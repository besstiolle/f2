<?php

if (!function_exists("cmsms")) exit;


$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'admin_save_params', 'post','', true, '',  array()));
$smarty->assign('user', $this->getPreference('user', '[TO DEFINED]'));
$smarty->assign('pass', $this->getPreference('pass', '[TO DEFINED]'));
$smarty->assign('rest_url', $this->getPreference('rest_url', '[TO DEFINED]'));

if(isset($params['message'])){
	echo $this->ShowMessage($this->Lang($params['message']));
//	die($this->ShowMessage($this->Lang($params['message'])));
}

try{
	$token = RestAPI::getToken();
	if(!empty($token)){
		$smarty->assign('token', $token);
	}
} catch (Exception $e) {
	//Don't bother with this exception.
}

//var_dump(RestAPI::getDump());

echo $this->processTemplate('defaultadmin.tpl');
?>