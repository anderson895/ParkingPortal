-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 07:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `carName` varchar(60) NOT NULL,
  `carType` varchar(60) NOT NULL,
  `plateNumber` varchar(60) NOT NULL,
  `condo` varchar(60) NOT NULL,
  `RFID` varchar(60) NOT NULL,
  `CarImage` varchar(255) NOT NULL,
  `carStatus` int(11) NOT NULL DEFAULT 1 COMMENT '0=archive, 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `carName`, `carType`, `plateNumber`, `condo`, `RFID`, `CarImage`, `carStatus`) VALUES
(10, 'Joshua Padilla', 'A', '123123', '323423', '4444', 'car_67396c723b97f5.52945636.jpeg', 1),
(11, 'April Jane', 'H', '654645', 'wqqwe12', '1223443', 'car_673977667e5980.40155464.jpeg', 0),
(12, 'Mary Jane', 'C', '2154A', '0001', '5443312', 'car_6739776f5d2331.97468192.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `time_logs`
--

CREATE TABLE `time_logs` (
  `time_id` int(11) NOT NULL,
  `time_car_id` int(11) NOT NULL,
  `time_date` date NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_logs`
--

INSERT INTO `time_logs` (`time_id`, `time_car_id`, `time_date`, `time_in`, `time_out`) VALUES
(2, 11, '2024-11-16', '2024-11-16 05:33:27', '2024-11-16 13:03:53'),
(3, 11, '2024-11-15', '2024-11-16 05:33:27', '2024-11-16 13:03:53'),
(4, 11, '2024-11-17', '2024-11-16 05:33:27', '2024-11-16 13:03:53'),
(5, 10, '2024-11-17', '2024-11-16 05:33:27', '2024-11-16 13:03:53'),
(6, 10, '2024-10-17', '2024-10-16 05:33:27', '2024-10-16 13:03:53'),
(7, 12, '2023-06-17', '2024-11-17 07:26:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD PRIMARY KEY (`time_id`),
  ADD KEY `time_car_id` (`time_car_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `time_logs`
--
ALTER TABLE `time_logs`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD CONSTRAINT `time_logs_ibfk_1` FOREIGN KEY (`time_car_id`) REFERENCES `cars` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
