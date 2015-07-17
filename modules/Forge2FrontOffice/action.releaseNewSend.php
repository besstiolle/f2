<?php

if (!function_exists("cmsms")) exit;

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

//Access denied for any no-admin / no-member
if( ! forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()) 
	&& ! forge_utils::is_project_member($project, forge_utils::getConnectedUserId())){
	return errorGenerator::display403();
}

$servicePackage= new ServicePackage();
$package = $servicePackage->getOne($params['packageId']);
if(!$package) { return; }

if($package['project_id']['id'] != $projectId){
	$msg = "The project #%d %s doesn't have any package #%d %s";
	return errorGenerator::display404(sprintf($msg, $projectId, $projectName, $package['id'], $package['name']), 
		$root_url.'/project/'.$project['id'].'/'.$project['unix_name']);
}

//get cookie to avoid url-scam
if(!forge_utils::hasCookie('release_new', $params['CSRF'])){
	$next = $root_url.'/project/'.$projectId.'/'.$projectName.'/package/'.$params['packageId'].'/release/new';
	return errorGenerator::display500("Your token has been already used. You should go back and try again", $next);
}

$params['package_id'] = $params['packageId'];
$params['released_by'] = forge_utils::getConnectedUserId();

$serviceRelease = new ServiceRelease();
$release = $serviceRelease->create($params, $root_url.'/project/'.$projectId.'/'.$projectName.'/package/'.$params['packageId'].'/release/new');
if(!$release){
	return;
}

$next = $root_url.'/project/'.$project['id'].'/'.$project['unix_name'];
errorGenerator::display200('the release '.$release['name'].' for the package '.$package['name'].' for the project '.$project['name'].' is created with success.', $next);

include('lib/inc.debug.php');