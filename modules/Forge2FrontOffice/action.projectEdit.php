<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

$projectId = $params['projectId'];
$projectName = $params['projectName'];

//Ask the module/tag/...
$request = RestAPI::GET('rest/v1/project/'.$projectId);
if($request->getStatus() === 404){
	$smarty->assign('error', 'The Project '.$projectName.' (#'.$projectId.') does not exist');
	echo $smarty->display('msg_notFound.tpl');
	return;
} else if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	echo $smarty->display('msg_rest_error.tpl');
	include('lib/inc.debug.php');
	return;
} 

$response = json_decode($request->getResponse(), true);

//Get the projects in the response data
$project = $response['data']['projects'][0];

//Access denied for any no-admin / no-member
if( ! forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()) 
	&& ! forge_utils::is_project_member($project, forge_utils::getConnectedUserId())){
	$this->RedirectForFrontEnd($id, $returnid, 'access_denied');
}

//set cookie to avoid url-scam
forge_utils::putCookie('edit', $projectId);


$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'projectEditSend', 'post','', false, '',  array(
				 	'sid' => $project['id'],
					'_link_next_failed'=> $config['root_url'].'/project/'.$project['id'].'/'.$project['unix_name'].'/edit',
								)));

$smarty->assign('title', 'Edit project '.$project['name']);
$smarty->assign('project', $project);
$smarty->assign('link_back', $config['root_url'].'/project/'.$project['id'].'/'.$project['unix_name']);

$smarty->assign('is_admin', forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()));
$smarty->assign('is_member', forge_utils::is_project_member($project, forge_utils::getConnectedUserId()));
$smarty->assign('root_url', $config['root_url']);

$baseurl_avatar = '/uploads/projects/'.$project['id'].'/avatar';
$baseurl_avatar_tmp = '/uploads/projects_cache/'.$project['id'].'/avatar';
$baseurl_show = '/uploads/projects/'.$project['id'].'/show';
$baseurl_show_tmp = '/uploads/projects_cache/'.$project['id'].'/show';

$smarty->assign('baseurl_avatar', $baseurl_avatar);
$smarty->assign('baseurl_show', $baseurl_show);

$root_path = $config['root_path'];

//Remove file on our side, we only propose visualization from the back server 
if(is_dir($root_path.$baseurl_avatar)){
	forge_utils::emptyDir($root_path.$baseurl_avatar, '#(.)*#', false); // should be already empty
	forge_utils::emptyDir($root_path.$baseurl_avatar.'/thumbnails', '#(.)*#', false);
}
if(is_dir($root_path.$baseurl_show)){
	forge_utils::emptyDir($root_path.$baseurl_show, '#(.)*#', false); // should be already empty
	forge_utils::emptyDir($root_path.$baseurl_show.'/thumbnails', '#(.)*#', false);
}

echo $smarty->display('projectEdit.tpl');

include('lib/inc.debug.php');