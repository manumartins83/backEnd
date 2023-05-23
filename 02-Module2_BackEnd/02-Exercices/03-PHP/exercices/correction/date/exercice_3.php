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
  echo "Exercices: Comment déterminer si une année est bissextile ?";
  echo "<br>";
  echo "<br/>";

  $date = new DateTime();
  $year = $date->format("Y");

  if ($year % 4 == 0 && $year % 100 != 0 || $year % 400 == 0) {
    echo "L'année " . $year . " est bissextile";
  } else {
    echo "L'année " . $year . " n'est pas bissextile";
  }
  ?>
</body>

</html>