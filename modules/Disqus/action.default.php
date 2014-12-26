<?php
if (!function_exists('cmsms')) exit;


$d_shortname = $this->GetPreference('d_shortname','');
if(empty($d_shortname)){
	echo $this->ShowErrors($this->Lang('shortname_null'));
	return;
}

$isPreviewBlocked = false;
if($this->GetPreference('isPreviewBlocked',0) == 0){
	//Are we in "preview" mode ?
	$prevs = array('_preview_', '__CMS_PREVIEW_PAGE__');
	foreach($prevs as $prev){
	  if(strpos($_SERVER['REQUEST_URI'], $prev) !== FALSE){
		$isPreviewBlocked = true;
		break;
	  }
	}
}

$smarty = cmsms()->GetSmarty();
$smarty->assign('d_shortname', $d_shortname);
$smarty->assign('isPreviewBlocked', $isPreviewBlocked);

if(!empty($params['disqus_identifier'])) {$smarty->assign('disqus_identifier', $params['disqus_identifier']);}
if(!empty($params['disqus_url'])) {$smarty->assign('disqus_url', $params['disqus_url']);}
if(!empty($params['disqus_title'])) {$smarty->assign('disqus_title', $params['disqus_title']);}
if(!empty($params['disqus_category_id'])) {$smarty->assign('disqus_category_id', $params['disqus_category_id']);}


echo $this->ProcessTemplate('comment.tpl');

?>