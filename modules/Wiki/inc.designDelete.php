<?php
if (!function_exists('cmsms')) exit;

$types = CmsLayoutTemplateType::load_all_by_originator($this->GetName());
if($types != null){
	foreach ($types as $type) {

		$tpls = $type->get_template_list();
		
		foreach ($tpls as $tpl) {
			$tpl->delete();
			echo "<br/>template ".$tpl->get_name()." deleted";
		}
		$type->delete();
		echo "<br/>type template ".$type->get_name()." deleted";
	}
}

try{
	$design = CmsLayoutCollection::load("Wiki Design With Foundation");
	$css_all = $design->get_stylesheets();
	if($css_all != null){
	foreach ($css_all as $css) {
		try{
			$css = CmsLayoutStylesheet::load($css);
			if($css != null){$css->delete();echo "<br/>css ".$css->get_name()." deleted";}
		} catch (CmsDataNotFoundException $e){ echo "css ".$css." not found"; }
	}}

	$tpl_all = $design->get_templates();
	if($tpl_all != null){
	foreach ($tpl_all as $tpl) {
		try{
			$tpl = CmsLayoutTemplate::load($tpl);
			if($tpl != null){$tpl->delete();echo "<br/>css ".$tpl->get_name()." deleted";}
		} catch (CmsDataNotFoundException $e){ echo "template ".$tpl." not found"; }
	}}

	$design->delete();
	echo "<br/>design ".$design->get_name()." deleted";

} catch (CmsDataNotFoundException $e){ echo "design not found"; }

?>