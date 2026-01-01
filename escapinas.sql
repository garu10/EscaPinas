-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 01, 2026 at 02:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `booking_reference` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(12, 1, 'Baguio-Sagada', 'Cool mountains, culture, scenic views', 'Active'),
(13, 1, 'Ilocos', 'Spanish-era heritage and northern coast', 'Active'),
(14, 1, 'La Union', 'Surfing and relaxation', 'Active'),
(15, 1, 'Bicol', 'Volcanoes, island hopping', 'Active'),
(16, 1, 'Batangas-Tagaytay', 'Scenic lake and cool weather', 'Active'),
(17, 2, 'Cebu', 'History, waterfalls, marine adventures', 'Active'),
(18, 2, 'Bohol', 'Countryside tour highlighting natural wonders', 'Active'),
(19, 2, 'Boracay', 'World-famous beach destination with powdery sand', 'Active'),
(20, 3, 'Davao', 'City tour with parks, wildlife, and nature', 'Active'),
(21, 3, 'Siargao', 'Surfing paradise with lagoons and island hopping', 'Active'),
(22, 3, 'Cagayan de Oro', 'Adventure and thrill-seeker activities', 'Active'),
(23, 1, 'Baguio-Sagada', 'Cool mountains, culture, scenic views', 'Active'),
(24, 1, 'Ilocos', 'Spanish-era heritage and northern coast', 'Active'),
(25, 1, 'La Union', 'Surfing and relaxation', 'Active'),
(26, 1, 'Bicol', 'Volcanoes, island hopping', 'Active'),
(27, 1, 'Batangas-Tagaytay', 'Scenic lake and cool weather', 'Active'),
(28, 2, 'Cebu', 'History, waterfalls, marine adventures', 'Active'),
(29, 2, 'Bohol', 'Countryside tour highlighting natural wonders', 'Active'),
(30, 2, 'Boracay', 'World-famous beach destination with powdery sand', 'Active'),
(31, 3, 'Davao', 'City tour with parks, wildlife, and nature', 'Active'),
(32, 3, 'Siargao', 'Surfing paradise with lagoons and island hopping', 'Active'),
(33, 3, 'Cagayan de Oro', 'Adventure and thrill-seeker activities', 'Active'),
(34, 1, 'Palawan', 'Enjoy cold breeze and view of beaches', 'Active');

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
  `review_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 'Mindanao', 'Southern islands of the Philippines'),
(4, 'Luzon', 'Northern and central islands of the Philippines'),
(5, 'Visayas', 'Central islands of the Philippines'),
(6, 'Mindanao', 'Southern islands of the Philippines');

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
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_packages`
--

INSERT INTO `tour_packages` (`tour_id`, `destination_id`, `tour_name`, `duration_days`, `duration_nights`, `description`, `price`, `status`, `image`) VALUES
(1, 1, 'Baguio-Sagada Tour', 4, 3, 'A cool-climate adventure combining Baguio city charm and Sagada culture.', 7998.00, 'Available', 'assets/images/baguio_sagada.jpg'),
(2, 2, 'Ilocos-Laoag Tour', 4, 3, 'A heritage and coastal tour showcasing Spanish-era landmarks.', 8998.00, 'Available', 'assets/images/ilocos_laoag.jpg'),
(3, 3, 'La Union Tour', 3, 2, 'A laid-back beach and nature escape.', 6998.00, 'Available', 'assets/images/la_union.jpg'),
(4, 4, 'Bicol Tour', 5, 4, 'An adventure-filled tour featuring volcano views and island hopping.', 8998.00, 'Available', 'assets/images/bicol.jpg'),
(5, 5, 'Batangas-Tagaytay Tour', 2, 1, 'A relaxing getaway with cool weather and scenic views.', 5498.00, 'Available', 'assets/images/batangas_tagaytay.jpg'),
(6, 6, 'Cebu City Tour', 4, 3, 'A mix of history, waterfalls, and marine adventures.', 7998.00, 'Available', 'assets/images/cebu.jpg'),
(7, 7, 'Bohol Countryside Tour', 3, 2, 'A scenic countryside tour highlighting natural wonders.', 6998.00, 'Available', 'assets/images/bohol.jpg'),
(8, 8, 'Boracay Island Tour', 4, 3, 'A world-famous beach destination with powdery sand and stunning sunsets.', 7998.00, 'Available', 'assets/images/boracay.jpg'),
(9, 9, 'Davao City Tour', 3, 2, 'A nature-filled city tour featuring wildlife, parks, and island escapes.', 6998.00, 'Available', 'assets/images/davao.jpg'),
(10, 10, 'Siargao Island Tour', 4, 3, 'A tropical paradise famous for surfing, lagoons, and island hopping.', 7998.00, 'Available', 'assets/images/siargao.jpg'),
(11, 11, 'Cagayan de Oro Tour', 3, 2, 'An action-packed adventure tour perfect for thrill-seekers.', 6998.00, 'Available', 'assets/images/cagayan.jpg'),
(12, 1, 'Baguio-Sagada Tour', 4, 3, 'A cool-climate adventure...', 7998.00, 'Available', 'assets/images/baguio_sagada.jpg'),
(13, 2, 'Ilocos-Laoag Tour', 4, 3, 'A heritage and coastal tour...', 8998.00, 'Available', 'assets/images/ilocos_laoag.jpg'),
(14, 3, 'La Union Tour', 3, 2, 'A laid-back beach escape.', 6998.00, 'Available', 'assets/images/la_union.jpg'),
(15, 4, 'Bicol Tour', 5, 4, 'An adventure-filled tour...', 8998.00, 'Available', 'assets/images/bicol.jpg'),
(16, 5, 'Batangas-Tagaytay Tour', 2, 1, 'A relaxing getaway...', 5498.00, 'Available', 'assets/images/batangas_tagaytay.jpg'),
(17, 6, 'Cebu City Tour', 4, 3, 'A mix of history...', 7998.00, 'Available', 'assets/images/cebu.jpg'),
(18, 7, 'Bohol Countryside Tour', 3, 2, 'A scenic countryside tour...', 6998.00, 'Available', 'assets/images/bohol.jpg'),
(19, 8, 'Boracay Island Tour', 4, 3, 'A world-famous beach...', 7998.00, 'Available', 'assets/images/boracay.jpg'),
(20, 9, 'Davao City Tour', 3, 2, 'A nature-filled city tour...', 6998.00, 'Available', 'assets/images/davao.jpg'),
(21, 10, 'Siargao Island Tour', 4, 3, 'A tropical paradise...', 7998.00, 'Available', 'assets/images/siargao.jpg'),
(22, 11, 'Cagayan de Oro Tour', 3, 2, 'An action-packed adventure...', 6998.00, 'Available', 'assets/images/cagayan.jpg'),
(23, 12, 'Palawan Island Adventure', 5, 3, 'A breathtaking tour of Palawan...', 12000.00, 'Available', 'frontend/assets/images/palawan_tour.jpg');

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
(47, 1, 'Burnham Park', 1, 'assets/images/burnham_park.jpg'),
(48, 1, 'Mines View Park', 1, 'assets/images/mines_view.jpg'),
(49, 1, 'The Mansion', 1, 'assets/images/the_mansion.jpg'),
(50, 1, 'Hanging Coffins', 2, 'assets/images/hanging_coffins.jpg'),
(51, 1, 'Sumaguing Cave', 2, 'assets/images/sumaguing_cave.jpg'),
(52, 1, 'Echo Valley', 2, 'assets/images/echo_valley.jpg'),
(53, 2, 'Vigan Calle Crisologo', 1, 'assets/images/vigan_calle.jpg'),
(54, 2, 'Laoag Sand Dunes', 2, 'assets/images/laoag_dunes.jpg'),
(55, 2, 'Paoay Church', 2, 'assets/images/paoay_church.jpg'),
(56, 2, 'Kapurpurawan Rock Formation', 3, 'assets/images/kapurpurawan_rock.jpg'),
(57, 2, 'Pagudpud Beach', 4, 'assets/images/pagudpud_beach.jpg'),
(58, 3, 'San Juan Surf Beach', 1, 'assets/images/san_juan.jpg'),
(59, 3, 'Ma-Cho Temple', 2, 'assets/images/macho_temple.jpg'),
(60, 3, 'Tangadan Falls', 2, 'assets/images/tangadan_falls.jpg'),
(61, 3, 'Thunderbird Resort', 3, 'assets/images/thunderbird_resort.jpg'),
(62, 4, 'Mayon Volcano', 1, 'assets/images/mayon_volcano.jpg'),
(63, 4, 'Cagsawa Ruins', 2, 'assets/images/cagsawa_ruins.jpg'),
(64, 4, 'Donsol Whale Shark Interaction', 3, 'assets/images/donsol_whale.jpg'),
(65, 4, 'Caramoan Islands', 4, 'assets/images/caramoan_islands.jpg'),
(66, 5, 'Taal Volcano View Deck', 1, 'assets/images/taal_volcano.jpg'),
(67, 5, 'Sky Ranch', 1, 'assets/images/sky_ranch.jpg'),
(68, 5, 'Picnic Grove', 2, 'assets/images/picnic_grove.jpg'),
(69, 5, 'Anilao Diving Sites', 3, 'assets/images/anilao_diving.jpg'),
(70, 6, 'Magellan\'s Cross', 1, 'assets/images/magellans_cross.jpg'),
(71, 6, 'Basilica del Santo Niño', 1, 'assets/images/santo_nino.jpg'),
(72, 6, 'Kawasan Falls', 2, 'assets/images/kawasan_falls.jpg'),
(73, 6, 'Oslob Whale Sharks', 3, 'assets/images/oslob_whale.jpg'),
(74, 7, 'Chocolate Hills', 1, 'assets/images/chocolate_hills.jpg'),
(75, 7, 'Tarsier Sanctuary', 1, 'assets/images/tarsier_sanctuary.jpg'),
(76, 7, 'Loboc River Cruise', 2, 'assets/images/loboc_river.jpg'),
(77, 7, 'Baclayon Church', 3, 'assets/images/baclayon_church.jpg'),
(78, 8, 'White Beach', 1, 'assets/images/white_beach.jpg'),
(79, 8, 'Puka Shell Beach', 2, 'assets/images/puka_shell.jpg'),
(80, 8, 'Bulabog Beach', 3, 'assets/images/bulabog_beach.jpg'),
(81, 8, 'Sunset Sailing', 4, 'assets/images/sunset_sailing.jpg'),
(82, 9, 'Philippine Eagle Center', 1, 'assets/images/eagle_center.jpg'),
(83, 9, 'Eden Nature Park', 2, 'assets/images/eden_park.jpg'),
(84, 9, 'People\'s Park', 3, 'assets/images/peoples_park.jpg'),
(85, 9, 'Samal Island', 4, 'assets/images/samal_island.jpg'),
(86, 10, 'Cloud 9', 1, 'assets/images/cloud_nine.jpg'),
(87, 10, 'Magpupungko Rock Pools', 2, 'assets/images/magpupungko_pools.jpg'),
(88, 10, 'Sugba Lagoon', 3, 'assets/images/sugba_lagoon.jpg'),
(89, 10, 'Naked Island', 4, 'assets/images/naked_island.jpg'),
(90, 11, 'White Water Rafting', 1, 'assets/images/white_rafting.jpg'),
(91, 11, 'Mapawa Nature Park', 2, 'assets/images/mapawa_park.jpg'),
(92, 11, 'Seven Seas Waterpark', 3, 'assets/images/seven_seas.jpg'),
(93, 12, 'Puerto Princesa Underground River', 1, 'frontend/assets/images/puerto_princesa.jpg'),
(94, 12, 'Honda Bay Island Hopping', 2, 'frontend/assets/images/honda_bay.jpg'),
(95, 12, 'El Nido Beaches and Lagoons', 3, 'frontend/assets/images/el_nido.jpg'),
(96, 12, 'Kayangan Lake, Coron', 4, 'frontend/assets/images/kayangan_lake.jpg'),
(97, 12, 'Snorkeling at Coron Reef', 5, 'frontend/assets/images/coron_reef.jpg'),
(98, 12, 'Relax at Palawan Beach Resort', 6, 'frontend/assets/images/palawan_resort.jpg');

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
(47, 1, '2026-01-15', '2026-01-18', 30),
(48, 1, '2026-03-12', '2026-03-15', 30),
(49, 1, '2026-06-10', '2026-06-13', 30),
(50, 1, '2026-10-07', '2026-10-10', 30),
(51, 2, '2026-02-05', '2026-02-08', 30),
(52, 2, '2026-04-16', '2026-04-19', 30),
(53, 2, '2026-07-22', '2026-07-25', 30),
(54, 2, '2026-11-11', '2026-11-14', 30),
(55, 3, '2026-01-23', '2026-01-25', 30),
(56, 3, '2026-05-08', '2026-05-10', 30),
(57, 3, '2026-08-14', '2026-08-16', 30),
(58, 3, '2026-12-04', '2026-12-06', 30),
(59, 4, '2026-02-18', '2026-02-22', 30),
(60, 4, '2026-04-22', '2026-04-26', 30),
(61, 4, '2026-09-09', '2026-09-13', 30),
(62, 5, '2026-01-03', '2026-01-04', 30),
(63, 5, '2026-02-07', '2026-02-08', 30),
(64, 5, '2026-03-07', '2026-03-08', 30),
(65, 5, '2026-04-04', '2026-04-05', 30),
(66, 5, '2026-05-02', '2026-05-03', 30),
(67, 5, '2026-06-06', '2026-06-07', 30),
(68, 5, '2026-07-04', '2026-07-05', 30),
(69, 5, '2026-08-01', '2026-08-02', 30),
(70, 5, '2026-09-05', '2026-09-06', 30),
(71, 5, '2026-10-03', '2026-10-04', 30),
(72, 5, '2026-11-07', '2026-11-08', 30),
(73, 5, '2026-12-05', '2026-12-06', 30),
(74, 6, '2026-03-04', '2026-03-07', 30),
(75, 6, '2026-06-17', '2026-06-20', 30),
(76, 6, '2026-09-23', '2026-09-26', 30),
(77, 7, '2026-02-11', '2026-02-13', 30),
(78, 7, '2026-05-20', '2026-05-22', 30),
(79, 7, '2026-10-21', '2026-10-23', 30),
(80, 8, '2026-01-28', '2026-01-31', 30),
(81, 8, '2026-04-08', '2026-04-11', 30),
(82, 8, '2026-07-01', '2026-07-04', 30),
(83, 8, '2026-12-09', '2026-12-12', 30),
(84, 9, '2026-03-18', '2026-03-20', 30),
(85, 9, '2026-08-19', '2026-08-21', 30),
(86, 9, '2026-11-25', '2026-11-27', 30),
(87, 10, '2026-02-25', '2026-02-28', 30),
(88, 10, '2026-06-03', '2026-06-06', 30),
(89, 10, '2026-09-30', '2026-10-03', 30),
(90, 11, '2026-01-07', '2026-01-09', 30),
(91, 11, '2026-05-27', '2026-05-29', 30),
(92, 11, '2026-10-14', '2026-10-16', 30),
(93, 12, '2026-01-10', '2026-01-15', 20),
(94, 12, '2026-02-05', '2026-02-10', 20),
(95, 12, '2026-03-12', '2026-03-17', 20);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`),
  ADD KEY `island_id` (`island_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pickup_dropoff`
--
ALTER TABLE `pickup_dropoff`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `island_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `tour_packages`
--
ALTER TABLE `tour_packages`
  MODIFY `tour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tour_place`
--
ALTER TABLE `tour_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `tour_schedules`
--
ALTER TABLE `tour_schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `tour_schedules` (`schedule_id`);

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_ibfk_1` FOREIGN KEY (`island_id`) REFERENCES `regions` (`island_id`);

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
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tour_packages` (`tour_id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
