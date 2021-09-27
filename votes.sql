-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2021. Sze 27. 09:45
-- Kiszolgáló verziója: 10.6.4-MariaDB
-- PHP verzió: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `votes`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `answers`
--

CREATE TABLE `answers` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `question_id` smallint(5) UNSIGNED NOT NULL,
  `answer` varchar(45) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `votes` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `votes`) VALUES
(1, 213, 'Vue', NULL),
(2, 213, 'React', NULL),
(3, 213, 'Svelte', NULL),
(4, 213, 'jQuery', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `questions`
--

CREATE TABLE `questions` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `questions`
--

INSERT INTO `questions` (`id`, `question`) VALUES
(213, 'Melyik a kedvenc frontend JavaScript keretrendszered');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `votelogs`
--

CREATE TABLE `votelogs` (
  `id` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(15) COLLATE utf8mb4_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_answers_questions_idx` (`question_id`);

--
-- A tábla indexei `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `votelogs`
--
ALTER TABLE `votelogs`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `answers`
--
ALTER TABLE `answers`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answers_questions` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
