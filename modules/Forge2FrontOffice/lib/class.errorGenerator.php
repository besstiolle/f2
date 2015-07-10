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
	 * 
	 * @param  string the label of the message
	 * @param  string the "next" url. NULL won't display a button
	 * @param  string the title of the page
	 * @param  string the foundation css class
	 * @return boolean FALSE
	 **/
	public static function display404($label = 'Object not found', $next = null, $title = '404 not found', $css = 'warning'){

		$smarty = errorGenerator::$forge->smarty;

		$smarty->assign('title', $title);
		$smarty->assign('label', $label);
		$smarty->assign('css', $css);
		$smarty->assign('closable', false);
		$smarty->assign('quote', 'There are not the droids you\'re looking for');
		$smarty->assign('quoteBy', 'Obi-Wan Kenobi');
		$smarty->assign('next', $next);

		echo $smarty->display('message.tpl');

		include('inc.debug.php');

		return false;
	}

	/**
	 * Error from the backoffice
	 * 
	 * @param  string the label of the message
	 * @param  string the "next" url. NULL won't display a button
	 * @param  string the title of the page
	 * @param  string the foundation css class
	 * @return boolean FALSE
	 **/
	public static function display400($label = 'An error was thrown by our secret back-forge', $next = null, $title = '400 Bad Request', $css = 'warning'){

		$smarty = errorGenerator::$forge->smarty;

		$smarty->assign('title', $title);
		$smarty->assign('label', $label);
		$smarty->assign('css', $css);
		$smarty->assign('closable', false);
		$smarty->assign('quote', 'NO Keyboard Detected! Press F1 to Resume');
		$smarty->assign('quoteBy', 'American Megatrends');
		$smarty->assign('next', $next);

		echo $smarty->display('message.tpl');

		include('inc.debug.php');

		return false;
	}

	/**
	 * Authentification error
	 * 
	 * @param  string the label of the message
	 * @param  string the "next" url. NULL won't display a button
	 * @param  string the title of the page
	 * @param  string the foundation css class
	 * @return boolean FALSE
	 **/
	public static function display403($label='You don\'t have the right to do that action', $next = null, $title = '403 Forbidden', $css = 'warning'){

		$smarty = errorGenerator::$forge->smarty;

		$smarty->assign('title', $title);
		$smarty->assign('label', $label);
		$smarty->assign('css', $css);
		$smarty->assign('closable', false);
		$smarty->assign('quote', 'Sorry dave i can\'t let you do that');
		$smarty->assign('quoteBy', 'hal3000');
		$smarty->assign('next', $next);

		echo $smarty->display('message.tpl');

		include('inc.debug.php');

		return false;
	}

	/**
	 * Error from the frontoffice
	 * 
	 * @param  string the label of the message
	 * @param  string the "next" url. NULL won't display a button
	 * @param  string the title of the page
	 * @param  string the foundation css class
	 * @return boolean FALSE
	 **/
	public static function display500($label = 'An error was thrown', $next = null, $title = '500 Internal Server Error', $css = 'alert'){

		$smarty = errorGenerator::$forge->smarty;

		$smarty->assign('title', $title);
		$smarty->assign('label', $label);
		$smarty->assign('css', $css);
		$smarty->assign('closable', false);
		$smarty->assign('quote', 'NO Keyboard Detected! Press F1 to Resume');
		$smarty->assign('quoteBy', 'American Megatrends');
		$smarty->assign('next', $next);

		echo $smarty->display('message.tpl');

		include('inc.debug.php');

		return false;
	}

	/**
	 * Message of information
	 * 
	 * @param  string the label of the message
	 * @param  string the "next" url. NULL won't display a button
	 * @param  string the title of the page
	 * @param  string the foundation css class
	 * @return boolean FALSE
	 **/
	public static function display200($label = 'The operation is a success', $next = null, $title = 'Success', $css = 'success'){

		$smarty = errorGenerator::$forge->smarty;

		$smarty->assign('title', $title);
		$smarty->assign('label', $label);
		$smarty->assign('css', $css);
		$smarty->assign('closable', false);
		$smarty->assign('quote', 'This was a triumph.<br/>
								I’m making a note here: HUGE SUCCESS.<br/>
								It’s hard to overstate my satisfaction.<br/>
								Aperture Science<br/>
								We do what we must<br/>
								because we can.<br/>
								For the good of all of us.<br/>
								Except the ones who are dead.');
		$smarty->assign('quoteBy', 'GLaDOS');
		$smarty->assign('next', $next);

		echo $smarty->display('message.tpl');

		include('inc.debug.php');

		return false;
	}
}

?>