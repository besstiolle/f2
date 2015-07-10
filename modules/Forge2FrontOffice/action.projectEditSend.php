<?php

if (!function_exists("cmsms")) exit;

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

//Access denied for any no-admin / no-member
if( ! forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()) 
	&& ! forge_utils::is_project_member($project, forge_utils::getConnectedUserId())){
	return errorGenerator::display403();
}

//get cookie to avoid url-scam
if(!forge_utils::hasCookie('edit', $params['CSRF'])){
	$next = $root_url."/project/".$projectId."/".$project['unix_name']."/edit";
	return errorGenerator::display500("Your token has been already used. You should go back and try again", $next);
}

$ServiceProject = new ServiceProject();
$project = $ServiceProject->update($projectId, $params, $root_url.'/project/'.$project['id'].'/'.$project['unix_name'].'/edit');
if(!$project){
	return;
}

$next = $root_url.'/project/'.$projectId.'/'.$project['unix_name'];
errorGenerator::display200('the project '.$project['name'].' is updated with success<br/>If you uploaded some pictures, they will be soon online.', $next);

/** 
 CHECK ALSO PICTURES 
 */

$baseurl_avatar = '/uploads/projects/'.$project['id'].'/avatar';
$baseurl_avatar_tmp = '/uploads/projects_cache/'.$project['id'].'/avatar';
$routeAvatar = 'rest/v1/files/project/'.$projectId.'/avatar/';

$baseurl_show = '/uploads/projects/'.$project['id'].'/show';
$baseurl_show_tmp = '/uploads/projects_cache/'.$project['id'].'/show';
$routeShow = 'rest/v1/files/project/'.$projectId.'/show/';

$regex = '/\.(gif|jpe?g|png)$/i';

if(!processImages($root_path, $root_url, $baseurl_avatar, $baseurl_avatar_tmp, $regex, $routeAvatar) ||
	!processImages($root_path, $root_url, $baseurl_show, $baseurl_show_tmp, $regex, $routeShow)){
	return;
}

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
			$filesParams[$file]['md5'] = md5_file($root_path.$baseurl_tmp.'/'.$file);
		}
		$params['files'] = $filesParams;

		$request = RestAPI::PUT($route, array(), $params);
		if($request->getStatus() !== 200){
			//Debug part
			$smarty->assign('error', "Error processing the Rest request");
			echo $smarty->display('msg_rest_error.tpl');
			include('lib/inc.debug.php');
			return false;
		}
	}
	return true;
}