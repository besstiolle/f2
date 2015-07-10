<?php

if (!function_exists("cmsms")) exit;

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

/***********************************************************/
//Ask the bugs of the module
$request = RestAPI::GET('rest/v1/tracker_item/'.$params['tracker_itemId']);
if($request->getStatus() === 404){
	$smarty->assign('error', 'The tracker item #'.$params['tracker_itemId'].' does not exist');
	echo $smarty->display('msg_notFound.tpl');
	return;
} else if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	echo $smarty->display('msg_rest_error.tpl');
	include('lib/inc.debug.php');
	return;
}

$response = json_decode($request->getResponse(), true);

//Get the bugs in the response data
$tracker_item = $response['data']['tracker_items'][0];


$smarty->assign('root_url', $root_url);
$smarty->assign('project', $project);
$smarty->assign('title', $project['name']);
$smarty->assign('tracker_item', $tracker_item);
$smarty->assign('tracker_type', $params['type']);


/***********************************************************/
//Ask the comments of the tracker_item
$parameter = array('commentable_id' => $params['tracker_itemId']);
$request = RestAPI::GET('rest/v1/comment/', $parameter);
if($request->getStatus() === 404){
/*	$smarty->assign('error', 'The tracker item #'.$params['tracker_itemId'].' does not exist');
	echo $smarty->display('msg_notFound.tpl');
	return;*/
} else if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	echo $smarty->display('msg_rest_error.tpl');
	include('lib/inc.debug.php');
	return;
}
$response = json_decode($request->getResponse(), true);

//Get the comments in the response data
$comments = $response['data']['comments'];

/***********************************************************/
//Ask the history of the tracker_item
$parameter = array('historizable_id' => $params['tracker_itemId']);
$request = RestAPI::GET('rest/v1/history/', $parameter);
if($request->getStatus() === 404){
/*	$smarty->assign('error', 'The tracker item #'.$params['tracker_itemId'].' does not exist');
	echo $smarty->display('msg_notFound.tpl');
	return;*/
} else if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	echo $smarty->display('msg_rest_error.tpl');
	include('lib/inc.debug.php');
	return;
}
$response = json_decode($request->getResponse(), true);

//Get the comments in the response data
$histories = $response['data']['histories'];

//Merge the 2 array
$elements = array();
foreach ($histories as $history) {
	$history['_type'] = 'history';
	$elements[$history['created_at']] = $history;
}
foreach ($comments as $comment) {
	$comment['_type'] = 'comment';
	$elements[$comment['created_at']] = $comment;
}
ksort($elements);

$smarty->assign('comments', $comments);
$smarty->assign('elements', $elements);


$smarty->assign('enumTrackerItemResolution', array_flip(Enum::ConstToArray('EnumTrackerItemResolution')));
$smarty->assign('enumTrackerItemSeverity', array_flip(Enum::ConstToArray('EnumTrackerItemSeverity')));
$smarty->assign('enumTrackerItemState', array_flip(Enum::ConstToArray('EnumTrackerItemState')));
$smarty->assign('is_admin', forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()));
$smarty->assign('is_member', forge_utils::is_project_member($project, forge_utils::getConnectedUserId()));

$avatar = $root_url.'/uploads/forge/design/user-64.png';
$smarty->assign('avatar', $avatar);

echo $smarty->display('tracker_itemView.tpl');

include('lib/inc.debug.php');
?>