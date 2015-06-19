<?php

if (!function_exists("cmsms")) exit;

//$smarty->assign('response', $response);
//$smarty->assign('dump', RestAPI::getDump());



//echo $this->processTemplate('vardump.tpl');

$debug = Debug::getInstance();
$debug->saveDump(RestAPI::getDump());
$tag = $debug->getTag();
if($tag !== FALSE){
	$smarty->assign('debug_tag',$tag);
	echo $this->processTemplate('vardump_tag.tpl');
}