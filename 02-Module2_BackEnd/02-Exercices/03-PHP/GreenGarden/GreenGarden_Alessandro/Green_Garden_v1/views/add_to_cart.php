<?php
include_once 'cart_functions.php';


if (isset($_GET['id'])) {
  $productId = intval($_GET['id']);
  addToCart($productId);
  header("Location: panier.php");
  exit;
} else {
  // Gérer l'erreur si l'ID du produit n'est pas fourni
  echo "Erreur : ID du produit manquant";
}
/**Ce fichier récupère l'ID du produit à partir de la requête GET, appelle la fonction addToCart($productId) pour ajouter le produit au panier, puis redirige l'utilisateur vers la page du panier. Si l'ID du produit n'est pas fourni, il affiche un message d'erreur. */
