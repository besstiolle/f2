<?php

include_once(dirname(__FILE__).'/Michelf/MarkdownExtra.inc.php');

class MichelfExtraEngine extends Engines{

	public function parsing($text){
		$parser = new Michelf\MarkdownExtra;
		$text = $parser->defaultTransform($text);

		return $text;
	}
}
?>
