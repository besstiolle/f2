<?php

if (!function_exists("cmsms")) exit;

$projectId = $params['projectId'];

//Ask the module/tag/...
$json = RestAPI::GET('rest/v1/projects/'.$projectId.'/a');
$response = json_decode($json, true);

//Get the projects in the response data
$projects = $response['data']['projects'];

$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'send', 'post','', true, '',  array()));
$smarty->assign('project', $projects[0]);
$smarty->assign('link_back', $config['root_url'].'/project/list');

//TODO let the choice between create / delete / update
$smarty->assign('routing', '/rest/v1/projects/'.$projects[0]['id'].'/a');
$smarty->assign('method', 'POST'); // = update

echo $this->processTemplate('projectById.tpl');

//Debug part
var_dump($response['request']);
var_dump($response['server']);
var_dump(RestAPI::getDump());