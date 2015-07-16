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
	$next = $root_url."/project/new";
	return errorGenerator::display500("Your token has been already used. You should go back and try again", $next);
}

/**
 Check emptyness of the Package
 */
$releases = $serviceRelease->getByPackageId($packages[$i]['id'], $projectId, $projectName);
if($releases === FALSE){ return; }

if($releases !== null){
	return errorGenerator::display500('You can\'t delete a package if there is still at least one Release');
}

die('end');


include('lib/inc.debug.php');