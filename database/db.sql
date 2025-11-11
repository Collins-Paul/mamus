-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 07, 2023 at 01:22 AM
-- Server version: 10.6.14-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u502262744_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_logos`
--

CREATE TABLE `app_logos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'default-logo.png',
  `logo` varchar(255) NOT NULL DEFAULT 'default-logo.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_logos`
--

INSERT INTO `app_logos` (`id`, `icon`, `logo`, `created_at`, `updated_at`) VALUES
(1, '20230625074951.png', '20230625074940.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `photo`, `heading`, `description`, `created_at`, `updated_at`) VALUES
(2, '20230603111925.png', 'Day Trading', 'Best Overall Broker', '2023-06-03 10:19:25', '2023-06-03 10:19:25'),
(3, '20230603112307.jpg', 'Investigoal Best Broker Awards', 'Best Fixed Spread Broker', '2023-06-03 10:23:07', '2023-06-03 10:23:07'),
(4, '20230603112413.png', 'Compare Forex Broker 2021', 'Best Fixed Spread Broker', '2023-06-03 10:24:13', '2023-06-03 10:24:13'),
(5, '20230603112446.png', 'Investigoal 2022', 'Best Fixed Spread Broker', '2023-06-03 10:24:46', '2023-06-03 10:24:46'),
(6, '20230603113845.png', 'Forex Broker 2021', 'No.1 Innovation', '2023-06-03 10:38:45', '2023-06-03 10:38:45'),
(7, '20230603113928.jpg', 'Investigoal Best Broker Awards', 'Best Mobile Trading Platform', '2023-06-03 10:39:28', '2023-06-03 10:39:28'),
(9, '20230603114143.png', 'Global Business Review Magazine 2021', 'Best Retail Broker UAE', '2023-06-03 10:41:43', '2023-06-03 10:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `capital` varchar(255) NOT NULL DEFAULT '0.00',
  `profit` varchar(255) NOT NULL DEFAULT '0.00',
  `balance` varchar(255) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`id`, `user_id`, `capital`, `profit`, `balance`, `created_at`, `updated_at`) VALUES
(17, 21, '0.00', '22.5', '1093.089293242', NULL, '2023-06-29 15:56:15'),
(22, 26, '0.00', '0.00', '0.00', NULL, NULL),
(24, 28, '0.00', '0.00', '0.00', NULL, NULL),
(25, 29, '0.00', '26563', '3100', NULL, '2023-08-06 16:16:45'),
(28, 32, '0.00', '0.00', '0.00', NULL, NULL),
(31, 35, '0.00', '1019', '1000', NULL, '2023-08-06 16:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_1` varchar(255) DEFAULT NULL,
  `phone_2` varchar(255) DEFAULT NULL,
  `address` tinytext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `phone_1`, `phone_2`, `address`, `created_at`, `updated_at`) VALUES
(1, '+15053714142', 'N/A', 'Griffith Corporate Centre Beachmont, Kingstown, St. Vincent and the Grenadines', NULL, '2023-07-12 05:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `copiers`
--

CREATE TABLE `copiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `copier_id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) NOT NULL,
  `master_name` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `copy_proportion` varchar(255) NOT NULL,
  `order_type` varchar(255) NOT NULL,
  `commission_copy_trade` varchar(255) NOT NULL,
  `currency_pair` varchar(255) NOT NULL,
  `lot_size` varchar(255) NOT NULL,
  `profit_or_loss` varchar(255) NOT NULL,
  `open_price` varchar(255) NOT NULL,
  `current_price` varchar(255) DEFAULT NULL,
  `close_price` varchar(255) DEFAULT NULL,
  `market` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'opened',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demo_accounts`
--

CREATE TABLE `demo_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `investment_plans`
--

CREATE TABLE `investment_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_title` varchar(255) NOT NULL,
  `interest_percent` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `min_deposit` varchar(255) NOT NULL,
  `max_deposit` varchar(255) NOT NULL,
  `deposit_return` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investment_plans`
--

INSERT INTO `investment_plans` (`id`, `plan_title`, `interest_percent`, `duration`, `min_deposit`, `max_deposit`, `deposit_return`, `created_at`, `updated_at`) VALUES
(1, 'Starter', '10', '2', '1000', '2000', 'Yes', '2023-06-10 18:14:19', '2023-06-10 18:14:19'),
(3, 'Advanced', '30', '4', '3001', '4000', 'Yes', '2023-06-11 03:30:27', '2023-06-11 03:30:27'),
(4, 'Gold', '35', '6', '4100', '5100', 'Yes', '2023-06-11 03:32:03', '2023-06-11 03:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `live_chat_apps`
--

CREATE TABLE `live_chat_apps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `script` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `live_chat_apps`
--

INSERT INTO `live_chat_apps` (`id`, `url`, `script`, `created_at`, `updated_at`) VALUES
(1, 'https://tawk.to/chat/649dd1ea94cf5d49dc60997b/default', '<!--Start of Tawk.to Script-->\r\n<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/649dd1ea94cf5d49dc60997b/default\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>\r\n<!--End of Tawk.to Script-->', NULL, '2023-06-29 18:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `management_teams`
--

CREATE TABLE `management_teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'dummy-profile-pic.png',
  `staff_name` varchar(255) NOT NULL,
  `staff_position` varchar(255) NOT NULL,
  `description` varchar(350) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `management_teams`
--

INSERT INTO `management_teams` (`id`, `photo`, `staff_name`, `staff_position`, `description`, `created_at`, `updated_at`) VALUES
(3, '20230603062310.png', 'Sarah Thompson', 'VP Risk Management', 'Sarah Thompson serves as our VP of Risk Management, overseeing the development and implementation of robust risk management strategies. With a keen eye for market trends and a meticulous approach, Sarah works diligently to mitigate risks and protect our clients\' interests, ensuring a secure trading environment.', '2023-06-03 03:27:13', '2023-06-03 03:27:13'),
(2, '20230602152807.png', 'Sarah Thompson', 'VP Risk Management', 'Sarah Thompson serves as our VP of Risk Management, overseeing the development and implementation of robust risk management strategies. With a keen eye for market trends and a meticulous approach, Sarah works diligently to mitigate risks and protect our clients\' interests, ensuring a secure trading environment.', '2023-06-02 14:28:07', '2023-06-02 14:28:07'),
(4, '20230603042821.png', 'David Chen', 'VP Compliance', 'David Chen holds the crucial role of VP of Compliance at RBC-Market. With extensive knowledge of regulatory frameworks and industry standards, David ensures that our platform adheres to all relevant regulations and operates with the utmost integrity. He is dedicated to maintaining transparency and upholding the highest compliance standards.', '2023-06-03 03:28:21', '2023-06-03 03:28:21'),
(5, '20230603042859.png', 'Emily Roberts', 'CFO', 'Emily Roberts serves as our Chief Financial Officer, responsible for managing the financial operations and strategies of RBC-Market. With a strong financial background and analytical acumen, Emily oversees budgeting, financial reporting, and strategic financial decision-making, ensuring the financial health and stability of our platform.', '2023-06-03 03:28:59', '2023-06-03 03:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `master_traders`
--

CREATE TABLE `master_traders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `master_id` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'master_default_photo.png',
  `description` longtext DEFAULT NULL,
  `minimum_investment` varchar(255) DEFAULT NULL,
  `risk_score` varchar(255) DEFAULT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `commission` varchar(255) NOT NULL DEFAULT '0',
  `capital` varchar(255) NOT NULL DEFAULT '0.00',
  `balance` varchar(255) NOT NULL DEFAULT '0.00',
  `bonus` varchar(255) NOT NULL DEFAULT '0.00',
  `profit` varchar(255) NOT NULL DEFAULT '0',
  `loss` varchar(255) NOT NULL DEFAULT '0',
  `master_trader_bonus` varchar(255) NOT NULL DEFAULT '0',
  `leverage` varchar(255) DEFAULT NULL,
  `equity` varchar(255) NOT NULL DEFAULT '0',
  `max_unrealised_loss` varchar(255) NOT NULL DEFAULT '0',
  `max_drawndown_duration` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2023_03_01_020942_create_balances_table', 2),
(15, '2023_03_01_141913_create_wallets_table', 4),
(18, '2023_03_01_120423_create_trans_history_table', 5),
(22, '2023_04_05_032625_create_master_traders_table', 6),
(23, '2023_04_05_042256_create_copiers_table', 6),
(24, '2023_04_08_091627_create_orders_table', 7),
(25, '2023_04_26_234505_create_demo_accounts_table', 7),
(26, '2023_05_01_043615_create_subscription_table', 7),
(27, '2023_05_13_163115_create_referrals_table', 8),
(28, '2023_05_14_123051_create_settings_table', 9),
(29, '2023_05_14_151556_create_withdrawal_cards_table', 9),
(30, '2023_05_16_142939_create_sub_plans_table', 10),
(31, '2023_06_02_062351_create_testimonies_table', 11),
(32, '2023_06_02_062535_create_awards_table', 11),
(33, '2023_06_02_080619_create_management_teams_table', 11),
(34, '2023_06_02_080733_create_app_logos_table', 11),
(35, '2023_06_10_095749_create_live_chat_apps_table', 12),
(36, '2023_06_10_121014_create_investment_plans_table', 12),
(37, '2023_06_10_122103_create_contact_details_table', 13),
(39, '2023_06_11_052656_create_user_investments_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `who` bigint(20) UNSIGNED NOT NULL,
  `user` bigint(20) UNSIGNED NOT NULL,
  `currency_pair` varchar(255) DEFAULT NULL,
  `order_type` varchar(255) DEFAULT NULL,
  `lot_size` varchar(255) DEFAULT NULL,
  `profit_or_loss` varchar(255) DEFAULT '0.00',
  `open_price` varchar(255) DEFAULT NULL,
  `current_price` varchar(255) DEFAULT NULL,
  `close_price` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) NOT NULL,
  `robot_id` varchar(255) DEFAULT NULL,
  `market` varchar(255) DEFAULT NULL,
  `method` varchar(255) NOT NULL DEFAULT 'manual',
  `amount` varchar(255) NOT NULL DEFAULT '0',
  `commission_paid` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'opened',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `who`, `user`, `currency_pair`, `order_type`, `lot_size`, `profit_or_loss`, `open_price`, `current_price`, `close_price`, `order_id`, `robot_id`, `market`, `method`, `amount`, `commission_paid`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 21, 'USD/JPY', 'sell', '0.01', '12.5', '144.703', '144.675', '144.675', 'c0ml1', NULL, 'forex', 'manual', '6.9107067579801', NULL, 'closed', '2023-06-29 15:54:58', '2023-06-29 15:54:58'),
(2, 0, 25, 'BTCUSDT', 'buy', '0.06', '408', '30428.07', '30414', '30414', 'jk7svsi35j', '1946741919', 'crypto', 'robot', '1000', NULL, 'closed', '2023-06-29 21:12:17', '2023-06-29 21:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `count` varchar(255) NOT NULL DEFAULT '0',
  `bonus` varchar(255) NOT NULL DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `user_id`, `count`, `bonus`, `code`, `created_at`, `updated_at`) VALUES
(14, 20, '12', '600', '17jaadxcfz', '2023-05-18 13:59:57', '2023-05-18 13:59:57'),
(15, 21, '0', '0', 'w73rv9sctw', '2023-06-13 13:53:12', '2023-06-13 13:53:12'),
(16, 22, '0', '0', 'b0f1dki05x', '2023-06-26 00:08:35', '2023-06-26 00:08:35'),
(17, 23, '0', '0', 'ojnbehu950', '2023-06-26 00:53:39', '2023-06-26 00:53:39'),
(18, 24, '0', '0', 'hvve6ra57t', '2023-06-26 19:12:13', '2023-06-26 19:12:13'),
(19, 25, '0', '0', '33v3ltc9jl', '2023-06-29 19:15:57', '2023-06-29 19:15:57'),
(20, 26, '0', '0', 'hpvz5t2j4r', '2023-06-30 00:05:50', '2023-06-30 00:05:50'),
(21, 27, '0', '0', 'ixstqoxccj', '2023-06-30 18:59:13', '2023-06-30 18:59:13'),
(22, 28, '0', '0', 'ckpku23375', '2023-06-30 19:49:18', '2023-06-30 19:49:18'),
(23, 29, '0', '0', 'xy5kkpkenz', '2023-06-30 20:29:17', '2023-06-30 20:29:17'),
(24, 30, '0', '0', '1jqc8j3kbf', '2023-07-05 11:29:55', '2023-07-05 11:29:55'),
(25, 31, '0', '0', 't8r1qw1z84', '2023-07-06 07:18:08', '2023-07-06 07:18:08'),
(26, 32, '0', '0', 'vq5exjj0kb', '2023-07-08 12:40:02', '2023-07-08 12:40:02'),
(27, 33, '0', '0', 'irtel8prpu', '2023-07-19 14:28:01', '2023-07-19 14:28:01'),
(28, 34, '0', '0', 'n4abf49tmh', '2023-07-22 17:25:10', '2023-07-22 17:25:10'),
(29, 35, '0', '0', 'ecf5jne0xc', '2023-08-03 21:24:24', '2023-08-03 21:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `demo` varchar(255) NOT NULL DEFAULT '1',
  `robot` varchar(255) NOT NULL DEFAULT '1',
  `min_withdrawal` varchar(255) NOT NULL DEFAULT '0',
  `min_deposit` varchar(255) NOT NULL DEFAULT '0',
  `referral_price` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `demo`, `robot`, `min_withdrawal`, `min_deposit`, `referral_price`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '0', '0', '50', '2023-05-22 14:03:48', '2023-05-22 14:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `features` text DEFAULT NULL,
  `weeks` varchar(255) NOT NULL,
  `percentage` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `heading`, `price`, `features`, `weeks`, `percentage`, `created_at`, `updated_at`) VALUES
(7, 'Classic Robot', '2000', NULL, '8', '80', '2023-06-28 06:19:49', '2023-06-28 06:19:49'),
(6, 'Basic Robot I', '1000', NULL, '4', '75', '2023-06-28 06:18:59', '2023-06-28 06:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `sub_plans`
--

CREATE TABLE `sub_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_title` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `purchase_date` varchar(255) DEFAULT NULL,
  `exp_date` varchar(255) DEFAULT NULL,
  `reciept` varchar(255) DEFAULT NULL,
  `robot_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_plans`
--

INSERT INTO `sub_plans` (`id`, `user_id`, `plan_title`, `price`, `purchase_date`, `exp_date`, `reciept`, `robot_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 21, '1 Week Free', '1000', '13th Jun, 2023', '20th Jun, 2023', '', '2811211742', 'active', '2023-06-13 13:53:12', '2023-06-13 13:53:12'),
(6, 20, 'Billed Weekly', '5000', '19th May, 2023', '26th May, 2023', '20230519213217.png', '5443625578', 'expired', '2023-05-19 20:32:17', '2023-06-21 09:21:17'),
(8, 22, '1 Week Free', '1000', '26th Jun, 2023', '03rd Jul, 2023', '', '9451424839', 'active', '2023-06-26 00:08:35', '2023-06-26 00:08:35'),
(9, 23, '1 Week Free', '1000', '26th Jun, 2023', '03rd Jul, 2023', '', '5540728240', 'active', '2023-06-26 00:53:39', '2023-06-26 00:53:39'),
(10, 24, '1 Week Free', '1000', '26th Jun, 2023', '03rd Jul, 2023', '', '8037356481', 'active', '2023-06-26 19:12:13', '2023-06-26 19:12:13'),
(11, 25, '1 Week Free', '1000', '29th Jun, 2023', '06th Jul, 2023', '', '1946741919', 'active', '2023-06-29 19:15:57', '2023-06-29 19:15:57'),
(12, 26, '1 Week Free', '1000', '30th Jun, 2023', '07th Jul, 2023', '', '7828647691', 'active', '2023-06-30 00:05:50', '2023-06-30 00:05:50'),
(13, 27, '1 Week Free', '1000', '30th Jun, 2023', '07th Jul, 2023', '', '2286191558', 'active', '2023-06-30 18:59:14', '2023-06-30 18:59:14'),
(14, 28, '1 Week Free', '1000', '30th Jun, 2023', '07th Jul, 2023', '', '1908020841', 'expired', '2023-06-30 19:49:18', '2023-07-14 10:55:43'),
(15, 29, '1 Week Free', '1000', '30th Jun, 2023', '07th Jul, 2023', '', '4104783431', 'active', '2023-06-30 20:29:17', '2023-06-30 20:29:17'),
(16, 30, '1 Week Free', '1000', '05th Jul, 2023', '12th Jul, 2023', '', '3731766621', 'active', '2023-07-05 11:29:55', '2023-07-05 11:29:55'),
(17, 31, '1 Week Free', '1000', '06th Jul, 2023', '13th Jul, 2023', '', '7270906847', 'active', '2023-07-06 07:18:08', '2023-07-06 07:18:08'),
(18, 32, '1 Week Free', '1000', '08th Jul, 2023', '15th Jul, 2023', '', '6535611295', 'active', '2023-07-08 12:40:02', '2023-07-08 12:40:02'),
(19, 33, '1 Week Free', '1000', '19th Jul, 2023', '26th Jul, 2023', '', '1305127875', 'active', '2023-07-19 14:28:01', '2023-07-19 14:28:01'),
(20, 34, '1 Week Free', '1000', '22nd Jul, 2023', '29th Jul, 2023', '', '0516706356', 'active', '2023-07-22 17:25:10', '2023-07-22 17:25:10'),
(21, 35, '1 Week Free', '1000', '03rd Aug, 2023', '10th Aug, 2023', '', '9595615480', 'active', '2023-08-03 21:24:24', '2023-08-03 21:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `testimonies`
--

CREATE TABLE `testimonies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `investor` varchar(255) NOT NULL,
  `testimony` varchar(350) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonies`
--

INSERT INTO `testimonies` (`id`, `photo`, `investor`, `testimony`, `country`, `created_at`, `updated_at`) VALUES
(2, '20230603132511.png', 'David Lee', 'I\'ve had an exceptional experience with RBC-Market\'s withdrawal process. Funds are processed quickly and efficiently, reflecting their commitment to customer satisfaction.', NULL, '2023-06-03 12:25:11', '2023-06-03 12:25:11'),
(3, '20230603133932.png', 'Emily Thompson', 'I\'ve been using your forex, crypto, and copy trading platform for a few months now, and I must say it\'s been a game-changer for me. The user-friendly interface and the expertly curated trading options have helped me earn consistent profits. Thank you!', NULL, '2023-06-03 12:39:32', '2023-06-03 12:39:32'),
(4, NULL, 'John Martinez', 'I\'ve tried numerous online trading platforms, but yours stands out from the rest. The copy trading feature has allowed me to replicate the success of experienced traders and grow my investment portfolio exponentially. I highly recommend it!', NULL, '2023-06-03 12:40:49', '2023-06-03 12:40:49'),
(5, NULL, 'Samantha Anderson', 'As a beginner in the world of forex and crypto trading, your platform has been a lifesaver. The educational resources and intuitive interface have helped me understand the market better and make profitable trades. It\'s been a fantastic learning experience!', NULL, '2023-06-03 12:42:47', '2023-06-03 12:42:47'),
(6, NULL, 'David Johnson', 'I\'ve been using your platform for a while now, and I\'m amazed at the results. The advanced tools and real-time market analysis have enabled me to make informed decisions and maximize my profits. It\'s definitely one of the best trading platforms out there!', NULL, '2023-06-03 12:43:50', '2023-06-03 12:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `trans_history`
--

CREATE TABLE `trans_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) NOT NULL,
  `method` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `wallet_address` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `ref` varchar(255) NOT NULL DEFAULT 'N/A',
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `channel` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trans_history`
--

INSERT INTO `trans_history` (`id`, `user_id`, `amount`, `method`, `type`, `wallet_address`, `status`, `ref`, `updated_at`, `created_at`, `channel`, `bank_name`, `account_number`, `swift_code`) VALUES
(23, 21, '100', NULL, 'deposit', NULL, 'completed', 'xpepfbkhapk52t69i3mj2aq1jycy9k', '2023-06-28 06:00:26', '2023-06-28 06:00:26', NULL, NULL, NULL, NULL),
(24, 21, '10', NULL, 'deposit', NULL, 'completed', 'ju3cu6zirz7qsrjqltimw9a8d8jbbq', '2023-06-28 06:00:56', '2023-06-28 06:00:56', NULL, NULL, NULL, NULL),
(25, 21, '1000', NULL, 'deposit', NULL, 'completed', '67wbv6atqnarthpexap2hjhd6zd8w9', '2023-06-29 15:53:12', '2023-06-29 15:53:12', NULL, NULL, NULL, NULL),
(30, 29, '1100', 'Bitcoin  (P2PKH)', 'deposit', '13yxrJggnCXjR4mca2ULGjdvMwYoC8scXk', 'completed', 'bu6skkpp3ss646sb6dflk2d5iwo821', '2023-07-02 02:48:01', '2023-07-02 00:41:17', NULL, NULL, NULL, NULL),
(31, 29, '28', NULL, 'deposit', NULL, 'completed', 'tu5txtxlti1d7jee9qubowp4y077ds', '2023-07-02 10:24:47', '2023-07-02 10:24:47', NULL, NULL, NULL, NULL),
(32, 29, '73', NULL, 'deposit', NULL, 'completed', '98pf93onsfwqoe1w2d2sc1y2zqpy8u', '2023-07-02 12:52:56', '2023-07-02 12:52:56', NULL, NULL, NULL, NULL),
(33, 29, '92', NULL, 'deposit', NULL, 'completed', 'c1eebn11owshha70a8d7q4lvca0e2d', '2023-07-02 22:32:56', '2023-07-02 22:32:56', NULL, NULL, NULL, NULL),
(34, 29, '201', NULL, 'deposit', NULL, 'completed', 'fyt7i6nobblhjpl5540nqo1rewku3q', '2023-07-03 07:56:54', '2023-07-03 07:56:54', NULL, NULL, NULL, NULL),
(35, 29, '53', NULL, 'deposit', NULL, 'completed', 'wx3w0jipplytshfa00y4hqowt8ill4', '2023-07-03 14:40:38', '2023-07-03 14:40:38', NULL, NULL, NULL, NULL),
(36, 29, '183', NULL, 'deposit', NULL, 'completed', 'ykk6a0lsfuyz2eey53pewwtue6jt84', '2023-07-03 17:10:08', '2023-07-03 17:10:08', NULL, NULL, NULL, NULL),
(37, 29, '195', NULL, 'deposit', NULL, 'completed', 'j4njmy6aufeqqempzbnzt5wlp3rv7q', '2023-07-03 20:53:45', '2023-07-03 20:53:45', NULL, NULL, NULL, NULL),
(38, 29, '337', NULL, 'deposit', NULL, 'completed', 'fzma5zvdebxndqlm1txjcpd0hstzin', '2023-07-04 07:24:20', '2023-07-04 07:24:20', NULL, NULL, NULL, NULL),
(39, 29, '29', NULL, 'deposit', NULL, 'completed', 'o975jfc3jjfwewqpfqwe96ztl1vcxd', '2023-07-04 16:26:44', '2023-07-04 16:26:44', NULL, NULL, NULL, NULL),
(40, 29, '17', NULL, 'deposit', NULL, 'completed', '3w3tmqpz7e0zaatlohqvwlbe7j661k', '2023-07-04 23:49:42', '2023-07-04 23:49:42', NULL, NULL, NULL, NULL),
(41, 29, '129', NULL, 'deposit', NULL, 'completed', 'k0qlkbyv1biu0yasrqoeowd1887r8q', '2023-07-05 11:37:10', '2023-07-05 11:37:10', NULL, NULL, NULL, NULL),
(42, 29, '388', NULL, 'deposit', NULL, 'completed', 'dz6dobta1mtdqo6bld10wrsjbuj1wm', '2023-07-05 23:36:47', '2023-07-05 23:36:47', NULL, NULL, NULL, NULL),
(43, 29, '291', NULL, 'deposit', NULL, 'completed', 'cit28qq0tm4i6mc0yty95tmrpwen04', '2023-07-06 13:52:58', '2023-07-06 13:52:58', NULL, NULL, NULL, NULL),
(44, 29, '473', NULL, 'deposit', NULL, 'completed', '2r814ddwnnwj3iprqj3wefmpn6e77u', '2023-07-06 17:58:43', '2023-07-06 17:58:43', NULL, NULL, NULL, NULL),
(45, 29, '31', NULL, 'deposit', NULL, 'completed', 'p4wx2jxx10s3ieuu466oounvs1s8h6', '2023-07-07 18:19:41', '2023-07-07 18:19:41', NULL, NULL, NULL, NULL),
(46, 29, '461', NULL, 'deposit', NULL, 'completed', 'hlhmmc2ifiji2oazhuv1jfirf1jbtb', '2023-07-07 23:43:18', '2023-07-07 23:43:18', NULL, NULL, NULL, NULL),
(47, 29, '298', NULL, 'deposit', NULL, 'completed', 'nm8ryr3t9vr0nfc0fxq36fqeddxh8j', '2023-07-08 03:15:35', '2023-07-08 03:15:35', NULL, NULL, NULL, NULL),
(48, 29, '255', NULL, 'deposit', NULL, 'completed', '8bvsvnbsaiz7zlqhj6u79a8ufy3zqh', '2023-07-08 08:43:49', '2023-07-08 08:43:49', NULL, NULL, NULL, NULL),
(49, 29, '171', NULL, 'deposit', NULL, 'completed', 'muhhhybdkbxj65281b3oncfef7d80r', '2023-07-08 14:33:19', '2023-07-08 14:33:19', NULL, NULL, NULL, NULL),
(50, 29, '57', NULL, 'deposit', NULL, 'completed', 'jwc5tzk2vdqfnc7vnwvuueof0hfuiy', '2023-07-08 16:31:00', '2023-07-08 16:31:00', NULL, NULL, NULL, NULL),
(51, 29, '694', NULL, 'deposit', NULL, 'completed', '8efjb0lkzj88boxujq6cy2d9tnwcy9', '2023-07-09 01:07:21', '2023-07-09 01:07:21', NULL, NULL, NULL, NULL),
(52, 29, '220', NULL, 'deposit', NULL, 'completed', '42em1x9mubu2poi6wcw6jndul8c3jf', '2023-07-09 17:02:57', '2023-07-09 17:02:57', NULL, NULL, NULL, NULL),
(53, 29, '103', NULL, 'deposit', NULL, 'completed', 'k3j89tx9t5jj8lcrcpoefp27rrdjhq', '2023-07-09 19:40:18', '2023-07-09 19:40:18', NULL, NULL, NULL, NULL),
(54, 29, '64', NULL, 'deposit', NULL, 'completed', 'c4aj5648204w2q7qc97ee328327ff2', '2023-07-09 23:36:35', '2023-07-09 23:36:35', NULL, NULL, NULL, NULL),
(55, 29, '98', NULL, 'deposit', NULL, 'completed', 'donxj01p1xsn5xza5lv988t294ijr4', '2023-07-10 05:44:06', '2023-07-10 05:44:06', NULL, NULL, NULL, NULL),
(56, 29, '329', NULL, 'deposit', NULL, 'completed', 'knip2ldoa5zwy58fasse6m7hlfbckr', '2023-07-10 11:27:16', '2023-07-10 11:27:16', NULL, NULL, NULL, NULL),
(57, 29, '41', NULL, 'deposit', NULL, 'completed', 'hfwjep8oauemrkbl0kh6amhb6in6rx', '2023-07-10 15:19:04', '2023-07-10 15:19:04', NULL, NULL, NULL, NULL),
(58, 29, '199', NULL, 'deposit', NULL, 'completed', 'aoj6pv8ufuiwfmorsn4naareq1jlz2', '2023-07-11 03:28:33', '2023-07-11 03:28:33', NULL, NULL, NULL, NULL),
(59, 29, '108', NULL, 'deposit', NULL, 'completed', 'lamh0s420wijl9q5c2l54r09ivvjhj', '2023-07-11 11:27:18', '2023-07-11 11:27:18', NULL, NULL, NULL, NULL),
(60, 29, '309', NULL, 'deposit', NULL, 'completed', 'km05wywkx4t9se2vl9fcb7nqbnjqdk', '2023-07-11 13:05:02', '2023-07-11 13:05:02', NULL, NULL, NULL, NULL),
(61, 29, '216', NULL, 'deposit', NULL, 'completed', 'to45zh4zzfpkcsp7v6qubqsj9c0ja7', '2023-07-11 15:33:53', '2023-07-11 15:33:53', NULL, NULL, NULL, NULL),
(62, 29, '55', NULL, 'deposit', NULL, 'completed', 'e2m98fvxcjvknfhjon1hms45jcj8oj', '2023-07-12 00:12:44', '2023-07-12 00:12:44', NULL, NULL, NULL, NULL),
(63, 29, '82', NULL, 'deposit', NULL, 'completed', 'h3o0ttj93k3jyomn5tklml3rb8au1a', '2023-07-12 06:10:02', '2023-07-12 06:10:02', NULL, NULL, NULL, NULL),
(64, 29, '82', NULL, 'deposit', NULL, 'completed', 'n4hpu3v264o39ohbw5qsiac0r5p6zd', '2023-07-12 06:14:17', '2023-07-12 06:14:17', NULL, NULL, NULL, NULL),
(65, 29, '19', NULL, 'deposit', NULL, 'completed', 'k1hpmjiejyvj096serncnjnif5bfw1', '2023-07-12 13:29:22', '2023-07-12 13:29:22', NULL, NULL, NULL, NULL),
(66, 29, '155', NULL, 'deposit', NULL, 'completed', 'vhlxxn70x3auc1oamc8p99zyt5uctn', '2023-07-12 18:56:16', '2023-07-12 18:56:16', NULL, NULL, NULL, NULL),
(67, 29, '101', NULL, 'deposit', NULL, 'completed', 'dsu3qqjpardn5jviq4lhpa8mmbez9o', '2023-07-12 22:17:36', '2023-07-12 22:17:36', NULL, NULL, NULL, NULL),
(68, 29, '49', NULL, 'deposit', NULL, 'completed', 'cfa3lpmur0yukn1rbe2e4mnwyt2fxc', '2023-07-13 03:24:24', '2023-07-13 03:24:24', NULL, NULL, NULL, NULL),
(69, 29, '88', NULL, 'deposit', NULL, 'completed', 'jlrtbuxbkf8jvf6kfruzsk2h1bcbbb', '2023-07-13 14:10:35', '2023-07-13 14:10:35', NULL, NULL, NULL, NULL),
(70, 29, '231', NULL, 'deposit', NULL, 'completed', '9qlsmdupan8dd4ej09j35wujtuh0q4', '2023-07-14 00:12:07', '2023-07-14 00:12:07', NULL, NULL, NULL, NULL),
(71, 29, '12', NULL, 'deposit', NULL, 'completed', 'qs208fqyto4robdhtqmwui5jyauwkd', '2023-07-14 09:19:58', '2023-07-14 09:19:58', NULL, NULL, NULL, NULL),
(72, 29, '60', NULL, 'deposit', NULL, 'completed', 'pcrfjacrv0cvusux7ickv08shnez48', '2023-07-14 10:44:43', '2023-07-14 10:44:43', NULL, NULL, NULL, NULL),
(73, 29, '38', NULL, 'deposit', NULL, 'completed', '0m9ujrosr8576140qdzqom2fcmec27', '2023-07-14 15:27:47', '2023-07-14 15:27:47', NULL, NULL, NULL, NULL),
(74, 29, '27', NULL, 'deposit', NULL, 'completed', 'jjk54ty489t7zpfdjcx639u9w9vn21', '2023-07-14 22:52:25', '2023-07-14 22:52:25', NULL, NULL, NULL, NULL),
(75, 29, '66', NULL, 'deposit', NULL, 'completed', 'fpcoazj130hb1jh9cv31adhvvtbfdj', '2023-07-15 10:28:39', '2023-07-15 10:28:39', NULL, NULL, NULL, NULL),
(76, 29, '175', NULL, 'deposit', NULL, 'completed', 'jf69ue3o2sj8lqn4lwvxcca3cnbjc0', '2023-07-15 20:19:55', '2023-07-15 20:19:55', NULL, NULL, NULL, NULL),
(77, 29, '58', NULL, 'deposit', NULL, 'completed', 'xeum5w1m07y6irlb5e3ijqoz15zy4w', '2023-07-16 16:20:05', '2023-07-16 16:20:05', NULL, NULL, NULL, NULL),
(78, 29, '100', NULL, 'deposit', NULL, 'completed', '2z17xxsju3lpttxo2r62ynnqtpk5cs', '2023-07-16 20:51:52', '2023-07-16 20:51:52', NULL, NULL, NULL, NULL),
(79, 29, '10', NULL, 'deposit', NULL, 'completed', '707ofi3ll5rmszckin8wmlxll0w60k', '2023-07-18 12:57:46', '2023-07-18 12:57:46', NULL, NULL, NULL, NULL),
(80, 29, '69', NULL, 'deposit', NULL, 'completed', 'jja2udoqj4tzwlk9x3ch9ertwdcl3k', '2023-07-18 17:43:21', '2023-07-18 17:43:21', NULL, NULL, NULL, NULL),
(81, 29, '125', NULL, 'deposit', NULL, 'completed', 'uuxprnxzrzhonbwu7xva55yyjk9eoa', '2023-07-21 19:47:38', '2023-07-21 19:47:38', NULL, NULL, NULL, NULL),
(82, 29, '45', NULL, 'deposit', NULL, 'completed', 'krj615qja4pn39xoqhuwh2lauutbcj', '2023-07-22 16:32:39', '2023-07-22 16:32:39', NULL, NULL, NULL, NULL),
(83, 29, '130', NULL, 'deposit', NULL, 'completed', 'toexb6qnr7o9q63txc3ncj7op3yfo8', '2023-07-22 16:33:07', '2023-07-22 16:33:07', NULL, NULL, NULL, NULL),
(84, 29, '44', NULL, 'deposit', NULL, 'completed', '8kyq7e0ol06ozajpk0x5m1f4as538t', '2023-07-23 10:25:05', '2023-07-23 10:25:05', NULL, NULL, NULL, NULL),
(85, 29, '40', NULL, 'deposit', NULL, 'completed', 'isyt38nroalhsf3rk3dwphj41dlo9d', '2023-07-23 23:02:24', '2023-07-23 23:02:24', NULL, NULL, NULL, NULL),
(86, 29, '26', NULL, 'deposit', NULL, 'completed', 'i1m5juo1602r6jozobck2mijpkjhtq', '2023-07-24 15:08:06', '2023-07-24 15:08:06', NULL, NULL, NULL, NULL),
(87, 29, '94', NULL, 'deposit', NULL, 'completed', '5kbpulejaavbkxvlj7fd4fe6j46d5q', '2023-07-25 13:03:14', '2023-07-25 13:03:14', NULL, NULL, NULL, NULL),
(88, 29, '210', NULL, 'deposit', NULL, 'completed', 'jarmtj0bpxj7rcjwul0ojyjtbbdw42', '2023-07-26 12:04:44', '2023-07-26 12:04:44', NULL, NULL, NULL, NULL),
(89, 29, '34', NULL, 'deposit', NULL, 'completed', 'om9mj3jby4evu56jn426z2uj1v1yj2', '2023-07-27 01:38:05', '2023-07-27 01:38:05', NULL, NULL, NULL, NULL),
(90, 29, '2000', 'Bitcoin  (P2PKH)', 'deposit', '13yxrJggnCXjR4mca2ULGjdvMwYoC8scXk', 'completed', 'rrkhtwm3h6oze5xzefjf6oxzcc31v5', '2023-07-27 15:27:44', '2023-07-27 13:50:37', NULL, NULL, NULL, NULL),
(91, 29, '320', NULL, 'deposit', NULL, 'completed', 'wwswm4vozi923lunysozhnsv2ymem3', '2023-07-27 15:25:26', '2023-07-27 15:25:26', NULL, NULL, NULL, NULL),
(92, 29, '958', NULL, 'deposit', NULL, 'completed', 'bxjsh148kmsy8v518fcjumvvp370c9', '2023-07-27 17:17:29', '2023-07-27 17:17:29', NULL, NULL, NULL, NULL),
(93, 29, '696', NULL, 'deposit', NULL, 'completed', '725wpy2xrepfan2cqmyj9jbwp5udfx', '2023-07-27 20:36:52', '2023-07-27 20:36:52', NULL, NULL, NULL, NULL),
(94, 29, '90', NULL, 'deposit', NULL, 'completed', 'aze5x3yfhcqzfjr8b4kobzt1uif4ni', '2023-07-28 00:48:23', '2023-07-28 00:48:23', NULL, NULL, NULL, NULL),
(95, 29, '997', NULL, 'deposit', NULL, 'completed', 'pubm8id539qpahm9zz73slz6jcklyq', '2023-07-28 10:56:51', '2023-07-28 10:56:51', NULL, NULL, NULL, NULL),
(96, 29, '287', NULL, 'deposit', NULL, 'completed', 'farrwir9xof1wubxvtqzk7crsk8q2n', '2023-07-28 21:55:21', '2023-07-28 21:55:21', NULL, NULL, NULL, NULL),
(97, 29, '484', NULL, 'deposit', NULL, 'completed', '7jxnoo30b77277jz46tlvkb3r3tlnu', '2023-07-29 01:57:58', '2023-07-29 01:57:58', NULL, NULL, NULL, NULL),
(98, 29, '663', NULL, 'deposit', NULL, 'completed', '0tdmz79lr7iz38dhn3t27j8kuwe1vx', '2023-07-30 01:02:16', '2023-07-30 01:02:16', NULL, NULL, NULL, NULL),
(99, 29, '1309', NULL, 'deposit', NULL, 'completed', '8zb0br0xneya82e8nyj6acsmqp211j', '2023-07-30 18:01:19', '2023-07-30 18:01:19', NULL, NULL, NULL, NULL),
(100, 29, '579', NULL, 'deposit', NULL, 'completed', 'n5zsyxyyq0vewf3e418cserqqjjlla', '2023-07-30 23:36:35', '2023-07-30 23:36:35', NULL, NULL, NULL, NULL),
(101, 29, '394', NULL, 'deposit', NULL, 'completed', 'd8ir1qh4tv21d6lxh3ct73uzi2vube', '2023-07-31 11:32:52', '2023-07-31 11:32:52', NULL, NULL, NULL, NULL),
(102, 29, '772', NULL, 'deposit', NULL, 'completed', '6bhysd673z4ote302r632pbx5c0wo9', '2023-07-31 19:05:54', '2023-07-31 19:05:54', NULL, NULL, NULL, NULL),
(103, 29, '899', NULL, 'deposit', NULL, 'completed', 'y8amcq72k20ie9vzsbpsab970d3zwu', '2023-07-31 22:30:57', '2023-07-31 22:30:57', NULL, NULL, NULL, NULL),
(104, 29, '1081', NULL, 'deposit', NULL, 'completed', 'fejdj423en2bs64qbwucsyhqsa34oq', '2023-07-31 23:44:50', '2023-07-31 23:44:50', NULL, NULL, NULL, NULL),
(105, 29, '528', NULL, 'deposit', NULL, 'completed', 'o8b2e0jxyvsrl513asvn6koeojmbj6', '2023-08-01 03:46:59', '2023-08-01 03:46:59', NULL, NULL, NULL, NULL),
(106, 29, '607', NULL, 'deposit', NULL, 'completed', '68uoqxhtrrpdihfu1ynubdrkvfe168', '2023-08-01 09:48:10', '2023-08-01 09:48:10', NULL, NULL, NULL, NULL),
(107, 29, '21', NULL, 'deposit', NULL, 'completed', 'yze39d4qx2jqh8lkjnnwq8f1z0rw2x', '2023-08-01 09:48:33', '2023-08-01 09:48:33', NULL, NULL, NULL, NULL),
(108, 29, '81', NULL, 'deposit', NULL, 'completed', 'wcwzqjiiewdxwribqpt0xjeq5r4qba', '2023-08-01 15:20:51', '2023-08-01 15:20:51', NULL, NULL, NULL, NULL),
(109, 29, '1647', NULL, 'deposit', NULL, 'completed', 'mjdskft4rjkltcy7bxyrqzovum1hs8', '2023-08-01 21:00:41', '2023-08-01 21:00:41', NULL, NULL, NULL, NULL),
(110, 29, '794', NULL, 'deposit', NULL, 'completed', 'e96z1h0s8osjjknvcl3b5zr7qy6fne', '2023-08-02 01:02:37', '2023-08-02 01:02:37', NULL, NULL, NULL, NULL),
(111, 29, '457', NULL, 'deposit', NULL, 'completed', 'vtcca2hbooqjbvd08hixmx911qr76j', '2023-08-02 09:43:41', '2023-08-02 09:43:41', NULL, NULL, NULL, NULL),
(112, 29, '39', NULL, 'deposit', NULL, 'completed', 'wv3y4bazkucpzy7ykb2k6540hjh80z', '2023-08-02 20:39:00', '2023-08-02 20:39:00', NULL, NULL, NULL, NULL),
(113, 29, '52', NULL, 'deposit', NULL, 'completed', 'uci7uppisyycbwqw9c53cbpxmp9l24', '2023-08-02 20:39:20', '2023-08-02 20:39:20', NULL, NULL, NULL, NULL),
(114, 29, '364', NULL, 'deposit', NULL, 'completed', 'sf1jxp5kzlnsqc45dyt7ndm9jjuxpd', '2023-08-03 02:56:46', '2023-08-03 02:56:46', NULL, NULL, NULL, NULL),
(115, 29, '539', NULL, 'deposit', NULL, 'completed', 'vu7fw2faal1jxtawmibkqowoipk4wm', '2023-08-03 11:26:29', '2023-08-03 11:26:29', NULL, NULL, NULL, NULL),
(116, 29, '288', NULL, 'deposit', NULL, 'completed', 'wby4r75x1luw8w781ulwjb794vqd3p', '2023-08-03 20:18:49', '2023-08-03 20:18:49', NULL, NULL, NULL, NULL),
(117, 35, '1000', 'Bitcoin  (P2PKH)', 'deposit', '13yxrJggnCXjR4mca2ULGjdvMwYoC8scXk', 'completed', 'o8ue87jcid35cmn30sr14l7v02pvnr', '2023-08-03 22:30:45', '2023-08-03 22:22:31', NULL, NULL, NULL, NULL),
(118, 35, '37', NULL, 'deposit', NULL, 'completed', 'r98advbpikj3cw1x6cj6mx0jcxio3z', '2023-08-04 07:34:06', '2023-08-04 07:34:06', NULL, NULL, NULL, NULL),
(119, 29, '779', NULL, 'deposit', NULL, 'completed', 'm1p0yiu760wtdaj2ue56npehyca1x8', '2023-08-04 07:34:49', '2023-08-04 07:34:49', NULL, NULL, NULL, NULL),
(120, 35, '76', NULL, 'deposit', NULL, 'completed', 'q1d8o7ludw6tim7jrcy5al0jpielbf', '2023-08-04 14:13:47', '2023-08-04 14:13:47', NULL, NULL, NULL, NULL),
(121, 29, '24', NULL, 'deposit', NULL, 'completed', 'bcfvc9ijpy8ixj7q470ci9iavz258s', '2023-08-04 14:14:40', '2023-08-04 14:14:40', NULL, NULL, NULL, NULL),
(122, 35, '204', NULL, 'deposit', NULL, 'completed', 'uxiaj8q694e5spl67nb80v6zo7b60m', '2023-08-04 21:25:32', '2023-08-04 21:25:32', NULL, NULL, NULL, NULL),
(123, 29, '179', NULL, 'deposit', NULL, 'completed', '4729r0j6hcjto2bwnxaj0m38wrn7zm', '2023-08-04 21:26:08', '2023-08-04 21:26:08', NULL, NULL, NULL, NULL),
(124, 29, '399', NULL, 'deposit', NULL, 'completed', 'r6jisnnxvqb99kxltqc5u58s0jt4ex', '2023-08-05 00:08:05', '2023-08-05 00:08:05', NULL, NULL, NULL, NULL),
(125, 35, '11', NULL, 'deposit', NULL, 'completed', 'lpf4smjuotd65625yz0rumqmjpj8a6', '2023-08-05 00:08:37', '2023-08-05 00:08:37', NULL, NULL, NULL, NULL),
(126, 35, '265', NULL, 'deposit', NULL, 'completed', 'c4ppwnbkt6tcbmtrvu8nb5whu3bv36', '2023-08-05 22:15:19', '2023-08-05 22:15:19', NULL, NULL, NULL, NULL),
(127, 29, '889', NULL, 'deposit', NULL, 'completed', '3u2iif0aaywnj3e1207v5fu7jmawwj', '2023-08-05 22:16:42', '2023-08-05 22:16:42', NULL, NULL, NULL, NULL),
(128, 29, '979', NULL, 'deposit', NULL, 'completed', 'sr7qe3sc9djvrnfj1i9udzcxjyzxiw', '2023-08-06 16:16:45', '2023-08-06 16:16:45', NULL, NULL, NULL, NULL),
(129, 35, '426', NULL, 'deposit', NULL, 'completed', 'bxaip9rwf4tdinw9mtr6jvqleefjj2', '2023-08-06 16:18:25', '2023-08-06 16:18:25', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `investment` varchar(255) DEFAULT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'master_default_photo.png',
  `country_of_residence` varchar(255) NOT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) NOT NULL,
  `address` tinytext DEFAULT NULL,
  `country_of_reg` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `reg_no` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_status` varchar(1) NOT NULL DEFAULT '0',
  `who` int(11) NOT NULL DEFAULT 1,
  `password` varchar(255) NOT NULL,
  `copy_trade` varchar(255) NOT NULL DEFAULT 'yes',
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `investment`, `photo`, `country_of_residence`, `dob`, `account_type`, `address`, `country_of_reg`, `company_name`, `reg_no`, `status`, `email_verified_at`, `verification_status`, `who`, `password`, `copy_trade`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Super', 'Admin', NULL, 'support@bullbearfx.net', 'NULL', '', 'master_default_photo.png', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '1', '0000-00-00 00:00:00', '1', 2, '$2y$10$hlOIFFKpdupSCHptthiFRObqikyZBhdisPlckpLCA7spPB8CfoePu', 'yes', NULL, 'https://rbcmarket.net/recover-password/5qfdod68tq1wjenkna1td6fwrjyrzddr6a9xm752i5fdzx589t/eyJpdiI6ImhzOXB0aHhDMEhwKzAxSEoxVC9FTlE9PSIsInZhbHVlIjoicmZOdHllOEM0Q094NUV2TnlYQVpjUT09IiwibWFjIjoiM2VhMmRhMjczMzZlMGFhMDVjOTdiYWUyNDI3OWJmY2QxODg5MWU5N2EyNzZkZTI4ZDZkZmVjMTdhOWQ4MTM1YyIsInRhZyI6IiJ9', NULL, NULL, NULL, '2023-06-19 06:13:46'),
(21, 'Kevwe', 'Patrick', NULL, 'collinssoftwares@gmail.com', '15083833310', 'Short-term', 'master_default_photo.png', 'Angola', '22-Jun-1997', 'corperate', NULL, 'United States', NULL, NULL, '1', '2023-06-13 13:58:28', '1', 1, '$2y$10$esT/M2s9Txp1.GaRk4YaOuqvLfmV7bxGS8E2qd/71F5sZuRPXJB/y', 'no', NULL, 'https://rbcmarket.net/recover-password/cv3tlmjarj929ztcyfefarro12yccmlc8vacobwla7jnpvq81o/eyJpdiI6IkJiSjdOZ0NJZU1WY3E4Rk5FWWgwNlE9PSIsInZhbHVlIjoiRVFaQzJrWWUwa1RSaXlseGJmWlpodz09IiwibWFjIjoiMDY1NDRmNzM0ZTkzOTBlOTAzNDdmMjQ4NzYyYWExNmE3YmZjOWUzYzZlMWE0M2NjNmU5NjYyYjIwNzI1NTllYSIsInRhZyI6IiJ9', NULL, NULL, '2023-06-13 13:53:12', '2023-07-27 14:15:10'),
(26, 'oluchukwu', 'ojubeli', NULL, 'ojugbelioluchucku@gmail.com', '08147955450', 'Short-term', 'master_default_photo.png', 'Nigeria', '16-Nov-2022', 'individual', NULL, NULL, NULL, NULL, '1', '2023-06-30 00:12:45', '0', 1, '$2y$10$5VgA8G6Ns9Dsa80Dh2sCR.k7A/P6Q5jx8/v4QESTVlUO2Ly71N9Fa', 'yes', NULL, NULL, NULL, NULL, '2023-06-30 00:05:50', '2023-06-30 00:13:43'),
(28, 'Scalp', 'Master', NULL, 'scalpmaster8@gmail.com', '08062950629', 'Short-term', 'master_default_photo.png', 'Albania', '25-Jun-2023', 'individual', NULL, NULL, NULL, NULL, '1', '2023-06-30 19:55:49', '0', 1, '$2y$10$cGcHYFleUaHKAqQ/kR4ZFe1hWj5FlfIIbUiyyyx2Fozou5osXH6Aq', 'yes', NULL, NULL, NULL, NULL, '2023-06-30 19:49:18', '2023-06-30 19:57:00'),
(29, 'Jason', 'Williams', NULL, 'yamadog75@gmail.com', '15307395019', 'Short-term', 'master_default_photo.png', 'United States', '10-Sep-1975', 'individual', NULL, NULL, NULL, NULL, '1', '2023-06-30 20:30:33', '0', 1, '$2y$10$5p0Agz6cXXzoCVaJNXUubuoPJsJ1jul3EIWeEcJgbTCYvOCPz7JxW', 'yes', NULL, NULL, NULL, NULL, '2023-06-30 20:29:17', '2023-06-30 20:30:39'),
(32, 'Courtney', 'Clark', NULL, 'Courtneyclark915@gmail.com', '940-577-7168', 'Short-term', 'master_default_photo.png', 'United States', '15-Sep-1983', 'individual', NULL, NULL, NULL, NULL, '1', '2023-07-08 20:00:29', '0', 1, '$2y$10$Wt.OQ.N2A5eeUBpQ1vs.BekLN2fDPi7zR5WyfKDAxfxA85PbUPSZ.', 'yes', NULL, NULL, NULL, NULL, '2023-07-08 12:40:02', '2023-07-09 01:07:45'),
(35, 'Amanda', 'Thompson', NULL, 'gthomp3029@gmail.com', '12052650777', 'Short-term', 'master_default_photo.png', 'United States', '01-Sep-1980', 'individual', NULL, NULL, NULL, NULL, '1', '2023-08-03 21:39:22', '0', 1, '$2y$10$PoYBbn8ZD/osyWk1js0kOu1Kb/gEW0cE44LXyVPpovz8Bpayv/Jnm', 'yes', NULL, NULL, NULL, NULL, '2023-08-03 21:24:24', '2023-08-03 21:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_investments`
--

CREATE TABLE `user_investments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `percentage` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `capital_return` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_investments`
--

INSERT INTO `user_investments` (`id`, `user_id`, `plan`, `duration`, `amount`, `percentage`, `start_date`, `end_date`, `capital_return`, `status`, `created_at`, `updated_at`) VALUES
(1, 20, 'Gold', '6', '100', '35', '11th Jun, 2023', '23rd Jul, 2023', 'Yes', '0', '2023-06-11 15:52:15', '2023-06-11 16:13:34'),
(2, 20, 'Starter', '2', '1000', '10', '11th Jun, 2023', '25th Jun, 2023', 'Yes', '0', '2023-06-11 16:27:12', '2023-06-11 16:28:58'),
(3, 20, 'Advanced', '4', '3001', '30', '11th Jun, 2023', '09th Jul, 2023', 'Yes', '0', '2023-06-11 16:28:40', '2023-06-11 16:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wallet_name` varchar(255) NOT NULL,
  `wallet_format` varchar(255) DEFAULT NULL,
  `wallet_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `wallet_name`, `wallet_format`, `wallet_address`, `created_at`, `updated_at`) VALUES
(3, 'Dogecoin', NULL, 'D8kKMd6mWpcvVJfLAdKjd9K7x7y6RrJq8P', '2023-06-30 01:13:57', '2023-06-30 01:13:57'),
(4, 'Tether', 'ERC20', '0x89afcf2CB16057739794CcD995bb0D39C19f3239', '2023-06-30 01:29:24', '2023-06-30 01:29:24'),
(5, 'Litecoin', NULL, 'LdXa85FXUUXxSYyGM9N2sQ13qEyjWfw9Wr', '2023-06-30 01:43:04', '2023-06-30 01:43:04'),
(6, 'Tether', 'TRC20', '3KMT4sdtJ9gU2uEmP1y7ktLDR88rpSWXXU', '2023-06-30 01:48:03', '2023-06-30 01:48:03'),
(7, 'Bitcoin', 'P2PKH', '13yxrJggnCXjR4mca2ULGjdvMwYoC8scXk', '2023-06-30 02:01:47', '2023-06-30 02:01:47'),
(8, 'Bitcoin', 'SEGWIT', 'bc1q0s6cgclp45rvx63e20azhhrrqxzcmwrn382vjq', '2023-06-30 02:03:23', '2023-06-30 02:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `whatsappwidget`
--

CREATE TABLE `whatsappwidget` (
  `id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `whatsappwidget`
--

INSERT INTO `whatsappwidget` (`id`, `number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'NULL', '0', '2023-07-03 14:06:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_cards`
--

CREATE TABLE `withdrawal_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `card_no` varchar(255) DEFAULT NULL,
  `cvv` varchar(255) DEFAULT NULL,
  `exp_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawal_cards`
--

INSERT INTO `withdrawal_cards` (`id`, `user_id`, `card_no`, `cvv`, `exp_date`, `status`, `created_at`, `updated_at`) VALUES
(7, 18, '050968120229', '738', '05/2025', '0', '2023-05-18 13:54:23', '2023-05-18 13:54:23'),
(6, 17, '035297801418', '820', '05/2025', '0', '2023-05-17 21:59:19', '2023-05-17 21:59:19'),
(8, 19, '415747695532', '774', '05/2025', '0', '2023-05-18 13:58:09', '2023-05-18 13:58:09'),
(9, 20, '317751036693', '311', '05/2025', '1', '2023-05-18 13:59:57', '2023-05-18 13:59:57'),
(10, 21, '092042881856', '396', '06/2025', '0', '2023-06-13 13:53:12', '2023-06-13 13:53:12'),
(11, 22, '121415855496', '060', '06/2025', '0', '2023-06-26 00:08:35', '2023-06-26 00:08:35'),
(12, 23, '103271708170', '027', '06/2025', '1', '2023-06-26 00:53:39', '2023-06-26 00:53:39'),
(13, 24, '787494619214', '264', '06/2025', '0', '2023-06-26 19:12:13', '2023-06-26 19:12:13'),
(14, 25, '045662331143', '871', '06/2025', '0', '2023-06-29 19:15:57', '2023-06-29 19:15:57'),
(15, 26, '908088928022', '731', '06/2025', '0', '2023-06-30 00:05:50', '2023-06-30 00:05:50'),
(16, 27, '519487871006', '316', '06/2025', '0', '2023-06-30 18:59:14', '2023-06-30 18:59:14'),
(17, 28, '687254518086', '608', '06/2025', '0', '2023-06-30 19:49:18', '2023-06-30 19:49:18'),
(18, 29, '513249055694', '841', '06/2025', '0', '2023-06-30 20:29:17', '2023-06-30 20:29:17'),
(19, 30, '959530072998', '912', '07/2025', '0', '2023-07-05 11:29:55', '2023-07-05 11:29:55'),
(20, 31, '445341464627', '252', '07/2025', '0', '2023-07-06 07:18:08', '2023-07-06 07:18:08'),
(21, 32, '963490147853', '828', '07/2025', '0', '2023-07-08 12:40:02', '2023-07-08 12:40:02'),
(22, 33, '856552207177', '206', '07/2025', '0', '2023-07-19 14:28:01', '2023-07-19 14:28:01'),
(23, 34, '135499386306', '117', '07/2025', '0', '2023-07-22 17:25:10', '2023-07-22 17:25:10'),
(24, 35, '553681426780', '665', '08/2025', '0', '2023-08-03 21:24:24', '2023-08-03 21:24:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_logos`
--
ALTER TABLE `app_logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `balances_user_id_foreign` (`user_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copiers`
--
ALTER TABLE `copiers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `copiers_copier_id_foreign` (`copier_id`);

--
-- Indexes for table `demo_accounts`
--
ALTER TABLE `demo_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `investment_plans`
--
ALTER TABLE `investment_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_chat_apps`
--
ALTER TABLE `live_chat_apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `management_teams`
--
ALTER TABLE `management_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_traders`
--
ALTER TABLE `master_traders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_traders_master_id_unique` (`master_id`),
  ADD UNIQUE KEY `master_traders_username_unique` (`username`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_who_foreign` (`who`),
  ADD KEY `orders_user_foreign` (`user`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referrals_user_id_foreign` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_plans`
--
ALTER TABLE `sub_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_plans_user_id_foreign` (`user_id`);

--
-- Indexes for table `testimonies`
--
ALTER TABLE `testimonies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_history`
--
ALTER TABLE `trans_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trans_history_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_investments`
--
ALTER TABLE `user_investments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_investments_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whatsappwidget`
--
ALTER TABLE `whatsappwidget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_cards`
--
ALTER TABLE `withdrawal_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrawal_cards_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_logos`
--
ALTER TABLE `app_logos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `copiers`
--
ALTER TABLE `copiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `demo_accounts`
--
ALTER TABLE `demo_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investment_plans`
--
ALTER TABLE `investment_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `live_chat_apps`
--
ALTER TABLE `live_chat_apps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `management_teams`
--
ALTER TABLE `management_teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_traders`
--
ALTER TABLE `master_traders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_plans`
--
ALTER TABLE `sub_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `testimonies`
--
ALTER TABLE `testimonies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trans_history`
--
ALTER TABLE `trans_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_investments`
--
ALTER TABLE `user_investments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `whatsappwidget`
--
ALTER TABLE `whatsappwidget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdrawal_cards`
--
ALTER TABLE `withdrawal_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balances`
--
ALTER TABLE `balances`
  ADD CONSTRAINT `balances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `copiers`
--
ALTER TABLE `copiers`
  ADD CONSTRAINT `copiers_copier_id_foreign` FOREIGN KEY (`copier_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trans_history`
--
ALTER TABLE `trans_history`
  ADD CONSTRAINT `trans_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
