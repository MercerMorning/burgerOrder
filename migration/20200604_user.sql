-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Ð¥Ð¾ÑÑ‚: 127.0.0.1:3306
-- Ð’Ñ€ÐµÐ¼Ñ ÑÐ¾Ð·Ð´Ð°Ð½Ð¸Ñ: Ð˜ÑŽÐ½ 05 2020 Ð³., 15:34
-- Ð’ÐµÑ€ÑÐ¸Ñ ÑÐµÑ€Ð²ÐµÑ€Ð°: 10.3.22-MariaDB
-- Ð’ÐµÑ€ÑÐ¸Ñ PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Ð‘Ð°Ð·Ð° Ð´Ð°Ð½Ð½Ñ‹Ñ…: `users_bd`
--
CREATE DATABASE IF NOT EXISTS `users_bd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `users_bd`;

-- --------------------------------------------------------

--
-- Ð¡Ñ‚Ñ€ÑƒÐºÑ‚ÑƒÑ€Ð° Ñ‚Ð°Ð±Ð»Ð¸Ñ†Ñ‹ `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `order_count` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Ð”Ð°Ð¼Ð¿ Ð´Ð°Ð½Ð½Ñ‹Ñ… Ñ‚Ð°Ð±Ð»Ð¸Ñ†Ñ‹ `users`
--

INSERT INTO `users` (`id`, `email`, `order_count`) VALUES
(1, 'hugopochta@gmail.com', 32),
(2, 'fdfd', 3),
(3, 'Ð°', 4),
(4, 'nikovasik.0@mail.ru', 15);

--
-- Ð˜Ð½Ð´ÐµÐºÑÑ‹ ÑÐ¾Ñ…Ñ€Ð°Ð½Ñ‘Ð½Ð½Ñ‹Ñ… Ñ‚Ð°Ð±Ð»Ð¸Ñ†
--

--
-- Ð˜Ð½Ð´ÐµÐºÑÑ‹ Ñ‚Ð°Ð±Ð»Ð¸Ñ†Ñ‹ `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT Ð´Ð»Ñ ÑÐ¾Ñ…Ñ€Ð°Ð½Ñ‘Ð½Ð½Ñ‹Ñ… Ñ‚Ð°Ð±Ð»Ð¸Ñ†
--

--
-- AUTO_INCREMENT Ð´Ð»Ñ Ñ‚Ð°Ð±Ð»Ð¸Ñ†Ñ‹ `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
