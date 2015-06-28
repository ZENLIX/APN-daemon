-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 28 2015 г., 10:51
-- Версия сервера: 5.5.43-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `admin_api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `push_pool`
--

CREATE TABLE IF NOT EXISTS `push_pool` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dt` datetime DEFAULT NULL,
  `msg` varchar(2048) DEFAULT NULL,
  `device_token` varchar(2048) DEFAULT NULL,
  `from_ip` varchar(128) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `ticket_hash` varchar(1024) NOT NULL,
  `cat` varchar(512) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticket_action` varchar(64) NOT NULL,
  `ticket_user_init` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2325 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
