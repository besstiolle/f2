<?php


class errorGenerator{

	private static $forge;

	private static $id;

	private static $returnId;

	private static $root_url;

	public static function init($forge, $id, $returnId, $root_url){
		errorGenerator::$forge = $forge;
		errorGenerator::$id = $id;
		errorGenerator::$returnId = $returnId;
		errorGenerator::$root_url = $root_url;
	}

	/**
	 * Object not found
	 */
	public static function display404($label = 'Object not found', $title = '404 not found', $css = 'warning'){

		$smarty = errorGenerator::$forge->smarty;

		$smarty->assign('title', $title);
		$smarty->assign('label', $label);
		$smarty->assign('css', $css);
		$smarty->assign('closable', false);
		$smarty->assign('quote', 'There are not the droids you\'re looking for');
		$smarty->assign('quoteBy', 'Obi-Wan Kenobi');

		echo $smarty->display('message.tpl');

		include('inc.debug.php');

		return false;
	}

	/**
	 * Error from the backoffice
	 **/
	public static function display400($label = 'An error was thrown by our secret back-forge', $title = '400 Bad Request', $css = 'warning'){

		$smarty = errorGenerator::$forge->smarty;

		$smarty->assign('title', $title);
		$smarty->assign('label', $label);
		$smarty->assign('css', $css);
		$smarty->assign('closable', false);
		$smarty->assign('quote', 'NO Keyboard Detected! Press F1 to Resume');
		$smarty->assign('quoteBy', 'American Megatrends');

		echo $smarty->display('message.tpl');

		include('inc.debug.php');

		return false;
	}

	/**
	 * Authentification error
	 **/
	public static function display401($label, $title = '401 ', $css = 'warning'){

		$smarty = errorGenerator::$forge->smarty;

		$smarty->assign('title', $title);
		$smarty->assign('label', $label);
		$smarty->assign('css', $css);
		$smarty->assign('closable', false);
		$smarty->assign('quote', 'Sorry dave i can\'t let you do that');
		$smarty->assign('quoteBy', 'hal3000');

		echo $smarty->display('message.tpl');

		include('inc.debug.php');

		return false;
	}
}

?>