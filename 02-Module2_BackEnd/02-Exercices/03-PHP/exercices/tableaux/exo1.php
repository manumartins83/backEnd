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

  echo '<br><br>';

  print_r(array_keys($a));
  echo nl2br("\n");
  $tabKeysGr = array_keys($a); //clefs tableau groupes
  $tabKeyGr2 = $tabKeysGr[1]; // clef groupe 2
  echo $tabKeyGr2;
  echo '<br><br>';

  print_r(array_values($a));
  echo nl2br("\n");
  $tabValuesGr = array_values($a); //valeurs tableau groupes
  $tabValuesGr2 = $tabValuesGr[1]; //valeur tableau groupe 2
  echo nl2br("\n");

  echo array_search("Validation", $tabValuesGr2);
  $valueValidWeekGr2 = array_search("Validation", $tabValuesGr2) + 1;
  echo nl2br("\n");
  echo "La validation du groupe " . $tabKeyGr2 . " a lieu à la semaine " . $valueValidWeekGr2;
  echo "<hr>";
  ?>

</body>

</html>