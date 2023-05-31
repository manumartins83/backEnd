<?php  
 session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
  echo "L'utilisateur est connecté.";
} else {
  echo "L'utilisateur n'est pas connecté.";
}
?>
<header>
  <?php
  include('../includes/header.php');
  include('config.php');



  ?>

  <style>
    body {
      background-color: #f5f5f5;
    }

    h1 {
      font-size: 3rem;
      font-family: 'Nabla', cursive;
      font-weight: 700;
      color: #2d2d2d;
    }

    .btn_style {
      background-color: #2d2d2d;
      color: #fff;
      border: none;
      border-radius: 0;
      font-size: 1rem;
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
      padding: 1rem 2rem;
      text-transform: uppercase;
      letter-spacing: 0.1rem;
      transition: all 0.3s ease-in-out;
    }

    .btn_style:hover {
      background-color: #fff;
      color: #2d2d2d;
      border: 1px solid #2d2d2d;
    }

    .search_style {
      border-radius: 0;
      border: 1px solid #2d2d2d;
      font-size: 1rem;
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
      padding: 1rem 2rem;
      text-transform: uppercase;
      letter-spacing: 0.1rem;
      transition: all 0.3s ease-in-out;
    }

    .search_style:focus {
      border: 1px solid #2d2d2d;
      box-shadow: none;
    }

    .card_style:hover {

      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      transform: translateY(-20px);
    }

    .card_style {
      border: none;
      border-radius: 0;
      transition: all 0.3s ease-in-out;
      width: 300px;
      margin: 0 auto;
      padding: 0;
    }

    .navbar {
      background-color: #2d2d2d;
      color: #fff;
      border: none;
      border-radius: 0;
      font-size: 1rem;
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
      padding: 1rem 2rem;
      text-transform: uppercase;
      letter-spacing: 0.1rem;
      transition: all 0.3s ease-in-out;
    }

    .navbar1>a {
      color: green;
      text-decoration: none;
    }
  </style>
</header>

<img src="../medias/974188.png" alt="arbre" width="100" height="100" />
<div class="container mt-5">
  <h1 class="text-center">Bienvenue</h1>
  <form class="d-flex mt-4" method="get" action="catalogue.php" id="search-form">
    <input class="form-control me-2 " search_style type="search" placeholder="Recherche" aria-label="Recherche" name="query">
    <button class="btn btn-outline-success btn btn_style" type="submit">Recherche</button>
  </form>
</div>

<div class="container mt-5">
  <div class="row" id="search-results">
    <!-- Les résultats de la recherche seront affichés ici -->
  </div>

  <!-- As a link -->
  <div class="navbar bg-body-tertiary">
    <div class="container-fluid navbar1">
      <a href="ajout_produit.php">Ajout prodits catalogue</a>
      <a href="ajout_categorie.php">Ajout catégorie</a>
      <a href="ajout_fournisseur.php">Ajout fournisseur</a>
    </div>
  </div>

  <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <!-- Tronc de l'arbre -->
    <rect x="45" y="60" width="10" height="40" fill="#8B4513" />
    <!-- Feuillage de l'arbre -->
    <circle cx="50" cy="45" r="20" fill="#228B22" />
    <circle cx="65" cy="55" r="20" fill="#228B22" />
    <circle cx="35" cy="55" r="20" fill="#228B22" />
  </svg>

  <?php

  // Connexion à la base de données (remplacez les valeurs par celles de votre base de données)
  $servername = "localhost";
  $username = "root";
  $password = "new_password";
  $dbname = "greengarden";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la recherche
    $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

    // Déterminez si une catégorie est sélectionnée
    if (isset($_GET['categorie'])) {
      $select_categorie = $_GET['categorie'];
      // Préparez une requête pour récupérer les produits de la catégorie sélectionnée
      $sql = "SELECT p.*, f.Nom_Fournisseur, c.Libelle FROM t_d_produit p
  JOIN t_d_fournisseur f ON p.Id_Fournisseur = f.Id_Fournisseur
  JOIN t_d_categorie c ON p.Id_Categorie = c.Id_Categorie
  WHERE p.Id_Categorie = :categorie AND p.nom_court LIKE :searchQuery";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':categorie', $select_categorie);
    } else {
      // Préparez une requête pour récupérer tous les produits
      $sql = "SELECT p.*, f.Nom_Fournisseur, c.Libelle FROM t_d_produit p
  JOIN t_d_fournisseur f ON p.Id_Fournisseur = f.Id_Fournisseur
  JOIN t_d_categorie c ON p.Id_Categorie = c.Id_Categorie
  WHERE p.nom_court LIKE :searchQuery";
      $stmt = $conn->prepare($sql);
    }

    // Ajoutez le paramètre de recherche
    $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');

    // Exécutez la requête
    $stmt->execute();
    $products = $stmt->fetchAll();



    if ($stmt->rowCount() > 0) {
      $counter = 1;
      echo '<div class="row">';

      foreach ($products as $product) {
        $calculTVA = $product['Prix_Achat'] * $product['Taux_TVA'] / 100;
        $prixTTC = $product['Prix_Achat'] + $calculTVA;

        echo '<div class="col-md-4 mb-4 card_style">';
        echo '<div class="card h-100 d-flex flex-column">';
        echo '<img src="' . $product['Photo'] . '" class="card-img-top" alt="'  . '">';
        echo '<div class="card-body d-flex flex-column">';
        echo '<h5 class="card-title">' . $product['Nom_court'] . '</h5>';
        echo '<p class="card-text flex-grow-1">' . $product['Nom_Long'] . '</p>';
        echo '<p class="card-text">' . $product['Prix_Achat'] . ' €</p>';
        echo '<p class="card-text">' . $product['Taux_TVA'] . ' %</p>';
        echo '<p class="card-text">' . round($prixTTC, 2) . ' € TTC</p>';
        echo '<p class="card-text">Fournisseur: ' . $product['Nom_Fournisseur'] . '</p>';
        echo '<p class="card-text">Catégorie: ' . $product['Libelle'] . '</p>';
        echo '<div class="mt-auto">';
        echo '<a href="consult_produit.php?id=' . $product['Id_Produit'] . '" class="btn btn-primary">Voir le produit</a>';
        echo '<a href="add_to_cart.php?id=' . $product['Id_Produit'] . '" class="btn btn-warning m-2">Ajouter au panier</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        if ($counter % 3 == 0) {
          echo '</div><div class="row">';
        }
        $counter++;
      }

      echo '</div>';
    } else {
      echo '<p>Aucun produit trouvé.</p>';
    }

    $conn = null;
  } catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
  }


  include('../includes/footer.php');
