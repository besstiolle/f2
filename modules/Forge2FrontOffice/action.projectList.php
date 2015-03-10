<?php

if (!function_exists("cmsms")) exit;

$restParameters = array();

// Number of the page
$restParameters['p'] = 1;
if(!empty($params['pagin_page'])) {
	$restParameters['p'] = $params['pagin_page'];
}

//Number of element by page
$restParameters['n'] = 10;
if(!empty($params['pagin_num'])) {
	$restParameters['n'] = $params['pagin_num'];
}

//Filter on the first char
if(isset($params['filterAlpha'])) {
	$restParameters['filterAlpha'] = $params['filterAlpha'];
} 

//Ask the last 10 modules
$request = RestAPI::GET('rest/v1/project', $restParameters);
if($request->getStatus() === 404){
	$smarty->assign('error', 'there is no project in the forge');
	echo $this->processTemplate('notFound.tpl');
	return;
} else if($request->getStatus() !== 200){
	throw new Exception("Error Processing GET Request on $restUrl with dataParams =
						\n ".print_r($paramsData,true)."
						\ncode returned = ".$request->getStatus()." 
						\n ".print_r(RestAPI::getDump(),true), 1);
} 

$response = json_decode($request->getResponse(), true);

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