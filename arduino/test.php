<?php
require '../config/database.php';
require '../lib/Database.php';
require ('../lib/AccessLog.php');
header("Content-type: text/html");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

if(strlen($_POST["data"]) > 1 )
{
$db = new Database();
	  echo "1"; // if it displays 1 it worked
	  $accessLogObj = new AccessLog($db);
	  $accessLogObj->create(null, $_POST["data"], 2, time());
            $accessLogObj->save();
}
if(strlen($_POST["submit"]) > 1 )
{
	  echo "2";  // if it displays 1 it worked
}
?>