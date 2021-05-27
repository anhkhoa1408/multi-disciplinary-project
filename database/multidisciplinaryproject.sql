-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2021 at 12:22 PM
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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `UserName` varchar(50) NOT NULL,
  `AIOKey` varchar(40) NOT NULL,
  `PassWord` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`UserName`, `AIOKey`, `PassWord`) VALUES
('khoa.nguyen1408', 'aio_bUAd97nQQdaIVzNRmAQx4MIOszNr', 'Anhkhoa123');

-- --------------------------------------------------------

--
-- Table structure for table `minimumparam`
--

CREATE TABLE `minimumparam` (
  `ID` int NOT NULL,
  `Temperature` int NOT NULL,
  `Humidity` int NOT NULL,
  `Created` datetime NOT NULL,
  `UserName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `minimumparam`
--

INSERT INTO `minimumparam` (`ID`, `Temperature`, `Humidity`, `Created`, `UserName`) VALUES
(2, 0, 20, '2021-05-26 20:54:15', 'khoa.nguyen1408'),
(3, 0, 20, '2021-05-26 20:55:08', 'khoa.nguyen1408'),
(4, 0, 20, '2021-05-26 21:04:06', 'khoa.nguyen1408'),
(5, 9, 20, '2021-05-26 21:04:11', 'khoa.nguyen1408');

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

-- --------------------------------------------------------

--
-- Table structure for table `timesetting`
--

CREATE TABLE `timesetting` (
  `ID` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `UserName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`UserName`);

--
-- Indexes for table `minimumparam`
--
ALTER TABLE `minimumparam`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserName` (`UserName`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`Time_Receive`),
  ADD KEY `UserName` (`UserName`);

--
-- Indexes for table `timesetting`
--
ALTER TABLE `timesetting`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserName` (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `minimumparam`
--
ALTER TABLE `minimumparam`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `timesetting`
--
ALTER TABLE `timesetting`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `minimumparam`
--
ALTER TABLE `minimumparam`
  ADD CONSTRAINT `minimumparam_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `accounts` (`UserName`);

--
-- Constraints for table `parameter`
--
ALTER TABLE `parameter`
  ADD CONSTRAINT `parameter_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `accounts` (`UserName`);

--
-- Constraints for table `timesetting`
--
ALTER TABLE `timesetting`
  ADD CONSTRAINT `timesetting_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `accounts` (`UserName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
