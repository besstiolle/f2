<?php

if (!function_exists('cmsms')) exit;

// remove the permissions
$this->RemovePermission('Use Disqus');

// remove the preference
$this->RemovePreference("d_shortname");

// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));

?>