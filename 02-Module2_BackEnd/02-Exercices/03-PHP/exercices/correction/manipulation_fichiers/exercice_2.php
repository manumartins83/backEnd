<!DOCTYPE html>
<html>

<head>
  <title>Liste des nouveaux utilisateurs</title>
  <!-- Ajoutez les fichiers CSS de Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <h1>Liste des nouveaux utilisateurs</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>customerID</th>
          <th>companyName</th>
          <th>contactName</th>
          <th>contactTitle</th>
          <th>address</th>
          <th>city</th>
          <th>region</th>
          <th>postalCode</th>
          <th>country</th>
          <th>phone</th>
          <th>fax</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Lire le fichier et stocker son contenu dans un tableau
        $lignes = file('customers.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Parcourir le tableau ligne par ligne
        foreach ($lignes as $ligne) {
          // Découper chaque ligne en un tableau de champs
          $champs = explode(',', $ligne);

          // Afficher les champs dans un tableau HTML
          echo '<tr>';
          foreach ($champs as $champ) {
            echo '<td>' . $champ . '</td>';
          }
          echo '</tr>';
        }

        /**Utilisez la fonction file() pour lire le fichier customers.csv et stocker son contenu dans un tableau.
        Parcourez le tableau ligne par ligne en utilisant une boucle foreach.
        Pour chaque ligne, utilisez la fonction explode() pour découper la ligne en un tableau de champs, en utilisant la virgule , comme séparateur.
        Créez un tableau HTML avec Bootstrap et affichez les données extraites du fichier CSV.
         */
        ?>
      </tbody>
    </table>
  </div>
  <!-- Ajoutez les fichiers JavaScript de Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>