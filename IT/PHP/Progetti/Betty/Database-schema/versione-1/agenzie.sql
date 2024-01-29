-- phpMyAdmin SQL Dump
-- Host: 127.0.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `betty`
--

-- --------------------------------------------------------
--
-- Struttura della tabella `agenzie`
--

CREATE TABLE `agenzie` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome_agenzia` varchar(100) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
--
-- Dumping data for table `agenzie`
--

INSERT INTO `agenzie` (`id`, `nome_agenzia`) VALUES
(1, 'Agenzia 1'),
(2, 'Agenzia 2'),
(3, 'Agenzia 3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
