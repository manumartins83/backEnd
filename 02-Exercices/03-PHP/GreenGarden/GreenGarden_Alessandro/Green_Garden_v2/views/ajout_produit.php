<?php
require 'function.php';



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
    // Vérification si le formulaire a été soumis
    if (
        isset($_POST['nom_court']) && isset($_POST['nom_long']) && isset($_POST['reference'])
        && isset($_POST['prix'])
        && isset($_POST['tva']) && isset($_POST['categorie']) && isset($_FILES['photo'])
        && isset($_POST['fournisseur'])
    ) {
        $noml_produit = $_POST['nom_long'];
        $nomc_produit = $_POST['nom_court'];
        $reference_produit = $_POST['reference'];
        $prix_produit = $_POST['prix'];
        $tva = $_POST['tva'];
        $photo_produit = $_FILES['photo'];


        $stmt = $conn->prepare("SELECT * from t_d_categorie where Libelle=:lib");
        $stmt->bindValue(':lib', $_POST['categorie']);
        $stmt->execute();
        $categorie =  $stmt->fetch(PDO::FETCH_ASSOC);

        if (upload_file($photo_produit, "img/")) {
            // Vérification si le produit existe déjà dans la base de données
            $stmt = $conn->prepare("SELECT * FROM t_d_produit WHERE Ref_fournisseur = :reference AND Id_Fournisseur = 1");
            $stmt->bindValue(':reference', $reference_produit);
            $stmt->bindValue(':fournisseur', $fournisseur);
            $stmt->execute();
            $existing_product = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($existing_product) {
                $error = "Un produit avec cette référence existe déjà";
            }
            // Ajout du produit à la base de données
            try {
                $stmt = $conn->prepare("INSERT INTO t_d_produit (Nom_Long, Nom_court
					, Ref_fournisseur, Prix_Achat,
					 Id_Fournisseur, Id_Categorie,
					 Photo,Taux_TVA)
					 VALUES (:nomlon,:nomcourt, :reference, :prix,1,:cat, :photo, :tva)");
                $stmt->bindValue(':nomlon', $noml_produit);
                $stmt->bindValue(':nomcourt', $nomc_produit);
                $stmt->bindValue(':reference', $reference_produit);
                $stmt->bindValue(':prix', $prix_produit);
                $stmt->bindValue(':tva', $tva);
                $stmt->bindValue(':cat', $categorie['Id_Categorie']);
                $stmt->bindValue(':photo', $photo_produit['name']);
                $stmt->execute();
                $product_id = $conn->lastInsertId();
                header("Location: consult_produit.php?id=$product_id");
                exit();
            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();
                exit();
            }
        } else {
            echo "Le fichier uploadé n'est pas une image";
        }
    } else {
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php include('../includes/header.php'); ?>
    <title>Ajout d'un produit</title>
    <style>
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
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
</head>

<body>
    <?php
    // include 'header.php';
    if (isset($error)) : ?>
        <p style="color: red"><?= $error ?></p>
    <?php endif ?>

    <?php if (isset($success)) : ?>
        <p style="color: green"><?= $success ?></p>
    <?php endif ?>

    <?php if (isset($success)) : ?>
        <p style="color: green"><?= $success ?></p>
    <?php endif ?>


    <div class="form-container">
        <h1>Ajout d'un produit</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nomcourt" class="form-label">Nom :</label>
                <input type="text" id="nomc" name="nom_court" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nomlong" class="form-label">Nom long (description):</label>
                <input type="text" id="noml" name="nom_long" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="reference" class="form-label">Référence Fournisseur:</label>
                <input type="text" id="reference" name="reference" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix HT Fournisseur:</label>
                <input type="number" id="prix" name="prix" class="form-control" min="0" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="tva" class="form-label">Taux TVA:</label>
                <input type="number" id="tva" name="tva" class="form-control" min="0" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="categorie" class="form-label">Catégorie :</label>
                <select name="categorie" class="form-select">
                    <?php
                    $stmt = $conn->query("SELECT * from t_d_categorie");

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch()) {
                            echo "<option>" . $row['Libelle'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="fournisseur" class="form-label">Fournisseur :</label>
                <select name="fournisseur" class="form-select">
                    <?php
                    $stmt = $conn->query("SELECT * from t_d_fournisseur");

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch()) {
                            echo "<option value=\"" . $row['Id_Fournisseur'] . "\">" . $row['Nom_Fournisseur'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo :</label>
                <input type="file" id="photo" name="photo" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    <footer>
        <?php include('../includes/footer.php'); ?>
        <!-- Le contenu du pied de page (liens, etc.) sera chargé à partir du fichier footer.php -->
    </footer>-