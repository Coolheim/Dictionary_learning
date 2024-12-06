<?php 

$hostname = "localhost";
$dbUser = "kulheimm";
$dbPassword = "swa_projekt_24";
$dbName = "kulheimm_dic_learning";

$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>