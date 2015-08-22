<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: FrontEndUsers (c) 2008-2015 by Robert Campbell
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

$username = $email = null;
$error = null;
$message = null;
$username_is_email = $this->GetPreference('username_is_email',0);
$nocaptcha = \cge_param::get_bool($params,'nocaptcha',FALSE);
$returnto = \cge_param::get_int($params,'returnto',$returnid);
$thetemplate = \cge_param::get_string($params,'forgotpwtemplate','feusers_forgotpasswordform');
$tpl = $this->CreateSmartyTemplate($thetemplate);

if( isset($params['feu_cancel']) ) {
    $this->RedirectContent($returnto);
}
else if( isset($params['feu_submit']) ) {
    try {
        // make sure we have a username
        $username = \cge_param::get_string($params,'feu_username');
        if( !$username ) throw new \RuntimeException($this->Lang('error_insufficientparams'));
        if( $username_is_email && !is_email($username) ) throw new \RuntimeException($this->Lang('error_invalidemailaddress'));

        // validate the captcha
        if( !$nocaptcha ) {
            $captcha = \cms_utils::get_module('Captcha');
            if( is_object($captcha) && !$captcha->CheckCaptcha(\cge_param::get_string($params,'feu_input_captcha')) ) {
                throw new \RuntimeException($this->Lang('error_captchamismatch'));
            }
        }

        // see if we can find this user
        $uid = $this->GetUserID($username);
        if( !$uid ) throw new \RuntimeException($this->Lang('error_usernotfound'));
        $tmp = $this->GetUserInfo($uid);
        if( !$tmp || !$tmp[0] ) throw new \RuntimeException($this->Lang('error_couldnotfindemail'));
        $user_info = $tmp[1];
        unset($tmp);
        if( $user_info['disabled'] ) throw new \RuntimeException($this->Lang('error_accountdisabled'));
        if( time() > strtotime($user_info['expires']) )  throw new \RuntimeException($this->Lang('error_accountexpired'));
        $email = $username;
        if( !$username_is_email ) {
            $email = $this->GetEmail($uid);
            if( !$email ) throw new \RuntimeException($this->Lang('error_couldnotfindemail'));
        }

        // see if we have a tempcode for this user already
        if( !$this->GetPreference('allow_duplicate_reminders') && $this->GetUserTempCode($uid) ) {
            throw new \RuntimeException($this->Lang('error_resetalreadysent'));
        }

        //
        // woot... at this point it all worked.
        // ready to get a temp code and send an email.
        //
        $code = substr(strtoupper(md5(__FILE__.$username.microtime())),0,25);
        $this->SetUserTempCode( $uid, $code );

        // send our funky email
        $destpage = $returnid;
        $tmp = $this->GetPreference('pageidforgotpasswd');
        if( $tmp ) $destpage = $this->resolve_alias_or_id($tmp,$tmp);

        $tpl2 = $this->CreateSmartyTemplate('feusers_forgotpasswordemailform');
        $tpl2->assign('title',$this->Lang('title_forgotpwemail'));
        $tpl2->assign('message_forgotpwemail',$this->Lang('message_forgotpwemail'));
        $tpl2->assign('prompt_code',$this->Lang('prompt_code'));
        $tpl2->assign('data_code',$code);
        $tpl2->assign('prompt_link',$this->Lang('prompt_link'));
        $pretty = "feu/verify/$destpage/$uid/$code";
        $parms = array('uid'=>$uid,'code'=>$code);
        $tpl2->assign('data_url',$this->create_url('cntnt0','verifycode',$destpage,$parms,false,false,$pretty));
        $body = $tpl2->fetch();

        $cmsmailer = \cms_utils::get_module('CMSMailer');
        $cmsmailer->reset();
        $cmsmailer->AddAddress($email);
        $cmsmailer->SetBody($body);
        $cmsmailer->SetSubject($this->Lang('lostpassword_emailsubject'));
        $cmsmailer->IsHTML(true);
        $cmsmailer->SetPriority(1);
        $cmsmailer->Send();

        // audit something
        audit($uid,$this->GetName(),'Requested a password reset code');

        // and we're done, do a redirect after post
        $parms = array('feu_username'=>$username);
        $parms['feu_forgotpwdone'] = 1;
        $parms['feu_email'] = $email;
        $this->redirect('cntnt01','forgotpw',$returnto,$parms);
    }
    catch( \Exception $e ) {
        $error = 1;
        $message = $e->GetMessage();
    }
}
else if( isset($params['feu_forgotpwdone']) ) {
    // we can now display our message.
    $message = $this->Lang('info_forgotpwmessagesent',$email);
    $email = \cge_param::get_string($params,'feu_email');
    $username = \cge_param::get_string($params,'feu_username');
    $tpl->assign('email',$email);
    $tpl->assign('username',$username);
    $tpl->assign('forgotpwdone',1);
    // fall through...
}

// create and display the template.
$tpl->assign('error',$error);
$tpl->assign('message',$message);
$tpl->assign('username',$username);
$captcha = $this->GetModuleInstance('Captcha');
if( is_object($captcha) && !$nocaptcha ) {
    $tpl->assign('captcha_title',$this->Lang('captcha_title'));
    $tpl->assign('captcha',$captcha->getCaptcha());
    $test = method_exists($captcha, 'NeedsInputField') ? $captcha->NeedsInputField() : true;
    if( $test ) $tpl->assign('input_captcha', $this->CreateInputText($id,'feu_input_captcha','',10));
}
$parms = array();
$parms['nocaptcha'] = $nocaptcha;
$parms['returnto'] = $returnto;
$tpl->assign('startform',$this->CGCreateFormStart( $id, 'forgotpw', $returnid, $parms ));
$tpl->assign('endform',$this->CreateFormEnd());
$tpl->assign('username_is_email',$username_is_email);
$tpl->assign('unfldlen',$this->GetPreference('usernamefldlength'));
$tpl->assign('max_unfldlen',$this->GetPreference('max_usernamelength'));
$tpl->display();

#
# EOF
#
?>