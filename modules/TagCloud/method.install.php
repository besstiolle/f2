<?php

if (!function_exists('cmsms')) exit;

$db = cmsms()->GetDb();
$config = cmsms()->GetConfig();

$this->CreatePermission('Use TagCloud', 'Use TagCloud');

$this->SetPreference("prefs", serialize(cloud_utils::getDefaultPrefs()));

# Setup display template
$fn = dirname(__FILE__).'/templates/sample.tpl';
if( file_exists( $fn ) ) {
	$template = @file_get_contents($fn);
	$this->SetTemplate(TC_TMPL_PREFIX_DISPLAY.'Sample',$template);
	
	//Default values
	$this->SetPreference('default_'.TC_TMPL_PREFIX_DISPLAY.'_template_contents',$template);
	$this->SetPreference(TC_DEFAULT_DISPLAY_TMPL_PREF_NAME,'Sample');
}
# Setup 2nd display template
$fn = dirname(__FILE__).'/templates/sample_with_pretty_urls.tpl';
if( file_exists( $fn ) ) {
	$template = @file_get_contents($fn);
	$this->SetTemplate(TC_TMPL_PREFIX_DISPLAY.'Sample_With_Pretty_Url',$template);
}

// put mention into the admin log
$this->Audit( 0, 
	      $this->Lang('friendlyname'), 
	      $this->Lang('installed', $this->GetVersion()) );

	      
?>