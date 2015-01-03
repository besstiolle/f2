<?php

if (!function_exists("cmsms")) exit;

//Ask the last 10 modules
$json = RestAPI::GET('rest/v1/projects');
$response = json_decode($json);

//Get the response data
$data = $response->data;

//Get the projects in the response data
$projects = $data->projects;


//Some shitty echo
echo "<table><thead><tr><th>Id</th><th>Name</th></tr></thead>";
foreach ($projects as $project) {
	echo "<tr><td>".$project->id."</td><td>".$project->name."</td></tr>";
}
echo "</table><br/><br/>";

//Debug part
var_dump($response->request);
var_dump($response->server);
var_dump(RestAPI::getDump());