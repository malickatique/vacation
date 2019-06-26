-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2019 at 09:31 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vacation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `imageurl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `job_title`, `status`, `imageurl`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@test.com', '$2y$10$.QNmjTb/pp0Uow/Jl.stg.FUvxqzXy0yzs90mOIBvtRD7j9f/AFrS', 'super-admin', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 'Rawalpindi', 1, NULL, NULL),
(2, 'Islamabad', 1, NULL, NULL),
(3, 'Lahore', 1, NULL, NULL),
(4, 'Karachi', 2, NULL, NULL),
(5, 'Nawab Shah', 2, NULL, NULL),
(6, 'Gawadar', 2, NULL, NULL),
(7, 'Peshawar', 3, NULL, NULL),
(8, 'Mardan', 3, NULL, NULL),
(9, 'Kurram Agency', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'name', 'OVR', '2019-06-11 05:37:29', NULL),
(2, 'description', 'Propert Rental', '2019-06-11 05:37:29', NULL),
(3, 'logo', '', '2019-06-11 05:37:29', NULL),
(4, 'favicon', '', '2019-06-11 05:37:29', NULL),
(5, 'contact_us_email', 'info@ovr.com', '2019-06-11 05:37:29', NULL),
(6, 'phone', '111128128', '2019-06-11 05:37:29', NULL),
(7, 'currency', 'Dollar', '2019-06-11 05:37:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `sortname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonecode` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`, `created_at`, `updated_at`) VALUES
(1, 'Pak', 'Pakistan', 92, NULL, NULL),
(2, 'Ind', 'India', 91, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplate`
--

CREATE TABLE `emailtemplate` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_questions`
--

CREATE TABLE `faq_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Center Cooling', NULL, NULL),
(2, 'Balcony', NULL, NULL),
(3, 'Pet Friendly', NULL, NULL),
(4, 'Barbeque', NULL, NULL),
(5, 'Fire Alarm', NULL, NULL),
(6, 'Modern Kitchen', NULL, NULL),
(7, 'Storage', NULL, NULL),
(8, 'Dryer', NULL, NULL),
(9, 'Heating', NULL, NULL),
(10, 'Pool', NULL, NULL),
(11, 'Laundry', NULL, NULL),
(12, 'Sauna', NULL, NULL),
(13, 'Gym', NULL, NULL),
(14, 'Elevator', NULL, NULL),
(15, 'Dish Washer', NULL, NULL),
(16, 'Emergency Exit', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grid_boxes`
--

CREATE TABLE `grid_boxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `section_heading` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_heading_paragraph` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grid_boxes_metadata`
--

CREATE TABLE `grid_boxes_metadata` (
  `id` int(10) UNSIGNED NOT NULL,
  `grid_box_id` int(11) NOT NULL,
  `box_heading` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `box_paragraph` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `conversation_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `conversation_id`, `image`, `receiver_id`, `message`, `created_at`, `updated_at`) VALUES
(4, 1, '1_2', NULL, 2, '1', '2019-06-11 06:50:31', '2019-06-11 06:50:31'),
(5, 1, '1_2', NULL, 2, 'Hi', '2019-06-11 06:52:56', '2019-06-11 06:52:56'),
(6, 2, '1_2', NULL, 1, 'Yes, test', '2019-06-11 06:53:09', '2019-06-11 06:53:09'),
(7, 1, '1_2', NULL, 2, 'Want to know about....', '2019-06-11 06:53:20', '2019-06-11 06:53:20'),
(8, 2, '1_2', NULL, 1, 'Some info...', '2019-06-11 06:53:26', '2019-06-11 06:53:26'),
(9, 2, '1_2', NULL, 1, 'additional', '2019-06-11 06:53:31', '2019-06-11 06:53:31'),
(10, 1, '1_2', NULL, 2, 'response', '2019-06-11 06:53:38', '2019-06-11 06:53:38'),
(11, 2, '1_2', NULL, 1, 'goes on', '2019-06-11 06:53:46', '2019-06-11 06:53:46'),
(12, 1, '1_2', NULL, 2, 'test time', '2019-06-11 07:24:56', '2019-06-11 07:24:56'),
(13, 2, '1_2', NULL, 1, 'no repeate', '2019-06-11 07:25:29', '2019-06-11 07:25:29'),
(14, 1, '1_2', NULL, 2, 'once', '2019-06-11 07:31:02', '2019-06-11 07:31:02'),
(15, 3, '2_3', NULL, 2, 'hello', '2019-06-11 09:56:24', '2019-06-11 09:56:24'),
(16, 5, '2_5', NULL, 2, 'hello', '2019-06-11 09:57:30', '2019-06-11 09:57:30'),
(17, 2, '2_5', NULL, 5, 'hi', '2019-06-11 09:58:24', '2019-06-11 09:58:24'),
(18, 5, '2_5', NULL, 2, '2', '2019-06-11 09:59:00', '2019-06-11 09:59:00'),
(19, 2, '2_3', NULL, 3, 'y', '2019-06-11 09:59:59', '2019-06-11 09:59:59'),
(20, 2, '2_3', NULL, 3, 'reply', '2019-06-11 10:00:15', '2019-06-11 10:00:15'),
(21, 3, '2_3', NULL, 2, 'confrmen', '2019-06-11 10:00:24', '2019-06-11 10:00:24'),
(22, 3, '2_3', NULL, 2, 'once', '2019-06-11 10:00:41', '2019-06-11 10:00:41'),
(23, 2, '1_2', NULL, 1, 'from owner\n ad', '2019-06-11 10:01:32', '2019-06-11 10:01:32'),
(24, 3, '2_3', NULL, 2, '1', '2019-06-11 10:02:09', '2019-06-11 10:02:09'),
(25, 2, '2_3', NULL, 3, '2', '2019-06-11 10:02:18', '2019-06-11 10:02:18'),
(26, 3, '2_3', NULL, 2, '333', '2019-06-11 10:05:35', '2019-06-11 10:05:35'),
(27, 2, '2_3', NULL, 3, '000', '2019-06-11 10:06:07', '2019-06-11 10:06:07'),
(28, 3, '2_3', NULL, 2, '111', '2019-06-11 10:06:13', '2019-06-11 10:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_05_114045_create_pages_table', 1),
(4, '2019_03_08_101125_create_user_types_table', 1),
(5, '2019_03_13_112500_create_configurations_table', 1),
(6, '2019_03_14_071052_create_properties_table', 1),
(7, '2019_03_14_071430_create_property_metadata_table', 1),
(8, '2019_03_14_072020_create_property_sites_table', 1),
(9, '2019_03_14_072253_create_property_features_table', 1),
(10, '2019_03_14_072409_create_property_templates_table', 1),
(11, '2019_03_14_072533_create_features_table', 1),
(12, '2019_03_14_113750_create_property_gallary_table', 1),
(13, '2019_03_20_074811_create_admins_table', 1),
(14, '2019_03_25_100407_create_emailTemplate_table', 1),
(15, '2019_03_28_060040_create_user_metadata_table', 1),
(16, '2019_03_28_060208_create_user_billing_info_table', 1),
(17, '2019_03_28_112637_create_property_occasion_table', 1),
(18, '2019_04_02_123427_create_countries_table', 1),
(19, '2019_04_02_130631_create_cities_table', 1),
(20, '2019_04_02_131821_create_states_table', 1),
(21, '2019_04_10_060052_create_pages_feature_table', 1),
(22, '2019_04_10_080129_create_faq_categories_table', 1),
(23, '2019_04_10_080229_create_faq_questions_table', 1),
(24, '2019_04_10_095452_create_pages_gallary_table', 1),
(25, '2019_04_10_113628_create_pages_contact_table', 1),
(26, '2019_04_10_125448_create_grid_boxes_table', 1),
(27, '2019_04_10_125541_create_grid_boxes_metadata_table', 1),
(28, '2019_04_15_060408_create_settings_table', 1),
(29, '2019_04_16_104549_create_subscriptions_table', 1),
(30, '2019_04_16_104701_create_subscription_features_table', 1),
(31, '2019_05_19_143151_create_messages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages_contact`
--

CREATE TABLE `pages_contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `map` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages_feature`
--

CREATE TABLE `pages_feature` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `feature` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages_gallary`
--

CREATE TABLE `pages_gallary` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `user_id`, `template_id`, `name`, `description`, `address`, `thumbnail`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'House for rent', 'Some text about description here. Some text about description here. Some text about description here. Some text about description here.', 'Islamabad, Pakistan', '1560244211.jpeg', 'rent', '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(2, 2, 1, 'House for sale', 'Property description here..Property description here..Property description here..Property description here..Property description here..', 'Larkana, Sindh', '1560324509.png', 'sale', '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(3, 4, 1, 'Apartment for Rent', 'vSome Description Some Description Some Description Some DescriptionSome Description', 'Sibbi, Sindh', '1560324633.jpeg', 'rent', '2019-06-12 04:30:34', '2019-06-12 04:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `property_features`
--

CREATE TABLE `property_features` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_features`
--

INSERT INTO `property_features` (`id`, `property_id`, `feature_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(2, 1, 6, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(3, 1, 11, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(4, 1, 4, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(5, 1, 16, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(6, 1, 7, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(7, 1, 10, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(8, 1, 13, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(9, 2, 1, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(10, 2, 5, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(11, 2, 9, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(12, 2, 10, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(13, 2, 6, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(14, 2, 2, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(15, 2, 7, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(16, 2, 11, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(17, 2, 4, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(18, 2, 8, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(19, 2, 16, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(20, 3, 1, '2019-06-12 04:30:34', '2019-06-12 04:30:34'),
(21, 3, 13, '2019-06-12 04:30:34', '2019-06-12 04:30:34'),
(22, 3, 14, '2019-06-12 04:30:34', '2019-06-12 04:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `property_gallary`
--

CREATE TABLE `property_gallary` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `media` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_gallary`
--

INSERT INTO `property_gallary` (`id`, `property_id`, `media`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, '1560244230.jpeg', 1, '2019-06-11 06:10:31', '2019-06-11 06:10:31'),
(2, 1, '1560244231.png', 1, '2019-06-11 06:10:32', '2019-06-11 06:10:32'),
(3, 1, '1560244232.jpeg', 1, '2019-06-11 06:10:33', '2019-06-11 06:10:33'),
(4, 2, '1560324522.png', 1, '2019-06-12 04:28:44', '2019-06-12 04:28:44'),
(5, 2, '1560324524.jpeg', 1, '2019-06-12 04:28:44', '2019-06-12 04:28:44'),
(6, 3, '1560324640.png', 1, '2019-06-12 04:30:41', '2019-06-12 04:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `property_metadata`
--

CREATE TABLE `property_metadata` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `floors` int(11) DEFAULT NULL,
  `garages` int(11) DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_metadata`
--

INSERT INTO `property_metadata` (`id`, `property_id`, `type`, `status`, `location`, `bedrooms`, `bathrooms`, `floors`, `garages`, `area`, `size`, `created_at`, `updated_at`) VALUES
(1, 1, 'house', 'rent', 'Islamabad, Pakistan', 4, 2, 2, 1, 1234, 123, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(2, 2, 'house', 'sale', 'Larkana, Pakistan', 4, 99, 40, 200, 432, 0, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(3, 3, 'apartment', 'rent', 'Sibbi, Sindh', 0, 0, 400, 10, 0, 90, '2019-06-12 04:30:34', '2019-06-12 04:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `property_occasion`
--

CREATE TABLE `property_occasion` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `occasion_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_night_rent` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_occasion`
--

INSERT INTO `property_occasion` (`id`, `property_id`, `occasion_name`, `availability_from`, `availability_to`, `per_night_rent`, `created_at`, `updated_at`) VALUES
(1, 1, 'Eid', '04/06/2019', '23/07/2019', 100, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(2, 1, 'Easter', '11/06/2019', '20/06/2019', 200, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(3, 1, 'Chr', '12/06/2019', '18/06/2019', 23, '2019-06-11 06:10:12', '2019-06-11 06:10:12'),
(4, 2, 'Weekends', '01/06/2019', '02/06/2019', 10, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(5, 2, '14 August', NULL, NULL, 123, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(6, 2, 'Eid', NULL, NULL, 123, '2019-06-12 04:28:31', '2019-06-12 04:28:31'),
(7, 3, 'Some Occassion', '11/06/2019', '16/07/2019', 1232, '2019-06-12 04:30:34', '2019-06-12 04:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `property_sites`
--

CREATE TABLE `property_sites` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `site_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_templates`
--

CREATE TABLE `property_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `template_type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'site_logo', NULL, 1, NULL, NULL),
(2, 'site_sticky_logo', NULL, 1, NULL, NULL),
(3, 'footer_logo', NULL, 1, NULL, NULL),
(4, 'footer_desc', NULL, 1, NULL, NULL),
(5, 'footer_contact', NULL, 1, NULL, NULL),
(6, 'footer_email', NULL, 1, NULL, NULL),
(7, 'footer_trademark', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Punjab', 1, NULL, NULL),
(2, 'Sindh', 1, NULL, NULL),
(3, 'KPK', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_feature`
--

CREATE TABLE `subscription_feature` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `feature_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `user_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type`, `password`, `status`, `user_image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Renter Ab', 'renter@test.com', 'renter', '$2y$10$cc9Ulok6QCCCozlQtOQpouCc/xzYGG2H0WbaWiOyTd4iBds9LIb0u', 2, '1560242431.png', 'rbc0FqBYGCFoEMKgTE2gemsjz4WvemEGullJsytWsrNvMmkP9dKxc3r9X5Rp', '2019-06-11 05:40:31', '2019-06-11 05:40:31'),
(2, 'Owner Ad', 'owner@test.com', 'owner', '$2y$10$XNXU5JJ8Dvya4vGpHUiSku4TPB5Z8S4mjsVC.b7Q6o.i77G88rLVi', 2, '1560242513.png', 'lXlVhWDoQD7EAA5FKtWvozIJ4BWij5IvPwuvxYN4xiPbnxp7UHLug5Gec97t', '2019-06-11 05:41:53', '2019-06-11 05:41:53'),
(3, 'Renter 2', 'renter2@test.com', 'renter', '$2y$10$JDHt9IZ9oyVIHTcGkoPpSempR1wql8i5ewy0/hlwDOwGV.GmcTNSa', 2, '1560255560.png', 'dH6ei8e4UnlVrhTIWsBmHnY9ZQhD9Dqb7hDcpWmDijIclck8x8HxnOCNScRx', '2019-06-11 09:19:20', '2019-06-11 09:19:20'),
(4, 'Owner 2', 'owner2@test.com', 'owner', '$2y$10$oe332u2evoRWNPnGZ1Mtn.jRQdlv0ifQxwu4aWn8IXshW9wcdw296', 2, '1560255625.png', NULL, '2019-06-11 09:20:25', '2019-06-11 09:20:25'),
(5, 'Renter 3', 'renter3@test.com', 'renter', '$2y$10$RtjYrS7NRzkdqfne8JDUQuUyTLwQfNW9kKIejobCjSq.xg1tlLGMW', 2, '1560256323.png', 'I1Fb5ZV1JcPAhHYLN0nQqeJ8gbJhyASXKN5LCpDxVVroGNaexrczsc7I90Uh', '2019-06-11 09:32:04', '2019-06-11 09:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_billing_info`
--

CREATE TABLE `user_billing_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_month` int(11) NOT NULL,
  `exp_year` int(11) NOT NULL,
  `sec_code` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_billing_info`
--

INSERT INTO `user_billing_info` (`id`, `user_id`, `card_number`, `exp_month`, `exp_year`, `sec_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '2', '4111111111111111', 12, 2019, 111, NULL, '2019-06-11 05:41:53', '2019-06-11 05:41:53'),
(2, '4', '4111111111111111', 12, 2019, 111, NULL, '2019-06-11 09:20:25', '2019-06-11 09:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_metadata`
--

CREATE TABLE `user_metadata` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driving_license` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_metadata`
--

INSERT INTO `user_metadata` (`id`, `user_id`, `name`, `surname`, `city`, `state`, `zip`, `address`, `number`, `driving_license`, `created_at`, `updated_at`) VALUES
(1, 1, 'Renter', 'Ab', '9', '3', '4300', 'Peshawar', '03122345654', '1560242431.PNG', '2019-06-11 05:40:31', '2019-06-11 05:40:31'),
(2, 2, 'Owner', 'Ad', '2', '1', '43000', 'Islamabad', '03001243769', '1560242513.PNG', '2019-06-11 05:41:53', '2019-06-11 05:41:53'),
(3, 3, 'Renter', '2', '6', '2', '43000', 'asd', '03122345654', '1560255560.jpg', '2019-06-11 09:19:20', '2019-06-11 09:19:20'),
(4, 4, 'Owner', '2', '8', '3', '43000', 'asd', '03122345654', '1560255625.jpg', '2019-06-11 09:20:25', '2019-06-11 09:20:25'),
(5, 5, 'Renter', '3', '3', '1', '123123', 'sd', '03122345654', '1560256324.jpg', '2019-06-11 09:32:04', '2019-06-11 09:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'this is admin', NULL, NULL),
(2, 'owner', 'this is owner', NULL, NULL),
(3, 'guest', 'this is guest', NULL, NULL),
(4, 'renter', 'this is renter', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailtemplate`
--
ALTER TABLE `emailtemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_questions`
--
ALTER TABLE `faq_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grid_boxes`
--
ALTER TABLE `grid_boxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grid_boxes_metadata`
--
ALTER TABLE `grid_boxes_metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_contact`
--
ALTER TABLE `pages_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_feature`
--
ALTER TABLE `pages_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_gallary`
--
ALTER TABLE `pages_gallary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_features`
--
ALTER TABLE `property_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_gallary`
--
ALTER TABLE `property_gallary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_metadata`
--
ALTER TABLE `property_metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_occasion`
--
ALTER TABLE `property_occasion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_sites`
--
ALTER TABLE `property_sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_templates`
--
ALTER TABLE `property_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_feature`
--
ALTER TABLE `subscription_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_billing_info`
--
ALTER TABLE `user_billing_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_metadata`
--
ALTER TABLE `user_metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emailtemplate`
--
ALTER TABLE `emailtemplate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_questions`
--
ALTER TABLE `faq_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `grid_boxes`
--
ALTER TABLE `grid_boxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grid_boxes_metadata`
--
ALTER TABLE `grid_boxes_metadata`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages_contact`
--
ALTER TABLE `pages_contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages_feature`
--
ALTER TABLE `pages_feature`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages_gallary`
--
ALTER TABLE `pages_gallary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_features`
--
ALTER TABLE `property_features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `property_gallary`
--
ALTER TABLE `property_gallary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `property_metadata`
--
ALTER TABLE `property_metadata`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_occasion`
--
ALTER TABLE `property_occasion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `property_sites`
--
ALTER TABLE `property_sites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_templates`
--
ALTER TABLE `property_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_feature`
--
ALTER TABLE `subscription_feature`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_billing_info`
--
ALTER TABLE `user_billing_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_metadata`
--
ALTER TABLE `user_metadata`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
