-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 31 jan. 2025 à 12:09
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `adjedjm_basket`
--

-- --------------------------------------------------------

--
-- Structure de la table `ACCEDER`
--

CREATE TABLE `ACCEDER` (
  `idPage` int(11) NOT NULL,
  `idRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ACCEDER`
--

INSERT INTO `ACCEDER` (`idPage`, `idRole`) VALUES
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(7, 6),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(10, 6),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(11, 6),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(12, 5),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(13, 5),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(15, 1),
(15, 2),
(15, 3),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(17, 5),
(17, 6);

-- --------------------------------------------------------

--
-- Structure de la table `DISPOSER`
--

CREATE TABLE `DISPOSER` (
  `idRole` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `DISPOSER`
--

INSERT INTO `DISPOSER` (`idRole`, `User_ID`) VALUES
(1, 1),
(3, 3),
(6, 7);

-- --------------------------------------------------------

--
-- Structure de la table `Entrainement`
--

CREATE TABLE `Entrainement` (
  `EntrainementID` int(11) NOT NULL,
  `DateEntrainement` datetime NOT NULL,
  `Duree` time NOT NULL,
  `TypeEntrainement` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Entrainement`
--

INSERT INTO `Entrainement` (`EntrainementID`, `DateEntrainement`, `Duree`, `TypeEntrainement`) VALUES
(1, '2025-01-18 14:00:00', '00:00:04', 'Shooting Workout'),
(2, '2025-01-19 09:30:00', '00:00:02', 'Driblling Workout'),
(3, '2025-01-19 15:00:00', '00:00:01', 'Running Workout'),
(4, '2025-01-21 14:00:00', '00:00:03', 'Free Practice');

-- --------------------------------------------------------

--
-- Structure de la table `Equipe`
--

CREATE TABLE `Equipe` (
  `EquipeID` int(11) NOT NULL,
  `NomEquipe` varchar(100) NOT NULL,
  `Ville` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Equipe`
--

INSERT INTO `Equipe` (`EquipeID`, `NomEquipe`, `Ville`) VALUES
(1, 'Boston Celtics', 'Boston'),
(2, 'Golden State Warriors', 'San Francisco'),
(3, 'Los Angeles Lakers', 'Los Angeles'),
(4, 'Cleveland Cavaliers', 'Cleveland'),
(5, 'Milwaukee Bucks', 'Milwaukee'),
(6, 'Denver Nuggets', 'Denver'),
(7, 'Phoenix Suns', 'Phoenix'),
(8, 'Dallas Mavericks', 'Dallas'),
(9, 'Miami Heat', 'Miami'),
(10, 'San Antonio Spurs', 'San Antonio');

-- --------------------------------------------------------

--
-- Structure de la table `JOUER`
--

CREATE TABLE `JOUER` (
  `RencontreID` int(11) NOT NULL,
  `EquipeID` int(11) NOT NULL,
  `Score` int(255) DEFAULT NULL,
  `EST_GAGNANT` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `JOUER`
--

INSERT INTO `JOUER` (`RencontreID`, `EquipeID`, `Score`, `EST_GAGNANT`) VALUES
(1, 1, NULL, 1),
(1, 2, NULL, 0),
(2, 3, NULL, 0),
(2, 4, NULL, 1),
(3, 5, NULL, -1),
(3, 6, NULL, -1),
(4, 7, NULL, 0),
(4, 8, NULL, 1),
(5, 9, NULL, 1),
(5, 10, NULL, 0),
(6, 1, NULL, 1),
(6, 8, NULL, 0),
(7, 1, NULL, 0),
(7, 2, NULL, 1),
(8, 2, NULL, 0),
(8, 3, NULL, 1),
(9, 4, NULL, 1),
(9, 8, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Membre`
--

CREATE TABLE `Membre` (
  `MembreID` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `DateNaissance` date NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `NumeroMaillot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Membre`
--

INSERT INTO `Membre` (`MembreID`, `Nom`, `Prenom`, `DateNaissance`, `Role`, `Email`, `NumeroMaillot`) VALUES
(1, 'Tatum', 'Jayson', '1998-03-03', 'Small Forward', 'jayson.tatum@celtics.com', 0),
(2, 'Brown', 'Jaylen', '1996-10-24', 'Shooting Guard', 'jaylen.brown@celtics.com', 7),
(3, 'Horford', 'Al', '1986-06-03', 'Center', 'al.horford@celtics.com', 42),
(4, 'White', 'Derrick', '1994-07-02', 'Point Guard', 'derrick.white@celtics.com', 9),
(5, 'Holiday', 'Jrue', '1990-06-12', 'Point Guard', 'jrue.holiday@celtics.com', 21),
(6, 'Curry', 'Stephen', '1988-03-14', 'Point Guard', 'stephen.curry@warriors.com', 30),
(7, 'Thompson', 'Klay', '1990-02-08', 'Shooting Guard', 'klay.thompson@warriors.com', 11),
(8, 'Green', 'Draymond', '1990-03-04', 'Power Forward', 'draymond.green@warriors.com', 23),
(9, 'Wiggins', 'Andrew', '1995-02-23', 'Small Forward', 'andrew.wiggins@warriors.com', 22),
(10, 'Looney', 'Kevon', '1996-02-06', 'Center', 'kevon.looney@warriors.com', 5),
(11, 'James', 'LeBron', '1984-12-30', 'Small Forward', 'lebron.james@lakers.com', 6),
(12, 'Davis', 'Anthony', '1993-03-11', 'Power Forward', 'anthony.davis@lakers.com', 3),
(13, 'Russell', 'DAngelo', '1996-02-23', 'Point Guard', 'dangelo.russell@lakers.com', 1),
(14, 'Reaves', 'Austin', '1998-05-29', 'Shooting Guard', 'austin.reaves@lakers.com', 15),
(15, 'Hachimura', 'Rui', '1998-02-08', 'Small Forward', 'rui.hachimura@lakers.com', 28),
(16, 'Mitchell', 'Donovan', '1996-09-07', 'Shooting Guard', 'donovan.mitchell@cavs.com', 45),
(17, 'Garland', 'Darius', '2000-01-26', 'Point Guard', 'darius.garland@cavs.com', 10),
(18, 'Mobley', 'Evan', '2001-06-18', 'Power Forward', 'evan.mobley@cavs.com', 4),
(19, 'Allen', 'Jarrett', '1998-04-21', 'Center', 'jarrett.allen@cavs.com', 31),
(20, 'Okoro', 'Isaac', '2001-01-26', 'Small Forward', 'isaac.okoro@cavs.com', 35),
(21, 'Antetokounmpo', 'Giannis', '1994-12-06', 'Power Forward', 'giannis.antetokounmpo@bucks.com', 34),
(22, 'Middleton', 'Khris', '1991-08-12', 'Small Forward', 'khris.middleton@bucks.com', 22),
(23, 'Lopez', 'Brook', '1988-04-01', 'Center', 'brook.lopez@bucks.com', 11),
(24, 'Holiday', 'Jrue', '1990-06-12', 'Point Guard', 'jrue.holiday@bucks.com', 21),
(25, 'Portis', 'Bobby', '1995-02-10', 'Power Forward', 'bobby.portis@bucks.com', 9),
(26, 'Jokić', 'Nikola', '1995-02-19', 'Center', 'nikola.jokic@nuggets.com', 15),
(27, 'Murray', 'Jamal', '1997-02-23', 'Point Guard', 'jamal.murray@nuggets.com', 27),
(28, 'Porter', 'Michael', '1998-06-29', 'Small Forward', 'michael.porter@nuggets.com', 1),
(29, 'Gordon', 'Aaron', '1995-09-16', 'Power Forward', 'aaron.gordon@nuggets.com', 50),
(30, 'Caldwell-Pope', 'Kentavious', '1993-02-18', 'Shooting Guard', 'kentavious.caldwellpope@nuggets.com', 5),
(31, 'Booker', 'Devin', '1996-10-30', 'Shooting Guard', 'devin.booker@suns.com', 1),
(32, 'Durant', 'Kevin', '1988-09-29', 'Small Forward', 'kevin.durant@suns.com', 35),
(33, 'Beal', 'Bradley', '1993-06-28', 'Shooting Guard', 'bradley.beal@suns.com', 3),
(34, 'Ayton', 'Deandre', '1998-07-23', 'Center', 'deandre.ayton@suns.com', 22),
(35, 'Gordon', 'Eric', '1988-12-25', 'Shooting Guard', 'eric.gordon@suns.com', 10),
(36, 'Doncic', 'Luka', '1999-02-28', 'Point Guard', 'luka.doncic@mavs.com', 77),
(37, 'Irving', 'Kyrie', '1992-03-23', 'Point Guard', 'kyrie.irving@mavs.com', 2),
(38, 'Green', 'Josh', '2000-11-16', 'Small Forward', 'josh.green@mavs.com', 8),
(39, 'Hardaway', 'Tim', '1992-03-16', 'Shooting Guard', 'tim.hardaway@mavs.com', 10),
(40, 'Powell', 'Dwight', '1991-07-20', 'Center', 'dwight.powell@mavs.com', 7),
(41, 'Butler', 'Jimmy', '1989-09-14', 'Small Forward', 'jimmy.butler@heat.com', 22),
(42, 'Adebayo', 'Bam', '1997-07-18', 'Center', 'bam.adebayo@heat.com', 13),
(43, 'Herro', 'Tyler', '2000-01-20', 'Shooting Guard', 'tyler.herro@heat.com', 14),
(44, 'Lowry', 'Kyle', '1986-03-25', 'Point Guard', 'kyle.lowry@heat.com', 7),
(45, 'Love', 'Kevin', '1988-09-07', 'Power Forward', 'kevin.love@heat.com', 42),
(46, 'Wembanyama', 'Victor', '2004-01-04', 'Center', 'victor.wembanyama@spurs.com', 1),
(47, 'Vassell', 'Devin', '2000-08-23', 'Shooting Guard', 'devin.vassell@spurs.com', 24),
(48, 'Johnson', 'Keldon', '1999-10-11', 'Small Forward', 'keldon.johnson@spurs.com', 3),
(49, 'Sochan', 'Jeremy', '2003-05-20', 'Power Forward', 'jeremy.sochan@spurs.com', 10),
(50, 'Jones', 'Tre', '2000-01-08', 'Point Guard', 'tre.jones@spurs.com', 33);

-- --------------------------------------------------------

--
-- Structure de la table `MembresEquipe`
--

CREATE TABLE `MembresEquipe` (
  `EquipeID` int(11) NOT NULL,
  `MembreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `MembresEquipe`
--

INSERT INTO `MembresEquipe` (`EquipeID`, `MembreID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(5, 21),
(5, 22),
(5, 23),
(5, 24),
(5, 25),
(6, 26),
(6, 27),
(6, 28),
(6, 29),
(6, 30),
(7, 31),
(7, 32),
(7, 33),
(7, 34),
(7, 35),
(8, 36),
(8, 37),
(8, 38),
(8, 39),
(8, 40),
(9, 41),
(9, 42),
(9, 43),
(9, 44),
(9, 45),
(10, 46),
(10, 47),
(10, 48),
(10, 49),
(10, 50);

-- --------------------------------------------------------

--
-- Structure de la table `PAGE`
--

CREATE TABLE `PAGE` (
  `idPage` int(11) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `NomPage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `PAGE`
--

INSERT INTO `PAGE` (`idPage`, `Description`, `NomPage`) VALUES
(3, 'Menu + Login page', 'index.php'),
(4, 'Account creation.', 'creation.php'),
(5, 'Disconnection', 'disconnect.php'),
(6, 'Password recovery', 'forgotpassword.php'),
(7, 'Password modification', 'getpassword.php'),
(8, 'Chart of the games.', 'gamechart.php'),
(9, 'Stats of the players', 'playerstats.php'),
(10, 'Team stats and details.', 'tdetails.php'),
(11, 'List of the teams with general information', 'teams.php'),
(12, 'Workout details', 'wdetails.php'),
(13, 'Workout attendants', 'participants.php'),
(14, 'Add players to a workout.', 'workout.php'),
(15, 'Workout creation', 'createworkout.php'),
(16, 'Add and manage games.', 'gamemanage.php'),
(17, 'Performance in mathches', 'performance.php');

-- --------------------------------------------------------

--
-- Structure de la table `PARTICIPER`
--

CREATE TABLE `PARTICIPER` (
  `EntrainementID` int(11) NOT NULL,
  `MembreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `PARTICIPER`
--

INSERT INTO `PARTICIPER` (`EntrainementID`, `MembreID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 14),
(2, 15),
(3, 11),
(3, 12),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20);

-- --------------------------------------------------------

--
-- Structure de la table `PERFORMANCE`
--

CREATE TABLE `PERFORMANCE` (
  `MembreID` int(11) NOT NULL,
  `RencontreID` int(11) NOT NULL,
  `Points` int(11) DEFAULT NULL,
  `Assists` int(11) DEFAULT NULL,
  `Rebonds` int(11) DEFAULT NULL,
  `MinutesJouees` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `PERFORMANCE`
--

INSERT INTO `PERFORMANCE` (`MembreID`, `RencontreID`, `Points`, `Assists`, `Rebonds`, `MinutesJouees`) VALUES
(1, 1, 30, 7, 7, 40),
(1, 6, 40, 13, 8, 40),
(1, 7, 8, 15, 12, 40),
(2, 1, 19, 16, 5, 40),
(2, 6, 21, 11, 6, 40),
(2, 7, 14, 8, 7, 40),
(3, 1, 18, 18, 14, 40),
(3, 6, 22, 8, 7, 40),
(3, 7, 11, 5, 13, 40),
(4, 1, 26, 8, 6, 40),
(4, 6, 12, 14, 15, 40),
(4, 7, 36, 2, 4, 40),
(5, 1, 9, 2, 12, 40),
(5, 6, 16, 11, 13, 40),
(5, 7, 37, 8, 20, 40),
(6, 1, 13, 5, 20, 40),
(6, 7, 22, 7, 17, 40),
(6, 8, 28, 3, 1, 40),
(7, 1, 31, 17, 10, 40),
(7, 7, 6, 12, 6, 40),
(7, 8, 21, 14, 3, 40),
(8, 1, 20, 14, 4, 40),
(8, 7, 29, 5, 6, 40),
(8, 8, 10, 4, 12, 40),
(9, 1, 2, 1, 4, 40),
(9, 7, 6, 9, 1, 40),
(9, 8, 7, 20, 9, 40),
(10, 1, 34, 9, 5, 40),
(10, 7, 38, 10, 19, 40),
(10, 8, 25, 14, 15, 40),
(11, 2, 8, 6, 14, 40),
(11, 8, 20, 1, 16, 40),
(12, 2, 18, 12, 14, 40),
(12, 8, 9, 7, 1, 40),
(13, 2, 0, 15, 16, 40),
(13, 8, 10, 20, 20, 40),
(14, 2, 37, 20, 4, 40),
(14, 8, 14, 20, 5, 40),
(15, 2, 8, 13, 14, 40),
(15, 8, 13, 4, 14, 40),
(16, 2, 3, 20, 16, 40),
(16, 9, 32, 10, 17, 40),
(17, 2, 19, 18, 13, 40),
(17, 9, 7, 11, 8, 40),
(18, 2, 18, 9, 1, 40),
(18, 9, 12, 20, 1, 40),
(19, 2, 26, 3, 20, 40),
(19, 9, 34, 4, 6, 40),
(20, 2, 25, 5, 3, 40),
(20, 9, 22, 8, 20, 40),
(21, 3, 25, 3, 16, 40),
(22, 3, 23, 18, 8, 40),
(23, 3, 12, 13, 9, 40),
(24, 3, 34, 3, 5, 40),
(25, 3, 34, 8, 4, 40),
(26, 3, 33, 14, 10, 40),
(27, 3, 30, 4, 12, 40),
(28, 3, 21, 7, 4, 40),
(29, 3, 28, 5, 15, 40),
(30, 3, 7, 20, 19, 40),
(31, 4, 14, 17, 16, 40),
(32, 4, 40, 16, 11, 40),
(33, 4, 34, 16, 18, 40),
(34, 4, 14, 11, 2, 40),
(35, 4, 7, 4, 19, 40),
(36, 4, 5, 17, 12, 40),
(36, 6, 3, 9, 16, 40),
(36, 9, 6, 15, 1, 40),
(37, 4, 15, 20, 5, 40),
(37, 6, 14, 15, 15, 40),
(37, 9, 18, 3, 15, 40),
(38, 4, 28, 19, 15, 40),
(38, 6, 28, 17, 3, 40),
(38, 9, 9, 5, 7, 40),
(39, 4, 36, 4, 4, 40),
(39, 6, 2, 3, 14, 40),
(39, 9, 39, 10, 4, 40),
(40, 4, 32, 4, 8, 40),
(40, 6, 16, 8, 6, 40),
(40, 9, 18, 7, 8, 40),
(41, 5, 16, 17, 17, 40),
(42, 5, 31, 20, 8, 40),
(43, 5, 24, 18, 20, 40),
(44, 5, 10, 4, 5, 40),
(45, 5, 0, 12, 12, 40),
(46, 5, 10, 2, 11, 40),
(47, 5, 28, 5, 7, 40),
(48, 5, 21, 9, 8, 40),
(49, 5, 21, 1, 1, 40),
(50, 5, 12, 17, 13, 40);

-- --------------------------------------------------------

--
-- Structure de la table `Rencontre`
--

CREATE TABLE `Rencontre` (
  `RencontreID` int(11) NOT NULL,
  `DateRencontre` datetime NOT NULL,
  `ScoreEquipe1` int(11) DEFAULT NULL,
  `ScoreEquipe2` int(11) DEFAULT NULL,
  `Lieu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Rencontre`
--

INSERT INTO `Rencontre` (`RencontreID`, `DateRencontre`, `ScoreEquipe1`, `ScoreEquipe2`, `Lieu`) VALUES
(1, '2024-10-13 18:00:00', 127, 105, 'Boston'),
(2, '2024-10-16 12:00:00', 90, 105, 'Cleveland'),
(3, '2024-11-05 09:00:00', 109, 109, 'Denver'),
(4, '2024-11-25 19:00:00', 125, 130, 'Phoenix'),
(5, '2024-11-29 15:00:00', 110, 85, 'Miami'),
(6, '2024-12-01 13:00:00', 130, 105, 'Boston'),
(7, '2024-12-03 21:00:00', 106, 120, 'San Francisco'),
(8, '2024-12-29 18:06:00', 110, 118, 'Los Angeles'),
(9, '2024-12-30 18:00:00', 135, 90, 'Cleveland');

-- --------------------------------------------------------

--
-- Structure de la table `ROLE`
--

CREATE TABLE `ROLE` (
  `idRole` int(11) NOT NULL,
  `NomRole` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ROLE`
--

INSERT INTO `ROLE` (`idRole`, `NomRole`, `Description`) VALUES
(1, 'Admin', 'Administrateur de l\'application.'),
(2, 'Manager', 'Peut accéder a la partie management des jeux.'),
(3, 'Coach', 'Peut créer et ajouter des jouers aux entraînements. '),
(4, 'Assistant', 'Peut ajouter des jouers dans des entrainement et les consulter'),
(5, 'Jouer', 'Peut consulter les entraînement '),
(6, 'Utilistateur', 'Peut seulement consulter les matches et les equipes + statistiques.');

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `User_ID` int(20) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Code` varchar(255) DEFAULT NULL,
  `DateExp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`User_ID`, `Login`, `Password`, `Mail`, `Code`, `DateExp`) VALUES
(1, 'Admin', '$2y$10$axFJTj50rLwv6B09u4hpLOPoLvyxZWjMCvC7K.XW6O4jQyG3djthq', 'adjedjm@saintjo.org', NULL, NULL),
(2, 'Usere5', '$2y$10$qtABqG7dOvAMSvbbdcmPnOm6S5YBedvDHydekxGAud2rVuWcnw8hy', 'adjedjm@saintjo.org', NULL, NULL),
(3, 'Coach_Merlin', '$2y$10$mal3GH7L2R6AfKekBEfAm.EZWBieu/cU.piCnS6X1pai6OsvWYdaC', 'Lecoachmerlinlegoat@gmail.goat', NULL, NULL),
(4, 'Patrick', '$2y$10$OEUN5CJh26RvOSZK3/xJ6.I9g.fTve.SLf7LvJ1q1JOjwRQcHBGfy', 'Patrickmichelin@michelin.michelin', NULL, NULL),
(5, 'Jean', '$2y$10$BPUmnXncBsIz0WJk/IbIDu4yjNyAp9829.35bHhPbmwuR5O9VoMWu', 'jeanpatrick@patrick@patrick', NULL, NULL),
(6, 'test', '$2y$10$bqmspuEGmP.FsXbZJ5kJvuEA3X2PaCaQd9til4yBnFARBJZH8P2mS', 'test@test.com', NULL, NULL),
(7, 'Popo', '$2y$10$iHmclFtWSFF/hB3pMKiCo.G9z9p5V69mwJaf6DvqAo1Z1NIz/BKBC', 'Popo@gmail.net', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ACCEDER`
--
ALTER TABLE `ACCEDER`
  ADD PRIMARY KEY (`idPage`,`idRole`),
  ADD KEY `idRole` (`idRole`);

--
-- Index pour la table `DISPOSER`
--
ALTER TABLE `DISPOSER`
  ADD PRIMARY KEY (`idRole`,`User_ID`),
  ADD KEY `idUtilisateur` (`User_ID`);

--
-- Index pour la table `Entrainement`
--
ALTER TABLE `Entrainement`
  ADD PRIMARY KEY (`EntrainementID`);

--
-- Index pour la table `Equipe`
--
ALTER TABLE `Equipe`
  ADD PRIMARY KEY (`EquipeID`);

--
-- Index pour la table `JOUER`
--
ALTER TABLE `JOUER`
  ADD PRIMARY KEY (`RencontreID`,`EquipeID`),
  ADD KEY `JOUER_Equipe0_FK` (`EquipeID`);

--
-- Index pour la table `Membre`
--
ALTER TABLE `Membre`
  ADD PRIMARY KEY (`MembreID`);

--
-- Index pour la table `MembresEquipe`
--
ALTER TABLE `MembresEquipe`
  ADD PRIMARY KEY (`EquipeID`,`MembreID`),
  ADD KEY `MembresEquipe_Membre0_FK` (`MembreID`);

--
-- Index pour la table `PAGE`
--
ALTER TABLE `PAGE`
  ADD PRIMARY KEY (`idPage`),
  ADD UNIQUE KEY `PAGE_AK` (`NomPage`);

--
-- Index pour la table `PARTICIPER`
--
ALTER TABLE `PARTICIPER`
  ADD PRIMARY KEY (`EntrainementID`,`MembreID`),
  ADD KEY `PARTICIPER_Membre0_FK` (`MembreID`);

--
-- Index pour la table `PERFORMANCE`
--
ALTER TABLE `PERFORMANCE`
  ADD PRIMARY KEY (`MembreID`,`RencontreID`),
  ADD KEY `PERFORMANCE_Rencontre0_FK` (`RencontreID`);

--
-- Index pour la table `Rencontre`
--
ALTER TABLE `Rencontre`
  ADD PRIMARY KEY (`RencontreID`);

--
-- Index pour la table `ROLE`
--
ALTER TABLE `ROLE`
  ADD PRIMARY KEY (`idRole`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Entrainement`
--
ALTER TABLE `Entrainement`
  MODIFY `EntrainementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Equipe`
--
ALTER TABLE `Equipe`
  MODIFY `EquipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Membre`
--
ALTER TABLE `Membre`
  MODIFY `MembreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `PAGE`
--
ALTER TABLE `PAGE`
  MODIFY `idPage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `Rencontre`
--
ALTER TABLE `Rencontre`
  MODIFY `RencontreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `ROLE`
--
ALTER TABLE `ROLE`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `User_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ACCEDER`
--
ALTER TABLE `ACCEDER`
  ADD CONSTRAINT `pj_ACCEDER_ibfk_1` FOREIGN KEY (`idPage`) REFERENCES `PAGE` (`idPage`),
  ADD CONSTRAINT `pj_ACCEDER_ibfk_2` FOREIGN KEY (`idRole`) REFERENCES `ROLE` (`idRole`);

--
-- Contraintes pour la table `DISPOSER`
--
ALTER TABLE `DISPOSER`
  ADD CONSTRAINT `DISPOSER_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `ROLE` (`idRole`),
  ADD CONSTRAINT `DISPOSER_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`User_ID`);

--
-- Contraintes pour la table `JOUER`
--
ALTER TABLE `JOUER`
  ADD CONSTRAINT `JOUER_Equipe0_FK` FOREIGN KEY (`EquipeID`) REFERENCES `Equipe` (`EquipeID`),
  ADD CONSTRAINT `JOUER_Rencontre_FK` FOREIGN KEY (`RencontreID`) REFERENCES `Rencontre` (`RencontreID`);

--
-- Contraintes pour la table `MembresEquipe`
--
ALTER TABLE `MembresEquipe`
  ADD CONSTRAINT `MembresEquipe_Equipe_FK` FOREIGN KEY (`EquipeID`) REFERENCES `Equipe` (`EquipeID`),
  ADD CONSTRAINT `MembresEquipe_Membre0_FK` FOREIGN KEY (`MembreID`) REFERENCES `Membre` (`MembreID`);

--
-- Contraintes pour la table `PARTICIPER`
--
ALTER TABLE `PARTICIPER`
  ADD CONSTRAINT `PARTICIPER_Entrainement_FK` FOREIGN KEY (`EntrainementID`) REFERENCES `Entrainement` (`EntrainementID`),
  ADD CONSTRAINT `PARTICIPER_Membre0_FK` FOREIGN KEY (`MembreID`) REFERENCES `Membre` (`MembreID`);

--
-- Contraintes pour la table `PERFORMANCE`
--
ALTER TABLE `PERFORMANCE`
  ADD CONSTRAINT `PERFORMANCE_Membre_FK` FOREIGN KEY (`MembreID`) REFERENCES `Membre` (`MembreID`),
  ADD CONSTRAINT `PERFORMANCE_Rencontre0_FK` FOREIGN KEY (`RencontreID`) REFERENCES `Rencontre` (`RencontreID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
