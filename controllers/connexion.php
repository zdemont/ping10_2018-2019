<?php
include_once("../models/connexionDAO.php");
include_once("../models/userDAO.php");


//if get post from connexion.phtml do connexion processing
if(isset($_POST['connexion'])){

    //transform all character on HTML form 
    $id = htmlentities($_POST['id']);
    $password = htmlentities($_POST['password']);

    var_dump($id); 

    $msg_error=[];
    $autorisationConnection = true;
    $user = getUserFromDB($id);


    //Vérification des champs vides 
    if(empty($_POST['id']) || empty($_POST['password'])){
        $msg_error[] = 'error connexion !';
        $autorisationConnection=false;
        
    }
    
    //Vérification de l'existance de l'utilisateur 
    $user_not_exist = $user["id"] == null; 
    if ($user_not_exist == true){
        $msg_error[] = 'user or password are wrong !';
        $autorisationConnection=false;
    }
    

    //mot de passe généré avec cette fonction 
    //password_hash('commercant',PASSWORD_DEFAULT);

    //Verification du mot de passe 
    $verifPassword = password_verify($password, $user['mdp']);
    if ($verifPassword == false){
        //var_dump("wrong password ");
        $msg_error[] = 'user or password are wrong !';
        $autorisationConnection=false;
    }
    
    //Connection 
    if ($autorisationConnection == true){
        session_unset();
        session_destroy();

        //redirection en fonction du statut
        if($user['statut'] == 'admin'){
            session_start();

            $_SESSION['user'] = array(
                'id' => $user['id'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'statut' => $user['statut']
            );
            header('location: ../views/start.phtml');

        }elseif($user['statut'] == 'conseiller'){
            session_start();

            $_SESSION['user'] = array(
                'id' => $user['id'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'statut' => $user['statut']
            );

            header('location: ../views/adviser.phtml');

        }elseif($user['statut'] == 'commercant'){
            session_start();

            $_SESSION['user'] = array(
                'id' => $user['id'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'statut' => $user['statut']
            );

            header('location: ../views/start.phtml');

        }

    }else {
        session_start();
        $msg_error[] = 'error connexion !';
        $_SESSION['error_connexion'] = $msg_error;
        header('location: ../views/index.phtml');
    }
}

