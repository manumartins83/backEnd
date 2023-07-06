<?php
// create_ticket.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commandNumber = $_POST['commandNumber'];
    $returnReason = $_POST['returnReason'];
    $issueDetails = $_POST['issueDetails'];

    // Effectuer les opérations de création de ticket ici
    // Insérer les données dans la base de données ou effectuer d'autres traitements nécessaires

    // Exemple de code pour insérer les données dans la table "t_d_ticketSAV"
    $servername = "localhost";
    $username = "root";
    $password = "new_password";
    $dbname = "greengarden";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO t_d_ticketsav (Num_Ticket_SAV, Id_Commande, Id_Retour) 
        VALUES (?, NOW(), ,'créé')");
        $stmt->execute([$commandNumber]);

        // Récupérer l'ID du ticket nouvellement créé
        $ticketId = $conn->lastInsertId();

        // Insérer les autres données dans la table ou effectuer d'autres opérations nécessaires

        // Rediriger vers la page des tickets SAV avec un message de succès
        header("Location: technicienSAV.php?success=1");
        exit();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
} else {
    echo "Erreur lors de la soumission du formulaire";
}
?>
