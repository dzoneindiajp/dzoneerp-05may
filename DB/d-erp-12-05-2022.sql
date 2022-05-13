-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2022 at 03:43 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `d-erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 0, 'Abcd', '<p>hjkjkljkljkj</p>', '2022-04-21 22:51:11', '2022-04-21 22:51:11', '2022-04-22 04:21:11'),
(4, 0, 'categ', '<p>p c jha</p>', '2022-04-22 00:32:49', '2022-04-22 03:55:18', '2022-04-22 06:02:49'),
(6, 0, 'gfjhghujkhkj', '<p>ghjijhkkljkjkj</p>', '2022-04-22 07:32:45', '2022-04-22 07:32:45', '2022-04-22 13:02:45'),
(7, 0, 'fggf', '<p>fghfhgh</p>', '2022-04-22 07:36:18', '2022-04-22 07:36:18', '2022-04-22 13:06:18'),
(8, 4, 'prabhash', '<p>jha</p>', '2022-04-22 07:43:50', '2022-04-23 09:21:40', '2022-04-22 13:13:50'),
(9, 6, 'test', '<ul>\r\n	<li>1323</li>\r\n</ul>', '2022-05-09 03:44:07', '2022-05-09 03:44:07', '2022-05-09 09:14:07'),
(10, 0, 'test', '<p>test desc</p>', '2022-05-09 03:54:19', '2022-05-09 03:54:19', '2022-05-09 09:24:19'),
(11, 10, 'test subcat', '<p>sub cat desc</p>', '2022-05-09 03:55:15', '2022-05-09 03:55:15', '2022-05-09 09:25:15'),
(12, 10, 'subcat 2', '<p>sub cat 2</p>', '2022-05-09 03:55:45', '2022-05-09 03:55:45', '2022-05-09 09:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `color_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'black', 'black', '2022-05-06 03:35:59', '2022-05-06 09:05:59', '2022-05-06 09:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `shortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `shortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `damage_purchases`
--

CREATE TABLE `damage_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `damage_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `damage_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `damage_date` date NOT NULL,
  `damageqty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `damage_note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `damage_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 - InActive, 1 - Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `damage_purchases`
--

INSERT INTO `damage_purchases` (`id`, `damage_code`, `damage_reason`, `purchase_id`, `damage_date`, `damageqty`, `damage_note`, `damage_image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'DAMAGE - 1', 'damage', 11, '2022-05-21', '[\"0\",\"4\"]', '<p>damage note</p>', NULL, 0, '2022-05-12 07:23:06', '2022-05-12 07:23:06');

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
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_03_07_000001_create_media_table', 1),
(4, '2022_03_07_000002_create_permissions_table', 1),
(5, '2022_03_07_000003_create_roles_table', 1),
(6, '2022_03_07_000004_create_users_table', 1),
(7, '2022_03_07_000005_create_asset_categories_table', 1),
(8, '2022_03_07_000006_create_asset_locations_table', 1),
(9, '2022_03_07_000007_create_asset_statuses_table', 1),
(10, '2022_03_07_000008_create_assets_table', 1),
(11, '2022_03_07_000009_create_assets_histories_table', 1),
(12, '2022_03_07_000010_create_crm_statuses_table', 1),
(13, '2022_03_07_000011_create_crm_customers_table', 1),
(14, '2022_03_07_000012_create_crm_notes_table', 1),
(15, '2022_03_07_000013_create_crm_documents_table', 1),
(16, '2022_03_07_000014_create_faq_categories_table', 1),
(17, '2022_03_07_000015_create_faq_questions_table', 1),
(18, '2022_03_07_000016_create_permission_role_pivot_table', 1),
(19, '2022_03_07_000017_create_role_user_pivot_table', 1),
(20, '2022_03_07_000018_add_relationship_fields_to_assets_table', 1),
(21, '2022_03_07_000019_add_relationship_fields_to_assets_histories_table', 1),
(22, '2022_03_07_000020_add_relationship_fields_to_crm_customers_table', 1),
(23, '2022_03_07_000021_add_relationship_fields_to_crm_notes_table', 1),
(24, '2022_03_07_000022_add_relationship_fields_to_crm_documents_table', 1),
(25, '2022_03_07_000023_add_relationship_fields_to_faq_questions_table', 1),
(26, '2022_03_07_000024_add_verification_fields', 1),
(27, '2022_03_07_000025_add_approval_fields', 1),
(28, '2022_04_21_113451_create_categories_table', 2),
(29, '2022_05_05_100157_add_column_user_type_in_users_table', 3),
(30, '2022_05_05_104732_create_suppliers_table', 3),
(31, '2022_05_05_104754_create_staff_table', 3),
(36, '2022_05_09_052041_create_vendors_table', 4),
(37, '2022_05_09_091631_create_products_table', 5),
(40, '2022_05_10_053107_create_purchases_table', 6),
(44, '2022_05_11_091754_create_return_purchases_table', 7),
(47, '2022_05_11_130115_create_damage_purchases_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sales@dzoneindia.co.in', '$2y$10$F6Dg0TeggPgDXiT7wBBjweuB8YcEDvEvpcMfIGqY/BzjWdsetqOtu', '2022-03-22 10:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', NULL, NULL, NULL, NULL),
(2, 'permission_create', NULL, NULL, NULL, NULL),
(3, 'permission_edit', NULL, NULL, NULL, NULL),
(4, 'permission_show', NULL, NULL, NULL, NULL),
(5, 'permission_delete', NULL, NULL, NULL, NULL),
(6, 'permission_access', NULL, NULL, NULL, NULL),
(7, 'role_create', NULL, NULL, NULL, NULL),
(8, 'role_edit', NULL, NULL, NULL, NULL),
(9, 'role_show', NULL, NULL, NULL, NULL),
(10, 'role_delete', 'abcdf', NULL, '2022-04-22 06:33:31', NULL),
(11, 'role_access', NULL, NULL, NULL, NULL),
(12, 'user_create', NULL, NULL, NULL, NULL),
(13, 'user_edit', NULL, NULL, NULL, NULL),
(14, 'user_show', NULL, NULL, NULL, NULL),
(15, 'user_delete', NULL, NULL, NULL, NULL),
(16, 'user_access', NULL, NULL, NULL, NULL),
(17, 'asset_management_access', NULL, NULL, NULL, NULL),
(18, 'asset_category_create', NULL, NULL, NULL, NULL),
(19, 'asset_category_edit', NULL, NULL, NULL, NULL),
(20, 'asset_category_show', NULL, NULL, NULL, NULL),
(21, 'asset_category_delete', NULL, NULL, NULL, NULL),
(22, 'asset_category_access', NULL, NULL, NULL, NULL),
(23, 'asset_location_create', NULL, NULL, NULL, NULL),
(24, 'asset_location_edit', NULL, NULL, NULL, NULL),
(25, 'asset_location_show', NULL, NULL, NULL, NULL),
(26, 'asset_location_delete', NULL, NULL, NULL, NULL),
(27, 'asset_location_access', NULL, NULL, NULL, NULL),
(28, 'asset_status_create', NULL, NULL, NULL, NULL),
(29, 'asset_status_edit', NULL, NULL, NULL, NULL),
(30, 'asset_status_show', NULL, NULL, NULL, NULL),
(31, 'asset_status_delete', NULL, NULL, NULL, NULL),
(32, 'asset_status_access', NULL, NULL, NULL, NULL),
(33, 'asset_create', NULL, NULL, NULL, NULL),
(34, 'asset_edit', NULL, NULL, NULL, NULL),
(35, 'asset_show', NULL, NULL, NULL, NULL),
(36, 'asset_delete', NULL, NULL, NULL, NULL),
(37, 'asset_access', NULL, NULL, NULL, NULL),
(38, 'assets_history_access', NULL, NULL, NULL, NULL),
(39, 'basic_c_r_m_access', NULL, NULL, NULL, NULL),
(40, 'crm_status_create', NULL, NULL, NULL, NULL),
(41, 'crm_status_edit', NULL, NULL, NULL, NULL),
(42, 'crm_status_show', NULL, NULL, NULL, NULL),
(43, 'crm_status_delete', NULL, NULL, NULL, NULL),
(44, 'crm_status_access', NULL, NULL, NULL, NULL),
(45, 'crm_customer_create', NULL, NULL, NULL, NULL),
(46, 'crm_customer_edit', NULL, NULL, NULL, NULL),
(47, 'crm_customer_show', NULL, NULL, NULL, NULL),
(48, 'crm_customer_delete', NULL, NULL, NULL, NULL),
(49, 'crm_customer_access', NULL, NULL, NULL, NULL),
(50, 'crm_note_create', NULL, NULL, NULL, NULL),
(51, 'crm_note_edit', NULL, NULL, NULL, NULL),
(52, 'crm_note_show', NULL, NULL, NULL, NULL),
(53, 'crm_note_delete', NULL, NULL, NULL, NULL),
(54, 'crm_note_access', NULL, NULL, NULL, NULL),
(55, 'crm_document_create', NULL, NULL, NULL, NULL),
(56, 'crm_document_edit', NULL, NULL, NULL, NULL),
(57, 'crm_document_show', NULL, NULL, NULL, NULL),
(58, 'crm_document_delete', NULL, NULL, NULL, NULL),
(59, 'crm_document_access', NULL, NULL, NULL, NULL),
(60, 'faq_management_access', NULL, NULL, NULL, NULL),
(61, 'faq_category_create', NULL, NULL, NULL, NULL),
(62, 'faq_category_edit', NULL, NULL, NULL, NULL),
(63, 'faq_category_show', NULL, NULL, NULL, NULL),
(64, 'faq_category_delete', NULL, NULL, NULL, NULL),
(65, 'faq_category_access', NULL, NULL, NULL, NULL),
(66, 'faq_question_create', NULL, NULL, NULL, NULL),
(67, 'faq_question_edit', NULL, NULL, NULL, NULL),
(68, 'faq_question_show', NULL, NULL, NULL, NULL),
(69, 'faq_question_delete', NULL, NULL, NULL, NULL),
(70, 'faq_question_access', NULL, NULL, NULL, NULL),
(71, 'profile_password_edit', NULL, NULL, NULL, NULL),
(72, 'categories_access', NULL, '2022-04-21 07:45:38', '2022-04-21 07:45:38', NULL),
(73, 'categories_create', NULL, '2022-04-21 22:35:34', '2022-04-21 22:35:34', NULL),
(74, 'category_edit', NULL, '2022-04-21 23:26:51', '2022-04-21 23:26:51', NULL),
(75, 'categories_store', NULL, '2022-04-22 00:13:38', '2022-04-22 00:13:38', NULL),
(76, 'categories_access', NULL, '2022-04-22 00:43:31', '2022-04-22 00:43:31', NULL),
(79, 'category_show', 'for category', '2022-04-22 04:00:39', '2022-04-22 04:00:39', NULL),
(80, 'subcategory_access', 'for subcategory access', '2022-04-22 05:46:00', '2022-04-22 05:46:00', NULL),
(81, 'subcategory_create', 'subcategories create', '2022-04-22 06:20:08', '2022-04-22 06:20:08', NULL),
(82, 'subcategories_store', 'for subcat store', '2022-04-22 06:54:02', '2022-04-22 06:54:02', NULL),
(83, 'subcategory_edit', 'subcat edit', '2022-04-23 09:22:49', '2022-04-23 09:22:49', NULL),
(84, 'subcategory_update', 'for sub cat update', '2022-04-23 09:25:07', '2022-04-23 09:25:07', NULL),
(85, 'subcategory_delete', 'for delete', '2022-04-23 09:25:53', '2022-04-23 09:25:53', NULL),
(86, 'subcategory_show', 'for show subcategory', '2022-04-23 09:50:39', '2022-04-23 09:50:39', NULL),
(87, 'color_access', 'color_access', '2022-05-06 03:11:41', '2022-05-06 03:11:41', NULL),
(88, 'color_create', 'color_create', '2022-05-06 03:35:08', '2022-05-06 03:35:08', NULL),
(89, 'color_show', 'color_show', '2022-05-06 03:37:26', '2022-05-06 03:37:26', NULL),
(90, 'color_edit', 'color_edit', '2022-05-06 03:38:21', '2022-05-06 03:38:21', NULL),
(91, 'color_delete', 'color_delete', '2022-05-06 03:38:45', '2022-05-06 03:38:45', NULL),
(92, 'size_access', 'size_access', '2022-05-06 04:25:12', '2022-05-06 04:25:12', NULL),
(93, 'size_create', 'size_create', '2022-05-06 04:30:58', '2022-05-06 04:30:58', NULL),
(94, 'size_show', 'size_show', '2022-05-06 04:32:03', '2022-05-06 04:32:03', NULL),
(95, 'size_edit', 'size_edit', '2022-05-06 04:32:27', '2022-05-06 04:32:27', NULL),
(96, 'size_delete', 'size_delete', '2022-05-06 04:33:14', '2022-05-06 04:33:14', NULL),
(97, 'unit_access', 'unit_access', '2022-05-07 04:47:45', '2022-05-07 04:47:45', NULL),
(98, 'unit_create', 'unit_create', '2022-05-07 04:48:11', '2022-05-07 04:48:11', NULL),
(99, 'unit_show', 'unit_show', '2022-05-07 04:51:56', '2022-05-07 04:51:56', NULL),
(100, 'unit_edit', 'unit_edit', '2022-05-07 06:36:08', '2022-05-07 06:36:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(2, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(2, 51),
(2, 52),
(2, 53),
(2, 54),
(2, 55),
(2, 56),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 61),
(2, 62),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 69),
(2, 70),
(2, 71),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 3),
(4, 30),
(5, 71),
(5, 1),
(5, 12),
(5, 13),
(5, 14),
(5, 16),
(1, 73),
(1, 74),
(1, 75),
(1, 79),
(1, 80),
(1, 81),
(1, 76),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 72),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catid` bigint(20) UNSIGNED NOT NULL,
  `subcatid` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitid` bigint(20) UNSIGNED NOT NULL,
  `productimage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isfinishedproduct` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 - No , 1 - Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `catid`, `subcatid`, `product_name`, `unitid`, `productimage`, `isfinishedproduct`, `created_at`, `updated_at`) VALUES
(5, 4, 8, 'test', 1, 'product_1652157760.jpg', 0, '2022-05-09 23:12:40', '2022-05-09 23:12:40'),
(6, 4, 8, 'new product', 1, 'product_1652340598.jpg', 0, '2022-05-12 01:59:58', '2022-05-12 01:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_code` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - supplier , 1 - vendor',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `total_discount` double NOT NULL DEFAULT 0,
  `transport_cost` double NOT NULL DEFAULT 0,
  `grand_total` double NOT NULL DEFAULT 0,
  `total_paid` double NOT NULL DEFAULT 0,
  `payment_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 - cash , 1 - card',
  `purchase_note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 - InActive, 1 - Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `purchase_code`, `purchase_date`, `user_type`, `user_id`, `product_id`, `product_qty`, `unit_id`, `unit_price`, `discount`, `subtotal`, `total_discount`, `transport_cost`, `grand_total`, `total_paid`, `payment_type`, `purchase_note`, `purchase_image`, `status`, `created_at`, `updated_at`) VALUES
(10, 'PUR - 9', '2022-05-21', 1, 4, '[\"5\",\"5\"]', '[\"111\",\"23\"]', '[\"1\",\"1\"]', '[\"11\",\"2\"]', '[\"1\",\"3\"]', 1253.4099999999999, 13.59, 11, 1264.4099999999999, 0, 0, '11', NULL, 1, '2022-05-11 03:39:10', '2022-05-11 05:26:33'),
(11, 'PUR - 11', '2022-05-19', 0, 8, '[\"5\",\"6\"]', '[\"2\",\"26\"]', '[\"1\",\"1\"]', '[\"2\",\"20\"]', '[\"5\",\"0\"]', 523.8, 0.2, 10, 533.8, 0, 0, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum debitis iusto itaque voluptas quam veniam aliquid quisquam! A aliquid, autem inventore labore et natus eligendi, distinctio aut, quos dolor qui?Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum debitis iusto itaque voluptas quam veniam aliquid quisquam! A aliquid, autem inventore labore et natus eligendi, distinctio aut, quos dolor qui?Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum debitis iusto itaque voluptas quam veniam aliquid quisquam! A aliquid, autem inventore labore et natus eligendi, distinctio aut, quos dolor qui?</p>', 'Purchase_1652360061.png', 0, '2022-05-11 03:40:37', '2022-05-12 07:35:51'),
(12, 'PUR - 12', '2022-05-14', 1, 4, '[\"5\",\"5\"]', '[\"10\",\"2\"]', '[\"1\",\"1\"]', '[\"2\",\"500\"]', '[\"00\",\"2\"]', 1000, 20, 0, 1000, 0, 0, '<p>purchase</p>', NULL, 1, '2022-05-11 09:11:57', '2022-05-12 07:36:00'),
(13, 'PUR - 13', '2022-05-13', 1, 4, '[\"5\"]', '[\"11\"]', '[\"1\"]', '[\"45\"]', '[\"1\"]', 490.05, 4.95, 0, 490.05, 0, 0, '<p>Purchase <strong>Note cccc ff<s>df</s>fd</strong></p>', NULL, 1, '2022-05-11 23:42:08', '2022-05-11 23:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `return_purchases`
--

CREATE TABLE `return_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `return_date` date NOT NULL,
  `returnqty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_amount` double NOT NULL DEFAULT 0,
  `return_note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 - InActive, 1 - Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_purchases`
--

INSERT INTO `return_purchases` (`id`, `return_code`, `return_reason`, `purchase_id`, `return_date`, `returnqty`, `return_amount`, `return_note`, `return_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'RETURN - 1', 'return this product', 11, '2022-05-10', '[\"2\",\"10\"]', 55, '<p>return note</p>', 'return_purchase_1652279843.jpg', 0, '2022-05-11 06:09:16', '2022-05-12 02:01:39'),
(6, 'RETURN - 6', 'Return Reason', 12, '2022-05-13', '[\"5\",\"1\"]', 120, 'test note', 'return_purchase_1652280498.png', 1, '2022-05-11 09:14:02', '2022-05-11 09:18:18'),
(7, 'RETURN - 7', 'need return this product', 13, '2022-05-11', '[\"2\"]', 2, '<p>test producct</p>', NULL, 1, '2022-05-11 23:44:56', '2022-05-12 00:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL),
(2, 'User', NULL, NULL, NULL),
(3, 'vendor', '2022-03-11 08:40:57', '2022-03-11 08:40:57', NULL),
(4, 'user', '2022-03-22 10:20:01', '2022-04-20 02:07:26', '2022-04-20 02:07:26'),
(5, 'Staff', '2022-04-20 02:07:47', '2022-04-20 02:07:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `size_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'm', 'M-size', '2022-05-06 04:46:43', '2022-05-06 04:46:43', '2022-05-06 10:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destignation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 - In-active , 1 - Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `user_id`, `name`, `email`, `country`, `phone`, `profile_image`, `company_name`, `destignation`, `address`, `status`, `created_at`, `updated_at`) VALUES
(5, 38, 'staf', 'staf@gmail.com', NULL, NULL, '1652158593.png', 'ksfdhhddkjhjk', 'fdsfdfdsfdsf', 'addr', 1, '2022-05-09 23:26:33', '2022-05-09 23:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destignation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 - In-active , 1 - Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `user_id`, `name`, `email`, `country`, `phone`, `profile_image`, `company_name`, `destignation`, `address`, `status`, `created_at`, `updated_at`) VALUES
(8, 39, 'supplier', 'supplier2@gmail.com', NULL, NULL, '1652166384.jpg', 'suppli com', 'destignition', 'addr', 1, '2022-05-10 01:36:24', '2022-05-10 01:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `unit_code`, `created_at`, `updated_at`) VALUES
(1, 'Height', 'H', '2022-05-07 06:18:57', '2022-05-07 06:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` tinyint(1) DEFAULT 1 COMMENT '1 - User, 2 - Supplier, 3 - Staff , 4 - Vendor',
  `email_verified_at` datetime DEFAULT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `verified` tinyint(1) DEFAULT 0,
  `verified_at` datetime DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `country`, `gender`, `user_type`, `email_verified_at`, `approved`, `verified`, `verified_at`, `verification_token`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', 'address', NULL, 'Afghanistan >Afghanistan</option>\r\n                                            <option value=', '', 1, NULL, 1, 1, '2022-03-07 19:39:23', '', '$2y$10$okrWpBiMZv6bZC7tEOafruhgGZcCJHvNu0leDixVJMalcNL5prOoC', 'NwFYLjivVe3E31Vg7tx2KJzSoShCuRjnM1dRRb0yt7W8kUCPEDPv59Fq3I0n', NULL, '2022-05-09 00:52:22', NULL),
(22, 'Mahesh', 'maheshjangir219@gmail.com', 'vyas apartment\r\nvyas apartment', '07709404627', '', '', 3, NULL, 1, 1, '2022-05-06 06:30:12', NULL, '$2y$10$Hu71S97omDmeK4mOkUjhK.h8om1PNEIrn1ugJFPJ70DHs9m58EYhS', NULL, '2022-05-06 01:00:12', '2022-05-09 03:21:30', NULL),
(38, 'staf', 'staf@gmail.com', 'addr', '', '', '', 3, NULL, 1, 1, '2022-05-10 04:56:33', NULL, '$2y$10$OxZPswHO6O26Bnuykosn9..ma8XqS09tyhCbQiUiIgwcHmPyS3Psy', NULL, '2022-05-09 23:26:33', '2022-05-09 23:26:33', NULL),
(39, 'supplier', 'supplier2@gmail.com', 'addr', '', '', '', 2, NULL, 1, 1, '2022-05-10 07:06:24', NULL, '$2y$10$oJw2pIPiHJZ399QcWFuK0eNkZf34Vld1CJbfX5EoMAE28ghPOP2D6', NULL, '2022-05-10 01:36:24', '2022-05-10 01:36:24', NULL),
(40, 'vendor', 'vendor@gmail.com', '12345678', '', '', '', 3, NULL, 1, 1, '2022-05-10 07:07:01', NULL, '$2y$10$nyhPxw79QWp34.CDJWSsgOlFplQUXon2iTEo42bAMk1TVN6ovApJu', NULL, '2022-05-10 01:37:01', '2022-05-10 01:37:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destignation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 - In-active , 1 - Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `user_id`, `name`, `email`, `country`, `phone`, `profile_image`, `company_name`, `destignation`, `address`, `status`, `created_at`, `updated_at`) VALUES
(4, 40, 'vendor', 'vendor@gmail.com', NULL, NULL, '1652166421.png', '12345678', '123', '12345678', 1, '2022-05-10 01:37:01', '2022-05-10 01:37:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `damage_purchases`
--
ALTER TABLE `damage_purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `damage_purchases_damage_code_unique` (`damage_code`),
  ADD KEY `damage_purchases_purchase_id_foreign` (`purchase_id`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_6156262` (`role_id`),
  ADD KEY `permission_id_fk_6156262` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_catid_foreign` (`catid`),
  ADD KEY `products_subcatid_foreign` (`subcatid`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_purchases`
--
ALTER TABLE `return_purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `return_purchases_return_code_unique` (`return_code`),
  ADD KEY `return_purchases_purchase_id_foreign` (`purchase_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `user_id_fk_6156271` (`user_id`),
  ADD KEY `role_id_fk_6156271` (`role_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_email_unique` (`email`),
  ADD KEY `staff_user_id_foreign` (`user_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`),
  ADD KEY `suppliers_user_id_foreign` (`user_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`),
  ADD KEY `vendors_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `damage_purchases`
--
ALTER TABLE `damage_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `return_purchases`
--
ALTER TABLE `return_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `damage_purchases`
--
ALTER TABLE `damage_purchases`
  ADD CONSTRAINT `damage_purchases_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_id_fk_6156262` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_id_fk_6156262` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_catid_foreign` FOREIGN KEY (`catid`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcatid_foreign` FOREIGN KEY (`subcatid`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `return_purchases`
--
ALTER TABLE `return_purchases`
  ADD CONSTRAINT `return_purchases_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_id_fk_6156271` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_6156271` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
