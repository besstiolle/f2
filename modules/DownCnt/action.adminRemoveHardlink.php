<?php

if (!isset($gCms)) exit;
if (!$this->CheckPermission('Manage Download Counters')) exit;


if(!empty($params['sid']))
{
	$sid = $params['sid'];
	$query = 'DELETE FROM ' . cms_db_prefix() . 'module_downcnt_hardlink where id = ?';
	$dbresult = $db->Execute($query, array($sid));
	if(!$dbresult)
	{
		die("Error ".$db->ErrorMsg());
	}
} 

$this->Redirect($id, "defaultadmin", '', array('msg'=>'message_success', 'tab'=>'hard'));

	


?>
