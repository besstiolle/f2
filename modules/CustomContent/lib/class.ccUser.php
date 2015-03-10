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
# This projects homepage is: http://www.cmsmadesimple.org
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

// this class handles retrieving information for the currently logged in user.
final class ccUser
{
  private static $_instance;
  private $_groups = array();
  private $_groupids = array();
  private $_uid = -1;
  private $_name = '';
  private $_email = null;
  private $_expired = null;

  private function __construct() {}

  public static function get_instance()
  {
    if( !self::$_instance ) {
      self::$_instance = new ccUser();
    }
    return self::$_instance;
  }

  public function ipmatches($ranges)
  {
    function _testip($range,$ip)
    {
      $result = 1;

# IP Pattern Matcher
# J.Adams <jna@retina.net>
      #
# Matches:
      #
# xxx.xxx.xxx.xxx        (exact)
# xxx.xxx.xxx.[yyy-zzz]  (range)
# xxx.xxx.xxx.xxx/nn    (nn = # bits, cisco style -- i.e. /24 = class C)
      #
# Does not match:
# xxx.xxx.xxx.xx[yyy-zzz]  (range, partial octets not supported)

      if (ereg("([0-9]+)\.([0-9]+)\.([0-9]+)\.([0-9]+)/([0-9]+)",$range,$regs)) {

# perform a mask match
	$ipl = ip2long($ip);
	$rangel = ip2long($regs[1] . "." . $regs[2] . "." . $regs[3] . "." . $regs[4]);

	$maskl = 0;

	for ($i = 0; $i< 31; $i++) {
	  if ($i < $regs[5]-1) {
	    $maskl = $maskl + pow(2,(30-$i));
	  }
	}

	if (($maskl & $rangel) == ($maskl & $ipl)) {
	  return 1;
	} else {
	  return 0;
	}
      } else {

# range based
	$maskocts = split("\.",$range);
	$ipocts = split("\.",$ip);

# perform a range match
	for ($i=0; $i<4; $i++) {
	  if (ereg("\[([0-9]+)\-([0-9]+)\]",$maskocts[$i],$regs)) {
	    if ( ($ipocts[$i] > $regs[2]) || ($ipocts[$i] < $regs[1])) {
	      $result = 0;
	    }
	  }
	  else
	    {
	      if ($maskocts[$i] <> $ipocts[$i]) {
		$result = 0;
	      }
	    }
	}
      }
      return $result;
    }

    $ip = getenv('REMOTE_ADDR');
    $arr_ranges = explode(',',$ranges);
    $myresult = 0;
    foreach( $arr_ranges as $onerange ) {
      $myresult = _testip($onerange,$ip);
      if( $myresult == 1 ) return $myresult;
    }
    return $myresult;
  }


  public static function loggedin()
  {
    if( self::get_instance()->_uid == -1 ) {
      $module = cms_utils::get_module('FrontEndUsers');
      if( !$module ) return 0;
      self::get_instance()->_uid = $module->LoggedInId();
    }
    return self::get_instance()->_uid;
  }


  public static function username()
  {
      if( empty(self::get_instance()->_name) ) {
          $module = cms_utils::get_module('FrontEndUsers');
          if( self::get_instance()->_uid == -1 ) {
              self::get_instance()->_uid = $module->LoggedInId();
          }
          self::get_instance()->_name = $module->LoggedInName();
      }
      return self::get_instance()->_name;
  }

  public static function email()
  {
      if( empty(self::get_instance()->_email) ) {
          $module = cms_utils::get_module('FrontEndUsers');
          if( self::get_instance()->_uid == -1 ) self::get_instance()->_uid = $module->LoggedInId();
          self::get_instance()->_email = $module->LoggedInEmail();
      }
      return self::get_instance()->_email;
  }

  public static function property($propname)
  {
    $module = cms_utils::get_module('FrontEndUsers');
    if( self::get_instance()->_uid == -1 ) {
      self::get_instance()->_uid = $module->LoggedInId();
    }
    if( !$module ) return false;
    $module->SetEncryptionKey(self::get_instance()->_uid);
    $txt = $module->GetUserPropertyFull($propname,self::get_instance()->_uid);
    return $txt;
  }

  public static function groups()
  {
    if( count(self::get_instance()->_groups) == 0 ) {
      $module = cms_utils::get_module('FrontEndUsers');
      if( !$module ) return '';

      if( !isset(self::get_instance()->_uid)  || self::get_instance()->_uid < 0 ) {
	self::get_instance()->_uid = $module->LoggedInId();
      }
      $groups = $module->GetMemberGroupsArray( self::get_instance()->_uid );
      $gns = array();
      $gids = array();
      if( $groups !== false ) {
	foreach( $groups as $gid ) {
	  $gids[] = $gid['groupid'];
	  $gns[] = $module->GetGroupName($gid['groupid']);
	}
      }
      self::get_instance()->_groupids = $gids;
      self::get_instance()->_groups = $gns;
    }
    return self::get_instance()->_groups;
  }

  public static function memberof($groups)
  {
    self::get_instance()->groups();

    $arr = array();
    if ( is_array($groups) )
      $arr = $groups;
    else
      $arr = explode(',', $groups);
    foreach( $arr as $one ) {
      $one = trim($one);
      if( array_search($one,self::get_instance()->_groups) !== FALSE )
	return 1;
      else if ( is_numeric($one) && array_search($one,self::get_instance()->_groupids) !== FALSE )
	return 1;
    }
    return 0;
  }

  public static function expired()
  {
    if( is_null(self::get_instance()->_expired) ) {
      $module = cms_utils::get_module('FrontEndUsers');
      if( !$module ) return false;
      if( self::get_instance()->_uid == -1 ) {
	self::get_instance()->_uid = $module->LoggedInId();
      }
      self::get_instance()->_expired = $module->IsAccountExpired(self::get_instance()->_uid);
    }
    return self::get_instance()->_expired;
  }
} // end of class

#
# EOF
#
?>