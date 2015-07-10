<?php


class errorGenerator{


	public static function 404($id, $label, ){

		$forge = cms_utils::get_module('Forge2FrontOffice');

		$forge->Redirect($id, 'message', '', array('code'=>, 404, 'label' => $label));
	}

}

?>