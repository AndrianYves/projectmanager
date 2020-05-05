-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2020 at 11:27 AM
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
-- Table structure for table `aboutme`
--

CREATE TABLE `aboutme` (
  `id` int(255) NOT NULL,
  `userID` bigint(255) NOT NULL,
  `education` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `datestart` varchar(255) NOT NULL,
  `dateend` varchar(255) NOT NULL,
  `status` enum('on going','finished','cancellled','') NOT NULL,
  `owner` int(255) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `location`, `datestart`, `dateend`, `status`, `owner`, `timestamp`) VALUES
(1, 'inventory system', 'water refilling district 12', 'baguio', '2020-05-01', '2020-05-31', 'on going', 1, '2020-05-05 07:15:05.000000'),
(2, 'quiz', 'quizz', 'new lucban', '2020-05-01', '2020-05-31', 'on going', 1, '2020-05-05 08:18:51.000000'),
(3, 'megaphone', 'create', 'city hall', '2020-05-01', '2020-05-31', 'on going', 4, '2020-05-05 08:30:36.000000'),
(4, 'industrial trial', 'trial', 'brookside', '2020-05-01', '2020-05-31', 'on going', 4, '2020-05-05 08:45:10.000000'),
(5, 'cellphone', 'mobile', 'holy', '2020-05-16', '2020-05-25', 'on going', 4, '2020-05-05 08:58:24.000000'),
(6, 'laptop', 'dell', 'dau', '2020-05-01', '2020-05-14', 'on going', 4, '2020-05-05 09:00:34.000000'),
(7, 'pc', 'pc', 'dau', '2020-05-01', '2020-05-06', 'on going', 4, '2020-05-05 09:01:34.000000'),
(8, 'smart phone', 'dd', 'asds', '2020-05-01', '2020-05-06', 'on going', 4, '2020-05-05 09:02:09.000000');

-- --------------------------------------------------------

--
-- Table structure for table `projectmembers`
--

CREATE TABLE `projectmembers` (
  `projectID` bigint(255) NOT NULL,
  `userID` bigint(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projectmembers`
--

INSERT INTO `projectmembers` (`projectID`, `userID`, `role`) VALUES
(1, 1, 'Project Manager'),
(1, 2, NULL),
(1, 3, NULL),
(1, 4, NULL),
(1, 5, NULL),
(2, 1, 'Project Manager'),
(2, 5, NULL),
(3, 1, NULL),
(3, 2, NULL),
(3, 3, NULL),
(3, 4, NULL),
(3, 5, NULL),
(4, 1, NULL),
(4, 2, NULL),
(4, 3, NULL),
(4, 4, NULL),
(4, 5, NULL),
(7, 4, 'Project Manager'),
(8, 2, NULL),
(8, 3, NULL),
(8, 4, 'Project Manager');

-- --------------------------------------------------------

--
-- Table structure for table `projectteams`
--

CREATE TABLE `projectteams` (
  `projectID` bigint(255) NOT NULL,
  `teamID` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projectteams`
--

INSERT INTO `projectteams` (`projectID`, `teamID`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(8, 1),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`) VALUES
(1, 'alpha'),
(2, 'beta'),
(3, 'charlie'),
(4, 'delta'),
(5, 'foxtrot'),
(6, ''),
(7, 'howard');

-- --------------------------------------------------------

--
-- Table structure for table `teammembers`
--

CREATE TABLE `teammembers` (
  `teamID` bigint(255) NOT NULL,
  `userID` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teammembers`
--

INSERT INTO `teammembers` (`teamID`, `userID`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 5),
(6, 1),
(6, 3),
(7, 1),
(7, 3);

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
  `lastlogin` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `lastlogin`) VALUES
(1, '12345@gmail.com', '$2y$10$mWesohOrz0BdxCSMjUX8mO/AnEpcGl0Gi1zs2sm1EHk7rA.F1M2Qe', 'admin', 'admin', '2020-05-05 07:11:03.000000'),
(2, 'adawd@gmail.com', '$2y$10$UwQe/JSTdhFaF6H2tCn2vOoHfmzXtHj9akuWPfC7DjT09bqv3OTUi', 'andrian yves', 'macalino', '2020-04-28 01:54:17.000000'),
(3, 'john@gmail.com', '$2y$10$mWesohOrz0BdxCSMjUX8mO/AnEpcGl0Gi1zs2sm1EHk7rA.F1M2Qe', 'john', 'john', '2020-05-05 07:09:21.000000'),
(4, 'mark@gmail.com', '$2y$10$mWesohOrz0BdxCSMjUX8mO/AnEpcGl0Gi1zs2sm1EHk7rA.F1M2Qe', 'mark', 'mark', '2020-05-05 07:27:35.000000'),
(5, 'peter@gmail.com', '$2y$10$mWesohOrz0BdxCSMjUX8mO/AnEpcGl0Gi1zs2sm1EHk7rA.F1M2Qe', 'peter', 'peter', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutme`
--
ALTER TABLE `aboutme`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projectmembers`
--
ALTER TABLE `projectmembers`
  ADD UNIQUE KEY `projectID` (`projectID`,`userID`);

--
-- Indexes for table `projectteams`
--
ALTER TABLE `projectteams`
  ADD UNIQUE KEY `projectID` (`projectID`,`teamID`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teammembers`
--
ALTER TABLE `teammembers`
  ADD UNIQUE KEY `teamID` (`teamID`,`userID`);

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
-- AUTO_INCREMENT for table `aboutme`
--
ALTER TABLE `aboutme`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
