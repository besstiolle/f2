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

final class feu_utils
{
    private function __construct() {}

    public static function using_std_consumer()
    {
        $feu = cge_utils::get_module('FrontEndUsers');
        $name = $feu->GetPreference('auth_module','');
        if( $name == '' || $name == '__BUILTIN__' ) return TRUE;
        return FALSE;
    }

    public static function &get_std_consumer()
    {
        $obj = new feu_std_consumer();
        return $obj;
    }

    public static function &get_auth_consumer()
    {
        $feu = cge_utils::get_module('FrontEndUsers');
        $name = $feu->GetPreference('auth_module','');
        if( $name == '' || $name == '__BUILTIN__' ) {
            return self::get_std_consumer();
        }

        $module = cge_utils::get_module($name);
        $res = null;
        if( is_object($module) ) {
            $obj = $module->GetFEUAuthConsumer();
            return $obj;
        }

        return self::get_std_consumer();
    }

    public static function get_userlist($none = null)
    {
        static $list;
        if( !is_array($list) ) {
            $list = array();

            // now add in feu users
            $feu = \cms_utils::get_module(MOD_FRONTENDUSERS);
            if( is_object($feu) ) {
                $query = new \feu_user_query;
                $query->add_and_opt(\feu_user_query_OPT::MATCH_NOTEXPIRED);
                $query->set_sortby(\feu_user_query::RESULT_SORTBY_USERNAME);
                $query->set_sortorder(\feu_user_query::RESULT_SORTORDER_ASC);
                $rs = $query->execute();
                if( $rs->get_found_rows() > 0 && $none ) {
                    $list[''] = $feu->Lang('none');
                }
                while( !$rs->EOF() ) {
                    $list[$rs->fields['id']] = $rs->fields['username'];
                    $rs->MoveNext();
                }
            }
        }
        return $list;
    }

} // class

#
# EOF
#
?>