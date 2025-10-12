
CREATE DATABASE IF NOT EXISTS zupinturas;
USE zupinturas;


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    foto VARCHAR(255) DEFAULT 'login.png',
    telefone VARCHAR(20),
    tipo ENUM('user', 'admin') DEFAULT 'user',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Tabela de solicitações de visita
CREATE TABLE IF NOT EXISTS solicitacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    data_solicitacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    descricao TEXT,
    cep VARCHAR(9) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    complemento VARCHAR(100),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    estado VARCHAR(2),
    status ENUM('pendente', 'marcado', 'recusado') DEFAULT 'pendente',
    observacao_admin TEXT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de visitas agendadas
CREATE TABLE IF NOT EXISTS visitas_agendadas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    solicitacao_id INT NOT NULL,
    data_visita DATE NOT NULL,
    hora_visita TIME NOT NULL,
    observacoes TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (solicitacao_id) REFERENCES solicitacoes(id) ON DELETE CASCADE
);

INSERT INTO usuarios (nome, email, senha, foto, telefone, tipo)
VALUES ('João Silva', 'joao@example.com', 'senha123', 'teste2.jpg', '11999998888', 'user');


INSERT INTO usuarios (nome, email, senha, foto, telefone, tipo)
VALUES ('Admin Master', 'admin@admin.com', '1234', 'teste2.jpg', '11988887777', 'admin');