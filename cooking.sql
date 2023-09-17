-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 17 2023 г., 18:44
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cooking`
--

-- --------------------------------------------------------

--
-- Структура таблицы `composition`
--

CREATE TABLE `composition` (
  `id` int NOT NULL,
  `dishes_id` int NOT NULL,
  `quantity` float NOT NULL,
  `pre_processing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `many_portions` int UNSIGNED NOT NULL,
  `priority` int UNSIGNED NOT NULL,
  `products_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `composition`
--

INSERT INTO `composition` (`id`, `dishes_id`, `quantity`, `pre_processing`, `many_portions`, `priority`, `products_id`) VALUES
(13, 1, 2, 'очистить', 1, 1, 1),
(14, 1, 3, 'нет', 1, 2, 2),
(15, 1, 5, 'сварить', 1, 3, 3),
(16, 1, 0.5, 'нет', 1, 4, 4),
(17, 1, 1, 'нет', 1, 5, 5),
(18, 1, 0.01, 'нет', 1, 6, 6),
(37, 4, 3, 'нет', 3, 3, 7),
(38, 4, 1, 'пассировка', 3, 1, 8),
(39, 4, 1, 'пассировка', 3, 2, 9),
(40, 4, 0.01, 'нет', 3, 4, 10),
(41, 4, 0.01, 'нет', 3, 5, 6),
(42, 4, 1, 'нет', 3, 6, 5),
(43, 5, 1, 'нет', 10, 3, 11),
(44, 5, 2, 'пассировка', 10, 1, 8),
(45, 5, 2, 'пассировка', 10, 2, 9),
(46, 5, 0.1, 'нет', 10, 4, 10),
(47, 5, 0.1, 'нет', 10, 5, 6),
(48, 5, 0.1, 'нет', 10, 6, 12),
(57, 6, 100, 'нет', 10, 1, 16),
(58, 6, 100, 'нет', 10, 2, 15),
(59, 6, 100, 'нет', 10, 3, 17),
(60, 6, 100, 'нет', 10, 4, 18),
(61, 6, 100, 'нет', 10, 5, 19),
(62, 6, 3, 'нет', 10, 6, 3),
(63, 6, 100, 'просеять', 10, 7, 13),
(64, 6, 100, 'нет', 10, 8, 14);

-- --------------------------------------------------------

--
-- Структура таблицы `dishes`
--

CREATE TABLE `dishes` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `weight` int NOT NULL,
  `recipe` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `dishes`
--

INSERT INTO `dishes` (`id`, `title`, `category`, `weight`, `recipe`) VALUES
(1, 'Салат \"Нидерланды\"', 'Второе блюдо', 250, 'Нарезать дольками огурцы\r\nСыр натереть на крупной терке\r\nСваренные яйца нарезать кубиками\r\nДобавить соль, майонез\r\nДобавить зелень и перемешать'),
(4, 'Простой суп', 'Первое блюдо', 500, 'Нарезать картофель, лук, морковь.\r\nЛук, морковь обжарить на растительном масле.\r\nПереложить в кастрюлю и залить водой.\r\nВарить до готовности картофель. Добавить зелень и соль.'),
(5, 'Тушенная курица', 'Первое блюдо', 1000, 'Курицу разрезать на кусочки. Порезать лук,морковь, пожарить на растительном масле. Добавить курицу. Тушить до готовности курицы. Добавить соль и перец.'),
(6, 'Имбирное печенье', 'десерты', 600, 'В миске смешать имбирь, корицу, гвоздику и соду. Просеять муку. В отдельной посуде растереть сливочное масло и сахар, добавить яйца. Смешать и взбить все до  однородной массы. Полученное тесто заморозить на 30-60 минут (пока не затвердеет). Достать и раскатать тесто. Вырезать формами печенье. Выпекать при 180 градусах по 3-6 минут.');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `calories` int UNSIGNED NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int UNSIGNED NOT NULL,
  `measurements` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `calories`, `category`, `price`, `measurements`) VALUES
(1, 'огурец', 15, 'овощ', 15, 'шт'),
(2, 'сыр твердый', 350, 'сыры', 100, 'грамм'),
(3, 'яйца куриные', 143, 'яйца', 8, 'шт'),
(4, 'Майонез', 680, 'соусы', 180, 'л'),
(5, 'Укроп', 40, 'зелень', 50, 'грамм'),
(6, 'Соль поваренная пищевая', 0, 'специи', 20, 'кг'),
(7, 'Картофель', 77, 'овощи', 20, 'шт'),
(8, 'Лук репчатый', 50, 'овощи', 15, 'шт'),
(9, 'Морковь', 10, 'овощи', 70, 'шт'),
(10, 'Растительное масло', 100, 'масло', 120, 'литр'),
(11, 'Грудка куриная', 1130, 'мясо', 80, 'кг'),
(12, 'Черный перец (молотый)', 254, 'пряность', 30, 'грамм'),
(13, 'Пшеничная мука', 100, 'мука', 100, 'кг'),
(14, 'Сода', 380, 'разрыхлитель', 50, 'кг'),
(15, 'Молотая корица', 100, 'пряность', 50, 'грамм'),
(16, 'Молотый имбирь', 100, 'пряность', 100, 'грамм'),
(17, 'Молотая гвоздика', 100, 'пряность', 100, 'грамм'),
(18, 'Сливочное масло', 100, 'масло', 100, 'грамм'),
(19, 'Сахар', 500, 'специи', 100, 'кг');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `email`, `phone`, `login`, `password`, `token`) VALUES
(1, 'Семенов Даниил', 'daniil@gmail.com', '+7 981 740 69 42', 'daniil', '$2y$13$WlKeopOqezZFeRS8.XIxme4ct8UgPfm73TvT77jx5iP4GMt0F1.aO', 'mbpvOpHTC0G9lSYi96SJZNUs4AL-Ayy_');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `composition`
--
ALTER TABLE `composition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dishes_id` (`dishes_id`),
  ADD KEY `products_id` (`products_id`);

--
-- Индексы таблицы `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `login_2` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `composition`
--
ALTER TABLE `composition`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT для таблицы `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `composition`
--
ALTER TABLE `composition`
  ADD CONSTRAINT `composition_ibfk_1` FOREIGN KEY (`dishes_id`) REFERENCES `dishes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `composition_ibfk_2` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
