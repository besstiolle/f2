<?php

if (!function_exists('cmsms')) exit;

if (! $this->CheckPermission('Use JqueryFU')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}

$tab = '';
if (!empty($params['active_tab'])) {
	$tab = $params['active_tab'];
}

$smarty = cmsms()->GetSmarty();
/*
$tab_header = $this->StartTabHeaders();
$tab_header .= $this->SetTabHeader('template',$this->Lang('title_template'),'template' == $tab);
$smarty->assign('start_template_tab',$this->StartTab('template', $params));


$smarty->assign('tabs_start',$tab_header.$this->EndTabHeaders().$this->StartTabContent());
$smarty->assign('tab_end',$this->EndTab());
$smarty->assign('tabs_end',$this->EndTabContent());*/

$smarty->assign('currentTab_template', 'template' == $tab);

$smarty->assign('mod', $this);

if(!empty($params['msg'])){ $this->ShowMessage($this->Lang($params['msg'])); }
if(!empty($params['err'])){ $this->ShowErrors($this->Lang($params['err'])); }

/** TEMPLATE PART **/
$smarty->assign('heading_display', $this->Lang('heading_display'));
$smarty->assign(
	'list_display_templates', 
	$this->ShowTemplateList(
		$id, 
		$returnid, 
		TMPL_PREFIX_DISPLAY, 
		'default_'.TMPL_PREFIX_DISPLAY.'_template_contents',
		'template',
		'current_'.TMPL_PREFIX_DISPLAY.'_template',
		$this->Lang('title_display'),
		$this->Lang('text_display_edit'),
		'defaultadmin'
	)
);
/** TEMPLATE PART **/

echo $this->ProcessTemplate('admin.tpl');

?>