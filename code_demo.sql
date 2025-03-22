-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 08:59 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `code_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_data`
--

CREATE TABLE `client_data` (
  `id` int NOT NULL,
  `parentLabelCompany` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `country` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `state` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `city` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

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

CREATE TABLE `metadata_data` (
  `id` int NOT NULL,
  `isrc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `albumName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `songName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `artist` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `musicLabel` int DEFAULT NULL,
  `inlay_file_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

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

CREATE TABLE `metadata_status` (
  `id` int NOT NULL,
  `status_id` int NOT NULL,
  `status_name` varchar(52) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_data`
--
ALTER TABLE `client_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `metadata_data`
--
ALTER TABLE `metadata_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `metadata_status`
--
ALTER TABLE `metadata_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
