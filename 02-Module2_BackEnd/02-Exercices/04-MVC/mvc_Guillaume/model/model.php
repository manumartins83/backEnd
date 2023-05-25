<?php
abstract class Model
{
    private $bdd;

    public function getBillets()
    {
        // accès aux données
        $bdd = $this->getBdd();
        $billets = $bdd->query('SELECT BIL_ID as id, BIL_DATE as date, BIL_TITRE as titre, BIL_CONTENU as contenu FROM T_BILLET order by BIL_ID desc');
        return $billets;
    }

    private function getBdd()
    {
        if ($this->bdd == null) {

            // Récupération des informations de l'utilisateur connecté
            $host = "localhost"; // Nom d'hôte de la base de données
            $user = "root"; // Nom d'utilisateur de la base de données
            $password_db = ""; // Mot de passe de la base de données
            $dbname = "blog"; // Nom de la base de données

            // accès aux données
            $this->bdd = new PDO("mysql:host=$host;dbname=$dbname; charset=utf8", $user, $password_db, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return $this->bdd;
    }

    // récupère un billet avec son id
    public function getBillet($idBillet)
    {
        $bdd = $this->getBdd();
        $billet = $bdd->prepare('SELECT BIL_ID as id, BIL_DATE as date, BIL_TITRE as titre, BIL_CONTENU as contenu FROM T_BILLET WHERE BIL_ID = ?');
        $billet->execute(array($idBillet));

        if ($billet->rowCount() == 1) {
            return $billet->fetch();
        } else {
            throw new Exception("Aucun billet ne correspond à cet identifiant");
        }
    }

    //     public function getComments($idBillet)
    //     {
    //         $bdd = $this->getBdd();
    //         $comments = $bdd->prepare('SELECT COM_ID as id, COM_DATE as date, COM_AUTEUR
    // as auteur, COM_CONTENU as contenu FROM T_COMMENTAIRE WHERE BIL_ID =?');
    //         $comments->execute(array($idBillet));
    //         return $comments;
    //     }

    protected function executerRequete($sql, $params = null)
    {
        if ($params == null) {
            $resultat = $this->getBdd()->query($sql); // exécution directe
        } else {
            $resultat = $this->getBdd()->prepare($sql); // requête préparée
            $resultat->execute($params);
        }
        return $resultat;
    }
}
