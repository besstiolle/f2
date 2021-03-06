<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: FrontEndUsers (c) 2008-2014 by Robert Campbell
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow management of frontend
#  users, and their login process within a CMS Made Simple powered
#  website.
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# Visit the CMSMS Homepage at: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE
if( !isset($gCms) ) exit;

if( version_compare(phpversion(),'5.4.3') < 0 ) {
    return "Minimum PHP version of 5.4.3 required";
}

$db = $this->GetDb();
$dict = NewDataDictionary($db);

switch( $oldversion ) {
case '0.1.0':
case '0.1.1':
{
    // permissions
    $this->CreatePermission('Modify FrontEndUserProps',
                            'Modify FrontEndUser Properties');
    $this->SetTemplate('feusers_forgotpasswordform', $this->dflt_forgotpasswordtemplate1);
    $this->SetTemplate('feusers_forgotpasswordemailform', $this->dflt_forgotpasswordtemplate2);
    $this->SetTemplate('feusers_forgotpasswordverifyform', $this->dflt_forgotpasswordtemplate3);

    // forgotten password stuff
    $flds = "
	             userid I KEY,
                 code C(25),
                 created ".CMS_ADODB_DT;
    $dict = NewDataDictionary($db);
    $sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_feusers_tempcode",
                                      $flds, $taboptarray );
    $dict->ExecuteSQLArray( $sqlarray );
    // notice no break
}

case '0.1.2':
{
    $this->SetPreference('pageid_forgotpasswd', '');
    $this->SetPreference('pageid_changesettings', '');
    $this->SetPreference('pageid_login','');
    $this->SetPreference('pageid_logout','');
    // notice no break
}

case '0.1.3':
case '0.1.4':
case '0.1.5':
case '0.1.6':
{
    //dropdown select options
    $dict = NewDataDictionary($db);
    $taboptarray = array('mysql' => 'TYPE=MyISAM');
    $flds = "
			 order_id		I,
			 option_name	C(40) NOT NULL,
			 option_text	C(80) NOT NULL,
			 control_name	C(40) NOT NULL;
			";
    $sqlarray = $dict->CreateTableSql(cms_db_prefix()."module_feusers_dropdowns",
                                      $flds, $taboptarray );
    $dict->ExecuteSQLArray( $sqlarray );

    // and cleanup property names
    $q = 'update '.cms_db_prefix().'module_feusers_propdefn set name = lcase(replace(name," ","_"))';
    $dbresult = $db->Execute( $q );
} //case

case '0.1.7':
{
    $sqlarray = $dict->AddcolumnSQL(cms_db_prefix()."module_feusers_propdefn",
                                    "maxlength I");
    $dict->ExecuteSQLArray( $sqlarray );
} // case

case '1.0.0':
{
    $this->SetPreference('allow_duplicate_emails',1);
}

case '1.0.1':
{
    $this->SetPreference('passwordfldlength', 20);
    $this->SetPreference('usernamefldlength', 20);
}

case '1.0.5':
case '1.0.6':
{
    // Events
    $this->CreateEvent( 'OnLogin' );
    $this->CreateEvent( 'OnLogout' );
    $this->CreateEvent( 'OnExpireUser' );
    $this->CreateEvent( 'OnCreateUser' );
    $this->CreateEvent( 'OnDeleteUser' );
    $this->CreateEvent( 'OnCreateGroup' );
    $this->CreateEvent( 'OnDeleteGroup' );

    // Preferences
    $this->RemovePreference('allow_repeated_logins',1);

    // Tables
    $flds = "
         userid I KEY,
	     sessionid C(32),
         action C(32),
         when DT
        ";
    $taboptarray = array('mysql' => 'TYPE=MyISAM');
    $sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_feusers_history",
                                      $flds, $taboptarray );
    $dict->ExecuteSQLArray( $sqlarray );
}

  case '1.1.0':
    {
      $sqlarray = $dict->ChangeTableSQL(cms_db_prefix()."module_feusers_dropdowns",
					"option_text C(255) NOT NULL");
      $dict->ExecuteSQLArray( $sqlarray );
    }

  case '1.2.1':
    {
      $this->CreateEvent( 'OnUpdateUser' );
    }

  case '1.2.2':
    {
      $sqlarray = $dict->DropTableSQL( cms_db_prefix().
				       "module_feusers_history" );
      $dict->ExecuteSQLArray($sqlarray);

      $taboptarray = array('mysql' => 'TYPE=MyISAM');
      $flds = "
             userid I,
	     sessionid C(32),
             action C(32),
             refdate ".CMS_ADODB_DT.",
             ipaddress C(20)";
      $sqlarray = $dict->CreateTableSQL(cms_db_prefix().
					"module_feusers_history",
					$flds, $taboptarray );
      $dict->ExecuteSQLArray( $sqlarray );
    }


  case '1.3':
    {
      $sqlarray = $dict->AddcolumnSQL(cms_db_prefix()."module_feusers_grouppropmap",
				      "lostunflag I");
      $dict->ExecuteSQLArray( $sqlarray);

      $this->SetPreference('pageid_afterverify','');
    }

  case '1.3.1':
    {
      $this->SetPreference('notification_subject',$this->Lang('feu_event_notification'));
      $fn = cms_join_path(__DIR__,'templates','orig_notification_template.tpl');
      if( file_exists( $fn ) )
	{
	  $template = @file_get_contents($fn);
	  $this->SetTemplate('notification_template',$template);
	}
    }

  case '1.3.2':
    {
      $tmp_name = cms_db_prefix().'module_feusers_properties_tmp';
      $real_name = cms_db_prefix().'module_feusers_properties';

      // 1 Create temporary table
      //user properties
      $flds = "
	      id I KEY,
  	      userid I,
 	      title C(100),
	      data X2
	    ";
      $taboptarray = array('mysql' => 'TYPE=MyISAM');
      $sqlarray = $dict->CreateTableSQL($tmp_name,$flds,$taboptarray);
      $dict->ExecuteSQLArray( $sqlarray );

      // 2.  Copy all data from feusers_properties to temporary table
      $query = 'INSERT INTO '.$tmp_name.' (id,userid,title,data)
                      SELECT id,userid,title,data FROM '.$real_name;
      $db->Execute($query);

      // 3.  Drop feusers_properties
      $sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_feusers_properties" );
      $dict->ExecuteSQLArray($sqlarray);

      // 4.  Rename table
      $sqlarray = $dict->RenameTableSQL($tmp_name,$real_name);
      $dict->ExecuteSQLArray($sqlarray);
    }

  case '1.3.3':
    $fn = cms_join_path(__DIR__,'templates','orig_viewuser_template.tpl');
    if( file_exists( $fn ) )
      {
	$template = @file_get_contents($fn);
	$this->SetTemplate('feusers_viewuser',$template);
      }

  case '1.4':
  case '1.4.1':
  case '1.4.2':
  case '1.4.3':
  case '1.4.4':
  case '1.5':
    {
      $sqlarray = $dict->AlterColumnSQL(cms_db_prefix()."module_feusers_propdefn", "prompt C(255) NOT NULL");
      $dict->ExecuteSQLArray($sqlarray);
    }

  case '1.5.1':
  case '1.5.2':
  case '1.5.3':
    {
      $sqlarray = $dict->AlterColumnSQL(cms_db_prefix().'module_feusers_loggedin', "sessionid C(255)");
      $dict->ExecuteSQLArray($sqlarray);
    }

  case '1.5.4':
    {
      $sqlarray = $dict->AddcolumnSQL(cms_db_prefix()."module_feusers_propdefn",
				      "attribs C(255)");
      $dict->ExecuteSQLArray($sqlarray);
    }

  case '1.6.5':
  case '1.6.6':
  case '1.6.7':
  case '1.6.8':
  case '1.6.9':
  case '1.6.10':
    {
      $this->AddEventHandler( 'Core', 'ContentPostRender', false );
    }

  case '1.6.11':
  case '1.6.12':
  case '1.6.13':
  case '1.6.14':
  case '1.6.15':
  case '1.6.16':
    {
      $fn = cms_join_path(__DIR__,'templates','orig_resetsession_template.tpl');
      if( file_exists( $fn ) )
	{
	  $template = @file_get_contents($fn);
	  $this->SetTemplate('feusers_resetsession',$template);
	}
    }

  case '1.7.11':
  case '1.8':
  case '1.8.1':
  case '1.8.2':
  case '1.8.3':
  case '1.8.5':
  case '1.9':
  case '1.9.1':
  case '1.9.2':
    {
      $sqlarray = $dict->AddcolumnSQL(cms_db_prefix()."module_feusers_propdefn",
				      "force_unique I1");
      $dict->ExecuteSQLArray($sqlarray);
    }

  case '1.10':
  case '1.10.1':
  case '1.10.2':
  case '1.10.3':
    {
      $sqlarray = $dict->AddcolumnSQL(cms_db_prefix()."module_feusers_propdefn",
				      "encrypt I1");
      $dict->ExecuteSQLArray($sqlarray);
    }

  case '1.11':
  case '1.11.1':
  case '1.12':
  case '1.12.1':
  case '1.12.2':
    {
      $this->RemoveEventHandler('CGEcommerceBase','OrderUpdated');
      $this->RemoveEventHandler('CGEcommerceBase','OrderDeleted');
      $this->RemoveEventHandler('Core','ModuleInstalled');
      $this->RemoveEventHandler('Core','ModuleUninstalled');
    }

  case '1.12.3':
  case '1.12.4':
  case '1.12.5':
  case '1.12.6':
  case '1.12.7':
  case '1.12.8':
  case '1.12.9':
  case '1.12.10':
  case '1.12.11':
  case '1.12.12':
  case '1.12.13':
    {
      $sqlarray = $dict->AddcolumnSQL(cms_db_prefix()."module_feusers_propdefn","encrypt I1");
      $dict->ExecuteSQLArray($sqlarray);
    }

  case '1.12.14':
  case '1.12.15':
  case '1.12.16':
  case '1.12.17':
    {
      $this->CreateEvent( 'OnRefreshUser' );
    }
  } // switch

if( version_compare($oldversion,'1.16.2') < 0 )
  {
    $sqlarray = $dict->CreateIndexSQL('idx_username',cms_db_prefix().'module_feusers_users','username');
    $dict->ExecuteSQLArray($sqlarray);
    $sqlarray = $dict->CreateIndexSQL('idx_expires',cms_db_prefix().'module_feusers_users','expires');
    $dict->ExecuteSQLArray($sqlarray);
    $sqlarray = $dict->CreateIndexSQL('idx_refdate',cms_db_prefix().'module_feusers_history','userid,refdate,action');
    $dict->ExecuteSQLArray($sqlarray);
  }
if( version_compare($oldversion,'1.19.1') < 0 ) {
  $sqlarray = $dict->AddcolumnSQL(cms_db_prefix()."module_feusers_propdefn","extra X");
  $dict->ExecuteSQLArray( $sqlarray );
}
if( version_compare($oldversion,'1.21') < 0 ) {
  $sqlarray = $dict->CreateIndexSQL(cms_db_prefix().'feu_idx_username',cms_db_prefix().'module_feusers_belongs','groupid');
  $dict->ExecuteSQLArray($sqlarray);
}
if( version_compare($oldversion,'1.21.7') < 0 ) {
  $sqlarray = $dict->AddColumnSQL(cms_db_prefix().'module_feusers_users','nonstd I1');
  $dict->ExecuteSQLArray($sqlarray);
}
if( version_compare($oldversion,'1.21.16') < 0 ) {
  $sqlarray = $dict->CreateIndexSQL(cms_db_prefix().'feu_idx_propusertitle',cms_db_prefix().'module_feusers_properties','userid,title');
  $dict->ExecuteSQLArray($sqlarray);
  $sqlarray = $dict->CreateIndexSQL(cms_db_prefix().'feu_idx_proptitle',cms_db_prefix().'module_feusers_properties','title');
  $dict->ExecuteSQLArray($sqlarray);
}

if( version_compare($oldversion,'1.23.5') < 0 ) {
    $this->RemoveEventHandler('Core','ContentPostRender');
}

if( version_compare($oldversion,'1.28') < 0 ) {
    $sqlarray = $dict->AddcolumnSQL(cms_db_prefix()."module_feusers_users","disabled I1, salt C(32), force_newpw I1");
    $dict->ExecuteSQLArray( $sqlarray );

    $tpl = file_get_contents(__DIR__.'/templates/orig_force_newpw_form.tpl');
    $this->SetTemplate('force_newpw_template',$tpl);
}

if( version_compare($oldversion,'1.30') < 0 ) {
    // gonna use innodb now.
    $db = \cge_utils::get_db();
    try {
        $tables = array();  // ignore seq tables
        $tables[] = cms_db_prefix().'module_feusers_users';
        $tables[] = cms_db_prefix().'module_feusers_groups';
        $tables[] = cms_db_prefix().'module_feusers_loggedin';
        $tables[] = cms_db_prefix().'module_feusers_belongs';
        $tables[] = cms_db_prefix().'module_feusers_propdefn';
        $tables[] = cms_db_prefix().'module_feusers_dropdowns';
        $tables[] = cms_db_prefix().'module_feusers_grouppropmap';
        $tables[] = cms_db_prefix().'module_feusers_properties';
        $tables[] = cms_db_prefix().'module_feusers_tempcode';
        $tables[] = cms_db_prefix().'module_feusers_history';
        $sql_i = "ALTER TABLE %s ENGINE=InnoDB";
        foreach( $tables as $one ) {
            $sql = sprintf($sql_i,$one);
            $dbr = $db->Execute($sql);
        }

        $db->BeginTrans();

        // get a list of all of the user ids that are in this history table, but not in the
        // users table.
        $query = 'SELECT A.userid FROM '.cms_db_prefix().'module_feusers_history A
                  LEFT JOIN '.cms_db_prefix().'module_feusers_users B ON A.userid = B.id
                  WHERE B.id IS NULL';
        $del_userids = $db->GetCol($query);
        $del_userids = array_unique($del_userids);
        if( count($del_userids) ) {
            $str = implode(',',$del_userids);
            if( $str ) {
                $query = 'DELETE FROM '.cms_db_prefix().'module_feusers_history WHERE userid IN ('.$str.')';
                $db->Execute($query);
            }
        }

        // get a list of all of the properties that are not in the propdefn table (clean up the properties table)
        $query = 'SELECT A.id FROM '.cms_db_prefix().'module_feusers_properties A
                  LEFT JOIN '.cms_db_prefix().'module_feusers_propdefn B ON A.title = B.name
                  WHERE B.name IS NULL';
        $del_propids = $db->GetCol($query);
        if( count($del_propids) ) {
            $str = implode(',',$del_userids);
            if( $str ) {
                $query = 'DELETE FROM '.cms_db_prefix().'module_feusers_properties WHERE id IN ('.$str.')';
                $db->Execute($query);
            }
        }

        // get a list of all of the properties that are not in the grouppropmap table (clean up the grouppropmap table)
        $query = 'SELECT A.name FROM '.cms_db_prefix().'module_feusers_grouppropmap  A
                  LEFT JOIN '.cms_db_prefix().'module_feusers_propdefn B ON A.name = B.name
                  WHERE B.name IS NULL';
        $del_grpprop = $db->GetCol($query);
        if( count($del_grpprop) ) {
            $query = 'DELETE FROM '.cms_db_prefix().'module_feusers_grouppropmap WHERE name = ?';
            for( $i = 0, $n = count($del_grpprop); $i < $n; $i++ ) {
                $tmp1 = $del_grpprop[$i];
                $db->Execute($query,array($tmp1));
            }
        }

        $db->CommitTrans();

        // delete everything from the history
        // setup foreign key relationships
        $sql = 'ALTER TABLE '.cms_db_prefix().'module_feusers_belongs ADD FOREIGN KEY (userid) REFERENCES '.cms_db_prefix().'module_feusers_users (id)';
        $db->Execute($sql);
        $sql = 'ALTER TABLE '.cms_db_prefix().'module_feusers_loggedin ADD FOREIGN KEY (userid) REFERENCES '.cms_db_prefix().'module_feusers_users (id)';
        $db->Execute($sql);
        $sql = 'ALTER TABLE '.cms_db_prefix().'module_feusers_belongs ADD FOREIGN KEY (groupid) REFERENCES '.cms_db_prefix().'module_feusers_groups (id)';
        $db->Execute($sql);
        $sql = 'ALTER TABLE '.cms_db_prefix().'module_feusers_dropdowns ADD FOREIGN KEY (control_name) REFERENCES '.cms_db_prefix().'module_feusers_propdefn (name)';
        $db->Execute($sql);
        $sql = 'ALTER TABLE '.cms_db_prefix().'module_feusers_grouppropmap ADD FOREIGN KEY (group_id) REFERENCES '.cms_db_prefix().'module_feusers_groups (id)';
        $db->Execute($sql);
        $sql = 'ALTER TABLE '.cms_db_prefix().'module_feusers_grouppropmap ADD FOREIGN KEY (name) REFERENCES '.cms_db_prefix().'module_feusers_propdefn (name)';
        $db->Execute($sql);
        $sql = 'ALTER TABLE '.cms_db_prefix().'module_feusers_properties ADD FOREIGN KEY (userid) REFERENCES '.cms_db_prefix().'module_feusers_users (id)';
        $db->Execute($sql);
        $sql = 'ALTER TABLE '.cms_db_prefix().'module_feusers_properties ADD FOREIGN KEY (title) REFERENCES '.cms_db_prefix().'module_feusers_propdefn (name)';
        $db->Execute($sql);
        $sql = 'ALTER TABLE '.cms_db_prefix().'module_feusers_tempcode ADD FOREIGN KEY (userid) REFERENCES '.cms_db_prefix().'module_feusers_users (id)';
        $db->Execute($sql);
        $sql = 'ALTER TABLE '.cms_db_prefix().'module_feusers_history ADD FOREIGN KEY (userid) REFERENCES '.cms_db_prefix().'module_feusers_users (id)';
        $db->Execute($sql);

        // get rid of the users seq table.
        try {
            $val = $db->GenID( cms_db_prefix().'module_feusers_users_seq');
            $query = 'ALTER TABLE '.cms_db_prefix().'module_feusers_users MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT';
            $db->Execute($query);
            $query = 'ALTER TABLE '.cms_db_prefix().'module_feusers_users AUTO_INCREMENT = ?';
            $db->Execute($query,array($val));
            $db->DropSequence( cms_db_prefix()."module_feusers_users_seq" );
        }
        catch( \Exception $e ) {
            // silently ignore, incase this is already done.
        }

        // get rid of the groups seq table
        try {
            $val = $db->GenID( cms_db_prefix().'module_feusers_groups_seq');
            $query = 'ALTER TABLE '.cms_db_prefix().'module_feusers_groups MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT';
            $db->Execute($query);
            $query = 'ALTER TABLE '.cms_db_prefix().'module_feusers_groups AUTO_INCREMENT = ?';
            $db->Execute($query,array($val));
            $db->DropSequence( cms_db_prefix()."module_feusers_groups_seq" );
        }
        catch( \Exception $e ) {
            // silently ignore, incase this is already done.
        }

        // get rid of the properties seq table
        try {
            $val = $db->GenID( cms_db_prefix().'module_feusers_properties_seq');
            $query = 'ALTER TABLE '.cms_db_prefix().'module_feusers_properties MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT';
            $db->Execute($query);
            $query = 'ALTER TABLE '.cms_db_prefix().'module_feusers_properties AUTO_INCREMENT = ?';
            $db->Execute($query,array($val));
            $db->DropSequence( cms_db_prefix()."module_feusers_properties_seq" );
        }
        catch( \Exception $e ) {
            // silently ignore, incase this is already done.
        }


    }
    catch( \Exception $e ) {
        die($db->sql.' '.$db->ErrorMsg());
        debug_to_log($db->sql);
        debug_to_log($e->GetMessage());
        audit('',$this->GetName(),'Upgrade Failed: '.$e->GetMessage());
        return $e->GetMessage();
    }
}
?>