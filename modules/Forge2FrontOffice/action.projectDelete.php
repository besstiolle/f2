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

if(forge_utils::is_project_admin($project, forge_utils::getConnectedUserId())){
	echo "oui";
} else {
	echo "non";
}

//TODO : set info in session to avoid url-scam and requiring confirmation before deleting something
$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'projectDeleteSend', 'post','', true, '', 
				 array(
				 	'sid' => $project['id']
				 	)));

$smarty->assign('title', 'Delete project '.$project['name']);
$smarty->assign('project', $project);
$smarty->assign('link_back', $config['root_url'].'/project/list');

echo $this->processTemplate('projectDelete.tpl');


//Debug part
$smarty->assign('response', $response);
$smarty->assign('dump', RestAPI::getDump());
echo $this->processTemplate('vardump.tpl');