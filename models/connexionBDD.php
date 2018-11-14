<?php

function bdd_connexion(){

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_ping10";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

return $conn;
}


//Cette fonction vérifie si le couple (id,mdp) saisi est présent dans la bdd
function authentication($id,$password){

    //new connection to database
    $conn = bdd_connexion();

    // prepare and bind
    $stmt = $conn->prepare("SELECT * FROM USERS WHERE conn_id=? AND mdp=?");
    $stmt->bind_param("ss", $id, $password);
    
    //execute and store the results
    $stmt->execute();
    $stmt->store_result();
    $result = $stmt->num_rows; 

    //close the connection
    $stmt->close();
    $conn->close();

    //check the result of the query
    if($result != 1)
        return false;//renvoyer false si la requête ne renvoie aucune ligne
    else
        return true;//renvoyer true si la requête renvoie une ligne
}


?>