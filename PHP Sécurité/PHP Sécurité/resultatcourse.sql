-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 04 Mars 2017 à 12:43
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `resultatcourse`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `USER` varchar(255) NOT NULL,
  `MPD` varchar(255) NOT NULL,
  `MDPS` varchar(255) NOT NULL,
  `NOM` varchar(255) NOT NULL,
  `PRENOM` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`ID`, `USER`, `MPD`, `MDPS`, `NOM`, `PRENOM`) VALUES
(1, 'majda.dari', '123456', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Dari', 'Majda');

-- --------------------------------------------------------

--
-- Structure de la table `commissaire`
--

CREATE TABLE `commissaire` (
  `ID` int(11) NOT NULL,
  `NOM` varchar(512) NOT NULL,
  `PRENOM` varchar(255) NOT NULL,
  `USER` varchar(255) NOT NULL,
  `MDP` varchar(255) NOT NULL,
  `MDPS` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commissaire`
--

INSERT INTO `commissaire` (`ID`, `NOM`, `PRENOM`, `USER`, `MDP`, `MDPS`) VALUES
(1, 'Fahim', 'Kenza', 'kenza.fahim', '123456', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(2, 'Belghez', 'Anas', 'anas.belghez', '123456', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Structure de la table `commissairecourse`
--

CREATE TABLE `commissairecourse` (
  `ID` int(11) NOT NULL,
  `COMMISSAIRE` varchar(255) NOT NULL,
  `COURSE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commissairecourse`
--

INSERT INTO `commissairecourse` (`ID`, `COMMISSAIRE`, `COURSE`) VALUES
(1, 'anas.belghez', 'TripleSaut(H)'),
(2, 'kenza.fahim', '200(F)'),
(3, 'kenza.fahim', '800(F)');

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

CREATE TABLE `course` (
  `ID` int(11) NOT NULL,
  `TITRE` varchar(255) NOT NULL,
  `HEURE` time NOT NULL,
  `CATEGORIE` varchar(255) NOT NULL,
  `JOUR` varchar(100) NOT NULL,
  `TYPE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `course`
--

INSERT INTO `course` (`ID`, `TITRE`, `HEURE`, `CATEGORIE`, `JOUR`, `TYPE`) VALUES
(1, '800(F)', '10:00:00', '800 mètres metres', 'Samedi 25 Janvier', 'F'),
(2, '200(F)', '10:30:00', '200 mètres metres', 'Dimanche 26 Janvier', 'F'),
(3, 'TripleSaut(H)', '11:00:00', 'TripleSaut', 'Samedi 25 Janvier', 'H');

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `ID` int(11) NOT NULL,
  `DOSSARD` int(11) NOT NULL,
  `COURSE` varchar(255) NOT NULL,
  `NOM` varchar(255) NOT NULL,
  `PRENOM` varchar(255) NOT NULL,
  `DN` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `participant`
--

INSERT INTO `participant` (`ID`, `DOSSARD`, `COURSE`, `NOM`, `PRENOM`, `DN`) VALUES
(1, 88, '200(F)', 'Chaafane', 'Nawal', '1987-11-22'),
(2, 26, '200(F)', 'Békélé', 'Sanya', '1984-09-21'),
(3, 44, '800(F)', 'Redouani', 'Asmaa', '1989-08-22'),
(4, 12, '200(F)', 'Fellah', 'Houda', '1987-10-22'),
(5, 30, 'TripleSaut(H)', 'Bassni', 'Anas', '1988-01-22'),
(6, 33, 'TripleSaut(H)', 'Ngobo', 'Cristophe', '1984-01-01'),
(7, 124, '800(F)', 'Slimani', 'Kenza', '1988-01-01');

-- --------------------------------------------------------

--
-- Structure de la table `recordcourse`
--

CREATE TABLE `recordcourse` (
  `ID` int(11) NOT NULL,
  `COURSE` varchar(255) NOT NULL,
  `RM` varchar(255) NOT NULL,
  `RO` varchar(255) NOT NULL,
  `RE` varchar(255) NOT NULL,
  `RF` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `recordcourse`
--

INSERT INTO `recordcourse` (`ID`, `COURSE`, `RM`, `RO`, `RE`, `RF`) VALUES
(1, '800(F)', '1''53"28', '1''53"43', '1''53"28', '1''56"53'),
(2, '200(F)', '1''03"28', '1''03"43', '1''03"28', '1''06"53'),
(3, 'TripleSaut(H)', '1''40"30', '1''40"40', '1''40"20', '1''40"40');

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

CREATE TABLE `resultat` (
  `ID` int(11) NOT NULL,
  `TITRE` varchar(255) NOT NULL,
  `DOSSARD` int(11) NOT NULL,
  `TEMPS` varchar(255) NOT NULL,
  `PLACE` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `resultat`
--

INSERT INTO `resultat` (`ID`, `TITRE`, `DOSSARD`, `TEMPS`, `PLACE`) VALUES
(1, 'TripleSaut(H)', 30, '1&quot;50&quot;00', '2'),
(2, 'TripleSaut(H)', 33, '1&quot;50&quot;20', '1'),
(3, '200(F)', 88, '1&quot;20&quot;40', '3'),
(4, '200(F)', 26, '1&quot;20&quot;50', '1'),
(5, '200(F)', 12, '1&quot;20&quot;20', '2'),
(6, '800(F)', 44, '1&quot;54&quot;40', '2'),
(7, '800(F)', 124, '1&quot;54&quot;00', '4');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USER` (`USER`);

--
-- Index pour la table `commissaire`
--
ALTER TABLE `commissaire`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USER` (`USER`);

--
-- Index pour la table `commissairecourse`
--
ALTER TABLE `commissairecourse`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `COURSE` (`COURSE`);

--
-- Index pour la table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `TITRE` (`TITRE`);

--
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `DOSSARD` (`DOSSARD`);

--
-- Index pour la table `recordcourse`
--
ALTER TABLE `recordcourse`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `COURSE` (`COURSE`);

--
-- Index pour la table `resultat`
--
ALTER TABLE `resultat`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `DOSSARD` (`DOSSARD`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `commissaire`
--
ALTER TABLE `commissaire`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `commissairecourse`
--
ALTER TABLE `commissairecourse`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `course`
--
ALTER TABLE `course`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `recordcourse`
--
ALTER TABLE `recordcourse`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `resultat`
--
ALTER TABLE `resultat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
