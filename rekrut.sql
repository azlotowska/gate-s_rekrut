-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Lut 2020, 19:41
-- Wersja serwera: 10.4.6-MariaDB
-- Wersja PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `rekrut`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(56) NOT NULL,
  `book_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `books`
--

INSERT INTO `books` (`id`, `name`, `book_date`) VALUES
(1, 'Zielona Mila', '2012-01-03'),
(2, 'Harry Potter', '2011-05-18'),
(3, 'Zielona Żabka', '2011-07-05'),
(4, 'Tajemnica', '2011-09-30'),
(5, 'Policja', '2011-12-06'),
(6, 'Na szafocie', '2011-12-28'),
(7, 'Co nam zostało', '2011-11-16');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` enum('m','f') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `reviews`
--

INSERT INTO `reviews` (`id`, `book_id`, `age`, `sex`) VALUES
(1, 2, 16, 'm'),
(2, 2, 29, 'f'),
(3, 4, 14, 'f'),
(4, 4, 16, 'm'),
(5, 1, 56, 'm'),
(6, 1, 58, 'm'),
(7, 3, 15, 'f'),
(8, 2, 15, 'm'),
(9, 2, 13, 'm'),
(10, 7, 29, 'f'),
(11, 7, 12, 'm'),
(12, 1, 38, 'f'),
(13, 6, 19, 'm'),
(14, 4, 17, 'f'),
(15, 3, 54, 'm'),
(16, 2, 52, 'f'),
(17, 1, 58, 'f');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `measure_interval` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `trips`
--

INSERT INTO `trips` (`id`, `name`, `measure_interval`) VALUES
(1, 'Trip 1', 15),
(2, 'Trip 2', 20),
(3, 'Trip 3', 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trip_measures`
--

CREATE TABLE `trip_measures` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `distance` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `trip_measures`
--

INSERT INTO `trip_measures` (`id`, `trip_id`, `distance`) VALUES
(1, 1, '0.00'),
(2, 1, '0.19'),
(3, 1, '0.50'),
(4, 1, '0.75'),
(5, 1, '1.00'),
(6, 1, '1.25'),
(7, 1, '1.50'),
(8, 1, '1.75'),
(9, 1, '2.00'),
(10, 1, '2.25'),
(11, 2, '0.00'),
(12, 2, '0.23'),
(13, 2, '0.46'),
(14, 2, '0.69'),
(15, 2, '0.92'),
(16, 2, '1.15'),
(17, 2, '1.38'),
(18, 2, '1.61'),
(19, 3, '0.00'),
(20, 3, '0.11'),
(21, 3, '0.22'),
(22, 3, '0.33'),
(23, 3, '0.44'),
(24, 3, '0.65'),
(25, 3, '1.08'),
(26, 3, '1.26'),
(27, 3, '1.68'),
(28, 3, '1.89'),
(29, 3, '2.10'),
(30, 3, '2.31'),
(31, 3, '2.52'),
(32, 3, '3.25');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indeksy dla tabeli `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `trip_measures`
--
ALTER TABLE `trip_measures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `trip_measures`
--
ALTER TABLE `trip_measures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
