CREATE DATABASE olx_challenge;
USE olx_challenge;
CREATE TABLE user (
    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(80) NOT NULL,
    apelido VARCHAR(80) NOT NULL,
    email VARCHAR(80) NOT NULL,
    password VARCHAR(64) NOT NULL,
    rua VARCHAR(150) NOT NULL,
    codigo_postal VARCHAR(7) NOT NULL,
    localidade VARCHAR(50) NOT NULL,
    pais VARCHAR(50) NOT NULL,
    nif INT NOT NULL,
    telefone INT NOT NULL,
    UNIQUE(nif),
    UNIQUE(email)
) ENGINE = InnoDB;