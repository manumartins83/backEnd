<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Les Indispansables</title>
</head>

<body>
  <?php
  //Lire le fichier et stoker le contenue  dans un tableau
  $lien = file('lien.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  foreach ($lien as $key => $value) {
    echo "<a href='$value' target='_blank'>Lien $key</a><br>";
  }


  /**Dans cet exemple, nous utilisons les options FILE_IGNORE_NEW_LINES et FILE_SKIP_EMPTY_LINES avec la fonction file() pour ignorer les sauts de ligne et les lignes vides. Le code générera une page Web contenant les liens hypertextes vers les sites mentionnés dans le fichier liens.txt. */
  ?>
</body>

</html>