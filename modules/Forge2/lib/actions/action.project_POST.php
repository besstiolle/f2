<?php

if (!function_exists("cmsms")) exit;

//Select by example
$example = new OrmExample();
$example->addCriteria('id', OrmTypeCriteria::$EQ, array($params['sid']));

//We don't need the sid anymore
unset($params['sid']);

$entities = OrmCore::findByExample(new Project, $example);

if(empty($entities)){
	$response->addContent('warn', 'entity not found');
	return;
}

$entity = $entities[0];
foreach ($params as $key => $value) {
	$entity->set($key, $value);
}

//Save the entity
$entity->save();

$response->addContent('info', 'entity saved with success');