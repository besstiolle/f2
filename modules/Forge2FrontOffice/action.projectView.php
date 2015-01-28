<?php

if (!function_exists("cmsms")) exit;

$projectId = $params['projectId'];
$projectName = $params['projectName'];

//Ask the module/tag/...
$json = RestAPI::GET('rest/v1/projects/'.$projectId.'/a');
$response = json_decode($json, true);

//Get the projects in the response data
$projects = $response['data']['projects'];
$config = cmsms()->GetConfig();

if(empty($projects)){
	$smarty->assign('error', 'The Project '.$projectName.' (#'.$projectId.') does not exist.');
} else {
	$smarty->assign('project', $projects[0]);
}

$smarty->assign('root_url', $config['root_url']);


echo $this->processTemplate('projectView.tpl');

//Debug part
var_dump($response['request']);
var_dump($response['server']);
var_dump(RestAPI::getDump());