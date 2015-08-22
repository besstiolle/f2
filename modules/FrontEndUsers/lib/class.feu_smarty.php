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

final class feu_smarty
{
    private static $_module;
    private static $_properties;
    private function __construct() {}

    private static function _get_module()
    {
        if( !self::$_module ) self::$_module = \cms_utils::get_module(MOD_FRONTENDUSERS);
        return self::$_module;
    }

    public static function get_current_userid()
    {
        $uid = self::_get_module()->LoggedInId();
        return $uid;
    }

    public static function get_current_username()
    {
        return self::_get_module()->LoggedInName();
    }

    public static function get_userid($username)
    {
        $username = trim($username);
        if( $username ) return (int)self::_get_module()->GetUserID($username);
    }

    public static function get_username($uid = null)
    {
        if( $uid < 1 ) $uid = self::_get_module()->LoggedInId();
        if( $uid < 1 ) return;
        $uinfo = self::_get_module()->GetUserInfo($uid);
        if( !is_array($uinfo) || count($uinfo) == 0 || $uinfo[0] == FALSE ) return;
        return $uinfo[1]['username'];
    }

    public static function get_email($uid = null)
    {
        if( $uid < 1 ) $uid = self::_get_module()->LoggedInId();
        if( $uid < 1 ) return;
        $mod = cms_utils::get_module(MOD_FRONTENDUSERS);
        if( $mod->GetPreference('username_is_email') ) return self::get_username($uid);
        $tmp = $mod->GetEmail($uid);
        return $tmp;
    }

    public static function get_userinfo($uid = null)
    {
        if( $uid < 1 ) $uid = self::_get_module()->LoggedInId();
        if( $uid < 1 ) return;
        $uid = (int)$uid;
        if( $uid > 0 ) {
            if( is_object(self::_get_module()) ) {
                $uinfo = self::_get_module()->GetUserInfo($uid,TRUE);
                if( !is_array($uinfo) || count($uinfo) == 0 ) {
                    if( $uinfo[0] == FALSE ) {

                        if( isset($uinfo[1]['fprops']) ) {
                            $tmp = array();
                            foreach( $uinfo[1]['fprops'] as $oneprop ) {
                                $tmp[$oneprop['title']] = $oneprop['data'];
                            }

                            unset($uinfo[1]['fprops']);
                            $uinfo[1]['props'] = $tmp;
                        }
                    }
                }
            }
        }
        return $uinfo[1];
    }

    public static function get_users_by_groupname($groupname,$for_list = FALSE)
    {
        if( !empty($groupname) ) {
            if( is_object(self::_get_module()) ) {

                $gid = self::_get_module()->GetGroupID($groupname);
                if( $gid ) {
                    $usersfull = self::_get_module()->GetUsersInGroup($gid);

                    $users = array();
                    foreach( $usersfull as $oneuser ) {
                        if( $for_list ) {
                            $users[$oneuser['id']] = $oneuser['username'];
                        }
                        else {
                            $users[] = array('id'=>$oneuser['id'],'username'=>$oneuser['username']);
                        }
                    }
                    return $users;
                }
            }
        }
    }

    public static function get_group_memberlist($gid)
    {
        $mod = cms_utils::get_module(MOD_FRONTENDUSERS);
        $usersfull = $mod->GetUsersInGroup($gid);
        $out = array();
        foreach( $usersfull as $oneuser ) {
            $out[$oneuser['id']] = $oneuser['username'];
        }
        return $out;
    }

    public static function get_user_expiry($uid = null)
    {
        if( $uid < 1 ) $uid = self::_get_module()->LoggedInId();
        if( $uid < 1 ) return;

        $res = null;
        $res = self::_get_module()->GetExpiryDate($uid);
        return $res;
    }

    public static function user_expired($uid)
    {
        if( empty($uid) ) return;
        if( !is_object(self::_get_module()) ) return;

        $res = self::_get_module()->IsAccountExpired($uid);
        return $res;
    }

    public static function get_user_properties($uid = null)
    {
        try {
            if( $uid < 1 ) $uid = self::_get_module()->LoggedInId();
            if( $uid < 1 ) throw new Exception('a');

            $res = self::_get_module()->GetUserProperties($uid);
            if( !$res ) throw new Exception('d');

            $res2 = array();
            foreach( $res as $one ) {
                $res2[$one['title']] = $one['data'];
            }
            return $res2;
        }
        catch( Exception $e ) {
        }
    }

    public static function get_user_property($property,$uid = null)
    {
        try {
            $property = trim($property);
            if( !$property ) throw new \Exception('0');
            if( $uid < 1 ) $uid = self::_get_module()->LoggedInId();
            if( $uid < 1 ) throw new \Exception('a');

            $tmp = self::get_user_properties($uid);
            if( isset($tmp[$property]) ) return $tmp[$property];
        }
        catch( \Exception $e ) {
        }
    }

    public static function get_dropdown_text($propname,$propvalue)
    {
        $res = null;

        try {
            if( !is_object(self::_get_module()) ) throw new Exception('a');
            if( self::$_properties == null ) {
                self::$_properties = array();
                $tmp = self::_get_module()->GetPropertyDefns();
                foreach( $tmp as $one ) {
                    if( $one['type'] == 4 || $one['type'] == 5 ) {
                        $tmp2 = self::_get_module()->GetSelectOptions($one['name']);
                        $one['options'] = array();
                        foreach( $tmp2 as $k => $v ) {
                            $one['options'][$v] = $k;
                        }
                    }
                    self::$_properties[$one['name']] = $one;
                }
            }

            if( !isset(self::$_properties[$propname]) ) throw new Exception('b');

            if( (self::$_properties[$propname]['type'] != 4 && self::$_properties[$propname]['type'] != 5) ||
                !isset(self::$_properties[$propname]['options']) ) throw new Exception('c');

            if( !isset(self::$_properties[$propname]['options'][$propvalue]) ) throw new Exception('d');

            $res = self::$_properties[$propname]['options'][$propvalue];
        }
        catch( Exception $e ) {
        }
        return $res;
    }

    public static function get_multiselect_text($propname,$propvalue)
    {
        $values = explode(',',$propvalue);
        $res = array();
        foreach( $values as $one ) {
            $res[] = self::get_dropdown_text($propname,$one);
        }
        return $res;
    }

    public static function get_group_list()
    {
        $list = array_flip(self::_get_module()->GetGroupList());
        return $list;
    }

    public static function get_user_groups($uid=null)
    {
        if( $uid < 1 ) $uid = self::_get_module()->LoggedInId();
        if( $uid < 1 ) return;

        $groups = self::_get_module()->GetMemberGroupsArray( $uid );
        $gns = array();
        $gids = array();
        if( $groups !== false ) {
            foreach( $groups as $gid ) {
                $gids[] = $gid['groupid'];
                $gns[$gid['groupid']] = self::_get_module()->GetGroupName($gid['groupid']);
            }
        }
        return $gns;
    }

    public static function is_user_memberof($groups,$uid=null)
    {
        if( $uid < 1 ) $uid = self::_get_module()->LoggedInId();
        if( $uid < 1 ) return;

        if( !is_array($groups) ) $groups = explode(',',$groups);
        $tmp = array();
        foreach( $groups as $grp ) {
            $grp = trim($grp);
            if( !$grp ) continue;
            $tmp[] = $grp;
        }
        if( !count($tmp) ) return;

        $groups = self::get_user_groups($uid);
        foreach( $tmp as $one ) {
            if( in_array($one,$groups) ) return TRUE;
        }
    }
}

#
# EOF
#
?>
