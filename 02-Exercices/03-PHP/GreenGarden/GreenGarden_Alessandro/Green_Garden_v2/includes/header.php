<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nabla&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link href="https://fonts.googleapis.com/css2?family=Moo+Lah+Lah&display=swap" rel="stylesheet">
</head>

<body>

  <?php include_once 'cart_functions.php';
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <div class="d-flex">
        <a class="nav-link me-3" href="./index.php"><i class="fas fa-home"></i></a>
        <form class="d-flex me-3" action="search.php" method="get">
          <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Recherche" name="query">
        </form>
      </div>
      <div class="w-100 d-none d-lg-block"></div>
      <a class="navbar-brand position-absolute start-50 translate-middle-x d-none d-lg-inline" href="#"><img src="../medias/gg.jpg" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="panier.php"><i class="fas fa-shopping-cart"></i> (<?php echo getCartCount(); ?>)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-globe"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../views/authenticate.php"><i class="fas fa-sign-in-alt"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../views/logout.php">Déconnexon</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>

</html>