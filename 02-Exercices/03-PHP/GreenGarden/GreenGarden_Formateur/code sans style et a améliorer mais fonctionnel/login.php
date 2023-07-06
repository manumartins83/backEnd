<?php
// Démarrage de la session
session_start();

// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
	header('Location: index.php'); // Redirection vers la page d'accueil si l'utilisateur est déjà connecté
	exit();
}

// Traitement de la soumission du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Récupération des données du formulaire en méthode POST
	$login = $_POST['login'];
	$password = $_POST['password'];

	// Vérification des identifiants dans la base de données
	$host = "localhost"; // Nom d'hôte de la base de données
	$userBD = "root"; // Nom d'utilisateur de la base de données
	$password_db = ""; // Mot de passe de la base de données
	$dbname = "greengarden"; // Nom de la base de données

	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $userBD, $password_db);
		// configuration pour afficher les erreurs pdo
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

	$stmt = $conn->prepare("SELECT * FROM t_d_user WHERE login=:login");
	$stmt->bindValue(':login', $login);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($user && password_verify($password, $user['Password'])) {
		// Connexion réussie, stockage de l'identifiant de l'utilisateur dans la variable de session
		$_SESSION['user_id'] = $user['Id_User'];


		//recup le type d'utilisateur pour renseigner la variable de session user_type


		$_SESSION['logged_in'] = true;
		header('Location: index.php'); // Redirection vers la page d'accueil
		exit();
	} else {
		// Identifiants incorrects, affichage d'un message d'erreur
		$error_message = "Email ou mot de passe incorrect.";
	}
}
?>

<?php include 'header.php' ?>

<h1>Connexion</h1>
<?php if (isset($error_message)) : ?>
	<p><?php echo $error_message; ?></p>
<?php endif; ?>
<form method="POST">
	<label for="login">Login :</label>
	<input type="login" id="login" name="login" required><br>
	<label for="password">Mot de passe :</label>
	<input type="password" id="password" name="password" required><br>
	<input type="submit" value="Se connecter">
</form>
<p>Pas encore inscrit ? <a href="inscription.php">S'inscrire</a></p>
</body>

</html>