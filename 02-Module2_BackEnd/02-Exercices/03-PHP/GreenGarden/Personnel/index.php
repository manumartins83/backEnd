<?php
$host = "localhost";
$user = "root";
$pwd = "";
$dbname = "greengarden";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
} catch (PDOException $e) {
    echo "Connection failed " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>

    <!-- Header -->
    <?php include 'header.php'; ?>


    <!-- Catégories -->
    <?php
    $sql = "select * from t_d_categorie";
    $stmt = $conn->query($sql);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch()) {
            echo "<a class='card styleCardProduit' target='_blank' href='catalogue.php'>";
            echo "<div class='styleTextProduit'>";
            echo "<div class='card-body'><strong>" . $row['Libelle'] . "</strong></div>";
            echo "</div>";
            echo "</a>";
        }
        $stmt->closeCursor(); //vide mémoire
    }
    ?>

    <div>Produits vedettes</div>

    <div>Marques vedettes</div>

    <div>Quoi de neuf</div>


    <!-- Footer -->
    <?php include 'footer.php'; ?>