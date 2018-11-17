<?php
//destruction des variables de session + destruction de la session et redirection page d'accueil
session_start();
session_unset();
session_destroy();

header('location:../views/connexion.phtml');
?>