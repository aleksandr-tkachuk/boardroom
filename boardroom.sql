-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 03 2017 г., 17:06
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
  `events_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `events`
--

TRUNCATE TABLE `events`;
--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`events_id`, `events_employer`, `events_start`, `events_end`, `events_description`, `events_recurring`, `events_specify`, `events_duration`, `events_parent`, `events_position`, `events_room`) VALUES
(14, 1, '2017-11-03 16:00:00', '2017-11-03 16:30:00', 'test 1', 0, 1, 0, 0, 0, 0),
(15, 1, '2017-11-03 17:00:00', '2017-11-03 18:30:00', 'test 2', 1, 1, 3, 0, 0, 0),
(16, 1, '2017-11-10 17:00:00', '2017-11-10 18:30:00', 'test 2', 1, 1, 3, 15, 1, 0),
(17, 1, '2017-11-17 17:00:00', '2017-11-17 18:30:00', 'test 2', 1, 1, 3, 15, 2, 0),
(18, 1, '2017-11-04 16:00:00', '2017-11-04 16:30:00', 'test 3', 1, 2, 2, 0, 0, 0),
(19, 1, '2017-11-18 16:00:00', '2017-11-18 16:30:00', 'test 3', 1, 2, 2, 18, 1, 0),
(20, 1, '2017-11-05 16:00:00', '2017-11-05 16:30:00', 'test 4', 1, 3, 3, 0, 0, 0),
(21, 1, '2017-12-05 16:00:00', '2017-12-05 16:30:00', 'test 4', 1, 3, 3, 20, 1, 0),
(22, 1, '2018-01-05 16:00:00', '2018-01-05 16:30:00', 'test 4', 1, 3, 3, 20, 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

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
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
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
  MODIFY `events_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `rooms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
