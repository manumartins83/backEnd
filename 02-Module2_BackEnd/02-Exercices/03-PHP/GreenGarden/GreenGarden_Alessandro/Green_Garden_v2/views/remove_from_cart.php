<?php

session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

function removeFromCart($productId)
{
  if (array_key_exists($productId, $_SESSION['cart'])) {
    $_SESSION['cart'][$productId]--;

    if ($_SESSION['cart'][$productId] <= 0) {
      unset($_SESSION['cart'][$productId]);
    }
  }
}

if (isset($_GET['id'])) {
  $productId = intval($_GET['id']);
  removeFromCart($productId);
}

$redirectUrl =  './panier.php';

header('Location: ' . $redirectUrl);
exit();
