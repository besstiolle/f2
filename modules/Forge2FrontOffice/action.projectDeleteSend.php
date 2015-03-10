<?php

if (!function_exists("cmsms")) exit;

$route = '/rest/v1/project/'.$params['sid'];
$returnid = $params['returnid'];
$success = $config['root_url'].'/project/list';
$failed = $config['root_url'].'/project/list';
$method = 'DELETE';

//TODO make some test about "do he have the right to use this route"

$request = RestAPI::$method($route, array(), $params);

$response = json_decode($request->getResponse(), true);
$sid = '';

if($request->getStatus() == 200){
	$link = $success;
	$message = 'the project is deleted with success';	
} else if($request->getStatus() === 404){
	$link = $success;
	$message = 'the project doesn\'t exists anymore. Maybe someone has already deleted it?';
} else {
	$link = $failed;
	$message = 'an error had occured';
}

$smarty->assign('message',$message);
$smarty->assign('link',$link);

echo $this->processTemplate('sended.tpl');


//Debug part
$smarty->assign('response', $response);
$smarty->assign('dump', RestAPI::getDump());
echo $this->processTemplate('vardump.tpl');