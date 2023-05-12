<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>exo2</title>
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

  $tabValuesGr1 = $tabValuesGr[0]; //valeur tableau groupe 1
  print_r($tabValuesGr1);
  echo nl2br("\n");
  print_r(count($tabValuesGr1));
  $nbTabGr1 = count($tabValuesGr1);
  // print_r(array_keys($tabValuesGr1,"Stage"));
  echo nl2br("\n");
  print_r(array_search("Stage", array_reverse($tabValuesGr1)) + 1);
  $nbTabDerStageGr1 = array_search("Stage", array_reverse($tabValuesGr1)) + 1;
  // echo nl2br("\n\n");
  // print_r(array_count_values($tabValuesGr1));
  // echo nl2br("\n");

  $group1 = 19001;
  // $countValGr1 = array_count_values($tabValuesGr1);
  // print_r($countValGr1);
  // echo nl2br("\n");
  // $nbStageGr1 = $countValGr1['Stage'];
  // print_r($nbStageGr1);
  echo nl2br("\n");
  $indexTabDerStageGr1 = $nbTabGr1 - $nbTabDerStageGr1;
  echo "La position de la dernière occurence de stage pour le groupe " . $group1 . " est " . $indexTabDerStageGr1;
  ?>

</body>

</html>