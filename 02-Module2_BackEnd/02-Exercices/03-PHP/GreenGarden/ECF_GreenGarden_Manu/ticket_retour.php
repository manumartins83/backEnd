<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

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

//on récup l'id du technicien SAV grâce à l'id user
$stmt = $pdo->prepare("SELECT * FROM t_d_techniciensav WHERE Id_User=:useid");
$stmt->bindValue(':useid', $user_id);
$stmt->execute();
$technicien = $stmt->fetch(PDO::FETCH_ASSOC);


$bons_cde = $pdo->query("SELECT * FROM t_d_commande")->fetchAll();
$tickets_retour = $pdo->query("SELECT * FROM t_d_ticketsav")->fetchAll();
$types_retour = $pdo->query("SELECT * FROM t_d_typeretour")->fetchAll();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // récupérer les informations du formulaire
    $cde_id = $_POST['num_bon_cde'];
    // $ticket_id = $_POST['num_tickets_retour'];
    $statut_ticket_retour = $_POST['statut_ticket'];
    $type_retour_id = $_POST['cause_retour'];
    // $suppr_ticket = $_POST['suppr_ticket_retour'];
    $today = date("Y-m-d H:i:s");


    // insérer le ticket dans la base de données
    $stmt = $pdo->prepare("INSERT INTO t_d_ticketsav (Date_Ticket_SAV, Statut_Ticket_SAV, 
    Id_Technicien_SAV, Id_Commande, Id_Retour) 	
    VALUES (:dateTicket, :statutTicket, :technicien, :cde, :retour)");
    $stmt->bindValue(':dateTicket', $today);
    $stmt->bindValue(':statutTicket', $statut_ticket_retour);
    $stmt->bindValue(':technicien', $technicien['Id_Technicien_SAV']);
    $stmt->bindValue(':cde', $cde_id);
    $stmt->bindValue(':retour', $type_retour_id);
    $stmt->execute();

    $order_id = $pdo->lastInsertId();


    // rediriger vers la page d'acceuil
    header('Location: index.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket retour</title>

    <!-- Header -->
    <?php include 'header.php'; ?>

    <h1 class="styleTitre">Ticket retour</h1>

    <form method="post">

        <!-- Informations commande -->
        <h2>Informations commande</h2>

        <label for="num_bon_cde">Numéro bon commande :</label><br>
        <select name="num_bon_cde">
            <?php foreach ($bons_cde as $bon_cde) { ?>
                <option value="<?= $bon_cde['Id_Commande'] ?>"><?= $bon_cde['Num_Commande'] ?></option>
            <?php } ?>
        </select><br><br>

        <label for="statut_ticket">Statut ticket retour :</label><br>
        <select name="statut_ticket">
            <?php foreach ($tickets_retour as $ticket_retour) { ?>
                <option value="<?= $ticket_retour['Statut_Ticket_SAV'] ?>"><?= $ticket_retour['Statut_Ticket_SAV'] ?></option>
            <?php } ?>
        </select><br><br>

        <label for="cause_retour">Cause du retour :</label><br>
        <select name="cause_retour">
            <?php foreach ($types_retour as $type_retour) { ?>
                <option value="<?= $type_retour['Id_Retour'] ?>"><?= $type_retour['Libelle_Retour'] ?></option>
            <?php } ?>
        </select><br><br>

        <!-- <div>
            <label for="suppr_ticket_retour">Supprimer le ticket retour :</label>
            <input type="checkbox" id="suppr_ticket_retour" name="suppr_ticket_retour" required>
        </div> -->

        <input type="submit" value="Valider">
    </form>

    <!-- Footer -->
    <?php include 'footer.php'; ?>