-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 01:37 PM
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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `service_id`, `appointmentDate`, `appointmentTime`, `status`, `details`, `resched_details`, `cancel_details`, `doctor_remarks`, `service_charge`, `feedback`, `created_at`, `updated_at`) VALUES
(153, 20, NULL, 89, '2023-10-29', '10:38:00', 'done', '', '', 'yawq na                  ', '', 0, NULL, '2023-10-07 11:08:16', '2023-11-22 10:25:05'),
(154, 8, NULL, 88, '2023-10-28', '09:15:00', 'done', '', '', '', '', 0, 'What good service', '2023-10-07 11:45:29', '2023-10-08 00:00:00'),
(155, 8, NULL, 87, '2023-10-20', '09:15:00', 'Approved', '', '', '', '', 0, NULL, '2023-10-07 11:45:44', '2023-11-13 05:47:29'),
(156, 8, NULL, 89, '2023-10-30', '15:46:00', NULL, '', '', '', '', 0, NULL, '2023-10-08 09:16:52', '2023-10-08 09:16:52'),
(157, 22, NULL, 89, '2023-10-30', '13:15:00', 'done', '', '', '', '', 0, NULL, '2023-10-08 19:45:35', '2023-10-08 19:55:24'),
(158, 22, NULL, 87, '2023-10-17', '14:22:00', NULL, '', '', '', '', 0, NULL, '2023-10-08 19:49:42', '2023-10-08 19:49:42'),
(192, 8, NULL, 88, '2023-11-23', '11:29:00', NULL, '', '2023-11-23', '', '', 0, NULL, '2023-11-11 16:00:09', '2023-11-11 17:58:03'),
(213, 8, NULL, 89, '2023-11-30', '09:27:00', NULL, '', '', '', '', 0, NULL, '2023-11-11 17:53:47', '2023-11-11 17:53:47'),
(214, 8, NULL, 88, '2023-11-29', '14:54:00', NULL, '', '2023-11-28', '', '', 0, NULL, '2023-11-11 18:09:29', '2023-11-11 18:24:48'),
(216, 20, NULL, 89, '2023-11-23', '10:21:00', 'done', '', '', '', '', 0, NULL, '2023-11-22 14:48:52', '2023-11-22 15:00:05'),
(217, 20, NULL, 87, '2023-11-28', '15:50:00', NULL, '', '', '', '', 0, NULL, '2023-11-22 15:06:14', '2023-11-22 15:06:14');

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
(1, 'Josefina Eligia ', 'Orfanel-Mendoza', 'doctor@edoc.com', '123', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `start`, `end`, `image`, `doctor_id`, `created_at`, `updated_at`) VALUES
(14, '✨ Discover Your Best Smile with Our Exclusive Checkup Special! ✨', '🦷 Complete Dental Examination: Our skilled dental professionals will assess every aspect of your oral health, from teeth and gums to jaw and bite. Uncover potential issues and pave the way for a healthier smile.', '2023-11-20', '2023-12-29', '20230926155458.jpg', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Smile Makeover Month', '✨ Thorough Examination: Our experienced dental professionals will conduct a detailed assessment of your oral health, identifying any potential issues and creating a personalized plan for your smile.', '2023-12-28', '2024-01-30', '20230926181332.jpg', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(8, 'mario@mail.com', 'Mario', 'Maurer', 'password', '', '09321654987', 'male', '2023-08-23 15:06:44', '2023-09-25 18:51:17'),
(20, 'peter@mail.com', 'Pedro', 'Patter', '123', '', '09123456789', 'male', '2023-08-23 18:47:24', '2023-11-22 14:52:23'),
(21, 'pablo@mail.com', 'Pablo', 'Picasso', '123', '', NULL, '', '2023-08-23 20:17:24', '2023-08-23 20:17:24'),
(22, 'damaso@mail.com', 'Padre', 'Damaso', 'password', '', NULL, 'male', '2023-08-28 06:57:19', '2023-10-08 19:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_id` int(11) NOT NULL,
  `tooth_id` int(11) DEFAULT NULL,
  `prescription` varchar(500) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `doctor_id`, `appointment_id`, `tooth_id`, `prescription`, `updated_at`, `created_at`) VALUES
(3, NULL, 141, 10, NULL, '0000-00-00 00:00:00', '2023-09-23 11:44:39'),
(4, NULL, 142, 11, NULL, '0000-00-00 00:00:00', '2023-09-23 11:45:36'),
(5, NULL, 150, 12, NULL, '0000-00-00 00:00:00', '2023-09-26 21:19:46'),
(7, NULL, 153, 18, 'Pain Killer - 1x/day', '0000-00-00 00:00:00', '2023-10-07 11:09:24'),
(8, NULL, 154, 19, 'Pain Killer - 3x/day\r\nStop Bleeding - If necessary', '0000-00-00 00:00:00', '2023-10-07 18:44:03'),
(9, NULL, 157, 20, 'Acetaminophen - when aching', '0000-00-00 00:00:00', '2023-10-08 19:55:24'),
(10, NULL, 216, 21, 'Pain Killer - 3x/day\r\nMefenamic - if bleeding', '0000-00-00 00:00:00', '2023-11-22 15:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service`, `description`, `created_at`, `updated_at`) VALUES
(87, 'Oral Prophylaxis', 'Oral prophylaxis, commonly known as a dental cleaning, is a crucial part of maintaining excellent oral health. This routine procedure involves the removal of plaque, tartar, and stains from your teeth and gums. By having regular oral prophylaxis, you can prevent tooth decay, gum disease, and maintain a fresh, vibrant smile.', '2023-10-07 10:47:18', NULL),
(88, 'Restoration (Pasta)', 'Restoration in dentistry is a specialized procedure aimed at repairing and rejuvenating damaged or decayed teeth. This process involves the removal of damaged tooth structure and the replacement of missing or compromised parts with durable materials like dental fillings, crowns, or bridges. Restoration not only restores the aesthetic appeal of your smile but also ensures proper function and comfort.', '2023-10-07 10:49:45', NULL),
(89, 'Extraction', 'Tooth extraction is a dental procedure performed when a tooth is severely damaged, infected, or causing significant pain. During this procedure, a dentist carefully removes the affected tooth to alleviate discomfort and prevent potential complications.', '2023-10-07 10:50:14', NULL),
(90, 'Braces', 'Braces are recommended to correct various orthodontic issues, including crooked teeth, misaligned bites, and overcrowding. They not only enhance the aesthetics of your smile but also contribute to better dental hygiene and overall oral health. By aligning your teeth, braces can reduce the risk of gum disease, tooth decay, and jaw joint problems.', '2023-10-09 08:58:03', NULL);

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
(11, 142, 2, 'Molar - Right', '2023-09-23 11:45:36', '0000-00-00 00:00:00'),
(12, 150, 1, 'Canine', '2023-09-26 21:19:46', '0000-00-00 00:00:00'),
(13, 152, 1, 'Molar - Right', '2023-10-07 11:02:29', '0000-00-00 00:00:00'),
(14, 152, 1, 'Molar - Right', '2023-10-07 11:03:44', '0000-00-00 00:00:00'),
(15, 152, 1, 'Molar - Right', '2023-10-07 11:05:19', '0000-00-00 00:00:00'),
(16, 152, 1, 'Molar - Right', '2023-10-07 11:05:26', '0000-00-00 00:00:00'),
(17, 152, 1, 'Molar - Right', '2023-10-07 11:05:35', '0000-00-00 00:00:00'),
(18, 153, 2, 'Left Molar', '2023-10-07 11:09:24', '0000-00-00 00:00:00'),
(19, 154, 1, 'Canine', '2023-10-07 18:44:03', '0000-00-00 00:00:00'),
(20, 157, 1, 'Molar - Right', '2023-10-08 19:55:24', '0000-00-00 00:00:00'),
(21, 216, 2, 'Left Molar', '2023-11-22 15:00:05', '0000-00-00 00:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tooth`
--
ALTER TABLE `tooth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
