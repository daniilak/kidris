-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 26 2017 г., 16:01
-- Версия сервера: 5.5.52-38.3
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bikluss_kidris`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_master_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tohen` varchar(255) NOT NULL,
  `is_die` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `count_ideas`
--

CREATE TABLE IF NOT EXISTS `count_ideas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_idea` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `screen_name` varchar(40) NOT NULL,
  `total_msg` varchar(255) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `cache_name` varchar(255) NOT NULL,
  `cache_photo` varchar(255) NOT NULL,
  `cache_time` int(11) NOT NULL,
  `show_desc` tinyint(1) NOT NULL DEFAULT '1',
  `show_count_msg` tinyint(1) NOT NULL DEFAULT '1',
  `show_rating` tinyint(1) NOT NULL DEFAULT '1',
  `auto_add` tinyint(1) NOT NULL DEFAULT '1',
  `auto_add_text` varchar(255) NOT NULL DEFAULT '#kidris #кидрис',
  `auto_add_photo` varchar(255) NOT NULL DEFAULT 'photo-88986513_403494639',
  `auto_add_up_down` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-up;1-down',
  `notification` tinyint(1) NOT NULL DEFAULT '0',
  `photo_min` varchar(255) NOT NULL DEFAULT 'https://pp.userapi.com/c631525/v631525984/1bb55/Xkc6KDdUUlc.jpg',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ideas`
--

CREATE TABLE IF NOT EXISTS `ideas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_posted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `msgs`
--

CREATE TABLE IF NOT EXISTS `msgs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `text` text NOT NULL,
  `attachments` text NOT NULL,
  `ip` varchar(40) NOT NULL,
  `cookies` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_group` (`id_group`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_notif_group` int(11) NOT NULL,
  `type_soc` varchar(2) NOT NULL,
  `id_notif_user` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_vk` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL DEFAULT '',
  `photo` varchar(255) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `GUID` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
