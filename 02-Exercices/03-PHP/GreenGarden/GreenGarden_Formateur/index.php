<?php include 'header.php';
require 'functions.php';

?>

<?php if (isset($_SESSION['user_id'])) :
    // Vérification si l'utilisateur existe déjà dans la base de données
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

    $stmt = $conn->prepare("SELECT * FROM t_d_user WHERE Id_User=:id");
    $stmt->bindValue(':id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

?>
    <p>Bonjour <?php echo $user['Login']; ?> !</p>

    <form method="POST">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Se déconnecter">
    </form>
<?php else : ?>
    <p><a href="login.php">Se connecter</a> ou <a href="inscription.php">s'inscrire</a></p>
<?php endif; ?>


<p>Coucou </p>
<?php
echo 'coucou||||||   /////';
?>

<?php include 'footer.php'; ?>