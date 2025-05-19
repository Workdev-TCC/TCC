
CREATE DATABASE IF NOT EXISTS zupinturas;
USE zupinturas;


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    foto VARCHAR(255),
    telefone VARCHAR(20),
    tipo ENUM('user', 'admin') DEFAULT 'user',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO usuarios (nome, email, senha, foto, telefone, tipo)
VALUES ('João Silva', 'joao@example.com', 'senha123', 'teste2.jpg', '11999998888', 'user','teste.jpg');


INSERT INTO usuarios (nome, email, senha, foto, telefone, tipo)
VALUES ('Admin Master', 'admin@admin.com', '1234', 'teste2.jpg', '11988887777', 'admin');