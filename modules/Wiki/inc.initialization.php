<?php
if (!function_exists('cmsms')) exit;




//Array for errors and messages
$errors = array();
$messages[] = array();
$has_error = false;


//Test basic parameters
if(empty($params['pprefix'])){
	$errors[] = 'prefix_mandatory';
	$has_error = true;
	echo "parameter pprefix not found for initialisation";
	exit;
}
if(empty($params['vlang'])){
	if($this->_getShowCodeIso()){
		$errors[] = 'lang_mandatory';
		$has_error = true;
		echo "parameter vlang not found for initialisation";
		exit;
	} else {
		$params['vlang'] = $this->_getDefaultLang();
	}
}
if(empty($params['palias'])){
	$errors[] = 'alias_mandatory';
	$has_error = true;
	echo "parameter palias not found for initialisation";
	exit;
}

//Smarty vars.
$smarty = cmsms()->GetSmarty();
$smarty->assign('mod', $this);

/**
  Get commons parameters
**/

//Prefix
$prefix  = $params['pprefix'];
RouteMaker::init($id, $returnid, $prefix);

//Page Alias
if(_JS_ACTION_){
	$aliasParam = $this->js_urldecode($params['palias']);
} else {
	$aliasParam = $this->clean_title($params['palias']);
}

//Lang
$langParam = $params['vlang'];


$langs = OrmCore::findAll(new Lang());
$all_langs_by_code = array();
$all_langs_by_id = array();
foreach($langs as $lang){
	$all_langs_by_code[$lang->get("code")] = $lang->getValues();
	$all_langs_by_id[$lang->get("lang_id")] = $lang->getValues();
}

//Get lang db entity, panic only if there is no lang.

/************* LANG ****************/
$lang = LangsService::getOne($langParam);

if($lang == null){
	$errors[] = 'lang_mandatory';
	$url = RouteMaker::getViewRoute($this->_getDefaultLang(), $this->_getDefaultAlias());
	$smarty->assign('errors',$errors);
	$smarty->assign('url',$url);
	echo $this->ProcessTemplate('message.tpl');
	$has_error = TRUE;
	return;
}
$smarty->assign('lang', $lang->getValues());

/************** PAGE *****************/

$page = PagesService::getOneByAlias($prefix, $aliasParam);
if($page == null){
	$page = new Page();
	$page->set('prefix', $prefix);
	$page->set('alias', $aliasParam);
	$page->set('lvl', PagesService::getLvl($aliasParam));
	//We don't create new page in preview mode
	if($params['action'] !== 'preview'){
		$page = $page->save();
	}
}

//Is this the default Lang ? Page & Version
$isDefaultLang = $lang->get('isdefault');
$isDefaultPage = ($this->_getDefaultAlias() == $aliasParam);
$isDefaultVersion = $isDefaultLang && $isDefaultPage;

$smarty->assign('isDefaultLang', $isDefaultLang);
$smarty->assign('isDefaultPage', $isDefaultPage);
$smarty->assign('isDefaultVersion', $isDefaultVersion);
$smarty->assign('showLangs', $this->_getShowCodeIso());
 

// Get preferences
$code_iso = ($this->GetPreference('show_code_iso', true)?$lang->get('code'):"");

//Reset actionid to avoid problems later in templates
$smarty->assign('wiki_action_id', $id);

?>