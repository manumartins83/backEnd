<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "new_password";
$dbname = "greengarden";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Récupérer l'ID du produit
  $productId = $_GET['id'];

  // Requête pour récupérer les informations du produit
  $sql = "SELECT * FROM t_d_produit WHERE Id_Produit = :id";
  $stmt = $conn->prepare($sql);
  $stmt->execute(['id' => $productId]);
  $product = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>

<?php include('../includes/header.php'); ?>


<div class="container mt-5">
  <div class="row">
    <?php if ($product !== null) : ?>
      <div class="col-md-6">
        <img src="<?php echo $product['Photo']; ?>" class="img-fluid" alt="<?php echo $product['Nom_court']; ?>">
      </div>
      <div class="col-md-6">
        <h1><?php echo $product['Nom_court']; ?></h1>
        <p><?php echo $product['Nom_Long']; ?></p>
        <p><?php echo $product['Prix_Achat']; ?></p>
      </div>
    <?php else : ?>
      <div class="col-md-12">
        <p>Le produit n'a pas été trouvé.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- Ajoutez le lien vers votre fichier JavaScript ici -->
<?php include('../includes/footer.php'); ?>