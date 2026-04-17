-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2026 at 03:46 PM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(1, 6, 23, 'Traditional Temple Design Bangle', '899', 1, 'bangles-25-11-25 - Copy.webp'),
(44, 7, 23, 'Traditional Temple Design Bangle', '899', 3, 'bangles-25-11-25 - Copy.webp'),
(61, 14, 22, 'Rose Gold Floral Stud Earrings', '299', 1, '50D3I3SZTABA09_2 - Copy - Copy.webp');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(10, 2, 'MD SAMIR PARWEZ', 'mdsamirparwez2006@gmail.com', '9334139734', 'Get your favourite jewellery delivered safely to your doorstep with secure packaging and quick shipping across India.');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `placed_on` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(86, 7, 'sam', '9142502934', 'mdsp@gmail.com', 'cash on delivery', 'Flat: 65, Street: Digha, City: Patna, State: Bihar, Country: India, PIN: 800001', 'Traditional Temple Design Bangle(1)', '899', '08-Apr-2026', 'pending'),
(87, 2, 'MD SAMIR PARWEZ', '9142502934', 'mdsamirparwez2006@gmail.com', 'cash on delivery', 'Flat: Azad Nagar, Street: Pathan Toli, City: , State: , Country: , PIN: 824101', 'Traditional Temple Design Bangle(1)', '899', '08-Apr-2026', 'pending'),
(88, 2, 'ramesh', '9334139734', 'mdsamirparwez2006@gmail.com', 'cash on delivery', 'Flat: 65 / singh niwas / road number 9, Street: Digha, City: Patna, State: Bihar, Country: India, PIN: 800001', 'Traditional Temple Design Bangle(1)', '899', '09-Apr-2026', 'pending'),
(89, 2, 'Ramesh', '9334197345', 'mdsamir@gmail.com', 'cash on delivery', 'Flat: 65 / singh niwas / road number 9, Street: Digha, City: Patna, State: Bihar, Country: India, PIN: 800001', 'Traditional Temple Design Bangle(1), Pink Lotus Drop Earrings(1), Sunflower Mangalsutra Pendant Necklace(1)', '1797', '09-Apr-2026', 'pending'),
(90, 2, 'MD SAMIR PARWEZ', '9142502934', 'mdsamirparwez2006@gmail.com', 'cash on delivery', 'Flat: 65 / singh niwas / road number 9, Street: Digha, City: Patna, State: Bihar, Country: India, PIN: 800001', 'Traditional Temple Design Bangle(1)', '899', '09-Apr-2026', 'pending'),
(91, 10, 'Imran Shaikh', '9142502934', 'imranshaikh705000@gmail.com', 'cash on delivery', 'Flat: 65 / singh niwas / road number 9, Street: Digha, City: Patna, State: Bihar, Country: India, PIN: 800001', 'Rose Gold Spiral Ring(1)', '279', '10-Apr-2026', 'pending'),
(92, 10, 'Imran Shaikh', '9142502934', 'mdsamirparwez2006@gmail.com', 'cash on delivery', 'Flat: Azad Nagar, Street: Pathan Toli, City: Aurangabad(BH), State: Bihar, Country: India, PIN: 824101', 'Traditional Temple Design Bangle(1)', '899', '10-Apr-2026', 'pending'),
(93, 10, 'Md Samir Parwez', '9334139734', 'mdsamirparwez2006@gmail.com', 'cash on delivery', 'Flat: 65 / singh niwas / road number 9, Street: Digha, City: Patna, State: Bihar, Country: India, PIN: 800010', 'Traditional Temple Design Bangle(5)', '4495', '10-Apr-2026', 'pending'),
(94, 11, 'Imran Shaikh', '9334139734', 'mdsamirparwez2006@gmail.com', 'cash on delivery', 'Flat: 65 / singh niwas / road number 9, Street: Digha, City: Aurangabad(BH), State: Bihar, Country: India, PIN: 824101', 'Traditional Temple Design Bangle(7)', '6293', '10-Apr-2026', 'pending'),
(95, 11, 'MD SAMIR PARWEZ', '9142502934', 'imranshaikh705000@gmail.com', 'cash on delivery', 'Flat: Azad Nagar, Street: Digha, City: Patna, State: Bihar, Country: India, PIN: 800001', 'Traditional Temple Design Bangle(1), Rose Gold Tennis Bracelet(1), Pink Lotus Drop Earrings(1)', '1747', '10-Apr-2026', 'pending'),
(96, 12, 'MD SAMIR PARWEZ', '9142502934', 'imranshaikh834051@gmail.com', 'cash on delivery', 'Flat: 65 / singh niwas / road number 9, Street: Digha, City: Patna, State: Bihar, Country: India, PIN: 800001', 'Floral Crown Diamond Ring(3)', '1047', '10-Apr-2026', 'pending'),
(97, 12, 'Imran Shaikh', '9334139734', 'mdsamirparwez@gmail.com', 'cash on delivery', 'Flat: 65 / singh niwas / road number 9, Street: Digha, City: Patna, State: Bihar, Country: India, PIN: 800001', 'Rose Gold Floral Stud Earrings(3)', '897', '10-Apr-2026', 'pending'),
(98, 13, 'MD SAMIR PARWEZ', '9142502934', 'mdsamirparwez2006@gmail.com', 'cash on delivery', 'Flat: 65 / singh niwas / road number 9, Street: Digha, City: Patna, State: Bihar, Country: India, PIN: 800001', 'Traditional Temple Design Bangle(6), Pink Lotus Drop Earrings(1)', '5743', '11-Apr-2026', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `price`, `quantity`) VALUES
(1, 71, 23, 'Traditional Temple Design Bangle', 899, 1),
(2, 71, 26, 'Pink Lotus Drop Earrings', 349, 1),
(3, 71, 29, 'Rose Gold Spiral Ring', 279, 1),
(4, 71, 35, 'Infinity Couple Style Ring', 279, 1),
(5, 72, 23, 'Traditional Temple Design Bangle', 899, 1),
(6, 72, 26, 'Pink Lotus Drop Earrings', 349, 1),
(7, 72, 29, 'Rose Gold Spiral Ring', 279, 1),
(8, 73, 23, 'Traditional Temple Design Bangle', 899, 13),
(9, 73, 26, 'Pink Lotus Drop Earrings', 349, 13),
(10, 73, 29, 'Rose Gold Spiral Ring', 279, 13),
(11, 76, 22, 'Rose Gold Floral Stud Earrings', 299, 15),
(12, 76, 23, 'Traditional Temple Design Bangle', 899, 78),
(13, 76, 24, 'Rose Gold Tennis Bracelet', 499, 1),
(14, 76, 25, 'Minimal Floral Chain Necklace', 399, 1),
(15, 76, 26, 'Pink Lotus Drop Earrings', 349, 88),
(16, 76, 27, 'Sunflower Mangalsutra Pendant Necklace', 549, 1),
(17, 76, 28, 'Elegant Diamond Look Pendant Necklace', 449, 1),
(18, 76, 29, 'Rose Gold Spiral Ring', 279, 5),
(19, 76, 30, 'Classic Solitaire Ring (Silver Tone)', 249, 1),
(20, 76, 33, 'Elegant Wave Floral Ring', 329, 1),
(21, 76, 32, 'Floral Crown Diamond Ring', 349, 1),
(22, 76, 31, 'Royal Hexagon Halo Ring', 399, 1),
(23, 76, 36, 'Classic Solitaire Adjustable Ring', 249, 1),
(24, 76, 35, 'Infinity Couple Style Ring', 279, 1),
(25, 76, 34, 'Rose Gold Spiral Sunburst Ring', 299, 1),
(26, 78, 23, 'Traditional Temple Design Bangle', 899, 1),
(27, 80, 24, 'Rose Gold Tennis Bracelet', 499, 1),
(28, 80, 26, 'Pink Lotus Drop Earrings', 349, 4),
(29, 80, 27, 'Sunflower Mangalsutra Pendant Necklace', 549, 1),
(30, 81, 23, 'Traditional Temple Design Bangle', 899, 1),
(31, 82, 22, 'Rose Gold Floral Stud Earrings', 299, 3),
(32, 82, 23, 'Traditional Temple Design Bangle', 899, 1),
(33, 83, 32, 'Floral Crown Diamond Ring', 349, 3),
(34, 84, 23, 'Traditional Temple Design Bangle', 899, 5),
(35, 85, 24, 'Rose Gold Tennis Bracelet', 499, 1),
(36, 86, 23, 'Traditional Temple Design Bangle', 899, 1),
(37, 87, 23, 'Traditional Temple Design Bangle', 899, 1),
(38, 88, 23, 'Traditional Temple Design Bangle', 899, 1),
(39, 89, 23, 'Traditional Temple Design Bangle', 899, 1),
(40, 89, 26, 'Pink Lotus Drop Earrings', 349, 1),
(41, 89, 27, 'Sunflower Mangalsutra Pendant Necklace', 549, 1),
(42, 90, 23, 'Traditional Temple Design Bangle', 899, 1),
(43, 91, 29, 'Rose Gold Spiral Ring', 279, 1),
(44, 92, 23, 'Traditional Temple Design Bangle', 899, 1),
(45, 93, 23, 'Traditional Temple Design Bangle', 899, 5),
(46, 94, 23, 'Traditional Temple Design Bangle', 899, 7),
(47, 95, 23, 'Traditional Temple Design Bangle', 899, 1),
(48, 95, 24, 'Rose Gold Tennis Bracelet', 499, 1),
(49, 95, 26, 'Pink Lotus Drop Earrings', 349, 1),
(50, 96, 32, 'Floral Crown Diamond Ring', 349, 3),
(51, 97, 22, 'Rose Gold Floral Stud Earrings', 299, 3),
(52, 98, 23, 'Traditional Temple Design Bangle', 899, 6),
(53, 98, 26, 'Pink Lotus Drop Earrings', 349, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product_detail` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `product_detail`, `image`) VALUES
(22, 'Rose Gold Floral Stud Earrings', '299', 'These elegant rose gold floral stud earrings are perfect for both daily wear and special occasions. The circular design with sparkling diamond-look stones at the center creates a classy and premium appearance. Their lightweight construction ensures maximum comfort even when worn for long hours. Whether paired with casual outfits, office wear, or party attire, these earrings add a subtle yet stylish touch to your overall look.', '50D3I3SZTABA09_2 - Copy - Copy.webp'),
(23, 'Traditional Temple Design Bangle', '899', 'This traditional temple-style bangle is specially crafted for festive and ethnic occasions. It features an antique gold finish with ruby-colored stones that give it a rich and royal South Indian jewelry look. The intricate detailing enhances its traditional appeal, making it an ideal accessory for weddings, festivals, and cultural events. Durable and beautifully designed, this bangle pairs perfectly with sarees and lehengas.', 'bangles-25-11-25 - Copy.webp'),
(24, 'Rose Gold Tennis Bracelet', '499', 'This rose gold tennis bracelet is a modern and elegant accessory designed to enhance any outfit. The bracelet features a continuous row of shimmering stones that provide a sophisticated and luxurious look. It is perfect for parties, formal events, or even everyday elegance. The secure clasp ensures a comfortable fit, while its refined design makes it an excellent choice for gifting as well.', 'bracelets-25-11-25 - Copy.webp'),
(25, 'Minimal Floral Chain Necklace', '399', 'This minimal floral chain necklace is designed for those who prefer subtle and elegant jewelry. The delicate chain is adorned with small floral motifs spaced evenly to create a graceful and feminine look. Lightweight and comfortable, it is ideal for daily wear, office outfits, or casual occasions. Its simple yet charming design makes it easy to pair with a variety of styles.', 'chains-25-11-25.webp'),
(26, 'Pink Lotus Drop Earrings', '349', 'Inspired by the beauty of the lotus flower, these pink drop earrings offer a soft and feminine appeal. The delicate pink enamel petals combined with a gold finish create a unique and eye-catching design. These earrings complement both traditional and fusion outfits beautifully, making them suitable for festive events, celebrations, or casual gatherings. Their lightweight structure ensures comfortable wear throughout the day.', 'earrings-25-11-25.webp'),
(27, 'Sunflower Mangalsutra Pendant Necklace', '549', 'This modern sunflower-design mangalsutra beautifully blends tradition with contemporary style. The black beaded chain symbolizes marital tradition, while the sparkling floral pendant adds a modern touch. Designed for everyday wear, it is lightweight, elegant, and comfortable. This piece is perfect for married women who want a stylish yet meaningful accessory for daily use.', 'mangalsutra-25-11-25 - Copy.webp'),
(28, 'Elegant Diamond Look Pendant Necklace', '449', 'This elegant pendant necklace features a sparkling circular drop design that radiates sophistication and charm. The rose gold finish enhances the brilliance of the diamond-like stones, making it an ideal accessory for parties, evening events, and special occasions. Lightweight and comfortable, it sits beautifully around the neckline and elevates any outfit with a touch of glamour.', 'pendant-25-11-25 - Copy.webp'),
(29, 'Rose Gold Spiral Ring', '279', 'This stylish spiral ring showcases a modern swirl design that adds a contemporary flair to your jewelry collection. The rose gold finish combined with sparkling stones creates an eye-catching and elegant appearance. Suitable for both daily wear and special occasions, this ring offers a comfortable fit and a smooth finish, making it a versatile accessory for any outfit.', 'ring-25-11-25 - Copy.webp'),
(30, 'Classic Solitaire Ring (Silver Tone)', '249', 'This classic solitaire ring features a timeless design with a single sparkling stone at its center. The silver tone gives it a clean, elegant, and sophisticated look that never goes out of style. Perfect for minimal jewelry lovers, it pairs effortlessly with both casual and formal outfits. Ideal for daily wear or as a thoughtful gift, this ring offers simplicity with lasting elegance.', 'SLS3I1FKHAJ79_2 - Copy.webp'),
(31, 'Royal Hexagon Halo Ring', '399', 'This stunning hexagon halo ring features a unique geometric design that immediately catches the eye. The center is surrounded by multiple sparkling stones arranged in a hexagonal shape, creating a luxurious and royal appearance. The gold-tone band adds warmth and elegance, making it suitable for parties, weddings, or festive occasions. Designed to be lightweight yet durable, this ring offers both comfort and glamour for long hours of wear.', 'rdw00067-y-v1_1.webp'),
(32, 'Floral Crown Diamond Ring', '349', 'Inspired by a delicate floral crown, this elegant ring features three sparkling flower clusters connected by twisted gold detailing. The intricate design gives it a royal and feminine touch, perfect for special occasions or festive wear. The brilliant stones reflect light beautifully, enhancing the overall sparkle. Comfortable to wear and visually striking, this ring pairs wonderfully with both traditional and modern outfits.', 'rdw00068-y-v1_1.webp'),
(33, 'Elegant Wave Floral Ring', '329', 'This graceful wave-style ring showcases a soft curved band with a delicate floral cluster at the center. The flowing design symbolizes elegance and movement, making it a perfect accessory for women who prefer subtle yet stylish jewelry. The gold-tone finish enhances its beauty, while the shimmering stones add a touch of sophistication. Ideal for daily wear as well as small gatherings, this ring blends comfort with charm.', 'rdw00069-y-v1.webp'),
(34, 'Rose Gold Spiral Sunburst Ring', '299', 'This rose gold spiral ring features a radiant sunburst-inspired design that symbolizes energy and positivity. The spiral center surrounded by sparkling stones creates a bold yet elegant statement piece. Its modern style makes it perfect for parties, evening events, or fashionable everyday wear. The smooth band ensures a comfortable fit, while the rose gold finish adds a trendy and luxurious feel.', 'ring-25-11-25 - Copy.webp'),
(35, 'Infinity Couple Style Ring', '279', 'This infinity-style ring represents eternal love and connection, making it a meaningful accessory or gift. The elegant infinity symbol is enhanced with small sparkling stones that add a subtle shine without being overly flashy. Its minimal yet stylish design makes it suitable for daily wear, casual outings, or as a promise ring. Lightweight and comfortable, it complements both western and traditional outfits effortlessly.', 'sf_830-_-532_3_1__1.webp'),
(36, 'Classic Solitaire Adjustable Ring', '249', 'This timeless solitaire ring features a single brilliant stone set on a sleek adjustable band. The silver-tone finish gives it a clean, modern, and sophisticated appearance that never goes out of style. Because of its adjustable design, it fits comfortably on most finger sizes, making it a convenient and versatile choice. Perfect for daily wear, office use, or gifting, this ring offers simplicity with lasting elegance.', 'SLS3I1FKHAJ79_2 - Copy.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(2, 'samir', 'mdsamirparwez2006@gmail.com', '$2y$10$.7k1SxOLQsloKQSd938A3O7p8O82fnm93L4nZQ.iBuPqMAxb1rdwu', 'user'),
(5, 'Md Saamir Parwez', 'mdsamirparwez@gmail.com', '$2y$10$7uGl3NOZRRVrw9KY4oeMp.PsmY4zm9F2yGAHwrYl1imSALxPxMbey', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(30, 2, 24, 'Rose Gold Tennis Bracelet', '499', 'bracelets-25-11-25 - Copy.webp'),
(33, 13, 26, 'Pink Lotus Drop Earrings', '349', 'earrings-25-11-25.webp'),
(34, 14, 23, 'Traditional Temple Design Bangle', '899', 'bangles-25-11-25 - Copy.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
