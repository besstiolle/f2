<?php
if (!function_exists('cmsms')) exit;


$d_shortname = $this->GetPreference('d_shortname','');
if(empty($d_shortname)){
	echo $this->ShowErrors($this->Lang('shortname_null'));
	return;
}

$smarty = cmsms()->GetSmarty();
$smarty->assign('d_shortname', $d_shortname);

echo $this->ProcessTemplate('counter.tpl');

?>