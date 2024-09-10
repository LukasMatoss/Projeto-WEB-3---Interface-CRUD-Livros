-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projeto_web
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projeto_web
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projeto_web` DEFAULT CHARACTER SET utf8mb4 ;
USE `projeto_web` ;

-- -----------------------------------------------------
-- Table `projeto_web`.`autores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_web`.`autores` (
  `id_autor` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_autor` VARCHAR(120) NOT NULL,
  `nacionalidade` VARCHAR(64) NOT NULL,
  `data_nascimento` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id_autor`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `projeto_web`.`generos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_web`.`generos` (
  `id_genero` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_genero`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `projeto_web`.`livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_web`.`livros` (
  `id_livro` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_livro` VARCHAR(120) NOT NULL,
  `editora_livro` VARCHAR(64) NOT NULL,
  `id_autor` INT(11) NOT NULL,
  `id_genero` INT(11) NOT NULL,
  PRIMARY KEY (`id_livro`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `projeto_web`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_web`.`usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO usuarios (nome_usuario, email_usuario, senha_usuario) VALUES
    ('Lukas Macacari de Matos', 'lukasrocket08@gmail.com', '451712'),
    ('Junior', 'junior04@gmail.com', 'batatafrita' );

INSERT INTO livros (nome_livro, editora_livro) VALUES
    ('Romeu e Julieta', 'Paulus Editora' ),
    ('O Senhor dos Anéis: A Sociedade do Anel', 'HarperCollins Brasil' ),
    ('Harry Potter e a Criança Amaldiçoada', 'J.K. Rowling' ),
    ('A Fúria dos Reis - As Crônicas de Gelo e Fogo', 'LEYA BRASIL' ),
    ('Pai rico, pai pobre para jovens', 'Elsevier' ),
    ('Recordando Anne Frank', 'Gutenberg Editora' ),
    ('O Príncipe', 'Bibliomundi' );

INSERT INTO autores(nome_autor, nacionalidade, data_nascimento) VALUES
    ('William Shakespeare', 'Inglês', 1564-04-23),
    ('J.R.R. Tolkien', 'Sul Africano', 1882-01-03),
    ('J.K. Rowling', 'britânica', 1965-07-31),
    ('George R. R. Martin', 'Estadunidense', 1948-09-20),
    ('Robert T. Kiyosaki, LECHTER SHARON', 'Estadunidense', 1947-04-08),
    ('Miep Gies, Alison Leslie Gold', 'Austríaca', 1909-02-15),
    ('Nicolau Maquiavel', 'Italiano', 1469-05-03);

INSERT INTO generos(tipo) VALUES
    ('Tragédia'),
    ('Ficção de aventura'),
    ('Fantasia'),
    ('Romance'),
    ('Finanças pessoais'),
    ('Autobiografia'),
    ('Não ficção');
