<?php

if (!function_exists("cmsms")) exit;


$debug = Debug::getInstance();
$dump = $debug->load($params['debugId']);
$cpt = count($dump);
for($i = 0 ; $i < $cpt; $i++) {
	$request = $dump[$i]['request'];
	$json = $request->getResponse();
	$dump[$i]['json_object'] = json_decode($json, true);

	$json = preg_replace('#([\[\{,])#','$0|||', $json);
	$json = preg_replace('#([\]\}])#','|||$0|||', $json);
	$json = preg_replace('#:([\[\{\]\}])#',': $1', $json);
	$json = preg_replace('#\}\|\|\|\,#','} ,', $json);
	$json = preg_replace('#\"([a-zA-Z0-9_]*)\"\:#','"<span class="json_key">$1</span>" : ', $json);
	$json = preg_replace('#\: \"([\w\ \.\:\\\/\-\&\;\\n\\r\(\)\#]*)\"#',': "<span class="json_val">$1</span>"', $json);
	$json = preg_replace('#\: ([0-9\.]+)#',': <span class="json_valnum">$1</span>', $json);
	$json = preg_replace('#\: (null)#',': <span class="json_null">null</span>', $json);
	$json_exploded = explode("|||", $json);
	$json_exploded = parseJsonExploded($json_exploded);
	$dump[$i]['json_exploded'] = $json_exploded;

	$url = $dump[$i]['GET'];
	$tmp = explode('?', $url);
	//$url = explode($tmp[0];
	$arr = array('base' => $tmp[0], 'key' => array());
	if(isset($tmp[1])){
		$tmp = explode('&',$tmp[1]);
		foreach ($tmp as $part) {
			$subpart = explode('=',$part);
			if(isset($subpart[1])){
				$arr['key'][$subpart[0]] = $subpart[1];	
			} else {
				$arr['key'][$subpart[0]] = "NOT DEFINED";	
			}
			
		}
	}
	$dump[$i]['route_exploded'] = $arr;
}
$smarty->assign('dump',$dump);
$smarty->assign('title',"Debug the Rest Stack.");
echo $this->processTemplate('vardump.tpl');


function parseJsonExploded($json_exploded){
	$lvl = 0;
	$output = '';

	foreach ($json_exploded as $line) {
		if(endswith($line,'}') || endswith($line,']')  || endswith($line,'} ,') || endswith($line,'] ,')){
			$lvl--;
		}
		$trim = trim($line);
		if(!empty($trim)){
			$output .= '<div class="json_line">'.pad($lvl).$line.'</div>';
		}
		if(endswith($line,'{') || endswith($line,'[') ){
			$lvl++;
		}
	}
	return $output;
}

function pad($nb){
	if($nb==0){
		return "";
	}
	return str_repeat('<span class="json_space"></span>', $nb);
}