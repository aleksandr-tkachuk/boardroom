-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 31 2017 г., 16:48
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
  `users_role` int(11) NOT NULL DEFAULT '0' COMMENT '1 - admin, 0 - employeelist'
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
(2, 'User', 'employeelist', '21232f297a57a5a743894a0e4a801fc3', 0);

--
-- Индексы сохранённых таблиц
--

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
