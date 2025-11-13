CREATE DATABASE IF NOT EXISTS zupinturas;
USE zupinturas;

-- Tabela de usuários
CREATE TABLE `usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL,
  `foto` VARCHAR(255) DEFAULT 'login.png',
  `telefone` VARCHAR(20) DEFAULT NULL,
  `tipo` ENUM('user','admin') DEFAULT 'user',
  `data_criacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela de solicitações
CREATE TABLE `solicitacoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NOT NULL,
  `data_solicitacao` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `descricao` TEXT DEFAULT NULL,
  `cep` VARCHAR(9) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `complemento` VARCHAR(100) DEFAULT NULL,
  `tipo_servico` VARCHAR(200) DEFAULT NULL, -- 👈 nova coluna adicionada aqui
  `status` ENUM('pendente','marcado','recusado') DEFAULT 'pendente',
  `observacao_admin` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_usuario_solicitacao` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserção de usuários
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `foto`, `telefone`, `tipo`, `data_criacao`) VALUES
(1, 'User teste', 'user@user.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.Kk8J1FOv3QAsHbSlRfRddxjc79uc6lS', 'semimagem.jpg', '11999998888', 'user', '2025-10-13 20:22:28'),
(2, 'ADM teste', 'admin@admin.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.Kk8J1FOv3QAsHbSlRfRddxjc79uc6lS', 'semimagem.jpg', '15997922637', 'admin', '2025-10-13 20:22:28');

-- Tabela de visitas agendadas
CREATE TABLE `visitas_agendadas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `solicitacao_id` INT(11) NOT NULL,
  `data_visita` DATE NOT NULL,
  `hora_visita` TIME NOT NULL,
  `observacoes` TEXT DEFAULT NULL,
  `criado_em` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_visita_solicitacao` FOREIGN KEY (`solicitacao_id`) REFERENCES `solicitacoes`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- senha dos 2 é: 12345
