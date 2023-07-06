# Créez un fichier index.php qui sera la page principale du site web. Vous pouvez y inclure la navigation vers les différentes sections du site, telles que la gestion des commandes, des produits et des clients

<http://localhost:3000/BackEnd/GreenGarden/index.php#>

docker-compose up -d

mysql -u root -pmy-secret-pw

Créez un dossier modules pour regrouper les différentes fonctionnalités du site.

Dans le dossier modules, créez un dossier orders pour le module de gestion des commandes. Ajoutez-y les fichiers suivants :

- orders.php : pour gérer la liste des commandes et leurs statuts.
- add_order.php : pour créer de nouvelles commandes.
- edit_order.php : pour modifier ou annuler les commandes.
- view_order.php : pour afficher les détails d'une commande.
Créez un dossier products dans le dossier modules pour le module de gestion des produits. Ajoutez-y les fichiers suivants :
- products.php : pour gérer la liste des produits et leurs informations.
- add_product.php : pour ajouter de nouveaux produits.
- edit_product.php : pour modifier les produits existants.
- delete_product.php : pour supprimer les produits.
Créez un dossier clients dans le dossier modules pour le module de gestion des clients. Ajoutez-y les fichiers suivants :
- clients.php : pour gérer la liste des clients et leurs informations.
- add_client.php : pour ajouter de nouveaux clients.
- view_client.php : pour consulter la fiche d'un client spécifique.

- edit_client.php : pour modifier les informations des clients existants.
- delete_client.php : pour supprimer les clients.
- clients_by_sales_rep.php : pour afficher la liste des clients d'un commercial.
Utilisez une base de données pour stocker les informations des commandes, des produits et des clients. Vous devrez créer des tables pour chacun de ces éléments et établir des relations entre elles.

Pour chaque fichier mentionné ci-dessus, vous devrez écrire le code PHP nécessaire pour interagir avec la base de données et effectuer les opérations appropriées (ajout, modification, suppression, consultation).

Assurez-vous d'appliquer des pratiques de développement sécurisées, telles que la validation des entrées utilisateur, la protection contre les injections SQL et le hachage des mots de passe.

Ajoutez des fichiers CSS et JavaScript pour améliorer l'apparence et la convivialité du site.

Testez et déboguez votre application pour vous assurer qu'elle fonctionne correctement et qu'elle répond aux exigences du projet.
