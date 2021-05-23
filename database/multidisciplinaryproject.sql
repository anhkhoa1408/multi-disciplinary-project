-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2021 at 12:32 PM
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
  `ID` int NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `AIOKey` varchar(40) NOT NULL,
  `PassWord` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `UserName`, `AIOKey`, `PassWord`) VALUES
(3, 'khoa.nguyen1408', 'aio_nnTc48vgd4kwi5HGcQGQwWHNkoRj', 'Anhkhoanguyen123'),
(4, 'testAccount', 'aio_nnTc48vgd4kwi5HGcQGQwWHNkoRj', 'abcd123');

-- --------------------------------------------------------

--
-- Table structure for table `minimumparam`
--

CREATE TABLE `minimumparam` (
  `ID` int NOT NULL,
  `Temperature` int NOT NULL,
  `Humidity` int NOT NULL,
  `Created` datetime NOT NULL,
  `userID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `Temperature` int NOT NULL,
  `Humidity` int NOT NULL,
  `Time_Receive` datetime NOT NULL,
  `userID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`Temperature`, `Humidity`, `Time_Receive`, `userID`) VALUES
(4, 45, '2021-05-23 19:17:51', 3),
(49, 40, '2021-05-23 19:28:04', 4),
(8, 44, '2021-05-23 19:29:22', 4);

-- --------------------------------------------------------

--
-- Table structure for table `timesetting`
--

CREATE TABLE `timesetting` (
  `ID` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `userID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `timesetting`
--

INSERT INTO `timesetting` (`ID`, `start_time`, `end_time`, `userID`) VALUES
(2, '09:12:00', '12:00:00', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`,`UserName`);

--
-- Indexes for table `minimumparam`
--
ALTER TABLE `minimumparam`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`Time_Receive`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `timesetting`
--
ALTER TABLE `timesetting`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `minimumparam`
--
ALTER TABLE `minimumparam`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `minimumparam_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `accounts` (`ID`);

--
-- Constraints for table `parameter`
--
ALTER TABLE `parameter`
  ADD CONSTRAINT `parameter_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `accounts` (`ID`);

--
-- Constraints for table `timesetting`
--
ALTER TABLE `timesetting`
  ADD CONSTRAINT `timesetting_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `accounts` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
