<?php

if (!isset($gCms)) exit;

$db = &$gCms->GetDb();

$taboptarray = array('mysql' => 'ENGINE MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci');
$dict = NewDataDictionary($db);


// Create main table 
$flds = "
    id I KEY,
    name C(255),
    lastdown_date DT,
    down_cnt I,
    active I1
";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_downcnt", $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
$db->CreateSequence(cms_db_prefix()."module_downcnt_seq");

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
    down_date DT,
	user_agent C(512)
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

 // Create hardcoded links
$flds = "
    id I,
    name C(255),
	url C(255)
";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_downcnt_hardlink", $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
$db->CreateSequence(cms_db_prefix()."module_downcnt_hardlink_seq");


$this->CreatePermission('Manage Download Counters', 'Manage Download Counters');

// put mention into the admin log
$this->Audit( 0,
	      $this->GetFriendlyName(),
	      $this->Lang('installed', $this->GetVersion()) );

?>