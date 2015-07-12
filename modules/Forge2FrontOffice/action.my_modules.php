<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

$serviceAssignment = new ServiceAssignment();
$assignments = $serviceAssignment->getByUserId($params['user_id']);
if($assignments === FALSE) { return; }

$smarty->assign('assignments', $assignments);
$smarty->assign('link_create', $config['root_url'].'/project/new');
$smarty->assign('enumProjectState', Enum::ConstToArray('EnumProjectState'));
$smarty->assign('enumAssignmentRole', Enum::ConstToArray('EnumAssignmentRole'));

echo $smarty->display('inc_myProjects.tpl');

include('lib/inc.debug.php');
?>