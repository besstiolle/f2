<?php


$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 

$query = $_SERVER["QUERY_STRING"];

//$pattern = "#^(\w)*[=]?project\/(?P<projectId>[\d]*)\/([\w\d]+)\/wiki#";
$pattern = "#^[\w=]*project\/(?P<projectId>[\d]*)\/([\w\d]+)\/wiki#";
//$pattern = "#^(\w)*=project\/(?P<projectId>[\d]*)\/([\w\d]+)\/wiki(.)*$#";
$matches = array();
if(!preg_match($pattern, $query, $matches)){
	if(isset($params['wiki_prefix'])){
		$query = $params['wiki_prefix'];
		if(!preg_match($pattern, $query, $matches)){
			/*print_r($_SERVER);
			die("second try");*/
			return;
		}
	} else {

		/*print_r($_SERVER);
		die("first try");*/
		return;
	} 

}
/*
print_r($matches);
die();*/

$projectId =  $matches['projectId'];

//Ask the module/tag/...
$request = RestAPI::GET('rest/v1/project/'.$projectId);
if($request->getStatus() === 404){
	$smarty->assign('error', 'The project '.$projectName.' (#'.$projectId.') does not exist');
	echo $smarty->display('msg_notFound.tpl');
	return;
} else if($request->getStatus() !== 200){
	//Debug part
	$smarty->assign('error', "Error processing the Rest request");
	$smarty->assign('request', $request);
	$smarty->assign('dump', RestAPI::getDump());
	echo $smarty->display('msg_rest_error.tpl');
	return;
} 

$response = json_decode($request->getResponse(), true);

//Get the projects in the response data
$project = $response['data']['projects'][0];

$uid = forge_utils::getConnectedUserId();
$is_member_or_admin = forge_utils::is_project_admin($project, $uid) || forge_utils::is_project_member($project, $uid);
/*if($is_member_or_admin){
	echo "oui";
}else {
	echo "non";
}
die();*/
$is_readable = true;
$is_writable = $is_member_or_admin;
$is_deletable = $is_member_or_admin;

$smarty->assign('is_readable', $is_readable);
$smarty->assign('is_writable', $is_writable);
$smarty->assign('is_deletable', $is_deletable);

include('lib/inc.debug.php');

?>