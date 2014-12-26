<?php

if (!isset($gCms)) exit;
if (!$this->CheckPermission('Manage Download Counters')) exit;

$img_true = "<img src='".$config["root_url"].'/modules/'.$this->getName()."/img/true.gif' alt='true'/>";
$img_false = "<img src='".$config["root_url"].'/modules/'.$this->getName()."/img/false.gif' alt='false'/>";
$img_delete = "<img src='".$config["root_url"].'/modules/'.$this->getName()."/img/delete.gif' alt='delete'/>";
$img_error = $config["root_url"].'/modules/'.$this->getName().'/img/block.png';


$smarty->assign('img_error', $img_error);

/*************************
	First Header
**************************/

$query = 'SELECT * FROM ' . cms_db_prefix() . 'module_downcnt_hardlink ORDER BY name ASC';
$dbresult = $db->Execute($query);
$messageHardlink = '';
$entryarrayHardlink = array();
if($dbresult->RecordCount() == 0){
  $messageHardlink = $this->Lang('noresult');
}

while ($row = $dbresult->FetchRow())
{
  $onerow = new stdClass();

  $onerow->id = $row['id'];
  $onerow->name = html_entity_decode($row['name'], ENT_QUOTES, 'UTF-8');
  $onerow->file = $row['url'];
  $onerow->usage = "{".$this->GetName()." sid='".$onerow->name."'}";
  
  $onerow->deletelink = $this->CreateLink($id, 'adminRemoveHardlink', $returnid, $img_delete, array('sid' => $row['id']), $this->Lang('areyousure'));
  $onerow->massdeletebox = $this->CreateInputCheckbox($id, 'massdelHardlink_'.$row['id'], 'massdelHardlink_'.$row['id'], -1);

  $entryarrayHardlink[] = $onerow;
}

//Form to add new Hardcodedlink
$addFormName = $this->CreateInputText($id, 'name', '', 20, 200, null);
$addFormFile = $this->CreateInputText($id, 'file', '', 40, 200, null);

/*************************
	END First Header
**************************/

$this->smarty->assign('messageHardlink', $messageHardlink);
$this->smarty->assign('addFormName', $addFormName);
$this->smarty->assign('addFormFile', $addFormFile);
$this->smarty->assign_by_ref('itemsHardlink', $entryarrayHardlink);
$this->smarty->assign('itemcountHardlink', count($entryarrayHardlink));
$this->smarty->assign('submitbutton', $this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
$this->smarty->assign('massdelbuttonhard', $this->CreateInputSubmit($id, 'delselectedhard', $this->Lang('delselected'), '', '', $this->Lang('areyousure2')));

?>
