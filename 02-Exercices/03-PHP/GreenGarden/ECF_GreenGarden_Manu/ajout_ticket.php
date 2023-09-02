<?php
// si la session de connexion n'est pas démarrée alors
if (session_status() == PHP_SESSION_NONE) {
    session_start(); /* démarrage session */
}

// si l'utilisateur n'est pas connecté alors
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php'); /* redirige vers la page de connexion */
    exit(); /* quitte la vérification */
}

// création des variables d'environnement d'accès à la base de données
$host = "localhost"; /* nom du service de la bdd */
$user = "root"; /* nom d'utilisateur de la bdd */
$password_db = ""; /* mdp de la bdd */
$dbname = "greengarden"; /* nom de la bdd */

// si connection OK alors
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password_db); /* connection à la bdd */
}
// sinon
catch (PDOException $e) {
    echo "Connection failed " . $e->getMessage(); /* message d'erreur */
}

// création de la variable de session
$user_id = $_SESSION['user_id']; /* de l'utilisateur correspondant */

// requête de récupération du technicien connecté dans la bdd
$stmt = $pdo->prepare("SELECT * FROM t_d_techniciensav WHERE Id_User=:useid"); /* requête sélection */
$stmt->bindValue(':useid', $user_id); /* met en place l'utilisateur de la session */
$stmt->execute(); /* exécute la requête */
$technicien = $stmt->fetch(PDO::FETCH_ASSOC); /* renvoi la réponse à la requête */

// requête de récupération des bons de commande dans la bdd
$bons_cde = $pdo->query("SELECT * FROM t_d_commande")->fetchAll(); /* requête sélection */
// requête de récupération des tickets SAV dans la bdd
$tickets_retour = $pdo->query("SELECT * FROM t_d_ticketsav")->fetchAll(); /* requête sélection */
// requête de récupération du statut de retour des tickets SAV dans la bdd
$types_retour = $pdo->query("SELECT * FROM t_d_typeretour")->fetchAll(); /* requête sélection */

// si post du formulaire OK
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // création des variables de récupération du formulaire
    $cde_id = $_POST['num_bon_cde']; /* numéro bon commande */
    $type_retour_id = $_POST['cause_retour']; /* statut retour du ticket */
    $today = date("Y-m-d H:i:s"); /* date et heure création */

    // requête d'insertion d'un ticket retour dans la bdd
    $stmt = $pdo->prepare("INSERT INTO t_d_ticketsav (Date_Ticket_SAV, Statut_Ticket_SAV, /* requête d'insertion */
    Id_Technicien_SAV, Id_Commande, Id_Retour) 	
    VALUES (:dateTicket, :statutTicket, :technicien, :cde, :retour)"); /* valeurs ajoutées */
    $stmt->bindValue(':dateTicket', $today); /* met en place la date */
    $stmt->bindValue(':statutTicket', 'crée'); /* met en place "crée" */
    $stmt->bindValue(':technicien', $technicien['Id_Technicien_SAV']); /* met en place le technicien de la requête */
    $stmt->bindValue(':cde', $cde_id); /* met en place le num bon cde posté */
    $stmt->bindValue(':retour', $type_retour_id); /* met en place le statut ticket posté */
    $stmt->execute(); /* exécute la requête */
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
                <?php foreach ($bons_cde as $bon_cde) {  // pour chaque données de la table bons de commande de la base de données 
                ?>
                    <option value="<?= $bon_cde['Id_Commande'] ?>"><?= $bon_cde['Num_Commande'] // affichage de la liste des bons dans select 
                                                                    ?></option>
                <?php } ?>
            </select>

            <select class="styleSelectAjoutTicket" name="cause_retour">
                <?php foreach ($types_retour as $type_retour) { // pour chaque données de la table type de retour ticket de la base de données 
                ?>
                    <option value="<?= $type_retour['Id_Retour'] ?>"><?= $type_retour['Libelle_Retour'] // affichage de la liste du type de retour dans select 
                                                                        ?></option>
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