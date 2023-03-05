-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 12:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_datetime` varchar(255) NOT NULL,
  `end_datetime` varchar(255) NOT NULL,
  `location` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `equipments` text NOT NULL,
  `status` int(11) NOT NULL,
  `is_event_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `description`, `start_datetime`, `end_datetime`, `location`, `type`, `equipments`, `status`, `is_event_active`) VALUES
(4, 14, 'First Event Title Test', 'First Event Description Test Bla Bla Bla Bla Bla', '2023-03-07T06:29', '2023-03-08T06:29', 2, 1, '', 1, 1),
(9, 14, 'asfdas', 'afae', '2023-03-08T07:45', '2023-03-09T07:45', 0, 3, '', 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(9, 'defaultmy', 'mynewpassword', 'participant', 'turokad new', 'vic', 'mar', 'female', 'ash', 4, 'R', 'turok@my.she', 0),
(10, 'default9', 'default123', 'administrator', 'teadg', 'eag', 'dgae', 'female', 'adga', 5, 'ad5', 'etstae@agda9.fads', 1),
(11, 'default10', 'default123', 'organizer', 'egfaf', 'geag', 'geagae', 'other', 'gdaeg', 15, 'asf', 'feafa@gadgadg.vas', 0),
(12, 'default11', 'default123', 'organizer', 'adg', 'aeg', 'aeg', 'other', 'daadg', 3, '5', 'agda@agdsfa.adg', 1),
(13, 'default12', 'default123', 'participant', 'aega', 'agd', 'ag', 'female', 'adgs', 3, 'adga', 'adfaae@gadfga.adg', 0),
(14, 'admin', 'admin', 'administrator', 'Steven ', 'Serrano', 'Portacio', 'male', 'BSIS NS', 4, 'C', 'admin@admin.com', 1),
(15, 'testuserr1', '123', 'administrator', 'steven', 'serrano', 'portacio', 'male', 'bsis-ns', 4, 'c', 'steven.serrano@tup.edu.ph', 0),
(16, 'prof1fds', '123456', 'organizer', 'nahida', 'feasfaes', 'feasf', 'male', 'feaf', 4, 'gaega', 'gaegas@gfdas.com', 0),
(17, 'default16', 'default123', 'participant', 'shin', 'min', 'kai', 'other', 'raw', 4, 'g', 'hurahura@hh.fdas', 0),
(18, 'newadmin', 'newadmin', 'organizer', 'admin2', 'admin2last', 'admin2middle', 'male', 'ADC', 1, 'A', 'newadmin@new.com', 1),
(19, 'default18', 'default123', 'organizer', 'new name', 'new last', 'new middle', 'other', 'GG', 4, 'B', 'newsample@sample.com', 1),
(20, 'default19', 'default123', 'administrator', 'modal name', 'modal lname', 'modal mname', 'male', 'modaltest', 2, 'ad', 'newmodal@modal.com', 0),
(21, 'default20', 'default123', 'administrator', 'egagae', 'geasg', 'geagas', 'female', 'abc', 22, 'abc', 'asdfgaega', 0),
(41, 'default21', 'default123', 'organizer', 'ert', 'ert', 'ert', 'male', 'ert', 45, '6', 'ert', 0),
(42, 'default22', 'default123', 'organizer', 'iop', 'iop', 'iop', 'male', 'iop', 8, 'iop', 'iop', 0),
(43, 'mynewusername123', 'sheesh', 'organizer', 'jujutsu', 'kaisen', 'a', 'female', 'BSCS', 3, 'C', 'sheesh@gmam.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE `user_feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(10) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_feedback`
--
ALTER TABLE `user_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`feeback_id`) REFERENCES `user_feedback` (`id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD CONSTRAINT `user_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
