-- script SQL requetes

-- 2.1.3
SELECT nom_societe, SUM(qte_prod*pu_HT_prod) AS prixHT 
FROM produit 
GROUP BY nom_societe;


-- 2.1.4

SELECT p.nom_societe, p.ref_prod, p.nom_prod, p.qte_prod, cde.date_cde 
FROM produit AS p 
JOIN contenir AS c ON p.ref_prod=c.FK_ref_prod 
JOIN commande AS cde ON cde.num_cde=c.FK_num_cde 
ORDER BY cde.date_cde ASC;


-- 2.1.5

SELECT cl.ref_cli, cl.nom_cli, cde.etat_cde, cde.date_cde 
FROM produit AS p 
JOIN contenir AS c ON p.ref_prod=c.FK_ref_prod 
JOIN commande AS cde ON cde.num_cde=c.FK_num_cde 
JOIN passer AS pa ON pa.FK_num_cde=cde.num_cde
JOIN client AS cl ON cl.ref_cli=pa.FK_ref_cli
GROUP BY cl.nom_cli;


-- 2.1.6

SELECT cl.ref_cli, cl.nom_cli, SUM(p.qte_prod*p.pu_HT_prod) AS prixHT 
FROM produit AS p 
JOIN contenir AS c ON p.ref_prod=c.FK_ref_prod 
JOIN commande AS cde ON cde.num_cde=c.FK_num_cde 
JOIN passer AS pa ON pa.FK_num_cde=cde.num_cde
JOIN client AS cl ON cl.ref_cli=pa.FK_ref_cli
GROUP BY cl.nom_cli;


-- 2.1.7

SELECT  cl.ref_cli, cl.nom_cli, cde.num_cde, cde.etat_cde SUM
FROM commande AS cde
JOIN passer AS pa ON pa.FK_num_cde=cde.num_cde
JOIN client AS cl ON cl.ref_cli=pa.FK_ref_cli
WHERE cde.etat_cde='expédiée';