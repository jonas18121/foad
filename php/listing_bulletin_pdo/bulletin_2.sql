-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 17 déc. 2020 à 13:02
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bulletin`
--
CREATE DATABASE `bulletin`;
-- --------------------------------------------------------

--
-- Structure de la table `devoir`
--

CREATE TABLE `devoir` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_publication` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `devoir`
--

INSERT INTO `devoir` (`id`, `titre`, `contenu`, `date_publication`) VALUES
(1, 'améliorer un code existant avec les nouveaux concepts 2', 'Pour un professe​ur des écoles, vous devez créer un `listing de ses élèves afin ​de réaliser le bulletin scolaire`.', '2020-12-17 10:35:13'),
(2, 'devoir 2', 'contenu devoir 2', '2020-12-17 10:35:13'),
(3, 'devoir 3', 'contenu devoir 3', '2020-12-17 10:35:13'),
(4, 'devoir 4', 'contenu devoir 4', '2020-12-17 10:35:13'),
(5, 'devoir 5', 'contenu devoir 5', '2020-12-17 10:35:13'),
(6, 'devoir 6', 'contenu devoir 6', '2020-12-17 10:35:13'),
(7, 'Devoir 7', 'Contenu du devoir 7', '2020-12-17 11:14:46');

-- --------------------------------------------------------

--
-- Structure de la table `devoir_eleve`
--

CREATE TABLE `devoir_eleve` (
  `id` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL,
  `id_devoir` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `devoir_eleve`
--

INSERT INTO `devoir_eleve` (`id`, `note`, `id_eleve`, `id_devoir`) VALUES
(1, 19, 1, 1),
(2, 14, 1, 2),
(3, 13, 3, 1),
(4, 11, 3, 2),
(5, 10, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naissance` datetime NOT NULL,
  `moyenne` int(11) NOT NULL,
  `appreciation` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `date_naissance`, `moyenne`, `appreciation`) VALUES
(1, 'merde', 'jean', '2000-10-30 00:00:00', 17, 'waou'),
(13, 'maité', 'maité', '2019-01-20 00:00:00', 1, 'trop jeune'),
(3, 'ardu', 'coline', '2000-02-20 00:00:00', 20, 'tres bon eleve'),
(8, 'anna', 'kati', '2000-12-31 00:00:00', 19, 'bravo le veau'),
(9, 'kha', 'alain', '2000-11-30 00:00:00', 19, 'bravo , un bon kha alain pour toi'),
(12, 'mika', 'mika', '2000-10-11 00:00:00', 19, 'bonne');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `devoir`
--
ALTER TABLE `devoir`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `devoir_eleve`
--
ALTER TABLE `devoir_eleve`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `devoir`
--
ALTER TABLE `devoir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `devoir_eleve`
--
ALTER TABLE `devoir_eleve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
