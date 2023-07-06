<?php
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "new_password";
$dbname = "greengarden";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

function getPanier() {
    global $conn;
    
    $cartProducts = [];
    
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $sql = "SELECT * FROM t_d_produit WHERE Id_Produit = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $product['quantity'] = $quantity;
        $cartProducts[] = $product;
    }
    
    return $cartProducts;
}

function getTotalPanier() {
    global $conn;
    $total = 0;

    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $sql = "SELECT * FROM t_d_produit WHERE Id_Produit = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $total += $product['Prix_Achat'] * $quantity;
    }
    
    return $total;
}

$cartProducts = getPanier();

$conn = null;
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <title>Panier</title>
</head>

<body>
    <div class="container mt-5 text-center">
        <div class="jumbotron">
        <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success_message']; ?>
                </div>
                <?php unset($_SESSION['success_message']); // Effacer le message après l'affichage ?>
            <?php endif; ?>
            <div class="text-center mb-4">
                <h2><i class="fas fa-shopping-cart"></i> Panier</h2>
            </div>
            <div class="text-center">
                <a class="btn btn-primary btn-lg" href="catalogue.php" role="button">Retour au catalogue</a>
                <a class="btn btn-success btn-lg" href="validation_panier.php" role="button">Payer</a>
            </div>
            <hr class="my-4">
            <div class="row">
                <?php
                // Afficher les produits du panier
                if (count($cartProducts) > 0) {
                    foreach ($cartProducts as $product) {
                        echo '<div class="col-md-4 mb-4">';
                        echo '<div class="card h-100 d-flex flex-column">';
                        echo '<img src="' . $product['Photo'] . '" class="card-img-top" alt="' . $product['Nom_court'] . '">';
                        echo '<div class="card-body d-flex flex-column">';
                        echo '<h5 class="card-title">' . $product['Nom_court'] . ' (x' . $product['quantity'] . ')</h5>';
                        echo '<p class="card-text">' . $product['Nom_Long'] . '</p>';
                        echo '<p class="card-text">' . $product['Prix_Achat'] . ' €</p>';
                        echo '<div class="mt-auto">';
                        echo '<a href="remove_from_cart.php?id=' . $product['Id_Produit'] . '" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // Afficher un message si le panier est vide
                    echo '<h2>Votre panier est vide.</h2>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>