<?php

if (!function_exists("cmsms")) exit;

//Paranoïd mode : ALL methods : GET PUT POST DELETE
ApiRequest::allowMethods(ApiRequest::$ALL);

$response = new ApiResponse($params);

//Check the token
$response = OAuth::validToken($response);

$params = $response->getParams();

$config = cmsms()->GetConfig();

//Include fieldController
$fc = new FieldController($this->getPath(), 'project', 'admin', $_SERVER['REQUEST_METHOD'], $params);
$fc->validate($response);
$params = $fc->getParams();
$warn = $fc->getWarn();

include_once($this->getPath().'lib/actions/action.project_'.$_SERVER['REQUEST_METHOD'].'.php');