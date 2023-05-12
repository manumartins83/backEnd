<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  echo "Hello World";

  $clientIP = $_SERVER['REMOTE_ADDR']; // Adresse IP du client
  $serverIP = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : 'Non défini'; // Adresse IP du serveur XAMPP en tant qu'environnement de développement local. Lorsque vous travaillez en local, certaines variables de $_SERVER peuvent ne pas être définies, comme $_SERVER['SERVER_ADDR']
  //Dans cet exemple, nous utilisons l'opérateur ternaire pour vérifier si $_SERVER['SERVER_ADDR'] est défini. Si c'est le cas, la valeur de $serverIP sera l'adresse IP du serveur. Sinon, la valeur sera 'Non défini'.
  echo "<br/>"; // Saut de ligne en HTML
  echo "Adresse IP du client: " . $clientIP;
  echo "<br/>";
  echo "Adresse IP du serveur: " . $serverIP;

  echo "<hr>"; // Ligne horizontale en HTML

  ?>