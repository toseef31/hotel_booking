-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2020 at 03:02 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alschat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_admin`
--

CREATE TABLE `chat_admin` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('admin','jobs','quote','payment') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chat_admin`
--

INSERT INTO `chat_admin` (`id`, `name`, `role`, `email`, `password`, `created_at`) VALUES
(1, 'nabeel', 'admin', 'peek@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-10-20 22:09:33'),
(2, 'a admin', 'jobs', 'a@admin.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-12-02 13:18:59'),
(3, 'b admin', 'quote', 'b@admin.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-12-02 13:18:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_admin`
--
ALTER TABLE `chat_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_admin`
--
ALTER TABLE `chat_admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
