-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 09, 2022 lúc 01:05 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doan_cosmetic_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Trang điểm', 'Đẹp và rạng ngời', 'images/hPTtizT4zPyGvd9Ywi9vT7RhbQrXv9DKvJJZtq1o.jpg', 1, NULL, '2022-10-12 22:53:59', '2022-10-12 23:01:18'),
(2, 'Chăm sóc da', 'Da sáng rạng ngời', 'images/mIFSoSf5vIlh89lzGtWMqUPrQ1rTTHzoSXW5FgcA.jpg', 1, NULL, '2022-10-12 23:03:24', '2022-10-12 23:03:24'),
(3, 'Chăm sóc tóc', 'Mềm mượt óng ả', 'images/2HANNgZaXoj0nONCyI6WkJqNlbJ4hHFnfb3OcVXF.jpg', 1, NULL, '2022-10-12 23:04:42', '2022-10-12 23:04:42'),
(4, 'Phụ kiện làm đẹp', 'Lan tỏa sắc đẹp', 'images/swooXVEuyWCT8deVJAnwEcKHTMvGUhPHxVksJ762.png', 1, NULL, '2022-10-12 23:06:43', '2022-10-25 01:59:03'),
(5, 'Nước hoa', 'Hương thơm lâu quyến rũ', 'images/2QQuev11FO47AoSxqZt2SXFnwA1Q8gL1c8VfGjzA.jpg', 1, NULL, '2022-10-12 23:07:27', '2022-10-13 22:29:33'),
(6, 'Chăm sóc toàn thân', 'Mềm mại tự tin', 'images/bpI34r9GnLIDvPuNj9D3kc9WSLopEwE0c7MlbEZl.png', 1, NULL, '2022-10-12 23:09:06', '2022-10-12 23:09:06'),
(7, 'Khuyến mại', 'Ưu đãi các sản phẩm', 'images/fiodEcUvoLU2x1deLy9mRzbB6x5RSwcFr4JPhAPd.jpg', 1, NULL, '2022-10-12 23:10:36', '2022-10-12 23:10:36'),
(8, 'Thương hiệu', 'Tin tưởng lựa chọn', 'images/Z9UvO8jqxP1kzr3fG74XRKwdqcZeQwcUufaw2VHo.jpg', 1, NULL, '2022-10-12 23:12:42', '2022-10-12 23:12:42'),
(9, 'mbm', 'mchg', 'images/p3hRZ5dlLRCIcLNxsdtH5Xs3uj1A7M66YwCsqXYC.png', 1, '2022-11-08 06:32:33', '2022-11-08 06:32:25', '2022-11-08 06:32:33'),
(10, ',snm', ',sa;', 'images/CVIPdnaRLXMYVnYtDFlhpIWfofLH1fAPcFiWdGBP.jpg', 1, '2022-11-27 00:07:36', '2022-11-27 00:06:40', '2022-11-27 00:07:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `name` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `content`, `email`, `name`, `product_id`) VALUES
(1, 6, 'dasdsa', 'sachtruyen@gmail.com', 'dsadasd', 3),
(2, 6, 'Sản phẩm này đẹp', 'nguyennga@gmail.com', 'Nguyễn Nga', 3),
(3, 6, 'dsadsa', 'maxime80@example.net', 'Eunice 123', 3),
(4, 6, 'Trương Hoàng Hà', 'webster32@example.org', 'Hiếu Programming Đẹp Giai', 3),
(5, 6, 'Nguyễn THông đẹp trai', 'maxime80@example.net', 'Nguyễn THông', 1),
(6, 6, 'dsadas', 'dadsa@gmail.com', 'dsadas', 1),
(7, 6, 'dasdsadsadas', 'Vladimir@gmail.com', 'Vladimir', 3),
(8, 6, 'dsadsadasd', 'maxime80@example.net', 'manga24h', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coupon_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_times` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `created_at`, `updated_at`, `coupon_name`, `coupon_code`, `coupon_times`, `coupon_condition`, `coupon_number`, `deleted_at`) VALUES
(1, NULL, NULL, 'Giảm mạnh', 'HGOJIFDGM', '50', NULL, '10', NULL),
(2, NULL, NULL, 'áb', 'khsq', 'skj', NULL, 'shbsq', NULL),
(3, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL),
(4, NULL, NULL, 'msns', 'mlkq', 's k', '1', '10', NULL),
(5, NULL, NULL, 'a', 'A', '1', '1', '50', NULL),
(6, NULL, NULL, 'a', 'a', 'a', '2', 's', NULL),
(7, NULL, NULL, 'Giảm mạnh', 'HGOJIFDGM', '50', '2', '30000', NULL),
(8, NULL, NULL, '30/4', 'HGOJIFDGM', '15', '2', '120000', NULL),
(9, NULL, NULL, ',dưhd', 'qưdqdwd', '3', '1', '50', NULL),
(10, NULL, NULL, 'nj,b', 'khsq', '15', '2', '30000', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `phone`, `address`, `gender`, `status`, `remember_token`, `email_verified_at`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Trần Thị Hạnh', 'hanh@gmail.com', '$2y$10$FLxsCp7FKFuLYtwz5troeeN5vt33Nrb5JtMHDzynzMY9rA1.c9cYG', '0124356789', 'Bình Lục - Hà Nam', 1, 1, NULL, NULL, NULL, NULL, '2022-10-13 00:41:03', '2022-10-13 00:41:03', NULL),
(2, 'Đinh Văn Nam', 'dvnam@gmail.com', '$2y$10$s9nkNPMfaX/F/kGdtl5T4eRZcHedttvcAYUm3qT/b6eovwLM9CEQy', '0315682933', 'Quảng Nam', 0, 1, NULL, NULL, NULL, NULL, '2022-10-13 22:43:30', '2022-10-13 22:43:30', NULL),
(3, 'Đinh Lan Anh', 'lananh@gmail.com', '$2y$10$Zy7RF039Wlob7TPK6LjDfuREpibMyys5QtLAd9z1J9w4tTAMFL5o.', '097865127', 'Nga Sơn - Thanh Hóa', 1, 0, NULL, NULL, NULL, NULL, '2022-10-23 07:14:09', '2022-11-25 03:08:36', NULL),
(4, 'Trần Thị Lan Anh', 'ttla@gmail.com', '$2y$10$pGAhJa6lQg9eBlG55J4Jpe8EOVfU/7B/NthSwYQB0cno1TBYXzgkm', '0869841274', 'Hải Phòng', 1, 1, NULL, NULL, NULL, NULL, '2022-10-28 00:09:09', '2022-10-28 00:09:09', NULL),
(5, 'Nguyễn Thị Hằng Nga', 'nthnga0703@gmail.com', '$2y$10$eDID9J3gKhpBhCvOvahSd.sAL9zhFh3GPCBMLgZF/FxqqKWz5yI1G', '0349719563', 'Xuân Trường - Nam Định', 1, 1, NULL, NULL, NULL, NULL, '2022-11-24 06:15:45', '2022-11-24 06:15:45', NULL),
(6, 'truongngoctanhieu2018@gmail.com', 'truongngoctanhieu2018@gmail.com', '$2y$10$SzNbkZtJ5aANzsMoOxZE8OfT.vvrdIxdH.qWxX.zTrBqZLSafh9jy', '0932023992', 'truongngoctanhieu2018@gmail.com', 0, 1, NULL, NULL, NULL, NULL, '2022-12-09 00:50:23', '2022-12-09 00:50:23', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`id`, `name`, `path`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'kemchem1.jpg', 'images/products/kemchem1.jpg', 1, '2022-10-12 23:19:12', '2022-10-12 23:19:12'),
(2, 'phannuoc1.jpg', 'images/products/phannuoc1.jpg', 2, '2022-10-12 23:24:26', '2022-10-12 23:24:26'),
(3, 'lột mụn đầu đen.jpg', 'images/products/lột mụn đầu đen.jpg', 3, '2022-10-12 23:43:32', '2022-10-12 23:43:32'),
(4, 'cera.jpg', 'images/products/cera.jpg', 4, '2022-10-12 23:46:04', '2022-10-12 23:46:04'),
(5, 'caphetdc.jpg', 'images/products/caphetdc.jpg', 5, '2022-10-12 23:48:03', '2022-10-12 23:48:03'),
(6, 'simple.jpeg', 'images/products/simple.jpeg', 6, '2022-10-12 23:51:37', '2022-10-12 23:51:37'),
(7, 'bioreduong.jpg', 'images/products/bioreduong.jpg', 7, '2022-10-12 23:53:37', '2022-10-12 23:53:37'),
(8, 'innistoner.jpg', 'images/products/innistoner.jpg', 8, '2022-10-12 23:55:46', '2022-10-12 23:55:46'),
(9, 'duongtoc.jpg', 'images/products/duongtoc.jpg', 9, '2022-10-12 23:58:21', '2022-10-12 23:58:21'),
(10, 'bedhead.png', 'images/products/bedhead.png', 10, '2022-10-13 00:00:24', '2022-10-13 00:00:24'),
(11, 'cocoon.jpg', 'images/products/cocoon.jpg', 11, '2022-10-13 00:04:38', '2022-10-13 00:04:38'),
(12, 'daukho.jpg', 'images/products/daukho.jpg', 12, '2022-10-13 00:12:16', '2022-10-13 00:12:16'),
(13, 'nentg.jpg', 'images/products/nentg.jpg', 13, '2022-10-13 00:14:25', '2022-10-13 00:14:25'),
(14, 'bongmut.jpg', 'images/products/bongmut.jpg', 14, '2022-10-13 00:16:05', '2022-10-13 00:16:05'),
(15, 'bammi.jpg', 'images/products/bammi.jpg', 15, '2022-10-13 00:18:35', '2022-10-13 00:18:35'),
(16, 'cọ trang điểm.jpg', 'images/products/cọ trang điểm.jpg', 16, '2022-10-13 00:21:37', '2022-10-13 00:21:37'),
(17, 'colongmay.png', 'images/products/colongmay.png', 17, '2022-10-13 00:23:42', '2022-10-13 00:23:42'),
(18, 'cstt.png', 'images/products/cstt.png', 17, '2022-10-13 00:23:42', '2022-10-13 00:23:42'),
(19, 'taytrang.jpg', 'images/products/taytrang.jpg', 18, '2022-10-13 00:25:57', '2022-10-13 00:25:57'),
(20, 'taytrang2.jpg', 'images/products/taytrang2.jpg', 18, '2022-10-13 00:25:57', '2022-10-13 00:25:57'),
(21, 'chailo.jpg', 'images/products/chailo.jpg', 19, '2022-10-13 00:28:09', '2022-10-13 00:28:09'),
(22, 'chailo2.jpg', 'images/products/chailo2.jpg', 19, '2022-10-13 00:28:09', '2022-10-13 00:28:09'),
(23, 'chailo3.jpg', 'images/products/chailo3.jpg', 19, '2022-10-13 00:28:09', '2022-10-13 00:28:09'),
(24, 'sonmongtay.jpg', 'images/products/sonmongtay.jpg', 20, '2022-10-13 00:31:45', '2022-10-13 00:31:45'),
(25, 'soninnis.jpg', 'images/products/soninnis.jpg', 21, '2022-10-13 02:04:59', '2022-10-13 02:04:59'),
(26, 'nuôcanu.jpg', 'images/products/nuôcanu.jpg', 22, '2022-10-13 02:07:46', '2022-10-13 02:07:46'),
(27, 'nuochoa.png', 'images/products/nuochoa.png', 22, '2022-10-13 02:07:46', '2022-10-13 02:07:46'),
(28, 'uochoa3.png', 'images/products/uochoa3.png', 22, '2022-10-13 02:07:46', '2022-10-13 02:07:46'),
(29, 'nuochoa3.jpg', 'images/products/nuochoa3.jpg', 23, '2022-10-13 02:11:46', '2022-10-13 02:11:46'),
(30, 'nuochoanam.jpg', 'images/products/nuochoanam.jpg', 24, '2022-10-13 02:14:28', '2022-10-13 02:14:28'),
(31, 'nuochoanam2.jpg', 'images/products/nuochoanam2.jpg', 24, '2022-10-13 02:14:28', '2022-10-13 02:14:28'),
(32, 'nuochoanam3.jpeg', 'images/products/nuochoanam3.jpeg', 24, '2022-10-13 02:14:28', '2022-10-13 02:14:28'),
(33, 'xị3.jpg', 'images/products/xị3.jpg', 25, '2022-10-13 02:18:51', '2022-10-13 02:18:51'),
(34, 'xit1.jpg', 'images/products/xit1.jpg', 25, '2022-10-13 02:18:51', '2022-10-13 02:18:51'),
(35, 'xit2.jpg', 'images/products/xit2.jpg', 25, '2022-10-13 02:18:51', '2022-10-13 02:18:51'),
(36, 'xị3.jpg', 'images/products/xị3.jpg', 26, '2022-10-13 02:19:51', '2022-10-13 02:19:51'),
(37, 'xit1.jpg', 'images/products/xit1.jpg', 26, '2022-10-13 02:19:51', '2022-10-13 02:19:51'),
(38, 'xit2.jpg', 'images/products/xit2.jpg', 26, '2022-10-13 02:19:51', '2022-10-13 02:19:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_10_09_122125_create_products_table', 1),
(7, '2022_10_09_122743_create_customers_table', 1),
(8, '2022_10_09_123024_create_categories_table', 1),
(9, '2022_10_09_123036_create_orders_table', 1),
(10, '2022_10_09_123051_create_order_products_table', 1),
(11, '2022_10_09_124700_create_images_table', 1),
(12, '2022_10_10_061828_create_sessions_table', 1),
(14, '2014_10_12_000000_create_users_table', 2),
(15, '2022_10_11_181021_create_payment_vnpay_table', 3),
(16, '2022_10_13_141747_create_comments_table', 3),
(17, '2022_11_07_141206_create_trademarks_table', 4),
(18, '2022_11_21_134242_add_trademark_id_to_products_table', 5),
(19, '2022_11_21_135728_add_image_to_trademarks_table', 6),
(20, '2022_11_24_134422_create_contact_table', 7),
(21, '2022_11_27_033906_create_coupons_table', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(255) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT 0,
  `update_by` int(11) NOT NULL DEFAULT 0,
  `total` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `payment_type`, `status`, `update_by`, `total`, `customer_id`, `product_id`, `note`, `created_at`, `updated_at`) VALUES
(1, '0', 5, 0, 110000, 1, 20, NULL, '2022-10-13 00:42:42', '2022-11-25 03:11:39'),
(2, '0', 3, 0, 350000, 1, 2, NULL, '2022-10-13 07:30:19', '2022-10-14 06:56:42'),
(3, '0', 3, 0, 110000, 2, 20, NULL, '2022-10-13 22:45:03', '2022-10-23 01:25:12'),
(4, '0', 1, 0, 131000, 3, 5, 'Mua ngay', '2022-10-23 07:16:03', '2022-11-25 03:11:48'),
(5, '0', 5, 0, 350000, 4, 2, NULL, '2022-11-05 18:03:58', '2022-11-25 03:11:31'),
(6, '0', 3, 0, 45000, 4, 6, 'okkm', '2022-11-27 02:34:19', '2022-11-27 02:34:31'),
(7, '0', 0, 0, 360000, 4, 4, NULL, '2022-11-27 02:42:32', '2022-11-27 02:42:32'),
(8, '0', 3, 0, 360000, 4, 4, NULL, '2022-11-27 02:43:23', '2022-11-27 02:43:31'),
(9, '0', 3, 0, 13000, 4, 3, NULL, '2022-11-27 06:45:13', '2022-11-27 07:15:51'),
(10, '0', 5, 0, 13000, 4, 3, NULL, '2022-11-27 07:15:30', '2022-11-27 07:17:08'),
(11, '0', 3, 0, 13000, 4, 3, NULL, '2022-11-27 07:17:50', '2022-11-27 07:19:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_category` varchar(255) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_origin_price` int(11) DEFAULT NULL,
  `product_sale_price` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `order_products`
--

INSERT INTO `order_products` (`id`, `product_name`, `product_category`, `product_quantity`, `product_origin_price`, `product_sale_price`, `total`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'Sơn Móng 3 Concept Eyes', 'Phụ kiện làm đẹp', 1, 70000, 110000, 110000, 1, 20, '2022-10-13 00:42:42', '2022-10-13 00:42:42'),
(2, 'Phấn Nước KLAVUU Blue Pearlsation High Coverage', 'Trang điểm', 1, 290000, 350000, 350000, 2, 2, '2022-10-13 07:30:19', '2022-10-13 07:30:19'),
(3, 'Sơn Móng 3 Concept Eyes', 'Phụ kiện làm đẹp', 1, 70000, 110000, 110000, 3, 20, '2022-10-13 22:45:03', '2022-10-13 22:45:03'),
(4, 'Tẩy Da Chết Mặt Cà Phê Đắk Lắk Cocoon Coffee Face Polish 150ml', 'Chăm sóc da', 1, 99000, 131000, 131000, 4, 5, '2022-10-23 07:16:03', '2022-10-23 07:16:03'),
(5, 'Phấn Nước KLAVUU Blue Pearlsation High Coverage', 'Trang điểm', 1, 290000, 350000, 350000, 5, 2, '2022-11-05 18:03:58', '2022-11-05 18:03:58'),
(6, 'Nước Tẩy Trang Simple Kind To Skin', 'Chăm sóc da', 1, 29000, 45000, 45000, 6, 6, '2022-11-27 02:34:19', '2022-11-27 02:34:19'),
(7, 'Sữa Rửa Mặt Cerave Cho Da Thường Đến Da Dầu 355ml', 'Chăm sóc da', 1, 290000, 360000, 360000, 7, 4, '2022-11-27 02:42:32', '2022-11-27 02:42:32'),
(8, 'Sữa Rửa Mặt Cerave Cho Da Thường Đến Da Dầu 355ml', 'Chăm sóc da', 1, 290000, 360000, 360000, 8, 4, '2022-11-27 02:43:23', '2022-11-27 02:43:23'),
(9, 'Miếng Giảm Mụn Đầu Đen Ciracle Goodbye 5ml', 'Chăm sóc da', 1, 5000, 13000, 13000, 9, 3, '2022-11-27 06:45:13', '2022-11-27 06:45:13'),
(10, 'Miếng Giảm Mụn Đầu Đen Ciracle Goodbye 5ml', 'Chăm sóc da', 1, 5000, 13000, 13000, 10, 3, '2022-11-27 07:15:30', '2022-11-27 07:15:30'),
(11, 'Miếng Giảm Mụn Đầu Đen Ciracle Goodbye 5ml', 'Chăm sóc da', 1, 5000, 13000, 13000, 11, 3, '2022-11-27 07:17:50', '2022-11-27 07:17:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_vnpay`
--

CREATE TABLE `payment_vnpay` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `money` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `code_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `sold` int(11) NOT NULL DEFAULT 0,
  `origin_price` int(11) NOT NULL DEFAULT 0,
  `sale_price` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `trademark_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `quantity`, `sold`, `origin_price`, `sale_price`, `user_id`, `category_id`, `status`, `created_at`, `updated_at`, `deleted_at`, `trademark_id`) VALUES
(1, 'Bảng Che Khuyết Điểm Mangogo Concealer 6gr', 'Bảng che khuyết điểm Mangogo Concealer nhỏ nhắn dễ mang theo\r\n\r\n- Bao gồm 2 tông màu cho da có nhiều hay ít khuyết điểm đều có thể sử dụng được. Chất kem dễ tán không gây vón cục hay bết da Che đi những khuyết điểm tạo lớp da đều màu, không tì vết', 50, 0, 40000, 65000, 1, 1, 1, '2022-10-12 23:19:12', '2022-10-12 23:19:12', NULL, NULL),
(2, 'Phấn Nước KLAVUU Blue Pearlsation High Coverage', 'Phấn nước che phủ cực tốt những khuyết điểm trên khuôn mặt còn cung cấp độ ẩm, làm sáng da. Với chiết xuất từ ngọc trai và rong biển, tảo biển chứa nhiều vitamin và collagen ngăn sự sự lão hoá cho da. Bảo vệ da khỏi ánh nắng mặt trời nhờ SPF 50 / PA +++', 30, 0, 290000, 350000, 1, 1, 0, '2022-10-12 23:24:26', '2022-10-12 23:24:26', NULL, NULL),
(3, 'Miếng Giảm Mụn Đầu Đen Ciracle Goodbye 5ml', 'Miếng Giảm Mụn Đầu Đen Ciracle Goodbye Blackhead thật sự là phương pháp giảm mụn đầu đen và mụn cám rất hiệu quả.\r\n\r\n- Giải quyết được 80-90% vấn đề mụn đầu đen trên mũi.\r\n\r\n- Dưỡng ấm cho vùng da sau khi sử dụng tốt, kiểu bóng bóng như mũi sao Hàn.\r\n\r\n- Không gây tổn hại đến bề mặt da nhờ cơ chế serum thấm vào các lỗ chân lông.', 100, 0, 5000, 13000, 1, 2, 1, '2022-10-12 23:43:32', '2022-10-12 23:43:32', NULL, NULL),
(4, 'Sữa Rửa Mặt Cerave Cho Da Thường Đến Da Dầu 355ml', 'Sữa rửa mặt CeraVe dòng màu xanh dành cho da thường đến da dầu\r\n\r\n- Dung tích 355ml thoải mái sử dụng\r\n\r\n- Sản phẩm thiết kế dạng ống bơm tiện lợi, sạch sẽ\r\n\r\n- Khả năng tạo bọt nhẹ, làm sạch không khô căng da\r\n\r\n- Sản phẩm lành tính, không màu và không chất tạo mùi', 50, 0, 290000, 360000, 1, 2, 1, '2022-10-12 23:46:04', '2022-10-12 23:46:04', NULL, NULL),
(5, 'Tẩy Da Chết Mặt Cà Phê Đắk Lắk Cocoon Coffee Face Polish 150ml', 'Những hạt cà phê Đắk Lắk xay nhuyễn giàu cafeine hòa quyện với bơ cacao Tiền Giang giúp bạn loại bỏ lớp tế bào chết già cỗi và xỉn màu, đánh thức làn da tươi mới đầy năng lượng cùng cảm giác mượt mà và mềm mịn lan tỏa', 30, 0, 99000, 131000, 1, 2, 2, '2022-10-12 23:48:03', '2022-10-12 23:48:03', NULL, NULL),
(6, 'Nước Tẩy Trang Simple Kind To Skin', 'Nước tẩy trang Simple Micellar Water với hàng triệu bong bóng thông minh giúp loại bỏ bụi bẩn và làm sạch lớp trang điểm hiệu quả, giữ ẩm cho da lên đến 4 giờ', 300, 0, 29000, 45000, 1, 2, 1, '2022-10-12 23:51:37', '2022-10-12 23:51:37', NULL, NULL),
(7, 'Kem Dưỡng Bioderma Cicabio Soothing Repairing Cream 40ml', '- Khôi phục lớp biểu bì\r\n\r\n- Làm giảm cảm giác ngứa và khó chịu\r\n\r\n- Dưỡng ẩm, thanh lọc da\r\n\r\n- Tạo một lớp màng thoáng khí bảo vệ da tối ưu và thoải mái', 200, 0, 20000, 280000, 1, 2, 1, '2022-10-12 23:53:37', '2022-10-12 23:53:37', NULL, NULL),
(8, 'Nước Cân Bằng Innisfree Bija Trouble Skin', '-Nước Hoa Hồng Innisfree Bija Trouble Skin chuyên dùng cho da dầu, da bị mụn hay có vấn đề về da.\r\n\r\n- Chăm sóc điều trị mụn hiệu quả, cân bằng độ pH trên da, se khít lỗ chân lông.\r\n\r\n- Chăm sóc vùng da bị hư tổn do mụn và có tác dụng tẩy tế bào chết nhẹ nhàng cho da.\r\n\r\n- Giúp thông thoáng lỗ chân lông, ngăn ngừa phát sinh mụn, không gây kích ứng da.', 150, 0, 240000, 315000, 1, 2, 1, '2022-10-12 23:55:46', '2022-10-12 23:55:46', NULL, NULL),
(9, 'Dưỡng Tóc Ogx Renewing-Argan Oil Of Morocco', '- Chiết xuất từ tinh dầu Argan có tác dụng dưỡng ẩm và giữ ẩm cho tóc cực hiệu quả\r\n\r\n- Thấm sâu và nuôi dưỡng từ bên trong, phục hồi tóc hư tổn gãy rụng\r\n\r\n- Cung cấp dưỡng chất giúp nuôi dưỡng tóc dày bóng mượt tự nhiên\r\n\r\n- Hương thơm dịu nhẹ dễ chịu, mang lại cảm giác thư thái thoải mái cho người dùng', 50, 0, 145000, 195000, 1, 3, 2, '2022-10-12 23:58:21', '2022-10-12 23:58:21', NULL, NULL),
(10, 'Bộ Gội - Xả TIGI Resurrection', '- Tái sinh mái tóc mới, phục hồi tóc hư tổn trả lại cho bạn mái tóc mềm mại\r\n\r\n- Cải thiện tình trạng xơ rối giúp tóc vào nếp, gọn gàng hơn\r\n\r\n- Lớp màng nano siêu nhỏ làm lớp chắn bảo vệ và tăng cường sức đề kháng cho tóc.', 70, 0, 450000, 530000, 1, 3, 1, '2022-10-13 00:00:24', '2022-10-13 00:00:24', NULL, NULL),
(11, 'Nước Dưỡng Tóc Sa-Chi Cocoon Inca Inchi Hair Tonic 140ml', '- Cải thiện độ chắc khoẻ và tăng cường độ bóng của tóc.\r\n\r\n- Bảo vệ tóc khỏi các tác nhân gây hại từ hóa chất và môi trường. \r\n\r\n- Loại bỏ lớp tế bào da chết tích tụ trên da đầu, bụi bẩn bám trên sợi tóc', 30, 0, 80000, 131000, 1, 3, 1, '2022-10-13 00:04:38', '2022-10-13 00:04:38', NULL, NULL),
(12, 'Dầu Gội Khô CoLab Dry Shampoo 200ml', '-Loại bỏ bụi bẩn, dầu nhờn ngay tức thì \r\n- Hô biến mái tóc trở nên bồng bềnh, khô ráo \r\n- Làm sạch tóc mà không cần dùng nước \r\n- Khử mùi và làm phồng chân tóc', 100, 0, 110000, 160000, 1, 3, 0, '2022-10-13 00:12:16', '2022-10-13 00:12:16', NULL, NULL),
(13, 'Bông Đánh Kem Nền Vacosi Quarter Sponge', '- Khả năng tán kem nền cực tốt\r\n\r\n- Độ dẻo và mềm mịn cao.\r\n\r\n- Thiết kế vừa vặn, dễ cầm và dặm phấn.', 100, 0, 35000, 55000, 1, 4, 1, '2022-10-13 00:14:25', '2022-10-13 00:14:25', NULL, NULL),
(14, 'Bông Mút Nee Ni Coo Set Kitten Puff', '- Set bông mút hình giọt nước với bao bì xinh xắn\r\n\r\n- Chiếc hộp hình mèo để đựng bông mút vệ sinh hơn\r\n\r\n- Chất bông xốp mịn, độ đàn hồi, co giãn tốt\r\n\r\n- Có thể dùng che phủ đến những vùng khó tán đều kem nền như cánh mùi, hốc mắt', 60, 0, 79000, 110000, 1, 4, 1, '2022-10-13 00:16:05', '2022-10-13 00:16:05', NULL, NULL),
(15, 'Bấm Mi Youse High End Beauty Tool', '- Bấm mi Youse High-End Beauty Tool Eyelash Curler với thiết kế tay cầm đuôi cá độc đáo cũng màu sắc nhẹ nhàng bắt mắt.\r\n\r\n- Phần kẹp mi có độ cong bầu nhẹ, phù hợp với đường cong mắt của người Châu Á', 500, 0, 15000, 32000, 1, 4, 1, '2022-10-13 00:18:35', '2022-10-13 00:18:35', NULL, NULL),
(16, 'BỘ CỌ TRANG ĐIỂM 7 MÓN dụng cụ makeup', 'Mô tả sản phẩm BỘ CỌ TRANG ĐIỂM CÁ NHÂN 7 MÓN Dụng cụ trang điểm giá rẻ Đồ nghề makeup Combo make up Make-up tools Cọ phấn mặt Cọ phấn má hồng Đồ trang điểm teen Bộ trang điểm nhỏ gọn tiện lợi Chổi đánh phấn\r\nSet gồm 7 cây cọ: cọ má hồng, cọ kem nền, cọ tán phấn mắt vừa và nhỏ, cọ vẽ son môi, cọ kẻ viền mắt (hoặc vẽ bột mày), cọ mút tán phấn mắt (hoặc phủ nhũ kim tuyến)\r\nKích thước hộp: 6x14.5x3cm', 90, 0, 50000, 101000, 1, 4, 1, '2022-10-13 00:21:37', '2022-10-13 00:21:37', NULL, NULL),
(17, 'Dao Cạo Chân Mày Dream Kiss Eyebrow Razor', '+ Điều chỉnh lông mày \r\n\r\n+ Dễ linh hoạt khi thao tác\r\n\r\n+ Thiết kế nhỏ gọn, vừa tay', 500, 0, 24000, 54000, 1, 4, 1, '2022-10-13 00:23:42', '2022-10-13 00:23:42', NULL, NULL),
(18, 'Bông Tẩy Trang Gấu Vịt Thỏ Silubi Line Friends', '- Chất bông sạch sẽ, mịn màng\r\n\r\n- Chứa thành phần từ bông cotton nguyên chất\r\n\r\n- Nhẹ nhàng lướt nhẹ trên da không gây trầy xước\r\n\r\n- Bao bì bộ 3 Gấu Vịt Thỏ Line Friends xinh xắn', 500, 0, 27000, 47000, 1, 4, 1, '2022-10-13 00:25:57', '2022-10-13 00:25:57', NULL, NULL),
(19, 'Bộ Chiết Mỹ Phẩm Sakura Hồng 7 Món', '- Bộ chiết mỹ phẩm bao gồm 7 món \r\n\r\n- Tiện lợi cho việc du lịch\r\n\r\n- Không mất quá nhiều diện tích khi di chuyển', 300, 0, 15000, 40000, 1, 4, 1, '2022-10-13 00:28:09', '2022-10-13 00:28:09', NULL, NULL),
(20, 'Sơn Móng 3 Concept Eyes', 'Sơn móng 3CE Eyes Nail Lacquer trơn, không nhũ, nước sơn trong & bền màu, nhiều tone màu hiện đại, trẻ trung. Lên màu chuẩn không làm khô gãy móng, với thành phần cao cấp không làm vàng móng, giòn móng..\r\n-Những bộ móng của bạn sẽ thật sự tuyệt vời với màu sắc đa dạng và chất sơn cực đẹp của Sơn móng 3CE\r\n\r\n- Dưỡng móng rất tốt, tôn lên nét đẹp của đôi bàn tay của nữ giới\r\n\r\n- Ngoài các hạt màu rất đẹp, sơn móng 3CE còn chứa dưỡng chất bảo vệ, giúp móng không bị ố vàng', 100, 0, 70000, 110000, 1, 4, 0, '2022-10-13 00:31:45', '2022-10-13 00:31:45', NULL, NULL),
(21, 'Sơn Móng Innisfree Real Color Nail Winter', '-Với thiết kế đầu chổi đặc biệt từ lông Du Pont giúp sơn không bị vón cục, lên màu đều.\r\n\r\n-Chứa thành phần từ quýt Cheju (quýt nổi tiếng nhất của Hàn Quốc) cung cấp dinh dưỡng và vitamin cho móng, giúp móng không bị biến màu.\r\n\r\n-Với bảng màu vô cùng đa dạng cho các nàng thoải mái lựa chọn, cải tiến đầu cọ bản to dễ dùng hơn, chất sơn mịn và bền hơn nhiều.\r\n\r\n- Thích hợp cho mọi loại da!', 50, 0, 20000, 55000, 1, 4, 1, '2022-10-13 02:04:58', '2022-10-13 02:04:58', NULL, NULL),
(22, 'Xịt Thơm Victoria\'s Secret Fragrance Mist 250ml', '- Hương thơm đa dạng, ngọt ngào, quyến rũ.\r\n\r\n- Lưu hương suốt nhiều giờ.\r\n\r\n- Thiết kế sang trọng, bắt mắt.', 100, 0, 250000, 320000, 1, 5, 1, '2022-10-13 02:07:46', '2022-10-13 02:07:46', NULL, NULL),
(23, 'Nước Hoa Suddenly Mamade Glamour Eau De Parfum', '- Hương thơm dai, bền mùi, không gắt\r\n\r\n- Mùi hương nhẹ tạo cảm giác rất dễ chịu\r\n\r\n- Nữ tính, dịu dàng nhưng cũng đầy quyến rũ', 100, 0, 130000, 180000, 1, 5, 0, '2022-10-13 02:11:46', '2022-10-13 02:11:46', NULL, NULL),
(24, 'Nước Hoa Nam BVLGARI', NULL, 30, 0, 205000, 250000, 1, 5, 0, '2022-10-13 02:14:28', '2022-10-13 02:14:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ratings`
--

INSERT INTO `ratings` (`id`, `rating`, `product_id`, `user_id`) VALUES
(1, 3, 3, 6),
(2, 5, 3, 6),
(3, 2, 3, 6),
(4, 4, 3, 6),
(5, 3, 3, 6),
(6, 2, 3, 6),
(7, 4, 1, 6),
(8, 3, 8, 6),
(9, 1, 8, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('V5xAcSmsVOiGndPG06QZgrOuptfC2darAIFOwsUG', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoidmZ6QU1LZWdHWmJoSXk0OTFDVWxhc2hyc2pUWXFOQmtYaEZXQ3BDWiI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRTek5ia1p0SjVhQU56c01vT3haRThPZlQudnZyZEl4ZEgucVd4WC56VHJCcVpMU2FmaDlqeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jb21tZW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1670581370);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trademarks`
--

CREATE TABLE `trademarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `trademarks`
--

INSERT INTO `trademarks` (`id`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`, `image`) VALUES
(1, 'biorema', 'biorema-slug', '2022-11-08 06:23:29', '2022-11-25 02:20:47', '2022-11-25 02:20:47', NULL),
(2, 'nga', 'nga-sluggggg', '2022-11-08 06:24:52', '2022-11-21 06:47:19', '2022-11-21 06:47:19', NULL),
(3, 'abc', 'abc-bcd', '2022-11-21 06:50:39', '2022-11-25 02:20:41', '2022-11-25 02:20:41', NULL),
(4, 'abcn', 'bnbn', '2022-11-21 06:59:13', '2022-11-25 02:20:35', '2022-11-25 02:20:35', NULL),
(5, 'nnnnn', 'nnnnn', '2022-11-21 06:59:53', '2022-11-25 02:20:30', '2022-11-25 02:20:30', NULL),
(6, '3CE', '3ce-thuog-hieu-my-pham', '2022-11-21 07:01:48', '2022-11-25 02:27:29', NULL, 'images/4FnJDR42vVzH969HClsQq9DfFdXkrriksQ7RJxLO.jpg'),
(7, 'Thương hiệu Innisfree', 'innisfree-thuong-hieu-my-pham-han-quoc', '2022-11-25 02:34:02', '2022-11-25 02:34:02', NULL, 'images/pJzvmLCYClRLgC3ZmGYSLOdkvNkVKAb2d93yvAXh.jpg'),
(8, 'THE FACE SHOP', 'the-face-shop-my-pham', '2022-11-25 02:36:39', '2022-11-25 02:36:39', NULL, 'images/X3qFTgYmn26SDYvEOCOXtFb8l2uYoONyefrlT4FP.jpg'),
(9, 'Thương hiệu Biorema', 'biore-my-pham-chinh-hang', '2022-11-25 02:39:05', '2022-11-25 02:39:05', NULL, 'images/76pZg7APCd4VT6x1lNPnDneK5JBIstWR9v5qLB8W.jpg'),
(10, 'Thương hiệu Simple', 'thuong-hieu-simple-hang-chinh-hang', '2022-11-25 02:40:35', '2022-11-25 02:40:35', NULL, 'images/o0k62S1rcE3m9WZ9rbVWmALRzPzsjAFuUr8iMxrE.jpg'),
(11, 'Thương hiệu L\'oréal', 'loreal-thuong-hieu-toan-the-gioi', '2022-11-25 02:43:57', '2022-11-25 02:43:57', NULL, 'images/IOhthjQKIX7vIeLwPyHuzGdOs3SIhHLSE1j5nqwy.png'),
(12, 'May Be Line', 'may-be-line-my-pham', '2022-11-25 02:46:29', '2022-11-25 02:46:29', NULL, 'images/YDC5g618n5oLyrvtIsDOLtJUFLSTz9RLL2fXsb14.jpg'),
(13, 'Thương hiệu Chanel', 'chanel-hang-xach-tay-noc-hoa', '2022-11-25 02:54:16', '2022-11-25 02:54:16', NULL, 'images/mO9k9e2nbiW8RIfPjwGMonb23ChRprshv00SgM5t.png'),
(14, 'Thương hiệu  Elysium', 'elysium-nuoc-hoa-nam', '2022-11-25 02:59:25', '2022-11-25 02:59:25', NULL, 'images/yyy7BjwPcMTSHWGOWvt5tbyRwytS6xNVjYqzEs9L.jpg'),
(15, 'Thương hiệu D&G', 'D-G-nuoc-hoa-nam', '2022-11-25 03:05:25', '2022-11-25 03:05:25', NULL, 'images/UgPW6SZjEcMFs0WjLFlI3odgbIQsGfHZfLbri0Sw.jpg'),
(16, 'Thương hiệu DIOR JADORE PARFUME D\'EAU', 'thuong-hieu-DIOR-JADORE-PARFUME-D\'EAU', '2022-11-25 03:08:08', '2022-11-25 03:08:08', NULL, 'images/b8bkngAiHDYjdDdfkl3ra4uRwzYoQmYrakOvgpq2.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `status`, `email_verified_at`, `password`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'Ha Noi', '0961130648', 1, NULL, '$2y$10$TQq4Il6eA4uGM2QC5BJJn.tBWRmZ1FT9AWR8Nkl/4UJ.z0KBbcm/K', NULL, NULL, NULL, '2022-10-12 22:40:39', '2022-10-12 22:40:39', NULL),
(2, 'Nguyễn Văn Nam', 'nvnam@gmailcom', 'Nam Định', '0349719563', 1, NULL, '123456', NULL, NULL, NULL, '2022-10-12 22:49:06', '2022-10-13 00:37:32', NULL),
(3, 'Nguyễn Thị Hằng Nga', 'nthnga0703@gmail.com', 'Hà Nội', '0349719563', 1, NULL, '$2y$10$xVNTHzrpcpsgY33MpJtTOe7jNL1A1sbRW/rzCoFifeVf1Xp5/RwBi', NULL, NULL, NULL, '2022-10-13 00:37:19', '2022-12-09 03:03:17', NULL),
(5, 'Trần Hoàng Oanh', 'tho@gmail.com', 'Quảng Bình', '0951285378', 1, NULL, '1234567890', NULL, NULL, NULL, '2022-11-25 03:09:41', '2022-11-25 03:09:41', NULL),
(6, 'Vũ Viết Duyến', 'vvd@gmail.com', 'Nam Định', '0931762964', 1, NULL, '123456', NULL, NULL, NULL, '2022-11-25 03:10:39', '2022-11-25 03:10:58', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `customers_email_unique` (`email`) USING BTREE;

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING BTREE;

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`) USING BTREE;

--
-- Chỉ mục cho bảng `payment_vnpay`
--
ALTER TABLE `payment_vnpay`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`) USING BTREE,
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`) USING BTREE;

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `sessions_user_id_index` (`user_id`) USING BTREE,
  ADD KEY `sessions_last_activity_index` (`last_activity`) USING BTREE;

--
-- Chỉ mục cho bảng `trademarks`
--
ALTER TABLE `trademarks`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `payment_vnpay`
--
ALTER TABLE `payment_vnpay`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `trademarks`
--
ALTER TABLE `trademarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
