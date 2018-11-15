<?php

include_once("connexionBDD.php");

//Cette fonction vérifie si le couple (id,mdp) saisi est présent dans la bdd
function authentication($id,$password){

    //new connection to database
    $conn = bddConnexion();

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