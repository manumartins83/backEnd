use greengarden;
DROP TABLE IF EXISTS t_d_user;


CREATE TABLE IF NOT EXISTS t_d_user (Id_User int(11) NOT NULL AUTO_INCREMENT,
 Id_UserType int(11) NOT NULL,
Login varchar(255) NOT NULL,
Password varchar(255) NOT NULL,
PRIMARY KEY (Id_User), KEY t_d_user_ibfk_1 (Id_UserType)) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT
CHARSET=utf8mb4;

--
-- Structure de la table t_d_usertype
--

DROP TABLE IF EXISTS t_d_usertype;


CREATE TABLE IF NOT EXISTS t_d_usertype (Id_UserType int(11) NOT NULL AUTO_INCREMENT,
Libelle varchar(50) NOT NULL,
PRIMARY KEY (Id_UserType)) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT
CHARSET=utf8mb4;

--
-- Déchargement des données de la table t_d_usertype
--

INSERT INTO t_d_usertype (Id_UserType, Libelle)
VALUES (1,
        'Client'), (2,
                    'Admin'), (3,
                               'Commercial');


     

ALTER TABLE t_d_user ADD CONSTRAINT t_d_user_ibfk_1
FOREIGN KEY (Id_UserType) REFERENCES t_d_usertype (Id_UserType);



















use greengarden;


drop table if exists t_d_user ;
drop table if exists t_d_usertype ;


create table t_d_usertype(Id_UserType int(11) not null, Libelle varchar(50)not null);


insert into t_d_usertype(Id_UserType,Libelle)
values (1,
        'Client'), (2,
                    'Admin'), (3,
                               'Commercial');


create table t_d_user(Id_User int(11) not null, Id_UserType int(11) not null, Login varchar(255) not null, Password varchar(255) not null);


ALTER TABLE `t_d_user` ADD PRIMARY KEY (`Id_User`);


ALTER TABLE `t_d_user` MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT,
                                                         AUTO_INCREMENT=6;


ALTER TABLE `t_d_user` ADD CONSTRAINT `t_d_user_ibfk_1`
FOREIGN KEY (`Id_UserType`) REFERENCES `t_d_usertype` (`Id_UserType`);

-- Créer 6 utilisateurs via l'interface de votre site web (formulaire inscription.php)(bien noter leur mots de passe) -
-- Puis via une requete sql update modifier leur usertype
--ex :
-- 1 : Login:TATA pwd:TATA (sera admin)
-- 2 : Login:TETE pwd:TETE (sera un commercial)
-- 3 : Login:TITI pwd:TITI (sera un autre commercial)
-- 4 : Login:TOTO pwd:TOTO (sera un client)
-- 5 : Login:TUTU pwd:TUTU (sera un client)
-- 6 : Login:TYTY pwd:TYTY (sera un client)

alter TABLE t_d_client add COLUMN Id_User int(11);


update t_d_client
set Id_User=9
where Id_Client=2;


update t_d_client
set Id_User=10
where Id_Client=3;


update t_d_client
set Id_User=11
where Id_Client=4;


ALTER TABLE `t_d_client` ADD CONSTRAINT `t_d_client_ibfk_user`
FOREIGN KEY (`Id_User`) REFERENCES `t_d_user` (`Id_User`);