<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();

$root_url = $config['root_url'];
$root_path = $config['root_path'];

$smarty->assign('root_url',$root_url);
$smarty->assign('root_path',$root_path);

$smarty->addTemplateDir($root_path.'/modules/Forge2FrontOffice/templates'); 

//Initiate the errorGenerator just-in-case
errorGenerator::init($this, $id, $returnid, $root_url);


//Initiate the project if we are able to do it.
$project = null;
if(isset($params['projectId'])){

	$projectId = $params['projectId'];
	$projectName = '';
	if(isset($params['projectId'])){
		$projectName = $params['projectName'];	
	}
	
	$request = RestAPI::GET('rest/v1/project/'.$projectId);
	if($request->getStatus() === 404){
		errorGenerator::display404('The project '.$projectName.' (#'.$projectId.') does not exist');
		//return;
		throw new Exception('');
	} else if($request->getStatus() !== 200){
		errorGenerator::display400();
		throw new Exception('');
		//return;
	} 

	$response = json_decode($request->getResponse(), true);
	$project = $response['data']['projects'][0];
}

?>