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
  //Que s'est-il passé le 1000200000 ?
  $date = new DateTime(1000200000);

  // echo time(1000200000);
  echo $date->format("d/m/Y");

  // Le 1000200000 est un timestamp, c'est à dire le nombre de secondes écoulées depuis le 1er janvier 1970 à 00h00.
  ?>
</body>

</html>