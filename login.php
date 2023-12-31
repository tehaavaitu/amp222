<?php
session_start(); // Démarre la session

// Inclure le fichier de connexion PDO
include 'includes/inc_Connect.php';

$cleChiffrement = 'votre_clé_de_chiffrement'; // Assurez-vous d'utiliser la même clé pour le chiffrement et le décryptage

$erreur = "";
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) { // Vérifie si le formulaire a été soumis avec le bouton de connexion

  // Récupérez les données soumises par le formulaire
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Préparez la requête SQL pour rechercher l'utilisateur par email et par rôle
  $sql = "SELECT * FROM usertable WHERE email = :email";

  // Utilisez une requête préparée PDO pour éviter les injections SQL
  $stmt = $connexion->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    // Utilisateur trouvé, vérifiez le mot de passe
    if (password_verify($password, $row['password'])) {
      // Mot de passe correct, l'utilisateur est authentifié
      if ($row['role'] === 'admin') {
        // L'utilisateur a le rôle "admin", redirigez-le vers la page admin.php
        header('Location: admin/index.php');
        exit;
      } elseif ($row['role'] === 'user') {
        // L'utilisateur a le rôle "user", redirigez-le vers la page new_page.html
        header('Location: new_page.html');
        exit;
      }
    } else {
      // Mot de passe incorrect
      $erreur = 'Identifiants incorrects. Veuillez réessayer.';
    }
  } else {
    // Aucun utilisateur trouvé avec cet email
    $erreur = 'Utilisateur non trouvé. Veuillez vérifier vos identifiants.';
  }
}

// Fermer la connexion à la BDD
$connexion = null;
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
            <span><p style="color: red;"><?php echo $erreur; ?></p></span>
          </div>

          <div class="page email-page">
            <div class="input-box">
              <input type="text" class="email" name="email" autofocus autocomplete="off" required />
              <label>Entrez votre email</label>
            </div>

            <div class="input-box">
              <input type="password" class="password" name="password" id="passLog" autocomplete="off" required />
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

  <script src="assets/js/vuemdp.js"></script>
</body>

</html>