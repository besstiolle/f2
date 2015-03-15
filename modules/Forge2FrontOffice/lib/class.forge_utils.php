<?php

final class forge_utils
{
    protected function __construct() {}

    /**
     * Will return true if the user is admin of the project
     *
     * @project the Entity project
     * @user_id the id of the logged user
     *
     **/
    public static function is_project_admin($project, $user_id) {

    	return forge_utils::has_role_on_project(
          $project, 
          $user_id, 
          Enum::FromString('EnumAssignmentRole::Administrator'));
    }

    /**
     * Will return true if the user is member of the project
     *
     * @project the Entity project
     * @user_id the id of the logged user
     *
     **/
    public static function is_project_member($project, $user_id) {

      return forge_utils::has_role_on_project(
          $project, 
          $user_id, 
          Enum::FromString('EnumAssignmentRole::Member'));
    }


    /**
     * Will return true if the user has the role on the project
     *
     * @project the Entity project
     * @user_id the id of the logged user
     * @role string const of the Enum EnumAssignmentRole
     *
     **/
    protected static function has_role_on_project($project, $user_id, $role) {

        foreach($project['assignments'] as $assignment){
            if($assignment['user_id'] == $user_id){
         //     echo '#'.$assignment['role'].' '.$role.' '.Enum::FromString('EnumAssignmentRole::Member');
                if($role == $assignment['role']){
         //         die();
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Will return a random string of 20 car by default
     *
     * @length 20 by default
     *
     **/
    public static function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Will write a cookie before any confirmation of action to avoid scam-url abusing.
     *
     * @param $action : String the name of action (delete / edit / ...)
     * @param $id : the id of the ressource, used to make each cookie unique.
     */
    public static function putCookie($action, $id){
        $sha1Key = sha1($action . $id);
        $salt = forge_utils::generateRandomString();
        cms_cookies::set($sha1Key."_s", $salt);
        cms_cookies::set($sha1Key."_h", sha1($salt.forge_utils::getConnectedUserId()));
    }

    /**
     * Will test if the cookie of confirmation exist and if true will delete it to avoid double clicking
     *
     * @param $action : String the name of action (delete / edit / ...)
     * @param $id : the id of the ressource, used to make each cookie unique.
     */
    public static function hasCookie($action, $id){
        $sha1Key = sha1($action . $id);
        if(!cms_cookies::exists($sha1Key."_s") || !cms_cookies::exists($sha1Key."_h")){
            return false;
        }
        $salt = cms_cookies::get($sha1Key."_s");
        $hash = cms_cookies::get($sha1Key."_h");

        $sha1 = sha1($salt.forge_utils::getConnectedUserId());
        if($hash !== $sha1){
            return false;
        }

        $salt = cms_cookies::erase($sha1Key."_s");
        $hash = cms_cookies::erase($sha1Key."_h");

        return true;
    }

    /**
     * Will return the FEU module
     *
     **/
    public static function getFEU(){
    	return cms_utils::get_module('FrontEndUsers');
    }

    /**
     * Will return the id of the current FEU user connected or NULL
     *
     **/
    public static function getConnectedUserId(){
    	$FEU = cms_utils::get_module('FrontEndUsers');
    	if(!$FEU->LoggedIn()){
    		return null;
    	}
    	return $FEU->LoggedInId();
    }

    /**
     * Will perform a basic redirection to a custom url without keeping any information about the
     * current navigation
     *
     * @param url string the url
     **/
    public static function redirect($url){
          header('Status: 302 Moved Temporarily', false, 302);      
          header('Location: '.$url);   
          exit(); 
    }

    /**
     * Will perform a basic redirection to a custom url without keeping any information about the
     * current navigation
     *
     * @param url the url relativ to cmsms
     **/
    public static function inner_redirect($url){
        $config = cmsms()->GetConfig();
        $url_cms = $config['root_url'].$url;
        forge_utils::redirect($url_cms);
    }

    public static function getFilesInDir($directory, $pattern){
        $files = array();
        if(!is_dir($directory)){
            return null;
        }
        if ($handle = opendir($directory)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && !is_dir($entry) && preg_match( $pattern , $entry)) {
                   $files[] = $entry;
                }
            }
            closedir($handle);
        }
        return $files;
    }
}