-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2026 at 09:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_file_cabinet_uho`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumens`
--

CREATE TABLE `dokumens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `laci_id` bigint(20) UNSIGNED NOT NULL,
  `nama_file_asli` varchar(255) NOT NULL,
  `nama_file_sistem` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `status` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending',
  `catatan_dosen` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumens`
--

INSERT INTO `dokumens` (`id`, `user_id`, `laci_id`, `nama_file_asli`, `nama_file_sistem`, `path_file`, `status`, `catatan_dosen`, `created_at`, `updated_at`) VALUES
(13, 123, 1, 'Laporan_Deteksi_Coklat (2) (1) (2).pdf', 'E1E123010_LaporanAkhir_24-04-2026.pdf', 'public/dokumen_mahasiswa/E1E123010_LaporanAkhir_24-04-2026.pdf', 'disetujui', NULL, '2026-04-23 18:09:26', '2026-04-23 18:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lacis`
--

CREATE TABLE `lacis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_laci` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lacis`
--

INSERT INTO `lacis` (`id`, `nama_laci`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Laporan Akhir', NULL, '2026-04-22 09:22:27', '2026-04-22 09:22:27'),
(2, 'Transkrip Nilai', NULL, '2026-04-22 09:22:35', '2026-04-22 09:22:35'),
(3, 'Skripsi', NULL, '2026-04-22 22:29:34', '2026-04-22 22:29:34'),
(4, 'Berita Acara', NULL, '2026-04-23 15:57:06', '2026-04-23 15:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_22_111635_create_lacis_table', 1),
(5, '2026_04_22_111646_create_dokumens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL DEFAULT 'mahasiswa',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nim`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin TI UHO', 'admin.ti@uho.ac.id', NULL, 'admin', NULL, '$2y$12$jle5reh7d7IPyA/gR1OmreMCaiGr0L/Dslsr49Z61AR4E2KUqcAT2', 'EUHPeWm189IeBWgXaaQLFShywvJErAMXJS2SNWrL4CBhr2m2TG8HxYriWWnq', '2026-04-22 09:21:41', '2026-04-22 09:21:41'),
(23, 'Aulia Rezky', 'rezky@uho.ac.id', NULL, 'dosen', NULL, '$2y$12$t49mBfvDNxJMq31BX303vuO0OAeoe24cR2Ph5vNn3rfRF2aktXjvK', NULL, '2026-04-23 16:34:51', '2026-04-23 16:34:51'),
(114, 'Mahasiswa E1E123001', NULL, 'E1E123001', 'mahasiswa', NULL, '$2y$12$Y8UD/kvWfqeS9NbcbHLMI.sZjrdg9D4flYqHAztq01Bx6MCljtpWK', NULL, '2026-04-23 18:02:31', '2026-04-23 18:02:31'),
(115, 'Mahasiswa E1E123002', NULL, 'E1E123002', 'mahasiswa', NULL, '$2y$12$4s/UZGDRnJfuK1sfduPQ5ODbIwtoKE1XsbSByoLQqUQmTDewVFM2S', NULL, '2026-04-23 18:02:31', '2026-04-23 18:02:31'),
(116, 'Mahasiswa E1E123003', NULL, 'E1E123003', 'mahasiswa', NULL, '$2y$12$SbMgKO3X2fGr9xR5BTqaru6O2XPEJCwbhrlhugtRQXLvQmdBynL5q', NULL, '2026-04-23 18:02:32', '2026-04-23 18:02:32'),
(117, 'Mahasiswa E1E123004', NULL, 'E1E123004', 'mahasiswa', NULL, '$2y$12$ye1c9EcnUN7IpAzzNrXF1uHtBSvsGrMXUUDtZdOLgCgSL9/.gNvHe', NULL, '2026-04-23 18:02:32', '2026-04-23 18:02:32'),
(118, 'Zulfikar', NULL, 'E1E123005', 'mahasiswa', NULL, '$2y$12$EE.4/R61Lw2Wtfau2OZF9.TPVar7vFrc5q5FflA7JyjAoUYdNZ3zK', NULL, '2026-04-23 18:02:32', '2026-04-23 19:09:29'),
(119, 'Mahasiswa E1E123006', NULL, 'E1E123006', 'mahasiswa', NULL, '$2y$12$KQEQR2XwFbhvvvWVr72cXurTPQlMUeBE128vdPrfdrAc6Zqh2PYzm', NULL, '2026-04-23 18:02:33', '2026-04-23 18:02:33'),
(120, 'Mahasiswa E1E123007', NULL, 'E1E123007', 'mahasiswa', NULL, '$2y$12$G5t3YZnnRRHNOxKXAjPYOOngh5jCQFj100znkIsixVQar/Gy6iabi', NULL, '2026-04-23 18:02:33', '2026-04-23 18:02:33'),
(121, 'Mahasiswa E1E123008', NULL, 'E1E123008', 'mahasiswa', NULL, '$2y$12$RJOXwrCTTtXIv2GXPTLjTO5fJuJHHy1PoSieppffLnYuO57Y9cy1m', NULL, '2026-04-23 18:02:34', '2026-04-23 18:02:34'),
(122, 'Mahasiswa E1E123009', NULL, 'E1E123009', 'mahasiswa', NULL, '$2y$12$ZGmzrZQeJzq46yih7e7SUua6uArLKGCI23r5ZJ9EqPEs4Kfb7spPK', NULL, '2026-04-23 18:02:34', '2026-04-23 18:02:34'),
(123, 'Yura Aulia', NULL, 'E1E123010', 'mahasiswa', NULL, '$2y$12$A..xrosg1VpT8es4sFGv/uSFMO1w4px7xze6oeJ1gOUFxmoOa2VWC', NULL, '2026-04-23 18:02:34', '2026-04-23 18:07:14'),
(124, 'Mahasiswa E1E123011', NULL, 'E1E123011', 'mahasiswa', NULL, '$2y$12$LfifSnLKRIByOM5CL2s0QeAnCw3FM9rwTQg5XjHYHH1b6UXGVRYjS', NULL, '2026-04-23 18:02:35', '2026-04-23 18:02:35'),
(125, 'Mahasiswa E1E123012', NULL, 'E1E123012', 'mahasiswa', NULL, '$2y$12$0O.kkV1vRLSYIg42Q91iaO1L6xJIbrm66e/RAnEgbsEsKYRwaRvA6', NULL, '2026-04-23 18:02:35', '2026-04-23 18:02:35'),
(126, 'Mahasiswa E1E123013', NULL, 'E1E123013', 'mahasiswa', NULL, '$2y$12$3y0AIme953rdnyXHAyGPA.5mUL7x4nmHICXe.d0hPysjnqb0zmM1G', NULL, '2026-04-23 18:02:36', '2026-04-23 18:02:36'),
(127, 'Mahasiswa E1E123014', NULL, 'E1E123014', 'mahasiswa', NULL, '$2y$12$PJu4UOv/AzbF0AuEcgGpju4UqDPwrzq94UfIIDNETCasiPho.poL2', NULL, '2026-04-23 18:02:36', '2026-04-23 18:02:36'),
(128, 'Mahasiswa E1E123015', NULL, 'E1E123015', 'mahasiswa', NULL, '$2y$12$VeaEENNtQw0l2lQLdAgK.ufFeoqBV4BHP9/XAZGtpFbvaZCzIC/w2', NULL, '2026-04-23 18:02:36', '2026-04-23 18:02:36'),
(129, 'Mahasiswa E1E123016', NULL, 'E1E123016', 'mahasiswa', NULL, '$2y$12$cpVsetKY3tq.OIOYPLD9COeqfXjX6bmSdXr.4PpXziphPSUypbmUu', NULL, '2026-04-23 18:02:37', '2026-04-23 18:02:37'),
(130, 'Mahasiswa E1E123017', NULL, 'E1E123017', 'mahasiswa', NULL, '$2y$12$NWexWq6Sx1aTlQ.jk7p/KOHgtYjZWNCYPA/9GszRuWUnVz1OfIVK2', NULL, '2026-04-23 18:02:37', '2026-04-23 18:02:37'),
(131, 'Mahasiswa E1E123018', NULL, 'E1E123018', 'mahasiswa', NULL, '$2y$12$XZF./SIG2LyilqDx5KlpFeotXdQRXT.51vag.rK6os6gfCVkjZfmO', NULL, '2026-04-23 18:02:37', '2026-04-23 18:02:37'),
(132, 'Mahasiswa E1E123019', NULL, 'E1E123019', 'mahasiswa', NULL, '$2y$12$AGFvCf8uiB.it8D6uTfkce8WZXxcU8DeLImr8s/kwygAe9OpShjxO', NULL, '2026-04-23 18:02:38', '2026-04-23 18:02:38'),
(133, 'Mahasiswa E1E123020', NULL, 'E1E123020', 'mahasiswa', NULL, '$2y$12$aR0U8YP9lwmuhZVDoJ6i5e/tGs573z.k1zJ93gGkY.Z6beG2wI7Se', NULL, '2026-04-23 18:02:38', '2026-04-23 18:02:38'),
(136, 'shina ashcroft', NULL, 'E1E122009', 'mahasiswa', NULL, '$2y$12$GeX54P.wxNz4G3E9PM4ozO0.A940PG03c1aJt/0aieU/5Y7xOR5FO', NULL, '2026-04-23 18:33:57', '2026-04-23 18:33:57'),
(137, 'dosen', 'dosen@uho.ac.id', NULL, 'dosen', NULL, '$2y$12$BpOLYu4GBn1bAWaW8XTlTuuxrzh6yL15dC3M7pjnjxfDeY6YexR3K', NULL, '2026-04-23 19:08:37', '2026-04-23 19:08:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `dokumens`
--
ALTER TABLE `dokumens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumens_user_id_foreign` (`user_id`),
  ADD KEY `dokumens_laci_id_foreign` (`laci_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lacis`
--
ALTER TABLE `lacis`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nim_unique` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumens`
--
ALTER TABLE `dokumens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lacis`
--
ALTER TABLE `lacis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumens`
--
ALTER TABLE `dokumens`
  ADD CONSTRAINT `dokumens_laci_id_foreign` FOREIGN KEY (`laci_id`) REFERENCES `lacis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dokumens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
