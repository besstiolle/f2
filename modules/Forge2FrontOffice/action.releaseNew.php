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

//set cookie to avoid url-scam & double action
$CSRF = forge_utils::generateRandomString();
forge_utils::putCookie('release_new', $CSRF);


$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'packageNewSend', 'post','', true, '',  array(
				 	'projectId' => $projectId,
				 	'packageId' => $package['id'],
				 	'CSRF' => $CSRF
				 	)));

$smarty->assign('link_back', $root_url.'/project/'.$projectId.'/'.$project['unix_name']);

$smarty->assign('title', $projectName.' : Add new Release');

die('end releaseNew');
echo $smarty->display('releaseNew.tpl');

include('lib/inc.debug.php');