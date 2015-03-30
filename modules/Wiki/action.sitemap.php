<?php
if (!function_exists('cmsms')) exit;

define('_JS_ACTION_',FALSE);

//Default values in view class in case of {Wiki} 
if(empty($params['palias'])) {
	$params['palias'] = $this->_getDefaultAlias();
}
if(empty($params['vlang'])) {
	$params['vlang'] = $this->_getDefaultLang();
}

//Common initialization
include_once('inc.initialization.php');

if($has_error){return;}


/* Variables available :
 *
 * $errors & $messages
 * $smarty
 * $aliasParam & $langParam
 * $page & $lang
 * $prefix from preferences prefix
 * $code_iso with preferences show_code_iso
 * $engine
 * $all_langs_by_code && $all_langs_by_id
 * $isDefaultLang $isDefaultPage $isDefaultVersion
 *
 **/

$entries = VersionsService::getAll(
		null, 
		$lang->get('lang_id'),
		null,
		Version::$STATUS_CURRENT);

$sitemap = array();
foreach ($entries as $entry) {
	$alias = $entry->get('page')->get('alias');
	$exploded = explode(':', $alias);


	$sub = &$sitemap;
	for ($i = 0; $i < count($exploded); $i++) {

		$part = $exploded[$i];

		if(!isset($sub[$part])) {
			$sub[$part] = array(
				'label' => $part,
				'children' => array(),
				);

			if($i+1 == count($exploded)){
				//$sub[$exploded[$i]]['label'] = $entry->get('title');
			}

		} else {
			//$sub[$exploded[$i]]['label'] = $entry->get('title');
		}
		$sub = &$sitemap[$exploded[$i]]['children'];

	}
}

print_r($sitemap);


$smarty->assign('root_wiki_url', RouteMaker::getRootRoute($langParam));


//Menu
//include_once('inc.menu.php');
//Menu siblings
//include_once('inc.menuSiblings.php');
//SubPage
//include_once('inc.childrens.php');
//Include langs
//include_once('inc.langs.php');
//Include last 10 versions
//include_once('inc.last10versions.php');
//Breadcrumbs
//include_once('inc.breadcrumbs.php');
//Display
//include_once('inc.sitemap.php');


?>