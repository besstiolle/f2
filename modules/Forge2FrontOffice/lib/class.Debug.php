<?php

if (!function_exists("cmsms")) exit;

/*
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
use sylouuu\Curl\Method as Curl;*/

class Debug{

	private static $instance;

	private $filename;
	private $key;
	private $alreadyPublished = false;

	private function __constructor(){}

	public static function getInstance(){
		if(Debug::$instance == null){
			$config = cmsms()->GetConfig();
			$debug = new Debug();	
			$debug->key = md5(rand().time());
			$debug->filename = $config['root_path'].'/tmp/cache/rest_debug_'.$debug->key.'.php';
			Debug::$instance = $debug;
		}

		return Debug::$instance;
	}

	public function saveDump($dump){
		$serialized = serialize($dump);
		$content = <<<PHP
<?php
if (!function_exists("cmsms")) exit;
\$dump = <<<'DATA'
$serialized;
DATA;

?>
PHP;
		file_put_contents($this->filename, $content);
	}

	public function getTag(){
		if($this->alreadyPublished){
			return false;
		}
		$config = cmsms()->GetConfig();
		$this->alreadyPublished = true;
		$tag = array(
			'url' => $config['root_url'].'/debug/'.$this->key
			);
		return $tag;
	}

	public static function load($key){
		$config = cmsms()->GetConfig();
		$filename = $config['root_path'].'/tmp/cache/rest_debug_'.$key.'.php';
		if(file_exists($filename)){
			include $filename;
			return unserialize($dump);
		} else {
			return null;
		}
		
	}
}