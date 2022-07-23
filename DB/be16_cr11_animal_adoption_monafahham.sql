-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2022 at 01:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be16_cr11_animal_adoption_monafahham`
--
CREATE DATABASE IF NOT EXISTS `be16_cr11_animal_adoption_monafahham` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be16_cr11_animal_adoption_monafahham`;

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `animal_id` int(11) NOT NULL,
  `animal_name` varchar(50) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `size` enum('small','large') NOT NULL,
  `age` int(11) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `vaccinated` enum('Yes','No') NOT NULL,
  `status` enum('Adopted','Available') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`animal_id`, `animal_name`, `picture`, `address`, `description`, `size`, `age`, `breed`, `vaccinated`, `status`) VALUES
(1, 'Rainbow', 'rainbow.jpg', 'Hauptbahnhof 1, 1100 Wien', 'rainbow is my favorite bird. It is a very beautiful bird. Its body is covered with green feathers. Its wings are green which looks very pretty when it flies.\r\n\r\n', 'small', 3, 'New Zealand parrot', 'Yes', 'Available'),
(2, 'Shadow', 'shadow.jpg', 'Karlsplatz 8, 1040 Wien', 'shadow is a super cute pet. It is loyal, humble, easily trainable and easily maintainable pet. Children love to play with cats. They are friendly and harmless pet.', 'small', 8, 'Toyger', 'No', 'Adopted'),
(3, 'Ace', 'Ace.jpg', 'Friedrich-Schmidt-Platz 1, 1010 Wien', 'Confident, courageous, intelligent, and gentle—it\'s no wonder German shepherds are considered the second most popular dog breed in America. These large dogs are steadfastly loyal and protective of their humans but approach strangers with caution.', 'large', 9, 'German Shepherd', 'Yes', 'Available'),
(4, 'Scratch', 'tiger.jpg', 'Schönbrunner Straße 259; A-1120 Wien', 'Scratch is a domesticated tiger. He can be kept as a pet. A majority of states in the U.S. have instituted bans on keeping any of the big cat species as pets. Tigers are huge, strong, fanged predators that eat dozens of pounds of meat per day and need acres of expensive high-security enclosures.', 'large', 10, 'Bengal Tiger', 'Yes', 'Available'),
(5, 'Bunny', 'guinea-pig.jpg', 'Am Spitz 1; A-1211 Wien', 'guinea pig, (Cavia porcellus), a domesticated species of South American rodent belonging to the cavy family (Caviidae). It resembles other cavies in having a robust body with short limbs, large head and eyes, and short ears. The feet have hairless soles and short sharp claws.', 'small', 2, 'Guinea Pig', 'No', 'Adopted'),
(6, 'Dark knight', 'night.jpg', 'Schönbrunner Schloßstraße 47, 1130 Wien', 'The dog is a pet animal. A dog has sharp teeth so that it can eat flesh very easily, it has four legs, two ears, two eyes, a tail, a mouth, and a nose. It is a very clever animal and is very useful in catching thieves. It runs very fast, barks loudly, and attacks strangers.', 'large', 10, 'American Staffordshire Terrier Steckbrief', 'Yes', ''),
(7, 'Naughty', 'rabbit.jpg', 'Stephansplatz 3, 1010 Wien', 'Naughty is a small, furry mammal with long ears, short fluffy tails, and strong, large hind legs. They have 2 pairs of sharp incisors (front teeth), one pair on top and one pair on the bottom. They also have 2 peg teeth behind the top incisors.', 'small', 12, 'Mini Lop', 'Yes', 'Adopted'),
(8, 'Taylor', 'terrier.jpg', 'Felderstraße 1, 1082 Wien', 'Taylor is a pet animal. She has sharp teeth so that she can eat flesh very easily, she has four legs, two ears, two eyes, a tail, a mouth, and a nose. It is a very clever animal and is very useful in catching thieves. It runs very fast, barks loudly, and attacks strangers.', 'small', 6, 'Terrier', 'Yes', 'Adopted'),
(9, 'Snowflake', 'snowflake.jpg', '', 'Snowflake is a handbag dog. That at least is what my mother calls her, probably because she takes him shopping in her handbag. She is a miniature Yorkshire terrier and she is a delight. Her most attractive quality is that she is friendly to everyone, especially children. They love her molten-brown eyes and her glossy fur. She also has the cutest little paws. They are like a fox’s paws and she loves to dig up the garden with them. She also has a small, marshmallow tail. It is soft and white so we just call it the marshmallow.\r\n\r\n', 'small', 4, 'Maltipoo', 'Yes', 'Available'),
(10, 'Needle', '2-porcupine.jpg', 'Resselgasse 4, 1040 Wien', 'Porcupines are members of the rodent family that are covered in sharp, defensive spines. There are two main types of porcupines classified in two different families. Old World porcupines are in the taxonomical family Hystricidae. New World porcupines are in the taxonomical family Erethizontidae. Read on to learn about the porcupine.\r\n', 'small', 5, 'Porcupine', 'No', 'Adopted'),
(11, 'Belfi', 'cat-5457315_1920.jpg', 'Herrengasse 9, 1010 Wien', 'Belfi is a super cute pet. It is a loyal, humble, easily trainable, and easily maintainable pet. Children love to play with cats. They are friendly and harmless pets.', 'small', 8, '', 'Yes', 'Available'),
(12, 'Bamse', 'bamse.jpg', 'Prinz Eugen-Straße 20-22, 1040 Wien', 'Siberian huskies are classic northern dogs. They are intelligent but somewhat independent and stubborn. They thrive on human company, but need firm, gentle training right from puppy hood. These are dogs bred to run, and their love of running may overcome their love for their guardians at times.', 'large', 3, 'Siberian Huskies', 'Yes', 'Adopted'),
(16, 'nancy', '62db58d103ade.jpg', 'Scheugasse 55', 'cat', 'large', 3, 'German Shepherd', '', 'Available'),
(32, 'flip', '62db2725d4efe.jpg', 'Scheugasse 1', 'dog', 'small', 10, 'German Shepherd', 'Yes', 'Adopted'),
(33, 'Nanny', '62db275640200.jpg', 'Scheugasse 3', 'sdcscs', 'large', 10, 'German Shepherd', 'Yes', ''),
(35, 'gobe', '62dbaf90d5162.jpg', 'Scheugasse 3', 'gobeeeeee', 'small', 3, 'gobe', 'Yes', 'Adopted');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `pet_adoption_id` int(11) NOT NULL,
  `fk_animal_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `adoption_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`pet_adoption_id`, `fk_animal_id`, `fk_user_id`, `adoption_date`) VALUES
(0, 6, 6, '2022-07-23'),
(0, 6, 6, '2022-07-23'),
(0, 6, 6, '2022-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `password`, `date_of_birth`, `status`) VALUES
(3, 'Mona', 'Fahham', 'monafaham@yahoo.com', 67769058, 'Scheugasse, Wien', '62dae0095a597.jpg', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2022-07-07', 'adm'),
(4, 'Parvin', 'Yaghoubifar', 'pari@yahoo.com', 6776845, 'Schwedenplatz, Wien', '62daeb801981e.jpg', 'e54fc6b51915e222ba6196747a19ebb8dfa651fd2b46a385a0ded647fbfefda0', '2022-07-01', 'user'),
(6, 'Reza', 'Fahham', 'reza@yahoo.com', 0, '', '62daef5e899e6.jpg', 'e54fc6b51915e222ba6196747a19ebb8dfa651fd2b46a385a0ded647fbfefda0', '2022-07-04', 'user'),
(10, 'Hamed', 'Fahham', 'hamed@yahoo.com', 0, '', '62db4ec981d4e.jpg', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2022-07-05', 'user'),
(12, 'Sartoon', 'Mesgari', 'sartoon@yahoo.com', 0, '', '62dbc4dc93b0f.jpg', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2022-07-14', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD KEY `fk_animal_id` (`fk_animal_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`fk_animal_id`) REFERENCES `animal` (`animal_id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
