<?php

/* Force the loading of Orm Framework BEFORE this module */
$config = cmsms()->GetConfig();
$Orm = $config['root_path'].'/modules/Orm/Orm.module.php';
if( !is_readable( $Orm ) ) {
  echo '<h1><font color="red">ERROR: The Orm Framework could not be found [<a href="https://github.com/besstiolle/orm-ms/wiki">help</a>].</font></h1>';
  return;
}
require_once($Orm);


class Forge2FrontOffice extends Orm
{   
	function GetName() {
		return 'Forge2FrontOffice';
	}

	function GetFriendlyName() {
		return $this->Lang('friendlyname');
	}

	function GetVersion() {
		return '0.0.1';
	}

	function GetDependencies() {
		return array('Orm'=>'0.3.1');
	}

	function GetHelp() {
		return $this->Lang('help');
	}

	function GetAuthor() {
		return 'Kevin Danezis (aka Bess)';
	}

	function GetAuthorEmail() {
		return 'contact at furie point be';
	}

	function GetChangeLog() {
		return $this->Lang('changelog');
	}

	function GetAdminDescription() {
		return $this->Lang('moddescription');
	}

	function MinimumCMSVersion() {
		return "1.11.0";
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

	function VisibleToAdminUser() {
		return true;
	}

	function InitializeFrontend()
	{
		$this->RegisterModulePlugin(true, false);
		$this->RestrictUnknownParams();
	/*	$this->SetParameterType('accept_file_types',CLEAN_STRING);
		$this->SetParameterType('number',CLEAN_INT);
		$this->SetParameterType('max_width',CLEAN_INT);
		$this->SetParameterType('max_height',CLEAN_INT);
		$this->SetParameterType('min_width',CLEAN_INT);
		$this->SetParameterType('min_height',CLEAN_INT);
		$this->SetParameterType('clean_name',CLEAN_STRING);
		$this->SetParameterType('dir_path',CLEAN_STRING);
		$this->SetParameterType('dir_url',CLEAN_STRING);
		$this->SetParameterType('template',CLEAN_STRING);*/
	}

	function CreateStaticRoutes() {
		$returnid = cmsms()->GetContentOperations()->GetDefaultContent();
		$prefixProject = 'project';
		$projectId = '(?P<projectId>[0-9]+)';
		$projectName = '(?P<projectName>[a-zA-Z0-9\-\_\:]+)';
		$packageId = '(?P<packageId>[0-9]+)';

		//List of Projects
		$route = $this->_generateRoute($prefixProject, 'list');
		$this->_add_static($route, array('action'=>'projectList', 'returnid'=>$returnid));

		//Page of project
		$route = $this->_generateRoute($prefixProject, $projectName, $projectId);
		$this->_add_static($route, array('action'=>'projectById', 'returnid'=>$returnid));
	}

	private function _generateRoute(){
   		return '/'.implode('\/', func_get_args()).'$/';
    }

    private function _add_static($route, $params){
		cms_route_manager::add_static(new CmsRoute($route, $this->GetName(), $params));
    }

	function InitializeAdmin() {
	}

	function AllowSmartyCaching() {
		return false;
	}

	function LazyLoadFrontend() {
		return false;
	}

	function LazyLoadAdmin() {
		return false;
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
	
	/**
	 * a inner function for factorize some recurrent code
	 **/
	function securize($str){
		return htmlentities($str, ENT_QUOTES, 'UTF-8');
	}
} 
?>
