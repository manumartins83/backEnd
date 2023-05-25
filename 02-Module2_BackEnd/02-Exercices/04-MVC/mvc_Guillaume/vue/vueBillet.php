<?php $this->titre = 'Mon Blog - ' . $billet['titre']; ?>

<?php ob_start(); ?>

<article>
    <header>
        <h1 class="titreBillet"><?php echo $billet['titre'] ?></h1>
        <time><?php echo $billet['date'] ?></time>
    </header>
    <p><?php echo $billet['contenu'] ?></p>
</article>
<hr>

<header>
    <h1 id="titreReponses">Réponses à <?php echo $billet['titre'] ?></h1>
</header>

<?php foreach ($commentaires as $commentaire) : ?>
    <p><?php echo $commentaire['auteur'] ?> dit :</p>
    <p><?php echo $commentaire['contenu'] ?></p>
<?php endforeach; ?>

<?php $contenu = ob_get_clean(); ?>

<?php echo $contenu; ?>

<form method="post" action="index.php?action=billet&add=commenter">
    <input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4" placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
    <input type="submit" value="Commenter" />
</form>