<?php


class WikiUtils{

	/**
	 * Will colorize links for the wiki
	 *
	 * @param string $text the text
	 * @param string $code_iso the code iso of the lang
	 *
	 * @return string with link colorized
	 **/
	static function colorizeLinks($text, $code_iso){
		$patternS = '`<a ([^<]*)href=[\'\"]([^<]*)[\'\"]>([^<]*)</a>`si';
		preg_match_all( $patternS, $text, $matches, PREG_SET_ORDER);
		$search = array();
		$replace = array();
		//print_r($matches);
		foreach($matches as $match) {
			// External link
			if(substr($match[2], 0, 7)== 'http://' 
				|| substr($match[2], 0, 8)== 'https://'){
				$cssClass = 'external';
				$title = "";
				$url = $match[2];
			}else {
				//Internal link
				$example = new OrmExample();
				$example->addCriteria('title', OrmTypeCriteria::$EQ, array($match[2]));
				$example->addCriteria('status', OrmTypeCriteria::$EQ, array(Version::$STATUS_CURRENT));
				$versions = OrmCore::findByExample(new Version(),$example);
				if(count($versions) == 0){
					$cssClass = 'new';
					$title = "Clic to create the page {$match[2]}";
				} else {
					$cssClass = 'follow';
					$title = "";
				}
				$url = RouteMaker::getViewRoute($code_iso, $match[2]);
			}
			//Replace plain text without regex anymore
			$search[] = $match[0];
			$replace[] = "<a class='wikilinks {$cssClass}' title='{$title}' href='{$url}'>{$match[3]}</a>";
		}
		$text = str_replace($search,$replace,$text);

		return $text;
	}

	/**
	 * Will parse the brut text, will call a external Markdown parser and will colorize links for the wiki
	 *
	 * @param string $text the text
	 * @param string $code_iso the code iso of the lang
	 *
	 * @return string the text ready for the wiki
	 **/
	static function parseText($text, $code_iso){
		$markdown = ModuleOperations::get_instance()->get_module_instance('Parser')->GetParserInstance();
		
		$text = html_entity_decode($text, ENT_QUOTES);

		$text = $markdown->process($text);

		$text = WikiUtils::colorizeLinks($text, $code_iso);

		return $text;
	}

}