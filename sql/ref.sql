-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Počítač: mysql27.gigaserver.cz
-- Vygenerováno: Pon 14. led 2013, 22:57
-- Verze MySQL: 5.1.63-0+squeeze1-log
-- Verze PHP: 5.2.6-1+lenny9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `wepla_cz_jampl`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `function` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone` char(16) COLLATE utf8_bin DEFAULT NULL,
  `mail` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `contact_group_id` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_group_id` (`contact_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `contact_group`
--

CREATE TABLE IF NOT EXISTS `contact_group` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `galery`
--

CREATE TABLE IF NOT EXISTS `galery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `description` tinytext COLLATE utf8_bin NOT NULL,
  `galery_album_id` int(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `galery_album_id` (`galery_album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `galery_album`
--

CREATE TABLE IF NOT EXISTS `galery_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '0=vrchní prezentace',
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `description` tinytext COLLATE utf8_bin NOT NULL,
  `galery_cat_id` int(11) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Pouze pro reference 0=přiřazeno k referenci',
  PRIMARY KEY (`id`),
  KEY `galery_cat_id` (`galery_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `galery_cat`
--

CREATE TABLE IF NOT EXISTS `galery_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `user` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'uživatelsky vytvořená?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `moderator`
--

CREATE TABLE IF NOT EXISTS `moderator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8_bin NOT NULL,
  `password` char(40) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `role` varchar(30) COLLATE utf8_bin NOT NULL,
  `name` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `surname` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `mail` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `img` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `moderator_id` int(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `moderator_id` (`moderator_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET ascii NOT NULL,
  `title` varchar(60) COLLATE utf8_bin NOT NULL,
  `content` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `reference`
--

CREATE TABLE IF NOT EXISTS `reference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `foto` varchar(60) COLLATE utf8_bin NOT NULL,
  `galery_album_id` int(11) DEFAULT NULL,
  `moderator_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `moderator_id` (`moderator_id`),
  KEY `galery_album_id` (`galery_album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Spouště `reference`
--
DROP TRIGGER IF EXISTS `reference_ad`;
DELIMITER //
CREATE TRIGGER `reference_ad` AFTER DELETE ON `reference`
 FOR EACH ROW UPDATE galery_album SET available=0 WHERE id = OLD.galery_album_id
//
DELIMITER ;
DROP TRIGGER IF EXISTS `reference_ai`;
DELIMITER //
CREATE TRIGGER `reference_ai` AFTER INSERT ON `reference`
 FOR EACH ROW UPDATE galery_album SET available=0 WHERE id = NEW.galery_album_id
//
DELIMITER ;
DROP TRIGGER IF EXISTS `reference_au`;
DELIMITER //
CREATE TRIGGER `reference_au` AFTER UPDATE ON `reference`
 FOR EACH ROW BEGIN
UPDATE galery_album SET available=1 WHERE id = OLD.galery_album_id;
UPDATE galery_album SET available=0 WHERE id = NEW.galery_album_id;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabulky `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `foto` varchar(60) COLLATE utf8_bin NOT NULL,
  `galery_album_id` int(11) DEFAULT NULL,
  `moderator_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `moderator_id` (`moderator_id`),
  KEY `galery_album_id` (`galery_album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Spouště `service`
--
DROP TRIGGER IF EXISTS `service_ad`;
DELIMITER //
CREATE TRIGGER `service_ad` AFTER DELETE ON `service`
 FOR EACH ROW UPDATE galery_album SET available=0 WHERE id = OLD.galery_album_id
//
DELIMITER ;
DROP TRIGGER IF EXISTS `service_ai`;
DELIMITER //
CREATE TRIGGER `service_ai` AFTER INSERT ON `service`
 FOR EACH ROW UPDATE galery_album SET available=0 WHERE id = NEW.galery_album_id
//
DELIMITER ;
DROP TRIGGER IF EXISTS `service_au`;
DELIMITER //
CREATE TRIGGER `service_au` AFTER UPDATE ON `service`
 FOR EACH ROW BEGIN
UPDATE galery_album SET available=1 WHERE id = OLD.galery_album_id;
UPDATE galery_album SET available=0 WHERE id = NEW.galery_album_id;
END
//
DELIMITER ;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`contact_group_id`) REFERENCES `contact_group` (`id`);

--
-- Omezení pro tabulku `galery`
--
ALTER TABLE `galery`
  ADD CONSTRAINT `galery_ibfk_2` FOREIGN KEY (`galery_album_id`) REFERENCES `galery_album` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `galery_album`
--
ALTER TABLE `galery_album`
  ADD CONSTRAINT `galery_album_ibfk_2` FOREIGN KEY (`galery_cat_id`) REFERENCES `galery_cat` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`moderator_id`) REFERENCES `moderator` (`id`);

--
-- Omezení pro tabulku `reference`
--
ALTER TABLE `reference`
  ADD CONSTRAINT `reference_ibfk_1` FOREIGN KEY (`moderator_id`) REFERENCES `moderator` (`id`),
  ADD CONSTRAINT `reference_ibfk_4` FOREIGN KEY (`galery_album_id`) REFERENCES `galery_album` (`id`) ON DELETE SET NULL;

--
-- Omezení pro tabulku `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`moderator_id`) REFERENCES `moderator` (`id`),
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`galery_album_id`) REFERENCES `galery_album` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
