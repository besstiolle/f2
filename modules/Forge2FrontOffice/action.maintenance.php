<?php

if (!function_exists("cmsms")) exit;

cms_route_manager::del_static('', 'Forge2FrontOffice');
$this->CreateStaticRoutes();
$this->InitializeFrontend();

echo "<p>PAGE Maintenance Forge2FrontOffice over</p>";