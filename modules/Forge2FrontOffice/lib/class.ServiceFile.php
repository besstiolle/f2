<?php

/**
 * Will call the API Release
 */
class ServiceFile {
	
	private $url_avatar = 'rest/v1/files/project/%d/avatar/';
	private $url_show = 'rest/v1/files/project/%d/show/';

	private $jsonNode_avatar = 'avatars';
	private $jsonNode_show = 'shows';

	function __construct(){
		
	}

	/**
	 * @param integer the projectId
	 * @param array the parameters of the file(s)
	 */
	public function getAvatarsWaitingForProjectId($projectId){
		$urlParams = array();
		$urlParams['onTransfert'] = true;

		$request = RestAPI::GET(sprintf($this->url_avatar, $projectId), $urlParams);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404 ){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$images = $response['data'][$this->jsonNode_avatar];
		return $images;
	}

	/**
	 * @param integer the projectId
	 * @param array the parameters of the file(s)
	 */
	public function getAvatarsForProjectId($projectId){
		$urlParams = array();
		$urlParams['onTransfert'] = false;

		$request = RestAPI::GET(sprintf($this->url_avatar, $projectId), $urlParams);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404 ){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$images = $response['data'][$this->jsonNode_avatar];
		return $images;
	}

	/**
	 * @param integer the projectId
	 * @param array the parameters of the file(s)
	 */
	public function deleteAvatarsForProjectId($projectId, $filename){
		$urlParams = array();
		$urlParams['filename'] = $filename;

		$request = RestAPI::DELETE(sprintf($this->url_avatar, $projectId), $urlParams);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404 ){
			return errorGenerator::display400();
		} 

		return true;
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
	 
	 */
	/**
	 * @param integer the projectId
	 * @param array the parameters of the file(s)
	 */
	public function getShowsWaitingForProjectId($projectId){
		$urlParams = array();
		$urlParams['onTransfert'] = true;

		$request = RestAPI::GET(sprintf($this->url_show, $projectId), $urlParams);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404 ){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$images = $response['data'][$this->jsonNode_show];

		return $images;
	}

	/**
	 * @param integer the projectId
	 * @param array the parameters of the file(s)
	 */
	public function getShowsForProjectId($projectId){
		$urlParams = array();
		$urlParams['onTransfert'] = false;

		$request = RestAPI::GET(sprintf($this->url_show, $projectId), $urlParams);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404 ){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$images = $response['data'][$this->jsonNode_show];

		return $images;
	}

	/**
	 * @param integer the projectId
	 * @param array the parameters of the file(s)
	 */
	public function deleteShowsForProjectId($projectId, $filename){
		$urlParams = array();
		$urlParams['filename'] = $filename;

		$request = RestAPI::DELETE(sprintf($this->url_show, $projectId), $urlParams);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404 ){
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