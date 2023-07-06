<header>
        <?php include('../includes/header.php'); ?>
        <!-- Le contenu de l'en-tête (liens, etc.) sera chargé à partir du fichier header.php -->
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
        h1{
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
        $libelle = $_POST['libelle'];

        $stmt = $conn->prepare("INSERT INTO t_d_categorie (Libelle) VALUES (:libelle)");
        $stmt->bindValue(':libelle', $libelle);
        
        try {
            $stmt->execute();
            $success = "Catégorie ajoutée avec succès!";
        } catch (PDOException $e) {
            $error = "Erreur lors de l'ajout de la catégorie: " . $e->getMessage();
        }
    }
?>
    <?php
        if (isset($error)) echo "<p style='color: red'>$error</p>";
        if (isset($success)) echo "<p style='color: green'>$success</p>";
    ?>

    
    <div class="form-container">
        <h1>Ajout d'une catégorie</h1>
    <form method="post">
        <label for="libelle">Nom de la catégorie :</label>
        <input type="text" id="libelle" name="libelle" required>
        <button type="submit">Ajouter</button>
    </form>
    </div>
<footer>
        <?php include('../includes/footer.php'); ?>
        <!-- Le contenu du pied de page (liens, etc.) sera chargé à partir du fichier footer.php -->
</footer>-