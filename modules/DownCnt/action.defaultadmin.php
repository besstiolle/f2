<?php

if (!isset($gCms)) exit;
if (!$this->CheckPermission('Manage Download Counters')) exit;
/*
if (isset($params['error_msg']))
{
  if ($params['error_msg'] === 'error_no_id')
    $this->ShowErrors(array($this->Lang['error_no_id']));
}*/

if(!empty($params['err'])) {$this->ShowErrors(array($this->Lang($params['err'])));}
if(!empty($params['msg'])) {$this->ShowMessage($this->Lang($params['msg']));}


//we add headers
$tab = null;
if(!empty($params['tab']))
{
	$tab = $params['tab'];
}
$tab_header = $this->StartTabHeaders();
$tab_header.= $this->SetTabHeader('hardlink',$this->Lang('title_hardlink'),('hardlink' == $tab));
//$tab_header.= $this->SetTabHeader('all',$this->Lang('title_all'),('all' == $tab));
$tab_header.= $this->SetTabHeader('master',$this->Lang('title_master'),('master' == $tab));
$tab_header.= $this->SetTabHeader('stats',$this->Lang('title_stats'),('stats' == $tab));

$tab_header.= $this->EndTabHeaders();
$smarty->assign('tabs_start',$tab_header.$this->StartTabContent());
$smarty->assign('tab_end',$this->EndTab());

$smarty->assign('hardlinkTpl',$this->StartTab('hardlink', $params));
//$smarty->assign('allTpl',$this->StartTab('all', $params));
$smarty->assign('masterTpl',$this->StartTab('master', $params));
$smarty->assign('statsTpl',$this->StartTab('stats', $params));
$smarty->assign('tabs_end',$this->EndTabContent());

$db = cmsms()->GetDb();

include_once(dirname(__FILE__).'/admin_hard.inc.php');
include_once(dirname(__FILE__).'/admin_master.inc.php');
include_once(dirname(__FILE__).'/admin_stats.inc.php');

//Complement
$this->smarty->assign('formstartHardlink', $this->CreateFormStart($id, 'massdeleteHardlink', $returnid));
$this->smarty->assign('formstartHardlinkAdd', $this->CreateFormStart($id, 'adminAddHardLink', $returnid));
$this->smarty->assign('formend', $this->CreateFormEnd());
$this->smarty->assign('id', $id);

$this->smarty->assign('nametext', $this->Lang('name'));
$this->smarty->assign('valuetext', $this->Lang('value'));
$this->smarty->assign('linktext', $this->Lang('link'));
$this->smarty->assign('newName', $this->Lang('newName'));
$this->smarty->assign('addText', $this->Lang('addText'));
$this->smarty->assign('newFile', $this->Lang('newFile'));
$this->smarty->assign('lastdatetext', $this->Lang('lastdate'));
$this->smarty->assign('activetext', $this->Lang('active'));
$this->smarty->assign('usageText', $this->Lang('usageText'));
$this->smarty->assign('tagtext', $this->Lang('tag'));
$this->smarty->assign('withouttagtext', $this->Lang('withouttag'));
$this->smarty->assign('listtagtext', $this->Lang('listtagtext'));;
$this->smarty->assign('confirm_del_tag', $this->Lang('confirm_del_tag'));

echo $this->ProcessTemplate('admin_js.tpl').$this->ProcessTemplate('defaultadmin.tpl');


?>
