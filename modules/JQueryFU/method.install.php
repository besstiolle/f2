<?php

if (!function_exists('cmsms')) exit;

$db = cmsms()->GetDb();
$config = cmsms()->GetConfig();

$this->CreatePermission('Use JqueryFU', 'Use JqueryFU');

# Setup display template
$fn = dirname(__FILE__).'/templates/full.tpl';
if( file_exists( $fn ) ) {
	$template = @file_get_contents($fn);
	$this->SetTemplate(TMPL_PREFIX_DISPLAY.'full',$template);
	
	//Default values
	$this->SetPreference('default_'.TMPL_PREFIX_DISPLAY.'_template_contents',$template);
	$this->SetPreference(DEFAULT_DISPLAY_TMPL_PREF_NAME,'full');
}
# Setup 2nd display template
$fn = dirname(__FILE__).'/templates/basic.tpl';
if( file_exists( $fn ) ) {
	$template = @file_get_contents($fn);
	$this->SetTemplate(TMPL_PREFIX_DISPLAY.'basic',$template);
}
# Setup 3 display template
$fn = dirname(__FILE__).'/templates/gdocViewer.tpl';
if( file_exists( $fn ) ) {
	$template = @file_get_contents($fn);
	$this->SetTemplate(TMPL_PREFIX_DISPLAY.'gdocViewer',$template);
}

// put mention into the admin log
$this->Audit( 0, 
	      $this->Lang('friendlyname'), 
	      $this->Lang('installed', $this->GetVersion()) );

	      
?>