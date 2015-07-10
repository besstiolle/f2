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

//set cookie to avoid url-scam
$CSRF = forge_utils::generateRandomString();
forge_utils::putCookie('delete', $CSRF);

$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'projectDeleteSend', 'post','', true, '', 
				 array(
				 	'projectId' => $project['id'],
				 	'CSRF' => $CSRF
				 	)));

$smarty->assign('title', 'Delete project '.$project['name']);
$smarty->assign('project', $project);
$smarty->assign('link_back', $root_url.'/project/'.$project['id'].'/'.$project['unix_name']);

echo $smarty->display('projectDelete.tpl');

include('lib/inc.debug.php');