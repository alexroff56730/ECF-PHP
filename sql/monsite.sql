-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 28 sep. 2022 à 16:12
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `monsite`
--

-- --------------------------------------------------------

--
-- Structure de la table `musique`
--

CREATE DATABASE IF NOT EXISTS `monsite`;

USE `monsite`;

CREATE TABLE `musique` (
  `id` int(11) NOT NULL,
  `Nom` char(25) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Musique` blob NOT NULL,
  `PseudoUser` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Nom` char(25) NOT NULL,
  `Prenom` char(25) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Pseudo` char(25) NOT NULL,
  `Mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `Nom`, `Prenom`, `Mail`, `Pseudo`, `Mdp`) VALUES
(1, 'ROFFIAEN', 'Alexandre', 'alexandreroffiaen@gmail.com', 'aroff56', '$2y$10$LH8iU72UJxS7QbwynYMSNuRemzIGGtv/JFIhlGfUjfaR3TGZTwSpC');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `musique`
--
ALTER TABLE `musique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `musique`
--
ALTER TABLE `musique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
