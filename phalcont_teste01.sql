-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Jul-2021 às 00:09
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE phalcont_teste01;

USE phalcont_teste01;

--
-- Banco de dados: `phalcont_teste01`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `descricao`) VALUES
(1, 'Esportiva'),
(2, 'Corona Vírus'),
(3, 'Saúde'),
(4, 'Tecnologia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `titulo` varchar(500) DEFAULT NULL,
  `texto` text DEFAULT NULL,
  `data_ultima_atualizacao` datetime DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `publicado` int(1) DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`id`, `titulo`, `texto`, `data_ultima_atualizacao`, `data_cadastro`, `publicado`, `data_publicacao`) VALUES
(21, 'Titulo 1', 'Texto 1', '2021-07-26 18:25:43', '2021-07-26 11:14:31', 1, '2021-12-07'),
(22, 'Titulo 2', 'Texto 2', '2021-07-26 13:25:03', '2021-07-26 11:21:55', NULL, NULL),
(26, 'Titulo 3', 'Texto 3', '2021-07-26 17:54:06', '2021-07-26 13:25:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia_categoria`
--

CREATE TABLE `noticia_categoria` (
  `id` int(11) NOT NULL,
  `noticia_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `noticia_categoria`
--

INSERT INTO `noticia_categoria` (`id`, `noticia_id`, `categoria_id`) VALUES
(3, 26, 1),
(4, 26, 2),
(19, 21, 1),
(20, 21, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Teste', 'teste1@brasilbigdata.com.br', '123456');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `noticia_categoria`
--
ALTER TABLE `noticia_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia_id` (`noticia_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `noticia_categoria`
--
ALTER TABLE `noticia_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `noticia_categoria`
--
ALTER TABLE `noticia_categoria`
  ADD CONSTRAINT `noticia_categoria_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `noticia` (`id`),
  ADD CONSTRAINT `noticia_categoria_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
