<?php

/**
 * Will call the API Release
 */
class ServiceRelease {
	
	private $url = 'rest/v1/release/';

	private $msg404 = 'The release #%d does not exist';

	private $jsonNode = 'releases';

	function __construct(){
		
	}

	/**
	 * Return a release
	 * 
	 * @param  integer the id of the release
	 * @param  array a list of urlParameter
	 * @return mixed the release or FALSE if an error occured
	 */
	public function getOne($id, $urlParam = array()){
		$request = RestAPI::GET($this->url.$id, $urlParam);
		
		if($request->getStatus() === 404){
			return errorGenerator::display404(sprintf($this->msg404, $id));
		} else if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$release = $response['data'][$this->jsonNode][0];
		return $release;
	}

	/**
	 * Return a list of releases + the counter
	 * 
	 * @param  array a list of urlParameter
	 * @return mixed array with the list releases & the number of results or FALSE if an error occured
	 */
	/*public function getAll($urlParam = array()){
		$request = RestAPI::GET($this->url, $urlParam);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$releases = $response['data'][$this->jsonNode];
		$count = $response['data']['count'];
		return array($releases, $count);
	}*/

	/**
	 * Delete a release
	 * 
	 * @param  integer the id of the release
	 * @return boolean FALSE if an error occured
	 */
	/*public function delete($id){
		$request = RestAPI::DELETE($this->url.$id);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404){
			return errorGenerator::display400();
		}

		return;
	}*/

	/**
	 * Update a release
	 * 
	 * @param  integer the id of the release
	 * @param  array a list of bodyParameter
	 * @return mixed array with the list releases & the number of results or FALSE if an error occured
	 */
	/*public function update($id, $bodyParameter = array(), $_link_next_failed){
		$request = RestAPI::POST($this->url.$id, array(), $bodyParameter);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400('An error was thrown by our secret back-forge', $_link_next_failed);
		} 

		$response = json_decode($request->getResponse(), true);
		return $response['data'][$this->jsonNode]; //FIXME : should return with array
	}*/

	/**
	 * Create a release
	 * 
	 * @param  array a list of bodyParameter
	 * @return mixed array with the list releases & the number of results or FALSE if an error occured
	 */
	/*public function create($bodyParameter = array(), $_link_next_failed){
		$request = RestAPI::PUT($this->url, array(), $bodyParameter);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400('An error was thrown by our secret back-forge', $_link_next_failed);
		} 

		$response = json_decode($request->getResponse(), true);
		return $response['data'][$this->jsonNode]; //FIXME : should return with array
	}*/


	/**
	 * Return last release from a package id
	 * 
	 * @param  integer the packageId
	 * @param  integer the projectId usefull for the message in case of 404
	 * @param  string the the projectName usefull for the message in case of 404
	 * @return mixed the release or FALSE if an error occured
	 */
	public function getByPackageId($packageId, $projectId, $projectName){
		$urlParam = array();
		$urlParam['package_id'] = $packageId;
		$urlParam['n'] = 1;

		$request = RestAPI::GET($this->url, $urlParam);
		
		if($request->getStatus() === 404){
			$msg = 'The package %d of the project #%d %s doesn\' have any release';
			return errorGenerator::display404(sprintf($msg, $id, $projectId, $projectName));
		} else if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$releases = $response['data'][$this->jsonNode];
		return $releases;
	}

	/**
	 * Return older releases from a releaseId
	 * 
	 * @param  integer the releaseId for reference
	 * @param  integer the packageId
	 * @return mixed the older releases or FALSE if an error occured
	 */
	public function getOlderReleasesByPackageId($releaseId, $packageId){
		$urlParam = array();
		$urlParam['showOlder'] = 1;
		$urlParam['sid'] = $releaseId;
		$urlParam['package_id'] = $packageId;
		$urlParam['n'] = 10;
		$urlParam['p'] = 1;

		$request = RestAPI::GET($this->url, $urlParam);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$releases = $response['data'][$this->jsonNode];
		return $releases;
	}
}

?>