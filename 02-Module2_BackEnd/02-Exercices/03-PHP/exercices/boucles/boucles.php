<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les boucles</title>
</head>

<body>

    <?php
    $a = 0;
    while ($a <= 150) {
        if ($a % 2 != 0) {
            echo $a . " ";
        }
        $a++;
    }
    echo "<hr>";
    ?>


    <?php
    echo "<br>";
    for ($i = 1; $i <= 150; $i += 2) {
        echo $i . " ";
    }
    echo "<hr>";
    ?>


    <?php
    echo nl2br("\n");
    define('phrase', "Je dois faire des sauvegardes régulières de mes fichiers");
    for ($i = 0; $i <= 500; $i++) {
        echo $i . "." . " " . phrase . " ";
    }
    echo "<hr>";
    ?>


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