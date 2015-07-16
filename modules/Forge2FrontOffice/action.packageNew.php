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

//set cookie to avoid url-scam & double action
$CSRF = forge_utils::generateRandomString();
forge_utils::putCookie('packagenew', $CSRF);


$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'packageNewSend', 'post','', true, '',  array(
				 	'CSRF' => $CSRF
				 	)));
$smarty->assign('link_back', $root_url.'/project/'.$projectId.'/'.$projectName);

$smarty->assign('title', $projectName.' : Add new Package');

echo $smarty->display('packageNew.tpl');

include('lib/inc.debug.php');