-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2020 at 03:58 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `number`, `address`, `image`) VALUES
(1, 'leo martin barbara', '09123456789', '123 san carlos city', 'avatar.png'),
(2, 'john michael jackson', '09341345313', '324 poblacion', 'avatar2.png'),
(9, 'Mr Lucas', '09123123234', '123 bonifacio', 'man-657869_1920.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(255) NOT NULL,
  `sendto` int(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `sendto`, `duration`, `timestamp`) VALUES
(1, 2, '5', '2020-02-05 10:43:17.000000'),
(2, 2, '3', '2020-02-05 10:43:35.000000'),
(3, 2, '4', '2020-02-05 10:51:07.000000'),
(4, 1, '2', '2020-02-05 10:51:18.000000'),
(5, 1, '4', '2020-02-05 10:51:55.000000'),
(6, 2, '5', '2020-02-05 10:52:19.000000'),
(7, 2, '4', '2020-02-05 18:53:12.000000'),
(8, 1, '3', '2020-02-05 18:54:10.000000');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(255) NOT NULL,
  `sendto` int(255) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sendto`, `message`, `timestamp`) VALUES
(1, 1, 'lets goo', '2020-02-05 15:43:00.000000'),
(2, 1, 'where na u??', '2020-02-04 17:00:00.000000'),
(3, 2, 'hi', '2020-02-05 09:18:05.000000'),
(4, 2, 'hello', '2020-02-05 09:18:18.000000'),
(5, 2, '', '2020-02-05 09:23:29.000000'),
(6, 2, 'we', '2020-02-05 09:27:12.000000'),
(7, 1, 'lo', '2020-02-05 09:27:22.000000'),
(8, 2, 'nice', '2020-02-05 09:27:48.000000'),
(9, 1, 'wdwd', '2020-02-05 09:30:17.000000'),
(10, 1, 'sd', '2020-02-05 09:31:06.000000'),
(11, 2, 'wdwd', '2020-02-05 09:31:10.000000'),
(12, 2, 'sup', '2020-02-05 09:46:28.000000'),
(13, 1, 'hey ', '2020-02-05 09:46:41.000000'),
(14, 2, 'df', '2020-02-05 09:47:13.000000'),
(15, 1, 'water', '2020-02-05 18:54:03.000000'),
(16, 2, 'musta??', '2020-02-05 18:54:19.000000'),
(17, 9, 'men', '2020-02-05 18:54:58.000000'),
(18, 2, 'sup??', '2020-02-05 18:56:07.000000');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` bigint(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `owner` int(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projectmembers`
--

CREATE TABLE `projectmembers` (
  `projectD` bigint(255) NOT NULL,
  `teamID` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teammembers`
--

CREATE TABLE `teammembers` (
  `teamID` bigint(255) NOT NULL,
  `memberID` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `role` enum('1','2','3','4') DEFAULT NULL,
  `lastlogin` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `role`, `lastlogin`) VALUES
(1, '12345@gmail.com', '$2y$10$mWesohOrz0BdxCSMjUX8mO/AnEpcGl0Gi1zs2sm1EHk7rA.F1M2Qe', 'admin', 'admin', '', '2020-04-24 22:39:38.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
