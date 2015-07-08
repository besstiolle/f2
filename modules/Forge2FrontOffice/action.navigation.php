<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 
$smarty->assign('root_url', $config['root_url']);

include('action.wikigateway.php');

if(isset($project)){
	$smarty->assign('is_admin', forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()));
	$smarty->assign('is_member', forge_utils::is_project_member($project, forge_utils::getConnectedUserId()));	
} else {
	$smarty->assign('is_admin', false);
	$smarty->assign('is_member', false);
}


echo $smarty->display('inc_navigation.tpl');