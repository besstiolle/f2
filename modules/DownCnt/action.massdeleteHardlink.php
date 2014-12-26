<?php

if (!isset($gCms)) exit;
if (!$this->CheckPermission('Manage Download Counters')) exit;

$query = 'DELETE FROM ' . cms_db_prefix() . 'module_downcnt_hardlink WHERE';

foreach ($params as $param)
{
  echo $param . '<br>';
  if(strpos('_' . $param, 'massdelHardlink_'))
  {
    $id = substr($param, 16);
    $query .= ' id = ' . $id . ' OR';
  }
}

$query = substr($query, 0, -3);

$result = $db->Execute($query);

$this->Redirect($id, 'defaultadmin', '', array('msg' => 'message_success', 'tab'=>'hard'));

?>
