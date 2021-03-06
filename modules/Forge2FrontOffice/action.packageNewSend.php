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

//get cookie to avoid url-scam
if(!forge_utils::hasCookie('packagenew', $params['CSRF'])){
	$next = $root_url.'/project/'.$projectId.'/'.$projectUnixName.'/package/new';
	return errorGenerator::display500("Your token has been already used. You should go back and try again", $next);
}

$params['project_id'] = $params['projectId'];

$servicePackage = new ServicePackage();
$package = $servicePackage->create($params, $root_url.'/project/'.$projectId.'/'.$projectUnixName.'/package/new');
if(!$package){
	return;
}

$next = $root_url.'/project/'.$project['id'].'/'.$project['unix_name'];
errorGenerator::display200('the package '.$package['name'].' for the project '.$project['name'].' is created with success.', $next);

include('lib/inc.debug.php');