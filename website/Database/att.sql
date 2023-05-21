-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 06:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `att`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

CREATE TABLE `admininfo` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `phone` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`username`, `password`, `email`, `fname`, `phone`, `type`) VALUES
('admin', 'admin', 'admin@gmail.com', 'admin', 12345678, 'admin'),
('admin', 'admin', 'admin@gmail.com', 'admin', 12345678, 'admin'),
('tanu', 'tanu', 'tanu@gmail.com', 'student', 12345678, 'student'),
('Deb', 'deb', 'deb@gmail.com', 'deb', 12345678, 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `Name` varchar(20) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Time` varchar(20) NOT NULL,
  `Date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`Name`, `Status`, `Time`, `Date`) VALUES
('Tanumay Goswami', 'Present', '21:17:07', '18/05/2023'),
('Abhisekh Roy', 'Absent', '21:17:24', '18/05/2023'),
('Abu Raihan', 'Absent', '21:17:24', '18/05/2023'),
('Argho Sarkar', 'Absent', '21:17:24', '18/05/2023'),
('Deep Gupta', 'Absent', '21:17:24', '18/05/2023'),
('Dutti Pati', 'Absent', '21:17:24', '18/05/2023'),
('Koyel Chatterjee', 'Absent', '21:17:24', '18/05/2023'),
('Nirabhra Das', 'Absent', '21:17:24', '18/05/2023'),
('Pratyay Mallick', 'Absent', '21:17:24', '18/05/2023'),
('Rajarshi Bhatterjee', 'Absent', '21:17:24', '18/05/2023'),
('Sristi Das', 'Absent', '21:17:24', '18/05/2023'),
('Swapnil Goswami', 'Absent', '21:17:24', '18/05/2023'),
('Trisha Chatterjee', 'Absent', '21:17:24', '18/05/2023'),
('Tanumay Goswami', 'Present', '09:43:59', '19/05/2023'),
('Abhisekh Roy', 'Present', '09:44:25', '19/05/2023'),
('Abu Raihan', 'Absent', '09:44:25', '19/05/2023'),
('Argho Sarkar', 'Absent', '09:44:26', '19/05/2023'),
('Deep Gupta', 'Absent', '09:44:26', '19/05/2023'),
('Dutti Pati', 'Absent', '09:44:26', '19/05/2023'),
('Koyel Chatterjee', 'Absent', '09:44:26', '19/05/2023'),
('Nirabhra Das', 'Absent', '09:44:26', '19/05/2023'),
('Pratyay Mallick', 'Absent', '09:44:26', '19/05/2023'),
('Rajarshi Bhatterjee', 'Absent', '09:44:26', '19/05/2023'),
('Sristi Das', 'Absent', '09:44:26', '19/05/2023'),
('Swapnil Goswami', 'Absent', '09:44:26', '19/05/2023'),
('Trisha Chatterjee', 'Absent', '09:44:26', '19/05/2023'),
('Tanumay Goswami', 'Absent', '09:46:48', '19/05/2023'),
('Rajarshi Bhatterjee', 'Absent', '09:46:48', '19/05/2023'),
('Sristi Das', 'Absent', '09:46:48', '19/05/2023'),
('Swapnil Goswami', 'Absent', '09:46:48', '19/05/2023'),
('Trisha Chatterjee', 'Absent', '09:46:48', '19/05/2023'),
('Argho Sarkar', 'Absent', '09:46:48', '19/05/2023'),
('Abu Raihan', 'Absent', '09:46:48', '19/05/2023'),
('Abhisekh Roy', 'Absent', '09:46:48', '19/05/2023'),
('Deep Gupta', 'Absent', '09:46:48', '19/05/2023'),
('Dutti Pati', 'Absent', '09:46:48', '19/05/2023'),
('Koyel Chatterjee', 'Absent', '09:46:48', '19/05/2023'),
('Nirabhra Das', 'Absent', '09:46:48', '19/05/2023'),
('Pratyay Mallick', 'Absent', '09:46:48', '19/05/2023');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `st_id` varchar(20) NOT NULL,
  `st_name` varchar(20) NOT NULL,
  `st_dept` varchar(20) NOT NULL,
  `st_batch` int(4) NOT NULL,
  `st_sem` int(11) NOT NULL,
  `st_email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`st_id`, `st_name`, `st_dept`, `st_batch`, `st_sem`, `st_email`) VALUES
('1', 'Tanumay Goswami', 'CSE', 2019, 3, 'tgoswami2001@gmail.com'),
('10', 'Rajarshi Bhatterjee', 'CSE', 2019, 3, 'abc@gmail.com'),
('11', 'Sristi Das', 'CSE', 2019, 3, 'abc@gmail.com'),
('12', 'Swapnil Goswami', 'CSE', 2019, 3, 'abc@gmail.com'),
('13', 'Trisha Chatterjee', 'CSE', 2019, 3, 'abc@gmail.com'),
('2', 'Argho Sarkar', 'CSE', 2019, 3, 'argho@gmail.com'),
('3', 'Abu Raihan', 'CSE', 2019, 3, 'abu@gmail.com'),
('4', 'Abhisekh Roy', 'CSE', 2019, 3, 'abc@gmail.com'),
('5', 'Deep Gupta', 'CSE', 2019, 3, 'abc@gmail.com'),
('6', 'Dutti Pati', 'CSE', 2019, 3, 'abc@gmail.com'),
('7', 'Koyel Chatterjee', 'CSE', 2019, 3, 'abc@gmail.com'),
('8', 'Nirabhra Das', 'CSE', 2019, 3, 'abc@gmail.com'),
('9', 'Pratyay Mallick', 'CSE', 2019, 3, 'abc@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `tc_id` int(11) NOT NULL,
  `tc_name` varchar(20) NOT NULL,
  `tc_dept` varchar(20) NOT NULL,
  `tc_email` varchar(40) NOT NULL,
  `tc_course` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`tc_id`, `tc_name`, `tc_dept`, `tc_email`, `tc_course`) VALUES
(1, 'Swapnil', 'CSE', 'swapnil@gmail.com', 'SE'),
(2, 'Subhajit Chowdhuri', 'CSE', 'teacher@gmail.com', 'EEE'),
(3, 'John Doe', 'CSE', 'teacher@gmail.com', 'AOD'),
(4, 'Sumita Goswami', 'CSE', 'teacher@gmail.com', 'AI'),
(5, 'Priyanka Roy', 'CSE', 'teacher@gmail.com', 'DB'),
(11, 'fcdf df', 'cse', 'kawohe3073@appxapi.com', 'sdad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`tc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
