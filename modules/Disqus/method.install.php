<?php

if (!function_exists('cmsms')) exit;

// create a permission
$this->CreatePermission('Use Disqus', 'Use Disqus');

// create a preference
$this->SetPreference("d_shortname", '');

// put mention into the admin log
$this->Audit( 0, 
	      $this->Lang('friendlyname'), 
	      $this->Lang('installed', $this->GetVersion()) );

	      
?>