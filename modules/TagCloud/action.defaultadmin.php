<?php

if (!function_exists('cmsms')) exit;

if (! $this->CheckPermission('Use TagCloud')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}

$tab = '';
if (!empty($params['active_tab'])) {
	$tab = $params['active_tab'];
}

$smarty = cmsms()->GetSmarty();

$tab_header = $this->StartTabHeaders();
$tab_header .= $this->SetTabHeader('general',$this->Lang('title_general'),'general' == $tab);
$tab_header .= $this->SetTabHeader('template',$this->Lang('title_template'),'template' == $tab);
$smarty->assign('start_general_tab',$this->StartTab('general', $params));
$smarty->assign('start_template_tab',$this->StartTab('template', $params));


$smarty->assign('tabs_start',$tab_header.$this->EndTabHeaders().$this->StartTabContent());
$smarty->assign('tab_end',$this->EndTab());
$smarty->assign('tabs_end',$this->EndTabContent());
$smarty->assign('start_form', $this->CreateFormStart($id, 'save_admin_prefs', $returnid));

if(!empty($params['allowed'])){$params['allowed'] = implode(chr(13).chr(10), cloud_utils::cleanEmptyCellsAndExplodeIt($params['allowed']));}
if(!empty($params['denied'])){$params['denied'] = implode(chr(13).chr(10), cloud_utils::cleanEmptyCellsAndExplodeIt($params['denied']));}
if(!empty($params['colors'])){$params['colors'] = implode(chr(13).chr(10), cloud_utils::cleanEmptyCellsAndExplodeIt($params['colors']));}

$prefs = unserialize($this->GetPreference("prefs"));
if(!empty($params['allowed'])){$prefs['allowed'] = $params['allowed'];}
if(!empty($params['denied'])){$prefs['denied'] = $params['denied'];}
if(!empty($params['colors'])){$prefs['colors'] = $params['colors'];}
if(!empty($params['min_px'])){$prefs['min_px'] = $params['min_px'];}
if(!empty($params['max_px'])){$prefs['max_px'] = $params['max_px'];}
if(!empty($params['number'])){$prefs['number'] = $params['number'];}


$smarty->assign('prefs',$prefs);
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
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
		TC_TMPL_PREFIX_DISPLAY, 
		'default_'.TC_TMPL_PREFIX_DISPLAY.'_template_contents',
		'template',
		'current_'.TC_TMPL_PREFIX_DISPLAY.'_template',
		$this->Lang('title_display'),
		$this->Lang('text_display_edit'),
		'defaultadmin'
	)
);
/** TEMPLATE PART **/

echo $this->ProcessTemplate('admin.tpl');

?>