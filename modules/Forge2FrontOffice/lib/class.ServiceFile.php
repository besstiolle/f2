<?php

/**
 * Will call the API Release
 */
class ServiceFile {
	
	private $url_avatar = 'rest/v1/files/project/%d/avatar/';
	private $url_show = 'rest/v1/files/project/%d/show/';

	function __construct(){
		
	}

	/**
	 * @param integer the projectId
	 * @param array the parameters of the file(s)
	 */
	public function addAvatarForProjectId($projectId, $bodyParam = array()){

		$request = RestAPI::PUT(sprintf($this->url_avatar, $projectId), array(), $bodyParam);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		return true;
	}
	
	/**
	 * @param integer the projectId
	 * @param array the parameters of the file(s)
	 */
	public function addShowForProjectId($projectId, $bodyParam = array()){

		$request = RestAPI::PUT(sprintf($this->url_show, $projectId), array(), $bodyParam);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		return true;
	}
}

?>