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
  echo "Exercices: Montrez que la date du 32/17/2019 est erronée.";
  echo "<br>";
  echo "<br/>";

  // Utilisez la fonction checkdate() pour valider la date
  if (checkdate(17, 32, 2019)) {
    echo "La date du 32/17/2019 est correcte";
  } else {
    echo "La date du 32/17/2019 est erronée";
  }
  ?>
</body>

</html>