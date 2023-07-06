<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface des commerciaux</title>
</head>
<body>
    <h1>Interface des Clients</h1>

    <!-- Formulaire de recherche de tickets SAV -->
    <form id="searchForm" action="search_tickets.php" method="post">
        <div class="form-group">
            <label for="searchTerm">Recherche :</label>
            <input type="text" id="searchTerm" name="searchTerm" required>
        </div>
        <input type="submit" value="Rechercher">
    </form>
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
</body>
</html>