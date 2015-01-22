<?php

if (!function_exists("cmsms")) exit;

$route = $params['routing'];
$returnid = $params['returnid'];
$success = $params['link_next_success'];
$failed = $params['link_next_failed'];

//TODO make some test about "do he have the right to use this route"

//TODO make some test about "does this method (POST/GET/PUSH/DELETE) is allowed to this route"

//Unset unused parameters
unset($params['action']);
unset($params['returnid']);
unset($params['method']);
unset($params['routing']);
unset($params['link_next_success']);
unset($params['link_next_failed']);

$json = RestAPI::$_SERVER['REQUEST_METHOD']($route, $params);
$response = json_decode($json, true);

if($response['server']['code'] == 200){
	$link = $success;
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$message = 'the entity is updated with success';	
	} else if($_SERVER['REQUEST_METHOD'] == 'PUT') {
		$message = 'the entity is created with success';	
	}  else if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
		$message = 'the entity is deleted with success';	
	} else {
		$message = 'the operation is a success';
	}
	
} else {
	$link = $failed;
	$message = 'an error had occured';
}

$smarty->assign('message',$message);
$smarty->assign('link',$link);

echo $this->processTemplate('sended.tpl');

//var_dump($json);
//var_dump($response);