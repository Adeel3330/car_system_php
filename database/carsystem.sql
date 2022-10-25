-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2022 at 11:58 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `car_categories` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_categories`, `name`, `color`, `model`, `registration_no`, `status`, `date_created`) VALUES
(1, 'Honda', 'adeel', 'white', '2020', 'REG_0001', 'active', '2022-10-24 21:12:23'),
(2, 'Audi bss 2c 6', 'AUX1', 'blue', '2021', 'REG_0002', 'active', '2022-10-24 21:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `date_created`) VALUES
(1, 'Audi bss 2c 6', 'active', '2022-10-23 16:49:02'),
(5, 'Honda', 'active', '2022-10-24 20:28:00'),
(6, 'ffa', 'delete', '2022-10-24 20:28:29'),
(7, 'ffa', 'delete', '2022-10-24 20:30:12'),
(8, '<script>window.location.href=google.com</script>', 'delete', '2022-10-24 20:52:13'),
(9, '&lt;script&gt;window.location.href=google.com&lt;/script&gt;', 'delete', '2022-10-24 21:31:44'),
(10, '&lt;script&gt;window.location.href=google.com&lt;/script&gt;', 'active', '2022-10-24 21:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `generated_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `userid`, `token`, `generated_date`) VALUES
(1, 26, 'ra3Y5QGgRqeM8h0uLnJyfwjKpicHvO', '1666643571');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `user_password`, `status`, `date_created`) VALUES
(26, 'adeeltariq', 'ffa', 'adeelansari3330@gmail.com', '$2y$10$Me8xROjtAyoE0dfSZyb2GuenYXJVHy8SZEVq/csLSVQGWTm3j8O/S', 'verify', '2022-10-23 11:22:07'),
(28, 'danny', 'ffa', 'dannydanial3330@gmail.com', '$2y$10$74u6WsAv6CAC2Ev0CGGXD.dcHZP4louozGcohd08y.2NE93VGr3f6', 'verify', '2022-10-24 20:32:39'),
(29, 'imtiaz', 'imtiazali', 'imtiazali78652@gmail.com', '$2y$10$w.3E/H2RemA/8c.DwCMUk.0afI5pxYre0uEC1mrGfHqnlFQZDYOoe', 'verify', '2022-10-24 21:55:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
