<?php
session_start();

// Vérifier la connexion à la BDD
include 'includes/inc_Connect.php';

$email = '';
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider et nettoyer l'e-mail entré par l'utilisateur
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if (!$email) {
        $erreur = 'L\'adresse e-mail n\'est pas valide.';
    } else {
        // Vérifier si l'e-mail existe dans la BDD
        $requete = "SELECT * FROM usertable WHERE email = :email";
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // E-mail existe, afficher le formulaire de question réponse
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
                <style>
                    .formQuestion {
                        display: <?php echo isset($_POST['question']) ? 'none' : 'block'; ?>;
                    }

                    .formPass {
                        display: <?php echo isset($_POST['question']) ? 'block' : 'none'; ?>;
                    }

                    .formMail {
                        display: <?php echo isset($_POST['question']) ? 'none' : 'block'; ?>;
                    }
                </style>
            </head>

            <body>
                <!-- formulaire question réponse -->
                <div class="container">
                    <div class="login-box">
                        
                            <form action="verif_question.php" method="POST">
                                <a href="index.html">
                                    <img src="assets/images/logos/logo1.png" alt="Logo de l'association" class="association-logo">
                                </a>
                                <h2 class="loginTitle-text">Verification de votre réponse</h2>
                                <?php if (!empty($erreur)) : ?>
                                    <p style="color: red;"><?php echo $erreur; ?></p>
                                <?php endif; ?>
                                <div class="input-box">
                                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                                    <select name="question" class="select-field" required>
                                        <option value="1">Quel est le nom de votre animal de compagnie ?</option>
                                        <option value="2">Quel est le nom de jeune fille de votre mère ?</option>
                                        <option value="3">Quel est votre lieu de naissance ?</option>
                                    </select>
                                </div>
                                <div class="input-box">
                                    <input type="text" class="name" name="reponse" required placeholder="Réponse à la question de sécurité">
                                </div>
                                <div class="btn-box">
                                    <a href="login.php">Annuler</a>
                                    <button type="submit" class="btn-next" name="verify_answer">Vérifier</button>
                                </div>
                            </form>
                       
                    </div>
                </div>
                <script src="assets/js/vuemdp.js"></script>
            </body>

            </html>
<?php
            // Vérifier le formulaire de question réponse
            if (isset($_POST['question']) && isset($_POST['reponse'])) {
                $question = $_POST['question'];
                $reponse = $_POST['reponse'];

                // Vérifier la question et la réponse dans la BDD
                $requete = "SELECT * FROM usertable WHERE email = :email AND question = :question AND reponse = :reponse";
                $stmt = $connexion->prepare($requete);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':question', $question, PDO::PARAM_INT);
                $stmt->bindParam(':reponse', $reponse, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    // Question et réponse correctes, rediriger vers la page de réinitialisation du mot de passe
                    header("Location: new_password.php?email=" . urlencode($email));
                    exit;
                } else {
                    // Question ou réponse incorrecte, afficher un message d'erreur
                    echo '<div>La question ou la réponse est incorrecte.</div>';
                }
            }
        } else {
            // E-mail n'existe pas, afficher un message d'erreur
            echo 'L\'adresse e-mail renseignée n\'existe pas.';
        }
    }
}

// Fermer la connexion à la BDD
$connexion = null;
?>