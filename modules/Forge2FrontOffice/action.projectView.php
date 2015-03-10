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
	throw new Exception("Error Processing GET Request on $restUrl with dataParams =
						\n ".print_r($paramsData,true)."
						\ncode returned = ".$request->getStatus()." 
						\n ".print_r(RestAPI::getDump(),true), 1);
} 

$response = json_decode($request->getResponse(), true);

//Get the projects in the response data
$project = $response['data']['projects'][0];
$config = cmsms()->GetConfig();


$smarty->assign('project', $project);
$smarty->assign('root_url', $config['root_url']);


echo $this->processTemplate('projectView.tpl');

//Debug part
var_dump($response['request']);
var_dump($response['server']);
var_dump(RestAPI::getDump());