<?php

if (!function_exists("cmsms")) exit;

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

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
$ServiceProject = new ServiceProject();
$result = $ServiceProject->getAll($restParameters);
$projects = $result[0];
$page_counter = $result[1];

$smarty->assign('projects', $projects);


/**
	FILTER Part
**/

$filter_route = $root_url.'/project/list';
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
$page_url = $root_url.'/project/list?'.$currentQueryParameter;

//Include paginator
include('lib/inc.paginator.php');

echo  $smarty->display('projects.tpl');

include('lib/inc.debug.php');