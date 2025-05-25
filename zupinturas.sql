
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

CREATE TABLE orcamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  area DECIMAL(10,2),
  demao INT,
  rendimento DECIMAL(10,2),
  preco_tinta DECIMAL(10,2),
  mao_obra DECIMAL(10,2),
  extras DECIMAL(10,2),
  litros_necessarios DECIMAL(10,2),
  gasto_material DECIMAL(10,2),
  gasto_mao_obra DECIMAL(10,2),
  total_extras DECIMAL(10,2),
  lucro_aplicado DECIMAL(10,2),
  valor_sem_lucro DECIMAL(10,2),
  valor_final DECIMAL(10,2),
  data_orcamento TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (nome, email, senha, foto, telefone, tipo)
VALUES ('João Silva', 'joao@example.com', 'senha123', 'teste2.jpg', '11999998888', 'user');


INSERT INTO usuarios (nome, email, senha, foto, telefone, tipo)
VALUES ('Admin Master', 'admin@admin.com', '1234', 'teste2.jpg', '11988887777', 'admin');