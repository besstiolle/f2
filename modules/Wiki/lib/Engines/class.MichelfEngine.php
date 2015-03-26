<?php

require_once(dirname(__FILE__).'/Michelf/Markdown.inc.php');

class MichelfEngine extends Engines{

	public function parsing($text){
		$parser = new Michelf\Markdown();
		$text = $parser->defaultTransform($text);

		return $text;
	}
}
?>
