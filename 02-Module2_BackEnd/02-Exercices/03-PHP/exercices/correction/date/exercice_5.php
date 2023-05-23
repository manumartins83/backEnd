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
  //Affichez l'heure courante sous cette forme : 11h25.

  echo "Exercices: Affichez l'heure courante sous cette forme : 11h25.";
  echo "<br>";
  echo "<br/>";
  $date = new DateTime();
  echo "Il est " . $date->format("H") . "h" . $date->format("i") . " et " . $date->format("s") . " secondes";
  ?>
</body>

</html>