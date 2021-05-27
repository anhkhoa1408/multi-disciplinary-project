-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2021 at 12:23 PM
-- Server version: 8.0.24
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multidisciplinaryproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `Temperature` int NOT NULL,
  `Humidity` int NOT NULL,
  `Time_Receive` datetime NOT NULL,
  `UserName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`Temperature`, `Humidity`, `Time_Receive`, `UserName`) VALUES
(21, 89, '2021-05-26 20:38:53', 'khoa.nguyen1408'),
(47, 72, '2021-05-26 21:08:20', 'khoa.nguyen1408'),
(49, 89, '2021-05-26 21:44:30', 'khoa.nguyen1408'),
(25, 5, '2021-05-27 10:48:33', 'khoa.nguyen1408'),
(25, 5, '2021-05-27 10:50:30', 'khoa.nguyen1408'),
(24, 5, '2021-05-27 15:36:24', 'khoa.nguyen1408'),
(24, 5, '2021-05-27 16:44:05', 'khoa.nguyen1408'),
(23, 5, '2021-05-27 17:21:29', 'khoa.nguyen1408');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`Time_Receive`),
  ADD KEY `UserName` (`UserName`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parameter`
--
ALTER TABLE `parameter`
  ADD CONSTRAINT `parameter_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `accounts` (`UserName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
