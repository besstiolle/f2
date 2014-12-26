<?php

if (!isset($gCms)) exit;

if(!empty($params['sid'])){
	$name = $params['sid'];
	$query = 'SELECT * FROM ' . cms_db_prefix() . 'module_downcnt_hardlink WHERE name = ?';
	$dbresult = $db->Execute($query, array($name));
	$exist = false;
	while ($row = $dbresult->FetchRow())
	{
		$exist = true;
		$params['name'] = $name;
		$params['link'] = $row['url'];
		
		break;
	}
	
	if(!$exist){
		
	}
}

if (!isset($params['name']))
{
  echo '[' . $this->Lang('error_insufficientparams', 'name') . ']';
} else if (strlen($params['name']) > 255)
{
  echo '[' . $this->Lang('error_nametoolong') . ']';
} else if (!isset($params['link']))
{
  echo '[' . $this->Lang('error_insufficientparams', 'link') . ']';
} else
{
	$query = 'SELECT count(*) FROM ' . cms_db_prefix() . 'module_downcnt_autho WHERE file = ? AND name = ?';
	$count = $db->getOne($query, array($params['link'], $params['name']));
	if($count == 0)
	{
		//Security : add this link to the authorised links list
		$id = $db->GenID(cms_db_prefix() . 'module_downcnt_autho_seq');
		$query = "INSERT INTO " . cms_db_prefix() . "module_downcnt_autho (id, name, file) VALUES( ?, ?, ?)";
		$db->Execute($query, array($id, $params['name'], $params['link']));
	}

	$link = str_replace("\&#39;", "", $params['link']);
	echo $this->CreateLink($id, 'click', $returnid, '',
							   array('name' => $params['name'], 'link' => urlencode($link)),
							   '', true, false, '');
}



?>