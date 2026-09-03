-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 11:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `odss_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `file_json` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `Doc_To` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `description`, `file_json`, `user_id`, `date_created`, `Doc_To`) VALUES
(7, '111', '111', '[\"1706556060_410478435_7541077649277137_8644158000333344798_n (1).jpg\"]', 6, '2024-01-29 20:21:35', '5'),
(8, 's', 's \r\n															', '[\"1706556120_849675.png\"]', 1, '2024-01-29 20:22:46', '5'),
(9, 'l', 'l \r\n															', '[\"1706556240_410478435_7541077649277137_8644158000333344798_n.jpg\"]', 6, '2024-01-29 20:24:06', '1'),
(10, 'a', 'a \r\n															', '[\"1706556240_849675.png\"]', 1, '2024-01-29 20:25:10', '8'),
(11, 'pub1', ' \r\n															', '[\"1706556300_182848250_473844463879491_3067536835881820262_n.jpg\"]', 5, '2024-01-29 20:25:43', 'public'),
(12, 'last', ' \r\n															', '[\"1706556480_182848250_473844463879491_3067536835881820262_n.jpg\"]', 1, '2024-01-29 20:28:34', 'public'),
(13, 'd', ' \r\n															', '[\"1706561160_llllll.mp4\"]', 1, '2024-01-29 21:46:20', '6, 7, 8'),
(14, 'qsdqsd', 'sdq', '[\"1706561220_llllll.mp4\"]', 1, '2024-01-29 21:47:05', 'public'),
(15, 'jdid', 'jdid', '[\"1706561220_llllll.mp4\"]', 1, '2024-01-29 21:47:34', 'public'),
(16, 'only', 'only', '[\"1706561220_llllll.mp4\"]', 1, '2024-01-29 21:47:48', '5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Admin,2= users',
  `avatar` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `contact`, `address`, `email`, `password`, `type`, `avatar`, `date_created`) VALUES
(1, 'Admin', 'Admin', '', '+12354654787', 'Sample', 'admin@admin.com', 'd41d8cd98f00b204e9800998ecf8427e', 1, '1706866200_WhatsApp Image 2023-11-26 at 11.13.00 PM.jpeg', '2020-11-11 15:35:19'),
(5, 'achref', 'abouda', '', '24167770', 'ariana borj louzir ', 'achref.abouda@edu.isetcom.tn', '0cc175b9c0f1b6a831c399e269772661', 2, '1706554380_WhatsApp Image 2023-11-26 at 11.13.00 PM.jpeg', '2024-01-29 19:53:17'),
(6, 'user2', 'user2', '', '00000000', 'ariana', 'user.user@gmail.com', '7b774effe4a349c6dd82ad4f4f21d34c', 2, '1706554440_849675.png', '2024-01-29 19:54:18'),
(7, 'user3', 'user3', '', '00000000', 'ariana', 'user3.user3@gmail.com', '7b774effe4a349c6dd82ad4f4f21d34c', 2, '1706554440_419754686_396937416203926_3722569750504902334_n.jpg', '2024-01-29 19:54:49'),
(8, 'admin2', 'admin2', '', '+1234567890', 'ariana', 'admin2@admin.com', '202cb962ac59075b964b07152d234b70', 1, '', '2024-01-29 19:55:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
