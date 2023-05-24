<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Blog</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div id="global">

        <header>
            <a href="index.php">
                <h1 id="titreBlog">Mon Blog</h1>
            </a>
            <p>Hello et bienvenue !!!!</p>
        </header>

        <div id="contenu">
            <?php echo $contenu; ?>
        </div>

        <footer id="piedBlog">
            Blog exercice
        </footer>
    </div>

</body>

</html>