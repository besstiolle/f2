<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'projectNewSend', 'post','', true, '',  array(
				 	'_link_next_failed' => $config['root_url'].'/project/new'
				 	)));
$smarty->assign('link_back', $config['root_url'].'/project/list');
$smarty->assign('enumProjectType', Enum::ConstToArray('EnumProjectType'));


$smarty->assign('title', 'Create a new Project');

echo $smarty->display('projectNew.tpl');

include('lib/inc.debug.php');