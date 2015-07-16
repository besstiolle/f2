<?php

if (!function_exists("cmsms")) exit;

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

//Access denied for any no-admin
if( ! forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()) ){
	return errorGenerator::display403();
}

//get cookie to avoid url-scam
if(!forge_utils::hasCookie('delete', $params['CSRF'])){
	$next = $root_url."/project/".$projectId."/".$project['unix_name'];
	return errorGenerator::display500("Your token has been already used. You should go back and try again", $next);
	
}

echo "delete avoided in action.projectDelete.php";
$ServiceProject = new ServiceProject();
/*if(!$ServiceProject->delete($projectId)){
	return;
}*/

$next = $root_url."/project/list";
errorGenerator::display200('the project is deleted with success', $next);


include('lib/inc.debug.php');