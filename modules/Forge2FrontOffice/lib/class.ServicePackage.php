<?php

/**
 * Will call the API Package
 */
class ServicePackage {
	
	private $url = 'rest/v1/package/';

	private $msg404 = 'The package #%d %s does not exist';

	private $jsonNode = 'packages';

	function __construct(){
		
	}

	/**
	 * Return a package
	 * 
	 * @param  integer the id of the package
	 * @param  string a name (usefull for the message in case of error)
	 * @param  array a list of urlParameter
	 * @return mixed the package or FALSE if an error occured
	 */
	public function getOne($id, $name = '', $urlParam = array()){
		$request = RestAPI::GET($this->url.$id, $urlParam);
		
		if($request->getStatus() === 404){
			return errorGenerator::display404(sprintf($this->msg404, $id, $name));
		} else if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$package = $response['data'][$this->jsonNode][0];
		return $package;
	}

	/**
	 * Return a list of packages + the counter
	 * 
	 * @param  array a list of urlParameter
	 * @return mixed array with the list packages & the number of results or FALSE if an error occured
	 */
	/*public function getAll($urlParam = array()){
		$request = RestAPI::GET($this->url, $urlParam);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$packages = $response['data'][$this->jsonNode];
		$count = $response['data']['count'];
		return array($packages, $count);
	}*/

	/**
	 * Delete a package
	 * 
	 * @param  integer the id of the package
	 * @return boolean FALSE if an error occured
	 */
	public function delete($id){
		$request = RestAPI::DELETE($this->url.$id);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404){
			return errorGenerator::display400();
		}

		return true;
	}

	/**
	 * Update a package
	 * 
	 * @param  integer the id of the package
	 * @param  array a list of bodyParameter
	 * @return mixed array with the list packages & the number of results or FALSE if an error occured
	 */
	public function update($id, $bodyParameter = array(), $_link_next_failed){
		$request = RestAPI::POST($this->url.$id, array(), $bodyParameter);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400('An error was thrown by our secret back-forge', $_link_next_failed);
		} 

		$response = json_decode($request->getResponse(), true);
		return $response['data'][$this->jsonNode][0];
	}

	/**
	 * Create a package
	 * 
	 * @param  array a list of bodyParameter
	 * @return mixed array with the list packages & the number of results or FALSE if an error occured
	 */
	public function create($bodyParameter = array(), $_link_next_failed){
		$request = RestAPI::PUT($this->url, array(), $bodyParameter);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400('An error was thrown by our secret back-forge', $_link_next_failed);
		} 

		$response = json_decode($request->getResponse(), true);
		return $response['data'][$this->jsonNode][0]; 
	}


	/**
	 * Return all packages by projectId
	 * 
	 * @param  integer the id of the project
	 * @param  string the project name (usefull for the message in case of error)
	 * @param  boolean true if you want filtering on actives packages only
	 * @param  array a list of urlParameter
	 * @return mixed the package or FALSE if an error occured
	 */
	public function getByProjectId($projectId, $projectName, $onlyActive = true){
		$urlParam = array();
		$urlParam['project_id'] = $projectId;
		if($onlyActive) {
			$urlParam['is_active'] = 1;
		}

		$request = RestAPI::GET($this->url, $urlParam);
		
		if($request->getStatus() === 404){
			$msg = 'The project #%d %s doesn\' have any package';
			return errorGenerator::display404(sprintf($msg, $projectId, $projectName));
		} else if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$packages = $response['data'][$this->jsonNode];
		return $packages;
	}
}

?>