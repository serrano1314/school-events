-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2023 at 08:02 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` int(11) NOT NULL,
  `equipment` varchar(100) NOT NULL,
  `equipment_no` int(11) NOT NULL,
  `remaining_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `equipment`, `equipment_no`, `remaining_no`) VALUES
(3, 'Chair', 60, 60),
(4, 'Tables', 30, 30),
(5, 'Speakers', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_in_used`
--

CREATE TABLE `equipment_in_used` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tables` int(11) NOT NULL,
  `chairs` int(11) NOT NULL,
  `speakers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `location` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `equipments` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `user_id`, `title`, `description`, `start_datetime`, `end_datetime`, `location`, `type`, `equipments`, `status`) VALUES
(3, 1, 'Teachers Meeting', 'All COS teachers should attend', '2023-07-02 07:33:00', '2023-07-02 07:33:00', 'IRTC Builing', 1, 0, 1),
(4, 1, 'SIT MEETING', 'ALL OJT STUDENT MUST ATTEND', '2023-02-24 15:00:00', '2023-02-24 16:00:00', 'IRTC Builing', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `feeback_id` int(11) NOT NULL,
  `num_reg_participants` int(11) NOT NULL,
  `num_attendees` int(11) NOT NULL,
  `num_male_attendee` int(11) NOT NULL,
  `num_female_attendee` int(11) NOT NULL,
  `num_other_attendee` int(11) NOT NULL,
  `average_rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` enum('administrator','organizer','participant') NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `course` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_user_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `first_name`, `last_name`, `middle_name`, `gender`, `course`, `year`, `section`, `email`, `is_user_active`) VALUES
(1, 'testuser1', '123', 'administrator', 'steven', 'serrano', 'portacio', 'male', 'bsis-ns', 4, 'c', 'steven.serrano@tup.edu.ph', 1),
(3, 'testuser2', 'rasdtagar', 'organizer', 'aefafeaf', 'gaegaeg', 'geagage', 'other', 'geagaeg', 4, 'agdasgea', 'geagas', 0),
(4, 'testuser3', 'feasgaeg', 'organizer', 'geagaega', 'geagaseg', 'gaegasg', 'male', 'gasegasgeagda', 1, 'adgaegas', 'geagaeag', 0),
(5, 'student1', '123456', 'participant', 'altahim', 'gaegagea', 'egasgdag', 'female', 'gasdga', 1, 'geaa', 'gaeaaega', 0),
(6, 'prof1', '123456', 'organizer', 'nahida', 'feasfaes', 'feasf', 'male', 'feaf', 4, 'gaega', 'gaegas', 1),
(7, 'default6', 'default123', 'organizer', 'tarik', 'efad', 'adgfasg', 'female', 'bscs', 2, 'd', 'asgdagas@hgmai.vados', 1),
(8, 'default7', 'default123', 'participant', 'shook', 'ageage', 'shads', 'male', 'bscs', 5, 'ad', 'user7@dgnaonae', 1),
(9, 'default8', 'default123', 'administrator', 'turokad', 'vcdx', 'taesda', 'male', 'adt', 3, 'da', 'turok8@takdla.dagas', 1),
(10, 'default9', 'default123', 'administrator', 'teadg', 'eag', 'dgae', 'female', 'adga', 5, 'ad5', 'etstae@agda9.fads', 1),
(11, 'default10', 'default123', 'organizer', 'egfaf', 'geag', 'geagae', 'other', 'gdaeg', 15, 'asf', 'feafa@gadgadg.vas', 0),
(12, 'default11', 'default123', 'organizer', 'adg', 'aeg', 'aeg', 'other', 'daadg', 3, '5', 'agda@agdsfa.adg', 1),
(13, 'default12', 'default123', 'participant', 'aega', 'agd', 'ag', 'female', 'adgs', 3, 'adga', 'adfaae@gadfga.adg', 0),
(14, 'admin', 'admin', 'administrator', 'admin first', 'admin last', 'admin middle', 'male', 'BSIS NS', 4, 'C', 'admin@admin.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE `user_feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(10) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_in_used`
--
ALTER TABLE `equipment_in_used`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_ibfk_1` (`user_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feeback_id` (`feeback_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`,`email`),
  ADD UNIQUE KEY `username_3` (`username`);

--
-- Indexes for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `equipment_in_used`
--
ALTER TABLE `equipment_in_used`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_feedback`
--
ALTER TABLE `user_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`feeback_id`) REFERENCES `user_feedback` (`id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Constraints for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD CONSTRAINT `user_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
