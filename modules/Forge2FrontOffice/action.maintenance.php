<?php

if (!function_exists("cmsms")) exit;

cms_route_manager::del_static('', 'Forge2FrontOffice');
$this->CreateStaticRoutes();
$this->InitializeFrontend();


/*$this->RemoveSmartyPlugin('fg_is_project_admin', 'function');
$this->RemoveSmartyPlugin('fg_is_project_member', 'function');
$this->RegisterSmartyPlugin('fg_is_project_admin','function', 'smarty_is_project_admin', false, 0);
$this->RegisterSmartyPlugin('fg_is_project_member','function', 'smarty_is_project_admin', false, 0);*/

echo "<p>PAGE Maintenance Forge2FrontOffice over</p>";