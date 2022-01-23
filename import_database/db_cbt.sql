-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2020 at 06:08 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_pengerjaans`
--

CREATE TABLE `history_pengerjaans` (
  `id_his` bigint(20) UNSIGNED NOT NULL,
  `kd_mapel` bigint(20) UNSIGNED NOT NULL,
  `kd_soal` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `your_answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `betul_or_tidak` tinyint(1) NOT NULL,
  `yakin_or_not` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `nm_kelas` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mapels`
--

CREATE TABLE `mapels` (
  `kd_mapel` bigint(20) UNSIGNED NOT NULL,
  `nm_mapel` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `date_ujian` date DEFAULT NULL,
  `time_start` time DEFAULT '00:00:00',
  `lama_ujian` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(61, '2014_10_12_000000_create_users_table', 1),
(62, '2014_10_12_100000_create_password_resets_table', 1),
(63, '2019_08_19_000000_create_failed_jobs_table', 1),
(64, '2020_02_09_001858_create_proktors_table', 1),
(65, '2020_02_09_001925_create_kelas_table', 1),
(66, '2020_02_09_001943_create_siswas_table', 1),
(67, '2020_02_09_002008_create_mapels_table', 1),
(68, '2020_02_09_002151_create_start_ujians_table', 1),
(69, '2020_02_09_002345_create_soals_table', 1),
(70, '2020_02_09_002346_create_history_pengerjaans_table', 1),
(71, '2020_02_09_002419_create_nilais_table', 1),
(72, '2020_02_14_162644_create_soal_temps_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilais`
--

CREATE TABLE `nilais` (
  `id_nilai` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `kd_mapel` bigint(20) UNSIGNED NOT NULL,
  `jumlah_jawaban_benar` int(11) NOT NULL,
  `jumlah_jawaban_salah` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_akhir` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proktors`
--

CREATE TABLE `proktors` (
  `id_proktor` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proktors`
--

INSERT INTO `proktors` (`id_proktor`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soals`
--

CREATE TABLE `soals` (
  `kd_soal` bigint(20) UNSIGNED NOT NULL,
  `soal` longtext COLLATE utf8mb4_unicode_ci,
  `soal_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_1` mediumtext COLLATE utf8mb4_unicode_ci,
  `option_2` mediumtext COLLATE utf8mb4_unicode_ci,
  `option_3` mediumtext COLLATE utf8mb4_unicode_ci,
  `option_4` mediumtext COLLATE utf8mb4_unicode_ci,
  `option_5` mediumtext COLLATE utf8mb4_unicode_ci,
  `right_answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `skor` double NOT NULL,
  `kd_mapel` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soal_temps`
--

CREATE TABLE `soal_temps` (
  `kd_soaltemp` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `kd_mapel` bigint(20) UNSIGNED NOT NULL,
  `kd_soal` bigint(20) UNSIGNED NOT NULL,
  `nomor_soal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `start_ujians`
--

CREATE TABLE `start_ujians` (
  `id_start` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `kd_mapel` bigint(20) UNSIGNED NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_pengerjaans`
--
ALTER TABLE `history_pengerjaans`
  ADD PRIMARY KEY (`id_his`),
  ADD KEY `history_pengerjaans_kd_mapel_foreign` (`kd_mapel`),
  ADD KEY `history_pengerjaans_id_siswa_foreign` (`id_siswa`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mapels`
--
ALTER TABLE `mapels`
  ADD PRIMARY KEY (`kd_mapel`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilais`
--
ALTER TABLE `nilais`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `nilais_kd_mapel_foreign` (`kd_mapel`),
  ADD KEY `nilais_id_siswa_foreign` (`id_siswa`);

--
-- Indexes for table `proktors`
--
ALTER TABLE `proktors`
  ADD PRIMARY KEY (`id_proktor`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `siswas_id_kelas_foreign` (`id_kelas`);

--
-- Indexes for table `soals`
--
ALTER TABLE `soals`
  ADD PRIMARY KEY (`kd_soal`),
  ADD KEY `soals_kd_mapel_foreign` (`kd_mapel`),
  ADD KEY `soals_id_kelas_foreign` (`id_kelas`);

--
-- Indexes for table `soal_temps`
--
ALTER TABLE `soal_temps`
  ADD PRIMARY KEY (`kd_soaltemp`),
  ADD KEY `soal_temps_kd_mapel_foreign` (`kd_mapel`),
  ADD KEY `soal_temps_id_siswa_foreign` (`id_siswa`),
  ADD KEY `soal_temps_kd_soal_foreign` (`kd_soal`);

--
-- Indexes for table `start_ujians`
--
ALTER TABLE `start_ujians`
  ADD PRIMARY KEY (`id_start`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_pengerjaans`
--
ALTER TABLE `history_pengerjaans`
  MODIFY `id_his` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mapels`
--
ALTER TABLE `mapels`
  MODIFY `kd_mapel` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `nilais`
--
ALTER TABLE `nilais`
  MODIFY `id_nilai` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proktors`
--
ALTER TABLE `proktors`
  MODIFY `id_proktor` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id_siswa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soals`
--
ALTER TABLE `soals`
  MODIFY `kd_soal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal_temps`
--
ALTER TABLE `soal_temps`
  MODIFY `kd_soaltemp` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `start_ujians`
--
ALTER TABLE `start_ujians`
  MODIFY `id_start` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history_pengerjaans`
--
ALTER TABLE `history_pengerjaans`
  ADD CONSTRAINT `history_pengerjaans_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswas` (`id_siswa`) ON DELETE NO ACTION,
  ADD CONSTRAINT `history_pengerjaans_kd_mapel_foreign` FOREIGN KEY (`kd_mapel`) REFERENCES `soals` (`kd_mapel`) ON DELETE NO ACTION;

--
-- Constraints for table `nilais`
--
ALTER TABLE `nilais`
  ADD CONSTRAINT `nilais_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswas` (`id_siswa`) ON DELETE NO ACTION,
  ADD CONSTRAINT `nilais_kd_mapel_foreign` FOREIGN KEY (`kd_mapel`) REFERENCES `mapels` (`kd_mapel`) ON DELETE NO ACTION;

--
-- Constraints for table `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE NO ACTION;

--
-- Constraints for table `soals`
--
ALTER TABLE `soals`
  ADD CONSTRAINT `soals_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE NO ACTION,
  ADD CONSTRAINT `soals_kd_mapel_foreign` FOREIGN KEY (`kd_mapel`) REFERENCES `mapels` (`kd_mapel`) ON DELETE NO ACTION;

--
-- Constraints for table `soal_temps`
--
ALTER TABLE `soal_temps`
  ADD CONSTRAINT `soal_temps_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswas` (`id_siswa`) ON DELETE NO ACTION,
  ADD CONSTRAINT `soal_temps_kd_mapel_foreign` FOREIGN KEY (`kd_mapel`) REFERENCES `mapels` (`kd_mapel`) ON DELETE NO ACTION,
  ADD CONSTRAINT `soal_temps_kd_soal_foreign` FOREIGN KEY (`kd_soal`) REFERENCES `soals` (`kd_soal`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
