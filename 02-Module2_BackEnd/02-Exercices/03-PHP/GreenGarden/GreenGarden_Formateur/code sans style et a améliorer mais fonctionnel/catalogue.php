<!DOCTYPE html>
<html>

<head>
    <title>Catalogue</title>
</head>

<body>
    <p><a href="panier.php">Voir mon panier</a></p>
    <h1>Recherche de produits</h1>

    <form method="post" action="">
        <label for="search_term">Rechercher un produit:</label>
        <input type="text" name="search_term" id="search_term">
        <input type="submit" name="search" value="Rechercher">
    </form>
    <?php
    // Inclure le fichier header.php
    /*require('header.php');*/ ?>
    <h1>Catalogue</h1>

    <?php
    // Connexion à la base de données
    $host = "localhost"; // Nom d'hôte de la base de données
    $user = "root"; // Nom d'utilisateur de la base de données
    $password = ""; // Mot de passe de la base de données
    $dbname = "greengarden"; // Nom de la base de données

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        // configuration pour afficher les erreurs pdo
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    // Traitement de la recherche
    if (isset($_POST['search'])) {
        $search_term = $_POST['search_term'];
        $sql = "SELECT * FROM t_d_produit WHERE nom_court
         LIKE :search_term OR nom_Long LIKE :search_term";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':search_term', '%' . $search_term . '%');
        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count > 0) {
            // Affichage des résultats
            echo "<p>Résultats de recherche pour '{$search_term}':</p>";
            echo "<ul>";
            while ($row = $stmt->fetch()) {
                echo "<li>
                        <a href='consult_produit.php?id={$row['Id_Produit']}'>
                            {$row['Nom_court']} - {$row['Prix_Achat']} € HT 
                            <form method='post' action='ajout_panier.php'>
                                <input type='hidden' name='id' value='{$row['Id_Produit']}'>
                                <input type='submit' value='Ajouter au panier'>
                            </form>
                        </a>
                    </li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Aucun résultat trouvé pour '{$search_term}'.</p>";
        }
    } else {
        // Récupération de tous les produits
        $sql = "SELECT * FROM t_d_produit";
        $stmt = $conn->query($sql);

        if ($stmt->rowCount() > 0) {
            echo "<ul>";
            while ($row = $stmt->fetch()) {
                echo "<li>
                        <a href='consult_produit.php?id=" . $row['Id_Produit'] . "'>
                        {$row['Nom_court']} - {$row['Prix_Achat']} € HT 
                            <form method='post' action='ajout_panier.php'>
                                <input type='hidden' name='id' value='{$row['Id_Produit']}'>
                                <input type='submit' value='Ajouter au panier'>
                            </form>
                        </a>
                </li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Aucun produit disponible pour le moment.</p>";
        }
    }

    $conn = null; // Fermeture de la connexion
    ?>




    <?php
    // Inclure le fichier footer.php
    /*require('footer.php');*/
    ?>

</body>

</html>