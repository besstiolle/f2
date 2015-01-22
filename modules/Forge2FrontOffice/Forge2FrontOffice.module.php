<?php

/* Force the loading of Orm Framework BEFORE this module */
$config = cmsms()->GetConfig();
$Orm = $config['root_path'].'/modules/Orm/Orm.module.php';
if( !is_readable( $Orm ) ) {
  echo '<h1><font color="red">ERROR: The Orm Framework could not be found [<a href="https://github.com/besstiolle/orm-ms/wiki">help</a>].</font></h1>';
  return;
}
require_once($Orm);

//$config = cmsms()->GetConfig();
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.Enum.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumProjectState.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumProjectRepository.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumProjectJoinRequestState.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumProjectType.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumAssignmentRole.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumTaggingType.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumHistoryType.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumCommentType.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumTrackerItemResolution.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumTrackerItemSeverity.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumTrackerItemState.php');
require_once($config['root_path'].'/modules/Forge2/lib/Enum/class.EnumTrackerItemType.php');



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
		$this->SetParameterType('routing',CLEAN_STRING);
		$this->SetParameterType('method',CLEAN_STRING);
		$this->SetParameterType('link_next_success',CLEAN_STRING);
		$this->SetParameterType('link_next_failed',CLEAN_STRING);
		$this->SetParameterType('projectId',CLEAN_INT);
		$this->SetParameterType('projectName',CLEAN_STRING);
		$this->SetParameterType('name',CLEAN_STRING);
		$this->SetParameterType('unix_name',CLEAN_STRING);
		$this->SetParameterType('description',CLEAN_STRING);
	}

	function CreateStaticRoutes() {
		$returnid = cmsms()->GetContentOperations()->GetDefaultContent();
		$prefixProject = 'project';
		$new = 'new';
		$delete = 'delete';
		$edit = 'edit';
		$projectId = '(?P<projectId>[0-9]+)';
		$projectName = '(?P<projectName>[a-zA-Z0-9\-\_\:]+)';
		$packageId = '(?P<packageId>[0-9]+)';

		//List of Projects
		$route = $this->_generateRoute($prefixProject, 'list');
		$this->_add_static($route, array('action'=>'projectList', 'returnid'=>$returnid));

		//Page of project
		$route = $this->_generateRoute($prefixProject, $projectId, $projectName);
		$this->_add_static($route, array('action'=>'projectView', 'returnid'=>$returnid));

		//Page of delete project
		$route = $this->_generateRoute($prefixProject, $projectId, $projectName, $delete);
		$this->_add_static($route, array('action'=>'projectDelete', 'returnid'=>$returnid));

		//Page of edit project
		$route = $this->_generateRoute($prefixProject, $projectId, $projectName, $edit);
		$this->_add_static($route, array('action'=>'projectEdit', 'returnid'=>$returnid));
		
		//Page of new project
		$route = $this->_generateRoute($prefixProject, $new);
		$this->_add_static($route, array('action'=>'projectNew', 'returnid'=>$returnid));
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
