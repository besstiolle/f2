<?php
if (!function_exists("cmsms")) exit;

$response = new ApiResponse($params);

//Generate a new Token.
$response = OAuth::getNewToken($response);

//Display result
echo $response;
exit;
