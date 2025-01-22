-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 11:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ass_manger`
--

CREATE TABLE `ass_manger` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `e_contact` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'ACTIVE',
  `dates` varchar(100) NOT NULL,
  `inst` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `manger` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ass_manger`
--

INSERT INTO `ass_manger` (`id`, `name`, `contact`, `e_contact`, `username`, `branch`, `password`, `status`, `dates`, `inst`, `role`, `address`, `manger`) VALUES
(1, 'assm@nspe', '1111111111', '1111111111', 'assm@nspe.com', 'I-TECH NALLASOPARA-EAST', 'assm@nspe1', 'ACTIVE', '2024-09-20', 'I TECH', 'Assistance Manger', 'nil', 'PRIYA DESHMUKH'),
(2, 'assm@nspw', '2222222222', '2222222222', 'assm@nspw.com', 'I-TECH NALLASOPARA-WEST', 'assm@nspw1', 'ACTIVE', '2024-09-20', 'I TECH', 'Assistance Manger', 'nil', 'SUDIKSHA MOGERA'),
(3, 'assm@vasaiold', '3333333333', '3333333333', 'assm@vasaiold.com', 'I-TECH VASAI WEST', 'assm@vasaiold1', 'ACTIVE', '2024-09-20', 'I TECH', 'Assistance Manger', 'nil', 'PRIYANSHU JHA'),
(4, 'assm@vasainew.com', '4444444444', '4444444444', 'assm@vasainew.com', 'VASAI WEST NEW', 'assm@vasainew1', 'ACTIVE', '2024-09-20', 'I TECH', 'Assistance Manger', 'nil', 'GOHIL VIJAY MANOJ'),
(5, 'assm@nerul', '5555555555', '5555555555', 'assm@nerul.com', 'I-TECH-NERUL', 'assm@nerul1', 'ACTIVE', '2024-09-20', 'I TECH', 'Assistance Manger', 'nil', 'MEGHA SAWANT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ass_manger`
--
ALTER TABLE `ass_manger`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ass_manger`
--
ALTER TABLE `ass_manger`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
