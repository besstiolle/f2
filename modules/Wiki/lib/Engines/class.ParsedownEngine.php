<?php


class ParsdownEngines extends Engines{

	public static __construct(){
		return new Parsedown;
	}

	public static function process($text, $prefix, $lang, $engine = 1){

		//Prepare configuration
		$config = cmsms()->GetConfig();
		$text = htmlentities(file_get_contents($config['root_path'].'/modules/Wiki/default.txt'));


		// blocquote
		// $search = array('`\n ?&gt; &gt; &gt; &gt; &gt; &gt; `','`\n ?&gt; &gt; &gt; &gt; &gt; `','`\n ?&gt; &gt; &gt; &gt; `','`\n ?&gt; &gt; &gt; `','`\n ?&gt; &gt; `','`\n ?&gt; `');
		// $replace = array('> > > > > >', '> > > > > ','> > > > ','> > > ','> > ','> ');
		// $text = preg_replace($search, $replace, $text);
		// $search = array('`^ ?&gt; &gt; &gt; &gt; &gt; &gt; `','`^ ?&gt; &gt; &gt; &gt; &gt; `','`^ ?&gt; &gt; &gt; &gt; `','`^ ?&gt; &gt; &gt; `','`^ ?&gt; &gt; `','`^ ?&gt; `');
		// $text = preg_replace($search, $replace, $text);

		//$search = array("# ?(&gt; )?(&gt; )?(&gt; )?(&gt; )?(&gt; )?#msi");  // #2 -> 5 level of quote
		$search = array("# ?(&gt; )?(&gt; )?(&gt; )?(&gt; )?(&gt; )?#msi");  // #2 -> 5 level of quote
		$replace = array('>');
		$text = preg_replace($search, $replace, $text);

		// Process the text : 
		require_once($config['root_path'].'/modules/Wiki/lib/Parsedown/Parsedown.php');
		$parsedown = new Parsedown;
		$text = $parsedown->text($text);

		//Transform smarty tags
		$search = array('{root_url}'); 
		$replace = array($config['root_url']); 
		$text = str_replace($search, $replace, $text);

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
					$version = VersionsService::getOne($page->get('page_id'), $lang->get('lang_id'), 
							null , Version::$STATUS_CURRENT);
				}

				if($page == null || $version == null){
					$cssClass = 'new';
					$title = "Clic to create the page {$match[2]}";
				} else {
					$cssClass = 'follow';
					$title = "";
				}
				$url = RouteMaker::getViewRoute($lang->get('code'), $match[2]);

			}
			//Replace plain text without regex anymore
			$search[] = $match[0];
			$replace[] = "<a class='wikilinks {$cssClass}' title='{$title}' href='{$url}'>{$match[3]}</a>";
		}
		$text = str_replace($search,$replace,$text);
		
		// //Fix inline/bloc <code></code> and <code class='xxx'></code> by decoding HTML entity
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
