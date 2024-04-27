-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 31 mars 2024 à 22:38
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetdev`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre_projet`
--

CREATE TABLE `membre_projet` (
  `id_membreP` int(11) NOT NULL,
  `nom_p` varchar(50) NOT NULL,
  `prenom_p` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membre_tache`
--

CREATE TABLE `membre_tache` (
  `id_membreT` int(11) NOT NULL,
  `nom_t` varchar(50) NOT NULL,
  `prenom_t` varchar(50) NOT NULL,
  `id_tache` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `progression` varchar(50) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `priorite` varchar(50) NOT NULL,
  `proprietaire` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id_projet`, `nom`, `progression`, `date_debut`, `date_fin`, `priorite`, `proprietaire`) VALUES
(1, 'java', 'moyenne', '2024-03-01', '2024-03-03', 'Normale', 'Arij'),
(2, 'web', 'faible', '2024-02-29', '2024-03-07', 'normale', 'Ameni'),
(3, 'mobile', 'Terminé', '2024-02-26', '2024-03-03', 'Elevée', 'Arij'),
(4, 'symfony', 'faible', '2024-03-02', '2024-03-09', 'normale', 'asma'),
(5, 'qsdf', 'sdfgh', '2024-03-02', '2024-03-03', 'fghjn', 'sesdfg');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id_tache` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `assigne` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `priorite` varchar(50) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `id_projet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`id_tache`, `nom`, `assigne`, `date`, `priorite`, `statut`, `id_projet`) VALUES
(1, 'crud', 'arij', '2024-03-03', 'elevée', 'a faire', 1),
(2, 'metier', 'ahlem', '2024-03-02', 'Normale', 'complet', 2),
(3, 'API', 'asma', '2024-03-02', 'Normale', 'complet', 1),
(4, 'crudd', 'ameni', '2024-03-01', 'elevée', 'complet', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `membre_projet`
--
ALTER TABLE `membre_projet`
  ADD PRIMARY KEY (`id_membreP`),
  ADD KEY `id_projet` (`id_projet`);

--
-- Index pour la table `membre_tache`
--
ALTER TABLE `membre_tache`
  ADD PRIMARY KEY (`id_membreT`),
  ADD KEY `id_tache` (`id_tache`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id_tache`),
  ADD KEY `id_projet` (`id_projet`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `membre_projet`
--
ALTER TABLE `membre_projet`
  MODIFY `id_membreP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre_tache`
--
ALTER TABLE `membre_tache`
  MODIFY `id_membreT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id_tache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `membre_projet`
--
ALTER TABLE `membre_projet`
  ADD CONSTRAINT `membre_projet_ibfk_1` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `membre_tache`
--
ALTER TABLE `membre_tache`
  ADD CONSTRAINT `membre_tache_ibfk_1` FOREIGN KEY (`id_tache`) REFERENCES `tache` (`id_tache`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
