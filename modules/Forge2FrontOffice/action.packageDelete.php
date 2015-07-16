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

if($package['project_id']['id'] != $projectId){
	$msg = "The project #%d %s doesn't have any package #%d %s";
	return errorGenerator::display404(sprintf($msg, $projectId, $projectName, $package['id'], $package['name']), 
		$root_url.'/project/'.$project['id'].'/'.$project['unix_name']);
}

//set cookie to avoid url-scam
$CSRF = forge_utils::generateRandomString();
forge_utils::putCookie('package_delete', $CSRF);

$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'packageDeleteSend', 'post','', true, '', 
				 array(
				 	'projectId' => $project['id'],
				 	'packageId' => $package['id'],
				 	'CSRF' => $CSRF
				 	)));

$smarty->assign('title', 'Delete package '.$package['name']);
$smarty->assign('link_back', $root_url.'/project/'.$project['id'].'/'.$project['unix_name']);

echo $smarty->display('packageDelete.tpl');

include('lib/inc.debug.php');