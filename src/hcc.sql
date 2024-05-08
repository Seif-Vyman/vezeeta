-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 04:13 PM
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
-- Database: `hcc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `userId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `drId` int(255) NOT NULL,
  `doctorName` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `header` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`drId`, `doctorName`, `date`, `header`, `content`) VALUES
(2, 'seif ayman', '2024-05-06', 'Hello World', 'programming is fun'),
(2, 'seif ayman', '2024-05-06', 'Blog ON', 'Set the fire to the Rain');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `userId` int(255) NOT NULL,
  `productId` int(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` int(255) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `productQuantity` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`userId`, `productId`, `productName`, `productPrice`, `productImage`, `productQuantity`) VALUES
(1, 2, 'panadol', 550, '', '1'),
(1, 4, 'detol', 600, '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `userId` int(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `fees` int(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `rating` int(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`userId`, `speciality`, `fees`, `address`, `rating`, `description`) VALUES
(2, 'qweqweqwe', 678, 'asdasd', 5, ''),
(4, 'dentist', 0, 'tagamo\'a 5 - new egypt', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `drId` int(255) NOT NULL,
  `patientId` int(255) NOT NULL,
  `doctorName` int(255) NOT NULL,
  `patientName` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `rate` int(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderId` int(255) NOT NULL,
  `prodId` int(255) NOT NULL,
  `prodQuant` int(255) NOT NULL,
  `totalPrice` int(255) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `userId` int(255) NOT NULL,
  `insurance` varchar(255) NOT NULL,
  `IDNumber` int(255) NOT NULL,
  `birthdate` date NOT NULL,
  `expiryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`userId`, `insurance`, `IDNumber`, `birthdate`, `expiryDate`) VALUES
(1, 'Select Insurance', 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `prodId` int(255) NOT NULL,
  `prodName` varchar(255) NOT NULL,
  `prodPrice` int(255) NOT NULL,
  `quantity` int(255) NOT NULL DEFAULT 1,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`prodId`, `prodName`, `prodPrice`, `quantity`, `image`) VALUES
(2, '5od panadol', 700, 3, ''),
(3, '50d 7asasya', 60, 1, ''),
(4, 'detol', 600, 1, ''),
(6, 'tramadol', 900, 1, ''),
(8, 'ketofaaaaaaaaan 2', 350, 6, 'Jude Bellingham.jpg'),
(9, 'katafast', 5, 20, 'detol.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `patientId` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `doctorId`, `date`, `time`, `status`, `patientId`) VALUES
(48, 2, '2024-05-15', '12:30:00', 'booked', 1),
(49, 2, '2024-05-21', '02:00:00', 'booked', 1),
(50, 2, '2024-05-31', '18:30:00', 'booked', 1),
(51, 2, '2024-05-01', '01:00:00', 'available', NULL),
(52, 2, '2024-05-02', '02:00:00', 'available', NULL),
(53, 2, '2024-05-03', '03:00:00', 'available', NULL),
(54, 2, '2024-05-04', '04:00:00', 'available', NULL),
(55, 2, '2024-05-07', '07:00:00', 'available', NULL),
(56, 2, '2024-05-09', '14:00:00', 'available', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userRole` varchar(255) NOT NULL,
  `phoneNum` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'Egypt',
  `city` varchar(255) NOT NULL DEFAULT 'Cairo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `firstName`, `lastName`, `password`, `email`, `userRole`, `phoneNum`, `country`, `city`) VALUES
(1, 'Ali', 'Azzam', '123456', 'ali@gmail.com', 'Patient', '2222222222', 'omeldonya', 'cairo'),
(2, 'seif allah', 'ayman', '123', 'seif.com', 'Doctor', '01234', 'egypt', 'cairo'),
(4, 'Halla', 'ayman', '123', 'salma.com', 'Doctor', '011111111', 'Egypt', 'Cairo'),
(5, 'ali', 'emad', 'aliali', 'aliemad@gmail.com', 'Patient', '', '', ''),
(10, 'aya', 'hamdy', 'ayaaya', 'aya@gmail.com', 'Admin', '1234567', 'Egypt', 'Cairo'),
(11, 'reem', 'hafez', 'reemreem', 'reem@gmail.com', 'Patient', '01234567891', 'Egypt', 'Cairo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD KEY `drId` (`drId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `userId` (`userId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD KEY `drId` (`drId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `prodId` (`prodId`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`prodId`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderId` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `prodId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`drId`) REFERENCES `doctor` (`userId`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `patient` (`userId`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `pharmacy` (`prodId`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`drId`) REFERENCES `doctor` (`userId`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patient` (`userId`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`prodId`) REFERENCES `pharmacy` (`prodId`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `patient` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
