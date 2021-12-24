-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2021 at 10:19 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atms_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`) VALUES
(1, 'SE Department'),
(2, 'IT Department'),
(3, 'IS Department'),
(4, 'CS Department');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `department_id` int(11) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `birthday` date NOT NULL,
  `role` int(11) NOT NULL,
  `late_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `phone`, `password`, `department_id`, `address`, `birthday`, `role`, `late_id`) VALUES
(1, 'admin', 'admin@gmail.com', '01111241705', 'admin', 1, 'kafr', '2000-12-09', 1, 1),
(2, 'sara', 'sara@gmail.com', '0155817847', 'sara301', 1, 'Dsok', '2000-12-08', 3, 5),
(3, 'aya', 'aya@gmail.com', '01111241705', 'aya20', 2, 'alex', '2000-07-16', 3, 4),
(4, 'gehad', 'gehad@gmail.com', '01111241705', 'gehad52', 3, 'tanta', '1999-12-22', 3, 3),
(5, 'ahmed', 'ahmed@gmail.com', '0155817847', 'ahmed30', 3, 'giza', '2000-11-08', 3, 2);


-- --------------------------------------------------------

--
-- Table structure for table `late`
--

CREATE TABLE `late` (
  `late_id` int(11) NOT NULL,
  `user_no` varchar(200) NOT NULL,
  `password` varchar(40) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `datehire` date NOT NULL,
  `department_id` int(11) NOT NULL,
  `id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `late`
--

INSERT INTO `late` (`late_id`, `user_no`, `password`, `user_name`, `datehire`, `department_id`, `id`) VALUES
(1, 'admin', 'admin', 'admin', '2021-12-16', 1, ''),
(2, 'ahmed', 'ahmed30', 'ahmed', '2021-12-15', 3, ''),
(3, 'gehad', 'gehad52', 'gehad', '2021-12-14', 3, 'OFFLINE'),
(4, 'aya', 'aya20', 'aya', '2021-12-01', 2, 'ONLINE'),

(5, 'sara', 'sara301', 'sara', '2021-12-02', 1, 'ONLINE');


-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE `leave` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `leave_description` text NOT NULL,
  `leave_status` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave`
--

INSERT INTO `leave` (`id`, `employee_id`, `leave_id`, `leave_from`, `leave_to`, `leave_description`, `leave_status`, `department_id`) VALUES
(1, 2, 4, '2021-12-11', '2021-12-15', 'soo soo tired ', 2, 1),
(2, 3, 3, '2021-12-10', '2021-01-23', 'soo soo sick', 1, 2),
(3, 5, 4, '2021-12-07', '2021-12-21', 'l am feel tired', 1, 3),
(4, 4, 8, '2021-12-18', '2021-12-21', 'mam is very tired', 1, 3),
(5, 2, 2, '2021-12-10', '2021-12-26', 'i am very sick', 2, 1),
(6, 3, 8, '2021-12-16', '2021-12-20', 'soo soo sick sir', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `leave_type`) VALUES
(2, 'Casual'),
(3, 'Earned'),
(4, 'Sick'),
(8, 'so tired'),
(13, 'Tariq envelope');

-- --------------------------------------------------------

--
-- Table structure for table `timein`
--

CREATE TABLE `timein` (
  `id` int(20) NOT NULL,
  `user_no` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(40) NOT NULL,
  `time` varchar(200) NOT NULL,
  `out` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timein`
--

INSERT INTO `timein` (`id`, `user_no`, `user_name`, `password`, `time`, `out`, `date`) VALUES
(1, 'gehad', 'gehad', 'gehad52', '12:59 AM', '04:07 AM', 'Dec-21-2021'),
(2, 'ahmed', 'ahmed', 'ahmed30', '01:06 AM', '04:07 AM', 'Dec-22-2021'),
(3, 'aya', 'aya', 'aya20', '07:08 PM', '04:07 AM', '23-Dec-2021'),
(4, 'sara', 'sara', 'sara301', '07:23 PM', '04:11 AM', '23-Dec-2021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `late_id` (`late_id`);

--
-- Indexes for table `late`
--
ALTER TABLE `late`
  ADD PRIMARY KEY (`late_id`),
  ADD UNIQUE KEY `user_no` (`user_no`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `leave`
--
ALTER TABLE `leave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timein`
--
ALTER TABLE `timein`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `late`
--
ALTER TABLE `late`
  MODIFY `late_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `leave`
--
ALTER TABLE `leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `timein`
--
ALTER TABLE `timein`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`late_id`) REFERENCES `late` (`late_id`);

--
-- Constraints for table `late`
--
ALTER TABLE `late`
  ADD CONSTRAINT `late_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `leave`
--
ALTER TABLE `leave`
  ADD CONSTRAINT `leave_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
