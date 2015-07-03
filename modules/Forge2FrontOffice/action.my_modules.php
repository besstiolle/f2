<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

$restParameters = array(
			'user_id' => $params['user_id'],
			'n' => 100);

//Ask the 100 modules
$request = RestAPI::GET('rest/v1/assignment', $restParameters);

if($request->getStatus() === 404){
	/*$smarty->assign('error', 'you don\'t have any project');
	echo $this->processTemplate('notFound.tpl');
	return;*/
} else if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	$smarty->assign('request', $request);
	$smarty->assign('dump', RestAPI::getDump());
	echo $this->processTemplate('rest_error.tpl');
	return;
}

$response = json_decode($request->getResponse(), true);

//Get the assignments in the response data
$assignments = $response['data']['assignments'];

$config = cmsms()->GetConfig();

$smarty->assign('root_url', $config['root_url']);
$smarty->assign('assignments', $assignments);
$smarty->assign('link_create', $config['root_url'].'/project/new');
$smarty->assign('enumProjectState', Enum::ConstToArray('EnumProjectState'));
$smarty->assign('enumAssignmentRole', Enum::ConstToArray('EnumAssignmentRole'));

echo $this->processTemplate('my_projects.tpl');

include('lib/inc.debug.php');
?>