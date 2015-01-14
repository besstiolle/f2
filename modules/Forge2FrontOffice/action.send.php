<?php

if (!function_exists("cmsms")) exit;

$route = $params['routing'];

//TODO make some test about "do he have the right to use this route"

//TODO make some test about "does this method (POST/GET/PUSH/DELETE) is allowed to this route"

//Unset unused parameters
unset($params['action']);
unset($params['returnid']);
unset($params['method']);
unset($params['routing']);

$json = RestAPI::$_SERVER['REQUEST_METHOD']($route, $params);
$response = json_decode($json, true);

var_dump($json);
var_dump($response);