<?php

if (!function_exists("cmsms")) exit;

if(array_key_exists('projectId', $params)) {
	$_GET['projectId'] = $params['projectId'];
}


$response = new ApiResponse($_GET);

//Check the token
$response = OAuth::validToken($response);
$code = $response->getCode();
if($code != 200){
	//Display result
	echo $response;
	exit;
}

$params = $response->getParams();

//Select by example
$example = new OrmExample();
$example->addCriteria('state', OrmTypeCriteria::$EQ, array(EnumProjectState::accepted));
$example->addCriteria('project_type', OrmTypeCriteria::$EQ, array(EnumProjectType::module));

if(array_key_exists('projectId', $params)){
	$example->addCriteria('id', OrmTypeCriteria::$EQ, array($params['projectId']));
} else {

}

$projects = OrmCore::findByExample(new Project, 
									$example, 
									new OrmOrderBy(array('last_file_date' => OrmOrderBy::$DESC)), 
									new OrmLimit(0, 10));

$projectsList = array();
foreach ($projects as $project) {
	$projectsList[] = $project->getValues();
}


$response->setContent(array('projects' => $projectsList));

//Display result
echo $response;
exit;