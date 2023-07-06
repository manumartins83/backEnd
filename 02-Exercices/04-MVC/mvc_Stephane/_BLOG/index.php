<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <title>Le blog culinaire</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="img/logo_140-98.jpg" alt="logo">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
          <div class="col-10 col-sm-8 col-lg-6">
            <img src="img/pizza.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
          </div>
          <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">Comment réussir une vraie pizza italienne</h1>
            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam ipsa eos debitis laudantium nisi soluta adipisci natus impedit voluptate voluptatibus necessitatibus maiores itaque quae architecto, repudiandae omnis laboriosam quasi nesciunt?</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
              <button type="button" class="btn btn-light btn-lg px-4 me-md-2">Consulter la recette</button>            </div>
          </div>
        </div>
      </div>
      <div class="container col-xxl-8 px-4 py-5">
          <h1 class="display-5 fw-bold text-center line"><span>Les recettes de saison... </span></h1>
          <div class="row">
            <?php                         
             define("DBHOST", "localhost");
             define("DBUSER", "root");
             define("DBPASS", "");
             define("DBNAME", "bdd_blog_culinaire");
            
            $dsn = 'mysql:host='.DBHOST.';dbname='.DBNAME;

             try {
                 $db = new PDO($dsn, DBUSER, DBPASS);
                 $db->exec("SET NAMES utf8");
                 $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
             } catch (PDOException $e) {
                 die("Erreur ! : " . $e->getMessage()) ;
             }

             $threeLastRecipesQuery = "SELECT rec_resume, rec_miniature FROM t_recipe ORDER BY rec_id DESC LIMIT 3";

             $threeLastQuery = $db->query($threeLastRecipesQuery);
             $recipes = $threeLastQuery->fetchAll();
             
             foreach ($recipes as $recipe): ?>
                <div class="col-12 col-md-6 col-xl-4 my-3">
                <div class="card mx-auto" style="width: 18rem;">
                  <img src="img/<?=  $recipe['rec_miniature'];?>" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text"><?=  $recipe['rec_resume'];?></p>
                  </div>
                </div>
              </div>
             <?php endforeach; ?>
          </div>
      </div>
      <div class="container col-xxl-8 px-4 py-5">
          <h1 class="display-5 fw-bold text-center line"><span>Les derniers commentaires... </span></h1>
      
          <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php
                $threeLastCommentsQuery = "SELECT com_auteur, com_contenu, rec_nom FROM t_comment LEFT JOIN t_recipe ON rec_id = id_rec ORDER BY com_id DESC LIMIT 3";
                $threeLastComQuery = $db->query($threeLastCommentsQuery);
                $count = $threeLastComQuery->rowCount();
                $comments = $threeLastComQuery->fetchAll();
                $flag = 1;
                foreach ($comments as $comment):
                if($flag === 1){
                  echo '<div class="carousel-item active">';
                } else{
                  echo '<div class="carousel-item">';
                }?>                
                  <div class="carousel-caption d-md-block">
                    <h5 class="text-dark"><?= $comment["com_contenu"];?></h5>
                    <p class="text-dark"><?= $comment["com_auteur"];?></p>
                    <p class="text-recipe-carousel fst-italic">Recette : <?= $comment["rec_nom"];?></p>
                  </div>
                </div>
               <?php 
                $flag += 1;
              endforeach;?>
            </div>
           </div> <!-- fin de carousel -->
        </div>
          <!-- Footer-->
    <footer class="border-top py-5">
      <div class="container text-center pt-3 pt-lg-4">
        <h3 class="fw-light">Abonnez-vous à ma newsletter</h3>
        <h2 class="pb-4">Pour les passionnés de cuisine et de gastronomie</h2><a class="btn btn-primary btn-lg" href="#" target="_blank" rel="noopener"><i class="ci-cart me-2"></i>Je m'abonne</a>
        <hr class="my-5">
        <div class="fs-ms text-muted text-center">© All rights reserved. Made by <a class="text-muted" href="#" target="_blank" rel="noopener">Ego Studio</a></div>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>