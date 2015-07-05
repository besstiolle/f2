<?php

if (!function_exists("cmsms")) exit;

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

$projectId = $params['sid'];
$returnid = $params['returnid'];
$success = $config['root_url'].'/project/list';


//Ask the module/tag/...
$request = RestAPI::GET('rest/v1/project/'.$projectId);
if($request->getStatus() === 404){
	$link = $success;
	$message = 'the project doesn\'t exists anymore. Maybe someone has already deleted it?';

	$smarty->assign('message',$message);
	$smarty->assign('link',$link);

	echo $this->processTemplate('sended.tpl');
	return;
} else if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	echo $this->processTemplate('rest_error.tpl');
	include('lib/inc.debug.php');
	return;
} 

$response = json_decode($request->getResponse(), true);

//Get the projects in the response data
$project = $response['data']['projects'][0];

//Access denied for any no-admin
if( forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()) ){
	$this->RedirectForFrontEnd($id, $returnid, 'access_denied');
}

//get cookie to avoid url-scam
if(!forge_utils::hasCookie('delete', $projectId)){
	$smarty->assign('title', "Token expired");
	$smarty->assign('error', "Your token has been already used. You should retry one more time");
	$smarty->assign('url', $config['root_url']."/project/".$projectId."/".$project['unix_name']."/delete");
	echo $this->processTemplate('forge_error.tpl');
	return;
}

die("delete stopped");

$route = '/rest/v1/project/'.$projectId;
$method = 'DELETE';

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
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	echo $this->processTemplate('rest_error.tpl');
	include('lib/inc.debug.php');
	return;
}

$smarty->assign('message',$message);
$smarty->assign('link',$link);

echo $this->processTemplate('sended.tpl');

include('lib/inc.debug.php');