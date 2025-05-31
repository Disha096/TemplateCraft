-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2025 at 07:26 PM
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
-- Database: `templatecraft`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_logindata`
--

CREATE TABLE `admin_logindata` (
  `ID` int(100) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `usertype` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_logindata`
--

INSERT INTO `admin_logindata` (`ID`, `name`, `email`, `password`, `usertype`) VALUES
(2, 'Admin', 'admin@mes.ac.in', 'mes@123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `filename`, `filepath`, `file_type`, `uploaded_at`) VALUES
(6, 'Front Page.docx', 'uploads/Front Page.docx', 'docx', '2025-02-13 06:15:11'),
(7, 'Report Format.docx', 'uploads/Report Format.docx', 'docx', '2025-02-13 06:15:27'),
(12, 'TemplateCraftSA', 'uploads/file_680bc459ca23a8.09014023.pdf', 'pdf', '2025-04-25 17:20:25'),
(13, 'notice (1).docx', 'uploads/notice (1).docx', NULL, '2025-04-26 06:31:04'),
(14, 'defaulter attendance.xlsx', 'uploads/defaulter attendance.xlsx', NULL, '2025-04-26 06:33:44'),
(15, 'Continous_Assessment sheet.xlsx', 'uploads/Continous_Assessment sheet.xlsx', NULL, '2025-04-26 06:33:52'),
(16, 'SEM VI- COMPUTER- REV- 19 C- MAY-2024.pdf', 'uploads/SEM VI- COMPUTER- REV- 19 C- MAY-2024.pdf', NULL, '2025-04-26 06:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_logindata`
--

CREATE TABLE `user_logindata` (
  `ID` int(100) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `usertype` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logindata`
--

INSERT INTO `user_logindata` (`ID`, `name`, `email`, `password`, `usertype`) VALUES
(6, 'Disha Mayuresh Naik', 'dishamn22hcompe@student.mes.ac.in', 'z', 'user'),
(7, 'Saloni Patil', 'salonivp22hcompe@student.mes.ac.in', 'asdfghjkl', 'user'),
(8, 'Rashmi Mokal', 'rashmibm22hcompe@student.mes.ac.in', 'qertyuiop', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_logindata`
--
ALTER TABLE `admin_logindata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logindata`
--
ALTER TABLE `user_logindata`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_logindata`
--
ALTER TABLE `admin_logindata`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_logindata`
--
ALTER TABLE `user_logindata`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
