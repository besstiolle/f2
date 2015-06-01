<?php

if (!function_exists("cmsms")) exit;

$config = cmsms()->GetConfig();
$basePath = $config['root_path'].'/modules/Forge2FrontOffice/';


include_once($basePath.'lib/vendor/php-curl-master/Curl.php');
include_once($basePath.'lib/vendor/php-curl-master/Method/Delete.php');
include_once($basePath.'lib/vendor/php-curl-master/Method/Get.php');
include_once($basePath.'lib/vendor/php-curl-master/Method/Head.php');
include_once($basePath.'lib/vendor/php-curl-master/Method/Options.php');
include_once($basePath.'lib/vendor/php-curl-master/Method/Patch.php');
include_once($basePath.'lib/vendor/php-curl-master/Method/Post.php');
include_once($basePath.'lib/vendor/php-curl-master/Method/Put.php');


// Namespace shortcut
use sylouuu\Curl\Method as Curl;


class RestAPI{

	private static $login = '[RestAPI was not initialized]';
	private static $pass = '[RestAPI was not initialized]';
	private static $base_url = '[RestAPI was not initialized]';

	private static $dump = array();

	private static $token = null;
	private static $tokenExpireOn = null;
	private static $tokenIsUnique = null;

	public static function init($login, $pass, $base_url){
		RestAPI::$login = $login;
		RestAPI::$pass = $pass;
		RestAPI::$base_url = $base_url;
	}

	public static function getToken(){

		// if we already have a valid token which is not unique
		if(RestAPI::$token != null && RestAPI::$tokenExpireOn != null && RestAPI::$tokenIsUnique != null 
			&& RestAPI::$tokenIsUnique == FALSE && time() < RestAPI::$tokenExpireOn) {
			return RestAPI::$token;
		} 

		// else we ask a new token
		$request = RestAPI::_GET('rest/v1/token', array(
							'user' => RestAPI::$login, 
							'pass' => RestAPI::$pass 
							));
		if($request->getStatus() !== 200){
			echo "Error during token retriving";
			return;
		}

		$response = json_decode($request->getResponse(), true);
		//Todo : test responseContent (null or other)

		RestAPI::$token = $response['server']['token']['token'];
		RestAPI::$tokenExpireOn = $response['server']['token']['expireOn'];
		RestAPI::$tokenIsUnique = $response['server']['token']['isUnique'];

		return RestAPI::$token;

	}

	public static function GET($route, $paramsUrl = null){
		$token = RestAPI::getToken();
		if($paramsUrl == null){
			$paramsUrl = array();
		}
		$paramsUrl['token'] = $token;
		return RestAPI::_GET($route, $paramsUrl);
	}

	public static function POST($route, $paramsUrl = null, $paramsData = null){
		$token = RestAPI::getToken();
		if($paramsUrl == null){
			$paramsUrl = array();
		}
		$paramsUrl['token'] = $token;
		return RestAPI::_POST($route, $paramsUrl, $paramsData);
	}

	public static function PUT($route, $paramsUrl = null, $paramsData = null){
		$token = RestAPI::getToken();
		if($paramsUrl == null){
			$paramsUrl = array();
		}
		$paramsUrl['token'] = $token;
		return RestAPI::_PUT($route, $paramsUrl, $paramsData);
	}

	public static function DELETE($route, $paramsUrl = null, $paramsData = null){
		$token = RestAPI::getToken();
		if($paramsUrl == null){
			$paramsUrl = array();
		}
		$paramsUrl['token'] = $token;
		return RestAPI::_DELETE($route, $paramsUrl, $paramsData);		
	}


	private static function _GET($route, $paramsUrl = null){

		$start = microtime(true);

		$stringParameters = '';
		if(!empty($paramsUrl)){
			$stringParameters = '?'.http_build_query($paramsUrl);
		}

		$restUrl = RestAPI::$base_url.$route.$stringParameters ;

		//For future debug
		$ref = RestAPI::addEntry(null, 'GET', $restUrl);

		$request = new Curl\Get( $restUrl );
		$request->send();

		$ref = RestAPI::addEntry($ref, 'http_code', $request->getStatus());
		$ref = RestAPI::addEntry($ref, 'time_exec', microtime(true) - $start);

		return $request;
	}

	private static function _POST($route, $paramsUrl = null, $paramsData = null){

		$start = microtime(true);

		$stringParameters = '';
		if(!empty($paramsUrl)){
			$stringParameters = '?'.http_build_query($paramsUrl); 
		}

		$restUrl = RestAPI::$base_url.$route.$stringParameters ;

		//For future debug
		$ref = RestAPI::addEntry(null, 'POST', $restUrl);

		$request = new Curl\POST( $restUrl , ['data' => $paramsData]);
		$request->send();

		$ref = RestAPI::addEntry($ref, 'http_code', $request->getStatus());
		$ref = RestAPI::addEntry($ref, 'time_exec', microtime(true) - $start);

		return $request;
	}

	private static function _PUT($route, $paramsUrl = null, $paramsData = null){

		$start = microtime(true);

		$stringParameters = '';
		if(!empty($paramsUrl)){
			$stringParameters = '?'.http_build_query($paramsUrl); 
		}

		$restUrl = RestAPI::$base_url.$route.$stringParameters ;

		//For future debug
		$ref = RestAPI::addEntry(null, 'PUT', $restUrl);

		$request = new Curl\PUT( $restUrl , ['data' => $paramsData]);
		$request->send();

		$ref = RestAPI::addEntry($ref, 'http_code', $request->getStatus());
		$ref = RestAPI::addEntry($ref, 'time_exec', microtime(true) - $start);
		/*
		
		return $request;*/
	}

	private static function _DELETE($route, $paramsUrl = null, $paramsData = null){

		$start = microtime(true);

		$stringParameters = '';
		if(!empty($paramsUrl)){
			$stringParameters = '?'.http_build_query($paramsUrl); 
		}

		$restUrl = RestAPI::$base_url.$route.$stringParameters ;

		//For future debug
		$ref = RestAPI::addEntry(null, 'DELETE', $restUrl);

		$request = new Curl\DELETE( $restUrl );
		$request->send();/*
		$status = $request->getStatus();
		if($status !== 200){
			throw new Exception("Error Processing DELETE Request on $restUrl with dataParams =
						\n ".print_r($paramsData,true)."
						\ncode returned = ".$status." 
						\n ".print_r(RestAPI::getDump(),true), 1);
		}

		return $request->getResponse();

		$ref = RestAPI::addEntry($ref, 'http_code', $request->getStatus());
		$ref = RestAPI::addEntry($ref, 'time_exec', microtime(true) - $start);
		*/
		return $request;
	}

	public static function getDump(){
		return RestAPI::$dump;
	}

	public static function addEntry($ref = null, $key, $value){
		if($ref === null){
			RestAPI::$dump[] = array();
		}
		$ref = count(RestAPI::$dump) - 1;

		RestAPI::$dump[$ref][$key] = $value;

		return $ref;
	}
}