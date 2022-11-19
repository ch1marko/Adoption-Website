-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2022 at 03:25 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be17_cr5_animal_adoption_marko_dzomba`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoption`
--

CREATE TABLE `adoption` (
  `id` int(11) NOT NULL,
  `date_adoption` date NOT NULL,
  `fk_animal_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adoption`
--

INSERT INTO `adoption` (`id`, `date_adoption`, `fk_animal_id`, `fk_user_id`) VALUES
(1, '2022-12-12', 5, 1),
(2, '2022-11-12', 1, 1),
(3, '2022-02-02', 3, 1),
(4, '2022-12-12', 4, 1),
(5, '2022-12-12', 6, 1),
(6, '2023-05-02', 2, 1),
(7, '2022-12-12', 7, 1),
(8, '2022-12-13', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `dis` varchar(255) NOT NULL,
  `size` enum('small','medium','big') NOT NULL,
  `age` int(3) NOT NULL,
  `vaccinated` enum('Yes','No') NOT NULL,
  `breed` varchar(50) NOT NULL,
  `status` enum('Adopted','Available') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `name`, `picture`, `location`, `dis`, `size`, `age`, `vaccinated`, `breed`, `status`) VALUES
(1, 'Chikita', 'animal.png', 'Honduras', 'Chihiahua', 'small', 3, 'Yes', 'Chihuahua', 'Adopted'),
(2, 'Pablo', 'animal.png', 'Spain', 'Old Pit Bull', 'big', 9, 'Yes', 'Pit Bull', 'Adopted'),
(3, 'Kitty', 'animal.png', 'Vienna', 'Very friendly kitty.', 'medium', 10, 'Yes', 'Russian Gray Cat', 'Available'),
(4, 'Cat', 'animal.png', 'Graz', 'Kitty Cat', 'small', 11, 'Yes', 'Cat', 'Available'),
(5, 'Catmandoo', 'animal.png', 'Graz', 'Kitty Cat', 'small', 9, 'Yes', 'Cat', 'Adopted'),
(6, 'Conchita', 'animal.png', 'Amazaon Forest', 'Snake', 'small', 12, 'Yes', 'Python', 'Adopted'),
(7, 'Grudo', 'animal.png', 'Venice', 'Sweet', 'small', 10, 'Yes', 'Fish', 'Available'),
(8, 'Horsey', 'animal.png', 'Texas', 'Ranger Horse', 'small', 15, 'Yes', 'Pony', 'Available'),
(9, 'Burro', 'animal.png', 'Argentina', 'Big Boy', 'small', 4, 'Yes', 'Buffallo', 'Available'),
(10, 'Pocahontas', 'animal.png', 'Wayoming', 'Fluff Ball', 'small', 4, 'Yes', 'Squirrel', 'Available'),
(11, 'Banana', 'animal.png', 'Portugal', 'Wonderful companion', 'small', 6, 'Yes', 'Rabbit', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` enum('user','adm') DEFAULT 'user',
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `password`, `email`, `address`, `picture`, `status`, `phone_number`) VALUES
(1, 'Marko', 'Dzomba', 'e3c4a8e68c23890091f9b9531ef3e0f805ce0a9378d6fb4bbcb6eed403c91342', 'marko@mail.com', 'marko strasse 1', '6378d88199bad.jpg', 'user', '123456'),
(2, 'markoadmin', 'marko', 'e3c4a8e68c23890091f9b9531ef3e0f805ce0a9378d6fb4bbcb6eed403c91342', 'marko1@mail.com', 'Marko Street 1', 'avatar.png', 'adm', '1321232414'),
(3, 'Pablito', 'Dzomba', 'e3c4a8e68c23890091f9b9531ef3e0f805ce0a9378d6fb4bbcb6eed403c91342', 'marko2@mail.com', 'marko street 1', '6378de7c3cad4.png', 'user', '06703245667'),
(4, 'Pedro', 'Alvarez', 'e3c4a8e68c23890091f9b9531ef3e0f805ce0a9378d6fb4bbcb6eed403c91342', 'marko3@mail.com', 'marko street 5', '6378decadf75e.jpg', 'user', '319834273492'),
(5, 'Pablo', 'Alvarez', 'e3c4a8e68c23890091f9b9531ef3e0f805ce0a9378d6fb4bbcb6eed403c91342', 'marko4@mail.com', 'street 2', '6378df1bdd6c5.jpg', 'user', '34234234'),
(6, 'Veko', 'Dzomba', 'e3c4a8e68c23890091f9b9531ef3e0f805ce0a9378d6fb4bbcb6eed403c91342', 'marko5@mail.com', 'Plaza Street 2', '6378dfc9cea42.jpg', 'user', '234234234'),
(7, 'Chiquiita', 'Banana', 'e3c4a8e68c23890091f9b9531ef3e0f805ce0a9378d6fb4bbcb6eed403c91342', 'marko7@mail.com', 'Plaza Banana 3', '6378e22a4e134.jpg', 'user', '24223523535'),
(8, 'Kokoro', 'Bird', 'e3c4a8e68c23890091f9b9531ef3e0f805ce0a9378d6fb4bbcb6eed403c91342', 'marko8@mail.com', 'Bird Street 2', '6378e35bacc23.jpg', 'user', '131434234324');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption`
--
ALTER TABLE `adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_animal_id` (`fk_animal_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption`
--
ALTER TABLE `adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption`
--
ALTER TABLE `adoption`
  ADD CONSTRAINT `adoption_ibfk_1` FOREIGN KEY (`fk_animal_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `adoption_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
