<?php

if (!function_exists('cmsms')) exit;

$time = microtime();
$start = explode(" ",$time);

//Get Current configuration
$prefs = unserialize($this->GetPreference("prefs"));

$allowed = $prefs["allowed"];
$denied = $prefs["denied"];
$colors = $prefs["colors"];
$min_px = $prefs["min_px"];
$max_px = $prefs["max_px"];
$number = $prefs["number"];
$myReturnId = cmsms()->GetContentOperations()->GetDefaultPageID();
$isLog = true;

$template = !empty($params['template'])?TC_TMPL_PREFIX_DISPLAY.$params['template']:TC_TMPL_PREFIX_DISPLAY.$this->GetPreference(TC_DEFAULT_DISPLAY_TMPL_PREF_NAME);

//Override parameters
if(!empty($params['number']) && cloud_utils::is_int($params['number'])){
	$number = $params['number'];
}

if(!empty($params['resultpage'])){
	if(cloud_utils::is_int($params['resultpage'])){
		$myReturnId = $params['resultpage'];
	} else{
		$myReturnId = cmsms()->GetContentOperations()->GetPageIDFromAlias($params['resultpage']);
	}
}

if(!empty($params['algo']) && $params['algo'] == 'linear'){
	$isLog = false;
}

$cache_id = $this->GetName().md5(serialize($params));
$dirname = cloud_utils::getCacheDirname();

if(file_exists($dirname.'/'.$cache_id)){
	$items = unserialize(file_get_contents($dirname.'/'.$cache_id));
} else {

	// Construct the condition with all regex
		$condition ='';
		foreach($denied as $word){
		  
		  if($condition =='') {
			$condition .= ' ( ';
		  } else {
			$condition .= ' AND ';
		  }
		  
		  if(substr($word, 0, 1) == '`'){
			$condition .= ' ind.word NOT REGEXP "'.str_replace('`', '', $word).'" ';
		  } else {
			$condition .= ' ind.word != "'.$word.'" ';
		  }
		}
		if(count($denied) > 0){
		  $condition .= ' ) ';
		}


		if(count($allowed) > 0){
		  $condition = ' ( '.$condition;
		}
		foreach($allowed as $word){  
		  if(substr($word, 0, 1) == '`'){
			$condition .= ' OR ind.word REGEXP "'.str_replace('`', '', $word).'" ';
		  } else {
			$condition .= ' OR ind.word = "'.$word.'" ';
		  }
		}
		if(count($allowed) > 0){
		  $condition .= ' ) ';
		}
		if($condition != '') {
		  $condition = ' AND ' . $condition;
		}
	// END condition



	$query = '
	SELECT ind.word, sum(ind.count) as cpt
	FROM '.cms_db_prefix().'module_search_index ind, '.cms_db_prefix().'module_search_items it
	WHERE (it.extra_attr = "article" OR it.extra_attr = "content")
	AND it.id = ind.item_id '.$condition.' 
	AND ( it.expires IS NULL OR it.expires > NOW()) 
	GROUP by ind.word
	ORDER by cpt DESC
	LIMIT 0 , '.$number.'
	';

	//echo $query;

	$db = cmsms()->GetDb();
	$result = $db->execute($query);
	$items = array();
	if($result === FALSE){
		echo "ERROR SQL, check your regex pattern";
		return;
	}
	while($row=$result->FetchRow()){
		$line = array('word'=>$row['word'], 'count'=>$row['cpt']);
		$items[] = $line;
	}
	

	list($function, $m, $n) = cloud_utils::getFunction($items, $min_px, $max_px, $isLog);

	//Second processing to calculate the CSS size
	for($i = 0; $i < count($items); $i++) {
		$items[$i]['size'] = cloud_utils::$function($m, $n, $items[$i]['count']);
		$items[$i]['color'] = cloud_utils::getColor($colors, $min_px, $max_px, $items[$i]['size']);
		$items[$i]['md5'] = md5($items[$i]['size'].$items[$i]['count'].$items[$i]['word']);
	}

	usort($items, "cloud_utils::sorting"); 

	if(FALSE === file_put_contents($dirname.'/'.$cache_id, serialize($items))){
		echo "<h3>[TagCloud] Oups, the cache file $dirname.'/'.$cache_id can't be created :(</h3>";
		exit;
	}
}

$smarty = cmsms()->GetSmarty();
$smarty->assign('items', $items);
$smarty->assign('returnid', $myReturnId);
echo $this->ProcessTemplateFromDatabase($template);

//runtime
$time = microtime();
$stop = explode(" ",$time);
$diff = ($stop[1]-$start[1])+($stop[0]-$start[0]);
//echo "<strong>".$diff." seconds runtime</strong><br>\n";

?>