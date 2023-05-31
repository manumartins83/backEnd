<?php
$servername = "localhost";
$username = "root";
$password = "new_password";
$dbname = "greengarden";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_GET['commandNum'])) {
    $commandNum = $_GET['commandNum'];

    // Recherche de la commande dans la base de données
    $stmt = $conn->prepare("SELECT * FROM t_d_commande WHERE Num_Commande = ?");
    $stmt->execute([$commandNum]);
    $command = $stmt->fetch();

    if ($command) {
        // Afficher les détails de la commande
        echo "Commande Numéro: " . $command['Num_Commande'] . "<br>";
        echo "Date: " . $command['Date_Commande'] . "<br>";
        echo "Client: " . $command['Nom_Client'] . "<br>";
        // Autres détails de la commande...
    } else {
        echo "Aucune commande trouvée avec le numéro " . $commandNum;
    }
} else {
    echo "Aucun numéro de commande fourni";
}


?>
