<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="returnForm" action="handle_return.php" method="post">
        <div class="form-group">
            <label for="search">Rechercher :</label>
            <input type="text" id="search" name="search" required>
        </div>

        <div class="form-group">
            <label for="reason">Motif :</label>
            <select id="reason" name="reason" required>
            <option value="">Choisir...</option>
            <option value="return">Retour de produit</option>
            <option value="npai">NPAI</option>
            </select>
        </div>

        <input type="submit" value="Submit">
    </form>


</body>
</html>
