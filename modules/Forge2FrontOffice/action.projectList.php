<?php

if (!function_exists("cmsms")) exit;

//Ask the last 10 modules
$json = RestAPI::GET('rest/v1/projects');
$response = json_decode($json, true);

//Get the projects in the response data
$projects = $response['data']['projects'];

//Some shitty echo
echo "<table><thead><tr><th>Id</th><th>Name</th></tr></thead>";
$config = cmsms()->GetConfig();
foreach ($projects as $project) {
	$link = $config['root_url'].'/project/'.$project['id'].'/'.$project['unix_name'];
	echo "<tr><td><a href='".$link."'>".$project['id']."</a></td><td>".$project['name']."</td></tr>";
}
echo "</table><br/><br/>";

//Debug part
var_dump($response['request']);
var_dump($response['server']);
var_dump(RestAPI::getDump());