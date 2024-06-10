-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 07:28 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercebjmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `slug`, `photo`, `description`, `status`, `created_at`, `updated_at`) VALUES
(5, 'BJMP TEST', 'bjmp-test', '/storage/photos/1/banner-07.jpg', '<p>TESTTTTT</p>', 'active', '2024-05-13 23:40:52', '2024-05-13 23:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `status` enum('new','progress','delivered','cancel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `quantity` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `order_id`, `user_id`, `price`, `status`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(10, 46, NULL, 41, 250.00, 'new', 5, 1250.00, '2024-05-14 08:11:12', '2024-05-14 10:57:32'),
(11, 42, NULL, 41, 250.00, 'new', 1, 250.00, '2024-05-14 08:11:20', '2024-05-14 08:11:20'),
(12, 23, NULL, 41, 2000.00, 'new', 1, 2000.00, '2024-05-14 09:28:12', '2024-05-14 09:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_parent` tinyint(1) NOT NULL DEFAULT 1,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `summary`, `photo`, `is_parent`, `parent_id`, `added_by`, `status`, `created_at`, `updated_at`) VALUES
(14, 'Metal Scrap', 'metal-scrap', '<p>Metal Scrap</p>', NULL, 1, NULL, NULL, 'active', '2024-05-13 22:42:58', '2024-05-13 22:42:58'),
(15, 'Wood Scrap', 'wood-scrap', NULL, NULL, 1, NULL, NULL, 'active', '2024-05-13 22:44:14', '2024-05-13 22:44:14'),
(16, 'Bag', 'bag', '<p>Bags</p>', NULL, 1, NULL, NULL, 'active', '2024-05-13 22:44:24', '2024-05-13 22:44:24'),
(17, 'Garlands', 'garlands', NULL, NULL, 1, NULL, NULL, 'active', '2024-05-13 22:44:33', '2024-05-13 22:44:33'),
(18, 'Paintings', 'paintings', '<p>Paintings</p>', NULL, 1, NULL, NULL, 'active', '2024-05-13 22:47:26', '2024-05-13 22:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('fixed','percent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `value` decimal(20,2) NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'LKPL690', 'fixed', '30.00', 'inactive', NULL, '2023-11-27 18:40:23'),
(2, '111111', 'percent', '10.00', 'active', NULL, NULL),
(6, 'CODEASTRO10', 'percent', '10.00', 'active', '2023-11-27 18:39:49', '2023-11-27 18:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_10_021010_create_brands_table', 1),
(5, '2020_07_10_025334_create_banners_table', 1),
(6, '2020_07_10_112147_create_categories_table', 1),
(7, '2020_07_11_063857_create_products_table', 1),
(8, '2020_07_12_073132_create_post_categories_table', 1),
(9, '2020_07_12_073701_create_post_tags_table', 1),
(10, '2020_07_12_083638_create_posts_table', 1),
(11, '2020_07_13_151329_create_messages_table', 1),
(12, '2020_07_14_023748_create_shippings_table', 1),
(13, '2020_07_15_054356_create_orders_table', 1),
(14, '2020_07_15_102626_create_carts_table', 1),
(15, '2020_07_16_041623_create_notifications_table', 1),
(16, '2020_07_16_053240_create_coupons_table', 1),
(17, '2020_07_23_143757_create_wishlists_table', 1),
(18, '2020_07_24_074930_create_product_reviews_table', 1),
(19, '2020_07_24_131727_create_post_comments_table', 1),
(20, '2020_08_01_143408_create_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('526b0c96-2100-4b0a-a0b4-b450e8b1566b', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New Product Rating!\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/product-detail\\/nightshade-bloom-lei\",\"fas\":\"fa-star\"}', NULL, '2024-05-14 08:09:51', '2024-05-14 08:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_total` double(8,2) NOT NULL,
  `shipping_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon` double(8,2) DEFAULT NULL,
  `total_amount` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_method` enum('cod','paypal','cardpay') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cod',
  `payment_status` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `status` enum('new','process','delivered','cancel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quote` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_tag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `replied_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 1,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'M',
  `condition` enum('default','new','hot') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `price` double(8,2) NOT NULL,
  `discount` double(8,2) NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `child_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `summary`, `description`, `photo`, `stock`, `size`, `condition`, `status`, `price`, `discount`, `is_featured`, `cat_id`, `child_cat_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(23, 'Colorful Pup', 'colorful-pup', '<p>Colorful Pup<br></p>', '<p>A vibrant portrayal of a dog against a black canvas, capturing its lively spirit and charm in a 2 ft by 2 ft acrylic painting.|<br><br>SIZE: 2 ft. by 2 ft.<br></p>', '/storage/photos/1/Products.Paintings/Colorful Pup Paintings.jpg', 1, '', 'new', 'active', 2000.00, 0.00, 1, 18, NULL, NULL, '2024-05-13 23:15:36', '2024-05-13 23:15:36'),
(24, 'Majestic Mare', 'majestic-mare', '<p>Majestic Mare</p>', '<p>A side-view horse painting with a serene teal blue backdrop, exuding elegance and grace in its 2.5 ft by 2 ft composition.</p><p><br></p><p><span style=\"font-weight: bolder;\">SIZE: 2.5 ft. by 2 ft.</span></p>', '/storage/photos/1/Products.Paintings/Majestic mare Painting.jpg', 1, '', 'new', 'active', 2000.00, 0.00, 1, 18, NULL, NULL, '2024-05-13 23:27:34', '2024-05-13 23:27:34'),
(25, 'Pink Parisian Blooms', 'pink-parisian-blooms', '<p>A colorful depiction of Paris streets adorned with pink flowering trees, radiating romance and whimsy in its 3.4 ft by 2 ft acrylic painting.<br></p>', '<p>A colorful depiction of Paris streets adorned with pink flowering trees, radiating romance and whimsy in its 3.4 ft by 2 ft acrylic painting.<br></p>', '/storage/photos/1/Products.Paintings/Paris Pink Painting.jpg', 1, '', 'default', 'active', 3500.00, 0.00, 1, 18, NULL, NULL, '2024-05-14 06:35:00', '2024-05-14 06:35:00'),
(26, 'Coastal Beacon', 'coastal-beacon', '<p>A nighttime scene featuring a lighthouse amidst ocean waves and shore, capturing the tranquil beauty of the coast in a 2 ft by 1.8 ft acrylic painting.</p><p><span style=\"font-weight: bolder;\">SIZE: 2 ft. by 1.8 ft.</span><br></p>', '<p>A nighttime scene featuring a lighthouse amidst ocean waves and shore, capturing the tranquil beauty of the coast in a 2 ft by 1.8 ft acrylic painting.&nbsp;<br><br><b>SIZE: 2 ft. by 1.8 ft.</b><br></p>', '/storage/photos/1/Products.Paintings/Lighhouse Painting.jpg', 1, '', 'new', 'active', 2500.00, 0.00, 1, 18, NULL, NULL, '2024-05-14 06:40:28', '2024-05-14 06:40:28'),
(27, 'Spirited Libations', 'spirited-libations', '<p>A vibrant portrayal of liquor and a bowl, bursting with color and energy in a 4.5 ft by 3.5 ft acrylic painting.</p><p><b>SIZE: 4.5 ft. by 3.5 ft.</b></p>', '<p>A vibrant portrayal of liquor and a bowl, bursting with color and energy in a 4.5 ft by 3.5 ft acrylic painting.</p><p><span style=\"font-weight: bolder;\">SIZE: 4.5 ft. by 3.5 ft.</span></p>', '/storage/photos/1/Products.Paintings/Spirited Libations.jpg', 1, '', 'new', 'active', 7500.00, 0.00, 1, 18, NULL, NULL, '2024-05-14 06:58:31', '2024-05-14 06:58:31'),
(28, 'Melodic Strings', 'melodic-strings', '<p>SHORT DESCRIPTION: A colorful depiction of a guitar surrounded by flowers, emanating musical harmony in a 2 ft by 1.5 ft acrylic painting.</p><p><b>SIZE: 2 ft. by 1.5 ft.</b></p>', '<p>SHORT DESCRIPTION: A colorful depiction of a guitar surrounded by flowers, emanating musical harmony in a 2 ft by 1.5 ft acrylic painting.</p><p><span style=\"font-weight: bolder;\">SIZE: 2 ft. by 1.5 ft.</span></p>', '/storage/photos/1/Products.Paintings/Meliodic Strings Painting.jpg', 1, '', 'new', 'active', 1000.00, 0.00, 1, 18, NULL, NULL, '2024-05-14 07:00:11', '2024-05-14 07:00:11'),
(29, 'Ballet Dreams', 'ballet-dreams', '<p>A graceful white ballerina set against a colorful \"triangled\" backdrop, capturing elegance and motion in a 4 ft by 2 ft acrylic painting.</p><p><b>SIZE: 4 ft. by 2 ft.</b></p>', '<p>A graceful white ballerina set against a colorful \"triangled\" backdrop, capturing elegance and motion in a 4 ft by 2 ft acrylic painting.</p><p><span style=\"font-weight: bolder;\">SIZE: 4 ft. by 2 ft.</span></p>', '/storage/photos/1/Products.Paintings/Ballet dreams Painting.jpg', 1, '', 'hot', 'active', 2000.00, 0.00, 1, 18, NULL, NULL, '2024-05-14 07:02:21', '2024-05-14 07:02:21'),
(30, 'Regal Lion', 'regal-lion', '<p>A lifelike portrayal of a lion, exuding strength and majesty in a 2.5 ft by 2 ft acrylic painting.</p><p><b>SIZE: 2.5 ft. by 2 ft.</b></p>', '<p>A lifelike portrayal of a lion, exuding strength and majesty in a 2.5 ft by 2 ft acrylic painting.</p><p><span style=\"font-weight: bolder;\">SIZE: 2.5 ft. by 2 ft.</span></p>', '/storage/photos/1/Products.Paintings/Regal Lion Painting.jpg', 1, '', 'default', 'active', 3000.00, 0.00, 1, 18, NULL, NULL, '2024-05-14 07:03:31', '2024-05-14 07:03:31'),
(31, 'Jungle Pop', 'jungle-pop', '<p>A vibrant pop art depiction of a lion on a black canvas, capturing the energetic allure of the jungle in a 3 ft by 2 ft acrylic painting.</p><p><b>SIZE: 3 ft. by 2 ft.</b></p>', '<p>A vibrant pop art depiction of a lion on a black canvas, capturing the energetic allure of the jungle in a 3 ft by 2 ft acrylic painting.</p><p><span style=\"font-weight: bolder;\">SIZE: 3 ft. by 2 ft.</span></p>', '/storage/photos/1/Products.Paintings/Jungle Pop Lion Paintings.jpg', 1, '', 'default', 'active', 3500.00, 0.00, 1, 18, NULL, NULL, '2024-05-14 07:05:27', '2024-05-14 07:05:27'),
(32, 'Tranquil Tortoise', 'tranquil-tortoise', '<p>A serene scene of a tortoise in the deep sea, ascending peacefully, in a 1.5 ft by 1.2 ft acrylic painting.</p><p><b>SIZE: 1.5 ft. by 1.2 ft.</b></p>', '<p>A serene scene of a tortoise in the deep sea, ascending peacefully, in a 1.5 ft by 1.2 ft acrylic painting.</p><p><span style=\"font-weight: bolder;\">SIZE: 1.5 ft. by 1.2 ft.</span></p>', '/storage/photos/1/Products.Paintings/Trangquil Tortoise Painting.jpg', 1, '', 'new', 'active', 1000.00, 0.00, 1, 18, NULL, NULL, '2024-05-14 07:06:36', '2024-05-14 07:06:36'),
(33, 'Strategic Triumph', 'strategic-triumph', '<p>A depiction of the white queen toppling the black king in a game of chess, symbolizing victory and strategy in a 2.2 ft by 1.7 ft acrylic painting.</p><p><b>SIZE: 2.2 ft. by 1.7 ft.</b></p>', '<p>A depiction of the white queen toppling the black king in a game of chess, symbolizing victory and strategy in a 2.2 ft by 1.7 ft acrylic painting.</p><p><span style=\"font-weight: bolder;\">SIZE: 2.2 ft. by 1.7 ft.</span></p>', '/storage/photos/1/Products.Paintings/Strategic Triumph Painting.jpg', 1, '', 'default', 'active', 1800.00, 0.00, 1, 18, NULL, NULL, '2024-05-14 07:09:20', '2024-05-14 07:09:20'),
(34, 'Zen Koi Pond', 'zen-koi-pond', '<p>A serene painting of Koi fish swimming in a pond amidst lilies, capturing tranquility and beauty in a 2 ft by 1.8 ft acrylic painting.</p><p><b>SIZE: 2 ft. by 1.8 ft.</b></p>', '<p>A serene painting of Koi fish swimming in a pond amidst lilies, capturing tranquility and beauty in a 2 ft by 1.8 ft acrylic painting.</p><p><span style=\"font-weight: bolder;\">SIZE: 2 ft. by 1.8 ft.</span></p>', '/storage/photos/1/Products.Paintings/Zen Koi Pond Painting.jpg', 1, '', 'hot', 'active', 1400.00, 0.00, 1, 18, NULL, NULL, '2024-05-14 07:10:59', '2024-05-14 07:10:59'),
(35, 'Royal Blue Elegance Garland', 'royal-blue-elegance-garland', '<p>Intricate designs with a touch of gold adorn this Royal Blue Garland, exuding regal charm and sophistication.</p><p><b>SIZE: 4 ft. Long</b></p>', '<p>Intricate designs with a touch of gold adorn this Royal Blue Garland, exuding regal charm and sophistication.</p><p><span style=\"font-weight: bolder;\">SIZE: 4 ft. Long</span></p>', '/storage/photos/1/Products.Garland and lei/Royal Blue Elegance Garland.jpg', 1, '', 'default', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:35:54', '2024-05-14 07:35:54'),
(36, 'Verdant Green Garland', 'verdant-green-garland', '<p>Intricately designed with a hint of gold accents, this Green Garland embodies natural beauty and elegance.</p><p><b>SIZE: 4 ft. Long</b></p>', '<p>Intricately designed with a hint of gold accents, this Green Garland embodies natural beauty and elegance.</p><p><span style=\"font-weight: bolder;\">SIZE: 4 ft. Long</span></p>', '/storage/photos/1/Products.Garland and lei/Verdant Green Garland.jpg', 1, '', 'default', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:37:15', '2024-05-14 07:37:15'),
(37, 'Crimson Blossom Garland', 'crimson-blossom-garland', '<p>Delicately crafted with intricate flower designs and subtle gold accents, the Red Garland radiates warmth and elegance.</p><p><b>SIZE: 4 ft. Long</b></p>', '<p>Delicately crafted with intricate flower designs and subtle gold accents, the Red Garland radiates warmth and elegance.</p><p><span style=\"font-weight: bolder;\">SIZE: 4 ft. Long</span></p>', '/storage/photos/1/Products.Garland and lei/Crimson Blossom Garland.jpg', 1, '', 'default', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:38:04', '2024-05-14 07:38:04'),
(38, 'Silver Birch Garland', 'silver-birch-garland', '<p>Featuring intricate silver designs against a brown background, this Garland exudes rustic charm with a touch of sophistication.</p><p><b>SIZE: 4 ft. Long</b></p>', '<p>Featuring intricate silver designs against a brown background, this Garland exudes rustic charm with a touch of sophistication.</p><p><span style=\"font-weight: bolder;\">SIZE: 4 ft. Long</span></p>', '/storage/photos/1/Products.Garland and lei/Silver Birch Garland.jpg', 1, '', 'new', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:38:49', '2024-05-14 07:38:49'),
(39, 'Golden Blossom Lei', 'white-garland', '<p>A white base adorned with intricate gold, red, and yellow designs, evoking the vibrancy of tropical blooms.</p><p><b>SIZE: 3.5 ft long</b></p>', '<p>A white base adorned with intricate gold, red, and yellow designs, evoking the vibrancy of tropical blooms.</p><p><span style=\"font-weight: bolder;\">SIZE: 3.5 ft long</span></p>', '/storage/photos/1/Products.Garland and lei/White Garland.jpg', 1, '', 'new', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:40:08', '2024-05-14 08:04:30'),
(40, 'Tropicana Lei', 'midnight-noir-garland', '<p>Featuring large black beads, yellow and peach ribbons, and lush green accents, this Lei captures the essence of tropical paradise.</p><p><b>SIZE: 3.5 ft long</b></p>', '<p>Featuring large black beads, yellow and peach ribbons, and lush green accents, this Lei captures the essence of tropical paradise.</p><p><span style=\"font-weight: bolder;\">SIZE: 3.5 ft long</span></p>', '/storage/photos/1/Products.Garland and lei/Midnight Noir Garland.jpg', 200, '', 'new', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:40:54', '2024-05-14 08:03:43'),
(41, 'Pink Blossom Lei', 'golden-blossom-lei', '<p>Shades of pink, red-violet, white, and hints of yellow, adorned with delicate leaves, inspired by the lush beauty of Hawaiian hibiscus flowers.</p><p><b>SIZE: 3.5 ft long</b></p>', '<p>Shades of pink, red-violet, white, and hints of yellow, adorned with delicate leaves, inspired by the lush beauty of Hawaiian hibiscus flowers.</p><p><span style=\"font-weight: bolder;\">SIZE: 3.5 ft long</span></p>', '/storage/photos/1/Products.Garland and lei/Golden Blossom Lei.jpg', 1, '', 'new', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:42:26', '2024-05-14 08:02:43'),
(42, 'Peachy Citrus lei', 'tropicana-lei', '<p><br></p><p>A peach base with vibrant orange ribbons and green accents reminiscent of leaves, exuding the freshness of ripe citrus fruits.</p><p><b>SIZE: 3.5 ft long</b></p><div><br></div>', '<p><br></p><p>A peach base with vibrant orange ribbons and green accents reminiscent of leaves, exuding the freshness of ripe citrus fruits.</p><p><span style=\"font-weight: bolder;\">SIZE: 3.5 ft long</span></p><div><br></div>', '/storage/photos/1/Products.Garland and lei/Tropicana Lei.jpg', 1, '', 'new', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:43:32', '2024-05-14 08:01:20'),
(43, 'Creamy Rouge Lei', 'pink-hibiscus-lei', '<p><br></p><p>A cream-colored base adorned with subtle hints of red, radiating elegance and sophistication.</p><p><b>SIZE: 3.5 ft long</b></p><div><br></div>', '<p><br></p><p>A cream-colored base adorned with subtle hints of red, radiating elegance and sophistication.</p><p><span style=\"font-weight: bolder;\">SIZE: 3.5 ft long</span></p><div><br></div>', '/storage/photos/1/Products.Garland and lei/Pink Hibiscus Lei.jpg', 1, '', 'default', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:44:45', '2024-05-14 07:59:37'),
(44, 'Nightshade Bloom Lei', 'peachy-citrus-lei', '<p><br></p><p>Featuring luxurious gold accents, deep reddish-purple hues, and blue-green leaves, the Nightshade Bloom Lei exudes an enchanting allure reminiscent of twilight\'s beauty.</p><p><b>SIZE: 3.5 ft long</b></p>', '<p><br></p><p>Featuring luxurious gold accents, deep reddish-purple hues, and blue-green leaves, the Nightshade Bloom Lei exudes an enchanting allure reminiscent of twilight\'s beauty.</p><p><span style=\"font-weight: bolder;\">SIZE: 3.5 ft long</span></p>', '/storage/photos/1/Products.Garland and lei/Peachy Citrus Lei.jpg', 1, '', 'default', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:45:45', '2024-05-14 07:58:22'),
(45, 'White Garland', 'creamy-rouge-lei', '<p><font face=\"Segoe UI Historic, Segoe UI, Helvetica, Arial, sans-serif\"><span style=\"font-size: 15px; white-space-collapse: preserve;\">Black curvy lines form diamond patterns against a white background, creating an elegant and timeless aesthetic in this Garland.\r\n\r\n<b>SIZE: 4 ft. Long</b></span></font><br></p>', '<p><span style=\"font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; font-size: 15px; white-space-collapse: preserve;\">Black curvy lines form diamond patterns against a white background, creating an elegant and timeless aesthetic in this Garland.\r\n\r\n</span><span style=\"font-weight: bolder; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; font-size: 15px; white-space-collapse: preserve;\">SIZE: 4 ft. Long</span><br></p>', '/storage/photos/1/Products.Garland and lei/Creamy Rouge Lei.jpg', 1, '', 'default', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:46:52', '2024-05-14 07:56:18'),
(46, 'Midnight Noir Garland', 'nightshade-bloom-lei', '<p>A black Garland with hints of reddish-brown, exuding a mysterious and captivating allure.</p><p><b>SIZE: 4 ft. Long</b></p><div><br></div>', '<p>A black Garland with hints of reddish-brown, exuding a mysterious and captivating allure.</p><p><span style=\"font-weight: bolder;\">SIZE: 4 ft. Long</span></p><div><br></div>', '/storage/photos/1/Products.Garland and lei/Nightshade Bloom Lei.jpg', 30, '', 'default', 'active', 250.00, 0.00, 1, 17, NULL, NULL, '2024-05-14 07:52:44', '2024-05-14 08:02:58'),
(47, 'Geometric Grizzly', 'geometric-grizzly', '<p>A bear intricately depicted in geometric patterns against a black background, commanding attention and intrigue in its 4 ft by 3 ft display.</p><p><b>SIZE: 4 ft. by 3 ft.</b></p>', '<p>A bear intricately depicted in geometric patterns against a black background, commanding attention and intrigue in its 4 ft by 3 ft display.</p><p><span style=\"font-weight: bolder;\">SIZE: 4 ft. by 3 ft.</span></p>', '/storage/photos/1/Products.WoodScraps/Geometric Grizzly.jpg', 35, '', 'default', 'active', 6000.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:16:49', '2024-05-14 08:16:49'),
(48, 'Geometric Howler', 'geometric-howler', '<p>A geometrically patterned wolf, wall-mounted for a striking display, capturing the essence of wilderness in its compact 1.2 ft design.</p><p><b>SIZE: 1.2 ft.</b></p>', '<p>A geometrically patterned wolf, wall-mounted for a striking display, capturing the essence of wilderness in its compact 1.2 ft design.</p><p><span style=\"font-weight: bolder;\">SIZE: 1.2 ft.</span></p>', '/storage/photos/1/Products.WoodScraps/Geometric Howler.jpg', 169, '', 'hot', 'active', 1000.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:18:17', '2024-05-14 08:18:17'),
(49, 'Geometric Majesty', 'geometric-majesty', '<p>An elephant portrayed in geometric patterns against a black backdrop, exuding regal elegance in its 4 ft by 3 ft presentation.</p><p><b>SIZE: 4 ft. by 3 ft.</b></p>', '<p>An elephant portrayed in geometric patterns against a black backdrop, exuding regal elegance in its 4 ft by 3 ft presentation.</p><p><span style=\"font-weight: bolder;\">SIZE: 4 ft. by 3 ft.</span></p>', '/storage/photos/1/Products.WoodScraps/Geometric Majesty.jpg', 177, '', 'default', 'active', 5000.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:24:43', '2024-05-14 08:24:43'),
(51, 'Divine Carving', 'divine-carving', '<p>A meticulously sculpted face of Jesus Christ from wood, radiating serenity and reverence in its compact 1 ft design.</p><p><b>SIZE: 1 ft.</b></p>', '<p>A meticulously sculpted face of Jesus Christ from wood, radiating serenity and reverence in its compact 1 ft design.</p><p><span style=\"font-weight: bolder;\">SIZE: 1 ft.</span></p>', '/storage/photos/1/Products.WoodScraps/Divine Carving.jpg', 21, '', 'new', 'active', 1200.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:26:05', '2024-05-14 08:26:05'),
(52, 'Multifaceted Cross', 'multifaceted-cross', '<p>A wooden cross crafted from a combination of different woods, adorned with white, black, and brown hues, symbolizing faith and diversity in its 2 ft by 1.5 ft form.</p><p><b>SIZE: 2 ft. by 1.5 ft.</b></p>', '<p>A wooden cross crafted from a combination of different woods, adorned with white, black, and brown hues, symbolizing faith and diversity in its 2 ft by 1.5 ft form.</p><p><span style=\"font-weight: bolder;\">SIZE: 2 ft. by 1.5 ft.</span></p>', '/storage/photos/1/Products.WoodScraps/Multifaceted Cross.jpg', 33, '', 'new', 'active', 2300.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:27:50', '2024-05-14 08:27:50'),
(53, 'Timber Timepiece', 'timber-timepiece', '<p>A wooden wall clock featuring different wood cuts for texture, adding rustic charm to any space in its compact 1 ft design.</p><p><b>SIZE: 1 ft.</b></p>', '<p>A wooden wall clock featuring different wood cuts for texture, adding rustic charm to any space in its compact 1 ft design.</p><p><span style=\"font-weight: bolder;\">SIZE: 1 ft.</span></p>', '/storage/photos/1/Products.WoodScraps/Timber Timepiece.jpg', 55, '', 'new', 'active', 800.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:29:20', '2024-05-14 08:29:20'),
(54, 'Purr-fect Table', 'purr-fect-table', '<p>A charming wooden table adorned with a cat design, adding whimsical flair to any room in its 2.5 ft by 1.5 ft size.</p><p><b>SIZE: 2.5 ft by 1.5 ft</b></p>', '<p>A charming wooden table adorned with a cat design, adding whimsical flair to any room in its 2.5 ft by 1.5 ft size.</p><p><span style=\"font-weight: bolder;\">SIZE: 2.5 ft by 1.5 ft</span></p>', '/storage/photos/1/Products.WoodScraps/Purr-fect Table.jpg', 1800, '', 'new', 'active', 1800.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:31:16', '2024-05-14 08:31:16'),
(55, 'Arboreal Bookshelf', 'arboreal-bookshelf', '<p>A tree-inspired bookshelf designed to be wall-mounted, offering both functionality and aesthetic appeal in its expansive 6 ft by 7 ft size.</p><p><b>SIZE: 6 ft. by 7 ft.</b></p>', '<p>A tree-inspired bookshelf designed to be wall-mounted, offering both functionality and aesthetic appeal in its expansive 6 ft by 7 ft size.</p><p><span style=\"font-weight: bolder;\">SIZE: 6 ft. by 7 ft.</span></p>', '/storage/photos/1/Products.WoodScraps/Arboreal Bookshelf.jpg', 44, '', 'default', 'active', 7000.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:33:38', '2024-05-14 08:33:38'),
(56, 'Eternal Embrace', 'eternal-embrace', '<p>A wooden display portraying a kissing couple, symbolizing love and unity, perfect for tabletop decor in its 1.5 ft by 1 ft size.</p><p><b>SIZE: 1.5 ft. by 1 ft.</b></p>', '<p>A wooden display portraying a kissing couple, symbolizing love and unity, perfect for tabletop decor in its 1.5 ft by 1 ft size.</p><p><span style=\"font-weight: bolder;\">SIZE: 1.5 ft. by 1 ft.</span></p>', '/storage/photos/1/Products.WoodScraps/Eternal Embrace.jpg', 111, '', 'new', 'active', 1000.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:36:49', '2024-05-14 08:36:49'),
(57, 'Love Duette', 'love-duette', '<p>A pair of tabletop displays that, when placed together, spell out the word \"Love,\" serving as a heartfelt reminder of affection and connection.</p><p><b>SIZE: 6 in. by 6 in.</b></p>', '<p>A pair of tabletop displays that, when placed together, spell out the word \"Love,\" serving as a heartfelt reminder of affection and connection.</p><p><span style=\"font-weight: bolder;\">SIZE: 6 in. by 6 in.</span></p>', '/storage/photos/1/Products.WoodScraps/Love Duette.jpg', 55, '', 'default', 'active', 500.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:38:30', '2024-05-14 08:38:30'),
(58, 'Wooden Mosaic', 'wooden-mosaic', '<p>A wooden wall design created from various wood rectangles of different sizes, forming a captivating mosaic in its 4 ft by 3 ft presentation.</p><p><b>SIZE: 4 ft. by 3 ft.</b></p>', '<p>A wooden wall design created from various wood rectangles of different sizes, forming a captivating mosaic in its 4 ft by 3 ft presentation.</p><p><span style=\"font-weight: bolder;\">SIZE: 4 ft. by 3 ft.</span></p>', '/storage/photos/1/Products.WoodScraps/Wooden Mosaic.jpg', 122, '', 'hot', 'active', 5000.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:39:51', '2024-05-14 08:39:51'),
(59, 'Rustic Log Chest', 'rustic-log-chest', '<p>A charming storage solution crafted from a single log, exuding rustic charm and natural beauty, perfect for adding a touch of wilderness to any space.</p><p><b>SIZE: 1 ft. by 2 ft.</b></p>', '<p>A charming storage solution crafted from a single log, exuding rustic charm and natural beauty, perfect for adding a touch of wilderness to any space.</p><p><span style=\"font-weight: bolder;\">SIZE: 1 ft. by 2 ft.</span></p>', '/storage/photos/1/Products.WoodScraps/Rustic Log Chest.jpg', 22, '', 'new', 'active', 700.00, 0.00, 1, 15, NULL, NULL, '2024-05-14 08:41:03', '2024-05-14 08:41:03'),
(60, 'Verdant Eco-Tote', 'verdant-eco-tote', '<p>Hand-crafted from recycled plastics, this green-hued tote bag offers both style and sustainability, perfect for eco-conscious individuals on the go.</p><p><br></p><p><b>SIZE: 1.5 ft. by 2 ft.</b></p>', '<p>Hand-crafted from recycled plastics, this green-hued tote bag offers both style and sustainability, perfect for eco-conscious individuals on the go.</p><p><br></p><p><span style=\"font-weight: bolder;\">SIZE: 1.5 ft. by 2 ft.</span></p>', '/storage/photos/1/Products.Bags/Verdant Eco-Tote.jpg', 45, '', 'new', 'active', 450.00, 0.00, 1, 16, NULL, NULL, '2024-05-14 08:42:18', '2024-05-14 08:42:18'),
(61, 'Rainbow Recycled Satchel', 'rainbow-recycled-satchel', '<p>Meticulously crafted from recycled plastics in a vibrant array of colors, this satchel embodies eco-chic fashion with its unique and eye-catching design.</p><p><br></p><p><b>SIZE: 1 ft. by 1.5 ft.</b></p>', '<p>Meticulously crafted from recycled plastics in a vibrant array of colors, this satchel embodies eco-chic fashion with its unique and eye-catching design.</p><p><br></p><p><span style=\"font-weight: bolder;\">SIZE: 1 ft. by 1.5 ft.</span></p>', '/storage/photos/1/Products.Bags/Rainbow Recycled Satchel.jpg', 88, '', 'new', 'active', 350.00, 50.00, 1, 16, NULL, NULL, '2024-05-14 08:43:15', '2024-05-14 08:43:15'),
(62, 'Crimson Eco-Carrier', 'crimson-eco-carrier', '<p>Hand-crafted from recycled plastics, this red-toned carrier bag combines practicality with eco-friendly craftsmanship, making it a stylish choice for everyday use.</p><p><br></p><p><b>SIZE: 1 ft by 2 ft.</b></p>', '<p>Hand-crafted from recycled plastics, this red-toned carrier bag combines practicality with eco-friendly craftsmanship, making it a stylish choice for everyday use.</p><p><br></p><p><span style=\"font-weight: bolder;\">SIZE: 1 ft by 2 ft.</span></p>', '/storage/photos/1/Products.Bags/Crimson Eco-Carrier.jpg', 67, '', 'hot', 'active', 350.00, 20.00, 1, 16, NULL, NULL, '2024-05-14 08:44:30', '2024-05-14 08:44:30'),
(63, 'Mosaic Eco-Tote', 'mosaic-eco-tote', '<p>Crafted from a mix of recycled plastics, this tote bag features a colorful mosaic pattern, showcasing the beauty of sustainability in its design.</p><p><br></p><p><b>SIZE: 1.5 by 2 ft.</b></p>', '<p>Crafted from a mix of recycled plastics, this tote bag features a colorful mosaic pattern, showcasing the beauty of sustainability in its design.</p><p><br></p><p><span style=\"font-weight: bolder;\">SIZE: 1.5 by 2 ft.</span></p>', '/storage/photos/1/Products.Bags/Mosaic Eco-Tote.jpg', 100, '', 'new', 'active', 450.00, 10.00, 1, 16, NULL, NULL, '2024-05-14 08:45:22', '2024-05-14 08:45:22'),
(64, 'Oceanic Nylon Carryall', 'oceanic-nylon-carryall', '<p>Hand-crafted from durable nylon in bold orange and blue hues, this spacious carryall bag is perfect for beach days or city adventures.</p><p><br></p><p><b>SIZE: 2 ft. by 2.3 ft.</b></p>', '<p>Hand-crafted from durable nylon in bold orange and blue hues, this spacious carryall bag is perfect for beach days or city adventures.</p><p><br></p><p><span style=\"font-weight: bolder;\">SIZE: 2 ft. by 2.3 ft.</span></p>', '/storage/photos/1/Products.Bags/Oceanic Nylon Carryall.jpg', 50, '', 'new', 'active', 500.00, 30.00, 1, 16, NULL, NULL, '2024-05-14 08:46:18', '2024-05-14 08:46:18'),
(65, 'Verdant Nylon Mini Bag', 'verdant-nylon-mini-bag', '<p>This small green bag is hand-crafted from sturdy nylon, offering convenient storage with a touch of eco-conscious style.</p><p><br></p><p><b>SIZE: 10 in. by 9 in.</b></p>', '<p>This small green bag is hand-crafted from sturdy nylon, offering convenient storage with a touch of eco-conscious style.</p><p><br></p><p><span style=\"font-weight: bolder;\">SIZE: 10 in. by 9 in.</span></p>', '/storage/photos/1/Products.Bags/Verdant Nylon Mini Bag.jpg', 300, '', 'hot', 'active', 200.00, 0.00, 1, 16, NULL, NULL, '2024-05-14 08:47:33', '2024-05-14 08:47:33'),
(66, 'Azure Nylon Mini Bag', 'azure-nylon-mini-bag', '<p>Hand-crafted from nylon in shades of blue and white, this mini bag is perfect for carrying your essentials with ease and elegance.</p><p><br></p><p><b>SIZE: 8 in. by 10 in.</b></p>', '<p>Hand-crafted from nylon in shades of blue and white, this mini bag is perfect for carrying your essentials with ease and elegance.</p><p><br></p><p><span style=\"font-weight: bolder;\">SIZE: 8 in. by 10 in.</span></p>', '/storage/photos/1/Products.Bags/Azure Nylon Mini Bag.jpg', 100, '', 'new', 'active', 300.00, 0.00, 1, 16, NULL, NULL, '2024-05-14 08:48:29', '2024-05-14 08:48:29'),
(67, 'Bamboo Charm Tote', 'bamboo-charm-tote', '<p>This tote bag, hand-crafted from bamboo skin with brown leather accents, exudes rustic charm and timeless elegance.</p><p><br></p><p><b>SIZE: 8 in. by 10 in.</b></p>', '<p>This tote bag, hand-crafted from bamboo skin with brown leather accents, exudes rustic charm and timeless elegance.</p><p><br></p><p><span style=\"font-weight: bolder;\">SIZE: 8 in. by 10 in.</span></p>', '/storage/photos/1/Products.Bags/Bamboo Charm Tote.jpg', 200, '', 'new', 'active', 450.00, 25.00, 1, 16, NULL, NULL, '2024-05-14 08:49:29', '2024-05-14 08:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` tinyint(4) NOT NULL DEFAULT 0,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `rate`, `review`, `status`, `created_at`, `updated_at`) VALUES
(21, 1, 46, 4, 'wow awesome', 'active', '2024-05-14 08:09:48', '2024-05-14 08:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_des` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `description`, `short_des`, `logo`, `photo`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(2, '<p>TEST</p>', '<p>Test</p>', '/storage/photos/1/Bjmp_logo-removebg-preview.png', '/storage/photos/1/blog3.jpg', '9WG6+CHG, F. Manalo Road, Damayan St, General Trias, Cavite', '0968 871 1236', 'r4a.crso@bjmp.gov.ph', '2024-05-13 23:58:39', '2024-05-13 23:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `role`, `provider`, `provider_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@mail.com', NULL, '$2y$10$5YPrJL3wIwUz7ps0vqG5S.P6sdt/s2jPBloTVlpljT0Ds8nt4/sBe', '/storage/photos/1/admin-icn.png', 'admin', NULL, NULL, 'active', 'O2V7gOK29l8XWboW1m1joBGUxT8oX70V6Eb6saZbHmy4uLwOEkbCGE7Cck0P', NULL, '2022-11-27 11:47:09'),
(41, 'ed', 'edchan@gmail.com', NULL, '$2y$10$Ch2k0xv9KXlhKV5shyXRAu/MOSOVC4Ez6AkPcFi0C/BBk6VieO55m', NULL, 'user', NULL, NULL, 'active', NULL, '2024-05-14 08:10:52', '2024-05-14 08:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banners_slug_unique` (`slug`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_order_id_foreign` (`order_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `categories_added_by_foreign` (`added_by`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_shipping_id_foreign` (`shipping_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_post_cat_id_foreign` (`post_cat_id`),
  ADD KEY `posts_post_tag_id_foreign` (`post_tag_id`),
  ADD KEY `posts_added_by_foreign` (`added_by`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_categories_slug_unique` (`slug`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comments_user_id_foreign` (`user_id`),
  ADD KEY `post_comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_tags_slug_unique` (`slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_cat_id_foreign` (`cat_id`),
  ADD KEY `products_child_cat_id_foreign` (`child_cat_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_cart_id_foreign` (`cart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shippings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_post_cat_id_foreign` FOREIGN KEY (`post_cat_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_post_tag_id_foreign` FOREIGN KEY (`post_tag_id`) REFERENCES `post_tags` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `post_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_child_cat_id_foreign` FOREIGN KEY (`child_cat_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
