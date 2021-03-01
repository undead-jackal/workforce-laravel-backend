-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2021 at 03:06 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workflowv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(10) UNSIGNED NOT NULL,
  `applicant` int(11) NOT NULL,
  `applicant_type` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0 COMMENT '0- invited, 1-prorosal',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-pending 1-accepted 2-applied 3-interview scheduled,4- interview today 5-interview beginnin 6-interview started 7- interview cancel 8-invite cancel 9-proposal -cancel,unqualified 10\r\n',
  `job` int(11) NOT NULL,
  `inviter` int(11) DEFAULT NULL,
  `inviter_type` int(11) DEFAULT NULL,
  `proposal` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `applicant`, `applicant_type`, `type`, `status`, `job`, `inviter`, `inviter_type`, `proposal`) VALUES
(1, 46, 1, 0, 1, 38, 30, 2, NULL),
(2, 46, 1, 0, 1, 39, 30, 2, NULL),
(3, 1, 0, 1, 10, 38, NULL, NULL, '<p>tsting</p>'),
(4, 1, 0, 1, 10, 39, NULL, NULL, '<p>tesing</p>'),
(5, 46, 1, 0, 0, 40, 30, 2, NULL),
(6, 46, 1, 0, 0, 41, 30, 2, NULL),
(7, 1, 0, 1, 2, 14, NULL, NULL, '<p>mora</p>');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `group_key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user`, `group_key`, `message`, `type`) VALUES
(1, 46, 'employer-1311998603864c2730223.40708351', 'hrllo', 1),
(2, 46, 'interview-1311998603864faa12600.85264173', 'hello', 1),
(3, 1, 'interview-1311998603864faa12600.85264173', 'hi', 0),
(4, 46, 'undefined', 'hello', 1),
(5, 46, '-1311998603867926a39c9.06029684', 'test', 1),
(6, 46, '-13119986038675d87f361.64707900', 'group2', 1),
(7, 46, 'employer-1311998603864c494e4c8.12532347', 'group 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=freelancer 1=coordinator 2=employer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `username`, `password`, `type`, `created_at`, `updated_at`) VALUES
(1, 'freelancer', '$2y$10$gkDOOKOGwQf7F0HHdYR5C.c0..YgUcnKHhWnzbQzMGLIud.LtibJm', '0', NULL, NULL),
(4, 'freelancer2', '$2y$10$yHoEUuQyH/FOFm3rGPJ/fOnXc.vseaDAsyCBOHM4C/XYSW4TZydYu', '0', NULL, NULL),
(5, 'freelancer3', '$2y$10$sADw3n7YdCetWyDdP63jaeB8xQ.pa/wCGTccPheMDCEVfu7TcUfmG', '0', NULL, NULL),
(6, 'freelancer4', '$2y$10$t95ZlIINl3sUP11BqSjRUuEwFKe/Du2odv6hkMw/Ao68sb6VlMdw2', '0', NULL, NULL),
(27, 'emp1', '$2y$10$qBp.9ClNlXWqVmx7wIWgFO5pMUFB.Vg1TLPfuG3a9ZEGla29iengW', '2', NULL, NULL),
(28, 'janu123', '$2y$10$mjmqlH8cD7l10zNP/7QireHuhgEYCniE/YOMNpxte40mGwM9/klHC', '0', NULL, NULL),
(29, 'janu1234', '$2y$10$pD5YiktxVrnPVOk2PaKhxOqe/06hwF2r1vMOHHOImfFpGKeILBrAC', '0', NULL, NULL),
(30, 'emp2', '$2y$10$0YVJRvAa39te4XJ1/g6wneq9DtjhmKs4viTSDxugDJkO7J5MP9Gkm', '2', NULL, NULL),
(31, 'emp3', '$2y$10$5W67mPCBMx0k95DV2OWCWeDKz0K/MrktY/CJCnBiNx/7FDbyvWyhS', '2', NULL, NULL),
(32, 'levi', '$2y$10$vUXQd3ESRQOvJs7DMWKofOkqPaZZnw.WzA54E/WKNsz8bTGaYQIwq', '0', NULL, NULL),
(35, '12312', '$2y$10$WytW3/htgDdqRqqGscv5he0mH1C7/runueuFaDjMmwyfLJLw5nfo6', '0', NULL, NULL),
(36, 'adwadwa', '$2y$10$ZZXgzdO3450NvG9CTZyUOeD/pzHWG4qLGiE6A6WZvM9HGnWgOY4Y6', '2', NULL, NULL),
(37, '123janu', '$2y$10$02HwWTq5hj/PHQfRIP5ZTuiQkc0gPG4hZcScdEhbJtoXjrSjbvKtq', '2', NULL, NULL),
(38, '123janu', '$2y$10$PvC5kUCPfdGLLw28mkkIeOOrkGpw56zRZxtLfyXMN2oa/4yifFkBi', '2', NULL, NULL),
(39, '123janu', '$2y$10$Q/I39zX2ylsaL1NydXu4ou9iEFQjR5q40.LsjHtgH37h7Ofpk1at.', '2', NULL, NULL),
(40, '123janu', '$2y$10$RHKf5V.8l303okNCSlisrevSSfY3kG5pryDXtDhJr8F0EnER/vEme', '2', NULL, NULL),
(41, '123janu', '$2y$10$V9u4tn7o/VeTbc66BSTDUeI8paNK11TwV3fVh/YDiAaALJJLvQRUi', '2', NULL, NULL),
(42, '123janu', '$2y$10$Yrnark9OCShy.Q1M4tNc/.iWkA2Phs/AbavVWTLwQB/vti9Tk2KLa', '2', NULL, NULL),
(46, 'fe', '$2y$10$7FrdY4gNktBCsriGfB9oe.cs0gAtDUSPETFLWABbJQnpmkUsYitDC', '1', NULL, NULL),
(47, 'eren', '$2y$10$l/7JjT55gQjZMVEAO7ItnOCOthOjK2ocxWsxg3PBxEEl26renXzFy', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee` int(11) NOT NULL,
  `employee_type` int(11) NOT NULL,
  `job` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee`, `employee_type`, `job`, `status`) VALUES
(1, 1, 0, 39, 0),
(2, 1, 0, 38, 0);

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
-- Table structure for table `group_chat`
--

CREATE TABLE `group_chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `application` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_chat`
--

INSERT INTO `group_chat` (`id`, `name`, `job`, `key`, `status`, `application`) VALUES
(1, 'second coordinator testing', 39, '-13119986038675d87f361.64707900', 1, NULL),
(2, 'coordinator-teting1', 38, '-1311998603867926a39c9.06029684', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hired_job`
--

CREATE TABLE `hired_job` (
  `id` int(10) UNSIGNED NOT NULL,
  `freelancer` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` int(11) DEFAULT NULL,
  `coordinator` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interview`
--

CREATE TABLE `interview` (
  `id` int(10) UNSIGNED NOT NULL,
  `applicants` int(11) NOT NULL,
  `reminder` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sched` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`id`, `applicants`, `reminder`, `sched`) VALUES
(29, 62, 'dwadawdaw', '2-22-2021, 04:55 PM'),
(30, 58, 'dwadawd', '2-22-2021, 04:56 PM'),
(31, 60, 'nwnad', '2-22-2021, 05:05 PM'),
(32, 61, 'jkjjkjj', '2-22-2021, 05:10 PM'),
(33, 63, 'w', '2-22-2021, 05:34 PM'),
(34, 65, 'wdada', '2-22-2021, 05:35 PM'),
(35, 67, 'dawdawdawdawd', '2-22-2021, 05:46 PM'),
(36, 68, 'wda', '2-23-2021, 10:06 AM'),
(37, 71, 'dwadw', '2-23-2021, 10:11 AM'),
(38, 72, 'dwadw', '2-23-2021, 10:16 AM'),
(39, 76, 'wadw', '2-23-2021, 10:22 AM'),
(40, 73, 'dwadawd', '2-23-2021, 10:22 AM'),
(41, 75, 'dwadawd', '2-23-2021, 10:22 AM'),
(43, 78, 'dwadwad', '2-23-2021, 02:18 PM'),
(44, 80, 'now', '2-23-2021, 05:05 PM'),
(45, 3, 'dw', '2-26-2021, 11:02 AM'),
(46, 4, 'hjda', '2-26-2021, 11:03 AM');

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `id` int(10) UNSIGNED NOT NULL,
  `invitee_id` int(11) NOT NULL,
  `invitee_type` int(11) DEFAULT NULL,
  `invited_by_id` int(11) DEFAULT NULL,
  `invited_by_type` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = pending,\r\n1=accepted,\r\n2=on interview\r\n3=cancel',
  `job` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invite`
--

INSERT INTO `invite` (`id`, `invitee_id`, `invitee_type`, `invited_by_id`, `invited_by_type`, `status`, `job`, `created_at`, `updated_at`) VALUES
(5, 28, 0, 27, 2, 3, 6, '2021-02-02 02:26:28', '2021-02-02 02:26:28'),
(6, 28, 0, 31, 2, 4, 9, '2021-02-04 02:31:22', '2021-02-04 02:31:22'),
(7, 1, 0, 27, 2, 4, 10, '2021-02-05 05:29:08', '2021-02-05 05:29:08'),
(8, 28, NULL, NULL, NULL, 5, 7, '2021-02-05 09:03:20', '2021-02-05 09:03:20'),
(9, 1, NULL, NULL, NULL, 5, 6, '2021-02-07 04:02:34', '2021-02-07 04:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirements` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `vacant` int(11) NOT NULL,
  `hired_job` int(11) DEFAULT NULL,
  `owner` int(11) NOT NULL,
  `skills` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0 COMMENT '0-open; 1-close',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `coordinator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `title`, `description`, `requirements`, `vacant`, `hired_job`, `owner`, `skills`, `level`, `salary`, `status`, `created_at`, `updated_at`, `coordinator`) VALUES
(14, 'Web DeVeloper PHP', 'Knows PHP', 'must be hard working', 2, 0, 27, '[{\"name\":\"Laravel\",\"code\":\"Lar\",\"rating\":5}]', 0, '60000', 0, '2021-02-11 07:27:00', '2021-02-11 07:27:00', NULL),
(15, 'Content Writer', 'knwo how write content', 'must be good', 10, 0, 27, '[{\"name\":\"Open Source\",\"code\":\"os\",\"rating\":5}]', 1, '10000', 0, '2021-02-11 07:27:50', '2021-02-11 07:27:50', NULL),
(16, 'UI/UX designer', 'ui/ ux ', 'wa', 100, 0, 27, '[{\"name\":\"Web Development\",\"code\":\"Web Dev\",\"rating\":5}]', 1, '10', 0, '2021-02-11 07:28:50', '2021-02-11 07:28:50', NULL),
(17, 'QA Tester', 'more on QA', 'muset be QA', 1, 0, 30, '[{\"name\":\"Open Source\",\"code\":\"os\",\"rating\":4}]', 0, '200000', 0, '2021-02-11 07:31:31', '2021-02-11 07:31:31', NULL),
(18, 'Store Manager', 'managing  Store', 'u know', 20, 0, 30, '[{\"name\":\"Open Source\",\"code\":\"os\",\"rating\":2}]', 0, '1000000', 0, '2021-02-11 07:32:17', '2021-02-11 07:32:17', NULL),
(19, 'Pet Care Taker', 'Takes are of pets', 'more pets', 20, 0, 31, '[{\"name\":\"Javascript\",\"code\":\"js\",\"rating\":3}]', 0, '12000', 0, '2021-02-11 07:34:16', '2021-02-11 07:34:16', NULL),
(20, 'Tester', 'tset', 'tset', 10, 0, 31, '[{\"name\":\"Vue.js\",\"code\":\"vu\",\"rating\":3}]', 0, '0100', 0, '2021-02-11 07:34:55', '2021-02-11 07:34:55', NULL),
(21, 'Coordinator', 'moral', 'moral', 12, 0, 30, '[{\"name\":\"Vue.js\",\"code\":\"vu\",\"rating\":5}]', 1, '17000', 0, '2021-02-15 05:54:30', '2021-02-15 05:54:30', NULL),
(28, 'job test', '<p>testing</p>', '<p>test</p>', 0, 0, 30, '[{\"name\":\"Vue.js\",\"code\":\"vu\",\"rating\":0}]', 0, '1200', 0, '2021-02-19 05:54:54', '2021-02-19 05:54:54', NULL),
(36, 'testing oordinator', '<p>testing</p>', '<p>dwjkafkahwkfja</p>', 0, 0, 30, '[{\"name\":\"Vue.js\",\"code\":\"vu\",\"rating\":4},{\"name\":\"Javascript\",\"code\":\"js\",\"rating\":5}]', 0, '10', 0, '2021-02-23 03:46:03', '2021-02-23 03:46:03', 46),
(37, 'testing approval', '<p>testing</p>', '<p>dnwja</p>', 0, 0, 30, '[{\"name\":\"Javascript\",\"code\":\"js\",\"rating\":5}]', 1, '10000', 0, '2021-02-23 08:39:13', '2021-02-23 08:39:13', 46),
(38, 'coordinator-teting1', '<p>just a testing</p>', '<p>1010101010</p>', 0, 0, 30, '[{\"name\":\"Javascript\",\"code\":\"js\",\"rating\":0},{\"name\":\"Vue.js\",\"code\":\"vu\",\"rating\":5}]', 0, '10', 0, '2021-02-26 02:59:34', '2021-02-26 02:59:34', 46),
(39, 'second coordinator testing', '<p>testing again</p>', '<p>kokoookkooko</p>', 0, 0, 30, '[{\"name\":\"Vue.js\",\"code\":\"vu\",\"rating\":0},{\"name\":\"Javascript\",\"code\":\"js\",\"rating\":0}]', 0, '100', 0, '2021-02-26 03:00:39', '2021-02-26 03:00:39', 46),
(40, 'web dev sample', '<p>sample</p>', '<p>ndowand</p>', 0, 0, 30, '[{\"name\":\"Javascript\",\"code\":\"js\",\"rating\":4}]', 0, '20000', 0, '2021-02-26 05:41:02', '2021-02-26 05:41:02', NULL),
(41, 'Job post sample', '<p>adawadawdawd</p>', '<p>dwadjsfksfka</p>', 0, 0, 30, '[{\"name\":\"Vue.js\",\"code\":\"vu\",\"rating\":4},{\"name\":\"Javascript\",\"code\":\"js\",\"rating\":4},{\"name\":\"Laravel\",\"code\":\"Lar\",\"rating\":5}]', 0, '20000', 0, '2021-02-26 05:43:54', '2021-02-26 05:43:54', NULL);

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
(4, '2021_01_23_173230_create_credentials_table', 2),
(5, '2021_01_23_173735_create_user_freelancers_table', 3),
(6, '2021_01_23_174024_create_user_employer_table', 3),
(7, '2021_01_23_174100_create_user_coordinator_table', 3),
(8, '2021_01_23_174632_create_job_table', 3),
(9, '2021_01_23_174706_create_hired_job_table', 3),
(10, '2021_01_27_044650_create_user_freelancer_table', 4),
(11, '2021_01_27_045215_create_user_freelancer_table', 5),
(12, '2021_01_27_083611_create_job_table', 6),
(13, '2021_01_27_085048_create_job_table', 7),
(14, '2021_01_27_085154_create_job_table', 8),
(15, '2021_01_29_015252_create_user_employer_table', 9),
(16, '2021_02_02_012753_create_invite_table', 10),
(17, '2021_02_02_013310_create_job_table', 10),
(18, '2021_02_02_015420_create_invite_table', 11),
(19, '2021_02_02_060443_create_hired_job_table', 12),
(20, '2021_02_02_060716_create_hired_job_table', 13),
(21, '2021_02_03_062323_create_proposal_table', 14),
(22, '2021_02_04_073819_create_interview_table', 15),
(23, '2021_02_04_084906_create_interview_table', 16),
(24, '2021_02_08_091243_create_application_table', 17),
(25, '2021_02_09_070658_create_interview_table', 18),
(26, '2021_02_09_095545_create_employee_table', 19),
(27, '2021_02_10_055534_create_group_chat_table', 20),
(28, '2021_02_10_055729_create_chat_table', 20),
(29, '2021_02_11_061959_create_solo_chat_table', 21),
(30, '2021_02_14_040429_add_data_to_user_freelancer', 22),
(31, '2021_02_15_032810_add_data_to_user_coordinator_table', 23),
(32, '2021_02_15_034935_add_data2_to_user_coordinator_table', 24),
(33, '2021_02_15_054025_add_data_to_job_table', 25),
(34, '2021_02_22_060950_add_data2_to_group_chat_table', 26),
(35, '2021_02_22_061152_add_data2_to_solo_chat_table', 26);

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
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id` int(10) UNSIGNED NOT NULL,
  `proposal` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `freelancer` int(11) NOT NULL,
  `job` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `proposal`, `freelancer`, `job`, `status`, `created_at`, `updated_at`) VALUES
(9, 'i will make it', 28, 7, 5, '2021-02-03 09:00:17', '2021-02-03 09:00:17'),
(10, 'adadadawdad', 28, 8, 4, '2021-02-03 09:02:29', '2021-02-03 09:02:29'),
(11, 'Just trust me iam super', 1, 9, 4, '2021-02-04 06:11:46', '2021-02-04 06:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `solo_chat`
--

CREATE TABLE `solo_chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `application` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `solo_chat`
--

INSERT INTO `solo_chat` (`id`, `name`, `job`, `user`, `key`, `status`, `application`) VALUES
(1, 'coordinator-teting1', 38, 30, 'employer-1311998603864c2730223.40708351', 0, 1),
(2, 'second coordinator testing', 39, 30, 'employer-1311998603864c494e4c8.12532347', 0, 2),
(3, 'second coordinator testing - cal Kakaka', 39, 1, 'interview-1311998603864faa12600.85264173', 3, 4),
(4, 'coordinator-teting1 - cal Kakaka', 38, 1, 'interview-13119986038678871f252.45826401', 3, 3);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_coordinator`
--

CREATE TABLE `user_coordinator` (
  `id` int(10) UNSIGNED NOT NULL,
  `credential` int(11) NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sss` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pagibig` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `philhealth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contacts` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `emails` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `langauge` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_coordinator`
--

INSERT INTO `user_coordinator` (`id`, `credential`, `fname`, `lname`, `created_at`, `updated_at`, `address`, `bday`, `sss`, `pagibig`, `philhealth`, `tin`, `contacts`, `emails`, `langauge`, `description`) VALUES
(5, 46, 'enricke', 'coordinator', NULL, NULL, 'fdsfsdfa', NULL, NULL, NULL, NULL, NULL, '[]', '[]', 'null', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_employer`
--

CREATE TABLE `user_employer` (
  `id` int(10) UNSIGNED NOT NULL,
  `credential` int(11) NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `emails` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_employer`
--

INSERT INTO `user_employer` (`id`, `credential`, `fname`, `lname`, `contact`, `emails`, `company`, `company_address`, `created_at`, `updated_at`) VALUES
(10, 27, 'employer1', 'Morales', '[\"09956371866\"]', '[\"enrickejanu@gmail.com\"]', 'Codingfork', 'Brgy Luz Cebu City', NULL, NULL),
(11, 30, 'employer2', 'Morales', '[\"dwada\"]', '[\"enricke@photoandvideoedits.com\"]', 's', 'Barangay Luz', NULL, NULL),
(12, 31, 'employer3', 'Morales', '[\"w\"]', '[\"enricke@photoandvideoedits.com\"]', '2', 'Barangay Luz', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_freelancer`
--

CREATE TABLE `user_freelancer` (
  `id` int(10) UNSIGNED NOT NULL,
  `credential` int(11) NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `contacts` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emails` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employement` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sss` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pagibig` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `philhealth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_freelancer`
--

INSERT INTO `user_freelancer` (`id`, `credential`, `fname`, `lname`, `bday`, `is_deleted`, `level`, `contacts`, `emails`, `work`, `education`, `skills`, `created_at`, `updated_at`, `description`, `employement`, `sss`, `tin`, `pagibig`, `philhealth`, `address`) VALUES
(4, 28, 'Enricke Janu', 'Morales', 'Jan 311998', 0, 2, '[\"09956371866\"]', '[\"enrickejanu@gmail.com\"]', '[]', '[{\"name\":\"Brgy Luz\",\"level\":\"Primary Education\",\"status\":\"Graduated\",\"year\":\"2004-2010\"},{\"name\":\"Apas National High School\",\"level\":\"Secondary Education\",\"status\":\"Graduated\",\"year\":\"2010-2014\"},{\"name\":\"Uc main\",\"level\":\"Tertiary Education\",\"status\":\"Under Graduate\",\"year\":\"2014-2019\"}]', '[{\"name\":\"Vue.js\",\"code\":\"vu\",\"rating\":5},{\"name\":\"Javascript\",\"code\":\"js\",\"rating\":5},{\"name\":\"Laravel\",\"code\":\"Lar\",\"rating\":5}]', NULL, NULL, '', '', '', '', '', '', ''),
(5, 29, 'justtesting', 'testerlan', 'jan 311998', 0, 1, '[\"099563718666\"]', '[\"enricke@photoandvideoedits.com\"]', '[]', '[]', '[{\"name\":\"Vue.js\",\"code\":\"vu\",\"rating\":4},{\"name\":\"Laravel\",\"code\":\"Lar\",\"rating\":1},{\"name\":\"Javascript\",\"code\":\"js\",\"rating\":2}]', NULL, NULL, '', '', '', '', '', '', ''),
(6, 1, 'cal', 'Kakaka', 'Jan 311998', 0, 2, '[\"09956371866\"]', '[\"enrickejanu@gmail.com\"]', '[]', '[{\"name\":\"Brgy Luz\",\"level\":\"Primary Education\",\"status\":\"Graduated\",\"year\":\"2004-2010\"},{\"name\":\"Apas National High School\",\"level\":\"Secondary Education\",\"status\":\"Graduated\",\"year\":\"2010-2014\"},{\"name\":\"Uc main\",\"level\":\"Tertiary Education\",\"status\":\"Under Graduate\",\"year\":\"2014-2019\"}]', '[{\"name\":\"Vue.js\",\"code\":\"vu\",\"rating\":5},{\"name\":\"Javascript\",\"code\":\"js\",\"rating\":5},{\"name\":\"Laravel\",\"code\":\"Lar\",\"rating\":5}]', NULL, NULL, '', '', '', '', '', '', ''),
(7, 33, 'levi', 'ackermsn', NULL, 0, 1, '[]', '[]', 'N/A', '[]', '[]', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 'wda'),
(8, 34, 'dwawdwa', 'dwaddw', NULL, 0, 1, '[]', '[]', 'N/A', '[]', '[]', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 'dwwwwwwwwwwwwww'),
(9, 35, 'dwa', 'dwa', NULL, 0, 0, '[]', '[]', 'N/A', '[]', '[]', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 'dwad'),
(10, 47, 'Eren', 'Yeager', NULL, 0, 0, '[\"0921981231\"]', '[\"enricke@photoandvideoedits.com\"]', 'N/A', '[]', '[{\"name\":\"Javascript\",\"code\":\"js\",\"rating\":4},{\"name\":\"Vue.js\",\"code\":\"vu\",\"rating\":4},{\"name\":\"Codeigniter\",\"code\":\"co\",\"rating\":5}]', NULL, NULL, '<p>Somethings</p>', '[]', NULL, NULL, NULL, NULL, 'wall');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `group_chat`
--
ALTER TABLE `group_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hired_job`
--
ALTER TABLE `hired_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interview`
--
ALTER TABLE `interview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solo_chat`
--
ALTER TABLE `solo_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_coordinator`
--
ALTER TABLE `user_coordinator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_employer`
--
ALTER TABLE `user_employer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_freelancer`
--
ALTER TABLE `user_freelancer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_chat`
--
ALTER TABLE `group_chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hired_job`
--
ALTER TABLE `hired_job`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `interview`
--
ALTER TABLE `interview`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `solo_chat`
--
ALTER TABLE `solo_chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_coordinator`
--
ALTER TABLE `user_coordinator`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_employer`
--
ALTER TABLE `user_employer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_freelancer`
--
ALTER TABLE `user_freelancer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
