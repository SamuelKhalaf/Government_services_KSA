-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2025 at 06:34 PM
-- Server version: 8.0.43-0ubuntu0.24.04.1
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch_commercial_registrations`
--

CREATE TABLE `branch_commercial_registrations` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `branch_reg_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_cr_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorized_capital` decimal(15,2) NOT NULL,
  `manager_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_activity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` date NOT NULL,
  `legal_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issuing_authority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `activities_list` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `certificate_file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','expired','suspended','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `enable_reminder` tinyint(1) NOT NULL DEFAULT '0',
  `reminder_days` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch_commercial_registrations`
--

INSERT INTO `branch_commercial_registrations` (`id`, `company_id`, `branch_reg_number`, `parent_cr_number`, `branch_type`, `authorized_capital`, `manager_name`, `manager_id_number`, `manager_nationality`, `manager_position`, `branch_activity`, `registration_date`, `legal_form`, `issuing_authority`, `issue_date`, `expiry_date`, `activities_list`, `notes`, `certificate_file_path`, `status`, `enable_reminder`, `reminder_days`, `created_at`, `updated_at`) VALUES
(1, 2, '962', '928', 'regional_office', 30.00, 'Kyra Cote', '358', 'Id et omnis unde con', 'Autem facilis dolore', 'Magna rerum ipsam fu', '1976-11-23', 'LLC', 'Consequat Culpa id', '1973-11-01', '1994-07-02', 'Officia hic elit et', 'Dolor veniam at lab', NULL, 'active', 1, 30, '2025-08-30 02:38:09', '2025-09-16 22:00:29'),
(2, 4, '770', '41', 'regional_office', 54.00, 'Lana Peck', '227', 'Eaque ut in architec', 'Quo id quia optio a', 'Culpa impedit reru', '1995-10-23', 'LLC', 'Aut proident exerci', '1988-11-02', '2029-10-30', 'Eu consequatur do d', 'Quis ut amet offici', 'company_documents/4/branch_registration/1756565403_branch_reg_laravel.jpg', 'active', 1, 12, '2025-08-30 11:50:03', '2025-09-16 21:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `civil_defense_licenses`
--

CREATE TABLE `civil_defense_licenses` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `authority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_classification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_area` decimal(10,2) NOT NULL,
  `floors` int NOT NULL,
  `facility_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `safety_status` enum('compliant','non_compliant','pending','under_review') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `inspection_status` enum('passed','failed','pending','not_required') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `last_inspection_date` date DEFAULT NULL,
  `next_inspection_date` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `certificate_file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','expired','suspended','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `enable_reminder` tinyint(1) NOT NULL DEFAULT '0',
  `reminder_days` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `civil_defense_licenses`
--

INSERT INTO `civil_defense_licenses` (`id`, `company_id`, `license_number`, `issue_date`, `expiry_date`, `authority`, `activity_classification`, `total_area`, `floors`, `facility_type`, `safety_status`, `inspection_status`, `last_inspection_date`, `next_inspection_date`, `notes`, `certificate_file_path`, `status`, `enable_reminder`, `reminder_days`, `created_at`, `updated_at`) VALUES
(1, 2, '546', '2021-07-04', '2022-03-11', 'Aliquip laudantium', 'Pariatur Dolor dolo', 30.00, 20, 'other', 'compliant', 'pending', '2000-03-16', '2000-12-14', 'Velit consequatur d', NULL, 'active', 1, 30, '2025-08-30 02:20:48', '2025-09-16 22:00:03'),
(2, 3, '435', '1972-04-27', '2017-06-01', 'Est commodi consequa', 'Nihil voluptas adipi', 66.00, 71, 'residential', 'compliant', 'failed', '1985-09-22', '2022-01-14', 'Asperiores ipsam lab', NULL, 'active', 1, 22, '2025-08-30 08:58:49', '2025-09-16 21:58:51'),
(3, 4, '123412', '1973-09-26', '1981-01-21', 'Exercitation quo nob', 'Omnis fugit lorem o', 58.00, 25, 'office', 'non_compliant', 'passed', '2017-11-19', '2018-06-13', 'Ipsum non sequi id', NULL, 'active', 1, 15, '2025-08-30 11:29:27', '2025-09-16 21:57:14'),
(4, 7, '347', '2013-01-11', '2014-06-18', 'Ut aute iusto ration', 'Aut officia quisquam', 19.00, 58, 'restaurant', 'non_compliant', 'failed', '2008-03-11', '2013-11-07', 'Rem voluptatem nisi', NULL, 'active', 1, 18, '2025-09-12 20:40:45', '2025-09-16 21:58:24'),
(5, 4, '45', '2009-03-12', '2010-07-14', 'Totam aut dolor offi', 'Dicta tempora impedi', 23.00, 94, 'office', 'under_review', 'pending', '1990-09-26', '2017-06-06', 'Quidem ex voluptatem', NULL, 'active', 1, 25, '2025-09-12 21:06:18', '2025-09-16 21:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `client_packages`
--

CREATE TABLE `client_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `package_id` bigint UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','expired','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_packages`
--

INSERT INTO `client_packages` (`id`, `client_id`, `package_id`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '2024-09-08', '2026-09-08', 'active', '2025-09-08 01:02:40', '2025-09-12 21:04:47'),
(4, 6, 1, '2025-09-13', '2026-09-13', 'active', '2025-09-12 21:05:28', '2025-09-12 21:05:28'),
(5, 4, 1, '2025-09-13', '2026-09-13', 'active', '2025-09-12 21:05:50', '2025-09-12 21:05:50'),
(6, 2, 1, '2025-09-16', '2026-09-16', 'active', '2025-09-16 19:00:03', '2025-09-16 19:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `company_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cr_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `establishment_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isic_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_location` text COLLATE utf8mb4_unicode_ci,
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `legal_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `establishment_date` date NOT NULL,
  `capital_amount` decimal(15,2) DEFAULT NULL,
  `status` enum('active','inactive','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name_ar`, `company_name_en`, `cr_number`, `establishment_number`, `license_number`, `tax_number`, `company_type`, `isic_code`, `phone`, `email`, `website`, `region`, `city`, `district`, `street`, `building_number`, `postal_code`, `additional_location`, `owner_name`, `owner_id_number`, `owner_nationality`, `legal_status`, `establishment_date`, `capital_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Coleman and Weeks Co', 'Mccall Clarke LLC', '711', NULL, NULL, '221', 'Sole Proprietorship', 'Eius aut cum soluta', '+1 (724) 615-4806', 'lypidypy@mailinator.com', 'https://www.robygyx.me.uk', 'Najran', 'Et maxime deserunt b', 'Eiusmod quas illo as', 'Nam deserunt dolor n', '787', 'Cum ea est ipsam fac', 'Facere eius eveniet', 'Aretha Bradshaw', '369', 'Voluptatem nulla et', 'Under Formation', '1979-10-11', 90.00, 'active', '2025-08-29 17:21:01', '2025-08-29 17:21:01'),
(2, 'Ross Waters Inc', 'Hubbard Dotson Plc', '369', NULL, NULL, '59', 'LLC', 'Consequatur nulla eu', '+1 (319) 471-9392', 'xoboboz@mailinator.com', 'https://www.vyfyditydamad.ca', 'Tabuk', 'Vel illum accusanti', 'Modi et omnis volupt', 'Exercitation qui lab', '403', 'Fuga Culpa ipsa e', 'Obcaecati sint nemo', 'Kenneth Hatfield', '82', 'Rerum adipisicing ac', 'Under Formation', '2011-02-16', 30.00, 'inactive', '2025-08-29 17:33:13', '2025-08-30 01:54:43'),
(3, 'Alvarez Bush Trading', 'Tanner and Knapp Traders', '236', NULL, NULL, '452', 'Sole Proprietorship', 'Est autem ea in eius', '+1 (689) 362-3113', 'wohisyr@mailinator.com', 'https://www.qecydaratawaf.org', 'Najran', 'Dolor aut sint ab re', 'Nulla rem ut ad in i', 'Voluptatem atque be', '549', 'Vel pariatur Quia q', 'Ex in expedita illo', 'Kelly Soto', '398', 'Omnis voluptates qui', 'Suspended', '1972-08-18', 56.00, 'active', '2025-08-30 08:57:25', '2025-08-30 08:57:25'),
(4, 'Carney and Hurst Inc', 'Rojas Bean Trading', '194', NULL, NULL, '18', 'Sole Proprietorship', 'Magni magnam libero', '+1 (393) 167-4845', 'myqyvoc@mailinator.com', 'https://www.bitydozajyximy.me', 'Najran', 'Dolores cupiditate c', 'Rem deserunt volupta', 'Voluptatibus sed est', '709', 'Ex laboriosam ipsam', 'Incididunt illum mo', 'Lavinia Nash', '736', 'Repudiandae cupidita', 'Suspended', '2001-08-07', 63.00, 'active', '2025-08-30 11:24:15', '2025-08-30 11:24:15'),
(5, 'Batz Group', 'Lowe Ltd', '9076080004', '05933155', '75843088', '2536449885', 'Partnership', '7217', '352.913.4317', 'klein.dawn@bogan.info', NULL, 'Blickburgh', 'West Damianberg', 'Sincere Bypass', '2518 Nola Corner Apt. 925', '853', '03543', '40346 Mosciski Trafficway Apt. 564\nSouth Bonnie, MT 68781', 'Miss Aubrey Kilback PhD', '3016971156', 'Kazakhstan', 'Active', '2021-09-24', 286044.23, 'active', '2025-09-07 11:53:32', '2025-09-07 11:53:32'),
(6, 'Herman and Sons', 'Fadel-Heaney', '5097659668', '59525222', '64826625', '2501597727', 'LLC', '1268', '+1-947-570-9019', 'yschiller@boyer.biz', NULL, 'New Federicoland', 'North Urban', 'Ortiz Street', '4476 Gaylord Lodge Apt. 340', '2780', '39862-2589', '4402 Jameson Plains Apt. 972\nWest Stacey, IA 14332-6058', 'Elinor Littel', '1427231443', 'Burundi', 'Suspended', '2020-05-14', 156898.05, 'active', '2025-09-07 11:53:33', '2025-09-07 11:53:33'),
(7, 'Graham, Ebert and Littel', 'Dickinson, Emmerich and Daniel', '9331674778', '48834175', '86431898', '5866844434', 'Corporation', '7080', '+1 (562) 322-7044', 'ltromp@lesch.com', NULL, 'Port Howellberg', 'East Macey', 'Zieme Viaduct', '49470 Carter Route Apt. 300', '64664', '77775', NULL, 'Bud Moen', '3206995529', 'Algeria', 'Suspended', '2017-06-14', 273363.28, 'active', '2025-09-07 11:53:35', '2025-09-07 11:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `company_documents`
--

CREATE TABLE `company_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `document_type_id` bigint UNSIGNED NOT NULL,
  `status` enum('active','expired','cancelled','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `enable_reminder` tinyint(1) NOT NULL DEFAULT '0',
  `reminder_days` int DEFAULT NULL,
  `custom_fields` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_documents`
--

INSERT INTO `company_documents` (`id`, `company_id`, `document_type_id`, `status`, `enable_reminder`, `reminder_days`, `custom_fields`, `created_at`, `updated_at`) VALUES
(1, 1, 20, 'active', 1, 10, '{\"issue_date\": \"2025-08-31\", \"expiry_date\": \"2025-09-19\", \"document_file\": {\"file_path\": \"company-documents/1757126541_file.pdf\", \"file_size\": 1032205, \"file_type\": \"application/pdf\", \"original_filename\": \"file.pdf\"}, \"document_number\": \"1243234534\"}', '2025-09-05 23:42:21', '2025-09-05 23:42:21'),
(2, 4, 19, 'active', 1, 20, '{\"issue_date\": \"2025-09-01\", \"expiry_date\": \"2025-09-17\", \"document_file\": {\"file_path\": \"company-documents/1757131880_laravel.jpg\", \"file_size\": 62515, \"file_type\": \"image/jpeg\", \"original_filename\": \"laravel.jpg\"}, \"document_number\": \"21342134\"}', '2025-09-05 23:58:28', '2025-09-06 01:11:20'),
(3, 4, 19, 'active', 1, 20, '{\"issue_date\": \"2025-08-31\", \"expiry_date\": \"2025-09-04\", \"document_number\": \"21342134\"}', '2025-09-06 00:35:38', '2025-09-06 00:36:48'),
(4, 2, 24, 'active', 1, 30, '{\"issue_date\": \"2025-09-17\", \"expiry_date\": \"2025-09-17\", \"document_file\": {\"file_path\": \"company-documents/1758061265_3910.jpg\", \"file_size\": 722264, \"file_type\": \"image/jpeg\", \"original_filename\": \"3910.jpg\"}, \"document_number\": \"213421343245\"}', '2025-09-16 19:10:12', '2025-09-16 19:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('employee','company') COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_type` enum('saudi','expat','both') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'both',
  `reminder_days_before` int NOT NULL DEFAULT '30',
  `custom_fields` json DEFAULT NULL,
  `description_ar` text COLLATE utf8mb4_unicode_ci,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_types`
--

INSERT INTO `document_types` (`id`, `name_en`, `name_ar`, `code`, `category`, `entity_type`, `reminder_days_before`, `custom_fields`, `description_ar`, `description_en`, `is_active`, `created_at`, `updated_at`) VALUES
(9, 'National ID', 'الهوية الوطنية', 'NAT_ID', 'employee', 'saudi', 90, '{\"issue_date\": {\"key\": \"issue_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الإصدار\", \"name_en\": \"Issue Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الإصدار\", \"placeholder_en\": \"Select issue date\"}, \"expiry_date\": {\"key\": \"expiry_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الانتهاء\", \"name_en\": \"Expiry Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الانتهاء\", \"placeholder_en\": \"Select expiry date\"}, \"document_file\": {\"key\": \"document_file\", \"type\": \"file\", \"name_ar\": \"ملف الوثيقة\", \"name_en\": \"Document File\", \"required\": false, \"placeholder_ar\": \"رفع ملف الوثيقة\", \"placeholder_en\": \"Upload document file\"}, \"place_of_issue\": {\"key\": \"place_of_issue\", \"type\": \"text\", \"name_ar\": \"مكان الإصدار\", \"name_en\": \"Place of Issue\", \"required\": false, \"placeholder_ar\": \"أدخل مكان الإصدار\", \"placeholder_en\": \"Enter place of issue\"}, \"document_number\": {\"key\": \"document_number\", \"type\": \"text\", \"name_ar\": \"رقم الوثيقة\", \"name_en\": \"Document Number\", \"required\": true, \"placeholder_ar\": \"أدخل رقم الوثيقة\", \"placeholder_en\": \"Enter document number\"}}', 'الهوية الوطنية للمواطنين السعوديين', 'National Identity Card for Saudi Citizens', 1, '2025-08-29 13:55:28', '2025-09-05 20:11:40'),
(10, 'Iqama (Residence Permit)', 'الإقامة', 'IQAMA', 'employee', 'expat', 60, '{\"issue_date\": {\"key\": \"issue_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الإصدار\", \"name_en\": \"Issue Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الإصدار\", \"placeholder_en\": \"Select issue date\"}, \"expiry_date\": {\"key\": \"expiry_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الانتهاء\", \"name_en\": \"Expiry Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الانتهاء\", \"placeholder_en\": \"Select expiry date\"}, \"document_file\": {\"key\": \"document_file\", \"type\": \"file\", \"name_ar\": \"ملف الوثيقة\", \"name_en\": \"Document File\", \"required\": false, \"placeholder_ar\": \"رفع ملف الوثيقة\", \"placeholder_en\": \"Upload document file\"}, \"place_of_issue\": {\"key\": \"place_of_issue\", \"type\": \"text\", \"name_ar\": \"مكان الإصدار\", \"name_en\": \"Place of Issue\", \"required\": false, \"placeholder_ar\": \"أدخل مكان الإصدار\", \"placeholder_en\": \"Enter place of issue\"}, \"document_number\": {\"key\": \"document_number\", \"type\": \"text\", \"name_ar\": \"رقم الوثيقة\", \"name_en\": \"Document Number\", \"required\": true, \"placeholder_ar\": \"أدخل رقم الوثيقة\", \"placeholder_en\": \"Enter document number\"}}', 'إقامة للوافدين المقيمين', 'Residence Permit for Expatriate Workers', 1, '2025-08-29 13:55:28', '2025-09-05 20:11:29'),
(11, 'Passport', 'جواز السفر', 'PASSPORT', 'employee', 'expat', 180, '{\"0\": {\"key\": \"number_passportnumber_u6gc\", \"type\": \"number\", \"name_ar\": \"رقم الجواز\", \"name_en\": \"passport_number\", \"options\": {\"value\": [null], \"label_ar\": [null], \"label_en\": [null]}, \"placeholder_ar\": null, \"placeholder_en\": null}, \"issue_date\": {\"key\": \"issue_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الإصدار\", \"name_en\": \"Issue Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الإصدار\", \"placeholder_en\": \"Select issue date\"}, \"expiry_date\": {\"key\": \"expiry_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الانتهاء\", \"name_en\": \"Expiry Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الانتهاء\", \"placeholder_en\": \"Select expiry date\"}, \"document_file\": {\"key\": \"document_file\", \"type\": \"file\", \"name_ar\": \"ملف الوثيقة\", \"name_en\": \"Document File\", \"required\": false, \"placeholder_ar\": \"رفع ملف الوثيقة\", \"placeholder_en\": \"Upload document file\"}, \"document_number\": {\"key\": \"document_number\", \"type\": \"text\", \"name_ar\": \"رقم الوثيقة\", \"name_en\": \"Document Number\", \"required\": true, \"placeholder_ar\": \"أدخل رقم الوثيقة\", \"placeholder_en\": \"Enter document number\"}}', 'جواز سفر للموظفين الوافدين', 'Passport for Expatriate Employees', 1, '2025-08-29 13:55:28', '2025-09-06 01:23:42'),
(12, 'Visa', 'التأشيرة', 'VISA', 'employee', 'expat', 30, '{\"notes\": {\"key\": \"notes\", \"type\": \"textarea\", \"name_ar\": \"ملاحظات\", \"name_en\": \"Notes\", \"required\": false, \"placeholder_ar\": \"أدخل الملاحظات\", \"placeholder_en\": \"Enter notes\"}, \"issue_date\": {\"key\": \"issue_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الإصدار\", \"name_en\": \"Issue Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الإصدار\", \"placeholder_en\": \"Select issue date\"}, \"expiry_date\": {\"key\": \"expiry_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الانتهاء\", \"name_en\": \"Expiry Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الانتهاء\", \"placeholder_en\": \"Select expiry date\"}, \"document_file\": {\"key\": \"document_file\", \"type\": \"file\", \"name_ar\": \"ملف الوثيقة\", \"name_en\": \"Document File\", \"required\": false, \"placeholder_ar\": \"رفع ملف الوثيقة\", \"placeholder_en\": \"Upload document file\"}, \"renewal_notes\": {\"key\": \"renewal_notes\", \"type\": \"textarea\", \"name_ar\": \"ملاحظات التجديد\", \"name_en\": \"Renewal Notes\", \"required\": false, \"placeholder_ar\": \"أدخل ملاحظات التجديد\", \"placeholder_en\": \"Enter renewal notes\"}, \"place_of_issue\": {\"key\": \"place_of_issue\", \"type\": \"text\", \"name_ar\": \"مكان الإصدار\", \"name_en\": \"Place of Issue\", \"required\": false, \"placeholder_ar\": \"أدخل مكان الإصدار\", \"placeholder_en\": \"Enter place of issue\"}, \"document_number\": {\"key\": \"document_number\", \"type\": \"text\", \"name_ar\": \"رقم الوثيقة\", \"name_en\": \"Document Number\", \"required\": true, \"placeholder_ar\": \"أدخل رقم الوثيقة\", \"placeholder_en\": \"Enter document number\"}}', 'تأشيرة دخول للموظفين الوافدين', 'Entry Visa for Expatriate Employees', 1, '2025-08-29 13:55:28', '2025-09-05 20:12:29'),
(13, 'Exit/Re-entry Permit', 'تأشيرة خروج وعودة', 'EXIT_REENTRY', 'employee', 'expat', 15, '{\"notes\": {\"key\": \"notes\", \"type\": \"textarea\", \"name_ar\": \"ملاحظات\", \"name_en\": \"Notes\", \"required\": false, \"placeholder_ar\": \"أدخل الملاحظات\", \"placeholder_en\": \"Enter notes\"}, \"issue_date\": {\"key\": \"issue_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الإصدار\", \"name_en\": \"Issue Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الإصدار\", \"placeholder_en\": \"Select issue date\"}, \"expiry_date\": {\"key\": \"expiry_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الانتهاء\", \"name_en\": \"Expiry Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الانتهاء\", \"placeholder_en\": \"Select expiry date\"}, \"document_file\": {\"key\": \"document_file\", \"type\": \"file\", \"name_ar\": \"ملف الوثيقة\", \"name_en\": \"Document File\", \"required\": false, \"placeholder_ar\": \"رفع ملف الوثيقة\", \"placeholder_en\": \"Upload document file\"}, \"renewal_notes\": {\"key\": \"renewal_notes\", \"type\": \"textarea\", \"name_ar\": \"ملاحظات التجديد\", \"name_en\": \"Renewal Notes\", \"required\": false, \"placeholder_ar\": \"أدخل ملاحظات التجديد\", \"placeholder_en\": \"Enter renewal notes\"}, \"place_of_issue\": {\"key\": \"place_of_issue\", \"type\": \"text\", \"name_ar\": \"مكان الإصدار\", \"name_en\": \"Place of Issue\", \"required\": false, \"placeholder_ar\": \"أدخل مكان الإصدار\", \"placeholder_en\": \"Enter place of issue\"}, \"document_number\": {\"key\": \"document_number\", \"type\": \"text\", \"name_ar\": \"رقم الوثيقة\", \"name_en\": \"Document Number\", \"required\": true, \"placeholder_ar\": \"أدخل رقم الوثيقة\", \"placeholder_en\": \"Enter document number\"}}', 'تأشيرة خروج وعودة للموظفين الوافدين', 'Exit and Re-entry Permit for Expatriate Employees', 1, '2025-08-29 13:55:28', '2025-09-05 19:44:32'),
(14, 'Work Contract', 'عقد العمل', 'WORK_CONTRACT', 'employee', 'both', 90, '{\"issue_date\": {\"key\": \"issue_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الإصدار\", \"name_en\": \"Issue Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الإصدار\", \"placeholder_en\": \"Select issue date\"}, \"expiry_date\": {\"key\": \"expiry_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الانتهاء\", \"name_en\": \"Expiry Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الانتهاء\", \"placeholder_en\": \"Select expiry date\"}, \"document_file\": {\"key\": \"document_file\", \"type\": \"file\", \"name_ar\": \"ملف الوثيقة\", \"name_en\": \"Document File\", \"required\": false, \"placeholder_ar\": \"رفع ملف الوثيقة\", \"placeholder_en\": \"Upload document file\"}, \"place_of_issue\": {\"key\": \"place_of_issue\", \"type\": \"text\", \"name_ar\": \"مكان الإصدار\", \"name_en\": \"Place of Issue\", \"required\": false, \"placeholder_ar\": \"أدخل مكان الإصدار\", \"placeholder_en\": \"Enter place of issue\"}, \"document_number\": {\"key\": \"document_number\", \"type\": \"text\", \"name_ar\": \"رقم الوثيقة\", \"name_en\": \"Document Number\", \"required\": true, \"placeholder_ar\": \"أدخل رقم الوثيقة\", \"placeholder_en\": \"Enter document number\"}}', 'عقد العمل للموظفين', 'Employment Contract for Employees', 1, '2025-08-29 13:55:28', '2025-09-05 20:12:39'),
(15, 'Health Insurance', 'التأمين الصحي', 'HEALTH_INSURANCE', 'employee', 'both', 30, '{\"issue_date\": {\"key\": \"issue_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الإصدار\", \"name_en\": \"Issue Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الإصدار\", \"placeholder_en\": \"Select issue date\"}, \"expiry_date\": {\"key\": \"expiry_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الانتهاء\", \"name_en\": \"Expiry Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الانتهاء\", \"placeholder_en\": \"Select expiry date\"}, \"document_file\": {\"key\": \"document_file\", \"type\": \"file\", \"name_ar\": \"ملف الوثيقة\", \"name_en\": \"Document File\", \"required\": false, \"placeholder_ar\": \"رفع ملف الوثيقة\", \"placeholder_en\": \"Upload document file\"}, \"renewal_notes\": {\"key\": \"renewal_notes\", \"type\": \"textarea\", \"name_ar\": \"ملاحظات التجديد\", \"name_en\": \"Renewal Notes\", \"required\": false, \"placeholder_ar\": \"أدخل ملاحظات التجديد\", \"placeholder_en\": \"Enter renewal notes\"}, \"place_of_issue\": {\"key\": \"place_of_issue\", \"type\": \"text\", \"name_ar\": \"مكان الإصدار\", \"name_en\": \"Place of Issue\", \"required\": false, \"placeholder_ar\": \"أدخل مكان الإصدار\", \"placeholder_en\": \"Enter place of issue\"}, \"document_number\": {\"key\": \"document_number\", \"type\": \"text\", \"name_ar\": \"رقم الوثيقة\", \"name_en\": \"Document Number\", \"required\": true, \"placeholder_ar\": \"أدخل رقم الوثيقة\", \"placeholder_en\": \"Enter document number\"}}', 'بوليصة التأمين الصحي', 'Health Insurance Policy', 1, '2025-08-29 13:55:28', '2025-09-05 21:35:14'),
(19, 'VAT Registration', 'شهادة التسجيل في ضريبة القيمة المضافة', 'VAT_REG', 'company', 'both', 20, '{\"issue_date\": {\"key\": \"issue_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الإصدار\", \"name_en\": \"Issue Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الإصدار\", \"placeholder_en\": \"Select issue date\"}, \"expiry_date\": {\"key\": \"expiry_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الانتهاء\", \"name_en\": \"Expiry Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الانتهاء\", \"placeholder_en\": \"Select expiry date\"}, \"document_file\": {\"key\": \"document_file\", \"type\": \"file\", \"name_ar\": \"ملف الوثيقة\", \"name_en\": \"Document File\", \"required\": false, \"placeholder_ar\": \"رفع ملف الوثيقة\", \"placeholder_en\": \"Upload document file\"}, \"document_number\": {\"key\": \"document_number\", \"type\": \"text\", \"name_ar\": \"رقم الوثيقة\", \"name_en\": \"Document Number\", \"required\": true, \"placeholder_ar\": \"أدخل رقم الوثيقة\", \"placeholder_en\": \"Enter document number\"}}', 'شهادة التسجيل في ضريبة القيمة المضافة', 'VAT Registration Certificate', 1, '2025-08-29 13:55:28', '2025-09-05 23:49:15'),
(20, 'GOSI Registration', 'شهادة التسجيل في التأمينات الاجتماعية', 'GOSI_REG', 'company', 'both', 10, '{\"issue_date\": {\"key\": \"issue_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الإصدار\", \"name_en\": \"Issue Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الإصدار\", \"placeholder_en\": \"Select issue date\"}, \"expiry_date\": {\"key\": \"expiry_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الانتهاء\", \"name_en\": \"Expiry Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الانتهاء\", \"placeholder_en\": \"Select expiry date\"}, \"document_file\": {\"key\": \"document_file\", \"type\": \"file\", \"name_ar\": \"ملف الوثيقة\", \"name_en\": \"Document File\", \"required\": false, \"placeholder_ar\": \"رفع ملف الوثيقة\", \"placeholder_en\": \"Upload document file\"}, \"renewal_notes\": {\"key\": \"renewal_notes\", \"type\": \"textarea\", \"name_ar\": \"ملاحظات التجديد\", \"name_en\": \"Renewal Notes\", \"required\": false, \"placeholder_ar\": \"أدخل ملاحظات التجديد\", \"placeholder_en\": \"Enter renewal notes\"}, \"place_of_issue\": {\"key\": \"place_of_issue\", \"type\": \"text\", \"name_ar\": \"مكان الإصدار\", \"name_en\": \"Place of Issue\", \"required\": false, \"placeholder_ar\": \"أدخل مكان الإصدار\", \"placeholder_en\": \"Enter place of issue\"}, \"document_number\": {\"key\": \"document_number\", \"type\": \"text\", \"name_ar\": \"رقم الوثيقة\", \"name_en\": \"Document Number\", \"required\": true, \"placeholder_ar\": \"أدخل رقم الوثيقة\", \"placeholder_en\": \"Enter document number\"}}', 'شهادة التسجيل في المؤسسة العامة للتأمينات الاجتماعية', 'General Organization for Social Insurance Registration', 1, '2025-08-29 13:55:28', '2025-09-05 23:48:56'),
(24, 'Commercial Registration', 'سجل تجاري', 'COMP_COMMERCIAL_REGISTRAT_0964', 'company', 'both', 30, '{\"0\": {\"key\": \"number_passportnumber_ajz0\", \"type\": \"number\", \"name_ar\": \"رقم الجواز\", \"name_en\": \"passport_number\", \"options\": {\"value\": [null], \"label_ar\": [null], \"label_en\": [null]}, \"placeholder_ar\": null, \"placeholder_en\": null}, \"notes\": {\"key\": \"notes\", \"type\": \"textarea\", \"name_ar\": \"ملاحظات\", \"name_en\": \"Notes\", \"required\": false, \"placeholder_ar\": \"أدخل الملاحظات\", \"placeholder_en\": \"Enter notes\"}, \"issue_date\": {\"key\": \"issue_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الإصدار\", \"name_en\": \"Issue Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الإصدار\", \"placeholder_en\": \"Select issue date\"}, \"expiry_date\": {\"key\": \"expiry_date\", \"type\": \"date\", \"name_ar\": \"تاريخ الانتهاء\", \"name_en\": \"Expiry Date\", \"required\": true, \"placeholder_ar\": \"اختر تاريخ الانتهاء\", \"placeholder_en\": \"Select expiry date\"}, \"document_file\": {\"key\": \"document_file\", \"type\": \"file\", \"name_ar\": \"ملف الوثيقة\", \"name_en\": \"Document File\", \"required\": false, \"placeholder_ar\": \"رفع ملف الوثيقة\", \"placeholder_en\": \"Upload document file\"}, \"renewal_notes\": {\"key\": \"renewal_notes\", \"type\": \"textarea\", \"name_ar\": \"ملاحظات التجديد\", \"name_en\": \"Renewal Notes\", \"required\": false, \"placeholder_ar\": \"أدخل ملاحظات التجديد\", \"placeholder_en\": \"Enter renewal notes\"}, \"place_of_issue\": {\"key\": \"place_of_issue\", \"type\": \"text\", \"name_ar\": \"مكان الإصدار\", \"name_en\": \"Place of Issue\", \"required\": false, \"placeholder_ar\": \"أدخل مكان الإصدار\", \"placeholder_en\": \"Enter place of issue\"}, \"document_number\": {\"key\": \"document_number\", \"type\": \"text\", \"name_ar\": \"رقم الوثيقة\", \"name_en\": \"Document Number\", \"required\": true, \"placeholder_ar\": \"أدخل رقم الوثيقة\", \"placeholder_en\": \"Enter document number\"}}', 'Suscipit quam sed ex', 'Doloremque unde quid', 1, '2025-09-06 01:23:01', '2025-09-06 01:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `full_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('saudi','expat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob_hijri` date DEFAULT NULL,
  `dob_greg` date NOT NULL,
  `pob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` enum('single','married','divorced','widowed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id_issue_date` date DEFAULT NULL,
  `national_id_expiry_date` date DEFAULT NULL,
  `national_id_issue_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iqama_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iqama_issue_date` date DEFAULT NULL,
  `iqama_expiry_date` date DEFAULT NULL,
  `border_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_issue_date` date DEFAULT NULL,
  `passport_expiry_date` date DEFAULT NULL,
  `passport_issue_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pobox` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hire_date` date NOT NULL,
  `contract_type` enum('permanent','temporary','part_time','contract') COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL,
  `allowances` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gosi_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medical_insurance_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saned_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','terminated','on_leave') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `company_id`, `full_name_ar`, `full_name_en`, `type`, `nationality`, `dob_hijri`, `dob_greg`, `pob`, `gender`, `marital_status`, `religion`, `education`, `specialization`, `national_id`, `national_id_issue_date`, `national_id_expiry_date`, `national_id_issue_place`, `iqama_number`, `iqama_issue_date`, `iqama_expiry_date`, `border_number`, `passport_number`, `passport_issue_date`, `passport_expiry_date`, `passport_issue_place`, `primary_mobile`, `secondary_mobile`, `email`, `region`, `city`, `district`, `street`, `building_number`, `postal_code`, `pobox`, `job_title`, `hire_date`, `contract_type`, `basic_salary`, `allowances`, `gosi_number`, `medical_insurance_number`, `saned_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Laura Skinner', 'Yetta Lyons', 'saudi', 'Atque dolore elit h', NULL, '2008-03-18', 'Reprehenderit deseru', 'male', 'divorced', NULL, NULL, NULL, '12431243', '2025-08-30', '2025-09-13', '12341234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Commodo pariatur Ma', 'Commodo pariatur Ma', 'migely@mailinator.com', 'Nulla aliquid est d', 'Dolores ipsum alias', 'Aliquam est eu adipi', 'Dolores quos id sae', '152', 'Deserunt porro nihil', 'P.O. Box 32445', 'Eius nihil mollit ut', '2007-08-27', 'temporary', 25.00, 51.00, '399', '458', '634', 'active', '2025-08-30 05:06:06', '2025-09-05 20:13:44'),
(2, 3, 'Aladdin Bell', 'Craig Sullivan', 'expat', 'Beatae obcaecati vol', NULL, '1979-01-20', 'Cum ut vitae facilis', 'male', 'married', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'xavasdsv', '2025-08-30', '2025-08-31', 'asvasdavd', 'asdvsdvvasdvv', '2025-08-14', '2025-08-31', 'savdasdvsdadsfv', 'Deserunt iste at pro', 'Deserunt iste at pro', 'hatok@mailinator.com', 'Consectetur commodo', 'Aute sit perferendi', 'Non placeat quasi s', 'Dolores numquam dolo', '126', 'Rem adipisicing cons', 'PO Box 80', 'Dolor ipsam qui aliq', '1997-03-11', 'temporary', 89.00, 45.00, '685', '683', '916', 'active', '2025-08-30 09:01:18', '2025-08-30 09:01:18'),
(3, 4, 'Adria Cox', 'Sydnee Rodgers', 'expat', 'Sequi assumenda dolo', NULL, '1982-07-13', 'Iure odio qui obcaec', 'male', 'single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '341', '1998-06-07', '2028-10-16', '851', '703', '1997-09-16', '2026-06-29', 'Accusantium ut facer', '12341243', '123412341234', 'tibi@mailinator.com', 'Quam id nesciunt en', 'Dolor vel quaerat do', 'Iure est aspernatur', 'Aperiam consectetur', '527', 'Veritatis illum lau', 'P.O. Box 5263', 'Rem aperiam ipsum es', '1977-03-14', 'part_time', 39.00, 9.00, '383', '720', '807', 'active', '2025-08-30 11:32:46', '2025-09-16 20:38:19'),
(4, 2, 'asdf', 'asdf', 'saudi', 'asdf', NULL, '2025-09-17', 'asdf', 'male', 'single', NULL, NULL, NULL, 'asdf', '2025-09-16', '2025-09-17', 'asdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asdf', NULL, NULL, 'asdf', 'asdf', 'asdfd', 'asdf', NULL, NULL, NULL, 'sadf', '2025-09-17', 'permanent', 1234.00, 0.00, NULL, NULL, NULL, 'active', '2025-09-16 19:00:58', '2025-09-16 19:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `employee_active_screen_time`
--

CREATE TABLE `employee_active_screen_time` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `session_start` timestamp NOT NULL,
  `session_end` timestamp NULL DEFAULT NULL,
  `total_seconds` int NOT NULL,
  `idle_seconds` int NOT NULL DEFAULT '0',
  `click_count` int NOT NULL DEFAULT '0',
  `keypress_count` int NOT NULL DEFAULT '0',
  `scroll_count` int NOT NULL DEFAULT '0',
  `activity_breaks` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_active_screen_time`
--

INSERT INTO `employee_active_screen_time` (`id`, `user_id`, `date`, `session_start`, `session_end`, `total_seconds`, `idle_seconds`, `click_count`, `keypress_count`, `scroll_count`, `activity_breaks`, `created_at`, `updated_at`) VALUES
(1, 44, '2025-09-17', '2025-09-17 00:55:08', NULL, 68, 2493, 29, 10, 43, '[[], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], []]', '2025-09-17 00:55:08', '2025-09-17 01:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `employee_activity_logs`
--

CREATE TABLE `employee_activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `action_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_activity_logs`
--

INSERT INTO `employee_activity_logs` (`id`, `user_id`, `action_type`, `model_type`, `model_id`, `description`, `old_values`, `new_values`, `ip_address`, `user_agent`, `url`, `created_at`, `updated_at`) VALUES
(1, 13, 'test', 'Test', NULL, 'Test activity', NULL, NULL, '127.0.0.1', 'test', 'http://test.com', '2025-09-17 00:57:57', '2025-09-17 00:57:57'),
(2, 44, 'view', 'App\\Models\\Company', NULL, 'Viewed Company page', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/companies', '2025-09-17 01:05:39', '2025-09-17 01:05:39'),
(3, 44, 'view', 'App\\Models\\Company', NULL, 'Viewed Company page', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/companies', '2025-09-17 01:08:03', '2025-09-17 01:08:03'),
(4, 44, 'view', 'App\\Models\\Company', NULL, 'Viewed Company page', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/companies?search=asd', '2025-09-17 01:08:15', '2025-09-17 01:08:15'),
(5, 44, 'view', 'App\\Models\\Company', NULL, 'Viewed Company page', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/companies?search=asd', '2025-09-17 01:08:15', '2025-09-17 01:08:15'),
(6, 44, 'view', 'App\\Models\\Company', NULL, 'Viewed Company page', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/companies?search=asd', '2025-09-17 01:08:15', '2025-09-17 01:08:15'),
(7, 44, 'view', 'App\\Models\\Company', NULL, 'Viewed Company page', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/companies', '2025-09-17 01:08:19', '2025-09-17 01:08:19'),
(8, 44, 'view', 'App\\Models\\CompanyDocument', NULL, 'Viewed CompanyDocument page', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/company-documents', '2025-09-17 01:09:03', '2025-09-17 01:09:03'),
(9, 44, 'view', 'App\\Models\\Employee', NULL, 'Viewed Employee page', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/employees', '2025-09-17 01:09:05', '2025-09-17 01:09:05'),
(10, 44, 'view', 'App\\Models\\Document', NULL, 'Viewed Document page', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/documents', '2025-09-17 01:09:07', '2025-09-17 01:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `employee_click_tracking`
--

CREATE TABLE `employee_click_tracking` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `element_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `element_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `element_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `element_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `x_position` int DEFAULT NULL,
  `y_position` int DEFAULT NULL,
  `clicked_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_click_tracking`
--

INSERT INTO `employee_click_tracking` (`id`, `user_id`, `element_type`, `element_id`, `element_class`, `element_text`, `page_url`, `x_position`, `y_position`, `clicked_at`, `created_at`, `updated_at`) VALUES
(1, 13, 'button', NULL, NULL, NULL, 'http://test.com', NULL, NULL, '2025-09-17 00:50:43', '2025-09-17 00:50:43', '2025-09-17 00:50:43'),
(2, 44, 'div', NULL, 'text-gray-600 fs-6', 'عليك بتجديد هذه الوثائق فى اسرع وقت', 'http://127.0.0.1:8000/admin/tasks/14', 631, 288, '2025-09-17 00:54:30', '2025-09-17 00:54:30', '2025-09-17 00:54:30'),
(3, 44, 'h2', NULL, NULL, 'تفاصيل المهمة', 'http://127.0.0.1:8000/admin/tasks/14', 840, 189, '2025-09-17 00:54:31', '2025-09-17 00:54:31', '2025-09-17 00:54:31'),
(4, 44, 'a', NULL, 'btn btn-sm btn-light-info', 'عرض', 'http://127.0.0.1:8000/admin/tasks/14', 609, 449, '2025-09-17 00:55:08', '2025-09-17 00:55:08', '2025-09-17 00:55:08'),
(5, 44, 'a', NULL, 'menu-link px-5', 'تسجيل الخروج', 'http://127.0.0.1:8000/admin/employees/1/documents/1', 136, 223, '2025-09-17 00:55:12', '2025-09-17 00:55:12', '2025-09-17 00:55:12'),
(6, 44, 'span', NULL, 'menu-title', 'إدارة المنشأت', 'http://127.0.0.1:8000/dashboard', 1174, 151, '2025-09-17 00:56:13', '2025-09-17 00:56:13', '2025-09-17 00:56:13'),
(7, 44, 'span', NULL, 'menu-title', 'المنشأت', 'http://127.0.0.1:8000/dashboard', 1177, 198, '2025-09-17 00:56:14', '2025-09-17 00:56:14', '2025-09-17 00:56:14'),
(8, 44, 'input', NULL, 'form-control form-control-solid w-250px ps-13', NULL, 'http://127.0.0.1:8000/admin/companies', 886, 320, '2025-09-17 01:08:13', '2025-09-17 01:08:13', '2025-09-17 01:08:13'),
(9, 44, 'input', NULL, 'form-control form-control-solid w-250px ps-13', NULL, 'http://127.0.0.1:8000/admin/companies?search=asd', 858, 315, '2025-09-17 01:08:17', '2025-09-17 01:08:17', '2025-09-17 01:08:17'),
(10, 44, 'input', NULL, 'form-control form-control-solid w-250px ps-13', NULL, 'http://127.0.0.1:8000/admin/companies?search=asd', 858, 315, '2025-09-17 01:08:17', '2025-09-17 01:08:17', '2025-09-17 01:08:17'),
(11, 44, 'div', 'kt_app_content_container', 'app-container container-xxl', 'المنشآت المخصصة فقط\n                    أنت تشاهد فقط المنشآت المخصصة لك من خلال المهام. اتصل بمديرك إذا كنت تحتاج إلى الوصول إلى منشآت إضافية.', 'http://127.0.0.1:8000/admin/companies?', 567, 233, '2025-09-17 01:08:21', '2025-09-17 01:08:21', '2025-09-17 01:08:21'),
(12, 44, 'a', NULL, 'menu-link', 'وثائق المنشأت', 'http://127.0.0.1:8000/admin/companies?', 1175, 263, '2025-09-17 01:09:03', '2025-09-17 01:09:03', '2025-09-17 01:09:03'),
(13, 44, 'span', NULL, 'menu-title', 'الموظفين', 'http://127.0.0.1:8000/admin/company-documents', 1174, 290, '2025-09-17 01:09:05', '2025-09-17 01:09:05', '2025-09-17 01:09:05'),
(14, 44, 'span', NULL, 'menu-title', 'وثائق الموظفين', 'http://127.0.0.1:8000/admin/employees', 1195, 340, '2025-09-17 01:09:07', '2025-09-17 01:09:07', '2025-09-17 01:09:07'),
(15, 44, 'span', NULL, 'menu-title', 'إدارة المهام', 'http://127.0.0.1:8000/admin/documents', 1192, 385, '2025-09-17 01:09:09', '2025-09-17 01:09:09', '2025-09-17 01:09:09'),
(16, 44, 'span', NULL, 'menu-title', 'مركز الإشعارات', 'http://127.0.0.1:8000/admin/tasks', 1178, 236, '2025-09-17 01:09:10', '2025-09-17 01:09:10', '2025-09-17 01:09:10'),
(17, 44, 'span', NULL, 'menu-title', 'إدارة المهام', 'http://127.0.0.1:8000/admin/notifications/all', 1135, 196, '2025-09-17 01:10:37', '2025-09-17 01:10:37', '2025-09-17 01:10:37'),
(18, 44, 'span', NULL, 'menu-title', 'إدارة المنشأت', 'http://127.0.0.1:8000/admin/tasks', 1173, 159, '2025-09-17 01:10:43', '2025-09-17 01:10:43', '2025-09-17 01:10:43'),
(19, 44, 'span', NULL, 'menu-title', 'لوحة التحكم', 'http://127.0.0.1:8000/admin/tasks', 1175, 105, '2025-09-17 01:10:45', '2025-09-17 01:10:45', '2025-09-17 01:10:45'),
(20, 44, 'span', NULL, 'menu-title', 'إدارة المنشأت', 'http://127.0.0.1:8000/dashboard', 1115, 162, '2025-09-17 01:10:52', '2025-09-17 01:10:52', '2025-09-17 01:10:52'),
(21, 44, 'span', NULL, 'menu-title', 'المنشأت', 'http://127.0.0.1:8000/dashboard', 1117, 199, '2025-09-17 01:10:54', '2025-09-17 01:10:54', '2025-09-17 01:10:54'),
(22, 44, 'img', NULL, NULL, NULL, 'http://127.0.0.1:8000/admin/companies', 43, 39, '2025-09-17 01:35:04', '2025-09-17 01:35:04', '2025-09-17 01:35:04'),
(23, 44, 'a', NULL, 'menu-link px-5', 'تسجيل الخروج', 'http://127.0.0.1:8000/admin/companies', 222, 224, '2025-09-17 01:35:04', '2025-09-17 01:35:04', '2025-09-17 01:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `employee_documents`
--

CREATE TABLE `employee_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `document_type_id` bigint UNSIGNED NOT NULL,
  `status` enum('active','expired','cancelled','pending','under_process') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `enable_reminder` tinyint(1) NOT NULL DEFAULT '0',
  `reminder_days` int DEFAULT NULL,
  `custom_fields` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_documents`
--

INSERT INTO `employee_documents` (`id`, `employee_id`, `document_type_id`, `status`, `enable_reminder`, `reminder_days`, `custom_fields`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 'pending', 1, 25, '{\"issue_date\": \"2024-02-06\", \"expiry_date\": \"2023-02-06\", \"document_file\": {\"file_path\": \"employee_documents/1/1757118451_laravel.jpg\", \"file_size\": 62515, \"file_type\": \"jpg\", \"original_filename\": \"laravel.jpg\"}, \"document_number\": \"123412324\"}', '2025-09-05 20:54:29', '2025-09-05 21:50:59'),
(2, 1, 9, 'active', 1, 90, '{\"issue_date\": \"2024-02-06\", \"expiry_date\": \"2025-09-19\", \"document_file\": {\"file_path\": \"employee_documents/1/1757118993_images.png\", \"file_size\": 4225, \"file_type\": \"png\", \"original_filename\": \"images.png\"}, \"document_number\": \"213412324124\"}', '2025-09-05 21:36:33', '2025-09-05 21:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `employee_login_logs`
--

CREATE TABLE `employee_login_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `login_at` timestamp NOT NULL,
  `logout_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','logged_out','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `duration_minutes` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_login_logs`
--

INSERT INTO `employee_login_logs` (`id`, `user_id`, `login_at`, `logout_at`, `ip_address`, `user_agent`, `session_id`, `status`, `duration_minutes`, `created_at`, `updated_at`) VALUES
(18, 13, '2025-09-17 01:11:25', NULL, '127.0.0.1', 'Symfony', 'EIT0xHxvsSbxaNIgQ8Xugpe8JQjRMRxYtJ2Sj8VW', 'active', NULL, '2025-09-17 01:11:25', '2025-09-17 01:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `package_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `payment_status` enum('paid','pending','overdue') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_03_26_115531_create_permission_tables', 1),
(7, '2025_08_27_015832_add_additional_fields_to_users_table', 2),
(8, '2025_08_29_143457_create_companies_table', 3),
(9, '2025_08_29_143600_create_civil_defense_licenses_table', 3),
(10, '2025_08_29_143707_create_municipality_licenses_table', 3),
(11, '2025_08_29_143759_create_branch_commercial_registrations_table', 3),
(12, '2025_08_29_143837_create_employees_table', 3),
(13, '2025_08_29_143942_create_employee_documents_table', 3),
(14, '2025_08_29_144627_create_document_types_table', 4),
(15, '2025_08_29_145046_modify_employee_documents_add_document_type_relation', 5),
(16, '2025_09_05_184203_add_custom_fields_to_document_types_table', 6),
(17, '2025_09_05_193134_remove_unused_columns_from_document_types_table', 7),
(19, '2025_09_05_193318_remove_required_optional_fields_from_document_types_table', 8),
(20, '2025_09_05_234222_update_employee_documents_table_structure', 9),
(21, '2025_09_06_012945_create_company_documents_table', 10),
(22, '2025_09_07_144739_create_tasks_table', 11),
(23, '2025_09_07_144744_create_task_histories_table', 11),
(24, '2025_09_08_004144_create_notifications_table', 12),
(26, '2025_09_08_020202_create_packages_table', 13),
(27, '2025_09_08_020208_create_client_packages_table', 14),
(28, '2025_09_08_020212_create_invoices_table', 14),
(29, '2025_09_12_230025_modify_packages_table_separate_document_types', 15),
(30, '2025_09_13_002836_add_document_fields_to_tasks_table', 16),
(31, '2025_09_13_120000_create_task_documents_table', 17),
(32, '2025_09_13_013212_remove_client_id_from_tasks_table', 18),
(33, '2025_09_13_022609_remove_old_document_fields_from_tasks_table', 19),
(34, '2025_09_16_223648_update_task_documents_enum_values', 20),
(35, '2025_01_27_000000_add_reminder_fields_to_company_document_models', 21),
(36, '2025_09_17_025235_remove_unused_permissions', 22),
(37, '2025_09_17_025724_consolidate_document_permissions', 23),
(38, '2025_09_17_030400_create_employee_login_logs_table', 23),
(39, '2025_09_17_030440_create_employee_activity_logs_table', 23),
(40, '2025_09_17_030556_create_employee_click_tracking_table', 23),
(41, '2025_09_17_030604_create_employee_active_screen_time_table', 23),
(42, '2025_09_17_030611_create_employee_screenshots_table', 23),
(43, '2025_09_17_042727_drop_employee_screenshots_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(72, 'App\\Models\\User', 22),
(73, 'App\\Models\\User', 22),
(74, 'App\\Models\\User', 22),
(75, 'App\\Models\\User', 22),
(76, 'App\\Models\\User', 22),
(77, 'App\\Models\\User', 22),
(78, 'App\\Models\\User', 22),
(72, 'App\\Models\\User', 23),
(73, 'App\\Models\\User', 23),
(74, 'App\\Models\\User', 23),
(75, 'App\\Models\\User', 23),
(76, 'App\\Models\\User', 23),
(77, 'App\\Models\\User', 23),
(78, 'App\\Models\\User', 23),
(72, 'App\\Models\\User', 27),
(73, 'App\\Models\\User', 27),
(74, 'App\\Models\\User', 27),
(75, 'App\\Models\\User', 27),
(76, 'App\\Models\\User', 27),
(77, 'App\\Models\\User', 27),
(78, 'App\\Models\\User', 27),
(72, 'App\\Models\\User', 30),
(73, 'App\\Models\\User', 30),
(74, 'App\\Models\\User', 30),
(75, 'App\\Models\\User', 30),
(76, 'App\\Models\\User', 30),
(77, 'App\\Models\\User', 30),
(78, 'App\\Models\\User', 30),
(72, 'App\\Models\\User', 43),
(73, 'App\\Models\\User', 43),
(74, 'App\\Models\\User', 43),
(75, 'App\\Models\\User', 43),
(76, 'App\\Models\\User', 43),
(77, 'App\\Models\\User', 43),
(78, 'App\\Models\\User', 43);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 13),
(1, 'App\\Models\\User', 22),
(1, 'App\\Models\\User', 23),
(1, 'App\\Models\\User', 27),
(1, 'App\\Models\\User', 30),
(2, 'App\\Models\\User', 32),
(1, 'App\\Models\\User', 43),
(2, 'App\\Models\\User', 44),
(2, 'App\\Models\\User', 45),
(2, 'App\\Models\\User', 46),
(2, 'App\\Models\\User', 47);

-- --------------------------------------------------------

--
-- Table structure for table `municipality_licenses`
--

CREATE TABLE `municipality_licenses` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipality_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `zone_classification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_permit_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `land_use_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `conditions` text COLLATE utf8mb4_unicode_ci,
  `license_fees` decimal(10,2) DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `certificate_file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','expired','suspended','cancelled','under_renewal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `enable_reminder` tinyint(1) NOT NULL DEFAULT '0',
  `reminder_days` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `municipality_licenses`
--

INSERT INTO `municipality_licenses` (`id`, `company_id`, `license_number`, `municipality_name`, `license_type`, `activity_desc`, `location_code`, `area`, `zone_classification`, `building_permit_number`, `land_use_type`, `issue_date`, `expiry_date`, `conditions`, `license_fees`, `notes`, `certificate_file_path`, `status`, `enable_reminder`, `reminder_days`, `created_at`, `updated_at`) VALUES
(1, 2, '445', 'Shay Suarez', 'industrial', 'Doloribus qui aut ni', 'Vel ullamco ratione', 30.00, 'Aspernatur vel optio', '677', 'health', '1990-10-10', '2004-02-04', 'Voluptas ea libero f', 41.00, 'Sit eos voluptatem', 'company_documents/2/municipality/1756499686_municipality_laravel.jpg', 'active', 1, 30, '2025-08-29 17:33:53', '2025-09-16 22:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` json DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `title`, `message`, `data`, `user_id`, `created_by`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(10, 'task_status_changed', 'تم تحديث حالة المهمة', 'تم تغيير حالة المهمة \"تسجيل الشركة في الضرائب\" من \"قيد التنفيذ\" إلى \"مكتملة\" من قبل موظف وثائق.', '{\"task_id\": 9, \"changed_by\": \"موظف وثائق\", \"new_status\": \"completed\", \"old_status\": \"in_progress\", \"task_title\": \"تسجيل الشركة في الضرائب\", \"new_status_name\": \"مكتملة\", \"old_status_name\": \"قيد التنفيذ\"}', 43, 44, 0, NULL, '2025-09-07 22:44:52', '2025-09-16 23:12:09'),
(12, 'task_assigned', 'تكليف مهمة', 'تم تكليفك بمهمة \"تسجيل الشركة في الضرائب\" من قبل مدير النظام.', '{\"task_id\": 9, \"task_title\": \"تسجيل الشركة في الضرائب\", \"assigned_by\": \"مدير النظام\"}', 45, 43, 0, NULL, '2025-09-12 21:16:39', '2025-09-12 21:16:39'),
(15, 'task_assigned', 'تكليف مهمة', 'تم تكليفك بمهمة \"وثائق شركه سعودية\" من قبل مدير النظام.', '{\"task_id\": 14, \"task_title\": \"وثائق شركه سعودية\", \"assigned_by\": \"مدير النظام\"}', 44, 43, 1, '2025-09-12 23:48:27', '2025-09-12 23:37:30', '2025-09-12 23:48:27'),
(16, 'task_status_changed', 'تم تحديث حالة المهمة', 'تم تغيير حالة المهمة \"وثائق شركه سعودية\" من \"جديدة\" إلى \"قيد التنفيذ\" من قبل موظف وثائق.', '{\"task_id\": 14, \"changed_by\": \"موظف وثائق\", \"new_status\": \"in_progress\", \"old_status\": \"new\", \"task_title\": \"وثائق شركه سعودية\", \"new_status_name\": \"قيد التنفيذ\", \"old_status_name\": \"جديدة\"}', 43, 44, 0, NULL, '2025-09-12 23:49:27', '2025-09-16 23:12:07'),
(17, 'task_created', 'مهمة جديدة مُكلفة', 'تم تكليفك بمهمة جديدة \"{title}\".', '{\"task_id\": 15, \"task_title\": \"asdfs\", \"assigned_by\": \"مدير النظام\"}', 32, 43, 0, NULL, '2025-09-16 17:37:18', '2025-09-16 17:37:18'),
(18, 'task_assigned', 'تكليف مهمة', 'تم تكليفك بمهمة \"وثائق شركه سعودية\" من قبل مدير النظام.', '{\"task_id\": 14, \"task_title\": \"وثائق شركه سعودية\", \"assigned_by\": \"مدير النظام\"}', 44, 43, 0, NULL, '2025-09-16 18:22:52', '2025-09-16 18:22:52'),
(19, 'task_assigned', 'تكليف مهمة', 'تم تكليفك بمهمة \"وثائق شركه سعودية\" من قبل مدير النظام.', '{\"task_id\": 14, \"task_title\": \"وثائق شركه سعودية\", \"assigned_by\": \"مدير النظام\"}', 44, 43, 0, NULL, '2025-09-16 19:19:10', '2025-09-16 19:19:10'),
(20, 'task_assigned', 'تكليف مهمة', 'تم تكليفك بمهمة \"وثائق شركه سعودية\" من قبل مدير النظام.', '{\"task_id\": 14, \"task_title\": \"وثائق شركه سعودية\", \"assigned_by\": \"مدير النظام\"}', 44, 43, 0, NULL, '2025-09-16 19:23:14', '2025-09-16 19:23:14'),
(21, 'task_assigned', 'تكليف مهمة', 'تم تكليفك بمهمة \"وثائق شركه سعودية\" من قبل مدير النظام.', '{\"task_id\": 14, \"task_title\": \"وثائق شركه سعودية\", \"assigned_by\": \"مدير النظام\"}', 44, 43, 0, NULL, '2025-09-16 19:56:57', '2025-09-16 19:56:57'),
(22, 'task_assigned', 'تكليف مهمة', 'تم تكليفك بمهمة \"وثائق شركه سعودية\" من قبل مدير النظام.', '{\"task_id\": 14, \"task_title\": \"وثائق شركه سعودية\", \"assigned_by\": \"مدير النظام\"}', 44, 43, 0, NULL, '2025-09-16 20:55:35', '2025-09-16 20:55:35'),
(75, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" لـ \"Mccall Clarke LLC\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 1, \"entity_name\": \"Mccall Clarke LLC\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"company\"}', 22, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(76, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"VAT Registration\" لـ \"Rojas Bean Trading\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 2, \"entity_name\": \"Rojas Bean Trading\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"VAT Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 22, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(77, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"Commercial Registration\" لـ \"Hubbard Dotson Plc\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 4, \"entity_name\": \"Hubbard Dotson Plc\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"Commercial Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 22, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(78, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"National ID\" لـ \"Yetta Lyons (Hubbard Dotson Plc)\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 2, \"entity_name\": \"Yetta Lyons (Hubbard Dotson Plc)\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"National ID\", \"days_until_expiry\": 1, \"document_category\": \"employee\"}', 22, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(79, 'expiring_documents_summary', 'ملخص الوثائق المنتهية الصلاحية', 'يوجد 4 وثيقة ستنتهي خلال 30 أيام القادمة. وثائق الموظفين: 1، وثائق الشركات: 3.', '{\"days_ahead\": 30, \"total_expiring\": 4, \"company_documents\": 3, \"employee_documents\": 1}', 22, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(80, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" لـ \"Mccall Clarke LLC\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 1, \"entity_name\": \"Mccall Clarke LLC\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"company\"}', 23, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(81, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"VAT Registration\" لـ \"Rojas Bean Trading\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 2, \"entity_name\": \"Rojas Bean Trading\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"VAT Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 23, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(82, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"Commercial Registration\" لـ \"Hubbard Dotson Plc\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 4, \"entity_name\": \"Hubbard Dotson Plc\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"Commercial Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 23, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(83, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"National ID\" لـ \"Yetta Lyons (Hubbard Dotson Plc)\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 2, \"entity_name\": \"Yetta Lyons (Hubbard Dotson Plc)\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"National ID\", \"days_until_expiry\": 1, \"document_category\": \"employee\"}', 23, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(84, 'expiring_documents_summary', 'ملخص الوثائق المنتهية الصلاحية', 'يوجد 4 وثيقة ستنتهي خلال 30 أيام القادمة. وثائق الموظفين: 1، وثائق الشركات: 3.', '{\"days_ahead\": 30, \"total_expiring\": 4, \"company_documents\": 3, \"employee_documents\": 1}', 23, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(85, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" لـ \"Mccall Clarke LLC\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 1, \"entity_name\": \"Mccall Clarke LLC\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"company\"}', 27, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(86, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"VAT Registration\" لـ \"Rojas Bean Trading\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 2, \"entity_name\": \"Rojas Bean Trading\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"VAT Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 27, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(87, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"Commercial Registration\" لـ \"Hubbard Dotson Plc\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 4, \"entity_name\": \"Hubbard Dotson Plc\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"Commercial Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 27, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(88, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"National ID\" لـ \"Yetta Lyons (Hubbard Dotson Plc)\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 2, \"entity_name\": \"Yetta Lyons (Hubbard Dotson Plc)\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"National ID\", \"days_until_expiry\": 1, \"document_category\": \"employee\"}', 27, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(89, 'expiring_documents_summary', 'ملخص الوثائق المنتهية الصلاحية', 'يوجد 4 وثيقة ستنتهي خلال 30 أيام القادمة. وثائق الموظفين: 1، وثائق الشركات: 3.', '{\"days_ahead\": 30, \"total_expiring\": 4, \"company_documents\": 3, \"employee_documents\": 1}', 27, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(90, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" لـ \"Mccall Clarke LLC\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 1, \"entity_name\": \"Mccall Clarke LLC\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"company\"}', 30, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(91, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"VAT Registration\" لـ \"Rojas Bean Trading\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 2, \"entity_name\": \"Rojas Bean Trading\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"VAT Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 30, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(92, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"Commercial Registration\" لـ \"Hubbard Dotson Plc\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 4, \"entity_name\": \"Hubbard Dotson Plc\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"Commercial Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 30, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(93, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"National ID\" لـ \"Yetta Lyons (Hubbard Dotson Plc)\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 2, \"entity_name\": \"Yetta Lyons (Hubbard Dotson Plc)\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"National ID\", \"days_until_expiry\": 1, \"document_category\": \"employee\"}', 30, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(94, 'expiring_documents_summary', 'ملخص الوثائق المنتهية الصلاحية', 'يوجد 4 وثيقة ستنتهي خلال 30 أيام القادمة. وثائق الموظفين: 1، وثائق الشركات: 3.', '{\"days_ahead\": 30, \"total_expiring\": 4, \"company_documents\": 3, \"employee_documents\": 1}', 30, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(95, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" لـ \"Mccall Clarke LLC\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 1, \"entity_name\": \"Mccall Clarke LLC\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"company\"}', 43, NULL, 1, '2025-09-16 23:15:48', '2025-09-16 22:31:11', '2025-09-16 23:15:48'),
(97, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"Commercial Registration\" لـ \"Hubbard Dotson Plc\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 4, \"entity_name\": \"Hubbard Dotson Plc\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"Commercial Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 43, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 23:12:00'),
(98, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"National ID\" لـ \"Yetta Lyons (Hubbard Dotson Plc)\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 2, \"entity_name\": \"Yetta Lyons (Hubbard Dotson Plc)\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"National ID\", \"days_until_expiry\": 1, \"document_category\": \"employee\"}', 43, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 23:12:02'),
(99, 'expiring_documents_summary', 'ملخص الوثائق المنتهية الصلاحية', 'يوجد 4 وثيقة ستنتهي خلال 30 أيام القادمة. وثائق الموظفين: 1، وثائق الشركات: 3.', '{\"days_ahead\": 30, \"total_expiring\": 4, \"company_documents\": 3, \"employee_documents\": 1}', 43, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 23:12:05'),
(100, 'document_expiring_soon', 'وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" ستنتهي خلال 1 أيام في 2025-09-19. يرجى اتخاذ الإجراءات اللازمة.', '{\"document_id\": 1, \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"employee\"}', 44, NULL, 0, NULL, '2025-09-16 22:31:11', '2025-09-16 22:31:11'),
(101, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" لـ \"Mccall Clarke LLC\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 1, \"entity_name\": \"Mccall Clarke LLC\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"company\"}', 22, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(102, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"VAT Registration\" لـ \"Rojas Bean Trading\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 2, \"entity_name\": \"Rojas Bean Trading\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"VAT Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 22, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(103, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"Commercial Registration\" لـ \"Hubbard Dotson Plc\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 4, \"entity_name\": \"Hubbard Dotson Plc\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"Commercial Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 22, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(104, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"National ID\" لـ \"Yetta Lyons (Hubbard Dotson Plc)\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 2, \"entity_name\": \"Yetta Lyons (Hubbard Dotson Plc)\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"National ID\", \"days_until_expiry\": 1, \"document_category\": \"employee\"}', 22, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(105, 'expiring_documents_summary', 'ملخص الوثائق المنتهية الصلاحية', 'يوجد 4 وثيقة ستنتهي خلال 30 أيام القادمة. وثائق الموظفين: 1، وثائق الشركات: 3.', '{\"days_ahead\": 30, \"total_expiring\": 4, \"company_documents\": 3, \"employee_documents\": 1}', 22, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(106, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" لـ \"Mccall Clarke LLC\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 1, \"entity_name\": \"Mccall Clarke LLC\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"company\"}', 23, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(107, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"VAT Registration\" لـ \"Rojas Bean Trading\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 2, \"entity_name\": \"Rojas Bean Trading\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"VAT Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 23, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(108, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"Commercial Registration\" لـ \"Hubbard Dotson Plc\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 4, \"entity_name\": \"Hubbard Dotson Plc\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"Commercial Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 23, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(109, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"National ID\" لـ \"Yetta Lyons (Hubbard Dotson Plc)\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 2, \"entity_name\": \"Yetta Lyons (Hubbard Dotson Plc)\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"National ID\", \"days_until_expiry\": 1, \"document_category\": \"employee\"}', 23, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(110, 'expiring_documents_summary', 'ملخص الوثائق المنتهية الصلاحية', 'يوجد 4 وثيقة ستنتهي خلال 30 أيام القادمة. وثائق الموظفين: 1، وثائق الشركات: 3.', '{\"days_ahead\": 30, \"total_expiring\": 4, \"company_documents\": 3, \"employee_documents\": 1}', 23, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(111, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" لـ \"Mccall Clarke LLC\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 1, \"entity_name\": \"Mccall Clarke LLC\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"company\"}', 27, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(112, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"VAT Registration\" لـ \"Rojas Bean Trading\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 2, \"entity_name\": \"Rojas Bean Trading\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"VAT Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 27, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(113, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"Commercial Registration\" لـ \"Hubbard Dotson Plc\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 4, \"entity_name\": \"Hubbard Dotson Plc\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"Commercial Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 27, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(114, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"National ID\" لـ \"Yetta Lyons (Hubbard Dotson Plc)\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 2, \"entity_name\": \"Yetta Lyons (Hubbard Dotson Plc)\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"National ID\", \"days_until_expiry\": 1, \"document_category\": \"employee\"}', 27, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(115, 'expiring_documents_summary', 'ملخص الوثائق المنتهية الصلاحية', 'يوجد 4 وثيقة ستنتهي خلال 30 أيام القادمة. وثائق الموظفين: 1، وثائق الشركات: 3.', '{\"days_ahead\": 30, \"total_expiring\": 4, \"company_documents\": 3, \"employee_documents\": 1}', 27, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(116, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" لـ \"Mccall Clarke LLC\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 1, \"entity_name\": \"Mccall Clarke LLC\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"company\"}', 30, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(117, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"VAT Registration\" لـ \"Rojas Bean Trading\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 2, \"entity_name\": \"Rojas Bean Trading\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"VAT Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 30, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(118, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"Commercial Registration\" لـ \"Hubbard Dotson Plc\" ستنتهي خلال 0 أيام في 2025-09-17.', '{\"document_id\": 4, \"entity_name\": \"Hubbard Dotson Plc\", \"expiry_date\": \"2025-09-17\", \"document_type\": \"Commercial Registration\", \"days_until_expiry\": 0, \"document_category\": \"company\"}', 30, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(119, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"National ID\" لـ \"Yetta Lyons (Hubbard Dotson Plc)\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 2, \"entity_name\": \"Yetta Lyons (Hubbard Dotson Plc)\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"National ID\", \"days_until_expiry\": 1, \"document_category\": \"employee\"}', 30, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(120, 'expiring_documents_summary', 'ملخص الوثائق المنتهية الصلاحية', 'يوجد 4 وثيقة ستنتهي خلال 30 أيام القادمة. وثائق الموظفين: 1، وثائق الشركات: 3.', '{\"days_ahead\": 30, \"total_expiring\": 4, \"company_documents\": 3, \"employee_documents\": 1}', 30, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50'),
(121, 'admin_document_expiring_soon', 'تنبيه وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" لـ \"Mccall Clarke LLC\" ستنتهي خلال 1 أيام في 2025-09-19.', '{\"document_id\": 1, \"entity_name\": \"Mccall Clarke LLC\", \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"company\"}', 43, NULL, 1, '2025-09-16 23:12:55', '2025-09-16 22:42:50', '2025-09-16 23:12:55'),
(125, 'expiring_documents_summary', 'ملخص الوثائق المنتهية الصلاحية', 'يوجد 4 وثيقة ستنتهي خلال 30 أيام القادمة. وثائق الموظفين: 1، وثائق الشركات: 3.', '{\"days_ahead\": 30, \"total_expiring\": 4, \"company_documents\": 3, \"employee_documents\": 1}', 43, NULL, 1, '2025-09-16 23:15:31', '2025-09-16 22:42:50', '2025-09-16 23:15:31'),
(126, 'document_expiring_soon', 'وثيقة ستنتهي قريباً', 'الوثيقة \"GOSI Registration\" ستنتهي خلال 1 أيام في 2025-09-19. يرجى اتخاذ الإجراءات اللازمة.', '{\"document_id\": 1, \"expiry_date\": \"2025-09-19\", \"document_type\": \"GOSI Registration\", \"days_until_expiry\": 1, \"document_category\": \"employee\"}', 44, NULL, 0, NULL, '2025-09-16 22:42:50', '2025-09-16 22:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `max_employees` int DEFAULT NULL,
  `max_employee_documents` int DEFAULT NULL,
  `max_company_documents` int DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `max_employees`, `max_employee_documents`, `max_company_documents`, `price`, `duration`, `created_at`, `updated_at`) VALUES
(1, 'الباقه الفضية', 'Molestiae magna fugi', 5, 5, 5, 500.00, 12, '2025-09-07 23:34:55', '2025-09-12 20:14:20'),
(5, 'الباقة الذهبية', 'Suscipit aliquid fug', 20, 10, 10, 1000.00, 12, '2025-09-07 23:48:19', '2025-09-12 20:14:32'),
(7, 'الباقه البلاتينيه', NULL, NULL, NULL, NULL, 2000.00, 12, '2025-09-12 19:34:10', '2025-09-12 19:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@example.com', '$2y$12$FwpKak2YqIuWG4YRTFzTHObZkDOT6IhecL5jnruTVHptN4/4iOQIG', '2025-08-29 05:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_dashboard', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(4, 'view_users', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(5, 'create_users', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(6, 'update_users', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(7, 'delete_users', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(9, 'view_roles', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(10, 'create_roles', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(11, 'update_roles', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(12, 'delete_roles', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(13, 'view_permissions', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(14, 'assign_permissions', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(15, 'view_all_clients', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(16, 'view_assigned_clients', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(17, 'create_clients', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(18, 'update_clients', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(19, 'delete_clients', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(21, 'view_client_employees', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(22, 'create_client_employees', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(23, 'update_client_employees', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(24, 'delete_client_employees', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(25, 'view_all_documents', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(26, 'view_assigned_documents', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(27, 'upload_documents', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(28, 'update_documents', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(29, 'delete_documents', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(30, 'download_documents', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(32, 'view_all_tasks', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(33, 'view_assigned_tasks', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(34, 'create_tasks', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(35, 'update_tasks', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(36, 'delete_tasks', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(38, 'complete_tasks', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(39, 'view_all_notifications', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(40, 'view_own_notifications', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(41, 'create_notifications', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(42, 'mark_notifications_read', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(43, 'delete_notifications', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(44, 'view_financial_packages', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(45, 'create_financial_packages', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(46, 'update_financial_packages', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(47, 'delete_financial_packages', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(48, 'assign_packages_to_clients', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(51, 'view_client_reports', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(53, 'create_permissions', 'web', '2025-08-29 04:52:09', '2025-08-29 04:52:09'),
(54, 'delete_permissions', 'web', '2025-08-29 04:52:09', '2025-08-29 04:52:09'),
(56, 'view_company_documents', 'web', '2025-08-29 14:45:17', '2025-08-29 14:45:17'),
(57, 'create_company_documents', 'web', '2025-08-29 14:45:17', '2025-08-29 14:45:17'),
(58, 'update_company_documents', 'web', '2025-08-29 14:45:17', '2025-08-29 14:45:17'),
(59, 'delete_company_documents', 'web', '2025-08-29 14:45:17', '2025-08-29 14:45:17'),
(60, 'manage_civil_defense_licenses', 'web', '2025-08-29 14:45:17', '2025-08-29 14:45:17'),
(61, 'manage_municipality_licenses', 'web', '2025-08-29 14:45:17', '2025-08-29 14:45:17'),
(62, 'manage_branch_registrations', 'web', '2025-08-29 14:45:17', '2025-08-29 14:45:17'),
(63, 'view_document_dashboard', 'web', '2025-08-29 14:45:17', '2025-08-29 14:45:17'),
(64, 'view_document_types', 'web', '2025-08-30 06:15:30', '2025-08-30 06:15:30'),
(65, 'create_document_types', 'web', '2025-08-30 06:15:30', '2025-08-30 06:15:30'),
(66, 'update_document_types', 'web', '2025-08-30 06:15:30', '2025-08-30 06:15:30'),
(67, 'delete_document_types', 'web', '2025-08-30 06:15:30', '2025-08-30 06:15:30'),
(69, 'renew_client_packages', 'web', '2025-09-08 01:06:50', '2025-09-08 01:06:50'),
(70, 'cancel_client_packages', 'web', '2025-09-08 01:06:50', '2025-09-08 01:06:50'),
(71, 'manage_task_documents', 'web', '2025-09-16 18:08:03', '2025-09-16 18:08:03'),
(72, 'view_employee_monitoring', 'web', '2025-09-17 00:29:26', '2025-09-17 00:29:26'),
(73, 'view_employee_login_logs', 'web', '2025-09-17 00:29:26', '2025-09-17 00:29:26'),
(74, 'view_employee_activity_logs', 'web', '2025-09-17 00:29:26', '2025-09-17 00:29:26'),
(75, 'view_employee_click_tracking', 'web', '2025-09-17 00:29:26', '2025-09-17 00:29:26'),
(76, 'view_employee_screen_time', 'web', '2025-09-17 00:29:26', '2025-09-17 00:29:26'),
(77, 'view_employee_screenshots', 'web', '2025-09-17 00:29:26', '2025-09-17 00:29:26'),
(78, 'manage_employee_monitoring', 'web', '2025-09-17 00:29:26', '2025-09-17 00:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 13, 'test-token', '69c9dbbf611adc03149b47cceabcef9c467feac75a0bf35a81ff64b6c5168d2b', '[\"*\"]', NULL, NULL, '2025-09-17 00:50:51', '2025-09-17 00:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-08-26 23:06:32', '2025-08-26 23:06:32'),
(2, 'employee', 'web', '2025-08-26 23:06:32', '2025-08-29 07:57:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(38, 1),
(40, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(51, 1),
(53, 1),
(54, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(16, 2),
(21, 2),
(26, 2),
(28, 2),
(30, 2),
(33, 2),
(35, 2),
(38, 2),
(40, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `assigned_to` bigint UNSIGNED NOT NULL,
  `status` enum('new','in_progress','completed','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `due_date` date DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_to`, `status`, `due_date`, `created_by`, `created_at`, `updated_at`) VALUES
(14, 'وثائق شركه سعودية', 'عليك بتجديد هذه الوثائق فى اسرع وقت', 44, 'in_progress', '2025-09-14', 43, '2025-09-12 23:33:44', '2025-09-12 23:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `task_documents`
--

CREATE TABLE `task_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED NOT NULL,
  `document_type` enum('company_document','employee_document','civil_defense','municipality','branch_registration') COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_documents`
--

INSERT INTO `task_documents` (`id`, `task_id`, `document_type`, `document_id`, `created_at`, `updated_at`) VALUES
(14, 14, 'company_document', 1, '2025-09-16 20:55:35', '2025-09-16 20:55:35'),
(15, 14, 'employee_document', 1, '2025-09-16 20:55:35', '2025-09-16 20:55:35'),
(16, 14, 'civil_defense', 1, '2025-09-16 20:55:35', '2025-09-16 20:55:35'),
(17, 14, 'branch_registration', 1, '2025-09-16 20:55:35', '2025-09-16 20:55:35'),
(18, 14, 'municipality', 1, '2025-09-16 20:55:35', '2025-09-16 20:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `task_histories`
--

CREATE TABLE `task_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` json DEFAULT NULL,
  `new_value` json DEFAULT NULL,
  `changed_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_histories`
--

INSERT INTO `task_histories` (`id`, `task_id`, `action`, `old_value`, `new_value`, `changed_by`, `created_at`, `updated_at`) VALUES
(41, 14, 'created', NULL, '{\"title\": \"asddsadfdf\", \"status\": \"new\", \"due_date\": \"2025-09-13\", \"assigned_to\": \"موظف وثائق\", \"client_name\": \"Hubbard Dotson Plc\", \"description\": \"asdfasdsf\", \"documents_count\": 2}', 43, '2025-09-12 23:33:44', '2025-09-12 23:33:44'),
(42, 14, 'updated', '{\"due_date\": \"2025-09-13T00:00:00.000000Z\"}', '{\"due_date\": \"2025-09-14T00:00:00.000000Z\"}', 43, '2025-09-12 23:35:59', '2025-09-12 23:35:59'),
(43, 14, 'updated', '{\"title\": \"asddsadfdf\", \"description\": \"asdfasdsf\"}', '{\"title\": \"وثائق شركه سعودية\", \"description\": \"عليك بتجديد هذه الوثائق فى اسرع وقت\"}', 43, '2025-09-12 23:37:30', '2025-09-12 23:37:30'),
(44, 14, 'updated', '{\"status\": \"new\"}', '{\"status\": \"in_progress\"}', 44, '2025-09-12 23:49:27', '2025-09-12 23:49:27'),
(45, 14, 'status_changed', '{\"status\": \"new\"}', '{\"status\": \"in_progress\"}', 44, '2025-09-12 23:49:27', '2025-09-12 23:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `national_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Saudi National ID',
  `preferred_language` enum('ar','en') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `last_login_at`, `national_id`, `preferred_language`, `avatar`, `address`, `created_by`, `phone_number`, `remember_token`, `created_at`, `updated_at`) VALUES
(13, 'Angelica Gleason', 'bednar.golden@example.net', '2025-03-29 18:19:33', '$2y$12$w/AEdANDBaZXPcza8QVlM.0NkPFKPNxSN0eiNhO4a9iQyrhd3fib6', 'active', '2025-09-17 01:11:25', NULL, 'ar', NULL, NULL, NULL, '+1.458.386.9122', 'zyIjEODGya', '2025-03-29 18:19:42', '2025-09-17 01:11:25'),
(22, 'Aubrey Brakus', 'tryan@example.org', '2025-03-29 18:19:36', '$2y$12$ztAYWpdEU1OzX5rPnlFiBO4e2DZ8Ekqb8zSAt760rF5s.tMU76wOC', 'active', NULL, NULL, 'ar', NULL, NULL, NULL, '+1 (360) 780-6324', 'SUSRitr9U6', '2025-03-29 18:19:42', '2025-03-29 18:19:42'),
(23, 'Cayla Schimmel', 'huel.yasmine@example.org', '2025-03-29 18:19:36', '$2y$12$3k7/YT3KTuckFNiRNCDDdO7.vnB543Bxp.8gjKWhj9kyAIZmzpAG6', 'active', NULL, NULL, 'ar', NULL, NULL, NULL, '+1-231-932-6929', '30SriKP6GE', '2025-03-29 18:19:42', '2025-03-29 18:19:42'),
(27, 'Allen Rutherford', 'icie.dare@example.org', '2025-03-29 18:19:37', '$2y$12$4zHI6NvW9SZveeGQ3u/7Ie.Um5dc3XG.RrGhdoiOMq12zXLnS7dIq', 'inactive', NULL, '12342134', 'en', NULL, 'asdfasdfasafd', NULL, '+553-42375678568', 'uxoodb0pQ0', '2025-03-29 18:19:42', '2025-08-29 06:18:50'),
(30, 'Alda Auer DVM', 'mertie.sawayn@example.com', '2025-03-29 18:19:38', '$2y$12$oswZCyHg8K9AbPh1QjeAcO6JhSKS3RUoDSBgD1GRUTAdSTCpbCAtS', 'inactive', NULL, NULL, 'ar', NULL, NULL, NULL, '847-669-4241', 'VUDxSbS6B5', '2025-03-29 18:19:43', '2025-08-29 06:08:09'),
(32, 'Clotilde Stamm Jr.', 'stacy.waters@example.net', '2025-03-29 18:19:38', '$2y$12$Hlcj/5n4v0LHo45oKDh6LuQwD8AwN9B72QAGT49bs73.eMn3OaKG.', 'active', NULL, NULL, 'ar', NULL, NULL, NULL, '240.429.9759', 'woJy53I4GF', '2025-03-29 18:19:43', '2025-03-29 18:19:43'),
(43, 'مدير النظام', 'admin@example.com', '2025-08-26 23:06:33', '$2y$12$NA48WfZMms4wWANRs2NXLOlxmku8NGtZgZrug2bTfv.cs6.t5z1ki', 'active', '2025-09-17 13:19:09', '1234567890', 'ar', NULL, 'الرياض، المملكة العربية السعودية', NULL, '+966500000001', NULL, '2025-08-26 23:06:33', '2025-09-17 14:00:38'),
(44, 'موظف وثائق', 'employee@example.com', '2025-08-26 23:06:33', '$2y$12$cT9zJV7YwJ/pUQaZlVftC.PrBkkAt4YiT..MKf8wcuUa4G9C9PtO2', 'active', '2025-09-17 00:56:10', '0987654321', 'ar', NULL, 'جدة، المملكة العربية السعودية', 43, '+966500000002', NULL, '2025-08-26 23:06:33', '2025-09-17 00:56:10'),
(45, 'أحمد محمد العبدالله', 'ahmed@example.com', '2025-08-26 23:06:33', '$2y$12$Dxb.9UGwlAWQLhUTushR7u9bVjhKJHNwpStBi.gWlMa/72YMVwQdO', 'active', NULL, '1111111111', 'ar', NULL, 'المملكة العربية السعودية', 43, '+966500000003', NULL, '2025-08-26 23:06:33', '2025-08-26 23:06:33'),
(46, 'فاطمة علي الأحمد', 'fatima@example.com', '2025-08-26 23:06:34', '$2y$12$cMdtXJtdCIC2EeNad7zLQ.gmAFmX2MAHFUn4PjLoq2kUz46R9O.Me', 'active', '2025-08-27 00:35:42', '2222222222', 'ar', NULL, 'المملكة العربية السعودية', 43, '+966500000004', NULL, '2025-08-26 23:06:34', '2025-08-27 00:35:42'),
(47, 'محمد عبدالرحمن السعد', 'mohammed@example.com', '2025-08-26 23:06:34', '$2y$12$mkits7E8TCbdoo82ZX94r.T4meLAhsDsBdkOw5clFVzSb.AppAB/q', 'active', NULL, '3333333333', 'ar', NULL, 'المملكة العربية السعودية', 43, '+966500000005', NULL, '2025-08-26 23:06:34', '2025-08-26 23:06:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch_commercial_registrations`
--
ALTER TABLE `branch_commercial_registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branch_commercial_registrations_branch_reg_number_unique` (`branch_reg_number`),
  ADD KEY `branch_commercial_registrations_branch_reg_number_index` (`branch_reg_number`),
  ADD KEY `branch_commercial_registrations_parent_cr_number_index` (`parent_cr_number`),
  ADD KEY `branch_commercial_registrations_company_id_index` (`company_id`),
  ADD KEY `branch_commercial_registrations_manager_id_number_index` (`manager_id_number`),
  ADD KEY `branch_commercial_registrations_expiry_date_index` (`expiry_date`),
  ADD KEY `branch_commercial_registrations_enable_reminder_index` (`enable_reminder`),
  ADD KEY `branch_commercial_registrations_reminder_days_index` (`reminder_days`);

--
-- Indexes for table `civil_defense_licenses`
--
ALTER TABLE `civil_defense_licenses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `civil_defense_licenses_license_number_unique` (`license_number`),
  ADD KEY `civil_defense_licenses_license_number_index` (`license_number`),
  ADD KEY `civil_defense_licenses_company_id_index` (`company_id`),
  ADD KEY `civil_defense_licenses_expiry_date_index` (`expiry_date`),
  ADD KEY `civil_defense_licenses_safety_status_inspection_status_index` (`safety_status`,`inspection_status`),
  ADD KEY `civil_defense_licenses_enable_reminder_index` (`enable_reminder`),
  ADD KEY `civil_defense_licenses_reminder_days_index` (`reminder_days`);

--
-- Indexes for table `client_packages`
--
ALTER TABLE `client_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_packages_client_id_foreign` (`client_id`),
  ADD KEY `client_packages_package_id_foreign` (`package_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_cr_number_unique` (`cr_number`),
  ADD KEY `companies_company_name_ar_company_name_en_index` (`company_name_ar`,`company_name_en`),
  ADD KEY `companies_cr_number_index` (`cr_number`),
  ADD KEY `companies_tax_number_index` (`tax_number`),
  ADD KEY `companies_region_city_index` (`region`,`city`);

--
-- Indexes for table `company_documents`
--
ALTER TABLE `company_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_documents_document_type_id_foreign` (`document_type_id`),
  ADD KEY `company_documents_company_id_document_type_id_index` (`company_id`,`document_type_id`),
  ADD KEY `company_documents_status_enable_reminder_index` (`status`,`enable_reminder`),
  ADD KEY `company_documents_reminder_days_index` (`reminder_days`);

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `document_types_code_unique` (`code`),
  ADD KEY `document_types_category_entity_type_index` (`category`,`entity_type`),
  ADD KEY `document_types_code_index` (`code`),
  ADD KEY `document_types_is_active_sort_order_index` (`is_active`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_company_id_status_index` (`company_id`,`status`),
  ADD KEY `employees_national_id_index` (`national_id`),
  ADD KEY `employees_iqama_number_index` (`iqama_number`),
  ADD KEY `employees_passport_number_index` (`passport_number`),
  ADD KEY `employees_full_name_ar_full_name_en_index` (`full_name_ar`,`full_name_en`),
  ADD KEY `employees_hire_date_index` (`hire_date`);

--
-- Indexes for table `employee_active_screen_time`
--
ALTER TABLE `employee_active_screen_time`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_active_screen_time_user_id_date_session_start_unique` (`user_id`,`date`,`session_start`),
  ADD KEY `employee_active_screen_time_user_id_date_index` (`user_id`,`date`),
  ADD KEY `employee_active_screen_time_date_total_seconds_index` (`date`,`total_seconds`);

--
-- Indexes for table `employee_activity_logs`
--
ALTER TABLE `employee_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_activity_logs_user_id_created_at_index` (`user_id`,`created_at`),
  ADD KEY `employee_activity_logs_action_type_created_at_index` (`action_type`,`created_at`),
  ADD KEY `employee_activity_logs_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `employee_click_tracking`
--
ALTER TABLE `employee_click_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_click_tracking_user_id_clicked_at_index` (`user_id`,`clicked_at`),
  ADD KEY `employee_click_tracking_page_url_clicked_at_index` (`page_url`,`clicked_at`);

--
-- Indexes for table `employee_documents`
--
ALTER TABLE `employee_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_documents_employee_id_document_type_index` (`employee_id`),
  ADD KEY `employee_documents_document_type_id_foreign` (`document_type_id`),
  ADD KEY `employee_documents_status_enable_reminder_index` (`status`,`enable_reminder`),
  ADD KEY `employee_documents_reminder_days_index` (`reminder_days`);

--
-- Indexes for table `employee_login_logs`
--
ALTER TABLE `employee_login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_login_logs_user_id_login_at_index` (`user_id`,`login_at`),
  ADD KEY `employee_login_logs_status_login_at_index` (`status`,`login_at`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_client_id_foreign` (`client_id`),
  ADD KEY `invoices_package_id_foreign` (`package_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `municipality_licenses`
--
ALTER TABLE `municipality_licenses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `municipality_licenses_license_number_unique` (`license_number`),
  ADD KEY `municipality_licenses_license_number_index` (`license_number`),
  ADD KEY `municipality_licenses_company_id_index` (`company_id`),
  ADD KEY `municipality_licenses_municipality_name_index` (`municipality_name`),
  ADD KEY `municipality_licenses_expiry_date_index` (`expiry_date`),
  ADD KEY `municipality_licenses_license_type_index` (`license_type`),
  ADD KEY `municipality_licenses_enable_reminder_index` (`enable_reminder`),
  ADD KEY `municipality_licenses_reminder_days_index` (`reminder_days`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_created_by_foreign` (`created_by`),
  ADD KEY `notifications_user_id_is_read_index` (`user_id`,`is_read`),
  ADD KEY `notifications_type_created_at_index` (`type`,`created_at`),
  ADD KEY `notifications_created_at_index` (`created_at`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_created_by_foreign` (`created_by`),
  ADD KEY `tasks_status_index` (`status`),
  ADD KEY `tasks_assigned_to_index` (`assigned_to`),
  ADD KEY `tasks_due_date_index` (`due_date`);

--
-- Indexes for table `task_documents`
--
ALTER TABLE `task_documents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `task_documents_task_id_document_type_document_id_unique` (`task_id`,`document_type`,`document_id`),
  ADD KEY `task_documents_task_id_index` (`task_id`),
  ADD KEY `task_documents_document_type_document_id_index` (`document_type`,`document_id`);

--
-- Indexes for table `task_histories`
--
ALTER TABLE `task_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_histories_task_id_index` (`task_id`),
  ADD KEY `task_histories_action_index` (`action`),
  ADD KEY `task_histories_changed_by_index` (`changed_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD UNIQUE KEY `users_national_id_unique` (`national_id`),
  ADD KEY `users_created_by_foreign` (`created_by`),
  ADD KEY `users_status_index` (`status`),
  ADD KEY `users_preferred_language_index` (`preferred_language`),
  ADD KEY `users_last_login_at_index` (`last_login_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch_commercial_registrations`
--
ALTER TABLE `branch_commercial_registrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `civil_defense_licenses`
--
ALTER TABLE `civil_defense_licenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client_packages`
--
ALTER TABLE `client_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `company_documents`
--
ALTER TABLE `company_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_active_screen_time`
--
ALTER TABLE `employee_active_screen_time`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_activity_logs`
--
ALTER TABLE `employee_activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1705;

--
-- AUTO_INCREMENT for table `employee_click_tracking`
--
ALTER TABLE `employee_click_tracking`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `employee_documents`
--
ALTER TABLE `employee_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_login_logs`
--
ALTER TABLE `employee_login_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `municipality_licenses`
--
ALTER TABLE `municipality_licenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `task_documents`
--
ALTER TABLE `task_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `task_histories`
--
ALTER TABLE `task_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch_commercial_registrations`
--
ALTER TABLE `branch_commercial_registrations`
  ADD CONSTRAINT `branch_commercial_registrations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `civil_defense_licenses`
--
ALTER TABLE `civil_defense_licenses`
  ADD CONSTRAINT `civil_defense_licenses_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_packages`
--
ALTER TABLE `client_packages`
  ADD CONSTRAINT `client_packages_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_packages_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_documents`
--
ALTER TABLE `company_documents`
  ADD CONSTRAINT `company_documents_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_documents_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_active_screen_time`
--
ALTER TABLE `employee_active_screen_time`
  ADD CONSTRAINT `employee_active_screen_time_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_activity_logs`
--
ALTER TABLE `employee_activity_logs`
  ADD CONSTRAINT `employee_activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_click_tracking`
--
ALTER TABLE `employee_click_tracking`
  ADD CONSTRAINT `employee_click_tracking_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_documents`
--
ALTER TABLE `employee_documents`
  ADD CONSTRAINT `employee_documents_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `employee_documents_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_login_logs`
--
ALTER TABLE `employee_login_logs`
  ADD CONSTRAINT `employee_login_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `municipality_licenses`
--
ALTER TABLE `municipality_licenses`
  ADD CONSTRAINT `municipality_licenses_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task_documents`
--
ALTER TABLE `task_documents`
  ADD CONSTRAINT `task_documents_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task_histories`
--
ALTER TABLE `task_histories`
  ADD CONSTRAINT `task_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_histories_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
