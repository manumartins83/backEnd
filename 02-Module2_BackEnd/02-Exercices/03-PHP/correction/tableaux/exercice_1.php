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
  //Exercice 1
  $a = array(
    "19001" => array(
      "Centre", "Centre", "Centre", "Centre", "Centre", "Centre",
      "", "", "Centre", "Centre", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage",
      "Stage", "Stage", "Stage", "Stage", "Stage", "Validation", "Validation"
    ),
    "19002" => array(
      "Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre",
      "Centre", "Centre", "Centre", "Centre", "Centre", "Stage", "Stage", "Stage", "Stage",
      "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Validation", ""
    ),
    "19003" => array(
      "", "", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre",
      "Centre", "Centre", "Centre", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage",
      "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "", "", "Validation"
    ),
  );

  //Quelle semaine a lieu la validation du groupe 19002 ?

  echo "<br/>";
  echo "Exercice 4";
  echo "<br>";

  $group = 19002;
  $validationWeek = array_search("Validation", $a[$group]);
  echo "La validation du groupe " . $group . " a lieu à la semaine " . ($validationWeek + 1);

  echo "<hr>";

  ?>
</body>

</html>