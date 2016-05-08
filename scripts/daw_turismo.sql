-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Maio-2016 às 02:54
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `daw_turismo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE IF NOT EXISTS `cidades` (
  `cidade_Cod` int(11) NOT NULL,
  `cidade_Nome` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`cidade_Cod`, `cidade_Nome`) VALUES
(1, 'Belo Horizonte'),
(2, 'Porto Alegre'),
(3, 'São Paulo'),
(4, 'Rio de Janeiro'),
(5, 'Brasília'),
(6, 'Salvador'),
(7, 'Recife'),
(8, 'Fortaleza'),
(9, 'Belém');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `cliente_Cod` int(11) NOT NULL,
  `cliente_Email` varchar(50) NOT NULL,
  `cliente_Senha` char(50) NOT NULL,
  `cliente_Cidade` int(11) NOT NULL,
  `cliente_Nome` varchar(50) NOT NULL,
  `cliente_Foto` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cliente_Cod`, `cliente_Email`, `cliente_Senha`, `cliente_Cidade`, `cliente_Nome`, `cliente_Foto`) VALUES
(2, 'will@smith.com', '1b3b204a43829b8e393289b1a004c790', 2, 'Will Smith', '../img/users/2.jpg'),
(3, 'fcunhasantos@yahoo.com.br', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'Felipe Santos', 'img/users/user.svg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hoteis`
--

CREATE TABLE IF NOT EXISTS `hoteis` (
  `hotel_Cod` int(11) NOT NULL,
  `hotel_Nome` varchar(30) NOT NULL,
  `hotel_Categoria` int(11) NOT NULL COMMENT '1 para básico, 2 para luxo',
  `hotel_Cidade` int(11) NOT NULL,
  `hotel_Diaria` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `hoteis`
--

INSERT INTO `hoteis` (`hotel_Cod`, `hotel_Nome`, `hotel_Categoria`, `hotel_Cidade`, `hotel_Diaria`) VALUES
(1, 'Hotel Nacional', 2, 1, 300),
(2, 'Hotel Nacional', 2, 2, 300),
(3, 'Hotel Nacional', 2, 3, 300),
(4, 'Hotel Nacional', 2, 4, 300),
(5, 'Hotel Nacional', 2, 5, 300),
(6, 'Hotel Nacional', 2, 6, 300),
(7, 'Hotel Nacional', 2, 7, 300),
(8, 'Hotel Nacional', 2, 8, 300),
(9, 'Hotel Nacional', 2, 9, 300),
(10, 'Hotel Plaza', 1, 1, 150),
(11, 'Hotel Plaza', 1, 2, 150),
(12, 'Hotel Plaza', 1, 3, 150),
(13, 'Hotel Plaza', 1, 4, 150),
(14, 'Hotel Plaza', 1, 5, 150),
(15, 'Hotel Plaza', 1, 6, 150),
(16, 'Hotel Plaza', 1, 7, 150),
(17, 'Hotel Plaza', 1, 8, 150),
(18, 'Hotel Plaza', 1, 9, 150);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservashotel`
--

CREATE TABLE IF NOT EXISTS `reservashotel` (
  `reservasHotel_Cliente` int(11) NOT NULL,
  `reservasHotel_Hotel` int(11) NOT NULL,
  `reservasHotel_DataEntrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reservasHotel_DataSaida` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reservasHotel_PrecoTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservasvoo`
--

CREATE TABLE IF NOT EXISTS `reservasvoo` (
  `reservasVoo_Cliente` int(11) NOT NULL,
  `reservasVoo_Voo` int(11) NOT NULL,
  `reservasVoo_QuantPassageiros` int(11) NOT NULL,
  `reservasVoo_PrecoTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `voos`
--

CREATE TABLE IF NOT EXISTS `voos` (
  `voo_Cod` int(11) NOT NULL,
  `voo_CidadeOrigem` int(11) NOT NULL,
  `voo_CidadeDestino` int(11) NOT NULL,
  `voo_Data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `voo_Preco` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `voos`
--

INSERT INTO `voos` (`voo_Cod`, `voo_CidadeOrigem`, `voo_CidadeDestino`, `voo_Data`, `voo_Preco`) VALUES
(1002, 1, 2, '2015-07-07 11:00:00', 800),
(1003, 1, 3, '2015-07-07 09:00:00', 300),
(1004, 1, 4, '2015-07-07 12:00:00', 200),
(1005, 1, 5, '2015-07-07 13:00:00', 400),
(1006, 1, 6, '2015-07-07 14:00:00', 400),
(1007, 1, 7, '2015-07-07 07:00:00', 700),
(1008, 1, 8, '2015-07-07 08:00:00', 800),
(1009, 1, 9, '2015-07-07 13:00:00', 900);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`cidade_Cod`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_Cod`), ADD UNIQUE KEY `cliente_Email` (`cliente_Email`), ADD UNIQUE KEY `cliente_Email_2` (`cliente_Email`), ADD KEY `cliente_Cidade` (`cliente_Cidade`);

--
-- Indexes for table `hoteis`
--
ALTER TABLE `hoteis`
  ADD PRIMARY KEY (`hotel_Cod`), ADD KEY `hotel_Cidade` (`hotel_Cidade`);

--
-- Indexes for table `reservashotel`
--
ALTER TABLE `reservashotel`
  ADD PRIMARY KEY (`reservasHotel_Cliente`,`reservasHotel_Hotel`,`reservasHotel_DataEntrada`,`reservasHotel_DataSaida`), ADD KEY `reservasHotel_Hotel` (`reservasHotel_Hotel`);

--
-- Indexes for table `reservasvoo`
--
ALTER TABLE `reservasvoo`
  ADD PRIMARY KEY (`reservasVoo_Cliente`,`reservasVoo_Voo`), ADD KEY `reservasVoo_Voo` (`reservasVoo_Voo`);

--
-- Indexes for table `voos`
--
ALTER TABLE `voos`
  ADD PRIMARY KEY (`voo_Cod`), ADD KEY `voo_CidadeOrigem` (`voo_CidadeOrigem`,`voo_CidadeDestino`), ADD KEY `voo_CidadeDestino` (`voo_CidadeDestino`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cidades`
--
ALTER TABLE `cidades`
  MODIFY `cidade_Cod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_Cod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`cliente_Cidade`) REFERENCES `cidades` (`cidade_Cod`);

--
-- Limitadores para a tabela `hoteis`
--
ALTER TABLE `hoteis`
ADD CONSTRAINT `hoteis_ibfk_1` FOREIGN KEY (`hotel_Cidade`) REFERENCES `cidades` (`cidade_Cod`);

--
-- Limitadores para a tabela `reservashotel`
--
ALTER TABLE `reservashotel`
ADD CONSTRAINT `reservashotel_ibfk_1` FOREIGN KEY (`reservasHotel_Cliente`) REFERENCES `clientes` (`cliente_Cod`),
ADD CONSTRAINT `reservashotel_ibfk_2` FOREIGN KEY (`reservasHotel_Hotel`) REFERENCES `hoteis` (`hotel_Cod`);

--
-- Limitadores para a tabela `reservasvoo`
--
ALTER TABLE `reservasvoo`
ADD CONSTRAINT `reservasvoo_ibfk_1` FOREIGN KEY (`reservasVoo_Cliente`) REFERENCES `clientes` (`cliente_Cod`),
ADD CONSTRAINT `reservasvoo_ibfk_2` FOREIGN KEY (`reservasVoo_Voo`) REFERENCES `voos` (`voo_Cod`);

--
-- Limitadores para a tabela `voos`
--
ALTER TABLE `voos`
ADD CONSTRAINT `voos_ibfk_1` FOREIGN KEY (`voo_CidadeOrigem`) REFERENCES `cidades` (`cidade_Cod`),
ADD CONSTRAINT `voos_ibfk_2` FOREIGN KEY (`voo_CidadeDestino`) REFERENCES `cidades` (`cidade_Cod`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
