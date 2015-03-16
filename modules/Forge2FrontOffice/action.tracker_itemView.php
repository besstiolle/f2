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
$request = RestAPI::GET('rest/v1/tracker_item/'.$params['tracker_itemId']);
if($request->getStatus() === 404){
	$smarty->assign('error', 'The tracker item #'.$params['tracker_itemId'].' does not exist');
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

//Get the bugs in the response data
$tracker_item = $response['data']['tracker_items'][0];


$smarty->assign('root_url', $config['root_url']);
$smarty->assign('project', $project);
$smarty->assign('title', $project['name']);
$smarty->assign('tracker_item', $tracker_item);
$smarty->assign('tracker_type', $params['type']);

//Ask the comments of the module
$parameter = array('commentable_id' => $params['tracker_itemId']);
$request = RestAPI::GET('rest/v1/comment/', $parameter);
if($request->getStatus() === 404){
/*	$smarty->assign('error', 'The tracker item #'.$params['tracker_itemId'].' does not exist');
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

//Get the comments in the response data
$comments = $response['data']['comments'];
$smarty->assign('comments', $comments);


$smarty->assign('enumTrackerItemResolution', array_flip(Enum::ConstToArray('EnumTrackerItemResolution')));
$smarty->assign('enumTrackerItemSeverity', array_flip(Enum::ConstToArray('EnumTrackerItemSeverity')));
$smarty->assign('enumTrackerItemState', array_flip(Enum::ConstToArray('EnumTrackerItemState')));

$avatar = $config['root_url'].'/uploads/forge/design/user-64.png';
$smarty->assign('avatar', $avatar);

echo $this->processTemplate('tracker_itemView.tpl');

//Debug part
$smarty->assign('response', $response);
$smarty->assign('dump', RestAPI::getDump());
echo $this->processTemplate('vardump.tpl');

?>