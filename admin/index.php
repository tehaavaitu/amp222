<?php
session_start();

// Vérifier la connexion à la BDD en utilisant PDO
include '../includes/inc_Connect.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['utilisateur_connecte'])) {
  // Vérifier si la session est inactive depuis plus de 30 minutes (1800 secondes)
  if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    // La session est inactive depuis trop longtemps, déconnecter l'utilisateur
    session_unset();  // Supprimer toutes les données de la session
    session_destroy(); // Détruire la session
    header("Location: login.php"); // Rediriger vers la page de connexion
    exit();
  }

  // Mettre à jour le timestamp de la dernière activité
  $_SESSION['last_activity'] = time();
}

// Fermer la connexion à la BDD en utilisant PDO
$connexion = null; // l'objet PDO est correctement détruit

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Découvrez nos services de pêche professionnelle de haute qualité tout en soutenant la préservation des ressources marines et la vie communautaire des marins pêcheurs professionnels. Nous nous engageons à pratiquer une pêche durable et responsable pour garantir un avenir durable pour notre environnement marin et nos communautés de pêcheurs." />
  <meta name="author" content="amp" />
  <!-- Balise pour le favicon -->
  <link rel="icon" type="image/png" href="../assets/images/logos/amp.jpg" />

  <title>AMP - Admin</title>

  <!-- Fichiers CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/bootstrap-icons.css" />


  <link href="../assets/css/admin.css" rel="stylesheet" />
</head>

<body>
  <header class="bg-primary text-white text-center py-4">
    <h4>Espace d'administration du site AMP</h4>
  </header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li>
            <a class="navbar-brand" href="../index.html">
              <img src="../assets/images/logos/logo1.png" class="logo-image img-fluid" alt="logoamp" />
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.html">Revenir au site</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="membres.php">Membres</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><img src="../assets/images/logos/shut.png" class="logo-image img-fluid" alt="sortie" /></a>
          </li>

        </ul>
      </div>
    </div>
  </nav>
  <main>
    <!-- Contenu principal de la page d'accueil -->
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="..." crossorigin="anonymous"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>