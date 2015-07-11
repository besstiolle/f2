<?php

if (!function_exists("cmsms")) exit;

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

/**
 Get the release
**/
$serviceRelease = new ServiceRelease();
$release = $serviceRelease->getOne($params['releaseId']);
if(!$release){ return; }
$release['current'] = true;
$releases = array($release);

/**
 Check the project
**/
$projectId = $release['package_id']['project_id'];
if($project['id'] !== $projectId){
	$msg = 'The project #%d %s doesn\'t have any release #%d';
	return errorGenerator::display404(sprintf($msg, $projectId, $projectName, $release['id']));
}

/**
 Get previous releases
 **/
 $all = !(empty($params['all']));
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