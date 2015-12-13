-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 dec 2015 om 19:28
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
(50, 'Hallo?', 3, 3, '2015-12-13 18:19'),
(51, 'Hallo meneer Lenonardo, ik had begrepen dat je een probleem hebt met de fiets?', 3, 3, '2015-12-13 18:19'),
(52, 'Hallo meneer Lenonardo, ik had begrepen dat je een probleem hebt met de fiets?', 3, 3, '2015-12-13 18:20'),
(53, 'Hallo meneer Lenonardo, ik had begrepen dat je een probleem hebt met de fiets?', 3, 3, '2015-12-13 18:20:55'),
(54, 'Hallo meneer Lenonardo, ik had begrepen dat je een probleem hebt met de fiets??', 3, 3, '2015-12-13 18:21:05'),
(55, 'Ja dat klopt', 4, 3, '2015-12-13 18:21:22'),
(56, 'Ja dat klopt', 4, 3, '2015-12-13 18:21:26'),
(57, 'Ja dat klopt', 4, 3, '2015-12-13 18:23:11'),
(58, '', 4, 3, '2015-12-13 18:24:13'),
(59, '', 4, 3, '2015-12-13 18:24:16'),
(60, '', 4, 3, '2015-12-13 18:24:24'),
(61, '', 4, 3, '2015-12-13 18:24:51'),
(62, '', 4, 3, '2015-12-13 18:24:59'),
(63, '', 4, 3, '2015-12-13 18:25:07'),
(64, 'Hallo?', 4, 4, '2015-12-13 18:31:37'),
(65, 'Hallo?', 4, 4, '2015-12-13 18:31:39'),
(66, 'Hallo?', 4, 4, '2015-12-13 18:32:33'),
(67, '', 4, 4, '2015-12-13 18:32:35'),
(68, '', 4, 4, '2015-12-13 18:32:36'),
(69, 'Hallo 1234567890123456789', 4, 4, '2015-12-13 18:34:18'),
(70, 'Hallo 1234567890123456789', 4, 4, '2015-12-13 18:34:21'),
(71, 'Hallo 1234567890123456789', 4, 4, '2015-12-13 18:34:31'),
(72, 'aaaaaaaaaaaaaaaaaaaaaaaaa', 5, 9, '2015-12-13 19:02:09'),
(73, 'Hallo meneer alwin, hoe gaat het ermee?', 3, 9, '2015-12-13 19:02:27'),
(74, 'Hallo meneer alwin, hoe gaat het ermee?', 3, 9, '2015-12-13 19:02:32'),
(75, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 5, 9, '2015-12-13 19:03:05'),
(76, 'volgensmij glicthed et er allemaal uit...', 5, 9, '2015-12-13 19:03:18'),
(77, '* Minimaal 20 tekens per bericht', 3, 1, '2015-12-13 19:25:36'),
(78, '* Minimaal 20 tekens per bericht', 3, 1, '2015-12-13 19:25:39'),
(79, '* Minimaal 20 tekens per bericht', 3, 1, '2015-12-13 19:25:48'),
(80, '* Minimaal 20 tekens per bericht', 3, 8, '2015-12-13 19:25:54'),
(81, '* Minimaal 20 tekens per bericht', 3, 8, '2015-12-13 19:25:59'),
(82, '* Minimaal 20 tekens per bericht', 3, 8, '2015-12-13 19:26:15'),
(83, '* Minimaal 20 tekens per bericht', 3, 8, '2015-12-13 19:26:28'),
(84, '* Minimaal 20 tekens per bericht', 3, 8, '2015-12-13 19:26:33'),
(85, '* Minimaal 20 tekens per bericht', 3, 8, '2015-12-13 19:26:35');

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
(2, 'y.lambers@outlook.com', 3, '2015-12-13 18:10:32', 2, ' Hallo mijn fiets is stuk :(', 'Yaron Lambers<br/>', '13.12.15', '  Het is wachten op een onderdeel', 1),
(3, 'fietsje@hotmail.com', 4, '2015-12-13 18:06:06', 4, ' Damm fuck this is happening?', 'aaaaa kkkkk<br/>', '13.12.15', '  yup its happining', 1),
(4, 'fietsje@hotmail.com', 4, '2015-12-13 18:05:41', 4, ' Mijn computer is stuk en nu kan ik niet meer', 'aaaaa kkkkk<br/>', '13.12.15', '  koop nieuwe pc', 3),
(5, 'das@gmail.com', 5, '2015-12-13 18:05:35', 1, '  aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Yaron Lambers<br/>', '13.12.15', '  cxxvxvxcvxcvxcvxcv', 1),
(6, 'das@gmail.com', 5, '2015-12-13 18:01:41', 1, ' ssssssssssssssssssssssssssssssssssssssssssss', NULL, NULL, NULL, 0),
(7, 'das@gmail.com', 5, '2015-12-13 18:01:45', 1, ' dddddddddddddddddddddddddddddddddddddddddddd', NULL, NULL, NULL, 0),
(8, 'das@gmail.com', 5, '2015-12-13 18:01:50', 1, ' zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', NULL, NULL, NULL, 0),
(9, 'das@gmail.com', 5, '2015-12-13 18:03:08', 1, ' dddddddddddddddddddddddddddddddddddddddddddd', 'Yaron Lambers<br/>', '13.12.15', '  dddddddddddddddddddddddddddddddddddddddddddd', 3),
(10, 'das@gmail.com', 5, '2015-12-13 18:07:26', 4, ' asdasdasdsdddddddddddddddddddddddddddddddddd', NULL, NULL, NULL, 0);

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
(3, 'Yaron', 'Lambers', 620923399, 2, 'y.lambers@outlook.com', 'c84258e9c39059a89ab77d846ddab909'),
(4, 'Leonardo', 'Davinci', 547649948, 1, 'fietsje@hotmail.com', 'c84258e9c39059a89ab77d846ddab909'),
(5, 'aaaaa', 'kkkkk', 601111111, 1, 'das@gmail.com', '594f803b380a41396ed63dca39503542');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT voor een tabel `status`
--
ALTER TABLE `status`
  MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT voor een tabel `urgentielevel`
--
ALTER TABLE `urgentielevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
