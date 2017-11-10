-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 10 2017 г., 10:56
-- Версия сервера: 5.7.16
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `boardroom`
--
CREATE DATABASE IF NOT EXISTS `boardroom` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `boardroom`;

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

DROP TABLE IF EXISTS `events`;
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
-- Очистить таблицу перед добавлением данных `events`
--

TRUNCATE TABLE `events`;
--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`events_id`, `events_employer`, `events_start`, `events_end`, `events_description`, `events_recurring`, `events_specify`, `events_duration`, `events_parent`, `events_position`, `events_room`, `events_created`) VALUES
(14, 1, '2017-11-03 16:00:00', '2017-11-03 16:30:00', 'test 1', 0, 1, 0, 0, 0, 2, '2017-11-08 15:49:07'),
(15, 1, '2017-11-03 17:00:00', '2017-11-03 18:30:00', 'test 2', 1, 1, 3, 0, 0, 2, '2017-11-08 15:49:07'),
(17, 1, '2017-11-17 17:00:00', '2017-11-17 18:30:00', 'test 2', 1, 1, 3, 15, 2, 2, '2017-11-08 15:49:07'),
(18, 1, '2017-11-04 16:00:00', '2017-11-04 16:30:00', 'test 3', 1, 2, 2, 0, 0, 2, '2017-11-08 15:49:07'),
(19, 1, '2017-11-18 16:00:00', '2017-11-18 16:30:00', 'test 3', 1, 2, 2, 18, 1, 2, '2017-11-08 15:49:07'),
(20, 1, '2017-11-05 16:00:00', '2017-11-05 16:30:00', 'test 4', 1, 3, 3, 0, 0, 2, '2017-11-08 15:49:07'),
(21, 1, '2017-12-05 16:00:00', '2017-12-05 16:30:00', 'test 4', 1, 3, 3, 20, 1, 2, '2017-11-08 15:49:07'),
(22, 1, '2018-01-05 16:00:00', '2018-01-05 16:30:00', 'test 4', 1, 3, 3, 20, 2, 2, '2017-11-08 15:49:07'),
(23, 1, '2017-11-04 18:00:00', '2017-11-04 21:00:00', '11111', 0, 1, 0, 0, 0, 1, '2017-11-08 15:49:07'),
(31, 1, '2017-11-25 15:00:00', '2017-11-25 16:30:00', '4444444', 1, 1, 4, 30, 2, 1, '2017-11-08 15:49:07'),
(32, 1, '2017-12-02 15:00:00', '2017-12-02 16:30:00', '4444444', 1, 1, 4, 30, 3, 1, '2017-11-08 15:49:07'),
(40, 1, '2017-11-29 13:00:00', '2017-11-29 15:30:00', '666666', 1, 1, 4, 38, 3, 1, '2017-11-08 15:49:07'),
(41, 1, '2017-11-04 13:00:00', '2017-11-04 13:30:00', 'ttt', 0, 1, 0, 0, 0, 1, '2017-11-08 15:49:07'),
(43, 1, '2017-11-04 13:00:00', '2017-11-04 13:30:00', 'rrrrrr', 0, 1, 0, 0, 0, 3, '2017-11-08 15:49:07'),
(44, 1, '2017-11-04 13:00:00', '2017-11-04 15:30:00', 'ddddd', 0, 1, 0, 0, 0, 3, '2017-11-08 15:49:07'),
(45, 2, '2017-11-04 14:00:00', '2017-11-04 15:00:00', 'test user', 0, 1, 0, 0, 0, 1, '2017-11-08 15:49:07'),
(46, 2, '2017-11-04 00:00:00', '2017-11-04 00:30:00', 'test room 3', 1, 3, 2, 0, 0, 3, '2017-11-08 15:49:07'),
(47, 2, '2017-12-04 00:00:00', '2017-12-04 00:30:00', 'test room 3', 1, 3, 2, 46, 1, 3, '2017-11-08 15:49:07'),
(83, 1, '2017-11-20 16:00:00', '2017-11-20 16:30:00', '', 1, 1, 4, 82, 1, 1, '2017-11-08 15:49:07'),
(85, 1, '2017-12-04 16:00:00', '2017-12-04 16:30:00', '', 1, 1, 4, 82, 3, 1, '2017-11-08 15:49:07'),
(86, 1, '2017-11-14 16:00:00', '2017-11-14 16:30:00', '', 1, 1, 4, 0, 0, 2, '2017-11-08 15:49:07'),
(88, 1, '2017-11-28 16:00:00', '2017-11-28 16:30:00', '11111', 1, 1, 4, 86, 2, 2, '2017-11-08 15:49:07'),
(89, 1, '2017-12-12 16:00:00', '2017-12-12 16:30:00', '', 1, 1, 4, 88, 2, 2, '2017-11-08 15:49:07'),
(90, 1, '2017-12-19 16:00:00', '2017-12-19 16:30:00', '', 1, 1, 4, 88, 3, 2, '2017-11-08 15:49:07'),
(92, 1, '2017-11-09 17:00:00', '2017-11-09 17:30:00', '3333', 0, 1, 0, 0, 0, 1, '2017-11-08 16:00:36'),
(94, 1, '2017-11-09 16:30:00', '2017-11-09 16:00:00', '', 0, 1, 0, 0, 0, 1, '2017-11-09 16:28:07'),
(96, 1, '2017-11-09 11:00:00', '2017-11-09 11:30:00', '', 0, 1, 0, 0, 0, 1, '2017-11-09 23:00:38'),
(97, 2, '2017-11-11 23:00:00', '2017-11-11 23:30:00', '', 1, 1, 4, 0, 0, 1, '2017-11-09 23:05:39'),
(101, 1, '2017-11-09 23:00:00', '2017-11-09 23:30:00', '', 1, 1, 2, 0, 0, 1, '2017-11-09 23:48:26'),
(104, 1, '2017-11-10 08:30:00', '2017-11-10 09:30:00', 'test test', 1, 1, 4, 0, 0, 1, '2017-11-09 23:54:44'),
(108, 1, '2017-11-17 11:00:00', '2017-11-17 11:30:00', 'test test 2', 1, 1, 2, 0, 0, 1, '2017-11-09 23:55:43'),
(109, 1, '2017-11-24 11:00:00', '2017-11-24 11:30:00', 'test test 2', 1, 1, 2, 108, 1, 1, '2017-11-09 23:56:54'),
(110, 1, '2017-11-10 00:00:00', '2017-11-10 00:30:00', 'wwweeerrr', 0, 2, 2, 0, 0, 2, '2017-11-10 00:02:27'),
(111, 1, '2017-11-16 09:00:00', '2017-11-16 10:30:00', 'qazwsxedc', 1, 1, 4, 0, 0, 1, '2017-11-10 00:04:41'),
(112, 1, '2017-12-07 08:00:00', '2017-12-07 10:30:00', 'qazwsxedc', 1, 1, 4, 111, 3, 1, '2017-11-10 00:05:53');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `rooms_id` int(11) NOT NULL,
  `rooms_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `rooms`
--

TRUNCATE TABLE `rooms`;
--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`rooms_id`, `rooms_name`) VALUES
(1, 'Boardroom 1'),
(2, 'Boardroom 2'),
(3, 'Boardroom 3');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_name` varchar(255) NOT NULL,
  `users_login` varchar(255) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_role` int(11) NOT NULL DEFAULT '0' COMMENT '1 - admin, 0 - user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `users`
--

TRUNCATE TABLE `users`;
--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`users_id`, `users_name`, `users_login`, `users_password`, `users_role`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'User', 'user', '21232f297a57a5a743894a0e4a801fc3', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`events_id`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`rooms_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `events_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `rooms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
