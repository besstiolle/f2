<?php

if (!function_exists("cmsms")) exit;

//Create all the tables automatically 
/*$entities = MyAutoload::getAllInstances($this->GetName());
foreach($entities as $anEntity) {
	OrmCore::createTable($anEntity);
}*/

$this->SetPreference('user', '[TO DEFINED]');
$this->SetPreference('pass', '[TO DEFINED]');
$this->SetPreference('rest_url', '[TO DEFINED]');

//Register Smarty Plugin
//$this->RegisterSmartyPlugin('fg_is_project_admin','function', 'smarty_is_project_admin', false, 0);
//$this->RegisterSmartyPlugin('fg_is_project_member','function', 'smarty_is_project_admin', false, 0);

 // and routes...
 $this->CreateStaticRoutes();

// put mention into the admin log
$this->Audit( 0, 
	      $this->Lang('friendlyname'), 
	      $this->Lang('installed', $this->GetVersion()) );
?>
