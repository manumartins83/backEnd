<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  echo "<hr>";
  echo "<br/>";
  echo "Afficher la date ";
  echo "<br>";

  // on déclare une instance de l'objet PHP 'DateTime' :
  $date = new DateTime();
  // on affiche le résultat :
  echo $date->format('Y-m-d H:i:s');

  echo "<hr>";

  echo "FUNCTIONS";
  echo "<br/>";
  echo "1 Exercices
  Utilisez l'objet DateTime, sauf mention contraire.";
  echo "<br>";
  ?>
</body>

</html>