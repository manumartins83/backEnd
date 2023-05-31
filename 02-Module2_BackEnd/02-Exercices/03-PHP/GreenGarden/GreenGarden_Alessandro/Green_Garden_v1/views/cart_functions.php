<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function addToCart($productId) {
    if (array_key_exists($productId, $_SESSION['cart'])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }
}

function getCartCount() {
    return array_sum($_SESSION['cart']);
}
/**cart_functions.php est un fichier contenant des fonctions pour gérer le panier d'achat, comme je l'ai mentionné précédemment. Vous pouvez inclure ce fichier dans d'autres fichiers PHP pour utiliser ces fonctions et gérer le panier. */
