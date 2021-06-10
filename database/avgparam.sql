-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2021 at 12:30 PM
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
-- Table structure for table `avgparam`
--

CREATE TABLE `avgparam` (
  `Time` datetime NOT NULL,
  `Average_Temperature` float NOT NULL,
  `Average_Humidity` float NOT NULL,
  `UserName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `avgparam`
--

INSERT INTO `avgparam` (`Time`, `Average_Temperature`, `Average_Humidity`, `UserName`) VALUES
('2021-06-09 22:33:20', 40.71, 28.66, 'anhkhoa1408'),
('2021-06-10 19:23:22', 35.27, 47.73, 'anhkhoa1408');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avgparam`
--
ALTER TABLE `avgparam`
  ADD PRIMARY KEY (`Time`),
  ADD KEY `UserName` (`UserName`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avgparam`
--
ALTER TABLE `avgparam`
  ADD CONSTRAINT `avgparam_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `accounts` (`UserName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
