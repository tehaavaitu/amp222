<?php
// Vérifier la connexion à la BDD
include 'includes/inc_Connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Vérifier si l'e-mail existe dans la BDD en utilisant une requête préparée
    $requete = "SELECT * FROM usertable WHERE email = :email";
    $stmt = $connexion->prepare($requete);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // E-mail existe, rediriger vers verif_question.php pour réinitialiser le mot de passe
        header("Location: verif_question.php?email=$email");
        exit();
    } else {
        // E-mail n'existe pas, afficher un message d'erreur
        $erreur = "Aucun identifiant trouvé.";
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
    <link rel="icon" type="image/png" href="assets/images/logos/amp.jpg" />

    <title>AMP - login</title>

    <!-- Fichiers CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap" rel="stylesheet" />

    <link href="assets/css/login.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="login-box">
            <form action="verif_question.php" method="POST">
                <div class="page-box">
                    <div class="login-title">
                        <a href="index.html">
                            <img src="assets/images/logos/logo1.png" alt="Logo de l'association" class="association-logo">
                        </a>
                        <h2 class="loginTitle-text">Récupération de compte</h2>
                        <?php if (!empty($erreur)) : ?>
                            <p class="error-message"><?php echo $erreur; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="page email-page">
                        <div class="input-box">
                            <input type="text" class="email" name="email" autofocus required />
                            <label>Entrez votre email</label>
                        </div>

                        <div class="log-link">
                            <a href="login.php">Se connecter</a>
                        </div>

                        <div class="btn-box">
                            <a href="new.php">Créer un compte</a>
                            <button type="submit" class="btn-next" name="reset">Valider</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>

</html>