<?php
session_start(); // Démarre la session

// Vérifier la connexion à la base de données
include 'includes/inc_Connect.php';

$cleChiffrement = 'votre_clé_de_chiffrement'; // Assurez-vous d'utiliser la même clé pour le chiffrement et le décryptage

$erreur = "";
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $question = $_POST['question'];
    $reponse = $_POST['reponse'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifier si l'email existe déjà dans la base de données
    $requete = "SELECT * FROM usertable WHERE email = ?";
    $stmt = mysqli_prepare($connexion, $requete);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($result);

    // Ajouter une vérification de longueur minimale pour le nom et la réponse
if (strlen($name) < 3 || strlen($reponse) < 5) {
    $erreur = "Le nom doit avoir au moins 3 caractères et la réponse au moins 5 caractères.";
} else {
    if ($num_rows > 0) {
        // Si l'email existe déjà, afficher un message d'erreur
        $erreur = "Cet email est déjà utilisé.";
    } else 
        // Vérifier si les mots de passe correspondent
        if ($password !== $confirm_password) {
            $erreur = "Les mots de passe ne correspondent pas.";
        } elseif (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
            // Vérifier les restrictions du mot de passe
            $erreur = "Le mot de passe doit avoir une longueur minimale de 8 caractères avec au moins une lettre minuscule, une lettre majuscule, un chiffre.";
        } else {
            // Hasher le mot de passe
            $mdpHash = password_hash($password, PASSWORD_DEFAULT);

            // Définir le statut comme "actif" et la date d'inscription
            $role = "user";
            $status = "actif";
            $date_inscription = date("Y-m-d H:i:s"); // Date actuelle

            // Enregistrements dans la table
            $requete = "INSERT INTO usertable (name, question, reponse, email, password, role, status, date_inscription) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($connexion, $requete);
            mysqli_stmt_bind_param($stmt, "ssssssss", $name, $question, $reponse, $email, $mdpHash, $role, $status, $date_inscription);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Inscription réussie !";

                // Réinitialiser les champs
                $name = "";
                $question = "";
                $reponse = "";
                $email = "";

                // Rediriger l'utilisateur vers la page de connexion
                header("Location: login.php");
                exit();
            } else {
                $erreur = "Erreur lors de l'inscription : " . mysqli_error($connexion);
            }
        }
    }

    // Fermer la requête et la connexion à la base de données
    mysqli_stmt_close($stmt);
    mysqli_close($connexion);
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
            <form action="new.php" method="POST">
                <div class="page-box">
                    <div class="login-title">
                        <a href="index.html">
                            <img src="assets/images/logos/logo1.png" alt="Logo de l'association" class="association-logo">
                        </a>
                        <h2 class="loginTitle-text">Création de Compte</h2>
                        <p class="user-email">Inscrivez-vous sur notre plateforme</p>
                        <?php if (!empty($erreur)) { ?>
                            <p style="color: red;"><?php echo $erreur; ?></p>
                        <?php } ?>
                        <?php if (!empty($message)) { ?>
                            <p style="color: green;"><?php echo $message; ?></p>
                        <?php } ?>
                    </div>

                    <div class="page new-page">
                        <div class="input-box">
                            <input type="text" class="name" name="name" autofocus required value="<?php echo isset($name) ? $name : ''; ?>" />
                            <label>Nom complet</label>
                        </div>

                        <div class="input-box select-box">
                            <select name="question" class="select-field" required>
                                <option value="1">Quel est le nom de votre animal de compagnie ?</option>
                                <option value="2">Quel est le nom de jeune fille de votre mère ?</option>
                                <option value="3">Quel est votre lieu de naissance ?</option>
                            </select>
                        </div>

                        <div class="input-box">
                            <input type="text" class="name" name="reponse" required value="<?php echo isset($reponse) ? $reponse : ''; ?>" />
                            <label>Réponse</label>
                        </div>

                        <div class="input-box">
                            <input type="email" class="email" name="email" required autocomplete="off" value="<?php echo isset($email) ? $email : ''; ?>" />
                            <label>Adresse e-mail</label>
                        </div>

                        <div class="input-box">
                            <input type="password" id="pass" class="password" name="password" autocomplete="off" autofocus required  />
                            <img src="assets/images/logos/redEye.png" id="eyepass" onClick="changer('pass')" />
                            <label>Mot de passe</label>
                        </div>

                        <div class="input-box">
                            <input type="password" id="confirmPass" class="confirm-password" name="confirm_password" required />
                            <img src="assets/images/logos/redEye.png" id="eyeconfirmPass" onClick="changer('confirmPass')" />
                            <label>Confirmez le mot de passe</label>
                        </div>

                        <div class="btn-box">
                            <a href="login.php">Se connecter</a>
                            <button type="submit" class="btn-next" name="create_account">Créer un compte</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>

</html>