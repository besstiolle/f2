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

	private static $login = 'root';
	private static $pass = 'pass';
	private static $base_url = 'http://localhost/forge2/';

	private static $dump = array();

	private static $token = null;
	private static $tokenExpireOn = null;
	private static $tokenIsUnique = null;

	public static function getToken(){

		// if we already have a valid token which is not unique
		if(RestAPI::$token != null && RestAPI::$tokenExpireOn != null && RestAPI::$tokenIsUnique != null 
			&& RestAPI::$tokenIsUnique == FALSE && time() < RestAPI::$tokenExpireOn) {
			return RestAPI::$token;
		} 

		// else we ask a new token
		$json = RestAPI::_GET('rest/v1/token', array(
							'user' => RestAPI::$login, 
							'pass' => RestAPI::$pass 
							));

		$responseContent = json_decode($json, true);
		//Todo : test responseContent (null or other)

		RestAPI::$token = $responseContent['server']['token']['token'];
		RestAPI::$tokenExpireOn = $responseContent['server']['token']['expireOn'];
		RestAPI::$tokenIsUnique = $responseContent['server']['token']['isUnique'];

		return RestAPI::$token;

	}

	public static function GET($route, $params = null){
		$token = RestAPI::getToken();
		$params['token'] = $token;
		return RestAPI::_GET($route, $params);
	}

	private static function _GET($route, $params = null){

		$stringParameters = '';
		if(!empty($params)){
			$stringParameters = '?'.http_build_query($params);
		}

		$restUrl = RestAPI::$base_url.$route.$stringParameters ;

		//For future debug
		RestAPI::$dump[] = $restUrl;

		$request = new Curl\Get( $restUrl );
		$request->send();
		$status = $request->getStatus();
		if($status !== 200){
			throw new Exception("Error Processing Request on $restUrl\ncode returned = ".$status." \n ".print_r(RestAPI::getDump(),true), 1);
		}

		return $request->getResponse();
	}

	public static function getDump(){
		return RestAPI::$dump;
	}

}