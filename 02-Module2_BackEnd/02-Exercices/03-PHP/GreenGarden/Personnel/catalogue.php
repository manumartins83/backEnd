<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Titre catalogue -->
    <h1 class="styleTitre">Catalogue</h1>

    <!-- <form method="post" action="">
        <label for="search_term">Rechercher un produit :</label>
        <input type="text" name="search_term" id="search_term">
        <input type="submit" name="search" value="Rechercher">
    </form> -->

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

    if (isset($_POST['search'])) {
        $search_term = $_POST['search_term'];
        $sql = "select * from t_d_produit WHERE nom_court like :search 
    or nom_Long like :search";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $search_term . '%');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "<p>Résultats de la recherche pour : " . $search_term . "</p>";

            while ($row = $stmt->fetch()) {
                echo "<div class='card styleCardProduit'>";
                echo "<div class='card-body'><img class='styleImgProduit' src={$row['Photo']}></div>";

                echo "<div class='styleTextProduit'>";
                echo "<div class='card-body'><strong>Nom produit : </strong>{$row['Nom_court']}</div>";
                echo "<div class='card-body'><strong>Description : </strong>{$row['Nom_Long']}</div>";
                echo "<div class='card-body'><strong>Prix : </strong>{$row['Prix_Achat']} €</div>";
                echo "</div>";

                echo "<input class='styleBtnAjoutPanier' type='submit' value='Ajoutez au panier'>";
                echo "</div>";
            }
        }
    } else {
        $sql = "select * from t_d_produit";
        $stmt = $conn->query($sql);

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                echo "<div class='card styleCardProduit'>";
                echo "<div class='card-body'><img class='styleImgProduit' src={$row['Photo']}></div>";

                echo "<div class='styleTextProduit'>";
                echo "<div class='card-body'><strong>Nom produit : </strong>{$row['Nom_court']}</div>";
                echo "<div class='card-body'><strong>Description : </strong>{$row['Nom_Long']}</div>";
                echo "<div class='card-body'><strong>Prix : </strong>{$row['Prix_Achat']} €</div>";
                echo "</div>";

                echo "<input class='styleBtnAjoutPanier' type='submit' value='Ajoutez au panier'>";
                echo "</div>";
            }
        }
    }
    ?>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>