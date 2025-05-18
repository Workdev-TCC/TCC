
CREATE DATABASE IF NOT EXISTS zupinturas;
USE zupinturas;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    tipo ENUM('user', 'admin') DEFAULT 'user',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO usuarios (nome, email, senha, telefone, tipo)
VALUES ('João Silva', 'joao@example.com', 'senha123', '11999998888', 'user');


INSERT INTO usuarios (nome, email, senha, telefone, tipo)
VALUES ('Admin Master', 'admin@example.com', 'admin123', '11988887777', 'admin');