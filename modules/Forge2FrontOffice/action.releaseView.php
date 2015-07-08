<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 

$restParameters = array();
$restParameters['n'] = 1;

$all = true;
if(empty($params['all'])){
	$all = false;
} 

$request = RestAPI::GET('rest/v1/release/'.$params['releaseId'], $restParameters);
if($request->getStatus() === 404){
	$smarty->assign('error', 'The release '.$params['releaseId'].' doesn\' not exists');
	echo $smarty->display('msg_notFound.tpl');
	return;
} else if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	echo $smarty->display('msg_rest_error.tpl');
	include('lib/inc.debug.php');
	return;
}
$response = json_decode($request->getResponse(), true);
$release = $response['data']['releases'][0];
$release['current'] = true;
$releases = array($release);

/**
 * Get previous releases
 **/
if($all){

	$restParameters['showOlder'] = 1;
	$restParameters['sid'] = $params['releaseId'];
	$restParameters['package_id'] = $release['package_id']['id'];
	$restParameters['n'] = 10;
	$restParameters['p'] = 1;
	$request = RestAPI::GET('rest/v1/release/', $restParameters);

	if($request->getStatus() === 404){
		$smarty->assign('error', 'The release '.$params['releaseId'].' doesn\' not exists');
		echo $smarty->display('msg_notFound.tpl');
		return;
	} else if($request->getStatus() !== 200){
		//Debug part
		$smarty->assign('error', "Error processing the Rest request");
		echo $smarty->display('msg_rest_error.tpl');
		include('lib/inc.debug.php');
		return;
	}

	$response = json_decode($request->getResponse(), true);
	$oldReleases = $response['data']['releases'];

	//Combinaisons des deux
	$releases = array_merge($releases, $oldReleases);
}


/**
 Get project
**/
$projectId = $release['package_id']['project_id'];

//Ask the module/tag/...
$request = RestAPI::GET('rest/v1/project/'.$projectId);
if($request->getStatus() === 404){
	$smarty->assign('error', 'The project #'.$projectId.' does not exist');
	echo $smarty->display('msg_notFound.tpl');
	return;
} else if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	echo $smarty->display('msg_rest_error.tpl');
	include('lib/inc.debug.php');
	return;
} 

$response = json_decode($request->getResponse(), true);

//Get the projects in the response data
$project = $response['data']['projects'][0];
$config = cmsms()->GetConfig();


$baseurl_avatar = '/uploads/projects/'.$projectId.'/avatar/';
$baseurl_show = '/uploads/projects/'.$projectId.'/show/';


$avatars = forge_utils::getFilesInDir($config['root_path'].$baseurl_avatar, '/\.(gif|jpe?g|png)$/i');
$shows = forge_utils::getFilesInDir($config['root_path'].$baseurl_show, '/\.(gif|jpe?g|png)$/i');

$smarty->assign('title', $project['name']);
$smarty->assign('project', $project);
$smarty->assign('releases', $releases);
$smarty->assign('all', $all);
$smarty->assign('is_admin', forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()));
$smarty->assign('is_member', forge_utils::is_project_member($project, forge_utils::getConnectedUserId()));
$smarty->assign('root_url', $config['root_url']);
$smarty->assign('avatar', (!empty($avatars)?$avatars[0]:null));
$smarty->assign('show', $shows);
$smarty->assign('baseurl_avatar', $baseurl_avatar);
$smarty->assign('baseurl_show', $baseurl_show);



echo $smarty->display('releaseView.tpl');

include('lib/inc.debug.php');