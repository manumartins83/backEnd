<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>exo1</title>
</head>

<body>

  <?php
  $a = 0;
  while ($a <= 150) {
    if ($a % 2 != 0) {
      echo $a . " ";
    }
    $a++;
  }
  echo "<hr>";
  ?>

</body>

</html>