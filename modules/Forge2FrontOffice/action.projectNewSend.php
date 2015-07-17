<?php

if (!function_exists("cmsms")) exit;

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

//get cookie to avoid url-scam
if(!forge_utils::hasCookie('new', $params['CSRF'])){
	$next = $root_url."/project/new";
	return errorGenerator::display500("Your token has been already used. You should go back and try again", $next);
}

$serviceProject = new ServiceProject();
$project = $serviceProject->create($params, $root_url.'/project/new');
if(!$project){
	return;
}

//Set myself to administrator
$assignment = array(
	'project_id' => $project['id'],
	'user_id' => forge_utils::getConnectedUserId(),
	'role' => EnumAssignmentRole::Administrator,
	);
$serviceAssignment = new ServiceAssignment();
$serviceAssignment->create($assignment, $root_url.'/project/new');
if(!$serviceAssignment){
	return;
}


$next = $root_url.'/project/'.$project['id'].'/'.$project['unix_name'];
errorGenerator::display200('the project '.$project['name'].' is created with success.', $next);

include('lib/inc.debug.php');