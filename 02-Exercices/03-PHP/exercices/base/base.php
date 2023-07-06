<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essais PHP</title>
</head>

<body>
    <?php echo 'coucou' ?>


    <h1>
        <?php echo "Bonjour le monde" ?>
    </h1>


    <?php
    $age = 25;
    (($age >= 18) ? $reponse = "majeur" : $reponse = "mineur");
    echo "Vous êtes " . $reponse . ". ";
    echo "<br>";
    echo "Vous êtes " . (($age >= 18) ? "majeur" : "mineur") . ".";
    echo "<br>";
    ?>


    <?php
    $a = $b = 2;
    function somme()
    {
        global $a, $b;
        $b = $a + $b;
        echo $b . "<br>";
    }
    somme();
    ?>


    <?php
    function Test()
    {
        $a = 1;
        echo $a . "<br>";
        $a++;
    }
    // Appel de la fonction (2 fois)
    Test();
    Test();
    ?>


    <?php
    function Test1()
    {
        static $a = 0;
        echo $a . "<br />";
        $a++;
    }
    // Appel de la fonction (3 fois)
    Test1();
    Test1();
    Test1();
    ?>


    <?php
    $a = 6.32172;
    $b = intval($a);
    $c = doubleval($a);
    // Ce qui donne : 6.32172 - 6 - 6.32172 = -6
    echo $a - $b - $c . '<br>';
    ?>


    <?php
    echo 'L\'adresse IP de l\'utilisateur est : ' . $_SERVER['REMOTE_ADDR'] . '<br>';
    echo 'L\'adresse IP du Server XAMPP est : ' . (isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : 'Non défini');
    echo '<br>';
    ?>


    <?php
    $clientIP = $_SERVER['REMOTE_ADDR']; // Adresse IP du client
    $serverIP = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : 'Non défini'; // Adresse IP du serveur XAMPP en tant qu'environnement de développement local. Lorsque vous travaillez en local, certaines variables de $_SERVER peuvent ne pas être définies, comme $_SERVER['SERVER_ADDR']
    //Dans cet exemple, nous utilisons l'opérateur ternaire pour vérifier si $_SERVER['SERVER_ADDR'] est défini. Si c'est le cas, la valeur de $serverIP sera l'adresse IP du serveur. Sinon, la valeur sera 'Non défini'.
    echo "<br/>"; // Saut de ligne en HTML
    echo "Adresse IP du client est : " . $clientIP;
    echo "<br/>";
    echo "Adresse IP du serveur est : " . $serverIP;
    echo "<br/>";
    ?>

</body>

</html>