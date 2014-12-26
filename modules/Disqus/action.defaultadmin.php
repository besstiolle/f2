<?php

if (!function_exists('cmsms')) exit;

if (! $this->VisibleToAdminUser()) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}
if (!empty($params['err'])){
	echo $this->ShowErrors($this->Lang($params['err']));
}
if (!empty($params['msg'])){
	echo $this->ShowMessage($this->Lang($params['msg']));
}
// Content defines and Form stuff for the admin
$smarty->assign('start_form', $this->CreateFormStart($id, 'admin_save', $returnid));
$smarty->assign('input_d_shortname',$this->CreateInputText($id, 'd_shortname', $this->GetPreference('d_shortname','')). $this->Lang('title_d_Shortname_help'));
$smarty->assign('input_isPreviewBlocked',$this->CreateInputCheckbox($id, 'isPreviewBlocked','1' , $this->GetPreference('isPreviewBlocked','0')). $this->Lang('title_isPreviewBlocked_help'));
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', $this->lang('submit')));
$smarty->assign('end_form', $this->CreateFormEnd());
$smarty->assign('title_test', $this->lang('title_test'));


echo $this->ProcessTemplate('admin.tpl');
echo "<div style='width:500px;border:1px solid #CCC; padding : 10px;'>";
include_once('action.default.php');
echo "</div>";
?>