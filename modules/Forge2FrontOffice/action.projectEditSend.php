<?php

if (!function_exists("cmsms")) exit;

$route = 'rest/v1/project/'.$params['sid'];
$failed = $params['_link_next_failed'];
$method = 'POST';

//TODO make some test about "do he have the right to use this route"

//TODO make some test about "does this method (POST/GET/PUSH/DELETE) is allowed to this route"

$request = RestAPI::$method($route, array(), $params);
$response = json_decode($request->getResponse(), true);

if($request->getStatus() === 200){
	$sid = $response['data']['projects'][0]['id'];
	$name = $response['data']['projects'][0]['name'];
	$unix_name = $response['data']['projects'][0]['unix_name'];
	$message = 'the project '.$name.' is updated with success';	
	$link = $config['root_url'].'/project/'.$sid.'/'.$unix_name;
	
} else {
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	$smarty->assign('request', $request);
	$smarty->assign('dump', RestAPI::getDump());
	echo $this->processTemplate('rest_error.tpl');
	return;
}

$smarty->assign('message',$message);
$smarty->assign('link',$link);

echo $this->processTemplate('sended.tpl');

//Debug part
$smarty->assign('response', $response);
$smarty->assign('dump', RestAPI::getDump());
echo $this->processTemplate('vardump.tpl');