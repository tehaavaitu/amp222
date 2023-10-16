<?php
session_start(); // Démarre la session

// Vérifier la connexion à la base de données
include 'includes/inc_Connect.php';

$cleChiffrement = 'votre_clé_de_chiffrement'; // Assurez-vous d'utiliser la même clé pour le chiffrement et le décryptage

$erreur = "";
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) { // Vérifie si le formulaire a été soumis avec le bouton de connexion

  // Récupérez les données soumises par le formulaire
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Préparez la requête SQL pour rechercher l'utilisateur par email
  $sql = "SELECT * FROM usertable WHERE email = ?";

  // Utilisez une requête préparée pour éviter les injections SQL
  if ($stmt = $connexion->prepare($sql)) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      // Utilisateur trouvé, vérifiez le mot de passe
      $row = $result->fetch_assoc();
      if (password_verify($password, $row['password'])) {
        // Mot de passe correct, l'utilisateur est authentifié
        echo 'Connexion réussie. Vous pouvez rediriger l\'utilisateur vers une page d\'administration ici.';
        // Vous pouvez rediriger l'utilisateur vers une page d'administration ici
        header('Location: admin.php');
        exit;
      } else {
        // Mot de passe incorrect
        $erreur = 'Identifiants incorrects. Veuillez réessayer.';
      }
    } else {
      // Aucun utilisateur trouvé avec cet email
      $erreur = 'Utilisateur non trouvé. Veuillez vérifier votre email.';
    }
    $stmt->close();
  }

  // Fermer la connexion à la base de données
  $connexion->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Découvrez nos services de pêche professionnelle de haute qualité tout en soutenant la préservation des ressources marines et la vie communautaire des marins pêcheurs professionnels. Nous nous engageons à pratiquer une pêche durable et responsable pour garantir un avenir durable pour notre environnement marin et nos communautés de pêcheurs." />
  <meta name="author" content="amp" />
  <!-- Balise pour le favicon -->
  <link rel="icon" type="image/jpg" href="assets/images/logos/amp.jpg" />

  <title>AMP - login</title>

  <!-- Fichiers CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/bootstrap-icons.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap" rel="stylesheet" />

  <link href="assets/css/login.css" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <div class="login-box">
      <form action="" method="POST">
        <div class="page-box">
          <div class="login-title">
            <a href="index.html"><img src="assets/images/logos/logo1.png" alt="Logo de l'association" class="association-logo" /></a>

            <h2 class="loginTitle-text">Connexion</h2>
            <p class="user-email">Connectez-vous sur notre plateforme</p>
          </div>

          <div class="page email-page">
            <div class="input-box">
              <input type="text" class="email" name="email" autofocus autocomplete="off" autocomplete="new-email" value="" required />
              <label>Entrez votre email</label>
            </div>

            <div class="input-box">
              <input type="password" class="password" name="password" id="passLog" autocomplete="off" autocomplete="new-password" value="" required />
              <img src="assets/images/logos/redEye.png" id="eyepassLog" onClick="changer('passLog')" />
              <label for="password">Mot de passe</label>
            </div>

            <div class="log-link">
              <a href="reset.php">Mot de passe oublié</a>
            </div>

            <div class="btn-box">
              <a href="new.php">Creer un compte</a>
              <button type="submit" class="btn-next" name="login">Se connecter</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="assets/js/script.js"></script>
</body>

</html>