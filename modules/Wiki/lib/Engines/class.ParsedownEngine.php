<?php

include_once(dirname(__FILE__).'/Parsedown/Parsedown.php');

class ParsedownEngine extends Engines{

	public function parsing($text){
		$parser = new Parsedown;
		$text = $parser->text($text);

		return $text;
	}
}
?>
