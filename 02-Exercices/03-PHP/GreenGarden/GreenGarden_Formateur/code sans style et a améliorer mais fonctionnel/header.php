
        <nav>
            <ul>
                <li><a href="catalogue.php">Catalogue</a></li>
                <li><a href="panier.php">Panier</a></li>
                <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'gestion') : ?>
                    <li><a href="ajout_produit.php">Ajouter un produit</a></li>
                <?php endif; ?>
                <?php if(isset($_SESSION['user_id'])) : ?>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                <?php else : ?>
                    <li><a href="login.php">Connexion</a></li>
                    <li><a href="inscription.php">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
