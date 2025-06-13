/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : 127.0.0.1:3306
 Source Schema         : cosmetic_shop

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 28/11/2022 18:19:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_id` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (11, 'Trang điểm', 'Đẹp và rạng ngời', 'https://picsum.photos/200/300', 1, NULL, '2022-10-13 05:53:59', '2022-10-13 06:01:18');
INSERT INTO `categories` VALUES (12, 'Chăm sóc da', 'Da sáng rạng ngời', 'https://picsum.photos/200/300', 1, NULL, '2022-10-13 06:03:24', '2022-10-13 06:03:24');
INSERT INTO `categories` VALUES (13, 'Chăm sóc tóc', 'Mềm mượt óng ả', 'https://picsum.photos/200/300', 1, NULL, '2022-10-13 06:04:42', '2022-10-13 06:04:42');
INSERT INTO `categories` VALUES (14, 'Phụ kiện làm đẹp', 'Lan tỏa sắc đẹp', 'https://picsum.photos/200/300', 1, NULL, '2022-10-13 06:06:43', '2022-10-25 08:59:03');
INSERT INTO `categories` VALUES (15, 'Nước hoa', 'Hương thơm lâu quyến rũ', 'https://picsum.photos/200/300', 1, NULL, '2022-10-13 06:07:27', '2022-10-14 05:29:33');
INSERT INTO `categories` VALUES (16, 'Chăm sóc toàn thân', 'Mềm mại tự tin', 'https://picsum.photos/200/300', 1, NULL, '2022-10-13 06:09:06', '2022-10-13 06:09:06');
INSERT INTO `categories` VALUES (17, 'Khuyến mại', 'Ưu đãi các sản phẩm', 'https://picsum.photos/200/300', 1, NULL, '2022-10-13 06:10:36', '2022-10-13 06:10:36');
INSERT INTO `categories` VALUES (18, 'Thương hiệu', 'Tin tưởng lựa chọn', 'https://picsum.photos/200/300', 1, NULL, '2022-10-13 06:12:42', '2022-10-13 06:12:42');
INSERT INTO `categories` VALUES (19, 'mbm', 'mchg', 'https://picsum.photos/200/300', 1, '2022-11-08 13:32:33', '2022-11-08 13:32:25', '2022-11-08 13:32:33');
INSERT INTO `categories` VALUES (20, ',snm', ',sa;', 'https://picsum.photos/200/300', 1, '2022-11-27 07:07:36', '2022-11-27 07:06:40', '2022-11-27 07:07:36');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------

-- ----------------------------
-- Table structure for coupons
-- ----------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coupon_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `coupon_times` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `coupon_condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `coupon_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coupons
-- ----------------------------
INSERT INTO `coupons` VALUES (1, NULL, NULL, 'Giảm mạnh', 'HGOJIFDGM', '50', NULL, '10', NULL);
INSERT INTO `coupons` VALUES (2, NULL, NULL, 'áb', 'khsq', 'skj', NULL, 'shbsq', NULL);
INSERT INTO `coupons` VALUES (3, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL);
INSERT INTO `coupons` VALUES (4, NULL, NULL, 'msns', 'mlkq', 's k', '1', '10', NULL);
INSERT INTO `coupons` VALUES (5, NULL, NULL, 'a', 'A', '1', '1', '50', NULL);
INSERT INTO `coupons` VALUES (6, NULL, NULL, 'a', 'a', 'a', '2', 's', NULL);
INSERT INTO `coupons` VALUES (7, NULL, NULL, 'Giảm mạnh', 'HGOJIFDGM', '50', '2', '30000', NULL);
INSERT INTO `coupons` VALUES (8, NULL, NULL, '30/4', 'HGOJIFDGM', '15', '2', '120000', NULL);
INSERT INTO `coupons` VALUES (9, NULL, NULL, ',dưhd', 'qưdqdwd', '3', '1', '50', NULL);
INSERT INTO `coupons` VALUES (10, NULL, NULL, 'nj,b', 'khsq', '15', '2', '30000', NULL);

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `gender` int NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `current_team_id` bigint UNSIGNED NULL DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `customers_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'Trần Thị Hạnh', 'hanh@gmail.com', '$2y$10$FLxsCp7FKFuLYtwz5troeeN5vt33Nrb5JtMHDzynzMY9rA1.c9cYG', '0124356789', 'Bình Lục - Hà Nam', 1, 1, NULL, NULL, NULL, NULL, '2022-10-13 07:41:03', '2022-10-13 07:41:03', NULL);
INSERT INTO `customers` VALUES (2, 'Đinh Văn Nam', 'dvnam@gmail.com', '$2y$10$s9nkNPMfaX/F/kGdtl5T4eRZcHedttvcAYUm3qT/b6eovwLM9CEQy', '0315682933', 'Quảng Nam', 0, 1, NULL, NULL, NULL, NULL, '2022-10-14 05:43:30', '2022-10-14 05:43:30', NULL);
INSERT INTO `customers` VALUES (3, 'Đinh Lan Anh', 'lananh@gmail.com', '$2y$10$Zy7RF039Wlob7TPK6LjDfuREpibMyys5QtLAd9z1J9w4tTAMFL5o.', '097865127', 'Nga Sơn - Thanh Hóa', 1, 0, NULL, NULL, NULL, NULL, '2022-10-23 14:14:09', '2022-11-25 10:08:36', NULL);
INSERT INTO `customers` VALUES (4, 'Trần Thị Lan Anh', 'ttla@gmail.com', '$2y$10$pGAhJa6lQg9eBlG55J4Jpe8EOVfU/7B/NthSwYQB0cno1TBYXzgkm', '0869841274', 'Hải Phòng', 1, 1, NULL, NULL, NULL, NULL, '2022-10-28 07:09:09', '2022-10-28 07:09:09', NULL);
INSERT INTO `customers` VALUES (5, 'Nguyễn Thị Hằng Nga', 'nthnga0703@gmail.com', '$2y$10$eDID9J3gKhpBhCvOvahSd.sAL9zhFh3GPCBMLgZF/FxqqKWz5yI1G', '0349719563', 'Xuân Trường - Nam Định', 1, 1, NULL, NULL, NULL, NULL, '2022-11-24 13:15:45', '2022-11-24 13:15:45', NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `connection` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `queue` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO `images` VALUES (1, 'kemchem1.jpg', 'images/products/kemchem1.jpg', 1, '2022-10-13 06:19:12', '2022-10-13 06:19:12');
INSERT INTO `images` VALUES (2, 'phannuoc1.jpg', 'images/products/phannuoc1.jpg', 2, '2022-10-13 06:24:26', '2022-10-13 06:24:26');
INSERT INTO `images` VALUES (3, 'lột mụn đầu đen.jpg', 'images/products/lột mụn đầu đen.jpg', 3, '2022-10-13 06:43:32', '2022-10-13 06:43:32');
INSERT INTO `images` VALUES (4, 'cera.jpg', 'images/products/cera.jpg', 4, '2022-10-13 06:46:04', '2022-10-13 06:46:04');
INSERT INTO `images` VALUES (5, 'caphetdc.jpg', 'images/products/caphetdc.jpg', 5, '2022-10-13 06:48:03', '2022-10-13 06:48:03');
INSERT INTO `images` VALUES (6, 'simple.jpeg', 'images/products/simple.jpeg', 6, '2022-10-13 06:51:37', '2022-10-13 06:51:37');
INSERT INTO `images` VALUES (7, 'bioreduong.jpg', 'images/products/bioreduong.jpg', 7, '2022-10-13 06:53:37', '2022-10-13 06:53:37');
INSERT INTO `images` VALUES (8, 'innistoner.jpg', 'images/products/innistoner.jpg', 8, '2022-10-13 06:55:46', '2022-10-13 06:55:46');
INSERT INTO `images` VALUES (9, 'duongtoc.jpg', 'images/products/duongtoc.jpg', 9, '2022-10-13 06:58:21', '2022-10-13 06:58:21');
INSERT INTO `images` VALUES (10, 'bedhead.png', 'images/products/bedhead.png', 10, '2022-10-13 07:00:24', '2022-10-13 07:00:24');
INSERT INTO `images` VALUES (11, 'cocoon.jpg', 'images/products/cocoon.jpg', 11, '2022-10-13 07:04:38', '2022-10-13 07:04:38');
INSERT INTO `images` VALUES (12, 'daukho.jpg', 'images/products/daukho.jpg', 12, '2022-10-13 07:12:16', '2022-10-13 07:12:16');
INSERT INTO `images` VALUES (13, 'nentg.jpg', 'images/products/nentg.jpg', 13, '2022-10-13 07:14:25', '2022-10-13 07:14:25');
INSERT INTO `images` VALUES (14, 'bongmut.jpg', 'images/products/bongmut.jpg', 14, '2022-10-13 07:16:05', '2022-10-13 07:16:05');
INSERT INTO `images` VALUES (15, 'bammi.jpg', 'images/products/bammi.jpg', 15, '2022-10-13 07:18:35', '2022-10-13 07:18:35');
INSERT INTO `images` VALUES (16, 'cọ trang điểm.jpg', 'images/products/cọ trang điểm.jpg', 16, '2022-10-13 07:21:37', '2022-10-13 07:21:37');
INSERT INTO `images` VALUES (17, 'colongmay.png', 'images/products/colongmay.png', 17, '2022-10-13 07:23:42', '2022-10-13 07:23:42');
INSERT INTO `images` VALUES (18, 'cstt.png', 'images/products/cstt.png', 17, '2022-10-13 07:23:42', '2022-10-13 07:23:42');
INSERT INTO `images` VALUES (19, 'taytrang.jpg', 'images/products/taytrang.jpg', 18, '2022-10-13 07:25:57', '2022-10-13 07:25:57');
INSERT INTO `images` VALUES (20, 'taytrang2.jpg', 'images/products/taytrang2.jpg', 18, '2022-10-13 07:25:57', '2022-10-13 07:25:57');
INSERT INTO `images` VALUES (21, 'chailo.jpg', 'images/products/chailo.jpg', 19, '2022-10-13 07:28:09', '2022-10-13 07:28:09');
INSERT INTO `images` VALUES (22, 'chailo2.jpg', 'images/products/chailo2.jpg', 19, '2022-10-13 07:28:09', '2022-10-13 07:28:09');
INSERT INTO `images` VALUES (23, 'chailo3.jpg', 'images/products/chailo3.jpg', 19, '2022-10-13 07:28:09', '2022-10-13 07:28:09');
INSERT INTO `images` VALUES (24, 'sonmongtay.jpg', 'images/products/sonmongtay.jpg', 20, '2022-10-13 07:31:45', '2022-10-13 07:31:45');
INSERT INTO `images` VALUES (25, 'soninnis.jpg', 'images/products/soninnis.jpg', 21, '2022-10-13 09:04:59', '2022-10-13 09:04:59');
INSERT INTO `images` VALUES (26, 'nuôcanu.jpg', 'images/products/nuôcanu.jpg', 22, '2022-10-13 09:07:46', '2022-10-13 09:07:46');
INSERT INTO `images` VALUES (27, 'nuochoa.png', 'images/products/nuochoa.png', 22, '2022-10-13 09:07:46', '2022-10-13 09:07:46');
INSERT INTO `images` VALUES (28, 'uochoa3.png', 'images/products/uochoa3.png', 22, '2022-10-13 09:07:46', '2022-10-13 09:07:46');
INSERT INTO `images` VALUES (29, 'nuochoa3.jpg', 'images/products/nuochoa3.jpg', 23, '2022-10-13 09:11:46', '2022-10-13 09:11:46');
INSERT INTO `images` VALUES (30, 'nuochoanam.jpg', 'images/products/nuochoanam.jpg', 24, '2022-10-13 09:14:28', '2022-10-13 09:14:28');
INSERT INTO `images` VALUES (31, 'nuochoanam2.jpg', 'images/products/nuochoanam2.jpg', 24, '2022-10-13 09:14:28', '2022-10-13 09:14:28');
INSERT INTO `images` VALUES (32, 'nuochoanam3.jpeg', 'images/products/nuochoanam3.jpeg', 24, '2022-10-13 09:14:28', '2022-10-13 09:14:28');
INSERT INTO `images` VALUES (33, 'xị3.jpg', 'images/products/xị3.jpg', 25, '2022-10-13 09:18:51', '2022-10-13 09:18:51');
INSERT INTO `images` VALUES (34, 'xit1.jpg', 'images/products/xit1.jpg', 25, '2022-10-13 09:18:51', '2022-10-13 09:18:51');
INSERT INTO `images` VALUES (35, 'xit2.jpg', 'images/products/xit2.jpg', 25, '2022-10-13 09:18:51', '2022-10-13 09:18:51');
INSERT INTO `images` VALUES (36, 'xị3.jpg', 'images/products/xị3.jpg', 26, '2022-10-13 09:19:51', '2022-10-13 09:19:51');
INSERT INTO `images` VALUES (37, 'xit1.jpg', 'images/products/xit1.jpg', 26, '2022-10-13 09:19:51', '2022-10-13 09:19:51');
INSERT INTO `images` VALUES (38, 'xit2.jpg', 'images/products/xit2.jpg', 26, '2022-10-13 09:19:51', '2022-10-13 09:19:51');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_10_09_122125_create_products_table', 1);
INSERT INTO `migrations` VALUES (7, '2022_10_09_122743_create_customers_table', 1);
INSERT INTO `migrations` VALUES (8, '2022_10_09_123024_create_categories_table', 1);
INSERT INTO `migrations` VALUES (9, '2022_10_09_123036_create_orders_table', 1);
INSERT INTO `migrations` VALUES (10, '2022_10_09_123051_create_order_products_table', 1);
INSERT INTO `migrations` VALUES (11, '2022_10_09_124700_create_images_table', 1);
INSERT INTO `migrations` VALUES (12, '2022_10_10_061828_create_sessions_table', 1);
INSERT INTO `migrations` VALUES (14, '2014_10_12_000000_create_users_table', 2);
INSERT INTO `migrations` VALUES (15, '2022_10_11_181021_create_payment_vnpay_table', 3);
INSERT INTO `migrations` VALUES (16, '2022_10_13_141747_create_comments_table', 3);
INSERT INTO `migrations` VALUES (17, '2022_11_07_141206_create_trademarks_table', 4);
INSERT INTO `migrations` VALUES (18, '2022_11_21_134242_add_trademark_id_to_products_table', 5);
INSERT INTO `migrations` VALUES (19, '2022_11_21_135728_add_image_to_trademarks_table', 6);
INSERT INTO `migrations` VALUES (20, '2022_11_24_134422_create_contact_table', 7);
INSERT INTO `migrations` VALUES (21, '2022_11_27_033906_create_coupons_table', 7);

-- ----------------------------
-- Table structure for order_products
-- ----------------------------
DROP TABLE IF EXISTS `order_products`;
CREATE TABLE `order_products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `product_category` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `product_quantity` int NULL DEFAULT NULL,
  `product_origin_price` int NULL DEFAULT NULL,
  `product_sale_price` int NULL DEFAULT NULL,
  `total` int NULL DEFAULT NULL,
  `order_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_products
-- ----------------------------
INSERT INTO `order_products` VALUES (1, 'Sơn Móng 3 Concept Eyes', 'Phụ kiện làm đẹp', 1, 70000, 110000, 110000, 1, 20, '2022-10-13 07:42:42', '2022-10-13 07:42:42');
INSERT INTO `order_products` VALUES (2, 'Phấn Nước KLAVUU Blue Pearlsation High Coverage', 'Trang điểm', 1, 290000, 350000, 350000, 2, 2, '2022-10-13 14:30:19', '2022-10-13 14:30:19');
INSERT INTO `order_products` VALUES (3, 'Sơn Móng 3 Concept Eyes', 'Phụ kiện làm đẹp', 1, 70000, 110000, 110000, 3, 20, '2022-10-14 05:45:03', '2022-10-14 05:45:03');
INSERT INTO `order_products` VALUES (4, 'Tẩy Da Chết Mặt Cà Phê Đắk Lắk Cocoon Coffee Face Polish 150ml', 'Chăm sóc da', 1, 99000, 131000, 131000, 4, 5, '2022-10-23 14:16:03', '2022-10-23 14:16:03');
INSERT INTO `order_products` VALUES (5, 'Phấn Nước KLAVUU Blue Pearlsation High Coverage', 'Trang điểm', 1, 290000, 350000, 350000, 5, 2, '2022-11-06 01:03:58', '2022-11-06 01:03:58');
INSERT INTO `order_products` VALUES (6, 'Nước Tẩy Trang Simple Kind To Skin', 'Chăm sóc da', 1, 29000, 45000, 45000, 6, 6, '2022-11-27 09:34:19', '2022-11-27 09:34:19');
INSERT INTO `order_products` VALUES (7, 'Sữa Rửa Mặt Cerave Cho Da Thường Đến Da Dầu 355ml', 'Chăm sóc da', 1, 290000, 360000, 360000, 7, 4, '2022-11-27 09:42:32', '2022-11-27 09:42:32');
INSERT INTO `order_products` VALUES (8, 'Sữa Rửa Mặt Cerave Cho Da Thường Đến Da Dầu 355ml', 'Chăm sóc da', 1, 290000, 360000, 360000, 8, 4, '2022-11-27 09:43:23', '2022-11-27 09:43:23');
INSERT INTO `order_products` VALUES (9, 'Miếng Giảm Mụn Đầu Đen Ciracle Goodbye 5ml', 'Chăm sóc da', 1, 5000, 13000, 13000, 9, 3, '2022-11-27 13:45:13', '2022-11-27 13:45:13');
INSERT INTO `order_products` VALUES (10, 'Miếng Giảm Mụn Đầu Đen Ciracle Goodbye 5ml', 'Chăm sóc da', 1, 5000, 13000, 13000, 10, 3, '2022-11-27 14:15:30', '2022-11-27 14:15:30');
INSERT INTO `order_products` VALUES (11, 'Miếng Giảm Mụn Đầu Đen Ciracle Goodbye 5ml', 'Chăm sóc da', 1, 5000, 13000, 13000, 11, 3, '2022-11-27 14:17:50', '2022-11-27 14:17:50');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT 0,
  `update_by` int NOT NULL DEFAULT 0,
  `total` int NULL DEFAULT NULL,
  `customer_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, '0', 5, 0, 110000, 1, 20, NULL, '2022-10-13 07:42:42', '2022-11-25 10:11:39');
INSERT INTO `orders` VALUES (2, '0', 3, 0, 350000, 1, 2, NULL, '2022-10-13 14:30:19', '2022-10-14 13:56:42');
INSERT INTO `orders` VALUES (3, '0', 3, 0, 110000, 2, 20, NULL, '2022-10-14 05:45:03', '2022-10-23 08:25:12');
INSERT INTO `orders` VALUES (4, '0', 1, 0, 131000, 3, 5, 'Mua ngay', '2022-10-23 14:16:03', '2022-11-25 10:11:48');
INSERT INTO `orders` VALUES (5, '0', 5, 0, 350000, 4, 2, NULL, '2022-11-06 01:03:58', '2022-11-25 10:11:31');
INSERT INTO `orders` VALUES (6, '0', 3, 0, 45000, 4, 6, 'okkm', '2022-11-27 09:34:19', '2022-11-27 09:34:31');
INSERT INTO `orders` VALUES (7, '0', 0, 0, 360000, 4, 4, NULL, '2022-11-27 09:42:32', '2022-11-27 09:42:32');
INSERT INTO `orders` VALUES (8, '0', 3, 0, 360000, 4, 4, NULL, '2022-11-27 09:43:23', '2022-11-27 09:43:31');
INSERT INTO `orders` VALUES (9, '0', 3, 0, 13000, 4, 3, NULL, '2022-11-27 13:45:13', '2022-11-27 14:15:51');
INSERT INTO `orders` VALUES (10, '0', 5, 0, 13000, 4, 3, NULL, '2022-11-27 14:15:30', '2022-11-27 14:17:08');
INSERT INTO `orders` VALUES (11, '0', 3, 0, 13000, 4, 3, NULL, '2022-11-27 14:17:50', '2022-11-27 14:19:03');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for payment_vnpay
-- ----------------------------
DROP TABLE IF EXISTS `payment_vnpay`;
CREATE TABLE `payment_vnpay`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `order_id` int NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `money` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `code_bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment_vnpay
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `abilities` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT 0,
  `sold` int NOT NULL DEFAULT 0,
  `origin_price` int NOT NULL DEFAULT 0,
  `sale_price` int NOT NULL DEFAULT 0,
  `user_id` int NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `trademark_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Bảng Che Khuyết Điểm Mangogo Concealer 6gr', 'Bảng che khuyết điểm Mangogo Concealer nhỏ nhắn dễ mang theo\r\n\r\n- Bao gồm 2 tông màu cho da có nhiều hay ít khuyết điểm đều có thể sử dụng được. Chất kem dễ tán không gây vón cục hay bết da Che đi những khuyết điểm tạo lớp da đều màu, không tì vết', 50, 0, 40000, 65000, 1, 1, 1, '2022-10-13 06:19:12', '2022-10-13 06:19:12', NULL, NULL);
INSERT INTO `products` VALUES (2, 'Phấn Nước KLAVUU Blue Pearlsation High Coverage', 'Phấn nước che phủ cực tốt những khuyết điểm trên khuôn mặt còn cung cấp độ ẩm, làm sáng da. Với chiết xuất từ ngọc trai và rong biển, tảo biển chứa nhiều vitamin và collagen ngăn sự sự lão hoá cho da. Bảo vệ da khỏi ánh nắng mặt trời nhờ SPF 50 / PA +++', 30, 0, 290000, 350000, 1, 1, 0, '2022-10-13 06:24:26', '2022-10-13 06:24:26', NULL, NULL);
INSERT INTO `products` VALUES (3, 'Miếng Giảm Mụn Đầu Đen Ciracle Goodbye 5ml', 'Miếng Giảm Mụn Đầu Đen Ciracle Goodbye Blackhead thật sự là phương pháp giảm mụn đầu đen và mụn cám rất hiệu quả.\r\n\r\n- Giải quyết được 80-90% vấn đề mụn đầu đen trên mũi.\r\n\r\n- Dưỡng ấm cho vùng da sau khi sử dụng tốt, kiểu bóng bóng như mũi sao Hàn.\r\n\r\n- Không gây tổn hại đến bề mặt da nhờ cơ chế serum thấm vào các lỗ chân lông.', 100, 0, 5000, 13000, 1, 2, 1, '2022-10-13 06:43:32', '2022-10-13 06:43:32', NULL, NULL);
INSERT INTO `products` VALUES (4, 'Sữa Rửa Mặt Cerave Cho Da Thường Đến Da Dầu 355ml', 'Sữa rửa mặt CeraVe dòng màu xanh dành cho da thường đến da dầu\r\n\r\n- Dung tích 355ml thoải mái sử dụng\r\n\r\n- Sản phẩm thiết kế dạng ống bơm tiện lợi, sạch sẽ\r\n\r\n- Khả năng tạo bọt nhẹ, làm sạch không khô căng da\r\n\r\n- Sản phẩm lành tính, không màu và không chất tạo mùi', 50, 0, 290000, 360000, 1, 2, 1, '2022-10-13 06:46:04', '2022-10-13 06:46:04', NULL, NULL);
INSERT INTO `products` VALUES (5, 'Tẩy Da Chết Mặt Cà Phê Đắk Lắk Cocoon Coffee Face Polish 150ml', 'Những hạt cà phê Đắk Lắk xay nhuyễn giàu cafeine hòa quyện với bơ cacao Tiền Giang giúp bạn loại bỏ lớp tế bào chết già cỗi và xỉn màu, đánh thức làn da tươi mới đầy năng lượng cùng cảm giác mượt mà và mềm mịn lan tỏa', 30, 0, 99000, 131000, 1, 2, 2, '2022-10-13 06:48:03', '2022-10-13 06:48:03', NULL, NULL);
INSERT INTO `products` VALUES (6, 'Nước Tẩy Trang Simple Kind To Skin', 'Nước tẩy trang Simple Micellar Water với hàng triệu bong bóng thông minh giúp loại bỏ bụi bẩn và làm sạch lớp trang điểm hiệu quả, giữ ẩm cho da lên đến 4 giờ', 300, 0, 29000, 45000, 1, 2, 1, '2022-10-13 06:51:37', '2022-10-13 06:51:37', NULL, NULL);
INSERT INTO `products` VALUES (7, 'Kem Dưỡng Bioderma Cicabio Soothing Repairing Cream 40ml', '- Khôi phục lớp biểu bì\r\n\r\n- Làm giảm cảm giác ngứa và khó chịu\r\n\r\n- Dưỡng ẩm, thanh lọc da\r\n\r\n- Tạo một lớp màng thoáng khí bảo vệ da tối ưu và thoải mái', 200, 0, 20000, 280000, 1, 2, 1, '2022-10-13 06:53:37', '2022-10-13 06:53:37', NULL, NULL);
INSERT INTO `products` VALUES (8, 'Nước Cân Bằng Innisfree Bija Trouble Skin', '-Nước Hoa Hồng Innisfree Bija Trouble Skin chuyên dùng cho da dầu, da bị mụn hay có vấn đề về da.\r\n\r\n- Chăm sóc điều trị mụn hiệu quả, cân bằng độ pH trên da, se khít lỗ chân lông.\r\n\r\n- Chăm sóc vùng da bị hư tổn do mụn và có tác dụng tẩy tế bào chết nhẹ nhàng cho da.\r\n\r\n- Giúp thông thoáng lỗ chân lông, ngăn ngừa phát sinh mụn, không gây kích ứng da.', 150, 0, 240000, 315000, 1, 2, 1, '2022-10-13 06:55:46', '2022-10-13 06:55:46', NULL, NULL);
INSERT INTO `products` VALUES (9, 'Dưỡng Tóc Ogx Renewing-Argan Oil Of Morocco', '- Chiết xuất từ tinh dầu Argan có tác dụng dưỡng ẩm và giữ ẩm cho tóc cực hiệu quả\r\n\r\n- Thấm sâu và nuôi dưỡng từ bên trong, phục hồi tóc hư tổn gãy rụng\r\n\r\n- Cung cấp dưỡng chất giúp nuôi dưỡng tóc dày bóng mượt tự nhiên\r\n\r\n- Hương thơm dịu nhẹ dễ chịu, mang lại cảm giác thư thái thoải mái cho người dùng', 50, 0, 145000, 195000, 1, 3, 2, '2022-10-13 06:58:21', '2022-10-13 06:58:21', NULL, NULL);
INSERT INTO `products` VALUES (10, 'Bộ Gội - Xả TIGI Resurrection', '- Tái sinh mái tóc mới, phục hồi tóc hư tổn trả lại cho bạn mái tóc mềm mại\r\n\r\n- Cải thiện tình trạng xơ rối giúp tóc vào nếp, gọn gàng hơn\r\n\r\n- Lớp màng nano siêu nhỏ làm lớp chắn bảo vệ và tăng cường sức đề kháng cho tóc.', 70, 0, 450000, 530000, 1, 3, 1, '2022-10-13 07:00:24', '2022-10-13 07:00:24', NULL, NULL);
INSERT INTO `products` VALUES (11, 'Nước Dưỡng Tóc Sa-Chi Cocoon Inca Inchi Hair Tonic 140ml', '- Cải thiện độ chắc khoẻ và tăng cường độ bóng của tóc.\r\n\r\n- Bảo vệ tóc khỏi các tác nhân gây hại từ hóa chất và môi trường. \r\n\r\n- Loại bỏ lớp tế bào da chết tích tụ trên da đầu, bụi bẩn bám trên sợi tóc', 30, 0, 80000, 131000, 1, 3, 1, '2022-10-13 07:04:38', '2022-10-13 07:04:38', NULL, NULL);
INSERT INTO `products` VALUES (12, 'Dầu Gội Khô CoLab Dry Shampoo 200ml', '-Loại bỏ bụi bẩn, dầu nhờn ngay tức thì \r\n- Hô biến mái tóc trở nên bồng bềnh, khô ráo \r\n- Làm sạch tóc mà không cần dùng nước \r\n- Khử mùi và làm phồng chân tóc', 100, 0, 110000, 160000, 1, 3, 0, '2022-10-13 07:12:16', '2022-10-13 07:12:16', NULL, NULL);
INSERT INTO `products` VALUES (13, 'Bông Đánh Kem Nền Vacosi Quarter Sponge', '- Khả năng tán kem nền cực tốt\r\n\r\n- Độ dẻo và mềm mịn cao.\r\n\r\n- Thiết kế vừa vặn, dễ cầm và dặm phấn.', 100, 0, 35000, 55000, 1, 4, 1, '2022-10-13 07:14:25', '2022-10-13 07:14:25', NULL, NULL);
INSERT INTO `products` VALUES (14, 'Bông Mút Nee Ni Coo Set Kitten Puff', '- Set bông mút hình giọt nước với bao bì xinh xắn\r\n\r\n- Chiếc hộp hình mèo để đựng bông mút vệ sinh hơn\r\n\r\n- Chất bông xốp mịn, độ đàn hồi, co giãn tốt\r\n\r\n- Có thể dùng che phủ đến những vùng khó tán đều kem nền như cánh mùi, hốc mắt', 60, 0, 79000, 110000, 1, 4, 1, '2022-10-13 07:16:05', '2022-10-13 07:16:05', NULL, NULL);
INSERT INTO `products` VALUES (15, 'Bấm Mi Youse High End Beauty Tool', '- Bấm mi Youse High-End Beauty Tool Eyelash Curler với thiết kế tay cầm đuôi cá độc đáo cũng màu sắc nhẹ nhàng bắt mắt.\r\n\r\n- Phần kẹp mi có độ cong bầu nhẹ, phù hợp với đường cong mắt của người Châu Á', 500, 0, 15000, 32000, 1, 4, 1, '2022-10-13 07:18:35', '2022-10-13 07:18:35', NULL, NULL);
INSERT INTO `products` VALUES (16, 'BỘ CỌ TRANG ĐIỂM 7 MÓN dụng cụ makeup', 'Mô tả sản phẩm BỘ CỌ TRANG ĐIỂM CÁ NHÂN 7 MÓN Dụng cụ trang điểm giá rẻ Đồ nghề makeup Combo make up Make-up tools Cọ phấn mặt Cọ phấn má hồng Đồ trang điểm teen Bộ trang điểm nhỏ gọn tiện lợi Chổi đánh phấn\r\nSet gồm 7 cây cọ: cọ má hồng, cọ kem nền, cọ tán phấn mắt vừa và nhỏ, cọ vẽ son môi, cọ kẻ viền mắt (hoặc vẽ bột mày), cọ mút tán phấn mắt (hoặc phủ nhũ kim tuyến)\r\nKích thước hộp: 6x14.5x3cm', 90, 0, 50000, 101000, 1, 4, 1, '2022-10-13 07:21:37', '2022-10-13 07:21:37', NULL, NULL);
INSERT INTO `products` VALUES (17, 'Dao Cạo Chân Mày Dream Kiss Eyebrow Razor', '+ Điều chỉnh lông mày \r\n\r\n+ Dễ linh hoạt khi thao tác\r\n\r\n+ Thiết kế nhỏ gọn, vừa tay', 500, 0, 24000, 54000, 1, 4, 1, '2022-10-13 07:23:42', '2022-10-13 07:23:42', NULL, NULL);
INSERT INTO `products` VALUES (18, 'Bông Tẩy Trang Gấu Vịt Thỏ Silubi Line Friends', '- Chất bông sạch sẽ, mịn màng\r\n\r\n- Chứa thành phần từ bông cotton nguyên chất\r\n\r\n- Nhẹ nhàng lướt nhẹ trên da không gây trầy xước\r\n\r\n- Bao bì bộ 3 Gấu Vịt Thỏ Line Friends xinh xắn', 500, 0, 27000, 47000, 1, 4, 1, '2022-10-13 07:25:57', '2022-10-13 07:25:57', NULL, NULL);
INSERT INTO `products` VALUES (19, 'Bộ Chiết Mỹ Phẩm Sakura Hồng 7 Món', '- Bộ chiết mỹ phẩm bao gồm 7 món \r\n\r\n- Tiện lợi cho việc du lịch\r\n\r\n- Không mất quá nhiều diện tích khi di chuyển', 300, 0, 15000, 40000, 1, 4, 1, '2022-10-13 07:28:09', '2022-10-13 07:28:09', NULL, NULL);
INSERT INTO `products` VALUES (20, 'Sơn Móng 3 Concept Eyes', 'Sơn móng 3CE Eyes Nail Lacquer trơn, không nhũ, nước sơn trong & bền màu, nhiều tone màu hiện đại, trẻ trung. Lên màu chuẩn không làm khô gãy móng, với thành phần cao cấp không làm vàng móng, giòn móng..\r\n-Những bộ móng của bạn sẽ thật sự tuyệt vời với màu sắc đa dạng và chất sơn cực đẹp của Sơn móng 3CE\r\n\r\n- Dưỡng móng rất tốt, tôn lên nét đẹp của đôi bàn tay của nữ giới\r\n\r\n- Ngoài các hạt màu rất đẹp, sơn móng 3CE còn chứa dưỡng chất bảo vệ, giúp móng không bị ố vàng', 100, 0, 70000, 110000, 1, 4, 0, '2022-10-13 07:31:45', '2022-10-13 07:31:45', NULL, NULL);
INSERT INTO `products` VALUES (21, 'Sơn Móng Innisfree Real Color Nail Winter', '-Với thiết kế đầu chổi đặc biệt từ lông Du Pont giúp sơn không bị vón cục, lên màu đều.\r\n\r\n-Chứa thành phần từ quýt Cheju (quýt nổi tiếng nhất của Hàn Quốc) cung cấp dinh dưỡng và vitamin cho móng, giúp móng không bị biến màu.\r\n\r\n-Với bảng màu vô cùng đa dạng cho các nàng thoải mái lựa chọn, cải tiến đầu cọ bản to dễ dùng hơn, chất sơn mịn và bền hơn nhiều.\r\n\r\n- Thích hợp cho mọi loại da!', 50, 0, 20000, 55000, 1, 4, 1, '2022-10-13 09:04:58', '2022-10-13 09:04:58', NULL, NULL);
INSERT INTO `products` VALUES (22, 'Xịt Thơm Victoria\'s Secret Fragrance Mist 250ml', '- Hương thơm đa dạng, ngọt ngào, quyến rũ.\r\n\r\n- Lưu hương suốt nhiều giờ.\r\n\r\n- Thiết kế sang trọng, bắt mắt.', 100, 0, 250000, 320000, 1, 5, 1, '2022-10-13 09:07:46', '2022-10-13 09:07:46', NULL, NULL);
INSERT INTO `products` VALUES (23, 'Nước Hoa Suddenly Mamade Glamour Eau De Parfum', '- Hương thơm dai, bền mùi, không gắt\r\n\r\n- Mùi hương nhẹ tạo cảm giác rất dễ chịu\r\n\r\n- Nữ tính, dịu dàng nhưng cũng đầy quyến rũ', 100, 0, 130000, 180000, 1, 5, 0, '2022-10-13 09:11:46', '2022-10-13 09:11:46', NULL, NULL);
INSERT INTO `products` VALUES (24, 'Nước Hoa Nam BVLGARI', NULL, 30, 0, 205000, 250000, 1, 5, 0, '2022-10-13 09:14:28', '2022-10-13 09:14:28', NULL, NULL);

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `payload` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('nvVbRBWS3lV8oheKxJpi6ynLUQBIldO8cvqgtVz1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUmdTYnJGUnc4UkdqVW1YRHRWdFdPTk5SS0hKc1FHM1BYSW0wVVpMTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1669559190);
INSERT INTO `sessions` VALUES ('PEGmbKZ5muPtB5FFN82jiuJk29db3yMrMsA6bquJ', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNzRBVUZSU21hNloxOEJmVTFUT0V1M0NTNDBPcmJVWjFkTXlHWlNJViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJHBHQWhKYTZsUWc5ZUJsRzU1SjRKcGU4RU9WZlUvN0IvTnRoU3dZUUIwY25vMVRCWVh6Z2ttIjt9', 1669572311);

-- ----------------------------
-- Table structure for trademarks
-- ----------------------------
DROP TABLE IF EXISTS `trademarks`;
CREATE TABLE `trademarks`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trademarks
-- ----------------------------
INSERT INTO `trademarks` VALUES (1, 'biorema', 'biorema-slug', '2022-11-08 13:23:29', '2022-11-25 09:20:47', '2022-11-25 09:20:47', NULL);
INSERT INTO `trademarks` VALUES (2, 'nga', 'nga-sluggggg', '2022-11-08 13:24:52', '2022-11-21 13:47:19', '2022-11-21 13:47:19', NULL);
INSERT INTO `trademarks` VALUES (3, 'abc', 'abc-bcd', '2022-11-21 13:50:39', '2022-11-25 09:20:41', '2022-11-25 09:20:41', NULL);
INSERT INTO `trademarks` VALUES (4, 'abcn', 'bnbn', '2022-11-21 13:59:13', '2022-11-25 09:20:35', '2022-11-25 09:20:35', NULL);
INSERT INTO `trademarks` VALUES (5, 'nnnnn', 'nnnnn', '2022-11-21 13:59:53', '2022-11-25 09:20:30', '2022-11-25 09:20:30', NULL);
INSERT INTO `trademarks` VALUES (6, '3CE', '3ce-thuog-hieu-my-pham', '2022-11-21 14:01:48', '2022-11-25 09:27:29', NULL, 'images/4FnJDR42vVzH969HClsQq9DfFdXkrriksQ7RJxLO.jpg');
INSERT INTO `trademarks` VALUES (7, 'Thương hiệu Innisfree', 'innisfree-thuong-hieu-my-pham-han-quoc', '2022-11-25 09:34:02', '2022-11-25 09:34:02', NULL, 'images/pJzvmLCYClRLgC3ZmGYSLOdkvNkVKAb2d93yvAXh.jpg');
INSERT INTO `trademarks` VALUES (8, 'THE FACE SHOP', 'the-face-shop-my-pham', '2022-11-25 09:36:39', '2022-11-25 09:36:39', NULL, 'images/X3qFTgYmn26SDYvEOCOXtFb8l2uYoONyefrlT4FP.jpg');
INSERT INTO `trademarks` VALUES (9, 'Thương hiệu Biorema', 'biore-my-pham-chinh-hang', '2022-11-25 09:39:05', '2022-11-25 09:39:05', NULL, 'images/76pZg7APCd4VT6x1lNPnDneK5JBIstWR9v5qLB8W.jpg');
INSERT INTO `trademarks` VALUES (10, 'Thương hiệu Simple', 'thuong-hieu-simple-hang-chinh-hang', '2022-11-25 09:40:35', '2022-11-25 09:40:35', NULL, 'images/o0k62S1rcE3m9WZ9rbVWmALRzPzsjAFuUr8iMxrE.jpg');
INSERT INTO `trademarks` VALUES (11, 'Thương hiệu L\'oréal', 'loreal-thuong-hieu-toan-the-gioi', '2022-11-25 09:43:57', '2022-11-25 09:43:57', NULL, 'images/IOhthjQKIX7vIeLwPyHuzGdOs3SIhHLSE1j5nqwy.png');
INSERT INTO `trademarks` VALUES (12, 'May Be Line', 'may-be-line-my-pham', '2022-11-25 09:46:29', '2022-11-25 09:46:29', NULL, 'images/YDC5g618n5oLyrvtIsDOLtJUFLSTz9RLL2fXsb14.jpg');
INSERT INTO `trademarks` VALUES (13, 'Thương hiệu Chanel', 'chanel-hang-xach-tay-noc-hoa', '2022-11-25 09:54:16', '2022-11-25 09:54:16', NULL, 'images/mO9k9e2nbiW8RIfPjwGMonb23ChRprshv00SgM5t.png');
INSERT INTO `trademarks` VALUES (14, 'Thương hiệu  Elysium', 'elysium-nuoc-hoa-nam', '2022-11-25 09:59:25', '2022-11-25 09:59:25', NULL, 'images/yyy7BjwPcMTSHWGOWvt5tbyRwytS6xNVjYqzEs9L.jpg');
INSERT INTO `trademarks` VALUES (15, 'Thương hiệu D&G', 'D-G-nuoc-hoa-nam', '2022-11-25 10:05:25', '2022-11-25 10:05:25', NULL, 'images/UgPW6SZjEcMFs0WjLFlI3odgbIQsGfHZfLbri0Sw.jpg');
INSERT INTO `trademarks` VALUES (16, 'Thương hiệu DIOR JADORE PARFUME D\'EAU', 'thuong-hieu-DIOR-JADORE-PARFUME-D\'EAU', '2022-11-25 10:08:08', '2022-11-25 10:08:08', NULL, 'images/b8bkngAiHDYjdDdfkl3ra4uRwzYoQmYrakOvgpq2.jpg');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `current_team_id` bigint UNSIGNED NULL DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@gmail.com', 'Ha Noi', '0961130648', 1, NULL, '$2y$10$TQq4Il6eA4uGM2QC5BJJn.tBWRmZ1FT9AWR8Nkl/4UJ.z0KBbcm/K', NULL, NULL, NULL, '2022-10-13 05:40:39', '2022-10-13 05:40:39', NULL);
INSERT INTO `users` VALUES (2, 'Nguyễn Văn Nam', 'nvnam@gmailcom', 'Nam Định', '0349719563', 1, NULL, '123456', NULL, NULL, NULL, '2022-10-13 05:49:06', '2022-10-13 07:37:32', NULL);
INSERT INTO `users` VALUES (3, 'Nguyễn Thị Hằng Nga', 'nthnga0703@gmail.com', 'Hà Nội', '0349719563', 0, NULL, '$2y$10$xVNTHzrpcpsgY33MpJtTOe7jNL1A1sbRW/rzCoFifeVf1Xp5/RwBi', NULL, NULL, NULL, '2022-10-13 07:37:19', '2022-11-08 13:17:36', NULL);
INSERT INTO `users` VALUES (5, 'Trần Hoàng Oanh', 'tho@gmail.com', 'Quảng Bình', '0951285378', 1, NULL, '1234567890', NULL, NULL, NULL, '2022-11-25 10:09:41', '2022-11-25 10:09:41', NULL);
INSERT INTO `users` VALUES (6, 'Vũ Viết Duyến', 'vvd@gmail.com', 'Nam Định', '0931762964', 1, NULL, '123456', NULL, NULL, NULL, '2022-11-25 10:10:39', '2022-11-25 10:10:58', NULL);

SET FOREIGN_KEY_CHECKS = 1;
