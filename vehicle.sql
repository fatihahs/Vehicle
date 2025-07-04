-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2025 at 04:37 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int NOT NULL,
  `AdminID` int NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `AdminID`, `description`, `created_at`, `updated_at`) VALUES
(15, 2, 'Admin Warda\'s details was updated by Aaisyah', '2025-05-26 17:33:15', '2025-05-26 17:33:15'),
(16, 14, 'Guard Kamil\'s details was updated by Warda', '2025-05-26 17:41:55', '2025-05-26 17:41:55'),
(17, 1, 'Guard Izar was deleted by Siti', '2025-05-27 16:56:25', '2025-05-27 16:56:25'),
(18, 2, 'Resident Emma\'s details was updated by Aaisyah', '2025-06-05 13:33:41', '2025-06-05 13:33:41'),
(19, 14, 'Guard Alias\'s details was updated by Warda', '2025-06-23 15:40:25', '2025-06-23 15:40:25'),
(20, 14, 'Admin Aisyah\'s details was updated by Warda', '2025-06-23 15:41:16', '2025-06-23 15:41:16'),
(21, 14, 'Resident Emma\'s details was updated by Warda', '2025-06-23 16:37:40', '2025-06-23 16:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Siti', 'siti@gmail.com', '$2y$12$lmSEfC5F6MuhCQjORRDn2eVGcVK9lkohYLTZJTYKMj.j1jNKJphdi', '2025-03-25 18:32:05', '2025-03-25 18:32:05'),
(2, 'Aisyah', 'aisyah@gmail.com', '$2y$12$cTCYi0vbEKQu7VLvaekKTe3QWpQwf8z7fQlc4Um2zwV2jLk5fbNwa', '2025-04-08 08:32:39', '2025-06-23 15:41:16'),
(14, 'Warda', 'warda@gmail.com', '$2y$12$/vMkSTztf4zP3ycwhQ7wWujRXFuKh29BaEAbc3/p1pHEY8NvamEJG', '2025-05-26 16:41:48', '2025-05-26 16:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(14, '2025_06_23_224005_create_admins_table', 1),
(15, '2025_06_23_234729_create_residents_table', 1),
(16, '2025_06_24_001342_create_vehicle_log_table', 1),
(17, '2025_06_24_002124_create_activity_logs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` int NOT NULL,
  `TagID` varchar(200) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `PlateNo` varchar(10) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `TagID`, `Name`, `PlateNo`, `Phone`, `Address`, `created_at`, `updated_at`) VALUES
(4, 'E4FEE4FE', 'Syasya', 'JBV2810', '01344520271', 'No 07, Lorong 02', '2025-05-15 16:26:10', '2025-05-22 02:40:49'),
(5, 'E4FFE4FF', 'Amir', 'ATT8943', '0153382073', 'No 23, Lorong 10', '2025-05-17 16:48:08', '2025-05-25 09:06:16'),
(6, '64FE64FE', 'Lily', 'ABV2019', '0113405543', 'No 05, Lorong 21', '2025-05-21 16:21:11', '2025-05-22 02:40:14'),
(7, '04FF04FF', 'Amran', 'BYD1797', '0175480751', 'No 09, Lorong 06', '2025-05-21 16:37:50', '2025-05-22 04:12:06'),
(9, 'C4FEC4FE', 'Emma', 'WMJ7333', '0132254936', 'No 14, Lorong 02', '2025-05-26 15:39:58', '2025-06-23 16:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Siti', '01588306048', 'siti@gmail.com', NULL, '$2y$12$lmSEfC5F6MuhCQjORRDn2eVGcVK9lkohYLTZJTYKMj.j1jNKJphdi', NULL, '2025-03-16 08:43:06', '2025-05-24 13:55:50'),
(5, 'Kamil', '0126639037', 'kamil@gmail.com', NULL, '$2y$12$isdScyyWeJTm61nJao1IquKt486DYVMppeSzYHKc87Mzxg65.A8me', NULL, '2025-05-26 17:24:21', '2025-05-26 17:24:21'),
(7, 'Izar', '0115676686', 'izar@gmail.com', NULL, '$2y$12$CVfcfIngSYCnvcJw4rdvB.whoKoz7I8N7AxaZqQMlrT5AERFrolEy', NULL, '2025-05-27 16:56:59', '2025-05-27 16:56:59'),
(8, 'Alias', '0126639333', 'alias@gmail.com', NULL, '$2y$12$lQX7jxzsJHgfmCI9gevOku4gvoQkzcrLUQme7M05vbYMKFpSP9hJ2', NULL, '2025-06-23 15:39:52', '2025-06-23 15:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_log`
--

CREATE TABLE `vehicle_log` (
  `id` int NOT NULL,
  `ResidentID` int NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicle_log`
--

INSERT INTO `vehicle_log` (`id`, `ResidentID`, `status`, `created_at`, `updated_at`) VALUES
(90, 7, 'IN', '2025-05-25 08:27:11', '2025-05-25 08:27:11'),
(91, 7, 'OUT', '2025-05-25 08:39:27', '2025-05-25 08:39:27'),
(93, 7, 'IN', '2025-05-25 08:49:49', '2025-05-25 08:49:49'),
(94, 7, 'OUT', '2025-05-25 08:50:49', '2025-05-25 08:50:49'),
(96, 4, 'IN', '2025-05-25 08:52:46', '2025-05-25 08:52:46'),
(97, 7, 'IN', '2025-05-25 08:52:52', '2025-05-25 08:52:52'),
(98, 6, 'IN', '2025-05-25 09:02:24', '2025-05-25 09:02:24'),
(99, 6, 'OUT', '2025-05-25 09:02:50', '2025-05-25 09:02:50'),
(100, 5, 'IN', '2025-05-25 09:03:50', '2025-05-25 09:03:50'),
(101, 7, 'OUT', '2025-05-25 09:06:56', '2025-05-25 09:06:56'),
(103, 6, 'IN', '2025-05-27 17:07:05', '2025-05-27 17:07:05'),
(104, 6, 'OUT', '2025-05-27 17:08:31', '2025-05-27 17:08:31'),
(105, 7, 'IN', '2025-06-05 16:08:14', '2025-06-05 16:08:14'),
(106, 7, 'OUT', '2025-06-05 16:15:17', '2025-06-05 16:15:17'),
(107, 7, 'IN', '2025-06-05 16:20:07', '2025-06-05 16:20:07'),
(108, 7, 'OUT', '2025-06-05 16:20:40', '2025-06-05 16:20:40'),
(109, 5, 'OUT', '2025-06-05 16:35:57', '2025-06-05 16:35:57'),
(110, 5, 'IN', '2025-06-05 16:41:24', '2025-06-05 16:41:24'),
(111, 5, 'OUT', '2025-06-05 16:48:45', '2025-06-05 16:48:45'),
(112, 5, 'IN', '2025-06-05 16:49:38', '2025-06-05 16:49:38'),
(113, 7, 'IN', '2025-06-05 16:50:20', '2025-06-05 16:50:20'),
(114, 6, 'IN', '2025-06-05 16:50:38', '2025-06-05 16:50:38'),
(115, 6, 'OUT', '2025-06-05 16:53:03', '2025-06-05 16:53:03'),
(116, 6, 'IN', '2025-06-05 16:53:26', '2025-06-05 16:53:26'),
(117, 6, 'OUT', '2025-06-05 16:53:53', '2025-06-05 16:53:53'),
(118, 5, 'OUT', '2025-06-05 16:56:47', '2025-06-05 16:56:47'),
(119, 6, 'IN', '2025-06-05 16:57:34', '2025-06-05 16:57:34'),
(120, 5, 'IN', '2025-06-05 17:00:16', '2025-06-05 17:00:16'),
(121, 4, 'OUT', '2025-06-05 17:04:01', '2025-06-05 17:04:01'),
(122, 7, 'OUT', '2025-06-05 17:04:17', '2025-06-05 17:04:17'),
(123, 6, 'OUT', '2025-06-05 17:14:04', '2025-06-05 17:14:04'),
(124, 6, 'IN', '2025-06-25 00:24:39', '2025-06-25 00:24:39'),
(125, 4, 'IN', '2025-06-25 00:24:44', '2025-06-25 00:24:44'),
(126, 4, 'OUT', '2025-06-25 00:25:14', '2025-06-25 00:25:14'),
(127, 5, 'OUT', '2025-06-25 00:25:37', '2025-06-25 00:25:37'),
(128, 9, 'IN', '2025-06-25 00:25:48', '2025-06-25 00:25:48'),
(129, 7, 'IN', '2025-06-25 00:25:57', '2025-06-25 00:25:57'),
(130, 7, 'OUT', '2025-06-25 00:26:02', '2025-06-25 00:26:02'),
(131, 7, 'IN', '2025-06-25 00:27:33', '2025-06-25 00:27:33'),
(132, 7, 'OUT', '2025-06-25 00:29:16', '2025-06-25 00:29:16'),
(133, 4, 'IN', '2025-06-25 00:30:17', '2025-06-25 00:30:17'),
(134, 6, 'OUT', '2025-06-25 00:30:25', '2025-06-25 00:30:25'),
(135, 4, 'OUT', '2025-06-25 00:30:52', '2025-06-25 00:30:52'),
(136, 5, 'IN', '2025-06-25 00:30:59', '2025-06-25 00:30:59'),
(137, 9, 'OUT', '2025-06-25 00:31:05', '2025-06-25 00:31:05'),
(138, 7, 'IN', '2025-06-25 00:31:11', '2025-06-25 00:31:11'),
(139, 7, 'OUT', '2025-06-25 00:31:35', '2025-06-25 00:31:35'),
(140, 7, 'IN', '2025-06-25 00:31:55', '2025-06-25 00:31:55'),
(141, 7, 'OUT', '2025-06-25 00:32:15', '2025-06-25 00:32:15'),
(142, 7, 'IN', '2025-06-25 00:32:35', '2025-06-25 00:32:35'),
(143, 6, 'IN', '2025-06-25 02:41:02', '2025-06-25 02:41:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicle_log`
--
ALTER TABLE `vehicle_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_log_ibfk_1` (`ResidentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicle_log`
--
ALTER TABLE `vehicle_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admins` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `vehicle_log`
--
ALTER TABLE `vehicle_log`
  ADD CONSTRAINT `vehicle_log_ibfk_1` FOREIGN KEY (`ResidentID`) REFERENCES `residents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
