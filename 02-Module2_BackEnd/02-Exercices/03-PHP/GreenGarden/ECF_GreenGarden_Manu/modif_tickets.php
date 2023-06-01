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

// requête de récupération dans base données
$sql = "SELECT * FROM t_d_ticketsav";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // récupérer les informations du formulaire
    $statut_ticket_retour = $_POST['statut_ticket'];

    // insérer le ticket dans la base de données
    $stmt = $pdo->prepare("UPDATE t_d_ticketsav SET Statut_Ticket_SAV=:statutTicket WHERE Id_Ticket_SAV=:idTicket");
    $stmt->bindValue(':statutTicket', $statut_ticket_retour);
    $stmt->bindValue(':idTicket', $tickets['Id_Ticket_SAV']);
    $stmt->execute();
}
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
    <h1 class="styleTitre">Modification des tickets retour</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Afficher un message de succès
        echo "<h2 class='styleTitreSecondaire'>Ticket modifié avec succès !</h2>";
    }

    // $sql = "select * from t_d_ticketsav";
    // $stmt = $pdo->query($sql);

    // if ($stmt->rowCount() > 0) {
    // while ($row = $stmt->fetch()) {
    if (!empty($tickets)) {
        foreach ($tickets as $ticket) {
            // liste des tickets
            echo "<div class='styleTextTicket'>";
            echo "<div class='card-body'><strong>Numéro du ticket : </strong>" . $ticket['Num_Ticket_SAV'] . "</div>";
            echo "<div class='card-body'><strong>Date du ticket : </strong>{$ticket['Date_Ticket_SAV']}</div>";

            echo '<div class="card-body"><strong>Statut du ticket : </strong>' . $ticket['Statut_Ticket_SAV'] .
                '<form class="stylePageModifTicket" method="post">
            <div>

                <select class="styleSelectModifTicket" name="statut_ticket"> 
                        <option value="suivi">suivi</option>
                        <option value="resolu">résolu</option>
                </select>
            
                <div class="styleBtnPageModifTicket">
                    <input type="hidden" name="id" value="' . $ticket["Id_Ticket_SAV"] . '">
                    <input class="styleBtnModifTicket" type="submit" value="Modifier ticket">
                </div>
            </div>
            </form>'
                . '</div>';

            echo "</div>";
        }
        $stmt->closeCursor(); //vide mémoire
    }
    ?>

    <!-- Footer -->
    <?php include 'footer.php'; ?>