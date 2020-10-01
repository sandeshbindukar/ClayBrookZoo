-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2020 at 04:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_animal_details`
--

CREATE TABLE `tb_animal_details` (
  `species_id` int(8) NOT NULL,
  `species_name` varchar(255) NOT NULL,
  `animal_given_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(25) NOT NULL,
  `average_lifespan_in_yrs` int(8) NOT NULL,
  `species_classification` varchar(255) NOT NULL,
  `dietary_requirements` text NOT NULL,
  `natural_habitat_description` text NOT NULL,
  `global_population_distribution` text NOT NULL,
  `date_joined_in_zoo` date NOT NULL,
  `animal_dimension` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_animal_details`
--

INSERT INTO `tb_animal_details` (`species_id`, `species_name`, `animal_given_name`, `date_of_birth`, `gender`, `average_lifespan_in_yrs`, `species_classification`, `dietary_requirements`, `natural_habitat_description`, `global_population_distribution`, `date_joined_in_zoo`, `animal_dimension`) VALUES
(10, 'a', 'Tiger', '2020-06-01', 'male', 15, 'The Cages/Compounds', 'gfa', 's', '0.001%', '1111-12-04', '121'),
(14, 'Canis lupus', 'Grey Wolf', '2020-06-01', 'male', 14, 'The Cages/Compounds', 'Their diet is dominated by wild medium-sized hoofed mammals and domestic species. The wolf depends on wild species.', 'Habitat use by wolves depends on the abundance of prey, snow conditions, livestock densities, road densities, human presence and topography', '0.0000111', '2020-06-01', 'Weight: 90kg\r\nHeight: 1m'),
(15, 'Passerina Cyanea', 'Indigo Bunting', '2020-06-01', 'female', 3, 'The Aviary ', 'sdbahsb', 'nscban', '0.0002%', '2020-07-05', 'Weight 12kg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_events`
--

CREATE TABLE `tb_events` (
  `event_id` int(8) NOT NULL,
  `event_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_events`
--

INSERT INTO `tb_events` (`event_id`, `event_description`) VALUES
(1, '20% off today!');

-- --------------------------------------------------------

--
-- Table structure for table `tb_species_classification`
--

CREATE TABLE `tb_species_classification` (
  `classification_id` int(11) NOT NULL,
  `classification_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_species_classification`
--

INSERT INTO `tb_species_classification` (`classification_id`, `classification_name`) VALUES
(1, 'The Aviary '),
(2, 'The Hothouse'),
(3, 'The Aquarium '),
(4, 'The Cages/Compounds');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sponsor_details`
--

CREATE TABLE `tb_sponsor_details` (
  `sponsor_id` int(8) NOT NULL,
  `species_code` int(8) NOT NULL,
  `species_name` varchar(255) NOT NULL,
  `animal_given_name` varchar(255) NOT NULL,
  `species_classification` varchar(255) NOT NULL,
  `sponsor_name` varchar(255) NOT NULL,
  `sponsor_email` varchar(255) NOT NULL,
  `sponsor_mobile_number` varchar(255) NOT NULL,
  `sponsor_address` varchar(255) NOT NULL,
  `sponsorship_band` varchar(255) NOT NULL,
  `date_of_sponsor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sponsor_details`
--

INSERT INTO `tb_sponsor_details` (`sponsor_id`, `species_code`, `species_name`, `animal_given_name`, `species_classification`, `sponsor_name`, `sponsor_email`, `sponsor_mobile_number`, `sponsor_address`, `sponsorship_band`, `date_of_sponsor`) VALUES
(5, 14, 'Canis lupus', 'Grey Wolf', 'The Cages/Compounds', 'Harry Porter', 'user@gmail.com', '122', 'user', 'A', '06/19/2020'),
(6, 15, 'Passerina Cyanea', 'Indigo Bunting', 'The Aviary ', 'Harry Porter', 'user@gmail.com', '122', 'user', 'A', '06/19/2020');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_details`
--

CREATE TABLE `tb_user_details` (
  `user_id` int(8) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_number` int(10) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user_details`
--

INSERT INTO `tb_user_details` (`user_id`, `user_type`, `name`, `surname`, `gender`, `email`, `username`, `password`, `mobile_number`, `address`) VALUES
(1, 'admin', 'admin', 'aa', 'Male', 'a@gmail.com', 'admin', '$2y$10$4b436.iKN.F8z5kG5z5Qu.ZB4BVQJYWDz8oLR6/NRAnbUXgjZtfcC', 454545, 'sasd\r\n'),
(2, 'user', 'Harry', 'Porter', 'Male', 'user@gmail.com', 'user', '$2y$10$3v9fnUaptZbYN8eDPArRseR0XYY5ail7QIKzQFk.hv..9g9yc985S', 122, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_animal_details`
--
ALTER TABLE `tb_animal_details`
  ADD PRIMARY KEY (`species_id`);

--
-- Indexes for table `tb_events`
--
ALTER TABLE `tb_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `tb_species_classification`
--
ALTER TABLE `tb_species_classification`
  ADD PRIMARY KEY (`classification_id`);

--
-- Indexes for table `tb_sponsor_details`
--
ALTER TABLE `tb_sponsor_details`
  ADD PRIMARY KEY (`sponsor_id`),
  ADD KEY `fk_s_sponsor` (`species_code`);

--
-- Indexes for table `tb_user_details`
--
ALTER TABLE `tb_user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_animal_details`
--
ALTER TABLE `tb_animal_details`
  MODIFY `species_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_events`
--
ALTER TABLE `tb_events`
  MODIFY `event_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_species_classification`
--
ALTER TABLE `tb_species_classification`
  MODIFY `classification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_sponsor_details`
--
ALTER TABLE `tb_sponsor_details`
  MODIFY `sponsor_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_user_details`
--
ALTER TABLE `tb_user_details`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_sponsor_details`
--
ALTER TABLE `tb_sponsor_details`
  ADD CONSTRAINT `fk_s_sponsor` FOREIGN KEY (`species_code`) REFERENCES `tb_animal_details` (`species_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
