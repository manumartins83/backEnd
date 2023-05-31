<?php
// démarrage session loguage
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// si utilisateur pas logué
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// création variable Id utilisateur connecté
$user_id = $_SESSION['user_id'];

// création variables récupération des infos de l'utilisateur connecté
$host = "localhost"; // Nom d'hôte de la base de données
$user = "root"; // Nom d'utilisateur de la base de données
$password_db = ""; // Mot de passe de la base de données
$dbname = "greengarden"; // Nom de la base de données

try {
    // récupération des infos de l'utilisateur connecté
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // configuration pour afficher les erreurs pdo
    echo "Connection failed: " . $e->getMessage();
}

//on récup l'id du commercial SAV grâce à l'id user
$stmt = $pdo->prepare("SELECT * FROM t_d_commercial WHERE Id_User=:useid");
$stmt->bindValue(':useid', $user_id);
$stmt->execute();
$commercial = $stmt->fetch(PDO::FETCH_ASSOC);

// requête de récupération bases données
$bons_cde = $pdo->query("SELECT * FROM t_d_commande")->fetchAll(PDO::FETCH_ASSOC);
$tickets = $pdo->query("SELECT * FROM t_d_ticketsav")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets retour</title>

    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Titre principal -->
    <h1 class="styleTitre">Bons de commande</h1>

    <!-- Formulaire sélection bon commande-->
    <form class="stylePageAfficheTicket" method="post">

        <div>
            <label class="styleLabelAfficheTicket" for="num_bon_cde">Numéro bon commande :</label>
        </div>

        <div>
            <select class="styleSelectAfficheTicket" name="num_bon_cde">
                <?php foreach ($bons_cde as $bon_cde) { ?>
                    <option value="<?= $bon_cde['Id_Commande'] ?>"><?= $bon_cde['Num_Commande'] ?></option>
                <?php } ?>
            </select>

            <div class="styleBtnPageAfficheTicket">
                <input class="styleBtnAfficheTicket" type="submit" value="Afficher">
            </div>
        </div>

    </form>

    <?php
    // Si validation formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // affiche titre liste tickets
        echo '<h1 class="styleTitre">Liste des tickets retour</h1>';

        // récupération des infos du formulaire
        $cde_id = $_POST['num_bon_cde'];

        // requête de récupération bases données
        $sql = "SELECT * FROM t_d_commande WHERE Id_Commande=:numCde";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':numCde', $cde_id);
        $stmt->execute();

        // Affichage message du bon commande correspondant aux tickets
        while ($numCde = $stmt->fetch()) {
            echo "<h2>Les tickets retour du bon de commande " . $numCde['Num_Commande'] . " sont :" . "</h2>";
        }
        $stmt->closeCursor(); //vide mémoire

        // requête de récupération bases données
        $sql = "SELECT * FROM t_d_ticketsav WHERE Id_Commande=:idCde";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':idCde', $cde_id);
        $stmt->execute();

        // Affichage liste ticket correspondant au bon commande
        if ($stmt->rowCount() > 0) {
            while ($ticket = $stmt->fetch()) {
                echo "<div class='styleTextTicket'>";
                echo "<div class='card-body'><strong>Numéro du ticket : </strong>" . $ticket['Num_Ticket_SAV']  . "</div>";
                echo "<div class='card-body'><strong>Date du ticket : </strong>" . $ticket['Date_Ticket_SAV'] . "</div>";
                echo "<div class='card-body'><strong>Statut du ticket : </strong>" . $ticket['Statut_Ticket_SAV'] . "</div>";
                echo "</div>";
            }
            $stmt->closeCursor(); //vide mémoire
        }
    }
    ?>

    <!-- Footer -->
    <?php include 'footer.php'; ?>