<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>base</title>
</head>

<body>

  <?php
  echo 'L\'adresse IP de l\'utilisateur est : ' . $_SERVER['REMOTE_ADDR'] . '<br>';
  echo 'L\'adresse IP du Server XAMPP est : ' . (isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : 'Non défini');
  echo '<br>';
  ?>

</body>

</html>