<?php
$timestart=microtime(true);

$LIMIT_HIGH = 10;


if (!isset($gCms))
	require_once dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))) . DIRECTORY_SEPARATOR . 'include.php';

$smarty = cmsms()->GetSmarty();

/**
 * does a date ('2001-01-31') is valid ?
 **/
function is_validDate($date) {
	$vals = explode('-', $date);
	return checkdate($vals[1],$vals[2],$vals[0]);
} 
/**
 * Get the first day ('2001-01-31') of the week with its millisecond
 **/
function getBeginOfWeekInMilli($date) {
	$variable = 0; //on reste à dimanche = premier jour de la semaine

	$ecart = date('w',strtotime($date)) ;

	if($ecart != 0) {
		return strtotime($date . " -".($ecart + $variable)." day");
	} 
	return strtotime($date);
}
function getValue($value, $day_month){
	$val = null;
	if($day_month == 1){	
		$val = substr($value, 11, 2); //Hour of the line
		if(substr($val,0,1) == 0) {
			$val = substr($val, 1, 1);
		}
	}else if($day_month == 2){	
		$val = substr($value, 0, 10); //Date YYYY-MM-DD
	}else if($day_month == 3){	
		$val = date('Y-m-d',getBeginOfWeekInMilli($value)); //Date YYYY-MM-DD set to monday of the week
	}else if($day_month == 4){	
		$val = substr($value, 0, 7); //Date YYYY-MM
	}else if($day_month == 5){	
		$val = substr($value, 0, 4); //Date YYYY
	} else if($day_month == 6){
		$val = date('w',strtotime($value)); //Day of week (0->6)
	}
	return $val;
}
	
	
$modops = cmsms()->GetModuleOperations();
$module = $modops->get_module_instance('DownCnt');

$clic_useragent = !empty($_GET['clic_useragent'])?$_GET['clic_useragent']:1;
$datemin = !empty($_GET['datemin'])?$_GET['datemin']:null;
$datemax = !empty($_GET['datemax'])?$_GET['datemax']:null;
$day_month = !empty($_GET['day_month'])?$_GET['day_month']:1;
$chart = !empty($_GET['chart'])?$_GET['chart']:1;
$by = !empty($_GET['by'])?$_GET['by']:1;
$noEnd = !empty($_GET['noEnd']) &&  $_GET['noEnd'] == 'true';
$bot = !empty($_GET['bot']) &&  $_GET['bot'] == 'true';
$tmpvalues = !empty($_GET['value'])?explode(',', $_GET['value']):array();

if($clic_useragent != "1" && $clic_useragent !="2") {
$clic_useragent = "1";
}
if($day_month != "1" && $day_month !="2" && $day_month !="3" && $day_month !="4" && $day_month !="5" && $day_month !="6") {
$day_month = "1";
}
if($chart != "1" && $chart !="2" && $chart !="3") {
$chart = "1";
}
if($by != "1" && $by !="2" && $by !="3") {
$by = "1";
}

$values =  array();
foreach($tmpvalues as $value){
	if($by =="3" && is_numeric($value)) {
		$values[] = $value;
	} else if($by !="3") {
		$values[] = $value;
	}
}

if(!is_validDate($datemin)){
	echo "we need at last a starting date like YYYY-MM-DD";
	exit;
}
if($noEnd || !is_validDate($datemax)) {
	$datemax = date('Y-m-d');
} 

$db = cmsms()->getDb();

if($clic_useragent == 1 && ($by == 1 || $by == 2)) {

	$query2 = 'SELECT master.master, base.name, stat.down_date 
		FROM '.cms_db_prefix().'module_downcnt_master as master 
			right join '.cms_db_prefix().'module_downcnt as base on master.id = base.id 
			left join '.cms_db_prefix().'module_downcnt_stat as stat on base.name=stat.name ';

	$query2 .= ' WHERE 1=1 ';
	
	if($datemin != null) {
		$query2 .= ' AND stat.down_date > "' . $datemin . ' 00:00:00" ';
	}

	if($datemax != null) {
		$query2 .= ' AND stat.down_date < "' . $datemax . ' 23:59:59" ';
	}

	if(count($values)>0){
		$query2 .= ' AND master.master in ( ';
		$first = true;
		foreach($values as $value) {
			if(!$first) {
				$query2 .= ' , ';
			}
			$query2 .= "'".$value."'";
			$first = false;
		}
		$query2 .= ' )';
	}
	
	
	$query2 .= ' AND master.id is not null ';
	
	$query2 .= ' ORDER BY master.master ASC, base.name ASC ';
	
	$result = $db->Execute($query2);
	if ($result === false)
	{
	   echo "<h2>error during request2 : ".$db->ErrorMsg().'</h2>';
	   exit;
	}
	
	$rows = $result->GetArray();
	
	
//	echo $query2."<br/>";
//	echo "##".count($rows)."##</br>";
} else if($clic_useragent == 1 && $by=3) {
	
	$query3 = 'SELECT base.name, stat.down_date, stat.user_agent 
		FROM '.cms_db_prefix().'module_downcnt as base
			left join '.cms_db_prefix().'module_downcnt_stat as stat on base.name=stat.name ';
	
	$query3 .= ' WHERE 1=1 ';
	
	if($datemin != null) {
		$query3 .= ' AND stat.down_date > "' . $datemin . ' 00:00:00" ';
	}

	if($datemax != null) {
		$query3 .= ' AND stat.down_date < "' . $datemax . ' 23:59:59" ';
	}
	
	if(count($values)>0){
		$query3 .= ' AND base.id in ( ';
		$first = true;
		foreach($values as $value) {
			if(!$first) {
				$query3 .= ' , ';
			}
			$query3 .= $value;
			$first = false;
		}
		$query3 .= ' )';
	}
	
	$query3 .= ' ORDER BY base.name ASC ';
	
	
	$result = $db->Execute($query3);
	if ($result === false)
	{
	   echo "<h2>error during request3 : ".$db->ErrorMsg().'</h2>';
	   exit;
	}

	$rows = $result->GetArray();
//	echo $query3."<br/>";
//	echo "##".count($rows)."##</br>";
}/* else if($clic_useragent == 2) {
	
	$query4 = 'SELECT stat.down_date, stat.user_agent 
		FROM '.cms_db_prefix().'module_downcnt_stat as stat';
	
	$query4 .= ' WHERE 1=1 ';
	
	if($datemin != null) {
		$query4 .= ' AND stat.down_date > "' . $datemin . ' 00:00:00" ';
	}

	if($datemax != null) {
		$query4 .= ' AND stat.down_date < "' . $datemax . ' 23:59:59" ';
	}
		
	$query4 .= ' ORDER BY stat.user_agent ASC ';
	
	
	$result = $db->Execute($query4);
	if ($result === false)
	{
	   echo "<h2>error during request4 : ".$db->ErrorMsg().'</h2>';
	   exit;
	}

	$rows = $result->GetArray();
	//echo $query4."<br/>";
	//echo "##".count($rows)."##</br>";
}*/

if(count($rows) == 0){
	$smarty->assign('noData', $module->Lang('princess'));
} else {

	//Liste of ordonnee
	$ord = array();
	$col = null; //Will have the name of column : 'master' or counter 'name' or 'user-agent'
	/*if($clic_useragent == 2) {
		$col = 'user_agent';
	} else*/ if($by == 1) {
		$col = 'master';
	} else if($by == 2 || $by == 3) {
		$col = 'name';
	}



	if($chart == 1 || $chart == 2) {
		//Liste des abscisses
		$abs = array();
		if($day_month == 1){
			$abs = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23);
			
		} else if($day_month == 2){
			$start = strtotime(date($datemin));
			$end = strtotime(date($datemax));

			while($start <= $end) { //By Days
				$abs[] = date("Y-m-d",$start);
				$start = strtotime(date("Y-m-d", $start) . " +1 day");
			}
			
		}  else if($day_month == 3){  //By Week
			$start = getBeginOfWeekInMilli($datemin);
			$end = getBeginOfWeekInMilli($datemax);
			
			while($start <= $end) {
				$abs[] = date("Y-m-d",getBeginOfWeekInMilli(date("Y-m-d", $start)));
				
				$start = strtotime(date("Y-m-d", $start) . " +1 week");
			}
		} else if($day_month == 4){  // By Month
			$start = strtotime(date(substr($datemin,0,7).'-01'));
			$end = strtotime(date(substr($datemax,0,7).'-01'));
			
			while($start <= $end) {
				$abs[] = date("Y-m",$start);
				$start = strtotime(date("Y-m-d", $start) . " +1 month");
			}
		}  else if($day_month == 5){
			$start = date("Y",strtotime(date($datemin)));
			$end = date("Y",strtotime(date($datemax)));
				
			while($start <= $end) {
				$abs[] = $start;
				$start++;
			}
		} else if($day_month == 6) { // 7-days rolling
			$abs = array(0,1,2,3,4,5,6);
		}

		$cpt = 0;
		$authorized_ord = array();
		foreach($rows as $row) {
			
			$el = $row[$col];
			if(empty($el)){
				$el = 'N/A';
			}
			if(!isset($authorized_ord[trim($el)])) {
				$authorized_ord[$el] = 0;
			}
			$authorized_ord[$el]++;
		}
		arsort($authorized_ord);
		$ord = array_keys($authorized_ord);
		
		$hasOverCharge = false;
		if(count($ord) > $LIMIT_HIGH) {
			$overcharg = 0;
			for($i = $LIMIT_HIGH - 1; $i < count($ord); $i++)
			{
				$overcharg += $authorized_ord[$ord[$i]];
			}
			
			$ord = array_slice($ord , 0 , $LIMIT_HIGH - 1, true);
			$ord[$LIMIT_HIGH] = 'OTHER';
			$hasOverCharge = true;
		}

		//Initialise matrix
		$matrix = array();
		foreach($abs as $anAbs){
			$matrix[$anAbs] = array();
			foreach($ord as $anOrd){
				$matrix[$anAbs][$anOrd] = 0;
			}
		}

		foreach($rows as $row) {
			$val = getValue($row['down_date'],$day_month);
			$el = $row[$col];
			if(empty($el)){
				$el = 'N/A';
			}
			
			if(!in_array($el,$ord)){
				if($hasOverCharge) {
					$el = 'OTHER';
				} else {
					continue;
				}
				
			}
			
			if(isset($matrix[$val][$el])) {
				$matrix[$val][$el]++;
			} else {
				$matrix[$val][$el] = 1;
			}
		}
		
		//die(print_r($matrix));
		
		$smarty->assign('abs', $abs);

	} else if($chart == 3){
		//Initialise matrix
		$cpt = 0;
		$matrix = array();
		
		$authorized_ord = array();
		foreach($rows as $row) {
			
			$el = $row[$col];
			if(empty($el)){
				$el = 'N/A';
			}
			if(!isset($authorized_ord[trim($el)])) {
				$authorized_ord[$el] = 0;
			}
			$authorized_ord[$el]++;
		}
		arsort($authorized_ord);
		$ord = array_keys($authorized_ord);
			
		$hasOverCharge = false;
		if(count($ord) > $LIMIT_HIGH) {
			$overcharg = 0;
			for($i = $LIMIT_HIGH -1 ; $i < count($ord); $i++)
			{
				$overcharg += $authorized_ord[$ord[$i]];
			}
			
			$ord = array_slice($ord , 0 , $LIMIT_HIGH - 1, true);
			$ord[$LIMIT_HIGH] = 'OTHER';
			$hasOverCharge = true;
		}
		
		//Initialise matrix
		$matrix = array();
		foreach($ord as $anOrd){
			$matrix[$anOrd] = 0;
		}
		
		
		foreach($rows as $row) {
			
			
			$el = $row[$col];
			
			if(!in_array($el,$ord)){
				if($hasOverCharge) {
					$el = 'OTHER';
				} else {
					continue;
				}
			}
			
			if(isset($matrix[$el])) {
				$matrix[$el] ++ ;
			} else {
				$matrix[$el] = 1;
			} 
		}
		
	}
		
	$smarty->assign('ord', $ord);
	$smarty->assign('matrix', $matrix);
	$smarty->assign('day_month', $day_month);
	$smarty->assign('by', $by);
	//$smarty->assign('clic_useragent', $clic_useragent);
	$smarty->assign('datemin', $datemin);
	$smarty->assign('datemax', $datemax);
	$smarty->assign('chart', $chart);
	$smarty->assign('week_days', array(0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday'));

	$smarty->assign('chart_title', $module->Lang('chart_title',$datemin,$datemax));
	$smarty->assign('chart_x', $module->Lang('chart_x'));
	$smarty->assign('chart_y', $module->Lang('chart_y'));

}

if($chart == 1) {
	echo $module->ProcessTemplate('charts_line_chart.tpl');
} else if($chart == 2) {
	echo $module->ProcessTemplate('charts_area_chart.tpl');
} else if($chart == 3) {
	echo $module->ProcessTemplate('charts_pie_chart.tpl');
}  



$timeend=microtime(true);
$time=$timeend-$timestart;	
echo "<!-- Script execute en " . number_format($time, 3) . " sec -->";

?>