<?php

/**
 * Will call the API Comment
 */
class ServiceComment {
	
	private $url = 'rest/v1/comment/';

	private $msg404 = 'The comment #%d does not exist';

	private $jsonNode = 'comments';

	function __construct(){
		
	}

	/**
	 * Return a comment
	 * 
	 * @param  integer the id of the comment
	 * @param  array a list of urlParameter
	 * @return mixed the comment or FALSE if an error occured
	 */
	/*public function getOne($id, $urlParam = array()){
		$request = RestAPI::GET($this->url.$id, $urlParam);
		
		if($request->getStatus() === 404){
			return errorGenerator::display404(sprintf($this->msg404, $id));
		} else if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$comment = $response['data'][$this->jsonNode][0];
		return $comment;
	}*/

	/**
	 * Return a list of comments + the counter
	 * 
	 * @param  array a list of urlParameter
	 * @return mixed array with the list comments & the number of results or FALSE if an error occured
	 */
	/*public function getAll($urlParam = array()){
		$request = RestAPI::GET($this->url, $urlParam);
		
		if($request->getStatus() !== 200){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$comments = $response['data'][$this->jsonNode];
		$count = $response['data']['count'];
		return array($comments, $count);
	}*/

	/**
	 * Delete a comment
	 * 
	 * @param  integer the id of the comment
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
	 * Update a comment
	 * 
	 * @param  integer the id of the comment
	 * @param  array a list of bodyParameter
	 * @return mixed array with the list comments & the number of results or FALSE if an error occured
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
	 * Create a comment
	 * 
	 * @param  array a list of bodyParameter
	 * @return mixed array with the list comments & the number of results or FALSE if an error occured
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
	 * Return list of comments for a tracker_itemId
	 * 
	 * @param  integer the tracker_itemId
	 * @return array with the list comments or FALSE if an error occured
	 */
	public function getByTrackerId($tracker_itemId){
		$urlParam = array();

		$urlParam['commentable_id'] = $tracker_itemId;

		$request = RestAPI::GET($this->url, $urlParam);
		
		if($request->getStatus() !== 200 && $request->getStatus() !== 404){
			return errorGenerator::display400();
		} 

		$response = json_decode($request->getResponse(), true);
		$comments = $response['data'][$this->jsonNode];
		return $comments;
	}

}

?>