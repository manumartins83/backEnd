<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technicien SAV</title>
</head>
<body>
    <h1>Technicien SAV</h1>

    <?php
    // Vérifier si le formulaire de création de ticket a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $commandNumber = $_POST['commandNumber'];
        $returnReason = $_POST['returnReason'];
        $issueDetails = $_POST['issueDetails'];

        // Effectuer les opérations de création de ticket en utilisant les données récupérées
        // ...

        // Afficher un message de succès ou d'erreur
        echo "<p>Ticket créé avec succès !</p>";
    }
    ?>

    <!-- Formulaire de création de ticket SAV -->
    <form id="ticketForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="commandNumber">Numéro de commande :</label>
            <input type="text" id="commandNumber" name="commandNumber" required>
        </div>

        <div class="form-group">
            <label for="returnReason">Motif du retour :</label>
            <select id="returnReason" name="returnReason" required>
                <option value="">Choisir...</option>
                <option value="npai">NPAI</option>
                <option value="abs">Absence</option>
                <option value="erreur_cde">Erreur de commande</option>
                <option value="panne">Panne</option>
                <option value="abime">Abîmé</option>
                <option value="non_conforme">Non conforme</option>
            </select>
        </div>

        <div class="form-group">
            <label for="issueDetails">Détails du problème :</label>
            <textarea id="issueDetails" name="issueDetails" rows="4" required></textarea>
        </div>

        <input type="submit" value="Créer le ticket">
    </form>

    <!-- Liste des tickets SAV existants -->
    <h2>Tickets SAV existants :</h2>
    <table>
        <tr>
            <th>Numéro de ticket</th>
            <th>Date de création</th>
            <th>Statut</th>
            <th>Client</th>
            <th>Détails</th>
        </tr>
        <?php
        // Récupérer et afficher les tickets SAV depuis la base de données
        $servername = "localhost";
        $username = "root";
        $password = "new_password";
        $dbname = "greengarden";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->query("SELECT * FROM t_d_ticketsav");
            $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tickets as $ticket) {
                echo "<tr>";
                echo "<td>" . $ticket['Num_Ticket_SAV'] . "</td>";
                echo "<td>" . $ticket['Date_Ticket_SAV'] . "</td>";
                echo "<td>" . $ticket['Statut_Ticket_SAV'] . "</td>";
                echo "<td><a href=\"ticket_details.php?ticketId=" . $ticket['Id_Ticket_SAV'] . "\">Détails</a></td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
    </table>

</body>
</html>
