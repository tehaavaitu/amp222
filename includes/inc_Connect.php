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

  $connexion = new mysqli($server, $user, $mdp, $database);
  
  if ($connexion->connect_error) {
    die("La connexion a échoué: <br>" . $connexion->connect_error);
  }


  ?>
</body>

</html>