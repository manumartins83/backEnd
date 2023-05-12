<?php
// Connexion à la base de données
// Remplacez ces valeurs par les informations de connexion à votre base de données
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "orders_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Sélectionnez toutes les commandes de la base de données
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

// Fermez la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/BackEnd/GreenGarden/order.css">
  <title>Commandes</title>
</head>

<body>
  <h1>Commandes</h1>
  <a href="add_order.php">Ajouter une commande</a>
  <table>
    <tr>
      <th>ID</th>
      <th>Client</th>
      <th>Produit</th>
      <th> Quantité</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
      // Affichez les données de chaque commande
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["client"] . "</td>";
        echo "<td>" . $row["product"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='4'>Aucune commande trouvée</td></tr>";
    }
    ?>
  </table>

</body>

</html>