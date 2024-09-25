-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Sep 2024 pada 05.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ruangkominfo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin@example.com|::1', 'i:1;', 1720849127),
('admin@example.com|::1:timer', 'i:1720849127;', 1720849127),
('admin@excample.com|127.0.0.1', 'i:1;', 1720154176),
('admin@excample.com|127.0.0.1:timer', 'i:1720154176;', 1720154176),
('laravel_cache_admin@kominfo.com|127.0.0.1', 'i:1;', 1722879821),
('laravel_cache_admin@kominfo.com|127.0.0.1:timer', 'i:1722879821;', 1722879821),
('laravel_cache_manuelsugianto@gmail.com|127.0.0.1', 'i:1;', 1722879810),
('laravel_cache_manuelsugianto@gmail.com|127.0.0.1:timer', 'i:1722879810;', 1722879810);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `acara` longtext NOT NULL,
  `id_rooms` bigint(20) UNSIGNED NOT NULL,
  `nama_rooms` varchar(255) NOT NULL,
  `asalbidang` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `peserta` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'Menunggu Konfirmasi',
  `catatan` text DEFAULT NULL,
  `presensi` varchar(255) DEFAULT NULL,
  `id_user` varchar(255) DEFAULT NULL,
  `rejection_note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `events`
--

INSERT INTO `events` (`id`, `nama`, `acara`, `id_rooms`, `nama_rooms`, `asalbidang`, `date`, `start`, `finish`, `created_at`, `updated_at`, `peserta`, `status`, `catatan`, `presensi`, `id_user`, `rejection_note`) VALUES
(31, 'Gerson Manuel Sugianto', 'Rapat Tahunan', 6, 'Ruang Aula', 'Informasi dan Komunikasi Publik', '2024-07-18', '07:00:00', '12:00:00', '2024-07-15 11:04:24', '2024-07-15 11:42:20', '20', 'Disetujui', NULL, NULL, NULL, NULL),
(49, 'Kusmala', 'Rapat Tahunan', 6, 'Ruang Aula', 'Informasi dan Komunikasi Publik', '2024-08-13', '09:38:00', '11:38:00', '2024-08-06 19:39:10', '2024-08-11 10:29:16', '50', 'Disetujui', NULL, 'https://forms.gle/Tyy2VTXN9XmQ2mC89', '2', 'Kegiatan Tidak Disetujui'),
(50, 'Kusmala', 'Rapat Tahunan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-12', '13:04:00', '14:04:00', '2024-08-11 10:05:11', '2024-08-11 10:46:13', '100', 'Tidak Disetujui', NULL, 'g.co', '2', 'tidak'),
(51, 'laa', 'Rapat', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-15', '15:00:00', '16:00:00', '2024-08-11 10:21:00', '2024-08-11 10:48:45', '20', 'Tidak Disetujui', NULL, 'https://forms.gle/g71pWzSirr73MHKJ7', '4', 'Penuh'),
(52, 'laa', 'Rapat', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-15', '11:00:00', '13:00:00', '2024-08-11 10:24:04', '2024-08-11 10:44:42', '10', 'Tidak Disetujui', NULL, 'https://forms.gle/g71pWzSirr73MHKJ7', '4', 'suka2 gue'),
(53, 'laa', 'Rapat Mingguan', 5, 'Ruang Pelatihan TIK', 'Aplikasi informatika', '2024-08-20', '10:00:00', '12:00:00', '2024-08-11 10:43:02', '2024-08-11 10:43:02', '30', 'Menunggu Konfirmasi', 'menambah kursi 10', 'p', '4', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `eventsbackup`
--

CREATE TABLE `eventsbackup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `acara` longtext NOT NULL,
  `id_rooms` bigint(20) UNSIGNED NOT NULL,
  `nama_rooms` varchar(255) NOT NULL,
  `asalbidang` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `peserta` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'Menunggu Konfirmasi',
  `catatan` varchar(255) DEFAULT NULL,
  `presensi` varchar(255) DEFAULT NULL,
  `id_user` varchar(255) DEFAULT NULL,
  `rejection_note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `eventsbackup`
--

INSERT INTO `eventsbackup` (`id`, `nama`, `acara`, `id_rooms`, `nama_rooms`, `asalbidang`, `date`, `start`, `finish`, `created_at`, `updated_at`, `peserta`, `status`, `catatan`, `presensi`, `id_user`, `rejection_note`) VALUES
(21, 'Gerson Manuel Sugianto', 'Rapat Tahunan', 6, 'Ruang Aula', 'Aplikasi informatika', '2024-07-17', '07:04:00', '11:04:00', '2024-07-15 11:04:24', '2024-07-15 11:04:24', '20', NULL, NULL, NULL, NULL, NULL),
(22, 'Irma Monika', 'Rapat Tahunan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-08', '08:00:00', '10:00:00', '2024-08-05 10:52:44', '2024-08-05 10:52:44', '200', 'Menunggu Konfirmasi', NULL, NULL, NULL, NULL),
(23, 'Gerson Manuel Sugianto', 'Rapat Tahunan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-10', '21:51:00', '22:51:00', '2024-08-06 07:54:57', '2024-08-06 07:54:57', '100', 'Menunggu Konfirmasi', NULL, NULL, NULL, NULL),
(24, 'Eduardus Gerry Henry', 'Rapat Tahunan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-31', '21:58:00', '22:58:00', '2024-08-06 07:58:18', '2024-08-06 07:58:18', '100', 'Menunggu Konfirmasi', NULL, NULL, NULL, NULL),
(25, 'Eduardus Gerry Henry', 'Rapat Bulanan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-29', '22:00:00', '23:00:00', '2024-08-06 08:00:23', '2024-08-06 08:00:23', '100', 'Menunggu Konfirmasi', NULL, NULL, NULL, NULL),
(26, 'Eduardus Gerry Henry', 'Rapat Mingguan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-28', '13:08:00', '15:08:00', '2024-08-06 08:08:55', '2024-08-06 08:08:55', '100', 'Menunggu Konfirmasi', NULL, NULL, NULL, NULL),
(27, 'Gerson Manuel Sugianto', 'Rapat Tahunan', 6, 'Ruang Aula', 'Informasi dan Komunikasi Publik', '2024-08-31', '22:24:00', '23:24:00', '2024-08-06 08:24:19', '2024-08-06 08:24:19', '100', 'Menunggu Konfirmasi', NULL, NULL, NULL, NULL),
(28, 'Eduardus Gerry Henry', 'Rapat Tahunan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-22', '19:21:00', '23:21:00', '2024-08-06 09:22:07', '2024-08-06 09:22:07', '100', 'Menunggu Konfirmasi', NULL, 'https://forms.gle/Tyy2VTXN9XmQ2mC89', NULL, NULL),
(29, 'Kusmala Admin', 'Rapat Tahunan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-08', '00:00:00', '01:04:00', '2024-08-06 09:59:31', '2024-08-06 09:59:31', '100', 'Menunggu Konfirmasi', NULL, 'https://forms.gle/Tyy2VTXN9XmQ2mC89', NULL, NULL),
(30, 'Kusmala Admin', 'Rapat Mingguan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-10', '00:29:00', '14:29:00', '2024-08-06 10:29:43', '2024-08-06 10:29:43', '100', 'Menunggu Konfirmasi', NULL, 'https://forms.gle/Tyy2VTXN9XmQ2mC89', NULL, NULL),
(31, 'Kusmala user', 'Rapat Tahunan', 6, 'Ruang Aula', 'Aplikasi informatika', '2024-08-17', '20:30:00', '21:30:00', '2024-08-06 10:33:18', '2024-08-06 10:33:18', '20', 'Menunggu Konfirmasi', NULL, 'https://forms.gle/Tyy2VTXN9XmQ2mC89', NULL, NULL),
(32, 'Kusmala', 'Rapat Bulanan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-31', '03:04:00', '05:04:00', '2024-08-06 11:04:33', '2024-08-06 11:04:33', '10', 'Menunggu Konfirmasi', NULL, 'https://forms.gle/Tyy2VTXN9XmQ2mC89', '2', NULL),
(33, 'Kusmala', 'Rapat Bulanan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-10', '02:17:00', '06:17:00', '2024-08-06 11:17:22', '2024-08-06 11:17:22', '10', 'Menunggu Konfirmasi', NULL, 'https://forms.gle/Tyy2VTXN9XmQ2mC89', '2', NULL),
(34, 'Kusmala', 'Rapat Tahunan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-08', '01:52:00', '03:52:00', '2024-08-06 11:52:55', '2024-08-06 11:52:55', '10', 'Menunggu Konfirmasi', NULL, 'https://forms.gle/Tyy2VTXN9XmQ2mC89', '2', NULL),
(35, 'Kusmala', 'Rapat Bulanan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-07', '05:53:00', '07:54:00', '2024-08-06 11:54:10', '2024-08-06 11:54:10', '20', 'Menunggu Konfirmasi', NULL, 'https://forms.gle/Tyy2VTXN9XmQ2mC89', '2', NULL),
(36, 'Kusmala', 'Rapat Tahunan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-07', '09:38:00', '11:38:00', '2024-08-06 19:39:10', '2024-08-06 19:39:10', '100', 'Menunggu Konfirmasi', NULL, 'https://forms.gle/Tyy2VTXN9XmQ2mC89', '2', NULL),
(37, 'Kusmala', 'Rapat Tahunan', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-12', '13:04:00', '14:04:00', '2024-08-11 10:05:11', '2024-08-11 10:05:11', '100', 'Menunggu Konfirmasi', NULL, 'g.co', '2', NULL),
(38, 'laa', 'Rapat', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-15', '11:00:00', '13:00:00', '2024-08-11 10:21:00', '2024-08-11 10:21:00', '20', 'Menunggu Konfirmasi', NULL, 'p', '4', NULL),
(39, 'laa', 'Rapat', 5, 'Ruang Pelatihan TIK', 'Informasi dan Komunikasi Publik', '2024-08-15', '11:00:00', '13:00:00', '2024-08-11 10:24:04', '2024-08-11 10:24:04', '10', 'Menunggu Konfirmasi', NULL, 'https://forms.gle/g71pWzSirr73MHKJ7', '4', NULL),
(40, 'laa', 'Rapat Mingguan', 5, 'Ruang Pelatihan TIK', 'Aplikasi informatika', '2024-08-20', '10:00:00', '12:00:00', '2024-08-11 10:43:02', '2024-08-11 10:43:02', '30', 'Menunggu Konfirmasi', 'menambah kursi 10', 'p', '4', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_05_25_214841_create_room_table', 1),
(5, '2024_05_25_214904_create_event_table', 1),
(6, '2024_05_25_223259_add_date_to_events_table', 2),
(7, '2024_07_01_083359_eventbackup', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ruang` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `status` enum('Tersedia','Tidak Tersedia') NOT NULL DEFAULT 'Tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rooms`
--

INSERT INTO `rooms` (`id`, `nama_ruang`, `image`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Ruang Pelatihan TIK', 'images/gdJUjEFpVselnKYIpOvaoceRl2OIiXLhuyjLpmat.png', 'Ini Ruang Pelatihan TIK', 'Tersedia', '2024-07-15 10:52:36', '2024-08-05 11:09:32'),
(6, 'Ruang Aula', 'images/MnliscF7KOoodBCTSdHmILQaGPbxP8uNyjl1rOdj.png', 'ini ruang aula', 'Tersedia', '2024-07-15 10:53:14', '2024-08-06 11:16:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('C4SX8q6nUCO4SAltQZqw12W3DfTB0J5z4GveTPP5', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHJCNG5zYVB4dk13V0EwaHZxcDE5VDJZR040YTlPWGpIZTBESEJveiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1721074198);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'kusmalaadmin@kominfo.com', 'admin', NULL, '$2y$12$FnGuWFCWxZ7BYD3fK.DK8ex1n0he6NULZHIN2.ylzerEdDz6X4Zf.', 'qrFUNX1HNerkQloqT7foejkM7QJ5xIueWvxeMTDkXSY2MDxOtRL7hASnKtT0', '2024-05-25 15:15:04', '2024-08-06 22:38:13'),
(2, 'Kusmala', 'kusmalauser@kominfo.com', 'user', NULL, '$2y$12$Ca8t8iHIRYMkvyx1NGaPQ.Mh66DRe37Q7TsU20enM21shl186qcYq', NULL, '2024-05-25 15:15:05', '2024-08-06 10:59:27'),
(3, 'Admin User', 'admin@xample.com', 'admin', NULL, '$2y$12$PIstkHdQVPkEafKlV4yBbe4xEjeQXNUFTlSEJT1HWPywqL82ese/a', NULL, '2024-07-12 22:41:36', '2024-07-12 22:41:36'),
(4, 'laa', 'laa@gmail.com', 'user', NULL, '$2y$12$wk9rxl7Qh2lsZKGxihlRU.XWmARYCNxa9AoBCTDENqGl.TEXbwRra', NULL, '2024-08-11 10:19:20', '2024-08-11 10:19:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `eventsbackup`
--
ALTER TABLE `eventsbackup`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `eventsbackup`
--
ALTER TABLE `eventsbackup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
