-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2021 at 03:36 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aqua_sense`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `sid` int(11) NOT NULL,
  `wtemp_low` varchar(10) NOT NULL,
  `wtemp_high` varchar(10) NOT NULL,
  `atemp_low` varchar(10) NOT NULL,
  `atemp_high` varchar(10) NOT NULL,
  `ph_low` varchar(10) NOT NULL,
  `ph_high` varchar(10) NOT NULL,
  `wlevel` varchar(10) NOT NULL,
  `light` varchar(10) NOT NULL,
  `humidity_low` varchar(10) NOT NULL,
  `humidity_high` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`sid`, `wtemp_low`, `wtemp_high`, `atemp_low`, `atemp_high`, `ph_low`, `ph_high`, `wlevel`, `light`, `humidity_low`, `humidity_high`) VALUES
(1, '20', '36', '24', '33', '5.7', '8.1', 'LOW', 'BRIGHT', '40', '71');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(3) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `first_name`, `last_name`, `email`) VALUES
(1, 'Thomas', 'Shelby', 'whanclarke@gmail.com'),
(2, 'Christopher', 'Goodluck', 'aspire.goodluck@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `id` int(6) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `sid` int(3) NOT NULL,
  `wtemp` float(5,1) NOT NULL,
  `ph` float(5,2) NOT NULL,
  `wlevel` varchar(10) NOT NULL,
  `atemp` float(5,1) NOT NULL,
  `humidity` int(3) NOT NULL,
  `light` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sensors`
--

INSERT INTO `sensors` (`id`, `date`, `time`, `sid`, `wtemp`, `ph`, `wlevel`, `atemp`, `humidity`, `light`) VALUES
(2, '2021-03-24', '12:13:09', 1, 27.2, 7.30, 'CRITICAL', 30.1, 23, 'VIVID'),
(3, '2021-03-24', '22:24:31', 1, 27.4, 7.40, 'CRITICAL', 30.4, 11, 'VIVID'),
(4, '2021-03-24', '23:38:59', 1, 27.5, 7.39, 'CRITICAL', 30.5, 24, 'ON'),
(5, '2021-03-25', '18:18:22', 1, 25.6, 6.90, 'CRITICAL', 31.4, 78, 'VIVID'),
(7, '2021-03-25', '18:34:36', 1, 28.7, 6.72, 'LOW', 31.3, 45, 'VIVID'),
(8, '2021-03-25', '18:36:01', 1, 27.1, 6.90, 'LOW', 30.5, 75, 'VIVID'),
(9, '2021-03-25', '23:41:59', 1, 28.1, 7.33, 'LOW', 31.2, 53, 'VIVID'),
(10, '2021-03-25', '23:48:57', 1, 28.2, 7.00, 'LOW', 30.6, 76, 'BRIGHT'),
(12, '2021-03-27', '11:33:18', 1, 24.8, 5.30, 'NORMAL', 31.6, 83, 'ON'),
(186, '2021-04-08', '16:30:26', 1, 28.9, 6.27, 'NORMAL', 0.0, 0, 'ON'),
(187, '2021-04-08', '16:33:32', 1, 28.9, 6.32, 'NORMAL', 30.1, 64, 'ON'),
(188, '2021-04-08', '16:38:33', 1, 28.9, 6.24, 'NORMAL', 30.1, 64, 'ON'),
(189, '2021-04-08', '16:43:35', 1, 28.9, 6.22, 'NORMAL', 30.1, 64, 'ON'),
(190, '2021-04-08', '16:48:36', 1, 28.9, 6.23, 'NORMAL', 30.1, 64, 'ON'),
(191, '2021-04-08', '16:53:37', 1, 28.9, 6.35, 'NORMAL', 30.1, 64, 'ON'),
(192, '2021-04-08', '16:58:38', 1, 28.9, 6.25, 'NORMAL', 30.1, 64, 'ON'),
(193, '2021-04-08', '17:03:39', 1, 28.9, 6.34, 'NORMAL', 30.1, 64, 'ON'),
(194, '2021-04-08', '17:08:40', 1, 28.8, 6.46, 'NORMAL', 30.1, 64, 'ON'),
(195, '2021-04-08', '17:13:41', 1, 28.8, 6.41, 'NORMAL', 30.1, 64, 'ON'),
(196, '2021-04-08', '17:18:42', 1, 28.8, 6.43, 'NORMAL', 30.1, 64, 'ON'),
(197, '2021-04-08', '17:23:43', 1, 28.8, 6.43, 'NORMAL', 30.1, 64, 'ON'),
(198, '2021-04-08', '17:28:44', 1, 28.8, 6.43, 'NORMAL', 30.1, 64, 'ON'),
(199, '2021-04-08', '17:33:45', 1, 28.8, 6.43, 'NORMAL', 30.1, 64, 'ON'),
(200, '2021-04-08', '17:38:46', 1, 28.8, 6.43, 'NORMAL', 30.1, 64, 'ON'),
(201, '2021-04-08', '17:43:47', 1, 28.8, 6.52, 'NORMAL', 30.1, 64, 'ON'),
(202, '2021-04-08', '17:48:48', 1, 28.8, 6.46, 'NORMAL', 30.1, 64, 'ON'),
(203, '2021-04-08', '17:53:49', 1, 28.8, 6.48, 'NORMAL', 30.1, 64, 'ON'),
(204, '2021-04-08', '17:58:51', 1, 28.8, 6.49, 'NORMAL', 30.1, 64, 'ON'),
(205, '2021-04-08', '18:03:52', 1, 28.8, 6.48, 'NORMAL', 30.1, 64, 'OFF'),
(206, '2021-04-08', '18:08:53', 1, 28.7, 6.51, 'NORMAL', 30.1, 64, 'OFF'),
(207, '2021-04-08', '18:13:54', 1, 28.7, 6.56, 'NORMAL', 30.1, 64, 'OFF'),
(208, '2021-04-08', '18:18:55', 1, 28.7, 6.55, 'NORMAL', 30.1, 64, 'OFF'),
(209, '2021-04-08', '18:23:56', 1, 28.7, 6.53, 'NORMAL', 30.1, 64, 'OFF'),
(210, '2021-04-08', '19:05:36', 1, 28.6, 6.52, 'NORMAL', 30.1, 64, 'ON'),
(211, '2021-04-08', '19:10:37', 1, 28.6, 6.76, 'NORMAL', 30.1, 64, 'ON');

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `sid` int(3) NOT NULL,
  `sname` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`sid`, `sname`) VALUES
(1, 'Room A'),
(2, 'Room B'),
(3, 'Room C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id`,`date`,`time`,`sid`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
