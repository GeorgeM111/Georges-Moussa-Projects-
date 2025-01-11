-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 11:02 AM
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
-- Database: `loza`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Light'),
(2, 'Milk'),
(3, 'Dark'),
(4, 'ramadan');

-- --------------------------------------------------------

--
-- Table structure for table `chocolates`
--

CREATE TABLE `chocolates` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 20.00,
  `datecreated` date DEFAULT NULL,
  `desc` varchar(500) NOT NULL,
  `weight` float NOT NULL DEFAULT 20,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chocolates`
--

INSERT INTO `chocolates` (`id`, `name`, `price`, `datecreated`, `desc`, `weight`, `image`) VALUES
(1, 'Coconut pistachio', 20.00, '2024-01-27', 'Pistachio truffle dipped in coconut flakes', 30, ''),
(2, 'Wafer', 20.00, '2024-01-27', 'Milk chocolate filled with wafer', 15, ''),
(3, 'Brownie', 20.00, '2024-01-27', 'Brownie dipped in milk chocolate', 30, ''),
(4, 'Roll lotus', 20.00, '2024-01-27', 'Biscuit roll filled with lotus cream dipped in milk chocolate', 20, ''),
(5, 'Walnut cream with brownie', 20.00, '2024-01-08', 'Milk chocolate filled with walnut cream & brownie', 20, ''),
(6, 'Caramel cheesecake', 20.00, NULL, 'Milk Chocolate filled with caramel and cheese cream', 20, ''),
(7, 'Strawberry cheesecake', 20.00, NULL, 'Milk chocolate filled with cheese cream and strawberry jam', 15, ''),
(8, 'Cheesecake tart', 20.00, NULL, 'Vanilla sable filled with cheese cream ,strawberry jam dipped in milk chocolate ', 25, ''),
(9, 'Pistachio with chocolate cream', 20.00, NULL, 'White and milk chocolate filled with chocolate cream and crushed pistachio ', 20, ''),
(10, 'Coffee dark', 20.00, NULL, 'Dark chocolate filled with coffee cream', 15, ''),
(11, 'Cookies with cotton candy', 20.00, NULL, 'Milk chocolate filled with cookies and cotton candy', 20, ''),
(12, 'Cookies and Mocha', 20.00, NULL, 'Cookies topped with mocha cream dipped in milk chocolate ', 20, ''),
(13, 'Croquant dark', 20.00, NULL, 'Dark chocolate filled with croquant ', 20, ''),
(14, 'Croquant with caramel and walnut ', 20.00, NULL, 'Layers of croquant , caramel &walnuts dipped in milk chocolate ', 20, ''),
(15, 'Crispy Custard', 20.00, NULL, 'Milk chocolate filled with custard &crushed biscuits', 15, ''),
(16, 'Date and pistachio', 20.00, NULL, 'Milk chocolate filled with date & crushed pistachios', 15, ''),
(17, 'Feuilletine cylinder', 20.00, NULL, 'Cylinder shaped chocolate filled with Feuilletine', 10, ''),
(18, 'Lotus chocolate', 20.00, NULL, 'Lotus biscuit dipped in milk chocolate ', 20, ''),
(19, 'Mars', 20.00, NULL, 'Milk chocolate filled with caramel and fondant ', 17, ''),
(20, 'Mendiant milk &Dark', 20.00, NULL, 'Mendiant milk &Dark chocolate', 15, '');

-- --------------------------------------------------------

--
-- Table structure for table `context`
--

CREATE TABLE `context` (
  `ID` int(11) NOT NULL,
  `CONTEXT` text NOT NULL,
  `MESSAGE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `context`
--

INSERT INTO `context` (`ID`, `CONTEXT`, `MESSAGE_ID`) VALUES
(2, 'Okay..,', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(16) NOT NULL,
  `company` varchar(250) NOT NULL,
  `Status` enum('Unblocked','Blocked') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CID`, `fname`, `lname`, `mname`, `address`, `Phone`, `email`, `password`, `company`, `Status`) VALUES
(1, 'George', 'Elias', 'Moussa', 'Qatlabeh', '71791910', 'georgesmoussa4443@gmail.com', 'Ab@123456', 'm', 'Unblocked'),
(2, 'George', 'moussa', 'elias', 'Kobayat', '71791911', 'georgesmoussa444@gmail.com', '12345678', 'LIU', 'Unblocked');

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE `markets` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `markets`
--

INSERT INTO `markets` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(1, 'Pan Africa Market', '1521 1st Ave, Seattle, WA', 47.608940, -122.340141, 'restaurant'),
(2, 'Buddha Thai & Bar', '2222 2nd Ave, Seattle, WA', 47.613590, -122.344391, 'bar'),
(3, 'The Melting Pot', '14 Mercer St, Seattle, WA', 47.624561, -122.356445, 'restaurant'),
(4, 'Ipanema Grill', '1225 1st Ave, Seattle, WA', 47.606365, -122.337654, 'restaurant'),
(5, 'Sake House', '2230 1st Ave, Seattle, WA', 47.612823, -122.345673, 'bar'),
(6, 'Crab Pot', '1301 Alaskan Way, Seattle, WA', 47.605961, -122.340363, 'restaurant'),
(7, 'Mama\'s Mexican Kitchen', '2234 2nd Ave, Seattle, WA', 47.613976, -122.345467, 'bar'),
(8, 'Wingdome', '1416 E Olive Way, Seattle, WA', 47.617214, -122.326584, 'bar'),
(9, 'Piroshky Piroshky', '1908 Pike pl, Seattle, WA', 47.610126, -122.342834, 'restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `SUBJECT` varchar(100) DEFAULT NULL,
  `CUSTOMER_ID` int(11) DEFAULT NULL,
  `ACTION` enum('Pending','Resolved','Rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `SUBJECT`, `CUSTOMER_ID`, `ACTION`) VALUES
(1, 'Hello', 1, 'Resolved');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `status` enum('Pending','Completed','Cancel') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `PAID_PRICE` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `customer_id`, `status`, `created_at`, `PAID_PRICE`) VALUES
(1, 2, 'Pending', '2024-11-21 10:00:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `chocolate_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `chocolate_id`, `quantity`, `cover`, `price`) VALUES
(1, 1, 2, 1, 'Brown', 20);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `ID` int(11) NOT NULL,
  `REPLY` text DEFAULT NULL,
  `MESSAGE_ID` int(11) DEFAULT NULL,
  `USER_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`ID`, `REPLY`, `MESSAGE_ID`, `USER_ID`) VALUES
(1, 'Okay', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `position` enum('Admin','Assistant') NOT NULL,
  `last_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `position`, `last_date`) VALUES
(1, 'Admin444', 'Ab@98719', 'admin444@gmail.com', 'Admin', '2024-07-14 06:00:52'),
(2, 'Assistant12', 'Ab@123456', 'assistant12@gmail.com', 'Assistant', '2024-10-23 11:54:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chocolates`
--
ALTER TABLE `chocolates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `context`
--
ALTER TABLE `context`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `context_ibfk_1` (`MESSAGE_ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `messages_ibfk_1` (`CUSTOMER_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `chocolate_id` (`chocolate_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `replies_ibfk_1` (`MESSAGE_ID`),
  ADD KEY `replies_ibfk_2` (`USER_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chocolates`
--
ALTER TABLE `chocolates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `context`
--
ALTER TABLE `context`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `context`
--
ALTER TABLE `context`
  ADD CONSTRAINT `context_ibfk_1` FOREIGN KEY (`MESSAGE_ID`) REFERENCES `messages` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `customers` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`chocolate_id`) REFERENCES `chocolates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`MESSAGE_ID`) REFERENCES `messages` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
