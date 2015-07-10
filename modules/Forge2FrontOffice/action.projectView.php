<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 


$projectId = $params['projectId'];
$projectName = $params['projectName'];

//Ask the module/tag/...
$request = RestAPI::GET('rest/v1/project/'.$projectId);
if($request->getStatus() === 404){
	/*$smarty->assign('error', 'The project '.$projectName.' (#'.$projectId.') does not exist');
	echo $smarty->display('msg_notFound.tpl');
	return;*/
	$label = 'The project '.$projectName.' (#'.$projectId.') does not exist';
	$this->Redirect($id, 'message', $returnId, array('code'=>, 404, 'label' => $label));
} else if($request->getStatus() !== 200){
	//Debug part
	/*$smarty->assign('error', "Error processing the Rest request");
	echo $smarty->display('msg_rest_error.tpl');
	include('lib/inc.debug.php');
	return;*/
	$label = 'Error processing the Rest request';
	$this->Redirect($id, 'message', $returnId, array('code'=>, 502, 'label' => $label));
} 

$response = json_decode($request->getResponse(), true);

//Get the projects in the response data
$project = $response['data']['projects'][0];
$config = cmsms()->GetConfig();

//TODO : ask to the back office the files
$baseurl_avatar = '/uploads/projects/'.$projectId.'/avatar/';
$baseurl_show = '/uploads/projects/'.$projectId.'/show/';


$avatars = forge_utils::getFilesInDir($config['root_path'].$baseurl_avatar, '/\.(gif|jpe?g|png)$/i');
$shows = forge_utils::getFilesInDir($config['root_path'].$baseurl_show, '/\.(gif|jpe?g|png)$/i');

//Get the active packages of the project
$restParameters = array();
$restParameters['project_id'] = $projectId;
$restParameters['is_active'] = 1;
$restParameters['is_public'] = 1;
$request = RestAPI::GET('rest/v1/package/', $restParameters);
if($request->getStatus() === 404){
	$smarty->assign('error', 'The project '.$projectName.' (#'.$projectId.') doesn\' have any package');
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
//Get the packages in the response data
$packages = $response['data']['packages'];

for($i=0; $i < count($packages); $i++) {
	$package = $packages[$i];
	$restParameters = array();
	$restParameters['package_id'] = $package['id'];
	//$restParameters['p'] = 0;
	$restParameters['n'] = 1;
	$request = RestAPI::GET('rest/v1/release/', $restParameters);
	if($request->getStatus() === 404){
		$smarty->assign('error', 'The package '.$package['id'].' doesn\' have any release');
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
	$packages[$i]['releases'] = $response['data']['releases'];
}


$smarty->assign('title', $project['name']);
$smarty->assign('project', $project);
$smarty->assign('packages', $packages);
$smarty->assign('is_admin', forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()));
$smarty->assign('is_member', forge_utils::is_project_member($project, forge_utils::getConnectedUserId()));
$smarty->assign('root_url', $config['root_url']);
$smarty->assign('avatar', (!empty($avatars)?$avatars[0]:null));
$smarty->assign('show', $shows);
$smarty->assign('baseurl_avatar', $baseurl_avatar);
$smarty->assign('baseurl_show', $baseurl_show);


echo $smarty->display('projectView.tpl');

include('lib/inc.debug.php');