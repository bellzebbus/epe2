<?php

$serverName = "localhost";
$DBuserName = "root";
$DBPass = "";
$DBName = "epe2";

$conn = mysqli_connect($serverName, $DBuserName, $DBPass, $DBName);

if (!$conn) {
	die("La connecion fallo: " . mysqli_connect_error());	
}