<?php

final class feu_smarty_plugins
{
    private function __construct() {}

    public static function feu_protect($params,$content,&$smarty,$repeat)
    {
        if( !$content ) return;

        $feu = \cms_utils::get_module(MOD_FRONTENDUSERS);
        if( !($uid = $feu->LoggedInId()) ) return;

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
            return;
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
        if( !count($gids) ) return;

        $membergroups = $feu->GetMemberGroupsArray($uid);
        if( !is_array($membergroups) || count($groups) == 0 ) {
            // groups specified, but user is not a member of any groups.
            return;
        }

        // FINAL test, if the user is a member of any of these groups, output the content.
        for( $i = 0; $i < count($membergroups); $i++ ) {
            $gid = $membergroups[$i]['groupid'];
            if( in_array($gid,$gids) ) return $content;
        }

        // user is not a member of any of the specified groups.
    }
} // end of class
?>