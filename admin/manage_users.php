<?php
session_start();
// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin'])) {
    header('Location: login.php'); // Rediriger vers la page de connexion
    exit();
}

// Inclure le fichier de configuration de la base de données
include('db_config.php');

// Traitement des actions de gestion des utilisateurs ici
// Vous pouvez ajouter, modifier ou supprimer des utilisateurs

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Utilisateurs</title>
    <!-- Ajoutez ici des liens vers des fichiers CSS -->
</head>
<body>
    <h1>Gestion des Utilisateurs</h1>
    <!-- Affichez ici la liste des utilisateurs et des fonctionnalités de gestion -->
</body>
</html>
