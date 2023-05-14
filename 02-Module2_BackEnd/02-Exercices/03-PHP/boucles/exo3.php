<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>exo3</title>
</head>

<body>

  <?php
  echo nl2br("\n");
  define('phrase', "Je dois faire des sauvegardes régulières de mes fichiers");
  for ($i = 0; $i <= 500; $i++) {
    echo $i . "." . " " . phrase . " ";
  }
  echo "<hr>";
  ?>

</body>

</html>