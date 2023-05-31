<header>
    <?php include('../includes/header.php'); ?>
    <title>Ajout d'un fournisseur</title>
    <style>
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            justify-content: center;
        }

        .form-container h1 {
            margin-bottom: 20px;

        }

        .form-container .mb-3 {
            margin-bottom: 10px;
        }

        h1 {
            font-family: 'Moo Lah Lah', cursive;
        }
    </style>
</header>
<?php
// Récupération des informations de l'utilisateur connecté
$host = "localhost"; // Nom d'hôte de la base de données
$user = "root"; // Nom d'utilisateur de la base de données
$password_db = "new_password"; // Mot de passe de la base de données
$dbname = "greengarden"; // Nom de la base de données

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password_db);
    // configuration pour afficher les erreurs pdo
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_fournisseur = $_POST['nom_fournisseur'];

    $stmt = $conn->prepare("INSERT INTO t_d_fournisseur (Nom_Fournisseur) VALUES (:nom_fournisseur)");
    $stmt->bindValue(':nom_fournisseur', $nom_fournisseur);

    try {
        $stmt->execute();
        $success = "Fournisseur ajouté avec succès!";
    } catch (PDOException $e) {
        $error = "Erreur lors de l'ajout du fournisseur: " . $e->getMessage();
    }
}
?>
<?php
if (isset($error)) echo "<p style='color: red'>$error</p>";
if (isset($success)) echo "<p style='color: green'>$success</p>";
?>


<div class="form-container">
    <h1>Ajout d'un fournisseur</h1>
    <form method="post">
        <label for="nom_fournisseur">Nom du fournisseur :</label>
        <input type="text" id="nom_fournisseur" name="nom_fournisseur" required>
        <button type="submit">Ajouter</button>
    </form>
</div>
<footer>
    <?php include('../includes/footer.php'); ?>
</footer>