<?php

if (!function_exists("cmsms")) exit;

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

//TODO : ask to the back office the files
$baseurl_avatar = '/uploads/projects/'.$projectId.'/avatar/';
$baseurl_show = '/uploads/projects/'.$projectId.'/show/';


$avatars = forge_utils::getFilesInDir($root_path.$baseurl_avatar, '/\.(gif|jpe?g|png)$/i');
$shows = forge_utils::getFilesInDir($root_path.$baseurl_show, '/\.(gif|jpe?g|png)$/i');

//Get the active packages of the project
$restParameters = array();
$restParameters['project_id'] = $projectId;
$restParameters['is_active'] = 1;
$restParameters['is_public'] = 1;
$request = RestAPI::GET('rest/v1/package/', $restParameters);
if($request->getStatus() === 404){
	return errorGenerator::display404('The project '.$projectName.' (#'.$projectId.') doesn\' have any package');
} else if($request->getStatus() !== 200){
	return errorGenerator::display400();
} 

$response = json_decode($request->getResponse(), true);
//Get the packages in the response data
$packages = $response['data']['packages'];

for($i=0; $i < count($packages); $i++) {
	$serviceRelease = new ServiceRelease();
	$releases = $serviceRelease->getByPackageId($packages[$i]['id'], $projectId, $projectName);
	if(!$releases){ return; }
	$packages[$i]['releases'] = $releases;
}


$smarty->assign('title', $project['name']);
$smarty->assign('project', $project);
$smarty->assign('packages', $packages);
$smarty->assign('avatar', (!empty($avatars)?$avatars[0]:null));
$smarty->assign('show', $shows);
$smarty->assign('baseurl_avatar', $baseurl_avatar);
$smarty->assign('baseurl_show', $baseurl_show);


echo $smarty->display('projectView.tpl');

include('lib/inc.debug.php');