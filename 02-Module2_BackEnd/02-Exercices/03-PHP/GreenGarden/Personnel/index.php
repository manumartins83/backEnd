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












    <!-- Caroussel -->
    <!-- <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->


    <div>Produits vedettes</div>

    <div>Marques vedettes</div>

    <div>Quoi de neuf</div>


    <!-- Footer -->
    <?php include 'footer.php'; ?>