<?php

if (!function_exists("cmsms")) exit;

$restParameters = array(
			'n' => 10000000);

//Ask the 100 modules
$request = RestAPI::GET('rest/v1/assignment', $restParameters);

if($request->getStatus() === 404){
	$this->redirect($id, 'defaultadmin', $returnid, array('error'=>'admin_param_saved'));
	return;
} else if($request->getStatus() !== 200){
	$this->redirect($id, 'defaultadmin', $returnid, array('error'=>'admin_param_saved'));
	return;
}

$response = json_decode($request->getResponse(), true);

//Get the assignments in the response data
$assignments = $response['data']['assignments'];

OrmCore::deleteByExample(new WikiAccess(), new OrmExample());

$list = array();

foreach ($assignments as $assignment) {

	$is_member_or_admin = Enum::FromString('EnumAssignmentRole::Administrator') == $assignment['role'] ||
							Enum::FromString('EnumAssignmentRole::Member') == $assignment['role'];


	$prefix = "project/".$assignment['project_id']['id']."/".$assignment['project_id']['unix_name']."/wiki";

	$obj = new WikiAccess();
	$obj->set('prefix', $prefix);
	$obj->set('user',$assignment['user_id']);
	$obj->set('r', true);
	$obj->set('w', $is_member_or_admin);
	$obj->set('d',$is_member_or_admin);
	$obj->save();
}

$this->redirect($id, 'defaultadmin', $returnid, array('message'=>'admin_wiki_initiated'));

?>