<?php
var_dump($_POST);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Après que l'utilisateur ait soumis le formulaire de connexion...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Récupérer l'utilisateur de la base de données
  $stmt = $conn->prepare("SELECT * FROM t_d_client WHERE Mail_Client = :email");
  $stmt->execute(['email' => $email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Vérifier si l'utilisateur existe et si le mot de passe correspond
  if ($user && password_verify($password, $user['PASSWORD'])) {
    // Démarrer une nouvelle session et enregistrer l'information de l'utilisateur dans la session
    session_start();
    $_SESSION['user_id'] = $user['Id_Client'];
    // Rediriger l'utilisateur vers une page protégée
    header('Location: /protected_page.php');
    exit();
  } else {
    // Gérer les erreurs d'authentification
    echo "Invalid email or password.";
  }
}
