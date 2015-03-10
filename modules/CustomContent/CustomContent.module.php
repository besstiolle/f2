<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CustomContent (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to conditionally displaying content
#  based on the currently logged in user (FrontEndUsers module) or other
#  factors.
# 
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
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

class CustomContent extends CMSModule
{
  protected $_initialized = false;

  function __construct()
  {
    require_once(dirname(__FILE__).'/lib/class.ccUser.php');
    $smarty = cmsms()->GetSmarty();
    if( !$smarty ) return;
    $smarty->assign('ccuser',ccUser::get_instance());
    $smarty->registerPlugin('function','cc_menufilter_loggedin',array($this,'cc_menufilter_loggedin'),FALSE);
    $smarty->registerPlugin('function','cc_menufilter_memberof',array($this,'cc_menufilter_memberof'),FALSE);
    $smarty->registerPlugin('block','cc_protect',array($this,'cc_protect'),FALSE);
  }

  function GetName() { return 'CustomContent'; }
  function GetFriendlyName() { return $this->Lang('friendlyname'); }
  function GetVersion() { return '1.10'; }
  function MinimumCMSVersion() { return '1.11.8'; }
  function GetHelp() { return file_get_contents(dirname(__FILE__).'/help.inc'); }
  function GetAuthor() { return 'calguy1000'; }
  function GetAuthorEmail() { return 'calguy1000@cmsmadesimple.org'; }
  function GetChangeLog() { return @file_get_contents(dirname(__FILE__).'/changelog.html.inc'); }
  function IsPluginModule() { return false; }
  function GetAdminDescription() { return $this->Lang('moddescription'); }
  function GetDependencies() { return array('FrontEndUsers'=>'1.23.4'); }
  function HasAdmin() { return FALSE; }
  function InstallPostMessage() { return $this->Lang('postinstall'); }
  function UninstallPostMessage() { return $this->Lang('postuninstall'); }

  function Upgrade($oldversion,$newversion)
  {
    $this->RemoveEventHandler( 'Core', 'SmartyPreCompile' );
  }

  function UnInstall()
  {
    $this->RemoveEventHandler( 'Core', 'SmartyPreCompile' );
  }

  public function cc_menufilter_loggedin($params,&$smarty)
  {
    if( !isset($params['menunodes']) ) return;
    if( !is_array($params['menunodes']) ) return;
    if( !isset($params['assign']) ) return;
    if( !isset($params['keyname']) && !isset($params['contentblock']) ) return;

    $nodes = $params['menunodes'];
    $dest_nodes = array();
    $feu = cms_utils::get_module('FrontEndUsers');
    if( isset($params['keyname']) ) {
      $keyname = trim($params['keyname']);
      $keyvalue = '';
      if( isset($params['keyvalue']) ) $keyvalue = $params['keyvalue'];
      for( $i = 0; $i < count($nodes); $i++ ) {
	$node =& $nodes[$i];
	if( !isset($node->$keyname) || empty($node->$keyname) || !$feu ||
	    ($node->$keyname != '' && $keyvalue == '::ANY::' && $feu->LoggedInId()) ||
	    ($node->$keyname == $keyvalue && $feu->LoggedInId()) ) {
	  if( count($dest_nodes) ) {
	    $j = count($dest_nodes)-1;
	    $node->prevdepth = $dest_nodes[$j]->depth;
	  }
	  $dest_nodes[] = $node;
	}
      }
    }
    else if( isset($params['contentblock']) ) {
      $blockname = $params['contentblock'];
      $blockvalue = $params['contentvalue'];
      $contentops = cmsms()->GetContentOperations();

      for( $i = 0; $i < count($nodes); $i++ ) {
	$node =& $nodes[$i];
	$blockcontent = '';
	$content = $contentops->LoadContentFromAlias($node->alias);
	if( is_object($content) ) $blockcontent = $content->GetPropertyValue($blockname);

	if( !$blockcontent || !$feu ||
	    ($blockcontent != '' && $blockvalue == '::ANY::' && $feu->LoggedInId()) ||
	    ($blockcontent == $blockvalue && $feu->LoggedInId()) ) {
	  $j = count($dest_nodes)-1;
	  $node->prevdepth = $dest_nodes[$j]->depth;
	}
	$dest_nodes[] = $node;
      }
    }

    if( !count($dest_nodes) ) return;
    if( isset($params['assign']) ) {
      $smarty->assign($params['assign'],$dest_nodes);
    }

    // {cc_menufilter_loggedin menunodes=$nodelist assign=nodelist keyname=extra1 value='' }
    // {cc_menufilter_loggedin menunodes=$nodelist assign=nodelist contentblocke=extra1 value=''}
  }

  public function cc_menufilter_memberof($params,&$smarty)
  {
    if( !isset($params['menunodes']) ) return;
    if( !is_array($params['menunodes']) ) return;
    if( !isset($params['assign']) ) return;
    if( !isset($params['keyname']) && !isset($params['contentblock']) ) return;
    if( !isset($params['memberof']) ) return;

    $nodes = $params['menunodes'];
    $dest_nodes = array();
    $feu = cms_utils::get_module('FrontEndUsers');
    if( isset($params['keyname']) ) {
      $keyname = trim($params['keyname']);
      $nodes = $params['menunodes'];
      $keyvalue = '';
      if( isset($params['keyvalue']) ) $keyvalue = $params['keyvalue'];
      for( $i = 0; $i < count($nodes); $i++ ) {
	$node =& $nodes[$i];
	if( !isset($node->$keyname) || empty($node->$keyname) || !$feu ||
	    ($node->$keyname != '' && $keyvalue == '::ANY::' && $feu->memberof($params['memberof'])) ||
	    ($node->$keyname == $keyvalue && $feu->memberof($params['memberof'])) ) {
	  if( count($dest_nodes) ) {
	    $j = count($dest_nodes)-1;
	    $node->prevdepth = $dest_nodes[$j]->depth;
	  }
	  $dest_nodes[] = $node;
	}
      }
    }
    else if( isset($params['contentblock']) ) {
      $blockname = $params['contentblock'];
      $blockvalue = $params['contentvalue'];
      $contentops = cmsms()->GetContentOperations();

      for( $i = 0; $i < count($nodes); $i++ ) {
	$node =& $nodes[$i];
	$blockcontent = '';
	$content = $contentops->LoadContentFromAlias($node->alias);
	if( is_object($content) ) $blockcontent = $content->GetPropertyValue($blockname);

	if( !$blockcontent || !$feu ||
	    ($blockcontent != '' && $blockvalue == '::ANY::' && $feu->memberof($params['memberof'])) ||
	    ($blockcontent == $blockvalue && $feu->memberof($params['memberof'])) ) {
	  $j = count($dest_nodes)-1;
	  $node->prevdepth = $dest_nodes[$j]->depth;
	}
	$dest_nodes[] = $node;
      }
    }

    if( !count($dest_nodes) ) return;
    if( isset($params['assign']) ) {
      $smarty->assign($params['assign'],$dest_nodes);
    }
  }

  public function cc_protect($params,$content,&$smarty,$repeat)
  {
    if( !$content ) return;
    
    $feu = cms_utils::get_module('FrontEndUsers');
    if( !($uid = $feu->LoggedInId()) ) {
      return '';
    }

    $groups = null;
    if( isset($params['group']) ) {
      $groups = explode(',',$params['group']);
      foreach( $groups as &$grp ) {
	$grp = trim($grp);
      }
    }
    else if( isset($params['groups']) ) {
      $groups = explode(',',$params['groups']);
      foreach( $groups as &$grp ) {
	$grp = trim($grp);
      }
    }
    if( !is_array($groups) || count($groups) == 0 ) {
      // empty groups array specified.
      return $content;
    }

    // convert group names to ids
    $grouplist = $feu->GetGroupList();
    $gids = array();
    foreach($groups as $name) {
      if( (int)$name > 0 ) {
	$gids[] = (int)$name;
      }
      else if( isset($grouplist[$name]) ) {
	$gids[] = $grouplist[$name];
      }
    }

    $membergroups = $feu->GetMemberGroupsArray($uid);
    if( !is_array($membergroups) || count($groups) == 0 ) {
      // groups specified, but user is not a member of any groups.
      return '';
    }

    for( $i = 0; $i < count($membergroups); $i++ ) {
      $gid = $membergroups[$i]['groupid'];
      if( in_array($gid,$gids) ) {
	return $content;
      }
    }

    // user is not a member of any of the specified groups.
  }
} // end of classs

?>
