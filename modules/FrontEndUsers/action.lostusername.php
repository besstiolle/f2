<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: FrontEndUsers (c) 2008-2014 by Robert Campbell
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow management of frontend
#  users, and their login process within a CMS Made Simple powered
#  website.
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# Visit the CMSMS Homepage at: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE
if( !isset($gCms) ) exit;

try {
    $message = null;
    $username_is_email = $this->GetPreference('username_is_email');
    $nocaptcha = \cge_param::get_bool($params,'nocaptcha');
    $thetemplate = \cge_param::get_string($params,'lostuntemplate','feusers_lostunform');
    $returnto = \cge_param::get_int($params,'returnto',$returnid);

    $gid = \cge_param::get_string($params,'feu_gid',-1);
    $gid = \cge_param::get_string($params,'lostun_group',$this->GetPreference('default_group',$gid));
    if( !is_numeric($gid) ) {
        $gid = $this->GetGroupID( $gid );
        if( $gid < 1 ) throw new \RuntimeException($this->Lang('error_groupnotfound'));
    }
    if( $gid <= 0 ) {
        // no gid specified or found,  get the gid of the first group.
        $groups = $this->GetGroupList();
        $values = array_values($groups);
        $gid = $values[0];
    }

    $relns = $this->GetGroupPropertyRelations( $gid );
    if( !is_array( $relns ) || $relns[0] === FALSE ) throw new \RuntimeException('Unknown Error');

    // Now: we need to get the properties that may be filled in in this group.
    // and display them in the form
    // we do this before handling submit so that we don't lose as much user entered information
    // if there is a silly error in form submission.
    $rowarray = array();

    $defns = $this->GetPropertyDefns();
    foreach( $relns as $onereln ) {
        // if it's not required here, don't do anything
        if( $onereln['required'] == 3 || $onereln['required'] == 4) {
            // Hmm, how can an a field that's required in lostun be hidden
            // gotta figure that out.... todo
            throw new \RuntimeException('A Hidden/readonly field is required for lostusername?');
        }

        $defn = $defns[ $onereln['name'] ];

        $onerow = new StdClass();
        $onerow->required = false;
        $onerow->propname = $onereln['name'];
        $onerow->name = 'feu_input_'.$onereln['name'];
        $onerow->fldname = $id.$onerow->name;
        $onerow->type = $defn['type'];
        if( $onerow->type == 8 ) {
            // date field uses html_select_date which provides three input fields.
            $_m = \cge_param::get_int($params,$onerow->name.'Month');
            $_d = \cge_param::get_int($params,$onerow->name.'Day');
            $_y = \cge_param::get_int($params,$onerow->name.'Year');
            if( $_m && $_d && $_y ) $params[$onerow->name] = mktime(0,0,0,$_m,$_d,$_y);
        }
        $onerow->val = \cge_utils::get_param($params,$onerow->name); // do not use cge_param because input may be an array
        $onerow->length = $defn['length'];
        $onerow->maxlength = $defn['maxlength'];
        $onerow->prompt = $defn['prompt'];

        switch( $defn['type'] ) {
        case 4: // dropdown
        case 5: // multiselect
        case 7: // radiobtns
            $onerow->options = array_flip($this->GetSelectOptions($defn['name']));
            $onerow->length = 5;
            if( count($onerow->options) > 20 ) $onerow->length = 10;
            $onerow->length = min(count($onerow->options),$onerow->length);
            break;

        case 8: // date
            $onerow->start_year = \cge_param::get_string($defn['extra'],'startyear','-10');
            $onerow->end_year = \cge_param::get_string($defn['extra'],'endyear','+5');
            break;

        case 6: // image
            // this isn't allowed
            continue;
            break;
        }

        $rowarray[$onerow->propname] = $onerow;
    }

    if( isset($params['feu_cancel']) ) {
        $this->RedirectContent($returnto);
    }
    else if( isset($params['feu_submit']) ) {
        //
        // handle form submit
        //
        try {
            // by this point our values should be uptodate in the $rowarray

            // check our honeypot
            if( isset($params['feu__data']) ) {
                $tmp = \cge_param::get_string($params,'feu__data');
                if( $tmp ) throw new \RuntimeException($this->Lang('error_youareabot'));
            }

            // check the captcha
            if( !$nocaptcha ) {
                $captcha = \cms_utils::get_module('Captcha');
                if( is_object($captcha) && !$captcha->CheckCaptcha($params['feu_input_captcha']) ) {
                    throw new \RuntimeException($this->Lang('error_captchamismatch'));
                }
            }

            // check any required fields
            foreach( $rowarray as $key => $rec ) {
                if( $rec->required && !$rec->val ) throw new \RuntimeException($this->Lang('error_requiredfield',$rec->prompt));
            }

            //
            // ready to do real work
            // we iterate through the fields (except password) and build an feu query
            // and hope that we only find one result.
            // if we find one result... we can display some information to the guy.
            //
            $sql = 'SELECT DISTINCT U.* FROM '.cms_db_prefix().'module_feusers_users U ';
            $n_conds = 0;
            $where = $joins = $parms = array();
            //$where[] = 'U.expires > NOW()';
            //$where[] = 'COALESCE(U.disabled,0) = 0';

            foreach( $rowarray as $key => $rec ) {
                if( !$rec->val ) continue;
                if( $key == '_password' ) continue;
                if( $key == '_email' ) continue;

                switch( $rec->type ) {
                case 0: // text
                case 2: // email
                case 3: // textarea
                    if( strlen($rec->val) > 3 ) {
                        $alias = "P{$n_conds}"; $n_conds++;
                        $joins[] = 'LEFT JOIN '.cms_db_prefix()."module_feusers_properties $alias ON U.id = {$alias}.userid AND {$alias}.title = '{$rec->propname}'";
                        $where[] = "{$alias}.data LIKE ?";
                        $parms[] = '%'.$rec->val.'%';
                    }
                    break;

                case 1: // checkbox
                    $alias = "P{$n_conds}"; $n_conds++;
                    $joins[] = 'LEFT JOIN '.cms_db_prefix()."module_feusers_properties $alias ON U.id = {$alias}.userid AND {$alias}.title = '{$rec->propname}'";
                    $where[] = "{$alias}.data = ?";
                    $parms[] = 1;
                    break;

                case 4: // dropdown
                case 7: // radiobtns
                    $alias = "P{$n_conds}"; $n_conds++;
                    $joins[] = 'LEFT JOIN '.cms_db_prefix()."module_feusers_properties $alias ON U.id = {$alias}.userid AND {$alias}.title = '{$rec->propname}'";
                    $where[] = "{$alias}.data = ?";
                    $parms[] = $rec->val;
                    break;

                case 4: // multiselect
                    // multiselect is a different case... we need to build an OR relationship so that any of the selected items match.
                    $alias = "P{$n_conds}"; $n_conds++;
                    $joins[] = 'LEFT JOIN '.cms_db_prefix()."module_feusers_properties $alias ON U.id = {$alias}.userid AND {$alias}.title = '{$rec->propname}'";
                    $t_val = $rec->val;
                    if( !is_array($t_val) ) $t_val = array($t_val);
                    if( count($t_val) == 1 ) {
                        $where[] = "{$alias}.data = ?";
                        $parms[] = $t_val;
                    }
                    else {
                        $str = '%'.implode('%',$t_val).'%';
                        $where[] = "{$alias}.data LIKE ?";
                    }
                    break;

                case 8: // date
                    $alias = "P{$n_conds}"; $n_conds++;
                    $joins[] = 'LEFT JOIN '.cms_db_prefix()."module_feusers_properties $alias ON U.id = {$alias}.userid AND {$alias}.title = '{$rec->propname}'";
                    $where[] = "{$alias}.data = ?";
                    $parms[] = $rec->val;
                    break;
                }
            }

            // check to make sure that there is at least some information
            if( $n_conds == 0 ) throw new \RuntimeException($this->Lang('error_lostun_nodata'));

            // build the query
            $sql .= implode(' ',$joins);
            $sql .= ' WHERE '.implode(' AND ',$where);
            $sql .= ' LIMIT 2';
            $tmp = $db->GetArray($sql,$parms);
            if( count($tmp) > 1 ) throw new \RuntimeException($this->Lang('error_nouniquematch'));
            if( !count($tmp) ) throw new \RuntimeException($this->Lang('error_lostun_usernotfound'));
            $uinfo = $tmp[0];
            $username = $uinfo['username'];

            // and display something
            $tpl = $this->CreateSmartyTemplate('feusers_lostunform_confirm');
            $tpl->assign('username',$username);
            $tpl->assign('prompt_yourusernameis',$this->Lang('your_username_is'));
            $tpl->assign('premsg',$this->Lang('lostunconfirm_premsg'));
            $tpl->assign('postmsg',$this->Lang('lostunconfirm_postmsg'));
            $tpl->display();
            return;
        }
        catch( \Exception $e ) {
            $message = $e->GetMessage();
        }
    }

    // start giving stuff to smarty.
    $tpl = $this->CreateSmartyTemplate($thetemplate);
    $parms = array('feu_gid'=>$gid);
    $parms['nocaptcha'] = $nocaptcha;
    $parms['returnto'] = $returnto;
    $parms['feu_lostuntemplate'] = $thetemplate;
    $tpl->assign('startform', $this->CGCreateFormStart($id,'lostusername',$returnid,$parms));
    $tpl->assign('endform', $this->CreateFormEnd());
    $tpl->assign('username_is_email',$username_is_email);
    $tpl->assign('unfldlen',$this->GetPreference('usernamefldlength'));
    $tpl->assign('max_unfldlen',$this->GetPreference('max_usernamelength'));
    $tpl->assign('message',$message);

    if( !$nocaptcha ) {
        $captcha = $this->GetModuleInstance('Captcha');
        if( is_object($captcha) ) {
            $tpl->assign('captcha', $captcha->getCaptcha());
            $tpl->assign('captcha_title', $this->Lang('captcha_title'));
            $test = method_exists($captcha, 'NeedsInputField') ? $captcha->NeedsInputField() : true;
            $tpl->assign('need_captcha_input',$test);
        }
    }

    $tpl->assign('controls', $rowarray);
    $tpl->display();
}
catch( \Exception $e ) {
    // fatal error that we cant work around.
    echo $this->DisplayErrorMessage($e->GetMessage());
}

// EOF
?>
