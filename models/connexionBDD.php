<?php

function bddConnexion(){

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ping10";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

return $conn;
}

?>