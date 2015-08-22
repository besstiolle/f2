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
if( !defined('CMS_VERSION') ) exit;

$tpl = $this->CreateSmartyTemplate('force_newpw_template');
$tpl->assign('formstart',$this->CGCreateFormStart($id,'user_forcenewpw',$returnid,$params));
$tpl->assign('formend',$this->CreateFormEnd());

try {
    $uid = (int) cge_utils::get_param($params,'uid');
    if( $uid < 1 ) throw new \RuntimeException($this->Lang('error_invalidparams'));
    $uid2 = $this->LoggedInId();
    if( $uid != $uid2 ) throw new \RuntimeException($this->Lang('error_invalidparams'));

    if( isset($params['feu_submit']) ) {
        $pw1 = cms_html_entity_decode(cge_utils::get_param($params,'feu_password'));
        $pw2 = cms_html_entity_decode(cge_utils::get_param($params,'feu_repeatpassword'));
        if( $pw1 != $pw2 ) throw new \RuntimeException($this->Lang('error_passwordmismatch'));

        // see if it is a valid password.
        if( !$this->IsValidPassword($pw1 ) ) throw new \RuntimeException($this->Lang('error_invalidpassword'));

        // now see if the password has actually changed.
        $db = cmsms()->GetDb();
        $encrypted = $this->EncryptPassword($uid,$pw1);
        $query = 'SELECT password FROM '.cms_db_prefix().'module_feusers_users WHERE id = ?';
        $stored = $db->GetOne($query,array($uid));
        if( $encrypted == $stored ) throw new \RuntimeException($this->Lang('error_passwordnotchanged'));

        // set the password
        $this->SetUserPassword($uid,$pw1);

        // disable the force reset flag
        $this->ForcePasswordChange($uid,FALSE);

        // and redirect out o here.
        $page = '';
        $return_url = '';
        if( ($url = $this->session_get('postlogin_url')) ) {
            $return_url = trim($url);
            $this->session_clear('postlogin_url');
        }
        else if( isset($params['returnlast']) && isset($_SESSION['feu_prelogin_url']) ) {
            $return_url = trim($_SESSION['feu_prelogin_url']);
            unset($_SESSION['feu_prelogin_url']);
        }
        else {
            $page = $this->GetPreference('pageid_login');
            if( isset( $params['returnto'] ) ) $page = $params['returnto'];

            // replace {$groupname} with the first groupname we can find that matches
            $groups = $this->GetMemberGroupsArray( $uid );
            $groupname = $this->GetGroupName( $groups[0]['groupid'] );
            $smarty->assign('username',$params['feu_input_username']);
            $smarty->assign('group',$groupname);
            $page = $this->ProcessTemplateFromData($page);
        }

        // now we know where we're going.
        if( $return_url != '' ) {
            redirect($return_url);
        }
        else if( $page ) {
            $id = ContentManager::get_instance()->GetPageIDFromAlias( $page );
            if( $id ) {
                $this->RedirectContent( $id );
                return;
            }
            die( "couldn't get pageid for $page" );
        }
        else {
            $this->RedirectContent( $returnid );
        }
    }
}
catch( \Exception $e ) {
    // on error, we just display a message.
    $tpl->assign('error',$e->GetMessage());
}

$tpl->display();