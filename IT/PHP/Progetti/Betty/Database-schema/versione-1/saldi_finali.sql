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
-- Struttura della tabella `saldi_finali`
--

CREATE TABLE `saldi_finali` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `credito` decimal(5,2) NOT NULL COMMENT 'importo che devo ricevere dal cliente',
  `debito` decimal(5,2) NOT NULL COMMENT 'importo che devo al cliente',
  `saldo` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
