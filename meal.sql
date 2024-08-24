-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 24, 2024 at 01:18 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meal`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int NOT NULL,
  `user` varchar(100) NOT NULL,
  `money` varchar(100) NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `user`, `money`, `description`, `datetime`) VALUES
(1, 'Faruk', '500', 'Meal data update for: alu', '2024-08-12 10:36:18'),
(2, 'Faruk', '500', 'My personal data update for: kqsqqqq', '2024-08-12 10:37:19'),
(3, 'Faruk', '300', 'My personal data update for: wqhq', '2024-08-12 10:37:58'),
(4, 'Faruk', '400', 'My personal data update for: eihwirew', '2024-08-12 10:38:48'),
(5, 'Faruk', '400', 'Meal data update for: sdssdd', '2024-08-12 10:39:20');

-- --------------------------------------------------------

--
-- Table structure for table `m_account`
--

CREATE TABLE `m_account` (
  `id` int NOT NULL,
  `user` varchar(100) NOT NULL,
  `money` varchar(100) NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `m_account`
--

INSERT INTO `m_account` (`id`, `user`, `money`, `description`, `datetime`) VALUES
(1, 'Faruk', '500', 'Meal data update for: alu', '2024-08-12 10:36:18'),
(2, 'Faruk', '400', 'Meal data update for: sdssdd', '2024-08-12 10:39:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'Samiul', '$2y$10$HNUVW40z2MrXVwOJhpoeXu5IoXgFftX7hhBxk5JXhBDdehboBMBqG'),
(2, 'Faruk', '$2y$10$pTYIDJUl1wCHGaC8UGCfTOsCse9bbbrZliRmb2SsCkEG3XZU8zzhO'),
(3, 'Ridoy', '$2y$10$GtEk806t5RmUhM/sz64YtO6xyC77HvjJ7b0gSs5t8r19ST6G8qmYi');

-- --------------------------------------------------------

--
-- Table structure for table `users_account`
--

CREATE TABLE `users_account` (
  `id` int NOT NULL,
  `user` varchar(100) NOT NULL,
  `money` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_account`
--

INSERT INTO `users_account` (`id`, `user`, `money`, `description`, `datetime`) VALUES
(1, 'Faruk', '500', 'My personal data update for: kqsqqqq', '2024-08-12 10:37:19'),
(2, 'Faruk', '300', 'My personal data update for: wqhq', '2024-08-12 10:37:58'),
(3, 'Faruk', '400', 'My personal data update for: eihwirew', '2024-08-12 10:38:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_account`
--
ALTER TABLE `m_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_account`
--
ALTER TABLE `users_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_account`
--
ALTER TABLE `m_account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_account`
--
ALTER TABLE `users_account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
