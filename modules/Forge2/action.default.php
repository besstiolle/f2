<?php

if (!function_exists("cmsms")) exit;


//Select last 10 module modules updated
$example = new OrmExample();
$example->addCriteria('state', OrmTypeCriteria::$EQ, array(EnumProjectState::accepted));
$example->addCriteria('project_type', OrmTypeCriteria::$EQ, array(EnumProjectType::module));
$projects = OrmCore::findByExample(new Project, $example, new OrmOrderBy(array('last_file_date' => OrmOrderBy::$DESC)), new OrmLimit(0, 10));

foreach ($projects as $project) {
	$smarty->assign('project', $project->getValues());
	echo $this->ProcessTemplate('project_128.tpl'); 
}

//Select last 10 projects core updated
$example = new OrmExample();
$example->addCriteria('state', OrmTypeCriteria::$EQ, array(EnumProjectState::accepted));
$example->addCriteria('project_type', OrmTypeCriteria::$EQ, array(EnumProjectType::plugin));
$projects = OrmCore::findByExample(new Project, $example, new OrmOrderBy(array('last_file_date' => OrmOrderBy::$DESC)), new OrmLimit(0, 10));

foreach ($projects as $project) {
	$smarty->assign('project', $project->getValues());
	echo $this->ProcessTemplate('project_128.tpl'); 
}