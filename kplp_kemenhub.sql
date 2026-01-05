-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2026 at 09:15 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kplp_kemenhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_berita_kplp`
--

CREATE TABLE `laporan_berita_kplp` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_berita_positif` int NOT NULL DEFAULT '0',
  `jumlah_berita_negatif` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_berita_kplp`
--

INSERT INTO `laporan_berita_kplp` (`id`, `tanggal`, `jumlah_berita_positif`, `jumlah_berita_negatif`, `created_at`, `updated_at`) VALUES
(1, '2025-12-08', 100, 20, '2025-12-08 07:51:08', '2025-12-08 07:51:08'),
(2, '2025-12-17', 89, 8, '2025-12-17 03:13:31', '2025-12-17 03:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_media_visual`
--

CREATE TABLE `laporan_media_visual` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `tayangan_postingan` int NOT NULL DEFAULT '0',
  `pengikut` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_media_visual`
--

INSERT INTO `laporan_media_visual` (`id`, `tanggal`, `tayangan_postingan`, `pengikut`, `created_at`, `updated_at`) VALUES
(1, '2025-12-08', 340, 90, '2025-12-08 07:40:15', '2025-12-08 07:40:15'),
(2, '2025-12-11', 700, 230, '2025-12-08 07:40:57', '2025-12-08 07:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_ppid`
--

CREATE TABLE `laporan_ppid` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_pemohon` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_ppid`
--

INSERT INTO `laporan_ppid` (`id`, `tanggal`, `jumlah_pemohon`, `created_at`, `updated_at`) VALUES
(1, '2025-12-08', 103, '2025-12-08 03:14:26', '2025-12-08 03:14:26'),
(2, '2025-12-10', 76, '2025-12-08 03:36:46', '2025-12-08 08:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_siaran_pers`
--

CREATE TABLE `laporan_siaran_pers` (
  `id` bigint UNSIGNED NOT NULL,
  `jumlah_siaran_pers` int NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_siaran_pers`
--

INSERT INTO `laporan_siaran_pers` (`id`, `jumlah_siaran_pers`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 800, '2025-12-08', '2025-12-08 08:00:40', '2025-12-08 08:00:40'),
(2, 1350, '2025-12-10', '2025-12-08 08:05:28', '2025-12-17 03:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_skm`
--

CREATE TABLE `laporan_skm` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `responden` int NOT NULL DEFAULT '0',
  `ipk` decimal(5,2) NOT NULL DEFAULT '0.00',
  `ikm` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_skm`
--

INSERT INTO `laporan_skm` (`id`, `tanggal`, `responden`, `ipk`, `ikm`, `created_at`, `updated_at`) VALUES
(1, '2025-12-08', 10, '9.76', '10.77', '2025-12-08 03:41:44', '2025-12-08 04:46:17'),
(2, '2025-12-10', 20, '5.45', '7.65', '2025-12-08 06:14:29', '2025-12-08 06:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `layanan_publik`
--

CREATE TABLE `layanan_publik` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `penyidikan_penyelidikan` int NOT NULL DEFAULT '0',
  `patroli_kapal` int NOT NULL DEFAULT '0',
  `sar` int NOT NULL DEFAULT '0',
  `snbp` int NOT NULL DEFAULT '0',
  `pengawasan_salvage` int NOT NULL DEFAULT '0',
  `marpol` int NOT NULL DEFAULT '0',
  `tamu_kantor` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanan_publik`
--

INSERT INTO `layanan_publik` (`id`, `tanggal`, `penyidikan_penyelidikan`, `patroli_kapal`, `sar`, `snbp`, `pengawasan_salvage`, `marpol`, `tamu_kantor`, `created_at`, `updated_at`) VALUES
(1, '2025-12-08', 6, 9, 8, 3, 4, 5, 7, '2025-12-08 01:49:52', '2025-12-08 02:46:53'),
(3, '2025-12-08', 0, 11, 12, 9, 8, 7, 6, '2025-12-08 02:47:38', '2025-12-08 02:59:46'),
(4, '2025-12-12', 12, 9, 21, 3, 10, 1, 2, '2025-12-08 03:00:36', '2025-12-08 08:24:24');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_03_090018_create_layanan_publik_table', 1),
(5, '2025_12_03_091424_create_laporan_ppid_table', 1),
(6, '2025_12_03_091811_create_laporan_skm_table', 1),
(7, '2025_12_03_092129_create_laporan_media_visual_table', 1),
(8, '2025_12_03_092514_create_laporan_berita_kplp_table', 1),
(9, '2025_12_05_212631_create_laporan_siaran_pers_table', 1),
(10, '2025_12_05_214546_create_pengelolaan_laporan_masuk_table', 1);

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
-- Table structure for table `pengelolaan_laporan_masuk`
--

CREATE TABLE `pengelolaan_laporan_masuk` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `belum_terverifikasi` int NOT NULL DEFAULT '0',
  `terdisposisi_belum_tindak_lanjut` int NOT NULL DEFAULT '0',
  `terdisposisi_sedang_proses` int NOT NULL DEFAULT '0',
  `terdisposisi_selesai` int NOT NULL DEFAULT '0',
  `tertunda` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengelolaan_laporan_masuk`
--

INSERT INTO `pengelolaan_laporan_masuk` (`id`, `tanggal`, `belum_terverifikasi`, `terdisposisi_belum_tindak_lanjut`, `terdisposisi_sedang_proses`, `terdisposisi_selesai`, `tertunda`, `created_at`, `updated_at`) VALUES
(1, '2025-12-05', 70, 40, 40, 80, 50, '2025-12-05 14:54:51', '2025-12-05 15:10:05'),
(2, '2025-12-10', 10, 60, 57, 87, 95, '2025-12-08 08:09:59', '2025-12-08 08:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('09oMGDnpSRZEbw2AZRQK0NfMs077UeA8j0lyk2Wt', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiYVYwMEJRam1Kd1VNd3Bmc1hVMldOZnRUZGMxQ1hLeDFObVNWanpIViI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEyOiJjYXB0Y2hhX3RleHQiO3M6NjoiWThEVk5NIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1765941620),
('H3WCUgwHHotaEPX44xRo6viNsX3lBWPOPNiGhkOr', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRmY1bE5JTjh0U01NWFhKNHZFbTlQMW1xbk0yQmhXRlJsdWFpM0RJaCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEyOiJjYXB0Y2hhX3RleHQiO3M6NjoiWFcyQ0xKIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1767597858),
('IVls8JKhZdvyltCMHCT2m5ScuriLwJD9HwmPuiOy', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieTEzSHVPMVlDNG9hYmNYSURaUlFZNHl4UHFLd2ZWMzJqSkNxWncxQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMjoiY2FwdGNoYV90ZXh0IjtzOjY6IkQ3TjcyUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1765871430),
('SXwVOTPIAZ505iTCEHmyeRVnTXmSxQLp4QjhY6Mj', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZWZFMGl0V0lWcjhpcVF2dmJKVW9abGpOZEYzZ2ZMMmxYdW1TTE81dCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEyOiJjYXB0Y2hhX3RleHQiO3M6NjoiUVBaUE9GIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1766368557),
('WL5BlJ1AFU89ZaWscIjpzLh8FEYINQqtgu2D6L95', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibXVtdGtoM0daMnlNYnFnQ0RiY2EzenRDdE5pNWtxTW9KYXNWUU03RyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEyOiJjYXB0Y2hhX3RleHQiO3M6NjoiWlUwRUVQIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1766538716),
('XV4kP31Fq3fOJsVSssHuZYrkw9D63hry1uinbdeT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSE5KcjJoQkNtQm9NMUhRRWNCTDkwcllWTXY3Y1AwSnZPNXRBUlF5MyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766538641);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Admin KPLP', 'admin', 'admin@kplp.go.id', '2025-12-09 02:23:44', '$2y$12$2Eimocaac87BwEaGxafg7eg8ByF37wRLwGKX.BsYxMO./hlM12aH2', NULL, '2025-12-09 02:23:44', '2025-12-09 02:23:44'),
(4, 'Wulan', 'Karyawan', 'karyawan@gmail.com', '2025-12-09 07:00:58', '$2y$12$2Eimocaac87BwEaGxafg7eg8ByF37wRLwGKX.BsYxMO./hlM12aH2', NULL, '2025-12-09 07:01:37', '2025-12-09 07:01:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

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
-- Indexes for table `laporan_berita_kplp`
--
ALTER TABLE `laporan_berita_kplp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_media_visual`
--
ALTER TABLE `laporan_media_visual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_ppid`
--
ALTER TABLE `laporan_ppid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_siaran_pers`
--
ALTER TABLE `laporan_siaran_pers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_skm`
--
ALTER TABLE `laporan_skm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_publik`
--
ALTER TABLE `layanan_publik`
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
-- Indexes for table `pengelolaan_laporan_masuk`
--
ALTER TABLE `pengelolaan_laporan_masuk`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_berita_kplp`
--
ALTER TABLE `laporan_berita_kplp`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laporan_media_visual`
--
ALTER TABLE `laporan_media_visual`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laporan_ppid`
--
ALTER TABLE `laporan_ppid`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laporan_siaran_pers`
--
ALTER TABLE `laporan_siaran_pers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laporan_skm`
--
ALTER TABLE `laporan_skm`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `layanan_publik`
--
ALTER TABLE `layanan_publik`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengelolaan_laporan_masuk`
--
ALTER TABLE `pengelolaan_laporan_masuk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
