<?php
        // Récupérer et afficher les tickets SAV trouvés depuis la base de données
        $servername = "localhost";
        $username = "root";
        $password = "new_password";
        $dbname = "greengarden";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $searchTerm = $_POST['searchTerm'];

                $stmt = $conn->prepare("SELECT * FROM t_d_ticketSAV WHERE Num_Ticket_SAV LIKE ? OR Statut_Ticket_SAV LIKE ?");
                $stmt->execute(["%$searchTerm%", "%$searchTerm%"]);
                $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($tickets as $ticket) {
                    echo "<tr>";
                    echo "<td>" . $ticket['Num_Ticket_SAV'] . "</td>";
                    echo "<td>" . $ticket['Date_Ticket_SAV'] . "</td>";
                    echo "<td>" . $ticket['Statut_Ticket_SAV'] . "</td>";
                    echo "<td><a href=\"ticket_details.php?ticketId=" . $ticket['Id_Ticket_SAV'] . "\">Détails</a></td>";
                    echo "</tr>";
                }
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>