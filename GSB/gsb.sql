-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 12 Avril 2013 à 14:11
-- Version du serveur: 5.1.66
-- Version de PHP: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: gsb_frais
--

-- --------------------------------------------------------

--
-- Structure de la table Etat
--

CREATE TABLE IF NOT EXISTS Etat (
  id char(2) NOT NULL,
  libelle varchar(30) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table Etat
--

INSERT INTO Etat (id, libelle) VALUES
('CL', 'Saisie clôturée'),
('CR', 'Fiche créée, saisie en cours'),
('RB', 'Remboursée'),
('VA', 'Validée et mise en paiement');

-- --------------------------------------------------------

--
-- Structure de la table FicheFrais
--

CREATE TABLE IF NOT EXISTS FicheFrais (
  idVisiteur char(4) NOT NULL,
  mois char(6) NOT NULL,
  nbJustificatifs int(11) DEFAULT NULL,
  montantValide decimal(10,2) DEFAULT NULL,
  dateModif date DEFAULT NULL,
  idEtat char(2) DEFAULT 'CR',
  PRIMARY KEY (idVisiteur,mois),
  KEY idEtat (idEtat)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table FicheFrais
--

INSERT INTO FicheFrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) VALUES
('1', '201303', 0, '500.00', '2013-03-28', 'CL'),
('2', '201303', 0, '20.00', '2013-04-05', 'CL'),
('2', '201304', 0, NULL, '2013-04-05', 'CR'),
('a17', '201303', 0, '200.00', '2013-03-14', 'CL');

-- --------------------------------------------------------

--
-- Structure de la table FraisForfait
--

CREATE TABLE IF NOT EXISTS FraisForfait (
  id char(3) NOT NULL,
  libelle char(20) DEFAULT NULL,
  montant decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table FraisForfait
--

INSERT INTO FraisForfait (id, libelle, montant) VALUES
('ETP', 'Forfait Etape', '110.00'),
('KM', 'Frais Kilométrique', '0.62'),
('NUI', 'Nuitée Hôtel', '80.00'),
('REP', 'Repas Restaurant', '25.00');

-- --------------------------------------------------------

--
-- Structure de la table LigneFraisForfait
--

CREATE TABLE IF NOT EXISTS LigneFraisForfait (
  idVisiteur char(4) NOT NULL,
  mois char(6) NOT NULL,
  idFraisForfait char(3) NOT NULL,
  quantite int(11) DEFAULT NULL,
  PRIMARY KEY (idVisiteur,mois,idFraisForfait),
  KEY idFraisForfait (idFraisForfait)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table LigneFraisForfait
--

INSERT INTO LigneFraisForfait (idVisiteur, mois, idFraisForfait, quantite) VALUES
('1', '201303', 'ETP', 0),
('1', '201303', 'KM', 150),
('1', '201303', 'NUI', 10),
('1', '201303', 'REP', 1),
('2', '201303', 'ETP', 1),
('2', '201303', 'KM', 1),
('2', '201303', 'NUI', 1),
('2', '201303', 'REP', 1),
('2', '201304', 'ETP', 0),
('2', '201304', 'KM', 0),
('2', '201304', 'NUI', 2),
('2', '201304', 'REP', 4);

-- --------------------------------------------------------

--
-- Structure de la table LigneFraisHorsForfait
--

CREATE TABLE IF NOT EXISTS LigneFraisHorsForfait (
  id int(11) NOT NULL AUTO_INCREMENT,
  idVisiteur char(4) NOT NULL,
  libelle varchar(100) DEFAULT NULL,
  date date DEFAULT NULL,
  montant decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idVisiteur (idVisiteur)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table LigneFraisHorsForfait
--

INSERT INTO LigneFraisHorsForfait (id, idVisiteur, libelle, date, montant) VALUES
(1, '1', 'Hotel', '2013-03-27', '50.00'),
(3, '1', 'Parking', '2013-04-01', '20.00');

-- --------------------------------------------------------

--
-- Structure de la table Visiteur
--

CREATE TABLE IF NOT EXISTS Visiteur (
  id char(4) NOT NULL,
  nom char(30) DEFAULT NULL,
  prenom char(30) DEFAULT NULL,
  login char(20) DEFAULT NULL,
  mdp char(20) DEFAULT NULL,
  adresse char(30) DEFAULT NULL,
  cp char(5) DEFAULT NULL,
  ville char(30) DEFAULT NULL,
  dateEmbauche date DEFAULT NULL,
  type tinyint(1) DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table Visiteur
--

INSERT INTO Visiteur (id, nom, prenom, login, mdp, adresse, cp, ville, dateEmbauche, type) VALUES
('1', 'Alberto', 'Hugo', 'luo', 'luo', 'lol', '05000', 'Gap', '2013-03-28', 2),
('2', 'Jean', 'Jacques', 'lou', 'lou', 'test', '05000', 'Gap', '2013-03-21', 1),
('a131', 'Villechalane', 'Louis', 'lvillachane', 'jux7g', '8 rue des Charmes', '46000', 'Cahors', '2005-12-21', 1),
('a17', 'Andre', 'David', 'dandre', 'oppg5', '1 rue Petit', '46200', 'Lalbenque', '1998-11-23', 1),
('a55', 'Bedos', 'Christian', 'cbedos', 'gmhxd', '1 rue Peranud', '46250', 'Montcuq', '1995-01-12', 1),
('a93', 'Tusseau', 'Louis', 'ltusseau', 'ktp3s', '22 rue des Ternes', '46123', 'Gramat', '2000-05-01', 1),
('b13', 'Bentot', 'Pascal', 'pbentot', 'doyw1', '11 allée des Cerises', '46512', 'Bessines', '1992-07-09', 1),
('b16', 'Bioret', 'Luc', 'lbioret', 'hrjfs', '1 Avenue gambetta', '46000', 'Cahors', '1998-05-11', 1),
('b19', 'Bunisset', 'Francis', 'fbunisset', '4vbnd', '10 rue des Perles', '93100', 'Montreuil', '1987-10-21', 1),
('b25', 'Bunisset', 'Denise', 'dbunisset', 's1y1r', '23 rue Manin', '75019', 'paris', '2010-12-05', 1),
('b28', 'Cacheux', 'Bernard', 'bcacheux', 'uf7r3', '114 rue Blanche', '75017', 'Paris', '2009-11-12', 1),
('b34', 'Cadic', 'Eric', 'ecadic', '6u8dc', '123 avenue de la République', '75011', 'Paris', '2008-09-23', 1),
('b4', 'Charoze', 'Catherine', 'ccharoze', 'u817o', '100 rue Petit', '75019', 'Paris', '2005-11-12', 1),
('b50', 'Clepkens', 'Christophe', 'cclepkens', 'bw1us', '12 allée des Anges', '93230', 'Romainville', '2003-08-11', 1),
('b59', 'Cottin', 'Vincenne', 'vcottin', '2hoh9', '36 rue Des Roches', '93100', 'Monteuil', '2001-11-18', 1),
('c14', 'Daburon', 'François', 'fdaburon', '7oqpv', '13 rue de Chanzy', '94000', 'Créteil', '2002-02-11', 1),
('c3', 'De', 'Philippe', 'pde', 'gk9kx', '13 rue Barthes', '94000', 'Créteil', '2010-12-14', 1),
('c54', 'Debelle', 'Michel', 'mdebelle', 'od5rt', '181 avenue Barbusse', '93210', 'Rosny', '2006-11-23', 1),
('d13', 'Debelle', 'Jeanne', 'jdebelle', 'nvwqq', '134 allée des Joncs', '44000', 'Nantes', '2000-05-11', 1),
('d51', 'Debroise', 'Michel', 'mdebroise', 'sghkb', '2 Bld Jourdain', '44000', 'Nantes', '2001-04-17', 1),
('e22', 'Desmarquest', 'Nathalie', 'ndesmarquest', 'f1fob', '14 Place d Arc', '45000', 'Orléans', '2005-11-12', 1),
('e24', 'Desnost', 'Pierre', 'pdesnost', '4k2o5', '16 avenue des Cèdres', '23200', 'Guéret', '2001-02-05', 1),
('e39', 'Dudouit', 'Frédéric', 'fdudouit', '44im8', '18 rue de l église', '23120', 'GrandBourg', '2000-08-01', 1),
('e49', 'Duncombe', 'Claude', 'cduncombe', 'qf77j', '19 rue de la tour', '23100', 'La souteraine', '1987-10-10', 1),
('e5', 'Enault-Pascreau', 'Céline', 'cenault', 'y2qdu', '25 place de la gare', '23200', 'Gueret', '1995-09-01', 1),
('e52', 'Eynde', 'Valérie', 'veynde', 'i7sn3', '3 Grand Place', '13015', 'Marseille', '1999-11-01', 1),
('f21', 'Finck', 'Jacques', 'jfinck', 'mpb3t', '10 avenue du Prado', '13002', 'Marseille', '2001-11-10', 1),
('f39', 'Frémont', 'Fernande', 'ffremont', 'xs5tq', '4 route de la mer', '13012', 'Allauh', '1998-10-01', 1),
('f4', 'Gest', 'Alain', 'agest', 'dywvt', '30 avenue de la mer', '13025', 'Berre', '1985-11-01', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table FicheFrais
--
ALTER TABLE FicheFrais
  ADD CONSTRAINT FicheFrais_ibfk_1 FOREIGN KEY (idEtat) REFERENCES Etat (id),
  ADD CONSTRAINT FicheFrais_ibfk_2 FOREIGN KEY (idVisiteur) REFERENCES Visiteur (id);

--
-- Contraintes pour la table LigneFraisForfait
--
ALTER TABLE LigneFraisForfait
  ADD CONSTRAINT LigneFraisForfait_ibfk_1 FOREIGN KEY (idVisiteur, mois) REFERENCES FicheFrais (idVisiteur, mois),
  ADD CONSTRAINT LigneFraisForfait_ibfk_2 FOREIGN KEY (idFraisForfait) REFERENCES FraisForfait (id);

--
-- Contraintes pour la table LigneFraisHorsForfait
--
ALTER TABLE LigneFraisHorsForfait
  ADD CONSTRAINT LigneFraisHorsForfait_ibfk_1 FOREIGN KEY (idVisiteur) REFERENCES FicheFrais (idVisiteur);
