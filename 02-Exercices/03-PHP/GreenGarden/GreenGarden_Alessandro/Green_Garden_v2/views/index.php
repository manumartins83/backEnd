<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
  echo "L'utilisateur est connecté.";
} else {
  echo "L'utilisateur n'est pas connecté.";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Green Garden - Accueil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Nabla&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/styles.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <header>

    <?php include('../includes/header.php');
    include_once 'cart_functions.php';
    include 'config.php';
    ?>
    <!-- Le contenu de l'en-tête (menu, logo, etc.) sera chargé à partir du fichier header.php -->
    <style>
      h2 {
        font-family: 'Hachi Maru Pop', cursive;
        font-size: 2rem;
        color: #2c3e50;
      }

      .card {
        width: 18rem;
        margin: 1rem;
        display: inline-block;
        border-bottom: 1px solid #ccc;
      }

      .card:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        transform: translateY(-20px);
        transition: 0.5s;
      }

      .catalogue>a {
        text-align: center;
        text-decoration: none;
      }

      .catalogue>a>:hover {
        transform: translateY(-10px);
        transition: 0.5s;
      }

      h2 {
        text-align: center;
        margin-top: 2rem;
      }

      .btn-primary {
        background-color: #2c3e50;
        border-color: #2c3e50;
        justify-content: center;
      }

      .btn-primary:hover {
        background-color: #2c3e;
        border-color: #2c3e50;
      }

      .jumbotron1 {
        width: 85%;
        margin: auto;
        margin-top: 2rem;
      }

      .jumbotron2 {
        width: 70%;
        margin: auto;
        margin-top: 2rem;
      }

      .jumbotron,
      .jumbotron1,
      .jumbotron2>a {
        border-radius: 80px;
      }

      #submit {
        display: none;
        background: #000;
        width: 90px;
        height: 30px;
        margin: auto;
        margin-top: 30px;
        -webkit-clip-path: polygon(0% 20%, 60% 20%, 60% 0%, 100% 50%, 60% 100%, 60% 80%, 0% 80%);
        clip-path: polygon(0% 20%, 60% 20%, 60% 0%, 100% 50%, 60% 100%, 60% 80%, 0% 80%);
      }

      #submit:hover {
        background-color: #2c3e;
        border-color: #2c3e50;
        transform: translateY(-10px);
        transition: 0.5s;
      }

      input[type='radio'] {
        transform: scale(1.5);
        margin: 10px;
        background-color: #2c3e50;
        margin-top: 30px;
      }

      label {
        font-size: 16px;
        color: #666;
      }


      #question {
        color: blue;
        font-size: 20px;
        padding: 10px;
      }
    </style>
  </header>
  <div class="catalogue mt-5">
    <a href='catalogue.php'>
      <h2>Catalogue</h2>
      <button><a href = 'formCommandes.php'><button type="button" class="btn btn-primary">commandes</button>
      <button><a href = 'commerciaux.php'><button type="button" class="btn btn-primary">Commerciaux</button>
      <button><a href = 'technicienSAV.php'><button type="button" class="btn btn-primary">TechnicienSAV</button>
      <button><a href = 'clients.php'><button type="button" class="btn btn-primary">Client</button>
    </a>
  </div>
  <main class="container flex-grow-1">
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://static.vecteezy.com/ti/vecteur-libre/p1/18969914-banniere-de-jardin-avec-des-lettres-de-typographie-ensemble-d-outils-de-jardin-de-printemps-illustrationle-vectoriel.jpg" alt="..." style="width: 1300px;">
        </div>
        <div class="carousel-item">
          <img src="https://cdn.oogarden.net/Shop/1/HomePageAdvertising/Banni%C3%A8re-19-18mai-FR.jpg" class="d-block w-100" style="width: 1300px" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://cdn.oogarden.net/Shop/1/HomePageAdvertising/Banni%C3%A8re-19-parasols-FR.jpg" class="d-block w-100" style="width: 1300px;" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
      <h2><i class="fas fa-leaf"></i> Catégories</h2>
    </div>

    <?php
    $stmt = $conn->query("SELECT * from t_d_categorie");
    while ($row = $stmt->fetch()) :
    ?>
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title"><?= $row['Libelle'] ?></h5>
          <a href="catalogue.php?categorie=<?= $row['Id_Categorie'] ?>" class="btn btn-primary">Voir les produits</a>
        </div>
      </div>
    <?php endwhile; ?>

  </main>




  <div class="container mt-5 text-center">
    <hr>
    <div class="jumbotron" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://cdn.shopify.com/s/files/1/0595/5531/5848/collections/Banniere_Jours_Willemse_f1e302bc-54f9-49ef-bd17-8fb1a426262c.jpg?v=1683019083'); background-size: cover;">
      <hr class="my-4">
      <div class="text-center">
        <img src="https://cdn.oogarden.net/Category/558/Banniere_17_tondeuse_FR-02.jpg" alt="Votre image" class="img-fluid" style="max-width: 80%; border-radius: 15px;">
      </div>
      <p style="color: white; font-size: 1.5em;">Profitez de nos offres exceptionnelles et de nos conseils pour créer le jardin de vos rêves.</p>
      <a class="btn btn-primary btn-sm" href="#" role="button" style="padding: 10px 20px; font-size: 1.2em;">En savoir plus</a>
    </div>
  </div>


  <div class="container mt-5 text-center">
    <hr>
    <div class="jumbotron1" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://www.paysagiste-foix.fr/sx-content/uploads/diaporamas/image-banniere02.jpg'); background-size: cover;">
      <hr class="my-4">
      <div class="text-center">
        <img src="https://www.jardinpromo.com/modules/angarslider/views/img/images/3ec27177f8a714db2ccb58f73170f1ed696cb990_71a9b3cb8be95c331f52578f1685dd0cec16ad94_banniere-yardforce.jpg" alt="Votre image" class="img-fluid" style="max-width: 80%; border-radius: 15px;">
      </div>
      <p style="color: white; font-size: 1.5em;">Profitez de nos offres exceptionnelles et de nos conseils pour créer le jardin de vos rêves.</p>
      <a class="btn btn-primary btn-sm" href="#" role="button" style="padding: 10px 20px; font-size: 1.2em;">En savoir plus</a>
    </div>
  </div>

  <div class="container mt-5 text-center">
    <div class="jumbotron2">
      <hr class="my-4">
      <div class="text-center">
        <img src="https://img.freepik.com/vecteurs-premium/banniere-horizontale-mains-personnes-resolvant-enigmes-jouant-jeu-intellectuel-repondant-questions-quiz-intelligentes-test-intelligence-intellect-illustration-vectorielle-coloree-dans-style-art-ligne_198278-11836.jpg?w=2000" alt="Votre image" class="img-fluid" style="max-width: 80%;">
      </div>
      <div id="quiz_container">
        <h2 id="question"></h2>
        <form id="quiz_form">
          <!-- Les réponses seront générées ici -->
        </form>
        <button class="btn btn-primary btn-sm" id="startQuizButton">Démarrer le Quiz</button>
        <button class="btn btn-primary btn-sm" role="button" id="submit"></button>
      </div>
    </div>
  </div>


  <footer>
    <?php include('../includes/footer.php'); ?>
    <!-- Le contenu du pied de page (liens, copyright, etc.) sera chargé à partir du fichier footer.php -->
    <script src="../js/quiz.js"></script>
  </footer>
</body>

</html>