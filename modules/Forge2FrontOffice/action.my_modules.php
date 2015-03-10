<?php

if (!function_exists("cmsms")) exit;

$restParameters = array(
			'user_id' => $params['user_id'],
			'n' => 100);

//Ask the last 10 modules
$request = RestAPI::GET('rest/v1/project', $restParameters);

if($request->getStatus() === 404){
	/*$smarty->assign('error', 'you don\'t have any project');
	echo $this->processTemplate('notFound.tpl');
	return;*/
} else if($request->getStatus() === 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	$smarty->assign('request', $request);
	$smarty->assign('dump', RestAPI::getDump());
	echo $this->processTemplate('rest_error.tpl');
	return;
}

$response = json_decode($request->getResponse(), true);

//Get the projects in the response data
$projects = $response['data']['projects'];
$config = cmsms()->GetConfig();

$smarty->assign('root_url', $config['root_url']);
$smarty->assign('projects', $projects);
$smarty->assign('link_create', $config['root_url'].'/project/new');

echo $this->processTemplate('my_projects.tpl');

//Debug part
$smarty->assign('response', $response);
$smarty->assign('dump', RestAPI::getDump());
echo $this->processTemplate('vardump.tpl');
?>