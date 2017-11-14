-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 14 2017 г., 12:00
-- Версия сервера: 5.7.16
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `boardroom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `events_id` int(11) NOT NULL,
  `events_employer` int(11) NOT NULL,
  `events_start` datetime NOT NULL,
  `events_end` datetime NOT NULL,
  `events_description` text NOT NULL,
  `events_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `events_specify` tinyint(1) NOT NULL DEFAULT '0',
  `events_duration` tinyint(1) NOT NULL DEFAULT '0',
  `events_parent` int(11) NOT NULL DEFAULT '0',
  `events_position` tinyint(1) NOT NULL DEFAULT '0',
  `events_room` int(11) NOT NULL DEFAULT '1',
  `events_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`events_id`, `events_employer`, `events_start`, `events_end`, `events_description`, `events_recurring`, `events_specify`, `events_duration`, `events_parent`, `events_position`, `events_room`, `events_created`) VALUES
(14, 1, '2017-11-03 16:00:00', '2017-11-03 16:30:00', 'test 1', 0, 1, 0, 0, 0, 2, '2017-11-08 15:49:07'),
(15, 1, '2017-11-03 17:00:00', '2017-11-03 18:30:00', 'test 2', 1, 1, 3, 0, 0, 2, '2017-11-08 15:49:07'),
(17, 1, '2017-12-01 19:00:00', '2017-12-01 19:30:00', 'test 2 !!!!!', 1, 2, 4, 15, 2, 2, '2017-11-08 15:49:07'),
(18, 1, '2017-11-04 16:00:00', '2017-11-04 16:30:00', 'test 3', 1, 2, 2, 0, 0, 2, '2017-11-08 15:49:07'),
(19, 1, '2017-11-18 16:00:00', '2017-11-18 16:30:00', 'test 3', 1, 2, 2, 18, 1, 2, '2017-11-08 15:49:07'),
(20, 1, '2017-11-05 16:00:00', '2017-11-05 16:30:00', 'test 4', 1, 3, 3, 0, 0, 2, '2017-11-08 15:49:07'),
(21, 1, '2017-12-05 16:00:00', '2017-12-05 16:30:00', 'test 4', 1, 3, 3, 20, 1, 2, '2017-11-08 15:49:07'),
(22, 1, '2018-01-05 16:00:00', '2018-01-05 16:30:00', 'test 4', 1, 3, 3, 20, 2, 2, '2017-11-08 15:49:07'),
(23, 1, '2017-11-04 18:00:00', '2017-11-04 21:00:00', '11111', 0, 1, 0, 0, 0, 1, '2017-11-08 15:49:07'),
(31, 1, '2017-11-25 15:00:00', '2017-11-25 16:30:00', '4444444', 1, 1, 4, 30, 2, 1, '2017-11-08 15:49:07'),
(40, 1, '2017-11-29 13:00:00', '2017-11-29 15:30:00', '666666', 1, 1, 4, 38, 3, 1, '2017-11-08 15:49:07'),
(41, 1, '2017-11-04 13:00:00', '2017-11-04 13:30:00', 'ttt', 0, 1, 0, 0, 0, 1, '2017-11-08 15:49:07'),
(43, 1, '2017-11-04 13:00:00', '2017-11-04 13:30:00', 'rrrrrr', 0, 1, 0, 0, 0, 3, '2017-11-08 15:49:07'),
(44, 1, '2017-11-04 13:00:00', '2017-11-04 15:30:00', 'ddddd', 0, 1, 0, 0, 0, 3, '2017-11-08 15:49:07'),
(45, 2, '2017-11-04 14:00:00', '2017-11-04 15:00:00', 'test user', 0, 1, 0, 0, 0, 1, '2017-11-08 15:49:07'),
(46, 2, '2017-11-04 00:00:00', '2017-11-04 00:30:00', 'test room 3', 1, 3, 2, 0, 0, 3, '2017-11-08 15:49:07'),
(47, 2, '2017-12-04 00:00:00', '2017-12-04 00:30:00', 'test room 3', 1, 3, 2, 46, 1, 3, '2017-11-08 15:49:07'),
(88, 1, '2017-11-28 16:00:00', '2017-11-28 16:30:00', '11111', 1, 1, 4, 86, 2, 2, '2017-11-08 15:49:07'),
(92, 1, '2017-11-09 17:00:00', '2017-11-09 17:30:00', '3333', 0, 1, 0, 0, 0, 1, '2017-11-08 16:00:36'),
(94, 1, '2017-11-09 16:30:00', '2017-11-09 16:00:00', '', 0, 1, 0, 0, 0, 1, '2017-11-09 16:28:07'),
(96, 1, '2017-11-09 11:00:00', '2017-11-09 11:30:00', '', 0, 1, 0, 0, 0, 1, '2017-11-09 23:00:38'),
(97, 2, '2017-11-11 23:00:00', '2017-11-11 23:30:00', '', 1, 1, 4, 0, 0, 1, '2017-11-09 23:05:39'),
(101, 1, '2017-11-09 23:00:00', '2017-11-09 23:30:00', '', 1, 1, 2, 0, 0, 1, '2017-11-09 23:48:26'),
(104, 1, '2017-11-10 08:30:00', '2017-11-10 09:30:00', 'test test', 1, 1, 4, 0, 0, 1, '2017-11-09 23:54:44'),
(110, 1, '2017-11-10 00:00:00', '2017-11-10 00:30:00', 'wwweeerrr', 0, 2, 2, 0, 0, 2, '2017-11-10 00:02:27'),
(112, 1, '2017-12-07 08:00:00', '2017-12-07 10:30:00', 'qazwsxedc', 1, 1, 4, 111, 3, 1, '2017-11-10 00:05:53'),
(113, 1, '2017-11-29 15:30:00', '2017-11-29 16:30:00', '!!!!!!!!', 0, 1, 0, 0, 0, 1, '2017-11-13 10:53:10'),
(114, 1, '2018-01-10 11:00:00', '2018-01-10 11:30:00', '1111', 0, 1, 0, 0, 0, 1, '2017-11-13 11:09:50'),
(118, 1, '2018-01-20 11:30:00', '2018-01-20 12:00:00', 'rrrrr !!!!!', 0, 1, 0, 0, 0, 1, '2017-11-13 11:19:17'),
(123, 1, '2018-01-22 11:30:00', '2018-01-22 12:00:00', '@@@@@', 0, 1, 0, 0, 0, 1, '2017-11-13 11:22:47'),
(126, 1, '2017-11-27 11:30:00', '2017-11-27 12:00:00', 'qaz', 1, 1, 3, 0, 0, 1, '2017-11-13 11:44:50'),
(129, 1, '2017-11-13 12:00:00', '2017-11-13 12:30:00', '', 0, 1, 0, 0, 0, 1, '2017-11-13 11:48:50'),
(141, 1, '2017-11-30 12:00:00', '2017-11-30 12:30:00', '777', 0, 1, 3, 0, 2, 1, '2017-11-13 12:10:13'),
(146, 1, '2017-11-23 12:00:00', '2017-11-23 12:30:00', '8888', 0, 1, 3, 0, 1, 1, '2017-11-13 12:16:32'),
(149, 1, '2017-11-13 14:00:00', '2017-11-13 14:30:00', '0000', 0, 1, 0, 0, 0, 1, '2017-11-13 13:08:09'),
(150, 1, '2017-11-30 14:00:00', '2017-11-30 14:30:00', '000', 0, 1, 0, 0, 0, 1, '2017-11-13 13:09:08'),
(151, 1, '2017-11-16 14:00:00', '2017-11-16 15:30:00', '', 1, 2, 2, 0, 0, 1, '2017-11-13 13:10:47'),
(160, 1, '2017-11-14 08:00:00', '2017-11-14 08:30:00', '', 0, 1, 0, 0, 0, 1, '2017-11-14 00:05:26'),
(161, 1, '2017-11-15 10:00:00', '2017-11-15 10:30:00', '1111', 1, 1, 3, 0, 0, 1, '2017-11-14 10:07:02'),
(165, 1, '2017-11-15 08:30:00', '2017-11-15 10:00:00', '5555', 0, 1, 0, 0, 0, 1, '2017-11-14 10:42:10'),
(166, 1, '2017-11-14 11:30:00', '2017-11-14 12:00:00', 'yyy', 0, 1, 0, 0, 0, 1, '2017-11-14 10:44:26'),
(168, 1, '2017-11-15 12:00:00', '2017-11-15 13:30:00', 'ddd', 0, 1, 0, 0, 0, 1, '2017-11-14 10:45:46'),
(169, 1, '2017-11-15 13:30:00', '2017-11-15 15:00:00', '666666', 0, 1, 0, 0, 0, 1, '2017-11-14 10:46:23');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`events_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `events_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
