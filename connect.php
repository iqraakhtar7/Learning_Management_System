<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "dcs-ubit";

$con = mysql_connect($host,$user,$password) or die("Could not connect to database");
mysql_select_db($db,$con) or die("No database selected");

?>