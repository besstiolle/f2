<?php

if (!isset($gCms)) exit;
if (!$this->CheckPermission('Manage Download Counters')) exit;

/*************************
	Start Fourth Header
**************************/
$query = 'SELECT min(down_date) as mi, max(down_date) as ma FROM ' . cms_db_prefix() . 'module_downcnt_stat';
$dbresult = $db->Execute($query);
if ($dbresult === false)
{
   echo "<h2>error during request min/max : ".$db->ErrorMsg().'</h2>';
   exit;
}

$rows = $dbresult->Getarray();
$date_min = strtotime(substr($rows[0]['mi'],0,10));
$date_max = strtotime(substr($rows[0]['ma'],0,10));

	
$this->smarty->assign('date_min', $date_min);
$this->smarty->assign('date_max', $date_max);

$query = 'SELECT id, name FROM ' . cms_db_prefix() . 'module_downcnt';
$dbresult = $db->Execute($query);
if ($dbresult === false)
{
   echo "<h2>error during request distinct name : ".$db->ErrorMsg().'</h2>';
   exit;
}

$counters = $dbresult->Getarray();
$this->smarty->assign('ul_counters', $counters);

$query = 'SELECT distinct master FROM ' . cms_db_prefix() . 'module_downcnt_master';
$dbresult = $db->Execute($query);
if ($dbresult === false)
{
   echo "<h2>error during request distinct master : ".$db->ErrorMsg().'</h2>';
   exit;
}

$masters = $dbresult->Getarray();
$this->smarty->assign('ul_masters', $masters);
$this->smarty->assign('root_url', $config["root_url"]);



$this->smarty->assign('title_1', $this->Lang('title_1'));
$this->smarty->assign('title_2', $this->Lang('title_2'));
$this->smarty->assign('title_3', $this->Lang('title_3'));
$this->smarty->assign('title_4', $this->Lang('title_4'));
$this->smarty->assign('title_5', $this->Lang('title_5'));
$this->smarty->assign('generate', $this->Lang('generate'));


$this->smarty->assign('chart_line', $this->Lang('chart_line'));
$this->smarty->assign('chart_area', $this->Lang('chart_area'));
$this->smarty->assign('chart_pie', $this->Lang('chart_pie'));
$this->smarty->assign('chart_from', $this->Lang('chart_from'));
$this->smarty->assign('chart_from', $this->Lang('chart_from'));
$this->smarty->assign('chart_to', $this->Lang('chart_to'));
$this->smarty->assign('chart_noEnd', $this->Lang('chart_noEnd'));
$this->smarty->assign('chart_bot', $this->Lang('chart_bot'));
$this->smarty->assign('chart_day', $this->Lang('chart_day'));
$this->smarty->assign('chart_week', $this->Lang('chart_week'));
$this->smarty->assign('chart_month', $this->Lang('chart_month'));
$this->smarty->assign('chart_year', $this->Lang('chart_year'));
$this->smarty->assign('chart_24', $this->Lang('chart_24'));
$this->smarty->assign('chart_7', $this->Lang('chart_7'));
$this->smarty->assign('chart_bytag', $this->Lang('chart_bytag'));
$this->smarty->assign('chart_bytagD', $this->Lang('chart_bytagD'));
$this->smarty->assign('chart_bycounter', $this->Lang('chart_bycounter'));


/*************************
	END Fourth Header
**************************/

?>
