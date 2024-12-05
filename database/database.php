<?php 

$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "kulheimm";

$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

if (!$conn){
    die("Something went wrong XD");
}


?>