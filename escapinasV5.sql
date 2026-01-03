-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 03, 2026 at 07:07 PM
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
-- Database: `escapinas`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `number_of_persons` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `booking_status` enum('Pending','Confirmed','Cancelled') DEFAULT NULL,
  `booking_reference` varchar(50) DEFAULT NULL,
  `tour_id` int(11) NOT NULL,
  `locpoints_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `schedule_id`, `number_of_persons`, `total_amount`, `booking_status`, `booking_reference`, `tour_id`, `locpoints_id`) VALUES
(14, 2, 1, 1, 11757.76, 'Confirmed', 'ESC-2026-5320CF', 1, 7),
(15, 2, 1, 1, 12093.76, 'Confirmed', 'ESC-2026-495D62', 1, 7),
(16, 2, 1, 1, 12877.76, 'Confirmed', 'ESC-2026-4138CD', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` int(11) NOT NULL,
  `island_id` int(11) DEFAULT NULL,
  `destination_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`destination_id`, `island_id`, `destination_name`, `description`, `status`) VALUES
(1, 1, 'Baguio-Sagada', 'Cool mountains, culture, scenic views', 'Active'),
(2, 1, 'Ilocos', 'Spanish-era heritage and northern coast', 'Active'),
(3, 1, 'La Union', 'Surfing and relaxation', 'Active'),
(4, 1, 'Bicol', 'Volcanoes, island hopping', 'Active'),
(5, 1, 'Batangas-Tagaytay', 'Scenic lake and cool weather', 'Active'),
(6, 2, 'Cebu', 'History, waterfalls, marine adventures', 'Active'),
(7, 2, 'Bohol', 'Countryside tour highlighting natural wonders', 'Active'),
(8, 2, 'Boracay', 'World-famous beach destination with powdery sand', 'Active'),
(9, 3, 'Davao', 'City tour with parks, wildlife, and nature', 'Active'),
(10, 3, 'Siargao', 'Surfing paradise with lagoons and island hopping', 'Active'),
(11, 3, 'Cagayan de Oro', 'Adventure and thrill-seeker activities', 'Active'),
(12, 1, 'Palawan', 'Enjoy cold breeze and view of beaches', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `location_points`
--

CREATE TABLE `location_points` (
  `locpoints_id` int(11) NOT NULL,
  `origin_island` enum('Luzon','Visayas','Mindanao','Tours Requiring AirTravel') NOT NULL,
  `pickup_points` varchar(255) NOT NULL,
  `dropoff_points` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location_points`
--

INSERT INTO `location_points` (`locpoints_id`, `origin_island`, `pickup_points`, `dropoff_points`) VALUES
(1, 'Luzon', 'Cubao', 'Cubao'),
(2, 'Luzon', 'Makati', 'Makati'),
(3, 'Visayas', 'Cebu City', 'Cebu City'),
(4, 'Visayas', 'Iloilo City', 'Iloilo City'),
(5, 'Mindanao', 'Davao City', 'Davao City'),
(6, 'Mindanao', 'Cagayan de Oro', 'Cagayan de Oro'),
(7, 'Tours Requiring AirTravel', 'NAIA (Manila)', 'NAIA (Manila)'),
(8, 'Tours Requiring AirTravel', 'Mactan–Cebu International Airport', 'Mactan–Cebu International Airport'),
(9, 'Tours Requiring AirTravel', 'Davao International Airport', 'Davao International Airport');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paypal_order_id` varchar(100) DEFAULT NULL,
  `paypal_capture_id` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) DEFAULT 'PHP',
  `payment_status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `user_id`, `paypal_order_id`, `paypal_capture_id`, `amount`, `currency`, `payment_status`, `created_at`) VALUES
(1, 15, 2, '570938822N054872N', '67445019GT426520M', 12093.76, 'PHP', 'COMPLETED', '2026-01-03 17:56:36'),
(2, 16, 2, '6Y015898EE628501L', '8LS31742H2964741Y', 12877.76, 'PHP', 'COMPLETED', '2026-01-03 18:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_dropoff`
--

CREATE TABLE `pickup_dropoff` (
  `location_id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `location_name` varchar(150) DEFAULT NULL,
  `location_address` text DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `dropoff_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `review_text` varchar(255) DEFAULT NULL,
  `rating_score` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`review_id`, `user_id`, `tour_id`, `review_text`, `rating_score`) VALUES
(12, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 5),
(13, 1, 1, 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 4),
(14, 1, 2, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco.', 5),
(15, 1, 2, 'Laboris nisi ut aliquip ex ea commodo consequat.', 5),
(16, 1, 3, 'Duis aute irure dolor in reprehenderit in voluptate velit.', 3),
(17, 1, 3, 'Esse cillum dolore eu fugiat nulla pariatur.', 4),
(18, 1, 4, 'Excepteur sint occaecat cupidatat non proident.', 4),
(19, 1, 10, 'Sunt in culpa qui officia deserunt mollit anim id est laborum.', 5),
(20, 1, 10, 'Lorem ipsum fresh surf vibes!', 5),
(21, 1, 10, 'Bit rainy but still good.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `island_id` int(11) NOT NULL,
  `island_name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`island_id`, `island_name`, `description`) VALUES
(1, 'Luzon', 'Northern and central islands of the Philippines'),
(2, 'Visayas', 'Central islands of the Philippines'),
(3, 'Mindanao', 'Southern islands of the Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `region_fees`
--

CREATE TABLE `region_fees` (
  `fee_id` int(11) NOT NULL,
  `origin_island` enum('Luzon','Visayas','Mindanao') DEFAULT NULL,
  `destination_island` enum('Luzon','Visayas','Mindanao') DEFAULT NULL,
  `additional_fee` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `region_fees`
--

INSERT INTO `region_fees` (`fee_id`, `origin_island`, `destination_island`, `additional_fee`) VALUES
(1, 'Luzon', 'Luzon', 0.00),
(2, 'Luzon', 'Visayas', 2800.00),
(3, 'Luzon', 'Mindanao', 3500.00),
(4, 'Visayas', 'Visayas', 0.00),
(5, 'Visayas', 'Luzon', 2800.00),
(6, 'Visayas', 'Mindanao', 2200.00),
(7, 'Mindanao', 'Mindanao', 0.00),
(8, 'Mindanao', 'Luzon', 3500.00),
(9, 'Mindanao', 'Visayas', 2200.00);

-- --------------------------------------------------------

--
-- Table structure for table `tour_about`
--

CREATE TABLE `tour_about` (
  `about_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_about`
--

INSERT INTO `tour_about` (`about_id`, `tour_id`, `description`) VALUES
(1, 1, 'Experience the cool climate and rich culture of Baguio and Sagada. Explore scenic mountain views, historical landmarks, and local traditions. Enjoy adventure activities such as cave exploration and hanging coffins visits, combined with relaxing moments in Burnham Park. Perfect for nature lovers and culture enthusiasts.'),
(2, 2, 'Discover the Spanish-era heritage of Ilocos, including Vigan and Laoag. Walk along cobblestone streets, visit historic churches, and marvel at coastal landscapes. Taste local delicacies and experience traditional crafts. A mix of history, culture, and scenic views awaits every traveler.'),
(3, 3, 'Relax and unwind at the beautiful beaches of La Union. Learn surfing techniques or simply enjoy the laid-back atmosphere. Explore local temples, waterfalls, and hidden spots for a complete escape. This tour blends adventure and serenity for an unforgettable experience.'),
(4, 4, 'Embark on an adventure in Bicol, famous for its volcanoes and islands. Trek Mayon Volcano, visit Cagsawa Ruins, and swim with whale sharks in Donsol. Experience island hopping and local culture along the way. Perfect for thrill-seekers and nature lovers alike.'),
(5, 5, 'Enjoy the cool weather and scenic views of Batangas and Tagaytay. Visit Taal Volcano, explore Sky Ranch, and have a picnic at local gardens. Savor local cuisine and take in panoramic landscapes. Ideal for a short and refreshing getaway.'),
(6, 6, 'Explore Cebu’s rich history and natural wonders. Visit Magellan’s Cross, Basilica del Santo Niño, and stunning waterfalls. Enjoy marine adventures and discover local culture along the way. A perfect combination of sightseeing and relaxation.'),
(7, 7, 'Discover the scenic countryside of Bohol, including the Chocolate Hills and Tarsier Sanctuary. Cruise the Loboc River and visit historic churches. Enjoy local food and cultural experiences. This tour is perfect for nature and culture enthusiasts.'),
(8, 8, 'Experience the world-famous beaches of Boracay. Relax on white sands, try water activities, and explore Puka Beach and Bulabog. Enjoy sunset sailing and vibrant nightlife. Perfect for beach lovers and adventure seekers alike.'),
(9, 9, 'Explore the natural beauty of Davao. Visit the Philippine Eagle Center, Eden Nature Park, and Samal Island. Enjoy city attractions and experience local culture and cuisine. Ideal for families and nature lovers.'),
(10, 10, 'Dive into the surfing paradise of Siargao. Ride the waves at Cloud 9, explore Magpupungko Rock Pools, and discover Sugba Lagoon. Visit Naked Island and enjoy the serene beaches. This tour is perfect for adventure enthusiasts and water lovers.'),
(11, 11, 'Embark on an action-packed adventure in Cagayan de Oro. Experience white water rafting, explore Mapawa Nature Park, and have fun at Seven Seas Waterpark. Enjoy local culture and cuisine. Perfect for thrill-seekers and families.'),
(12, 12, 'Explore the breathtaking beauty of Palawan. Visit Puerto Princesa Underground River, Honda Bay, and the stunning beaches of El Nido. Snorkel at Coron Reef, relax at Palawan resorts, and take in the scenic lagoons and lakes. A complete tropical adventure for nature lovers and explorers.');

-- --------------------------------------------------------

--
-- Table structure for table `tour_exclusions`
--

CREATE TABLE `tour_exclusions` (
  `exclusion_id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `exclusion_detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_exclusions`
--

INSERT INTO `tour_exclusions` (`exclusion_id`, `tour_id`, `exclusion_detail`) VALUES
(1, 1, 'Personal expenses'),
(2, 1, 'Entrance fees not mentioned'),
(3, 1, 'Travel insurance'),
(4, 1, 'Dinner unless specified'),
(5, 2, 'Personal expenses'),
(6, 2, 'Entrance fees not included'),
(7, 2, 'Travel insurance'),
(8, 3, 'Equipment damage fees'),
(9, 3, 'Meals not mentioned'),
(10, 3, 'Travel insurance'),
(11, 4, 'Extra snacks and drinks'),
(12, 4, 'Travel insurance'),
(13, 4, 'Personal expenses'),
(14, 5, 'Meals not included'),
(15, 5, 'Souvenirs'),
(16, 5, 'Travel insurance'),
(17, 6, 'Personal expenses'),
(18, 6, 'Entrance fees not mentioned'),
(19, 6, 'Travel insurance'),
(20, 7, 'Meals not included'),
(21, 7, 'Souvenirs'),
(22, 7, 'Travel insurance'),
(23, 8, 'Equipment rental fees'),
(24, 8, 'Alcoholic beverages'),
(25, 8, 'Travel insurance'),
(26, 9, 'Meals not mentioned'),
(27, 9, 'Souvenirs'),
(28, 9, 'Travel insurance'),
(29, 10, 'Personal expenses'),
(30, 10, 'Meals not included'),
(31, 10, 'Travel insurance'),
(32, 11, 'Meals and drinks'),
(33, 11, 'Souvenirs'),
(34, 11, 'Travel insurance'),
(35, 12, 'Alcoholic beverages'),
(36, 12, 'Personal expenses'),
(37, 12, 'Travel insurance'),
(38, 12, 'Equipment damage fees');

-- --------------------------------------------------------

--
-- Table structure for table `tour_inclusions`
--

CREATE TABLE `tour_inclusions` (
  `inclusion_id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `inclusion_detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_inclusions`
--

INSERT INTO `tour_inclusions` (`inclusion_id`, `tour_id`, `inclusion_detail`) VALUES
(1, 1, 'Baguio city tour'),
(2, 1, 'Sagada cultural visit'),
(3, 1, 'Transportation between Baguio and Sagada'),
(4, 1, 'Breakfast and lunch included'),
(5, 1, 'Tour guide'),
(6, 2, 'Ilocos heritage site visits'),
(7, 2, 'Coastal sightseeing'),
(8, 2, 'Transportation'),
(9, 2, 'Meals included'),
(10, 2, 'Local guide'),
(11, 3, 'Surfing lessons'),
(12, 3, 'Beach relaxation'),
(13, 3, 'Equipment provided'),
(14, 3, 'Local guide'),
(15, 4, 'Volcano trekking'),
(16, 4, 'Island hopping tour'),
(17, 4, 'Boat transfers included'),
(18, 4, 'Meals and snacks'),
(19, 4, 'Guide services'),
(20, 5, 'Lake sightseeing'),
(21, 5, 'Tagaytay city tour'),
(22, 5, 'Breakfast included'),
(23, 5, 'Tour guide'),
(24, 5, 'Transportation'),
(25, 6, 'City tour of Cebu'),
(26, 6, 'Waterfall visits'),
(27, 6, 'Marine adventure activities'),
(28, 6, 'Transportation'),
(29, 6, 'Meals included'),
(30, 7, 'Bohol countryside tour'),
(31, 7, 'Chocolate Hills visit'),
(32, 7, 'River cruise'),
(33, 7, 'Transportation'),
(34, 7, 'Tour guide'),
(35, 8, 'Boracay island tour'),
(36, 8, 'Beach access'),
(37, 8, 'Water activities'),
(38, 8, 'Meals and refreshments'),
(39, 8, 'Local guide'),
(40, 9, 'City tour of Davao'),
(41, 9, 'Wildlife park visit'),
(42, 9, 'Nature exploration'),
(43, 9, 'Transportation'),
(44, 9, 'Guide included'),
(45, 10, 'Surfing lessons'),
(46, 10, 'Island hopping'),
(47, 10, 'Lagoon visit'),
(48, 10, 'Equipment provided'),
(49, 10, 'Tour guide'),
(50, 11, 'Adventure activities'),
(51, 11, 'City tour of Cagayan de Oro'),
(52, 11, 'Transportation included'),
(53, 11, 'Guide services'),
(54, 12, 'Beach hopping in Palawan'),
(55, 12, 'Snorkeling activities'),
(56, 12, 'Local transportation included'),
(57, 12, 'Breakfast and lunch'),
(58, 12, 'Tour guide services');

-- --------------------------------------------------------

--
-- Table structure for table `tour_itinerary`
--

CREATE TABLE `tour_itinerary` (
  `itinerary_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `day_number` int(11) NOT NULL,
  `short_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_itinerary`
--

INSERT INTO `tour_itinerary` (`itinerary_id`, `tour_id`, `day_number`, `short_desc`) VALUES
(1, 1, 1, 'Arrival at Baguio City and check-in at the hotel. (Breakfast included)'),
(2, 1, 1, 'Visit Burnham Park and take a boat ride on the lake.'),
(3, 1, 1, 'Explore the Baguio Mines View Park for panoramic views.'),
(4, 1, 1, 'Enjoy lunch at the famous Good Taste Restaurant. (Lunch at your own account)'),
(5, 1, 1, 'Tour The Mansion, the official summer residence of the Philippine President.'),
(6, 1, 1, 'Take a stroll through the vibrant The Wright Park.'),
(7, 1, 1, 'Stroll in the Baguio Session Road for shopping and local treats.'),
(8, 1, 1, 'Enjoy and Shop at the Baguio Public Night Market.'),
(9, 1, 2, 'Travel to Sagada and visit the Hanging Coffins.'),
(10, 1, 2, 'Explore the Sumaguing Cave with a guided spelunking tour.'),
(11, 1, 2, 'Lunch at a local Sagada restaurant. (Lunch at your own account)'),
(12, 1, 2, 'Hike to Echo Valley and enjoy the scenic views.'),
(13, 1, 2, 'Travel back to Manila'),
(14, 2, 1, 'Arrival at Ilocos and visit the Bangui Windmills.'),
(15, 2, 1, 'Explore the historic Cape Bojeador Lighthouse.'),
(16, 2, 1, 'Visit the beautiful Patapat Viaduct along the coast.'),
(17, 2, 1, 'Enjoy local Ilocano cuisine for lunch. (Lunch included)'),
(18, 2, 1, 'Walk along historic cobblestone streets of Vigan.'),
(19, 2, 1, 'Shop for local crafts and souvenirs at Vigan Market.'),
(20, 2, 1, 'Enjoy free dinner in hotel.'),
(21, 2, 2, 'Breakfast at the hotel. (Breakfast included)'),
(22, 2, 2, 'Visit the beautiful Bantay Church and Bell Tower.'),
(23, 2, 2, 'Tour the impressive Sand Dunes of Laoag.'),
(24, 2, 2, 'Enjoy local delicacies for lunch. (Lunch at your own account)'),
(25, 2, 2, 'Experience thrilling 4x4 rides in the sand dunes.'),
(26, 2, 2, 'Visit the iconic UNESCO World Heritage Paoay Church.'),
(27, 2, 3, 'Breakfast at the hotel. (Breakfast included)'),
(28, 2, 3, 'See stunning white rock formations along the coast.'),
(29, 2, 3, 'Lunch at a local restaurant. (Lunch at your own account)'),
(30, 2, 3, 'Explore the historic Malacañang of the North.'),
(31, 2, 3, 'Enjoy shopping for souvenirs at the Ilocos Norte Capitol.'),
(32, 2, 4, 'Breakfast at the hotel. (Breakfast included)'),
(33, 2, 4, 'Relax at the pristine beaches of Pagudpud.'),
(34, 2, 4, 'Departure to Manila'),
(35, 3, 1, 'Arrive in La Union and check-in at the hotel. (Breakfast included)'),
(36, 3, 1, 'Relax and unwind at the San Juan Surf Beach.'),
(37, 3, 2, 'Breakfast at the hotel. (Breakfast included)'),
(38, 3, 2, 'Visit Ma-Cho Temple, a Taoist temple with ocean views.'),
(39, 3, 2, 'Enjoy lunch at a seaside restaurant. (Lunch at your own account)'),
(40, 3, 2, 'Explore Tangadan Falls and enjoy the cold water.'),
(41, 3, 2, 'Check in the Thunderbird Resort for a luxurious stay.'),
(42, 3, 3, 'Breakfast at the resort. (Breakfast included)'),
(43, 3, 3, 'Relax and unwind at the resort or explore nearby cafes.'),
(44, 3, 3, 'Enjoy the luxurious amenities and ocean views.'),
(45, 3, 3, 'Departure to Manila'),
(46, 4, 1, 'Arrival at Legazpi City and check-in at the hotel.'),
(47, 4, 1, 'Enjoy free lunch at a local restaurant. (Lunch included)'),
(48, 4, 1, 'Visit the Mayon Volcano View and Photo Stop.'),
(49, 4, 2, 'Breakfast at the hotel. (Breakfast included)'),
(50, 4, 2, 'Discover the Cagsawa Ruins and learn about its history.'),
(51, 4, 2, 'Take a scenic ATV ride around the base of Mayon Volcano.'),
(52, 4, 2, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(53, 4, 2, 'Explore local markets.'),
(54, 4, 3, 'Breakfast at the hotel. (Breakfast included)'),
(55, 4, 3, 'Travel to Donsol for whale shark watching.'),
(56, 4, 3, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(57, 4, 3, 'Swim with the gentle giants of the sea.'),
(58, 4, 4, 'Breakfast at the hotel. (Breakfast included)'),
(59, 4, 4, 'Island hopping tour in Caramoan Islands.'),
(60, 4, 4, 'Enjoy lunch on one of the islands. (Lunch at your own account)'),
(61, 4, 4, 'Departure to Manila'),
(62, 5, 1, 'Arrival at Tagaytay and visit the Taal Volcano Viewpoint.'),
(63, 5, 1, 'Breakfast at the buffet restaurant with a view. (Breakfast included)'),
(64, 5, 1, 'Enjoy rides and leisure activities at Sky Ranch.'),
(65, 5, 2, 'Relax and have a picnic in scenic surroundings.'),
(66, 5, 2, 'Explore different gardens and cafes in Tagaytay.'),
(67, 5, 2, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(68, 5, 2, 'Visit Tagaytay Public Market for local products.'),
(69, 5, 3, 'Travel to Batangas and check-in at the beach resort.'),
(70, 5, 3, 'Enjoy a relaxing morning by the beach.'),
(71, 5, 3, 'Have lunch at the resort. (Lunch included)'),
(72, 5, 3, 'Dive or snorkel in Anilao with clear waters.'),
(73, 5, 3, 'Departure to Manila'),
(74, 6, 1, 'Arrival at Cebu City and check-in at the hotel. (Breakfast included)'),
(75, 6, 1, 'See the historical cross planted by Magellan.'),
(76, 6, 1, 'Enjoy local Cebuano cuisine for lunch. (Lunch at your own account)'),
(77, 6, 1, 'Visit the Magellan Basilica Minore del Santo Niño.'),
(78, 6, 1, 'Visit the vibrant Carbon Market for local goods.'),
(79, 6, 2, 'Breakfast at the hotel. (Breakfast included)'),
(80, 6, 2, 'Explore the stunning beaches of Mactan Island.'),
(81, 6, 2, 'Visit Kawasan and swim in with the waterfalls.'),
(82, 6, 2, 'Have lunch at a Kawasan. (Lunch included)'),
(83, 6, 2, 'Relax and unwind at the falls.'),
(84, 6, 3, 'Breakfast at the hotel. (Breakfast included)'),
(85, 6, 3, 'Enjoy the Oslob Whale Shark Watching experience.'),
(86, 6, 3, 'Have lunch at a local restaurant. (Lunch at your own account)'),
(87, 6, 3, 'Shop for souvenirs at local markets.'),
(88, 6, 3, 'Departure to Manila'),
(89, 7, 1, 'Arrival at Bohol and check-in at the hotel. (Breakfast included)'),
(90, 7, 1, 'See the iconic Chocolate Hills and take photos.'),
(91, 7, 1, 'Visit the Tarsier Sanctuary to see the tiny primates.'),
(92, 7, 1, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(93, 7, 1, 'Find unique souvenirs at the Bohol Bee Farm.'),
(94, 7, 2, 'Breakfast at the hotel. (Breakfast included)'),
(95, 7, 2, 'Cruise along the Loboc River and enjoy a buffet lunch on a floating restaurant.'),
(96, 7, 2, 'Enjoy free time at Panglao Beach.'),
(97, 7, 3, 'Breakfast at the hotel. (Breakfast included)'),
(98, 7, 3, 'Enjoy amenities at the hotel or explore nearby cafes.'),
(99, 7, 3, 'Visit the Baclayon Church, one of the oldest churches in the Philippines.'),
(100, 7, 3, 'Have lunch at a local restaurant. (Lunch at your own account)'),
(101, 7, 3, 'Departure to Manila'),
(102, 8, 1, 'Arrival at Boracay and check-in at the hotel. (Lunch included)'),
(103, 8, 1, 'Relax and sunbathe on Boracay that is famous for White Beach.'),
(104, 8, 1, 'Enjoy amenities of the hotel (pool, spa, beach).'),
(105, 8, 2, 'Breakfast at the hotel. (Breakfast included)'),
(106, 8, 2, 'Go island hopping in Puka Shell Beach, Crocodile Island, and Crystal Cove.'),
(107, 8, 2, 'Have lunch on one of the islands. (Lunch included)'),
(108, 8, 2, 'Relax and unwind at the beach.'),
(109, 8, 3, 'Check in at the Bulabog Beach Resort. (Breakfast included)'),
(110, 8, 3, 'Explore Boracay with vibrant underwater world with scuba diving.'),
(111, 8, 3, 'Engage in water sports like kiteboarding and windsurfing.'),
(112, 8, 3, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(113, 8, 4, 'Breakfast at the hotel. (Breakfast included)'),
(114, 8, 4, 'Relax and enjoy the beautiful beach scenery.'),
(115, 8, 4, 'Shop for souvenirs at D Mall Boracay.'),
(116, 8, 4, 'Sail along the coast and watch a breathtaking sunset.'),
(117, 8, 4, 'Departure to Manila'),
(118, 9, 1, 'Arrival at Davao City and check-in at the hotel. (Breakfast included)'),
(119, 9, 1, 'Visit the Philippine Eagle Center to see the national bird.'),
(120, 9, 1, 'Enjoy local Davao cuisine for lunch. (Lunch at your own account)'),
(121, 9, 1, 'See the majestic Philippine eagle up close.'),
(122, 9, 2, 'Breakfast at the hotel. (Breakfast included)'),
(123, 9, 2, 'Explore the vibrant Davao City Market for local products.'),
(124, 9, 2, 'Visit the Davao Crocodile Park and learn about crocodile conservation.'),
(125, 9, 2, 'Enjoy lunch at a local restaurant. (Lunch at your own account)'),
(126, 9, 2, 'Relax at the Eden Nature Park and experience nature trails.'),
(127, 9, 3, 'Breakfast at the hotel. (Breakfast included)'),
(128, 9, 3, 'Visit different shops at the Aldevinco Shopping Center.'),
(129, 9, 3, 'Have lunch at a local restaurant. (Lunch at your own account)'),
(130, 9, 3, 'Explore the Peoples Park.'),
(131, 9, 4, 'Breakfast at the hotel. (Breakfast included)'),
(132, 9, 4, 'Take a boat tour to Samal Island and visit Hagimit Falls.'),
(133, 9, 4, 'Enjoy lunch on Samal Island. (Lunch at your own account)'),
(134, 9, 4, 'Relax on the pristine beaches of Samal Island.'),
(135, 9, 4, 'Departure to Manila'),
(136, 10, 1, 'Arrival in Siargao, transfer to hotel, check-in, and settle in.'),
(137, 10, 1, 'Breakfast at the hotel.'),
(138, 10, 1, 'Surfing session at Cloud 9 for beginners and enthusiasts.'),
(139, 10, 1, 'Lunch at a local seaside restaurant.'),
(140, 10, 1, 'Explore General Luna town, souvenir and local handicraft shopping.'),
(141, 10, 1, 'Dinner at a beachfront restaurant.'),
(142, 10, 2, 'Breakfast at the hotel.'),
(143, 10, 2, 'Visit Magpupungko Rock Pools during low tide, swimming and relaxing.'),
(144, 10, 2, 'Lunch picnic at Magpupungko beach.'),
(145, 10, 2, 'Optional snorkeling or cliff diving.'),
(146, 10, 2, 'Return to hotel and free time for shopping.'),
(147, 10, 2, 'Dinner at local restaurant.'),
(148, 10, 3, 'Breakfast at the hotel.'),
(149, 10, 3, 'Island hopping to Sugba Lagoon with kayaking, swimming, and paddleboarding.'),
(150, 10, 3, 'Lunch on the boat or at nearby island.'),
(151, 10, 3, 'Return to hotel for rest and optional shopping.'),
(152, 10, 3, 'Dinner at hotel or beachfront café.'),
(153, 10, 4, 'Breakfast at hotel.'),
(154, 10, 4, 'Relax and unwind at Naked Island, swimming and sunbathing.'),
(155, 10, 4, 'Lunch on the island.'),
(156, 10, 4, 'Check-out and transfer to airport for departure.'),
(157, 11, 1, 'Arrival in Cagayan de Oro, hotel check-in and settle in.'),
(158, 11, 1, 'Breakfast at hotel.'),
(159, 11, 1, 'Exciting White Water Rafting adventure in Cagayan River.'),
(160, 11, 1, 'Lunch by the riverside after rafting.'),
(161, 11, 1, 'Free time for souvenir shopping at local market.'),
(162, 11, 1, 'Dinner at local restaurant.'),
(163, 11, 2, 'Breakfast at hotel.'),
(164, 11, 2, 'Hiking and nature exploration at Mapawa Nature Park.'),
(165, 11, 2, 'Lunch picnic at the park.'),
(166, 11, 2, 'Zipline or other adventure activities.'),
(167, 11, 2, 'Return to hotel for rest and shopping.'),
(168, 11, 2, 'Dinner at hotel or local dining spot.'),
(169, 11, 3, 'Breakfast at hotel.'),
(170, 11, 3, 'Fun-filled day at Seven Seas Waterpark, swimming and slides.'),
(171, 11, 3, 'Lunch at the park.'),
(172, 11, 3, 'Relax at hotel and optional local shopping.'),
(173, 11, 3, 'Check-out and transfer to airport for departure.'),
(174, 12, 1, 'Arrival in Puerto Princesa, check-in at hotel and settle in.'),
(175, 12, 1, 'Breakfast at hotel.'),
(176, 12, 1, 'Visit Puerto Princesa Underground River.'),
(177, 12, 1, 'Lunch at local restaurant.'),
(178, 12, 1, 'Explore local market for souvenirs and handicrafts.'),
(179, 12, 1, 'Dinner at beachfront restaurant.'),
(180, 12, 2, 'Breakfast at hotel.'),
(181, 12, 2, 'Honda Bay Island Hopping including snorkeling and beach visits.'),
(182, 12, 2, 'Lunch on one of the islands.'),
(183, 12, 2, 'Relax and enjoy beach activities, optional shopping.'),
(184, 12, 2, 'Dinner at hotel or nearby restaurant.'),
(185, 12, 3, 'Breakfast at hotel.'),
(186, 12, 3, 'El Nido Beaches and Lagoons tour with kayaking and swimming.'),
(187, 12, 3, 'Lunch at El Nido island restaurant.'),
(188, 12, 3, 'Free time for sightseeing and shopping in El Nido.'),
(189, 12, 3, 'Dinner and overnight stay.'),
(190, 12, 4, 'Breakfast at hotel.'),
(191, 12, 4, 'Visit Kayangan Lake, Coron for swimming and photo opportunities.'),
(192, 12, 4, 'Lunch at local eatery.'),
(193, 12, 4, 'Optional shopping for local products.'),
(194, 12, 4, 'Return to hotel and dinner.'),
(195, 12, 5, 'Breakfast at hotel.'),
(196, 12, 5, 'Snorkeling adventure at Coron Reef.'),
(197, 12, 5, 'Lunch on the boat or at nearby beach.'),
(198, 12, 5, 'Relax and enjoy island activities.'),
(199, 12, 5, 'Dinner at hotel or beachside restaurant.'),
(200, 12, 6, 'Breakfast at hotel.'),
(201, 12, 6, 'Free time and relaxation at Palawan Beach Resort.'),
(202, 12, 6, 'Check-out and transfer to airport for departure.');

-- --------------------------------------------------------

--
-- Table structure for table `tour_packages`
--

CREATE TABLE `tour_packages` (
  `tour_id` int(11) NOT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `tour_name` varchar(150) DEFAULT NULL,
  `duration_days` int(11) DEFAULT NULL,
  `duration_nights` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` enum('Available','Unavailable') DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_packages`
--

INSERT INTO `tour_packages` (`tour_id`, `destination_id`, `tour_name`, `duration_days`, `duration_nights`, `description`, `price`, `status`, `image`, `banner_image`) VALUES
(1, 1, 'Baguio-Sagada Tour', 4, 3, 'A cool-climate adventure combining Baguio city charm and Sagada culture.', 7998.00, 'Available', 'assets/images/baguio_sagada.jpg', NULL),
(2, 2, 'Ilocos-Laoag Tour', 4, 3, 'A heritage and coastal tour showcasing Spanish-era landmarks.', 8998.00, 'Available', 'assets/images/ilocos_laoag.jpg', NULL),
(3, 3, 'La Union Tour', 3, 2, 'A laid-back beach and nature escape.', 6998.00, 'Available', 'assets/images/la_union.jpg', NULL),
(4, 4, 'Bicol Tour', 5, 4, 'An adventure-filled tour featuring volcano views and island hopping.', 8998.00, 'Available', 'assets/images/bicol.jpg', NULL),
(5, 5, 'Batangas-Tagaytay Tour', 2, 1, 'A relaxing getaway with cool weather and scenic views.', 5498.00, 'Available', 'assets/images/batangas_tagaytay.jpg', NULL),
(6, 6, 'Cebu City Tour', 4, 3, 'A mix of history, waterfalls, and marine adventures.', 7998.00, 'Available', 'assets/images/cebu.jpg', NULL),
(7, 7, 'Bohol Countryside Tour', 3, 2, 'A scenic countryside tour highlighting natural wonders.', 6998.00, 'Available', 'assets/images/bohol.jpg', NULL),
(8, 8, 'Boracay Island Tour', 4, 3, 'A world-famous beach destination with powdery sand and stunning sunsets.', 7998.00, 'Available', 'assets/images/boracay.jpg', NULL),
(9, 9, 'Davao City Tour', 3, 2, 'A nature-filled city tour featuring wildlife, parks, and island escapes.', 6998.00, 'Available', 'assets/images/davao.jpg', NULL),
(10, 10, 'Siargao Island Tour', 4, 3, 'A tropical paradise famous for surfing, lagoons, and island hopping.', 7998.00, 'Available', 'assets/images/siargao.jpg', NULL),
(11, 11, 'Cagayan de Oro Tour', 3, 2, 'An action-packed adventure tour perfect for thrill-seekers.', 6998.00, 'Available', 'assets/images/cagayan.jpg', NULL),
(12, 5, 'Palawan Island Adventure', 5, 3, 'A breathtaking tour of Palawan including Puerto Princesa, El Nido, and Coron. Explore beaches, lagoons, and vibrant culture.', 12000.00, 'Available', 'assets/images/palawan_tour.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tour_place`
--

CREATE TABLE `tour_place` (
  `place_id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `place_name` varchar(150) DEFAULT NULL,
  `day_number` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_place`
--

INSERT INTO `tour_place` (`place_id`, `tour_id`, `place_name`, `day_number`, `image`) VALUES
(1, 1, 'Burnham Park', 1, 'assets/images/burnham_park.jpg'),
(2, 1, 'Mines View Park', 1, 'assets/images/mines_view.jpg'),
(3, 1, 'The Mansion', 1, 'assets/images/the_mansion.jpg'),
(4, 1, 'Hanging Coffins', 2, 'assets/images/hanging_coffins.jpg'),
(5, 1, 'Sumaguing Cave', 2, 'assets/images/sumaguing_cave.jpg'),
(6, 1, 'Echo Valley', 2, 'assets/images/echo_valley.jpg'),
(7, 2, 'Vigan Calle Crisologo', 1, 'assets/images/vigan_calle.jpg'),
(8, 2, 'Laoag Sand Dunes', 2, 'assets/images/laoag_dunes.jpg'),
(9, 2, 'Paoay Church', 2, 'assets/images/paoay_church.jpg'),
(10, 2, 'Kapurpurawan Rock Formation', 3, 'assets/images/kapurpurawan_rock.jpg'),
(11, 2, 'Pagudpud Beach', 4, 'assets/images/pagudpud_beach.jpg'),
(12, 3, 'San Juan Surf Beach', 1, 'assets/images/san_juan.jpg'),
(13, 3, 'Ma-Cho Temple', 2, 'assets/images/macho_temple.jpg'),
(14, 3, 'Tangadan Falls', 2, 'assets/images/tangadan_falls.jpg'),
(15, 3, 'Thunderbird Resort', 3, 'assets/images/thunderbird_resort.jpg'),
(16, 4, 'Mayon Volcano', 1, 'assets/images/mayon_volcano.jpg'),
(17, 4, 'Cagsawa Ruins', 2, 'assets/images/cagsawa_ruins.jpg'),
(18, 4, 'Donsol Whale Shark Interaction', 3, 'assets/images/donsol_whale.jpg'),
(19, 4, 'Caramoan Islands', 4, 'assets/images/caramoan_islands.jpg'),
(20, 5, 'Taal Volcano View Deck', 1, 'assets/images/taal_volcano.jpg'),
(21, 5, 'Sky Ranch', 1, 'assets/images/sky_ranch.jpg'),
(22, 5, 'Picnic Grove', 2, 'assets/images/picnic_grove.jpg'),
(23, 5, 'Anilao Diving Sites', 3, 'assets/images/anilao_diving.jpg'),
(24, 6, 'Magellan\'s Cross', 1, 'assets/images/magellans_cross.jpg'),
(25, 6, 'Basilica del Santo Niño', 1, 'assets/images/santo_nino.jpg'),
(26, 6, 'Kawasan Falls', 2, 'assets/images/kawasan_falls.jpg'),
(27, 6, 'Oslob Whale Sharks', 3, 'assets/images/oslob_whale.jpg'),
(28, 7, 'Chocolate Hills', 1, 'assets/images/chocolate_hills.jpg'),
(29, 7, 'Tarsier Sanctuary', 1, 'assets/images/tarsier_sanctuary.jpg'),
(30, 7, 'Loboc River Cruise', 2, 'assets/images/loboc_river.jpg'),
(31, 7, 'Baclayon Church', 3, 'assets/images/baclayon_church.jpg'),
(32, 8, 'White Beach', 1, 'assets/images/white_beach.jpg'),
(33, 8, 'Puka Shell Beach', 2, 'assets/images/puka_shell.jpg'),
(34, 8, 'Bulabog Beach', 3, 'assets/images/bulabog_beach.jpg'),
(35, 8, 'Sunset Sailing', 4, 'assets/images/sunset_sailing.jpg'),
(36, 9, 'Philippine Eagle Center', 1, 'assets/images/eagle_center.jpg'),
(37, 9, 'Eden Nature Park', 2, 'assets/images/eden_park.jpg'),
(38, 9, 'People\'s Park', 3, 'assets/images/peoples_park.jpg'),
(39, 9, 'Samal Island', 4, 'assets/images/samal_island.jpg'),
(40, 10, 'Cloud 9', 1, 'assets/images/cloud_nine.jpg'),
(41, 10, 'Magpupungko Rock Pools', 2, 'assets/images/magpupungko_pools.jpg'),
(42, 10, 'Sugba Lagoon', 3, 'assets/images/sugba_lagoon.jpg'),
(43, 10, 'Naked Island', 4, 'assets/images/naked_island.jpg'),
(44, 11, 'White Water Rafting', 1, 'assets/images/white_rafting.jpg'),
(45, 11, 'Mapawa Nature Park', 2, 'assets/images/mapawa_park.jpg'),
(46, 11, 'Seven Seas Waterpark', 3, 'assets/images/seven_seas.jpg'),
(47, 12, 'Puerto Princesa Underground River', 1, 'frontend/assets/images/puerto_princesa.jpg'),
(48, 12, 'Honda Bay Island Hopping', 2, 'frontend/assets/images/honda_bay.jpg'),
(49, 12, 'El Nido Beaches and Lagoons', 3, 'frontend/assets/images/el_nido.jpg'),
(50, 12, 'Kayangan Lake, Coron', 4, 'frontend/assets/images/kayangan_lake.jpg'),
(51, 12, 'Snorkeling at Coron Reef', 5, 'frontend/assets/images/coron_reef.jpg'),
(52, 12, 'Relax at Palawan Beach Resort', 6, 'frontend/assets/images/palawan_resort.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tour_schedules`
--

CREATE TABLE `tour_schedules` (
  `schedule_id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `available_slots` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_schedules`
--

INSERT INTO `tour_schedules` (`schedule_id`, `tour_id`, `start_date`, `end_date`, `available_slots`) VALUES
(1, 1, '2026-01-15', '2026-01-18', 30),
(2, 1, '2026-03-12', '2026-03-15', 30),
(3, 1, '2026-06-10', '2026-06-13', 30),
(4, 1, '2026-10-07', '2026-10-10', 30),
(5, 2, '2026-02-05', '2026-02-08', 30),
(6, 2, '2026-04-16', '2026-04-19', 30),
(7, 2, '2026-07-22', '2026-07-25', 30),
(8, 2, '2026-11-11', '2026-11-14', 30),
(9, 3, '2026-01-23', '2026-01-25', 30),
(10, 3, '2026-05-08', '2026-05-10', 30),
(11, 3, '2026-08-14', '2026-08-16', 30),
(12, 3, '2026-12-04', '2026-12-06', 30),
(13, 4, '2026-02-18', '2026-02-22', 30),
(14, 4, '2026-04-22', '2026-04-26', 30),
(15, 4, '2026-09-09', '2026-09-13', 30),
(16, 5, '2026-01-03', '2026-01-04', 30),
(17, 5, '2026-02-07', '2026-02-08', 30),
(18, 5, '2026-03-07', '2026-03-08', 30),
(19, 5, '2026-04-04', '2026-04-05', 30),
(20, 5, '2026-05-02', '2026-05-03', 30),
(21, 5, '2026-06-06', '2026-06-07', 30),
(22, 5, '2026-07-04', '2026-07-05', 30),
(23, 5, '2026-08-01', '2026-08-02', 30),
(24, 5, '2026-09-05', '2026-09-06', 30),
(25, 5, '2026-10-03', '2026-10-04', 30),
(26, 5, '2026-11-07', '2026-11-08', 30),
(27, 5, '2026-12-05', '2026-12-06', 30),
(28, 6, '2026-03-04', '2026-03-07', 30),
(29, 6, '2026-06-17', '2026-06-20', 30),
(30, 6, '2026-09-23', '2026-09-26', 30),
(31, 7, '2026-02-11', '2026-02-13', 30),
(32, 7, '2026-05-20', '2026-05-22', 30),
(33, 7, '2026-10-21', '2026-10-23', 30),
(34, 8, '2026-01-28', '2026-01-31', 30),
(35, 8, '2026-04-08', '2026-04-11', 30),
(36, 8, '2026-07-01', '2026-07-04', 30),
(37, 8, '2026-12-09', '2026-12-12', 30),
(38, 9, '2026-03-18', '2026-03-20', 30),
(39, 9, '2026-08-19', '2026-08-21', 30),
(40, 9, '2026-11-25', '2026-11-27', 30),
(41, 10, '2026-02-25', '2026-02-28', 30),
(42, 10, '2026-06-03', '2026-06-06', 30),
(43, 10, '2026-09-30', '2026-10-03', 30),
(44, 11, '2026-01-07', '2026-01-09', 30),
(45, 11, '2026-05-27', '2026-05-29', 30),
(46, 11, '2026-10-14', '2026-10-16', 30),
(47, 12, '2026-01-10', '2026-01-15', 20),
(48, 12, '2026-02-05', '2026-02-10', 20),
(49, 12, '2026-03-12', '2026-03-17', 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `middle_initial` char(1) DEFAULT NULL,
  `contact_num` varchar(15) DEFAULT NULL,
  `region` varchar(30) DEFAULT NULL,
  `province` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `middle_initial`, `contact_num`, `region`, `province`, `city`, `email`, `password`, `role`) VALUES
(1, 'Jhon', 'Mackay', 'S', '09995635443', NULL, 'Batangas', 'Tanauan CIty', 'test1@gmail.com', '$2y$10$ig78VJKaY6kVmJlvP9iG3ep3zHQbq3eOxedqWOUqBrASURIMQloFS', 'user'),
(2, 'Joyce Anne', 'Remo', 'P', '09912676928', NULL, 'Batangas', 'City', 'joyceanneremo05@gmail.com', '$2y$10$NNArr6zfvMjbHIlTQ5b9F.i7aQAQGFJ6VuJtE2rEK4upDlqknFFdG', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `voucher_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `external_system` enum('travel_agency','ebook_store') NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `is_redeemed` tinyint(1) DEFAULT 0,
  `issued_at` datetime DEFAULT current_timestamp(),
  `expires_at` datetime NOT NULL,
  `redeemed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `fk_booking_tour` (`tour_id`),
  ADD KEY `fk_booking_location` (`locpoints_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`),
  ADD KEY `island_id` (`island_id`);

--
-- Indexes for table `location_points`
--
ALTER TABLE `location_points`
  ADD PRIMARY KEY (`locpoints_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `pickup_dropoff`
--
ALTER TABLE `pickup_dropoff`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`island_id`);

--
-- Indexes for table `region_fees`
--
ALTER TABLE `region_fees`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `tour_about`
--
ALTER TABLE `tour_about`
  ADD PRIMARY KEY (`about_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_exclusions`
--
ALTER TABLE `tour_exclusions`
  ADD PRIMARY KEY (`exclusion_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_inclusions`
--
ALTER TABLE `tour_inclusions`
  ADD PRIMARY KEY (`inclusion_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_itinerary`
--
ALTER TABLE `tour_itinerary`
  ADD PRIMARY KEY (`itinerary_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `tour_place`
--
ALTER TABLE `tour_place`
  ADD PRIMARY KEY (`place_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_schedules`
--
ALTER TABLE `tour_schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`voucher_id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `location_points`
--
ALTER TABLE `location_points`
  MODIFY `locpoints_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pickup_dropoff`
--
ALTER TABLE `pickup_dropoff`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `island_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `region_fees`
--
ALTER TABLE `region_fees`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tour_about`
--
ALTER TABLE `tour_about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tour_exclusions`
--
ALTER TABLE `tour_exclusions`
  MODIFY `exclusion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tour_inclusions`
--
ALTER TABLE `tour_inclusions`
  MODIFY `inclusion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tour_itinerary`
--
ALTER TABLE `tour_itinerary`
  MODIFY `itinerary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `tour_packages`
--
ALTER TABLE `tour_packages`
  MODIFY `tour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tour_place`
--
ALTER TABLE `tour_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tour_schedules`
--
ALTER TABLE `tour_schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `tour_schedules` (`schedule_id`),
  ADD CONSTRAINT `fk_booking_location` FOREIGN KEY (`locpoints_id`) REFERENCES `location_points` (`locpoints_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking_tour` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_ibfk_1` FOREIGN KEY (`island_id`) REFERENCES `regions` (`island_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE;

--
-- Constraints for table `pickup_dropoff`
--
ALTER TABLE `pickup_dropoff`
  ADD CONSTRAINT `pickup_dropoff_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`),
  ADD CONSTRAINT `pickup_dropoff_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_ratings_tour` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `tour_about`
--
ALTER TABLE `tour_about`
  ADD CONSTRAINT `tour_about_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `tour_exclusions`
--
ALTER TABLE `tour_exclusions`
  ADD CONSTRAINT `tour_exclusions_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `tour_inclusions`
--
ALTER TABLE `tour_inclusions`
  ADD CONSTRAINT `tour_inclusions_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `tour_itinerary`
--
ALTER TABLE `tour_itinerary`
  ADD CONSTRAINT `tour_itinerary_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD CONSTRAINT `tour_packages_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destination_id`);

--
-- Constraints for table `tour_place`
--
ALTER TABLE `tour_place`
  ADD CONSTRAINT `tour_place_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `tour_schedules`
--
ALTER TABLE `tour_schedules`
  ADD CONSTRAINT `tour_schedules_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

--
-- Constraints for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `vouchers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
