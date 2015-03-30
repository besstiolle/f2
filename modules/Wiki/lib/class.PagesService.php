<?php

if (!function_exists("cmsms")) exit;

class PagesService{

	public static function getOneById($id){
		$example = new OrmExample();
		$example->addCriteria('page_id', OrmTypeCriteria::$EQ, array($id));
		$pages = OrmCore::findByExample(new Page(),$example);
		if(!empty($pages)){
			return $pages[0];
		}
		return null;
	}

	public static function getOneByAlias($alias){
		$example = new OrmExample();
		$example->addCriteria('alias', OrmTypeCriteria::$EQ, array($alias));
		$pages = OrmCore::findByExample(new Page(),$example);
		if(!empty($pages)){
			return $pages[0];
		}
		return null;
	}

	public static function getByAliasLike($alias){
		$example = new OrmExample();
		$example->addCriteria('alias', OrmTypeCriteria::$LIKE, array($alias));
		$pages = OrmCore::findByExample(new Page(),$example);
		return $pages;
	}

	public static function getSiblings($alias){
		$pos = strrpos($alias, ':');
		if($pos === false){
			$lvl = 0;
			$aliasParent = null;
		} else {
			$aliasParent = substr($alias, 0, $pos);
			$lvl = substr_count($alias, ':');
		}


		$example = new OrmExample();
		if($aliasParent != null){
			$example->addCriteria('alias', OrmTypeCriteria::$LIKE, array($aliasParent.'%'));
		}
		$example->addCriteria('lvl', OrmTypeCriteria::$EQ, array($lvl));
		$pages = OrmCore::findByExample(new Page(),$example);

		return $pages;

	}

	public static function getLvl($alias){
		return substr_count($alias, ':');
	}
}