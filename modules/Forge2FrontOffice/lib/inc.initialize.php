<?php

if (!function_exists("cmsms")) exit;

$mustStop = false;
$config = cmsms()->GetConfig();

$root_url = $config['root_url'];
$root_path = $config['root_path'];

$smarty->assign('root_url',$root_url);
$smarty->assign('root_path',$root_path);
$smarty->assign('forge_id',$id);

$smarty->addTemplateDir($root_path.'/modules/Forge2FrontOffice/templates'); 


require_once(dirname(__FILE__).'/../../CustomContent/lib/class.ccUser.php');
$smarty = cmsms()->GetSmarty();
if( !$smarty ) return;
$smarty->assign('ccUser',ccUser::get_instance());

//Initiate the errorGenerator just-in-case
errorGenerator::init($this, $id, $returnid, $root_url);

//Initiate the project if we are able to do it.
$project = null;
if(isset($params['projectId'])){

	$projectId = $params['projectId'];
	$projectName = '';
	if(isset($params['projectName'])){
		$projectName = $params['projectName'];	
	}
	$serviceProject = new ServiceProject();
	$project = $serviceProject->getOne($projectId, $projectName);
	$projectName = $project['name'];
	$projectUnixName = $project['unix_name'];
	$mustStop = ($project === false);

	if($mustStop) {
		return;
	}

	$is_admin = forge_utils::is_project_admin($project, forge_utils::getConnectedUserId());
	$is_member = forge_utils::is_project_member($project, forge_utils::getConnectedUserId());

	$smarty->assign('is_admin', $is_admin);
	$smarty->assign('is_member', $is_member);
	$smarty->assign('project', $project);
	
	return;
}

?>