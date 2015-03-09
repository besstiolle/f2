<?php

if (!function_exists("cmsms")) exit;

$projectId = $params['projectId'];
$projectName = $params['projectName'];

//Ask the module/tag/...
$request = RestAPI::GET('rest/v1/project/'.$projectId);
if($request->getStatus() === 404){
	$smarty->assign('error', 'The Project '.$projectName.' (#'.$projectId.') does not exist');
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
$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'projectEditSend', 'post','', true, '',  array(
				 	'sid' => $project['id'],
					'_link_next_failed'=> $config['root_url'].'/project/'.$project['id'].'/'.$project['unix_name'].'/edit',
								)));
$smarty->assign('project', $project);
$smarty->assign('link_back', $config['root_url'].'/project/'.$project['id'].'/'.$project['unix_name']);




echo $this->processTemplate('projectEdit.tpl');

//Debug part
var_dump($response['request']);
var_dump($response['server']);
var_dump(RestAPI::getDump());