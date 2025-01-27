-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 08:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hertzsoft_jewellery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'test', 'test@test.com', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`) VALUES
(3, 7, 6),
(10, 6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(1, 'Rings', 'category-img/jewelery.png'),
(2, 'Necklaces', 'category-img/necklace.png'),
(3, 'Earrings', 'category-img/earrings.png'),
(4, 'Bracelets', 'category-img/bracelet.png'),
(5, 'Pendants', 'category-img/diamond.png');

-- --------------------------------------------------------

--
-- Table structure for table `flash_message`
--

CREATE TABLE `flash_message` (
  `id` int(10) NOT NULL,
  `message` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flash_message`
--

INSERT INTO `flash_message` (`id`, `message`) VALUES
(1, 'We have 20% discount \r\n'),
(2, 'Abdulkader is a good boy'),
(3, 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_id` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `total_amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `order_date`, `total_amount`) VALUES
(5, 6, 6, '2025-01-19', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` int(10) NOT NULL,
  `mrp` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `weight` int(11) NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `mrp`, `discount`, `weight`, `image_url`, `brand`, `category_id`) VALUES
(4, 'Elegant Ring', 20000, 30000, 18, 45, 'uploads/rings/67908ec9e70f7.webp', 'Thor', 1),
(5, 'Beautiful Earings', 28000, 35000, 10, 10, 'uploads/earrings/678a6adeacc76.webp', 'Iron Jewelleries', 3),
(6, 'Wonder Bangles', 10000, 20000, 25, 15, 'uploads/bracelets/678a6b21ef76c.webp', 'Modern Jewellery', 4),
(7, 'Swift Ring', 3500, 10000, 20, 24, 'uploads/rings/678f8cda3e127.webp', 'Modern Jewellery', 1),
(8, 'Kankan Bengali Bangles', 50000, 58000, 8, 40, 'uploads/bracelets/678f8d62c4524.webp', 'Hertzsoft Jewellery', 4),
(9, 'Long Necklace', 40000, 50000, 10, 40, 'uploads/necklaces/678f8de4761f1.webp', 'Visual Necklaces', 2),
(10, 'Better Necklace', 10000, 13000, 13, 15, 'uploads/necklaces/678fa5f797a5f.webp', 'Captain Jewellers', 2),
(11, 'Layered Necklace', 40000, 50000, 10, 23, 'uploads/necklaces/678fa67018b85.webp', 'Thunder Necklaces', 2),
(12, 'Collar Necklace', 80000, 100000, 20, 25, 'uploads/pendants/678fa6e9e36ba.webp', 'Hulk Pendants', 3),
(13, 'Golden Ring', 14000, 15000, 90, 90, 'uploads/rings/678fa75612fce.webp', 'Modern Jewels', 1),
(14, 'Supreme Earrings', 9000, 10000, 90, 10, 'uploads/earrings/679090234dd6f.webp', 'Supreme Jewellers', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `mobile` int(10) NOT NULL,
  `address` varchar(400) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `image` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `mobile`, `address`, `gender`, `image`) VALUES
(6, 'test1@test.com', 'test1', 'test1', 444, 'test1', 'male', 'profile-img/my_photo.jpeg'),
(7, 'test2@test.com', 'test2', 'test', 786, 'ueuueu', 'male', 'profile-img/20250116054133_67888dfde9bb2.jpeg'),
(8, 'thor@hertz.com', 'thor', 'thor', 5455662, 'Asgard', 'male', 'profile-img/20250121093940_678f5d4c42817.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_message`
--
ALTER TABLE `flash_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `flash_message`
--
ALTER TABLE `flash_message`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
