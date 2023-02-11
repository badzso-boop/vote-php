-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Feb 11. 14:43
-- Kiszolgáló verziója: 10.4.24-MariaDB
-- PHP verzió: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `vote`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `fnev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(512) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `name`, `fnev`, `jelszo`, `email`) VALUES
(2, 'Ujj Norbert', 'norbi', '$2y$10$tO6xt6MQ4lqqQzZ.DShwWeFq00mmxGBYJtKWxCeZHYZnPOYpJsyoW', 'norbert.ujj@gmail.com'),
(3, 'Ujj Marcell', 'marci', '$2y$10$.ZzFNQhTx0etgO.0bB0/rOnd6KSjVeBECQkxpkRn9DCj0ovoPQkKy', 'maci.ujj@gmail.com'),
(4, 'Ujj Marcell ', 'Anyadat', '$2y$10$WhHlTI44gxqv8D2NauyEBejIKricI3ieVlP7udIJeKsRqFMvuSYQO', 'maci.ujj@gmail.com');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `kerdes` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `valaszok` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `eredmenyek` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `felhasznalok` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `votes`
--

INSERT INTO `votes` (`id`, `kerdes`, `valaszok`, `eredmenyek`, `felhasznalok`) VALUES
(9, 'Megegy kerdes', 'asd,asd,asd,asd,asd', '11,2,2,2,2', 'norbi,norbi,norbi,norbi,norbi,norbi,norbi,norbi,marci,norbi,norbi,norbi,norbi,norbi,norbi,norbi,norbi,norbi,norbi'),
(12, 'Megegy kerdes1', 'asd,asd,asd,asd,asd', '5,2,3,3,2', 'norbi,norbi,norbi,norbi,norbi,norbi,norbi,norbi,marci,norbi,norbi,norbi,norbi,norbi,norbi'),
(13, 'Miri okos?', 'Igen,Nem,Talán,Nemtudom,', '1,1,0,2,-1', 'norbi,marci,marci,Anyadat'),
(14, 'asd', 'asd,asd,asd,,', '0,0,0,-1,-1', '');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
