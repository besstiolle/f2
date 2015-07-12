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
forge_utils::putCookie('edit', $CSRF);


$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'projectEditSend', 'post','', false, '',  array(
				 	'projectId' => $projectId,
				 	'CSRF' => $CSRF
								)));

$smarty->assign('title', 'Edit project '.$project['name']);
$smarty->assign('project', $project);
$smarty->assign('link_back', $root_url.'/project/'.$projectId.'/'.$project['unix_name']);

/**
   Move the Pictures 
 */
$baseurl_avatar = '/uploads/projects/'.$projectId.'/avatar';
$baseurl_avatar_tmp = '/uploads/projects_cache/'.$projectId.'/avatar';
$baseurl_show = '/uploads/projects/'.$projectId.'/show';
$baseurl_show_tmp = '/uploads/projects_cache/'.$projectId.'/show';

$smarty->assign('baseurl_avatar', $baseurl_avatar);
$smarty->assign('baseurl_show', $baseurl_show);
$smarty->assign('baseurl_avatar_tmp', $baseurl_avatar_tmp);
$smarty->assign('baseurl_show_tmp', $baseurl_show_tmp);

//Remove file on our side, we only propose visualization from the back server 
if(is_dir($root_path.$baseurl_avatar)){
	forge_utils::emptyDir($root_path.$baseurl_avatar, '#(.)*#', false); // should be already empty
	forge_utils::emptyDir($root_path.$baseurl_avatar.'/thumbnails', '#(.)*#', false);
}
if(is_dir($root_path.$baseurl_show)){
	forge_utils::emptyDir($root_path.$baseurl_show, '#(.)*#', false); // should be already empty
	forge_utils::emptyDir($root_path.$baseurl_show.'/thumbnails', '#(.)*#', false);
}

$serviceFile = new ServiceFile();
$avatarsWaiting = $serviceFile->getAvatarsWaitingForProjectId($projectId);
if($avatarsWaiting === FALSE) { return; }

$avatars = $serviceFile->getAvatarsForProjectId($projectId);
if($avatars === FALSE) { return; }

$showsWaiting = $serviceFile->getShowsWaitingForProjectId($projectId);
if($showsWaiting === FALSE) { echo "arf";return; }

$shows = $serviceFile->getShowsForProjectId($projectId);
if($shows === FALSE) { return; }


print_r($avatarsWaiting);
print_r($avatars);
print_r($showsWaiting);
print_r($shows);

echo $smarty->display('projectEdit.tpl');

include('lib/inc.debug.php');