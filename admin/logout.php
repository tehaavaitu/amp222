<?php
session_start();

// Inclure le fichier de connexion PDO
include '../includes/inc_Connect.php';

// Supprimer toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion
header('Location: ../login.php');
?>