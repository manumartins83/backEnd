# Arborescence du site Green Garden

Debeug:
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

docker-compose up -d

mysql -u root -pmy-secret-pw

greengarden/
│
├── css/
│   └── styles.css
│
├── models/
│   ├── product.php
│   └── user.php
│
├── views/
│   ├
│   ├── catalogue.php
│   ├── consult_produit.php
│   ├── panier.php
│   ├── inscription.php
│   ├── login.php
│   └── validation_panier.php
│
├── controllers/
│   ├── productController.php
│   └── userController.php
│
├── includes/
│   ├── header.php
│   └── footer.php
│
└── index.php

Construire le squelette du site e-commerce Green Garden utiliser css ou bootstrap

- Index.php: la page d'acceuil avec un menu allant vers les pages catalogue, Ajouter/modifier un produit, Ajouter/modifier un utilisateur,
        et Voir mon panier
    Une zone avec des boutons Login et Inscription
    Une zone avec "Bonjour xxxx" où xxxx est le login de l'utilisateur si celui-ci est authentifié

- Catalogue.php: renvoit tous les produits ou via une zone de recherche sur le nom du produit un ou plusieurs produits
- Consult_produit.php: permet de voir le détail d'un produit en particulier
- Panier.php: permettant de voir ce qui a été mis dans le panier
- Inscription.php: formulaire d'inscription permettant d'inscrire un client en plus d'un utilisateur avec les informations basiques:
        *Login
        * Email
        *Mot de passe (avoir une partie ressaisie du mot de passe pour vérification)
        * Type de client (Particulier/professionnel)
- Login.php: formulaire d'authentification
- validation_panier.php: lors de la validation du panier (passage obligatoire via panier.php),
        saisie des informations du client (adresse livraison, adresse facturation, type de paiement, type de livraison)

## PseudoCode du jeux Quiz

Initialiser le score à zéro
Initialiser un tableau avec toutes les questions et les réponses correctes

Pour chaque question dans le tableau
    Afficher la question en bas de la page
    Attendre que l'utilisateur réponde à la question
    Comparer la réponse de l'utilisateur avec la réponse correcte
    Si la réponse est correcte
        Ajouter un au score
        Afficher un message de succès
    Sinon
        Afficher un message d'échec

Après que l'utilisateur a répondu à toutes les questions
    Afficher le score total de l'utilisateur

### Explication du code

Données du quiz : L'objet quiz est un tableau qui contient les données du quiz, y compris les questions, les réponses possibles et les réponses correctes.

Variables de suivi : score et currentQuestionIndex sont des variables utilisées pour suivre le score actuel de l'utilisateur et l'index de la question actuelle dans le tableau quiz.

Sélection des éléments DOM : Ces lignes de code utilisent la méthode document.getElementById pour sélectionner différents éléments sur la page web par leur ID. Ces éléments seront manipulés plus tard dans le script.

Fonction loadQuestion : Cette fonction prend un index de question et charge la question et les réponses correspondantes dans le DOM. Elle crée des éléments input de type radio et des éléments label pour chaque réponse, les ajoute au DOM, et fixe le texte de la question.

Fonction checkAnswer : Cette fonction vérifie si la réponse de l'utilisateur est correcte. Si la réponse est correcte, elle augmente le score et affiche un message "Correct!". Sinon, elle affiche un message d'erreur.

Fonction startQuiz : Cette fonction est appelée lorsque l'utilisateur clique sur le bouton "Démarrer le Quiz". Elle masque le bouton "Démarrer le Quiz", affiche le bouton "Soumettre", et charge la première question. Elle ajoute également un écouteur d'événements au bouton "Soumettre" qui vérifie la réponse de l'utilisateur, passe à la question suivante, ou termine le quiz et affiche le score final.

Donc, en résumé, ce script utilise les concepts de manipulation du DOM et d'écoute d'événements pour créer un quiz interactif sur une page web.

### Explication de l'algorithme

logique de l'algorithme en étapes.

Initialisation : L'algorithme commence par définir un certain nombre de variables globales. Il s'agit du tableau quiz qui contient les questions, les réponses possibles et la réponse correcte pour chaque question. Deux autres variables, score et currentQuestionIndex, sont utilisées pour suivre le score actuel de l'utilisateur et la question en cours.

Sélection des éléments du DOM : Ensuite, l'algorithme sélectionne un certain nombre d'éléments du DOM dont il aura besoin pour manipuler l'interface utilisateur du quiz. Ces éléments comprennent le bouton pour démarrer le quiz, l'endroit où la question est affichée, l'endroit où les réponses sont affichées, et le bouton pour soumettre une réponse.

Chargement des questions : La fonction loadQuestion est utilisée pour afficher une question et ses réponses possibles à l'utilisateur. Elle commence par effacer toutes les réponses précédemment affichées, puis elle récupère la question actuelle du tableau quiz et l'affiche. Ensuite, pour chaque réponse possible à la question, elle crée un nouvel élément radio input et un élément label correspondant, et les ajoute à l'interface utilisateur.

Vérification des réponses : La fonction checkAnswer est utilisée pour vérifier si la réponse de l'utilisateur à une question est correcte. Elle compare la réponse choisie par l'utilisateur avec la réponse correcte stockée dans le tableau quiz. Si la réponse est correcte, elle augmente le score de l'utilisateur et affiche un message indiquant que la réponse est correcte. Si la réponse est incorrecte, elle affiche simplement un message indiquant que la réponse est incorrecte.

Démarrage du quiz : Lorsque l'utilisateur clique sur le bouton pour démarrer le quiz, la fonction startQuiz est appelée. Cette fonction masque le bouton de démarrage, affiche le bouton de soumission, et appelle loadQuestion pour afficher la première question. Elle ajoute également un écouteur d'événements au bouton de soumission qui sera déclenché chaque fois que l'utilisateur soumet une réponse.

Progression à travers le quiz : À chaque fois que l'utilisateur soumet une réponse, l'écouteur d'événements du bouton de soumission est déclenché. Cela vérifie la réponse de l'utilisateur, efface la réponse choisie pour la prochaine question, puis soit charge la question suivante, soit termine le quiz si toutes les questions ont été posées.

Fin du quiz : Lorsque toutes les questions ont été posées, l'algorithme affiche le score final de l'utilisateur, cache le quiz, affiche à nouveau le bouton de démarrage du quiz et réinitialise l'index de la question et le score pour le prochain démarrage du quiz.
