-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 apr 2024 om 10:32
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bericht`
--

CREATE TABLE `bericht` (
  `voornaam` varchar(255) NOT NULL,
  `leeftijd` int(255) NOT NULL,
  `geslacht` varchar(255) NOT NULL,
  `berichtid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `bestelid` int(11) NOT NULL,
  `klantid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`bestelid`, `klantid`, `productid`, `aantal`, `datum`) VALUES
(3, 1, 5, 3, '2024-04-02 21:27:15'),
(4, 10, 6, 88, '2024-04-02 21:27:15');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantid` int(11) NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `plaats` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klantid`, `voornaam`, `achternaam`, `adres`, `plaats`) VALUES
(1, 'jan', 'timmerman', 'hedwiglaan', 'almere'),
(2, 'erik', 'jansen', 'dantestraat 55', 'rotterdam'),
(3, 'ron', 'akker', 'wilhelminastraat 33', 'rotterdam'),
(4, 'jeroen', 'lammert', 'rozenstraat 24', 'amsterdam'),
(5, 'maria', 'koenraad', 'rozenstraat 76', 'amsterdam'),
(6, 'karlijn', 'rogier', 'madeliefstraat 99', 'groningen'),
(7, 'feline', 'robert', 'rozemarijnstraat 1', 'drenthe'),
(8, 'maarten', 'petrus', 'rozemarijnstraat 4', 'drenthe'),
(9, 'helga', 'natalia', 'alexanderlaan 57', 'brabant'),
(10, 'esther', 'leopold', 'alexanderlaan 44', 'brabant'),
(11, 'gelbert', 'ernst', 'imkerlaan 55', 'friesland');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `productid` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `prijs` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`productid`, `naam`, `merk`, `prijs`) VALUES
(1, 'laserpen oranje', 'LLC', 29.99),
(2, 'laserpen geel', 'LLC', 19.00),
(3, 'laserpen paars', 'LLC', 19.00),
(4, 'laserpen groen', 'LLC', 19.00),
(5, 'laserpen blauw', 'LLC', 19.00),
(6, 'laserpen rood', 'LLC', 19.00),
(7, 'laserlamp sterrenhemel', 'LLC', 30.00),
(8, 'laserlamp geel', 'LLC', 30.00);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bericht`
--
ALTER TABLE `bericht`
  ADD PRIMARY KEY (`berichtid`);

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`bestelid`),
  ADD KEY `klantid` (`klantid`),
  ADD KEY `productid` (`productid`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantid`),
  ADD KEY `voornaam` (`voornaam`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`productid`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bericht`
--
ALTER TABLE `bericht`
  MODIFY `berichtid` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `bestelid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `bestellingen_ibfk_1` FOREIGN KEY (`klantid`) REFERENCES `klanten` (`klantid`),
  ADD CONSTRAINT `bestellingen_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `producten` (`productid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
