<?php

if (!function_exists("cmsms")) exit;

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

$state = EnumTrackerItemState::Open;
if(isset($params['state'])){
	if($params['state'] == '1'){
		$state = EnumTrackerItemState::Closed;
	} else if($params['state'] == '0|1'){
		$state = NULL;
	}
}

/**
   GET THE ITEMS TRACKER
**/
$serviceTracker_item = new ServiceTracker_item();
if(!empty($params['pagin_page']) && !empty($params['pagin_num'])){
	$result = $serviceTracker_item->getByProjectIdAndTypeAndState($projectId, $params['type'], $state, $params['pagin_num'], $params['pagin_page']);
} else {
	$result = $serviceTracker_item->getByProjectIdAndTypeAndState($projectId, $params['type'], $state);
}
if($result === FALSE){ return; }

$tracker_items = $result[0];
$page_counter = $result[1]; //for paginator

$smarty->assign('project', $project);
$smarty->assign('title', $project['name']);
$smarty->assign('tracker_items', $tracker_items);
$smarty->assign('tracker_type', $params['type']);

$smarty->assign('enumTrackerItemResolution', array_flip(Enum::ConstToArray('EnumTrackerItemResolution')));
$smarty->assign('enumTrackerItemSeverity', array_flip(Enum::ConstToArray('EnumTrackerItemSeverity')));
$smarty->assign('enumTrackerItemState', array_flip(Enum::ConstToArray('EnumTrackerItemState')));

$avatar = $root_url.'/uploads/forge/design/user-64.png';

$smarty->assign('avatar', $avatar);


/**
	FILTER Part
**/

if($params['type'] == EnumTrackerItemType::Bug){
	$filter_route = $root_url.'/project/'.$project['id'].'/'.$project['unix_name'].'/bug/list';
} else if($params['type'] == EnumTrackerItemType::FeatureRequest) {
	$filter_route = $root_url.'/project/'.$project['id'].'/'.$project['unix_name'].'/request/list';
}


$filters = array(
	array('css' => ($state === EnumTrackerItemState::Open)?'active':'',
			'text' => 'open', 
			'url' => $filter_route),
	array('css' => ($state === EnumTrackerItemState::Closed)?'active':'', 
			'text' => 'closed', 
			'url' => $filter_route.'?'.$id.'state=1'),
	array('css' => ($state === null)?'active':'', 
			'text' => 'all', 
			'url' => $filter_route.'?'.$id.'state=0|1'),
);

$smarty->assign('filters', $filters);


/**
	Paginator
**/

$currentQueryParameter = '';
if(isset($params['state'])){
	$currentQueryParameter = '&amp;'.$id.'state='.$params['state'];
}
if($params['type'] == EnumTrackerItemType::Bug){
	$page_url = $root_url."/project/{$projectId}/{$project['unix_name']}/bug/list?{$currentQueryParameter}";
} else if($params['type'] == EnumTrackerItemType::FeatureRequest) {
	$page_url = $root_url."/project/{$projectId}/{$project['unix_name']}/request/list?{$currentQueryParameter}";
}
//Include paginator
include('lib/inc.paginator.php');

echo $smarty->display('tracker_items.tpl');

include('lib/inc.debug.php');