-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2023 at 04:39 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactpage`
--

CREATE TABLE `contactpage` (
  `id` int(7) NOT NULL,
  `email` varchar(50) NOT NULL,
  `issue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactpage`
--

INSERT INTO `contactpage` (`id`, `email`, `issue`) VALUES
(1, 'ethangrdnr@gmail.com', 'DAS TOO GOOD!'),
(2, 'Jnew@gmail.com', 'DAS CLASS TOO GOOD');

-- --------------------------------------------------------

--
-- Table structure for table `professor_reviews`
--

CREATE TABLE `professor_reviews` (
  `id` int(7) NOT NULL,
  `professor_name` varchar(100) NOT NULL,
  `review_text` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professor_reviews`
--

INSERT INTO `professor_reviews` (`id`, `professor_name`, `review_text`, `rating`, `created_at`) VALUES
(1, 'Dr. Das', 'Dr. Das is the best teacher ever!', 5, '2023-11-29 04:33:06'),
(2, 'Dr. Das', 'I also think Dr. Das is the best ', 5, '2023-11-29 04:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(7) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `firstName`, `lastName`, `username`, `password`, `email`) VALUES
(1, 'Ethan', 'Gardner', 'ethangrdnr', '$2y$10$YC9cFOXUMKvcMy4T/3ocAey4saKptB7nj3ZNMGbBilH9w2kwe5Lq2', 'ethangrdnr@gmail.com'),
(2, 'John', 'Newman', 'Jnew', '$2y$10$X6ntaRFE3bVmSjWlQBK11uf4raeSw.5NsG7L6OqAmSWJdEG1gkrRG', 'Jnew@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactpage`
--
ALTER TABLE `contactpage`
  ADD KEY `id` (`id`);

--
-- Indexes for table `professor_reviews`
--
ALTER TABLE `professor_reviews`
  ADD KEY `id` (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contactpage`
--
ALTER TABLE `contactpage`
  ADD CONSTRAINT `contactpage_ibfk_1` FOREIGN KEY (`id`) REFERENCES `registration` (`id`);

--
-- Constraints for table `professor_reviews`
--
ALTER TABLE `professor_reviews`
  ADD CONSTRAINT `professor_reviews_ibfk_1` FOREIGN KEY (`id`) REFERENCES `registration` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
