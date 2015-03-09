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

//TODO : set info in session to avoid url-scam and requiring confirmation before deleting something
$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'projectDeleteSend', 'post','', true, '', 
				 array(
				 	'sid' => $project['id']
				 	)));
$smarty->assign('project', $project);
$smarty->assign('link_back', $config['root_url'].'/project/list');

echo $this->processTemplate('projectDelete.tpl');

//Debug part
var_dump($response['request']);
var_dump($response['server']);
var_dump(RestAPI::getDump());