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
$consumer = feu_utils::get_auth_consumer();
if( $consumer->has_capability(feu_auth_consumer::CAPABILITY_LOGOUT) ) {
  // the consumer provides the login capabilities
  echo $consumer->get_logout_display($id,$returnid,$params);
  return;
}

try {
// do the default
    $uid = $this->LoggedInId();
    if( !$uid ) return; // nothing to do, user is not logged in.

    $returnto = \cge_param::get_string($params,'returnto'); // test me.
    $returnlast = \cge_param::get_bool($params,'returnlast'); // test me.
    $prelogout_url = \cge_param::get_string($params,'feu_prelogout_url');
    if( $returnlast && !$prelogout_url ) $prelogout_url = \cge_url::current_url();

    $username = $this->LoggedInName();
    $thetemplate = \cge_param::get_string($params,'logouttemplate','feusers_logoutform');
    $tpl = $this->CreateSmartyTemplate($thetemplate);
    // replace {$groupname} with the first groupname we can find that matches
    $groups = $this->GetMemberGroupsArray( $uid );
    $groupname = $this->GetGroupName( $groups[0]['groupid'] );
    $tpl->assign('prompt_loggedin', $this->Lang('msg_currentlyloggedinas')); // can get rid of this.
    $tpl->assign('userid', $uid);
    $tpl->assign('username', $username);

    // start ugly
    // todo: need some mechanism to tell 'which' authentication was used, if alt authentication is supported.
    $loggedin_using_std = FALSE;
    $manip = $this->GetManipulator();
    if( $manip->_std_LoggedInId() ) $loggedin_using_std = TRUE;
    // end ugly

    $parms = array();
    $parms['returnto'] = $returnto;
    $parms['returnlast'] = $returnlast;
    $parms['feu_prelogout_url'] = $prelogout_url;
    $url = $this->create_url($id,'logout',$returnid,$parms);
    $tpl->assign('url_logout',$url);

    // replace {$groupname} with the first groupname we can find that matches
    $cspage = $returnid;
    if( ($tmp = $this->GetPreference('pageid_changesettings')) ) {  // test me
        $tpl2 = $this->CreateSamrtyTemplate('string:'.$tmp,$tmp);
        $tmp = $tpl2->fetch();
        if( $tmp ) $cspage = $this->resolve_alias_or_id($tmp,$returnid);
    }
    $parms = array('form'=>'changesettings');
    $parms['returnto'] = $returnto;
    $parms['returnlast'] = $returnlast;
    $parms['feu_prelogout_url'] = $prelogout_url;
    $url = $this->create_url($id,'default',$cspage,$parms);
    $tpl->assign('url_changesettings',$url);
    $props = $this->GetUserProperties( $this->LoggedInId() );
    if( $props !== false ) {
        foreach( $props as $p ) {
            $tpl->assign($p['title'],$p['data']);
        }
    }

    if( $consumer->has_capability($consumer::CAPABILITY_ALTLOGIN) ) {
        // the consumer has alternate login capabilities....
        $res = $consumer->get_logout_display($id,$returnid,$params);
        $smarty->assign('alt_logoutform',$res);
    }

    $tpl->display();
}
catch( \Exception $e ) {
    // fatal error we cannot work around.
    echo $this->DisplayErrorMessage($e->GetMessage());
}

#
# EOF
#
?>