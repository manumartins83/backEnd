<?php
require('config.php');
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    echo "L'utilisateur est connecté.";
} else {
    echo "L'utilisateur n'est pas connecté.";
}

// Après que l'utilisateur ait soumis le formulaire de connexion...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['Password'];

  // Récupérer l'utilisateur de la base de données
  $stmt = $conn->prepare("SELECT * FROM t_d_user WHERE Login = :email");
  $stmt->execute(['email' => $email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Vérifier si l'utilisateur existe et si le mot de passe correspond
  if ($user && password_verify($password, $user['Password'])) {
    // Enregistrer l'information de l'utilisateur dans la session
    $_SESSION['user_id'] = $user['Id_User'];
    $_SESSION['user_email'] = $user['Login'];
    // Rediriger l'utilisateur vers une page protégée
    header('Location: ./index.php');
    exit();
  } else {
    // Gérer les erreurs d'authentification
    echo "Invalid email or password.";
  }
}


