-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2017 at 08:54 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cubes`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cate_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cate_name`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'LG'),
(4, 'Sony'),
(5, 'HTC'),
(6, 'Huawei'),
(7, 'OPPO'),
(8, 'Nokia'),
(10, 'ASUS'),
(11, 'Mobistar'),
(13, 'Xiiaomi'),
(15, 'Meizu');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `detail_info` text COLLATE utf8_unicode_ci NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cate_id`, `product_name`, `image`, `price`, `detail_info`, `views`) VALUES
(42, 2, 'Samsung Galaxy S8 Plus', 'product-42.png', '20490000.00', 'Màn hình:	Super AMOLED, 5.8\", Quad HD (2K)\r\nHệ điều hành:	Android 7.0\r\nCamera sau:	12 MP\r\nCamera trước:	8 MP\r\nCPU:	Exynos 8895 8 nhân 64-bit\r\nRAM:	4 GB\r\nBộ nhớ trong:	64 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:	2 SIM Nano (SIM 2 chung khe thẻ nhớ), Hỗ trợ 4G\r\nDung lượng pin:	3000 mAh, có sạc nhanh', 2),
(43, 2, 'Samsung Galaxy J7 Pro', 'product-43.png', '6990000.00', 'Màn hình:	Super AMOLED, 5.5\", Full HD\r\nHệ điều hành:	Android 7.0\r\nCamera sau:	13 MP\r\nCamera trước:	13 MP\r\nCPU:	Exynos 7870 8 nhân 64-bit\r\nRAM:	3 GB\r\nBộ nhớ trong:	32 GB', 2),
(44, 2, 'Samsung Galaxy A3 (2017)', 'product-44.png', '6490000.00', 'Màn hình:	Super AMOLED, 4.7\", HD\r\nHệ điều hành:	Android 6.0 (Marshmallow)\r\nCamera sau:	13 MP\r\nCamera trước:	8 MP\r\nCPU:	Exynos 7870 8 nhân 64-bit\r\nRAM:	2 GB\r\nBộ nhớ trong:	16 GB', 0),
(45, 2, 'Samsung Galaxy S8', 'product-45.png', '18490000.00', 'Màn hình:	Super AMOLED, 5.8\", Quad HD (2K)\r\nHệ điều hành:	Android 7.0\r\nCamera sau:	12 MP\r\nCamera trước:	8 MP\r\nCPU:	Exynos 8895 8 nhân 64-bit\r\nRAM:	4 GB\r\nBộ nhớ trong:	64 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:	2 SIM Nano (SIM 2 chung khe thẻ nhớ), Hỗ trợ 4G\r\nDung lượng pin:	3000 mAh, có sạc nhanh', 0),
(46, 1, 'iPhone 6s 32GB', 'product-46.png', '13490000.00', 'Màn hình:	LED-backlit IPS LCD, 4.7\", Retina HD\r\nHệ điều hành:	iOS 10\r\nCamera sau:	12 MP\r\nCamera trước:	5 MP\r\nCPU:	Apple A9 2 nhân 64-bit\r\nRAM:	2 GB\r\nBộ nhớ trong:	32 GB\r\nThẻ SIM:	1 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	1715 mAh', 0),
(47, 1, 'iPhone 7 Plus Red 128GB', 'product-47.png', '23990000.00', 'Màn hình:	LED-backlit IPS LCD, 5.5\", Retina HD\r\nHệ điều hành:	iOS 10\r\nCamera sau:	2 camera 12 MP\r\nCamera trước:	7 MP\r\nCPU:	Apple A10 Fusion 4 nhân 64-bit\r\nRAM:	3 GB\r\nBộ nhớ trong:	128 GB\r\nThẻ SIM:	1 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	2900 mAh', 0),
(48, 1, 'iPhone 7 Red 128GB', 'product-48.png', '19990000.00', 'Màn hình:	LED-backlit IPS LCD, 4.7\", Retina HD\r\nHệ điều hành:	iOS 10\r\nCamera sau:	12 MP\r\nCamera trước:	7 MP\r\nCPU:	Apple A10 Fusion 4 nhân 64-bit\r\nRAM:	2 GB\r\nBộ nhớ trong:	128 GB\r\nThẻ SIM:	1 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	1960 mAh', 0),
(49, 1, 'iPhone 5S 16GB', 'product-49.png', '5990000.00', 'Màn hình:	LED-backlit IPS LCD, 4\", DVGA\r\nHệ điều hành:	iOS 10\r\nCamera sau:	8 MP\r\nCamera trước:	1.2 MP\r\nCPU:	Apple A7 2 nhân 64-bit\r\nRAM:	1 GB\r\nBộ nhớ trong:	16 GB\r\nThẻ SIM:	1 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	1560 mAh', 0),
(50, 2, 'Samsung Galaxy S7 Edge', 'product-50.png', '15490000.00', 'Màn hình:	Super AMOLED, 5.5\", Quad HD (2K)\r\nHệ điều hành:	Android 6.0 (Marshmallow)\r\nCamera sau:	12 MP\r\nCamera trước:	5 MP\r\nCPU:	Exynos 8890 8 nhân 64-bit\r\nRAM:	4 GB\r\nBộ nhớ trong:	32 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:	2 SIM Nano (SIM 2 chung khe thẻ nhớ), Hỗ trợ 4G\r\nDung lượng pin:	3600 mAh, có sạc nhanh', 9),
(51, 2, 'Samsung Galaxy A7 (2017)', 'product-51.png', '9990000.00', 'Màn hình:	Super AMOLED, 5.7\", Full HD\r\nHệ điều hành:	Android 6.0 (Marshmallow)\r\nCamera sau:	16 MP\r\nCamera trước:	16 MP\r\nCPU:	Exynos 7880 8 nhân 64-bit\r\nRAM:	3 GB\r\nBộ nhớ trong:	32 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:	2 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	3600 mAh, có sạc nhanh', 0),
(52, 2, 'Samsung Galaxy A5 (2017)', 'product-52.png', '7990000.00', 'Màn hình:	Super AMOLED, 5.2\", Full HD\r\nHệ điều hành:	Android 6.0 (Marshmallow)\r\nCamera sau:	16 MP\r\nCamera trước:	16 MP\r\nCPU:	Exynos 7880 8 nhân 64-bit\r\nRAM:	3 GB\r\nBộ nhớ trong:	32 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:	2 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	3000 mAh, có sạc nhanh', 1),
(53, 2, 'Samsung Galaxy J3 Pro', 'product-53.png', '4490000.00', 'Màn hình:	PLS TFT LCD, 5\", HD\r\nHệ điều hành:	Android 7.0\r\nCamera sau:	13 MP\r\nCamera trước:	5 MP\r\nCPU:	Exynos 7570 4 nhân 64-bit\r\nRAM:	2 GB\r\nBộ nhớ trong:	16 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:	2 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	2400 mAh', 0),
(54, 2, 'Samsung Galaxy J5 Prime', 'product-54.png', '4490000.00', 'Màn hình:	PLS TFT LCD, 5\", HD\r\nHệ điều hành:	Android 6.0 (Marshmallow)\r\nCamera sau:	13 MP\r\nCamera trước:	5 MP\r\nCPU:	Exynos 7570 4 nhân 64-bit\r\nRAM:	2 GB\r\nBộ nhớ trong:	16 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:	2 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	2400 mAh', 1),
(55, 7, 'OPPO F3 Plus', 'product-55.png', '10690000.00', 'Màn hình:	IPS LCD, 6\", Full HD\r\nHệ điều hành:	Android 6.0 (Marshmallow)\r\nCamera sau:	16 MP\r\nCamera trước:	16 MP và 8 MP\r\nCPU:	Snapdragon 653 8 nhân 64-bit\r\nRAM:	4 GB\r\nBộ nhớ trong:	64 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:	2 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	4000 mAh, có sạc nhanh', 0),
(56, 7, 'OPPO F3', 'product-56.png', '6990000.00', 'Màn hình:	IPS LCD, 5.5\", Full HD\r\nHệ điều hành:	Android 6.0 (Marshmallow)\r\nCamera sau:	13 MP\r\nCamera trước:	16 MP và 8 MP\r\nCPU:	MT6750T 8 nhân 64-bit\r\nRAM:	4 GB\r\nBộ nhớ trong:	64 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 128 GB\r\nThẻ SIM:	2 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	3200 mAh', 0),
(57, 7, 'OPPO F3 RED', 'product-57.png', '6990000.00', 'Màn hình:	IPS LCD, 5.5\", Full HD\r\nHệ điều hành:	Android 6.0 (Marshmallow)\r\nCamera sau:	13 MP\r\nCamera trước:	16 MP và 8 MP\r\nCPU:	MT6750T 8 nhân 64-bit\r\nRAM:	4 GB\r\nBộ nhớ trong:	64 GB\r\nHỗ trợ thẻ nhớ:	MicroSD, hỗ trợ tối đa 128 GB\r\nThẻ SIM:	2 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	3200 mAh', 0),
(58, 8, 'Nokia 6', 'product-58.png', '5590000.00', 'Màn hình:	IPS LCD, 5.5\", Full HD\r\nHệ điều hành:	Android 7.0\r\nCamera sau:	16 MP\r\nCamera trước:	8 MP\r\nCPU:	Qualcomm Snapdragon 430 8 nhân 64 bit\r\nRAM:	3 GB\r\nBộ nhớ trong:	32 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 128 GB\r\nThẻ SIM:	2 SIM Nano (SIM 2 chung khe thẻ nhớ), Hỗ trợ 4G\r\nDung lượng pin:	3000 mAh, có sạc nhanh', 0),
(59, 8, 'Nokia 3310 2017', 'product-59.png', '1060000.00', 'Màn hình:	TFT, 2.4\", 65.536 màu\r\nDanh bạ:	2000 số\r\nThẻ nhớ ngoài:	MicroSD, hỗ trợ tối đa 32 GB\r\nCamera:	2 MP\r\nJack cắm tai nghe:	3.5 mm\r\nRadio FM:	Có\r\nDung lượng pin:	1200 mAh', 0),
(60, 13, 'Xiaomi Redmi Note 4', 'product-60.png', '4690000.00', 'Màn hình:	IPS LCD, 5.5\", Full HD\r\nHệ điều hành:	Android 6.0 (Marshmallow)\r\nCamera sau:	13 MP\r\nCamera trước:	5 MP\r\nCPU:	Snapdragon 625 8 nhân 64-bit\r\nRAM:	3 GB\r\nBộ nhớ trong:	32 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 128 GB\r\nThẻ SIM:	Nano SIM & Micro SIM (SIM 2 chung khe thẻ nhớ), Hỗ trợ 4G\r\nDung lượng pin:	4100 mAh', 20),
(61, 4, 'Sony Xperia XZs', 'product-61.png', '13990000.00', 'Màn hình:	IPS LCD, 5.2\", Full HD\r\nHệ điều hành:	Android 7.0\r\nCamera sau:	19 MP\r\nCamera trước:	13 MP\r\nCPU:	Snapdragon 820 4 nhân 64-bit\r\nRAM:	4 GB\r\nBộ nhớ trong:	64 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 256 GB\r\nThẻ SIM:	2 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	2900 mAh, có sạc nhanh', 0),
(62, 15, 'Meizu M5S', 'product-62.png', '4190000.00', 'Màn hình:	IPS LCD, 5.2\", HD\r\nHệ điều hành:	Android 6.0 (Marshmallow)\r\nCamera sau:	13 MP\r\nCamera trước:	5 MP\r\nCPU:	MTK6753 8 nhân 64-bit\r\nRAM:	3 GB\r\nBộ nhớ trong:	32 GB\r\nThẻ nhớ:	MicroSD, hỗ trợ tối đa 128 GB\r\nThẻ SIM:	2 Nano SIM\r\nDung lượng pin:	3000 mAh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
