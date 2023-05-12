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
  //Combien reste-t-il de jours avant la fin de votre formation ?

  echo "<br/>";
  echo "Exercices: Combien reste-t-il de jours avant la fin de votre formation ?";
  echo "<br>";
  echo "<br>";

  $date = new DateTime();
  $end = new DateTime("2023-09-10");
  $interval = $date->diff($end)

  // echo "Il reste " . $interval->format("%a") . " jours avant la fin de la formation";
  ?>
</body>

</html>