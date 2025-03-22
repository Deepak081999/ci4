-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2025 at 04:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4`
--
CREATE DATABASE IF NOT EXISTS `ci4` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ci4`;

-- --------------------------------------------------------

--
-- Table structure for table `client_data`
--

DROP TABLE IF EXISTS `client_data`;
CREATE TABLE `client_data` (
  `id` int(11) NOT NULL,
  `parentLabelCompany` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `state` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `city` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `client_data`
--

INSERT INTO `client_data` (`id`, `parentLabelCompany`, `country`, `state`, `city`, `status`) VALUES
(1, 'XYZ Company Go', 'India', 'West Bengal', 'Parganas', 2),
(2, 'Go Go Music', 'India', 'Gujarat', 'Ahmedabad', 2),
(3, 'Main Max Pro', 'India', 'Uttar Pradesh', 'Ghaziabad', 2);

-- --------------------------------------------------------

--
-- Table structure for table `metadata_data`
--

DROP TABLE IF EXISTS `metadata_data`;
CREATE TABLE `metadata_data` (
  `id` int(11) NOT NULL,
  `isrc` text DEFAULT NULL,
  `albumName` text DEFAULT NULL,
  `songName` text DEFAULT NULL,
  `artist` text DEFAULT NULL,
  `musicLabel` int(11) DEFAULT NULL,
  `inlay_file_url` text NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `metadata_data`
--

INSERT INTO `metadata_data` (`id`, `isrc`, `albumName`, `songName`, `artist`, `musicLabel`, `inlay_file_url`, `createdOn`, `status`) VALUES
(1, '2200001', 'Album 01', 'Namo Namo', 'artist1,artist29', 3, '2200001.jpg', '2023-04-26 10:25:47', 3),
(2, '2200002', 'Album 02', 'Me Hu Don', 'artist20,artist3,artist1', 2, '2200002.jpg', '2023-05-06 12:21:32', 8),
(3, '2200003', 'Album 03', 'Tu Kya Lagte Ho', 'artist4,artist2', 2, '2200003.jpg', '2023-04-26 10:25:56', 4),
(4, '2200004', 'Album 04', 'Challo Challo', 'artist5', 3, '2200004.jpg', '2023-04-26 10:26:04', 2),
(5, '2200005', 'Album 05', 'Mere Liye', 'artist8,artist14', 3, '2200005.jpg', '2023-04-26 10:26:10', 8),
(6, '2200006', 'Album 06', 'Dheere Dheere', 'artist8', 3, '2200006.jpg', '2023-05-06 12:25:08', 8),
(7, '2200007', 'Album 07', 'Tere Bina Jina', 'artist5,artist1', 2, '2200007.jpg', '2023-04-26 10:26:17', 2),
(8, '2200008', 'Album 08', 'Me Hu Hero', 'artist1', 2, '2200008.jpg', '2023-05-06 12:21:35', 8),
(9, '2200009', 'Album 09', 'Tum Jo Aaye', 'artist6', 3, '2200009.jpg', '2023-05-06 12:21:38', 8),
(10, '22000010', 'Album 10', 'Beta Ke Bina', 'artist7', 3, '22000010.jpg', '2023-05-06 12:21:40', 3),
(11, '22000011', 'Album 11', 'Lal Duptta', 'artist9,artist3', 1, '22000011.jpg', '2023-05-06 12:21:43', 8),
(12, '22000012', 'Album 12', 'Keasriya', 'artist3', 3, '22000012.jpg', '2023-04-26 10:26:29', 8),
(13, '22000013', 'Album 13', 'Blue Eyes', 'artist15', 3, '22000013.jpg', '2023-04-26 10:26:35', 3),
(14, '22000014', 'Album 14', 'Dhire Dhire Se', 'artist3', 1, '22000014.jpg', '2023-05-06 12:25:09', 8),
(15, '22000015', 'Album 15', 'Dhire Dhire Bola Ye', 'artist5,artist8', 3, '22000015.jpg', '2023-05-06 12:25:14', 8),
(16, '22000016', 'Album 16', 'Duniya Ek Numberi', 'artist1', 3, '22000016.jpg', '2023-05-06 12:25:18', 4),
(17, '22000017', 'Album 17', 'Bade Miya Chote Miya', 'artist5', 2, '22000017.jpg', '2023-05-06 12:21:47', 8),
(18, '22000018', 'Album 18', 'Get Lost', 'artist5,artist9,artist10', 3, '22000018.jpg', '2023-04-26 10:26:38', 8),
(19, '22000019', 'Album 19', 'Me Hu Khal Nayak', 'artist3', 1, '22000019.jpg', '2023-05-06 12:25:21', 3),
(20, '22000020', 'Album 20', 'Lets Go', 'artist2', 3, '22000020.jpg', '2023-05-06 12:21:48', 8);

-- --------------------------------------------------------

--
-- Table structure for table `metadata_status`
--

DROP TABLE IF EXISTS `metadata_status`;
CREATE TABLE `metadata_status` (
  `id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `status_name` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `metadata_status`
--

INSERT INTO `metadata_status` (`id`, `status_id`, `status_name`) VALUES
(1, 0, 'Waiting for approval'),
(2, 1, 'Approved'),
(3, 2, 'In Process'),
(4, 3, 'Delivered'),
(5, 4, 'Transfer WithinCMS'),
(7, 5, 'Takendown'),
(8, 6, 'Rejected'),
(10, 7, 'Error'),
(11, 8, 'Live');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-03-20-044841', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1742446300, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_img`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'update', 'test@testing.com', '$2y$10$g78ZjoN6Ba8/dFbjHC9g5.P7NbbDpmp6U7UKvc28sNJdpwbq9qgAu', '1742614898_a6a939c4ccaf6496bec4.jpg', '2025-03-20 04:52:08', '2025-03-22 03:41:38', NULL),
(2, 'Deepak saini', 'test1@gmail.com', '$2y$10$UStMJ7uGoUGGIYtg0GbgsOcEfRqZME7k2tzCEGxvGcqtCY2I7Vlaa', '1742555683_b18ea5fa4c54929e24cb.jpg', '2025-03-21 10:25:18', '2025-03-21 11:28:26', NULL),
(3, 'test test', 'GeeksIT_NWH@gmail.com', '$2y$10$0cvf97LY9ECb/8IYFHsMve5KI/uSLcTPJyuTC18e97UgdsZc3GMAm', NULL, '2025-03-21 16:33:42', '2025-03-21 16:33:42', NULL),
(6, 'test test', 'test1234@testing.com', '$2y$10$DsosV9fZZTyoOcKdt6Qhceb8wt7dznyzgcHsdHn1IWIT0mjtJxmoa', '1742575371_a160379073bcb5adfe51.jpg', '2025-03-21 16:42:51', '2025-03-21 16:42:51', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_data`
--
ALTER TABLE `client_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metadata_data`
--
ALTER TABLE `metadata_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metadata_status`
--
ALTER TABLE `metadata_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_data`
--
ALTER TABLE `client_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `metadata_data`
--
ALTER TABLE `metadata_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `metadata_status`
--
ALTER TABLE `metadata_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
