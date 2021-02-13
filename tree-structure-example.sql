-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 27 2016 г., 20:32
-- Версия сервера: 5.7.13
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tree-structure`
--

-- --------------------------------------------------------

--
-- Структура таблицы `nodes`
--

CREATE TABLE IF NOT EXISTS `nodes` (
  `id` int(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `left_key` int(10) NOT NULL DEFAULT '0',
  `right_key` int(10) NOT NULL DEFAULT '0',
  `level` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `nodes`
--

INSERT INTO `nodes` (`id`, `name`, `left_key`, `right_key`, `level`) VALUES
(1, 'vehicle', 1, 42, 1),
(2, 'motorcycle', 2, 3, 2),
(3, 'automobile', 4, 41, 2),
(4, 'audi', 5, 18, 3),
(5, 'bmw', 19, 34, 3),
(6, 'ford', 35, 40, 3),
(7, 'a1', 6, 7, 4),
(8, 'a3', 8, 15, 4),
(9, 'a4', 16, 17, 4),
(10, 'x1', 20, 25, 4),
(11, 'x3', 26, 27, 4),
(12, 'x4', 28, 29, 4),
(13, 'x5', 30, 31, 4),
(14, 'x6', 32, 33, 4),
(15, 'focus', 36, 37, 4),
(16, 'kuga', 38, 39, 4),
(17, '1999', 9, 10, 5),
(18, '2003', 11, 12, 5),
(19, '2004', 13, 14, 5),
(20, '2009', 21, 22, 5),
(21, '2016', 23, 24, 5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `nodes`
--
ALTER TABLE `nodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `left_key` (`left_key`,`right_key`,`level`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `nodes`
--
ALTER TABLE `nodes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
