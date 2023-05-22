<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <header>
        <?php include('../includes/header.php');
        ?>
    </header>


    <div class="container">
        <h1>Inscription</h1>
        <form action="./process_inscription.php" method="post">
            <div class="form-group">
                <label for="Nom_Client">Votre nom</label>
                <input type="text" class="form-control" id="Nom_Client" name="Nom_Client" required>
            </div>
            <div class="form-group">
                <label for="Prenom_Client">Votre prénom</label>
                <input type="text" class="form-control" id="Prenom_Client" name="Prenom_Client" required>
            </div>
            <div class="form-group">
                <label for="Mail_Client">Email</label>
                <input type="email" class="form-control" id="Mail_Client" name="Mail_Client" required>
            </div>

            <div class="form-group">
                <label for="PASSWORD">Mot de passe</label>
                <input type="password" class="form-control" id="PASSWORD" name="PASSWORD" required>
            </div>

            <div class="form-group">
                <label for="password_confirm">Confirmez le mot de passe</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
            </div>

            <div class="form-group">
                <label for="Id_Type_Client">Type de client</label>
                <select class="form-control" id="Id_Type_Client" name="Id_Type_Client" required>
                    <option value="particulier">Particulier</option>
                    <option value="professionnel">Professionnel</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">S'inscrire</button>
            <a href="./authenticate.php" class="btn btn-secondary">Déja inscrit?<br>Connectez-vous</a>
        </form>
    </div>

    <footer>
        <?php include('../includes/footer.php'); ?>
        <!-- Le contenu du pied de page (liens, copyright, etc.) sera chargé à partir du fichier footer.php -->
    </footer>
</body>

</html>