<?php
$svr 	= "BEDEGONG\SQLSERVER";
$user 	= "sa";
$pass 	= "123!";
$db2	= "V@LID49V6_2020";

$connectionoptions = array("Database" => $db2, "UID" => $user, "PWD" => $pass, "MultipleActiveResultSets" => '1');
$conn2 = sqlsrv_connect($svr, $connectionoptions);