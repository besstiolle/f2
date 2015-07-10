<?php

/**
 * Will call the API Project
 */
class ServiceProject {
	
	private $url = 'rest/v1/project/';

	private $msg404 = 'The project #%d %s does not exist';

	private $jsonNode = 'projects';

	function __construct(){
		
	}

	/**
	 * Return a project
	 * 
	 * @param  integer the id of the project
	 * @param  string a name (usefull for the message in case of error)
	 * @param  array a list of urlParameter
	 * @return mixed the project or FALSE if an error occured
	 */
	public function getOne($id, $name = '', $urlParam = array()){
		$request = RestAPI::GET($this->url.$id, $urlParam);
		
		if($request->getStatus() === 404){
			return errorGenerator::display404(sprintf($this->msg404, $id, $name));
		} else if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$project = $response['data'][$this->jsonNode][0];
		return $project;
	}

	/**
	 * Return a list of projects + the counter
	 * 
	 * @param  array a list of urlParameter
	 * @return mixed array with the list projects & the number of results or FALSE if an error occured
	 */
	public function getAll($urlParam = array()){
		$request = RestAPI::GET($this->url, $urlParam);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$projects = $response['data'][$this->jsonNode];
		$count = $response['data']['count'];
		return array($projects, $count);
	}

	/**
	 * Delete a project
	 * 
	 * @param  integer the id of the project
	 * @return boolean FALSE if an error occured
	 */
	public function delete($id){
		$request = RestAPI::DELETE($this->url.$id);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404){
			return errorGenerator::display400();
		}

		return;
	}

	/**
	 * Update a project
	 * 
	 * @param  integer the id of the project
	 * @param  array a list of bodyParameter
	 * @return mixed array with the list projects & the number of results or FALSE if an error occured
	 */
	public function update($id, $bodyParameter = array(), $_link_next_failed){
		$request = RestAPI::POST($this->url.$id, array(), $bodyParameter);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400('An error was thrown by our secret back-forge', $_link_next_failed);
		} 

		$response = json_decode($request->getResponse(), true);
		return $response['data'][$this->jsonNode]; //FIXME : should return with array
	}

	/**
	 * Create a project
	 * 
	 * @param  array a list of bodyParameter
	 * @return mixed array with the list projects & the number of results or FALSE if an error occured
	 */
	public function create($bodyParameter = array(), $_link_next_failed){
		$request = RestAPI::PUT($this->url, array(), $bodyParameter);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400('An error was thrown by our secret back-forge', $_link_next_failed);
		} 

		$response = json_decode($request->getResponse(), true);
		return $response['data'][$this->jsonNode]; //FIXME : should return with array
	}
}

?>