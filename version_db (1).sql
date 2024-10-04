-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 08:30 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `version_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_03_113816_create_products_table', 1),
(6, '2024_10_04_172348_add_user_id_to_products_table', 2);

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_type` enum('flat','discount') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `product_name`, `product_price`, `product_quantity`, `product_type`, `discount`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ss', '32.00', 2, 'discount', '23', '2024-10-03 06:59:00', '2024-10-03 06:59:00'),
(2, NULL, 'ss', '11.00', 11, 'flat', '2', '2024-10-03 09:31:02', '2024-10-03 09:31:02'),
(3, NULL, 'qq', '12.00', 2, 'discount', NULL, '2024-10-03 09:31:02', '2024-10-03 09:31:02'),
(4, NULL, 'ss', '220.00', 2, 'discount', '23', '2024-10-03 09:39:11', '2024-10-03 09:39:11'),
(5, NULL, 'cc', '1200.00', 2, 'flat', NULL, '2024-10-03 09:40:00', '2024-10-03 09:40:00'),
(6, NULL, 'ss', '120.00', 2, 'flat', '100', '2024-10-03 13:41:16', '2024-10-03 13:41:16'),
(7, NULL, 'cc', '120.00', 2, 'discount', NULL, '2024-10-03 13:41:16', '2024-10-03 13:41:16'),
(8, NULL, 'sew', '12.00', 12, 'flat', '0', '2024-10-04 03:57:39', '2024-10-04 03:57:39'),
(9, NULL, 'sew', '12.00', 12, 'discount', '10', '2024-10-04 04:02:22', '2024-10-04 04:02:22'),
(10, NULL, 'xxx', '12.00', 12, 'flat', '0', '2024-10-04 04:03:56', '2024-10-04 04:03:56'),
(11, NULL, 'xxx', '12.00', 12, 'discount', '12', '2024-10-04 04:07:17', '2024-10-04 04:07:17'),
(12, NULL, 'xxx', '12.00', 12, 'flat', '20', '2024-10-04 04:21:38', '2024-10-04 04:21:38'),
(13, NULL, 'sew', '1333.00', 20, 'discount', '0', '2024-10-04 04:21:38', '2024-10-04 04:21:38'),
(14, NULL, 'xxx', '1333.00', 2, 'discount', '10', '2024-10-04 04:28:10', '2024-10-04 04:28:10'),
(15, NULL, 'sew', '133.00', 4, 'discount', '20', '2024-10-04 04:29:28', '2024-10-04 04:29:28'),
(16, NULL, 'watch', '1200.00', 5, 'flat', '20', '2024-10-04 06:00:51', '2024-10-04 06:00:51'),
(17, NULL, 'shirt', '1500.00', 20, 'discount', '0', '2024-10-04 06:00:51', '2024-10-04 06:00:51'),
(18, NULL, 'sew', '12.00', 2, 'discount', '10', '2024-10-04 10:24:56', '2024-10-04 10:24:56'),
(19, 21, 'shirt', '13000.00', 3, 'discount', '20', '2024-10-04 11:58:39', '2024-10-04 11:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `phonenumber`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(15, 'radha', 'shubhampawadessss', '09921322784', 'ritesh9@1111doshiaccountants.com', '$2y$12$hLB03vIKIa/BoKflWWSfI.zJC2dy28fb1P2rPgE/afDH/1b2Up1zi', NULL, '2024-10-04 04:07:17', '2024-10-04 11:37:47'),
(17, 'shubham pawade', 'pawade832swaa@gmail.com', '09921322784', 'pawadeshubhamwas78@gmail.com', '$2y$12$1/cJxdW3YLH0WuYg4kz6SOiOLIMcGPffe/5ZuoMw058sTBxy85.ym', NULL, '2024-10-04 04:28:10', '2024-10-04 04:28:10'),
(18, 'shubham pawade', 'adminqqq', '09921322784', 'ss@gmail.com', '$2y$12$hTqJla.PXCz.ac4Yf8baVOnlPqXCePBmN2r4dqmtgr.CchGNFnPMi', NULL, '2024-10-04 04:29:28', '2024-10-04 04:29:28'),
(19, 'sweta gawande', 'swea', '666666666', 'sweta@gmail.com', '$2y$12$HLG1LVvr.ReuJ1dRSZOPvOtR4zNOrto77X2lSqqRAKd2LNYd.DavG', NULL, '2024-10-04 06:00:51', '2024-10-04 06:00:51'),
(20, 'Reshma', 'sswwwwww', '11111111', 'sss@gmail.com', '$2y$12$Ht2XuNA6sxO52fGNffn6Puu6ft0C.LL4hD9g5wFYHP.FPEGjBavAK', NULL, '2024-10-04 10:24:56', '2024-10-04 10:24:56'),
(21, 'yogesh gawade', 'yogesh121', '776655667', 'user@example.com', '$2y$12$3hwpMyVJ1LA3K3lZXmT1run2GisNbX9xXp5wF4jqn30BF7xKBp72a', NULL, '2024-10-04 11:58:39', '2024-10-04 11:58:39');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
