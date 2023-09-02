<?php
// si la session de connexion n'est pas démarrée alors
if (session_status() == PHP_SESSION_NONE) {
    session_start(); /* démarrage session */
}

// si la session renvoi un utilisateur client alors
if (isset($_SESSION['user_id'])) {
    header('Location: index.php'); /* redirige vers la page d'accueil */
    exit(); /* quitte la vérification */
}

// si post du formulaire OK alors
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // création des variables de récupération du formulaire
    $login = $_POST["login"]; /* login */
    $password = $_POST["password"]; /* mdp */

    // création des variables d'environnement d'accès à la base de données
    $host = "localhost"; /* nom du service de la bdd */
    $user = "root"; /* nom d'utilisateur de la bdd */
    $password_db = ""; /* mdp de la bdd */
    $dbname = "greengarden"; /* nom de la bdd */

    // si connection OK alors
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password_db); /* connection à la bdd */
    }
    // sinon
    catch (PDOException $e) {
        echo "Connection failed " . $e->getMessage(); /* message d'erreur */
    }

    // requête de récupération de l'authentification de l'utilisateur dans la bdd
    $stmt = $conn->prepare('SELECT * FROM t_d_user WHERE Login=:login'); /* requête sélection */
    $stmt->bindValue(':login', $login); /* met en place le login posté */
    $stmt->execute(); /* exécute la requête */
    $use = $stmt->fetch(PDO::FETCH_ASSOC); /* renvoi la réponse à la requête */

    // si le mdp utilisateur est OK
    if ($use && password_verify($password, $use['Password'])) {
        $_SESSION['user_id'] = $use['Id_User']; /* défini la session utilisateur correspondante de la requête*/

        // requête de récupération du type d'utilisateur dans la bdd
        $stmt = $conn->prepare('SELECT * FROM t_d_usertype WHERE Id_UserType=:Id_UserType'); /* requête sélection */
        $stmt->bindValue(':Id_UserType', $use['Id_UserType']); /* met en place le type d'utilisateur de la requête */
        $stmt->execute(); /* exécute la requête */
        $useType = $stmt->fetch(PDO::FETCH_ASSOC); /* renvoi la réponse à la requête */

        $_SESSION['user_type'] = $useType['Libelle']; /* défini la session du type d'utilisateur de la requête */
        $_SESSION['logged_in'] = true; /* défini la session de connexion à vrai */

        header('Location: index.php'); /* redirige vers la page de connexion */
        exit(); /* quitte la vérification */
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <!-- Header -->
    <?php include 'header.php'; ?>

    <h1 class="styleTitre">Connexion</h1>

    <?php if (isset($error_message)) :
    ?>
        <p> <?php echo $error_message ?></p>
    <?php endif; ?>

    <form class="stylePageLogin" method="POST">

        <div>
            <label class="styleLabelLogin" for="login">Votre login :</label>
            <label class="styleLabelLogin" for="password">Votre password :</label>
        </div>

        <div>
            <input class="styleInputLogin" type="login" id="login" name="login" required>
            <input class="styleInputLogin" type="password" id="password" name="password" required>

            <div class="styleBtnPageLogin">
                <input class="styleBtnLogin" type="submit" value="Se connecter">
            </div>
        </div>

    </form>

    <div class="styleBtnPageLogin">
        <p>Pas encore inscrit ? <a href="inscription.php"> S'inscrire</a></p>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>