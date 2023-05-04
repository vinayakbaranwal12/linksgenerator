-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2023 at 07:13 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `biolinks_blocks`
--

CREATE TABLE `biolinks_blocks` (
  `biolink_block_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `link_id` int(11) DEFAULT NULL,
  `type` varchar(32) NOT NULL DEFAULT '',
  `location_url` varchar(512) DEFAULT NULL,
  `clicks` int(11) NOT NULL DEFAULT 0,
  `settings` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_enabled` tinyint(4) NOT NULL DEFAULT 1,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biolinks_blocks`
--

INSERT INTO `biolinks_blocks` (`biolink_block_id`, `user_id`, `link_id`, `type`, `location_url`, `clicks`, `settings`, `order`, `start_date`, `end_date`, `is_enabled`, `datetime`) VALUES
(1, 1, 1, 'heading', NULL, 0, '{\"heading_type\":\"h1\",\"text\":\"Example page\",\"text_color\":\"white\"}', 0, NULL, NULL, 1, '2021-12-20 18:05:52'),
(2, 1, 1, 'paragraph', NULL, 0, '{\"text\":\"This is an example description.\",\"text_color\":\"white\"}', 1, NULL, NULL, 1, '2021-12-20 18:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `biolinks_templates`
--

CREATE TABLE `biolinks_templates` (
  `biolink_template_id` bigint(20) UNSIGNED NOT NULL,
  `link_id` int(11) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `url` varchar(512) DEFAULT NULL,
  `image` varchar(40) DEFAULT NULL,
  `settings` text DEFAULT NULL,
  `is_enabled` tinyint(4) NOT NULL DEFAULT 1,
  `total_usage` bigint(20) UNSIGNED DEFAULT 0,
  `order` int(11) DEFAULT 0,
  `last_datetime` datetime DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `biolinks_themes`
--

CREATE TABLE `biolinks_themes` (
  `biolink_theme_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `image` varchar(40) DEFAULT NULL,
  `settings` text DEFAULT NULL,
  `is_enabled` tinyint(4) NOT NULL DEFAULT 1,
  `order` int(11) DEFAULT 0,
  `last_datetime` datetime DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `blog_post_id` bigint(20) UNSIGNED NOT NULL,
  `blog_posts_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `url` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `description` varchar(256) DEFAULT NULL,
  `keywords` varchar(256) DEFAULT NULL,
  `image` varchar(40) DEFAULT NULL,
  `editor` varchar(16) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `language` varchar(32) DEFAULT NULL,
  `total_views` bigint(20) UNSIGNED DEFAULT 0,
  `is_published` tinyint(4) DEFAULT 1,
  `datetime` datetime DEFAULT NULL,
  `last_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts_categories`
--

CREATE TABLE `blog_posts_categories` (
  `blog_posts_category_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `description` varchar(256) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `language` varchar(32) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `last_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `broadcasts`
--

CREATE TABLE `broadcasts` (
  `broadcast_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `subject` varchar(128) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `segment` varchar(64) DEFAULT NULL,
  `users_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sent_users_ids` longtext DEFAULT NULL,
  `sent_emails` int(10) UNSIGNED DEFAULT 0,
  `total_emails` int(10) UNSIGNED DEFAULT 0,
  `status` varchar(16) DEFAULT NULL,
  `last_sent_email_datetime` datetime DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `last_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `code_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `type` varchar(16) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `code` varchar(32) NOT NULL DEFAULT '',
  `discount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `redeemed` int(11) NOT NULL DEFAULT 0,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `datum_id` bigint(20) UNSIGNED NOT NULL,
  `biolink_block_id` int(11) DEFAULT NULL,
  `link_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(32) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `domain_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `scheme` varchar(8) NOT NULL DEFAULT '',
  `host` varchar(256) NOT NULL DEFAULT '',
  `custom_index_url` varchar(256) DEFAULT NULL,
  `custom_not_found_url` varchar(256) DEFAULT NULL,
  `type` tinyint(11) DEFAULT 1,
  `is_enabled` tinyint(4) DEFAULT 0,
  `datetime` datetime DEFAULT NULL,
  `last_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `link_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `biolink_theme_id` int(11) DEFAULT NULL,
  `biolink_id` int(11) DEFAULT NULL,
  `domain_id` int(11) DEFAULT 0,
  `pixels_ids` text DEFAULT NULL,
  `type` varchar(32) NOT NULL DEFAULT '',
  `url` varchar(256) NOT NULL DEFAULT '',
  `location_url` varchar(2048) DEFAULT NULL,
  `clicks` int(11) NOT NULL DEFAULT 0,
  `settings` text DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT 0,
  `is_enabled` tinyint(4) NOT NULL DEFAULT 1,
  `last_datetime` datetime DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`link_id`, `project_id`, `user_id`, `biolink_theme_id`, `biolink_id`, `domain_id`, `pixels_ids`, `type`, `url`, `location_url`, `clicks`, `settings`, `start_date`, `end_date`, `is_verified`, `is_enabled`, `last_datetime`, `datetime`) VALUES
(1, NULL, 1, NULL, NULL, 0, '[]', 'biolink', 'example', NULL, 1, '{\"verified_location\":\"top\",\"background_type\":\"preset\",\"background\":\"six\",\"favicon\":null,\"text_color\":\"#fff\",\"display_branding\":true,\"branding\":{\"name\":\"\",\"url\":\"\"},\"seo\":{\"block\":false,\"title\":\"\",\"meta_description\":\"\",\"image\":\"\"},\"utm\":{\"medium\":\"\",\"source\":\"\"},\"font\":\"arial\",\"font_size\":16,\"password\":null,\"sensitive_content\":false,\"leap_link\":\"\"}', NULL, NULL, 1, 1, NULL, '2021-12-20 18:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `pages_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `url` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `description` varchar(256) DEFAULT NULL,
  `keywords` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `editor` varchar(16) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `type` varchar(16) DEFAULT '',
  `position` varchar(16) NOT NULL DEFAULT '',
  `language` varchar(32) DEFAULT NULL,
  `open_in_new_tab` tinyint(4) DEFAULT 1,
  `order` int(11) DEFAULT 0,
  `total_views` bigint(20) UNSIGNED DEFAULT 0,
  `is_published` tinyint(4) DEFAULT 1,
  `datetime` datetime DEFAULT NULL,
  `last_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `pages_category_id`, `url`, `title`, `description`, `keywords`, `editor`, `content`, `type`, `position`, `language`, `open_in_new_tab`, `order`, `total_views`, `is_published`, `datetime`, `last_datetime`) VALUES
(1, NULL, 'https://hypweb.in', 'Software by Hypweb Solutions', '', NULL, NULL, '', 'external', 'bottom', NULL, 1, 1, 0, 1, '2023-05-03 04:30:55', '2023-05-03 04:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `pages_categories`
--

CREATE TABLE `pages_categories` (
  `pages_category_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `description` varchar(256) DEFAULT NULL,
  `icon` varchar(32) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `language` varchar(32) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `last_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `plan_id` int(10) UNSIGNED DEFAULT NULL,
  `processor` varchar(16) DEFAULT NULL,
  `type` varchar(16) DEFAULT NULL,
  `frequency` varchar(16) DEFAULT NULL,
  `payment_id` varchar(128) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `plan` text DEFAULT NULL,
  `billing` text DEFAULT NULL,
  `business` text DEFAULT NULL,
  `taxes_ids` text DEFAULT NULL,
  `base_amount` float DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `discount_amount` float DEFAULT NULL,
  `currency` varchar(4) DEFAULT NULL,
  `payment_proof` varchar(40) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pixels`
--

CREATE TABLE `pixels` (
  `pixel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `pixel` varchar(64) NOT NULL,
  `last_datetime` datetime DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `plan_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `description` varchar(256) NOT NULL DEFAULT '',
  `monthly_price` float DEFAULT NULL,
  `annual_price` float DEFAULT NULL,
  `lifetime_price` float DEFAULT NULL,
  `trial_days` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `settings` text NOT NULL,
  `taxes_ids` text DEFAULT NULL,
  `codes_ids` text DEFAULT NULL,
  `color` varchar(16) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `order` int(10) UNSIGNED DEFAULT 0,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `color` varchar(16) DEFAULT '#000',
  `last_datetime` datetime DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qr_codes`
--

CREATE TABLE `qr_codes` (
  `qr_code_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `type` varchar(32) DEFAULT NULL,
  `qr_code_logo` varchar(64) DEFAULT NULL,
  `qr_code` varchar(64) NOT NULL,
  `settings` text DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `last_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redeemed_codes`
--

CREATE TABLE `redeemed_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(64) NOT NULL DEFAULT '',
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'main', '{\"title\":\"Site Title\",\"default_language\":\"english\",\"default_theme_style\":\"light\",\"default_timezone\":\"UTC\",\"index_url\":\"\",\"terms_and_conditions_url\":\"\",\"privacy_policy_url\":\"\",\"not_found_url\":\"\",\"se_indexing\":true,\"default_results_per_page\":25,\"default_order_type\":\"DESC\",\"auto_language_detection_is_enabled\":true,\"blog_is_enabled\":true,\"logo_light\":\"\",\"logo_dark\":\"\",\"logo_email\":\"\",\"opengraph\":\"\",\"favicon\":\"\"}'),
(2, 'users', '{\"email_confirmation\":false,\"register_is_enabled\":true,\"auto_delete_inactive_users\":0,\"user_deletion_reminder\":0}'),
(3, 'ads', '{\"header\":\"\",\"footer\":\"\",\"header_biolink\":\"\",\"footer_biolink\":\"\"}'),
(4, 'captcha', '{\"type\":\"basic\",\"recaptcha_public_key\":\"\",\"recaptcha_private_key\":\"\",\"login_is_enabled\":0,\"register_is_enabled\":0,\"lost_password_is_enabled\":0,\"resend_activation_is_enabled\":0}'),
(5, 'cron', '{\"key\":\"2e182189801836febfa8650687c362d0\"}'),
(6, 'email_notifications', '{\"emails\":\"\",\"new_user\":\"0\",\"new_payment\":\"0\"}'),
(7, 'facebook', '{\"is_enabled\":\"0\",\"app_id\":\"\",\"app_secret\":\"\"}'),
(8, 'google', '{\"is_enabled\":\"0\",\"client_id\":\"\",\"client_secret\":\"\"}'),
(9, 'twitter', '{\"is_enabled\":\"0\",\"consumer_api_key\":\"\",\"consumer_api_secret\":\"\"}'),
(10, 'discord', '{\"is_enabled\":\"0\"}'),
(11, 'plan_custom', '{\"plan_id\":\"custom\",\"name\":\"Custom\",\"status\":1}'),
(12, 'plan_free', '{\"plan_id\":\"free\",\"name\":\"Free\",\"days\":null,\"status\":1,\"settings\":{\"additional_global_domains\":true,\"custom_url\":true,\"deep_links\":true,\"no_ads\":true,\"removable_branding\":true,\"custom_branding\":true,\"custom_colored_links\":true,\"statistics\":true,\"custom_backgrounds\":true,\"verified\":true,\"temporary_url_is_enabled\":true,\"seo\":true,\"utm\":true,\"socials\":true,\"fonts\":true,\"password\":true,\"sensitive_content\":true,\"leap_link\":true,\"api_is_enabled\":true,\"affiliate_is_enabled\":true,\"projects_limit\":10,\"pixels_limit\":10,\"biolinks_limit\":15,\"links_limit\":25,\"domains_limit\":1,\"enabled_biolink_blocks\":{\"link\":true,\"text\":true,\"image\":true,\"mail\":true,\"soundcloud\":true,\"spotify\":true,\"youtube\":true,\"twitch\":true,\"vimeo\":true,\"tiktok\":true,\"applemusic\":true,\"tidal\":true,\"anchor\":true,\"twitter_tweet\":true,\"instagram_media\":true,\"rss_feed\":true,\"custom_html\":true,\"vcard\":true,\"image_grid\":true,\"divider\":true}}}'),
(13, 'payment', '{\"is_enabled\":\"0\",\"type\":\"both\",\"brand_name\":\"Hypweb Solutions LLC\",\"currency\":\"USD\", \"codes_is_enabled\": false}'),
(14, 'paypal', '{\"is_enabled\":\"0\",\"mode\":\"sandbox\",\"client_id\":\"\",\"secret\":\"\"}'),
(15, 'stripe', '{\"is_enabled\":\"0\",\"publishable_key\":\"\",\"secret_key\":\"\",\"webhook_secret\":\"\"}'),
(16, 'offline_payment', '{\"is_enabled\":\"0\",\"instructions\":\"Your offline payment instructions go here..\"}'),
(17, 'coinbase', '{\"is_enabled\":\"0\"}'),
(18, 'payu', '{\"is_enabled\":\"0\"}'),
(19, 'paystack', '{\"is_enabled\":\"0\"}'),
(20, 'razorpay', '{\"is_enabled\":\"0\"}'),
(21, 'mollie', '{\"is_enabled\":\"0\"}'),
(22, 'yookassa', '{\"is_enabled\":\"0\"}'),
(23, 'crypto_com', '{\"is_enabled\":\"0\"}'),
(24, 'paddle', '{\"is_enabled\":\"0\"}'),
(25, 'mercadopago', '{\"is_enabled\":\"0\"}'),
(26, 'smtp', '{\"host\":\"\",\"from\":\"\",\"from_name\":\"\",\"encryption\":\"tls\",\"port\":\"587\",\"auth\":\"0\",\"username\":\"\",\"password\":\"\"}'),
(27, 'custom', '{\"head_js\":\"\",\"head_css\":\"\"}'),
(28, 'socials', '{\"facebook\":\"\",\"instagram\":\"\",\"twitter\":\"\",\"youtube\":\"\"}'),
(29, 'announcements', '{\"id\":\"\",\"content\":\"\",\"show_logged_in\":\"\",\"show_logged_out\":\"\"}'),
(30, 'business', '{\"invoice_is_enabled\":\"0\",\"name\":\"\",\"address\":\"\",\"city\":\"\",\"county\":\"\",\"zip\":\"\",\"country\":\"\",\"email\":\"\",\"phone\":\"\",\"tax_type\":\"\",\"tax_id\":\"\",\"custom_key_one\":\"\",\"custom_value_one\":\"\",\"custom_key_two\":\"\",\"custom_value_two\":\"\"}'),
(31, 'webhooks', '{\"user_new\": \"\", \"user_delete\": \"\"}'),
(32, 'cookie_consent', '{}'),
(33, 'links', '{\"branding\":\"by Hypweb Solutions\",\"shortener_is_enabled\":true,\"qr_codes_is_enabled\":true,\"biolinks_is_enabled\":true,\"files_is_enabled\":true,\"vcards_is_enabled\":true,\"directory_is_enabled\":true,\"directory_display\":\"verified\",\"domains_is_enabled\":true,\"main_domain_is_enabled\":true,\"blacklisted_domains\":\"\",\"blacklisted_keywords\":\"\",\"google_safe_browsing_is_enabled\":false,\"google_safe_browsing_api_key\":\"\",\"google_static_maps_is_enabled\":false,\"google_static_maps_api_key\":\"\",\"avatar_size_limit\":2,\"background_size_limit\":2,\"favicon_size_limit\":2,\"seo_image_size_limit\":2,\"thumbnail_image_size_limit\":2,\"image_size_limit\":2,\"audio_size_limit\":2,\"video_size_limit\":2,\"file_size_limit\":2,\"product_file_size_limit\":2}'),
(34, 'tools', ''),
(35, 'license', '{\"license\":\"HypwebSolutions2023.5.1\",\"type\":\"MIT Release\"}'),
(36, 'product_info', '{\"version\":\"1\", \"code\":\"1\"}');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `tax_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `value_type` enum('percentage','fixed') DEFAULT NULL,
  `type` enum('inclusive','exclusive') DEFAULT NULL,
  `billing_type` enum('personal','business','both') DEFAULT NULL,
  `countries` text DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `track_links`
--

CREATE TABLE `track_links` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `link_id` int(11) DEFAULT NULL,
  `biolink_block_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `country_code` varchar(8) DEFAULT NULL,
  `city_name` varchar(128) DEFAULT NULL,
  `os_name` varchar(16) DEFAULT NULL,
  `browser_name` varchar(32) DEFAULT NULL,
  `referrer_host` varchar(256) DEFAULT NULL,
  `referrer_path` varchar(1024) DEFAULT NULL,
  `device_type` varchar(16) DEFAULT NULL,
  `browser_language` varchar(16) DEFAULT NULL,
  `utm_source` varchar(128) DEFAULT NULL,
  `utm_medium` varchar(128) DEFAULT NULL,
  `utm_campaign` varchar(128) DEFAULT NULL,
  `is_unique` tinyint(4) DEFAULT 0,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `track_links`
--

INSERT INTO `track_links` (`id`, `user_id`, `link_id`, `biolink_block_id`, `project_id`, `country_code`, `city_name`, `os_name`, `browser_name`, `referrer_host`, `referrer_path`, `device_type`, `browser_language`, `utm_source`, `utm_medium`, `utm_campaign`, `is_unique`, `datetime`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, 'Windows', 'Chrome', NULL, NULL, 'desktop', 'en', NULL, NULL, NULL, 0, '2023-05-03 01:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `billing` text DEFAULT NULL,
  `api_key` varchar(32) DEFAULT NULL,
  `token_code` varchar(32) DEFAULT NULL,
  `twofa_secret` varchar(16) DEFAULT NULL,
  `anti_phishing_code` varchar(8) DEFAULT NULL,
  `one_time_login_code` varchar(32) DEFAULT NULL,
  `pending_email` varchar(128) DEFAULT NULL,
  `email_activation_code` varchar(32) DEFAULT NULL,
  `lost_password_code` varchar(32) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `is_newsletter_subscribed` tinyint(4) NOT NULL DEFAULT 0,
  `plan_id` varchar(16) NOT NULL DEFAULT '',
  `plan_expiration_date` datetime DEFAULT NULL,
  `plan_settings` text DEFAULT NULL,
  `plan_trial_done` tinyint(4) DEFAULT 0,
  `plan_expiry_reminder` tinyint(4) DEFAULT 0,
  `payment_subscription_id` varchar(64) DEFAULT NULL,
  `payment_processor` varchar(16) DEFAULT NULL,
  `payment_total_amount` float DEFAULT NULL,
  `payment_currency` varchar(4) DEFAULT NULL,
  `referral_key` varchar(32) DEFAULT NULL,
  `referred_by` varchar(32) DEFAULT NULL,
  `referred_by_has_converted` tinyint(4) DEFAULT 0,
  `language` varchar(32) DEFAULT 'english',
  `timezone` varchar(32) DEFAULT 'UTC',
  `datetime` datetime DEFAULT NULL,
  `ip` varchar(64) DEFAULT NULL,
  `continent_code` varchar(8) DEFAULT NULL,
  `country` varchar(8) DEFAULT NULL,
  `city_name` varchar(32) DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_user_agent` varchar(256) DEFAULT NULL,
  `total_logins` int(11) DEFAULT 0,
  `user_deletion_reminder` tinyint(4) DEFAULT 0,
  `source` varchar(32) DEFAULT 'direct'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `name`, `billing`, `api_key`, `token_code`, `twofa_secret`, `anti_phishing_code`, `one_time_login_code`, `pending_email`, `email_activation_code`, `lost_password_code`, `type`, `status`, `is_newsletter_subscribed`, `plan_id`, `plan_expiration_date`, `plan_settings`, `plan_trial_done`, `plan_expiry_reminder`, `payment_subscription_id`, `payment_processor`, `payment_total_amount`, `payment_currency`, `referral_key`, `referred_by`, `referred_by_has_converted`, `language`, `timezone`, `datetime`, `ip`, `continent_code`, `country`, `city_name`, `last_activity`, `last_user_agent`, `total_logins`, `user_deletion_reminder`, `source`) VALUES
(1, 'admin', '$2y$10$uFNO0pQKEHSFcus1zSFlveiPCB3EvG9ZlES7XKgJFTAl5JbRGFCWy', 'Vinayak Baranwal', NULL, 'b645595fe8a1f841cefbe03f8ed1cf1b', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 'custom', '2030-01-01 12:00:00', '{\"additional_global_domains\":true,\"custom_url\":true,\"deep_links\":true,\"no_ads\":true,\"removable_branding\":true,\"custom_branding\":true,\"custom_colored_links\":true,\"statistics\":true,\"qr_is_enabled\":true,\"custom_backgrounds\":true,\"verified\":true,\"temporary_url_is_enabled\":true,\"seo\":true,\"utm\":true,\"fonts\":true,\"password\":true,\"sensitive_content\":true,\"leap_link\":true,\"api_is_enabled\":true,\"affiliate_is_enabled\":true,\"dofollow_is_enabled\":true,\"biolink_blocks_limit\":-1,\"projects_limit\":-1,\"pixels_limit\":-1,\"biolinks_limit\":-1,\"links_limit\":-1,\"domains_limit\":-1,\"track_links_retention\":-1,\"enabled_biolink_blocks\":{\"link\":true,\"heading\":true,\"paragraph\":true,\"avatar\":true,\"image\":true,\"socials\":true,\"mail\":true,\"soundcloud\":true,\"spotify\":true,\"youtube\":true,\"twitch\":true,\"vimeo\":true,\"tiktok\":true,\"applemusic\":true,\"tidal\":true,\"anchor\":true,\"twitter_tweet\":true,\"instagram_media\":true,\"rss_feed\":true,\"custom_html\":true,\"vcard\":true,\"image_grid\":true,\"divider\":true,\"faq\":true,\"discord\":true,\"facebook\":true,\"reddit\":true,\"audio\":true,\"video\":true,\"file\":true,\"countdown\":true,\"cta\":true,\"external_item\":true,\"share\":true,\"youtube_feed\":true}}', 0, 0, NULL, NULL, NULL, NULL, 'd274e2f4f5d050da7de1cc1ec3980322', NULL, 0, 'english', 'UTC', '2023-05-03 04:30:55', '127.0.0.1', NULL, NULL, NULL, '2023-05-04 05:08:58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 3, 0, 'direct');

-- --------------------------------------------------------

--
-- Table structure for table `users_logs`
--

CREATE TABLE `users_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `ip` varchar(64) DEFAULT NULL,
  `device_type` varchar(16) DEFAULT NULL,
  `os_name` varchar(16) DEFAULT NULL,
  `continent_code` varchar(8) DEFAULT NULL,
  `country_code` varchar(8) DEFAULT NULL,
  `city_name` varchar(32) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_logs`
--

INSERT INTO `users_logs` (`id`, `user_id`, `type`, `ip`, `device_type`, `os_name`, `continent_code`, `country_code`, `city_name`, `datetime`) VALUES
(1, 1, 'login.default.success', '127.0.0.1', 'desktop', 'Windows', NULL, NULL, NULL, '2023-05-03 01:34:25'),
(2, 1, 'login.default.success', '127.0.0.1', 'desktop', 'Windows', NULL, NULL, NULL, '2023-05-03 01:49:31'),
(3, 1, 'login.default.success', '127.0.0.1', 'desktop', 'Windows', NULL, NULL, NULL, '2023-05-04 03:01:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biolinks_blocks`
--
ALTER TABLE `biolinks_blocks`
  ADD PRIMARY KEY (`biolink_block_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `links_type_index` (`type`),
  ADD KEY `links_links_link_id_fk` (`link_id`);

--
-- Indexes for table `biolinks_templates`
--
ALTER TABLE `biolinks_templates`
  ADD PRIMARY KEY (`biolink_template_id`),
  ADD KEY `link_id` (`link_id`);

--
-- Indexes for table `biolinks_themes`
--
ALTER TABLE `biolinks_themes`
  ADD PRIMARY KEY (`biolink_theme_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`blog_post_id`),
  ADD KEY `blog_post_id_index` (`blog_post_id`),
  ADD KEY `blog_post_url_index` (`url`),
  ADD KEY `blog_posts_category_id` (`blog_posts_category_id`),
  ADD KEY `blog_posts_is_published_index` (`is_published`),
  ADD KEY `blog_posts_language_index` (`language`);

--
-- Indexes for table `blog_posts_categories`
--
ALTER TABLE `blog_posts_categories`
  ADD PRIMARY KEY (`blog_posts_category_id`),
  ADD KEY `url` (`url`),
  ADD KEY `blog_posts_categories_url_language_index` (`url`,`language`);

--
-- Indexes for table `broadcasts`
--
ALTER TABLE `broadcasts`
  ADD PRIMARY KEY (`broadcast_id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`code_id`),
  ADD KEY `type` (`type`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`datum_id`),
  ADD UNIQUE KEY `datum_id` (`datum_id`),
  ADD KEY `link_id` (`link_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `biolink_block_id` (`biolink_block_id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`domain_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `host` (`host`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `url` (`url`),
  ADD KEY `links_type_index` (`type`),
  ADD KEY `links_links_link_id_fk` (`biolink_id`),
  ADD KEY `links_biolinks_themes_biolink_theme_id_fk` (`biolink_theme_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`),
  ADD KEY `pages_pages_category_id_index` (`pages_category_id`),
  ADD KEY `pages_url_index` (`url`),
  ADD KEY `pages_is_published_index` (`is_published`),
  ADD KEY `pages_language_index` (`language`);

--
-- Indexes for table `pages_categories`
--
ALTER TABLE `pages_categories`
  ADD PRIMARY KEY (`pages_category_id`),
  ADD KEY `url` (`url`),
  ADD KEY `pages_categories_url_language_index` (`url`,`language`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id` (`user_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `pixels`
--
ALTER TABLE `pixels`
  ADD PRIMARY KEY (`pixel_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD PRIMARY KEY (`qr_code_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `redeemed_codes`
--
ALTER TABLE `redeemed_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code_id` (`code_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `track_links`
--
ALTER TABLE `track_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_id` (`link_id`),
  ADD KEY `track_links_date_index` (`datetime`),
  ADD KEY `track_links_project_id_index` (`project_id`),
  ADD KEY `track_links_users_user_id_fk` (`user_id`),
  ADD KEY `track_links_biolink_block_id_index` (`biolink_block_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `api_key` (`api_key`);

--
-- Indexes for table `users_logs`
--
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_logs_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biolinks_blocks`
--
ALTER TABLE `biolinks_blocks`
  MODIFY `biolink_block_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `biolinks_templates`
--
ALTER TABLE `biolinks_templates`
  MODIFY `biolink_template_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `biolinks_themes`
--
ALTER TABLE `biolinks_themes`
  MODIFY `biolink_theme_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `blog_post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts_categories`
--
ALTER TABLE `blog_posts_categories`
  MODIFY `blog_posts_category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `broadcasts`
--
ALTER TABLE `broadcasts`
  MODIFY `broadcast_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `code_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `datum_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `domain_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages_categories`
--
ALTER TABLE `pages_categories`
  MODIFY `pages_category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pixels`
--
ALTER TABLE `pixels`
  MODIFY `pixel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qr_codes`
--
ALTER TABLE `qr_codes`
  MODIFY `qr_code_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `redeemed_codes`
--
ALTER TABLE `redeemed_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `tax_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `track_links`
--
ALTER TABLE `track_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_logs`
--
ALTER TABLE `users_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `biolinks_blocks`
--
ALTER TABLE `biolinks_blocks`
  ADD CONSTRAINT `biolinks_blocks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `biolinks_blocks_ibfk_2` FOREIGN KEY (`link_id`) REFERENCES `links` (`link_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `biolinks_templates`
--
ALTER TABLE `biolinks_templates`
  ADD CONSTRAINT `biolinks_templates_ibfk_1` FOREIGN KEY (`link_id`) REFERENCES `links` (`link_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`blog_posts_category_id`) REFERENCES `blog_posts_categories` (`blog_posts_category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `data_ibfk_1` FOREIGN KEY (`link_id`) REFERENCES `links` (`link_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `data_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_ibfk_4` FOREIGN KEY (`biolink_block_id`) REFERENCES `biolinks_blocks` (`biolink_block_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `domains`
--
ALTER TABLE `domains`
  ADD CONSTRAINT `domains_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_biolinks_themes_biolink_theme_id_fk` FOREIGN KEY (`biolink_theme_id`) REFERENCES `biolinks_themes` (`biolink_theme_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `links_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `links_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `links_links_link_id_fk` FOREIGN KEY (`biolink_id`) REFERENCES `links` (`link_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`pages_category_id`) REFERENCES `pages_categories` (`pages_category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pixels`
--
ALTER TABLE `pixels`
  ADD CONSTRAINT `pixels_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD CONSTRAINT `qr_codes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qr_codes_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `track_links`
--
ALTER TABLE `track_links`
  ADD CONSTRAINT `track_links_ibfk_1` FOREIGN KEY (`link_id`) REFERENCES `links` (`link_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `track_links_links_project_id_fk` FOREIGN KEY (`project_id`) REFERENCES `links` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `track_links_projects_project_id_fk` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `track_links_users_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_logs`
--
ALTER TABLE `users_logs`
  ADD CONSTRAINT `users_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
