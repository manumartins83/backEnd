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
  //Ajoutez 1 mois à la date courante.

  echo "Ajoutez 1 mois à la date courante.";
  echo "<br>";
  echo "<br/>";
  $date = new DateTime();
  $date = $date->add(new DateInterval("P1M"));
  echo "Dans un mois, nous serons le " . $date->format("d/m/Y");
  ?>
</body>

</html>