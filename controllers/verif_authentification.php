<?php
if(!isset($_SESSION)){
    session_start();
}
include_once('../models/userDAO.php');
//var_dump($_SESSION);

if( verifUser($_SESSION['user']['id'])==false){
    header('location:../controllers/connexion_verif.php');
}


?>