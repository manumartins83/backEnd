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
  //Trouver la position de la dernière occurrence de Stage pour le groupe 19001.

  echo "<br/>";
  echo "Exercice 2";
  echo "<br>";
  $group = 19001;
  $lastStageWeek = array_search("Stage", array_reverse($a[$group]));
  echo "la Derniere occurance de stage pour le goupe" . $group . "est la semaine" . (25 - $lastStageWeek);

  echo "<hr>";
  ?>
</body>

</html>