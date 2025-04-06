-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2025 at 03:29 PM
-- Server version: 10.11.11-MariaDB-0+deb12u1
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adjedjm_basket`
--

-- --------------------------------------------------------

--
-- Table structure for table `Acceder`
--

CREATE TABLE `Acceder` (
  `PageID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Acceder`
--

INSERT INTO `Acceder` (`PageID`, `RoleID`) VALUES
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
(17, 6),
(18, 1),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(22, 1),
(22, 2),
(22, 3),
(22, 4),
(22, 5),
(22, 6),
(23, 1),
(23, 2),
(24, 1),
(24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Disposer`
--

CREATE TABLE `Disposer` (
  `RoleID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Disposer`
--

INSERT INTO `Disposer` (`RoleID`, `UserID`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `Entrainement`
--

CREATE TABLE `Entrainement` (
  `EntrainementID` int(11) NOT NULL,
  `DateEntrainement` datetime NOT NULL,
  `Duree` time NOT NULL,
  `TypeEntrainement` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Entrainement`
--

INSERT INTO `Entrainement` (`EntrainementID`, `DateEntrainement`, `Duree`, `TypeEntrainement`) VALUES
(1, '2025-04-08 16:00:00', '00:00:03', 'Shooting Workout'),
(2, '2025-04-09 17:00:00', '00:00:01', 'Driblling Workout'),
(3, '2025-10-04 16:00:00', '00:00:04', 'Conditioning');

-- --------------------------------------------------------

--
-- Table structure for table `Equipe`
--

CREATE TABLE `Equipe` (
  `EquipeID` int(11) NOT NULL,
  `NomEquipe` varchar(100) NOT NULL,
  `Ville` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Equipe`
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
-- Table structure for table `Jouer`
--

CREATE TABLE `Jouer` (
  `RencontreID` int(11) NOT NULL,
  `EquipeID` int(11) NOT NULL,
  `Score` int(255) DEFAULT NULL,
  `EST_GAGNANT` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Jouer`
--

INSERT INTO `Jouer` (`RencontreID`, `EquipeID`, `Score`, `EST_GAGNANT`) VALUES
(1, 1, NULL, -1),
(1, 2, NULL, -1),
(2, 1, 119, 1),
(2, 3, 115, 0),
(3, 2, 96, 0),
(3, 3, 104, 1),
(4, 4, 121, 0),
(4, 5, 122, 1),
(5, 4, 121, 1),
(5, 6, 105, 0),
(6, 5, 85, 0),
(6, 6, 115, 1),
(7, 7, 95, 0),
(7, 8, 155, 1),
(8, 7, 95, 0),
(8, 9, 112, 1),
(9, 8, 120, 0),
(9, 9, 125, 1),
(10, 9, 125, 1),
(10, 10, 115, 0),
(11, 3, 115, 1),
(11, 10, 112, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Membre`
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
-- Dumping data for table `Membre`
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
-- Table structure for table `MembresEquipe`
--

CREATE TABLE `MembresEquipe` (
  `EquipeID` int(11) NOT NULL,
  `MembreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `MembresEquipe`
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
-- Table structure for table `Page`
--

CREATE TABLE `Page` (
  `PageID` int(11) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `NomPage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Page`
--

INSERT INTO `Page` (`PageID`, `Description`, `NomPage`) VALUES
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
(17, 'Performance in mathches', 'performance.php'),
(18, 'Administration panel, can modify roles only accessed by Admins.', 'adminpanel.php'),
(19, 'Page that lets you modify games that have not been played', 'manageexistinggames.php'),
(20, 'Modify the score of games and validate them', 'modify.php'),
(22, 'La page profile d\'un utilisateur', 'profile.php'),
(23, 'Script that deletes workouts', 'deleteworkout.php'),
(24, 'Lets you modify existing games', 'modifygame.php');

-- --------------------------------------------------------

--
-- Table structure for table `Participer`
--

CREATE TABLE `Participer` (
  `EntrainementID` int(11) NOT NULL,
  `MembreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Participer`
--

INSERT INTO `Participer` (`EntrainementID`, `MembreID`) VALUES
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
(3, 14),
(3, 15);

-- --------------------------------------------------------

--
-- Table structure for table `Performance`
--

CREATE TABLE `Performance` (
  `MembreID` int(11) NOT NULL,
  `RencontreID` int(11) NOT NULL,
  `Points` int(11) DEFAULT NULL,
  `Assists` int(11) DEFAULT NULL,
  `Rebonds` int(11) DEFAULT NULL,
  `MinutesJouees` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Performance`
--

INSERT INTO `Performance` (`MembreID`, `RencontreID`, `Points`, `Assists`, `Rebonds`, `MinutesJouees`) VALUES
(1, 1, 10, 6, 9, 40),
(1, 2, 36, 18, 12, 40),
(2, 1, 1, 20, 6, 40),
(2, 2, 30, 15, 16, 40),
(3, 1, 1, 6, 14, 40),
(3, 2, 20, 6, 11, 40),
(4, 1, 32, 20, 1, 40),
(4, 2, 32, 14, 7, 40),
(5, 1, 33, 6, 12, 40),
(5, 2, 34, 17, 9, 40),
(6, 1, 39, 13, 9, 40),
(6, 3, 37, 15, 6, 40),
(7, 1, 40, 7, 18, 40),
(7, 3, 38, 18, 13, 40),
(8, 1, 32, 11, 13, 40),
(8, 3, 19, 18, 6, 40),
(9, 1, 17, 16, 14, 40),
(9, 3, 10, 2, 11, 40),
(10, 1, 21, 11, 6, 40),
(10, 3, 37, 10, 10, 40),
(11, 2, 8, 6, 1, 40),
(11, 3, 1, 20, 10, 40),
(11, 11, 20, 16, 13, 40),
(12, 2, 6, 13, 14, 40),
(12, 3, 19, 19, 13, 40),
(12, 11, 30, 9, 17, 40),
(13, 2, 7, 3, 16, 40),
(13, 3, 6, 7, 6, 40),
(13, 11, 23, 1, 5, 40),
(14, 2, 5, 1, 7, 40),
(14, 3, 26, 16, 12, 40),
(14, 11, 18, 1, 7, 40),
(15, 2, 35, 17, 13, 40),
(15, 3, 6, 3, 18, 40),
(15, 11, 6, 3, 20, 40),
(16, 4, 32, 4, 12, 40),
(16, 5, 27, 7, 1, 40),
(17, 4, 18, 4, 15, 40),
(17, 5, 23, 16, 8, 40),
(18, 4, 34, 20, 19, 40),
(18, 5, 29, 16, 1, 40),
(19, 4, 24, 17, 4, 40),
(19, 5, 27, 13, 19, 40),
(20, 4, 7, 5, 16, 40),
(20, 5, 13, 17, 9, 40),
(21, 4, 24, 11, 5, 40),
(21, 6, 23, 18, 18, 40),
(22, 4, 14, 18, 6, 40),
(22, 6, 13, 10, 13, 40),
(23, 4, 3, 18, 6, 40),
(23, 6, 26, 7, 13, 40),
(24, 4, 11, 2, 15, 40),
(24, 6, 9, 12, 17, 40),
(25, 4, 18, 13, 12, 40),
(25, 6, 24, 11, 6, 40),
(26, 5, 33, 3, 6, 40),
(26, 6, 40, 4, 14, 40),
(27, 5, 33, 10, 8, 40),
(27, 6, 15, 3, 1, 40),
(28, 5, 19, 17, 2, 40),
(28, 6, 26, 8, 1, 40),
(29, 5, 5, 15, 11, 40),
(29, 6, 34, 6, 2, 40),
(30, 5, 32, 20, 3, 40),
(30, 6, 27, 12, 2, 40),
(31, 7, 27, 9, 12, 40),
(31, 8, 40, 13, 1, 40),
(32, 7, 40, 1, 11, 40),
(32, 8, 36, 7, 1, 40),
(33, 7, 16, 11, 13, 40),
(33, 8, 16, 10, 12, 40),
(34, 7, 31, 3, 19, 40),
(34, 8, 17, 10, 10, 40),
(35, 7, 31, 18, 17, 40),
(35, 8, 38, 14, 1, 40),
(36, 7, 20, 5, 13, 40),
(36, 9, 30, 6, 15, 40),
(37, 7, 18, 6, 15, 40),
(37, 9, 6, 13, 15, 40),
(38, 7, 6, 3, 15, 40),
(38, 9, 32, 10, 14, 40),
(39, 7, 37, 7, 8, 40),
(39, 9, 18, 19, 3, 40),
(40, 7, 20, 5, 14, 40),
(40, 9, 19, 7, 7, 40),
(41, 8, 2, 13, 11, 40),
(41, 9, 9, 10, 5, 40),
(41, 10, 9, 8, 7, 40),
(42, 8, 7, 1, 3, 40),
(42, 9, 19, 17, 15, 40),
(42, 10, 14, 18, 8, 40),
(43, 8, 1, 6, 5, 40),
(43, 9, 39, 14, 14, 40),
(43, 10, 39, 11, 9, 40),
(44, 8, 34, 3, 6, 40),
(44, 9, 21, 17, 20, 40),
(44, 10, 29, 15, 11, 40),
(45, 8, 30, 3, 13, 40),
(45, 9, 35, 18, 13, 40),
(45, 10, 40, 3, 4, 40),
(46, 10, 15, 17, 1, 40),
(46, 11, 1, 7, 4, 40),
(47, 10, 22, 7, 9, 40),
(47, 11, 6, 8, 16, 40),
(48, 10, 9, 19, 12, 40),
(48, 11, 9, 14, 4, 40),
(49, 10, 26, 20, 16, 40),
(49, 11, 22, 2, 14, 40),
(50, 10, 10, 13, 8, 40),
(50, 11, 40, 7, 13, 40);

-- --------------------------------------------------------

--
-- Table structure for table `Rencontre`
--

CREATE TABLE `Rencontre` (
  `RencontreID` int(11) NOT NULL,
  `DateRencontre` datetime NOT NULL,
  `ScoreEquipe1` int(11) DEFAULT NULL,
  `ScoreEquipe2` int(11) DEFAULT NULL,
  `Lieu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Rencontre`
--

INSERT INTO `Rencontre` (`RencontreID`, `DateRencontre`, `ScoreEquipe1`, `ScoreEquipe2`, `Lieu`) VALUES
(1, '2025-02-02 14:00:00', NULL, NULL, 'Boston'),
(2, '2025-03-14 18:00:00', 115, 119, 'Los Angeles'),
(3, '2025-03-18 20:00:00', 104, 96, 'Los Angeles'),
(4, '2025-01-25 08:00:00', 122, 121, 'Milwuakee'),
(5, '2025-12-02 19:00:00', 105, 121, 'Cleveland'),
(6, '2025-04-03 15:00:00', 115, 85, 'Denver'),
(7, '2025-05-02 08:11:00', 155, 95, 'Dallas'),
(8, '2025-11-01 18:59:00', 112, 95, 'Miami'),
(9, '2025-04-03 23:00:00', 125, 120, 'Miami'),
(10, '2025-04-04 20:00:00', 115, 125, 'San Antonio'),
(11, '2025-04-02 16:00:00', 115, 112, 'Los Angeles');

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `RoleID` int(11) NOT NULL,
  `NomRole` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`RoleID`, `NomRole`, `Description`) VALUES
(1, 'Admin', 'Administrateur de l\'application.'),
(2, 'Manager', 'Peut accéder a la partie management des jeux.'),
(3, 'Coach', 'Peut créer et ajouter des jouers aux entraînements. '),
(4, 'Assistant', 'Peut ajouter des jouers dans des entrainement et les consulter'),
(5, 'Jouer', 'Peut consulter les entraînement '),
(6, 'Utilistateur', 'Peut seulement consulter les matches et les equipes + statistiques.');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `UserID` int(20) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `DateCreation` datetime DEFAULT NULL,
  `Code` varchar(255) DEFAULT NULL,
  `DateExp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserID`, `Login`, `Password`, `Mail`, `DateCreation`, `Code`, `DateExp`) VALUES
(1, 'Administrator', '$2y$10$LxDxgpooy3ca1oHipMhe1uSP2jbm2Gu9c67Z9MNnEs.ZJsqIpdHc6', 'adminaccount@adminaccount.org', '2025-04-06 00:00:00', NULL, NULL),
(2, 'Manager-Account', '$2y$10$TxwNAKFHSqTOTuCKiOVh7eSwVoPErR4siRdlDA7C3EV.P3R317c0u', 'manager@manager-account.org', '2025-04-06 00:00:00', NULL, NULL),
(3, 'Coach-Account', '$2y$10$/IbGkeNCEhmsr08BPN2NOerBqm5K/TKWvEAk3Vgc7IpkCvBuNV2rG', 'Coach@coach-account.org', '2025-04-06 00:00:00', NULL, NULL),
(4, 'Assistant-Account', '$2y$10$Yva6FRZE3cOblHgWlHU8de5oHq7sdBwVDuuLIV7t95SYTOmZacp7e', 'Assistant@assistant-account.org', '2025-04-06 00:00:00', NULL, NULL),
(5, 'Player-Account', '$2y$10$KVc201G7ghP.h9enShrz3etIrRMcExGRr/iKt76tBGZ7KoFU/aH82', 'Player@player-account.org', '2025-04-06 00:00:00', NULL, NULL),
(6, 'User-Account', '$2y$10$tfmnmAquBrWX8PmWUYxdRuBZ9Rx/XztxZFwFThJkaKQ9c09q1k4N6', 'User@user-account.org', '2025-04-06 00:00:00', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Acceder`
--
ALTER TABLE `Acceder`
  ADD PRIMARY KEY (`PageID`,`RoleID`),
  ADD KEY `idRole` (`RoleID`);

--
-- Indexes for table `Disposer`
--
ALTER TABLE `Disposer`
  ADD PRIMARY KEY (`RoleID`,`UserID`),
  ADD KEY `idUtilisateur` (`UserID`);

--
-- Indexes for table `Entrainement`
--
ALTER TABLE `Entrainement`
  ADD PRIMARY KEY (`EntrainementID`);

--
-- Indexes for table `Equipe`
--
ALTER TABLE `Equipe`
  ADD PRIMARY KEY (`EquipeID`);

--
-- Indexes for table `Jouer`
--
ALTER TABLE `Jouer`
  ADD PRIMARY KEY (`RencontreID`,`EquipeID`),
  ADD KEY `JOUER_Equipe0_FK` (`EquipeID`);

--
-- Indexes for table `Membre`
--
ALTER TABLE `Membre`
  ADD PRIMARY KEY (`MembreID`);

--
-- Indexes for table `MembresEquipe`
--
ALTER TABLE `MembresEquipe`
  ADD PRIMARY KEY (`EquipeID`,`MembreID`),
  ADD KEY `MembresEquipe_Membre0_FK` (`MembreID`);

--
-- Indexes for table `Page`
--
ALTER TABLE `Page`
  ADD PRIMARY KEY (`PageID`),
  ADD UNIQUE KEY `PAGE_AK` (`NomPage`);

--
-- Indexes for table `Participer`
--
ALTER TABLE `Participer`
  ADD PRIMARY KEY (`EntrainementID`,`MembreID`),
  ADD KEY `PARTICIPER_Membre0_FK` (`MembreID`);

--
-- Indexes for table `Performance`
--
ALTER TABLE `Performance`
  ADD PRIMARY KEY (`MembreID`,`RencontreID`),
  ADD KEY `PERFORMANCE_Rencontre0_FK` (`RencontreID`);

--
-- Indexes for table `Rencontre`
--
ALTER TABLE `Rencontre`
  ADD PRIMARY KEY (`RencontreID`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Mail` (`Mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Entrainement`
--
ALTER TABLE `Entrainement`
  MODIFY `EntrainementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Equipe`
--
ALTER TABLE `Equipe`
  MODIFY `EquipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Membre`
--
ALTER TABLE `Membre`
  MODIFY `MembreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `Page`
--
ALTER TABLE `Page`
  MODIFY `PageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `Rencontre`
--
ALTER TABLE `Rencontre`
  MODIFY `RencontreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UserID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Acceder`
--
ALTER TABLE `Acceder`
  ADD CONSTRAINT `pj_ACCEDER_ibfk_1` FOREIGN KEY (`PageID`) REFERENCES `Page` (`PageID`),
  ADD CONSTRAINT `pj_ACCEDER_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `Role` (`RoleID`);

--
-- Constraints for table `Disposer`
--
ALTER TABLE `Disposer`
  ADD CONSTRAINT `Disposer_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `Role` (`RoleID`),
  ADD CONSTRAINT `Disposer_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`);

--
-- Constraints for table `Jouer`
--
ALTER TABLE `Jouer`
  ADD CONSTRAINT `JOUER_Equipe0_FK` FOREIGN KEY (`EquipeID`) REFERENCES `Equipe` (`EquipeID`),
  ADD CONSTRAINT `JOUER_Rencontre_FK` FOREIGN KEY (`RencontreID`) REFERENCES `Rencontre` (`RencontreID`);

--
-- Constraints for table `MembresEquipe`
--
ALTER TABLE `MembresEquipe`
  ADD CONSTRAINT `MembresEquipe_Equipe_FK` FOREIGN KEY (`EquipeID`) REFERENCES `Equipe` (`EquipeID`),
  ADD CONSTRAINT `MembresEquipe_Membre0_FK` FOREIGN KEY (`MembreID`) REFERENCES `Membre` (`MembreID`);

--
-- Constraints for table `Participer`
--
ALTER TABLE `Participer`
  ADD CONSTRAINT `PARTICIPER_Entrainement_FK` FOREIGN KEY (`EntrainementID`) REFERENCES `Entrainement` (`EntrainementID`),
  ADD CONSTRAINT `PARTICIPER_Membre0_FK` FOREIGN KEY (`MembreID`) REFERENCES `Membre` (`MembreID`);

--
-- Constraints for table `Performance`
--
ALTER TABLE `Performance`
  ADD CONSTRAINT `PERFORMANCE_Membre_FK` FOREIGN KEY (`MembreID`) REFERENCES `Membre` (`MembreID`),
  ADD CONSTRAINT `PERFORMANCE_Rencontre0_FK` FOREIGN KEY (`RencontreID`) REFERENCES `Rencontre` (`RencontreID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
