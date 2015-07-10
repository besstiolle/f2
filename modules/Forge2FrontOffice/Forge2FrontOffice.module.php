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
$pathShared = $config['root_path'].'/modules/Forge2FrontOffice/lib/shared/';
require_once($pathShared.'class.Enum.php');
require_once($pathShared.'class.EnumProjectState.php');
require_once($pathShared.'class.EnumProjectRepository.php');
require_once($pathShared.'class.EnumProjectJoinRequestState.php');
require_once($pathShared.'class.EnumProjectType.php');
require_once($pathShared.'class.EnumAssignmentRole.php');
require_once($pathShared.'class.EnumTaggingType.php');
require_once($pathShared.'class.EnumHistoryType.php');
require_once($pathShared.'class.EnumCommentType.php');
require_once($pathShared.'class.EnumTrackerItemResolution.php');
require_once($pathShared.'class.EnumTrackerItemSeverity.php');
require_once($pathShared.'class.EnumTrackerItemState.php');
require_once($pathShared.'class.EnumTrackerItemType.php');



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

	function InitializeAdmin(){
		$this->_init();
	}
	function InitializeFrontend()
	{
		$this->RegisterModulePlugin(true, false);
		$this->RestrictUnknownParams();
		$this->SetParameterType('routing',CLEAN_STRING);
		$this->SetParameterType('method',CLEAN_STRING);
		//$this->SetParameterType('link_next_success',CLEAN_STRING);
		$this->SetParameterType('_link_next_failed',CLEAN_STRING);
		$this->SetParameterType('sid',CLEAN_INT);
		$this->SetParameterType('projectId',CLEAN_INT);
		$this->SetParameterType('projectName',CLEAN_STRING);
		$this->SetParameterType('name',CLEAN_STRING);
		$this->SetParameterType('unix_name',CLEAN_STRING);
		$this->SetParameterType('description',CLEAN_STRING);
		$this->SetParameterType('project_type',CLEAN_INT);
		$this->SetParameterType('filterAlpha',CLEAN_STRING);

		$this->SetParameterType('pagin_page',CLEAN_INT);
		$this->SetParameterType('pagin_num',CLEAN_INT);

		//section "my_modules"
		$this->SetParameterType('user_id',CLEAN_INT);
		$this->SetParameterType('project',CLEAN_NONE);

		//tracker item
		$this->SetParameterType('type',CLEAN_INT);
		$this->SetParameterType('tracker_itemId',CLEAN_INT);

		//release
		$this->SetParameterType('releaseId',CLEAN_INT);
		$this->SetParameterType('all',CLEAN_STRING);

		//Fiters
		$this->SetParameterType('state',CLEAN_STRING);

		//Various parameters
		$this->SetParameterType('wiki_prefix',CLEAN_NONE);
		$this->SetParameterType('debugId',CLEAN_STRING);
		$this->SetParameterType('confirm',CLEAN_STRING);

		$this->_init();
	}

	function CreateStaticRoutes() {
		$returnid = cmsms()->GetContentOperations()->GetDefaultContent();
		$prefixProject = 'project';
		$prefixBug = 'bug';
		$prefixRequest = 'request';
		$releaseRequest = 'release';
		$all = 'all';
		$new = 'new';
		$delete = 'delete';
		$edit = 'edit';
		$projectId = '(?P<projectId>[\d]+)';
		$projectName = '(?P<projectName>[\d\w\-\:]+)';
		$packageId = '(?P<packageId>[\d]+)';
		$tracker_itemId = '(?P<tracker_itemId>[\d]+)';
		$releaseId = '(?P<releaseId>[\d]+)';
		$debugId = '(?P<debugId>[\d\w]+)';
		//$filterAlpha = '(?P<filterAlpha>[\d\w])';


		//List of Projects
		$route = $this->_generateRoute($prefixProject, 'list');
		$this->_add_static($route, array('action'=>'projectList', 'returnid'=>$returnid));

		//List of Projects with filtre alpha numeric
		//$route = $this->_generateRoute($prefixProject, 'list', $filterAlpha);
		//$this->_add_static($route, array('action'=>'projectList', 'returnid'=>$returnid));

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

		//Page of all bugs of a project
		$route = $this->_generateRoute($prefixProject, $projectId, $projectName, $prefixBug, 'list');
		$this->_add_static($route, array('action'=>'tracker_itemList', 'returnid'=>$returnid, 'type' => EnumTrackerItemType::Bug));

		//Page of bug of a project
		$route = $this->_generateRoute($prefixProject, $projectId, $projectName, $prefixBug, $tracker_itemId);
		$this->_add_static($route, array('action'=>'tracker_itemView', 'returnid'=>$returnid, 'type' => EnumTrackerItemType::Bug));

		//Page of all bugs of a project
		$route = $this->_generateRoute($prefixProject, $projectId, $projectName, $prefixRequest, 'list');
		$this->_add_static($route, array('action'=>'tracker_itemList', 'returnid'=>$returnid, 'type' => EnumTrackerItemType::FeatureRequest));

		//Page of bug of a project
		$route = $this->_generateRoute($prefixProject, $projectId, $projectName, $prefixRequest, $tracker_itemId);
		$this->_add_static($route, array('action'=>'tracker_itemView', 'returnid'=>$returnid, 'type' => EnumTrackerItemType::FeatureRequest));

		//Page of list of file for a release
		$route = $this->_generateRoute($prefixProject, $projectId, $projectName, $releaseRequest, $releaseId);
		$this->_add_static($route, array('action'=>'releaseView', 'returnid'=>$returnid));

		//Page of list of file for a release + older
		$route = $this->_generateRoute($prefixProject, $projectId, $projectName, $releaseRequest, $releaseId, $all);
		$this->_add_static($route, array('action'=>'releaseView', 'returnid'=>$returnid, 'all' => true));

		//Access Denied
		$route = $this->_generateRoute('401');
		$this->_add_static($route, array('action'=>'access_denied', 'returnid'=>$returnid));
		//Access Denied
		$route = $this->_generateRoute('debug', $debugId);
		$this->_add_static($route, array('action'=>'debug', 'returnid'=>$returnid));

		//Page of new project
		//$route = $this->_generateRoute('404');
		//$this->_add_static($route, array('action'=>'not_found', 'returnid'=>$returnid));
	}

	private function _generateRoute(){
   		return '/^'.implode('\/', func_get_args()).'$/';
    }

    private function _add_static($route, $params){
		cms_route_manager::add_static(new CmsRoute($route, $this->GetName(), $params));
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

	private function _init(){

		$user = $this->getPreference('user', '[TO DEFINED]');
		$pass = $this->getPreference('pass', '[TO DEFINED]');
		$rest_url = $this->getPreference('rest_url', '[TO DEFINED]');
		$config = cmsms()->GetConfig();

		//Init the RestAPI
		require_once($config['root_path'].'/modules/Forge2FrontOffice/lib/class.RestAPI.php');

		RestAPI::init($user, $pass, $rest_url, $this);
	}

	static function smarty_is_project_admin($params, $smarty){
		return forge_smarty_plugins::smarty_is_project_admin($params, $smarty);
	}
	static function fg_is_project_member($params, $smarty){
		return forge_smarty_plugins::fg_is_project_member($params, $smarty);
	}
} 
?>
