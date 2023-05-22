<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>

        <h1 class="styleTitre">Village Green Garden</h1>

        <div class="styleMenu">

            <div class="styleMenuLeft">
                <div>
                    <a href="index.php"><img class="styleLogo" src="img/gg.jpg" alt="Logo_Green_Garden"></a>
                </div>

                <div>
                    <form method="post" action="">
                        <!-- <label class="styleLabelSearch" for="search_term"><strong>Rechercher un produit :</strong></label> -->
                        <input id="search_term" class="styleSearch" type="text" name="search_term">
                        <input class="styleBtnSearch" type="submit" name="search" value="Rechercher">
                    </form>
                </div>
            </div>



            <div class="styleMenuRight">

                <?php
                // Démarrage de la session
                session_start();

                if (isset($_SESSION['user_id'])) :
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
                    $use = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>

                    <p><a href="deconnexion.php">Se déconnecter</a></p>
                <?php else : ?>
                    <p><a href="login.php">Se connecter</a> ou <a href="inscription.php">s'inscrire</a></p>
                <?php endif; ?>



                <!-- <div>
                    <a href="login.php"><img class="styleLogin" src="img/login.png" alt="Login"></a>
                </div>

                <div>
                    <a href="inscription.php"><img class="styleInscription" src="img/inscription.png" alt="Inscription"></a>
                </div> -->

                <div>
                    <a href="panier.php"><img class="stylePanier" src="img/panier.png" alt="Panier"></a>
                </div>
            </div>

        </div>

    </header>