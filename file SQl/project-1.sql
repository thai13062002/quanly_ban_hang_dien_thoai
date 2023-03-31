-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th3 22, 2023 lúc 08:29 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `project-1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id`, `name`, `link`, `created_at`, `updated_at`) VALUES
(26, 'Game hay', 'https://lienquan.vn/', '2023-03-22 00:28:04', '2023-03-22 00:28:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(20, 'Apple', '2023-03-19 02:52:25', '2023-03-19 02:52:25'),
(24, 'SamSung', '2023-03-20 18:52:39', '2023-03-20 18:52:39'),
(25, 'Xiaomi', '2023-03-20 18:53:37', '2023-03-20 18:53:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại', 0, '2023-03-16 06:04:30', NULL),
(2, 'Tai nghe', 0, '2023-03-16 06:04:30', NULL),
(15, 'Điện thoại phím', 0, '2023-03-20 18:59:15', '2023-03-20 18:59:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `colors`
--

INSERT INTO `colors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Đỏ', NULL, NULL),
(3, 'Đen', NULL, NULL),
(4, 'Vàng', NULL, NULL),
(5, 'Xanh', NULL, NULL),
(6, 'Tím', NULL, NULL),
(7, 'Bạch kim', NULL, NULL),
(8, 'Trắng', NULL, NULL),
(9, 'Bạc', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `color_product_detail`
--

CREATE TABLE `color_product_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `color_product_detail`
--

INSERT INTO `color_product_detail` (`id`, `product_id`, `color_id`, `quantity`) VALUES
(7, 8, 8, 12),
(9, 10, 6, 15),
(10, 9, 4, 22),
(11, 8, 3, 34),
(12, 11, 9, 10),
(13, 11, 3, 6),
(14, 11, 5, 9),
(15, 12, 8, 90),
(16, 12, 2, 120),
(17, 13, 3, 20),
(18, 13, 6, 12),
(19, 13, 5, 90),
(20, 13, 8, 67),
(21, 14, 6, 21),
(22, 14, 8, 33),
(23, 14, 5, 12),
(24, 14, 3, 56),
(25, 15, 2, 199),
(26, 15, 6, 45),
(27, 15, 5, 22),
(28, 16, 6, 18),
(29, 17, 2, 12),
(30, 16, 9, 123),
(31, 18, 3, 123),
(32, 18, 4, 23),
(33, 18, 8, 11),
(34, 19, 3, 12),
(35, 19, 9, 23),
(36, 19, 5, 22);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `object_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`id`, `object_id`, `path`, `type`, `created_at`, `updated_at`) VALUES
(43, 20, '1679219545_png-clipart-apple-logo-apple-heart-logo.png', 'App\\Models\\Brand', NULL, NULL),
(51, 24, '1679363559_samsung-logo-text-png-1.png', 'App\\Models\\Brand', NULL, NULL),
(52, 25, '1679363617_Xiaomi_logo_(2021-).svg.png', 'App\\Models\\Brand', NULL, NULL),
(62, 12, '1679366622_iphone-14-pro-max-purple-1.jpg', 'App\\Models\\Product', NULL, NULL),
(63, 8, '1679366667_iphone-14-pro-bac-1-2.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(67, 10, '1679366763_iphone-14-pro-max-purple-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(68, 9, '1679367200_iphone-14-pro-vang-1-2 (1).jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(69, 8, '1679367268_iphone-14-pro-den-1-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(70, 13, '1679367495_samsung-galaxy-z-fold-4-512gb-xanh-1.jpg', 'App\\Models\\Product', NULL, NULL),
(71, 11, '1679367528_samsung-galaxy-z-fold-4-512gb-xanh-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(72, 11, '1679367528_samsung-galaxy-z-flod-4-den-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(73, 11, '1679367528_samsung-galaxy-z-fold4-512gb-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(74, 14, '1679367807_iphone-11-trang-1-2-org.jpg', 'App\\Models\\Product', NULL, NULL),
(75, 12, '1679367827_iphone-11-den-1-1-1-org.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(76, 12, '1679367827_iphone-11-trang-1-2-org.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(77, 15, '1679369526_samsung-galaxy-s23-xanh-1.jpg', 'App\\Models\\Product', NULL, NULL),
(78, 13, '1679369559_samsung-galaxy-s23-xanh-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(79, 13, '1679369559_samsung-galaxy-s23-hong-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(80, 13, '1679369559_samsung-galaxy-s23-den-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(81, 14, '1679369653_samsung-galaxy-s23-xanh-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(82, 14, '1679369653_samsung-galaxy-s23-hong-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(83, 14, '1679369653_samsung-galaxy-s23-den-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(84, 16, '1679369804_iphone-14-tim-1-3.jpg', 'App\\Models\\Product', NULL, NULL),
(85, 15, '1679369839_iphone-14-trang-1-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(86, 15, '1679369839_iphone-14-do-1-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(87, 15, '1679369839_iphone-14-tim-1-3.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(88, 16, '1679369890_iphone-14-trang-1-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(89, 16, '1679369890_iphone-14-tim-1-3.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(90, 17, '1679369921_iphone-14-do-1-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(91, 17, '1679370060_iphone-12-pro-max-512gb-bac-1-org.jpg', 'App\\Models\\Product', NULL, NULL),
(92, 18, '1679370079_iphone-12-pro-max-512gb-bac-1-org.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(93, 18, '1679370079_iphone-12-pro-max-512gb-1-org.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(94, 18, '1679370079_iphone-12-pro-max-512gb-xam-1-org.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(95, 18, '1679370212_xiaomi-12t-glr-xanh-1-1.jpg', 'App\\Models\\Product', NULL, NULL),
(96, 19, '1679370235_xiaomi-12t-glr-xanh-1-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(97, 19, '1679370235_xiaomi-12t-glr-den-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(98, 19, '1679370235_xiaomi-12t-bac-glr-1.jpg', 'App\\Models\\ProductDetail', NULL, NULL),
(107, 26, '1679470084_banner-lien-quan-voi-khung-rank-min5d3296d3cce80_68b2aa69df0473f5d1e8c2b0f398e72d.jpg', 'App\\Models\\Banner', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2014_10_12_000000_create_users_table', 1),
(16, '2014_10_12_100000_create_password_resets_table', 1),
(17, '2019_08_19_000000_create_failed_jobs_table', 1),
(18, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(19, '2023_03_14_025654_create_categories_table', 1),
(20, '2023_03_14_030744_create_table_brands_table', 1),
(21, '2023_03_14_030818_create_table_banners_table', 1),
(23, '2023_03_14_031036_create_table_images_table', 1),
(24, '2023_03_14_031506_create_table_colors_table', 1),
(25, '2023_03_14_032057_create_table_product_detail_table', 1),
(26, '2023_03_14_060919_create_table_color_product_detail_table', 1),
(27, '2023_03_15_014116_add_column_id_to_table_color_product_detail', 2),
(28, '2023_03_14_030923_create_table_products_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `is_selling` tinyint(4) NOT NULL,
  `is_outstanding` tinyint(4) NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `pice_sell` bigint(20) DEFAULT NULL,
  `price_import` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `status`, `is_selling`, `is_outstanding`, `cat_id`, `brand_id`, `pice_sell`, `price_import`, `created_at`, `updated_at`) VALUES
(12, 'Iphone 14 ProMax', 'Iphone-14-ProMax', 'iPhone 14 Pro Max 512 GB một siêu phẩm đến từ nhà Apple chắc chắn đang được rất nhiều sự quan tâm từ iFan.', '1', 1, 1, 1, 20, NULL, NULL, '2023-03-20 19:43:42', '2023-03-20 19:43:42'),
(13, 'Điện thoại Samsung Galaxy Z Fold4', 'Điện-thoại-Samsung-Galaxy-Z-Fold4', 'Samsung Galaxy Z Fold4 có lẽ là cái tên dành được nhiều sự chú ý đến từ sự kiện Unpacked thường niên của Samsung, bởi máy sở hữu màn hình lớn cùng cơ chế gấp gọn giúp người dùng có thể dễ dàng mang theo', '1', 1, 1, 1, 24, NULL, NULL, '2023-03-20 19:58:15', '2023-03-20 19:58:15'),
(14, 'Iphone 11', 'Iphone-11', 'Apple đã chính thức trình làng bộ 3 siêu phẩm iPhone 11, trong đó phiên bản iPhone 11 64GB có mức giá rẻ nhất nhưng vẫn được nâng cấp mạnh mẽ như iPhone Xr ra mắt trước đó.', '1', 1, 0, 1, 20, NULL, NULL, '2023-03-20 20:03:27', '2023-03-20 20:03:27'),
(15, 'Điện thoại Samsung Galaxy S23 5G', 'Điện-thoại-Samsung-Galaxy-S23-5G', 'Samsung Galaxy S23 5G 256GB có lẽ là ứng cử viên sáng giá được xướng tên trong danh sách điện thoại đáng mua nhất năm 2023', '1', 1, 1, 1, 24, NULL, NULL, '2023-03-20 20:32:06', '2023-03-20 20:32:06'),
(16, 'Điện thoại iPhone 14', 'Điện-thoại-iPhone-14', 'iPhone 14 128GB được xem là mẫu smartphone bùng nổ của nhà táo trong năm 2022', '1', 1, 1, 1, 20, NULL, NULL, '2023-03-20 20:36:44', '2023-03-20 20:36:44'),
(17, 'Điện thoại iPhone 12 Pro Max', 'Điện-thoại-iPhone-12-Pro-Max', 'Điện thoại iPhone 12 Pro Max 512GB - đẳng cấp từ tên gọi đến từng chi tiết. Ngay từ khi chỉ là tin đồn thì chiếc smartphone này đã làm đứng ngồi không yên bao “fan cứng” nhà Apple', '1', 1, 1, 1, 20, NULL, NULL, '2023-03-20 20:41:00', '2023-03-20 20:41:00'),
(18, 'Xiaomi 12T series', 'Xiaomi-12T-series', 'Xiaomi 12T series đã ra mắt trong sự kiện của Xiaomi vào ngày 4/10, trong đó có Xiaomi 12T 5G 128GB', '1', 1, 0, 1, 25, NULL, NULL, '2023-03-20 20:43:32', '2023-03-20 20:43:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_detail`
--

CREATE TABLE `product_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `capacity` bigint(20) NOT NULL,
  `price_import` bigint(20) NOT NULL,
  `price_sell` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_detail`
--

INSERT INTO `product_detail` (`id`, `product_id`, `capacity`, `price_import`, `price_sell`, `created_at`, `updated_at`) VALUES
(8, 12, 128, 26950000, 28050000, '2023-03-20 19:44:27', '2023-03-20 19:44:27'),
(9, 12, 256, 28900000, 29900000, '2023-03-20 19:45:18', '2023-03-20 19:45:18'),
(10, 12, 512, 29230000, 30230000, '2023-03-20 19:46:03', '2023-03-20 19:46:03'),
(11, 13, 256, 34590000, 38590000, '2023-03-20 19:58:48', '2023-03-20 19:58:48'),
(12, 14, 64, 10900000, 11230000, '2023-03-20 20:03:47', '2023-03-20 20:03:47'),
(13, 15, 256, 21900000, 23900000, '2023-03-20 20:32:39', '2023-03-20 20:32:39'),
(14, 15, 512, 2980000, 3280000, '2023-03-20 20:34:13', '2023-03-20 20:34:13'),
(15, 16, 128, 1825000, 2056999, '2023-03-20 20:37:19', '2023-03-20 20:37:19'),
(16, 16, 64, 1789900, 1889900, '2023-03-20 20:38:10', '2023-03-20 20:38:10'),
(17, 16, 256, 2100000, 2200000, '2023-03-20 20:38:41', '2023-03-20 20:38:41'),
(18, 17, 256, 1980000, 2100000, '2023-03-20 20:41:19', '2023-03-20 20:41:19'),
(19, 18, 128, 1090000, 1190000, '2023-03-20 20:43:55', '2023-03-20 20:43:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Phong Nguyễn', 'phongqn0901@gmail.com', NULL, '$2y$10$.Qh0zTdHPnXu18JHo4zy1uba87RiYHxOL18ICFMUrhx/1eEwgqxFC', 'CGO920e7Bscryadhe4OWVLQS7mQQLGWNFYp4npFdpclTFUeaqrD4gazy4rll', '2023-03-14 19:34:18', '2023-03-14 19:34:18'),
(2, 'khanh', 'khanh@gmail.com', NULL, '$2y$10$P80GdlO1b.KAiWgFzS41ae.ia6MIYJ5nnKzuXhOSNCXpRiS.2d6ma', NULL, '2023-03-20 19:39:46', '2023-03-20 19:39:46');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `color_product_detail`
--
ALTER TABLE `color_product_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `color_product_detail_color_id_foreign` (`color_id`),
  ADD KEY `color_product_detail_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_cat_id_foreign` (`cat_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_detail_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `color_product_detail`
--
ALTER TABLE `color_product_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `color_product_detail`
--
ALTER TABLE `color_product_detail`
  ADD CONSTRAINT `color_product_detail_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  ADD CONSTRAINT `color_product_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product_detail` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `product_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
