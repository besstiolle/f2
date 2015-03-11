<?php

final class forge_utils
{
    protected function __construct() {}

    public static function is_project_admin($project, $user_id) {

    	return forge_utils::has_role_on_project($project, $user_id, Enum::FromString('EnumAssignmentRole::Administrator'));
        /*foreach($project['assignments'] as $assignment){
            if($assignment['user_id'] == $user_id){
                if(Enum::FromString('EnumAssignmentRole::Administrator') == $assignment['role']){
                    return true;
                }
            }
        }

        return false;*/
    }

    public static function is_project_member($project, $user_id) {

        foreach($project['assignments'] as $assignment){
            if($assignment['user_id'] == $user_id){
                if(Enum::FromString('EnumAssignmentRole::Member') == $assignment['role']){
                    return true;
                }
            }
        }

        return false;
    }

    protected static function has_role_on_project($project, $user_id, $role) {

        foreach($project['assignments'] as $assignment){
            if($assignment['user_id'] == $user_id){
                if($role == $assignment['role']){
                    return true;
                }
            }
        }

        return false;
    }

    public static function getFEU(){
    	return cms_utils::get_module('FrontEndUsers');
    }

    public static function getConnectedUserId(){
    	$FEU = cms_utils::get_module('FrontEndUsers');
    	if(!$FEU->LoggedIn()){
    		return null;
    	}
    	return $FEU->LoggedInId();
    }
}