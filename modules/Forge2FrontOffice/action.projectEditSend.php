<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

$projectId = $params['sid'];
$route = 'rest/v1/project/'.$projectId;
$failed = $params['_link_next_failed'];
$method = 'POST';

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

//Access denied for any no-admin / no-member
if( ! forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()) 
	&& ! forge_utils::is_project_member($project, forge_utils::getConnectedUserId())){
	//$this->RedirectForFrontEnd($id, $returnid, 'access_denied');
	print_r($project);
	die();
}

//get cookie to avoid url-scam
if(!forge_utils::hasCookie('edit', $projectId)){
	$smarty->assign('title', "Token expired");
	$smarty->assign('error', "Your token is expired. You should retry one more time");
	$smarty->assign('url', $config['root_url']."/project/".$projectId."/".$project['unix_name']."/edit");
	echo $this->processTemplate('forge_error.tpl');
	return;
}

$request = RestAPI::$method($route, array(), $params);
$response = json_decode($request->getResponse(), true);

if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	echo $this->processTemplate('rest_error.tpl');
	include('lib/inc.debug.php');
	return;
}


$sid = $response['data']['projects']['id'];
$name = $response['data']['projects']['name'];
$unix_name = $response['data']['projects']['unix_name'];
$message = 'the project '.$name.' is updated with success';	
$link = $config['root_url'].'/project/'.$sid.'/'.$unix_name;

$smarty->assign('message',$message);
$smarty->assign('link',$link);

/** CHECK ALSO PICTURES **/
$root_path = $config['root_path'];
$baseurl_avatar = $root_path.'/uploads/projects/'.$project['id'].'/avatar';
$baseurl_show = $root_path.'/uploads/projects/'.$project['id'].'/show';

$files = forge_utils::getFilesInDir($baseurl_avatar, '/\.(gif|jpe?g|png)$/i');
if(!empty($files)) {
	$route = 'rest/v1/files/project/avatar/'.$projectId;
	$params['files'] = $files;
	$request = RestAPI::$method($route, array(), $params);
	if($request->getStatus() !== 200){
		//Debug part
		$smarty->assign('error', "Error processing the Rest request");
		echo $this->processTemplate('rest_error.tpl');
		include('lib/inc.debug.php');
		return;
	}
}

$files = forge_utils::getFilesInDir($baseurl_show, '/\.(gif|jpe?g|png)$/i');
if(empty($files)) {
	$route = 'rest/v1/files/project/show/'.$projectId;
	$params['files'] = $files;
	$request = RestAPI::$method($route, array(), $params);
	if($request->getStatus() !== 200){
		//Debug part
		$smarty->assign('error', "Error processing the Rest request");
		echo $this->processTemplate('rest_error.tpl');
		include('lib/inc.debug.php');
		return;
	}
}

echo $this->processTemplate('sended.tpl');

include('lib/inc.debug.php');