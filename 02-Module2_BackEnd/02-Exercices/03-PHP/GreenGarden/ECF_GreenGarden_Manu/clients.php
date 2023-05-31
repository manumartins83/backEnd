<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>

    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Titre principal -->
    <h1 class="styleTitre">Tickets retour</h1>

    <div>
        <form method="post" action="">
            <!-- <label class="styleLabelSearch" for="search_term"><strong>Rechercher un produit :</strong></label> -->
            <input id="search_term" class="styleSearch" type="text" name="search_term">
            <button type="submit" name="search" class="styleBtnSearch"><img class="styleImgBtnSearch" src="img/search.png" alt="Recherche"></button>
            <!-- <input class="styleBtnSearch" type="submit" name="search" value="Rechercher"> -->
        </form>
    </div>



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

    <?php
    if (isset($_POST['search'])) {
        $search_term = $_POST['search_term'];
        $sql = "select * from t_d_produit WHERE nom_court like :search or nom_Long like :search";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $search_term . '%');
        $stmt->execute();



        if ($stmt->rowCount() > 0) {

            echo "<p>Résultats de la recherche pour : " . $search_term . "</p>";

            foreach ($produit as $row) {
                while ($row = $stmt->fetch()) {
                    echo "<a class='card styleCardProduit' target='_blank' href='consult_produit.php?id={$row['Id_Produit']}'>";
                    echo "<img class='styleImgProduit' src='img/{$row['Photo']}'>";

                    echo "<div class='styleTextProduit'>";
                    echo "<div class='card-body'><strong>Nom produit : </strong>" . $row['Nom_court'] . "</div>";
                    echo "<div class='card-body'><strong>Description : </strong>{$row['Nom_Long']}</div>";
                    echo "<div class='card-body'><strong>Prix : </strong>{$row['Prix_Achat']} €</div>";
                    echo "</div>";

                    echo "<form method='POST' action='ajout_panier.php'>
                <input type='hidden' name='id' value=' {$row['Id_Produit']}'>
                <input class='styleBtnAjoutPanier' type='submit' value='Ajouter au panier'>
                </form>";

                    // echo "<input class='styleBtnAjoutPanier' type='submit' value='Ajoutez au panier'>";
                    echo "</a>";
                }
                $stmt->closeCursor(); //vide mémoire
            }
        } else {
            $sql = "select * from t_d_produit";
            $stmt = $conn->query($sql);




            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch()) {
                    echo "<a class='card styleCardProduit' target='_blank' href='consult_produit.php?id={$row['Id_Produit']}'>";
                    echo "<img class='styleImgProduit' src='img/{$row['Photo']}'>";

                    echo "<div class='styleTextProduit'>";
                    echo "<div class='card-body'><strong>Nom produit : </strong>" . $row['Nom_court'] . "</div>";
                    echo "<div class='card-body'><strong>Description : </strong>{$row['Nom_Long']}</div>";
                    echo "<div class='card-body'><strong>Prix : </strong>{$row['Prix_Achat']} €</div>";
                    echo "</div>";

                    echo "<form method='POST' action='ajout_panier.php'>
            <input type='hidden' name='id' value=' {$row['Id_Produit']}'>
            <input class='styleBtnAjoutPanier' type='submit' value='Ajouter au panier'>
            </form>";

                    // echo "<input class='styleBtnAjoutPanier' type='submit' value='Ajoutez au panier'>";
                    echo "</a>";
                }
                $stmt->closeCursor(); //vide mémoire
            }
        }
    }
    ?>

    <!-- Footer -->
    <?php include 'footer.php'; ?>




    <label for="num_tickets_retour">Ticket retour :</label><br>
        <select name="num_tickets_retour">
            <?php foreach ($tickets_retour as $ticket_retour) { ?>
                <option value="<?= $ticket_retour['Num_Ticket_SAV'] ?>"><?= $ticket_retour['Num_Ticket_SAV'] ?></option>
            <?php } ?>
        </select><br><br>


        <select class="styleSelectAjoutTicket" name="statut_ticket">
                <?php foreach ($tickets_retour as $ticket_retour) { ?>
                    <option value="<?= $ticket_retour['Statut_Ticket_SAV'] ?>"><?= $ticket_retour['Statut_Ticket_SAV'] ?></option>
                <?php } ?>
            </select>