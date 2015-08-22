<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: FrontEndUsers (c) 2008-2015 by Robert Campbell
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
if( !isset($gCms) ) return;

$uid = $this->LoggedInId();
if( $uid < 1 ) return;

// replace {$groupname} with the first groupname we can find that matches
$groups = $this->GetMemberGroupsArray( $uid );
$groupnames = array();
foreach( $groups as $one ) {
    $groupnames[] = $this->GetGroupName( $one['groupid'] );
}

$feu_data = array();
$feu_data['userid'] = $uid;
$feu_data['username'] = $this->LoggedInName();
$feu_data['member_groups'] = $groupnames;
$feu_data['url_logout'] = $this->create_url($id,'logout',$returnid);

$pageid = $returnid;
if( ($tmp = $this->GetPreference('pageid_changesetting')) ) {
    $tpl = $this->CreateSmartyTemplate('string:'.$tmp);
    $tpl->assign('group',$groupname);
    $tpl->assign('groupid',$groups[0]['groupid']);
    $tpl->assign('username',$username);
    $tpl->assign('uid',$uid);
    $tmp = $tpl->fetch();
    if( $tmp ) $pageid = $this->resolve_alias_or_id($tmp,$returnid);
}
$feu_data['url_changesettings'] = $this->create_url($id,'default',$pageid,array('form'=>'changesettings'));

$props = $this->GetUserProperties( $uid );
foreach( $props as $p ) {
    $feu_data[$p['title']] = $p['data'];
}

$smarty->assign('feu_data',$feu_data);
$smarty->assignGlobal('feu_data',$feu_data);
