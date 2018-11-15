<?php

include_once("connexionBDD.php");

//récupérer le nom de l'utilisateur dans la BDD
function getUserFromDB($conn_id,$password){

    //new connection to database
    $conn = bddConnexion();

    // prepare and bind
    $stmt = $conn->prepare("SELECT id,nom,prenom,statut FROM USERS WHERE conn_id=? AND mdp=?");
    $stmt->bind_param("ss", $conn_id, $password);
    
    //execute and get the status
    $stmt->execute();
    $stmt->bind_result($dbID,$dbFirstName,$dbLastName,$dbStatus);
    $stmt->fetch();

    //stockage du résultat de la requête dans un array
    $userInfos = array(
        "id" => $dbID,
        "nom" => $dbFirstName,
        "prenom" => $dbLastName,
        "statut" => $dbStatus
    );

    //close the connection
    $stmt->close();
    $conn->close();

    return $userInfos;
}

?>