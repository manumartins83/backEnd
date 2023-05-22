<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "my-secret-pw";
$dbname = "greengarden";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données du formulaire
  $name = $_POST['Nom_Client'] ?? '';
  $lastname = $_POST['Prenom_Client'] ?? '';
  $email = $_POST['Mail_Client'] ?? '';
  $password = $_POST['PASSWORD'] ?? '';
  $password_confirm = $_POST['password_confirm'] ?? '';
  $delai_paiement_client = isset($_POST['DelaiPaiement_Client']) ? $_POST['DelaiPaiement_Client'] : '';

  $client_types = array(
    'particulier' => 1,
    'professionnel' => 2
  );

  $client_type = isset($_POST['Id_Type_Client']) ? $client_types[$_POST['Id_Type_Client']] : '';


  // Expressions régulières pour valider les données du formulaire
  $name_regex = '/^[a-zA-Z0-9-_]{3,}$/'; // Lettres, chiffres, tiret, underscore, au moins 3 caractères
  $lastname_regex = '/^[a-zA-Z0-9-_]{3,}$/'; // Lettres, chiffres, tiret, underscore, au moins 3 caractères
  $email_regex = '/^\S+@\S+\.\S+$/'; // Format d'email basique
  $password_regex = '/^.{8,}$/'; // Au moins 8 caractères

  // Valider les données avec les regex
  if (!preg_match($name_regex, $name)) {
    echo "Le nom est invalide.";
  } elseif (!preg_match($lastname_regex, $lastname)) {
    echo "Le prénom est invalide.";
  } elseif (!preg_match($email_regex, $email)) {
    echo "L'email est invalide.";
  } elseif (!preg_match($password_regex, $password)) {
    echo "Le mot de passe doit contenir au moins 8 caractères.";
  } elseif ($password !== $password_confirm) {
    echo "Les mots de passe ne correspondent pas.";
  } else {
    // Si toutes les entrées sont valides, on peut procéder à l'inscription de l'utilisateur

    // Hasher le mot de passe avant de l'insérer dans la base de données
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insérer le nouvel utilisateur dans la base de données
    $sql = "INSERT INTO t_d_client (Nom_Client, Prenom_Client, Mail_Client, PASSWORD, Id_Type_Client, Id_Commercial) VALUES (:name, :lastname, :email, :password, :client_type, :id_commercial)";

    $stmt = $conn->prepare($sql); // Préparer la requête SQL

    $stmt->execute([
      ':name' => $name,
      ':lastname' => $lastname,
      ':email' => $email,
      ':password' => $hashed_password,
      ':client_type' => $client_type,
      ':id_commercial' => $id_commercial
    ]);



    // Rediriger 
    header('Location: ./index.php?success=1');
    exit();
  }
}
