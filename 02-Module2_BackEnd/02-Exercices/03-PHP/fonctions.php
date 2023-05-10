<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les fonctions</title>
</head>

<body>
    <?php
    $tab = array(
        array(1, "janvier", "2016"),
        array(2, "février", "2017"),
        array(3, "mars", "2018"),
        array(4, "avril", "2019")
    );
    // Affiche : 3 mars 2018
    echo $tab[2][0] . " " . $tab[2][1] . " " . $tab[2][2] . "<br>";
    ?>


    <?php
    $factures = array(
        "Janvier" => 500, "Février" => 620, "Mars" => 300, "Avril" => 130,
        "Mai" => 560, "Juin" => 350
    );
    $total_annuel = 0;
    foreach ($factures as $value) {
        echo $value . " &euro;<br>";
        $total_annuel += $value;
    }
    echo "Total annuel de vos factures téléphoniques : " . $total_annuel . " &euro;<br><br>";

    foreach ($factures as $key => $value) {
        echo "Facture du mois de " . $key . " : " . $value . "€<br>";
        $total_annuel += $value;
    }
    echo "Total annuel de vos factures téléphoniques : " . $total_annuel . " &euro;";
    ?>


</body>

</html>