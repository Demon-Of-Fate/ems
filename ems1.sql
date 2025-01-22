-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 02:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `centre_master`
--

CREATE TABLE `centre_master` (
  `centre_code` varchar(100) NOT NULL,
  `centre_name` varchar(100) NOT NULL,
  `centre_location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `centre_master`
--

INSERT INTO `centre_master` (`centre_code`, `centre_name`, `centre_location`) VALUES
('HO1#', 'Head Office', 'Nallasopra West'),
('NERUL 6#', 'NERUL WEST', 'NERUL WEST'),
('NSP (EAST) 3#', 'NSP (EAST) TULINJ', 'NSP (EAST) TULINJ'),
('NSP (WEST) 2#', 'NSP (WEST)', 'NSP WEST CIVIC CENTER'),
('VASAI (WEST ) 4#', 'VASAI (WEST ) NEW', 'VASAI (WEST )  TUNGARESHWAR SWEETS'),
('VASAI (WEST ) 5#', 'VASAI (WEST ) OLD', 'VASAI (WEST ) DHURI MEDICAL');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Department` varchar(200) NOT NULL,
  `depid` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Department`, `depid`) VALUES
('Accounts', 1),
('Admin ', 2),
('Call Center', 3),
('Front office', 4),
('IT', 5),
('magician', 9),
('Marketing', 6),
('place', 8),
('Placement', 7);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation` varchar(200) NOT NULL,
  `desigid` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation`, `desigid`) VALUES
('accounts- executive', 24),
('adddddsdf', 31),
('admin executive', 30),
('bdm', 0),
('business development executive', 29),
('business development manager', 17),
('centre coordinator', 4),
('centre head', 1),
('concealer', 2),
('designation', 0),
('digital marketing associate', 1),
('digital markting- intern', 28),
('HR & placement coordinator', 22),
('HR & placement executive', 21),
('HR executive', 20),
('jr Accountant', 2),
('marketing executive', 5),
('office assistant', 25),
('operations- coordinator', 23),
('placement executive', 19),
('programmer software', 26),
('receptionist', 18),
('sdfsd', 32),
('senior concealer', 3),
('Software dev', 3),
('software- intern', 27),
('tele- caller', 9),
('tele- concealer', 10),
('trainer- 4 module', 6),
('trainer- animation', 13),
('trainer- animation & VFX', 14),
('trainer- data science', 8),
('trainer- digital markting', 16),
('trainer- graphics & animation', 15),
('trainer- hardware', 11),
('trainer-graphics', 12),
('trainer-software', 7);

-- --------------------------------------------------------

--
-- Table structure for table `employee_master`
--

CREATE TABLE `employee_master` (
  `empid` int(11) NOT NULL,
  `ename` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `emp_joining_date` date NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_gender` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_phone_no` varchar(255) NOT NULL,
  `emp_alt_contact_no` varchar(255) NOT NULL,
  `emp_address` varchar(255) NOT NULL,
  `emp_city` varchar(255) NOT NULL,
  `emp_pincode` varchar(255) NOT NULL,
  `emp_salary` varchar(255) NOT NULL,
  `centre_id` varchar(100) NOT NULL,
  `incentive` char(3) NOT NULL,
  `emp_status` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_branch` varchar(255) NOT NULL,
  `bank_account_name` varchar(255) NOT NULL,
  `bank_account_no` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `login_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'user.png',
  `department` varchar(100) NOT NULL,
  `EmpCode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_master`
--

INSERT INTO `employee_master` (`empid`, `ename`, `designation`, `role`, `emp_joining_date`, `emp_dob`, `emp_gender`, `marital_status`, `emp_email`, `emp_phone_no`, `emp_alt_contact_no`, `emp_address`, `emp_city`, `emp_pincode`, `emp_salary`, `centre_id`, `incentive`, `emp_status`, `bank_name`, `bank_branch`, `bank_account_name`, `bank_account_no`, `ifsc_code`, `login_name`, `password`, `profile_picture`, `department`, `EmpCode`) VALUES
(1, 'Ashish A .Tiwari', 'bdm', 'ADMIN', '2024-09-26', '2025-01-13', 'MALE', 'UNMARRIED', 'at674295@gmail.com', '7058540635', '7058540635', 'nallasopra tulinj road', 'Palghar', '401209', 'nill', 'HO1#', 'no', 'ACTIVE', 'HDFC', 'BORIVALI EAST', 'Ashish Tiwari', '1234567898', '12232434', 'Ashish@itech.com', 'Ashish@123', 'user.png', 'IT', 'cde234'),
(12, 'rohan', 'bdm', 'EMPLOYEE', '2025-01-06', '2024-12-31', 'male', 'single', 'rohan@gmail.com', '1212121213', '1212121213', 'mumbai', 'mumbai', '23232323', '30000', 'HO1#', 'no', 'active', 'icicic', 'vasai', 'rohan', '12121212', '2323223', 'rohan@gmail.com', 'rohan@gmail.com', '', 'IT', '23derr');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `userid` int(11) NOT NULL,
  `userrole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`userid`, `userrole`) VALUES
(4, 'ACCOUNTS - ADMIN'),
(1, 'ADMIN'),
(3, 'EMPLOYEE'),
(2, 'HR - ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centre_master`
--
ALTER TABLE `centre_master`
  ADD PRIMARY KEY (`centre_code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Department`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation`);

--
-- Indexes for table `employee_master`
--
ALTER TABLE `employee_master`
  ADD PRIMARY KEY (`empid`),
  ADD KEY `fkuserrole` (`role`),
  ADD KEY `fk_centerid` (`centre_id`),
  ADD KEY `department` (`department`),
  ADD KEY `designation` (`designation`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `userrole` (`userrole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_master`
--
ALTER TABLE `employee_master`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_master`
--
ALTER TABLE `employee_master`
  ADD CONSTRAINT `employee_master_ibfk_1` FOREIGN KEY (`department`) REFERENCES `department` (`Department`),
  ADD CONSTRAINT `employee_master_ibfk_2` FOREIGN KEY (`designation`) REFERENCES `designation` (`designation`),
  ADD CONSTRAINT `fk_centerid` FOREIGN KEY (`centre_id`) REFERENCES `centre_master` (`centre_code`),
  ADD CONSTRAINT `fkuserrole` FOREIGN KEY (`role`) REFERENCES `role` (`userrole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
