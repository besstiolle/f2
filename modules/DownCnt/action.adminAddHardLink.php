<?php


if (!isset($gCms)) exit;
if (!$this->CheckPermission('Manage Download Counters')) exit;

if (!empty($params['name']) && !empty($params['file']))
{
	$file = $params['file'];
	$name = $params['name'];

	$query = 'Select count(*) as cpt from ' . cms_db_prefix() . 'module_downcnt_hardlink where name = ?';
	$dbresult = $db->GetOne($query, array($name));
	
	if($dbresult != 0) {
		$this->Redirect($id, "defaultadmin", '', array('err'=>'error_mustBeUnique', 'tab'=>'hard'));
	}
	
	$sid = $db->GenID(cms_db_prefix() . 'module_downcnt_hardlink_seq');
	$query = 'INSERT INTO ' . cms_db_prefix() . 'module_downcnt_hardlink (id,name, url) values (?, ?, ?)';
	$dbresult = $db->Execute($query, array($sid,$name,$file));
	$this->Redirect($id, "defaultadmin", '', array('msg'=>'message_success', 'tab'=>'hard'));
	
} else {
	$this->Redirect($id, "defaultadmin", '', array('err'=>'error_isrequired', 'tab'=>'hard'));
}

?>
