<?php

if (!function_exists('cmsms')) exit;


$current_version = $oldversion;
switch($current_version)
{
 case "1.3":
}

// put mention into the admin log
$this->Audit( 0, 
	      $this->Lang('friendlyname'), 
	      $this->Lang('upgraded', $this->GetVersion()));

?>