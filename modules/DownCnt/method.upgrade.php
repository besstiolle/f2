<?php

if (!isset($gCms)) exit;

$db =& cmsms()->GetDb();
$taboptarray = array('mysql' => 'ENGINE MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci');
$dict = NewDataDictionary($db);

switch($oldversion)
{
 case '2.0.0':
 case '2.1.0':
 case '2.1.1':
 case '2.2.0':
	
// Create authorized files table 
$flds = "
    id I KEY,
    name C(255),
    file C(512)
";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_downcnt_autho", $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
$db->CreateSequence(cms_db_prefix()."module_downcnt_autho_seq");

// Create statistiques table 
$flds = "
    id I KEY,
    name C(255),
    file C(512),
    down_date DT
";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_downcnt_stat", $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
$db->CreateSequence(cms_db_prefix()."module_downcnt_stat_seq");

 // Create master table 
$flds = "
    id I,
    master C(255)
";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_downcnt_master", $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$query = "ALTER TABLE ".cms_db_prefix()."module_downcnt_stat ADD user_agent VARCHAR( 512 ) NULL ";
$db->execute($query);
$query = "ALTER TABLE ".cms_db_prefix()."module_downcnt_stat DROP file";
$db->execute($query);

$flds = "
    id I,
    name C(255),
	url C(255)
";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_downcnt_hardlink", $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
$db->CreateSequence(cms_db_prefix()."module_downcnt_hardlink_seq");

//Supress old files
$files = array("/templates/counterlist.tpl"
				, "/adminlisting.inc.php"
			);
$config = cmsms()->GetConfig();
$path = $config['root_path'].'/modules/'.$this->GetName().'/';
foreach($files as $file) {
	if(file_exists($path.$file)) {
		unlink($path.$file);
	}
}
 case '2.3.0':
 
 
 }

// put mention into the admin log
$this->Audit( 0, $this->GetFriendlyName(), $this->Lang('upgraded', $this->GetVersion()));
?>