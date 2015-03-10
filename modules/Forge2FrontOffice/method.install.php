<?php

if (!function_exists("cmsms")) exit;

//Create all the tables automatically 
/*$entities = MyAutoload::getAllInstances($this->GetName());
foreach($entities as $anEntity) {
	OrmCore::createTable($anEntity);
}*/

OrmCore::createTable(new License());
OrmCore::createTable(new Ssh_key());
OrmCore::createTable(new Project());

$this->SetPreference('user', '[TO DEFINED]');
$this->SetPreference('pass', '[TO DEFINED]');
$this->SetPreference('rest_url', '[TO DEFINED]');

// put mention into the admin log
$this->Audit( 0, 
	      $this->Lang('friendlyname'), 
	      $this->Lang('installed', $this->GetVersion()) );
?>
