<?php

if (!function_exists("cmsms")) exit;

$smarty->assign('title', 'Access Denied');

echo $smarty->display('msg_access_denied.tpl');