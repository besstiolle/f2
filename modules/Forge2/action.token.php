<?php
if (!function_exists("cmsms")) exit;

$response = new ApiResponse($_GET);

//Generate a new Token.
$response = OAuth::getToken($response);

//Display result
echo $response;
exit;
