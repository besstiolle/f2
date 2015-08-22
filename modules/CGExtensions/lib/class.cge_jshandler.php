<?php

final class cge_jshandler
{
    private function __construct() {}

    public static function load($libname)
    {
        $mod = cms_utils::get_module(MOD_CGEXTENSIONS);
        if( $libname == 'cg_cmsms' ) {
            // gotta return code.
            $config = cms_config::get_instance();
            $tpl = $mod->CreateSmartyTemplate('jquery.cg_cmsms.tpl');
            $tpl->assign('mod',$mod);
            $tpl->assign('config',$config);
            $code = $tpl->fetch();
            $obj = new StdClass;
            $obj->code = $code;
            return $obj;
        }
    }
} // end of class

?>