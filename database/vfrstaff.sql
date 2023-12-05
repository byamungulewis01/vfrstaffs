-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 06:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vfrstaff`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"BYAMUNGU Lewis\",\"username\":\"lewis\"},\"old\":{\"name\":\"BYAMUNGU Lewis\",\"username\":\"lewis\"}}', NULL, '2023-11-19 16:32:22', '2023-11-19 16:32:22'),
(2, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"BYAMUNGU Lewis\",\"username\":\"lewis\"},\"old\":{\"name\":\"BYAMUNGU Lewis\",\"username\":\"lewis\"}}', NULL, '2023-11-19 16:32:26', '2023-11-19 16:32:26'),
(3, 'default', 'created', 'App\\Models\\User', 'created', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Chantal HABIMANA\",\"username\":\"chantal\"}}', NULL, '2023-11-19 16:33:13', '2023-11-19 16:33:13'),
(4, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"Ntwari Lebon 02\",\"username\":\"lebon\"},\"old\":{\"name\":\"Ntwari Lebon\",\"username\":\"lebon\"}}', NULL, '2023-11-19 16:34:21', '2023-11-19 16:34:21'),
(5, 'default', 'created', 'App\\Models\\Department', 'created', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":7,\"name\":\"TEST ONE\",\"created_at\":\"2023-11-19T18:39:58.000000Z\",\"updated_at\":\"2023-11-19T18:39:58.000000Z\"}}', NULL, '2023-11-19 16:39:58', '2023-11-19 16:39:58'),
(6, 'default', 'deleted', 'App\\Models\\Department', 'deleted', 7, 'App\\Models\\User', 1, '{\"old\":{\"id\":7,\"name\":\"TEST ONE\",\"created_at\":\"2023-11-19T18:39:58.000000Z\",\"updated_at\":\"2023-11-19T18:39:58.000000Z\"}}', NULL, '2023-11-19 16:40:49', '2023-11-19 16:40:49'),
(7, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$Evu9R2J.L8XJYxYoME1HNOFZ3aWmVYU\\/ocYXdR9zWY78b0gPA9Una\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T18:41:25.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$bBEVBAvMal42\\/pGqdQtqLuoxJgYh20XelkDiChemwrMBYYtpSBnay\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T18:34:21.000000Z\"}}', NULL, '2023-11-19 16:41:25', '2023-11-19 16:41:25'),
(8, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$u5meFA58CpOBLv0s\\/NNlU.8CtspkKX40Ia5pvdEy8Tw2o9.OVX0TK\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T18:41:34.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$Evu9R2J.L8XJYxYoME1HNOFZ3aWmVYU\\/ocYXdR9zWY78b0gPA9Una\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T18:41:25.000000Z\"}}', NULL, '2023-11-19 16:41:34', '2023-11-19 16:41:34'),
(9, 'default', 'created', 'App\\Models\\Department', 'created', 8, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":8,\"name\":\"LEBON TEST\",\"created_at\":\"2023-11-19T18:41:50.000000Z\",\"updated_at\":\"2023-11-19T18:41:50.000000Z\"}}', NULL, '2023-11-19 16:41:50', '2023-11-19 16:41:50'),
(10, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$b\\/RKS2HPgzGg6w9OJxnSd.BehfTGoRdUaFU4vBN05GdWhssTK4M5.\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:04:54.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$.FfewG83qvMdJzCGHK66DuIRvdN1L4M7aW9EmtL4UglXGt6ZYgf2.\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T18:32:26.000000Z\"}}', NULL, '2023-11-19 18:04:54', '2023-11-19 18:04:54'),
(11, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$95iKAT06QLfGBDyYPYPKcu42ZFKO1P2xj8q7bmN2XDQMT0FVCPIeW\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:05:28.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$b\\/RKS2HPgzGg6w9OJxnSd.BehfTGoRdUaFU4vBN05GdWhssTK4M5.\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:04:54.000000Z\"}}', NULL, '2023-11-19 18:05:28', '2023-11-19 18:05:28'),
(12, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$dbjn.9YPPRxh4IK\\/mPlAfOhAlhWy6Mob3ghr7y0JSWcyu6CpRNLhq\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:05:37.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$95iKAT06QLfGBDyYPYPKcu42ZFKO1P2xj8q7bmN2XDQMT0FVCPIeW\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:05:28.000000Z\"}}', NULL, '2023-11-19 18:05:37', '2023-11-19 18:05:37'),
(13, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$X7o8RgNPJFZUWYuG2HFAk.AZG97CCnKFUYyTNVhbWPF6m5S0MKKqO\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:10:01.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$dbjn.9YPPRxh4IK\\/mPlAfOhAlhWy6Mob3ghr7y0JSWcyu6CpRNLhq\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:05:37.000000Z\"}}', NULL, '2023-11-19 18:10:01', '2023-11-19 18:10:01'),
(14, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$8rXP0bVZi2JrEV5\\/Hnb4SOszUj9E46nnAK\\/yhhOxm5DF7H75zT57q\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:10:10.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$X7o8RgNPJFZUWYuG2HFAk.AZG97CCnKFUYyTNVhbWPF6m5S0MKKqO\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:10:01.000000Z\"}}', NULL, '2023-11-19 18:10:10', '2023-11-19 18:10:10'),
(15, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$JPm2qsVWxILGw62hUTxMceyB8CzaZP3dm.VljeUmf3XUMdactViKm\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:10:35.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$8rXP0bVZi2JrEV5\\/Hnb4SOszUj9E46nnAK\\/yhhOxm5DF7H75zT57q\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:10:10.000000Z\"}}', NULL, '2023-11-19 18:10:35', '2023-11-19 18:10:35'),
(16, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$x6KT19PlJiPuBmkp8Jd.feskW4Vudum32FFUqiR\\/31Kt7BG.D9jG.\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:11:01.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$JPm2qsVWxILGw62hUTxMceyB8CzaZP3dm.VljeUmf3XUMdactViKm\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:10:35.000000Z\"}}', NULL, '2023-11-19 18:11:01', '2023-11-19 18:11:01'),
(17, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$\\/EvHoyJGVUyBpZ.nJ.Zd1umhfByhr383dMHmtu5SpB3NHhHmFMs0y\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-20T15:17:31.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$x6KT19PlJiPuBmkp8Jd.feskW4Vudum32FFUqiR\\/31Kt7BG.D9jG.\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T20:11:01.000000Z\"}}', NULL, '2023-11-20 13:17:31', '2023-11-20 13:17:31'),
(18, 'default', 'updated', 'App\\Models\\User', 'updated', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":4,\"name\":\"Chantal HABIMANA\",\"regnumber\":\"VFC004\",\"username\":\"chantal\",\"phone\":\"0784432244\",\"email_verified_at\":null,\"password\":\"$2y$10$RpE4TlfwzNUVKBs102b1GOhlfzqCVuYGp2HDDbxBk5m\\/bU9vlMkXK\",\"savings\":2000,\"role\":\"1\",\"status\":\"0\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-19T18:33:13.000000Z\",\"updated_at\":\"2023-11-20T15:38:36.000000Z\"},\"old\":{\"id\":4,\"name\":\"Chantal HABIMANA\",\"regnumber\":\"VFC004\",\"username\":\"chantal\",\"phone\":\"0784432244\",\"email_verified_at\":null,\"password\":\"$2y$10$RpE4TlfwzNUVKBs102b1GOhlfzqCVuYGp2HDDbxBk5m\\/bU9vlMkXK\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-19T18:33:13.000000Z\",\"updated_at\":\"2023-11-19T18:33:13.000000Z\"}}', NULL, '2023-11-20 13:38:36', '2023-11-20 13:38:36'),
(19, 'default', 'created', 'App\\Models\\User', 'created', 5, NULL, NULL, '{\"attributes\":{\"id\":5,\"name\":\"Micheal Gislason\",\"regnumber\":\"VFC005\",\"username\":\"mreichel\",\"phone\":\"+1-551-485-9327\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":50000,\"role\":\"1\",\"status\":\"1\",\"department_id\":4,\"remember_token\":null,\"created_at\":\"2023-11-20T20:37:33.000000Z\",\"updated_at\":\"2023-11-20T20:37:33.000000Z\"}}', NULL, '2023-11-20 18:37:33', '2023-11-20 18:37:33'),
(20, 'default', 'created', 'App\\Models\\User', 'created', 7, NULL, NULL, '{\"attributes\":{\"id\":7,\"name\":\"Carroll Kilback\",\"regnumber\":\"VFC006\",\"username\":\"xkonopelski\",\"phone\":\"478.662.1700\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":20000,\"role\":\"0\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-20T20:38:31.000000Z\",\"updated_at\":\"2023-11-20T20:38:31.000000Z\"}}', NULL, '2023-11-20 18:38:31', '2023-11-20 18:38:31'),
(21, 'default', 'created', 'App\\Models\\User', 'created', 9, NULL, NULL, '{\"attributes\":{\"id\":9,\"name\":\"Jessy Bayer\",\"regnumber\":\"VFC007\",\"username\":\"elmo29\",\"phone\":\"213-750-9502\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":10000,\"role\":\"1\",\"status\":\"1\",\"department_id\":4,\"remember_token\":null,\"created_at\":\"2023-11-20T20:40:46.000000Z\",\"updated_at\":\"2023-11-20T20:40:46.000000Z\"}}', NULL, '2023-11-20 18:40:46', '2023-11-20 18:40:46'),
(22, 'default', 'created', 'App\\Models\\User', 'created', 11, NULL, NULL, '{\"attributes\":{\"id\":11,\"name\":\"Emerald Denesik\",\"regnumber\":\"VFC008\",\"username\":\"ryann.lebsack\",\"phone\":\"+1 (661) 725-5550\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":50000,\"role\":\"0\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-20T20:40:53.000000Z\",\"updated_at\":\"2023-11-20T20:40:53.000000Z\"}}', NULL, '2023-11-20 18:40:53', '2023-11-20 18:40:53'),
(23, 'default', 'created', 'App\\Models\\User', 'created', 13, NULL, NULL, '{\"attributes\":{\"id\":13,\"name\":\"Mrs. Violette VonRueden Jr.\",\"regnumber\":\"VFC009\",\"username\":\"meggie38\",\"phone\":\"(650) 633-5234\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":10000,\"role\":\"0\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-20T20:40:57.000000Z\",\"updated_at\":\"2023-11-20T20:40:57.000000Z\"}}', NULL, '2023-11-20 18:40:57', '2023-11-20 18:40:57'),
(24, 'default', 'created', 'App\\Models\\User', 'created', 15, NULL, NULL, '{\"attributes\":{\"id\":15,\"name\":\"Ken Carter\",\"regnumber\":\"VFC010\",\"username\":\"bullrich\",\"phone\":\"(534) 557-3502\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":10000,\"role\":\"0\",\"status\":\"1\",\"department_id\":4,\"remember_token\":null,\"created_at\":\"2023-11-20T20:40:59.000000Z\",\"updated_at\":\"2023-11-20T20:40:59.000000Z\"}}', NULL, '2023-11-20 18:40:59', '2023-11-20 18:40:59'),
(25, 'default', 'created', 'App\\Models\\User', 'created', 17, NULL, NULL, '{\"attributes\":{\"id\":17,\"name\":\"Britney Waelchi\",\"regnumber\":\"VFC011\",\"username\":\"kmurphy\",\"phone\":\"620.936.3836\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":10000,\"role\":\"1\",\"status\":\"1\",\"department_id\":4,\"remember_token\":null,\"created_at\":\"2023-11-20T20:41:39.000000Z\",\"updated_at\":\"2023-11-20T20:41:39.000000Z\"}}', NULL, '2023-11-20 18:41:39', '2023-11-20 18:41:39'),
(26, 'default', 'created', 'App\\Models\\User', 'created', 19, NULL, NULL, '{\"attributes\":{\"id\":19,\"name\":\"Santina Wyman\",\"regnumber\":\"VFC012\",\"username\":\"tre.johnson\",\"phone\":\"1-678-283-2738\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":10000,\"role\":\"1\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-20T20:42:28.000000Z\",\"updated_at\":\"2023-11-20T20:42:28.000000Z\"}}', NULL, '2023-11-20 18:42:28', '2023-11-20 18:42:28'),
(27, 'default', 'created', 'App\\Models\\User', 'created', 21, NULL, NULL, '{\"attributes\":{\"id\":21,\"name\":\"Tania Frami\",\"regnumber\":\"VFC013\",\"username\":\"vonrueden.ryleigh\",\"phone\":\"1-307-555-2762\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":50000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-20T20:42:43.000000Z\",\"updated_at\":\"2023-11-20T20:42:43.000000Z\"}}', NULL, '2023-11-20 18:42:43', '2023-11-20 18:42:43'),
(28, 'default', 'created', 'App\\Models\\User', 'created', 23, NULL, NULL, '{\"attributes\":{\"id\":23,\"name\":\"Prof. Isabella Reynolds\",\"regnumber\":\"VFC014\",\"username\":\"mireya.mayert\",\"phone\":\"539-526-9492\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":30000,\"role\":\"0\",\"status\":\"1\",\"department_id\":4,\"remember_token\":null,\"created_at\":\"2023-11-20T20:42:46.000000Z\",\"updated_at\":\"2023-11-20T20:42:46.000000Z\"}}', NULL, '2023-11-20 18:42:46', '2023-11-20 18:42:46'),
(29, 'default', 'created', 'App\\Models\\User', 'created', 25, NULL, NULL, '{\"attributes\":{\"id\":25,\"name\":\"Mrs. Daija Dach IV\",\"regnumber\":\"VFC015\",\"username\":\"brianne68\",\"phone\":\"+1-484-482-3856\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":30000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-20T20:42:49.000000Z\",\"updated_at\":\"2023-11-20T20:42:49.000000Z\"}}', NULL, '2023-11-20 18:42:49', '2023-11-20 18:42:49'),
(30, 'default', 'created', 'App\\Models\\User', 'created', 27, NULL, NULL, '{\"attributes\":{\"id\":27,\"name\":\"Lafayette Treutel\",\"regnumber\":\"VFC016\",\"username\":\"sullrich\",\"phone\":\"+1-731-366-0126\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":50000,\"role\":\"0\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-20T20:42:53.000000Z\",\"updated_at\":\"2023-11-20T20:42:53.000000Z\"}}', NULL, '2023-11-20 18:42:53', '2023-11-20 18:42:53'),
(31, 'default', 'created', 'App\\Models\\User', 'created', 29, NULL, NULL, '{\"attributes\":{\"id\":29,\"name\":\"Einar Bruen\",\"regnumber\":\"VFC017\",\"username\":\"isidro76\",\"phone\":\"409.541.6228\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":50000,\"role\":\"0\",\"status\":\"1\",\"department_id\":4,\"remember_token\":null,\"created_at\":\"2023-11-20T20:42:57.000000Z\",\"updated_at\":\"2023-11-20T20:42:57.000000Z\"}}', NULL, '2023-11-20 18:42:57', '2023-11-20 18:42:57'),
(32, 'default', 'created', 'App\\Models\\User', 'created', 31, NULL, NULL, '{\"attributes\":{\"id\":31,\"name\":\"Prof. Robin Harris\",\"regnumber\":\"VFC018\",\"username\":\"axel.klein\",\"phone\":\"630-430-9743\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":30000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:16.000000Z\",\"updated_at\":\"2023-11-20T20:43:16.000000Z\"}}', NULL, '2023-11-20 18:43:16', '2023-11-20 18:43:16'),
(33, 'default', 'created', 'App\\Models\\User', 'created', 33, NULL, NULL, '{\"attributes\":{\"id\":33,\"name\":\"Prof. Shania Jones\",\"regnumber\":\"VFC019\",\"username\":\"hills.shanie\",\"phone\":\"+17019124506\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":40000,\"role\":\"0\",\"status\":\"1\",\"department_id\":5,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:18.000000Z\",\"updated_at\":\"2023-11-20T20:43:18.000000Z\"}}', NULL, '2023-11-20 18:43:18', '2023-11-20 18:43:18'),
(34, 'default', 'created', 'App\\Models\\User', 'created', 35, NULL, NULL, '{\"attributes\":{\"id\":35,\"name\":\"Dr. Emerson Carroll\",\"regnumber\":\"VFC020\",\"username\":\"bfeest\",\"phone\":\"(417) 910-1892\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":10000,\"role\":\"1\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:20.000000Z\",\"updated_at\":\"2023-11-20T20:43:20.000000Z\"}}', NULL, '2023-11-20 18:43:20', '2023-11-20 18:43:20'),
(35, 'default', 'created', 'App\\Models\\User', 'created', 37, NULL, NULL, '{\"attributes\":{\"id\":37,\"name\":\"Delfina Bahringer\",\"regnumber\":\"VFC021\",\"username\":\"mkeebler\",\"phone\":\"+1-937-257-3485\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":30000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:21.000000Z\",\"updated_at\":\"2023-11-20T20:43:21.000000Z\"}}', NULL, '2023-11-20 18:43:21', '2023-11-20 18:43:21'),
(36, 'default', 'created', 'App\\Models\\User', 'created', 39, NULL, NULL, '{\"attributes\":{\"id\":39,\"name\":\"Imogene Keeling V\",\"regnumber\":\"VFC022\",\"username\":\"rmarks\",\"phone\":\"1-361-263-0609\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":30000,\"role\":\"1\",\"status\":\"1\",\"department_id\":4,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:22.000000Z\",\"updated_at\":\"2023-11-20T20:43:22.000000Z\"}}', NULL, '2023-11-20 18:43:22', '2023-11-20 18:43:22'),
(37, 'default', 'created', 'App\\Models\\User', 'created', 41, NULL, NULL, '{\"attributes\":{\"id\":41,\"name\":\"Prof. Joan Hansen\",\"regnumber\":\"VFC023\",\"username\":\"jlesch\",\"phone\":\"+1 (870) 252-2702\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":30000,\"role\":\"0\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:24.000000Z\",\"updated_at\":\"2023-11-20T20:43:24.000000Z\"}}', NULL, '2023-11-20 18:43:24', '2023-11-20 18:43:24'),
(38, 'default', 'created', 'App\\Models\\User', 'created', 43, NULL, NULL, '{\"attributes\":{\"id\":43,\"name\":\"Lily Schowalter\",\"regnumber\":\"VFC024\",\"username\":\"cjaskolski\",\"phone\":\"+1-689-204-7515\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":10000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:25.000000Z\",\"updated_at\":\"2023-11-20T20:43:25.000000Z\"}}', NULL, '2023-11-20 18:43:25', '2023-11-20 18:43:25'),
(39, 'default', 'created', 'App\\Models\\User', 'created', 45, NULL, NULL, '{\"attributes\":{\"id\":45,\"name\":\"Alexandrine Kohler\",\"regnumber\":\"VFC025\",\"username\":\"nasir.vonrueden\",\"phone\":\"409.536.9076\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":40000,\"role\":\"1\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:26.000000Z\",\"updated_at\":\"2023-11-20T20:43:26.000000Z\"}}', NULL, '2023-11-20 18:43:26', '2023-11-20 18:43:26'),
(40, 'default', 'created', 'App\\Models\\User', 'created', 47, NULL, NULL, '{\"attributes\":{\"id\":47,\"name\":\"Dr. Oleta Conroy III\",\"regnumber\":\"VFC026\",\"username\":\"jaylan.pollich\",\"phone\":\"1-980-346-5978\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":20000,\"role\":\"1\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:27.000000Z\",\"updated_at\":\"2023-11-20T20:43:27.000000Z\"}}', NULL, '2023-11-20 18:43:27', '2023-11-20 18:43:27'),
(41, 'default', 'created', 'App\\Models\\User', 'created', 49, NULL, NULL, '{\"attributes\":{\"id\":49,\"name\":\"Angeline Buckridge\",\"regnumber\":\"VFC027\",\"username\":\"ihickle\",\"phone\":\"+1-380-500-6843\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":40000,\"role\":\"1\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:38.000000Z\",\"updated_at\":\"2023-11-20T20:43:38.000000Z\"}}', NULL, '2023-11-20 18:43:38', '2023-11-20 18:43:38'),
(42, 'default', 'created', 'App\\Models\\User', 'created', 51, NULL, NULL, '{\"attributes\":{\"id\":51,\"name\":\"Ramiro Olson I\",\"regnumber\":\"VFC028\",\"username\":\"omacejkovic\",\"phone\":\"818.678.0354\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":30000,\"role\":\"1\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:40.000000Z\",\"updated_at\":\"2023-11-20T20:43:40.000000Z\"}}', NULL, '2023-11-20 18:43:40', '2023-11-20 18:43:40'),
(43, 'default', 'created', 'App\\Models\\User', 'created', 53, NULL, NULL, '{\"attributes\":{\"id\":53,\"name\":\"Gabriella Herman\",\"regnumber\":\"VFC029\",\"username\":\"sylvia91\",\"phone\":\"1-419-853-9884\",\"email_verified_at\":null,\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"savings\":20000,\"role\":\"1\",\"status\":\"1\",\"department_id\":4,\"remember_token\":null,\"created_at\":\"2023-11-20T20:43:42.000000Z\",\"updated_at\":\"2023-11-20T20:43:42.000000Z\"}}', NULL, '2023-11-20 18:43:42', '2023-11-20 18:43:42'),
(44, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$qgtcHKsThQ7viBqtZeeMBuloS4pfnZ3LVjni4UUYpe4uJy1Y133FS\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T04:07:48.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$\\/EvHoyJGVUyBpZ.nJ.Zd1umhfByhr383dMHmtu5SpB3NHhHmFMs0y\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-20T15:17:31.000000Z\"}}', NULL, '2023-11-21 02:07:49', '2023-11-21 02:07:49'),
(45, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$vEJ2YNKR\\/s5WVUgH1wB0gOzNmAzaT9qnljShSCAqoMs.I\\/YmmzrIy\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T07:25:29.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$qgtcHKsThQ7viBqtZeeMBuloS4pfnZ3LVjni4UUYpe4uJy1Y133FS\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T04:07:48.000000Z\"}}', NULL, '2023-11-21 05:25:29', '2023-11-21 05:25:29'),
(46, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$0ujHxS8KgOTGERQe0uI7BODLq.IYfjnvVH51nNIqdkNfutahfgVJ2\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T13:58:39.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$vEJ2YNKR\\/s5WVUgH1wB0gOzNmAzaT9qnljShSCAqoMs.I\\/YmmzrIy\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T07:25:29.000000Z\"}}', NULL, '2023-11-21 11:58:39', '2023-11-21 11:58:39'),
(47, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$.pI6BRc3XeWHA7dBlT.CUOGG0mhcYdIfpXh3gfJTpzjIbY25kZJQO\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T16:41:46.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$0ujHxS8KgOTGERQe0uI7BODLq.IYfjnvVH51nNIqdkNfutahfgVJ2\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T13:58:39.000000Z\"}}', NULL, '2023-11-21 14:41:46', '2023-11-21 14:41:46'),
(48, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$eiEFJgp7zrCtme.NqD28oOlH\\/HCg1WQCG6hwIm2lzvlUlmmDpMzti\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T20:29:33.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$.pI6BRc3XeWHA7dBlT.CUOGG0mhcYdIfpXh3gfJTpzjIbY25kZJQO\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T16:41:46.000000Z\"}}', NULL, '2023-11-21 18:29:33', '2023-11-21 18:29:33'),
(49, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$mLQ\\/ul\\/Ygo7n93iERAtQ1eWvnRHVsT0kQoG2RyaXbUkkm.NPzfE4e\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T20:29:41.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$eiEFJgp7zrCtme.NqD28oOlH\\/HCg1WQCG6hwIm2lzvlUlmmDpMzti\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T20:29:33.000000Z\"}}', NULL, '2023-11-21 18:29:41', '2023-11-21 18:29:41'),
(50, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$DH.pFXSUBdLlTvQMOIBeeuBgB6aC8WEMOk8ogFLMvpFogC8IhTXA.\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-22T04:30:41.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$mLQ\\/ul\\/Ygo7n93iERAtQ1eWvnRHVsT0kQoG2RyaXbUkkm.NPzfE4e\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-21T20:29:41.000000Z\"}}', NULL, '2023-11-22 02:30:41', '2023-11-22 02:30:41'),
(51, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$PiKmQoCAc6.99YvlRxPSEOUbCQFsJgyM8rXsQt.RoAPuVJqUihGmK\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-22T17:01:04.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$DH.pFXSUBdLlTvQMOIBeeuBgB6aC8WEMOk8ogFLMvpFogC8IhTXA.\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-22T04:30:41.000000Z\"}}', NULL, '2023-11-22 15:01:04', '2023-11-22 15:01:04'),
(52, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$\\/RB0dgKtulgy80hRs8Um3.JuwbvGS7YRAlu7yJDA16ruHOxjRf9h2\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-22T20:52:12.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$PiKmQoCAc6.99YvlRxPSEOUbCQFsJgyM8rXsQt.RoAPuVJqUihGmK\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-22T17:01:04.000000Z\"}}', NULL, '2023-11-22 18:52:13', '2023-11-22 18:52:13'),
(53, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$w8iZ4c.nCQtTYaJzeJlZ2O7cCr5\\/vJ7jQxubM9CyHUZSSDEQeTI5S\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T07:12:34.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$\\/RB0dgKtulgy80hRs8Um3.JuwbvGS7YRAlu7yJDA16ruHOxjRf9h2\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-22T20:52:12.000000Z\"}}', NULL, '2023-11-23 05:12:34', '2023-11-23 05:12:34'),
(54, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$ehlcZrfUzA3x4NAS32LkreFVC43RYrb4bdy7XtQnf5NBL3p.X7hxq\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T09:27:38.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$u5meFA58CpOBLv0s\\/NNlU.8CtspkKX40Ia5pvdEy8Tw2o9.OVX0TK\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-19T18:41:34.000000Z\"}}', NULL, '2023-11-23 07:27:38', '2023-11-23 07:27:38'),
(55, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$hgWT.U0ofUk4HA.FhwsXg.cnac28p2C7Fp9PuBfdaUiq9VuLFVjw.\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T09:27:48.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$ehlcZrfUzA3x4NAS32LkreFVC43RYrb4bdy7XtQnf5NBL3p.X7hxq\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T09:27:38.000000Z\"}}', NULL, '2023-11-23 07:27:48', '2023-11-23 07:27:48'),
(56, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$bR8oB\\/u8sSDiZ5Ldyi48QO1m08eb2SGgEbtkEbAM09IgR3ZPIvUOm\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T12:41:05.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$hgWT.U0ofUk4HA.FhwsXg.cnac28p2C7Fp9PuBfdaUiq9VuLFVjw.\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T09:27:48.000000Z\"}}', NULL, '2023-11-23 10:41:05', '2023-11-23 10:41:05'),
(57, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$0uhea0SQv7FP\\/8NDoH2cEOYEwMQHNYeIlySwxEXyTdgLNYjR2tHs6\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T13:17:25.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$w8iZ4c.nCQtTYaJzeJlZ2O7cCr5\\/vJ7jQxubM9CyHUZSSDEQeTI5S\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T07:12:34.000000Z\"}}', NULL, '2023-11-23 11:17:25', '2023-11-23 11:17:25'),
(58, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$oaYATDQf93k9cuVKtJwO.OKd8vDOjTC4gRhsSjlBtKdV7Zjo23A3S\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T13:17:32.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$0uhea0SQv7FP\\/8NDoH2cEOYEwMQHNYeIlySwxEXyTdgLNYjR2tHs6\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T13:17:25.000000Z\"}}', NULL, '2023-11-23 11:17:32', '2023-11-23 11:17:32'),
(59, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$h6SoABLK1v\\/nvRXa7.87UuGMZ6cxJs3iK7FpX55DNYfQMnFNYLKa6\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T13:24:03.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$bR8oB\\/u8sSDiZ5Ldyi48QO1m08eb2SGgEbtkEbAM09IgR3ZPIvUOm\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T12:41:05.000000Z\"}}', NULL, '2023-11-23 11:24:03', '2023-11-23 11:24:03'),
(60, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$WeDWwxFIgwUmCrW4mIUMyONwifVs2\\/wDyqty2B2V68G9Pqki0Kdn6\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T13:24:19.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$h6SoABLK1v\\/nvRXa7.87UuGMZ6cxJs3iK7FpX55DNYfQMnFNYLKa6\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T13:24:03.000000Z\"}}', NULL, '2023-11-23 11:24:19', '2023-11-23 11:24:19'),
(61, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$9WV5PFEDU715oJmAUujWbOWTH8WuJ0D\\/2xUSxG8ojJj.9mhh8hJIm\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-25T05:02:43.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$oaYATDQf93k9cuVKtJwO.OKd8vDOjTC4gRhsSjlBtKdV7Zjo23A3S\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T13:17:32.000000Z\"}}', NULL, '2023-11-25 03:02:44', '2023-11-25 03:02:44'),
(62, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$gpSre7.Z6UAlN5L0sTA6R.UW0hg1A68Dc.LzZbu5elkZhD03JCGzm\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-25T14:42:52.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$9WV5PFEDU715oJmAUujWbOWTH8WuJ0D\\/2xUSxG8ojJj.9mhh8hJIm\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-25T05:02:43.000000Z\"}}', NULL, '2023-11-25 12:42:53', '2023-11-25 12:42:53'),
(63, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$zs4bPMh9ohqAiuIwVlS19uW0ULWLxb8u4ttnsb3R09bgxv\\/1ZEJIS\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-25T21:08:15.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$gpSre7.Z6UAlN5L0sTA6R.UW0hg1A68Dc.LzZbu5elkZhD03JCGzm\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-25T14:42:52.000000Z\"}}', NULL, '2023-11-25 19:08:15', '2023-11-25 19:08:15'),
(64, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$lKiD3OiTKik4LWewBbv7ce33ItGXLzGjIEug\\/X1Rn\\/evviRv4U4Fm\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-26T06:07:28.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$zs4bPMh9ohqAiuIwVlS19uW0ULWLxb8u4ttnsb3R09bgxv\\/1ZEJIS\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-25T21:08:15.000000Z\"}}', NULL, '2023-11-26 04:07:28', '2023-11-26 04:07:28'),
(65, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$mtCERa7vSIkwK9XhWhcmy.Op7vhR5PVrEwBcyCxiTFGaPc1obV2Q6\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-26T15:50:55.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$lKiD3OiTKik4LWewBbv7ce33ItGXLzGjIEug\\/X1Rn\\/evviRv4U4Fm\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-26T06:07:28.000000Z\"}}', NULL, '2023-11-26 13:50:55', '2023-11-26 13:50:55'),
(66, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$kuxKw5egg49PJ.ZO\\/\\/NmhOgMy9KglbRIZ7GMdMUZkxqQRub2QiYHC\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-26T16:09:48.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$WeDWwxFIgwUmCrW4mIUMyONwifVs2\\/wDyqty2B2V68G9Pqki0Kdn6\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-23T13:24:19.000000Z\"}}', NULL, '2023-11-26 14:09:48', '2023-11-26 14:09:48');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(67, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$OchyyMa2boejwhlga\\/vn5eOu3pqSqtXjuozXgM.SHhOFKJzc80vMK\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-26T16:09:56.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$kuxKw5egg49PJ.ZO\\/\\/NmhOgMy9KglbRIZ7GMdMUZkxqQRub2QiYHC\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-26T16:09:48.000000Z\"}}', NULL, '2023-11-26 14:09:56', '2023-11-26 14:09:56'),
(68, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$ygmeIVM6iSQMSpldbJLCO.mEjGp6hULZ50NAIu1bmDCU48JTR0R7q\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-26T16:10:36.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$mtCERa7vSIkwK9XhWhcmy.Op7vhR5PVrEwBcyCxiTFGaPc1obV2Q6\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-26T15:50:55.000000Z\"}}', NULL, '2023-11-26 14:10:36', '2023-11-26 14:10:36'),
(69, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$lmV1yALnxo2WDjH3d0txBuuRrfSdl7BcRekc014OOCvY572rllp.e\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-27T06:23:28.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$ygmeIVM6iSQMSpldbJLCO.mEjGp6hULZ50NAIu1bmDCU48JTR0R7q\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-26T16:10:36.000000Z\"}}', NULL, '2023-11-27 04:23:29', '2023-11-27 04:23:29'),
(70, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$\\/3a0\\/zeJFqhjBKEAIP9LWeIEbfhWKB3HnvHqQz.ffRANj8O89hdzS\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-27T08:40:09.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$OchyyMa2boejwhlga\\/vn5eOu3pqSqtXjuozXgM.SHhOFKJzc80vMK\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-26T16:09:56.000000Z\"}}', NULL, '2023-11-27 06:40:09', '2023-11-27 06:40:09'),
(71, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$gIcRfs1jkb25rGKasAyYe.UuzMRfvo40WF7RSEWIiIvnS0QLOhAVG\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-27T08:40:17.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$\\/3a0\\/zeJFqhjBKEAIP9LWeIEbfhWKB3HnvHqQz.ffRANj8O89hdzS\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-27T08:40:09.000000Z\"}}', NULL, '2023-11-27 06:40:17', '2023-11-27 06:40:17'),
(72, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$URxlR.FP0y.DuL1SWRzoBuOA51heYxsk6rEuEnd50TGFNFsQQhZZq\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-28T20:55:48.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$lmV1yALnxo2WDjH3d0txBuuRrfSdl7BcRekc014OOCvY572rllp.e\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-27T06:23:28.000000Z\"}}', NULL, '2023-11-28 18:55:48', '2023-11-28 18:55:48'),
(73, 'default', 'updated', 'App\\Models\\User', 'updated', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":3,\"name\":\"UWIZEWE Jean\",\"regnumber\":\"VFC003\",\"username\":\"uwizewe\",\"phone\":\"078776500\",\"email_verified_at\":null,\"password\":\"$2y$10$3npriuDRARSrrO2MxADO6ew5DSqVQScdHzDpr9reGgf02lSaTdocG\",\"savings\":2000,\"role\":\"2\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-28T20:57:23.000000Z\"},\"old\":{\"id\":3,\"name\":\"UWIZEWE Jean\",\"regnumber\":\"VFC003\",\"username\":\"uwizewe\",\"phone\":\"078776500\",\"email_verified_at\":null,\"password\":\"$2y$10$DG7EUWeInL1s3A.9baAtxeyQE8lajdE6Elopx\\/8s.XTE0gNfgvXCi\",\"savings\":2000,\"role\":\"2\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-17T18:54:46.000000Z\"}}', NULL, '2023-11-28 18:57:23', '2023-11-28 18:57:23'),
(74, 'default', 'updated', 'App\\Models\\User', 'updated', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":3,\"name\":\"UWIZEWE Jean\",\"regnumber\":\"VFC003\",\"username\":\"uwizewe\",\"phone\":\"078776500\",\"email_verified_at\":null,\"password\":\"$2y$10$GjDNrSyZlXgxOsw3Yjuwmev.KjoU2bHg9Sxx4UFs4lVUckALrzgj2\",\"savings\":2000,\"role\":\"2\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-28T20:57:31.000000Z\"},\"old\":{\"id\":3,\"name\":\"UWIZEWE Jean\",\"regnumber\":\"VFC003\",\"username\":\"uwizewe\",\"phone\":\"078776500\",\"email_verified_at\":null,\"password\":\"$2y$10$3npriuDRARSrrO2MxADO6ew5DSqVQScdHzDpr9reGgf02lSaTdocG\",\"savings\":2000,\"role\":\"2\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-28T20:57:23.000000Z\"}}', NULL, '2023-11-28 18:57:31', '2023-11-28 18:57:31'),
(75, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$6JFgk\\/.i2FAXjn.XjNCYkOc2YnkIBINpz2zPXrfJIHnvCB1gTimGq\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-29T05:08:27.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$URxlR.FP0y.DuL1SWRzoBuOA51heYxsk6rEuEnd50TGFNFsQQhZZq\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-28T20:55:48.000000Z\"}}', NULL, '2023-11-29 03:08:27', '2023-11-29 03:08:27'),
(76, 'default', 'updated', 'App\\Models\\User', 'updated', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":3,\"name\":\"UWIZEWE Jean\",\"regnumber\":\"VFC003\",\"username\":\"uwizewe\",\"phone\":\"078776500\",\"email_verified_at\":null,\"password\":\"$2y$10$yqI4cWAml8USyvuaC522uu9eN33up4EOaQQgz1os0fILWtJ.11xO2\",\"savings\":2000,\"role\":\"2\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-29T05:13:13.000000Z\"},\"old\":{\"id\":3,\"name\":\"UWIZEWE Jean\",\"regnumber\":\"VFC003\",\"username\":\"uwizewe\",\"phone\":\"078776500\",\"email_verified_at\":null,\"password\":\"$2y$10$GjDNrSyZlXgxOsw3Yjuwmev.KjoU2bHg9Sxx4UFs4lVUckALrzgj2\",\"savings\":2000,\"role\":\"2\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-28T20:57:31.000000Z\"}}', NULL, '2023-11-29 03:13:13', '2023-11-29 03:13:13'),
(77, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$SL4S8RdX68c\\/SjbgpPJlcOJoirMOM62CmEVEh0FvERe5i2A72R4EK\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-29T05:54:07.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$6JFgk\\/.i2FAXjn.XjNCYkOc2YnkIBINpz2zPXrfJIHnvCB1gTimGq\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-29T05:08:27.000000Z\"}}', NULL, '2023-11-29 03:54:08', '2023-11-29 03:54:08'),
(78, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$zT.rGCvQx2xbQNTV7HFya.djBZUuyqIH61kfCR5wk.iOuRhwBtGX2\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-29T05:54:14.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$SL4S8RdX68c\\/SjbgpPJlcOJoirMOM62CmEVEh0FvERe5i2A72R4EK\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-29T05:54:07.000000Z\"}}', NULL, '2023-11-29 03:54:14', '2023-11-29 03:54:14'),
(79, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$Hy7GysH.G\\/CcyzVTyIVPseyjP3jwQeULSTRB60PnNg8bkwpcKfEx2\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:03:54.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$zT.rGCvQx2xbQNTV7HFya.djBZUuyqIH61kfCR5wk.iOuRhwBtGX2\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-29T05:54:14.000000Z\"}}', NULL, '2023-12-04 16:03:54', '2023-12-04 16:03:54'),
(80, 'default', 'updated', 'App\\Models\\User', 'updated', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":3,\"name\":\"UWIZEWE Jean\",\"regnumber\":\"VFC003\",\"username\":\"uwizewe\",\"phone\":\"078776500\",\"email_verified_at\":null,\"password\":\"$2y$10$YrqwNJtNgrvN5ZblQuiKYOxc7l8lSCmpuO0eFF1jXe0V3TQ5ESF.e\",\"savings\":2000,\"role\":\"2\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:06:30.000000Z\"},\"old\":{\"id\":3,\"name\":\"UWIZEWE Jean\",\"regnumber\":\"VFC003\",\"username\":\"uwizewe\",\"phone\":\"078776500\",\"email_verified_at\":null,\"password\":\"$2y$10$yqI4cWAml8USyvuaC522uu9eN33up4EOaQQgz1os0fILWtJ.11xO2\",\"savings\":2000,\"role\":\"2\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-29T05:13:13.000000Z\"}}', NULL, '2023-12-04 16:06:30', '2023-12-04 16:06:30'),
(81, 'default', 'updated', 'App\\Models\\User', 'updated', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":3,\"name\":\"UWIZEWE Jean\",\"regnumber\":\"VFC003\",\"username\":\"uwizewe\",\"phone\":\"078776500\",\"email_verified_at\":null,\"password\":\"$2y$10$MfT7qvIxzGtgcEIQi4U2nehDFu\\/3tqvAOSEmCmQPU2HzqA6TzSNiK\",\"savings\":2000,\"role\":\"2\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:06:38.000000Z\"},\"old\":{\"id\":3,\"name\":\"UWIZEWE Jean\",\"regnumber\":\"VFC003\",\"username\":\"uwizewe\",\"phone\":\"078776500\",\"email_verified_at\":null,\"password\":\"$2y$10$YrqwNJtNgrvN5ZblQuiKYOxc7l8lSCmpuO0eFF1jXe0V3TQ5ESF.e\",\"savings\":2000,\"role\":\"2\",\"status\":\"1\",\"department_id\":3,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:06:30.000000Z\"}}', NULL, '2023-12-04 16:06:38', '2023-12-04 16:06:38'),
(82, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$Y5dz.V3pFcbVBUi8Xobk2O29trNHkDE8I7Vwz8A8LT6bzfP2qKt4q\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:08:06.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$Hy7GysH.G\\/CcyzVTyIVPseyjP3jwQeULSTRB60PnNg8bkwpcKfEx2\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:03:54.000000Z\"}}', NULL, '2023-12-04 16:08:06', '2023-12-04 16:08:06'),
(83, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$HzjO.XIyDAKmJhTFayyjueyNp10zg8R2mbz.4vKBWf4pjW7n.QoCq\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:11:57.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$gIcRfs1jkb25rGKasAyYe.UuzMRfvo40WF7RSEWIiIvnS0QLOhAVG\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-11-27T08:40:17.000000Z\"}}', NULL, '2023-12-04 16:11:57', '2023-12-04 16:11:57'),
(84, 'default', 'updated', 'App\\Models\\User', 'updated', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$kZ\\/UgvqU7vLfBw0VfO9YN.QXiaKyCrexpAUjuzyPJjcpwpoGQVknO\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:12:06.000000Z\"},\"old\":{\"id\":2,\"name\":\"Ntwari Lebon 02\",\"regnumber\":\"VFC002\",\"username\":\"lebon\",\"phone\":\"0787765434\",\"email_verified_at\":null,\"password\":\"$2y$10$HzjO.XIyDAKmJhTFayyjueyNp10zg8R2mbz.4vKBWf4pjW7n.QoCq\",\"savings\":2000,\"role\":\"1\",\"status\":\"1\",\"department_id\":2,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:11:57.000000Z\"}}', NULL, '2023-12-04 16:12:06', '2023-12-04 16:12:06'),
(85, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$xdK2f.j32W\\/R27LZ6Hefyuf6k7ScB5M1UhxeM.YuQAUNox3c4a.uK\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:13:05.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$Y5dz.V3pFcbVBUi8Xobk2O29trNHkDE8I7Vwz8A8LT6bzfP2qKt4q\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:08:06.000000Z\"}}', NULL, '2023-12-04 16:13:05', '2023-12-04 16:13:05'),
(86, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$DAl9huwSqu2zDQOMuaQevesNyTEjAcOqVPnBRqLINLcUcg5cfuxdW\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:13:11.000000Z\"},\"old\":{\"id\":1,\"name\":\"BYAMUNGU Lewis\",\"regnumber\":\"VFC001\",\"username\":\"lewis\",\"phone\":\"0785436135\",\"email_verified_at\":null,\"password\":\"$2y$10$xdK2f.j32W\\/R27LZ6Hefyuf6k7ScB5M1UhxeM.YuQAUNox3c4a.uK\",\"savings\":2000,\"role\":\"0\",\"status\":\"1\",\"department_id\":1,\"remember_token\":null,\"created_at\":\"2023-11-17T18:54:46.000000Z\",\"updated_at\":\"2023-12-04T18:13:05.000000Z\"}}', NULL, '2023-12-04 16:13:11', '2023-12-04 16:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `authentication_log`
--

CREATE TABLE `authentication_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `authenticatable_type` varchar(255) NOT NULL,
  `authenticatable_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `logout_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authentication_log`
--

INSERT INTO `authentication_log` (`id`, `authenticatable_type`, `authenticatable_id`, `ip_address`, `user_agent`, `login_at`, `logout_at`) VALUES
(1, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-17 18:21:20', '2023-11-17 18:22:08'),
(2, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-17 18:21:20', '2023-11-17 18:23:21'),
(3, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 OPR/104.0.0.0', '2023-11-17 18:24:25', '2023-11-17 18:26:36'),
(4, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-17 18:26:48', NULL),
(5, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-18 21:19:25', NULL),
(6, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 15:02:04', '2023-11-19 15:49:12'),
(7, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 15:02:27', '2023-11-19 15:48:50'),
(8, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 15:49:18', '2023-11-19 15:49:38'),
(9, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 15:49:25', '2023-11-19 16:04:14'),
(10, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 16:04:19', '2023-11-19 16:06:46'),
(11, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 16:04:33', '2023-11-19 16:06:40'),
(12, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 16:07:01', '2023-11-19 16:11:45'),
(13, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 16:07:08', NULL),
(14, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 16:11:56', NULL),
(15, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 16:12:28', '2023-11-19 16:12:33'),
(16, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 16:12:44', '2023-11-19 16:13:15'),
(17, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 16:13:34', NULL),
(18, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 16:13:42', NULL),
(19, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 16:13:54', NULL),
(20, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 16:13:57', NULL),
(21, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 16:14:31', NULL),
(22, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 16:14:43', '2023-11-19 16:15:25'),
(23, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 16:15:39', NULL),
(24, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 16:32:22', NULL),
(25, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 16:32:26', '2023-11-19 16:41:14'),
(26, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 16:41:24', NULL),
(27, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-19 16:41:33', NULL),
(28, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 18:04:53', '2023-11-19 18:05:19'),
(29, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 18:05:27', NULL),
(30, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 18:05:37', '2023-11-19 18:07:54'),
(31, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 18:10:00', NULL),
(32, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 18:10:10', '2023-11-19 18:10:27'),
(33, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 18:10:35', NULL),
(34, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-19 18:11:01', NULL),
(35, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-20 13:17:30', NULL),
(36, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-21 02:07:48', NULL),
(37, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-21 05:25:28', NULL),
(38, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-21 11:58:39', NULL),
(39, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-21 14:41:45', '2023-11-21 18:29:01'),
(40, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-21 18:29:33', NULL),
(41, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-21 18:29:40', NULL),
(42, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-22 02:30:41', NULL),
(43, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-22 15:01:04', NULL),
(44, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-22 18:52:11', NULL),
(45, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-23 05:12:33', '2023-11-23 07:27:19'),
(46, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-23 07:27:38', NULL),
(47, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-23 07:27:48', NULL),
(48, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-23 10:41:05', '2023-11-23 11:17:17'),
(49, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-23 11:17:24', NULL),
(50, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-23 11:17:32', '2023-11-23 11:22:00'),
(51, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-23 11:24:03', NULL),
(52, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-23 11:24:18', '2023-11-23 13:15:18'),
(53, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-25 03:02:43', NULL),
(54, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-25 12:42:52', NULL),
(55, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-25 19:08:14', NULL),
(56, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-26 04:07:27', NULL),
(57, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-26 13:50:54', '2023-11-26 14:09:32'),
(58, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-26 14:09:48', NULL),
(59, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-26 14:09:56', NULL),
(60, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-26 14:10:36', NULL),
(61, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-27 04:23:28', '2023-11-27 06:39:57'),
(62, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-27 06:40:09', NULL),
(63, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-27 06:40:17', '2023-11-27 07:14:18'),
(64, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-28 18:55:47', '2023-11-28 18:56:21'),
(65, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-28 18:57:23', NULL),
(66, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-28 18:57:31', NULL),
(67, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', '2023-11-29 03:08:27', '2023-11-29 03:54:00'),
(68, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-29 03:13:13', '2023-11-29 03:53:47'),
(69, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-29 03:54:07', NULL),
(70, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Avast/118.0.0.0', '2023-11-29 03:54:14', NULL),
(71, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Avast/119.0.0.0', '2023-12-04 16:03:53', '2023-12-04 16:06:22'),
(72, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Avast/119.0.0.0', '2023-12-04 16:06:29', NULL),
(73, 'App\\Models\\User', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Avast/119.0.0.0', '2023-12-04 16:06:38', NULL),
(74, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Avast/119.0.0.0', '2023-12-04 16:08:06', '2023-12-04 16:11:49'),
(75, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Avast/119.0.0.0', '2023-12-04 16:11:57', NULL),
(76, 'App\\Models\\User', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Avast/119.0.0.0', '2023-12-04 16:12:06', '2023-12-04 16:12:45'),
(77, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Avast/119.0.0.0', '2023-12-04 16:13:04', NULL),
(78, 'App\\Models\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Avast/119.0.0.0', '2023-12-04 16:13:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ADMINISTRATION', '2023-11-17 16:54:46', '2023-11-17 16:54:46'),
(2, 'FINANCE', '2023-11-17 16:54:46', '2023-11-17 16:54:46'),
(3, 'AUDIT', '2023-11-17 16:54:46', '2023-11-17 16:54:46'),
(4, 'SPECIAL', '2023-11-17 16:54:46', '2023-11-17 16:54:46'),
(5, 'OPERATION', '2023-11-17 16:54:46', '2023-11-17 16:54:46'),
(8, 'LEBON TEST', '2023-11-19 16:41:50', '2023-11-19 16:41:50');

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
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan` bigint(20) NOT NULL,
  `interest` int(11) NOT NULL,
  `installement` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `loan_status` enum('open','closed') NOT NULL DEFAULT 'open',
  `status` enum('requested','approved','rejected') NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `loan_type` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `loan`, `interest`, `installement`, `comment`, `loan_status`, `status`, `user_id`, `loan_type`, `created_at`, `updated_at`) VALUES
(1, 30000, 900, 3, 'Loan for First Check', 'closed', 'rejected', 3, 1, '2023-11-25 04:45:30', '2023-11-27 06:36:00'),
(2, 50000, 2000, 4, 'I want chek here', 'closed', 'approved', 2, 1, '2023-11-25 05:36:36', '2023-11-26 15:48:07'),
(3, 250000, 10000, 4, 'Test Loan', 'open', 'approved', 3, 1, '2023-11-25 05:37:59', '2023-11-26 15:40:33'),
(4, 40000, 3200, 4, 'Emergency Loan', 'open', 'requested', 3, 2, '2023-11-29 03:48:30', '2023-11-29 03:48:30'),
(5, 100000, 5000, 5, 'Just Apply', 'open', 'approved', 4, 1, '2023-12-04 16:10:30', '2023-12-04 16:12:32');

-- --------------------------------------------------------

--
-- Table structure for table `loan_pays`
--

CREATE TABLE `loan_pays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `interest` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` enum('requested','approved','rejected') NOT NULL DEFAULT 'requested',
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_pays`
--

INSERT INTO `loan_pays` (`id`, `amount`, `interest`, `comment`, `status`, `loan_id`, `created_at`, `updated_at`) VALUES
(1, 10000, 300, 'Comment on QCL', 'approved', 1, '2023-11-25 08:02:54', '2023-11-27 06:36:00'),
(2, 62500, 2500, 'Yes Paid', 'rejected', 3, '2023-11-25 13:54:35', '2023-11-27 06:42:47'),
(3, 20000, 300, 'Anather one', 'approved', 1, '2023-11-25 19:19:12', '2023-11-25 19:19:12'),
(4, 50000, 1000, 'Payed All', 'approved', 1, '2023-11-26 09:46:26', '2023-11-26 09:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `loan_settings`
--

CREATE TABLE `loan_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_settings`
--

INSERT INTO `loan_settings` (`id`, `loan_id`, `name`, `rate`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'LT01', 'BUSINESS LOAN', 1, 1, '2023-11-17 17:29:27', '2023-11-25 04:44:55'),
(2, 'LT02', 'EMERGENCE LOAN', 2, 1, '2023-11-17 17:30:13', '2023-11-17 17:30:13');

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
(1, '2012_10_27_205017_create_departments_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_17_191206_create_loan_settings_table', 2),
(7, '2017_09_01_000000_create_authentication_log_table', 3),
(11, '2023_11_19_182618_create_activity_log_table', 4),
(12, '2023_11_19_182619_add_event_column_to_activity_log_table', 4),
(13, '2023_11_19_182620_add_batch_uuid_column_to_activity_log_table', 4),
(16, '2023_11_20_160135_create_savings_table', 5),
(17, '2023_11_21_075241_create_saving_members_table', 5),
(18, '2023_11_25_051834_create_loans_table', 6),
(20, '2023_11_25_093959_create_loan_pays_table', 7);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

CREATE TABLE `savings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `type` enum('deposit','withdraw') NOT NULL DEFAULT 'deposit',
  `saving_by` enum('single','members') NOT NULL DEFAULT 'members',
  `status` enum('requested','approved','rejected') NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`id`, `amount`, `comment`, `type`, `saving_by`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 48000, 'All month Saving', 'deposit', 'members', 'approved', 1, '2023-09-21 07:13:23', '2023-09-21 07:13:23'),
(5, 158000, 'SAVINGS FOR OCTOBER', 'deposit', 'members', 'rejected', 1, '2023-10-21 07:44:32', '2023-11-23 13:13:51'),
(6, 68000, 'SAVINGS FOR November', 'deposit', 'members', 'requested', 1, '2023-11-21 08:45:41', '2023-11-21 08:45:41'),
(7, 20000, 'NDAYAKENEYE CYANE', 'withdraw', 'single', 'approved', 1, '2023-11-23 06:32:43', '2023-11-23 13:13:19'),
(8, 3000, 'ZIGAMA CCC', 'deposit', 'single', 'requested', 1, '2023-11-23 06:36:12', '2023-11-23 06:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `saving_members`
--

CREATE TABLE `saving_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `saving_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `type` enum('deposit','withdraw') NOT NULL DEFAULT 'deposit',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saving_members`
--

INSERT INTO `saving_members` (`id`, `user_id`, `saving_id`, `amount`, `type`, `created_at`, `updated_at`) VALUES
(15, 1, 4, 2000, 'deposit', '2023-11-21 08:13:23', '2023-11-21 08:13:23'),
(16, 2, 4, 2000, 'deposit', '2023-11-21 08:13:23', '2023-11-21 08:13:23'),
(17, 3, 4, 2000, 'deposit', '2023-11-21 08:13:23', '2023-11-21 08:13:23'),
(18, 4, 4, 2000, 'deposit', '2023-11-21 08:13:23', '2023-11-21 08:13:23'),
(19, 7, 4, 20000, 'deposit', '2023-11-21 08:13:23', '2023-11-21 08:13:23'),
(20, 13, 4, 10000, 'deposit', '2023-11-21 08:13:23', '2023-11-21 08:13:23'),
(21, 15, 4, 10000, 'deposit', '2023-11-21 08:13:23', '2023-11-21 08:13:23'),
(22, 1, 5, 2000, 'deposit', '2023-11-21 08:44:32', '2023-11-21 08:44:32'),
(23, 2, 5, 2000, 'deposit', '2023-11-21 08:44:32', '2023-11-21 08:44:32'),
(24, 3, 5, 2000, 'deposit', '2023-11-21 08:44:32', '2023-11-21 08:44:32'),
(25, 4, 5, 2000, 'deposit', '2023-11-21 08:44:32', '2023-11-21 08:44:32'),
(26, 5, 5, 50000, 'deposit', '2023-11-21 08:44:32', '2023-11-21 08:44:32'),
(27, 7, 5, 20000, 'deposit', '2023-11-21 08:44:32', '2023-11-21 08:44:32'),
(28, 9, 5, 10000, 'deposit', '2023-11-21 08:44:32', '2023-11-21 08:44:32'),
(29, 11, 5, 50000, 'deposit', '2023-11-21 08:44:32', '2023-11-21 08:44:32'),
(30, 13, 5, 10000, 'deposit', '2023-11-21 08:44:32', '2023-11-21 08:44:32'),
(31, 15, 5, 10000, 'deposit', '2023-11-21 08:44:32', '2023-11-21 08:44:32'),
(32, 1, 6, 2000, 'deposit', '2023-11-21 08:45:41', '2023-11-21 08:45:41'),
(33, 2, 6, 2000, 'deposit', '2023-11-21 08:45:41', '2023-11-21 08:45:41'),
(34, 3, 6, 2000, 'deposit', '2023-11-21 08:45:41', '2023-11-21 08:45:41'),
(35, 4, 6, 2000, 'deposit', '2023-11-21 08:45:41', '2023-11-21 08:45:41'),
(36, 5, 6, 50000, 'deposit', '2023-11-21 08:45:41', '2023-11-21 08:45:41'),
(37, 15, 6, 10000, 'deposit', '2023-11-21 08:45:41', '2023-11-21 08:45:41'),
(38, 5, 7, 20000, 'withdraw', '2023-11-23 06:32:44', '2023-11-23 06:32:44'),
(39, 7, 8, 3000, 'deposit', '2023-11-23 06:36:12', '2023-11-23 06:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `regnumber` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `savings` bigint(20) NOT NULL,
  `role` enum('0','1','2') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `regnumber`, `username`, `phone`, `email_verified_at`, `password`, `savings`, `role`, `status`, `department_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'BYAMUNGU Lewis', 'VFC001', 'lewis', '0785436135', NULL, '$2y$10$DAl9huwSqu2zDQOMuaQevesNyTEjAcOqVPnBRqLINLcUcg5cfuxdW', 2000, '0', '1', 1, NULL, '2023-11-17 16:54:46', '2023-12-04 16:13:11'),
(2, 'Ntwari Lebon 02', 'VFC002', 'lebon', '0787765434', NULL, '$2y$10$kZ/UgvqU7vLfBw0VfO9YN.QXiaKyCrexpAUjuzyPJjcpwpoGQVknO', 2000, '1', '1', 2, NULL, '2023-11-17 16:54:46', '2023-12-04 16:12:06'),
(3, 'UWIZEWE Jean', 'VFC003', 'uwizewe', '078776500', NULL, '$2y$10$MfT7qvIxzGtgcEIQi4U2nehDFu/3tqvAOSEmCmQPU2HzqA6TzSNiK', 2000, '2', '1', 3, NULL, '2023-11-17 16:54:46', '2023-12-04 16:06:38'),
(4, 'Chantal HABIMANA', 'VFC004', 'chantal', '0784432244', NULL, '$2y$10$RpE4TlfwzNUVKBs102b1GOhlfzqCVuYGp2HDDbxBk5m/bU9vlMkXK', 2000, '1', '0', 2, NULL, '2023-11-19 16:33:13', '2023-11-20 13:38:36'),
(5, 'Micheal Gislason', 'VFC005', 'mreichel', '+1-551-485-9327', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 50000, '1', '1', 4, NULL, '2023-11-20 18:37:33', '2023-11-20 18:37:33'),
(7, 'Carroll Kilback', 'VFC006', 'xkonopelski', '478.662.1700', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 20000, '0', '1', 3, NULL, '2023-11-20 18:38:31', '2023-11-20 18:38:31'),
(9, 'Jessy Bayer', 'VFC007', 'elmo29', '213-750-9502', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 10000, '1', '1', 4, NULL, '2023-11-20 18:40:46', '2023-11-20 18:40:46'),
(11, 'Emerald Denesik', 'VFC008', 'ryann.lebsack', '+1 (661) 725-5550', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 50000, '0', '1', 3, NULL, '2023-11-20 18:40:53', '2023-11-20 18:40:53'),
(13, 'Mrs. Violette VonRueden Jr.', 'VFC009', 'meggie38', '(650) 633-5234', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 10000, '0', '1', 2, NULL, '2023-11-20 18:40:57', '2023-11-20 18:40:57'),
(15, 'Ken Carter', 'VFC010', 'bullrich', '(534) 557-3502', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 10000, '0', '1', 4, NULL, '2023-11-20 18:40:59', '2023-11-20 18:40:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `authentication_log`
--
ALTER TABLE `authentication_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authentication_log_authenticatable_type_authenticatable_id_index` (`authenticatable_type`,`authenticatable_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_user_id_foreign` (`user_id`),
  ADD KEY `loans_loan_type_foreign` (`loan_type`);

--
-- Indexes for table `loan_pays`
--
ALTER TABLE `loan_pays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_pays_loan_id_foreign` (`loan_id`);

--
-- Indexes for table `loan_settings`
--
ALTER TABLE `loan_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loan_settings_loan_id_unique` (`loan_id`),
  ADD UNIQUE KEY `loan_settings_name_unique` (`name`),
  ADD KEY `loan_settings_user_id_foreign` (`user_id`);

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
-- Indexes for table `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `savings_user_id_foreign` (`user_id`);

--
-- Indexes for table `saving_members`
--
ALTER TABLE `saving_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saving_members_user_id_foreign` (`user_id`),
  ADD KEY `saving_members_saving_id_foreign` (`saving_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_regnumber_unique` (`regnumber`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `authentication_log`
--
ALTER TABLE `authentication_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loan_pays`
--
ALTER TABLE `loan_pays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_settings`
--
ALTER TABLE `loan_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `saving_members`
--
ALTER TABLE `saving_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_loan_type_foreign` FOREIGN KEY (`loan_type`) REFERENCES `loan_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loan_pays`
--
ALTER TABLE `loan_pays`
  ADD CONSTRAINT `loan_pays_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loan_settings`
--
ALTER TABLE `loan_settings`
  ADD CONSTRAINT `loan_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `savings`
--
ALTER TABLE `savings`
  ADD CONSTRAINT `savings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `saving_members`
--
ALTER TABLE `saving_members`
  ADD CONSTRAINT `saving_members_saving_id_foreign` FOREIGN KEY (`saving_id`) REFERENCES `savings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saving_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
