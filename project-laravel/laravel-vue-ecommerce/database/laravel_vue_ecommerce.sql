-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2025 at 07:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_vue_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(7, 4, 2, 1, '2025-06-13 10:08:18', '2025-06-13 10:08:18'),
(8, 4, 3, 1, '2025-06-13 10:08:20', '2025-06-13 10:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `active`, `parent_id`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'category 4', 'category-4', 1, 5, 4, 4, NULL, NULL, '2025-06-13 07:49:00', '2025-06-13 09:26:31'),
(2, 'category 1', 'category-1', 1, NULL, 4, 4, NULL, NULL, '2025-06-13 08:19:18', '2025-06-13 09:25:57'),
(3, 'category 3', 'category-3', 1, 2, 4, 4, NULL, NULL, '2025-06-13 08:19:31', '2025-06-13 09:26:20'),
(4, '111', '111', 0, NULL, 4, 4, NULL, NULL, '2025-06-13 08:19:42', '2025-06-13 08:19:42'),
(5, 'category 2', 'category-2', 1, NULL, 4, 4, NULL, NULL, '2025-06-13 08:19:53', '2025-06-13 09:26:05'),
(6, 'Electronics', 'electronics', 1, NULL, 1, 1, NULL, NULL, '2025-06-13 16:32:41', '2025-06-13 16:32:41'),
(7, 'Smartphones', 'smartphones', 1, 6, 1, 1, NULL, NULL, '2025-06-13 16:32:41', '2025-06-13 16:32:41'),
(8, 'Laptops', 'laptops', 1, 6, 2, 2, NULL, NULL, '2025-06-13 16:32:41', '2025-06-13 16:32:41'),
(9, 'Accessories', 'accessories', 0, NULL, 1, 2, NULL, NULL, '2025-06-13 16:32:41', '2025-06-13 16:32:41'),
(10, 'Headphones', 'headphones', 1, 9, 1, 1, NULL, NULL, '2025-06-13 16:33:00', '2025-06-13 16:33:00'),
(11, 'Chargers', 'chargers', 1, 9, 2, 2, NULL, NULL, '2025-06-13 16:33:00', '2025-06-13 16:33:00'),
(12, 'Home Appliances', 'home-appliances', 1, NULL, 1, 1, NULL, NULL, '2025-06-13 16:33:00', '2025-06-13 16:33:00'),
(13, 'Televisions', 'televisions', 0, 6, 2, 1, NULL, NULL, '2025-06-13 16:33:00', '2025-06-13 16:33:00'),
(14, 'Gaming Consoles', 'gaming-consoles', 1, 6, 1, 2, NULL, NULL, '2025-06-13 16:33:00', '2025-06-13 16:33:00'),
(15, 'Wearables', 'wearables', 1, NULL, 1, 1, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(16, 'Smart Watches', 'smart-watches', 1, 15, 2, 2, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(17, 'Fitness Trackers', 'fitness-trackers', 1, 15, 1, 2, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(18, '5G Phones', '5g-phones', 1, 7, 1, 1, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(19, 'Budget Phones', 'budget-phones', 0, 7, 2, 1, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(20, 'Gaming Laptops', 'gaming-laptops', 1, 8, 1, 2, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(21, 'Ultrabooks', 'ultrabooks', 1, 8, 2, 2, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(22, 'Cables', 'cables', 1, 9, 1, 1, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(23, 'Kitchen Appliances', 'kitchen-appliances', 1, 12, 2, 1, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(24, 'Microwaves', 'microwaves', 1, 23, 1, 2, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(25, 'Blenders', 'blenders', 0, 23, 2, 2, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(26, 'Furniture', 'furniture', 1, NULL, 1, 1, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(27, 'Sofas', 'sofas', 1, 26, 2, 1, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(28, 'Dining Tables', 'dining-tables', 1, 26, 1, 2, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00'),
(29, 'LED TVs', 'led-tvs', 1, 13, 2, 1, NULL, NULL, '2025-06-13 16:34:00', '2025-06-13 16:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `code` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `states` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`states`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`code`, `name`, `states`) VALUES
('geo', 'Georgia', NULL),
('ger', 'Germany', NULL),
('ind', 'India', NULL),
('usa', 'United States of America', '{\"AL\":\"Alabama\",\"AK\":\"Alaska\",\"AZ\":\"Arizona\",\"AR\":\"Arkansas\",\"CA\":\"California\"}');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `first_name`, `last_name`, `phone`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, 'test', '1', '123-456-7890', 'active', '2025-06-13 08:10:30', '2025-06-13 09:51:07', NULL, NULL),
(5, 'Jane', 'Smith', '987-654-3210', 'active', '2025-06-13 08:10:30', '2025-06-13 08:10:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(45) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) NOT NULL,
  `country_code` varchar(3) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `type`, `address1`, `address2`, `city`, `state`, `zipcode`, `country_code`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'shipping', 'Đà nẵng', 'aaa', 'aa', '111', '111', 'geo', 5, '2025-06-13 08:26:06', '2025-06-13 08:26:06'),
(2, 'billing', 'Đà nẵng', 'aaa', 'aa', '111', '111', 'geo', 5, '2025-06-13 08:26:06', '2025-06-13 08:26:06'),
(3, 'shipping', 'Đà nẵng', 'aaa', 'aa', '11', '111', 'geo', 4, '2025-06-13 09:21:49', '2025-06-13 09:21:49'),
(4, 'billing', 'Đà nẵng', 'aaa', 'aa', '11', '111', 'geo', 4, '2025-06-13 09:21:49', '2025-06-13 09:21:49');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_09_004121_create_products_table', 1),
(6, '2022_07_09_004135_create_orders_table', 1),
(7, '2022_07_09_004342_create_countries_table', 1),
(8, '2022_07_09_004403_create_cart_items_table', 1),
(9, '2022_07_09_004417_create_order_details_table', 1),
(10, '2022_07_09_004430_create_order_items_table', 1),
(11, '2022_07_09_004446_create_payments_table', 1),
(12, '2022_07_09_004505_create_customers_table', 1),
(13, '2022_07_09_004515_create_customer_addresses_table', 1),
(14, '2022_07_11_043258_add_is_admin_column_to_users_table', 1),
(15, '2022_09_11_142434_rename_customer_id_column', 1),
(16, '2022_09_17_025414_change_countries_states_column_into_json', 1),
(17, '2022_10_01_142356_add_session_id_to_payments_table', 1),
(18, '2022_10_09_171628_add_published_column_to_products', 1),
(19, '2022_11_28_194915_update_order_items_order_id', 1),
(20, '2022_11_28_194929_update_payments_order_id', 1),
(21, '2023_02_26_194708_add_expires_at_column_to_personal_access_tokens', 1),
(22, '2023_08_29_144700_add_quantity_column_to_products_table', 1),
(23, '2023_09_01_145113_create_product_images_table', 1),
(24, '2023_09_22_145051_create_categories_table', 1),
(25, '2023_10_16_151019_create_product_categories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(20,2) NOT NULL,
  `status` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total_price`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(5, 2222.00, 'paid', '2025-06-13 08:38:06', '2025-06-13 08:38:06', 5, 5),
(6, 0.00, 'paid', '2025-06-13 08:38:19', '2025-06-13 08:38:19', 5, 5),
(9, 5777.00, 'paid', '2025-06-13 09:09:08', '2025-06-13 09:09:08', 5, 5),
(10, 777.00, 'paid', '2025-06-13 09:09:28', '2025-06-13 09:09:28', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) NOT NULL,
  `country_code` varchar(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(5, 5, 2, 2, 1111.00, '2025-06-13 08:38:06', '2025-06-13 08:38:06'),
(10, 9, 1, 2, 111.00, '2025-06-13 09:09:08', '2025-06-13 09:09:08'),
(11, 9, 2, 5, 1111.00, '2025-06-13 09:09:08', '2025-06-13 09:09:08'),
(12, 10, 1, 1, 111.00, '2025-06-13 09:09:28', '2025-06-13 09:09:28'),
(13, 10, 3, 2, 333.00, '2025-06-13 09:09:28', '2025-06-13 09:09:28');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `amount`, `status`, `type`, `created_at`, `updated_at`, `created_by`, `updated_by`, `session_id`) VALUES
(5, 5, 2222.00, 'paid', 'none', '2025-06-13 08:38:06', '2025-06-13 08:38:06', 5, 5, NULL),
(6, 6, 0.00, 'paid', 'none', '2025-06-13 08:38:19', '2025-06-13 08:38:19', 5, 5, NULL),
(9, 9, 5777.00, 'paid', 'none', '2025-06-13 09:09:08', '2025-06-13 09:09:08', 5, 5, NULL),
(10, 10, 777.00, 'paid', 'none', '2025-06-13 09:09:28', '2025-06-13 09:09:28', 5, 5, NULL);

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 4, 'main', 'f50b58e9d763bebd923dc7efc73fd7123dbb9cc1c8bdff7ec9af4696274da8b4', '[\"*\"]', '2025-06-13 10:46:44', NULL, '2025-06-13 09:48:09', '2025-06-13 10:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(2000) NOT NULL,
  `slug` varchar(2000) NOT NULL,
  `description` longtext DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `price`, `quantity`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`, `created_at`, `updated_at`, `published`) VALUES
(1, 'test2', 'test2', '<p>test2</p>', 111.00, 222, 4, 4, NULL, NULL, '2025-06-13 07:44:16', '2025-06-13 09:25:19', 1),
(2, 'bbb', 'bbb', '<p>222</p>', 1111.00, 326, 4, 4, NULL, NULL, '2025-06-13 07:48:40', '2025-06-13 09:09:08', 1),
(3, 'test', 'test', '<p>test</p>', 333.00, 21, 4, 4, NULL, NULL, '2025-06-13 07:50:39', '2025-06-13 09:24:52', 1),
(4, 'iPhone 15 Pro', 'iphone-15-pro', 'Latest iPhone with A17 chip', 999.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(5, 'Samsung Galaxy S24', 'samsung-galaxy-s24', 'Flagship Android phone', 899.99, 555, 1, 4, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 10:13:37', 1),
(6, 'Google Pixel 8', 'google-pixel-8', 'With advanced AI features', 699.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(7, 'OnePlus 12', 'oneplus-12', 'Fast charging smartphone', 749.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(8, 'Xiaomi 14 Pro', 'xiaomi-14-pro', 'High-end camera phone', 799.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(9, 'iPhone 14', 'iphone-14', 'Previous generation iPhone', 699.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(10, 'Samsung Galaxy A54', 'samsung-galaxy-a54', 'Mid-range Samsung phone', 449.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(11, 'Motorola Edge 40', 'motorola-edge-40', 'Sleek design phone', 599.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(12, 'Realme GT 3', 'realme-gt-3', 'Performance focused phone', 549.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(13, 'Oppo Find X6', 'oppo-find-x6', 'Innovative design phone', 899.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(14, 'iPhone SE', 'iphone-se', 'Compact iPhone', 429.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(15, 'Samsung Galaxy Z Flip', 'samsung-galaxy-z-flip', 'Foldable smartphone', 999.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(16, 'Nokia G60', 'nokia-g60', 'Durable Android phone', 399.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(17, 'Asus ROG Phone 7', 'asus-rog-phone-7', 'Gaming smartphone', 999.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(18, 'Sony Xperia 1 V', 'sony-xperia-1-v', 'For photography enthusiasts', 1199.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(19, 'Vivo X90 Pro', 'vivo-x90-pro', 'Camera-centric phone', 899.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(20, 'iPhone 13 Mini', 'iphone-13-mini', 'Small form factor iPhone', 599.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(21, 'Samsung Galaxy S23 FE', 'samsung-galaxy-s23-fe', 'Fan edition phone', 699.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(22, 'Nothing Phone 2', 'nothing-phone-2', 'Unique design phone', 599.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(23, 'Fairphone 5', 'fairphone-5', 'Sustainable smartphone', 699.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(24, 'Samsung Galaxy S24 Ultra 5G', 'samsung-galaxy-s24-ultra-5g', 'Flagship 5G phone', 1299.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(25, 'iPhone 15 Pro Max 5G', 'iphone-15-pro-max-5g', 'Large screen 5G iPhone', 1199.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(26, 'OnePlus 12 5G', 'oneplus-12-5g', '5G version', 799.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(27, 'Xiaomi 14 Pro 5G', 'xiaomi-14-pro-5g', '5G flagship', 899.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(28, 'Motorola Edge 40 5G', 'motorola-edge-40-5g', '5G capable version', 649.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(29, 'MacBook Pro 16\" M3', 'macbook-pro-16-m3', 'Professional laptop', 2499.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(30, 'Dell XPS 15', 'dell-xps-15', 'Premium Windows laptop', 1799.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(31, 'HP Spectre x360', 'hp-spectre-x360', 'Convertible laptop', 1499.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(32, 'Lenovo ThinkPad X1 Carbon', 'lenovo-thinkpad-x1-carbon', 'Business laptop', 1699.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(33, 'Asus ZenBook 14', 'asus-zenbook-14', 'Ultraportable laptop', 1299.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(34, 'Microsoft Surface Laptop 5', 'microsoft-surface-laptop-5', 'Sleek Windows laptop', 1399.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(35, 'Acer Swift 3', 'acer-swift-3', 'Budget laptop', 799.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(36, 'Razer Blade 15', 'razer-blade-15', 'Gaming laptop', 2299.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(37, 'LG Gram 17', 'lg-gram-17', 'Lightweight large laptop', 1799.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(38, 'MSI Prestige 14', 'msi-prestige-14', 'Creator laptop', 1599.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(39, 'Alienware m18', 'alienware-m18', 'Powerful gaming laptop', 2999.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(40, 'Asus ROG Zephyrus G14', 'asus-rog-zephyrus-g14', 'Compact gaming laptop', 1799.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(41, 'MSI Stealth 16', 'msi-stealth-16', 'Slim gaming laptop', 2199.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(42, 'Lenovo Legion Pro 7', 'lenovo-legion-pro-7', 'High-performance gaming', 1999.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(43, 'Acer Predator Helios 16', 'acer-predator-helios-16', 'Gaming powerhouse', 1899.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(44, 'MacBook Air M2', 'macbook-air-m2', 'Thin and light', 1099.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(45, 'Dell XPS 13 Plus', 'dell-xps-13-plus', 'Premium ultrabook', 1599.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(46, 'HP Envy 13', 'hp-envy-13', 'Sleek ultrabook', 1199.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(47, 'Lenovo Yoga 9i', 'lenovo-yoga-9i', 'Convertible ultrabook', 1499.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(48, 'Asus ExpertBook B9', 'asus-expertbook-b9', 'Business ultrabook', 1699.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(49, 'Sony WH-1000XM5', 'sony-wh-1000xm5', 'Noise cancelling headphones', 399.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(50, 'Bose QuietComfort 45', 'bose-quietcomfort-45', 'Premium headphones', 329.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(51, 'Apple AirPods Max', 'apple-airpods-max', 'Apple headphones', 549.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(52, 'Sennheiser Momentum 4', 'sennheiser-momentum-4', 'High-quality sound', 349.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(53, 'Jabra Elite 85h', 'jabra-elite-85h', 'Smart headphones', 249.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(54, 'Anker 65W GaN Charger', 'anker-65w-gan-charger', 'Compact fast charger', 49.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(55, 'Apple 20W USB-C Charger', 'apple-20w-usb-c-charger', 'iPhone charger', 19.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(56, 'Samsung 45W Travel Charger', 'samsung-45w-travel-charger', 'Fast charging', 39.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(57, 'Belkin 108W 3-Port Charger', 'belkin-108w-3-port-charger', 'Multi-device charging', 99.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(58, 'UGreen 100W 4-Port Charger', 'ugreen-100w-4-port-charger', 'High-power charging', 79.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(59, 'Anker Powerline III USB-C', 'anker-powerline-iii-usb-c', 'Durable USB-C cable', 19.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(60, 'Belkin Boost Charge USB-C', 'belkin-boost-charge-usb-c', 'Fast charging cable', 24.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(61, 'Amazon Basics Lightning', 'amazon-basics-lightning', 'iPhone charging cable', 12.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(62, 'UGreen HDMI 2.1 Cable', 'ugreen-hdmi-2-1-cable', '8K HDMI cable', 29.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(63, 'JSAUX USB-C to USB-C', 'jsaux-usb-c-to-usb-c', '100W charging cable', 15.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(64, 'Samsung QN90B Neo QLED TV', 'samsung-qn90b-neo-qled-tv', '4K Smart TV', 1999.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(65, 'LG C2 OLED TV', 'lg-c2-oled-tv', 'OLED 4K TV', 1799.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(66, 'Sony A95K QD-OLED TV', 'sony-a95k-qd-oled-tv', 'Premium OLED', 2999.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(67, 'TCL 6-Series Roku TV', 'tcl-6-series-roku-tv', 'Budget 4K TV', 799.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(68, 'Hisense U8H Quantum TV', 'hisense-u8h-quantum-tv', 'Bright QLED TV', 1299.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(69, 'Samsung The Frame TV', 'samsung-the-frame-tv', 'Art mode TV', 1499.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(70, 'LG QNED MiniLED TV', 'lg-qned-miniled-tv', 'MiniLED technology', 2199.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(71, 'Sony X95K LED TV', 'sony-x95k-led-tv', 'Full array LED', 1799.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(72, 'Vizio M-Series Quantum', 'vizio-m-series-quantum', 'Value LED TV', 899.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(73, 'Toshiba C350 LED TV', 'toshiba-c350-led-tv', 'Basic LED TV', 499.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(74, 'Ninja Foodi Grill', 'ninja-foodi-grill', 'Multi-cooker grill', 229.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(75, 'Instant Pot Duo', 'instant-pot-duo', '7-in-1 pressure cooker', 99.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(76, 'Vitamix 5200 Blender', 'vitamix-5200-blender', 'Professional blender', 449.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(77, 'Breville Smart Oven', 'breville-smart-oven', 'Convection toaster oven', 349.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(78, 'Keurig K-Elite', 'keurig-k-elite', 'Coffee maker', 179.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(79, 'Panasonic Microwave', 'panasonic-microwave', 'Inverter technology', 199.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 0),
(80, 'Toshiba Countertop Microwave', 'toshiba-countertop-microwave', '1.2 cu.ft capacity', 129.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(81, 'Sharp Carousel Microwave', 'sharp-carousel-microwave', 'Turntable microwave', 149.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(82, 'GE Profile Microwave', 'ge-profile-microwave', 'Built-in microwave', 399.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(83, 'Samsung Smart Microwave', 'samsung-smart-microwave', 'WiFi enabled', 279.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(84, 'IKEA Ektorp Sofa', 'ikea-ektorp-sofa', 'Comfortable 3-seater', 499.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(85, 'Ashley Furniture Sofa', 'ashley-furniture-sofa', 'Modern design', 799.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(86, 'West Elm Harmony Sofa', 'west-elm-harmony-sofa', 'Mid-century style', 1299.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(87, 'Joybird Eliot Sofa', 'joybird-eliot-sofa', 'Customizable sofa', 1499.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(88, 'Article Sven Sofa', 'article-sven-sofa', 'Leather sectional', 1799.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(89, 'Walker Edison Dining Table', 'walker-edison-dining-table', 'Modern farmhouse style', 399.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(90, 'Zinus Modern Dining Table', 'zinus-modern-dining-table', 'Sleek design', 299.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(91, 'Pottery Barn Dining Table', 'pottery-barn-dining-table', 'Extendable table', 999.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(92, 'Sauder Dining Table', 'sauder-dining-table', 'Traditional style', 499.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(93, 'Coaster Dining Table', 'coaster-dining-table', 'Rustic design', 599.99, NULL, 1, 1, NULL, NULL, '2025-06-13 16:52:56', '2025-06-13 16:52:56', 1),
(109, 'Oura Ring Gen 3', 'oura-ring-gen-3', 'Smart ring with health tracking', 299.00, 100, 1, NULL, NULL, NULL, NULL, NULL, 1),
(110, 'Ultrahuman Ring AIR', 'ultrahuman-ring-air', 'Advanced smart ring for metabolic tracking', 349.00, 100, 1, NULL, NULL, NULL, NULL, NULL, 1),
(111, 'Garmin Epix Pro', 'garmin-epix-pro', 'Premium smartwatch with AMOLED display', 899.00, 50, 1, NULL, NULL, NULL, NULL, NULL, 1),
(112, 'Suunto Vertical', 'suunto-vertical', 'Adventure-ready GPS smartwatch', 629.00, 60, 1, NULL, NULL, NULL, NULL, NULL, 1),
(113, 'Whoop Strap 4.0', 'whoop-strap-4', 'Fitness tracker with subscription model', 0.00, 200, 1, NULL, NULL, NULL, NULL, NULL, 1),
(114, 'Garmin Forerunner 955', 'garmin-forerunner-955', 'GPS running smartwatch with music', 499.00, 80, 1, NULL, NULL, NULL, NULL, NULL, 1),
(115, 'Garmin Bounce Kids Watch', 'garmin-bounce-kids', 'Smartwatch designed for kids', 149.00, 70, 1, NULL, NULL, NULL, NULL, NULL, 1),
(116, 'TickTalk 4 Kids Watch', 'ticktalk-4-kids', '4G LTE kids smartwatch', 189.00, 90, 1, NULL, NULL, NULL, NULL, NULL, 1),
(117, 'Polar H10 Heart Rate Sensor', 'polar-h10', 'Chest strap fitness sensor', 89.00, 120, 1, NULL, NULL, NULL, NULL, NULL, 1),
(118, 'Shokz OpenRun', 'shokz-openrun', 'Bone conduction sports headphones', 129.00, 150, 1, NULL, NULL, NULL, NULL, NULL, 1),
(119, 'Xiaomi Mi Band 8', 'xiaomi-mi-band-8', 'Budget fitness tracker', 59.00, 300, 1, NULL, NULL, NULL, NULL, NULL, 1),
(120, 'Gizmo Watch 3', 'gizmo-watch-3', 'Kids smartwatch by Verizon', 149.00, 70, 1, NULL, NULL, NULL, NULL, NULL, 1),
(121, 'Xplora X6 Play', 'xplora-x6-play', 'Smartwatch for kids', 169.00, 60, 1, NULL, NULL, NULL, NULL, NULL, 1),
(122, 'TickTalk 5', 'ticktalk-5', 'Latest kids smart tracker', 189.00, 50, 1, NULL, NULL, NULL, NULL, NULL, 1),
(123, 'Polar H10', 'polar-h10', 'Chest heart rate monitor', 89.00, 100, 1, NULL, NULL, NULL, NULL, NULL, 1),
(124, 'Shokz OpenRun', 'shokz-openrun', 'Bone-conduction headphones', 129.00, 120, 1, NULL, NULL, NULL, NULL, NULL, 1),
(125, 'Garmin HRM-Pro Plus', 'garmin-hrm-pro-plus', 'Heart rate strap with memory', 129.00, 90, 1, NULL, NULL, NULL, NULL, NULL, 1),
(126, 'Wahoo TICKR X', 'wahoo-tickr-x', 'Heart rate & motion sensor', 79.00, 80, 1, NULL, NULL, NULL, NULL, NULL, 1),
(127, 'Coros Pod 2', 'coros-pod-2', 'Running performance tracker', 99.00, 70, 1, NULL, NULL, NULL, NULL, NULL, 1),
(128, 'Stryd Power Meter', 'stryd-power-meter', 'Running power sensor', 219.00, 60, 1, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`) VALUES
(1, 2, 1),
(3, 3, 1),
(4, 1, 2),
(5, 1, 7),
(6, 2, 7),
(7, 3, 7),
(8, 4, 7),
(10, 6, 7),
(11, 7, 7),
(12, 8, 7),
(13, 9, 7),
(14, 10, 7),
(15, 11, 7),
(16, 12, 7),
(17, 13, 7),
(18, 14, 7),
(19, 15, 7),
(20, 16, 7),
(21, 17, 7),
(22, 18, 7),
(23, 19, 7),
(24, 20, 7),
(25, 21, 18),
(26, 22, 18),
(27, 23, 18),
(28, 24, 18),
(29, 25, 18),
(30, 26, 8),
(31, 27, 8),
(32, 28, 8),
(33, 29, 8),
(34, 30, 8),
(35, 31, 8),
(36, 32, 8),
(37, 33, 8),
(38, 34, 8),
(39, 35, 8),
(40, 36, 20),
(41, 37, 20),
(42, 38, 20),
(43, 39, 20),
(44, 40, 20),
(45, 41, 21),
(46, 42, 21),
(47, 43, 21),
(48, 44, 21),
(49, 45, 21),
(50, 46, 10),
(51, 47, 10),
(52, 48, 10),
(53, 49, 10),
(54, 50, 10),
(55, 51, 11),
(56, 52, 11),
(57, 53, 11),
(58, 54, 11),
(59, 55, 11),
(60, 56, 22),
(61, 57, 22),
(62, 58, 22),
(63, 59, 22),
(64, 60, 22),
(65, 61, 13),
(66, 62, 13),
(67, 63, 13),
(68, 64, 13),
(69, 65, 13),
(70, 66, 29),
(71, 67, 29),
(72, 68, 29),
(73, 69, 29),
(74, 70, 29),
(75, 71, 23),
(76, 72, 23),
(77, 73, 23),
(78, 74, 23),
(79, 75, 23),
(80, 76, 24),
(81, 77, 24),
(82, 78, 24),
(83, 79, 24),
(84, 80, 24),
(85, 81, 27),
(86, 82, 27),
(87, 83, 27),
(88, 84, 27),
(89, 85, 27),
(90, 86, 28),
(91, 87, 28),
(92, 88, 28),
(93, 89, 28),
(94, 90, 28),
(95, 1, 6),
(96, 2, 6),
(97, 3, 6),
(98, 4, 6),
(100, 6, 6),
(101, 7, 6),
(102, 8, 6),
(103, 9, 6),
(104, 10, 6),
(105, 11, 6),
(106, 12, 6),
(107, 13, 6),
(108, 14, 6),
(109, 15, 6),
(110, 16, 6),
(111, 17, 6),
(112, 18, 6),
(113, 19, 6),
(114, 20, 6),
(115, 21, 6),
(116, 22, 6),
(117, 23, 6),
(118, 24, 6),
(119, 25, 6),
(120, 26, 6),
(121, 27, 6),
(122, 28, 6),
(123, 29, 6),
(124, 30, 6),
(125, 31, 6),
(126, 32, 6),
(127, 33, 6),
(128, 34, 6),
(129, 35, 6),
(130, 36, 6),
(131, 37, 6),
(132, 38, 6),
(133, 39, 6),
(134, 40, 6),
(135, 41, 6),
(136, 42, 6),
(137, 43, 6),
(138, 44, 6),
(139, 45, 6),
(140, 46, 6),
(141, 47, 6),
(142, 48, 6),
(143, 49, 6),
(144, 50, 6),
(145, 51, 6),
(146, 52, 6),
(147, 53, 6),
(148, 54, 6),
(149, 55, 6),
(150, 56, 6),
(151, 57, 6),
(152, 58, 6),
(153, 59, 6),
(154, 60, 6),
(155, 61, 12),
(156, 62, 12),
(157, 63, 12),
(158, 64, 12),
(159, 65, 12),
(160, 66, 12),
(161, 67, 12),
(162, 68, 12),
(163, 69, 12),
(164, 70, 12),
(165, 71, 12),
(166, 72, 12),
(167, 73, 12),
(168, 74, 12),
(169, 75, 12),
(170, 76, 12),
(171, 77, 12),
(172, 78, 12),
(173, 79, 12),
(174, 80, 12),
(175, 81, 26),
(176, 82, 26),
(177, 83, 26),
(178, 84, 26),
(179, 85, 26),
(180, 86, 26),
(181, 87, 26),
(182, 88, 26),
(183, 89, 26),
(184, 90, 26),
(185, 1, 7),
(186, 2, 7),
(187, 3, 7),
(188, 4, 7),
(190, 6, 7),
(191, 7, 7),
(192, 8, 7),
(193, 9, 7),
(194, 10, 7),
(195, 11, 7),
(196, 12, 7),
(197, 13, 7),
(198, 14, 7),
(199, 15, 7),
(200, 16, 7),
(201, 17, 7),
(202, 18, 7),
(203, 19, 7),
(204, 20, 7),
(205, 21, 18),
(206, 22, 18),
(207, 23, 18),
(208, 24, 18),
(209, 25, 18),
(210, 26, 8),
(211, 27, 8),
(212, 28, 8),
(213, 29, 8),
(214, 30, 8),
(215, 31, 8),
(216, 32, 8),
(217, 33, 8),
(218, 34, 8),
(219, 35, 8),
(220, 36, 20),
(221, 37, 20),
(222, 38, 20),
(223, 39, 20),
(224, 40, 20),
(225, 41, 21),
(226, 42, 21),
(227, 43, 21),
(228, 44, 21),
(229, 45, 21),
(230, 46, 10),
(231, 47, 10),
(232, 48, 10),
(233, 49, 10),
(234, 50, 10),
(235, 51, 11),
(236, 52, 11),
(237, 53, 11),
(238, 54, 11),
(239, 55, 11),
(240, 56, 22),
(241, 57, 22),
(242, 58, 22),
(243, 59, 22),
(244, 60, 22),
(245, 61, 13),
(246, 62, 13),
(247, 63, 13),
(248, 64, 13),
(249, 65, 13),
(250, 66, 29),
(251, 67, 29),
(252, 68, 29),
(253, 69, 29),
(254, 70, 29),
(255, 71, 23),
(256, 72, 23),
(257, 73, 23),
(258, 74, 23),
(259, 75, 23),
(260, 76, 24),
(261, 77, 24),
(262, 78, 24),
(263, 79, 24),
(264, 80, 24),
(265, 81, 27),
(266, 82, 27),
(267, 83, 27),
(268, 84, 27),
(269, 85, 27),
(270, 86, 28),
(271, 87, 28),
(272, 88, 28),
(273, 89, 28),
(274, 90, 28),
(275, 1, 6),
(276, 2, 6),
(277, 3, 6),
(278, 4, 6),
(280, 6, 6),
(281, 7, 6),
(282, 8, 6),
(283, 9, 6),
(284, 10, 6),
(285, 11, 6),
(286, 12, 6),
(287, 13, 6),
(288, 14, 6),
(289, 15, 6),
(290, 16, 6),
(291, 17, 6),
(292, 18, 6),
(293, 19, 6),
(294, 20, 6),
(295, 21, 6),
(296, 22, 6),
(297, 23, 6),
(298, 24, 6),
(299, 25, 6),
(300, 26, 6),
(301, 27, 6),
(302, 28, 6),
(303, 29, 6),
(304, 30, 6),
(305, 31, 6),
(306, 32, 6),
(307, 33, 6),
(308, 34, 6),
(309, 35, 6),
(310, 36, 6),
(311, 37, 6),
(312, 38, 6),
(313, 39, 6),
(314, 40, 6),
(315, 41, 6),
(316, 42, 6),
(317, 43, 6),
(318, 44, 6),
(319, 45, 6),
(320, 46, 6),
(321, 47, 6),
(322, 48, 6),
(323, 49, 6),
(324, 50, 6),
(325, 51, 6),
(326, 52, 6),
(327, 53, 6),
(328, 54, 6),
(329, 55, 6),
(330, 56, 6),
(331, 57, 6),
(332, 58, 6),
(333, 59, 6),
(334, 60, 6),
(335, 61, 12),
(336, 62, 12),
(337, 63, 12),
(338, 64, 12),
(339, 65, 12),
(340, 66, 12),
(341, 67, 12),
(342, 68, 12),
(343, 69, 12),
(344, 70, 12),
(345, 71, 12),
(346, 72, 12),
(347, 73, 12),
(348, 74, 12),
(349, 75, 12),
(350, 76, 12),
(351, 77, 12),
(352, 78, 12),
(353, 79, 12),
(354, 80, 12),
(355, 81, 26),
(356, 82, 26),
(357, 83, 26),
(358, 84, 26),
(359, 85, 26),
(360, 86, 26),
(361, 87, 26),
(362, 88, 26),
(363, 89, 26),
(364, 90, 26),
(365, 1, 7),
(367, 7, 7),
(368, 9, 7),
(369, 12, 7),
(370, 14, 7),
(371, 16, 7),
(372, 18, 7),
(373, 20, 7),
(374, 22, 7),
(375, 24, 7),
(376, 26, 7),
(377, 28, 7),
(378, 30, 7),
(379, 32, 7),
(380, 34, 7),
(381, 36, 7),
(382, 38, 7),
(383, 40, 7),
(384, 42, 7),
(385, 1, 18),
(387, 9, 18),
(388, 14, 18),
(389, 18, 18),
(390, 22, 18),
(391, 26, 18),
(392, 30, 18),
(393, 34, 18),
(394, 38, 18),
(395, 2, 8),
(396, 4, 8),
(397, 6, 8),
(398, 8, 8),
(399, 10, 8),
(400, 13, 8),
(401, 15, 8),
(402, 17, 8),
(403, 19, 8),
(404, 21, 8),
(405, 23, 8),
(406, 25, 8),
(407, 27, 8),
(408, 29, 8),
(409, 31, 8),
(410, 2, 20),
(411, 6, 20),
(412, 10, 20),
(413, 15, 20),
(414, 19, 20),
(415, 23, 20),
(416, 27, 20),
(417, 4, 21),
(418, 8, 21),
(419, 13, 21),
(420, 17, 21),
(421, 21, 21),
(422, 25, 21),
(423, 29, 21),
(424, 31, 21),
(425, 3, 10),
(426, 11, 10),
(427, 33, 10),
(428, 45, 10),
(429, 57, 10),
(430, 69, 10),
(431, 81, 10),
(432, 93, 10),
(433, 35, 11),
(434, 47, 11),
(435, 59, 11),
(436, 71, 11),
(437, 83, 11),
(438, 89, 11),
(439, 92, 11),
(440, 37, 22),
(441, 49, 22),
(442, 61, 22),
(443, 73, 22),
(444, 85, 22),
(445, 91, 22),
(446, 39, 13),
(447, 41, 13),
(448, 43, 13),
(449, 51, 13),
(450, 63, 13),
(451, 75, 13),
(452, 87, 13),
(453, 90, 13),
(454, 39, 29),
(455, 51, 29),
(456, 63, 29),
(457, 75, 29),
(458, 87, 29),
(459, 44, 23),
(460, 50, 23),
(461, 56, 23),
(462, 62, 23),
(463, 68, 23),
(464, 74, 23),
(465, 80, 23),
(466, 44, 24),
(467, 56, 24),
(468, 68, 24),
(469, 80, 24),
(470, 46, 27),
(471, 52, 27),
(472, 58, 27),
(473, 64, 27),
(474, 70, 27),
(475, 82, 27),
(476, 48, 28),
(477, 54, 28),
(478, 60, 28),
(479, 66, 28),
(480, 78, 28),
(481, 1, 6),
(482, 2, 6),
(483, 3, 6),
(484, 4, 6),
(486, 6, 6),
(487, 7, 6),
(488, 8, 6),
(489, 9, 6),
(490, 10, 6),
(491, 11, 6),
(492, 12, 6),
(493, 13, 6),
(494, 14, 6),
(495, 15, 6),
(496, 16, 6),
(497, 17, 6),
(498, 18, 6),
(499, 19, 6),
(500, 20, 6),
(501, 21, 6),
(502, 22, 6),
(503, 23, 6),
(504, 24, 6),
(505, 25, 6),
(506, 26, 6),
(507, 27, 6),
(508, 28, 6),
(509, 29, 6),
(510, 30, 6),
(511, 31, 6),
(512, 32, 6),
(513, 33, 6),
(514, 34, 6),
(515, 35, 6),
(516, 36, 6),
(517, 37, 6),
(518, 38, 6),
(519, 39, 6),
(520, 40, 6),
(521, 41, 6),
(522, 42, 6),
(523, 43, 6),
(524, 44, 6),
(525, 45, 6),
(526, 46, 6),
(527, 47, 6),
(528, 48, 6),
(529, 49, 6),
(530, 50, 6),
(531, 51, 6),
(532, 52, 6),
(533, 53, 6),
(534, 54, 6),
(535, 55, 6),
(536, 56, 6),
(537, 57, 6),
(538, 58, 6),
(539, 59, 6),
(540, 60, 6),
(541, 61, 12),
(542, 62, 12),
(543, 63, 12),
(544, 64, 12),
(545, 65, 12),
(546, 66, 12),
(547, 67, 12),
(548, 68, 12),
(549, 69, 12),
(550, 70, 12),
(551, 71, 12),
(552, 72, 12),
(553, 73, 12),
(554, 74, 12),
(555, 75, 12),
(556, 76, 12),
(557, 77, 12),
(558, 78, 12),
(559, 79, 12),
(560, 80, 12),
(561, 81, 12),
(562, 82, 12),
(563, 83, 12),
(564, 84, 12),
(565, 85, 12),
(566, 86, 26),
(567, 87, 26),
(568, 88, 26),
(569, 89, 26),
(570, 90, 26),
(571, 91, 26),
(572, 92, 26),
(573, 93, 26),
(574, 46, 26),
(575, 52, 26),
(576, 58, 26),
(577, 64, 26),
(578, 70, 26),
(579, 82, 26),
(580, 48, 26),
(581, 7, 9),
(582, 15, 14),
(583, 44, 6),
(584, 39, 6),
(585, 3, 15),
(586, 11, 15),
(587, 35, 7),
(593, 5, 6),
(594, 5, 6),
(595, 5, 6),
(596, 5, 15),
(597, 5, 12),
(813, 109, 15),
(814, 110, 15),
(815, 111, 15),
(816, 112, 16),
(817, 112, 15),
(818, 113, 16),
(819, 113, 15),
(820, 114, 16),
(821, 114, 15),
(822, 115, 16),
(823, 115, 15),
(824, 116, 17),
(825, 116, 15),
(826, 117, 17),
(827, 117, 16),
(828, 117, 15),
(829, 118, 17),
(830, 119, 17),
(831, 120, 16),
(832, 120, 15),
(833, 121, 16),
(834, 121, 15),
(835, 122, 16),
(836, 122, 15),
(837, 123, 17),
(838, 123, 15),
(839, 124, 15),
(840, 125, 17),
(841, 126, 17),
(842, 127, 17),
(843, 127, 15),
(844, 128, 17),
(845, 109, 6),
(846, 110, 6),
(847, 111, 6),
(848, 112, 6),
(849, 113, 6),
(850, 114, 6),
(851, 115, 6),
(852, 116, 6),
(853, 117, 6),
(854, 118, 6),
(855, 119, 6),
(856, 120, 6),
(857, 121, 6),
(858, 122, 6),
(859, 123, 6),
(860, 124, 6),
(861, 125, 6),
(862, 126, 6),
(863, 127, 6),
(864, 128, 6),
(865, 109, 17),
(866, 110, 17),
(867, 111, 17),
(868, 124, 17),
(869, 128, 15);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `mime` varchar(55) NOT NULL,
  `size` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `path`, `url`, `mime`, `size`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/fc0NYrdRThc6HTyk/tTDB98r1PspvMggg.png', 'http://localhost:8000/storage/images/fc0NYrdRThc6HTyk/tTDB98r1PspvMggg.png', 'image/png', 209657, 1, '2025-06-13 07:44:16', '2025-06-13 09:25:19'),
(2, 2, 'images/jEB4DYPmF886XIF5/4tBq4NFHqLu54l2g.png', 'http://localhost:8000/storage/images/jEB4DYPmF886XIF5/4tBq4NFHqLu54l2g.png', 'image/png', 164328, 1, '2025-06-13 07:48:40', '2025-06-13 07:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(4, 'Admin', 'admin@example.com', '2025-06-13 07:30:59', '$2y$12$phk2OgtUHXJ.ju24mKNbtuL7SSQMagkXS1Ui.cDThh20RxXZhMSAq', '34t7Aur7U0YWXtxdzW2N1pC2O5oLvWluX4W2MrEJm2guERLXsQ61oWLum1It', '2025-06-13 07:30:59', '2025-06-13 07:30:59', 1),
(5, 'Admin 1', 'admin@gmail.com', '2025-06-13 07:45:13', '$2y$12$Ayg0aHU4QlGlVvrmRRLGTu/wbCAoAyBEfx3TD9dIez295f/AROMna', NULL, '2025-06-13 07:45:13', '2025-06-13 09:51:44', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_addresses_country_code_foreign` (`country_code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories_product_id_foreign` (`product_id`),
  ADD KEY `product_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=870;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_code_foreign` FOREIGN KEY (`country_code`) REFERENCES `countries` (`code`),
  ADD CONSTRAINT `customer_addresses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
