<?php

final class forge_smarty_plugins
{
    protected function __construct() {}

    public static function smarty_is_project_admin($params,$smarty) {
        /*$db = \cge_utils::get_db();
        $obj = cge_utils::get_module('CGExtensions');

        $query = 'SELECT * FROM '.CGEXTENSIONS_TABLE_STATES.' ORDER BY sorting DESC,name ASC';
        $tmp = $db->GetAll($query);
        $output = '';
        if( isset($params['selectone']) ) $output .= '<option value="">'.trim($params['selectone'])."</option>\n";
        foreach( $tmp as $row ) {
            $output .= "<option value=\"{$row['code']}\"";
            if( isset($params['selected']) && $params['selected'] == $row['code'] ) $output .= ' selected="selected"';
            $output .= ">{$row['name']}</option>\n";
        }
        return $output;*/

        //print_r($smarty->get_template_vars('project'));

        $project = $params['project'];
        $user_id = $params['user_id'];
        $assign = $params['assign'];

        if(empty($project) || empty($user_id) || empty($assign)){
            return;
        }

        foreach($project['assignments'] as $assignment){
            if($assignment['user_id'] == $user_id){
                if(Enum::FromString('EnumAssignmentRole::Administrator') == $assignment['role']){
                   //$smarty->assign($assign, true);
                    return;
                }
            }
        }

        $smarty->assign($assign, false);
        return;
    }
    public static function smarty_is_project_member($params,$smarty) {
        $project = $params['project'];
        $user_id = $params['user_id'];
        $assign = $params['assign'];

        if(empty($project) || empty($user_id) || empty($assign)){
            return;
        }

        foreach($project['assignments'] as $assignment){
            if($assignment['user_id'] == $user_id){
                if(Enum::FromString('EnumAssignmentRole::Member') == $assignment['role']){
                    $smarty->assign($assign, true);
                    return;
                }
            }
        }

        $smarty->assign($assign, false);
        return;
    }
}