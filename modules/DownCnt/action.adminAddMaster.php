<?php


if (!isset($gCms)) exit;
if (!$this->CheckPermission('Manage Download Counters')) exit;


if (!empty($params['tag']))
{
	$tag = $params['tag'];
	$sid = null;
	if(!empty($params['sid']))
	{
		$sid = $params['sid'];
	}
	
	if($sid == null)
	{
		$query = 'Select count(*) as cpt from ' . cms_db_prefix() . 'module_downcnt_master where id is NULL and master = ?';
		$dbresult = $db->GetOne($query, array($tag));
	} else{
		$query = 'Select count(*) as cpt from ' . cms_db_prefix() . 'module_downcnt_master where id = ? and master = ?';
		$dbresult = $db->GetOne($query, array($sid,$tag));
	}
	
	if($dbresult == 0)
	{
		$query = 'INSERT INTO ' . cms_db_prefix() . 'module_downcnt_master (id,master) values (?,?)';
		$dbresult = $db->Execute($query, array($sid,$tag));
	}
}

include_once('admin_master.inc.php');

echo $this->ProcessTemplate('counterlistmaster.tpl');



?>
