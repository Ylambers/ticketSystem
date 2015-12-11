-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 11 dec 2015 om 19:35
-- Serverversie: 5.6.25
-- PHP-versie: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stenden_ehelp`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `idstatus` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `active` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `status`
--

INSERT INTO `status` (`idstatus`, `name`, `active`) VALUES
(1, 'In de wachtrij', 0),
(2, 'In behandeling', 1),
(3, 'Klaar', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `idticket` int(11) NOT NULL,
  `customer` varchar(45) NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `urgentieLevel` int(3) NOT NULL,
  `description` varchar(45) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `employee` varchar(45) NOT NULL,
  `fixed_at` timestamp NULL DEFAULT NULL,
  `solution` longtext,
  `active` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `ticket`
--

INSERT INTO `ticket` (`idticket`, `customer`, `idcustomer`, `created_at`, `urgentieLevel`, `description`, `status`, `employee`, `fixed_at`, `solution`, `active`) VALUES
(20, 'y.lambers@outlook.com', 2, '2015-12-11 13:31:20', 0, 'hallofhhhhh', 1, '', NULL, NULL, 0),
(21, 'y.lambers@outlook.com', 2, '2015-12-11 14:15:25', 0, 'dfsdfsdfsdfasdfadfasdfadfasdf', 0, 'yaron lambers', NULL, 'hallohjhbhhkjkjhj', 3),
(22, 'y.lambers@outlook.com', 2, '2015-12-11 09:37:54', 0, 'dfsdfsdfsdfasdfadfasdfadfasdf', 0, '', NULL, NULL, 0),
(23, 'y.lambers@outlook.com', 2, '2015-12-11 09:38:04', 1, 'jmhjkjhgkjhkjhkjhkjhkjhkjhkjhkhjkjhjkkjh', 0, '', NULL, NULL, 0),
(24, 'y.lambers@outlook.com', 2, '2015-12-11 10:19:43', 1, 'jmhjkjhgkjhkjhkjhkjhkjhkjhkjhkhjkjhjkkjh', 1, '', NULL, NULL, 0),
(25, 'y.lambers@outlook.com', 2, '2015-12-11 09:47:27', 1, 'jmhjkjhgkjhkjhkjhkjhkjhkjhkjhkhjkjhjkkjh', 0, '', NULL, NULL, 0),
(26, 'y.lambers@outlook.com', 2, '2015-12-11 09:47:38', 1, 'jmhjkjhgkjhkjhkjhkjhkjhkjhkjhkhjkjhjkkjh', 0, '', NULL, NULL, 0),
(27, 'y.lambers@outlook.com', 2, '2015-12-11 09:48:25', 1, 'jmhjkjhgkjhkjhkjhkjhkjhkjhkjhkhjkjhjkkjh', 0, '', NULL, NULL, 0),
(28, 'y.lambers@outlook.com', 2, '2015-12-11 10:28:56', 1, 'jmhjkjhgkjhkjhkjhkjhkjhkjhkjhkhjkjhjkkjh', 1, '', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `urgentieLevel`
--

CREATE TABLE IF NOT EXISTS `urgentieLevel` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `urgentieLevel`
--

INSERT INTO `urgentieLevel` (`id`, `name`) VALUES
(1, 'Low'),
(2, 'Normal'),
(4, 'Critical');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(5) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `phone` int(14) NOT NULL,
  `image` longtext NOT NULL,
  `role` int(2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `phone`, `image`, `role`, `email`, `password`) VALUES
(2, 'yaron', 'lambers', 620923399, '', 2, 'y.lambers@outlook.com', 'admin2');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idstatus`);

--
-- Indexen voor tabel `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`idticket`);

--
-- Indexen voor tabel `urgentieLevel`
--
ALTER TABLE `urgentieLevel`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `status`
--
ALTER TABLE `status`
  MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idticket` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT voor een tabel `urgentieLevel`
--
ALTER TABLE `urgentieLevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
