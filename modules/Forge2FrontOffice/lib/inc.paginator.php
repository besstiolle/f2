<?php


if(!isset($page_counter)){
	echo "<h1>Hey IT-man, you forgot to assign page_counter parameter in your action classe (asshole)</h1>";
	exit;
}
if(!isset($page_url)){
	echo "<h1>Hey IT-man, you forgot to assign page_url parameter in your action classe (asshole)</h1>";
	exit;
}

$smarty->addTemplateDir(dirname(__FILE__).'/../templates'); 

// # current page
$page = 1;
if(!empty($params['pagin_page'])) {
	$page = $params['pagin_page'];
}


//Number of element by page
$nbPerPage = 10;
if(!empty($params['pagin_num'])) {
	$nbPerPage = $params['pagin_num'];
}

if($page_counter < $nbPerPage) {
	return;
}

$maxPage = ceil($page_counter / $nbPerPage);

$paginator = array();
$paginator['page'] = $page;
$paginator['nbPerPage'] = $nbPerPage;
if($page == 1){
	$paginator['previous'] = 	array('css'=> 'unavailable','query' => "");
}
if($page == $maxPage){
	$paginator['next'] = 	array('css'=> 'unavailable','query' => "");
}


$pages = array();
$pass = false;
for($i = 1; $i <= $maxPage; $i++){
	
	if($i > 2 && $i + 1 < $page){
		if(!$pass){
			$pass = true;
			$pages[$i] = array('css'=> 'unavailable','query' => "");
		}
		continue;
	}

	if($i < ($maxPage - 1) && $i - 1 > $page){
		if(!$pass){
			$pass = true;
			$pages[$i] = array('css'=> 'unavailable','query' => "");
		}			
		continue;
	}

	$pass = false;

	if($i == $page) {
		$pages[$i] = array('css'=> 'current','query' => "{$page_url}&amp;{$id}pagin_page={$i}&amp;{$id}pagin_num={$nbPerPage}");
	} else {
		$pages[$i] = array('css'=> '','query' => "{$page_url}&amp;{$id}pagin_page={$i}&amp;{$id}pagin_num={$nbPerPage}");
	}

	if($i+1 == $page) {
		$paginator['previous'] = array('css'=> '','query' => "{$page_url}&amp;{$id}pagin_page={$i}&amp;{$id}pagin_num={$nbPerPage}");
	} 
	if($i-1 == $page) {
		$paginator['next'] = array('css'=> '','query' => "{$page_url}&amp;{$id}pagin_page={$i}&amp;{$id}pagin_num={$nbPerPage}");
	}
	
}

$paginator['pages'] = $pages;

$smarty->assign('paginator', $paginator);
