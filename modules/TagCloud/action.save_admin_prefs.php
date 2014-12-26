<?php
if (!function_exists('cmsms')) exit;

if (! $this->CheckPermission('Use TagCloud')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}

if(empty($params['min_px']) || !cloud_utils::is_int($params['min_px'])){
	$params = array_merge($params, array('err'=> 'min_px_number', 'active_tab' => 'general'));
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}
if(empty($params['max_px']) || !cloud_utils::is_int($params['max_px'])){
	$params = array_merge($params, array('err'=> 'max_px_number', 'active_tab' => 'general'));
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}
if(empty($params['number']) || !cloud_utils::is_int($params['number'])){
	$params = array_merge($params, array('err'=> 'number_number', 'active_tab' => 'general'));
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}

	$prefs = array();
	$prefs["allowed"] = cloud_utils::cleanEmptyCellsAndExplodeIt($params['allowed']);
	$prefs["denied"] = cloud_utils::cleanEmptyCellsAndExplodeIt($params['denied']);
	$prefs["colors"] = cloud_utils::cleanEmptyCellsAndExplodeIt($params['colors']);
	$prefs["min_px"] = $params['min_px'];
	$prefs["max_px"] = $params['max_px'];
	$prefs["number"] = $params['number'];
	$prefs["template"] = 'default';
	


// set our preference
$this->SetPreference('prefs', serialize($prefs) );

//clear the cache
cloud_utils::clearCache();

// write to the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('prefsupdated') );
$params = array_merge($params, array('msg'=> 'prefsupdated', 'active_tab' => 'general'));

$this->Redirect($id, 'defaultadmin', $returnid, $params);


?>