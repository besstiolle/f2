<?php

if (!function_exists("cmsms")) exit;

//$smarty->assign('response', $response);
//$smarty->assign('dump', RestAPI::getDump());



//echo $this->processTemplate('vardump.tpl');

$debug = Debug::getInstance();
$debug->saveDump(RestAPI::getDump());
$debug->publish();