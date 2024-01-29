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
-- Table structure for table `tipi_transazioni`
--

CREATE TABLE IF NOT EXISTS `tipi_transazioni` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `movimento` varchar(50) NOT NULL,
  `tipo_transazione` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

--
-- Dumping data for table `tipo_transazioni`
--

INSERT INTO `tipi_transazioni` (`id`, `movimento`,`tipo_transazione`) VALUES
(1, 'Ricarica online', 'Credito'),
(2, 'Versamento in contanti', 'Credito'),
(3, 'Vincita', 'Credito'),
(4, 'Pagamento in contanti', 'Debito'),
(5, 'Perdita', 'Debito');
