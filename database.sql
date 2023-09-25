-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2023 at 06:00 PM
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
-- Database: `dental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@edoc.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `service_id` int(10) DEFAULT NULL,
  `appointmentDate` date DEFAULT NULL,
  `appointmentTime` time DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `details` varchar(255) NOT NULL,
  `resched_details` varchar(255) NOT NULL,
  `cancel_details` varchar(255) NOT NULL,
  `doctor_remarks` varchar(255) NOT NULL,
  `service_charge` int(11) NOT NULL,
  `feedback` varchar(500) DEFAULT NULL,
  `notif_status` varchar(255) DEFAULT NULL,
  `notif_status_client` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `service_id`, `appointmentDate`, `appointmentTime`, `status`, `details`, `resched_details`, `cancel_details`, `doctor_remarks`, `service_charge`, `feedback`, `notif_status`, `notif_status_client`, `created_at`, `updated_at`) VALUES
(141, 20, NULL, 83, '2023-09-30', '12:35:00', 'done', '', '', '', '', 0, 'as', NULL, NULL, '2023-09-22 04:05:04', '2023-09-23 00:00:00'),
(142, 20, NULL, 83, '2023-09-24', '14:24:00', 'done', '', '', '', '', 0, '', NULL, NULL, '2023-09-22 18:54:33', '2023-09-23 11:45:36'),
(143, 20, NULL, 73, '2023-09-25', '14:25:00', 'Approved', '', '', '', '', 0, '', NULL, NULL, '2023-09-22 18:55:10', '2023-09-23 08:17:12'),
(145, 8, NULL, 73, '2023-09-25', '14:56:00', NULL, '', '', 'habo ko na po                                                    ', '', 0, '', NULL, NULL, '2023-09-23 06:26:27', '2023-09-23 03:08:04'),
(146, 21, NULL, 83, '2023-09-30', '13:10:00', NULL, '', '', 'yawq na po                                                    ', '', 0, '', NULL, NULL, '2023-09-23 06:40:57', '2023-09-23 03:11:17'),
(148, 8, NULL, 83, '2023-09-30', '10:16:00', 'Approved', '', '', '', '', 0, '', NULL, NULL, '2023-09-23 11:46:47', '2023-09-23 17:26:17'),
(149, 20, NULL, 83, '2023-09-28', '13:58:00', NULL, '', '2023-09-30', '', '', 0, '', NULL, NULL, '2023-09-24 00:57:36', '2023-09-24 09:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `first_name`, `last_name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'Doctor', 'doctor@edoc.com', '123', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(50) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `start`, `end`, `doctor_id`, `created_at`, `updated_at`) VALUES
(1, 'Sample Promo', 'We have a promo tomorrow', '2023-09-26', '2023-09-27', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Sample Promo 1', 'This is the descripttion', '0000-00-00', '0000-00-00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'afas', 'asdasdasd', '2023-09-20', '2023-09-27', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'asdasd', 'asdasd', '2023-09-27', '2023-09-29', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'asds', 'asdadasd', '2023-09-22', '2023-09-30', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `expirydate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `sex` varchar(6) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `email`, `first_name`, `last_name`, `password`, `address`, `contact_number`, `sex`, `created_at`, `updated_at`) VALUES
(8, 'mario@mail.com', 'Mario', 'Maurer', '123', '', '09321654987', 'male', '2023-08-23 15:06:44', '2023-09-25 18:51:17'),
(20, 'peter@mail.com', 'Peter', 'Patter', '123', '', '09123456789', 'male', '2023-08-23 18:47:24', '2023-09-24 12:36:27'),
(21, 'pablo@mail.com', 'Pablo', 'Picasso', '123', '', NULL, '', '2023-08-23 20:17:24', '2023-08-23 20:17:24'),
(22, 'damaso@mail.com', 'Padre', 'Damaso', '321654987', '', NULL, '', '2023-08-28 06:57:19', '2023-08-28 06:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_id` int(11) NOT NULL,
  `tooth_id` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `doctor_id`, `appointment_id`, `tooth_id`, `updated_at`, `created_at`) VALUES
(3, NULL, 141, 10, '0000-00-00 00:00:00', '2023-09-23 11:44:39'),
(4, NULL, 142, 11, '0000-00-00 00:00:00', '2023-09-23 11:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service`, `price`, `description`, `created_at`, `updated_at`) VALUES
(7, 'Prophylaxis', 2000, 'A preventive dental procedure involving thorough cleaning, plaque and tartar removal, and enamel polishing, enhancing oral health and preventing cavities and gum problems.', '2023-08-23 15:25:13', '2023-08-23 15:25:13'),
(42, 'Rooth Canal', 2000, 'A preventive dental procedure involving thorough cleaning, plaque and tartar removal, and enamel polishing, enhancing oral health and preventing cavities and gum problems.', '2023-08-23 21:30:32', '2023-08-23 21:30:32'),
(73, 'Tooth Extraction', 1000, 'Have your teeth removed.', '2023-08-28 07:06:55', '2023-08-28 07:06:55'),
(83, 'Teeth Whitening', 2000, 'sample', '2023-09-17 08:56:07', '2023-09-17 08:56:07'),
(85, 'Extraction', 5000, '321654', '2023-09-20 20:52:27', '2023-09-20 20:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `tooth`
--

CREATE TABLE `tooth` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `tooth_number` int(11) NOT NULL,
  `tooth_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `udpated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tooth`
--

INSERT INTO `tooth` (`id`, `appointment_id`, `tooth_number`, `tooth_name`, `created_at`, `udpated_at`) VALUES
(10, 141, 1, 'Left Molar', '2023-09-23 11:44:39', '0000-00-00 00:00:00'),
(11, 142, 2, 'Molar - Right', '2023-09-23 11:45:36', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@edoc.com', 'a'),
('damaso@mail.com', 'p'),
('doctor@edoc.com', 'd'),
('emhashenudara@gmail.com', 'p'),
('mario@mail.com', 'p'),
('pablo@mail.com', 'p'),
('patient@edoc.com', 'p'),
('peter@mail.com', 'p');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aemail`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scheduleid` (`service_id`),
  ADD KEY `patient_id_index` (`patient_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_record_index` (`doctor_id`),
  ADD KEY `appointment_records_index` (`appointment_id`) USING BTREE,
  ADD KEY `tooth_records_index` (`tooth_id`) USING BTREE;

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tooth`
--
ALTER TABLE `tooth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tooth`
--
ALTER TABLE `tooth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `services_index_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `tooth_index_id` FOREIGN KEY (`tooth_id`) REFERENCES `tooth` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
