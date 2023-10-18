<?php
session_start();
// Vérifiez si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin'])) {
    header('Location: login.php'); // Redirigez vers la page de connexion
    exit();
}

// Inclure le fichier de configuration de la BDD
include('db_config.php');

// Traitement du formulaire de modification de l'image
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données soumises depuis le formulaire
    $imageId = $_POST['image_id'];
    $newImagePath = $_POST['new_image_path'];
    $newAltText = $_POST['new_alt_text'];

    // Effectuez la mise à jour dans la BDD (vous devrez écrire cette partie)
    // Assurez-vous de valider et de sécuriser les données avant de les utiliser dans une requête SQL.

    // Après la mise à jour, redirigez l'administrateur vers une page de confirmation ou de gestion.
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier le Contenu</title>
    <!-- Ajoutez ici des liens vers des fichiers CSS -->
</head>

<body>
    <h1>Modifier le Contenu de l'Actualité</h1>
    <form method="post" action="">
        <label for="image_id">Sélectionnez l'image à modifier :</label>
        <select name="image_id" id="image_id">
            <option value="1">Image 1</option>
            <option value="2">Image 2</option>
            <option value="3">Image 3</option> <!-- Sélectionnez la 3ème image -->
        </select>
        <br>

        <label for="new_image_path">Nouveau chemin de l'image :</label>
        <input type="text" name="new_image_path" id="new_image_path" required>
        <br>

        <label for="new_alt_text">Nouveau texte alternatif :</label>
        <input type="text" name="new_alt_text" id="new_alt_text" required>
        <br>

        <button type="submit">Enregistrer les modifications</button>
    </form>
</body>

</html>