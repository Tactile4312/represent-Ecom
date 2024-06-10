-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 03:11 AM
-- Server version: 5.6.21
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8 */
;
--
-- Database: `ecommercebjmp`
--
-- --------------------------------------------------------
--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
    `id` bigint(20) unsigned NOT NULL,
    `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `description` text COLLATE utf8mb4_unicode_ci,
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--
-- --------------------------------------------------------
--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
    `id` bigint(20) unsigned NOT NULL,
    `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--
-- --------------------------------------------------------
--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
    `id` bigint(20) unsigned NOT NULL,
    `product_id` bigint(20) unsigned NOT NULL,
    `order_id` bigint(20) unsigned DEFAULT NULL,
    `user_id` bigint(20) unsigned DEFAULT NULL,
    `price` double(8, 2) NOT NULL,
    `status` enum(
        'new',
        'progress',
        'delivered',
        'cancel'
    ) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
    `quantity` int(11) NOT NULL,
    `amount` double(8, 2) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--
-- --------------------------------------------------------
--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
    `id` bigint(20) unsigned NOT NULL,
    `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `summary` text COLLATE utf8mb4_unicode_ci,
    `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `is_parent` tinyint(1) NOT NULL DEFAULT '1',
    `parent_id` bigint(20) unsigned DEFAULT NULL,
    `added_by` bigint(20) unsigned DEFAULT NULL,
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 14 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--
-- --------------------------------------------------------
--
-- Table structure for table `coupons`
--

CREATE TABLE IF NOT EXISTS `coupons` (
    `id` bigint(20) unsigned NOT NULL,
    `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `type` enum('fixed', 'percent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
    `value` decimal(20, 2) NOT NULL,
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO
    `coupons` (
        `id`,
        `code`,
        `type`,
        `value`,
        `status`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'LKPL690',
        'fixed',
        '30.00',
        'inactive',
        NULL,
        '2023-11-27 18:40:23'
    ),
    (
        2,
        '111111',
        'percent',
        '10.00',
        'active',
        NULL,
        NULL
    ),
    (
        6,
        'CODEASTRO10',
        'percent',
        '10.00',
        'active',
        '2023-11-27 18:39:49',
        '2023-11-27 18:39:49'
    );

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
    `id` bigint(20) unsigned NOT NULL,
    `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
    `id` bigint(20) unsigned NOT NULL,
    `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `read_at` timestamp NULL DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
    `id` int(10) unsigned NOT NULL,
    `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch` int(11) NOT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 21 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO
    `migrations` (`id`, `migration`, `batch`)
VALUES (
        1,
        '2014_10_12_000000_create_users_table',
        1
    ),
    (
        2,
        '2014_10_12_100000_create_password_resets_table',
        1
    ),
    (
        3,
        '2019_08_19_000000_create_failed_jobs_table',
        1
    ),
    (
        4,
        '2020_07_10_021010_create_brands_table',
        1
    ),
    (
        5,
        '2020_07_10_025334_create_banners_table',
        1
    ),
    (
        6,
        '2020_07_10_112147_create_categories_table',
        1
    ),
    (
        7,
        '2020_07_11_063857_create_products_table',
        1
    ),
    (
        8,
        '2020_07_12_073132_create_post_categories_table',
        1
    ),
    (
        9,
        '2020_07_12_073701_create_post_tags_table',
        1
    ),
    (
        10,
        '2020_07_12_083638_create_posts_table',
        1
    ),
    (
        11,
        '2020_07_13_151329_create_messages_table',
        1
    ),
    (
        12,
        '2020_07_14_023748_create_shippings_table',
        1
    ),
    (
        13,
        '2020_07_15_054356_create_orders_table',
        1
    ),
    (
        14,
        '2020_07_15_102626_create_carts_table',
        1
    ),
    (
        15,
        '2020_07_16_041623_create_notifications_table',
        1
    ),
    (
        16,
        '2020_07_16_053240_create_coupons_table',
        1
    ),
    (
        17,
        '2020_07_23_143757_create_wishlists_table',
        1
    ),
    (
        18,
        '2020_07_24_074930_create_product_reviews_table',
        1
    ),
    (
        19,
        '2020_07_24_131727_create_post_comments_table',
        1
    ),
    (
        20,
        '2020_08_01_143408_create_settings_table',
        1
    );

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
    `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `notifiable_id` bigint(20) unsigned NOT NULL,
    `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `read_at` timestamp NULL DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
    `id` bigint(20) unsigned NOT NULL,
    `order_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id` bigint(20) unsigned DEFAULT NULL,
    `sub_total` double(8, 2) NOT NULL,
    `shipping_id` bigint(20) unsigned DEFAULT NULL,
    `coupon` double(8, 2) DEFAULT NULL,
    `total_amount` double(8, 2) NOT NULL,
    `quantity` int(11) NOT NULL,
    `payment_method` enum('cod', 'paypal', 'cardpay') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cod',
    `payment_status` enum('paid', 'unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
    `status` enum(
        'new',
        'process',
        'delivered',
        'ready_to_pickup'
        'cancel'
    ) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
    `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `post_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `address1` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `address2` text COLLATE utf8mb4_unicode_ci,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 12 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
    `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
    `id` bigint(20) unsigned NOT NULL,
    `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `description` longtext COLLATE utf8mb4_unicode_ci,
    `quote` text COLLATE utf8mb4_unicode_ci,
    `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `post_cat_id` bigint(20) unsigned DEFAULT NULL,
    `post_tag_id` bigint(20) unsigned DEFAULT NULL,
    `added_by` bigint(20) unsigned DEFAULT NULL,
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--
-- --------------------------------------------------------
--
-- Table structure for table `post_categories`
--

CREATE TABLE IF NOT EXISTS `post_categories` (
    `id` bigint(20) unsigned NOT NULL,
    `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE IF NOT EXISTS `post_comments` (
    `id` bigint(20) unsigned NOT NULL,
    `user_id` bigint(20) unsigned DEFAULT NULL,
    `post_id` bigint(20) unsigned DEFAULT NULL,
    `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    `replied_comment` text COLLATE utf8mb4_unicode_ci,
    `parent_id` bigint(20) unsigned DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `post_comments`
--

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE IF NOT EXISTS `post_tags` (
    `id` bigint(20) unsigned NOT NULL,
    `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tags`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
    `id` bigint(20) unsigned NOT NULL,
    `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `description` longtext COLLATE utf8mb4_unicode_ci,
    `photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `stock` int(11) NOT NULL DEFAULT '1',
    `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'M',
    `condition` enum('default', 'new', 'hot') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
    `price` double(8, 2) NOT NULL,
    `discount` double(8, 2) NOT NULL,
    `is_featured` tinyint(1) NOT NULL,
    `cat_id` bigint(20) unsigned DEFAULT NULL,
    `child_cat_id` bigint(20) unsigned DEFAULT NULL,
    `brand_id` bigint(20) unsigned DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 23 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE IF NOT EXISTS `product_reviews` (
    `id` bigint(20) unsigned NOT NULL,
    `user_id` bigint(20) unsigned DEFAULT NULL,
    `product_id` bigint(20) unsigned DEFAULT NULL,
    `rate` tinyint(4) NOT NULL DEFAULT '0',
    `review` text COLLATE utf8mb4_unicode_ci,
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 21 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
    `id` bigint(20) unsigned NOT NULL,
    `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `short_des` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE IF NOT EXISTS `shippings` (
    `id` bigint(20) unsigned NOT NULL,
    `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `price` decimal(8, 2) NOT NULL,
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
    `id` bigint(20) unsigned NOT NULL,
    `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `role` enum('admin', 'user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
    `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 41 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO
    `users` (
        `id`,
        `name`,
        `email`,
        `email_verified_at`,
        `password`,
        `photo`,
        `role`,
        `provider`,
        `provider_id`,
        `status`,
        `remember_token`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'Admin',
        'admin@mail.com',
        NULL,
        '$2y$10$5YPrJL3wIwUz7ps0vqG5S.P6sdt/s2jPBloTVlpljT0Ds8nt4/sBe',
        '/storage/photos/1/admin-icn.png',
        'admin',
        NULL,
        NULL,
        'active',
        'gsUaZyeRlckSu9M3AFpnKCYhduZPPPeYKCkEhId2EeSGftwYHa07s0md7C7G',
        NULL,
        '2022-11-27 11:47:09'
    );

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE IF NOT EXISTS `wishlists` (
    `id` bigint(20) unsigned NOT NULL,
    `product_id` bigint(20) unsigned NOT NULL,
    `cart_id` bigint(20) unsigned DEFAULT NULL,
    `user_id` bigint(20) unsigned DEFAULT NULL,
    `price` double(8, 2) NOT NULL,
    `quantity` int(11) NOT NULL,
    `amount` double(8, 2) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

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
ALTER TABLE `failed_jobs` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
ADD PRIMARY KEY (`id`),
ADD KEY `notifications_notifiable_type_notifiable_id_index` (
    `notifiable_type`,
    `notifiable_id`
);

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
ALTER TABLE `settings` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings` ADD PRIMARY KEY (`id`);

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
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 5;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 8;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 10;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 14;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 7;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 21;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 12;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 7;
--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 6;
--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 8;
--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 23;
--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 21;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 2;
--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 41;
--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 2;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
