-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 02:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp_dmc`
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
-- Table structure for table `membership_members`
--

CREATE TABLE `membership_members` (
  `member_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `qr_size` int(11) DEFAULT NULL,
  `theme` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiring_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_members`
--

INSERT INTO `membership_members` (`member_id`, `customer_id`, `plan_id`, `qr_size`, `theme`, `expiring_at`, `created_at`, `updated_at`) VALUES
('WM-606-901', 7, 4, 200, 'modern', '2024-01-25', '2023-12-29 16:17:13', '2024-01-18 07:09:47'),
('WM-599-872', 8, 2, 200, NULL, '2024-02-22', '2024-01-08 15:29:10', '2024-01-16 15:48:08'),
('WM-877-664', 16, 4, NULL, NULL, '2024-02-29', '2024-01-15 04:39:25', '2024-01-15 04:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `membership_plans`
--

CREATE TABLE `membership_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_plans`
--

INSERT INTO `membership_plans` (`id`, `name`, `color`, `price`, `is_active`) VALUES
(1, 'Gold', '#f0d07b', 50, 1),
(2, 'Platinum', '#484848', 100, 1),
(4, 'Silver', '#bcbcbc', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `membership_social_links`
--

CREATE TABLE `membership_social_links` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reddit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tumblr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_social_links`
--

INSERT INTO `membership_social_links` (`customer_id`, `website`, `twitter`, `facebook`, `instagram`, `reddit`, `tumblr`, `youtube`, `linkedin`, `whatsapp`, `pinterest`, `tiktok`, `created_at`, `updated_at`) VALUES
(7, 'google.com', NULL, 'facebook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-04 23:36:47'),
(8, 'google.com', NULL, 'facebook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(5, '2023_11_26_232102_create_settings_table', 1),
(6, '2023_11_26_234742_create_roles_table', 1),
(7, '2023_11_26_234801_create_role_groups_table', 1),
(8, '2023_11_27_055017_create_user_details_table', 1),
(9, '2023_12_29_130633_create_membership_plans_table', 2),
(10, '2023_12_29_141822_create_membership_members_table', 3),
(13, '2023_12_31_084208_create_virtual_cards_table', 4),
(15, '2024_01_03_140404_create_membership_social_links_table', 5),
(16, '2024_01_10_132810_create_vendor_types_table', 6),
(17, '2024_01_10_132826_create_vendor_locations_table', 6),
(18, '2024_01_10_132903_create_vendor_categories_table', 6),
(19, '2024_01_11_131723_create_vendor_details_table', 7),
(20, '2024_01_13_142845_create_purchase_histories_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@email.com', '$2y$12$cflXVGgXGHZ1fYUTzTVsiejjvUH1JhlUi9Zl.1Mlr/exUTwhXrjHK', '2024-01-05 22:52:27');

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
-- Table structure for table `purchase_histories`
--

CREATE TABLE `purchase_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `type` bigint(20) UNSIGNED NOT NULL,
  `location` bigint(20) UNSIGNED NOT NULL,
  `categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`categories`)),
  `subtotal` double NOT NULL,
  `discount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_histories`
--

INSERT INTO `purchase_histories` (`id`, `customer_id`, `vendor_id`, `type`, `location`, `categories`, `subtotal`, `discount`, `created_at`, `updated_at`) VALUES
(1, 8, 13, 1, 2, '[\"3\"]', 200, 25, '2024-01-13 07:17:41', '2024-01-17 16:08:41'),
(3, 7, 14, 2, 3, '[\"3\",\"4\"]', 600, 25, '2024-01-14 05:36:59', '2024-01-14 05:36:59'),
(4, 16, 13, 3, 2, '[\"2\",\"3\"]', 1000, 10, '2024-01-15 04:40:18', '2024-01-17 16:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'Admin', 'All rights to the whole panel'),
(2, 'User', 'Can access to specific functions.'),
(3, 'Customer', 'Can access to specific functions.'),
(4, 'Vendor', 'Managing Business');

-- --------------------------------------------------------

--
-- Table structure for table `role_groups`
--

CREATE TABLE `role_groups` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_groups`
--

INSERT INTO `role_groups` (`user_id`, `role_id`) VALUES
(1, 1),
(15, 2),
(7, 3),
(8, 3),
(16, 3),
(13, 4),
(14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_ban` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `is_active`, `is_ban`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Efrain Bayer III', 'admin@email.com', '2023-12-28 14:55:06', '$2y$12$h5AoWyYuNIM8NgebmU8D7uk7raGXsSKdwPohBLhELaahOQnGU2Zi2', '6dEFclSMARqXTRyOKDa3Dyc8R5Hu2lyBMfC3nZpyHXiA227KlQoenKlnsYK8', 1, 0, '2023-12-28 14:55:06', '2023-12-28 14:55:06'),
(7, 'Nor Isnur Najmuddin', 'customer1@email.com', NULL, '$2y$12$LDflHpd5f0ymdpmbLwIXcOXFLDvWeKualknL1Wlw9AT0V4kFtzrHu', NULL, 1, 0, '2023-12-29 16:17:13', '2024-01-15 04:38:49'),
(8, 'Sophia Williamson', 'customer@email.com', NULL, '$2y$12$U5W6M.A.KNGSQ2Me0E9noOarRlGPvheSBhCjyohK2umr8Lb/qmKuK', NULL, 1, 0, '2024-01-08 15:29:10', '2024-01-15 15:04:31'),
(13, 'Bernice Wallace', 'vendor@email.com', NULL, '$2y$12$D7L0YJUmYM/GMjlIYwSmjebabKMtQbRzFcqmlNRXXpXVSfSEMj0RO', NULL, 1, 0, '2024-01-11 04:18:00', '2024-01-17 01:19:01'),
(14, 'Tony Gilbert', 'vendor1@email.com', NULL, '$2y$12$QGh5obvblcTHP9PokMHXxOE9luOAO0kxOGPEyZCzMWySdpE0HhR9u', NULL, 0, 0, '2024-01-11 04:18:51', '2024-01-11 04:21:22'),
(15, 'Jessie James', 'user@email.com', NULL, '$2y$12$2/e0pF8JfOSVQ/Z3lT.LSOCxvuVuutkafAjED.Vryxs6225SN/ED6', NULL, 1, 0, '2024-01-14 15:07:55', '2024-01-14 15:07:55'),
(16, 'Joses Jordan', 'customer2@email.com', NULL, '$2y$12$M1SwtbglZCbqSxSdlrP/y.7J.U6EYuzdSM4WzFrpXLmGnW/k8rQvm', NULL, 0, 0, '2024-01-15 04:39:25', '2024-01-15 04:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ic_number` bigint(20) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('m','f') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `country` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `ic_number`, `image`, `gender`, `organization`, `phone_number`, `address`, `city`, `state`, `zip`, `country`, `created_at`, `updated_at`) VALUES
(7, 123456789, NULL, NULL, NULL, '23426031513', '3rd Floor, Jaya Shopping Center', NULL, NULL, NULL, NULL, '2023-12-29 16:17:13', '2024-01-05 22:15:53'),
(8, 12365478952, NULL, NULL, NULL, '5969862813', '867, Jalan Hang Tuah', NULL, NULL, NULL, NULL, '2024-01-08 15:29:10', '2024-01-16 15:56:21'),
(13, NULL, NULL, NULL, 'Narmi Rich Enterprise', '4532446947', NULL, NULL, NULL, NULL, NULL, '2024-01-11 04:18:00', '2024-01-11 04:18:00'),
(14, NULL, NULL, NULL, 'Aspire Studio Production', '8099910858', NULL, NULL, NULL, NULL, NULL, '2024-01-11 04:18:51', '2024-01-11 04:18:51'),
(16, NULL, NULL, NULL, NULL, '0125982700', NULL, NULL, NULL, NULL, NULL, '2024-01-15 04:39:25', '2024-01-15 04:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_categories`
--

CREATE TABLE `vendor_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_categories`
--

INSERT INTO `vendor_categories` (`id`, `name`) VALUES
(2, 'Venue'),
(3, 'Photographer'),
(4, 'Bridal');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_details`
--

CREATE TABLE `vendor_details` (
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`types`)),
  `categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`categories`)),
  `locations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`locations`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_details`
--

INSERT INTO `vendor_details` (`vendor_id`, `types`, `categories`, `locations`, `created_at`, `updated_at`) VALUES
(13, '[\"1\",\"3\"]', '[\"2\",\"3\"]', '[\"2\"]', '2024-01-12 04:32:02', '2024-01-15 14:59:04'),
(14, '[\"2\"]', '[\"3\",\"4\"]', '[\"1\",\"3\"]', '2024-01-12 04:31:40', '2024-01-12 04:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_locations`
--

CREATE TABLE `vendor_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_locations`
--

INSERT INTO `vendor_locations` (`id`, `name`) VALUES
(1, 'Kuala Lumpur'),
(2, 'Johor Bahru'),
(3, 'Penang');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_types`
--

CREATE TABLE `vendor_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_types`
--

INSERT INTO `vendor_types` (`id`, `name`) VALUES
(1, 'Malay'),
(2, 'Chinese'),
(3, 'Indian');

-- --------------------------------------------------------

--
-- Table structure for table `virtual_cards`
--

CREATE TABLE `virtual_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slugurl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `virtual_cards`
--

INSERT INTO `virtual_cards` (`id`, `name`, `slugurl`, `customer_id`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Nor VCard', 'nor-vcard', 7, 1, '2024-01-02 15:39:00', '2024-01-16 15:04:01'),
(3, 'Sop Vcard', 'sop-vcard', 8, 1, '2024-01-09 06:45:00', '2024-01-16 15:05:32');

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
-- Indexes for table `membership_members`
--
ALTER TABLE `membership_members`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `membership_members_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `membership_plans`
--
ALTER TABLE `membership_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_social_links`
--
ALTER TABLE `membership_social_links`
  ADD PRIMARY KEY (`customer_id`);

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
-- Indexes for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_histories_customer_id_foreign` (`customer_id`),
  ADD KEY `purchase_histories_vendor_id_foreign` (`vendor_id`),
  ADD KEY `purchase_histories_type_foreign` (`type`),
  ADD KEY `purchase_histories_location_foreign` (`location`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_groups`
--
ALTER TABLE `role_groups`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_groups_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `settings_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendor_categories`
--
ALTER TABLE `vendor_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_details`
--
ALTER TABLE `vendor_details`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_locations`
--
ALTER TABLE `vendor_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_types`
--
ALTER TABLE `vendor_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `virtual_cards`
--
ALTER TABLE `virtual_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `virtual_cards_customer_id_foreign` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `membership_plans`
--
ALTER TABLE `membership_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vendor_categories`
--
ALTER TABLE `vendor_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendor_locations`
--
ALTER TABLE `vendor_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor_types`
--
ALTER TABLE `vendor_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `virtual_cards`
--
ALTER TABLE `virtual_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membership_members`
--
ALTER TABLE `membership_members`
  ADD CONSTRAINT `membership_members_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `membership_members_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `membership_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `membership_social_links`
--
ALTER TABLE `membership_social_links`
  ADD CONSTRAINT `membership_social_links_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  ADD CONSTRAINT `purchase_histories_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_histories_location_foreign` FOREIGN KEY (`location`) REFERENCES `vendor_locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_histories_type_foreign` FOREIGN KEY (`type`) REFERENCES `vendor_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_histories_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_groups`
--
ALTER TABLE `role_groups`
  ADD CONSTRAINT `role_groups_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendor_details`
--
ALTER TABLE `vendor_details`
  ADD CONSTRAINT `vendor_details_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `virtual_cards`
--
ALTER TABLE `virtual_cards`
  ADD CONSTRAINT `virtual_cards_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
