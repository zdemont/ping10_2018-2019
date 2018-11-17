<?php

include_once("connexionBDD.php");

//récupérer le nom de l'utilisateur dans la BDD
function getUserFromDB($conn_id){

    //new connection to database
    $conn = bddConnexion();

    // prepare and bind
    $stmt = $conn->prepare("SELECT id,nom,prenom,statut,mdp FROM USERS WHERE conn_id=?");
    $stmt->bind_param("s", $conn_id);
    
    //execute and get the status
    $stmt->execute();
    $stmt->bind_result($dbID,$dbFirstName,$dbLastName,$dbStatus, $dbpassword);
    $stmt->fetch();

    //stockage du résultat de la requête dans un array
    $userInfos = array(
        "id" => $dbID,
        "nom" => $dbFirstName,
        "prenom" => $dbLastName,
        "statut" => $dbStatus,
        "mdp" => $dbpassword
    );

    //close the connection
    $stmt->close();
    $conn->close();
    return $userInfos;
}

function verifUser ($id){
    //new connection to database
    $conn = bddConnexion();

    // prepare and bind
    $stmt = $conn->prepare("SELECT * FROM USERS WHERE id=?");
    $stmt->bind_param("s", $id);

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