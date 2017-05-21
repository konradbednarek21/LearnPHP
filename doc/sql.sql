-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Maj 2017, 11:30
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wordgame`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `points` int(11) NOT NULL,
  `count_add_word` int(11) DEFAULT NULL,
  `count_fail_word` int(11) DEFAULT NULL,
  `api` tinyint(1) DEFAULT NULL,
  `count_get_word_api` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`iduser`, `user`, `pass`, `email`, `points`, `count_add_word`, `count_fail_word`, `api`, `count_get_word_api`) VALUES
(1, 'konrad', 'test', 'test@gmail.com', 0, 0, 0, 1, 0),
(2, 'bartek', '1', 'gromulab@gmail.com', 0, 0, 0, 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `id` (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
