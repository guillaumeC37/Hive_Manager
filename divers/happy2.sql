-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 27 Mai 2018 à 17:48
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `happy2`
--
CREATE DATABASE IF NOT EXISTS `happy2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `happy2`;

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `P_Add_Achat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Add_Achat`(IN `DateA` DATE, IN `Montant` FLOAT, IN `Mag` VARCHAR(255), IN `Des` VARCHAR(250), IN `Id_Api` INT(10))
    MODIFIES SQL DATA
INSERT INTO achat(DATE_ACHAT,MONTANT,MAGASIN,DESCRIPTION,ID_Apiculteur) VALUES(DateA,Montant,MAg,Des,Id_Api)$$

DROP PROCEDURE IF EXISTS `P_Add_Api`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Add_Api`(IN `Login` VARCHAR(50), IN `MDP` VARCHAR(32), IN `APE` VARCHAR(5), IN `API` VARCHAR(10), IN `SIRET` VARCHAR(20), IN `NUMAGRI` VARCHAR(30), IN `Nom` VARCHAR(150), IN `Prenom` VARCHAR(150), IN `Ville` VARCHAR(150), IN `NumRue` TINYINT, IN `nomRue` VARCHAR(200), IN `CP` INT, IN `TypeR` INT, IN `Mail` VARCHAR(200), IN `ID_Q` INT(10), IN `R_Q` VARCHAR(200))
    MODIFIES SQL DATA
    COMMENT 'Ajoute un apiculteur dans la base'
insert into apiculteur( Login,MDP,Code_APE,Code_API,SIRET,NUMAGRI,Nom_Api,Prenom_Api,Ad_Mail,Ville,Num_Rue,Nom_Rue,Code_Postal,Id_Type,ID_Question,Re_Question)
values(Login, MDP,APE,API,SIRET,NUMAGRI,Nom,Prenom,Mail,Ville,NumRue,NomRue,CP,TypeR,ID_Q,R_Q)$$

DROP PROCEDURE IF EXISTS `P_Add_Datalogger_Info`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Add_Datalogger_Info`(IN `ID_DTL` INT(11), IN `DateLog` DATE, IN `HeureLog` TIME, IN `LePoids` INT(10), IN `T_E` FLOAT, IN `T_I` FLOAT, IN `H_E` INT(10), IN `H_I` INT(10), IN `ID_R` INT(11), IN `ID_Api` INT(10))
    MODIFIES SQL DATA
INSERT INTO datalogger(ID_DataLogger,Date_Log,Heure_Log,Poids,TempExt,TempInt,HygroExt,HygroInt,ID_RUCHE,ID_Apiculteur) VALUES(ID_DTL,DateLog,HeureLog,LePoids,T_E,T_I,H_E,H_I,ID_R,ID_Api)$$

DROP PROCEDURE IF EXISTS `P_Add_Essaim`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Add_Essaim`(IN `Nom` VARCHAR(50), IN `Ruche` INT(11), IN `Apic` INT(10), IN `Espece` VARCHAR(60), IN `Origine` INT(11), IN `DateE` DATE, IN `Age` INT(11), IN `Or_R` VARCHAR(100), IN `Lieu` VARCHAR(100))
    MODIFIES SQL DATA
INSERT INTO essaim( NOM_ESSAIM,ID_RUCHE,ID_Apiculteur, ESPECE,ID_ORIGINE, DATE_CREATION,AGE_REINE,ORIGINE_REINE, LIEU_CAPTURE)
VALUES (Nom,Ruche,Apic,Espece,Origine,DateE,Age,Or_R,Lieu)$$

DROP PROCEDURE IF EXISTS `P_Add_Recolte`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Add_Recolte`(IN `LaRuche` INT(11), IN `LeMiel` INT(10), IN `LaDate` DATE, IN `LePoids` FLOAT)
    MODIFIES SQL DATA
INSERT INTO recolte (Id_Ruche,Id_Type_Miel,Date_R,Poids) VALUES(LaRuche,LeMiel,LaDate,LePoids)$$

DROP PROCEDURE IF EXISTS `P_Add_Ruche`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Add_Ruche`(IN `NomR` VARCHAR(60), IN `NumR` VARCHAR(30), IN `NbreC` INT(11), IN `TypeR` INT(11), IN `TypeH` INT(10), IN `NbreH` INT(11), IN `Etat` INT(11), IN `ID_Rucher` INT(11), IN `DateM` DATE, IN `Obs` LONGTEXT, IN `QRCode` VARCHAR(255))
    MODIFIES SQL DATA
    COMMENT 'Ajoute une ruche'
INSERT INTO ruche(Nom_Ruche,NUM_RUCHE,NBRE_CADRE,ID_TYPERUCHE,id_hausses,NBRE_HAUSSE,ID_ETAT,id_rucher,DATE_MES,OBSERV,QRCode) VALUES(NomR,NumR,NbreC,TypeR,TypeH,NbreH,Etat,id_Rucher,DateM,Obs,QRCode)$$

DROP PROCEDURE IF EXISTS `P_Add_Rucher`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Add_Rucher`(IN `ID_APIculteur` INT(10) UNSIGNED, IN `Actif` SMALLINT(6), IN `Nom` VARCHAR(100) CHARSET utf8, IN `loc` VARCHAR(100) CHARSET utf8, IN `Num` VARCHAR(15) CHARSET utf8, IN `Coord` VARCHAR(30) CHARSET utf8, IN `Obs` LONGTEXT CHARSET utf8)
    MODIFIES SQL DATA
    COMMENT 'Ajoute un rucher dans la table'
INSERT INTO rucher(ID_Apiculteur,isActif,Nom_Rucher,Localisation,Num_Rucher,Coordonnees_GPS,Observations)
values(ID_APIculteur,Actif,Nom,Loc,Num,Coord,Obs)$$

DROP PROCEDURE IF EXISTS `P_Add_Visite`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Add_Visite`(IN `DateV` DATE, IN `Clim` INT(11), IN `Popu` VARCHAR(255), IN `Hygro` INT(11), IN `Temp` FLOAT(11), IN `Poids` FLOAT, IN `Comport` VARCHAR(255), IN `Reine` INT(11), IN `Maladie` INT(11), IN `ID_M` INT(10), IN `Nourri` INT(11), IN `VNourri` VARCHAR(100), IN `Travaux` INT(11), IN `Notes` LONGTEXT, IN `IDRuche` INT(11))
    MODIFIES SQL DATA
INSERT INTO visite (Date_Visite,ID_TEMPS,POPULATION,HYGRO,TEMPERATURE,POIDS,COMPORT_ESSAIM,REINE_VISIBLE,Presence_Maladie,ID_Maladie,NOURISSAGE,TYPE_NOURRISSAGE,TRAVAUX,NOTES,ID_RUCHE)
VALUES (DateV,Clim,Popu,Hygro,Temp,Poids,Comport,Reine,Maladie,ID_M,Nourri,VNourri,Travaux,Notes,IDRuche)$$

DROP PROCEDURE IF EXISTS `P_Update_Api`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Update_Api`(IN `APE` VARCHAR(5), IN `sire` VARCHAR(20), IN `AdMail` VARCHAR(200), IN `LaVille` VARCHAR(150), IN `NumRue` TINYINT(4), IN `NomRue` VARCHAR(200), IN `CP` INT(11), IN `TypeVoie` INT(11), IN `ID_Q` INT(10), IN `Reponse` VARCHAR(200), IN `ID_Api` INT(10))
    MODIFIES SQL DATA
UPDATE apiculteur SET 
Code_APE=APE, 
SIRET=sire,
 Ad_Mail=AdMail,
 Ville=LaVille,
 Num_Rue=NumRue,
 Nom_Rue=NomRue,
 Code_Postal=CP,
 Id_Type=TypeVoie,
 Id_Question=ID_Q,
 Re_Question=Reponse
 WHERE ID_Apiculteur=ID_Api$$

DROP PROCEDURE IF EXISTS `P_Update_Api_Full`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Update_Api_Full`(IN `MotPasse` VARCHAR(255), IN `APE` VARCHAR(5), IN `sire` VARCHAR(20), IN `AdMail` VARCHAR(200), IN `LaVille` VARCHAR(150), IN `NumRue` TINYINT(4), IN `NomRue` VARCHAR(200), IN `CP` INT(11), IN `TypeVoie` INT(11), IN `ID_Q` INT(10), IN `Reponse` VARCHAR(200), IN `ID_Api` INT(10))
    MODIFIES SQL DATA
UPDATE apiculteur SET 
MDP=MotPasse,
 Code_APE=APE,
 SIRET=sire,
 Ad_Mail=AdMail,
 Ville=LaVille,
 Num_Rue=NumRue,
 Nom_Rue=NomRue,
 Code_Postal=CP,
 Id_Type=TypeVoie,
 Id_Question=ID_Q,
 Re_Question=Reponse
 WHERE ID_Apiculteur=ID_Api$$

DROP PROCEDURE IF EXISTS `P_Update_Api_Pass`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Update_Api_Pass`(IN `Id_Api` INT, IN `PassW` VARCHAR(255))
    MODIFIES SQL DATA
UPDATE Apiculteur
SET MDP=PassW
WHERE ID_Apiculteur=Id_Api$$

DROP PROCEDURE IF EXISTS `P_Update_Coord_Ruche`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Update_Coord_Ruche`(IN `X_La_Ruche` INT, IN `Y_La_Ruche` INT, IN `Z_La_Ruche` INT, IN `Id_La_Ruche` INT)
    MODIFIES SQL DATA
update ruche set X_Ruche=X_La_Ruche,Y_Ruche=Y_La_Ruche,Z_Ruche=Z_La_Ruche WHERE ID_Ruche=Id_La_Ruche$$

DROP PROCEDURE IF EXISTS `P_Update_Image_Rucher`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Update_Image_Rucher`(IN `Nom_Image` VARCHAR(100), IN `IDRUCHER` INT(11))
    MODIFIES SQL DATA
UPDATE rucher SET Path_Image=Nom_Image
WHERE id_Rucher=IDRUCHER$$

DROP PROCEDURE IF EXISTS `P_Update_Ruche`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `P_Update_Ruche`(IN `NomRuche` VARCHAR(60), IN `NumRuche` VARCHAR(30), IN `Rucher` INT(11), IN `DateC` DATE, IN `Etat` INT(11), IN `Hausses` INT(11), IN `Obs` LONGTEXT, IN `IdRuche` INT(11))
    MODIFIES SQL DATA
UPDATE ruche SET DATE_MES = DateC, NBRE_HAUSSE = Hausses, NUM_RUCHE = NumRuche, OBSERV = Obs, Nom_Ruche = NomRuche, id_Rucher = Rucher, ID_ETAT = Etat WHERE ID_Ruche =IdRuche$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `ID_LIGNE` int(11) NOT NULL AUTO_INCREMENT,
  `MAGASIN` varchar(150) NOT NULL,
  `MONTANT` float NOT NULL,
  `DATE_ACHAT` date NOT NULL,
  `DESCRIPTION` varchar(250) NOT NULL,
  `ID_Apiculteur` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID_LIGNE`,`ID_Apiculteur`),
  KEY `fk_achat_apiculteur1_idx` (`ID_Apiculteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `apiculteur`
--

DROP TABLE IF EXISTS `apiculteur`;
CREATE TABLE IF NOT EXISTS `apiculteur` (
  `ID_Apiculteur` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Login` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `MDP` varchar(255) NOT NULL,
  `Code_APE` varchar(5) DEFAULT NULL,
  `Code_API` varchar(10) NOT NULL,
  `SIRET` varchar(20) DEFAULT NULL,
  `NUMAGRI` varchar(30) NOT NULL,
  `Nom_Api` varchar(150) NOT NULL,
  `Prenom_Api` varchar(150) NOT NULL,
  `Ad_Mail` varchar(200) DEFAULT NULL,
  `Ville` varchar(150) NOT NULL,
  `Num_Rue` tinyint(4) NOT NULL,
  `Nom_Rue` varchar(200) NOT NULL,
  `Code_Postal` int(11) NOT NULL,
  `Id_Type` int(11) NOT NULL,
  `ID_Question` int(10) unsigned NOT NULL,
  `Re_Question` varchar(200) NOT NULL,
  PRIMARY KEY (`ID_Apiculteur`,`Id_Type`),
  UNIQUE KEY `Code_API` (`Code_API`,`NUMAGRI`),
  UNIQUE KEY `Login` (`Login`),
  KEY `fk_apiculteur_type_voie1_idx` (`Id_Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `datalogger`
--

DROP TABLE IF EXISTS `datalogger`;
CREATE TABLE IF NOT EXISTS `datalogger` (
  `ID_Ligne` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DataLogger` int(11) NOT NULL DEFAULT '999',
  `Date_Log` date NOT NULL,
  `Heure_Log` time NOT NULL,
  `Poids` int(10) unsigned DEFAULT '0',
  `TempExt` float DEFAULT '-100',
  `TempInt` float DEFAULT '-100',
  `HygroExt` int(10) unsigned DEFAULT '0',
  `HygroInt` int(10) unsigned DEFAULT '0',
  `ID_RUCHE` int(11) NOT NULL,
  `ID_Apiculteur` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID_Ligne`,`ID_RUCHE`),
  KEY `fk_datalogger_ruche1_idx` (`ID_RUCHE`),
  KEY `fk_Api_DataL` (`ID_Apiculteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `essaim`
--

DROP TABLE IF EXISTS `essaim`;
CREATE TABLE IF NOT EXISTS `essaim` (
  `ID_ESSAIM` int(11) NOT NULL AUTO_INCREMENT,
  `ESPECE` varchar(60) DEFAULT NULL,
  `DATE_CREATION` date DEFAULT NULL,
  `LIEU_CAPTURE` varchar(100) DEFAULT NULL,
  `AGE_REINE` int(11) DEFAULT NULL,
  `ORIGINE_REINE` varchar(100) DEFAULT NULL,
  `NOM_ESSAIM` varchar(50) NOT NULL,
  `ID_ORIGINE` int(11) NOT NULL,
  `ID_RUCHE` int(11) NOT NULL,
  `ID_Apiculteur` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID_ESSAIM`,`ID_ORIGINE`,`ID_RUCHE`,`ID_Apiculteur`),
  KEY `fk_essaim_origine_essaim1_idx` (`ID_ORIGINE`),
  KEY `fk_essaim_ruche1_idx` (`ID_RUCHE`),
  KEY `fk_essaim_apiculteur1_idx` (`ID_Apiculteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `etat_ruche`
--

DROP TABLE IF EXISTS `etat_ruche`;
CREATE TABLE IF NOT EXISTS `etat_ruche` (
  `ID_ETAT` int(11) NOT NULL DEFAULT '0',
  `NOM_ETAT` varchar(30) DEFAULT NULL,
  `Photo` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_ETAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hausses`
--

DROP TABLE IF EXISTS `hausses`;
CREATE TABLE IF NOT EXISTS `hausses` (
  `id_hausses` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_cadre` varchar(45) NOT NULL,
  PRIMARY KEY (`id_hausses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `maladie`
--

DROP TABLE IF EXISTS `maladie`;
CREATE TABLE IF NOT EXISTS `maladie` (
  `idmaladie` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Id_Api` int(10) unsigned NOT NULL,
  `Nom_Maladie` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmaladie`),
  KEY `fk_Visite_Api_idx` (`Id_Api`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `origine_essaim`
--

DROP TABLE IF EXISTS `origine_essaim`;
CREATE TABLE IF NOT EXISTS `origine_essaim` (
  `ID_ORIGINE` int(11) NOT NULL,
  `NOM_ORIGINE` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_ORIGINE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `param`
--

DROP TABLE IF EXISTS `param`;
CREATE TABLE IF NOT EXISTS `param` (
  `ID_Param` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Param` varchar(200) NOT NULL,
  `Value_Param` varchar(100) NOT NULL,
  `ID_Apiculteur` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Param`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `question_secrete`
--

DROP TABLE IF EXISTS `question_secrete`;
CREATE TABLE IF NOT EXISTS `question_secrete` (
  `ID_Question` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nom_Question` varchar(200) NOT NULL,
  PRIMARY KEY (`ID_Question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Structure de la table `recolte`
--

DROP TABLE IF EXISTS `recolte`;
CREATE TABLE IF NOT EXISTS `recolte` (
  `ID_Recolte` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Ruche` int(10) NOT NULL,
  `Id_Type_Miel` int(10) unsigned NOT NULL,
  `Poids` float NOT NULL,
  `Date_R` date NOT NULL,
  PRIMARY KEY (`ID_Recolte`),
  KEY `fk_type_miel` (`Id_Type_Miel`),
  KEY `idx_recolte_ruche` (`Id_Ruche`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ruche`
--

DROP TABLE IF EXISTS `ruche`;
CREATE TABLE IF NOT EXISTS `ruche` (
  `ID_Ruche` int(11) NOT NULL AUTO_INCREMENT,
  `DATE_MES` date DEFAULT NULL,
  `NBRE_CADRE` int(11) NOT NULL,
  `NBRE_HAUSSE` int(11) NOT NULL,
  `NUM_RUCHE` varchar(30) NOT NULL,
  `OBSERV` longtext,
  `Nom_Ruche` varchar(60) NOT NULL,
  `id_Rucher` int(11) NOT NULL,
  `ID_ETAT` int(11) NOT NULL,
  `ID_TYPERUCHE` int(11) NOT NULL,
  `id_hausses` int(10) unsigned NOT NULL,
  `QRCode` varchar(255) DEFAULT NULL,
  `X_Ruche` int(11) DEFAULT NULL,
  `Y_Ruche` int(11) DEFAULT NULL,
  `Z_Ruche` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Ruche`,`id_Rucher`,`ID_ETAT`,`ID_TYPERUCHE`,`id_hausses`),
  KEY `fk_ruche_rucher1_idx` (`id_Rucher`),
  KEY `fk_ruche_etat_ruche1_idx` (`ID_ETAT`),
  KEY `fk_ruche_type_ruche1_idx` (`ID_TYPERUCHE`),
  KEY `fk_ruche_hausses1_idx` (`id_hausses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `rucher`
--

DROP TABLE IF EXISTS `rucher`;
CREATE TABLE IF NOT EXISTS `rucher` (
  `id_Rucher` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Rucher` varchar(100) NOT NULL,
  `Localisation` varchar(100) NOT NULL,
  `Coordonnees_GPS` varchar(30) DEFAULT NULL,
  `Observations` longtext,
  `Num_Rucher` varchar(15) NOT NULL,
  `isActif` smallint(6) NOT NULL,
  `ID_Apiculteur` int(10) unsigned NOT NULL,
  `Path_Image` varchar(130) DEFAULT NULL,
  PRIMARY KEY (`id_Rucher`,`ID_Apiculteur`),
  KEY `fk_rucher_apiculteur1_idx` (`ID_Apiculteur`),
  KEY `Nom_Rucher_UNIQUE` (`Nom_Rucher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `templates`
--

DROP TABLE IF EXISTS `templates`;
CREATE TABLE IF NOT EXISTS `templates` (
  `Id_Template` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Template` varchar(30) NOT NULL,
  PRIMARY KEY (`Id_Template`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `temps_meteo`
--

DROP TABLE IF EXISTS `temps_meteo`;
CREATE TABLE IF NOT EXISTS `temps_meteo` (
  `ID_TEMPS` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_TEMPS` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_TEMPS`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_miel`
--

DROP TABLE IF EXISTS `type_miel`;
CREATE TABLE IF NOT EXISTS `type_miel` (
  `ID_Type_Miel` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Api` int(10) unsigned NOT NULL,
  `Nom_Type_Miel` varchar(100) NOT NULL,
  `Nom_Image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Type_Miel`),
  KEY `ID_Api` (`ID_Api`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_ruche`
--

DROP TABLE IF EXISTS `type_ruche`;
CREATE TABLE IF NOT EXISTS `type_ruche` (
  `ID_TYPERUCHE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_TYPE_RUCHE` varchar(60) NOT NULL,
  `Photo` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_TYPERUCHE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_voie`
--

DROP TABLE IF EXISTS `type_voie`;
CREATE TABLE IF NOT EXISTS `type_voie` (
  `Id_Type` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Type` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`Id_Type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

DROP TABLE IF EXISTS `visite`;
CREATE TABLE IF NOT EXISTS `visite` (
  `ID_VISITE` int(11) NOT NULL AUTO_INCREMENT,
  `TEMPERATURE` float DEFAULT NULL,
  `HYGRO` int(11) DEFAULT NULL,
  `TRAVAUX` int(11) DEFAULT NULL,
  `NOURISSAGE` int(11) DEFAULT NULL,
  `TYPE_NOURRISSAGE` varchar(100) DEFAULT NULL,
  `POIDS` float DEFAULT NULL,
  `REINE_VISIBLE` int(11) DEFAULT '0',
  `POPULATION` varchar(255) DEFAULT NULL,
  `COMPORT_ESSAIM` varchar(255) DEFAULT NULL,
  `NOTES` longtext,
  `Date_Visite` date NOT NULL,
  `ID_RUCHE` int(11) NOT NULL,
  `ID_TEMPS` int(11) NOT NULL,
  `Presence_Maladie` int(11) NOT NULL,
  `ID_Maladie` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID_VISITE`,`ID_RUCHE`,`ID_TEMPS`),
  KEY `fk_visite_ruche1_idx` (`ID_RUCHE`),
  KEY `fk_visite_temps_meteo1_idx` (`ID_TEMPS`),
  KEY `fk_visite_maladie_idx` (`ID_Maladie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_achat`
--
DROP VIEW IF EXISTS `vue_achat`;
CREATE TABLE IF NOT EXISTS `vue_achat` (
`ID_Apiculteur` int(10) unsigned
,`Nom_Api` varchar(150)
,`Prenom_Api` varchar(150)
,`ID_Ligne` int(11)
,`Magasin` varchar(150)
,`Montant` float
,`Date_Achat` date
,`Description` varchar(250)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_apiculteur`
--
DROP VIEW IF EXISTS `vue_apiculteur`;
CREATE TABLE IF NOT EXISTS `vue_apiculteur` (
`ID_Apiculteur` int(10) unsigned
,`Login` varchar(50)
,`MDP` varchar(255)
,`Code_APE` varchar(5)
,`Code_API` varchar(10)
,`SIRET` varchar(20)
,`NUMAGRI` varchar(30)
,`Nom_Api` varchar(150)
,`Prenom_Api` varchar(150)
,`Ad_Mail` varchar(200)
,`Ville` varchar(150)
,`Num_Rue` tinyint(4)
,`Nom_Rue` varchar(200)
,`Code_Postal` int(11)
,`Nom_Type` varchar(90)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_coord_ruche`
--
DROP VIEW IF EXISTS `vue_coord_ruche`;
CREATE TABLE IF NOT EXISTS `vue_coord_ruche` (
`ID_Ruche` int(11)
,`Nom_Ruche` varchar(60)
,`X_Ruche` int(11)
,`Y_Ruche` int(11)
,`Z_Ruche` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_coord_ruche_rucher`
--
DROP VIEW IF EXISTS `vue_coord_ruche_rucher`;
CREATE TABLE IF NOT EXISTS `vue_coord_ruche_rucher` (
`X_Ruche` int(11)
,`Y_Ruche` int(11)
,`Z_Ruche` int(11)
,`id_rucher` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_essaim_nomruche`
--
DROP VIEW IF EXISTS `vue_essaim_nomruche`;
CREATE TABLE IF NOT EXISTS `vue_essaim_nomruche` (
`ID_ESSAIM` int(11)
,`NOM_ESSAIM` varchar(50)
,`Id_Apiculteur` int(10) unsigned
,`Nom_Ruche` varchar(60)
,`ID_RUCHE` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_recolte`
--
DROP VIEW IF EXISTS `vue_recolte`;
CREATE TABLE IF NOT EXISTS `vue_recolte` (
`Poids` float
,`Date_R` date
,`Id_Ruche` int(10)
,`Id_Type_Miel` int(10) unsigned
,`Nom_Type_Miel` varchar(100)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_recolte_api`
--
DROP VIEW IF EXISTS `vue_recolte_api`;
CREATE TABLE IF NOT EXISTS `vue_recolte_api` (
`Poids` float
,`Date_R` date
,`Id_Type_Miel` int(10) unsigned
,`Nom_Type_Miel` varchar(100)
,`Id_Ruche` int(11)
,`Nom_Ruche` varchar(60)
,`ID_Apiculteur` int(10) unsigned
,`Id_Rucher` int(11)
,`Image` varchar(50)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_rucher_api`
--
DROP VIEW IF EXISTS `vue_rucher_api`;
CREATE TABLE IF NOT EXISTS `vue_rucher_api` (
`Id_Rucher` int(11)
,`Nom_Rucher` varchar(100)
,`Localisation` varchar(100)
,`Coordonnees_GPS` varchar(30)
,`Observations` longtext
,`Num_Rucher` varchar(15)
,`isActif` smallint(6)
,`Nom_Api` varchar(150)
,`Prenom_Api` varchar(150)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_rucher_declaration`
--
DROP VIEW IF EXISTS `vue_rucher_declaration`;
CREATE TABLE IF NOT EXISTS `vue_rucher_declaration` (
`Nom_Api` varchar(150)
,`Prenom_Api` varchar(150)
,`Ville` varchar(150)
,`Num_Rue` tinyint(4)
,`nom_Rue` varchar(200)
,`Code_Postal` int(11)
,`SIRET` varchar(20)
,`Code_API` varchar(10)
,`Nom_Type` varchar(90)
,`Nom_Rucher` varchar(100)
,`Localisation` varchar(100)
,`Num_Rucher` varchar(15)
,`id_Rucher` int(11)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_ruche_api`
--
DROP VIEW IF EXISTS `vue_ruche_api`;
CREATE TABLE IF NOT EXISTS `vue_ruche_api` (
`Id_Ruche` int(11)
,`nom_ruche` varchar(60)
,`NUM_RUCHE` varchar(30)
,`ID_Apiculteur` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_ruche_complete_sans_api`
--
DROP VIEW IF EXISTS `vue_ruche_complete_sans_api`;
CREATE TABLE IF NOT EXISTS `vue_ruche_complete_sans_api` (
`ID_Ruche` int(11)
,`Date_MES` date
,`NBRE_CADRE` int(11)
,`NBRE_HAUSSE` int(11)
,`NUM_RUCHE` varchar(30)
,`Nom_Ruche` varchar(60)
,`OBSERV` longtext
,`EPHOTO` varchar(25)
,`NOM_ETAT` varchar(30)
,`Nom_Rucher` varchar(100)
,`Id_Rucher` int(11)
,`NOM_TYPE_RUCHE` varchar(60)
,`TPHOTO` varchar(25)
,`type_cadre` varchar(45)
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_ruche_etat_essaim`
--
DROP VIEW IF EXISTS `vue_ruche_etat_essaim`;
CREATE TABLE IF NOT EXISTS `vue_ruche_etat_essaim` (
`ID_Ruche` int(11)
,`NBRE_HAUSSE` int(11)
,`Nom_ETAT` varchar(30)
,`Nom_Essaim` varchar(50)
,`ID_Apiculteur` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_ruche_sans_essaims`
--
DROP VIEW IF EXISTS `vue_ruche_sans_essaims`;
CREATE TABLE IF NOT EXISTS `vue_ruche_sans_essaims` (
`Id_Ruche` int(11)
,`Nom_Ruche` varchar(60)
,`Id_Apiculteur` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_visite`
--
DROP VIEW IF EXISTS `vue_visite`;
CREATE TABLE IF NOT EXISTS `vue_visite` (
`Temperature` float
,`Hygro` int(11)
,`Travaux` int(11)
,`Nourrissage` int(11)
,`Type_Nourrissage` varchar(100)
,`Poids` float
,`Reine_Visible` int(11)
,`Population` varchar(255)
,`Comportement` varchar(255)
,`Notes` longtext
,`Date_Visite` date
,`Presence_Maladie` int(11)
,`Id_Ruche` int(11)
,`Nom_Ruche` varchar(60)
,`Nom_Maladie` varchar(45)
,`Climat` varchar(50)
);
-- --------------------------------------------------------

--
-- Structure de la vue `vue_achat`
--
DROP TABLE IF EXISTS `vue_achat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_achat` AS select `a`.`ID_Apiculteur` AS `ID_Apiculteur`,`a`.`Nom_Api` AS `Nom_Api`,`a`.`Prenom_Api` AS `Prenom_Api`,`v`.`ID_LIGNE` AS `ID_Ligne`,`v`.`MAGASIN` AS `Magasin`,`v`.`MONTANT` AS `Montant`,`v`.`DATE_ACHAT` AS `Date_Achat`,`v`.`DESCRIPTION` AS `Description` from (`apiculteur` `a` join `achat` `v` on((`v`.`ID_Apiculteur` = `a`.`ID_Apiculteur`)));

-- --------------------------------------------------------

--
-- Structure de la vue `vue_apiculteur`
--
DROP TABLE IF EXISTS `vue_apiculteur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_apiculteur` AS select `a`.`ID_Apiculteur` AS `ID_Apiculteur`,`a`.`Login` AS `Login`,`a`.`MDP` AS `MDP`,`a`.`Code_APE` AS `Code_APE`,`a`.`Code_API` AS `Code_API`,`a`.`SIRET` AS `SIRET`,`a`.`NUMAGRI` AS `NUMAGRI`,`a`.`Nom_Api` AS `Nom_Api`,`a`.`Prenom_Api` AS `Prenom_Api`,`a`.`Ad_Mail` AS `Ad_Mail`,`a`.`Ville` AS `Ville`,`a`.`Num_Rue` AS `Num_Rue`,`a`.`Nom_Rue` AS `Nom_Rue`,`a`.`Code_Postal` AS `Code_Postal`,`t`.`Nom_Type` AS `Nom_Type` from (`apiculteur` `a` join `type_voie` `t` on((`a`.`Id_Type` = `t`.`Id_Type`)));

-- --------------------------------------------------------

--
-- Structure de la vue `vue_coord_ruche`
--
DROP TABLE IF EXISTS `vue_coord_ruche`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_coord_ruche` AS select `ruche`.`ID_Ruche` AS `ID_Ruche`,`ruche`.`Nom_Ruche` AS `Nom_Ruche`,`ruche`.`X_Ruche` AS `X_Ruche`,`ruche`.`Y_Ruche` AS `Y_Ruche`,`ruche`.`Z_Ruche` AS `Z_Ruche` from `ruche`;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_coord_ruche_rucher`
--
DROP TABLE IF EXISTS `vue_coord_ruche_rucher`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_coord_ruche_rucher` AS select `ruche`.`X_Ruche` AS `X_Ruche`,`ruche`.`Y_Ruche` AS `Y_Ruche`,`ruche`.`Z_Ruche` AS `Z_Ruche`,`ruche`.`id_Rucher` AS `id_rucher` from `ruche` where ((`ruche`.`X_Ruche` is not null) and (`ruche`.`Y_Ruche` is not null) and (`ruche`.`Z_Ruche` is not null));

-- --------------------------------------------------------

--
-- Structure de la vue `vue_essaim_nomruche`
--
DROP TABLE IF EXISTS `vue_essaim_nomruche`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_essaim_nomruche` AS select `e`.`ID_ESSAIM` AS `ID_ESSAIM`,`e`.`NOM_ESSAIM` AS `NOM_ESSAIM`,`e`.`ID_Apiculteur` AS `Id_Apiculteur`,`r`.`Nom_Ruche` AS `Nom_Ruche`,`r`.`ID_Ruche` AS `ID_RUCHE` from (`essaim` `e` join `ruche` `r` on((`e`.`ID_RUCHE` = `r`.`ID_Ruche`)));

-- --------------------------------------------------------

--
-- Structure de la vue `vue_recolte`
--
DROP TABLE IF EXISTS `vue_recolte`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_recolte` AS select `r`.`Poids` AS `Poids`,`r`.`Date_R` AS `Date_R`,`r`.`Id_Ruche` AS `Id_Ruche`,`r`.`Id_Type_Miel` AS `Id_Type_Miel`,`t`.`Nom_Type_Miel` AS `Nom_Type_Miel` from (`recolte` `r` join `type_miel` `t` on((`r`.`Id_Type_Miel` = `t`.`ID_Type_Miel`)));

-- --------------------------------------------------------

--
-- Structure de la vue `vue_recolte_api`
--
DROP TABLE IF EXISTS `vue_recolte_api`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_recolte_api` AS select `re`.`Poids` AS `Poids`,`re`.`Date_R` AS `Date_R`,`re`.`Id_Type_Miel` AS `Id_Type_Miel`,`type_miel`.`Nom_Type_Miel` AS `Nom_Type_Miel`,`ru`.`ID_Ruche` AS `Id_Ruche`,`ru`.`Nom_Ruche` AS `Nom_Ruche`,`a`.`ID_Apiculteur` AS `ID_Apiculteur`,`rucher`.`id_Rucher` AS `Id_Rucher`,`type_miel`.`Nom_Image` AS `Image` from ((((`recolte` `re` join `ruche` `ru` on((`re`.`Id_Ruche` = `ru`.`ID_Ruche`))) join `type_miel` on((`re`.`Id_Type_Miel` = `type_miel`.`ID_Type_Miel`))) join `rucher` on((`ru`.`id_Rucher` = `rucher`.`id_Rucher`))) join `apiculteur` `a` on((`rucher`.`ID_Apiculteur` = `a`.`ID_Apiculteur`)));

-- --------------------------------------------------------

--
-- Structure de la vue `vue_rucher_api`
--
DROP TABLE IF EXISTS `vue_rucher_api`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_rucher_api` AS select `r`.`id_Rucher` AS `Id_Rucher`,`r`.`Nom_Rucher` AS `Nom_Rucher`,`r`.`Localisation` AS `Localisation`,`r`.`Coordonnees_GPS` AS `Coordonnees_GPS`,`r`.`Observations` AS `Observations`,`r`.`Num_Rucher` AS `Num_Rucher`,`r`.`isActif` AS `isActif`,`a`.`Nom_Api` AS `Nom_Api`,`a`.`Prenom_Api` AS `Prenom_Api` from (`rucher` `r` join `apiculteur` `a` on((`r`.`ID_Apiculteur` = `a`.`ID_Apiculteur`)));

-- --------------------------------------------------------

--
-- Structure de la vue `vue_rucher_declaration`
--
DROP TABLE IF EXISTS `vue_rucher_declaration`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_rucher_declaration` AS select `a`.`Nom_Api` AS `Nom_Api`,`a`.`Prenom_Api` AS `Prenom_Api`,`a`.`Ville` AS `Ville`,`a`.`Num_Rue` AS `Num_Rue`,`a`.`Nom_Rue` AS `nom_Rue`,`a`.`Code_Postal` AS `Code_Postal`,`a`.`SIRET` AS `SIRET`,`a`.`Code_API` AS `Code_API`,`t`.`Nom_Type` AS `Nom_Type`,`r`.`Nom_Rucher` AS `Nom_Rucher`,`r`.`Localisation` AS `Localisation`,`r`.`Num_Rucher` AS `Num_Rucher`,`r`.`id_Rucher` AS `id_Rucher` from ((`apiculteur` `a` join `rucher` `r` on((`r`.`ID_Apiculteur` = `a`.`ID_Apiculteur`))) join `type_voie` `t` on((`a`.`Id_Type` = `t`.`Id_Type`)));

-- --------------------------------------------------------

--
-- Structure de la vue `vue_ruche_api`
--
DROP TABLE IF EXISTS `vue_ruche_api`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_ruche_api` AS select `r`.`ID_Ruche` AS `Id_Ruche`,`r`.`Nom_Ruche` AS `nom_ruche`,`r`.`NUM_RUCHE` AS `NUM_RUCHE`,`a`.`ID_Apiculteur` AS `ID_Apiculteur` from ((`ruche` `r` join `rucher` on((`r`.`id_Rucher` = `rucher`.`id_Rucher`))) join `apiculteur` `a` on((`rucher`.`ID_Apiculteur` = `a`.`ID_Apiculteur`)));

-- --------------------------------------------------------

--
-- Structure de la vue `vue_ruche_complete_sans_api`
--
DROP TABLE IF EXISTS `vue_ruche_complete_sans_api`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_ruche_complete_sans_api` AS select `r`.`ID_Ruche` AS `ID_Ruche`,`r`.`DATE_MES` AS `Date_MES`,`r`.`NBRE_CADRE` AS `NBRE_CADRE`,`r`.`NBRE_HAUSSE` AS `NBRE_HAUSSE`,`r`.`NUM_RUCHE` AS `NUM_RUCHE`,`r`.`Nom_Ruche` AS `Nom_Ruche`,`r`.`OBSERV` AS `OBSERV`,`e`.`Photo` AS `EPHOTO`,`e`.`NOM_ETAT` AS `NOM_ETAT`,`ru`.`Nom_Rucher` AS `Nom_Rucher`,`ru`.`id_Rucher` AS `Id_Rucher`,`t`.`NOM_TYPE_RUCHE` AS `NOM_TYPE_RUCHE`,`t`.`Photo` AS `TPHOTO`,`h`.`type_cadre` AS `type_cadre` from ((((`ruche` `r` join `rucher` `ru` on((`r`.`id_Rucher` = `ru`.`id_Rucher`))) join `etat_ruche` `e` on((`r`.`ID_ETAT` = `e`.`ID_ETAT`))) join `type_ruche` `t` on((`r`.`ID_TYPERUCHE` = `t`.`ID_TYPERUCHE`))) join `hausses` `h` on((`r`.`id_hausses` = `h`.`id_hausses`)));

-- --------------------------------------------------------

--
-- Structure de la vue `vue_ruche_etat_essaim`
--
DROP TABLE IF EXISTS `vue_ruche_etat_essaim`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_ruche_etat_essaim` AS select `r`.`ID_Ruche` AS `ID_Ruche`,`r`.`NBRE_HAUSSE` AS `NBRE_HAUSSE`,`e`.`NOM_ETAT` AS `Nom_ETAT`,`es`.`NOM_ESSAIM` AS `Nom_Essaim`,`a`.`ID_Apiculteur` AS `ID_Apiculteur` from ((((`ruche` `r` join `etat_ruche` `e` on((`r`.`ID_ETAT` = `e`.`ID_ETAT`))) left join `essaim` `es` on((`es`.`ID_RUCHE` = `r`.`ID_Ruche`))) join `rucher` on((`r`.`id_Rucher` = `rucher`.`id_Rucher`))) join `apiculteur` `a` on((`a`.`ID_Apiculteur` = `rucher`.`ID_Apiculteur`)));

-- --------------------------------------------------------

--
-- Structure de la vue `vue_ruche_sans_essaims`
--
DROP TABLE IF EXISTS `vue_ruche_sans_essaims`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_ruche_sans_essaims` AS select `r`.`ID_Ruche` AS `Id_Ruche`,`r`.`Nom_Ruche` AS `Nom_Ruche`,`ru`.`ID_Apiculteur` AS `Id_Apiculteur` from ((`ruche` `r` left join `essaim` on((`r`.`ID_Ruche` = `essaim`.`ID_RUCHE`))) join `rucher` `ru` on((`r`.`id_Rucher` = `ru`.`id_Rucher`))) where isnull(`essaim`.`ID_ESSAIM`);

-- --------------------------------------------------------

--
-- Structure de la vue `vue_visite`
--
DROP TABLE IF EXISTS `vue_visite`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_visite` AS select `v`.`TEMPERATURE` AS `Temperature`,`v`.`HYGRO` AS `Hygro`,`v`.`TRAVAUX` AS `Travaux`,`v`.`NOURISSAGE` AS `Nourrissage`,`v`.`TYPE_NOURRISSAGE` AS `Type_Nourrissage`,`v`.`POIDS` AS `Poids`,`v`.`REINE_VISIBLE` AS `Reine_Visible`,`v`.`POPULATION` AS `Population`,`v`.`COMPORT_ESSAIM` AS `Comportement`,`v`.`NOTES` AS `Notes`,`v`.`Date_Visite` AS `Date_Visite`,`v`.`Presence_Maladie` AS `Presence_Maladie`,`r`.`ID_Ruche` AS `Id_Ruche`,`r`.`Nom_Ruche` AS `Nom_Ruche`,`m`.`Nom_Maladie` AS `Nom_Maladie`,`t`.`NOM_TEMPS` AS `Climat` from (((`visite` `v` join `ruche` `r` on((`v`.`ID_RUCHE` = `r`.`ID_Ruche`))) join `maladie` `m` on((`v`.`ID_Maladie` = `m`.`idmaladie`))) join `temps_meteo` `t` on((`v`.`ID_TEMPS` = `t`.`ID_TEMPS`)));

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `fk_achat_apiculteur1` FOREIGN KEY (`ID_Apiculteur`) REFERENCES `apiculteur` (`ID_Apiculteur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `apiculteur`
--
ALTER TABLE `apiculteur`
  ADD CONSTRAINT `fk_apiculteur_type_voie1` FOREIGN KEY (`Id_Type`) REFERENCES `type_voie` (`Id_Type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `datalogger`
--
ALTER TABLE `datalogger`
  ADD CONSTRAINT `FK_Api_Datalogger` FOREIGN KEY (`ID_Apiculteur`) REFERENCES `apiculteur` (`ID_Apiculteur`),
  ADD CONSTRAINT `fk_datalogger_ruche1` FOREIGN KEY (`ID_RUCHE`) REFERENCES `ruche` (`ID_Ruche`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `essaim`
--
ALTER TABLE `essaim`
  ADD CONSTRAINT `fk_essaim_apiculteur1` FOREIGN KEY (`ID_Apiculteur`) REFERENCES `apiculteur` (`ID_Apiculteur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_essaim_origine_essaim1` FOREIGN KEY (`ID_ORIGINE`) REFERENCES `origine_essaim` (`ID_ORIGINE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_essaim_ruche1` FOREIGN KEY (`ID_RUCHE`) REFERENCES `ruche` (`ID_Ruche`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `maladie`
--
ALTER TABLE `maladie`
  ADD CONSTRAINT `fk_maladie_api` FOREIGN KEY (`Id_Api`) REFERENCES `apiculteur` (`ID_Apiculteur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `recolte`
--
ALTER TABLE `recolte`
  ADD CONSTRAINT `fk_recolte_ruche` FOREIGN KEY (`Id_Ruche`) REFERENCES `ruche` (`ID_Ruche`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Recolte_Type` FOREIGN KEY (`Id_Type_Miel`) REFERENCES `type_miel` (`ID_Type_Miel`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ruche`
--
ALTER TABLE `ruche`
  ADD CONSTRAINT `fk_ruche_etat_ruche1` FOREIGN KEY (`ID_ETAT`) REFERENCES `etat_ruche` (`ID_ETAT`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ruche_hausses1` FOREIGN KEY (`id_hausses`) REFERENCES `hausses` (`id_hausses`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ruche_rucher1` FOREIGN KEY (`id_Rucher`) REFERENCES `rucher` (`id_Rucher`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ruche_type_ruche1` FOREIGN KEY (`ID_TYPERUCHE`) REFERENCES `type_ruche` (`ID_TYPERUCHE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rucher`
--
ALTER TABLE `rucher`
  ADD CONSTRAINT `fk_rucher_apiculteur1` FOREIGN KEY (`ID_Apiculteur`) REFERENCES `apiculteur` (`ID_Apiculteur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `type_miel`
--
ALTER TABLE `type_miel`
  ADD CONSTRAINT `type_miel_ibfk_1` FOREIGN KEY (`ID_Api`) REFERENCES `apiculteur` (`ID_Apiculteur`);

--
-- Contraintes pour la table `visite`
--
ALTER TABLE `visite`
  ADD CONSTRAINT `fk_visite_maladie` FOREIGN KEY (`ID_Maladie`) REFERENCES `maladie` (`idmaladie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_visite_ruche1` FOREIGN KEY (`ID_RUCHE`) REFERENCES `ruche` (`ID_Ruche`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_visite_temps_meteo1` FOREIGN KEY (`ID_TEMPS`) REFERENCES `temps_meteo` (`ID_TEMPS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
