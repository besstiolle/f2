<?php

if (!function_exists("cmsms")) exit;

$projectId = $params['projectId'];
$projectName = $params['projectName'];

//Ask the module/tag/...
$request = RestAPI::GET('rest/v1/project/'.$projectId);
if($request->getStatus() === 404){
	$smarty->assign('error', 'The project '.$projectName.' (#'.$projectId.') does not exist');
	echo $this->processTemplate('notFound.tpl');
	return;
} else if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	$smarty->assign('request', $request);
	$smarty->assign('dump', RestAPI::getDump());
	echo $this->processTemplate('rest_error.tpl');
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
$smarty->assign('is_admin', forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()));
$smarty->assign('is_member', forge_utils::is_project_member($project, forge_utils::getConnectedUserId()));
$smarty->assign('root_url', $config['root_url']);
$smarty->assign('avatar', (!empty($avatars)?$avatars[0]:null));
$smarty->assign('show', $shows);
$smarty->assign('baseurl_avatar', $baseurl_avatar);
$smarty->assign('baseurl_show', $baseurl_show);


echo $this->processTemplate('projectView.tpl');


//Debug part
$smarty->assign('response', $response);
$smarty->assign('dump', RestAPI::getDump());
echo $this->processTemplate('vardump.tpl');