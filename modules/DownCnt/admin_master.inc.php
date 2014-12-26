<?php

if (!isset($gCms)) exit;
if (!$this->CheckPermission('Manage Download Counters')) exit;

/*************************
	Second Header
**************************/
$entryarray = array();
$nomasters = array();

$img_true = "<img src='".$config["root_url"].'/modules/'.$this->getName()."/img/true.gif' alt='true'/>";
$img_false = "<img src='".$config["root_url"].'/modules/'.$this->getName()."/img/false.gif' alt='false'/>";
$img_delete = "<img src='".$config["root_url"].'/modules/'.$this->getName()."/img/delete.gif' alt='delete'/>";

$query = '';
$dbresult = '';
$query = 'SELECT * FROM ' . cms_db_prefix() . 'module_downcnt ORDER BY lastdown_date DESC';
$dbresult = $db->Execute($query);
$messageAll = '';
if($dbresult->RecordCount() == 0){
  $messageAll = $this->Lang('nocountersfound');
}

while ($row = $dbresult->FetchRow())
{
  $onerow = new stdClass();

  $onerow->id = $row['id'];
  $nomasters[$row['id']] = true;
  $onerow->name = html_entity_decode($row['name'], ENT_QUOTES, 'UTF-8');
  $onerow->value = $row['down_cnt'];
  $onerow->lastdate = $row['lastdown_date'];


  $onerow->activelink = $this->CreateLink($id, 'changeactive', $returnid, ($row['active']) ? $img_true : $img_false, array('cnt_id' => $row['id'], 'active' => (($row['active']) ? '0' : '1')));
  $onerow->deletelink = $this->CreateLink($id, 'delete', $returnid, $img_delete, array('cnt_id' => $row['id']), $this->Lang('areyousure'));
  $onerow->massdeletebox = $this->CreateInputCheckbox($id, 'massdel_'.$row['id'], 'massdel_'.$row['id'], -1);

  $entryarray[] = $onerow;
}

/*************************
	END Second Header
**************************/

/*************************
	Third Header
**************************/

$query2 = 'SELECT * FROM ' . cms_db_prefix() . 'module_downcnt_master';
$masters = array();
$sids = array();
$dbresult = $db->Execute($query2);
while ($row = $dbresult->FetchRow())
{
	$sid = $row['id'];
	
	if(isset($nomasters[$sid]))
	{
		unset($nomasters[$sid]);
	}
	
	$master = htmlentities($row['master'],ENT_QUOTES,'UTF-8');
	
	if(!isset($sids[$sid]))
	{
		$sids[$sid] = array();
	}
	$sids[$sid][] = $master;
	
	
	if(!isset($masters[$master]))
	{
		$masters[$master] = array();
	}
	$masters[$master][] = $sid;
}

ksort($masters);
$masterskey = array_keys($masters);
$listSelect = array();
foreach($masterskey as $master)
{
	$listSelect[$master] = $master;
}

$urlAdd = $this->CreateLink($id, 'adminAddMaster', $returnid, "", array('disable_theme'=>'true'), null, true);
$urlDel = $this->CreateLink($id, 'adminRemoveMaster', $returnid, "", array('disable_theme'=>'true'), null, true);

$input = $this->CreateInputText($id, 'newtag', '', 20, 200)."<img id='newtag' src='".$config["root_url"].'/modules/'.$this->getName()."/img/add.png' class='newtag' alt='new tag' title='new tag'/>";

$selects = array();
foreach($entryarray as $entry)
{
	$selects[$entry->id] = $this->CreateInputDropdown ($id, 'listtag', $listSelect, null, null, "style='width: 50px; padding: 2px 0;'")."<img src='".$config["root_url"].'/modules/'.$this->getName()."/img/add.png' class='addtag' alt='add tag' title='add tag' id='sid_".$entry->id."'/>";
}

$smarty->assign('noCounter', $messageAll);
$smarty->assign('formstartMaster', $this->CreateFormStart($id, 'massdelete', $returnid));

$smarty->assign_by_ref('items', $entryarray);
$smarty->assign('itemcount', count($entryarray));
$smarty->assign('nametext', $this->Lang('name'));
$smarty->assign('valuetext', $this->Lang('value'));
$smarty->assign('lastdatetext', $this->Lang('lastdate'));
$smarty->assign('activetext', $this->Lang('active'));
$smarty->assign('tagtext', $this->Lang('tag'));
$smarty->assign('withouttagtext', $this->Lang('withouttag'));
$smarty->assign('listtagtext', $this->Lang('listtagtext'));;

$smarty->assign('sids', $sids);
$smarty->assign('masters', $masters);
$smarty->assign('masterskey', $masterskey);
$smarty->assign('newTag', $input);
$smarty->assign('selects', $selects);
$smarty->assign('nomasters', $nomasters);
$smarty->assign('urlAdd', $urlAdd);
$smarty->assign('urlDel', $urlDel);

$smarty->assign('formend', $this->CreateFormEnd());
$smarty->assign('tab_end',$this->EndTab());
$smarty->assign('masterTpl',$this->StartTab('master', $params));

$smarty->assign('massdelbutton', $this->CreateInputSubmit($id, 'delselected', $this->Lang('delselected'), '', '', $this->Lang('areyousure2')));


/*************************
	END Third Header
**************************/

?>
