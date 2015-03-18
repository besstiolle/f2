<?php

if (!function_exists("cmsms")) exit;

$type = EnumProjectType::module;
if(isset($params['type']) && Enum::IsValidValue( 'EnumProjectType', $params['type']) ){
	$type = $params['type'];
} else if(isset($params['type']) && $params['type']='all'){
	$type = null;
}

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

//type of module
if(!empty($type)) {
	$restParameters['project_type'] = $type;
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
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	$smarty->assign('request', $request);
	$smarty->assign('dump', RestAPI::getDump());
	echo $this->processTemplate('rest_error.tpl');
	return;
} 

$response = json_decode($request->getResponse(), true);

//Get the projects in the response data
$projects = $response['data']['projects'];
$page_counter = $response['data']['count'];
$config = cmsms()->GetConfig();

$smarty->assign('root_url', $config['root_url']);
$smarty->assign('projects', $projects);


/**
	FILTER Part
**/

$filter_route = $config['root_url'].'/project/list';
$filters = array(
	array('css' => ($type === EnumProjectType::module)?'active':'',
			'text' => 'module', 
			'url' => $filter_route.'?'.$id.'type='.EnumProjectType::module),

	array('css' => ($type === EnumProjectType::plugin)?'active':'', 
			'text' => 'plugin', 
			'url' => $filter_route.'?'.$id.'type='.EnumProjectType::plugin),

	array('css' => ($type === EnumProjectType::translation)?'active':'', 
			'text' => 'translation', 
			'url' => $filter_route.'?'.$id.'type='.EnumProjectType::translation),

	array('css' => ($type === EnumProjectType::core)?'active':'', 
			'text' => 'core', 
			'url' => $filter_route.'?'.$id.'type='.EnumProjectType::core),

	array('css' => ($type === EnumProjectType::documentation)?'active':'', 
			'text' => 'documentation', 
			'url' => $filter_route.'?'.$id.'type='.EnumProjectType::documentation),

	array('css' => ($type === EnumProjectType::other)?'active':'', 
			'text' => 'other', 
			'url' => $filter_route.'?'.$id.'type='.EnumProjectType::other),

	array('css' => ($type === null)?'active':'', 
			'text' => 'all', 
			'url' => $filter_route.'?'.$id.'type=all'),
);

$smarty->assign('filters', $filters);


/**
	Paginator
**/

$currentQueryParameter = '';
if(!empty($type)){
	$currentQueryParameter = '&amp;'.$id.'type='.$type;
}
$page_url = $config['root_url'].'/project/list?'.$currentQueryParameter;

//Include paginator
include('lib/inc.paginator.php');

echo $this->processTemplate('projects.tpl');


//Debug part
$smarty->assign('response', $response);
$smarty->assign('dump', RestAPI::getDump());
echo $this->processTemplate('vardump.tpl');