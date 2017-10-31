-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 23 2017 г., 15:59
-- Версия сервера: 5.7.16
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bookShop`
--
CREATE DATABASE IF NOT EXISTS `bookShop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bookShop`;

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `author`
--

TRUNCATE TABLE `author`;
--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`author_id`, `author_name`) VALUES
(1, 'Gosha'),
(3, 'Толстой'),
(4, 'Антонов'),
(5, 'RRR');

-- --------------------------------------------------------

--
-- Структура таблицы `author_book`
--

DROP TABLE IF EXISTS `author_book`;
CREATE TABLE `author_book` (
  `author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `author_book`
--

TRUNCATE TABLE `author_book`;
--
-- Дамп данных таблицы `author_book`
--

INSERT INTO `author_book` (`author_id`, `book_id`) VALUES
(4, 10),
(1, 13),
(3, 13),
(3, 11),
(4, 11),
(3, 0),
(5, 0),
(3, 14),
(4, 14),
(3, 15),
(4, 15),
(4, 16),
(3, 17),
(4, 17),
(3, 18),
(4, 18),
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_description` tinytext,
  `book_price` float(8,2) NOT NULL,
  `book_discount_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `book`
--

TRUNCATE TABLE `book`;
--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `book_description`, `book_price`, `book_discount_id`) VALUES
(2, 'rott', 'chot in good!', 321.00, 9),
(10, 'монстры', '2017 год', 120.00, 0),
(11, 'wwwddd', 'qazwsxedc', 123.00, 8),
(13, 'ZZZZZ', 'ssss', 123.00, 9),
(14, 'eee', 'rrrr', 123.00, 0),
(15, 'eee', 'rrrr', 123.00, 0),
(16, 'eee', 'rrrr', 123.00, 0),
(17, 'FFF', 'GGG', 123.00, 0),
(18, 'FFF', 'GGG', 123.00, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `book_order`
--

DROP TABLE IF EXISTS `book_order`;
CREATE TABLE `book_order` (
  `book_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `book_order`
--

TRUNCATE TABLE `book_order`;
--
-- Дамп данных таблицы `book_order`
--

INSERT INTO `book_order` (`book_id`, `order_id`, `book_count`) VALUES
(10, 1, 2),
(2, 1, 1),
(11, 3, 2),
(13, 3, 3),
(13, 4, 1),
(11, 4, 5),
(13, 5, 2),
(11, 5, 3),
(13, 6, 1),
(2, 6, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `discount_name` varchar(255) NOT NULL,
  `discount_tax` int(11) NOT NULL,
  `discount_type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `discount`
--

TRUNCATE TABLE `discount`;
--
-- Дамп данных таблицы `discount`
--

INSERT INTO `discount` (`discount_id`, `discount_name`, `discount_tax`, `discount_type`) VALUES
(8, 'magento1111', 12, 2),
(9, 'sale', 20, 1),
(10, 'уценка', 5, 2),
(11, 'просрочка', 20, 1),
(12, 'qqq', 10, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `genre`
--

TRUNCATE TABLE `genre`;
--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`) VALUES
(16, 'comedy'),
(18, 'fiction'),
(23, 'roman');

-- --------------------------------------------------------

--
-- Структура таблицы `genre_book`
--

DROP TABLE IF EXISTS `genre_book`;
CREATE TABLE `genre_book` (
  `genre_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `genre_book`
--

TRUNCATE TABLE `genre_book`;
--
-- Дамп данных таблицы `genre_book`
--

INSERT INTO `genre_book` (`genre_id`, `book_id`) VALUES
(18, 10),
(18, 11),
(16, 15),
(18, 15),
(23, 16),
(18, 17),
(18, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `orders_data` datetime NOT NULL,
  `orders_client_id` int(11) NOT NULL,
  `orders_cost` float(8,2) NOT NULL,
  `orders_status` int(11) NOT NULL DEFAULT '1' COMMENT '1- new order, 2 - canceled order, 3 - completed order',
  `orders_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Очистить таблицу перед добавлением данных `orders`
--

TRUNCATE TABLE `orders`;
--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`orders_data`, `orders_client_id`, `orders_cost`, `orders_status`, `orders_id`) VALUES
('2017-10-19 17:31:17', 1, 561.00, 1, 1),
('2017-10-19 17:33:06', 2, 615.00, 2, 3),
('2017-10-19 18:03:10', 2, 738.00, 3, 4),
('2017-10-19 18:04:21', 2, 615.00, 1, 5),
('2017-10-23 15:11:50', 2, 550.80, 1, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `user`
--

TRUNCATE TABLE `user`;
--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `name`, `token`, `discount`) VALUES
(1, 'aleksandr', '698d51a19d8a121ce581499d7b701668', '', 'ZXURZK5ZGicB8a0', 8),
(2, 'test', '698d51a19d8a121ce581499d7b701668', '', '8z4cVA0PhRbsY4d', 10),
(3, 'newtest', '698d51a19d8a121ce581499d7b701668', '', 'XlYG5UbYSNVNJLO', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Индексы таблицы `author_book`
--
ALTER TABLE `author_book`
  ADD KEY `author_id` (`author_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Индексы таблицы `book_order`
--
ALTER TABLE `book_order`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Индексы таблицы `genre_book`
--
ALTER TABLE `genre_book`
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book_order`
--
ALTER TABLE `book_order`
  ADD CONSTRAINT `book_order_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
