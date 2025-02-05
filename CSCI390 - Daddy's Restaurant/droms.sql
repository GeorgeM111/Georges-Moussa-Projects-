-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2025 at 11:19 PM
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
-- Database: `droms`
--

-- --------------------------------------------------------

--
-- Table structure for table `addable`
--

CREATE TABLE `addable` (
  `ITEM_ID` int(11) NOT NULL,
  `INGREDIENT_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addable`
--

INSERT INTO `addable` (`ITEM_ID`, `INGREDIENT_ID`) VALUES
(1, 2),
(28, 2);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `USERNAME` varchar(15) NOT NULL,
  `EMAIL_ADDRESS` varchar(30) NOT NULL,
  `PHONE_NUMBER` varchar(10) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`USERNAME`, `EMAIL_ADDRESS`, `PHONE_NUMBER`, `PASSWORD`) VALUES
('Admin1234', 'restaurantdaddys@gmail.com', '11 111 111', '$2y$10$PrIZg3Nnk6obVkxY5JpNju.N9zFAwyiYbNzeLCHL.nlOojqC/Ka9u');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Appetisers', 'A variety of starters to sharpen your appetite.'),
(2, 'Salads', 'Fresh and healthy options with a range of dressings.'),
(3, 'Burgers', 'Gourmet and classic burger options.'),
(4, 'Main Platters', 'Hearty meals for a fulfilling dining experience.'),
(5, 'Pastas', 'A selection of innovative warm pasta dishes.'),
(6, 'Sandwiches', 'Light bites available with various fillings.'),
(7, 'Pizzas', 'From timeless favourites to unique combinations.'),
(8, 'Wraps', 'A heartful selection of deliciously deceiving wraps'),
(9, 'Cold Drinks', 'Refreshing beverages to cool you down.'),
(10, 'Hot Drinks', 'Warm beverages for a comforting sip.'),
(11, 'Alcohol', 'A selection of beers, wines, and spirits.'),
(12, 'Dessert', 'Sweet treats to conclude your meal.'),
(13, 'Chicha', 'Traditional and flavoured Chicha options.');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `FULL NAME` varchar(40) NOT NULL,
  `ADDRESS` varchar(30) DEFAULT NULL,
  `PHONE_NUMBER` varchar(10) DEFAULT NULL,
  `EMAIL_ADDRESS` varchar(30) DEFAULT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `STATUS` enum('Unblocked','Blocked','Deleted') NOT NULL DEFAULT 'Unblocked',
  `RESET_TOKEN` varchar(255) DEFAULT NULL,
  `TOKEN_EXPIRY` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `FULL NAME`, `ADDRESS`, `PHONE_NUMBER`, `EMAIL_ADDRESS`, `PASSWORD`, `STATUS`, `RESET_TOKEN`, `TOKEN_EXPIRY`) VALUES
(35, 'Georges Moussa', 'Kobayat Qatlabeh', '71 791 910', 'johnymoussz140@gmail.com', '$2y$10$nG1N9SDofKYjfGzewdnRnefi1Hj77Scri1/Mx19xeFUcYbTjVxnn2', 'Unblocked', 'ff537f15', '2025-02-04 08:04:59'),
(36, 'Johny Moussa', NULL, '70 450 990', 'johnymoussa40@gmail.com', '$2y$10$JLcPcvXKK56gdMjGHeqexeokFH3H6xKUOAXoC05Fpttj0LX2P2p5C', 'Unblocked', NULL, NULL),
(37, 'Joey Moussa', NULL, '03 166 449', 'owkeyhandop@gmail.com', '$2y$10$/bmoEXAy45mcPwODrkj8Du/q4cg84ym15O3zwHyL4bCFJdNk/.WWS', 'Blocked', '105c3624', '2025-02-04 22:24:16'),
(53, 'John Doe', '123 Main St', '555-1234', 'john.doe@example.com', 'hashed_password1', 'Unblocked', NULL, NULL),
(54, 'Jane Smith', '456 Oak St', '555-5678', 'jane.smith@example.com', 'hashed_password2', 'Unblocked', NULL, NULL),
(55, 'Alice Johnson', '789 Pine St', '555-9012', 'alice.johnson@example.com', 'hashed_password3', 'Blocked', NULL, NULL),
(56, 'Bob Williams', '321 Maple St', '555-3456', 'bob.williams@example.com', 'hashed_password4', 'Deleted', NULL, NULL),
(57, 'Charlie Brown', '654 Cedar St', '555-7890', 'charlie.brown@example.com', 'hashed_password5', 'Unblocked', NULL, NULL),
(58, 'David White', '987 Birch St', '555-2345', 'david.white@example.com', 'hashed_password6', 'Blocked', NULL, NULL),
(59, 'Emily Davis', '741 Walnut St', '555-6789', 'emily.davis@example.com', 'hashed_password7', 'Unblocked', NULL, NULL),
(60, 'Frank Thomas', '852 Elm St', '555-12345', 'frank.thomas@example.com', 'hashed_password8', 'Deleted', NULL, NULL),
(61, 'Grace Hall', '963 Spruce St', '555-56785', 'grace.hall@example.com', 'hashed_password9', 'Unblocked', NULL, NULL),
(62, 'Henry Miller', '159 Chestnut St', '555-90125', 'henry.miller@example.com', 'hashed_password10', 'Blocked', NULL, NULL),
(63, 'Isabella Scott', '753 Sycamore St', '555-34565', 'isabella.scott@example.com', 'hashed_password11', 'Unblocked', NULL, NULL),
(64, 'Jack Wilson', '246 Redwood St', '555-78905', 'jack.wilson@example.com', 'hashed_password12', 'Deleted', NULL, NULL),
(65, 'Karen Martinez', '369 Beech St', '555-23455', 'karen.martinez@example.com', 'hashed_password13', 'Blocked', NULL, NULL),
(66, 'Leo Anderson', '987 Fir St', '555-67895', 'leo.anderson@example.com', 'hashed_password14', 'Unblocked', NULL, NULL),
(67, 'Mia Clark', '258 Willow St', '555-12346', 'mia.clark@example.com', 'hashed_password15', 'Unblocked', NULL, NULL),
(68, 'Reine Nassour', NULL, '81 295 206', 'reinenassour004@gmail.com', '$2y$10$Ba2yLPXQVmqYRfjmO21lAesKv04FHAF5Sn5T8WbV9J4cIgwAgRNMC', 'Deleted', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE `featured` (
  `ID` int(11) NOT NULL,
  `ITEM_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featured`
--

INSERT INTO `featured` (`ID`, `ITEM_ID`) VALUES
(5, 5),
(2, 9),
(6, 30);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `PRICE` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`ID`, `NAME`, `PRICE`) VALUES
(2, 'Cheddar', 0.4),
(3, 'Onions', 0.01);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ID` int(11) NOT NULL,
  `PRICE` float NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `DESCRIPTION` text DEFAULT NULL,
  `CATEGORY_ID` int(11) DEFAULT NULL,
  `IMAGE` varchar(255) DEFAULT NULL,
  `Avaliablity` enum('Available','Unavailable') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ID`, `PRICE`, `NAME`, `DESCRIPTION`, `CATEGORY_ID`, `IMAGE`, `Avaliablity`) VALUES
(1, 2.56, 'French Fries Platter', 'Platter Of Freshly Fried Fries.', 1, 'fries.jpg', 'Available'),
(2, 3.33, 'Potato Wedges Platter', 'Fried potato wedges, cocktail sauce, sweet sauce.', 1, 'potatoWedges.jpg', 'Available'),
(3, 3.17, 'Cheese Chips', 'French Fries covered in cheese served with sauce.', 1, 'item_67a2590a71a530.79054776.jpg', 'Available'),
(4, 2.5, 'Grilled Potato', 'A freshly Baked Grilled Potato served with toum.', 1, 'grilledPotato.jpg', 'Available'),
(5, 5.55, 'Potato Twister', 'Platter Of Delicious Curly Fries.', 1, 'potatoTwister.jpg', 'Available'),
(6, 2, 'Hummus', 'A tradionally made hummus with tahini  to enlighten your dining experience.', 1, 'Hummus.jpg', 'Available'),
(7, 10.89, 'Alfredo Pizza Large', 'Alfredo Sauce, chopped grilled chicken breasts, cheese ,corn, olives, pepperoni.', 7, 'Alfredo.jpg', 'Available'),
(8, 3.45, 'Mozarella Sticks', 'Cheesy goodness of warm mozarella sticks.', 1, 'mozarellaSticks.jpg', 'Available'),
(9, 2.78, 'Cheese Garlic Bread', 'Garlicy, Cheesy, and Herby bread.', 1, 'cheeseGarlicBread.jpeg', 'Available'),
(10, 3.5, 'Eres Kibbeh Mechwye', '(Ask For Availability)', 1, 'kibbeh.jpeg', 'Available'),
(11, 4.11, 'Hummus With Meat', 'A Traditionally made authentic hummus with meat bowl.', 1, 'hummusMeat.jpg', 'Available'),
(12, 1.4, 'French Fries Box', 'A box of french fries.', 1, 'BoxFries.jpg', 'Available'),
(13, 2.45, 'Baba Ghannouj', 'Authentic bowl of baba ghannouj.', 1, 'babaghannoush.jpg', 'Available'),
(14, 3.9, 'Tabouleh', 'Tomato, parsley, onions, tabouleh dressing.', 2, 'tabouleh.jpg', 'Available'),
(15, 3.61, 'Fattoush', 'Tomato, cucumber , lettuce, parsley, onion, mint, fattoush dressing.', 2, 'fatoush.jpg', 'Available'),
(16, 5.11, 'Crab Salad', 'Crab, lettuce, tomato, cucumber, orange, carrots, mustard dressing.', 2, 'crabSalad.jpg', 'Available'),
(17, 4.67, 'Greek Salad', 'Lettuce, tomato, cucumber, green pepper, feta cheese, olives, mint leaves, greek dressing.', 2, 'greekSalad.jpeg', 'Available'),
(18, 7, 'Kani  Salad', 'Crab, cucumbers, carrots, lettuce, orange, panko and kani salad sauces.', 2, 'kaniSalad.jpeg', 'Available'),
(19, 3.9, 'Ceaser Salad', 'Lettuce, crouton, parmesan, with ceaser salad dressing.', 2, 'ceaserSalad.jpeg', 'Available'),
(20, 6, 'Pesto Salad', 'Penne pasta, tomato, olives, parmesan, pesto dressing.', 2, 'pestoSalad.jpeg', 'Available'),
(21, 4, 'Falafel Salad', 'Mini Falafel, Mint, onion, raddish, lettuce, tomato, tahini dressing', 2, 'falafelSalad.jpg', 'Available'),
(22, 5.9, 'Tuna Salad', 'Tuna, tomato, green pepper, pickles, corn, olives. Your choice of  mustard or mayo dressing.', 2, 'tunaSalad.jpg', 'Available'),
(23, 5.9, 'Tuna Pasta Salad', 'Tuna,pasta, tomato, pickles, corn, olives. Your choice of  mustard or mayo dressing.', 2, 'tunaPastaSalad.jpg', 'Available'),
(24, 6.11, 'Oz Burger.', 'Double meat patty, lettuce , pickles, onions, tomato, barbecue sauce, cheese with a side of coleslaw and fries.', 3, 'ozBurger.jpg', 'Available'),
(25, 3.9, 'Chicken Burger', 'Choice of grilled or fried chicken breast, cheese,  coleslaw, fries, cocktail sauce, ketchup.                  ', 3, 'chickenBurger.jpg', 'Available'),
(26, 4.35, 'Chicken Cheese Burger', 'Choice of grilled or fried chicken breast, cheese, coleslaw, fries, cocktail sauce, ketchup.                  ', 3, 'chickenCheeseBurger.jpeg', 'Available'),
(27, 6.11, 'Oz chicken Burger', 'Two grilled chicken breasts, lettuce, pickles, onions, barbecue sauce, cheese with side of coleslaw and fries.', 3, 'chickenOzbBurger.jpeg', 'Available'),
(28, 3.9, 'Hamburger', 'Meat patty, coleslaw salad , French Fries, and ketchup.', 3, 'burger.png', 'Available'),
(29, 4.35, 'Cheese Burger', 'Meat patty, cheese, coleslaw salad , French Fries, and ketchup.', 3, 'cheeseburger.png', 'Available'),
(30, 6.33, 'Swiss Mushroom Burger', 'Meat patty, Swiss mushroom sauce, barbecue sauce, cheddar sauce, mozarella with a side of fries.', 3, 'swissMushroomBurger.jpeg', 'Available'),
(31, 6.45, 'Mozarerlla Burger', 'Mozarella patty, your choice of grilled, fried chicken or  meat, lettuce, mayonnaise, pickles with a side of fries.', 3, 'MozarellaBurger.png', 'Available'),
(32, 6.55, 'Crispy Magnum Burger', 'Fried breaded chicken, cheese, jambon, potato chips, lettuce, barbecue & fries.', 3, 'crispyMagnum.png', 'Available'),
(33, 3.9, 'Fish Burger', 'Breaded Fried Fish, Lettuce, tartar sauce with french fries.', 3, 'fishBurger.jpeg', 'Available'),
(34, 7.23, 'Burger Wrap', 'Meat, cheddar cheese sauce, onions, tomato, lettuce, fries, cocktail sauce, ketchup.', 8, 'burgerWrap.jpg', 'Available'),
(35, 7.23, 'Chicken Burger Wrap', 'Grilled Chicken, onions, mozarella, lettuce, fries, cocktail sauce, ketchup.', 8, 'chickenBurgerWrap.jpeg', 'Available'),
(36, 6.66, 'Daddy\'s Chicken Wrap', 'Grilled chicken, cheese, corn, olives, pickles, tomatoes, lettuce, barbecue sauce, cocktail sauce.', 8, 'chickenWrap.jpg', 'Available'),
(37, 6.9, 'Daddy\'s Submarine Wrap', 'Salami, cheese, lettuce, tomato, corn, olives, pickles, cocktail sauce.', 8, 'subMarineWrap.jpeg', 'Available'),
(38, 7, 'Daddy\'s Crispy Chicken Wrap', 'Crispy, cheese, lettuce, chips, barbecue sauce cocktail sauce, cheddar.', 8, 'crispyChickenWrap.webp', 'Available'),
(39, 6.9, 'Daddy\'s Hot Dog Wrap', 'Hot dogs, chips, fries, mustard, cocktail sauce, cheddar sauce.', 8, 'hotDogWrap.png', 'Available'),
(40, 6.67, 'Daddy\'s Fish Wrap', 'Fried fish fillet, tomatoes, lettuce, pickles and special sauce.', 8, 'fishWrap.jpg', 'Available'),
(41, 9, 'Daddy\'s Sujuk Wrap', 'Sujuk, grilled onions, grilled tomatoes, fries, toum, cheese.', 8, 'SaussageWrap.jpeg', 'Available'),
(42, 6, 'Tabliyet Daddy\'s ', '', 4, 'Tablye.png', 'Available'),
(43, 2.78, 'Nargila', '', 13, 'Nargila.png', 'Available'),
(44, 0.35, 'Plastic Hose', '', 13, 'Hose.jpeg', 'Available'),
(45, 1.67, 'Tobacco Replacement', '', 13, 'chicha.jpg', 'Available'),
(46, 8.34, 'Nargila Jabali', '', 13, 'Jabali.png', 'Available'),
(47, 4, 'Penne Arabiata', 'Penne pasta, red sauce and olives', 5, 'penneArabiata.jpg', 'Available'),
(48, 7.8, 'Four Cheese Pasta', 'Penne Pasta, four cheese in white sauce.', 5, 'FourCheesePasta.jpg', 'Available'),
(49, 7.5, 'Pesto Pasta', 'Penne Pasta, grilled chicken, pesto, mushroom, parmesan, white sauce, onions.', 5, 'PestoPasta.jpeg', 'Available'),
(50, 8.35, 'Penne Ai Funghi', 'Penne pasta, mushroom, parsley, garlic, cheese, white sauce', 5, 'PenneAiFunghi.jpg', 'Available'),
(51, 3.5, 'Noodles', 'Noodles, onions, green bellpepper, mushroom, sauce.', 5, 'Noodles.jpeg', 'Available'),
(52, 9.17, 'Daddy\'s Special Pizza Large', 'Chef\'s Favorite Mix.', 7, 'daddySpecial.jpeg', 'Available'),
(53, 8.45, 'Vegeterian Pizza Large', 'Pizza sauce, onions, green bell pepper, tomato, corn, olives.', 7, 'vegetarianPizza.jpg', 'Available'),
(54, 8.78, 'Lebanese Pizza Large', 'Pizza sauce, jambon, corn, olives, green bellpepper, tomatoes.', 7, 'Lebanese.jpeg', 'Available'),
(55, 8.78, 'Pepperoni Pizza Large', 'Pizza Sauce , pepperoni slices, mushrooms.', 7, 'pepperoni.jpeg', 'Available'),
(56, 8.39, 'Marguerita Pizza Large', 'Pizza sauce, cheese and olives.', 7, 'margherita.jpg', 'Available'),
(57, 8.89, 'GodFother Pizza Large', 'Grilled chicken, sauce barbecue, cheese, onions.', 7, 'godFather.png', 'Available'),
(58, 9.78, 'Sujuk Pizza Large', 'Sujuk, onions, tomatoes.', 7, 'sujukPizza.jpg', 'Available'),
(59, 9.83, 'Four Cheese Pizza Large', 'Pizza sauce, four cheeses.', 7, '4cheese.jpg', 'Available'),
(60, 9.78, 'Alfredo Pizza Small', 'Alfredo Sauce, chopped grilled chicken breasts, cheese ,corn, olives, pepperoni', 7, 'Alfredo.jpg', 'Available'),
(61, 8.06, 'Daddy\'s Special Pizza Small', 'Chef\'s Favorite Mix', 7, 'daddySpecial.jpeg', 'Available'),
(62, 7.34, 'Vegeterian Pizza Small', 'Pizza sauce, onions, green bell pepper, tomato, corn, olives.', 7, 'vegetarianPizza.jpg', 'Available'),
(63, 7.66, 'Lebanese Pizza Small', 'Pizza sauce, jambon, corn, olives, green bellpepper, tomatoes.', 7, 'Lebanese.jpeg', 'Available'),
(64, 7.66, 'Pepperoni Pizza Small', 'Pizza Sauce , pepperoni slices, mushrooms.', 7, 'pepperoni.jpeg', 'Available'),
(65, 7.28, 'Marguerita Pizza Small', 'Pizza sauce, cheese and olives.', 7, 'margherita.jpg', 'Available'),
(66, 7.78, 'GodFother Pizza Small', 'Grilled chicken, sauce barbecue, cheese, onions.', 7, 'godFather.png', 'Available'),
(67, 8.76, 'Sujuk Pizza Small', 'Sujuk, onions, tomatoes.', 7, 'sujukPizza.jpg', 'Available'),
(68, 8.72, 'Four Cheese Pizza Small', 'Pizza sauce, four cheeses.', 7, '4cheese.jpg', 'Available'),
(69, 0.9, 'Coffee In a Pot Medium', '', 10, 'coffeePotMedium.jpg', 'Available'),
(70, 1.67, 'Coffee In a Pot Large', '', 10, 'coffeePotLarge.jpg', 'Available'),
(71, 1, 'Nescafe Sachet', '', 10, 'nescafeSachet.jpg', 'Available'),
(72, 1.12, 'Nescafe Mix', '', 10, 'nescafeMix.jpg', 'Available'),
(73, 1, 'Cappucino', '', 10, 'cappucino.jpg', 'Available'),
(74, 0.9, 'Herbal Tea', '', 10, 'herbalTea.jpg', 'Available'),
(75, 1, 'Hot Chocolate', '', 10, 'hotChocolate.jpg', 'Available'),
(76, 0.56, 'Espresso', '', 10, 'espresso.png', 'Available'),
(77, 1, 'Espresso Double', '', 10, 'espressoDouble.jpg', 'Available'),
(78, 2.9, 'Cocktail Avocat', '', 12, 'avocadoCocktail.jpg', 'Available'),
(79, 1.56, 'Crepe Small', '2 pieces.', 12, 'crepeSmall.jpg', 'Available'),
(80, 2.78, 'Crepe Large', '4 pieces.', 12, 'crepeLarge.jpg', 'Available'),
(81, 0.67, 'Ice Cream Scoop', '', 12, 'icecreamScoop.jpg', 'Available'),
(82, 1.68, 'Ice Cream Mix Cone', '', 12, 'iceCreamCone.jpg', 'Available'),
(83, 5.28, 'Ice Cream1/2 Kg', '', 12, 'icecreamhalf.jpg', 'Available'),
(84, 10.55, 'Ice Cream 1 Kg', '', 12, 'icecreamKG.jpg', 'Available'),
(85, 3.16, 'Chocolat Mou', '', 12, 'chocolatMou.jpg', 'Available'),
(86, 3.33, 'Oreo Ice Cream', '', 12, 'OreoIcecream.jpg', 'Available'),
(87, 2.78, 'Daddy\'s Cake', '', 12, 'daddysCake.jpg', 'Available'),
(88, 1.11, 'Biscuit au chocolat', '', 12, 'lazyCake.jpg', 'Available'),
(89, 4, 'Special Oreo Ice Cream', '', 12, 'OreoIcecreamSp.jpg', 'Available'),
(90, 3.62, 'Sweet Pizza Small', '', 12, 'sweetpizzaS.jpeg', 'Available'),
(91, 4.55, 'Sweet Pizza Large', '', 12, 'sweetpizzaL.jpeg', 'Available'),
(92, 3.33, 'Bombastic Lotus', '', 12, 'bombasticLotus.jpg', 'Available'),
(93, 0.28, 'Water Small', '', 9, 'waterSmall.png', 'Available'),
(94, 0.56, 'Water Big', '', 9, 'waterBig.jpg', 'Available'),
(95, 1.45, 'Iced Coffee', '', 9, 'icedCoffee.jpg', 'Available'),
(96, 1.89, 'Almaza Beer', '', 9, 'almaza-beer.jpg', 'Available'),
(97, 2.11, 'Mexican Beer', '', 9, 'mexicanbeer.png', 'Available'),
(98, 1.67, 'Fresh Orange Juice', '', 9, 'orangeJuice.jpeg', 'Available'),
(99, 0.89, 'Dark Blue Energy Drink', '', 9, 'darkBlue.jpg', 'Available'),
(100, 1.11, 'XXL Red Energy Drink', '', 9, 'xxlred.png', 'Available'),
(101, 0.56, 'Tropicana Juice', '', 9, 'tropicanaJuice.jpg', 'Available'),
(102, 0.78, 'Soft Drink Plastic', 'Pepsi , 7UP, Miranda', 9, 'softDrinkPlastic.jpeg', 'Available'),
(103, 0.5, 'Soft Drink Glass', 'Pepsi , 7UP, Miranda', 9, 'softdrinkGlass.jpeg', 'Available'),
(104, 0.89, 'Soft Drink Can', 'Pepsi , 7UP, Miranda', 9, 'softDrinkCan.jpg', 'Available'),
(105, 1.67, 'Mixed Nuts ', 'Bzourat', 9, 'Bzurat.jpg', 'Available'),
(106, 1.78, 'Oreo Iced Coffee', '', 9, 'OreoIcedCoffee.jpg', 'Available'),
(107, 1.6, 'Smoothie', '', 9, 'smoothie.jpg', 'Available'),
(108, 1.11, 'Via Sparkling Water', '', 9, 'viaSparkling.jpg', 'Available'),
(109, 3, 'Corona Beer', '', 9, 'coronaBeer.jpeg', 'Available'),
(110, 3.56, 'Budweiser', '', 9, 'budweiser.png', 'Available'),
(111, 3, 'Smirnoff Ice', '', 9, 'smirnoffIce.jpg', 'Available'),
(112, 7.95, 'Chicken Mushroom Sauce Platter', '3 grilled chicken slices, potato wedges, mushroom sauce.', 4, 'chickenMushroomSauce.jpg', 'Available'),
(113, 8.78, 'Makanek Platter', '400 grams of makanek, cooked with pomegrenade molasses with a side of pickles and fries.', 4, 'makanekPlatter.png', 'Available'),
(114, 8.45, 'Sujuk Platter', '400 grams of sujuk meat with a side of pickles, tomatoes and fries.', 4, 'saussagePlatter.jpg', 'Available'),
(115, 7.73, 'Chicken Polo Alfredo', '3 grilled chicken slices, mushrooms, onions, served with rice and sauce.', 4, 'chickenPoloAlfredo.jpg', 'Available'),
(116, 7.34, 'Daddy\'s chicken ', '4 grilled chicken slices, choice of fried or grilled potatoes, side of toum, slices of tomato.', 4, 'DaddyschickenPlatter.jpeg', 'Available'),
(117, 6.45, 'Crispy Chicken Platter', '4 crispy chicken strips, coleslaw, fires, cocktail sauce.', 4, 'crispyChickenPlatter.jpeg', 'Available'),
(118, 5.34, 'Nuggets Platter', '8 chicken nuggets, coleslaw, fries, cocktail sauce.', 4, 'nuggetsPlatter.jpeg', 'Available'),
(119, 6.45, 'Escalope Platter', '2 Breaded chicken breasts, coleslaw, fries, cocktail sauce.', 4, 'escalopePlatter.jpeg', 'Available'),
(120, 7.72, 'Fajita Platter', 'Fajita, avocado sauce, toasted bread.', 4, 'FajitaPlatter.png', 'Available'),
(121, 5.45, 'Shawarma Chicken Small Platter', '250 grams of chicken  shawarma with fries, pickles and toum.', 4, 'shawarmaChickenSmall.jpg', 'Available'),
(122, 8.89, 'Shawarma Chicken Large Platter', '500 grams of chicken shawarma  on a sizzling plate with a side of fries, toum, pickles and tomatoes.', 4, 'shawarmaChickenBig.jpg', 'Available'),
(123, 6.78, 'Shawarma Meat Small Platter', '250 grams of  meat shawarma with fries, pickles and tomatoes.', 4, 'meatShawarmasMALL.jpg', 'Available'),
(124, 10.89, 'Shawarma Meat Large Platter', '500 grams of meat shawarma on a sizzling platter with a side of fries, tahini sauce, pickles, tomatoes, onions and parsley.', 4, 'shawarmaMeatBig.png', 'Available'),
(125, 6.67, 'Tawook Platter', '250 of grilled tawook pieces, coleslaw, salad, fries, pickles and garlic sauce.', 4, 'tawookPlatter.jpg', 'Available'),
(126, 8.45, 'Kafta Platter', '500 grams of kafta on a sizzling plate.', 4, 'kaftaPlatter.jpg', 'Available'),
(127, 6.11, 'Asbeh Platter', 'Asbeh, lettuce, tomato, pickles, fries and garlic sauce.', 4, 'asbehPlatter.jpg', 'Available'),
(128, 6.89, 'Samkeh Harra Platter', 'Fish fillet, potato, sauce.', 4, 'SamkehHarraPlatter.png', 'Available'),
(129, 3.35, 'Whiskey Red (Glass)', '', 11, 'redLabel.png', 'Available'),
(130, 5.55, 'Whiskey Black (Glass)', '', 11, 'blackLabel.jpg', 'Available'),
(131, 2, 'Regular Vodka (Glass)', '', 11, 'absVodka.jpg', 'Available'),
(132, 3, 'Vodka Black (Glass)', '', 11, 'blackVodka.jpg', 'Available'),
(133, 3, 'Red Wine Premium (Glass)', '', 11, 'redWinePremium.jpg', 'Available'),
(134, 3, 'White Wine Premium (Glass)', '', 11, 'whiteWinePremium.jpg', 'Available'),
(135, 3, 'Rose Wine Premium (Glass)', '', 11, 'RoseWinePremium.jpg', 'Available'),
(136, 1.67, 'Arak Glass', '', 11, 'arakCup.jpg', 'Available'),
(137, 1.67, 'Meza', '(Bzourat, Jazar, Termos)', 11, 'Meza.jpeg', 'Available'),
(138, 3.34, 'Energy Drink + Vodka Glass', '', 11, 'vodkaEnergy.jpg', 'Available'),
(139, 7.5, 'Whiskey Red (1/4 Bottle)', '', 11, 'redLabel.png', 'Available'),
(140, 25, 'Whiskey Black (1/2 Bottle)', '', 11, 'blackLabel.jpg', 'Available'),
(141, 12, 'Regular Vodka (1/2 Bottle)', '', 11, 'absVodka.jpg', 'Available'),
(142, 3.2, 'Juk Arak', '', 11, 'JukArak.png', 'Available'),
(143, 15, 'Whiskey Red (1/2 Bottle)', '', 11, 'redLabel.png', 'Available'),
(144, 45, 'Whiskey Black (Bottle)', '', 11, 'blackLabel.jpg', 'Available'),
(145, 33, 'Vodka Black (Bottle)', '', 11, 'blackVodka.jpg', 'Available'),
(146, 15, 'Red Wine Premium (Bottle)', '', 11, 'redWinePremium.jpg', 'Available'),
(147, 14, 'White Wine Premium (Bottle)', '', 11, 'whiteWinePremium.jpg', 'Available'),
(148, 14, 'Rose Wine Premium (Bottle)', '', 11, 'RoseWinePremium.jpg', 'Available'),
(149, 22.8, 'Regular Vodka (Bottle)', '', 11, 'absVodka.jpg', 'Available'),
(150, 28, 'Whiskey Red (Bottle)', '', 11, 'redLabel.png', 'Available'),
(151, 4.67, 'Grilled Chicken Sub', 'Grilled chicken, corn, olives, pickles, lettuce ,tomato, cheddar, barbecue and cocktail sauce.', 6, 'grilledChickenSub.jpg', 'Available'),
(152, 3.56, 'Hot Dog', 'Hot dog, chips, cheddar , mustard, ketchup.', 6, 'hotDog.jpg', 'Available'),
(153, 3.45, 'Asbeh', 'Asbeh, garlic, pickles, lettuce ,fries.', 6, 'asbeh.jpg', 'Available'),
(154, 3.89, 'Tawook', 'Tawook, garlic sauce, coleslaw, fries, pickles.', 6, 'tawook.jpg', 'Available'),
(155, 4.28, 'Kafta', 'Kafta, hummus, pickles, grilled tomato and grilled onions.', 6, 'kafta.jpg', 'Available'),
(156, 4.06, 'Soujouk', 'Soujouk, toum, fries, onions, tomatoes, pickles.', 6, 'soujuk.jpg', 'Available'),
(157, 2.23, 'Batata', 'Fries, Coleslaw, toum, ketchup, pickles.', 6, 'Batata.jpg', 'Available'),
(158, 3.34, 'Jebne W Jambon', 'Cheese, Ham, Mayonnaise, lettuce, tomatoes, pickles.', 6, 'hamCheese.jpeg', 'Available'),
(159, 4.45, 'Crispy Chicken & Cheese Sub', 'Fried crispy strips, fries, cheese, coleslaw, barbecue sauce and cocktail sauce in a sub.', 6, 'crispyChickenCheeseSub.jpeg', 'Available'),
(160, 4.45, 'Meat Shawarma', 'Meat shawarma, grilled onions and tomatoes, tahini sauce.', 6, 'shawarmaMeat.jpg', 'Available'),
(161, 4.45, 'Fajita', 'Chicken, cheese, bellpepper, onions, mushrooms, avocado sauce.', 6, 'fajita.png', 'Available'),
(162, 3.84, 'Crispy Chicken', 'Fried crispy strips, fries, coleslaw, barbecue sauce and cocktail sauce.', 6, 'crispyChicken.png', 'Available'),
(163, 4.17, 'Crispy Chicken & Cheese', 'Fried crispy strips, fries, cheese, coleslaw, barbecue sauce and cocktail sauce.', 6, 'crispyChickenCheese.jpg', 'Available'),
(164, 4.45, 'Makanek', '', 6, 'makanek.png', 'Available'),
(165, 5.55, 'The Twins', 'Grilled chicken, tomatoes, lettuce, sauces with a side of fries', 6, 'theTwins.png', 'Available'),
(166, 5.55, 'Fish Finger Twins', 'Fried fish fingers, tartar sauce, lettuce, tomatoes, with a side of fries.', 6, 'fishFingerTwins.png', 'Available'),
(167, 4, 'Samkeh Harra ', 'Fried fish. lettuce, sauce', 6, 'samkeHarra.png', 'Available'),
(168, 4.17, 'Crispy Chicken Sub', 'Fried crispy strips, fries, coleslaw, barbecue sauce and cocktail sauce in a sub.', 6, 'crispyChickenSub.jpeg', 'Available'),
(169, 3.67, 'Chicken Shawarma', 'Chicken shawarma, toum, lettuce, fries, pickles.', 6, 'shawarmaChicken.jpg', 'Available'),
(170, 3.78, 'Tuna Sandwich', 'Tuna, corn, olives, pickles, onions, mayonnaise sauce, lettuce.', 6, 'tunaSandwich.jpeg', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `STATUS` enum('Pending','In Progress','Ready','Picked Up','Canceled') NOT NULL,
  `DATE_AND_TIME` datetime NOT NULL,
  `TOTAL_PRICE` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `STATUS`, `DATE_AND_TIME`, `TOTAL_PRICE`) VALUES
(1, 'Pending', '2025-02-04 18:37:29', 3.5),
(2, 'In Progress', '2025-02-04 19:42:51', 3.85);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `ORDER_ID` int(11) NOT NULL,
  `ITEM_ID` int(11) NOT NULL,
  `QUANTITY` int(11) DEFAULT NULL,
  `REQUEST` text DEFAULT NULL,
  `FINAL_PRICE` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`ORDER_ID`, `ITEM_ID`, `QUANTITY`, `REQUEST`, `FINAL_PRICE`) VALUES
(1, 10, 1, 'A - Special Request:<br>&emsp;- No Special Request.<br>B - Removed Ingredients:<br>&emsp;- None removed.<br>C - Added Ingredients:<br>&emsp;- None added.', 3.5),
(2, 12, 1, 'A - Special Request:<br>&emsp;- No Special Request.<br>B - Removed Ingredients:<br>&emsp;- None removed.<br>C - Added Ingredients:<br>&emsp;- None added.', 1.4),
(2, 13, 1, 'A - Special Request:<br>&emsp;- No Special Request.<br>B - Removed Ingredients:<br>&emsp;- None removed.<br>C - Added Ingredients:<br>&emsp;- None added.', 2.45);

-- --------------------------------------------------------

--
-- Table structure for table `order_in_dining`
--

CREATE TABLE `order_in_dining` (
  `ORDER_ID` int(11) NOT NULL,
  `TABLE_NUMBER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_in_dining`
--

INSERT INTO `order_in_dining` (`ORDER_ID`, `TABLE_NUMBER`) VALUES
(1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_out_dining`
--

CREATE TABLE `order_out_dining` (
  `ORDER_ID` int(11) NOT NULL,
  `CUSTOMER_ID` int(11) NOT NULL,
  `OPTION` enum('Pickup','Delivery') NOT NULL DEFAULT 'Pickup'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_out_dining`
--

INSERT INTO `order_out_dining` (`ORDER_ID`, `CUSTOMER_ID`, `OPTION`) VALUES
(2, 35, 'Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `recommended`
--

CREATE TABLE `recommended` (
  `ID` int(11) NOT NULL,
  `ITEM_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recommended`
--

INSERT INTO `recommended` (`ID`, `ITEM_ID`) VALUES
(3, 23),
(2, 78),
(5, 91);

-- --------------------------------------------------------

--
-- Table structure for table `removable`
--

CREATE TABLE `removable` (
  `ITEM_ID` int(11) NOT NULL,
  `INGREDIENT_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `removable`
--

INSERT INTO `removable` (`ITEM_ID`, `INGREDIENT_ID`) VALUES
(28, 3);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `ABOUT1` text DEFAULT NULL,
  `ABOUT2` text DEFAULT NULL,
  `YEARS` int(11) DEFAULT NULL,
  `PHONE` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(40) DEFAULT NULL,
  `FACEBOOK` text DEFAULT NULL,
  `INSTAGRAM` text DEFAULT NULL,
  `KITCHEN_STATUS` enum('Open','Closed','Busy') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`ABOUT1`, `ABOUT2`, `YEARS`, `PHONE`, `EMAIL`, `FACEBOOK`, `INSTAGRAM`, `KITCHEN_STATUS`) VALUES
('Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos erat ipsum et lorem et sit, sed stet lorem sit.', 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet', 4, '+961 06 350 650', 'daddysres002@gmail.com', 'https://www.facebook.com/p/Daddys-100064091701196/', 'https://www.instagram.com/daddys.cafe.lb?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==', 'Busy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addable`
--
ALTER TABLE `addable`
  ADD PRIMARY KEY (`ITEM_ID`,`INGREDIENT_ID`),
  ADD KEY `INGREDIENT_ID` (`INGREDIENT_ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `PHONE_NUMBER` (`PHONE_NUMBER`);

--
-- Indexes for table `featured`
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ITEM_ID` (`ITEM_ID`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CATEGORY_ID` (`CATEGORY_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `ITEM_ID` (`ITEM_ID`),
  ADD KEY `ORDER_ID` (`ORDER_ID`);

--
-- Indexes for table `order_in_dining`
--
ALTER TABLE `order_in_dining`
  ADD PRIMARY KEY (`ORDER_ID`,`TABLE_NUMBER`);

--
-- Indexes for table `order_out_dining`
--
ALTER TABLE `order_out_dining`
  ADD PRIMARY KEY (`ORDER_ID`,`CUSTOMER_ID`),
  ADD KEY `CUSTOMER_ID` (`CUSTOMER_ID`);

--
-- Indexes for table `recommended`
--
ALTER TABLE `recommended`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ITEM_ID` (`ITEM_ID`);

--
-- Indexes for table `removable`
--
ALTER TABLE `removable`
  ADD PRIMARY KEY (`ITEM_ID`,`INGREDIENT_ID`),
  ADD KEY `INGREDIENT_ID` (`INGREDIENT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1035;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `featured`
--
ALTER TABLE `featured`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `recommended`
--
ALTER TABLE `recommended`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addable`
--
ALTER TABLE `addable`
  ADD CONSTRAINT `addable_ibfk_1` FOREIGN KEY (`ITEM_ID`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addable_ibfk_2` FOREIGN KEY (`INGREDIENT_ID`) REFERENCES `ingredient` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `featured`
--
ALTER TABLE `featured`
  ADD CONSTRAINT `featured_ibfk_1` FOREIGN KEY (`ITEM_ID`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`ITEM_ID`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`ORDER_ID`) REFERENCES `orders` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_in_dining`
--
ALTER TABLE `order_in_dining`
  ADD CONSTRAINT `order_in_dining_ibfk_1` FOREIGN KEY (`ORDER_ID`) REFERENCES `orders` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_out_dining`
--
ALTER TABLE `order_out_dining`
  ADD CONSTRAINT `order_out_dining_ibfk_1` FOREIGN KEY (`ORDER_ID`) REFERENCES `orders` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_out_dining_ibfk_2` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `customer` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recommended`
--
ALTER TABLE `recommended`
  ADD CONSTRAINT `recommended_ibfk_1` FOREIGN KEY (`ITEM_ID`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `removable`
--
ALTER TABLE `removable`
  ADD CONSTRAINT `removable_ibfk_1` FOREIGN KEY (`ITEM_ID`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `removable_ibfk_2` FOREIGN KEY (`INGREDIENT_ID`) REFERENCES `ingredient` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
