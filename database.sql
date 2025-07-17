-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS mini_erp;
USE mini_erp;

-- Tabela produtos
CREATE TABLE produtos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- Tabela estoques
CREATE TABLE estoques (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    produto_id BIGINT UNSIGNED NOT NULL,
    variacao VARCHAR(255) NULL,
    quantidade INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabela pedidos
CREATE TABLE pedidos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subtotal DECIMAL(10,2) NOT NULL,
    frete DECIMAL(10,2) NOT NULL,
    cep VARCHAR(10) NULL,
    endereco TEXT NULL,
    status ENUM('pendente', 'confirmado', 'cancelado') DEFAULT 'pendente',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- Tabela cupons
CREATE TABLE cupons (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    desconto DECIMAL(10,2) NOT NULL,
    valor_minimo DECIMAL(10,2) NOT NULL,
    validade DATE NOT NULL,
    ativo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- Tabela sessions
CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX user_id (user_id),
    INDEX last_activity (last_activity)
) ENGINE=InnoDB;

-- Tabela cache
CREATE TABLE cache (
    `key` VARCHAR(255) PRIMARY KEY,
    `value` MEDIUMTEXT NOT NULL,
    expiration INT NOT NULL
) ENGINE=InnoDB;

-- Tabela cache_locks
CREATE TABLE cache_locks (
    `key` VARCHAR(255) PRIMARY KEY,
    `owner` VARCHAR(255) NOT NULL,
    expiration INT NOT NULL
) ENGINE=InnoDB;

-- Dados de teste
INSERT INTO produtos (nome, preco, created_at, updated_at) VALUES
('Camiseta', 50.00, NOW(), NOW()),
('Calça', 100.00, NOW(), NOW()),
('Tênis', 150.00, NOW(), NOW());

INSERT INTO estoques (produto_id, variacao, quantidade, created_at, updated_at) VALUES
(1, 'Azul', 10, NOW(), NOW()),
(1, 'Vermelho', 15, NOW(), NOW()),
(2, NULL, 20, NOW(), NOW()),
(3, 'Branco', 5, NOW(), NOW());

INSERT INTO cupons (codigo, desconto, valor_minimo, validade, ativo, created_at, updated_at) VALUES
('DESC10', 10.00, 50.00, '2025-12-31', 1, NOW(), NOW());
