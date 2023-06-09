-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 08:05 AM
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
-- Database: `magicline`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_lists`
--

CREATE TABLE `access_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `accesslists` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_lists`
--

INSERT INTO `access_lists` (`id`, `user_id`, `accesslists`) VALUES
(1, 1, 'ALL'),
(2, 2, 'ALL'),
(3, 3, 'ALL'),
(4, 4, 'COFRAD'),
(5, 5, 'COFRAD,FRANCE DISPLAY,LOFTNGARDEN,WOLF & SMF'),
(6, 6, 'ALL'),
(7, 7, 'ALL'),
(8, 8, 'ALL');

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `activity`, `timestamp`) VALUES
(1, '2', 'Logged in', '2023-05-17 03:29:35'),
(2, '4', 'Logged in', '2023-05-17 03:29:50'),
(3, '4', 'Logged out', '2023-05-17 03:34:34'),
(4, '6', 'Logged in', '2023-05-17 03:34:52'),
(5, '6', 'Logged out', '2023-05-17 03:37:01'),
(6, '6', 'Logged in', '2023-05-17 03:37:12'),
(7, '6', 'Logged out', '2023-05-17 03:38:00'),
(8, '6', 'Logged in', '2023-05-17 03:38:10'),
(9, '6', 'Logged out', '2023-05-17 03:38:30'),
(10, '4', 'Logged in', '2023-05-17 03:39:35'),
(11, '4', 'Logged out', '2023-05-17 03:40:11'),
(12, '2', 'Logged out', '2023-05-17 05:08:54'),
(13, '1', 'Logged in', '2023-05-17 05:09:01'),
(14, '6', 'Logged in', '2023-05-17 05:09:37'),
(15, '1', 'Logged out', '2023-05-17 05:12:20'),
(16, '4', 'Logged in', '2023-05-17 05:20:42'),
(17, '4', 'Logged out', '2023-05-17 05:38:32'),
(18, '2', 'Logged in', '2023-05-17 05:38:36'),
(19, '6', 'Logged out', '2023-05-17 05:51:27'),
(20, '5', 'Logged in', '2023-05-17 05:53:47'),
(21, '5', 'Logged out', '2023-05-17 07:13:04'),
(22, '5', 'Logged in', '2023-05-17 07:13:14'),
(23, '2', 'Logged out', '2023-05-17 09:00:34'),
(24, '2', 'Logged in', '2023-05-18 00:36:49'),
(25, '5', 'Logged in', '2023-05-18 03:09:20'),
(26, '2', 'Logged in', '2023-05-19 00:03:32'),
(27, '3', 'Logged in', '2023-05-19 00:35:41'),
(28, '2', 'Logged out', '2023-05-19 00:35:57'),
(29, '2', 'Logged in', '2023-05-19 00:36:06'),
(30, '2', 'Logged in', '2023-05-24 03:16:52'),
(31, '2', 'Logged out', '2023-05-24 05:05:02'),
(32, '4', 'Logged in', '2023-05-24 05:05:08'),
(33, '4', 'Logged out', '2023-05-24 05:26:46'),
(34, '2', 'Logged in', '2023-05-24 05:26:51'),
(35, '2', 'Logged in', '2023-05-25 01:39:14'),
(36, '4', 'Logged in', '2023-05-25 01:51:33'),
(37, '4', 'Logged out', '2023-05-25 01:51:45'),
(38, '2', 'Logged out', '2023-05-25 02:06:45'),
(39, '2', 'Logged in', '2023-05-25 02:06:56'),
(40, '2', 'Logged out', '2023-05-25 02:57:28'),
(41, '4', 'Logged in', '2023-05-25 02:57:32'),
(42, '4', 'Logged out', '2023-05-25 02:58:21'),
(43, '5', 'Logged in', '2023-05-25 02:58:26'),
(44, '5', 'Logged out', '2023-05-25 03:04:11'),
(45, '6', 'Logged in', '2023-05-25 03:04:17'),
(46, '6', 'Logged out', '2023-05-25 03:06:17'),
(47, '2', 'Logged in', '2023-05-25 03:06:23'),
(48, '2', 'Logged out', '2023-05-25 05:16:09'),
(49, '2', 'Logged in', '2023-05-26 05:51:52'),
(50, '2', 'Logged in', '2023-05-27 01:54:53'),
(51, '2', 'Logged in', '2023-05-29 00:14:46'),
(52, '2', 'Logged out', '2023-05-29 01:38:05'),
(53, '2', 'Logged in', '2023-05-29 01:38:10'),
(54, '2', 'Logged out', '2023-05-29 05:20:03'),
(55, '4', 'Logged in', '2023-05-29 05:20:10'),
(56, '4', 'Logged out', '2023-05-29 05:20:46'),
(57, '2', 'Logged in', '2023-05-29 05:20:51'),
(58, '2', 'Logged out', '2023-05-29 07:31:55'),
(59, '6', 'Logged in', '2023-05-29 07:32:07'),
(60, '2', 'Logged in', '2023-05-29 07:35:04'),
(61, '2', 'Logged out', '2023-05-29 08:39:08'),
(62, '2', 'Logged in', '2023-05-29 08:40:19'),
(63, '2', 'Logged out', '2023-05-29 08:45:12'),
(64, '4', 'Logged in', '2023-05-29 08:45:29'),
(65, '4', 'Logged out', '2023-05-29 08:45:43'),
(66, '5', 'Logged in', '2023-05-29 08:45:48'),
(67, '5', 'Logged out', '2023-05-29 08:46:25'),
(68, '6', 'Logged in', '2023-05-29 08:46:31'),
(69, '6', 'Logged out', '2023-05-29 08:52:53'),
(70, '2', 'Logged in', '2023-05-29 08:55:05'),
(71, '2', 'Logged in', '2023-05-30 00:44:08'),
(72, '2', 'Logged in', '2023-05-30 07:30:29'),
(73, '2', 'Logged in', '2023-05-31 02:06:34'),
(74, '6', 'Logged in', '2023-05-31 03:09:43'),
(75, '6', 'Logged out', '2023-05-31 03:10:31'),
(76, '2', 'Logged in', '2023-05-31 08:08:46'),
(77, '2', 'Logged in', '2023-06-01 07:03:29'),
(78, '2', 'Logged in', '2023-06-05 00:30:27'),
(79, '2', 'Logged in', '2023-06-05 00:30:28'),
(80, '2', 'Logged out', '2023-06-05 01:43:23'),
(81, '4', 'Logged in', '2023-06-05 01:43:31'),
(82, '2', 'Logged in', '2023-06-05 01:45:32'),
(83, '4', 'Logged out', '2023-06-05 01:59:09'),
(84, '4', 'Logged in', '2023-06-05 03:34:51'),
(85, '4', 'Logged out', '2023-06-05 03:58:07'),
(86, '7', 'Logged in', '2023-06-05 03:58:15'),
(87, '7', 'Logged out', '2023-06-05 04:48:50'),
(88, '7', 'Logged in', '2023-06-05 04:49:15'),
(89, '7', 'Logged out', '2023-06-05 04:58:04'),
(90, '4', 'Logged in', '2023-06-05 04:59:42'),
(91, '4', 'Logged out', '2023-06-05 05:00:49'),
(92, '7', 'Logged in', '2023-06-05 05:02:17'),
(93, '7', 'Logged out', '2023-06-05 05:41:53'),
(94, '6', 'Logged in', '2023-06-05 05:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avatars`
--

INSERT INTO `avatars` (`id`, `avatar`) VALUES
(1, 'avatar 1.png'),
(2, 'avatar 2.png'),
(3, 'avatar 3.png'),
(4, 'avatar 4.png'),
(5, 'avatar 5.png'),
(6, 'avatar 6.png'),
(7, 'avatar 7.png'),
(8, 'avatar 8.png'),
(9, 'avatar 9.png');

-- --------------------------------------------------------

--
-- Table structure for table `bug_reports`
--

CREATE TABLE `bug_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `archived` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bug_reports`
--

INSERT INTO `bug_reports` (`id`, `user_id`, `title`, `description`, `attachment`, `status`, `archived`, `created_at`, `updated_at`) VALUES
(1, 5, 'Bug report test', 'I found a bug.', 'Activity Logs.pdf', 'open', '1', '2023-05-18 06:40:34', '2023-05-29 07:23:03');

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
-- Table structure for table `ltu_languages`
--

CREATE TABLE `ltu_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `rtl` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ltu_phrases`
--

CREATE TABLE `ltu_phrases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `translation_id` bigint(20) UNSIGNED NOT NULL,
  `translation_file_id` bigint(20) UNSIGNED NOT NULL,
  `phrase_id` bigint(20) UNSIGNED DEFAULT NULL,
  `key` text NOT NULL,
  `group` text NOT NULL,
  `value` text DEFAULT NULL,
  `parameters` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`parameters`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ltu_translations`
--

CREATE TABLE `ltu_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `source` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ltu_translation_files`
--

CREATE TABLE `ltu_translation_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_19_013016_create_products_table', 1),
(6, '2023_04_20_005554_create_access_lists_table', 1),
(7, '2023_04_20_011151_create_partners_table', 1),
(8, '2023_04_27_005144_create_temporary_files_table', 1),
(9, '2023_04_28_032054_create_reset_requests_table', 1),
(10, '2023_05_17_081236_create_activity_logs_table', 1),
(11, '2023_05_17_081516_create_prices_table', 1),
(12, '2023_05_18_113226_create_bug_reports_table', 2),
(13, '2018_08_08_100000_create_translations_tables', 3);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `archived` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `company`, `logo`, `archived`) VALUES
(1, 'CLEO', 'CLEO.png', NULL),
(2, 'COFRAD', 'COFRAD.png', NULL),
(3, 'LOFTNGARDEN', 'LOFT&GARDEN.png', NULL),
(4, 'MANEX FRANCE', 'MANEX FRANCE.png', NULL),
(5, 'FRANCE DISPLAY', 'MANEX USA.png', NULL),
(6, 'NUBODY', 'NUBODY.png', NULL),
(7, 'RUNWAY', 'RUNWAY.png', NULL),
(8, 'STOCKMAN PARIS', 'STOCKMAN.png', NULL),
(9, 'WOLF & SMF', 'WOLF&SMF.png', NULL),
(10, 'SHOES', 'shoes(man) (1).jpg', '1');

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
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `itemref` varchar(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `isallowed` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `itemref`, `user_id`, `isallowed`) VALUES
(1, 'P750-1-AI', '4,5', NULL),
(2, 'SS-B535-36-SC-1038', NULL, NULL),
(3, 'head', '6', NULL),
(4, 'head', '6', NULL),
(5, 'head 2', '6', NULL),
(6, 'head with headset', '6', NULL),
(7, 'head 321', '6', NULL),
(8, 'SMF-PF-M-S38', '4,6', NULL),
(9, 'NY-AS01', NULL, NULL),
(10, 'SMF-MDJF-40-RP', '4', NULL),
(11, 'SMF-MDJF-40-RP', '5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po` varchar(255) DEFAULT NULL,
  `itemref` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` longtext DEFAULT NULL,
  `description` longtext NOT NULL,
  `images` varchar(255) NOT NULL,
  `file` longtext DEFAULT NULL,
  `pdf` longtext DEFAULT NULL,
  `addedby` varchar(255) NOT NULL,
  `updatedby` varchar(255) DEFAULT NULL,
  `archived` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `po`, `itemref`, `company`, `category`, `type`, `price`, `description`, `images`, `file`, `pdf`, `addedby`, `updatedby`, `archived`) VALUES
(1, '6896LM', 'NY-AS01', 'FRANCE DISPLAY', 'Bust & Torso', 'Standard', NULL, '<p>This is the current infos</p>', 'NY-AS01-1.jpg,NY-AS01-2.jpg,NY-AS01-3.jpg,NY-AS01-4.jpg', 'Admin  Users (1).xlsx', NULL, 'ryan', 'ryan', NULL),
(2, 'CF001671', 'P750-1-AI', 'COFRAD', 'Mannequin', 'Standard', '$50', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry</span><br></p>', 'P750-1-AI (1).JPG,P750-1-AI (2).JPG,P750-1-AI (3).JPG,P750-1-AI (4).JPG', NULL, NULL, 'ryan', 'ryan', '1'),
(3, 'CF001702', 'SS-B535-36-SC-1038', 'COFRAD', 'Bust & Torso', 'Standard', '$50', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry</span><br></p>', 'SS-B535-36-SC-1038 (2).JPG,SS-B535-36-SC-1038 (3).JPG,SS-B535-36-SC-1038 (4).JPG,SS-B535-36-SC-1038 (5).JPG', 'Admin  Users (1).xlsx', 'Activity Logs.pdf', 'ryan', 'ryan', NULL),
(4, '80516JD', 'INTIMATE SIZE 34D', 'WOLF & SMF', 'Bust & Torso', 'Standard', NULL, '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry</span><br></p>', 'INTIMATE SIZE 34D (1).JPG,INTIMATE SIZE 34D (2).JPG,INTIMATE SIZE 34D (3).JPG,INTIMATE SIZE 34D (4).JPG', NULL, NULL, 'ryan', NULL, NULL),
(5, '80576LM', 'SMF-RL-WDDF-2-RP', 'WOLF & SMF', 'Bust & Torso', 'Standard', NULL, '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry</span><br></p>', 'SMF-RL-WDDF-2-RP (1).JPG,SMF-RL-WDDF-2-RP (2).JPG,SMF-RL-WDDF-2-RP (3).JPG,SMF-RL-WDDF-2-RP (4).JPG', NULL, NULL, 'ryan', NULL, NULL),
(6, NULL, 'head', 'CLEO', 'Accessories', 'Special', '456', '<p>sample</p>', 'DSC_0727.JPG,DSC_0729.JPG,DSC_0732.JPG,DSC_0733.JPG', NULL, NULL, 'star', 'ryan', NULL),
(10, NULL, 'head6', 'CLEO', 'Bust & Torso', 'Standard', '89', '<p>head6</p>', 'DSC_0737.JPG,DSC_0740.JPG,DSC_0741.JPG,DSC_0742.JPG', NULL, NULL, 'star', NULL, NULL),
(11, NULL, 'head with headset', 'SHOES', 'Accessories', 'Special', '143', '<p>head with headset<br></p>', 'DSC_0745.JPG,DSC_0747.JPG,DSC_0749.JPG,DSC_0752.JPG', NULL, NULL, 'star', 'star', '1'),
(13, '80550JD', 'SMF-PF-M-S38', 'WOLF & SMF', 'Mannequin', 'Standard', NULL, '<p style=\"\" class=\"\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Fabrication: - Fiberglass</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">Fabric: - Beige Muslin</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">Fabric Neck Cap: - Flat Metal Neck Cap (ø91) (Covered Beige Muslin Fabric)</span><br> <span style=\"font-family: &quot;Times New Roman&quot;;\">- Metal Neck Cap with Lip and Raw Acorn</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">Head: - True Egg Head (Covered Beige Muslin Fabric)</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">Arms: - Raw Articulated Arms and Fingers screwed with the Middle Finger</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">- Arm Caps (ø14)</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">(Covered Beige Muslin Fabric)</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">Attachment: - ø1 Flange</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">Base: - Raw Chicago&nbsp;Base</span></p><p style=\"\" class=\"\"></p><h5 class=\"\"><br><b><u><span style=\"font-family: &quot;Times New Roman&quot;;\">Measurements Size</span></u></b></h5><span style=\"font-family: &quot;Times New Roman&quot;;\">Bust: - 83cm (32 5/8”)</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">Waist: - 60cm (23 5/8”)</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">Hips: - 86.5cm (34”)</span><p></p><p style=\"\" class=\"\"></p><h5 class=\"\"><br><b><u><span style=\"font-family: &quot;Times New Roman&quot;;\">Material Composition</span></u></b></h5><span style=\"font-family: &quot;Times New Roman&quot;;\">50% - Beige Muslin Fabric</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">40% - Fiber Glass</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">05% - Wood</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">03% - Metal</span><br><span style=\"font-family: &quot;Times New Roman&quot;;\">02% - Aluminum</span><p></p>', 'SMF-PF-M-S38 (2).JPG,SMF-PF-M-S38 (1).JPG,SMF-PF-M-S38 (3).JPG,SMF-PF-M-S38 (4).JPG', 'Admin  Users.xlsx', 'NY-B535-40-AI-1009._.pdf', 'ryan', 'ryan', NULL),
(14, '80567LC', 'SMF-MDJF-40-RP', 'WOLF & SMF', 'Bust & Torso', 'Standard', '$50', '<p class=\"\">Fabrication: - Fiberglass\r\n</p><p class=\"\">Fabric: - Beige Muslin Fabric\r\n</p><p class=\"\">Neck Cap: - Flat Metal Neck Cap (ø91)\r\n (Covered Beige Muslin Fabric)\r\n</p><p class=\"\"> - Metal Neck Cap with Lip and\r\n Raw Acorn\r\n</p><p class=\"\">Head: - True Egg Head\r\n (Covered Beige Muslin Fabric)\r\n</p><p class=\"\">Arms: - Raw Articulated Arms and\r\n Fingers screwed with the\r\n Middle Finger\r\n</p><p class=\"\"> - Arm Caps (ø14)\r\n (Covered Beige Muslin Fabric)\r\nAttachment: - ø1 Flange\r\n</p><p class=\"\">Base: - Raw Chicago Base<br></p>', 'SMF-MDJF-40-RP (1).JPG,SMF-MDJF-40-RP (2).JPG,SMF-MDJF-40-RP (3).JPG,SMF-MDJF-40-RP (4).JPG', NULL, NULL, 'ryan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reset_requests`
--

CREATE TABLE `reset_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_files`
--

CREATE TABLE `temporary_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folder` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `company` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `archived` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `email_verified_at`, `company`, `password`, `role`, `status`, `avatar`, `archived`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Christophe', 'Israel', 'christophe', 'christophe@cofrad.com', NULL, 'MAGIC LINE', '$2y$10$MrCgJDjG7pTEeS84G1vXmeewdHPjllAzpH8/s04DMHCr8iJeN5sWy', 'owner', 'activated', 'avatar 1.png', NULL, NULL, NULL, NULL),
(2, 'Ryan', 'Garcia', 'ryan', 'ryangarcia.dev@gmail.com', NULL, 'MAGIC LINE', '$2y$10$/TG5a/2/Xr9TmZ/BwcrDouw6hJMVTb7XcwFeeckzlyg2xdvO22INC', 'admin1', 'activated', 'avatar 9.png', NULL, NULL, NULL, NULL),
(3, 'Star', 'Esguerra', 'star', 'star@gmail.com', NULL, 'MAGIC LINE', '$2y$10$2tpBmFuImKyQ4mZAlVYNdOi5kfTRbpqLElkRttXdzgDpDZcnQsaAy', 'admin1', 'activated', 'avatar 2.png', NULL, NULL, NULL, NULL),
(4, 'The', 'Viewer', 'viewer', 'viewer@gmail.com', NULL, 'MAGIC LINE', '$2y$10$w7LzbHHHUzQrdehoPDKB4OgyUyCc96wpRLwM9FGqV6pnnh6IWnmGq', 'user', 'activated', 'avatar 2.png', NULL, NULL, NULL, NULL),
(5, 'Viewer', 'Two', 'viewer2', 'viewer2@gmail.com', NULL, 'MAGIC LINE', '$2y$10$MZSqI4F.tsMqSZlQz9nypedGHVBOgGfpjBLHsb6MLIjqK1dnMsjhG', 'user', 'activated', 'avatar 6.png', NULL, NULL, NULL, NULL),
(6, 'Walter', 'Mart', 'walter', 'walter@gmail.com', NULL, 'MAGIC LINE', '$2y$10$8wlNw2/871EDlR8s/J.ybemxKmgO9kBhVd65.J8YT2yn7SePQ5Eve', 'admin2', 'activated', 'avatar 4.png', NULL, NULL, NULL, NULL),
(7, 'Mister', 'Clean', 'mrclean', 'a@g.v', NULL, 'MAGIC LINE', '$2y$10$/mMK7Di5Ihs99871XbgUceAOMwJIRwbrSNhNHURyRZepZumsSl9DO', 'user', 'activated', 'avatar 9.png', NULL, NULL, NULL, NULL),
(8, 'Cedric', 'Bloc', 'cedric', 'magicline.corp@gmail.com', NULL, 'MAGIC LINE', '$2y$10$oVj/NElpCzsmuaOj.7wvsuom25MrhPzJrT9dV7UHB2iygBmbFIjpq', 'admin1', 'activated', 'avatar 1.png', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_lists`
--
ALTER TABLE `access_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_lists_user_id_foreign` (`user_id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bug_reports`
--
ALTER TABLE `bug_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bug_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `ltu_languages`
--
ALTER TABLE `ltu_languages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ltu_languages_code_index` (`code`);

--
-- Indexes for table `ltu_phrases`
--
ALTER TABLE `ltu_phrases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ltu_phrases_translation_id_foreign` (`translation_id`),
  ADD KEY `ltu_phrases_translation_file_id_foreign` (`translation_file_id`),
  ADD KEY `ltu_phrases_phrase_id_foreign` (`phrase_id`);

--
-- Indexes for table `ltu_translations`
--
ALTER TABLE `ltu_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ltu_translations_language_id_foreign` (`language_id`);

--
-- Indexes for table `ltu_translation_files`
--
ALTER TABLE `ltu_translation_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
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
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_requests`
--
ALTER TABLE `reset_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_files`
--
ALTER TABLE `temporary_files`
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
-- AUTO_INCREMENT for table `access_lists`
--
ALTER TABLE `access_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bug_reports`
--
ALTER TABLE `bug_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ltu_languages`
--
ALTER TABLE `ltu_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ltu_phrases`
--
ALTER TABLE `ltu_phrases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ltu_translations`
--
ALTER TABLE `ltu_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ltu_translation_files`
--
ALTER TABLE `ltu_translation_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reset_requests`
--
ALTER TABLE `reset_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temporary_files`
--
ALTER TABLE `temporary_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_lists`
--
ALTER TABLE `access_lists`
  ADD CONSTRAINT `access_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bug_reports`
--
ALTER TABLE `bug_reports`
  ADD CONSTRAINT `bug_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ltu_phrases`
--
ALTER TABLE `ltu_phrases`
  ADD CONSTRAINT `ltu_phrases_phrase_id_foreign` FOREIGN KEY (`phrase_id`) REFERENCES `ltu_phrases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ltu_phrases_translation_file_id_foreign` FOREIGN KEY (`translation_file_id`) REFERENCES `ltu_translation_files` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ltu_phrases_translation_id_foreign` FOREIGN KEY (`translation_id`) REFERENCES `ltu_translations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ltu_translations`
--
ALTER TABLE `ltu_translations`
  ADD CONSTRAINT `ltu_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `ltu_languages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
