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

CREATE TABLE transazioni (
    id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT,
    data DATE,
    ora TIME,
    tipo_transazione_id INT,
    importo DECIMAL(10, 2),
    FOREIGN KEY (tipo_transazione_id) REFERENCES tipo_transazioni(id),
    FOREIGN KEY (client_id) REFERENCES clienti(id)
);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
