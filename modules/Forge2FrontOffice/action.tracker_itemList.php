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
//Get the project in the response data
$project = $response['data']['projects'][0];


//Ask the bugs of the module
$parameters = array('project_id' => $projectId, 
					'type' => $params['type'],
					'state' => EnumTrackerItemState::Open
					
					);
$request = RestAPI::GET('rest/v1/tracker_item/', $parameters);
if($request->getStatus() === 404){
/*	$smarty->assign('error', 'The project '.$projectName.' (#'.$projectId.') does not exist');
	echo $this->processTemplate('notFound.tpl');
	return;*/
} else if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	$smarty->assign('request', $request);
	$smarty->assign('dump', RestAPI::getDump());
	echo $this->processTemplate('rest_error.tpl');
	return;
}

$response = json_decode($request->getResponse(), true);

//Get the bugs in the response data
$tracker_items = $response['data']['tracker_items'];

$smarty->assign('root_url', $config['root_url']);
$smarty->assign('project', $project);
$smarty->assign('title', $project['name']);
$smarty->assign('tracker_items', $tracker_items);
$smarty->assign('tracker_type', $params['type']);


$smarty->assign('enumTrackerItemResolution', array_flip(Enum::ConstToArray('EnumTrackerItemResolution')));
$smarty->assign('enumTrackerItemSeverity', array_flip(Enum::ConstToArray('EnumTrackerItemSeverity')));
$smarty->assign('enumTrackerItemState', array_flip(Enum::ConstToArray('EnumTrackerItemState')));

$avatar = $config['root_url'].'/uploads/forge/design/user-64.png';

$smarty->assign('avatar', $avatar);

echo $this->processTemplate('tracker_items.tpl');

//Debug part
$smarty->assign('response', $response);
$smarty->assign('dump', RestAPI::getDump());
echo $this->processTemplate('vardump.tpl');

?>