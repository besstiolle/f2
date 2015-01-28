<?php

if (!function_exists("cmsms")) exit;

if(isset($params['filterAlpha'])){
	$json = RestAPI::GET('rest/v1/projects', array('p'=>1, 'n'=>10, 'filterAlpha' => $params['filterAlpha']));
	$response = json_decode($json, true);
} else {
	//Ask the last 10 modules
	$json = RestAPI::GET('rest/v1/projects', array('p'=>1, 'n'=>10));
	$response = json_decode($json, true);
}


//Get the projects in the response data
$projects = $response['data']['projects'];
$config = cmsms()->GetConfig();

$smarty->assign('root_url', $config['root_url']);
$smarty->assign('projects', $projects);
$smarty->assign('link_create', $config['root_url'].'/project/new');

echo $this->processTemplate('projects.tpl');

//Debug part
var_dump($response['request']);
var_dump($response['server']);
var_dump(RestAPI::getDump());