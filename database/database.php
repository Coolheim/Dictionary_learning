<?php 

$hostname = "localhost";
$dbUser = "kulheimm"; // Replace with your MySQL username
$dbPassword = "swa_projekt_24"; // Replace with your MySQL password
$dbName = "kulheimm_dic_learning"; // Ensure the database name is correct

$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
