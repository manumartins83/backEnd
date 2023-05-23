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
  //1. Trouvez le numéro de semaine de la date suivante : 14/07/2019.

  $date = new DateTime("2019-07-14");
  echo "Le numéro de semaine de la date 14/07/2019 est " . $date->format("W");

  echo "<hr>";
  ?>
</body>

</html>