<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 

include('action.wikigateway.php');


$smarty->assign('is_admin', forge_utils::is_project_admin($project, forge_utils::getConnectedUserId()));
$smarty->assign('is_member', forge_utils::is_project_member($project, forge_utils::getConnectedUserId()));

echo $smarty->display('inc_navigation.tpl');