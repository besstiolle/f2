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

$serviceRelease = new ServiceRelease();
$release = $serviceRelease->getOne($params['releaseId']);
if(!$release) { return; }

if($release['package_id']['id'] != $package['id']){
	$msg = "The package #%d %s doesn't have any release #%d %s";
	return errorGenerator::display404(sprintf($msg, $package['id'], $package['name'], $release['id'], $release['name']), 
		$root_url.'/project/'.$project['id'].'/'.$project['unix_name']);
}

//set cookie to avoid url-scam & double action
$CSRF = forge_utils::generateRandomString();
forge_utils::putCookie('release_edit', $CSRF);


$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'releaseEditSend', 'post','', true, '',  array(
				 	'projectId' => $projectId,
				 	'packageId' => $package['id'],
				 	'releaseId' => $release['id'],
				 	'CSRF' => $CSRF
				 	)));


$smarty->assign('title', $projectName.' : Edit Release '.$release['name']);
$smarty->assign('link_back', $root_url.'/project/'.$projectId.'/'.$project['unix_name'].'/package/'.$package['id'].'/release/'.$release['id']);
$smarty->assign('release', $release);
$smarty->assign('packageName', $package['name']);

/**
 Get files
 */

$baseurl_file = '/uploads/projects/'.$projectId.'/release/'.$release['id'].'/file';
$baseurl_file_tmp = '/uploads/projects_cache/'.$projectId.'/release/'.$release['id'].'/file';

$smarty->assign('baseurl_file', $baseurl_file);
$smarty->assign('baseurl_file_tmp', $baseurl_file_tmp);

//Remove file on our side, we only propose visualization from the back server 
if(is_dir($root_path.$baseurl_file)){
	forge_utils::emptyDir($root_path.$baseurl_file, '#(.)*#', false); // should be already empty
}

$serviceFile = new ServiceFile();
$filesWaiting = $serviceFile->getFilesWaitingForReleaseId($release['id']);
if($filesWaiting === FALSE) { return; }

$files = $serviceFile->getFilesForReleaseId($release['id']);
if($files === FALSE) { return; }


//$deleteFileUrl = $root_url.'/project/'.$projectId.'/'.$project['unix_name'].'/file/delete/3';

//$smarty->assign('deleteFileUrl', $deleteFileUrl);

$smarty->assign('filesWaiting', $filesWaiting);
$smarty->assign('files', $files);
$smarty->assign('max_files', max(0, 10 - count($filesWaiting) - count($files)));

echo $smarty->display('releaseEdit.tpl');

include('lib/inc.debug.php');