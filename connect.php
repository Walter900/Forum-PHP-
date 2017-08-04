<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "php_bbs";

//connect to the database
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName) ;
	


$connect = mysql_connect("localhost", "root", "") or die ("could not connect to server");
	mysql_select_db("php_bbs") or die ("could not connect to database");
	
?>

