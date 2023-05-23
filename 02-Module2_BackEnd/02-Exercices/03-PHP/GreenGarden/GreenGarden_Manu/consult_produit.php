<?php

require 'produit.php';
require 'categorie.php';
require 'fournisseur.php';

// $host = "localhost";
// $user = "root";
// $pwd = "";
// $dbname = "greengarden";

// try {
//     $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
// } catch (PDOException $e) {
//     echo "Connection failed " . $e->getMessage();
// }

if (isset($_GET['id'])) {

    $id_produit = $_GET['id'];

    try {
        // $stmt = $conn->prepare("SELECT * FROM t_d_produit where Id_Produit=:id");
        // $stmt->bindValue(':id', $id_produit);
        // $stmt->execute();
        // $produit = $stmt->fetch(PDO::FETCH_ASSOC);

        $p = new Produit();
        $produit = $p->getProduitById($id_produit)[0];

        // $stmt = $conn->prepare("SELECT * FROM t_d_categorie where Id_Categorie=:idcat");
        // $stmt->bindValue(':idcat', $produit['Id_Categorie']);
        // $stmt->execute();
        // $categorie = $stmt->fetch(PDO::FETCH_ASSOC);

        $c = new Categorie();
        $categorie = $c->getCategorieById($produit['Id_Categorie'])[0];

        // $stmt = $conn->prepare("SELECT * FROM t_d_fournisseur where Id_Fournisseur=:idfour");
        // $stmt->bindValue(':idfour', $produit['Id_Fournisseur']);
        // $stmt->execute();
        // $fournisseur = $stmt->fetch(PDO::FETCH_ASSOC);

        $f = new Fournisseur();
        $fournisseur = $f->getFournisseurById($produit['Id_Fournisseur'])[0];

    } catch (PDOException $e) {
        echo
        "Erreur: " . $e->getMessage();
        exit();
    }
} else {
    echo "Produit non spécifié";
    exit;
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation produit : <?php echo $produit['Nom_court']; ?></title>

    <!-- Header -->
    <?php include 'header.php'; ?>


    <div class='card styleCardProduit'>
        <img class='styleImgProduitConsult' src='<?php echo "img/" . $produit['Photo']; ?>'>
        <div class='styleTextProduit'>
            <h1 class='card-body'><strong><?php echo $produit['Nom_court']; ?></strong></h1>
            <div class='card-body'><strong>Fournisseur : </strong><?php echo $fournisseur['Nom_Fournisseur']; ?></div>
            <div class='card-body'><strong>Référence : </strong><?php echo $produit['Ref_fournisseur']; ?></div>
            <div class='card-body'><strong>Catégorie : </strong><?php echo $categorie['Libelle']; ?></div>
            <div class='card-body'><strong>Description : </strong><?php echo $produit['Nom_Long']; ?></div>

            <?php
            $calculTVA = $produit['Prix_Achat'] * $produit['Taux_TVA'] / 100;
            $prixTTC = $produit['Prix_Achat'] + $calculTVA;
            ?>

            <div class='card-body'><strong>Prix HT : </strong><?php echo $produit['Prix_Achat'] . " €"; ?></div>
            <div class='card-body'><strong>Prix TTC : </strong><?php echo round($prixTTC, 2) . " €"; ?></div>
        </div>

        <form method="POST" action="ajout_panier.php">
            <input type="hidden" name="id" value="<?php echo $id_produit ?>">
            <input class='styleBtnAjoutPanier' type="submit" value="Ajouter au panier">
        </form>
    </div>






    <!-- Footer -->
    <?php include 'footer.php'; ?>