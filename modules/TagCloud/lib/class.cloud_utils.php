<?php

class cloud_utils{

	//public static $urlpattern = array('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si', '`((?<!//)(www\.\S+[[:alnum:]]/?))`si'); 
	
	public static $number_pattern = '`^[0-9]*$`';
		
	protected function __construct() {}

	
	public static function is_int($number){		
		return preg_match(cloud_utils::$number_pattern,$number);
	}
	
	/**
	 * return the default configuration
	 *
	 * @return the default configuration
	 *
	 **/
	public static function getDefaultPrefs(){
		$prefs = array();
		$prefs["allowed"] = array();
		$prefs["denied"] =  array('`^.{0,1}$`', 								// string with 0-1 caracters
								'`[^_a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿ]`',  	// string with something not a word 
								'`^[0-9]*$`',  									// string with only number
								'THIS_IS_HOW_TO_DENIED_A_SINGLE_WORD',  		// for example
								'`^THIS_IS_HOW_TO_DENIED_A_WORD_WITH_REGEX_PATTERN$`' // for example
								);
		$prefs["colors"] = array('#A897AC', '#333333','#CC6699','#7ACC00','#DAA520');
		$prefs["min_px"] = 10;
		$prefs["max_px"] = 40;
		$prefs["number"] = 30;

	  return $prefs;
	}
	
	/**
	 * Compare two array on the md5 field
	 *
	 * @param first element
	 * @param second element
	 *
	 * @return 0 if equals, -1 if $a < $b, +1 else.
	 *
	 **/
	public static function sorting($a, $b){
		if ($a['md5'] == $b['md5']) {
			return 0;
		}
		return ($a['md5'] < $b['md5']) ? -1 : 1;
	}
	
	
	/**
	 * a linear function to calculate the fontsize
	 * y = m*x + n
	 * @param int $m factor of the linear function
	 * @param int $n offset of the function
	 * @param int $x value for the function
	 * @return int linear fontsize
	 */
	public static function linear_function($m, $n, $x) {
		return str_replace(",",".",($m * $x + $n));
	}

	/**
	 * a logarithmical function to calculate the fontsize
	 * y = m*log(x) + n
	 * @param int $m factor of the logarithmical function
	 * @param int $n offset of the function
	 * @param int $x value for the function
	 * @return int logarithmical fontsize
	 */
	public static function logarithmical_function($m, $n, $x) {
		return str_replace(",",".",($m * log($x) + $n));
	}
	
	/**
	 * Will return a color picked from an array for a text passed in parameter
	 *
	 * @param $colors an array with colors : #fafafa or rgb(12,255,35) or rgba(12,255,35,0.4)
	 * @param $min_px the min size of the text for the render 
	 * @param $max_px the max size of the text for the render  
	 * @param $val the actual value of the size of the text
	 *
	 * @return the color value picked
	 */
	public static function getColor($colors, $min_px, $max_px, $val){
	   $cpt = count($colors);
	   $delta = $max_px - $min_px;
	   $step = $delta / $cpt;
	   $i = 0;
	   for($j = $min_px+$step; $j <= $max_px; $j+=$step) {
		if($val <= $j) {
			return $colors[$i];
		}
		$i++;
	   }
	}
	
	/**
	 * return pre-precessed values for Log function or for linear function_exists
	 *
	 * @param list of items
	 * @param $min_px the min size of the text for the render 
	 * @param $max_px the max size of the text for the render  
	 * @param boolean isLog. Set to true by default
	 * @return an array : the name of the function, the $m value, the $n value
	 *
	 **/
	public static function getFunction($items, $min_px, $max_px, $isLOG = true){
		//retrieve max_weight and min_weight
		//due to the order of the sql query they are in the first and last item of $index_rows
		$max_weight = $items[0]['count'];
		$min_weight = $items[sizeof($items)-1]['count'];
			
		//parting the range between max and min size by the number of style classes to define a range for each class
		//we have to add a little buffer to the delta otherwise the max tag would be mapped to the (max) border of the range
		//and therefore it would be considered as a new (nonexisting) class 
		$delta_y = $max_px - $min_px;
			
		//prepare fontsize functions
		//logarithmical function
		if($isLOG) {
			//fontsize = m * log(x) + n
			$delta_x = log($max_weight) - log($min_weight);
			// if we got no delta regarding weights we use max fontsize
			if ($delta_x == 0) {
				$m = 0;
				$n = $max_px;
			}
			else {
				$m = $delta_y/$delta_x;
				$n = (log($max_weight)*$min_px - log($min_weight)*$max_px)/$delta_x;
			}
			
			$function = "logarithmical_function";
		}
		//standard: linear function
		else {
			//fontsize = m * row['count'] + n
			$delta_x = $max_weight - $min_weight;
			// if we got no delta regarding weights we use max fontsize
			if ($delta_x == 0) {
				$m = 0;
				$n = $max_px;
			}
			else {
				$m = $delta_y/$delta_x;
				$n = $max_px - $m * $max_weight;
			}

			$function = "linear_function";
		}
		
		return array($function, $m, $n);
	}
	
	public static function getCacheDirname(){
		$config = cmsms()->getConfig();
		$cache_name = $config['root_path']."/tmp/cache/tagcloud";
		if(!is_dir($cache_name) && !mkdir($cache_name, 0755)){
			echo "<h3>[TagCloud] Oups, the directory $cache_name can't be created :(</h3>";
			exit;
		}
		return $cache_name;
	}
	
	public static function clearCache(){
		$dirname = cloud_utils::getCacheDirname();
		
		cloud_utils::rrmdir($dirname);
		/*
		if(!rmdir($dirname)){
			echo "<h3>[TagCloud] Oups, the directory $cache_name can't be deleted :(</h3>";
			exit;
		}*/
	}
	
	public static function rrmdir($dir) {
		if (is_dir($dir)) {
		 $objects = scandir($dir);
		 foreach ($objects as $object) {
		   if ($object != "." && $object != "..") {
			 if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
		   }
		 }
		 reset($objects);
		 rmdir($dir);
		}
	}
	
	function cleanEmptyCellsAndExplodeIt($string) {
		$array = explode(chr(13).chr(10),$string);
		$size = count($array);
		for($i=0; $i < $size; $i++) {
			if(empty($array[$i])){
				unset($array[$i]);
			} 
		}
		return array_values($array);
	}

}


?>