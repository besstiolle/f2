<?php

if (!isset($gCms)) exit;


if (!isset($params['name'])) {
  echo $this->Lang('error_insufficientparams', 'name');
  return;
}
else if (!isset($params['link'])) {
  echo $this->Lang('error_insufficientparams', 'link');
  return;
}

$link = str_replace('%C2','',$params['link']);
$link = urldecode($link);
$name = html_entity_decode(html_entity_decode($params['name'],ENT_QUOTES, 'UTF-8'),ENT_QUOTES, 'UTF-8');

//die($name.'  '.$params['name']);

$db = &$this->GetDb();
//Security I : refuse all the crap like "../../"

$secuPattern = array(NULL, "\x1a", "\n", "\r", "\\", "‘", "»", "\\x00", "..", "./", "/.", '*', '<', '>');
foreach($secuPattern as $pattern)
{
	if(FALSE !== strpos($name, $pattern) || FALSE !== strpos($link, $pattern))
	{
		echo "no hack allowed [".$pattern."]";
		return;
	}
}

//Security II : we search after a authorized link
$query = 'SELECT count(*) FROM ' . cms_db_prefix() . 'module_downcnt_autho WHERE file = ? AND name = ?';
$count = $db->getOne($query, array($link, $name));
if($count == 0)
{
	echo "the ".$link." link is not allowed ".$name;
	return;
}


$query = 'SELECT id, down_cnt, active FROM ' . cms_db_prefix() . 'module_downcnt WHERE name = ?';
$result = $db->Execute($query, array($name));

$row = $result->FetchRow();
$time = trim($db->DBTimeStamp(time()), "'");

if ($row)
{
	if ($row['active']) //Update the value only if the item is active
	{
	  $query = "UPDATE " . cms_db_prefix() . "module_downcnt SET lastdown_date=?, down_cnt=? WHERE id = ?";
	  $db->Execute($query, array($time, $row['down_cnt'] + 1, $row['id']));
	}
}
else {
	$id = $db->GenID(cms_db_prefix() . 'module_downcnt_seq');
	$query = "INSERT INTO " . cms_db_prefix() . "module_downcnt (id, name, lastdown_date, down_cnt, active) VALUES( ?, ?, ?, ?, ?)";
	$db->Execute($query, array($id, $name, $time, 1, 1  ));
}

//Insert Ping for the stats
$id = $db->GenID(cms_db_prefix() . 'module_downcnt_stat_seq');
$query = "INSERT INTO " . cms_db_prefix() . "module_downcnt_stat (id, name, down_date, user_agent) VALUES( ?, ?, ?, ?)";
$user_agent = htmlentities($_SERVER['HTTP_USER_AGENT']);

$db->Execute($query, array($id, $name, $time, $user_agent ));


if(substr($link, 0, 3) == 'www')
{
	$link = 'http://'.$link;
}

header('Location: ' . $link);


?>