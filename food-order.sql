-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2023 at 04:16 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(42, 'Sinchana P Gudagi', 'Sinchana', '202cb962ac59075b964b07152d234b70'),
(44, 'Umme Zaiba', 'Zaiba', 'd9e9359e6e012f18868d5db925bfa96c');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(35, 'pizza', 'Food_Category_193.jpg', 'yes', 'yes'),
(36, 'Burger', 'Food_Category_679.jpg', 'yes', 'yes'),
(37, 'Momos', 'Food_Category_385.jpg', 'yes', 'yes'),
(38, 'Sandwich', 'Food_Category_826.jpg', 'yes', 'yes'),
(42, 'Samosa', 'Food_Category_4.jpg', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(31, 'olives pizza        ', ' Delicious pizza with olives   ', '313.00', 'Food_Name-4138.jpg', 35, 'yes', 'yes'),
(33, 'Pepperoni pizza', '  pepperoni loaded pizza', '863.00', 'Food_Name-2164.jpg', 35, 'yes', 'yes'),
(34, 'Cheese burger', 'Cheese burst burger', '719.00', 'Food_Name-4839.jpg', 36, 'yes', 'yes'),
(35, 'Ham burger', 'Yummy ham burger', '196.00', 'Food_Name-4229.jpg', 36, 'yes', 'yes'),
(36, 'veg sandwich', '  Veggies stuffed sandwich', '457.00', 'Food_Name-1928.png', 38, 'yes', 'yes'),
(38, 'Steamed momos', 'Steamed hot momos for your breakfast', '562.00', 'Food_Name-2891.jpg', 37, 'yes', 'yes'),
(39, 'Samosa', '  Veg stuffed samosa', '230.00', 'Food_Name-2865.jpg', 42, 'yes', 'yes'),
(40, 'Double cheese ham burger', '  Doubly loaded extra cheese burger', '560.00', 'Food_Name-8063.jpg', 36, 'yes', 'yes'),
(41, 'Motu Samosa', 'Special hot samosa for your snacks', '200.00', 'Food_Name-2283.png', 42, 'yes', 'yes'),
(42, 'Veg momos', '  Healthy veggies momos', '200.00', 'Food_Name-1422.jpg', 37, 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(14, 'olives pizza        ', '313.00', 1, '313.00', '2023-01-13 10:16:54', 'Delivered', 'Arjit', '12345', 'yummy@gmail.com', 'Banglore'),
(15, 'Cheese burger', '719.00', 1, '719.00', '2023-01-13 10:17:36', 'Delivered', 'Sonam', '12345', 'foods@gmail.com', 'Mumbai'),
(16, 'veg sandwich', '457.00', 1, '457.00', '2023-01-13 10:18:11', 'Cancelled', 'Shreya', '78787', 'myfoods@gmail.com', 'Delhi'),
(17, 'Steamed momos', '562.00', 1, '562.00', '2023-01-13 10:18:50', 'Cancelled', 'Sofiya', '34343', 'yum@gmail.com', 'Davangere'),
(18, 'Motu Samosa', '200.00', 1, '200.00', '2023-01-13 10:20:27', 'On Delivery', 'Payal', '67676', 'delicious@gmail.com', 'Banglore'),
(19, 'Pepperoni pizza', '863.00', 1, '863.00', '2023-01-13 10:21:47', 'Ordered', 'Zinpreet', '56565', 'Zinpreet@gmail.com', 'Davangere'),
(20, 'Double cheese ham burger', '560.00', 1, '560.00', '2023-01-13 11:01:32', 'Delivered', 'Soni', '34343', 'order@gmail.com', 'Davangere'),
(21, 'Steamed momos', '562.00', 263, '147806.00', '2023-01-27 09:55:19', 'Ordered', 'Lenore Mclean', '+1 (472) 556-6398', 'qudegatu@mailinator.com', 'Totam qui quaerat qu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `review` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`id`, `name`, `email`, `review`) VALUES
(13, 'Sanam', 'yummyfoods@gmail.com', '\"The food was amazing! Everything was cooked to perfection and the flavors were out of this world.\"'),
(14, 'Tina', 'foods@gmail.com', '\"The food was amazing! Everything was cooked to perfection and the flavors were out of this world.\"'),
(15, 'Suzi', 'tasty@gmail.com', '\"I have never tasted anything like this before, the food was so delicious and the service was excellent\"'),
(19, 'John', 'john@gmail.com', '\"I have had a great time at this restaurant, the food was delicious and the service was excellent\"'),
(20, 'kkkk', 'jjkkjjk@gmail.com', 'please rate na swalpa kadme maadi,and plzzzz my fvt chocolate cake availabel madsii');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
