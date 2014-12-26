<?php

include_once("../../../lib/class.MyFinder.php");
$tmp_path = "../../../../../tmp/cache/JQueryFU/";
$myFinder = new MyFinder("../../../../../tmp/cache/");


if(!isset($_GET['name']) || empty($_GET['name']))
{
  echo "<h3>name not setted</h3>";
  exit -1;
}
if(!isset($_GET['hash']) || empty($_GET['hash']))
{
  echo "<h3>hash not setted</h3>";
  exit -2;
}

$name = $_GET['name'];
if(!preg_match("#^[a-zA-Z0-9]+$#", $name)) {
  echo "<h3>name's name not ok</h3>";
  exit -3;
}

$hash = $_GET['hash'];
if(!preg_match("#^[a-zA-Z0-9]+$#", $hash)) {
  echo "<h3>hash's name not ok</h3>";
  exit -4;
}

$name.=".php";



if(!file_exists($tmp_path.$name))
{
  echo "<h3>file's  not found</h3> : ".$tmp_path.$name;
  exit -5;
}

include_once($tmp_path.$name);

?>