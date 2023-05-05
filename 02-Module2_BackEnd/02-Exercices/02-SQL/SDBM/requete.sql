-- Liste des bières avec type de bière, la marque, la couleur ordonnée par continent et pays
SELECT a.nom_article, t.nom_type, m.nom_marque, c.nom_couleur, p.nom_pays, co.nom_continent
FROM typebiere AS t JOIN article AS a ON t.ID_TYPE=a.id_type
JOIN couleur AS c ON a.id_couleur=c.ID_COULEUR
JOIN marque AS m ON m.ID_MARQUE=a.id_marque
JOIN pays AS p ON p.ID_PAYS=m.ID_PAYS
JOIN continent AS co ON co.ID_CONTINENT=p.ID_CONTINENT
GROUP BY co.id_continent;


-- Nombre de bières par fabricant
SELECT nom_fabricant, count(ID_ARTICLE) AS nb_biere
FROM fabricant AS f 
JOIN marque AS m ON m.ID_FABRICANT=f.ID_FABRICANT
JOIN article AS a ON m.ID_MARQUE=a.ID_MARQUE
GROUP BY f.ID_FABRICANT;


-- Pour chaque pays, établir la moyenne de bières à partir du type
SELECT a.nom_article, AVG(a.ID_ARTICLE) AS moy_biere, t.nom_type, p.nom_pays
FROM typebiere AS t 
JOIN article AS a ON t.ID_TYPE=a.id_type
JOIN marque AS m ON m.ID_MARQUE=a.id_marque
JOIN pays AS p ON p.ID_PAYS=m.ID_PAYS
GROUP BY p.ID_PAYS;


-- Pour un ticket: j'aimerais le détail de chaque ligne à savoir le nom de l'article, la quantité, 
-- le prix unitaire et le total par ligne ordonnée par année
SELECT t.NUMERO_TICKET, a.nom_article, v.QUANTITE, v.PRIX_VENTE, SUM(v.QUANTITE*v.PRIX_VENTE) AS total, t.ANNEE  
FROM ticket AS t 
JOIN vendre AS v ON t.NUMERO_TICKET=v.NUMERO_TICKET
JOIN article AS a ON a.ID_ARTICLE=v.ID_ARTICLE
WHERE t.numero_ticket=1 GROUP BY a.ID_ARTICLE, t.ANNEE ORDER BY t.ANNEE ASC;


-- Le montant global moyen pour un ticket par année
SELECT t.NUMERO_TICKET, AVG(v.QUANTITE*v.PRIX_VENTE) AS moy_total, t.ANNEE  
FROM ticket AS t 
JOIN vendre AS v ON t.NUMERO_TICKET=v.NUMERO_TICKET
JOIN article AS a ON a.ID_ARTICLE=v.ID_ARTICLE
WHERE t.numero_ticket=1 GROUP BY t.NUMERO_TICKET, t.ANNEE ORDER BY t.ANNEE ASC;