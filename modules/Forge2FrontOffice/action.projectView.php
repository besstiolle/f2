<?php

if (!function_exists("cmsms")) exit;

$projectId = $params['projectId'];

//Ask the module/tag/...
$json = RestAPI::GET('rest/v1/projects/'.$projectId.'/a');
$response = json_decode($json, true);

//Get the projects in the response data
$projects = $response['data']['projects'];
$config = cmsms()->GetConfig();

$smarty->assign('root_url', $config['root_url']);
$smarty->assign('project', $projects[0]);


echo $this->processTemplate('projectView.tpl');

//Debug part
var_dump($response['request']);
var_dump($response['server']);
var_dump(RestAPI::getDump());