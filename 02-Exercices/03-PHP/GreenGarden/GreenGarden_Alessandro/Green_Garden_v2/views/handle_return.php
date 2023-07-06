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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // récupérer les données du formulaire
    $search = $_POST['search'];
    $reason = $_POST['reason'];

// Recherche de la commande dans la base de données
    $stmt = $conn->prepare("
    SELECT * 
    FROM t_d_commande 
    INNER JOIN t_d_client ON t_d_commande.Id_Client = t_d_client.Id_Client
    WHERE t_d_commande.Num_Commande LIKE ? OR t_d_client.Nom_Client LIKE ?
");
    if($stmt->execute(["%$search%", "%$search%"])) {
        $results = $stmt->fetchAll();

        if(count($results) > 0) {
            // Affichage des résultats
            echo "<table>";
            echo "<tr><th>Commande Num</th><th>Date</th><th>Client</th><th>Détails</th><th>Action</th></tr>";
            foreach ($results as $result) {
                echo "<tr>";
                echo "<td>" . $result['Num_Commande'] . "</td>";
                echo "<td>" . $result['Date_Commande'] . "</td>";
                echo "<td>" . $result['Nom_Client'] . "</td>";
                echo "<td><button type=\"button\" onclick=\"chooseCommand('" . $result['Num_Commande'] . "')\">Choisir commande</button></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Aucun résultat trouvé.";
        }
    } else {
        echo "Erreur lors de l'exécution de la requête SQL.";
    }
}
?>
