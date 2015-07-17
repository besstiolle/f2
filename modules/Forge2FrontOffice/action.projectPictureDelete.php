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

if(empty($params['typeFile']) && empty($params['filename'])){
	$next = $root_url."/project/".$projectId.'/'.$projectUnixName.'/edit';
	return errorGenerator::display500('Some parameters were missing', $next);
}

$serviceFile = new ServiceFile();
if($params['typeFile'] == 1) {
	if(!$serviceFile->deleteAvatarsForProjectId($projectId, $params['filename'])){
		return;
	}
} else if($params['typeFile'] == 2){
	if(!$serviceFile->deleteShowsForProjectId($projectId, $params['filename'])){
		return;
	}
}


$next = $root_url."/project/".$projectId.'/'.$project['unix_name'].'/edit';
errorGenerator::display200('the picture is deleted with success', $next);