-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 dec 2015 om 21:16
-- Serverversie: 10.0.17-MariaDB
-- PHP-versie: 5.6.14

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

CREATE TABLE `status` (
  `idstatus` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `ticket_idticket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ticket`
--

CREATE TABLE `ticket` (
  `idticket` int(11) NOT NULL,
  `customer` varchar(45) NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `importantLevel` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `employee` varchar(45) NOT NULL,
  `fixed_at` varchar(45) DEFAULT NULL,
  `solution` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `ticket`
--

INSERT INTO `ticket` (`idticket`, `customer`, `idcustomer`, `created_at`, `importantLevel`, `description`, `status`, `employee`, `fixed_at`, `solution`) VALUES
(1, 'y.lambers@outlook.com', 0, '2015-12-10 19:24:16', '', 'dfsdfsdfsdfsdfsdffdgdfg', '', '', NULL, NULL),
(2, '', 2, '2015-12-10 19:55:56', '', 'fgdfdsfsdfsdfsdfsdfsdfsdfsdfsdfsdf', '', '', NULL, NULL),
(3, '', 2, '2015-12-10 20:02:47', '', 'fgdfdsfsdfsdfsdfsdfsdfsdfsdfsdfsdf', '', '', NULL, NULL),
(4, '', 2, '2015-12-10 20:02:58', '', 'fgdfdsfsdfsdfsdfsdfsdfsdfsdfsdfsdf', '', '', NULL, NULL),
(5, '', 2, '2015-12-10 20:05:11', '', 'fgdfdsfsdfsdfsdfsdfsdfsdfsdfsdfsdf', '', '', NULL, NULL),
(6, '', 2, '2015-12-10 20:05:23', '', 'fgdfdsfsdfsdfsdfsdfsdfsdfsdfsdfsdf', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `type`
--

CREATE TABLE `type` (
  `idtype` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `ticket_idticket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `phone` int(14) NOT NULL,
  `image` longtext NOT NULL,
  `role` int(2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `phone`, `image`, `role`, `email`, `password`) VALUES
(2, 'yaron', 'lambers', 620923399, '', 2, 'y.lambers@outlook.com', 'admin1');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idstatus`),
  ADD KEY `fk_status_ticket1_idx` (`ticket_idticket`);

--
-- Indexen voor tabel `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`idticket`);

--
-- Indexen voor tabel `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`idtype`),
  ADD KEY `fk_type_ticket1_idx` (`ticket_idticket`);

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
  MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `type`
--
ALTER TABLE `type`
  MODIFY `idtype` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
