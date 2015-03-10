<?php

if (!function_exists("cmsms")) exit;


$user = $this->getPreference('user', '[TO DEFINED]');
$pass = $this->getPreference('pass', '[TO DEFINED]');
$rest_url = $this->getPreference('rest_url', '[TO DEFINED]');

if(!empty($params['user'])){
	$user = $params['user'];
}
if(!empty($params['pass'])){
	$pass = $params['pass'];
}
if(!empty($params['rest_url'])){
	$rest_url = $params['rest_url'];
}

$this->setPreference('user', $user);
$this->setPreference('pass', $pass);
$this->setPreference('rest_url', $rest_url);

$this->redirect($id, 'defaultadmin', $returnid, array('message'=>'admin_param_saved'));

?>