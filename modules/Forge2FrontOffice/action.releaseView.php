<?php

if (!function_exists("cmsms")) exit;

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

$restParameters = array();
$restParameters['n'] = 1;

$all = true;
if(empty($params['all'])){
	$all = false;
} 

$serviceRelease = new ServiceRelease();
$release = $serviceRelease->getOne($params['releaseId'], $restParameters);
if(!$release){ return; }
$release['current'] = true;
$releases = array($release);

/**
 Check the project
**/
$projectId = $release['package_id']['project_id'];
if($project['id'] !== $projectId){
	return errorGenerator::display404('The project '.$project['name'].' (#'.$project['id'].') doesn\' have any release #'.$params['releaseId']);
}

/**
 Get previous releases
 **/
if($all){

	$serviceRelease = new ServiceRelease();
	$oldReleases = $serviceRelease->getOlderReleasesByPackageId($release['id'], $release['package_id']['id']);
	if(!$oldReleases){ return; }

	//merge both
	$releases = array_merge($releases, $oldReleases);
}

$smarty->assign('title', $project['name']);
$smarty->assign('project', $project);
$smarty->assign('releases', $releases);
$smarty->assign('all', $all);

echo $smarty->display('releaseView.tpl');

include('lib/inc.debug.php');