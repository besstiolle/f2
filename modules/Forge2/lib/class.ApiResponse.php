<?php

class ApiResponse {

	private $startdt;

	private $params = array();

	private $code; // Something like 200, 401, 403 ...
	private $message; 

	private $content = '';
	
	public function __construct($params){
		$this->startdt = microtime(true);
		$this->params = $this->parseGet($params);

	}

	public function getParams(){
		return $this->params;
	}

	public function setCode($code){
		$this->code = $code;
	}
	public function getCode(){
		return $this->code;
	}

	public function setMessage($message){
		$this->message = $message;
	}
	public function getMessage(){
		return $this->message;
	}

	public function setContent($content){
		$this->content = $content;
	}
	public function getContent(){
		return $this->content;
	}

	public function parseGet($params){
		$sanitized = array();

		$pattern = '#^[a-zA-Z0-9]+$#';
		if(isset($params['user']) && preg_match($pattern, $params['user'])){
			$sanitized['user'] = $params['user'];
		}

		$pattern = '#^[a-zA-Z0-9]+$#';
		if(isset($params['pass']) && preg_match($pattern, $params['pass'])){
			$sanitized['pass'] = $params['pass'];
		}

		$pattern = '#^[a-zA-Z0-9]+$#';
		if(isset($params['token']) && preg_match($pattern, $params['token'])){
			$sanitized['token'] = $params['token'];
		}

		$pattern = '#^[0-9]+$#';
		if(isset($params['projectId']) && preg_match($pattern, $params['projectId'])){
			$sanitized['projectId'] = $params['projectId'];
		}

		$pattern = '#^[a-zA-Z0-9]+$#';
		if(isset($params['projectUnixName']) && preg_match($pattern, $params['projectUnixName'])){
			$sanitized['projectUnixName'] = $params['projectUnixName'];
		}

		return $sanitized;
	}

	public function __toString(){
		header($_SERVER["SERVER_PROTOCOL"]." ".$this->code." ".$this->message); 
		header('Content-Type: application/json');

		$json = array(
					'request' => $this->params, //for debug only
					'server' => array(
								'microtime' => microtime(true) - $this->startdt,
								'code' => $this->code,
								'message' => $this->message,
							),
					'data' => $this->content,
				);

		return json_encode($json);
	}

}