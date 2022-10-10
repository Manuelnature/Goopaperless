-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 10, 2022 at 02:38 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client_file_system`
--

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_16_221152_create_products_table', 1);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `file`, `created_at`, `updated_at`) VALUES
(1, 'yama', 'roger', '1658010790.pdf', '2022-07-16 22:33:10', '2022-07-16 22:33:10'),
(2, 'second', 'another file', '1658012667.jpeg', '2022-07-16 23:04:27', '2022-07-16 23:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_files`
--

CREATE TABLE `tbl_files` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_id` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `folder_id` int(11) DEFAULT NULL,
  `access_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(200) DEFAULT NULL,
  `updated_at` varchar(200) DEFAULT NULL,
  `updated_by` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_files`
--

INSERT INTO `tbl_files` (`id`, `title`, `description`, `file_name`, `file_id`, `file_url`, `folder_id`, `access_to`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6, 'csc201', 'First file for kofi', 'csc2011665355484.pdf', '1vY80CksiiF1mJAhidGIr9cwOezuEjDP1', 'https://drive.google.com/drive/folders/1vY80CksiiF1mJAhidGIr9cwOezuEjDP1', 3, '[{\"order\":0,\"user_id\":\"16\"}]', '2022-10-09 22:44:49', '17', '2022-10-09 22:47:42', 'Kukua Cobbina'),
(7, 'math201', 'My math book by Kofi Yankah', 'math2011665355529.pdf', '1vY80CksiiF1mJAhidGIr9cwOezuEjDP1', 'https://drive.google.com/drive/folders/1vY80CksiiF1mJAhidGIr9cwOezuEjDP1', 3, '[{\"order\":0,\"user_id\":null},{\"order\":1,\"user_id\":null}]', '2022-10-09 22:45:33', '16', '2022-10-09 22:46:41', 'Kukua Cobbina'),
(8, 'Csc702', 'First csc for Kof', 'Csc7021665357294.pdf', '1KC-ZkxEkG0l9cge5AoNL_HdvqNt9stO4', 'https://drive.google.com/drive/folders/1KC-ZkxEkG0l9cge5AoNL_HdvqNt9stO4', 4, '[{\"order\":0,\"user_id\":\"16\"}]', '2022-10-09 23:14:58', 'Kukua Cobbina', '2022-10-09 23:15:29', 'Kukua Cobbina');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_folders`
--

CREATE TABLE `tbl_folders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `folder_id` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_folders`
--

INSERT INTO `tbl_folders` (`id`, `name`, `description`, `url`, `folder_id`, `date_created`, `updated_by`, `updated_at`) VALUES
(3, 'Manuel', 'Manuel\'s folder', 'https://drive.google.com/drive/folders/1vY80CksiiF1mJAhidGIr9cwOezuEjDP1', '1vY80CksiiF1mJAhidGIr9cwOezuEjDP1', '2022-10-09 22:43:42', 'Kukua Cobbina', '2022-10-09 23:13:19'),
(4, 'Andrew', 'Andrew Folder', 'https://drive.google.com/drive/folders/1KC-ZkxEkG0l9cge5AoNL_HdvqNt9stO4', '1KC-ZkxEkG0l9cge5AoNL_HdvqNt9stO4', '2022-10-09 22:44:04', 'Kukua Cobbina', '2022-10-09 23:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_links`
--

CREATE TABLE `tbl_links` (
  `id` int(11) NOT NULL,
  `link` longtext DEFAULT NULL,
  `shared_to` varchar(200) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(200) DEFAULT NULL,
  `updated_at` varchar(200) DEFAULT NULL,
  `updated_by` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `firstname`, `lastname`, `email`, `password`, `city`, `role`, `phone_number`, `profession`, `address`, `photo`, `date_created`, `updated_by`, `updated_at`) VALUES
(9, 'Andrew', 'Sowah', 'andre@yahoo.com', '$2y$10$1276b5SccSPDfLQCQr8nfO1lRofkiwJjQggic.FOnymxCIK9dW3CS', 'Accra', 'Super Admin', '022145454', 'Programmer', 'Taifa Haifa', NULL, '2022-08-11 21:51:51', NULL, NULL),
(10, 'Abena', 'Kuku', 'kuku@gmail.com', '$2y$10$bqyGtDM.6WxpL6uDzI/c8OFLTVTX5E3/uCfKoKRoPiRD8LSVzlvsS', 'Tema New', 'Super Admin', '055636214', 'Teacher and nurse', 'Comm. 17', 'ProfilePhoto866-2022-09-23-01-58-30.png', '2022-09-01 22:30:54', 'Kwame Ayew', '2022-09-23 02:00:38'),
(12, 'Kwame Newman', 'Ayew', 'ayew@gmail.com', '$2y$10$UBLW2zEdD.sjVMdnmebte.aAi7eXJgDMBkl6g.QfVsXHLxQKT3kHe', 'Tamale City', 'Super Admin', '0245787788', 'Footballer', 'Tamale New Market', NULL, '2022-09-02 01:22:01', 'Kwame Newman Ayew', '2022-09-27 19:45:30'),
(13, 'Kukua', 'Cobbina', 'kukua@gmail.com', '$2y$10$hWdPJD.xux0dBK1kB0SOh.H2j1BQIcnlinZ1Ba9YNOpzZGA0e0kxO', 'Cape Coast', 'Admin', '0212336699', 'Accountant', 'Moree Junction', 'ProfilePhoto890-2022-09-02-15-06-43.jpg', '2022-09-02 15:06:43', NULL, NULL),
(14, 'Ewura', 'Efua', 'efua@gmail.com', '$2y$10$KusU.w33VwYA5PAJbn0N3uwqFZnz48EPN0ast9j8fK8kBCPKlAqHq', 'Elmina', 'Basic', '0245636363', 'Sales Manager', 'Elmina', NULL, '2022-09-02 15:12:07', NULL, NULL),
(15, 'Frank', 'Adjei Mensah', 'frank@gmail.com', '$2y$10$E0Bq8xyJNNksR0hyF0w8C.lHb8oOCQhTcoTLcxUOhSwDF4gYMziqq', 'Kasoa', 'Admin', '0222454545', 'Medical Doctor', 'Kasoa Millenium City', 'ProfilePhoto974-2022-09-02-20-16-17.jpg', '2022-09-02 20:16:17', NULL, NULL),
(16, 'Kofi Abiem', 'Yankah', 'yankah@gmail.com', '$2y$10$bBqvP4ZfszEuj9/kM/3.m.04qahy5JHq28LwLUrBrqEkakKmz2ze6', 'Sunyani', 'Basic', '0245787788', 'Accountant', 'TML High Street', NULL, '2022-09-21 22:17:29', NULL, NULL),
(17, 'Kukua', 'Cobbina', 'man@gmail.com', '$2y$10$J8GU5.Qz7Se1RNV.CZfeuO/a7IF5xFf.C3Ou7F9BJorgkY24Iq3Ve', 'Angloga', 'Super Admin', '0245787788', 'Accountant', 'Hey there', NULL, '2022-09-23 02:02:48', NULL, NULL),
(18, 'Kofi', 'yankah', 'kya@gmail.com', '$2y$10$3iluXPtp3pK6Eaal//Euo.hpe8jfXX2U19N4fcqr2iLVx7PhHbPae', 'Manhean', 'Admin', '0222145445', 'Footballer and manager', 'Hey', NULL, '2022-09-23 02:18:30', 'Kwame Ayew', '2022-09-23 02:19:05');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folder_id` (`folder_id`);

--
-- Indexes for table `tbl_folders`
--
ALTER TABLE `tbl_folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_links`
--
ALTER TABLE `tbl_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_files`
--
ALTER TABLE `tbl_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_folders`
--
ALTER TABLE `tbl_folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_links`
--
ALTER TABLE `tbl_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
