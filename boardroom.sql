-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 05 2017 г., 11:22
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
  `events_room` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`events_id`, `events_employer`, `events_start`, `events_end`, `events_description`, `events_recurring`, `events_specify`, `events_duration`, `events_parent`, `events_position`, `events_room`) VALUES
(14, 1, '2017-11-03 16:00:00', '2017-11-03 16:30:00', 'test 1', 0, 1, 0, 0, 0, 2),
(15, 1, '2017-11-03 17:00:00', '2017-11-03 18:30:00', 'test 2', 1, 1, 3, 0, 0, 2),
(16, 1, '2017-11-10 17:00:00', '2017-11-10 18:30:00', 'test 2', 1, 1, 3, 15, 1, 2),
(17, 1, '2017-11-17 17:00:00', '2017-11-17 18:30:00', 'test 2', 1, 1, 3, 15, 2, 2),
(18, 1, '2017-11-04 16:00:00', '2017-11-04 16:30:00', 'test 3', 1, 2, 2, 0, 0, 2),
(19, 1, '2017-11-18 16:00:00', '2017-11-18 16:30:00', 'test 3', 1, 2, 2, 18, 1, 2),
(20, 1, '2017-11-05 16:00:00', '2017-11-05 16:30:00', 'test 4', 1, 3, 3, 0, 0, 2),
(21, 1, '2017-12-05 16:00:00', '2017-12-05 16:30:00', 'test 4', 1, 3, 3, 20, 1, 2),
(22, 1, '2018-01-05 16:00:00', '2018-01-05 16:30:00', 'test 4', 1, 3, 3, 20, 2, 2),
(23, 1, '2017-11-04 18:00:00', '2017-11-04 21:00:00', '11111', 0, 1, 0, 0, 0, 1),
(30, 1, '2017-11-11 15:00:00', '2017-11-11 16:30:00', '4444444', 1, 1, 4, 0, 0, 1),
(31, 1, '2017-11-25 15:00:00', '2017-11-25 16:30:00', '4444444', 1, 1, 4, 30, 2, 1),
(32, 1, '2017-12-02 15:00:00', '2017-12-02 16:30:00', '4444444', 1, 1, 4, 30, 3, 1),
(33, 1, '2017-11-14 12:00:00', '2017-11-14 14:00:00', 'test 14', 0, 1, 0, 0, 0, 1),
(34, 1, '2017-11-07 12:00:00', '2017-11-07 14:30:00', 'test !!!!!!!', 1, 1, 4, 0, 0, 1),
(35, 1, '2017-11-21 12:00:00', '2017-11-21 14:30:00', 'test !!!!!!!', 1, 1, 4, 34, 2, 1),
(36, 1, '2017-11-28 12:00:00', '2017-11-28 14:30:00', 'test !!!!!!!', 1, 1, 4, 34, 3, 1),
(37, 1, '2017-11-15 13:00:00', '2017-11-15 13:30:00', '55555', 0, 1, 0, 0, 0, 1),
(38, 1, '2017-11-08 13:00:00', '2017-11-08 15:30:00', '666666', 1, 1, 4, 0, 0, 1),
(39, 1, '2017-11-22 13:00:00', '2017-11-22 15:30:00', '666666', 1, 1, 4, 38, 2, 1),
(40, 1, '2017-11-29 13:00:00', '2017-11-29 15:30:00', '666666', 1, 1, 4, 38, 3, 1),
(41, 1, '2017-11-04 13:00:00', '2017-11-04 13:30:00', 'ttt', 0, 1, 0, 0, 0, 1),
(43, 1, '2017-11-04 13:00:00', '2017-11-04 13:30:00', 'rrrrrr', 0, 1, 0, 0, 0, 3),
(44, 1, '2017-11-04 13:00:00', '2017-11-04 15:30:00', 'ddddd', 0, 1, 0, 0, 0, 3),
(45, 2, '2017-11-04 14:00:00', '2017-11-04 15:00:00', 'test user', 0, 1, 0, 0, 0, 1),
(46, 2, '2017-11-04 00:00:00', '2017-11-04 00:30:00', 'test room 3', 1, 3, 2, 0, 0, 3),
(47, 2, '2017-12-04 00:00:00', '2017-12-04 00:30:00', 'test room 3', 1, 3, 2, 46, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `rooms_id` int(11) NOT NULL,
  `rooms_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_name` varchar(255) NOT NULL,
  `users_login` varchar(255) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_role` int(11) NOT NULL DEFAULT '0' COMMENT '1 - admin, 0 - user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`users_id`, `users_name`, `users_login`, `users_password`, `users_role`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'User', 'user', '21232f297a57a5a743894a0e4a801fc3', 0),
(4, 'test', 'test_login', '698d51a19d8a121ce581499d7b701668', 0);

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
  MODIFY `events_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `rooms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
