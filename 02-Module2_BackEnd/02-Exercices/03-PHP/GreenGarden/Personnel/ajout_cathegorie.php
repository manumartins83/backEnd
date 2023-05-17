<?php
include 'header.php';
require 'functions.php';

// Récupération des informations de l'utilisateur connecté
$host = "localhost"; // Nom d'hôte de la base de données
$user = "root"; // Nom d'utilisateur de la base de données
$password_db = ""; // Mot de passe de la base de données
$dbname = "greengarden"; // Nom de la base de données

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password_db);
    // configuration pour afficher les erreurs pdo
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification si le formulaire a été soumis
    if (
        isset($_POST['categorie'])
    )

        $categorie = $_POST['categorie'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS total from t_d_categorie where Libelle=:nomcat");
    $stmt->bindValue(':nomcat', $_POST['categorie']);
    $stmt->execute();
    $categorieTot =  $stmt->fetch(PDO::FETCH_ASSOC);
    $totalCat = $categorieTot['total'];

    if ($totalCat < 1) {
        try {
            $stmt = $conn->prepare("INSERT INTO t_d_categorie (Libelle, Id_Categorie_Parent)
                     VALUES (:nomcat, idcatPa)");
            $stmt->bindValue(':nomcat', $categorie);
            $stmt->bindValue(':idcatPa', $categorie);
            $stmt->execute();
            $categorie_id = $conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
            exit();
        }
    } else {
        echo 'la catégorie existe déjà';
    }
}
?>


<h1 class="styleTitre">Ajout d'une catégorie</h1>

<div>
    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="categorie">Catégorie : </label>
            <input type="text" id="nomcat" name="categorie" required>
        </div>
        <button id="button" type="submit">Ajouter</button>
    </form>
</div>

<?php include 'footer.php'; ?>