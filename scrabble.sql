-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2022 at 09:03 PM
-- Server version: 8.0.29
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scrabble`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE `administrateur` (
  `id` int NOT NULL,
  `id_membre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`id`, `id_membre`) VALUES
(30, 1000021);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ageMin` int DEFAULT NULL,
  `ageMax` int DEFAULT NULL
) ;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `ageMin`, `ageMax`) VALUES
(1, 'Rubis', 83, NULL),
(2, 'Diamants', 73, 82),
(3, 'Vermeils', 63, 72),
(4, 'Séniors', 26, 62),
(5, 'Espoirs', 18, 25),
(6, 'Juniors', 16, 17),
(7, 'Cadets', 13, 15),
(8, 'Benjamins', 11, 12);

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `id` int NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `codePostal` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `localite` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rue` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `responsable` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`id`, `nom`, `codePostal`, `localite`, `rue`, `responsable`) VALUES
(5, 'Scrabble legends', '1000', 'Brussels', 'Rue', 1000021),
(6, 'Scrabble prof', '1410', 'Waterloo', 'Rue de examen', 1000021),
(7, 'Scrabble amateurs', '4700', 'Eupen', 'Rue de Liege', 1000022),
(8, 'Scrabble nanies', '2000', 'Antwerpen', 'Rue de club', 1000023);

-- --------------------------------------------------------

--
-- Table structure for table `judgearbitre`
--

CREATE TABLE `judgearbitre` (
  `id` int NOT NULL,
  `id_membre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `judgearbitre`
--

INSERT INTO `judgearbitre` (`id`, `id_membre`) VALUES
(5, 1000020);

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE `membre` (
  `id` int NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `codePostal` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `localite` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rue` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gsm` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dateDeNaissance` date NOT NULL,
  `serie` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categorie` int DEFAULT NULL,
  `codeClub` int DEFAULT NULL,
  `totalPointsSaison` int DEFAULT NULL,
  `moteDePass` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `codePostal`, `localite`, `rue`, `gsm`, `dateDeNaissance`, `serie`, `categorie`, `codeClub`, `totalPointsSaison`, `moteDePass`, `email`) VALUES
(1000019, 'Verstappen', 'Max', '4700', 'Eupen', 'Herbestal', '0487123456', '1992-06-03', 'Serie', 1, 5, 0, '123456', 't1@t.com'),
(1000021, 'Leclerc', 'Charles', '4000', 'Antwerpen', 'Herbestal', '0487123456', '1992-06-03', 'serie', 1, 6, 0, '123456', 't3@t.com'),
(1000022, 'Russell', 'Geuorge', '4400', 'Ketenis', 'Herbestal', '0487123456', '1992-06-03', 'Serie', 1, 6, 0, '123456', 't4@t.com'),
(1000023, 'Sainz', 'Carlos', '4800', 'Raeren', 'Herbestal', '0487123456', '1992-06-03', 'Serie', 2, 8, 0, '123456', 't5@t.com');

-- --------------------------------------------------------

--
-- Table structure for table `participer`
--

CREATE TABLE `participer` (
  `id` int NOT NULL,
  `id_membre` int NOT NULL,
  `score` int DEFAULT NULL,
  `id_turnoi` int NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `turnoi`
--

CREATE TABLE `turnoi` (
  `id` int NOT NULL,
  `turnoiCode` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  `dtturnoi` date DEFAULT NULL,
  `nomCategorie` int NOT NULL,
  `codeClub` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responsable` (`responsable`);

--
-- Indexes for table `judgearbitre`
--
ALTER TABLE `judgearbitre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codeClub` (`codeClub`);

--
-- Indexes for table `participer`
--
ALTER TABLE `participer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `turnoi`
--
ALTER TABLE `turnoi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codeClub` (`codeClub`),
  ADD KEY `nomCategorie` (`nomCategorie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `judgearbitre`
--
ALTER TABLE `judgearbitre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participer`
--
ALTER TABLE `participer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `turnoi`
--
ALTER TABLE `turnoi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`);

--
-- Constraints for table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ibfk_1` FOREIGN KEY (`responsable`) REFERENCES `membre` (`id`);

--
-- Constraints for table `turnoi`
--
ALTER TABLE `turnoi`
  ADD CONSTRAINT `turnoi_ibfk_1` FOREIGN KEY (`codeClub`) REFERENCES `club` (`id`),
  ADD CONSTRAINT `turnoi_ibfk_2` FOREIGN KEY (`nomCategorie`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
