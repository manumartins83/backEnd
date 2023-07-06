<?php
// verification démarrage session connexion
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// redirection vers page "Login" si utilisateur pas logué
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// création variables récupération des infos utilisateur dans base de donnée
$host = "localhost"; // Nom d'hôte de la base de données
$user = "root"; // Nom d'utilisateur de la base de données
$password_db = ""; // Mot de passe de la base de données
$dbname = "greengarden"; // Nom de la base de données

// appel de la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password_db);
    // configuration d'affichage des erreurs de la base de données
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// création variable connexion Id utilisateur
$user_id = $_SESSION['user_id'];

// requête de récupération Id utilisateur connecté dans base de données
$stmt = $pdo->prepare("SELECT * FROM t_d_commercial WHERE Id_User=:useid");
$stmt->bindValue(':useid', $user_id);
$stmt->execute();
$commercial = $stmt->fetch(PDO::FETCH_ASSOC);

// requête de récupération des données bons de commande dans base de données
$bons_cde = $pdo->query("SELECT * FROM t_d_commande")->fetchAll(PDO::FETCH_ASSOC);
// requête de récupération des données tickets dans base de données
$tickets = $pdo->query("SELECT * FROM t_d_ticketsav")->fetchAll(PDO::FETCH_ASSOC);
?>


<!-- STRUCTURE HTML -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets retour</title>

    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Titre principal page -->
    <h1 class="styleTitre">Bons de commande</h1>

    <!-- affichage formulaire de sélection des bons de commande -->
    <form class="stylePageAfficheTicket" method="post">
        <div>
            <label class="styleLabelAfficheTicket" for="num_bon_cde">Numéro bon commande :</label>
        </div>

        <div>
            <select class="styleSelectAfficheTicket" name="num_bon_cde">
                <?php foreach ($bons_cde as $bon_cde) { // pour chaque données de la table bons de commande de la base de données ?>
                    <option value="<?= $bon_cde['Id_Commande'] ?>"><?= $bon_cde['Num_Commande'] // affichage de la liste des bons dans select ?></option>
                <?php } ?>
            </select>

            <div class="styleBtnPageAfficheTicket">
                <input class="styleBtnAfficheTicket" type="submit" value="Afficher">
            </div>
        </div>
    </form>


    <?php
    // si validation du formulaire dans structure HTML
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // affiche Titre principal liste des tickets retour
        echo '<h1 class="styleTitre">Liste des tickets retour</h1>';

        // récupération des infos du formulaire de la structure HTML
        $cde_id = $_POST['num_bon_cde'];

        // requête de récupération num commande dans base de données table bons de commande
        $sql = "SELECT * FROM t_d_commande WHERE Id_Commande=:numCde";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':numCde', $cde_id);
        $stmt->execute();

        // tant que num bon de commande client présent dans base données alors
        while ($numCde = $stmt->fetch()) {
            // affichage message du num bon commande sélectionné
            echo "<h2>Les tickets retour du bon de commande " . $numCde['Num_Commande'] . " sont :" . "</h2>";
        }
        $stmt->closeCursor(); //vide mémoire

        // requête de récupération id commande dans base de données table tickets
        $sql = "SELECT * FROM t_d_ticketsav WHERE Id_Commande=:idCde";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':idCde', $cde_id);
        $stmt->execute();

        // si sélection requête > 0 alors
        if ($stmt->rowCount() > 0) {
            // tant que tickets retour correspondant à un bon de commande dans base de données alors
            while ($ticket = $stmt->fetch()) {
                // affichage de la liste des tickets correspondant au bon commande
                echo "<div class='styleTextTicket card'>";
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