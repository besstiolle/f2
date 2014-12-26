<?php

define("TC_TMPL_PREFIX_DISPLAY" , "display" );
define("TC_DEFAULT_DISPLAY_TMPL_PREF_NAME",'current_'.TC_TMPL_PREFIX_DISPLAY.'_template');

class TagCloud extends CGExtensions {

  function GetName() {
    return 'TagCloud';
  }

  function GetFriendlyName() {
    return $this->Lang('friendlyname');
  }

  function GetVersion() {
    return '1.0.2';
  }
  
  function GetHelp() {
    return $this->Lang('help');
  }

  function GetAuthor() {
    return 'Bess';
  }

  function GetAuthorEmail() {
    return 'contact [at] furie.be';
  }
  
  function GetChangeLog() {
    return $this->Lang('changelog');
  }
  
  function IsPluginModule() {
    return true;
  }

  function HasAdmin() {
    return true;
  }

  function GetAdminSection() {
    return 'extensions';
  }

  function GetAdminDescription() {
    return $this->Lang('moddescription');
  }
  
  function VisibleToAdminUser() {
    return $this->CheckPermission('Use TagCloud');
  }
 
  function GetDependencies() {
    return array('CGExtensions'=>'1.37');
  }

  function MinimumCMSVersion() {
    return "1.11.0";
  }
  
  function MaximumCMSVersion() {
    return "2.0";
  }

  function InstallPostMessage() {
    return $this->Lang('postinstall');
  }

  function UninstallPostMessage() {
    return $this->Lang('postuninstall');
  }

  function UninstallPreMessage() {
    return $this->Lang('really_uninstall');
  }
  
  public function AllowSmartyCaching() {
	return TRUE; 
  }


  function SetParameters() {
	$this->RegisterModulePlugin();

	$this->RestrictUnknownParams();

	$this->CreateParameter('template', '',$this->Lang('help_module_template'));
	$this->SetParameterType('template',CLEAN_STRING);
	
	$this->CreateParameter('number', '30',$this->Lang('help_module_number'));
	$this->SetParameterType('number',CLEAN_INT);
	
	$this->CreateParameter('resultpage', '',$this->Lang('help_module_resultpage'));
	$this->SetParameterType('resultpage',CLEAN_STRING);
	
	$this->CreateParameter('algo', 'log',$this->Lang('help_module_algo'));
	$this->SetParameterType('algo',CLEAN_STRING);
	

	$this->AddEventHandler( 'Search', 'SearchAllItemsDeleted', true );
	$this->AddEventHandler( 'Search', 'SearchItemAdded', true );
	$this->AddEventHandler( 'Search', 'SearchItemDeleted', true );
  }

    function DoEvent( $originator, $eventname, &$params ){
		cloud_utils::clearCache();
	}
}
?>
