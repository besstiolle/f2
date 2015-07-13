<?php

if (!function_exists("cmsms")) exit;

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

/**
 Get the active packages of the project
**/
$servicePackage = new ServicePackage();
$packages = $servicePackage->getActiveAndPublicByProjectId($projectId, $projectName);
if($packages === FALSE){ return; }

/**
  Get the last release for each package
 */
$serviceRelease = new ServiceRelease();
for($i=0; $i < count($packages); $i++) {
	
	$releases = $serviceRelease->getByPackageId($packages[$i]['id'], $projectId, $projectName);
	if($releases === FALSE){ return; }
	$packages[$i]['releases'] = $releases;
}

/**
 Find the pictures avatar&show
 */
$serviceFile = new ServiceFile();

$avatars = $serviceFile->getAvatarsForProjectId($projectId);
if($avatars === FALSE) { return; }

$shows = $serviceFile->getShowsForProjectId($projectId);
if($shows === FALSE) { return; }

$smarty->assign('title', $project['name']);
$smarty->assign('project', $project);
$smarty->assign('packages', $packages);
$smarty->assign('avatars', $avatars);
$smarty->assign('shows', $shows);


echo $smarty->display('projectView.tpl');

include('lib/inc.debug.php');