-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 11:50 PM
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
-- Database: `website_kemah`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat_kemah`
--

CREATE TABLE `alat_kemah` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `availability` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `specifications` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alat_kemah`
--

INSERT INTO `alat_kemah` (`id`, `name`, `total_stock`, `price`, `availability`, `description`, `specifications`, `image`) VALUES
(1, 'Hammock', 10, 150.00, 5, 'Comfortable hammock for relaxing.', 'Material: Nylon, Max Load: 200kg', 'assets/images/Hammock.jpg'),
(2, 'Raincoat', 10, 50.00, 10, 'Waterproof raincoat for all sizes.', 'Material: PVC, Size: M, L, XL', 'assets/images/Raincoat.jpg'),
(3, 'Fly Sheet', 10, 80.00, 7, 'Lightweight fly sheet for camping.', 'Dimensions: 2x3m, Material: Polyester', 'assets/images/FlySheet.jpg'),
(4, 'Cooking Set', 10, 120.00, 4, 'Complete cooking set for outdoor use.', 'Includes pots, pans, utensils', 'assets/images/CookingSet.jpg'),
(5, 'Meja Lipat', 10, 200.00, 6, 'Portable folding table for camping.', 'Material: Aluminum, Size: 120x60cm', 'assets/images/MejaLipat.jpg'),
(6, 'Bantal Tiup', 10, 30.00, 15, 'Inflatable pillow for comfort.', 'Material: PVC, Size: 40x30cm', 'assets/images/BantalTiup.jpg'),
(7, 'Carrier 50 L', 10, 300.00, 8, 'Durable carrier for trekking.', 'Volume: 50L, Material: Nylon', 'assets/images/Carrier50L.jpg'),
(8, 'Carrier 60 L', 10, 350.00, 5, 'Spacious carrier for longer trips.', 'Volume: 60L, Material: Nylon', 'assets/images/Carrier60L.jpg'),
(9, 'Carrier 80 L', 10, 400.00, 2, 'Extra large carrier for expedition.', 'Volume: 80L, Material: Nylon', 'assets/images/Carrier80L.jpg'),
(10, 'Terpal 2 x 3', 10, 100.00, 3, 'Waterproof tarpaulin for various uses.', 'Dimensions: 2x3m', 'assets/images/Terpal2X3.jpg'),
(11, 'Terpal 3 x 4', 10, 150.00, 4, 'Durable tarpaulin for camping.', 'Dimensions: 3x4m', 'assets/images/Terpal3X4.jpg'),
(12, 'Matras', 10, 80.00, 10, 'Comfortable sleeping mat.', 'Material: Foam, Size: 180x60cm', 'assets/images/Matras.jpg'),
(13, 'Foot Print', 10, 40.00, 5, 'Groundsheet for tent protection.', 'Dimensions: 2x3m', 'assets/images/FootPrint.jpg'),
(14, 'Tracking Pole', 10, 70.00, 12, 'Lightweight tracking pole.', 'Material: Aluminum, Length: Adjustable', 'assets/images/TrackingPole.jpg'),
(15, 'Gas Portable', 10, 90.00, 6, 'Portable gas stove for outdoor cooking.', 'Material: Aluminum, Power: 2000W', 'assets/images/GasPortable.jpg'),
(16, 'Tiang Fly Sheet', 10, 50.00, 8, 'Support pole for fly sheet.', 'Material: Aluminum, Height: Adjustable', 'assets/images/TiangFlySheet.jpg'),
(17, 'Headlamp Charge', 10, 60.00, 10, 'Rechargeable headlamp for night use.', 'Brightness: 300 lumens, Battery: Rechargeable', 'assets/images/HeadlampCharge.jpg'),
(18, 'Kursi Lipat XXL', 10, 120.00, 5, 'Extra large folding chair.', 'Material: Fabric, Max Load: 150kg', 'assets/images/KursiLipatXXL.jpg'),
(19, 'Lampu Emergency', 10, 70.00, 7, 'Emergency lamp for camping.', 'Brightness: 200 lumens, Battery: 6 hours', 'assets/images/LampuEmergency.jpg'),
(20, 'Slepping Bag Tebal', 10, 250.00, 4, 'Thick sleeping bag for cold weather.', 'Temperature Rating: -10°C', 'assets/images/SleppingBagTebal.jpg'),
(21, 'Kompor Kovar Kotak', 10, 150.00, 6, 'Box-type camping stove.', 'Power: 3000W, Fuel: Gas', 'assets/images/KomporKovarKotak.jpg'),
(22, 'Senter Mini Charge', 10, 40.00, 8, 'Mini rechargeable flashlight.', 'Brightness: 150 lumens, Battery: Rechargeable', 'assets/images/SenterMiniCharge.jpg'),
(24, 'Tenda Cap 2 Double Layer', 10, 500.00, 5, 'Double layer tent for 2 people.', 'Dimensions: 210x130x120cm', 'assets/images/TendaCap2DoubleLayer.jpg'),
(25, 'Tenda Cap 4 Single Layer', 10, 700.00, 2, 'Single layer tent for 4 people.', 'Dimensions: 240x210x120cm', 'assets/images/TendaCap4SingleLayer.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `alat` varchar(255) NOT NULL,
  `rental_duration` varchar(50) NOT NULL,
  `schedule_date_time` datetime NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `username`, `phone_number`, `alat`, `rental_duration`, `schedule_date_time`, `payment_method`) VALUES
(34, '', '', 'Raincoat', '1 day', '2024-11-05 03:01:00', 'BRI');

-- --------------------------------------------------------

--
-- Table structure for table `rentals_fix`
--

CREATE TABLE `rentals_fix` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `alat` varchar(100) NOT NULL,
  `rental_duration` int(11) NOT NULL,
  `schedule_date_time` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals_fix`
--

INSERT INTO `rentals_fix` (`id`, `username`, `phone_number`, `alat`, `rental_duration`, `schedule_date_time`, `created_at`, `payment_method`, `updated_at`) VALUES
(21, 'rifki', '089525901250', 'Meja Lipat', 3, '2024-11-01 14:24:00', '2024-11-01 07:24:47', 'BRI', '2024-11-04 03:20:00'),
(23, 'rifki', '089525901250', 'Hammock', 2, '2024-11-18 16:49:00', '2024-11-01 07:52:52', 'Dana', '2024-11-04 03:20:00'),
(24, 'rifki', '089525901250', 'Carrier 80 L', 2, '2024-11-02 16:53:00', '2024-11-01 07:52:52', 'Bayar di Tempat', '2024-11-04 03:20:00'),
(25, 'rifki', '089525901250', 'Matras', 2, '2024-12-28 14:50:00', '2024-11-01 07:52:52', 'Bayar di Tempat', '2024-11-04 03:20:00'),
(27, 'rifki', '089525901250', 'Kursi Lipat XXL', 2, '2024-11-29 07:51:00', '2024-11-01 07:52:52', 'ShopeePay', '2024-11-04 03:20:00'),
(28, 'rifki', '089525901250', 'Kursi Lipat XXL', 1, '2024-11-04 10:53:00', '2024-11-01 07:52:52', 'Bayar di Tempat', '2024-11-04 03:20:00'),
(30, 'rifki', '089525901250', 'Hammock', 2, '2024-11-01 14:58:00', '2024-11-01 07:58:29', 'BRI', '2024-11-04 03:20:00'),
(31, 'rifki', '089525901250', 'Carrier 50 L', 2, '2024-11-01 15:42:00', '2024-11-01 08:42:53', 'BRI', '2024-11-04 03:20:00'),
(32, 'roe', '087739731102', 'Hammock', 1, '2024-11-04 23:58:00', '2024-11-03 16:58:54', 'ShopeePay', '2024-11-04 03:20:00'),
(36, 'ujang', '087739731102', 'Kursi Lipat XXL', 2, '2024-11-06 03:32:00', '2024-11-03 13:32:44', 'ShopeePay', '2024-11-03 20:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `phone_number`, `created_at`) VALUES
(2, 'zayn', 'zayn@gmail.com', 'admin', '$2y$10$1rnaKKdb/T0fXlcxEMzt5egq/.r5184CFHHS2gM8peIc7Ce1eH87G', NULL, '2024-10-31 01:25:59'),
(3, 'jade', 'jade@gmail.com', 'admin', '$2y$10$hZd8iPk4dDVeWmxlTxuUoeG4A0LP0W8aARTf8Ky./EczX0gsixIva', NULL, '2024-10-31 01:28:17'),
(4, 'rifki', 'rifki@gmail.com', 'user', '$2y$10$nxRCou5UU5W4HKPbpSLuyuWLkiaY6Aq7bl5pvT4uYG7lOt/.3S6Z.', '089525901250', '2024-10-31 09:58:09'),
(5, 'roe', 'roeru1412@gmail.com', 'admin', '$2y$10$epB232jc1XOy6c0HOLOjJeLAKGa4NlrA9h4uxQ4QNSV.U2Ua/2M72', '087739731102', '2024-11-03 23:56:53'),
(7, 'ujang', 'ujang@gmail.com', 'user', '$2y$10$q7DKpZkfJR9mfvbZfVkPtuFjAZ20FDC0ijopJxec56wzwhEw/xVUa', '087739731102', '2024-11-04 03:29:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat_kemah`
--
ALTER TABLE `alat_kemah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals_fix`
--
ALTER TABLE `rentals_fix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `rentals_fix`
--
ALTER TABLE `rentals_fix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
