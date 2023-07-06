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
  //Combien de semaines dure le stage du groupe 19003 ?

  echo "<br/>";
  echo "Exercice 4";
  echo "<br>";

  $group = 19003;
  $lastStageWeek = array_search("Stage", array_reverse($a[$group]));
  $firstStageWeek = array_search("Stage", $a[$group]);

  echo "Le stage du groupe " . $group . " dure " . ($lastStageWeek - $firstStageWeek + 1) . " semaines";

  echo "<hr>";
  ?>
</body>

</html>