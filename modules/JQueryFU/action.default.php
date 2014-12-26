<?php
if (!isset($gCms)) exit;

$config = cmsms()->GetConfig();
$smarty = cmsms()->GetSmarty();
$myFinder = new MyFinder($config['root_path'].DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR);

$parameters = array();

//By default : '/\.(txt|gif|jpe?g|png)$/i'
if(isset($params['accept_file_types'])) {
	$parameters['accept_file_types'] = html_entity_decode($params['accept_file_types'],ENT_QUOTES,'UTF-8');
}
//By default : null
if(isset($params['number'])) {
	$parameters['max_number_of_files'] = $params['number'];
}
//By default : null
if(isset($params['max_width'])) {
	$parameters['max_width'] = $params['max_width'];
}
//By default : null
if(isset($params['max_height'])) {
	$parameters['max_height'] = $params['max_height'];
}
//By default : 1 (px)
if(isset($params['min_width'])) {
	$parameters['min_width'] = $params['min_width'];
}
//By default : 1 (px)
if(isset($params['min_height'])) {
	$parameters['min_height'] = $params['min_height'];
}
//By default : true
if(isset($params['clean_name'])) {
	$parameters['clean_name'] = $params['clean_name'];
}
//By default : "\uploads\jqueryfu"
if(isset($params['dir_path'])) {
	$parameters['dir_path'] = $params['dir_path'];
}
//By default : "/uploads/jqueryfu"
if(isset($params['dir_url'])) {
	$parameters['dir_url'] = $params['dir_url'];
}

$tpl = !empty($params['template'])?TMPL_PREFIX_DISPLAY.$params['template']:TMPL_PREFIX_DISPLAY.$this->GetPreference(DEFAULT_DISPLAY_TMPL_PREF_NAME);

//Create skeleton from template 
list($name, $hash) = $myFinder->makeTheFile($this, $config, $parameters);

$smarty->assign('path',$config['root_url'].'/'.'modules'.'/'.$this->GetName().'/'."jqfu");
$smarty->assign('name',$name);
$smarty->assign('hash',$hash);


$html = $this->ProcessTemplateFromDatabase($tpl);

echo $html;

?>