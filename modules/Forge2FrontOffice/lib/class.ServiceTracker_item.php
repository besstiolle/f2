<?php

/**
 * Will call the API Tracker_item
 */
class ServiceTracker_item {
	
	private $url = 'rest/v1/tracker_item/';

	private $msg404 = 'The tracker item #%d does not exist';

	private $jsonNode = 'tracker_items';

	function __construct(){
		
	}

	/**
	 * Return a tracker_item
	 * 
	 * @param  integer the id of the tracker_item
	 * @param  array a list of urlParameter
	 * @return mixed the tracker_item or FALSE if an error occured
	 */
	public function getOne($id, $urlParam = array()){
		$request = RestAPI::GET($this->url.$id, $urlParam);
		
		if($request->getStatus() === 404){
			return errorGenerator::display404(sprintf($this->msg404, $id));
		} else if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$tracker_item = $response['data'][$this->jsonNode][0];
		return $tracker_item;
	}

	/**
	 * Return a list of tracker_items + the counter
	 * 
	 * @param  array a list of urlParameter
	 * @return mixed array with the list tracker_items & the number of results or FALSE if an error occured
	 */
	/*public function getAll($urlParam = array()){
		$request = RestAPI::GET($this->url, $urlParam);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$tracker_items = $response['data'][$this->jsonNode];
		$count = $response['data']['count'];
		return array($tracker_items, $count);
	}*/

	/**
	 * Delete a tracker_item
	 * 
	 * @param  integer the id of the tracker_item
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
	 * Update a tracker_item
	 * 
	 * @param  integer the id of the tracker_item
	 * @param  array a list of bodyParameter
	 * @return mixed array with the list tracker_items & the number of results or FALSE if an error occured
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
	 * Create a tracker_item
	 * 
	 * @param  array a list of bodyParameter
	 * @return mixed array with the list tracker_items & the number of results or FALSE if an error occured
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
	 * 	
	 * Return list of tracker_items for a projectId with differents filters
	 * 
	 * @param  integer the packageId
	 * @param  string the type of the tracker_item
	 * @param  string the state of the tracker_item
	 * @param  integer the number of element per page
	 * @param  integer the number of the page
	 * @return array with the list tracker_items & the number of results or FALSE if an error occured
	 */
	public function getByProjectIdAndTypeAndState($projectId, $type = null, $state = null, $number = 10, $page = 1){
		$urlParam = array();

		$urlParam['p'] = $page;
		$urlParam['n'] = $number;
		$urlParam['project_id'] = $projectId;
		$urlParam['type'] = $type;
		if($state !== NULL){
			$urlParam['state'] = $state;
		}				

		$request = RestAPI::GET($this->url, $urlParam);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$tracker_items = $response['data'][$this->jsonNode];
		return array($tracker_items, $response['data']['count']);
	}

}

?>