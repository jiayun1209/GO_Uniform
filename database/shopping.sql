-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2020 at 04:52 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'ivy', '81dc9bdb52d04dc20036dbd8313ed055', '2017-01-24 16:21:18', '09-12-2020 02:25:42 PM'),
(2, 'clement', '81dc9bdb52d04dc20036dbd8313ed055', '2020-12-09 17:15:19', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(1, 'Birthday Cake Deal', 'Buy 2 cake and get a gift card', '2020-12-03 06:32:00', '09-12-2020 11:11:18 PM'),
(2, 'Below 100', 'Promotion of Jelly Cake below 100  ', '2020-12-03 06:32:00', ''),
(3, 'SETS', 'Get beautiful decoration of Cake Suprise ', '2020-12-03 06:32:00', ''),
(4, 'Cupcakes', 'Graceful design of Cupcakes & Jelly Cupcakes with Dreamy taste', '2020-12-03 06:32:00', ''),
(5, 'Chocolote Cakes', 'Dark Chocolate with special recipe', '2020-12-03 06:32:00', NULL),
(6, 'Ice Cream Cake\r\n', 'Cold Jelly Cake with ice', '2020-12-03 06:32:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chatwithus`
--

CREATE TABLE `chatwithus` (
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatwithus`
--

INSERT INTO `chatwithus` (`email`, `message`) VALUES
('q@gmail.com', 'Hi'),
('ongkc-wm18@student.tarc.edu.my', 'Hi');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`name`, `email`, `message`) VALUES
('Ivy Wee', 'weecl-wm18@student.tarc.edu.my', 'Hi'),
('Ivy Wee', 'weecl-wm18@student.tarc.edu.my', 'Why '),
('Ivy Wee', 'weecl-wm18@student.tarc.edu.my', 'Why '),
('Ivy Wee', 'weecl-wm18@student.tarc.edu.my', 'Why ');

-- --------------------------------------------------------

--
-- Table structure for table `guestaddress`
--

CREATE TABLE `guestaddress` (
  `shippingAddress` varchar(255) NOT NULL,
  `shippingState` varchar(255) NOT NULL,
  `shippingCity` varchar(225) NOT NULL,
  `shippingPincode` varchar(255) NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `cardnumber` int(255) NOT NULL,
  `expirydate` date NOT NULL,
  `cvNumber` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL,
  `cardnumber` int(11) NOT NULL,
  `expirydate` date NOT NULL,
  `cvNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`, `cardnumber`, `expirydate`, `cvNumber`) VALUES
(84, 1, '18', 1, '2020-12-09 08:36:19', 'debit', 'Delivered', 98765432, '2021-09-21', 123),
(85, 1, '34', 1, '2020-12-09 09:06:34', 'debit', 'Delivered', 1234567, '2021-09-09', 12345679),
(86, 1, '13', 3, '2020-12-09 11:25:46', 'credit card', NULL, 2147483647, '2023-09-12', 6666),
(92, 1, '2', 1, '2020-12-09 19:32:37', 'debit', NULL, 1234567890, '2021-09-12', 4666),
(93, 1, '4', 1, '2020-12-10 02:13:02', 'debit', NULL, 1234567890, '2020-09-12', 221),
(94, 1, '18', 1, '2020-12-10 02:37:32', 'debit', NULL, 1234567890, '2020-09-12', 221),
(95, 1, '18', 1, '2020-12-10 02:38:49', 'debit', NULL, 1234567890, '2020-09-12', 221),
(98, 1, '26', 1, '2020-12-10 03:18:32', 'debit', NULL, 1234567890, '2020-09-12', 221);

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordertrackhistory`
--

INSERT INTO `ordertrackhistory` (`id`, `orderId`, `status`, `remark`, `postingDate`) VALUES
(1, 1, 'in Process', 'Order in process', '2020-12-03 15:03:30'),
(2, 1, 'Delivered', 'Please write a review!', '2020-12-03 15:04:07'),
(3, 85, 'Delivered', 'Done', '2020-12-09 10:13:14'),
(4, 84, 'Delivered', 'Done\r\n', '2020-12-09 10:14:07'),
(5, 83, 'Delivered', 'Done', '2020-12-09 10:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `txn_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `payment_gross` float(10,2) NOT NULL,
  `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payer_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `payer_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payer_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payer_country` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `product_id`, `txn_id`, `payment_gross`, `currency_code`, `payer_id`, `payer_name`, `payer_email`, `payer_country`, `payment_status`, `created`) VALUES
(1, 1, 'PAYID-L7HW4FI6MX65751M9842900Y', 109.00, 'USD', 'VHRVBKGPE4W72', 'Chealsea Leo', 'sb-kkwxc4013121@personal.example.com', 'US', 'approved', '2020-12-08 13:14:54'),
(2, 1, 'PAYID-L7HYRYA5ML10931DM194744F', 109.00, 'USD', 'VHRVBKGPE4W72', 'Chealsea Leo', 'sb-kkwxc4013121@personal.example.com', 'US', 'approved', '2020-12-08 15:09:42'),
(3, 1, 'PAYID-L7IIVRA3W912296BE841311E', 109.00, 'USD', 'VHRVBKGPE4W72', 'Chealsea Leo', 'sb-kkwxc4013121@personal.example.com', 'US', 'approved', '2020-12-09 09:30:22'),
(4, 1, 'PAYID-L7IJHSQ05U2846905423635G', 109.00, 'USD', 'VHRVBKGPE4W72', 'Chealsea Leo', 'chealsea@personal.example.com', 'US', 'approved', '2020-12-09 10:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productreviews`
--

INSERT INTO `productreviews` (`id`, `productId`, `quality`, `price`, `value`, `name`, `summary`, `review`, `reviewDate`) VALUES
(1, 42, 1, 1, 5, 'weecl-wm18@student.tarc.edu.my', 'Good taste', 'Reasonable price', '2020-12-07 07:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `productPriceBeforeDiscount` int(11) DEFAULT NULL,
  `productDescription` longtext DEFAULT NULL,
  `productImage1` varchar(255) DEFAULT NULL,
  `shippingCharge` int(11) DEFAULT NULL,
  `productAvailability` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL,
  `currency` varchar(10) DEFAULT 'USD'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `productName`, `productPrice`, `productPriceBeforeDiscount`, `productDescription`, `productImage1`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`, `currency`) VALUES
(1, 1, 'Frozen Castle', 109, 135, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Frozen Castle</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nFor Frozen-loving kids, going \"Into the Unknown\" of a new age means a birthday celebration with friends and family. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Cake 1.jpg', 7, 'In Stock', '2020-11-12 16:54:35', '', 'USD'),
(3, 1, 'Poney Jelly Cake', 109, 135, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Poney Jelly Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nPoney Jelly cake filled high with a sweet and sour strawberry mousseline. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cake 3.jpg', 7, 'In Stock', '2020-12-03 13:08:01', NULL, 'USD'),
(4, 1, 'Birth Cake', 109, 135, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Birth Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nMade extra special with the dark cherries preserve filling, it’s enrobed in delicious smooth jelly, ready to be served on any occasion! \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cake 4.jpg', 7, 'In Stock', '2020-12-03 13:09:07', NULL, 'USD'),
(5, 1, 'Teddy Bear Cake', 109, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Teddy Bear Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nBEST SELLER! Moist dark chocolate sponge sandwiched with homemade jelly. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cake 5.jpg', 7, 'In Stock', '2020-12-03 13:10:12', NULL, 'USD'),
(6, 1, 'Cute Rabbit Cake', 109, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Cute Rabbit Cake<br></div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nA cute and yummy cake that you might never want to try any other cake. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cake 6.jpg', 7, 'In Stock', '2020-12-03 13:10:59', NULL, 'USD'),
(7, 1, 'Long Mao Cake', 109, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Long Mao Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nThe crunch bite, distinctive flavor, and caramelized taste gonna leave you wanting more! \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cake 7.jpg', 7, 'In Stock', '2020-12-03 13:11:27', NULL, 'USD'),
(8, 1, 'Bear Bear Cake', 109, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Bear Bear Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nIt’s a cake that is a tribute to all things celebratory! \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cake 8.jpg', 7, 'In Stock', '2020-12-03 13:11:45', NULL, 'USD'),
(9, 2, 'Cheese Cake', 95, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; line-height: 1.4; white-space: nowrap; font-size: 18px; font-family: Roboto, Arial, sans-serif; color: rgb(33, 33, 33);\">Cheese Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><div>Baked cheesecake with Dark Pitted Cherries on butter crust base. Made extra special with the dark cherries preserve filling, it’s enrobed in delicious smooth creamy cheese, ready to be served on any occasion!</div><div><br></div><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Below1.PNG', 7, 'In Stock', '2020-12-03 13:13:00', NULL, 'USD'),
(10, 2, 'Sprinkles Fun', 95, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Sprinkles Fun</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><div>The off white pastel cake is decorated with pastel-colored buttercream, and a dash of rainbow sprinkles to finish the minimalistic look.&nbsp;</div><div><br></div><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Below2.PNG', 7, 'In Stock', '2020-12-03 13:13:21', NULL, 'USD'),
(11, 2, ' Velvet Cake', 95, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">&nbsp;Velvet Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nLayers of delicious soft red velvet sponge, cream cheese enveloped in vibrant red velvet crumbs. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Below3.PNG', 7, 'In Stock', '2020-12-03 13:13:52', NULL, 'USD'),
(12, 2, 'Red Velvet Fruit Cake', 95, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Red Velvet Fruit Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nIf you have never tasted or heard of a “Red Velvet Cake” before, you are seriously missing out! Red velvet cake probably comes second behind a chocolate cake. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Below4.PNG', 7, 'In Stock', '2020-12-03 13:15:04', NULL, 'USD'),
(13, 2, 'Xinyi', 89, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; line-height: 1.4;\"><font color=\"#212121\" face=\"Roboto, Arial, sans-serif\"><span style=\"font-size: 18px; white-space: nowrap;\">Xinyi</span></font><br></div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nA chocolate flower cake crafted on top of heavenly delicious cake to express your love to your special person or enjoy it on any occasion. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Below5.PNG', 7, 'In Stock', '2020-12-03 13:22:00', NULL, 'USD'),
(14, 2, 'Peanut Chocolate Cake', 95, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Peanut Chocolate Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nThe sweet and salty combo of peanut butter and chocolate with the extra creamy texture makes this cake irresistible. This cake is meant for only one thing; to satisfy you. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Below6.PNG', 7, 'In Stock', '2020-12-03 13:23:49', NULL, 'USD'),
(15, 2, 'Hojicha Lychee Cake', 99, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; line-height: 1.4;\"><font color=\"#212121\" face=\"Roboto, Arial, sans-serif\"><span style=\"font-size: 18px; white-space: nowrap;\">Hojicha Lychee Cake</span></font><br></div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><div>For the tea lovers- Low sugar Hojicha tea sponge cake, layered with lychees and light cream. Packed with flavours of roasted nutty tea, with floral fruity notes.</div><div><br></div><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Below7.PNG', 7, 'In Stock', '2020-12-03 13:25:03', NULL, 'USD'),
(16, 2, 'Rainbow Cake', 99, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; line-height: 1.4;\"><font color=\"#212121\" face=\"Roboto, Arial, sans-serif\"><span style=\"font-size: 18px; white-space: nowrap;\">Rainbow Cake</span></font><br></div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><div>&nbsp;A fluffy vanilla sponge cake with light cream cheese, decorated with love-shaped marshmallows and sprinkles, let your loved ones experience the excitement of colors when they cut through the cake!</div><div><br></div><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Below8.PNG', 7, 'In Stock', '2020-12-03 13:26:05', NULL, 'USD'),
(17, 3, 'I Love U 4Ever Cake', 105, 150, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; line-height: 1.4;\"><font color=\"#212121\" face=\"Roboto, Arial, sans-serif\"><span style=\"font-size: 18px; white-space: nowrap;\">I Love U 4Ever Cake</span></font><br></div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nThis cake is the most delicious vanilla chiffon cake layered with mango pieces and mango panna cotta, decorated with rose petals made of chocolate fondant and handcrafted with no added preservatives. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Birthday1.PNG', 7, 'In Stock', '2020-12-03 13:28:16', NULL, 'USD'),
(18, 3, 'Burnt Cheese Cake', 85, 99, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; line-height: 1.4;\"><font color=\"#212121\" face=\"Roboto, Arial, sans-serif\"><span style=\"font-size: 18px; white-space: nowrap;\">Burnt Cheese Cake</span></font><br></div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nInspired by the burnt cheesecake made famous by the Basque region of Spain, this rich cheesecake features a beautifully brûléed top with a lingering smoothness between bites of burnt crust and a creamy, melt-in-your-mouth, center. Pure indulgence!&nbsp;&nbsp; \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Birthday2.PNG', 7, 'In Stock', '2020-12-03 13:29:30', NULL, 'USD'),
(19, 3, 'Mango Rose Cake', 99, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Mango Rose Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><div>A perfect mango bouquet with vanilla chiffon, layered with delectable mango filling and mango panna cotta to celebrate with your special one on a special occasion.</div><div><br></div><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Birthday3.PNG', 7, 'In Stock', '2020-12-03 13:30:20', NULL, 'USD'),
(20, 3, 'Caramel Chocolate Cake', 119, 150, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Caramel Chocolate Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nNo matter how you pronounce ‘caramel’, whether it’s “car-mel” or “care-a-mel”, we can all agree that chocolate and caramel are a mouth-watering duo. Here’s a candy-like cake for you. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Birthday4.PNG', 7, 'In Stock', '2020-12-03 13:31:06', NULL, 'USD'),
(21, 3, 'Pandan Cake', 95, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Pandan Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><div>Classic Malaysian flavours with a gula laden twist, our buttery pandan cake sandwiched with fluffy coconut buttercream, homemade kaya, and a delicious palm sugar crumble is a trip down memory lane with an echo of home in every bite.</div><div><br></div><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Birthday5.PNG', 7, 'In Stock', '2020-12-03 13:31:26', NULL, 'USD'),
(22, 3, 'Fruit Chantilly Cake', 95, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Fruit Chantilly Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nFluffy vanilla cake loaded with fresh assorted fruits and luscious pastry cream will breathe a new soul into you. Tastes as good as it looks, this showstopping dessert is the perfect cake for any kind of celebration. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Birthday6.PNG', 7, 'In Stock', '2020-12-03 13:32:02', NULL, 'USD'),
(23, 3, 'Gateau Jaune Cake', 99, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Gateau Jaune Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">&nbsp;Light up the room with this cheerful treat; decorated with white cream and colorful sprinkles on top. The perfect party cake to share with your loved ones while memories are being made! \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Birthday7.PNG', 7, 'In Stock', '2020-12-03 13:32:43', NULL, 'USD'),
(24, 3, 'Bamboo Forest Cake', 85, 99, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; line-height: 1.4; white-space: nowrap; font-size: 18px; font-family: Roboto, Arial, sans-serif; color: rgb(33, 33, 33);\">Bamboo Forest Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nA lovely cake that is decorated with fresh fruits. The cake is crafted from light vanilla chiffon and blueberry filling and lined with puff on the side. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Birthday8.PNG', 7, 'In Stock', '2020-12-03 13:33:07', NULL, 'USD'),
(25, 4, 'Logo Cupcake', 6, 12, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Logo Cupcake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nA various type of custom made Logo cupcakes. Can send a request of the design.&nbsp; \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cupcake 1.jpg', 7, 'In Stock', '2020-12-03 13:36:00', NULL, 'USD'),
(26, 4, 'Cartoon Cupcake', 6, 12, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Cartoon Cupcake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nA various type of custom made Cartoon cupcakes. Can send a request of the design.&nbsp; \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cupcake 2.jpg', 7, 'In Stock', '2020-12-03 13:36:43', NULL, 'USD'),
(27, 4, 'Ocean Cupcake', 6, 12, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Ocean Cupcake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><div>A various type of custom made Ocean cupcakes. Can send a request of the design.&nbsp;</div><div><br></div><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cupcake 3.jpg', 7, 'In Stock', '2020-12-03 13:37:11', NULL, 'USD'),
(28, 4, 'Pink Panther Cupcake', 6, 12, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Pink Panther Cupcake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nA various type of custom made Pink Panther cupcakes. Can send a request of the design.&nbsp; \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cupcake 4.jpg', 7, 'In Stock', '2020-12-03 13:38:08', NULL, 'USD'),
(29, 4, 'Fish Cupcakes', 6, 12, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Fish Cupcakes</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><div>&nbsp;A various type of custom made Fish cupcakes. Can send a request of the design.&nbsp;</div><div><br></div><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cupcake 5.jpg', 7, 'In Stock', '2020-12-03 13:38:39', NULL, 'USD'),
(30, 4, 'Dinasour Cupcake', 6, 12, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Dinasour Cupcake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nA various type of custom made Dinasour cupcakes. Can send a request of the design. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cupcake 6.jpg', 7, 'In Stock', '2020-12-03 13:38:57', NULL, 'USD'),
(31, 4, 'Jelly Love Cupcake', 6, 12, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Jelly Love Cupcake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nA various type of custom made Jelly Love cupcakes. Can send a request of the design.&nbsp; \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cupcake 7.jpg', 7, 'In Stock', '2020-12-03 13:39:35', NULL, 'USD'),
(32, 4, 'Jelly Poney Cupcake', 6, 12, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Jelly Poney Cupcake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nA various type of custom made Jelly Poney cupcakes. Can send a request of the design. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'cupcake 8.jpg', 7, 'In Stock', '2020-12-03 13:40:13', NULL, 'USD'),
(33, 5, 'Chocolate Nostalgia', 79, 99, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Chocolate Nostalgia</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><div>Silky smooth, homestyle moist chocolate cake, layered with a creamy rich chocolate mousse, sprinkled with chocolate biscuit crumble and drizzled with dark chocolate ganache. Delicious!!</div><div><br></div><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Chocolate1.PNG', 7, 'In Stock', '2020-12-03 13:41:07', NULL, 'USD'),
(34, 5, 'Chocolate Rocher Cake', 149, 165, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Chocolate Rocher Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><div>Moist chocolate cake layered with Milk chocolate ganache and almond praline crunchy finished with an almond chocolate coating.</div><div><br></div><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Chocolate2.PNG', 7, 'In Stock', '2020-12-03 13:41:40', NULL, 'USD'),
(35, 5, 'Awesome Blackout Cake', 129, 0, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Frozen Castle</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nFor Frozen-loving kids, going \"Into the Unknown\" of a new age means a birthday celebration with friends and family. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Chocolate3.PNG', 7, 'In Stock', '2020-12-03 13:42:23', NULL, 'USD'),
(36, 5, 'Cherish U', 99, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; line-height: 1.4;\"><font color=\"#212121\" face=\"Roboto, Arial, sans-serif\"><span style=\"font-size: 18px; white-space: nowrap;\">Cherish U</span></font></div><div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; line-height: 1.4;\"><span style=\"white-space: nowrap;\">&nbsp;A sugary way to make them feel extra special! - This sweet treat will satisfy your sweet tooth as you indulge in its rich flavor that will leave you wanting more!</span><br></div><ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Chocolate4.PNG', 7, 'In Stock', '2020-12-03 13:42:57', NULL, 'USD'),
(37, 5, 'Chocolate Royale Cake', 165, 175, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; line-height: 1.4; white-space: nowrap; font-size: 18px; font-family: Roboto, Arial, sans-serif; color: rgb(33, 33, 33);\">Chocolate Royale Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\n&nbsp;A rich chocolate brownie base, dark chocolate mousse made from Belgium dark couverture chocolate and crunchy hazelnut feuiletine. Tastes just like Ferrero Rocher! \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Chocolate5.PNG', 7, 'In Stock', '2020-12-03 13:43:57', NULL, 'USD'),
(38, 5, 'Mozart Cake', 99, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Mozart Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nLayers of Japonaise (soft meringue with seasonal tree nuts) and hazelnut praline cream, topped with fine chocolate shavings. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Chocolate6.PNG', 7, 'In Stock', '2020-12-03 13:45:05', NULL, 'USD'),
(39, 5, 'Chocolate Fudge Cake', 99, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Chocolate Fudge Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\"><div>This fudgy chocolate cake is super rich and decadent with the perfect balance of fluffy and fudgy. It gets its fine texture from silky smooth frosting that covers the exterior.</div><div><br></div><li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Chocolate7.PNG', 7, 'In Stock', '2020-12-03 13:45:43', NULL, 'USD'),
(40, 5, 'Wicked Forest Cake', 109, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Wicked Forest Cake</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nChocolate sponge cake with a rich cherry filling based on the German dessert Schwarzwälder Kirschtorte, literally \"Black Forest Cherry-torte\". Typically, Black Forest gateau consists of several layers of chocolate sponge cake sandwiched with whipped cream and cherries. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'Chocolate8.PNG', 7, 'In Stock', '2020-12-03 13:46:00', NULL, 'USD'),
(41, 6, 'Perfect 10 ', 135, 150, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Perfect 10&nbsp;</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nWhen you want a bit of everything, the Perfect 10 ice cream cake is the ultimate choice. Cut into 10 perfect slices each with its individual flavors. You can sample flavors like Mango, Strawberry, Sumiyaki Coffee, Vanilla, Dark Chocolate, Matcha, Sweet Corn, Black Sesame, Coconut &amp; Mint with Chocolate Chips. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'IceCream1.PNG', 7, 'In Stock', '2020-12-03 13:49:25', NULL, 'USD'),
(42, 6, 'Durian Family', 85, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Durian Family</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\n Durian lovers rejoice! Super good looking durian family ice cream cake is made with premium quality durian puree. It\'s as cute as it gets!\r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'IceCream2.PNG', 7, 'In Stock', '2020-12-03 13:49:51', NULL, 'USD'),
(43, 6, 'Shape of My Heart ', 119, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Shape of My Heart&nbsp;</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nFor Frozen-loving kids, going \"Into the Unknown\" of a new age means a birthday celebration with friends and family. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'IceCream3.PNG', 7, 'In Stock', '2020-12-03 13:50:19', NULL, 'USD'),
(44, 6, 'Bouquet Pop', 89, 99, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Bouquet Pop</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nIt is assembled to look like a flower bouquet by using our signature Kpop ice cream lollipop. It makes a perfect gift that shows your affection with a sweet ending. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'IceCream4.PNG', 7, 'In Stock', '2020-12-03 13:51:01', NULL, 'USD'),
(45, 6, 'Mangoberry ', 145, 165, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Mangoberry&nbsp;</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nRich, creamy mangoes and zingy, sweet strawberries are a match made in fruity heaven and we bring them together in healthful holy matrimony of this hearty cake. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'IceCream5.PNG', 7, 'In Stock', '2020-12-03 13:51:16', NULL, 'USD'),
(46, 6, 'Black Forest', 125, 139, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Black Forest</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nA decadent chocolate base meets pops of sumptuous cherry and cream in this sinfully angelic ice cream cake. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'IceCream6.PNG', 7, 'In Stock', '2020-12-03 13:51:44', NULL, 'USD'),
(47, 6, 'Tiramisu ', 125, 0, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Frozen Castle</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nFor Frozen-loving kids, going \"Into the Unknown\" of a new age means a birthday celebration with friends and family. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'IceCream7.PNG', 7, 'In Stock', '2020-12-03 13:52:45', NULL, 'USD'),
(48, 6, 'Chocoreo ', 125, 0, '<div class=\"HoUsOy\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif;\">Frozen Castle</div>\r\n\r\n<ul class=\"_3dG3ix col col-9-12\" style=\"box-sizing: border-box; margin-left: 0px; width: 548.25px; display: inline-block; vertical-align: top; line-height: 1.4;\">\r\n\r\nFor Frozen-loving kids, going \"Into the Unknown\" of a new age means a birthday celebration with friends and family. \r\n<li class=\"sNqDog\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\"></li></ul>', 'IceCream8.PNG', 7, 'In Stock', '2020-12-03 13:53:33', NULL, 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-03 14:03:36', NULL, 0),
(2, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-03 14:09:06', NULL, 0),
(3, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-03 14:09:15', NULL, 0),
(4, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-03 14:10:10', '03-12-2020 07:58:28 PM', 1),
(5, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-03 14:28:40', NULL, 1),
(6, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-03 15:01:48', '03-12-2020 08:34:56 PM', 1),
(7, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-04 01:16:11', '04-12-2020 07:51:29 AM', 1),
(8, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-04 02:21:44', NULL, 1),
(9, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 07:17:33', '07-12-2020 12:52:04 PM', 1),
(10, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 07:22:15', NULL, 0),
(11, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 07:22:22', '07-12-2020 12:53:26 PM', 1),
(12, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 07:23:35', '07-12-2020 12:53:50 PM', 1),
(13, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 07:24:01', NULL, 0),
(14, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 07:24:08', NULL, 1),
(15, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 07:29:28', '07-12-2020 01:46:31 PM', 1),
(16, 'ongkc-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 08:17:54', '07-12-2020 01:48:15 PM', 1),
(17, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 08:38:45', '07-12-2020 02:13:58 PM', 1),
(18, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 08:44:34', '07-12-2020 02:14:42 PM', 1),
(19, 'ongkc-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 08:47:24', '07-12-2020 02:22:56 PM', 1),
(20, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 08:53:03', '07-12-2020 02:27:33 PM', 1),
(21, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 09:02:46', '07-12-2020 03:46:04 PM', 1),
(22, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-07 10:29:42', NULL, 1),
(23, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-08 06:51:55', NULL, 1),
(24, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-08 11:04:23', NULL, 1),
(25, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-08 13:53:45', '08-12-2020 08:02:40 PM', 1),
(26, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-08 14:49:52', NULL, 1),
(27, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-08 15:51:22', '08-12-2020 09:22:03 PM', 1),
(28, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-08 16:35:02', NULL, 0),
(29, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-08 16:35:15', NULL, 1),
(30, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 04:36:39', NULL, 1),
(31, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 08:27:58', NULL, 1),
(32, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 08:57:56', '09-12-2020 02:35:56 PM', 1),
(33, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 09:06:25', NULL, 1),
(34, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 11:25:42', '09-12-2020 05:22:36 PM', 1),
(35, 'ongkc-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 12:18:33', '09-12-2020 08:24:40 PM', 1),
(36, 'lily@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-09 14:55:31', '09-12-2020 10:30:07 PM', 1),
(37, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 17:00:13', NULL, 0),
(38, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 17:00:18', '09-12-2020 10:30:53 PM', 1),
(39, 'lily@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-09 17:01:14', NULL, 1),
(40, 'lily@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-09 18:20:00', '10-12-2020 12:01:49 AM', 1),
(41, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 18:33:39', NULL, 0),
(42, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 18:33:44', '10-12-2020 12:45:44 AM', 1),
(43, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 19:30:33', '10-12-2020 01:11:38 AM', 1),
(44, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-09 19:42:35', NULL, 1),
(45, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-10 02:12:59', '10-12-2020 08:14:59 AM', 1),
(46, 'weecl-wm18@student.tarc.edu.my', 0x3a3a3100000000000000000000000000, '2020-12-10 03:18:28', '10-12-2020 09:01:53 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` longtext DEFAULT NULL,
  `shippingState` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `regDate`, `updationDate`) VALUES
(1, 'Ivy Wee', 'Female', 'weecl-wm18@student.tarc.edu.my', 184567892, '827ccb0eea8a706c4c34a16891f84e7b', 'Jln Malinja', 'Subang Jaya', 'Selangor', 165, '2020-12-03 14:09:54', '07-12-2020 12:53:07 PM'),
(3, 'Lily', 'Female', 'lily@gmail.com', 19888222, '81dc9bdb52d04dc20036dbd8313ed055', 'Tmn Melati', 'Terengganu', 'Jerteh', 22021, '2020-12-09 14:55:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `userId`, `productId`, `postingDate`) VALUES
(4, 1, 10, '2020-12-08 14:00:18'),
(5, 3, 43, '2020-12-09 16:44:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
