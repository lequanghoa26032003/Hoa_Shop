-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 20, 2024 lúc 01:48 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hoa_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `popular` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `popular`, `created_at`) VALUES
(22, 'LV', 1, 1, '2024-04-21 08:36:34'),
(23, 'GUCCI', 1, 1, '2024-04-21 08:36:52'),
(27, 'Chanel', 1, 1, '2024-05-12 05:51:42'),
(28, 'Dior', 1, 1, '2024-05-27 02:40:59'),
(29, 'Hermè', 1, 1, '2024-05-27 02:41:15'),
(32, 'Dior', 1, 1, '2024-06-20 11:34:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking_no` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` mediumtext NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comments` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `tracking_no`, `user_id`, `name`, `phone`, `email`, `address`, `total_price`, `payment_mode`, `payment_id`, `status`, `comments`, `created_at`) VALUES
(103, 'hoa_shop489467633340', 22, 'hoacon', '0367633340', 'hoakieu2603@gmail.com', '118 nguyễn du, thành phố vinh', 1000000, 'COD', 0, 2, '', '2024-06-20 11:20:40'),
(104, 'hoa_shop1363', 22, 'hoacon', '0367633340', 'hoakieu2603@gmail.com', '118 nguyễn du, thành phố vinh', 1000000, 'NCB', 0, 1, '', '2024-06-20 11:21:40'),
(105, 'hoa_shop922767633340', 26, 'hoabanh', '0367633340', 'banh@gmail.com', '118 nguyễn du, thành phố vinh', 1000000, 'COD', 0, 1, '', '2024-06-20 11:31:23'),
(106, 'hoa_shop4133', 26, 'hoabanh', '0367633340', 'banh@gmail.com', '118 nguyễn du, thành phố vinh', 500000, 'NCB', 0, 2, '', '2024-06-20 11:32:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `qty`, `price`, `created_at`) VALUES
(106, 103, 6, 2, 263000, '2024-06-20 11:20:40'),
(107, 104, 6, 2, 263000, '2024-06-20 11:21:40'),
(108, 105, 6, 2, 263000, '2024-06-20 11:31:23'),
(109, 106, 7, 1, 263000, '2024-06-20 11:32:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `small_description` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `original_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `count_view` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `trending` tinyint(4) NOT NULL,
  `sale` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `image`, `qty`, `count_view`, `status`, `trending`, `sale`, `created_at`) VALUES
(5, 22, 'Quần loe đen', 'quan-loe-den', '<p>da</p>', 'sđ', 500000, 450000, '1715492440.jpg', 90, 25, 1, 1, 0, '2024-04-21 11:08:53'),
(6, 27, 'Quần vải trắng', 'quan-vai-trang', '<p>af</p>', 'faf', 500000, 263000, '1715523655.jpg', 88, 22, 1, 1, 0, '2024-04-22 04:22:12'),
(7, 27, 'Quần cạp cao', 'quan-cap-cao', '<p>fsdfsdg</p>', 'dsfs', 500000, 263000, '1713759762.jpg', 94, 22, 1, 1, 0, '2024-04-22 04:22:42'),
(9, 27, 'Quần âu', 'quan-loe', '<p>dfgfdg</p>', 'gfgf', 10000, 8000, '1716498316.jpg', 10, 5, 1, 0, 0, '2024-05-23 21:05:16'),
(10, 23, 'Quần âu', 'quan-loe', '<p>fgfdg</p>', 'fggf', 10000, 8000, '1716498338.jpg', 11, 1, 1, 0, 0, '2024-05-23 21:05:38'),
(12, 28, 'Quần âu', 'quan-loe', '<p>dfdfdsf</p>', 'dfdf', 10001, 8000, '1717905632.jpg', 10, 5, 1, 1, 1, '2024-06-09 04:00:32'),
(14, 32, 'Quần âu', 'quan-au', '<p>quan dep</p>', 'qqqqq', 100000, 80000, '1718883314.jpg', 11, NULL, 1, 1, 1, '2024-06-20 11:35:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) UNSIGNED NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'Le Quang Hoa', 'hoakieu2603@gmail.com', 'hoaadmin', 'c4ca4238a0b923820dcc509a6f75849b', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `category_post_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_blog`
--

INSERT INTO `tbl_blog` (`id`, `title`, `description`, `content`, `category_post_id`, `image`, `status`, `created_at`) VALUES
(5, 'HOA HẬU MAI PHƯƠNG HỘI TỤ CÙNG FOURTH VÀ DÀN SAO CHÂU Á TẠI TRONG SỰ KIỆN TOMMY HILFIGER DESTINATION SUMMER POP-UP TẠI MALAYSI', '<p>Vào ngày 17/5 vừa qua, Tommy Hilfiger chính thức ra mắt bộ sưu tập Summer Colour Rush tại cửa hàng Destination Summer Pop-up nằm ngay sảnh chính của TTTM Pavilion Kuala Lumpur, thu hút sự chú ý đông đảo các tín đồ thời trang. mai phươn</p>', '', 4, '1717937409.jpg', 1, '2024-06-09 12:50:09'),
(7, 'DENIM DIOR OBLIQUE – CHIẾN DỊCH THỜI TRANG ĐẦU TIÊN DO HAERIN (NEWJEANS) LÀM GƯƠNG MẶT ĐẠI DIỆN', '<p>Vào ngày 17/5 vừa qua, Tommy Hilfiger chính thức ra mắt bộ sưu tập Summer Colour Rush tại cửa hàng Destination Summer Pop-up nằm ngay sảnh chính của TTTM Pavilion Kuala Lumpur, thu hút sự chú ý đông đảo các tín đồ thời trang. mai phươn</p><figure class=\"image\"><img></figure><p>&nbsp;</p><p>.</p>', '', 4, '1717937715.jpg', 1, '2024-06-09 12:54:53'),
(8, 'BIỂU TƯỢNG THỜI TRANG – CÔNG NGHỆ MỚI KHIẾN HOA HẬU THUỲ TIÊN MÊ MẨN!', '<p>dvgdg</p>', '', 4, '1717938272.jpg', 1, '2024-06-09 13:04:32'),
(14, 'ANNE HATHAWAY, ZENDAYA VÀ LƯU DIỆC PHI XUẤT HIỆN LỘNG LẪY TRONG CHIẾN DỊCH MỚI CỦA BULGARI', '<p>dfgdfgdf</p>', 'dfgfdg', 4, '1717939013.jpg', 1, '2024-06-09 13:16:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_blog_comments`
--

CREATE TABLE `tbl_blog_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `cmt` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_blog_comments`
--

INSERT INTO `tbl_blog_comments` (`id`, `user_id`, `blog_id`, `cmt`, `created_at`) VALUES
(28, 22, 2, 'hay lắm', '2024-06-09 06:21:42'),
(29, 22, 7, 'sfdfsdf', '2024-06-09 13:22:02'),
(31, 26, 5, 'hay', '2024-06-20 11:33:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category_blog`
--

CREATE TABLE `tbl_category_blog` (
  `id` int(11) NOT NULL,
  `title` varchar(99) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category_blog`
--

INSERT INTO `tbl_category_blog` (`id`, `title`, `description`, `status`) VALUES
(2, 'thể thao', 'tin tức thể thao', 1),
(4, 'thời trang', 'tin tức thời trang', 1),
(7, 'Thời tiết', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_prod_comments`
--

CREATE TABLE `tbl_prod_comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `cmt` text NOT NULL,
  `prod_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_rating`
--

INSERT INTO `tbl_rating` (`id`, `prod_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(34, 7, 22, 5, 'hay', '2024-06-08 11:40:32'),
(35, 6, 22, 5, 'đẹp', '2024-06-20 11:20:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_reply_to_comments`
--

CREATE TABLE `tbl_reply_to_comments` (
  `id` int(11) NOT NULL,
  `blog_comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cmt` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_reply_to_comments`
--

INSERT INTO `tbl_reply_to_comments` (`id`, `blog_comment_id`, `user_id`, `cmt`, `created_at`) VALUES
(42, 28, 22, 'ok', '2024-06-09 06:23:33'),
(44, 30, 26, 'kk', '2024-06-20 11:33:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) UNSIGNED NOT NULL,
  `sliderName` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `Sale` int(11) NOT NULL,
  `sliderImage` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `sliderName`, `description`, `Sale`, `sliderImage`, `type`) VALUES
(6, 'Hoa_Shop - 1 năm rực rỡ', '<p><strong>Để tri ân khách hàng, Hoa_Shop triển khai chương trình khuyến mãi đặc biệt nhân dịp sinh nhật 1 năm với vô vàn ưu đãi hấp dẫn:</strong></p><ul><li>Giảm giá <strong>10%</strong> cho tất cả các sản phẩm hoa tươi.</li><li>Miễn phí giao hàng trong nội thành <strong>[Tên thành phố]</strong>.</li><li>Tặng quà miễn phí cho hóa đơn trên <strong>[số tiền]</strong>.</li><li>Rút thăm trúng thưởng với nhiều giải thưởng giá trị.</li></ul>', 0, '1714549953.jpg', 1),
(10, 'Black .....', '<ul><li>Black Friday đã trở lại với hàng loạt ưu đãi cực khủng, giảm giá đến 70% cho tất cả các sản phẩm.</li><li>Săn sale thả ga, mua sắm không giới hạn với hàng ngàn deal sốc, quà tặng hấp dẫn.</li><li>Cơ hội vàng để sở hữu những món đồ mong ước với mức giá tiết kiệm nhất.</li><li>Đừng bỏ lỡ Black Friday 2024 - Lễ hội mua sắm hoành tráng nhất năm!</li><li>Truy cập website/cửa hàng ngay để khám phá thêm thông tin chi tiết.</li></ul>', 0, '1718883380.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `customer_id`, `prod_id`, `prod_name`, `price`, `image`, `status`, `slug`) VALUES
(91, 22, 6, 'Quần vải trắng', 500000, '1715523655.jpg', 1, ''),
(93, 22, 5, 'Quần loe đen', 500000, '1715492440.jpg', 1, ''),
(94, 22, 7, 'Quần cạp cao', 500000, '1713759762.jpg', 1, ''),
(95, 26, 6, 'Quần vải trắng', 500000, '1715523655.jpg', 1, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `pass`, `address`, `image`, `status`, `created_at`) VALUES
(22, 'hoacon', 'hoakieu2603@gmail.com', '0367633340', 'c4ca4238a0b923820dcc509a6f75849b', '118 nguyễn du, thành phố vinh', '1718882601.jpg', 0, '2024-05-24 13:54:52'),
(23, 'lequanghoa', 'lequanghoa2603@gmail.com', NULL, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '', 0, '2024-05-28 10:52:28'),
(24, 'hoacon', '1@gmail.com', NULL, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '', 0, '2024-06-20 11:24:23'),
(26, 'hoabanh', 'banh@gmail.com', '0367633340', 'c4ca4238a0b923820dcc509a6f75849b', '118 nguyễn du, thành phố vinh', '1718883033.jpg', 0, '2024-06-20 11:29:58');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`,`prod_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`payment_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`,`prod_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_post_id` (`category_post_id`);

--
-- Chỉ mục cho bảng `tbl_blog_comments`
--
ALTER TABLE `tbl_blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Chỉ mục cho bảng `tbl_category_blog`
--
ALTER TABLE `tbl_category_blog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_prod_comments`
--
ALTER TABLE `tbl_prod_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`prod_id`);

--
-- Chỉ mục cho bảng `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `tbl_reply_to_comments`
--
ALTER TABLE `tbl_reply_to_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_comment_id` (`blog_comment_id`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`,`prod_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `tbl_blog_comments`
--
ALTER TABLE `tbl_blog_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `tbl_category_blog`
--
ALTER TABLE `tbl_category_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_prod_comments`
--
ALTER TABLE `tbl_prod_comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `tbl_reply_to_comments`
--
ALTER TABLE `tbl_reply_to_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD CONSTRAINT `tbl_blog_ibfk_1` FOREIGN KEY (`category_post_id`) REFERENCES `tbl_category_blog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_blog_comments`
--
ALTER TABLE `tbl_blog_comments`
  ADD CONSTRAINT `tbl_blog_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD CONSTRAINT `tbl_rating_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_rating_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD CONSTRAINT `tbl_wishlist_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_wishlist_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
