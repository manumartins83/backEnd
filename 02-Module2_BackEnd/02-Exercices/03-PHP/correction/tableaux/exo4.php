<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>exo4</title>
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

  $gr3 = 19003;
  $derStageSem = array_search("Stage", array_reverse($a[$gr3]));
  $preStageSem = array_search("Stage", $a[$gr3]);

  echo "Le stage du groupe " . $gr3 . " dure " . ($derStageSem - $preStageSem + 1) . " semaines";

  ?>

</body>

</html>