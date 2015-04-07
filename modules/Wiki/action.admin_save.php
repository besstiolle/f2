<?php

if (!function_exists("cmsms")) exit;


if(isset($params['show_code_iso'])){
	$this->SetPreference('show_code_iso',$params['show_code_iso']);
}
if(isset($params['multiInstances'])){
	$this->SetPreference('multiInstances',$params['multiInstances']);
}
if(isset($params['default_alias'])){
	$this->SetPreference('default_alias',$params['default_alias']);
}
if(isset($params['prefix'])){
	$this->SetPreference('prefix',$params['prefix']);
}

//Refresh Routes
$this->CreateStaticRoutes();

$this->redirect($id,'defaultadmin');


?>