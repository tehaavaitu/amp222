<?php
// Vérifier la connexion à la bdd
include 'includes/inc_Connect.php';

$email = isset($_GET['email']) ? urldecode($_GET['email']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer données du formulaire
    $email = $_POST['email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($pass1 === $pass2) {
        if (strlen($pass1) >= 8) {
            // Requêtes préparées pour éviter les injections SQL
            $stmt = $connexion->prepare("SELECT * FROM usertable WHERE email = ?");
            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    // L'utilisateur existe, mettre à jour le mot de passe
                    $hashedPassword = password_hash($pass1, PASSWORD_DEFAULT);
                    $stmt = $connexion->prepare("UPDATE usertable SET password = ? WHERE email = ?");
                    $stmt->bind_param("ss", $hashedPassword, $email);

                    if ($stmt->execute()) {
                        header("Location: login.php?email=$email");
                        exit;
                    } else {
                        echo "Erreur lors de la mise à jour du mot de passe : " . $stmt->error;
                    }
                } else {
                    echo "Aucun utilisateur trouvé avec cet email.";
                }
            } else {
                echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
            }
        } else {
            echo "Le mot de passe doit contenir au moins 8 caractères.";
            echo '<style>.formPass {display: block;}</style>';
        }
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }
}

// Fermer la connexion à la bdd
mysqli_close($connexion);
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

    <title>AMP - recuperation</title>

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
                <a href="index.html">
                    <img src="assets/images/logos/logo1.png" alt="Logo de l'association" class="association-logo">
                </a>
                <h2 class="loginTitle-text">Récupération de compte</h2>

                <div class="page email-page">
                    <div class="input-box">
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                        <input type="password" id="pass" class="password" name="pass1" required />
                        <img src="assets/images/logos/redEye.png" id="eyepass" onClick="changer('pass')" />
                        <label>Creer un mot de passe</label>
                    </div>

                    <div class="input-box">
                        <input type="password" id="confirmPass" class="confirm-password" name="pass2" required />
                        <img src="assets/images/logos/redEye.png" id="eyeconfirmPass" onClick="changer('confirmPass')" />
                        <label>Confirmez le mot de passe</label>
                    </div>

                    <div class="btn-box">
                        <a href="login.php">Annuler</a>
                        <button type="submit" class="btn-next" name="new_password">Valider</button>
                    </div>
            </form>

        </div>
    </div>

    <script src="assets/js/script.js"></script>

</body>

</html>