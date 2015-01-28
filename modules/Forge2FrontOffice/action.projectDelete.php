<?php

if (!function_exists("cmsms")) exit;

$projectId = $params['projectId'];
$projectName = $params['projectName'];

//Ask the module/tag/...
$json = RestAPI::GET('rest/v1/projects/'.$projectId.'/a');
$response = json_decode($json, true);

//Get the projects in the response data
$projects = $response['data']['projects'];

//TODO : set info in session to avoid url-scam and requiring confirmation before deleting something

if(empty($projects)){
	$smarty->assign('error', 'The Project '.$projectName.' (#'.$projectId.') does not exist.');
} else {
	$project = $projects[0];
	$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'send', 'post','', true, '',  array()));
	$smarty->assign('project', $project);
	$smarty->assign('link_back', $config['root_url'].'/project/list');
	$smarty->assign('link_next_success', $config['root_url'].'/project/list');
	$smarty->assign('link_next_failed', $config['root_url'].'/project/'.$projectId.'/'.$project['unix_name']);
	$smarty->assign('method', 'DELETE'); 
	$smarty->assign('routing', '/rest/v1/projects/'.$project['id'].'/a');
}

echo $this->processTemplate('projectDelete.tpl');

//Debug part
var_dump($response['request']);
var_dump($response['server']);
var_dump(RestAPI::getDump());