<?php

if (!function_exists('cmsms')) exit;

if(empty($params['d_shortname'])){
	$params['err'] = 'shortname_null';
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
} 

$shortName = $params['d_shortname'];
$this->SetPreference('d_shortname',$shortName);

$isPreviewBlocked = 0;
if(!empty($params['isPreviewBlocked']) && $params['isPreviewBlocked'] == '1'){
	$isPreviewBlocked = 1;
}
$this->SetPreference('isPreviewBlocked',$isPreviewBlocked);


$params['msg'] = 'success';
$this->Redirect($id, 'defaultadmin', $returnid, $params);

?>