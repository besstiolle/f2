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
//TODO : ask to the back office the files
$baseurl_avatar = '/uploads/projects/'.$projectId.'/avatar/';
$baseurl_show = '/uploads/projects/'.$projectId.'/show/';

$avatars = forge_utils::getFilesInDir($root_path.$baseurl_avatar, '/\.(gif|jpe?g|png)$/i');
$shows = forge_utils::getFilesInDir($root_path.$baseurl_show, '/\.(gif|jpe?g|png)$/i');


$smarty->assign('title', $project['name']);
$smarty->assign('project', $project);
$smarty->assign('packages', $packages);
$smarty->assign('avatar', (!empty($avatars)?$avatars[0]:null));
$smarty->assign('show', $shows);
$smarty->assign('baseurl_avatar', $baseurl_avatar);
$smarty->assign('baseurl_show', $baseurl_show);


echo $smarty->display('projectView.tpl');

include('lib/inc.debug.php');