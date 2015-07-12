<?php

if (!function_exists("cmsms")) exit;

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

/**
 Ask the tracker_item
**/
$serviceTracker_item = new ServiceTracker_item();
$tracker_item = $serviceTracker_item->getOne($params['tracker_itemId']);
if($tracker_item === FALSE) { return; }

$smarty->assign('project', $project);
$smarty->assign('title', $project['name']);
$smarty->assign('tracker_item', $tracker_item);
$smarty->assign('tracker_type', $params['type']);


/**
 Ask the comments & the history of the tracker_item
**/
$serviceComment = new ServiceComment();
$comments = $serviceComment->getByTrackerId($params['tracker_itemId']);
if($comments === FALSE) { return; }

$serviceHistory = new ServiceHistory();
$histories = $serviceHistory->getByTrackerId($params['tracker_itemId']);
if($histories === FALSE) { return; }

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

$avatar = $root_url.'/uploads/forge/design/user-64.png';
$smarty->assign('avatar', $avatar);

echo $smarty->display('tracker_itemView.tpl');

include('lib/inc.debug.php');
?>