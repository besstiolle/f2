<?php

if (!function_exists("cmsms")) exit;

if(isset($params['template_access'])){
	$this->SetTemplate('template_access',$params['template_access']);
}

$this->RedirectToAdminTab('tab3');


?>