<?php

if (!function_exists("cmsms")) exit;

$smarty->assign('title', 'Access Denied');

echo $this->processTemplate('access_denied.tpl');