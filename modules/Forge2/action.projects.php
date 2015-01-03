<?php

if (!function_exists("cmsms")) exit;

$response = new ApiResponse($_GET);

//Check the token
$response = OAuth::validToken($response);
$code = $response->getCode();
if($code != 200){
	//Display result
	echo $response;
	exit;
}

//Select last 10 module modules updated
$example = new OrmExample();
$example->addCriteria('state', OrmTypeCriteria::$EQ, array(EnumProjectState::accepted));
$example->addCriteria('project_type', OrmTypeCriteria::$EQ, array(EnumProjectType::module));
$projects = OrmCore::findByExample(new Project, $example, new OrmOrderBy(array('last_file_date' => OrmOrderBy::$DESC)), new OrmLimit(0, 10));

$projectsList = array();
foreach ($projects as $project) {
	$projectsList[] = $project->getValues();
}

$response->setContent(array('projects' => $projectsList));

//Display result
echo $response;
exit;