<?php
/**
 * 
 * 7. Input parameter sanitizing
 * -----------------------------
 * 
 * Starting from 1.1 version of CMSMS module developers are urged to take closer
 * look of what parameters their module accepts and how they are sanitized.
 * 
 * Few new API functions are introduced, all parameters should be mapped for
 * everything to work smoothly. Use $this->SetParameterType('paramname',TYPE); 
 * to clean your input parameters (possible types are CLEAN_INT, CLEAN_STRING,
 * CLEAN_FLOAT, CLEAN_STRING)
 */

class Disqus extends CMSModule
{
  function GetName()
  {
    return 'Disqus';
  }
  
  function GetFriendlyName()
  {
    return $this->Lang('friendlyname');
  }

  function GetVersion()
  {
    return '2.0';
  }
  
  function GetHelp()
  {
    return $this->Lang('help');
  }
  
  function GetAuthor()
  {
    return 'Bess';
  }

  function GetAuthorEmail()
  {
    return 'contac@furie.be';
  }
  
  function GetChangeLog()
  {
    return $this->Lang('changelog');
  }
  
  function IsPluginModule()
  {
    return true;
  }

  function HasAdmin()
  {
    return true;
  }
  
  function GetAdminSection()
  {
    return 'extensions';
  }

  function GetAdminDescription()
  {
    return $this->Lang('moddescription');
  }

  function VisibleToAdminUser()
  {
    return $this->CheckPermission('Use Disqus');
  }
  
  function GetDependencies()
  {
    return array();
  }

  function MinimumCMSVersion()
  {
    return "1.11.1";
  }
  
  function SetParameters()
  {
	$this->RegisterModulePlugin();

	$this->RestrictUnknownParams();
  
	$this->CreateParameter('action', 'default', $this->Lang('help_action'));
	$this->SetParameterType('action',CLEAN_STRING);
	
	$this->CreateParameter('disqus_identifier', 'null', $this->Lang('help_disqus_identifier'));
	$this->SetParameterType('disqus_identifier',CLEAN_STRING);

	$this->CreateParameter('disqus_url','null',$this->Lang('help_disqus_url'));
	$this->SetParameterType('disqus_url',CLEAN_STRING);

	$this->CreateParameter('disqus_title','null',$this->Lang('help_disqus_title'));
	$this->SetParameterType('disqus_title',CLEAN_STRING);

	$this->CreateParameter('disqus_category_id','null',$this->Lang('help_disqus_category_id'));
	$this->SetParameterType('disqus_category_id',CLEAN_INT);
  }

  function InstallPostMessage()
  {
    return $this->Lang('postinstall');
  }

  function UninstallPostMessage()
  {
    return $this->Lang('postuninstall');
  }

  function UninstallPreMessage()
  {
    return $this->Lang('really_uninstall');
  }
}
?>
