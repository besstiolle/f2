<?php

if (!function_exists("cmsms")) exit;

$debug = Debug::getInstance();
$debug->saveDump(RestAPI::getDump());
$tag = $debug->getTag();
if($tag !== FALSE){
	$config = cmsms()->GetConfig();
	$smarty->assign('root_url',$config['root_url']);
	$smarty->assign('debug_tag',$tag);
	echo $smarty->display('inc_vardump_tag.tpl');
}