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
$stmt = $pdo->prepare("SELECT * FROM t_d_techniciensav WHERE Id_User=:useid");
$stmt->bindValue(':useid', $user_id);
$stmt->execute();
$technicien = $stmt->fetch(PDO::FETCH_ASSOC);

// requête de récupération des données bons de commande dans base de données
$bons_cde = $pdo->query("SELECT * FROM t_d_commande")->fetchAll();
// requête de récupération des données tickets dans base de données
$tickets_retour = $pdo->query("SELECT * FROM t_d_ticketsav")->fetchAll();
// requête de récupération des données type de ticket dans base de données
$types_retour = $pdo->query("SELECT * FROM t_d_typeretour")->fetchAll();

// si validation du formulaire dans structure HTML
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // récupération des infos du formulaire de la structure HTML
    $cde_id = $_POST['num_bon_cde'];
    $type_retour_id = $_POST['cause_retour'];
    $today = date("Y-m-d H:i:s");

    // requête d'insertion d'un ticket dans base de données
    $stmt = $pdo->prepare("INSERT INTO t_d_ticketsav (Date_Ticket_SAV, Statut_Ticket_SAV, 
    Id_Technicien_SAV, Id_Commande, Id_Retour) 	
    VALUES (:dateTicket, :statutTicket, :technicien, :cde, :retour)");
    $stmt->bindValue(':dateTicket', $today);
    $stmt->bindValue(':statutTicket', 'crée');
    $stmt->bindValue(':technicien', $technicien['Id_Technicien_SAV']);
    $stmt->bindValue(':cde', $cde_id);
    $stmt->bindValue(':retour', $type_retour_id);
    $stmt->execute();
}
?>


<!-- STRUCTURE HTML -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Ticket</title>

    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Titre principal page création ticket -->
    <h1 class="styleTitre">Création ticket retour</h1>

    <!-- affichage formulaire de création ticket-->
    <form class="stylePageAjoutTicket" method="post">
        <div>
            <label class="styleLabelAjoutTicket" for="num_bon_cde">Numéro bon commande :</label>
            <label class="styleLabelAjoutTicket" for="statut_ticket">Statut ticket retour :</label>
        </div>

        <div>
            <select class="styleSelectAjoutTicket" name="num_bon_cde">
                <?php foreach ($bons_cde as $bon_cde) {  // pour chaque données de la table bons de commande de la base de données ?>
                    <option value="<?= $bon_cde['Id_Commande'] ?>"><?= $bon_cde['Num_Commande'] // affichage de la liste des bons dans select ?></option>
                <?php } ?>
            </select>
            <select class="styleSelectAjoutTicket" name="cause_retour">
                <?php foreach ($types_retour as $type_retour) { // pour chaque données de la table type de retour ticket de la base de données ?>
                    <option value="<?= $type_retour['Id_Retour'] ?>"><?= $type_retour['Libelle_Retour'] // affichage de la liste du type de retour dans select ?></option>
                <?php } ?><br>
            </select>
            <div class="styleBtnPageAjoutTicket">
                <input class="styleBtnAjoutTicket" type="submit" value="Créer ticket">
            </div>
        </div>
    </form>

    <!-- Titre principal liste tickets -->
    <h1 class="styleTitre">Liste des tickets retour</h1>


    <?php
    // Si validation formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // affichage message création ticket
        echo "<h2 class='styleTitreSecondaire'>Ticket créé avec succès !</h2>";
        // rafraichissement page 
        header('refresh:5;url= ajout_ticket.php');
    }

    // requête de récupération des données tickets dans base de données
    $sql = "SELECT * FROM t_d_ticketsav";
    $stmt = $pdo->query($sql);

    // si sélection requête > 0 alors
    if ($stmt->rowCount() > 0) {
        // tant que données ticket présent dans base données alors
        while ($row = $stmt->fetch()) {
            // affichage de la liste des tickets
            echo "<div class='styleTextTicket card'>";
            echo "<div class='card-body'><strong>Numéro du ticket : </strong>" . $row['Num_Ticket_SAV'] . "</div>";
            echo "<div class='card-body'><strong>Date du ticket : </strong>{$row['Date_Ticket_SAV']}</div>";
            echo "<div class='card-body'><strong>Statut du ticket : </strong>" . $row['Statut_Ticket_SAV'] . "</div>";
            echo "</div>";
        }
        $stmt->closeCursor(); //vide mémoire 
    }
    ?>

    <!-- Footer -->
    <?php include 'footer.php'; ?>