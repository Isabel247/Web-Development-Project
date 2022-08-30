-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 06:56 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `church_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `username`, `password`) VALUES
(1, 'administrator', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `event_request`
--

CREATE TABLE `event_request` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `avail_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_request`
--

INSERT INTO `event_request` (`event_id`, `event_name`, `avail_file`) VALUES
(2, 'Baptism', '4888-Baptismal-Preparation-Sheets.pdf'),
(3, 'Wedding', '3063-Wedding_Request_Form.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` varchar(200) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `name`, `description`, `position`, `photo`) VALUES
(7, 'Juan dela Cruz', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum repudiandae consequatur quasi suscipit, aliquid repellendus tenetur ex delectus in culpa doloremque totam dolorum magni earum corrupti v', 'Priest', 'mass.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_events`
--

CREATE TABLE `upcoming_events` (
  `event_id` int(9) NOT NULL,
  `event_name` varchar(200) DEFAULT NULL,
  `event_desc` varchar(300) DEFAULT NULL,
  `event_date` timestamp NULL DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upcoming_events`
--

INSERT INTO `upcoming_events` (`event_id`, `event_name`, `event_desc`, `event_date`, `location`) VALUES
(3, 'mass', 'online mass', '2021-04-21 05:36:00', 'manila'),
(4, 'mass', 'online', '2021-04-29 14:29:00', 'Manila');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_id`, `name`, `email`, `address`, `phone_no`, `username`, `password`) VALUES
(1, 'Isabel Laurel', 'laurelisabel96@gmail.com', NULL, '0910002323', 'isabel', 'saz');

-- --------------------------------------------------------

--
-- Table structure for table `user_request`
--

CREATE TABLE `user_request` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `pre_time` date DEFAULT NULL,
  `alt_time` date DEFAULT NULL,
  `stat` varchar(100) DEFAULT NULL,
  `application_date` datetime NOT NULL DEFAULT current_timestamp(),
  `application_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_request`
--

INSERT INTO `user_request` (`request_id`, `user_id`, `event_id`, `pre_time`, `alt_time`, `stat`, `application_date`, `application_id`) VALUES
(22, 1, 2, '2021-05-28', '2021-06-04', 'process', '2021-04-05 23:03:23', '150634581134189430');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `event_request`
--
ALTER TABLE `event_request`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_request`
--
ALTER TABLE `user_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_req_fk` (`user_id`),
  ADD KEY `event_req_fk` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_request`
--
ALTER TABLE `event_request`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  MODIFY `event_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_request`
--
ALTER TABLE `user_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_request`
--
ALTER TABLE `user_request`
  ADD CONSTRAINT `event_req_fk` FOREIGN KEY (`event_id`) REFERENCES `event_request` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_req_fk` FOREIGN KEY (`user_id`) REFERENCES `user_registration` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
