<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

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

//Access denied for any no-admin
if( ! forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()) ){
	$this->RedirectForFrontEnd($id, $returnid, 'access_denied');
}

//set cookie to avoid url-scam
forge_utils::putCookie('delete', $projectId);

$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'projectDeleteSend', 'post','', true, '', 
				 array(
				 	'sid' => $project['id']
				 	)));

$smarty->assign('title', 'Delete project '.$project['name']);
$smarty->assign('project', $project);
$smarty->assign('link_back', $config['root_url'].'/project/list');

echo $this->processTemplate('projectDelete.tpl');

include('lib/inc.debug.php');