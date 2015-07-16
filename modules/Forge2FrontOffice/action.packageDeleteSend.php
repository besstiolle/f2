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
if(!forge_utils::hasCookie('package_delete', $params['CSRF'])){
	$next = $root_url.'/project/'.$project['id'].'/'.$project['unix_name'];
	return errorGenerator::display500("Your token has been already used. You should go back and try again", $next);
}


/**
 Check emptyness of the Package
 */
$servicePackage= new ServicePackage();
$package = $servicePackage->getOne($params['packageId']);

$serviceRelease = new ServiceRelease();
$releases = $serviceRelease->getByPackageId($package['id'], $projectId, $projectName);
if($releases === FALSE){ return; }

if(count($releases) > 0){
	foreach ($releases as $release) {
		if($release['is_active']){
			$next = $root_url.'/project/'.$project['id'].'/'.$project['unix_name'];
			return errorGenerator::display500('You can\'t delete a package if there is still at least one Release', $next);
		} 
	}
}

$servicePackage->delete($package['id']);


$next = $root_url.'/project/'.$project['id'].'/'.$project['unix_name'];
errorGenerator::display200('the package is deleted with success', $next);


include('lib/inc.debug.php');