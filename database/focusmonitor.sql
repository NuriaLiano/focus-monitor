-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2022 at 05:57 PM
-- Server version: 8.0.31-0ubuntu0.20.04.1
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `focusmonitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_logs`
--

CREATE TABLE `access_logs` (
  `id` int NOT NULL,
  `path` varchar(250) NOT NULL,
  `access_date` date NOT NULL,
  `id_user` int NOT NULL,
  `id_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `error_logs`
--

CREATE TABLE `error_logs` (
  `id` int NOT NULL,
  `path` varchar(250) NOT NULL,
  `error_date` varchar(25) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `error_logs`
--

INSERT INTO `error_logs` (`id`, `path`, `error_date`, `message`) VALUES
(1, '/var/log/focusmonitor/error.log', '2022-11-19 18:48:53', 'default'),
(2, '/var/log/focusmonitor/error.log', '2022-11-19 18:50:01', 'probando');

-- --------------------------------------------------------

--
-- Table structure for table `node`
--

CREATE TABLE `node` (
  `id` int NOT NULL,
  `hostname` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `ip` int NOT NULL,
  `network` int NOT NULL,
  `vlan` int NOT NULL,
  `rack` varchar(3) NOT NULL,
  `positionU` int NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `serverType` varchar(250) NOT NULL,
  `serialNumber` int NOT NULL,
  `owner` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL COMMENT 'groups name',
  `r` tinyint(1) NOT NULL DEFAULT '0',
  `w` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `r`, `w`) VALUES
(1, 'admin', 1, 1),
(2, 'smg', 1, 0),
(3, 'economia', 1, 0),
(4, 'geocean', 1, 0),
(5, 'citimac', 1, 0),
(6, 'gtfe', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `serviceName` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `version` int NOT NULL,
  `useCases` varchar(250) NOT NULL,
  `node` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(25) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `officeNumber` int NOT NULL,
  `phoneNumber` int NOT NULL,
  `faculty` varchar(250) NOT NULL,
  `id_role` int NOT NULL,
  `profilePicture` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `username`, `password`, `email`, `officeNumber`, `phoneNumber`, `faculty`, `id_role`, `profilePicture`) VALUES
(20, 'nuria', 'liano', 'lianon', '8b812f34306683e9fcbbf5f9ecfba190', 'lianon@unican.es', 78945, 78945156, 'derecho', 1, '70d0b6780b68ef6a287d4fcdacbab4c4.jpg'),
(21, 'marek', 'legends', 'legendsm', 'a1fb6876859b56d1fcad1b7a9738355b', 'marek@unican.es', 78945, 465876325, 'ifca', 6, '1.jpg'),
(22, 'popi', 'fresh', 'freshp', '5ae1c1703aa1a9821dad71a5c301ff3e', 'freshp@unican.es', 78945, 789456123, 'derecho', 3, 'default.png'),
(25, 'asd', 'probando', 'probandoa', 'a1fb6876859b56d1fcad1b7a9738355b', 'probandon@unican.es', 12345, 88888, 'educacion', 1, '47122e0dea6c8201072ef78ea7bb7bdf.jpg'),
(26, 'luis', 'villa', 'villal', '8b812f34306683e9fcbbf5f9ecfba190', 'villal@unican.es', 12345, 942567898, 'educacion', 3, 'default.png'),
(28, 'andrea', 'echevarria', 'echevarriaa', '94dd9a333e98e78f98b1c29495af06b2', 'echevarriaa@unican.es', 12345, 654123987, 'ifca', 6, '4d31980dbe177ada4b4701a5c852dd19.jpg'),
(29, 'alba', 'lopez', 'lopeza', '3803602c7b5aa6bb7bac94353e223ca6', 'lopeza@unican.es', 12345, 987653437, 'ifca', 4, NULL),
(30, 'alba', 'lopez', 'lopeza', '28d120e5eb7559db1b48a02ec0eafc20', 'lopeza@unican.es', 12345, 123456789, 'ciese', 6, NULL),
(32, 'angela', 'gomez', 'gomeza', 'd29e144df6a0f513a79d6bc822539b4e', 'gomeza@unican.es', 123345, 832975632, 'enfermeria', 3, 'e0ea5bfc2798fe10aff59cc3b1721f41.jpg'),
(33, 'foto', 'pru', 'pruf', '5c832505478af2e38c4b52484cc136d3', 'pruf@unican.es', 8937, 398472398, 'derecho', 2, '3728f09a68eadb525f070885407442e0.jpg'),
(34, 'alvaro', 'rodriguez', 'rodrigueza', '2dec62c64a7b19d5cec761dc7e19ee34', 'rodrigueza@unican.es', 34325, 54323454, 'educacion', 2, '01f33b147ff14e8c90ca264635b8d6bf.jpg'),
(35, 'antonio', 'perez', 'pereza', '73b1d11388c48199f40af586484ca4ef', 'pereza@unican.es', 12345, 987656748, 'educacion', 2, '4f2da316ab7a77ca868d5f188b699e94.jpg'),
(36, 'lucia', 'alvarez', 'alvarezl', '5ca700c641e3c3c09419c88f4e87ffe5', 'alvarezl@unican.es', 12345, 98647382, 'educacion', 2, '4187904a24f21ddbe9c10465e870b466.jpg'),
(37, 'rocio', 'madrid', 'madridr', 'b43b4c34ad6186580e98e61f7057de12', 'madridr@unican.es', 12345, 945678738, 'derecho', 1, 'ba5eb738ac4d0e857072455103f25352.jpg'),
(38, 'paula', 'camacho', 'camachop', '59b70f0e2a2a28e553063f01282f2a32', 'camachop@unican.es', 12345, 98746783, 'derecho', 1, '70638bab28c086cd48888d4a90b0164c.jpg'),
(39, 'carlota', 'ruiz', 'ruizc', 'ef4ac3f97e960c2dcb741f7577297402', 'ruizc@unican.es', 12345, 942897480, 'nautica', 3, '3f906811ab964e6e9bcc9bd9e08f6721.jpg'),
(40, 'joel', 'garcia', 'garciaj', 'b81239fbf3a0f55c05c8aa051ace532e', 'garciaj@unican.es', 12345, 942789350, 'educacion', 5, 'c7f612bcad820ebd6b1be0e63dd6d186.jpg'),
(41, 'oscar', 'campo', 'campoo', '595507d09f8abc119563824339a0f5a5', 'campoo@unican.es', 123345, 945678930, 'educacion', 2, 'f4b364f018411ed069dae2864233d22e.jpg'),
(42, 'nuria', 'gutierrez', 'gutierrezn', '8b812f34306683e9fcbbf5f9ecfba190', 'gutierrezn@unican.es', 99999, 945768746, 'ciencias', 1, 'cb3ad6edb2cef56876bb1ff9e113c51b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vm`
--

CREATE TABLE `vm` (
  `id` int NOT NULL,
  `hostname` varchar(25) NOT NULL,
  `status` varchar(50) NOT NULL,
  `ip` int NOT NULL,
  `network` int NOT NULL,
  `vlan` int NOT NULL,
  `node` varchar(100) NOT NULL,
  `cores` int NOT NULL,
  `memory` int NOT NULL,
  `disk` int NOT NULL,
  `owner` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_logs`
--
ALTER TABLE `access_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `error_logs`
--
ALTER TABLE `error_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `node`
--
ALTER TABLE `node`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `vm`
--
ALTER TABLE `vm`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_logs`
--
ALTER TABLE `access_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `error_logs`
--
ALTER TABLE `error_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `node`
--
ALTER TABLE `node`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `vm`
--
ALTER TABLE `vm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_logs`
--
ALTER TABLE `access_logs`
  ADD CONSTRAINT `access_logs_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_logs_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
