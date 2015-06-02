<?php

if (!function_exists("cmsms")) exit;

$projectId = $params['projectId'];
$projectName = $params['projectName'];
$state = EnumTrackerItemState::Open;
if(isset($params['state'])){
	if($params['state'] == '1'){
		$state = EnumTrackerItemState::Closed;
	} else if($params['state'] == '0|1'){
		$state = NULL;
	}
}


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

/**
   GET THE ITEMS TRACKER
**/
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

$restParameters['project_id'] = $projectId;
$restParameters['type'] = $params['type'];

if($state !== NULL){
	$restParameters['state'] = $state;
}
					
$request = RestAPI::GET('rest/v1/tracker_item/', $restParameters);
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
$page_counter = $response['data']['count'];

$smarty->assign('enumTrackerItemResolution', array_flip(Enum::ConstToArray('EnumTrackerItemResolution')));
$smarty->assign('enumTrackerItemSeverity', array_flip(Enum::ConstToArray('EnumTrackerItemSeverity')));
$smarty->assign('enumTrackerItemState', array_flip(Enum::ConstToArray('EnumTrackerItemState')));

$avatar = $config['root_url'].'/uploads/forge/design/user-64.png';

$smarty->assign('avatar', $avatar);


/**
	FILTER Part
**/

if($params['type'] == EnumTrackerItemType::Bug){
	$filter_route = $config['root_url'].'/project/'.$project['id'].'/'.$project['unix_name'].'/bug/list';
} else if($params['type'] == EnumTrackerItemType::FeatureRequest) {
	$filter_route = $config['root_url'].'/project/'.$project['id'].'/'.$project['unix_name'].'/request/list';
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
	$page_url = $config['root_url']."/project/{$projectId}/{$project['unix_name']}/bug/list?{$currentQueryParameter}";
} else if($params['type'] == EnumTrackerItemType::FeatureRequest) {
	$page_url = $config['root_url']."/project/{$projectId}/{$project['unix_name']}/request/list?{$currentQueryParameter}";
}
//Include paginator
include('lib/inc.paginator.php');

$smarty->assign('is_admin', forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()));
$smarty->assign('is_member', forge_utils::is_project_member($project, forge_utils::getConnectedUserId()));

echo $this->processTemplate('tracker_items.tpl');


//Debug part
$smarty->assign('response', $response);
$smarty->assign('dump', RestAPI::getDump());
echo $this->processTemplate('vardump.tpl');

?>