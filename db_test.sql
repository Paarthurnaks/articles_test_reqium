-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 06 2021 г., 16:23
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `t_articles`
--

CREATE TABLE `t_articles` (
  `ID` int NOT NULL,
  `TITLE` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `DESCRIPTION` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CATEGORY_ID` int NOT NULL,
  `DATE_CREATE` datetime NOT NULL,
  `DATE_UPDATE` datetime NOT NULL,
  `AUTHOR_ID` int NOT NULL,
  `KEYWORDS` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `IMAGE` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_articles`
--

INSERT INTO `t_articles` (`ID`, `TITLE`, `DESCRIPTION`, `CATEGORY_ID`, `DATE_CREATE`, `DATE_UPDATE`, `AUTHOR_ID`, `KEYWORDS`, `IMAGE`) VALUES
(1, 'тестовая статья', 'какой-то хтмл код', 1, '2021-07-06 03:37:49', '2021-07-06 03:37:49', 1, 'test', '/images/test.png'),
(2, 'тестовая статья 2', 'какой-то хтмл код', 1, '2021-07-06 03:38:18', '2021-07-06 03:38:18', 1, 'test', '/images/test.png'),
(3, 'тестовая статья 3', 'какой-то хтмл код', 1, '2021-07-06 03:38:24', '2021-07-06 03:38:24', 1, 'test', '/images/test.png'),
(4, 'тестовая статья 4', 'какой-то хтмл код', 1, '2021-07-06 03:38:39', '2021-07-06 03:38:39', 1, 'test', '/images/test.png'),
(5, 'тестовая статья 5', 'какой-то хтмл код', 1, '2021-07-06 03:38:44', '2021-07-06 03:38:44', 1, 'test', '/images/test.png'),
(6, 'тестовая статья 6', 'какой-то хтмл код', 1, '2021-07-06 03:38:52', '2021-07-06 03:55:21', 1, 'test2,test3', '/images/test.png'),
(7, 'тестовая статья 7', 'какой-то хтмл код', 1, '2021-07-06 03:38:56', '2021-07-06 03:38:56', 1, 'test', '/images/test.png'),
(8, 'тестовая статья 8', 'какой-то хтмл код', 1, '2021-07-06 03:38:59', '2021-07-06 03:38:59', 1, 'test', '/images/test.png');

-- --------------------------------------------------------

--
-- Структура таблицы `t_categories`
--

CREATE TABLE `t_categories` (
  `ID` int NOT NULL,
  `TITLE` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `DESCRIPTION` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_categories`
--

INSERT INTO `t_categories` (`ID`, `TITLE`, `DESCRIPTION`) VALUES
(1, 'Тест', ''),
(2, 'Test2', 'Вторая тестовая категория');

-- --------------------------------------------------------

--
-- Структура таблицы `t_users`
--

CREATE TABLE `t_users` (
  `ID` int NOT NULL,
  `USER_NAME` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `NAME` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `LAST_NAME` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PASSWORD` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_users`
--

INSERT INTO `t_users` (`ID`, `USER_NAME`, `NAME`, `LAST_NAME`, `PASSWORD`) VALUES
(1, 'test', 'test', 'test', 'test');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `t_articles`
--
ALTER TABLE `t_articles`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AUTHOR_ID` (`AUTHOR_ID`),
  ADD KEY `CATEGORY_ID` (`CATEGORY_ID`);

--
-- Индексы таблицы `t_categories`
--
ALTER TABLE `t_categories`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `t_articles`
--
ALTER TABLE `t_articles`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `t_categories`
--
ALTER TABLE `t_categories`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `t_users`
--
ALTER TABLE `t_users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `t_articles`
--
ALTER TABLE `t_articles`
  ADD CONSTRAINT `t_articles_ibfk_1` FOREIGN KEY (`AUTHOR_ID`) REFERENCES `t_users` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `t_articles_ibfk_2` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `t_categories` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
