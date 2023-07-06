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
  //FUNCTIONS
  //1 Ecrivez la fonction calculator() traitant les opérations d'addition, de soustraction, de multiplication et de division.

  function calculator($a, $b, $operateur)
  {
    switch ($operateur) {
      case "+":
        return $a + $b;
        break;
      case "-":
        return $a - $b;
        break;
      case "*":
        return $a * $b;
        break;
      case "/":
        return $a / $b;
        break;
      default:
        return "L'opérateur n'est pas valide";
    }
  }

  $result = calculator(5, 5, "/");
  echo "Le resultat est " . $result;
  ?>
</body>

</html>