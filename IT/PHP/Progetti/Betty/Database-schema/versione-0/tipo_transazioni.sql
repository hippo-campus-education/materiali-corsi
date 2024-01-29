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
-- Table structure for table `tipo_transazioni`
--

CREATE TABLE IF NOT EXISTS `tipo_transazioni` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(35) NOT NULL,
  `nome` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

--
-- Dumping data for table `tipo_transazioni`
--

INSERT INTO `tipo_transazioni` (`id`, `tipo`,`nome`) VALUES
(1, 'Credito', 'Ricarica cellulare'),
(2, 'Credito', 'Versamento in contanti'),
(3, 'Credito', 'Vincita'),
(4, 'Debito', 'Pagamento in contanti'),
(5, 'Debito', 'Perdita'),
(6, 'Debito', 'Addebito cellulare');
