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
			$debug->filename = $config['root_path'].'/tmp/cache/rest_debug_'.md5(rand().time()).'.php';
			Debug::$instance = $debug;
		}

		return Debug::$instance;
	}

	public function saveDump($dump){
		$serialized = serialize($dump);
		$content = <<<PHP

<?php

if (!function_exists("cmsms")) exit;
\$dump = <<<DATA
$serialized;
DATA;

?>


PHP;
		file_put_contents($this->filename, $content);
	}

	public function publish(){
		if(!$this->alreadyPublished){
			$this->alreadyPublished = true;

		}
	}
}