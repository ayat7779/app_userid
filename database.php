<?php
$svr 	= "xxxxxxxxxxxxxx";
$user 	= "xxxxx";
$pass 	= "xxxxx";
$db2	= "xxxxxxxxxxxxxxxx";

$connectionoptions = array("Database" => $db2, "UID" => $user, "PWD" => $pass, "MultipleActiveResultSets" => '1');
$conn2 = sqlsrv_connect($svr, $connectionoptions);
