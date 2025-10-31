-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/10/2025 às 18:34
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12
CREATE IF NOT EXISTS DATABASE zupinturas;
USE zupinturas;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `zupinturas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacoes`
--

CREATE TABLE `solicitacoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_solicitacao` datetime DEFAULT current_timestamp(),
  `descricao` text DEFAULT NULL,
  `cep` varchar(9) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `status` enum('pendente','marcado','recusado') DEFAULT 'pendente',
  `observacao_admin` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `solicitacoes`
--

INSERT INTO `solicitacoes` (`id`, `usuario_id`, `data_solicitacao`, `descricao`, `cep`, `endereco`, `complemento`, `status`, `observacao_admin`) VALUES
(1, 1, '2025-10-13 14:30:52', 'teste1', '18072440', 'Sorocaba, Parque São Bento, Rua Maria de Fátima Faria, 12º.', 'teste1', 'marcado', NULL),
(2, 1, '2025-10-22 15:35:00', 'pintura', '24732890', 'São Gonçalo, Amendoeira, Rua Manuel Martins, 123º.', '', 'marcado', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT 'login.png',
  `telefone` varchar(20) DEFAULT NULL,
  `tipo` enum('user','admin') DEFAULT 'user',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `foto`, `telefone`, `tipo`, `data_criacao`) VALUES
(1, 'João Silva', 'joao@example.com', 'senha123', 'teste2.jpg', '11999998888', 'user', '2025-10-13 17:22:28'),
(2, 'Adm supremo', 'admin@admin.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.Kk8J1FOv3QAsHbSlRfRddxjc79uc6lS', 'img_68f99df2b073e8.64069580.jpg', '15997922637', 'admin', '2025-10-13 17:22:28'),
(4, 'GUSTAVO SILVA PRADO', 'teste@gmail.com', '1234', 'login.png', '15997922637', 'user', '2025-10-25 15:37:45');

-- --------------------------------------------------------

--
-- Estrutura para tabela `visitas_agendadas`
--

CREATE TABLE `visitas_agendadas` (
  `id` int(11) NOT NULL,
  `solicitacao_id` int(11) NOT NULL,
  `data_visita` date NOT NULL,
  `hora_visita` time NOT NULL,
  `observacoes` text DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `visitas_agendadas`
--

INSERT INTO `visitas_agendadas` (`id`, `solicitacao_id`, `data_visita`, `hora_visita`, `observacoes`, `criado_em`) VALUES
(2, 2, '2025-10-24', '18:30:00', NULL, '2025-10-22 18:52:43'),
(3, 1, '2025-10-24', '13:26:00', NULL, '2025-10-22 19:26:52');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `visitas_agendadas`
--
ALTER TABLE `visitas_agendadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitacao_id` (`solicitacao_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `visitas_agendadas`
--
ALTER TABLE `visitas_agendadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD CONSTRAINT `solicitacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `visitas_agendadas`
--
ALTER TABLE `visitas_agendadas`
  ADD CONSTRAINT `visitas_agendadas_ibfk_1` FOREIGN KEY (`solicitacao_id`) REFERENCES `solicitacoes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
