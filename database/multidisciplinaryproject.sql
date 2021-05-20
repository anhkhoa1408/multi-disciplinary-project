-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th5 20, 2021 lúc 11:52 AM
-- Phiên bản máy phục vụ: 8.0.24
-- Phiên bản PHP: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `multidisciplinaryproject`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `ID` int NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `PassWord` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`ID`, `UserName`, `PassWord`) VALUES
(14, 'khoa.nguyen1408', 'Anhkhoanguyen123'),
(15, 'khoa.nguyen1408', 'Anhkhoanguyen123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `minimumparam`
--

CREATE TABLE `minimumparam` (
  `ID` int NOT NULL,
  `Temperature` int NOT NULL,
  `Humidity` int NOT NULL,
  `Created` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `parameter`
--

CREATE TABLE `parameter` (
  `ID` int NOT NULL,
  `Temperature` int NOT NULL,
  `Humidity` int NOT NULL,
  `Time_Receive` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `timesetting`
--

CREATE TABLE `timesetting` (
  `ID` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `timesetting`
--

INSERT INTO `timesetting` (`ID`, `start_time`, `end_time`) VALUES
(1, '05:55:00', '12:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`,`UserName`);

--
-- Chỉ mục cho bảng `minimumparam`
--
ALTER TABLE `minimumparam`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`ID`,`Time_Receive`);

--
-- Chỉ mục cho bảng `timesetting`
--
ALTER TABLE `timesetting`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `minimumparam`
--
ALTER TABLE `minimumparam`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `parameter`
--
ALTER TABLE `parameter`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `timesetting`
--
ALTER TABLE `timesetting`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
