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
    echo "<table border='1'>"; //ajoute un style de bordure de 1 au tableau
    for ($i = 0; $i <= 12; $i++) {
        echo "<tr>"; //ouvre une nouvelle ligne du tableau

        for ($j = 0; $j <= 12; $j++) {
            echo "<td>"; //ouvre une nouvelle cellule du tableau
            echo $i * $j;
            echo "</td>"; //ferme la cellule du tableau
        }
        echo "</tr>"; //ferme la ligne du tableau
    }
    echo "</table>"; //ferme le tableau
    ?>

</body>

</html>