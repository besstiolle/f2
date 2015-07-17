<?php

if (!function_exists("cmsms")) exit;

//Check the login
if(!forge_utils::getConnectedUserId()){
	forge_utils::inner_redirect('/account');
}

//Initiate the vars.
include_once('lib/inc.initialize.php');
if($mustStop) {return;}

//set cookie to avoid url-scam & double action
$CSRF = forge_utils::generateRandomString();
forge_utils::putCookie('new', $CSRF);

$serviceLicense = new ServiceLicense();
$result = $serviceLicense->getAll();
if(!$result) { return; }

$licenses = $result[0];
$defaultLicense = 101; //GLP

$smarty->assign('form', $this->CreateFrontendFormStart($id, $returnid, 'projectNewSend', 'post','', true, '',  array(
				 	'CSRF' => $CSRF
				 	)));
$smarty->assign('link_back', $root_url.'/project/list');
$smarty->assign('enumProjectType', Enum::ConstToArray('EnumProjectType'));
$smarty->assign('enumProjectRepository', Enum::ConstToArray('EnumProjectRepository'));
$smarty->assign('licenses', $licenses);
$smarty->assign('defaultLicense', $defaultLicense);


$smarty->assign('title', 'Create a new Project');

echo $smarty->display('projectNew.tpl');

include('lib/inc.debug.php');