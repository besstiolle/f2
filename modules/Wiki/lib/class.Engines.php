<?php


class Engines{


	public static $MICHELF = 1;
	public static $MICHELF_EXTRA = 2;
	public static $PARSDOWN = 3;

	protected static $engine;
	protected static $prefix;
	protected static $lang;
	protected static $config;

	public static function initInstance($engineType, $prefix, $lang){

		if(self::$engine != null){
			return;
		}

		if(Engines::$MICHELF == $engineType) {
			include_once(dirname(__FILE__).'/Engines/class.MichelfEngine.php');
			self::$engine = new MichelfEngine($prefix, $lang);
		
		} else if(Engines::$MICHELF_EXTRA == $engineType) {
			include_once(dirname(__FILE__).'/Engines/class.MichelfExtraEngine.php');
			self::$engine = new MichelfExtraEngine($prefix, $lang);
		
		} else if(Engines::$PARSDOWN == $engineType) {
			include_once(dirname(__FILE__).'/Engines/class.ParsedownEngine.php');
			self::$engine = new ParsedownEngine($prefix, $lang);
		} 

	}

	protected function __construct($prefix, $lang){
		self::$prefix = $prefix;
		self::$lang = $lang;
		self::$config = cmsms()->GetConfig();
	}

	public function process($text){
		// $micro = microtime(true);
		// $text = htmlentities(file_get_contents(dirname(__FILE__).'/../default.txt'));
		$text = self::$engine->pre_parsing($text);
		// $micro = microtime(true);
		// for($i = 0; $i < 1000; $i++){
		// 	self::$engine->parsing($text);
		// }
		// echo "<h1>".((microtime(true)-$micro)*1)."</h1>";

		$text = self::$engine->parsing($text);
		$text = self::$engine->post_parsing($text);
		

		return $text;
	}

	protected function pre_parsing($text){
		$text = self::fixBlocQuote($text);
		$text = self::fixSmarty($text);
		$text = self::fixImageUrl($text);

		return $text;
	}

	protected function post_parsing($text){

		$text = self::fixUrlColor($text);
		$text = self::fixCodeBloc($text);

		return $text;
	}

	protected static function fixBlocQuote($text){
		// blocquote
		$search = array('`\n ?&gt; &gt; &gt; &gt; &gt; &gt; `','`\n ?&gt; &gt; &gt; &gt; &gt; `','`\n ?&gt; &gt; &gt; &gt; `','`\n ?&gt; &gt; &gt; `','`\n ?&gt; &gt; `','`\n ?&gt; `');
		$replace = array('> > > > > >', '> > > > > ','> > > > ','> > > ','> > ','> ');
		$text = preg_replace($search, $replace, $text);
		$search = array('`^ ?&gt; &gt; &gt; &gt; &gt; &gt; `','`^ ?&gt; &gt; &gt; &gt; &gt; `','`^ ?&gt; &gt; &gt; &gt; `','`^ ?&gt; &gt; &gt; `','`^ ?&gt; &gt; `','`^ ?&gt; `');
		$text = preg_replace($search, $replace, $text);

		//$search = array("# ?(&gt; )?(&gt; )?(&gt; )?(&gt; )?(&gt; )?#msi");  // #2 -> 5 level of quote
		// $search = array("# ?(&gt; )?(&gt; )?(&gt; )?(&gt; )?(&gt; )?#msi");  // #2 -> 5 level of quote
		// $replace = array('>');
		// $text = preg_replace($search, $replace, $text);
		return $text;
	}

	protected static function fixSmarty($text){
		//Transform smarty tags
		$search = array('{root_url}'); 
		$replace = array(self::$config['root_url']); 
		$text = str_replace($search, $replace, $text);
		return $text;
	}

	protected static function fixImageUrl($text){
		//Transform specific tags
		$search = array('&#33;'); 
		$replace = array('!'); 
		$text = str_replace($search, $replace, $text);
		return $text;
	}


	protected static function fixUrlColor($text){
		$patternS = '`<a ([^<]*)href=[\'\"]([^<]*)[\'\"]>([^<]*)</a>`si';
		preg_match_all( $patternS, $text, $matches, PREG_SET_ORDER);
		$search = array();
		$replace = array();

		foreach($matches as $match) {
			// External link
			if(substr($match[2], 0, 7) == 'http://' 
				|| substr($match[2], 0, 8) == 'https://'){
				$cssClass = 'external';
				$title = "";
				$url = $match[2];
				//$url = 'http://google.fr';
			}else {
				//Internal link
				$page = PagesService::getOneByAlias($match[2]);
				if($page != null){
					$version = VersionsService::getOne($page->get('page_id'), self::$lang->get('lang_id'), 
							null , Version::$STATUS_CURRENT);
				}

				if($page == null || $version == null){
					$cssClass = 'new';
					$title = "Clic to create the page {$match[2]}";
				} else {
					$cssClass = 'follow';
					$title = "";
				}
				$url = RouteMaker::getViewRoute(self::$lang->get('code'), $match[2]);

			}
			//Replace plain text without regex anymore
			$search[] = $match[0];
			$replace[] = "<a class='wikilinks {$cssClass}' title='{$title}' href='{$url}'>{$match[3]}</a>";
		}
		$text = str_replace($search,$replace,$text);
		return $text;
	}


	protected static function fixCodeBloc($text){
		//Fix inline/bloc <code></code> and <code class='xxx'></code> by decoding HTML entity
		$patternS = '`<code(?:[^>]*)>([^<]*)<\/code>`i';
		preg_match_all( $patternS, $text, $matches, PREG_SET_ORDER);
		$search = array();
		$replace = array();
		foreach($matches as $match) {
			$search[] = $match[0];
			$replace[] = html_entity_decode($match[0]);
		}
		$text = str_replace($search,$replace,$text);
		return $text;
	}
}
?>
