<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>exo3</title>
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

  ?>
</body>

</html>