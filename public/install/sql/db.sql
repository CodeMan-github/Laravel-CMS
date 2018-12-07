-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2018 at 08:56 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rss`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(10) unsigned NOT NULL,
  `code` text COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scroll_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `show_in_menu` tinyint(4) NOT NULL,
  `show_in_sidebar` tinyint(4) NOT NULL,
  `show_in_footer` tinyint(4) NOT NULL,
  `seo_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_description` text COLLATE utf8_unicode_ci NOT NULL,
  `show_as_mega_menu` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `show_on_home` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`) VALUES
(1, 'US', 'United States'),
(2, 'CA', 'Canada'),
(3, 'AF', 'Afghanistan'),
(4, 'AL', 'Albania'),
(5, 'DZ', 'Algeria'),
(6, 'DS', 'American Samoa'),
(7, 'AD', 'Andorra'),
(8, 'AO', 'Angola'),
(9, 'AI', 'Anguilla'),
(10, 'AQ', 'Antarctica'),
(11, 'AG', 'Antigua and/or Barbuda'),
(12, 'AR', 'Argentina'),
(13, 'AM', 'Armenia'),
(14, 'AW', 'Aruba'),
(15, 'AU', 'Australia'),
(16, 'AT', 'Austria'),
(17, 'AZ', 'Azerbaijan'),
(18, 'BS', 'Bahamas'),
(19, 'BH', 'Bahrain'),
(20, 'BD', 'Bangladesh'),
(21, 'BB', 'Barbados'),
(22, 'BY', 'Belarus'),
(23, 'BE', 'Belgium'),
(24, 'BZ', 'Belize'),
(25, 'BJ', 'Benin'),
(26, 'BM', 'Bermuda'),
(27, 'BT', 'Bhutan'),
(28, 'BO', 'Bolivia'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British lndian Ocean Territory'),
(34, 'BN', 'Brunei Darussalam'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'KH', 'Cambodia'),
(39, 'CM', 'Cameroon'),
(40, 'CV', 'Cape Verde'),
(41, 'KY', 'Cayman Islands'),
(42, 'CF', 'Central African Republic'),
(43, 'TD', 'Chad'),
(44, 'CL', 'Chile'),
(45, 'CN', 'China'),
(46, 'CX', 'Christmas Island'),
(47, 'CC', 'Cocos (Keeling) Islands'),
(48, 'CO', 'Colombia'),
(49, 'KM', 'Comoros'),
(50, 'CG', 'Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'ID', 'Indonesia'),
(101, 'IR', 'Iran (Islamic Republic of)'),
(102, 'IQ', 'Iraq'),
(103, 'IE', 'Ireland'),
(104, 'IL', 'Israel'),
(105, 'IT', 'Italy'),
(106, 'CI', 'Ivory Coast'),
(107, 'JM', 'Jamaica'),
(108, 'JP', 'Japan'),
(109, 'JO', 'Jordan'),
(110, 'KZ', 'Kazakhstan'),
(111, 'KE', 'Kenya'),
(112, 'KI', 'Kiribati'),
(113, 'KP', 'Korea, Democratic People''s Republic of'),
(114, 'KR', 'Korea, Republic of'),
(115, 'XK', 'Kosovo'),
(116, 'KW', 'Kuwait'),
(117, 'KG', 'Kyrgyzstan'),
(118, 'LA', 'Lao People''s Democratic Republic'),
(119, 'LV', 'Latvia'),
(120, 'LB', 'Lebanon'),
(121, 'LS', 'Lesotho'),
(122, 'LR', 'Liberia'),
(123, 'LY', 'Libyan Arab Jamahiriya'),
(124, 'LI', 'Liechtenstein'),
(125, 'LT', 'Lithuania'),
(126, 'LU', 'Luxembourg'),
(127, 'MO', 'Macau'),
(128, 'MK', 'Macedonia'),
(129, 'MG', 'Madagascar'),
(130, 'MW', 'Malawi'),
(131, 'MY', 'Malaysia'),
(132, 'MV', 'Maldives'),
(133, 'ML', 'Mali'),
(134, 'MT', 'Malta'),
(135, 'MH', 'Marshall Islands'),
(136, 'MQ', 'Martinique'),
(137, 'MR', 'Mauritania'),
(138, 'MU', 'Mauritius'),
(139, 'TY', 'Mayotte'),
(140, 'MX', 'Mexico'),
(141, 'FM', 'Micronesia, Federated States of'),
(142, 'MD', 'Moldova, Republic of'),
(143, 'MC', 'Monaco'),
(144, 'MN', 'Mongolia'),
(145, 'ME', 'Montenegro'),
(146, 'MS', 'Montserrat'),
(147, 'MA', 'Morocco'),
(148, 'MZ', 'Mozambique'),
(149, 'MM', 'Myanmar'),
(150, 'NA', 'Namibia'),
(151, 'NR', 'Nauru'),
(152, 'NP', 'Nepal'),
(153, 'NL', 'Netherlands'),
(154, 'AN', 'Netherlands Antilles'),
(155, 'NC', 'New Caledonia'),
(156, 'NZ', 'New Zealand'),
(157, 'NI', 'Nicaragua'),
(158, 'NE', 'Niger'),
(159, 'NG', 'Nigeria'),
(160, 'NU', 'Niue'),
(161, 'NF', 'Norfork Island'),
(162, 'MP', 'Northern Mariana Islands'),
(163, 'NO', 'Norway'),
(164, 'OM', 'Oman'),
(165, 'PK', 'Pakistan'),
(166, 'PW', 'Palau'),
(167, 'PA', 'Panama'),
(168, 'PG', 'Papua New Guinea'),
(169, 'PY', 'Paraguay'),
(170, 'PE', 'Peru'),
(171, 'PH', 'Philippines'),
(172, 'PN', 'Pitcairn'),
(173, 'PL', 'Poland'),
(174, 'PT', 'Portugal'),
(175, 'PR', 'Puerto Rico'),
(176, 'QA', 'Qatar'),
(177, 'RE', 'Reunion'),
(178, 'RO', 'Romania'),
(179, 'RU', 'Russian Federation'),
(180, 'RW', 'Rwanda'),
(181, 'KN', 'Saint Kitts and Nevis'),
(182, 'LC', 'Saint Lucia'),
(183, 'VC', 'Saint Vincent and the Grenadines'),
(184, 'WS', 'Samoa'),
(185, 'SM', 'San Marino'),
(186, 'ST', 'Sao Tome and Principe'),
(187, 'SA', 'Saudi Arabia'),
(188, 'SN', 'Senegal'),
(189, 'RS', 'Serbia'),
(190, 'SC', 'Seychelles'),
(191, 'SL', 'Sierra Leone'),
(192, 'SG', 'Singapore'),
(193, 'SK', 'Slovakia'),
(194, 'SI', 'Slovenia'),
(195, 'SB', 'Solomon Islands'),
(196, 'SO', 'Somalia'),
(197, 'ZA', 'South Africa'),
(198, 'GS', 'South Georgia South Sandwich Islands'),
(199, 'ES', 'Spain'),
(200, 'LK', 'Sri Lanka'),
(201, 'SH', 'St. Helena'),
(202, 'PM', 'St. Pierre and Miquelon'),
(203, 'SD', 'Sudan'),
(204, 'SR', 'Suriname'),
(205, 'SJ', 'Svalbarn and Jan Mayen Islands'),
(206, 'SZ', 'Swaziland'),
(207, 'SE', 'Sweden'),
(208, 'CH', 'Switzerland'),
(209, 'SY', 'Syrian Arab Republic'),
(210, 'TW', 'Taiwan'),
(211, 'TJ', 'Tajikistan'),
(212, 'TZ', 'Tanzania, United Republic of'),
(213, 'TH', 'Thailand'),
(214, 'TG', 'Togo'),
(215, 'TK', 'Tokelau'),
(216, 'TO', 'Tonga'),
(217, 'TT', 'Trinidad and Tobago'),
(218, 'TN', 'Tunisia'),
(219, 'TR', 'Turkey'),
(220, 'TM', 'Turkmenistan'),
(221, 'TC', 'Turks and Caicos Islands'),
(222, 'TV', 'Tuvalu'),
(223, 'UG', 'Uganda'),
(224, 'UA', 'Ukraine'),
(225, 'AE', 'United Arab Emirates'),
(226, 'GB', 'United Kingdom'),
(227, 'UM', 'United States minor outlying islands'),
(228, 'UY', 'Uruguay'),
(229, 'UZ', 'Uzbekistan'),
(230, 'VU', 'Vanuatu'),
(231, 'VA', 'Vatican City State'),
(232, 'VE', 'Venezuela'),
(233, 'VN', 'Vietnam'),
(234, 'VG', 'Virgin Islands (British)'),
(235, 'VI', 'Virgin Islands (U.S.)'),
(236, 'WF', 'Wallis and Futuna Islands'),
(237, 'EH', 'Western Sahara'),
(238, 'YE', 'Yemen'),
(239, 'YU', 'Yugoslavia'),
(240, 'ZR', 'Zaire'),
(241, 'ZM', 'Zambia'),
(242, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `cron_jobs`
--

CREATE TABLE IF NOT EXISTS `cron_jobs` (
  `id` int(10) unsigned NOT NULL,
  `cron_started_on` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cron_completed_on` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `what` text COLLATE utf8_unicode_ci NOT NULL,
  `result` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Content Creator', 'posts.add,posts.view', '2016-02-21 21:52:13', '2018-02-06 23:13:01'),
(3, 'Manager', 'categories.add,categories.edit,categories.view,categories.delete,sources.add,posts.add,posts.edit,posts.view', '2016-09-09 09:00:04', '2016-09-09 09:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `image_gallery`
--

CREATE TABLE IF NOT EXISTS `image_gallery` (
  `id` int(10) unsigned NOT NULL,
  `post_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locales`
--

CREATE TABLE IF NOT EXISTS `locales` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locales`
--

INSERT INTO `locales` (`id`, `title`, `code`) VALUES
(1, 'Arabic', 'ar'),
(2, 'Azerbaijan', 'az'),
(3, 'Bulgarian', 'bg'),
(4, 'Bengali', 'bn'),
(5, 'Catalan', 'ca'),
(6, 'Czech', 'cs'),
(7, 'Danish', 'da'),
(8, 'Dutch', 'nl'),
(9, 'English', 'en'),
(10, 'Esperanto', 'eo'),
(11, 'Finnish', 'fi'),
(12, 'French', 'fr'),
(13, 'Faroese', 'fo'),
(14, 'German', 'de'),
(15, 'Greek', 'el'),
(16, 'Hebrew', 'hr'),
(17, 'Hungarian', 'hu'),
(18, 'Indonesian', 'id'),
(19, 'Italian', 'it'),
(20, 'Japanese', 'ja'),
(21, 'Korean', 'ko'),
(22, 'Latvian', 'lv'),
(23, 'Lithuanian', 'lt'),
(24, 'Malay', 'ms'),
(25, 'Norwegian', 'no'),
(26, 'Polish', 'pl'),
(27, 'Portuguese', 'pt_BR'),
(28, 'Persian', 'fa'),
(29, 'Romanian', 'ro'),
(30, 'Russian', 'ru'),
(31, 'Serbian', 'sr'),
(32, 'Slovak', 'sk'),
(33, 'Slovenian', 'sl'),
(34, 'Spanish', 'es'),
(35, 'Swedish', 'sv'),
(36, 'Thai', 'th'),
(37, 'Turkish', 'tr'),
(38, 'Ukrainian', 'uk'),
(39, 'Uzbek', 'uz'),
(40, 'Vietnamese', 'vi');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_06_23_103902_create_categories_table', 1),
('2015_06_24_104137_create_sources_table', 1),
('2015_06_25_111523_create_pages_table', 1),
('2015_06_25_130151_create_ads_table', 2),
('2015_06_28_112539_create_settings_table', 3),
('2015_07_18_115508_create_avatar', 4),
('2015_07_22_213918_create_sub_categories_table', 5),
('2015_07_22_225256_add_featured_to_posts', 6),
('2015_07_23_130937_create_groups_table', 7),
('2015_07_23_131055_create_user_groups_table', 7),
('2015_07_23_145432_add_fields_to_users', 8),
('2015_07_23_192626_create_countries_table', 9),
('2015_07_23_194056_add_fb_columns_users', 10),
('2015_07_24_061620_add_fields_to_posts', 11),
('2015_07_24_071211_make_tags_table', 12),
('2015_07_24_073148_create_image_gallery_table', 13),
('2015_07_24_073323_add_fields_to_posts', 14),
('2015_07_29_171303_create_post_ratings_table', 15),
('2015_07_29_173535_add_views_to_tags', 16),
('2015_07_29_175532_add_slug_to_tags', 17),
('2015_07_29_180532_add_views_to_tagss', 18),
('2015_07_29_180819_show_as_mega_menu_cats', 19),
('2015_07_29_192856_add_author_to_posts', 20),
('2015_07_30_085814_add_slug_to_users', 21),
('2015_07_30_175935_add_show_featured_image', 22),
('2015_07_31_061109_add_columns_to_users', 23),
('2015_08_03_070051_add_twitter_handle_settings', 24),
('2015_08_03_125746_add_link_to_posts', 25),
('2015_08_03_160735_add_status_author_pages', 26),
('2015_08_07_061421_add_dont_show_author_as_publisher', 27),
('2015_08_09_115604_big_sharing_btns', 28),
('2015_08_11_063723_create_permissions_table', 28),
('2015_08_11_102144_add_rating_desc', 28),
('2015_08_11_103313_add_post_likes_table', 28),
('2015_08_03_170949_add_groups_and_admin', 29),
('2015_08_12_195811_create_cron_jobs_table', 30),
('2015_08_18_084146_add_dummy_table', 30),
('2015_08_19_194624_drop_permissions_and_dummy', 30),
('2015_09_01_041103_add_show_on_homepage_cats', 30),
('2015_09_03_035306_add_full_text_sources', 30),
('2015_09_03_170706_add_locales_and_timezones', 30),
('2016_09_03_223242_create_sub_sub_category', 31);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `show_in_menu` tinyint(4) NOT NULL,
  `show_in_sidebar` tinyint(4) NOT NULL,
  `show_in_footer` tinyint(4) NOT NULL,
  `seo_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL,
  `author_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL,
  `category_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `source_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `lists_description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `views` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `show_in_mega_menu` tinyint(4) NOT NULL,
  `render_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video_embed_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_parallax` tinyint(4) NOT NULL,
  `video_parallax` tinyint(4) NOT NULL,
  `rating_box` tinyint(4) NOT NULL,
  `show_featured_image_in_post` tinyint(4) NOT NULL,
  `show_author_box` tinyint(4) NOT NULL DEFAULT '1',
  `show_author_socials` tinyint(4) NOT NULL DEFAULT '1',
  `dont_show_author_publisher` tinyint(4) NOT NULL,
  `show_post_source` tinyint(4) NOT NULL,
  `rating_desc` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE IF NOT EXISTS `post_likes` (
  `id` int(10) unsigned NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_ratings`
--

CREATE TABLE IF NOT EXISTS `post_ratings` (
  `id` int(10) unsigned NOT NULL,
  `post_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE IF NOT EXISTS `post_tags` (
  `id` int(10) unsigned NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=298 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`id`, `post_id`, `tag_id`, `views`, `created_at`, `updated_at`) VALUES
(3, 1, 3, 0, '2017-08-21 12:25:24', '2017-08-21 12:25:24'),
(4, 1, 4, 0, '2017-08-21 12:25:24', '2017-08-21 12:25:24'),
(5, 1, 5, 0, '2017-08-21 12:25:25', '2017-08-21 12:25:25'),
(6, 2, 6, 0, '2017-08-21 12:25:25', '2017-08-21 12:25:25'),
(7, 2, 7, 0, '2017-08-21 12:25:26', '2017-08-21 12:25:26'),
(8, 2, 8, 0, '2017-08-21 12:25:26', '2017-08-21 12:25:26'),
(9, 2, 9, 0, '2017-08-21 12:25:26', '2017-08-21 12:25:26'),
(10, 2, 10, 0, '2017-08-21 12:25:26', '2017-08-21 12:25:26'),
(11, 3, 11, 0, '2017-08-21 12:25:28', '2017-08-21 12:25:28'),
(12, 3, 12, 0, '2017-08-21 12:25:28', '2017-08-21 12:25:28'),
(13, 3, 13, 0, '2017-08-21 12:25:28', '2017-08-21 12:25:28'),
(14, 3, 14, 0, '2017-08-21 12:25:28', '2017-08-21 12:25:28'),
(15, 3, 15, 0, '2017-08-21 12:25:28', '2017-08-21 12:25:28'),
(16, 4, 16, 0, '2017-08-21 12:25:29', '2017-08-21 12:25:29'),
(17, 4, 17, 0, '2017-08-21 12:25:29', '2017-08-21 12:25:29'),
(18, 4, 18, 0, '2017-08-21 12:25:29', '2017-08-21 12:25:29'),
(19, 4, 19, 0, '2017-08-21 12:25:30', '2017-08-21 12:25:30'),
(20, 4, 20, 0, '2017-08-21 12:25:30', '2017-08-21 12:25:30'),
(21, 5, 21, 0, '2017-08-21 12:25:30', '2017-08-21 12:25:30'),
(22, 5, 22, 0, '2017-08-21 12:25:30', '2017-08-21 12:25:30'),
(23, 5, 23, 0, '2017-08-21 12:25:30', '2017-08-21 12:25:30'),
(24, 5, 24, 0, '2017-08-21 12:25:31', '2017-08-21 12:25:31'),
(25, 5, 17, 0, '2017-08-21 12:25:31', '2017-08-21 12:25:31'),
(26, 6, 16, 0, '2017-08-21 12:25:31', '2017-08-21 12:25:31'),
(27, 6, 25, 0, '2017-08-21 12:25:31', '2017-08-21 12:25:31'),
(28, 6, 23, 0, '2017-08-21 12:25:31', '2017-08-21 12:25:31'),
(29, 6, 17, 0, '2017-08-21 12:25:31', '2017-08-21 12:25:31'),
(30, 6, 26, 0, '2017-08-21 12:25:31', '2017-08-21 12:25:31'),
(31, 7, 27, 0, '2017-08-21 12:25:32', '2017-08-21 12:25:32'),
(32, 7, 20, 0, '2017-08-21 12:25:32', '2017-08-21 12:25:32'),
(33, 7, 28, 0, '2017-08-21 12:25:32', '2017-08-21 12:25:32'),
(34, 7, 16, 0, '2017-08-21 12:25:32', '2017-08-21 12:25:32'),
(35, 7, 29, 0, '2017-08-21 12:25:32', '2017-08-21 12:25:32'),
(36, 8, 16, 0, '2017-08-21 12:25:32', '2017-08-21 12:25:32'),
(37, 8, 21, 0, '2017-08-21 12:25:32', '2017-08-21 12:25:32'),
(38, 8, 29, 0, '2017-08-21 12:25:32', '2017-08-21 12:25:32'),
(39, 8, 23, 0, '2017-08-21 12:25:33', '2017-08-21 12:25:33'),
(40, 8, 17, 0, '2017-08-21 12:25:33', '2017-08-21 12:25:33'),
(41, 9, 27, 0, '2017-08-21 12:25:34', '2017-08-21 12:25:34'),
(42, 9, 20, 0, '2017-08-21 12:25:34', '2017-08-21 12:25:34'),
(43, 9, 28, 0, '2017-08-21 12:25:34', '2017-08-21 12:25:34'),
(44, 9, 16, 0, '2017-08-21 12:25:34', '2017-08-21 12:25:34'),
(45, 9, 30, 0, '2017-08-21 12:25:34', '2017-08-21 12:25:34'),
(46, 10, 31, 0, '2017-08-21 12:25:35', '2017-08-21 12:25:35'),
(47, 10, 32, 0, '2017-08-21 12:25:35', '2017-08-21 12:25:35'),
(48, 10, 33, 0, '2017-08-21 12:25:35', '2017-08-21 12:25:35'),
(49, 10, 34, 0, '2017-08-21 12:25:35', '2017-08-21 12:25:35'),
(50, 10, 35, 0, '2017-08-21 12:25:35', '2017-08-21 12:25:35'),
(51, 11, 31, 0, '2017-08-21 12:25:36', '2017-08-21 12:25:36'),
(52, 11, 36, 0, '2017-08-21 12:25:37', '2017-08-21 12:25:37'),
(53, 11, 37, 0, '2017-08-21 12:25:37', '2017-08-21 12:25:37'),
(54, 11, 38, 0, '2017-08-21 12:25:37', '2017-08-21 12:25:37'),
(55, 11, 39, 0, '2017-08-21 12:25:37', '2017-08-21 12:25:37'),
(56, 12, 40, 0, '2017-08-21 12:25:37', '2017-08-21 12:25:37'),
(57, 12, 31, 0, '2017-08-21 12:25:37', '2017-08-21 12:25:37'),
(58, 12, 41, 0, '2017-08-21 12:25:38', '2017-08-21 12:25:38'),
(59, 12, 36, 0, '2017-08-21 12:25:38', '2017-08-21 12:25:38'),
(60, 12, 37, 0, '2017-08-21 12:25:38', '2017-08-21 12:25:38'),
(61, 13, 20, 0, '2017-08-21 12:25:39', '2017-08-21 12:25:39'),
(62, 13, 42, 0, '2017-08-21 12:25:39', '2017-08-21 12:25:39'),
(63, 13, 43, 0, '2017-08-21 12:25:39', '2017-08-21 12:25:39'),
(64, 13, 44, 0, '2017-08-21 12:25:39', '2017-08-21 12:25:39'),
(65, 13, 45, 0, '2017-08-21 12:25:39', '2017-08-21 12:25:39'),
(66, 14, 46, 0, '2017-08-21 12:25:40', '2017-08-21 12:25:40'),
(67, 14, 42, 0, '2017-08-21 12:25:40', '2017-08-21 12:25:40'),
(68, 14, 47, 0, '2017-08-21 12:25:40', '2017-08-21 12:25:40'),
(69, 14, 48, 0, '2017-08-21 12:25:40', '2017-08-21 12:25:40'),
(70, 14, 49, 0, '2017-08-21 12:25:40', '2017-08-21 12:25:40'),
(71, 15, 42, 0, '2017-08-21 12:25:42', '2017-08-21 12:25:42'),
(72, 15, 47, 0, '2017-08-21 12:25:42', '2017-08-21 12:25:42'),
(73, 15, 50, 0, '2017-08-21 12:25:42', '2017-08-21 12:25:42'),
(74, 15, 51, 0, '2017-08-21 12:25:42', '2017-08-21 12:25:42'),
(75, 15, 52, 0, '2017-08-21 12:25:42', '2017-08-21 12:25:42'),
(76, 16, 53, 0, '2017-08-21 12:25:42', '2017-08-21 12:25:42'),
(77, 16, 54, 0, '2017-08-21 12:25:42', '2017-08-21 12:25:42'),
(78, 16, 55, 0, '2017-08-21 12:25:42', '2017-08-21 12:25:42'),
(79, 16, 56, 0, '2017-08-21 12:25:42', '2017-08-21 12:25:42'),
(80, 16, 20, 0, '2017-08-21 12:25:43', '2017-08-21 12:25:43'),
(81, 17, 20, 0, '2017-08-21 12:25:43', '2017-08-21 12:25:43'),
(82, 17, 42, 0, '2017-08-21 12:25:43', '2017-08-21 12:25:43'),
(83, 17, 57, 0, '2017-08-21 12:25:44', '2017-08-21 12:25:44'),
(84, 17, 58, 0, '2017-08-21 12:25:44', '2017-08-21 12:25:44'),
(85, 17, 20, 0, '2017-08-21 12:25:44', '2017-08-21 12:25:44'),
(86, 18, 59, 0, '2017-08-21 12:25:44', '2017-08-21 12:25:44'),
(87, 18, 60, 0, '2017-08-21 12:25:44', '2017-08-21 12:25:44'),
(88, 18, 61, 0, '2017-08-21 12:25:44', '2017-08-21 12:25:44'),
(89, 18, 62, 0, '2017-08-21 12:25:44', '2017-08-21 12:25:44'),
(90, 18, 28, 0, '2017-08-21 12:25:44', '2017-08-21 12:25:44'),
(91, 19, 63, 0, '2017-08-21 12:25:45', '2017-08-21 12:25:45'),
(92, 19, 7, 0, '2017-08-21 12:25:45', '2017-08-21 12:25:45'),
(93, 19, 64, 0, '2017-08-21 12:25:45', '2017-08-21 12:25:45'),
(94, 19, 46, 0, '2017-08-21 12:25:45', '2017-08-21 12:25:45'),
(95, 19, 65, 0, '2017-08-21 12:25:45', '2017-08-21 12:25:45'),
(96, 20, 66, 0, '2017-08-21 12:25:46', '2017-08-21 12:25:46'),
(97, 20, 67, 0, '2017-08-21 12:25:46', '2017-08-21 12:25:46'),
(98, 20, 68, 0, '2017-08-21 12:25:46', '2017-08-21 12:25:46'),
(99, 20, 69, 0, '2017-08-21 12:25:46', '2017-08-21 12:25:46'),
(100, 20, 28, 0, '2017-08-21 12:25:46', '2017-08-21 12:25:46'),
(101, 21, 70, 0, '2017-08-21 12:25:47', '2017-08-21 12:25:47'),
(102, 21, 71, 0, '2017-08-21 12:25:47', '2017-08-21 12:25:47'),
(103, 21, 72, 0, '2017-08-21 12:25:48', '2017-08-21 12:25:48'),
(104, 21, 28, 0, '2017-08-21 12:25:48', '2017-08-21 12:25:48'),
(105, 21, 73, 0, '2017-08-21 12:25:48', '2017-08-21 12:25:48'),
(106, 22, 20, 0, '2017-08-21 12:25:48', '2017-08-21 12:25:48'),
(107, 22, 74, 0, '2017-08-21 12:25:48', '2017-08-21 12:25:48'),
(108, 22, 75, 0, '2017-08-21 12:25:48', '2017-08-21 12:25:48'),
(109, 22, 20, 0, '2017-08-21 12:25:48', '2017-08-21 12:25:48'),
(110, 22, 74, 0, '2017-08-21 12:25:48', '2017-08-21 12:25:48'),
(111, 23, 20, 0, '2017-08-21 12:25:50', '2017-08-21 12:25:50'),
(112, 23, 76, 0, '2017-08-21 12:25:51', '2017-08-21 12:25:51'),
(113, 23, 31, 0, '2017-08-21 12:25:51', '2017-08-21 12:25:51'),
(114, 23, 77, 0, '2017-08-21 12:25:51', '2017-08-21 12:25:51'),
(115, 23, 78, 0, '2017-08-21 12:25:51', '2017-08-21 12:25:51'),
(116, 24, 60, 0, '2017-08-21 12:25:51', '2017-08-21 12:25:51'),
(117, 24, 79, 0, '2017-08-21 12:25:51', '2017-08-21 12:25:51'),
(118, 24, 80, 0, '2017-08-21 12:25:52', '2017-08-21 12:25:52'),
(119, 24, 81, 0, '2017-08-21 12:25:52', '2017-08-21 12:25:52'),
(120, 24, 28, 0, '2017-08-21 12:25:52', '2017-08-21 12:25:52'),
(121, 25, 82, 0, '2017-08-21 12:25:52', '2017-08-21 12:25:52'),
(122, 25, 83, 0, '2017-08-21 12:25:52', '2017-08-21 12:25:52'),
(123, 25, 84, 0, '2017-08-21 12:25:52', '2017-08-21 12:25:52'),
(124, 25, 85, 0, '2017-08-21 12:25:52', '2017-08-21 12:25:52'),
(125, 25, 86, 0, '2017-08-21 12:25:53', '2017-08-21 12:25:53'),
(126, 26, 27, 0, '2017-08-21 12:25:53', '2017-08-21 12:25:53'),
(127, 26, 87, 0, '2017-08-21 12:25:53', '2017-08-21 12:25:53'),
(128, 26, 31, 0, '2017-08-21 12:25:53', '2017-08-21 12:25:53'),
(129, 26, 77, 0, '2017-08-21 12:25:53', '2017-08-21 12:25:53'),
(130, 26, 88, 0, '2017-08-21 12:25:53', '2017-08-21 12:25:53'),
(131, 27, 20, 0, '2017-08-21 12:25:54', '2017-08-21 12:25:54'),
(132, 27, 42, 0, '2017-08-21 12:25:54', '2017-08-21 12:25:54'),
(133, 27, 89, 0, '2017-08-21 12:25:54', '2017-08-21 12:25:54'),
(134, 27, 90, 0, '2017-08-21 12:25:54', '2017-08-21 12:25:54'),
(135, 27, 20, 0, '2017-08-21 12:25:54', '2017-08-21 12:25:54'),
(136, 28, 91, 0, '2017-08-21 12:25:54', '2017-08-21 12:25:54'),
(137, 28, 92, 0, '2017-08-21 12:25:54', '2017-08-21 12:25:54'),
(138, 28, 93, 0, '2017-08-21 12:25:54', '2017-08-21 12:25:54'),
(139, 28, 94, 0, '2017-08-21 12:25:54', '2017-08-21 12:25:54'),
(140, 28, 95, 0, '2017-08-21 12:25:55', '2017-08-21 12:25:55'),
(141, 29, 74, 0, '2017-08-21 12:25:55', '2017-08-21 12:25:55'),
(142, 29, 96, 0, '2017-08-21 12:25:55', '2017-08-21 12:25:55'),
(143, 29, 97, 0, '2017-08-21 12:25:55', '2017-08-21 12:25:55'),
(144, 29, 98, 0, '2017-08-21 12:25:55', '2017-08-21 12:25:55'),
(145, 29, 99, 0, '2017-08-21 12:25:55', '2017-08-21 12:25:55'),
(146, 30, 100, 0, '2017-08-21 12:25:56', '2017-08-21 12:25:56'),
(147, 30, 101, 0, '2017-08-21 12:25:56', '2017-08-21 12:25:56'),
(148, 30, 41, 0, '2017-08-21 12:25:56', '2017-08-21 12:25:56'),
(149, 30, 37, 0, '2017-08-21 12:25:56', '2017-08-21 12:25:56'),
(150, 30, 102, 0, '2017-08-21 12:25:56', '2017-08-21 12:25:56'),
(156, 32, 105, 0, '2017-08-23 15:19:03', '2017-08-23 15:19:03'),
(157, 32, 106, 0, '2017-08-23 15:19:03', '2017-08-23 15:19:03'),
(158, 32, 107, 0, '2017-08-23 15:19:03', '2017-08-23 15:19:03'),
(159, 32, 108, 0, '2017-08-23 15:19:03', '2017-08-23 15:19:03'),
(160, 32, 109, 0, '2017-08-23 15:19:03', '2017-08-23 15:19:03'),
(161, 33, 27, 0, '2017-08-23 15:19:05', '2017-08-23 15:19:05'),
(162, 33, 110, 0, '2017-08-23 15:19:05', '2017-08-23 15:19:05'),
(163, 33, 111, 0, '2017-08-23 15:19:05', '2017-08-23 15:19:05'),
(164, 33, 112, 0, '2017-08-23 15:19:05', '2017-08-23 15:19:05'),
(165, 33, 113, 0, '2017-08-23 15:19:05', '2017-08-23 15:19:05'),
(166, 34, 78, 0, '2017-08-23 15:19:06', '2017-08-23 15:19:06'),
(167, 34, 114, 0, '2017-08-23 15:19:06', '2017-08-23 15:19:06'),
(168, 34, 115, 0, '2017-08-23 15:19:06', '2017-08-23 15:19:06'),
(169, 34, 116, 0, '2017-08-23 15:19:07', '2017-08-23 15:19:07'),
(170, 34, 117, 0, '2017-08-23 15:19:07', '2017-08-23 15:19:07'),
(171, 35, 118, 0, '2017-08-23 15:19:08', '2017-08-23 15:19:08'),
(172, 35, 119, 0, '2017-08-23 15:19:08', '2017-08-23 15:19:08'),
(173, 35, 120, 0, '2017-08-23 15:19:08', '2017-08-23 15:19:08'),
(174, 35, 121, 0, '2017-08-23 15:19:08', '2017-08-23 15:19:08'),
(175, 35, 122, 0, '2017-08-23 15:19:09', '2017-08-23 15:19:09'),
(176, 36, 123, 0, '2017-08-23 15:19:09', '2017-08-23 15:19:09'),
(177, 36, 124, 0, '2017-08-23 15:19:09', '2017-08-23 15:19:09'),
(178, 36, 28, 0, '2017-08-23 15:19:09', '2017-08-23 15:19:09'),
(179, 36, 125, 0, '2017-08-23 15:19:09', '2017-08-23 15:19:09'),
(180, 37, 126, 0, '2017-08-23 15:19:10', '2017-08-23 15:19:10'),
(181, 37, 110, 0, '2017-08-23 15:19:10', '2017-08-23 15:19:10'),
(182, 37, 127, 0, '2017-08-23 15:19:11', '2017-08-23 15:19:11'),
(183, 37, 128, 0, '2017-08-23 15:19:11', '2017-08-23 15:19:11'),
(184, 37, 129, 0, '2017-08-23 15:19:11', '2017-08-23 15:19:11'),
(185, 38, 16, 0, '2017-08-23 15:19:11', '2017-08-23 15:19:11'),
(186, 38, 130, 0, '2017-08-23 15:19:11', '2017-08-23 15:19:11'),
(187, 38, 131, 0, '2017-08-23 15:19:11', '2017-08-23 15:19:11'),
(188, 38, 132, 0, '2017-08-23 15:19:11', '2017-08-23 15:19:11'),
(189, 38, 20, 0, '2017-08-23 15:19:11', '2017-08-23 15:19:11'),
(190, 39, 73, 0, '2017-08-23 15:19:13', '2017-08-23 15:19:13'),
(191, 39, 133, 0, '2017-08-23 15:19:13', '2017-08-23 15:19:13'),
(192, 39, 134, 0, '2017-08-23 15:19:13', '2017-08-23 15:19:13'),
(193, 39, 135, 0, '2017-08-23 15:19:13', '2017-08-23 15:19:13'),
(194, 39, 28, 0, '2017-08-23 15:19:13', '2017-08-23 15:19:13'),
(195, 40, 136, 0, '2017-08-23 15:19:13', '2017-08-23 15:19:13'),
(196, 40, 137, 0, '2017-08-23 15:19:13', '2017-08-23 15:19:13'),
(197, 40, 138, 0, '2017-08-23 15:19:13', '2017-08-23 15:19:13'),
(198, 40, 139, 0, '2017-08-23 15:19:14', '2017-08-23 15:19:14'),
(199, 40, 140, 0, '2017-08-23 15:19:14', '2017-08-23 15:19:14'),
(201, 41, 141, 0, '2017-08-23 15:19:15', '2017-08-23 15:19:15'),
(203, 41, 142, 0, '2017-08-23 15:19:15', '2017-08-23 15:19:15'),
(204, 41, 143, 0, '2017-08-23 15:19:15', '2017-08-23 15:19:15'),
(205, 42, 63, 0, '2017-08-23 15:19:16', '2017-08-23 15:19:16'),
(206, 42, 78, 0, '2017-08-23 15:19:16', '2017-08-23 15:19:16'),
(207, 42, 103, 0, '2017-08-23 15:19:16', '2017-08-23 15:19:16'),
(208, 42, 144, 0, '2017-08-23 15:19:16', '2017-08-23 15:19:16'),
(209, 42, 145, 0, '2017-08-23 15:19:16', '2017-08-23 15:19:16'),
(210, 43, 146, 0, '2017-08-23 15:19:16', '2017-08-23 15:19:16'),
(211, 43, 147, 0, '2017-08-23 15:19:16', '2017-08-23 15:19:16'),
(212, 43, 148, 0, '2017-08-23 15:19:16', '2017-08-23 15:19:16'),
(213, 43, 149, 0, '2017-08-23 15:19:16', '2017-08-23 15:19:16'),
(214, 43, 150, 0, '2017-08-23 15:19:17', '2017-08-23 15:19:17'),
(215, 44, 151, 0, '2017-08-23 15:19:17', '2017-08-23 15:19:17'),
(216, 44, 152, 0, '2017-08-23 15:19:17', '2017-08-23 15:19:17'),
(217, 44, 153, 0, '2017-08-23 15:19:17', '2017-08-23 15:19:17'),
(218, 44, 28, 0, '2017-08-23 15:19:17', '2017-08-23 15:19:17'),
(219, 44, 154, 0, '2017-08-23 15:19:17', '2017-08-23 15:19:17'),
(220, 45, 17, 0, '2017-08-23 15:19:17', '2017-08-23 15:19:17'),
(221, 45, 155, 0, '2017-08-23 15:19:17', '2017-08-23 15:19:17'),
(222, 45, 20, 0, '2017-08-23 15:19:17', '2017-08-23 15:19:17'),
(223, 45, 16, 0, '2017-08-23 15:19:18', '2017-08-23 15:19:18'),
(224, 46, 156, 0, '2017-08-23 15:19:18', '2017-08-23 15:19:18'),
(225, 46, 157, 0, '2017-08-23 15:19:18', '2017-08-23 15:19:18'),
(226, 46, 158, 0, '2017-08-23 15:19:18', '2017-08-23 15:19:18'),
(227, 46, 28, 0, '2017-08-23 15:19:18', '2017-08-23 15:19:18'),
(228, 46, 156, 0, '2017-08-23 15:19:18', '2017-08-23 15:19:18'),
(229, 47, 159, 0, '2017-08-23 15:19:18', '2017-08-23 15:19:18'),
(230, 47, 28, 0, '2017-08-23 15:19:18', '2017-08-23 15:19:18'),
(231, 47, 154, 0, '2017-08-23 15:19:18', '2017-08-23 15:19:18'),
(232, 48, 156, 0, '2017-08-23 15:19:19', '2017-08-23 15:19:19'),
(233, 48, 160, 0, '2017-08-23 15:19:19', '2017-08-23 15:19:19'),
(234, 48, 157, 0, '2017-08-23 15:19:19', '2017-08-23 15:19:19'),
(235, 48, 28, 0, '2017-08-23 15:19:19', '2017-08-23 15:19:19'),
(236, 48, 156, 0, '2017-08-23 15:19:19', '2017-08-23 15:19:19'),
(237, 49, 46, 0, '2017-08-23 15:19:20', '2017-08-23 15:19:20'),
(239, 49, 104, 0, '2017-08-23 15:19:20', '2017-08-23 15:19:20'),
(240, 49, 161, 0, '2017-08-23 15:19:20', '2017-08-23 15:19:20'),
(241, 49, 46, 0, '2017-08-23 15:19:20', '2017-08-23 15:19:20'),
(242, 50, 162, 0, '2017-08-23 15:19:21', '2017-08-23 15:19:21'),
(243, 50, 163, 0, '2017-08-23 15:19:21', '2017-08-23 15:19:21'),
(244, 50, 164, 0, '2017-08-23 15:19:21', '2017-08-23 15:19:21'),
(245, 50, 165, 0, '2017-08-23 15:19:21', '2017-08-23 15:19:21'),
(246, 50, 166, 0, '2017-08-23 15:19:21', '2017-08-23 15:19:21'),
(247, 51, 27, 0, '2017-08-23 15:19:22', '2017-08-23 15:19:22'),
(248, 51, 167, 0, '2017-08-23 15:19:22', '2017-08-23 15:19:22'),
(249, 51, 168, 0, '2017-08-23 15:19:22', '2017-08-23 15:19:22'),
(250, 51, 169, 0, '2017-08-23 15:19:22', '2017-08-23 15:19:22'),
(251, 51, 170, 0, '2017-08-23 15:19:22', '2017-08-23 15:19:22'),
(252, 52, 171, 0, '2017-08-23 15:19:22', '2017-08-23 15:19:22'),
(253, 52, 107, 0, '2017-08-23 15:19:22', '2017-08-23 15:19:22'),
(254, 52, 172, 0, '2017-08-23 15:19:23', '2017-08-23 15:19:23'),
(255, 52, 173, 0, '2017-08-23 15:19:23', '2017-08-23 15:19:23'),
(256, 52, 174, 0, '2017-08-23 15:19:23', '2017-08-23 15:19:23'),
(257, 53, 156, 0, '2017-08-23 15:19:23', '2017-08-23 15:19:23'),
(258, 53, 175, 0, '2017-08-23 15:19:23', '2017-08-23 15:19:23'),
(259, 53, 28, 0, '2017-08-23 15:19:23', '2017-08-23 15:19:23'),
(260, 53, 156, 0, '2017-08-23 15:19:23', '2017-08-23 15:19:23'),
(261, 54, 46, 0, '2017-08-23 15:19:23', '2017-08-23 15:19:23'),
(262, 54, 176, 0, '2017-08-23 15:19:23', '2017-08-23 15:19:23'),
(263, 54, 42, 0, '2017-08-23 15:19:23', '2017-08-23 15:19:23'),
(264, 54, 89, 0, '2017-08-23 15:19:23', '2017-08-23 15:19:23'),
(265, 54, 177, 0, '2017-08-23 15:19:24', '2017-08-23 15:19:24'),
(266, 55, 125, 0, '2017-08-23 15:19:24', '2017-08-23 15:19:24'),
(267, 55, 178, 0, '2017-08-23 15:19:24', '2017-08-23 15:19:24'),
(268, 55, 179, 0, '2017-08-23 15:19:24', '2017-08-23 15:19:24'),
(269, 55, 180, 0, '2017-08-23 15:19:24', '2017-08-23 15:19:24'),
(270, 55, 20, 0, '2017-08-23 15:19:24', '2017-08-23 15:19:24'),
(271, 56, 171, 0, '2017-08-23 15:19:24', '2017-08-23 15:19:24'),
(272, 56, 181, 0, '2017-08-23 15:19:25', '2017-08-23 15:19:25'),
(273, 56, 172, 0, '2017-08-23 15:19:25', '2017-08-23 15:19:25'),
(274, 56, 174, 0, '2017-08-23 15:19:25', '2017-08-23 15:19:25'),
(275, 56, 182, 0, '2017-08-23 15:19:25', '2017-08-23 15:19:25'),
(276, 57, 78, 0, '2017-08-23 15:19:25', '2017-08-23 15:19:25'),
(277, 57, 176, 0, '2017-08-23 15:19:25', '2017-08-23 15:19:25'),
(278, 57, 154, 0, '2017-08-23 15:19:25', '2017-08-23 15:19:25'),
(279, 58, 20, 0, '2017-08-23 15:19:27', '2017-08-23 15:19:27'),
(280, 58, 125, 0, '2017-08-23 15:19:27', '2017-08-23 15:19:27'),
(281, 58, 183, 0, '2017-08-23 15:19:27', '2017-08-23 15:19:27'),
(282, 58, 154, 0, '2017-08-23 15:19:27', '2017-08-23 15:19:27'),
(283, 58, 78, 0, '2017-08-23 15:19:27', '2017-08-23 15:19:27'),
(284, 59, 184, 0, '2017-08-23 15:19:28', '2017-08-23 15:19:28'),
(285, 59, 89, 0, '2017-08-23 15:19:28', '2017-08-23 15:19:28'),
(286, 59, 185, 0, '2017-08-23 15:19:28', '2017-08-23 15:19:28'),
(287, 59, 186, 0, '2017-08-23 15:19:28', '2017-08-23 15:19:28'),
(288, 59, 187, 0, '2017-08-23 15:19:28', '2017-08-23 15:19:28'),
(289, 60, 61, 0, '2017-08-23 15:19:28', '2017-08-23 15:19:28'),
(290, 60, 188, 0, '2017-08-23 15:19:28', '2017-08-23 15:19:28'),
(291, 60, 189, 0, '2017-08-23 15:19:28', '2017-08-23 15:19:28'),
(292, 60, 190, 0, '2017-08-23 15:19:29', '2017-08-23 15:19:29'),
(293, 60, 191, 0, '2017-08-23 15:19:29', '2017-08-23 15:19:29'),
(294, 31, 46, 0, '2017-08-23 15:22:09', '2017-08-23 15:22:09'),
(295, 31, 63, 0, '2017-08-23 15:22:09', '2017-08-23 15:22:09'),
(296, 31, 103, 0, '2017-08-23 15:22:09', '2017-08-23 15:22:09'),
(297, 31, 104, 0, '2017-08-23 15:22:09', '2017-08-23 15:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `column_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value_string` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_txt` text COLLATE utf8_unicode_ci,
  `value_check` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `show_big_sharing` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `category`, `column_key`, `value_string`, `value_txt`, `value_check`, `created_at`, `updated_at`, `show_big_sharing`) VALUES
(1, 'general', 'site_url', 'http://phpdummies.com', NULL, NULL, '2015-07-27 10:14:25', '2015-08-03 18:42:16', 0),
(2, 'general', 'site_title', 'RSS AGGREGATOR', NULL, NULL, '2015-07-27 10:14:25', '2015-07-27 10:14:25', 0),
(3, 'general', 'analytics_code', NULL, '<script>\r\n  (function(i,s,o,g,r,a,m){i[''GoogleAnalyticsObject'']=r;i[r]=i[r]||function(){\r\n  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\r\n  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\r\n  })(window,document,''script'',''//www.google-analytics.com/analytics.js'',''ga'');\r\n\r\n  ga(''create'', ''UA-46219998-2'', ''auto'');\r\n  ga(''send'', ''pageview'');\r\n\r\n</script>', NULL, '2015-07-27 10:14:25', '2015-08-03 12:37:11', 0),
(4, 'general', 'mailchimp_form', NULL, '<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">\r\n<style type="text/css">\r\n    #mc_embed_signup{clear:left; font:14px Helvetica,Arial,sans-serif; }\r\n#mc_embed_signup input.email{width:100% !important;}\r\n    /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.\r\n       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */\r\n</style>\r\n\r\n<div id="mc_embed_signup">\r\n            <form action="//kodeinfo.us3.list-manage.com/subscribe/post?u=432b8d5be12d2248705e3269b&id=1ca4b4cd98" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>\r\n                <div id="mc_embed_signup_scroll">\r\n                    <label for="mce-EMAIL">Subscribe to our mailing list</label>\r\n                    <input type="email" value="" name="EMAIL" class="email plain buffer" id="mce-EMAIL" placeholder="Email address" required>\r\n                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->\r\n                    <div style="position: absolute; left: -5000px;"><input type="text" name="b_432b8d5be12d2248705e3269b_1ca4b4cd98" tabindex="-1" value=""></div>\r\n                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button btn btn-success"></div>\r\n                </div>\r\n            </form>\r\n        </div>', NULL, '2015-07-27 10:14:25', '2015-08-07 09:26:12', 0),
(5, 'general', 'logo_76', 'http://rss.app/uploads/images/57a82fa4e0e92_file.png', NULL, NULL, '2015-07-27 10:14:25', '2016-08-07 21:37:17', 0),
(6, 'general', 'logo_120', 'http://rss.app/uploads/images/57a82fa5244c0_file.png', NULL, NULL, '2015-07-27 10:14:26', '2016-08-07 21:37:17', 0),
(7, 'general', 'logo_152', 'http://rss.app/uploads/images/57a82fa533e8b_file.png', NULL, NULL, '2015-07-27 10:14:26', '2016-08-07 21:37:17', 0),
(8, 'general', 'favicon', 'http://rss.app/uploads/images/57a82fa53f61a_file.png', NULL, NULL, '2015-07-27 10:14:26', '2016-08-07 21:37:17', 0),
(9, 'general', 'site_post_as_titles', NULL, NULL, 0, '2015-07-27 10:14:26', '2015-08-03 12:37:11', 0),
(10, 'general', 'generate_sitemap', NULL, NULL, 1, '2015-07-27 10:14:26', '2015-07-27 10:14:26', 0),
(11, 'general', 'generate_rss_feeds', NULL, NULL, 1, '2015-07-27 10:14:26', '2015-07-27 10:14:26', 0),
(12, 'general', 'include_sources', NULL, NULL, 1, '2015-07-27 10:14:26', '2015-07-27 10:14:26', 0),
(13, 'seo', 'seo_keywords', NULL, 'rss,aggregator,website cloning scripts', NULL, '2015-07-27 10:29:28', '2015-07-27 10:29:28', 0),
(14, 'seo', 'seo_description', NULL, 'seo description goes here', NULL, '2015-07-27 10:29:28', '2015-07-27 10:29:28', 0),
(15, 'seo', 'google_verify', '<meta name="google-site-verification" content="QsHIQMfsdaassq1kr8irG33KS7LoaJhZY8XLTdAQ7PA" />', NULL, NULL, '2015-07-27 10:29:28', '2015-07-27 10:29:28', 0),
(16, 'seo', 'bing_verify', '<meta name="msvalidate.01" content="5A3A378F55B7518E3733ffS784711DC0" />', NULL, NULL, '2015-07-27 10:29:28', '2015-07-27 10:29:28', 0),
(17, 'comments', 'comment_system', 'disqus', NULL, NULL, '2015-07-27 10:31:06', '2015-08-07 09:28:04', 0),
(18, 'comments', 'fb_js', NULL, '<div id="fb-root"></div>\r\n<script>(function(d, s, id) {\r\n  var js, fjs = d.getElementsByTagName(s)[0];\r\n  if (d.getElementById(id)) return;\r\n  js = d.createElement(s); js.id = id;\r\n  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=501198926683933";\r\n  fjs.parentNode.insertBefore(js, fjs);\r\n}(document, ''script'', ''facebook-jssdk''));</script>', NULL, '2015-07-27 10:31:06', '2015-07-31 01:58:12', 0),
(19, 'comments', 'fb_num_posts', '5', NULL, NULL, '2015-07-27 10:31:06', '2015-07-31 01:58:12', 0),
(20, 'comments', 'fb_comment_count', NULL, NULL, 1, '2015-07-27 10:31:07', '2015-07-31 01:58:12', 0),
(21, 'comments', 'disqus_js', NULL, '<div id="disqus_thread"></div>\r\n<script type="text/javascript">\r\n    /* * * CONFIGURATION VARIABLES * * */\r\n    var disqus_shortname = ''rsstesting'';\r\n    \r\n    /* * * DON''T EDIT BELOW THIS LINE * * */\r\n    (function() {\r\n        var dsq = document.createElement(''script''); dsq.type = ''text/javascript''; dsq.async = true;\r\n        dsq.src = ''//'' + disqus_shortname + ''.disqus.com/embed.js'';\r\n        (document.getElementsByTagName(''head'')[0] || document.getElementsByTagName(''body'')[0]).appendChild(dsq);\r\n    })();\r\n</script>\r\n<script type="text/javascript">\r\n    /* * * CONFIGURATION VARIABLES * * */\r\n    var disqus_shortname = ''rsstesting'';\r\n    \r\n    /* * * DON''T EDIT BELOW THIS LINE * * */\r\n    (function () {\r\n        var s = document.createElement(''script''); s.async = true;\r\n        s.type = ''text/javascript'';\r\n        s.src = ''//'' + disqus_shortname + ''.disqus.com/count.js'';\r\n        (document.getElementsByTagName(''HEAD'')[0] || document.getElementsByTagName(''BODY'')[0]).appendChild(s);\r\n    }());\r\n</script>\r\n<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>', NULL, '2015-07-27 10:31:07', '2015-07-31 01:49:52', 0),
(22, 'comments', 'disqus_comment_count', NULL, NULL, 1, '2015-07-27 10:31:07', '2015-07-27 11:00:57', 0),
(23, 'comments', 'show_comment_box', NULL, NULL, 1, '2015-07-27 10:31:07', '2015-07-27 10:31:07', 0),
(24, 'social', 'fb_page_url', 'http://www.facebook.com', NULL, NULL, '2015-07-27 10:49:13', '2015-07-27 10:49:13', 0),
(25, 'social', 'twitter_url', 'http://www.twitter.com', NULL, NULL, '2015-07-27 10:49:13', '2015-07-27 10:49:13', 0),
(26, 'social', 'google_plus_page_url', 'http://plus.google.com', NULL, NULL, '2015-07-27 10:49:14', '2015-07-27 10:49:14', 0),
(27, 'social', 'skype_username', 'kodeinfo', NULL, NULL, '2015-07-27 10:49:14', '2015-07-27 10:49:14', 0),
(28, 'social', 'youtube_channel_url', 'http://www.youtube.com', NULL, NULL, '2015-07-27 10:49:14', '2015-07-27 10:49:14', 0),
(29, 'social', 'vimeo_channel_url', 'http://www.vimeo.com', NULL, NULL, '2015-07-27 10:49:14', '2015-07-27 10:49:14', 0),
(30, 'social', 'addthis_js', NULL, '<!-- Go to www.addthis.com/dashboard to customize your tools -->\r\n<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55bb432d558afc29" async="async"></script>', NULL, '2015-07-27 10:49:14', '2015-07-31 00:25:50', 0),
(31, 'social', 'sharethis_js', NULL, '<script type="text/javascript">var switchTo5x=true;</script>\r\n<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>\r\n<script type="text/javascript">stLight.options({publisher: "04a92307-c6d5-4f7d-b14d-08d8a6960c5c", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>', NULL, '2015-07-27 10:49:14', '2015-07-31 00:25:50', 0),
(32, 'social', 'facebook_box_js', NULL, '<div class="fb-page" data-href="https://www.facebook.com/facebook" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>\r\n\r\n<div id="fb-root"></div>\r\n<script>(function(d, s, id) {\r\n  var js, fjs = d.getElementsByTagName(s)[0];\r\n  if (d.getElementById(id)) return;\r\n  js = d.createElement(s); js.id = id;\r\n  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=501198926683933";\r\n  fjs.parentNode.insertBefore(js, fjs);\r\n}(document, ''script'', ''facebook-jssdk''));</script>', NULL, '2015-07-27 10:49:14', '2015-07-31 02:01:45', 0),
(33, 'social', 'twitter_box_js', NULL, '<a class="twitter-timeline" href="https://twitter.com/kode_info" data-widget-id="627080804296888320">Tweets by @kode_info</a>\r\n<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?''http'':''https'';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>', NULL, '2015-07-27 10:49:14', '2015-07-31 02:08:29', 0),
(34, 'social', 'show_sharing', NULL, NULL, 1, '2015-07-27 10:49:14', '2015-07-27 10:49:14', 0),
(35, 'custom_js', 'custom_js', NULL, '<script type="text/javascript">\r\nconsole.log(''CUSTOM JS'');\r\n</script>', NULL, '2015-07-27 10:49:50', '2015-07-27 10:49:50', 0),
(36, 'custom_css', 'custom_css', NULL, '<style type="text/css">\r\n.stButton .stBubble_count{height:42px  !important;}\r\n.stButton .stMainServices{height:25px !important; }\r\n</style>', NULL, '2015-07-27 10:50:07', '2015-08-07 09:41:35', 0),
(37, 'social', 'sharethis_span_tags', NULL, '<span class=''st_sharethis_vcount'' displayText=''ShareThis''></span>\r\n<span class=''st_facebook_vcount'' displayText=''Facebook''></span>\r\n<span class=''st_twitter_vcount'' displayText=''Tweet''></span>\r\n<span class=''st_linkedin_vcount'' displayText=''LinkedIn''></span>\r\n<span class=''st_pinterest_vcount'' displayText=''Pinterest''></span>\r\n<span class=''st_email_vcount'' displayText=''Email''></span>', NULL, '2015-07-27 10:49:14', '2015-07-31 00:37:48', 0),
(38, 'social', 'twitter_handle', '', NULL, NULL, '2015-08-03 11:15:08', '2015-08-03 11:15:08', 0),
(39, 'social', 'show_big_sharing', NULL, NULL, 1, '2015-08-09 16:40:40', '2015-08-09 16:40:40', 0),
(40, 'general', 'timezone', 'America/New_York', NULL, NULL, '2016-08-07 21:37:17', '2016-08-07 21:37:17', 0),
(41, 'general', 'locale', 'en', NULL, NULL, '2016-08-07 21:37:17', '2016-08-07 21:37:17', 0),
(42, 'old_news', 'days', '5', NULL, NULL, '2017-03-09 21:49:45', '2017-03-09 22:04:19', 0),
(43, 'old_news', 'auto_delete_old_news', NULL, NULL, 1, '2017-03-09 21:49:45', '2017-03-09 21:49:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE IF NOT EXISTS `sources` (
  `id` int(10) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `channel_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel_language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel_pubDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel_lastBuildDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel_generator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auto_update` tinyint(4) NOT NULL,
  `items_count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dont_show_author_publisher` tinyint(4) NOT NULL,
  `show_post_source` tinyint(4) NOT NULL,
  `fetch_full_text` tinyint(4) NOT NULL,
  `use_auto_spin` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(10) unsigned NOT NULL,
  `parent_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scroll_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `show_in_menu` tinyint(4) NOT NULL,
  `show_in_sidebar` tinyint(4) NOT NULL,
  `show_in_footer` tinyint(4) NOT NULL,
  `seo_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE IF NOT EXISTS `timezones` (
  `id` int(10) unsigned NOT NULL,
  `country_iso` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=417 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `country_iso`, `code`) VALUES
(1, 'AD', 'Europe/Andorra'),
(2, 'AE', 'Asia/Dubai'),
(3, 'AF', 'Asia/Kabul'),
(4, 'AG', 'America/Antigua'),
(5, 'AI', 'America/Anguilla'),
(6, 'AL', 'Europe/Tirane'),
(7, 'AM', 'Asia/Yerevan'),
(8, 'AO', 'Africa/Luanda'),
(9, 'AQ', 'Antarctica/McMurdo'),
(10, 'AQ', 'Antarctica/Rothera'),
(11, 'AQ', 'Antarctica/Palmer'),
(12, 'AQ', 'Antarctica/Mawson'),
(13, 'AQ', 'Antarctica/Davis'),
(14, 'AQ', 'Antarctica/Casey'),
(15, 'AQ', 'Antarctica/Vostok'),
(16, 'AQ', 'Antarctica/DumontDUrville'),
(17, 'AQ', 'Antarctica/Syowa'),
(18, 'AQ', 'Antarctica/Troll'),
(19, 'AR', 'America/Argentina/Buenos_Aires'),
(20, 'AR', 'America/Argentina/Cordoba'),
(21, 'AR', 'America/Argentina/Salta'),
(22, 'AR', 'America/Argentina/Jujuy'),
(23, 'AR', 'America/Argentina/Tucuman'),
(24, 'AR', 'America/Argentina/Catamarca'),
(25, 'AR', 'America/Argentina/La_Rioja'),
(26, 'AR', 'America/Argentina/San_Juan'),
(27, 'AR', 'America/Argentina/Mendoza'),
(28, 'AR', 'America/Argentina/San_Luis'),
(29, 'AR', 'America/Argentina/Rio_Gallegos'),
(30, 'AR', 'America/Argentina/Ushuaia'),
(31, 'AS', 'Pacific/Pago_Pago'),
(32, 'AT', 'Europe/Vienna'),
(33, 'AU', 'Australia/Lord_Howe'),
(34, 'AU', 'Antarctica/Macquarie'),
(35, 'AU', 'Australia/Hobart'),
(36, 'AU', 'Australia/Currie'),
(37, 'AU', 'Australia/Melbourne'),
(38, 'AU', 'Australia/Sydney'),
(39, 'AU', 'Australia/Broken_Hill'),
(40, 'AU', 'Australia/Brisbane'),
(41, 'AU', 'Australia/Lindeman'),
(42, 'AU', 'Australia/Adelaide'),
(43, 'AU', 'Australia/Darwin'),
(44, 'AU', 'Australia/Perth'),
(45, 'AU', 'Australia/Eucla'),
(46, 'AW', 'America/Aruba'),
(47, 'AX', 'Europe/Mariehamn'),
(48, 'AZ', 'Asia/Baku'),
(49, 'BA', 'Europe/Sarajevo'),
(50, 'BB', 'America/Barbados'),
(51, 'BD', 'Asia/Dhaka'),
(52, 'BE', 'Europe/Brussels'),
(53, 'BF', 'Africa/Ouagadougou'),
(54, 'BG', 'Europe/Sofia'),
(55, 'BH', 'Asia/Bahrain'),
(56, 'BI', 'Africa/Bujumbura'),
(57, 'BJ', 'Africa/Porto-Novo'),
(58, 'BL', 'America/St_Barthelemy'),
(59, 'BM', 'Atlantic/Bermuda'),
(60, 'BN', 'Asia/Brunei'),
(61, 'BO', 'America/La_Paz'),
(62, 'BQ', 'America/Kralendijk'),
(63, 'BR', 'America/Noronha'),
(64, 'BR', 'America/Belem'),
(65, 'BR', 'America/Fortaleza'),
(66, 'BR', 'America/Recife'),
(67, 'BR', 'America/Araguaina'),
(68, 'BR', 'America/Maceio'),
(69, 'BR', 'America/Bahia'),
(70, 'BR', 'America/Sao_Paulo'),
(71, 'BR', 'America/Campo_Grande'),
(72, 'BR', 'America/Cuiaba'),
(73, 'BR', 'America/Santarem'),
(74, 'BR', 'America/Porto_Velho'),
(75, 'BR', 'America/Boa_Vista'),
(76, 'BR', 'America/Manaus'),
(77, 'BR', 'America/Eirunepe'),
(78, 'BR', 'America/Rio_Branco'),
(79, 'BS', 'America/Nassau'),
(80, 'BT', 'Asia/Thimphu'),
(81, 'BW', 'Africa/Gaborone'),
(82, 'BY', 'Europe/Minsk'),
(83, 'BZ', 'America/Belize'),
(84, 'CA', 'America/St_Johns'),
(85, 'CA', 'America/Halifax'),
(86, 'CA', 'America/Glace_Bay'),
(87, 'CA', 'America/Moncton'),
(88, 'CA', 'America/Goose_Bay'),
(89, 'CA', 'America/Blanc-Sablon'),
(90, 'CA', 'America/Toronto'),
(91, 'CA', 'America/Nipigon'),
(92, 'CA', 'America/Thunder_Bay'),
(93, 'CA', 'America/Iqaluit'),
(94, 'CA', 'America/Pangnirtung'),
(95, 'CA', 'America/Resolute'),
(96, 'CA', 'America/Atikokan'),
(97, 'CA', 'America/Rankin_Inlet'),
(98, 'CA', 'America/Winnipeg'),
(99, 'CA', 'America/Rainy_River'),
(100, 'CA', 'America/Regina'),
(101, 'CA', 'America/Swift_Current'),
(102, 'CA', 'America/Edmonton'),
(103, 'CA', 'America/Cambridge_Bay'),
(104, 'CA', 'America/Yellowknife'),
(105, 'CA', 'America/Inuvik'),
(106, 'CA', 'America/Creston'),
(107, 'CA', 'America/Dawson_Creek'),
(108, 'CA', 'America/Vancouver'),
(109, 'CA', 'America/Whitehorse'),
(110, 'CA', 'America/Dawson'),
(111, 'CC', 'Indian/Cocos'),
(112, 'CD', 'Africa/Kinshasa'),
(113, 'CD', 'Africa/Lubumbashi'),
(114, 'CF', 'Africa/Bangui'),
(115, 'CG', 'Africa/Brazzaville'),
(116, 'CH', 'Europe/Zurich'),
(117, 'CI', 'Africa/Abidjan'),
(118, 'CK', 'Pacific/Rarotonga'),
(119, 'CL', 'America/Santiago'),
(120, 'CL', 'Pacific/Easter'),
(121, 'CM', 'Africa/Douala'),
(122, 'CN', 'Asia/Shanghai'),
(123, 'CN', 'Asia/Urumqi'),
(124, 'CO', 'America/Bogota'),
(125, 'CR', 'America/Costa_Rica'),
(126, 'CU', 'America/Havana'),
(127, 'CV', 'Atlantic/Cape_Verde'),
(128, 'CW', 'America/Curacao'),
(129, 'CX', 'Indian/Christmas'),
(130, 'CY', 'Asia/Nicosia'),
(131, 'CZ', 'Europe/Prague'),
(132, 'DE', 'Europe/Berlin'),
(133, 'DE', 'Europe/Busingen'),
(134, 'DJ', 'Africa/Djibouti'),
(135, 'DK', 'Europe/Copenhagen'),
(136, 'DM', 'America/Dominica'),
(137, 'DO', 'America/Santo_Domingo'),
(138, 'DZ', 'Africa/Algiers'),
(139, 'EC', 'America/Guayaquil'),
(140, 'EC', 'Pacific/Galapagos'),
(141, 'EE', 'Europe/Tallinn'),
(142, 'EG', 'Africa/Cairo'),
(143, 'EH', 'Africa/El_Aaiun'),
(144, 'ER', 'Africa/Asmara'),
(145, 'ES', 'Europe/Madrid'),
(146, 'ES', 'Africa/Ceuta'),
(147, 'ES', 'Atlantic/Canary'),
(148, 'ET', 'Africa/Addis_Ababa'),
(149, 'FI', 'Europe/Helsinki'),
(150, 'FJ', 'Pacific/Fiji'),
(151, 'FK', 'Atlantic/Stanley'),
(152, 'FM', 'Pacific/Chuuk'),
(153, 'FM', 'Pacific/Pohnpei'),
(154, 'FM', 'Pacific/Kosrae'),
(155, 'FO', 'Atlantic/Faroe'),
(156, 'FR', 'Europe/Paris'),
(157, 'GA', 'Africa/Libreville'),
(158, 'GB', 'Europe/London'),
(159, 'GD', 'America/Grenada'),
(160, 'GE', 'Asia/Tbilisi'),
(161, 'GF', 'America/Cayenne'),
(162, 'GG', 'Europe/Guernsey'),
(163, 'GH', 'Africa/Accra'),
(164, 'GI', 'Europe/Gibraltar'),
(165, 'GL', 'America/Godthab'),
(166, 'GL', 'America/Danmarkshavn'),
(167, 'GL', 'America/Scoresbysund'),
(168, 'GL', 'America/Thule'),
(169, 'GM', 'Africa/Banjul'),
(170, 'GN', 'Africa/Conakry'),
(171, 'GP', 'America/Guadeloupe'),
(172, 'GQ', 'Africa/Malabo'),
(173, 'GR', 'Europe/Athens'),
(174, 'GS', 'Atlantic/South_Georgia'),
(175, 'GT', 'America/Guatemala'),
(176, 'GU', 'Pacific/Guam'),
(177, 'GW', 'Africa/Bissau'),
(178, 'GY', 'America/Guyana'),
(179, 'HK', 'Asia/Hong_Kong'),
(180, 'HN', 'America/Tegucigalpa'),
(181, 'HR', 'Europe/Zagreb'),
(182, 'HT', 'America/Port-au-Prince'),
(183, 'HU', 'Europe/Budapest'),
(184, 'ID', 'Asia/Jakarta'),
(185, 'ID', 'Asia/Pontianak'),
(186, 'ID', 'Asia/Makassar'),
(187, 'ID', 'Asia/Jayapura'),
(188, 'IE', 'Europe/Dublin'),
(189, 'IL', 'Asia/Jerusalem'),
(190, 'IM', 'Europe/Isle_of_Man'),
(191, 'IN', 'Asia/Kolkata'),
(192, 'IO', 'Indian/Chagos'),
(193, 'IQ', 'Asia/Baghdad'),
(194, 'IR', 'Asia/Tehran'),
(195, 'IS', 'Atlantic/Reykjavik'),
(196, 'IT', 'Europe/Rome'),
(197, 'JE', 'Europe/Jersey'),
(198, 'JM', 'America/Jamaica'),
(199, 'JO', 'Asia/Amman'),
(200, 'JP', 'Asia/Tokyo'),
(201, 'KE', 'Africa/Nairobi'),
(202, 'KG', 'Asia/Bishkek'),
(203, 'KH', 'Asia/Phnom_Penh'),
(204, 'KI', 'Pacific/Tarawa'),
(205, 'KI', 'Pacific/Enderbury'),
(206, 'KI', 'Pacific/Kiritimati'),
(207, 'KM', 'Indian/Comoro'),
(208, 'KN', 'America/St_Kitts'),
(209, 'KP', 'Asia/Pyongyang'),
(210, 'KR', 'Asia/Seoul'),
(211, 'KW', 'Asia/Kuwait'),
(212, 'KY', 'America/Cayman'),
(213, 'KZ', 'Asia/Almaty'),
(214, 'KZ', 'Asia/Qyzylorda'),
(215, 'KZ', 'Asia/Aqtobe'),
(216, 'KZ', 'Asia/Aqtau'),
(217, 'KZ', 'Asia/Oral'),
(218, 'LA', 'Asia/Vientiane'),
(219, 'LB', 'Asia/Beirut'),
(220, 'LC', 'America/St_Lucia'),
(221, 'LI', 'Europe/Vaduz'),
(222, 'LK', 'Asia/Colombo'),
(223, 'LR', 'Africa/Monrovia'),
(224, 'LS', 'Africa/Maseru'),
(225, 'LT', 'Europe/Vilnius'),
(226, 'LU', 'Europe/Luxembourg'),
(227, 'LV', 'Europe/Riga'),
(228, 'LY', 'Africa/Tripoli'),
(229, 'MA', 'Africa/Casablanca'),
(230, 'MC', 'Europe/Monaco'),
(231, 'MD', 'Europe/Chisinau'),
(232, 'ME', 'Europe/Podgorica'),
(233, 'MF', 'America/Marigot'),
(234, 'MG', 'Indian/Antananarivo'),
(235, 'MH', 'Pacific/Majuro'),
(236, 'MH', 'Pacific/Kwajalein'),
(237, 'MK', 'Europe/Skopje'),
(238, 'ML', 'Africa/Bamako'),
(239, 'MM', 'Asia/Rangoon'),
(240, 'MN', 'Asia/Ulaanbaatar'),
(241, 'MN', 'Asia/Hovd'),
(242, 'MN', 'Asia/Choibalsan'),
(243, 'MO', 'Asia/Macau'),
(244, 'MP', 'Pacific/Saipan'),
(245, 'MQ', 'America/Martinique'),
(246, 'MR', 'Africa/Nouakchott'),
(247, 'MS', 'America/Montserrat'),
(248, 'MT', 'Europe/Malta'),
(249, 'MU', 'Indian/Mauritius'),
(250, 'MV', 'Indian/Maldives'),
(251, 'MW', 'Africa/Blantyre'),
(252, 'MX', 'America/Mexico_City'),
(253, 'MX', 'America/Cancun'),
(254, 'MX', 'America/Merida'),
(255, 'MX', 'America/Monterrey'),
(256, 'MX', 'America/Matamoros'),
(257, 'MX', 'America/Mazatlan'),
(258, 'MX', 'America/Chihuahua'),
(259, 'MX', 'America/Ojinaga'),
(260, 'MX', 'America/Hermosillo'),
(261, 'MX', 'America/Tijuana'),
(262, 'MX', 'America/Santa_Isabel'),
(263, 'MX', 'America/Bahia_Banderas'),
(264, 'MY', 'Asia/Kuala_Lumpur'),
(265, 'MY', 'Asia/Kuching'),
(266, 'MZ', 'Africa/Maputo'),
(267, 'NA', 'Africa/Windhoek'),
(268, 'NC', 'Pacific/Noumea'),
(269, 'NE', 'Africa/Niamey'),
(270, 'NF', 'Pacific/Norfolk'),
(271, 'NG', 'Africa/Lagos'),
(272, 'NI', 'America/Managua'),
(273, 'NL', 'Europe/Amsterdam'),
(274, 'NO', 'Europe/Oslo'),
(275, 'NP', 'Asia/Kathmandu'),
(276, 'NR', 'Pacific/Nauru'),
(277, 'NU', 'Pacific/Niue'),
(278, 'NZ', 'Pacific/Auckland'),
(279, 'NZ', 'Pacific/Chatham'),
(280, 'OM', 'Asia/Muscat'),
(281, 'PA', 'America/Panama'),
(282, 'PE', 'America/Lima'),
(283, 'PF', 'Pacific/Tahiti'),
(284, 'PF', 'Pacific/Marquesas'),
(285, 'PF', 'Pacific/Gambier'),
(286, 'PG', 'Pacific/Port_Moresby'),
(287, 'PG', 'Pacific/Bougainville'),
(288, 'PH', 'Asia/Manila'),
(289, 'PK', 'Asia/Karachi'),
(290, 'PL', 'Europe/Warsaw'),
(291, 'PM', 'America/Miquelon'),
(292, 'PN', 'Pacific/Pitcairn'),
(293, 'PR', 'America/Puerto_Rico'),
(294, 'PS', 'Asia/Gaza'),
(295, 'PS', 'Asia/Hebron'),
(296, 'PT', 'Europe/Lisbon'),
(297, 'PT', 'Atlantic/Madeira'),
(298, 'PT', 'Atlantic/Azores'),
(299, 'PW', 'Pacific/Palau'),
(300, 'PY', 'America/Asuncion'),
(301, 'QA', 'Asia/Qatar'),
(302, 'RE', 'Indian/Reunion'),
(303, 'RO', 'Europe/Bucharest'),
(304, 'RS', 'Europe/Belgrade'),
(305, 'RU', 'Europe/Kaliningrad'),
(306, 'RU', 'Europe/Moscow'),
(307, 'RU', 'Europe/Simferopol'),
(308, 'RU', 'Europe/Volgograd'),
(309, 'RU', 'Europe/Samara'),
(310, 'RU', 'Asia/Yekaterinburg'),
(311, 'RU', 'Asia/Omsk'),
(312, 'RU', 'Asia/Novosibirsk'),
(313, 'RU', 'Asia/Novokuznetsk'),
(314, 'RU', 'Asia/Krasnoyarsk'),
(315, 'RU', 'Asia/Irkutsk'),
(316, 'RU', 'Asia/Chita'),
(317, 'RU', 'Asia/Yakutsk'),
(318, 'RU', 'Asia/Khandyga'),
(319, 'RU', 'Asia/Vladivostok'),
(320, 'RU', 'Asia/Sakhalin'),
(321, 'RU', 'Asia/Ust-Nera'),
(322, 'RU', 'Asia/Magadan'),
(323, 'RU', 'Asia/Srednekolymsk'),
(324, 'RU', 'Asia/Kamchatka'),
(325, 'RU', 'Asia/Anadyr'),
(326, 'RW', 'Africa/Kigali'),
(327, 'SA', 'Asia/Riyadh'),
(328, 'SB', 'Pacific/Guadalcanal'),
(329, 'SC', 'Indian/Mahe'),
(330, 'SD', 'Africa/Khartoum'),
(331, 'SE', 'Europe/Stockholm'),
(332, 'SG', 'Asia/Singapore'),
(333, 'SH', 'Atlantic/St_Helena'),
(334, 'SI', 'Europe/Ljubljana'),
(335, 'SJ', 'Arctic/Longyearbyen'),
(336, 'SK', 'Europe/Bratislava'),
(337, 'SL', 'Africa/Freetown'),
(338, 'SM', 'Europe/San_Marino'),
(339, 'SN', 'Africa/Dakar'),
(340, 'SO', 'Africa/Mogadishu'),
(341, 'SR', 'America/Paramaribo'),
(342, 'SS', 'Africa/Juba'),
(343, 'ST', 'Africa/Sao_Tome'),
(344, 'SV', 'America/El_Salvador'),
(345, 'SX', 'America/Lower_Princes'),
(346, 'SY', 'Asia/Damascus'),
(347, 'SZ', 'Africa/Mbabane'),
(348, 'TC', 'America/Grand_Turk'),
(349, 'TD', 'Africa/Ndjamena'),
(350, 'TF', 'Indian/Kerguelen'),
(351, 'TG', 'Africa/Lome'),
(352, 'TH', 'Asia/Bangkok'),
(353, 'TJ', 'Asia/Dushanbe'),
(354, 'TK', 'Pacific/Fakaofo'),
(355, 'TL', 'Asia/Dili'),
(356, 'TM', 'Asia/Ashgabat'),
(357, 'TN', 'Africa/Tunis'),
(358, 'TO', 'Pacific/Tongatapu'),
(359, 'TR', 'Europe/Istanbul'),
(360, 'TT', 'America/Port_of_Spain'),
(361, 'TV', 'Pacific/Funafuti'),
(362, 'TW', 'Asia/Taipei'),
(363, 'TZ', 'Africa/Dar_es_Salaam'),
(364, 'UA', 'Europe/Kiev'),
(365, 'UA', 'Europe/Uzhgorod'),
(366, 'UA', 'Europe/Zaporozhye'),
(367, 'UG', 'Africa/Kampala'),
(368, 'UM', 'Pacific/Johnston'),
(369, 'UM', 'Pacific/Midway'),
(370, 'UM', 'Pacific/Wake'),
(371, 'US', 'America/New_York'),
(372, 'US', 'America/Detroit'),
(373, 'US', 'America/Kentucky/Louisville'),
(374, 'US', 'America/Kentucky/Monticello'),
(375, 'US', 'America/Indiana/Indianapolis'),
(376, 'US', 'America/Indiana/Vincennes'),
(377, 'US', 'America/Indiana/Winamac'),
(378, 'US', 'America/Indiana/Marengo'),
(379, 'US', 'America/Indiana/Petersburg'),
(380, 'US', 'America/Indiana/Vevay'),
(381, 'US', 'America/Chicago'),
(382, 'US', 'America/Indiana/Tell_City'),
(383, 'US', 'America/Indiana/Knox'),
(384, 'US', 'America/Menominee'),
(385, 'US', 'America/North_Dakota/Center'),
(386, 'US', 'America/North_Dakota/New_Salem'),
(387, 'US', 'America/North_Dakota/Beulah'),
(388, 'US', 'America/Denver'),
(389, 'US', 'America/Boise'),
(390, 'US', 'America/Phoenix'),
(391, 'US', 'America/Los_Angeles'),
(392, 'US', 'America/Metlakatla'),
(393, 'US', 'America/Anchorage'),
(394, 'US', 'America/Juneau'),
(395, 'US', 'America/Sitka'),
(396, 'US', 'America/Yakutat'),
(397, 'US', 'America/Nome'),
(398, 'US', 'America/Adak'),
(399, 'US', 'Pacific/Honolulu'),
(400, 'UY', 'America/Montevideo'),
(401, 'UZ', 'Asia/Samarkand'),
(402, 'UZ', 'Asia/Tashkent'),
(403, 'VA', 'Europe/Vatican'),
(404, 'VC', 'America/St_Vincent'),
(405, 'VE', 'America/Caracas'),
(406, 'VG', 'America/Tortola'),
(407, 'VI', 'America/St_Thomas'),
(408, 'VN', 'Asia/Ho_Chi_Minh'),
(409, 'VU', 'Pacific/Efate'),
(410, 'WF', 'Pacific/Wallis'),
(411, 'WS', 'Pacific/Apia'),
(412, 'YE', 'Asia/Aden'),
(413, 'YT', 'Indian/Mayotte'),
(414, 'ZA', 'Africa/Johannesburg'),
(415, 'ZM', 'Africa/Lusaka'),
(416, 'ZW', 'Africa/Harare');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reset_requested_on` datetime NOT NULL,
  `activated` tinyint(4) NOT NULL,
  `activation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activated_at` datetime NOT NULL,
  `fb_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fb_page_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google_plus_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `slug`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `birthday`, `bio`, `gender`, `mobile_no`, `country`, `timezone`, `reset_password_code`, `reset_requested_on`, `activated`, `activation_code`, `activated_at`, `fb_url`, `fb_page_url`, `website_url`, `twitter_url`, `google_plus_url`) VALUES
(3, 'Super Admin', 'imran-khan', 'admin@mail.com', '$2y$10$d9u7mTlYk9jOaBFbVvSNt.msXRRvn5eiG9dZZmH6u.Kn/gGLdSmoW', 'cmQ76foX1bBI9Ly4LXVtJKWHp4HIdwQzVnDdmlgyhjwRqZcpaZk7FX95SID0', '2015-07-18 16:45:35', '2018-02-08 01:38:46', '/uploads/0.69403700 1438373059_file.jpeg', '07/01/2015', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent libero ligula, vestibulum ut justo sed.', 'male', '8686371915', '99', '', '', '0000-00-00 00:00:00', 1, '', '2015-08-04 19:57:23', 'http://www.facebook.com/shellprog', 'http://www.facebook.com/kodeinfo', 'http://www.kodeinfo.com', 'http://www.twitter.com/kode_info', 'https://plus.google.com/u/1/+ImranIqbal_kodeinfo/posts');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`, `created_at`, `updated_at`) VALUES
(12, 3, 1, '2015-08-04 23:57:23', '2015-08-04 23:57:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cron_jobs`
--
ALTER TABLE `cron_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_gallery`
--
ALTER TABLE `image_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_ratings`
--
ALTER TABLE `post_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT for table `cron_jobs`
--
ALTER TABLE `cron_jobs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `image_gallery`
--
ALTER TABLE `image_gallery`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locales`
--
ALTER TABLE `locales`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_ratings`
--
ALTER TABLE `post_ratings`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=298;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `sources`
--
ALTER TABLE `sources`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=417;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
