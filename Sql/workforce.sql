-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 05:21 AM
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
-- Database: `workforce`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(10) UNSIGNED NOT NULL,
  `applicant` int(11) NOT NULL,
  `applicant_type` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-pending 1-accepted 2-applied 3-interview scheduled,4- interview today 5-interview beginnin 6-interview started 7- interview cancel 8-invite cancel 9-proposal -cancel,unqualified 10',
  `job` int(11) NOT NULL,
  `inviter` int(11) DEFAULT NULL,
  `inviter_type` int(11) DEFAULT NULL,
  `proposal` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `applicant`, `applicant_type`, `type`, `status`, `job`, `inviter`, `inviter_type`, `proposal`, `created_at`, `updated_at`) VALUES
(126, 44, 0, 1, 7, 14, NULL, NULL, '<p>dwadad</p>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `group_key` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee` int(11) NOT NULL,
  `employee_type` int(11) DEFAULT NULL,
  `job` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `doing` int(11) NOT NULL DEFAULT 0,
  `payment` decimal(10,2) NOT NULL DEFAULT 0.00,
  `totalHours` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee`, `employee_type`, `job`, `status`, `created_at`, `updated_at`, `doing`, `payment`, `totalHours`) VALUES
(16, 44, NULL, 14, 0, '2021-05-20 08:16:05', '2021-05-20 08:16:05', 0, '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_log`
--

CREATE TABLE `employee_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `job` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0:break; 1:inprogress\r\n; 2:end',
  `time_stepped` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_log`
--

INSERT INTO `employee_log` (`id`, `user`, `job`, `status`, `time_stepped`, `created_at`, `updated_at`, `pays`) VALUES
(20, 60, 14, 1, '1.0875', '2021-05-18 04:01:42', '2021-05-17 21:07:00', '65.25'),
(21, 60, 14, 1, '0.0003', '2021-05-18 05:18:59', '2021-05-17 21:19:00', '0.02'),
(22, 60, 14, 1, '0.0042', '2021-05-18 05:31:20', '2021-05-17 21:31:35', '0.25'),
(23, 60, 15, 1, '0.0025', '2021-05-18 06:37:32', '2021-05-17 22:37:41', '0.15');

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
-- Table structure for table `interview`
--

CREATE TABLE `interview` (
  `id` int(10) UNSIGNED NOT NULL,
  `applicants` int(11) NOT NULL,
  `reminder` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sched` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`id`, `applicants`, `reminder`, `sched`, `created_at`, `updated_at`) VALUES
(66, 126, NULL, '2021-05-20T08:15:00.000Z', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirement` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `skills` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `coordinator` int(11) DEFAULT NULL,
  `owner` int(11) NOT NULL,
  `hourlyRate` int(11) DEFAULT NULL,
  `fixedRate` int(11) DEFAULT NULL,
  `paymentType` int(11) DEFAULT NULL,
  `minHour` int(11) DEFAULT NULL,
  `maxHour` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `title`, `description`, `requirement`, `skills`, `level`, `status`, `coordinator`, `owner`, `hourlyRate`, `fixedRate`, `paymentType`, `minHour`, `maxHour`) VALUES
(14, 'BRIDGE SYSTEM ENGINEER', '<p>Job Role:</p><ul><li>He/She will assist in ensuring that each member delegated to him are able to achieve his/her assigned targets.&nbsp;</li><li>He/She will be responsible for understanding a project\'s target, and ensuring that said goals are properly disseminated to the project\'s members.&nbsp;</li><li>He/She will be included in the basic designing of system documentation, consultation, and ensuring that all parties involved are well informed.</li><li>He/she will be a contact point between the offshore and onshore development teams</li></ul><p>Benefits:</p><ul><li>Monthly Incentives (Performance, Attendance, etc.)</li><li>Meal and Transportation Allowance</li><li>Private Health Insurance</li><li>Leaves are convertible to cash, annual increase and bonuses</li><li>Events and activities (Badminton, Basketball, Movie marathon, Billiards and etc.)</li><li>Incentives for JLPT passers (N1-N4)</li><li>Bereavement Assistance</li><li>Calamity Assistance</li><li>Referral Incentive</li><li>Incentives for ISTQB passers&nbsp;&nbsp;&nbsp;</li></ul><p><br></p>', '<ul><li>Candidate must have Bachelor\'s/College Degree in Computer Science/Information Technology or equivalent.</li><li>Has good communication skills</li><li>Has a decent understanding of system development designs</li><li>Knows how to convert client specifications to well defined, and understandable system specifications</li><li>Knowledge in Japanese language is an advantage</li></ul><p><br></p>', '[{\"name\":\"Javascript\",\"code\":\"js\"},{\"name\":\"brdige system\",\"code\":\"br7996464\",\"rating\":0}]', 1, 0, NULL, 43, 60, 0, 1, 0, 0),
(17, 'Front-End Developer', '<p>Golden Great Peak English Inc.&nbsp;is a corporation duly organized and existing under Philippine laws having been issued a Certificate of Incorporation by the Securities and Exchange Commission on October 28, 2014, with office address at Unit 3 ABC, 3F, JDN Square, P. Remedio St., Banilad, Mandaue City</p><p>&nbsp;</p><p>Golden Great Peak English Inc.&nbsp;is engaged in the business of operating an export business outsourcing enterprise for tutorial in the English language for foreignindividuals abroad, particularly, those in Japan through telephone and internet, without operating a school engaged in the business of English as Second Language for foreign clients.</p><p><br></p>', '<ul><li>Professional experience as a front-end developer</li><li>Advanced expertise in HTML, CSS, javascript, JQuery</li><li>Knowledge of UI/UX application</li><li>Must have a good command of the English language</li><li>Can start ASAP&nbsp;</li></ul><p><br></p>', '[{\"name\":\"Javascript\",\"code\":\"js\"},{\"name\":\"Open Source\",\"code\":\"os\"},{\"name\":\"Vue.js\",\"code\":\"vu\"}]', 1, 0, NULL, 43, 0, 0, 0, 0, 0);

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_03_31_031337_create_user_credentials_table', 1),
(4, '2021_04_03_050522_create_user_info_table', 2),
(5, '2021_04_03_052948_create_job_table', 3),
(6, '2021_04_03_061445_create_job_table', 4),
(7, '2021_04_03_062032_create_job_table', 5),
(8, '2021_04_05_021052_create_application_table', 6),
(9, '2021_04_05_033605_create_interview_table', 7),
(10, '2021_04_05_061250_create_employee_table', 8),
(11, '2021_04_05_092210_add_data_to_user_info_table', 9),
(12, '2021_04_06_053627_add_data1_to_user_info_table', 10),
(13, '2021_04_11_060512_create_solo_chat_table', 11),
(14, '2021_04_11_063859_add_data_to_solo_chat_table', 12),
(15, '2021_04_11_071331_create_chat_table', 13),
(16, '2021_04_19_075526_create_notification_table', 14),
(17, '2021_04_19_080257_add_datas_to_notification_table', 15),
(18, '2021_04_19_082438_add_datas2_to_notification_table', 15),
(19, '2021_04_20_034617_create_notification_table', 16),
(20, '2021_04_20_035822_add_data_to_notification_table', 17),
(21, '2021_04_22_063923_add_another_to_job_table', 18),
(22, '2021_04_23_085319_add_more_data_to_employee_table', 19),
(23, '2021_04_26_015112_create_employee_log_table', 20),
(24, '2021_04_27_080715_add_one_to_employee_log_table', 21),
(25, '2021_04_30_040700_add_image_to_user_info_table', 22),
(26, '2021_05_06_040503_create_user_settings_table', 23),
(27, '2021_05_08_093340_add_current_profile_to_user_settings_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `from`, `to`, `type`, `status`) VALUES
(68, 44, 14, 'Application', 0),
(69, 44, 14, 'Application', 0);

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
-- Table structure for table `solo_chat`
--

CREATE TABLE `solo_chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `job` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `key` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `solo_chat`
--

INSERT INTO `solo_chat` (`id`, `job`, `user`, `key`, `status`, `created_at`, `updated_at`, `title`, `application`) VALUES
(52, 14, 44, 'interview-131199860a61ac0c4b2d0.48859770', 0, NULL, NULL, 'BRIDGE SYSTEM ENGINEER', 126);

-- --------------------------------------------------------

--
-- Table structure for table `user_credentials`
--

CREATE TABLE `user_credentials` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logintoken` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_credentials`
--

INSERT INTO `user_credentials` (`id`, `username`, `password`, `logintoken`, `role`, `created_at`, `updated_at`) VALUES
(1, 'gem', '$2y$10$iM91DZ3SkxIHjYoYmuA9Zu.d85s5Nhmw4D2p5WmOgEj3.mc/D5082', 'workforce-607e863fbf2736.71731400', 0, NULL, NULL),
(43, 'EmployerTest1', '$2y$10$62Iu.jBJEoQ5jmzW9mf5I.T3rr9ts2hUR//qCtxXyFT3ivZH/yleO', 'workforce-60726ea2dcece8.25324923', 2, NULL, NULL),
(44, 'IamIronMan', '$2y$10$7FXawhy1n0Zy1hDHGtDwTOMVF72Szdgq2nil7ryp5Bshbh.Hojwd.', 'workforce-607270238d9c37.69033285', 0, NULL, NULL),
(45, '123', '$2y$10$UE0P6.tUv.Qk21.Ao5H9yeWdjI.5JlO5OilGOS1MAwims4Mz7fDAC', 'workforce-6076a93dd11b61.16138453', 0, NULL, NULL),
(46, '123Banner', '$2y$10$dDFtyC9e6ctsvieGcktrK.6NadsbToCnSSljA5mtRg897GVjDHgnm', 'workforce-607e314542ad21.13324633', 2, NULL, NULL),
(47, '123@barnes', '$2y$10$AkT.ylUNMS4URWQei5V9lOv4MnN4gdDJQKp52A1vOWyvzqza1Ocgm', 'workforce-607e321489a274.93756887', 0, NULL, NULL),
(48, 'Cap@123', '$2y$10$tCNSV20uTkkdLlV0cQwpVurLD4wF7biVtrxNg0wtLeabkdNqFbjGm', 'workforce-6094fdab125d82.58499785', 0, NULL, NULL),
(49, 'ScarletWitch', '$2y$10$K0K.YpEhbP14azQBYmDU4O5iaQUYRJK/uC7i6OtnpKwplL69FvTLu', 'workforce-60965dc7785a64.22959990', 0, NULL, NULL),
(50, 'test@test', '$2y$10$4.UJc8.fS8lTN38YizWrmewTlIlgzNut68BPGGGtFNOs6zLFDiVQu', 'workforce-609a36c053f0c9.73152284', 0, NULL, NULL),
(51, 'Spiderman', '$2y$10$IehAr77M94Y7gX5P2hrJZeZsI1iYJbmzXDfjIz.gv0rAsgYRaETe6', 'workforce-609a38559ef554.12584881', 0, NULL, NULL),
(52, 'QuickSilver', '$2y$10$K1UjGpI5sI3A78NCBhca/umDWblmmncyYmwIsQnFhafn54tCqdTxK', 'workforce-609a39259c2b68.27357802', 0, NULL, NULL),
(53, '123test', '$2y$10$UXHaqDKZO8NWlS/KZto7MOJHdatPkCZpanYQCoKobQT/TqWVfakbG', 'workforce-609b2e755a76b3.31144436', 0, NULL, NULL),
(55, 'qwe123', '$2y$10$rqBlxvv7Igu8ql7CkIYikucvMJGC7JMpAlXNEPygG0GcFN9Vl4l0G', 'workforce-60a0783f858313.61043130', 0, NULL, NULL),
(56, 'lastlast', '$2y$10$g0.o76.KxJlfcoohMS9a8edXg9j8Djug59OW4Wspoc1ui.ok7Qp2y', 'workforce-60a0adfa1cbd90.28878456', 0, NULL, NULL),
(57, 'emp2021', '$2y$10$SJM5sz8SOYW8Rsc.Q55azuItZBvyvKrFxNoRrzqhvB538Xl5NpiYa', 'workforce-60a0b8447a1d85.31668800', 2, NULL, NULL),
(58, 'test111', '$2y$10$YLkdJG/1N1S1RTl12zSyFOSN.GoEEFJlVJzr4URUAszMPyn2CdIbm', 'workforce-60a32d18029503.70064995', 0, NULL, NULL),
(59, '123', '$2y$10$foeJgod.RZRWTik9yXlyIO1XhRNAbq5iwv4DXrfsaWNFHkQuCXTA2', 'workforce-60a32d861a0126.71284950', 0, NULL, NULL),
(60, 'jmorales', '$2y$10$ouVcQVJixz9jZ63cuCP3QuZ9WDuDIN75Iuo0uHGY7l6YWv.lXLcLa', 'workforce-60a33b890e01b0.19546042', 0, NULL, NULL),
(61, '123Freelancer', '$2y$10$sKeR1c2kgSJ68prvS07EcepXMrTDCZn7QMDGdRzruBA4JYz5tPXyK', 'workforce-60a49dad68f099.05575566', 0, NULL, NULL),
(62, 'se@23', '$2y$10$DV81qpfhrP0e/E826/Hqce5Nd6hdNLtT4VlFym8tYusSFYGU6EVJ.', 'workforce-60a4c49f100c09.76773943', 0, NULL, NULL),
(63, 'awd@awd', '$2y$10$6XZmnuK7htiiyuap/J/GkO06w.lNK6Pvj.Lezx5eSTjlZu33wYoMS', 'workforce-60a4c4e071c149.10171322', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credential` int(11) NOT NULL,
  `bday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contacts` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emails` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `languages` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sss` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `philhealth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pagibig` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_contact` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_Deleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `fname`, `lname`, `credential`, `bday`, `contacts`, `emails`, `languages`, `sss`, `philhealth`, `pagibig`, `tin`, `work`, `education`, `employment`, `skills`, `description`, `level`, `company`, `company_address`, `company_email`, `company_contact`, `is_Deleted`, `created_at`, `updated_at`, `status`, `address`, `profile`) VALUES
(18, 'Steve', 'Roger', 43, NULL, '[\"0921894124812-\",\"dwa12\",\"dwadw\",\"dwad\"]', '[\"ef;sjf;jefjsefsejf\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Centrality', 'Hello', '[\"dwadaw\"]', '[\"dwadawd\",\"dwada\"]', 0, NULL, NULL, 1, 'Brooklyn', 'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'),
(19, 'Tony', 'Start', 44, NULL, '902381947184', 'ericke@janu', NULL, 'dwadawdawddw', NULL, NULL, 'dwakjdjawd', NULL, '[{\"name\":\"dawjkdawkjd\",\"cour\":\"wjdkajhdkjhad\"}]', NULL, '[{\"name\":\"Javascript\",\"code\":\"js\"}]', '<p>dwadadadada</p>', '0', NULL, NULL, 'null', 'null', 0, NULL, NULL, 3, 'dwadajwhdawd', 'https://cdn.image4.io/jackal/33d883a3-3ae6-4d5d-a36a-9d7a021cffd7.jpeg'),
(20, 'hoho', 'ohoho', 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'),
(21, 'Bruce', 'Banner', 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'),
(22, 'Bucky', 'Barnes', 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'),
(24, 'Gemma', 'Mondragon', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'),
(25, 'Steve', 'Roger', 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'),
(26, 'Wanda', 'Maximo', 49, NULL, '[\"wdadawd\",\"dwada\",\"wdawd\"]', '[\"dwadawda\",\"dwada\"]', 'undefined', '1231231231', 'undefined', 'undefined', 'null', NULL, 'null', 'undefined', '[{\"name\":\"Open Source\",\"code\":\"os\"},{\"name\":\"Javascript\",\"code\":\"js\"}]', '<p>2131231231</p>', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 3, 'dwadawdawd', 'https://cdn.image4.io/jackal/74d8ed18-dbef-42ef-a5aa-ed2e4e787481.png'),
(27, 'Test1', 'tester1', 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 2, NULL, 'https://cdn.image4.io/jackal/72a846cb-19e8-4f14-ad43-3df80e933519.jpeg'),
(28, 'peter', 'parker', 51, NULL, 'wadawdawda', 'dwadawdawd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"name\":\"Open Source\",\"code\":\"os\"},{\"name\":\"Javascript\",\"code\":\"js\"}]', '<p>dwadawdawdjljk</p>', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 3, 'dwadawda', 'https://cdn.image4.io/jackal/665ef331-0597-4a0c-9766-76f0bb170dc7.jpeg'),
(29, 'petro', 'maximof', 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'undefined', '[]', '<p>wdadwada</p>', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 3, NULL, 'https://cdn.image4.io/jackal/1b7c23c0-8020-4d16-a855-d9be15112778.jpeg'),
(30, 'fretester', 'teste', 53, NULL, 'DWAD', 'AWDAWDAW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"name\":\"Open Source\",\"code\":\"os\"},{\"name\":\"Javascript\",\"code\":\"js\"}]', '<p>DADWADAD</p>', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 3, 'DWADWADAW', 'https://cdn.image4.io/jackal/2f01afc2-74e8-4934-9ffa-1bcf8a692ffa.jpeg'),
(31, '123test', '123test', 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'),
(32, 'wqe', 'qwe', 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'),
(33, 'last', 'last', 56, NULL, 'dwad', 'wadawda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"name\":\"Open Source\",\"code\":\"os\"}]', '<p>dwadawdaw</p>', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 3, 'dawawdawd', 'https://cdn.image4.io/jackal/7c75b6de-716d-4b9b-bc75-ade21f8a4fcb.png'),
(34, 'emp123', '123', 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'),
(35, 'usertest', 'test', 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'),
(36, 'UserTest123', '123', 59, NULL, '123', '1231231@123123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"name\":\"Javascript\",\"code\":\"js\"},{\"name\":\"Open Source\",\"code\":\"os\"}]', '<p>wdadadwdw</p>', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 2, 'wdadwadwa', 'https://cdn.image4.io/jackal/44979b03-b92c-429e-b121-61a88a15ea7a.jpeg'),
(37, 'janu', 'morales', 60, NULL, 'dawdawd', 'wadwadw@awdawda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"name\":\"Open Source\",\"code\":\"os\"}]', '<p>dwadawda</p>', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 3, 'wdadawda', 'https://cdn.image4.io/jackal/8025089c-36a2-4cf5-85b2-fd364961a9d8.jpeg'),
(38, 'testerFreel', '123', 61, NULL, 'jkshdjhashdkasd', 'askjdlasjdlkjsk@kadjdlkjla', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"company\":\"wdada\",\"duration\":\"dadawd\",\"position\":\"dwadawd\"},{\"company\":\"dawdawd\",\"duration\":\"dwadawd\",\"position\":\"dwada\"}]', '[{\"name\":\"Javascript\",\"code\":\"js\"},{\"name\":\"Vue.js\",\"code\":\"vu\"}]', '<p>ajdkjaksjalksjdlajlsdjak</p>', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 3, 'dbahdgjawda', 'https://cdn.image4.io/jackal/84b1cf12-63dc-494f-a784-085c209cb5b2.jpeg'),
(39, 'sese', 'ese', 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 'https://cdn.image4.io/jackal/f_auto/workforce/system/9c7f9c2b-e2c8-4463-ae68-3ebcfb8863ad.png'),
(40, 'dwa', 'awd', 63, NULL, 'dwadawda', 'dwadawdawd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"company\":\"dwadada\",\"duration\":\"dwaadawdwa\",\"position\":\"dwadwadawd\"}]', '[{\"name\":\"Vue.js\",\"code\":\"vu\"}]', '<p>dwhakhdkjahad</p>', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 2, 'dadawdawd', 'https://cdn.image4.io/jackal/03b8d5af-dec3-4f02-8924-7a5718442201.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `manual` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profileStats` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`id`, `user`, `manual`, `created_at`, `updated_at`, `profileStats`) VALUES
(1, 48, 0, NULL, NULL, '{\"cover\":1,\"profile\":1,\"personal\":1,\"skill\":1}'),
(2, 43, 1, NULL, NULL, '{\"cover\":1,\"profile\":1,\"personal\":1,\"skill\":1}'),
(4, 44, 1, NULL, NULL, '{\"cover\":1,\"profile\":1,\"personal\":1,\"skill\":1}'),
(5, 49, 1, NULL, NULL, '{\"cover\":1,\"profile\":1,\"personal\":1,\"skill\":1}'),
(6, 50, 0, NULL, NULL, '{\"cover\":0,\"profile\":0,\"personal\":0,\"skill\":0}'),
(7, 51, 1, NULL, NULL, '{\"cover\":1,\"profile\":1,\"personal\":1,\"skill\":1}'),
(8, 52, 0, NULL, NULL, '{\"cover\":0,\"profile\":1,\"personal\":0,\"skill\":0}'),
(9, 53, 1, NULL, NULL, '{\"cover\":1,\"profile\":1,\"personal\":1,\"skill\":1}'),
(10, 54, 0, NULL, NULL, '{\"cover\":0,\"profile\":0,\"personal\":0,\"skill\":0}'),
(11, 55, 0, NULL, NULL, '{\"cover\":0,\"profile\":0,\"personal\":0,\"skill\":0}'),
(12, 56, 1, NULL, NULL, '{\"cover\":1,\"profile\":1,\"personal\":1,\"skill\":1}'),
(13, 57, 1, NULL, NULL, '{\"cover\":0,\"profile\":0,\"personal\":0,\"skill\":0}'),
(14, 58, 0, NULL, NULL, '{\"cover\":0,\"profile\":0,\"personal\":0,\"skill\":0}'),
(15, 59, 1, NULL, NULL, '{\"cover\":1,\"profile\":0,\"personal\":1,\"skill\":1}'),
(16, 60, 1, NULL, NULL, '{\"cover\":1,\"profile\":1,\"personal\":1,\"skill\":1}'),
(17, 61, 1, NULL, NULL, '{\"cover\":1,\"profile\":1,\"personal\":1,\"skill\":1}'),
(18, 62, 0, NULL, NULL, '{\"cover\":0,\"profile\":0,\"personal\":0,\"skill\":0}'),
(19, 63, 1, NULL, NULL, '{\"cover\":1,\"profile\":1,\"personal\":1,\"skill\":1}');

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
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_log`
--
ALTER TABLE `employee_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `interview`
--
ALTER TABLE `interview`
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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `solo_chat`
--
ALTER TABLE `solo_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_credentials`
--
ALTER TABLE `user_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employee_log`
--
ALTER TABLE `employee_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interview`
--
ALTER TABLE `interview`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `solo_chat`
--
ALTER TABLE `solo_chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user_credentials`
--
ALTER TABLE `user_credentials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
