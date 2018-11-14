<?php

$id_admin = admin;
$pass_admin = admin;

$id_adviser = conseiller;
$pass_adviser = conseiller;

$id_retailer = commercant;
$pass_retailer = commercant;


if(isset($_POST['connexion'])){
    $id = htmlentities($_POST['id']);
    $password = htmlentities($_POST['password']);

    $msg_error=[];

    $autorisationConnection = true;


    if(empty($_POST['id']) || empty($_POST['password'])){

        $msg_error[] = 'error connexion !';
        $autorisationConnection=false;
        
    }





    if ($id == $id_admin & $password == $pass_admin){
        header('location: ../views/admin.phtml');
    }

    elseif ($id == $id_adviser & $password == $pass_adviser){
        header('location: ../views/adviser.phtml');
    }
    
    elseif ($id == $id_retailer & $password == $pass_retailer){
        header('location: ../views/retailer.phtml');
    }

    else {
        $msg_error[] = 'error connexion !';
        header('location: ../views/connexion.phtml');
    }
}

