<?php
session_start();

if (!isset($_SESSION['cart'])) {
    header('Location: catalogue.php');
    exit;
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

include 'dao.php';

$user_id = $_SESSION['user_id'];

// Récupération des informations de l'utilisateur connecté
$host = "localhost"; // Nom d'hôte de la base de données
$user = "root"; // Nom d'utilisateur de la base de données
$password_db = ""; // Mot de passe de la base de données
$dbname = "greengarden"; // Nom de la base de données

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password_db);
    // configuration pour afficher les erreurs pdo
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

//on récup l'id du client grâce à l'id user


$delivery_options = $pdo->query("SELECT * FROM t_d_delivery_options")->fetchAll();
$payment_options = $pdo->query("SELECT * FROM t_d_payment_options")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // récupérer les informations du formulaire
    $delivery_address = $_POST['delivery_address'];
    $billing_address = $_POST['billing_address'];
    $delivery_option_id = $_POST['delivery_option'];
    $payment_option_id = $_POST['payment_option'];

    // insérer la commande dans la base de données
    $stmt = $pdo->prepare("INSERT INTO t_orders (user_id, delivery_address, billing_address, delivery_option_id, payment_option_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $delivery_address, $billing_address, $delivery_option_id, $payment_option_id]);

    // récupérer l'id de la commande
    $order_id = $pdo->lastInsertId();


    //avant de créer les lignes de commande, il convient de créer une expedition
    $stmt = $pdo->prepare("INSERT INTO t_d_expedition (Date_Expedition) VALUES (null)");
    $stmt->execute();
    // récupérer l'id de l'expedition créé
    $exp_id = $pdo->lastInsertId();

    // récupérer le contenu du panier de l'utilisateur (pour ça on recup la variable de session cart)


    // insérer les éléments du panier dans la table d'éléments de commande
    /*  foreach ($cart_items as $item) {
        $stmt = $pdo->prepare("INSERT INTO t_order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
    }*/
    $total = 0;
    foreach ($_SESSION['cart'] as $id => $quantity) {
        $product = $dao->getProductById($id);
        $subtotal = $quantity * $product['Prix_Achat'];
        $total += $subtotal;
        echo $product['Nom_Long'] . " x " . $quantity . " = " . $subtotal . " €<br>";
    }
    echo "<br>Total HT: " . $total . " €<br>";



    // rediriger vers la page d'acceuil
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Validation du panier</title>
</head>

<body>
    <h1>Validation du panier</h1>
    <div class="container mt-5">
        <h2>Informations du client</h2>
        <form method="post">
            <!-- Adresse de livraison -->
            <h2>Adresse de livraison</h2>
            <div class="form-group">
                <label for="adresse_livraison">Adresse :</label>
                <input type="text" class="form-control" id="adresse_livraison" name="adresse_livraison" required>
            </div>
            <div class="form-group">
                <label for="code_postal_livraison">Code postal :</label>
                <input type="text" class="form-control" id="code_postal_livraison" name="code_postal_livraison" required>
            </div>
            <div class="form-group">
                <label for="ville_livraison">Ville :</label>
                <input type="text" class="form-control" id="ville_livraison" name="ville_livraison" required>
            </div>

            <!-- Adresse de facturation -->
            <h2>Adresse de facturation</h2>
            <div class="form-group">
                <label for="adresse_facturation">Adresse :</label>
                <input type="text" class="form-control" id="adresse_facturation" name="adresse_facturation" required>
            </div>
            <div class="form-group">
                <label for="code_postal_facturation">Code postal :</label>
                <input type="text" class="form-control" id="code_postal_facturation" name="code_postal_facturation" required>
            </div>
            <div class="form-group">
                <label for="ville_facturation">Ville :</label>
                <input type="text" class="form-control" id="ville_facturation" name="ville_facturation" required>
            </div>


            <h2>Options de livraison et de paiement</h2>
            <label for="delivery_option">Type de livraison :</label><br>
            <select name="delivery_option">
                <?php foreach ($delivery_options as $option) { ?>
                    <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
                <?php } ?>
            </select><br><br>

            <label for="payment_option">Type de paiement :</label><br>
            <select name="payment_option">
                <?php foreach ($payment_options as $option) { ?>
                    <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
                <?php } ?>
            </select><br><br>

            <input type="submit" value="Valider le panier">
        </form>
</body>

</html>