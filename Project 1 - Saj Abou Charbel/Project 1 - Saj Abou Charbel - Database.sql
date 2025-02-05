-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 10:20 AM
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
-- Database: `sajaboucharbel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`) VALUES
(1, 'Admin444', '$2y$10$WXHS08X8tC.8cGyHCLdVpu4Qb71z/6A8FgAjm3XBgXQ1uVasQfMnu');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Manakish'),
(2, 'Drinks'),
(3, 'Chicha'),
(4, 'Snacks');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(30) DEFAULT NULL,
  `PRICE` varchar(30) DEFAULT NULL,
  `CATEGORY_ID` int(11) DEFAULT NULL,
  `IMAGE` varchar(100) DEFAULT NULL,
  `stock` enum('in','out') DEFAULT 'in'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `NAME`, `PRICE`, `CATEGORY_ID`, `IMAGE`, `stock`) VALUES
(1, 'Zaatar', '50,000 L.L', 1, 'mankoushezaatar.jpeg', 'in'),
(2, 'Zaatar Extra', '100,000 L.L', 1, 'mankoushezaatarextra.jpeg', 'in'),
(3, 'Zaatar w Jebne', '100,000 L.L', 1, 'mankoushejebnezaatar.jpeg', 'in'),
(4, 'Jebne', '150,000 L.L', 1, 'mankoushejebne.jpg', 'in'),
(5, 'Jebne + Corn', '170,000 L.L', 1, 'mankoushejebnedara.jpg', 'in'),
(6, 'Jebne Extra', '180,000 L.L', 1, 'mankoushejebnedarazaytoun.jpg\n', 'in'),
(7, 'Lahme', '150,000 L.L', 1, 'mankoushelahme.jpg', 'in'),
(8, 'Lahme w Jebne', '150,000 L.L', 1, 'makoushelahmejebne.webp', 'in'),
(9, 'Lahme + Jebne', '170,000 L.L', 1, 'mankoushejebnelahmetop.jpg', 'in'),
(10, 'Keshek', '150,000 L.L', 1, 'mankoushekeshek.jpg', 'in'),
(11, 'Arish', '150,000 L.L', 1, 'mankoushekarish.jpg', 'in'),
(12, 'Labneh', '150,000 L.L', 1, 'mankoushelabne.jpg', 'in'),
(13, 'Kafta', '250,000 L.L', 1, 'mankoushekafta.jpg', 'in'),
(14, 'Chocoba', '60,000 L.L', 1, 'chocobat.jpg', 'in'),
(15, 'Soft Drink Plastic', '60,000 L.L', 2, 'softDrinkBottle.jpeg', 'in'),
(16, 'Soft Drink Glass', '30,000 L.L', 2, 'softDrinkglass.jpeg', 'in'),
(17, 'XXL Red', '50,000 L.L', 2, 'xxlRed.png', 'in'),
(18, 'Dark Blue', '50,000 L.L', 2, 'darkBlue.jpg', 'in'),
(19, 'Tropicana', '40,000 L.L', 2, 'TropicanaJuice.jpg', 'in'),
(20, 'Water', '30,000 L.L', 2, 'waterSmall.png', 'in'),
(21, 'Beer', '60,000 L.L', 2, 'beer.jpg', 'in'),
(22, 'Mr. Juicy', '20,000 L.L', 2, 'mrjuicy.png', 'in'),
(23, 'X-tra', '40,000 L.L', 2, 'xtra.jpeg', 'in'),
(24, 'Orange + Carrot Juice', '45,000 L.L', 2, 'original.jpg', 'in'),
(25, 'Pizza Small', '5 $', 1, 'Lebanese.jpeg', 'in'),
(26, 'Nargila', '200,000 L.L', 3, 'Nargila.png', 'in'),
(27, 'Halley', '45,000 L.L', 4, 'halley.jpg', 'in'),
(28, 'Albeni', '35,000 L.L', 4, 'albeni.png', 'in'),
(29, 'Albeni Cake', '40,000 L.L', 4, 'albeniCake.jpg', 'in'),
(30, 'Albeni Rolls', '50,000 L.L', 4, 'albeniRoll.jpg', 'in'),
(31, 'Choco Prince', '40,000 L.L', 4, 'chocoprince.jpg', 'in'),
(32, 'Batton Salé', '20,000 L.L', 4, 'batton.jpg', 'in'),
(33, 'Wanted', '35,000 L.L', 4, 'wanted.png\r\n', 'in'),
(34, 'Snickers', '55,000 L.L', 4, 'snickers.jpg', 'in'),
(35, 'Mars', '55,000 L.L', 4, 'mars.jpg', 'in'),
(36, 'Lavita', '20,000 L.L', 4, 'lavita.jpg', 'in'),
(37, 'Chips Big', '100,000 L.L', 4, 'chipsBig.jpg', 'in'),
(38, 'Chips Small', '50,000 L.L', 4, 'smallChips.jpg', 'in'),
(39, 'Bzurat', '80,000 L.L', 4, 'Bzurat.jpg', 'in'),
(40, 'Bezer', '60,000 L.L', 4, 'bezer.jpeg', 'in'),
(41, 'Bezer Abyad', '100,000 L.L', 4, 'bezerAbyad.jpeg', 'in'),
(42, 'Pizza Medium', '7 $', 1, 'Lebanese.jpeg', 'in'),
(43, 'Pizza Large', '10 $', 1, 'Lebanese.jpeg', 'in'),
(52, 'Jebne + Jambon', '200,000 L.L', 1, 'jbnejambon.jpg', 'in');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CATEGORY_ID` (`CATEGORY_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `category` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
