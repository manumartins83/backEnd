<?php
// Démarrage de la session
session_start();



// Récupération des informations de l'utilisateur connecté
$host = "localhost"; // Nom d'hôte de la base de données
$user = "root"; // Nom d'utilisateur de la base de données
$password_db = ""; // Mot de passe de la base de données
$dbname = "greengarden"; // Nom de la base de données

try {
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password_db);
	// configuration pour afficher les erreurs pdo
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}



// Vérification si le produit est spécifié dans l'URL
if (isset($_GET['id'])) {
	$id_produit = $_GET['id'];

	// Récupération des informations du produit
	try {
		$stmt = $conn->prepare("SELECT * FROM t_d_produit WHERE id_produit=:id");
		$stmt->bindValue(':id', $id_produit);
		$stmt->execute();
		$produit = $stmt->fetch(PDO::FETCH_ASSOC);


		$stmt = $conn->prepare("SELECT * from t_d_categorie where Id_Categorie=:idcat");
		$stmt->bindValue(':idcat', $produit['Id_Categorie']);
		$stmt->execute();
		$categorie =  $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo "Erreur: " . $e->getMessage();
		exit();
	}
} else {
	echo "Produit non spécifié";
	exit();
}
?>

<!DOCTYPE html>
<html>

<head>
	<title><?php echo "Green Garden: présentation du produit " . $produit['Nom_court']; ?></title>
</head>

<body>
	<h1><?php echo $produit['Ref_fournisseur'] . " - " . $produit['Nom_court']; ?></h1>
	<p>Catégorie: <?php echo $categorie['Libelle']; ?> </p>
	<p>Description: <?php echo $produit['Nom_Long']; ?></p>
	<p>Prix: <?php echo $produit['Prix_Achat']; ?> €</p>

	<!-- on pourrai mettre la photo du produit -->

	<form method="POST" action="ajout_panier.php">
		<input type="hidden" name="id" value="<?php echo $id_produit; ?>">
		<input type="submit" value="Ajouter au panier">
	</form>
</body>

</html>