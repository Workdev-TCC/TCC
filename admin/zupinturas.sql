-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/11/2025 às 12:47
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

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
  `tipo_servico` varchar(200) DEFAULT NULL,
  `status` enum('pendente','marcado','recusado') DEFAULT 'pendente',
  `observacao_admin` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `solicitacoes`
--

INSERT INTO `solicitacoes` (`id`, `usuario_id`, `data_solicitacao`, `descricao`, `cep`, `endereco`, `complemento`, `tipo_servico`, `status`, `observacao_admin`) VALUES
(1, 1, '2025-11-17 12:32:03', 'casa toda', '77064332', 'Palmas, Setor Vale do Sol (Taquaralto), Rua NC 8, Nº 12 - casa', 'casa', '[\"pintura interna\",\"pintura de fachada\",\"pintura de portoes\",\"pintura decorativa\",\"aplicação de texturas\",\"pintura predial\"]', 'marcado', NULL),
(2, 3, '2025-11-17 12:37:24', 'teste', '77064332', 'Palmas, Setor Vale do Sol (Taquaralto), Rua NC 8, Nº 34', '', '[\"aplicação de texturas\"]', 'recusado', 'n gostei');

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
(1, 'User teste', 'user@user.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.Kk8J1FOv3QAsHbSlRfRddxjc79uc6lS', 'semimagem.jpg', '11999998888', 'user', '2025-10-13 23:22:28'),
(2, 'ADM teste', 'admin@admin.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.Kk8J1FOv3QAsHbSlRfRddxjc79uc6lS', 'img_691b09d8da4cd2.04723947.jpg', '15997922637', 'admin', '2025-10-13 23:22:28'),
(3, 'Gustavo Silva Prado', 'gustavo.sp3012@gmail.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.HPiKA8RZGzfv8vkdzVJDxjVL2GqaehC', 'login.png', '(15) 99792-2637', 'user', '2025-11-17 11:29:21');

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
(1, 1, '2025-11-21', '12:42:00', NULL, '2025-11-17 11:37:53');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_solicitacao` (`usuario_id`);

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
  ADD KEY `fk_visita_solicitacao` (`solicitacao_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD CONSTRAINT `fk_usuario_solicitacao` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `visitas_agendadas`
--
ALTER TABLE `visitas_agendadas`
  ADD CONSTRAINT `fk_visita_solicitacao` FOREIGN KEY (`solicitacao_id`) REFERENCES `solicitacoes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
