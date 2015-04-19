<?php
if (!function_exists('cmsms')) exit;

$uid = null;
if( cmsms()->test_state(CmsApp::STATE_INSTALL) ) {
  $uid = 1; // hardcode to first user
} else {
  $uid = get_userid();
}


$config = cmsms()->GetConfig();
$c_css1 = file_get_contents($config['root_path'].'/modules/Wiki/templates/init/css_normalize');
$c_css2 = file_get_contents($config['root_path'].'/modules/Wiki/templates/init/css_foundation');
$c_css3 = file_get_contents($config['root_path'].'/modules/Wiki/templates/init/css_wiki');

$c_tpl1 = file_get_contents($config['root_path'].'/modules/Wiki/templates/init/tpl_wiki1col');
$c_tpl2 = file_get_contents($config['root_path'].'/modules/Wiki/templates/init/tpl_wiki2cols');


try {

  //Using core::page type
  $wiki_type = CmsLayoutTemplateType::load("Core::page");


  // CREATE TEMPLATE 1 COL
  $tpl1 = new CmsLayoutTemplate();
  $tpl1->set_name('Wiki Sample 1 col');
  $tpl1->set_owner($uid);
  $tpl1->set_content($c_tpl1);
  $tpl1->set_type($wiki_type);
  $tpl1->set_type_dflt(TRUE);
  $tpl1->save();
  //CmsLayoutTemplate::load($tpl1->get_name());

  // CREATE TEMPLATE 2 ROL
  $tpl2 = new CmsLayoutTemplate();
  $tpl2->set_name('Wiki Sample 2 cols');
  $tpl2->set_owner($uid);
  $tpl2->set_content($c_tpl2);
  $tpl2->set_type($wiki_type);
  $tpl2->set_type_dflt(TRUE);
  $tpl2->save();
  //CmsLayoutTemplate::load($tpl2->get_name());

  // CREATE CSS
  $css1 = new CmsLayoutStylesheet();
  $css1->set_name('Wiki_Normalize');
  $css1->set_content($c_css1);
  $css1->set_description("CSS for the Normalize's base design v3.0.2");
  $css1->save();
  //CmsLayoutStylesheet::load($css1->get_name());

  $css2 = new CmsLayoutStylesheet();
  $css2->set_name('Wiki_Foundation');
  $css2->set_content($c_css2);
  $css2->set_description("CSS for the foundation's base design v5.5.1");
  $css2->save();
  //CmsLayoutStylesheet::load($css2->get_name());

  $css3 = new CmsLayoutStylesheet();
  $css3->set_name('Wiki_Main');
  $css3->set_content($c_css3);
  $css3->set_description("CSS for the wiki v1.0.0 . Extends the foundations's base design");
  $css3->save();
  //CmsLayoutStylesheet::load($css3->get_name());


  // CREATE TEMPLATE 2 ROL
  $design = new CmsLayoutCollection();
  $design->set_name("Wiki Design With Foundation");
  $design->set_description("Foundation Design needed by the wiki to work. It will include CSS and JS for foundation 5.5.1");
  $design->set_templates(array(
  			$tpl1->get_id(),
  			$tpl2->get_id(),
  			));
  $design->set_stylesheets(array(
  			$css1->get_id(),
  			$css2->get_id(),
  			$css3->get_id(),
  			));
  $design->save();

}
catch( CmsException $e ) {
  audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
  echo $this->GetName(),'Installation Error: '.$e->GetMessage();
  die();
}

?>