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


-- Pour un ticket: j'aimerais le détail de chaque ligne à savoir le nom de l'article, la quantité, 
-- le prix unitaire et le total par ligne ordonnée par année


-- Le montant global moyen pour un ticket par année
