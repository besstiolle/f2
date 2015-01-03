<?php

if (!function_exists("cmsms")) exit;

$projectId = $params['projectId'];

//Ask the module/tag/...
$json = RestAPI::GET('rest/v1/projects/'.$projectId.'/a');
$response = json_decode($json);

//Get the response data
$data = $response->data;

//Get the projects in the response data
$projects = $data->projects;


//Some shitty echo
echo "<table><thead><tr><th>Id</th><th>Name</th></tr></thead>";
$config = cmsms()->GetConfig();
foreach ($projects as $project) {
	$link = $config['root_url'].'/project/'.$project->unix_name.'/'.$project->id;
	echo "<tr><td><a href='".$link."'>".$project->id."</a></td><td>".$project->name."</td></tr>";
}
echo "</table><br/><br/>";

//Debug part
var_dump($response->request);
var_dump($response->server);
var_dump(RestAPI::getDump());