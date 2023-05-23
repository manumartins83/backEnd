<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les tableaux</title>
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
    echo '<hr>';
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
    echo "Total annuel de vos factures téléphoniques : " . $total_annuel . " &euro;<br>";
    echo '<hr>';
    ?>


    <?php
    $factures = array(
        "Janvier" => 500, "Février" => 620, "Mars" => 300, "Avril" => 130,
        "Mai" => 560, "Juin" => 350
    );

    $total_annuel = 0;
    foreach ($factures as $key => $value) {
        echo "Facture du mois de " . $key . " : " . $value . "€<br>";
        $total_annuel += $value;
    }
    echo "Total annuel de vos factures téléphoniques : " . $total_annuel . " &euro;";
    echo '<hr>';
    ?>


    <?php
    $tab = array(
        "a" => "Lundi",
        "b" => "Mardi",
        "c" => "Mercredi",
        "d" => "Jeudi",
        "e" => "Vendredi"
    );

    asort($tab);
    foreach ($tab as $cle => $valeur) {
        echo $cle . " : " . $valeur . "<br>";
    }
    echo '<br>';

    arsort($tab);
    foreach ($tab as $key => $item) {
        echo $key . " : " . $item . "<br>";
    }
    echo '<hr>';
    ?>


    <?php
    $tab = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
    // Suppression de l'élément 2 (Mercredi)
    unset($tab[2]);
    var_dump($tab);
    echo '<hr>';
    ?>


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

    //Exercice 1
    echo 'Exercice 1 <br><br>';

    //Quelle semaine a lieu la validation du groupe 19002 ?
    //code 1
    $group2 = 19002;
    $validationWeek = array_search("Validation", $a[$group2]);
    echo "La validation du groupe " . $group2 . " a lieu à la semaine " . ($validationWeek + 1);
    echo '<br><br>';

    //code 2
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


    //Exercice 2
    echo 'Exercice 2 <br><br>';

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

    echo nl2br("\n");


    $groupe = 19001;
    //initialiser la variable qui contiendra la dernière positipn
    $last = false;

    foreach ($a[$groupe] as $index => $value) {

        // si la valeur actuelle est égale à "stage",stocke sa position
        if ($value == "Stage") { // la valeur de la recherche du mot stage dans le tableau
            $last = $index;
            //la valeur suivante est stocker dans $lat jusqu'à la dernière puis garder dans une variable $index pour pouvoir l'afficher

        }
    }
    echo "La dernière position occurence de " . $groupe . " est : " . ($index - 1);
    ?>

</body>

</html>