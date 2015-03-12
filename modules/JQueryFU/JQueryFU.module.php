<?php


define("TMPL_PREFIX_DISPLAY" , "display" );
define("DEFAULT_DISPLAY_TMPL_PREF_NAME",'current_'.TMPL_PREFIX_DISPLAY.'_template');

class JQueryFU extends CGExtensions
{
  
  function GetName() {
    return 'JQueryFU';
  }

  function GetFriendlyName() {
    return 'JQueryFileUploader by Bess';
  }
  
  function GetVersion()
  {
    return '1.2.0';
  }
  
  function GetDependencies() {
    return array('CGExtensions'=>'1.37');
  }
 
  function GetHelp() {
    return $this->Lang('help');
  }
  
  function GetAuthor() {
    return 'Bess';
  }

  function GetAuthorEmail(){
    return 'contact [at] furie [dot] be';
  }
  
  function GetChangeLog(){
    return $this->Lang('changelog');
  }
  
  function IsPluginModule(){
    return true;
  }
  
  function HasAdmin(){
    return true;
  }

  function GetAdminSection(){
    return 'extensions';
  }
  
  function GetAdminDescription(){
    return $this->Lang('moddescription');
  }
  
  function VisibleToAdminUser(){
    return $this->CheckPermission('Use JqueryFU');
  }
  
  function MinimumCMSVersion() {
    return "1.99.0";
  }
  
  function InitializeFrontend() {
	  $this->RegisterModulePlugin(true, false);

    $this->RestrictUnknownParams();

    $this->SetParameterType('accept_file_types',CLEAN_STRING);
    $this->SetParameterType('number',CLEAN_INT);
    $this->SetParameterType('max_width',CLEAN_INT);
    $this->SetParameterType('max_height',CLEAN_INT);
    $this->SetParameterType('min_width',CLEAN_INT);
    $this->SetParameterType('min_height',CLEAN_INT);
    $this->SetParameterType('clean_name',CLEAN_STRING);
    $this->SetParameterType('dir_path',CLEAN_STRING);
    $this->SetParameterType('dir_url',CLEAN_STRING);
    $this->SetParameterType('template',CLEAN_STRING);
  }
  
  function InitializeAdmin() {
	  $this->CreateParameter('accept_file_types', "/\.(txt|gif|jpe?g|png)$/i", $this->Lang('help_accept_file_types'));
	  $this->CreateParameter('number', 99999, $this->lang('help_number'));
	  $this->CreateParameter('max_width', 0, $this->lang('help_max_width'));
	  $this->CreateParameter('max_height', 0, $this->lang('help_max_height'));
	  $this->CreateParameter('min_width', 0, $this->lang('help_min_width'));
	  $this->CreateParameter('min_height', 0, $this->lang('help_min_height'));
	  $this->CreateParameter('clean_name', "true", $this->lang('help_clean_name'));
	  $this->CreateParameter('dir_path', DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."jqueryfu", $this->lang('help_dir_path'));
	  $this->CreateParameter('dir_url', "/uploads/jqueryfu", $this->lang('help_dir_url'));
	  $this->CreateParameter('template', 'full', $this->lang('help_template'));
	}

  function RegisterEvents() {

  }
  
  function AllowSmartyCaching() {
	  return FALSE;
	}

	function LazyLoadFrontend() {
	  return FALSE;
	}

	function LazyLoadAdmin() {
	  return FALSE;
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
  
  function DisplayErrorPage($msg) {
    echo "<h3>".$msg."</h3>";
  }

} 

?>