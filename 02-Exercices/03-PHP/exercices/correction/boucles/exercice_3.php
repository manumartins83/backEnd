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
  //Exercice 3
  //Ecrire un script qui affiche la table de multiplication totale de {1,...,12} par {1,...,12}, le résultat doit être le suivant :

  echo "<br/>";
  echo "Exercice 3";
  echo "<br>";

  echo "<table border='1'>"; // Ajoutez une bordure au tableau pour une meilleure visibilité

  for ($i = 1; $i <= 12; $i++) {
    echo "<tr>"; // Ouvre une nouvelle ligne du tableau

    for ($j = 1; $j <= 12; $j++) {
      echo "<td>"; // Ouvre une nouvelle cellule du tableau
      echo $i * $j;
      echo "</td>"; // Ferme la cellule du tableau
    }

    echo "</tr>"; // Ferme la ligne du tableau
  }

  echo "</table>"; // Ferme le tableau


  echo "<hr>";

  ?>
</body>

</html>