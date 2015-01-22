<?php

if (!function_exists("cmsms")) exit;

$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'send', 'post','', true, '',  array()));
$smarty->assign('link_back', $config['root_url'].'/project/list');

$smarty->assign('link_next_success', $config['root_url'].'/project/new');
$smarty->assign('link_next_failed', $config['root_url'].'/project/new');
$smarty->assign('method', 'PUT'); // = create
$smarty->assign('routing', '/rest/v1/projects/');

echo $this->processTemplate('projectNew.tpl');
