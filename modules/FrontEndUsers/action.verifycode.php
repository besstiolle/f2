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

$username = $fatal = $error = $message = null;
$do_form = 1;
$uid = \cge_param::get_int($params,'uid');
$code = \cge_param::get_string($params,'code');
$username_is_email = $this->GetPreference('username_is_email',0);
$password1 = \cge_param::get_string($params,'feu_password1');
$password2 = \cge_param::get_string($params,'feu_password2');
$tpl = $this->CreateSmartyTemplate('feusers_forgotpasswordverifyform');

try {
    if( $uid < 1 ) throw new \LogicException($this->Lang('error_insufficientparams'));
    if( !$code ) throw new \LogicException($this->Lang('error_insufficientparams'));
    $res = $this->GetUserInfo($uid);
    if( !$res ) throw new \LogicException($this->Lang('error_usernotfound'));
    $uinfo = $res[1];
    if( !is_array($uinfo )) throw new \LogicException($this->Lang('error_usernotfound'));
    if( $uinfo['disabled'] ) throw new \LogicException($this->Lang('error_accountdisabled'));
    if( time() > strtotime($uinfo['expires']) ) throw new \LogicException($this->Lang('error_accountexpired'));
    $username = $uinfo['username'];

    if( isset($params['feu_afterverify']) ) {
        $tpl->assign('feu_afterverify',1);
        $do_form = 0;
        $message = $this->Lang('info_password_reset');
    }
    else if( isset($params['feu_submit']) ) {
        $tempcode = $this->GetUserTempCode($uid);
        if( !$tempcode ) throw new \LogicException($this->Lang('error_tempcodenotfound'));

        $code = \cge_param::get_string($params,'feu_code');
        $password1 = cms_html_entity_decode(\cge_param::get_string($params,'feu_password1'));
        $password2 = cms_html_entity_decode(\cge_param::get_string($params,'feu_password2'));
        if( !$this->IsValidPassword($password1) ) throw new \RuntimeException($this->Lang('error_invalidpassword'));
        if( $password1 != $password2 ) throw new \RuntimeException($this->Lang('error_passwordmismatch'));
        if( $code != $tempcode ) throw new \RuntimeException($this->Lang('error_invalidcode'));
        $this->SetUserPassword($uid,$password1);
        $this->RemoveUserTempCode($uid);
        $username = $this->GetUsername($uid);

        // and send an event
        $event_params = array();
        $event_params['name'] = $username;
        $event_params['id'] = $uid;
        $this->SendEvent('OnUpdateUser',$event_params);
        $this->_SendNotificationEmail('OnUpdateUser',$event_params);

        // and audit it
        audit($uid,$this->GetName(),'Successfully changed password via forgotpw');

        // and redirect somewhere
        $pagetpl = $this->GetPreference('pageid_afterverify');
        if( $pagetpl ) {
            $tpl2 = $this->CreateSmartyTemplate('string:'.$pagetpl);
            $tpl2->assign('username',$event_params['name']);
            $tpl2->assign('uid',$uid);
            $groups = $this->GetMemberGroupsArray( $uid );
            $groupname = $this->GetGroupName( $groups[0]['groupid'] );
            $tpl2->assign('groupname',$groupname);
            $page = $tpl2->fetch();
            $dest = $this->resolve_alias_or_id($page,$returnid);
            if( !$dest ) {
                audit('',$this->GetName(),'Could not convert template &quot;'.$pagetpl.'&quot; to a page id');
            }
            else {
                $this->RedirectContent($dest);
            }
        }
        else {
            // redirect after POST
            $parms = array('feu_afterverify'=>1,'uid'=>$uid,'code'=>'__invalid__');
            $this->redirect('cntnt001','verifycode',$returnid,$parms);
        }
    }
}
catch( \RuntimeException $e ) {
    $error = 1;
    $message = $e->GetMessage();
}
catch( \LogicException $e ) {
    $do_form = 0;
    $error = 1;
    $message = $e->GetMessage();
}


// create the template
if( $do_form ) {
    $parms = array('uid'=>$uid,'code'=>$code);
    $tpl->assign('startform',$this->CGCreateFormStart('cntnt01','verifycode',$returnid,$parms));
    $tpl->assign('endform',$this->CreateFormEnd());
}
$tpl->assign('unfldlen',$this->GetPreference('usernamefldlength'));
$tpl->assign('max_unfldlen',$this->GetPreference('max_usernamelength'));
$tpl->assign('pwfldlen',$this->GetPreference('passwordfldlength'));
$tpl->assign('max_pwfldlen',$this->GetPreference('max_passwordlength'));
$tpl->assign('username_is_email',$username_is_email);
$tpl->assign('username',$username);
$tpl->assign('password1',$password1);
$tpl->assign('password2',$password2);
$tpl->assign('code',$code);
$tpl->assign('uid',$uid);
$tpl->assign('error',$error);
$tpl->assign('message',$message);
$tpl->display();

?>