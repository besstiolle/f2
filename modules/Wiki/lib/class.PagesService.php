<?php

if (!function_exists("cmsms")) exit;

class PagesService{
/*
	public static function getOneById($id){
		$example = new OrmExample();
		$example->addCriteria('page_id', OrmTypeCriteria::$EQ, array($id));
		$pages = OrmCore::findByExample(new Page(),$example);
		if(!empty($pages)){
			return $pages[0];
		}
		return null;
	}*/

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

		$lvl = PagesService::getLvl($alias);

		$pos = strrpos($alias, ':');
		if($pos === false){
			$aliasParent = null;
		} else {
			$aliasParent = substr($alias, 0, $pos);
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