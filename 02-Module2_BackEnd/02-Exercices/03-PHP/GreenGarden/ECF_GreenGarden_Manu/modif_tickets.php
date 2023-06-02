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

// si validation du formulaire dans structure HTML
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // récupération des infos du formulaire de la structure HTML
    $statut_ticket_retour = $_POST['statut_ticket'];
    $Id_ticket = $_POST['ticketId'];

    // requête de modification du statut ticket dans base de données
    $stmt = $pdo->prepare("UPDATE t_d_ticketsav SET Statut_Ticket_SAV=:statutTicket WHERE Id_Ticket_SAV=:idTicket");
    $stmt->bindValue(':statutTicket', $statut_ticket_retour);
    $stmt->bindValue(':idTicket', $Id_ticket);
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
    <title>Tickets retour</title>

    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Titre principal page -->
    <h1 class="styleTitre">Modification des tickets retour</h1>

    <?php
    // requête de récupération des données tickets dans base de données
    $sql = "SELECT * FROM t_d_ticketsav";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // si validation du formulaire dans structure HTML
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // affichage message modification statut ticket
        echo "<h2 class='styleTitreSecondaire'>Statut du ticket modifié avec succès !</h2>";
        // rafraichissement page 
        header('refresh:5;url= modif_tickets.php');
    }

    // si page pas vide alors
    if (!empty($tickets)) {
        // pour chaque données de la table tickets de la base de données
        foreach ($tickets as $ticket) {
            // affichage de la liste des tickets dans page
            echo "<div class='styleTextTicket card'>";

            echo "<div class='card-body'><strong>Numéro du ticket : </strong>" . $ticket['Num_Ticket_SAV'] . "</div>";
            echo "<div class='card-body'><strong>Date du ticket : </strong>{$ticket['Date_Ticket_SAV']}</div>";
            echo '<div class="card-body"><strong>Statut du ticket : </strong>' . $ticket['Statut_Ticket_SAV'] . "</div>";

            echo '<form class="stylePageModifTicket" method="post">
                    <div>
                        <label class="styleLabelModifTicket" for="statut_ticket">Sélectionner statut :</label>
                    </div>

                    <div>
                        <select class="styleSelectModifTicket" name="statut_ticket"> 
                                <option value="suivi" required>suivi</option>
                                <option value="resolu" required>résolu</option>
                        </select>
            
                        <div class="styleBtnPageModifTicket">
                            <input type="hidden" name="ticketId" value="' . $ticket["Id_Ticket_SAV"] . '">
                            <input class="styleBtnModifTicket" type="submit" value="Modifier statut">
                        </div>
                    </div>
                </form>';
            echo "</div>";
        }
    }
    ?>

    <!-- Footer -->
    <?php include 'footer.php'; ?>