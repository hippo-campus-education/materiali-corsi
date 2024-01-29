-- phpMyAdmin SQL Dump

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
-- Table structure for table `transazioni`
--


CREATE TABLE `transazioni` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `importo` decimal(5,2) NOT NULL,
  `data` date NOT NULL,
  `ora` time(5) NOT NULL,
  `cliente_id` int(5) NOT NULL,
  `tipo_transazione_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
  -- FOREIGN KEY (tipo_transazione_id) REFERENCES tipo_transazioni(id),
  -- FOREIGN KEY (cliente_id) REFERENCES clienti(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
