<?php
$servername = "host";
$username = "username";
$password = "password";
$dbname = "dbname";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
  $customer_name = $_POST['customer_name'];
  $product = $_POST['product'];
  $quantity = $_POST['quantity'];

  $sql = "INSERT INTO orders (customer_name, product, quantity) VALUES ('$customer_name', '$product', '$quantity')";

  if ($conn->query($sql) === TRUE) {
    echo "Nouvelle commande ajoutée avec succès !";
  } else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter une commande</title>
  <link rel="stylesheet" href="/BackEnd/GreenGarden/edit_order.css">
</head>

<body>
  <div class="container">
    <h1>Ajouter une commande</h1>
    <form action="add_order.php" method="post">
      <label for="customer_name">Nom du client :</label>
      <input type="text" id="customer_name" name="customer_name" required><br><br>
      <label for="product">Produit :</label>
      <input type="text" id="product" name="product" required><br><br>
      <label for="quantity">Quantité :</label>
      <input type="number" id="quantity" name="quantity" required><br><br>
      <button type="submit" name="submit">Ajouter la commande</button>
    </form>
  </div>
</body>

</html>