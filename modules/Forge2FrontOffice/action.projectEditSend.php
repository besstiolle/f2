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
	$smarty->assign('error', "Your token has been already used. You should retry one more time");
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
$message = 'the project '.$name.' is updated with success<br/>If you uploaded some pictures, they will be soon online.';	
$link = $config['root_url'].'/project/'.$sid.'/'.$unix_name;

$smarty->assign('message',$message);
$smarty->assign('link',$link);

/** CHECK ALSO PICTURES **/
$root_path = $config['root_path'];
$root_url = $config['root_url'];

$baseurl_avatar = '/uploads/projects/'.$project['id'].'/avatar';
$baseurl_avatar_tmp = '/uploads/projects_cache/'.$project['id'].'/avatar';
$routeAvatar = 'rest/v1/files/project/'.$projectId.'/avatar/';

$baseurl_show = '/uploads/projects/'.$project['id'].'/show';
$baseurl_show_tmp = '/uploads/projects_cache/'.$project['id'].'/show';
$routeShow = 'rest/v1/files/project/'.$projectId.'/show/';

$regex = '/\.(gif|jpe?g|png)$/i';

processImages($root_path, $root_url, $baseurl_avatar, $baseurl_avatar_tmp, $regex, $routeAvatar);
processImages($root_path, $root_url, $baseurl_show, $baseurl_show_tmp, $regex, $routeShow);


echo $this->processTemplate('sended.tpl');

include('lib/inc.debug.php');


function processImages($root_path, $root_url, $baseurl, $baseurl_tmp, $regex, $route){

	$files = forge_utils::getFilesInDir($root_path.$baseurl, $regex);
	if(!empty($files)) {
		
		$filesParams = array();
		foreach ($files as $file) {
			if(!is_dir($root_path.$baseurl_tmp)){
				//Create tmp directory if necessary
				mkdir($root_path.$baseurl_tmp, 0750, true);
			}
			//Moving to tmp directory
			rename($root_path.$baseurl.'/'.$file, $root_path.$baseurl_tmp.'/'.$file);

			$filesParams[$file] = array();
			$filesParams[$file]['url'] = $root_url.$baseurl_tmp.'/'.$file;
			$filesParams[$file]['md5'] = md5($root_path.$baseurl_tmp);
		}
		$params['files'] = $filesParams;

		$request = RestAPI::PUT($route, array(), $params);
		if($request->getStatus() !== 200){
			//Debug part
			$smarty->assign('error', "Error processing the Rest request");
			echo $this->processTemplate('rest_error.tpl');
			include('lib/inc.debug.php');
			return false;
		}
	}
	return true;
}