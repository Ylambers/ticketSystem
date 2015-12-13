-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 dec 2015 om 16:44
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
-- Tabelstructuur voor tabel `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `post_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `chat`
--

INSERT INTO `chat` (`id`, `message`, `user_id`, `ticket_id`, `post_time`) VALUES
(26, 'fgdgfd', 3, 3, '2015-12-13 16:32'),
(27, 'fgdgfd', 4, 3, '2015-12-13 16:32'),
(28, 'fgdgfd', 4, 3, '2015-12-13 16:33'),
(29, 'fgdgfd', 4, 3, '2015-12-13 16:33'),
(30, 'hmngvhmghmg', 3, 1, '2015-12-13 16:35'),
(31, 'jkhjk', 4, 3, '2015-12-13 16:36'),
(32, 'jkhjk', 4, 3, '2015-12-13 16:36'),
(33, 'dfsdfsdf', 4, 3, '2015-12-13 16:43');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status`
--

CREATE TABLE `status` (
  `idstatus` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `active` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `ticket` (
  `idticket` int(11) NOT NULL,
  `customer` varchar(45) NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `urgentieLevel` int(3) NOT NULL,
  `description` varchar(45) NOT NULL,
  `employee` varchar(45) DEFAULT NULL,
  `fixed_at` varchar(14) DEFAULT NULL,
  `solution` longtext,
  `active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `ticket`
--

INSERT INTO `ticket` (`idticket`, `customer`, `idcustomer`, `created_at`, `urgentieLevel`, `description`, `employee`, `fixed_at`, `solution`, `active`) VALUES
(1, 'y.lambers@outlook.com', 3, '2015-12-12 23:46:41', 4, 'Hallo mijn fiets is stuk :(', 'yaron lambers<br/>', '13.12.15', '  Fietsband is gemaakt meneer', 3),
(2, 'y.lambers@outlook.com', 3, '2015-12-12 22:28:46', 2, ' Hallo mijn fiets is stuk :(', NULL, NULL, NULL, 0),
(3, 'fietsje@hotmail.com', 4, '2015-12-12 23:33:04', 4, ' Damm fuck this is happening?', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `urgentielevel`
--

CREATE TABLE `urgentielevel` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `urgentielevel`
--

INSERT INTO `urgentielevel` (`id`, `name`) VALUES
(1, 'Low'),
(2, 'Normal'),
(4, 'Critical');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `phone` int(14) NOT NULL,
  `role` int(2) NOT NULL DEFAULT '1',
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `phone`, `role`, `email`, `password`) VALUES
(3, 'yaron', 'lambers', 620923399, 2, 'y.lambers@outlook.com', 'c84258e9c39059a89ab77d846ddab909'),
(4, 'Leonardo', 'Davinci', 547649948, 1, 'fietsje@hotmail.com', 'c84258e9c39059a89ab77d846ddab909');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

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
-- Indexen voor tabel `urgentielevel`
--
ALTER TABLE `urgentielevel`
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
-- AUTO_INCREMENT voor een tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT voor een tabel `status`
--
ALTER TABLE `status`
  MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `urgentielevel`
--
ALTER TABLE `urgentielevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
