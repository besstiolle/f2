<?php

class RouteDispatcher{
	
	private static $wiki;
	private static $id;
	private static $returnid;

	public static init($id, $returnid){
		self::$wiki = ModuleOperations::get_instance()->get_module_instance('Wiki');
		self::$id = $id;
		self::$returnid = $returnid;
	}

	public static function getDispatcher($url){

		$config = cmsms()->GetConfig();
    	$ext = $config["page_extension"]; 
    	if($ext !== ''){
    		$url = str_replace($ext, '', $url);
    	}

		$delim = '/'
		$parts = explode($delim, $url);
		$prefix = '';
		$prefixReady = false;
		$code_iso = null;
		$aliasOrVersion = null;
		$action = null;
		foreach ($parts as $section) {
			if(!$prefixReady){
				$prefix.=$delim;
			} else {
				if(self::$wiki->_getShowCodeIso() && $code_iso == null){
					$code_iso = $section;
				} else if($aliasOrVersion == null){
					$aliasOrVersion = $section;
				} else if($action == null){
					$action = $section;
				} else {
					throw new Exception("Error Processing URL Request : ".$url.$ext, 1);
				}
			}
			if(preg_match(self::$wiki->_getDefaultPrefix(), $prefix)){
				$prefixReady = true;
			}
		}

		//Specific for Version
		if(preg_match('#([a-zA-Z0-9\-\_\:]+)#', $aliasOrVersion) ^ $action == 'preview'){
			throw new Exception("Error Processing 'PREVIEW' URL Request : ".$url.$ext, 1);
		}

		if($code_iso == null){
			$code_iso = self::$wiki->_getDefaultLang();
		}
		if($aliasOrVersion == null){
			$aliasOrVersion = self::$wiki->_getDefaultAlias();
		}
		if($action == null){
			$action = 'default'
		}

		//Specific for sitemap
		if($aliasOrVersion == 'sitemap'){
			$aliasOrVersion = '';
			$action = 'sitemap';
		}

		$params = ['vlang'=> $code_iso];
		if(!empty($aliasOrVersion)){
			if(preg_match('#([a-zA-Z0-9\-\_\:]+)#', $aliasOrVersion)){
				$params['version_id'] = $aliasOrVersion;
			} else {
				$params['palias'] = $aliasOrVersion;
			}
		}
		
		//Run dispatcher
		self::$wiki->RedirectForFrontEnd(self::$id, self::$returnid, $action, $params);
	}
}


?>