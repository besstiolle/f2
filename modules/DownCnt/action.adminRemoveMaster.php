<?php

if (!isset($gCms)) exit;
if (!$this->CheckPermission('Manage Download Counters')) exit;

if (!empty($params['tag']))
{
	$tag = $params['tag'];
	if(!empty($params['sid']))
	{
		$sid = $params['sid'];
		$query = 'DELETE FROM ' . cms_db_prefix() . 'module_downcnt_master where id = ? and master = ?';
		$dbresult = $db->Execute($query, array($sid,$tag));
		if(!$dbresult)
		{
			die("Error ".$db->ErrorMsg());
		}
	} else
	{
		$query = 'DELETE FROM ' . cms_db_prefix() . 'module_downcnt_master where master = ?';
		$dbresult = $db->Execute($query, array($tag));
		if(!$dbresult)
		{
			die("Error ".$db->ErrorMsg());
		}
	}
	
}

include_once('admin_master.inc.php');

echo $this->ProcessTemplate('counterlistmaster.tpl');



?>
