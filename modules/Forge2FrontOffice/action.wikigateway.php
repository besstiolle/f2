<?php


$config = cmsms()->GetConfig();
$smarty->addTemplateDir($config['root_path'].'/modules/Forge2FrontOffice/templates'); 

$query = $_SERVER["QUERY_STRING"];
$pattern = "#^[\w=]*project\/(?P<projectId>[\d]*)\/([\w\d]+)\/wiki#";
$matches = array();
if(!preg_match($pattern, $query, $matches)){
	if(isset($params['wiki_prefix'])){
		$query = $params['wiki_prefix'];
		if(!preg_match($pattern, $query, $matches)){
			//echo '!preg_match($pattern, $query, $matches)';
			return;
		}
	} else {
		//echo '!isset($params[\'wiki_prefix\'])';
		return;
	} 

}


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
	echo $smarty->display('msg_rest_error.tpl');
	include('lib/inc.debug.php');
	return;
} 

$response = json_decode($request->getResponse(), true);

//Get the projects in the response data
$project = $response['data']['projects'][0];

$uid = forge_utils::getConnectedUserId();
$is_member_or_admin = forge_utils::is_project_admin($project, $uid) || forge_utils::is_project_member($project, $uid);

$is_readable = true;
$is_writable = $is_member_or_admin;
$is_deletable = $is_member_or_admin;

//die(print_r($project));
//die($is_deletable);
$smarty->assign('project', $project);
$smarty->assign('is_readable', $is_readable);
$smarty->assign('is_writable', $is_writable);
$smarty->assign('is_deletable', $is_deletable);

include('lib/inc.debug.php');

?>