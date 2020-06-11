-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Jun 2020 um 12:47
-- Server-Version: 10.4.8-MariaDB
-- PHP-Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bilddb`
--
CREATE DATABASE IF NOT EXISTS `bilddb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bilddb`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pic_id` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pic_id`, `price`) VALUES
(190, 62, 124, 6.99),
(192, 62, 108, 6.99);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `uploaded` int(1) NOT NULL DEFAULT 1 CHECK (`uploaded` in (0,1))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `pictures`
--

INSERT INTO `pictures` (`id`, `user_id`, `path`, `description`, `uploaded`) VALUES
(106, 54, 'uploads/original/5ec8e0444e646.jpg', NULL, 1),
(107, 54, 'uploads/original/5ec8e06da5cb9.jpg', NULL, 1),
(108, 54, 'uploads/original/5ec8e0838b14a.jpg', NULL, 1),
(111, 61, 'uploads/original/5ec8e1973da8e.jpg', NULL, 1),
(112, 61, 'uploads/original/5ec8e1b807498.jpg', NULL, 1),
(113, 62, 'uploads/original/5ec8e20490052.jpg', NULL, 1),
(114, 62, 'uploads/original/5ec8e21620001.jpg', NULL, 1),
(124, 54, 'uploads/original/5ecbe38a3e1f9.jpg', 'I am the president. Yes I am', 1),
(125, 54, 'uploads/original/5ecbe6e587fd6.jpg', 'I am the best president. No one is president, except for me. Because I am the president', 1),
(126, 62, 'uploads/original/5eccdded62122.jpg', 'I am the best president. You are fake news', 1),
(171, 61, 'uploads/original/5ec8e06da5cb9.jpg', '', 0),
(172, 61, 'uploads/original/5ec8e0444e646.jpg', '', 0),
(173, 62, 'uploads/original/5ec8e06da5cb9.jpg', '', 0),
(175, 62, 'uploads/original/5ecea344d936b.jpg', 'Angry cat who wants your soul', 1),
(176, 62, 'uploads/original/5ec8e1973da8e.jpg', '', 0),
(177, 62, 'uploads/original/5ec8e0838b14a.jpg', '', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `pic_id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tags`
--

INSERT INTO `tags` (`id`, `pic_id`, `tag`) VALUES
(115, 106, 'trump'),
(116, 106, 'wall'),
(117, 106, 'fake_news'),
(118, 107, 'trumpino'),
(119, 107, 'president'),
(120, 107, 'murica'),
(121, 107, 'we_are_great'),
(122, 108, 'big_button'),
(123, 108, 'rocket_man'),
(124, 108, 'trumpo'),
(132, 111, 'orange'),
(133, 111, 'haters_gonna_hate'),
(134, 112, 'put_her_in_jail'),
(135, 113, 'grap_her_.....'),
(136, 113, 'sex'),
(137, 113, 'drugs'),
(138, 113, 'rock_and_roll'),
(139, 114, 'what?'),
(140, 114, 'wat?'),
(141, 114, 'why?'),
(142, 114, '????'),
(157, 124, 'trump'),
(158, 125, 'trumpino'),
(159, 125, 'wall'),
(160, 125, 'mr_president'),
(161, 126, 'corona'),
(162, 126, 'free'),
(163, 126, 'free_the_country'),
(164, 126, 'no_lockdown'),
(216, 171, 'trumpino'),
(217, 171, 'president'),
(218, 171, 'murica'),
(219, 171, 'we_are_great'),
(220, 172, 'trump'),
(221, 172, 'wall'),
(222, 172, 'fake_news'),
(223, 173, 'trumpino'),
(224, 173, 'president'),
(225, 173, 'murica'),
(226, 173, 'we_are_great'),
(231, 175, 'come_back_here'),
(232, 175, 'imma_fuck_you_up'),
(233, 175, 'fight_me'),
(234, 176, 'orange'),
(235, 176, 'haters_gonna_hate'),
(236, 177, 'big_button'),
(237, 177, 'rocket_man'),
(238, 177, 'trumpo');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(1) DEFAULT NULL CHECK (`gender` in ('m','f')),
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `postal_code` int(8) NOT NULL,
  `street_housenr` varchar(25) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `profile_pic_type` varchar(25) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `gender`, `firstname`, `lastname`, `city`, `postal_code`, `street_housenr`, `is_admin`, `profile_pic_type`, `profile_pic`) VALUES
(54, 'Chuck Norris', 'taharaed98@gmail.com', '$2y$10$eKM075wcE2yj5V6r/8WE/em7sfFPfpvHiZMegRgLML0H60T/8meFm', 'm', 'Taha', 'Khashmany', 'Horn', 3580, 'Thurnhofgasse 19', 1, 'image/jpeg', 'profile-pictures/5ec696ce8b662.JPG'),
(61, 'Rocket Man', 'taharaed98@gmail.com', '$2y$10$RZJc74bDoZymI3V6oLuJ0uZZ8QS4Ht8BUbcIWDqTn8TWHIHu0pvoC', 'm', 'Donald', 'Trump', 'Horn', 3580, 'Thurnhofgasse 19', 0, 'image/jpeg', 'profile-pictures/5ec8e14c7d34e.jpg'),
(62, 'if19b006', 'taharaed98@gmail.com', '$2y$10$uWSH5Ov5pfNR3efq49PUMOBS/9CqzOIlajbgE0uxWJ3bHOsfXVy.a', 'm', 'Taha', 'Al Khashmany', 'Horn', 3580, 'Thurnhofgasse 19', 0, 'image/jpeg', 'profile-pictures/5ecce0e4ceaec.jpg');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_pic` (`pic_id`);

--
-- Indizes für die Tabelle `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk` (`user_id`);

--
-- Indizes für die Tabelle `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pics` (`pic_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT für Tabelle `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT für Tabelle `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_pic` FOREIGN KEY (`pic_id`) REFERENCES `pictures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `fk_pics` FOREIGN KEY (`pic_id`) REFERENCES `pictures` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
