<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <?php
  $server = 'localhost';
  $database = 'userform';
  $user = 'root';
  $mdp = '';

  try {
    $connexion = new PDO("mysql:host=$server;dbname=$database", $user, $mdp);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connecté avec succès<br>";
  } catch (PDOException $e) {
    echo "La connexion a échoué: " . $e->getMessage();
  }
  ?>
</body>

</html>
