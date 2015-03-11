<?php

if (!function_exists("cmsms")) exit;

//Drop all the tables automatically
/*$entities = MyAutoload::getAllInstances($this->GetName(), $this->getName());
foreach($entities as $anEntity) {
	OrmCore::dropTable($anEntity);
}*/


$this->RemovePreference('user');
$this->RemovePreference('pass');
$this->RemovePreference('rest_url');


//Remove all the Smarty Plugin
$this->RemoveSmartyPlugin();

// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));

?>