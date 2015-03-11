<?php

if (!function_exists("cmsms")) exit;

$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'projectNewSend', 'post','', true, '',  array(
				 	'_link_next_failed' => $config['root_url'].'/project/new'
				 	)));
$smarty->assign('link_back', $config['root_url'].'/project/list');
$smarty->assign('enumProjectType', Enum::ConstToArray('EnumProjectType'));


$smarty->assign('title', 'Create a new Project');

echo $this->processTemplate('projectNew.tpl');
