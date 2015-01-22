<?php

if (!function_exists("cmsms")) exit;

$projectId = $params['projectId'];

//Ask the module/tag/...
$json = RestAPI::GET('rest/v1/projects/'.$projectId.'/a');
$response = json_decode($json, true);

//Get the projects in the response data
$projects = $response['data']['projects'];

if(empty($projects)){
	$smarty->assign('error', 'The Project '.$projectId.' does not exist.');
} else {
	$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'send', 'post','', true, '',  array()));
	$smarty->assign('link_back', $config['root_url'].'/project/list');
	$smarty->assign('link_next_success', $config['root_url'].'/project/'.$projectId.'/'.$projects[0]['unix_name'].'/edit');
	$smarty->assign('link_next_failed', $config['root_url'].'/project/'.$projectId.'/'.$projects[0]['unix_name'].'/edit');
	$smarty->assign('method', 'POST'); // = edit
	$smarty->assign('routing', 'rest/v1/projects/'.$projectId.'/a');
	$smarty->assign('project', $projects[0]);
}


echo $this->processTemplate('projectEdit.tpl');

//Debug part
var_dump($response['request']);
var_dump($response['server']);
var_dump(RestAPI::getDump());