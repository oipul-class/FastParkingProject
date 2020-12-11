-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dbFastParking
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbFastParking
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbFastParking` DEFAULT CHARACTER SET utf8 ;
USE `dbFastParking` ;

-- -----------------------------------------------------
-- Table `dbFastParking`.`tblCliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFastParking`.`tblCliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFastParking`.`tblVeiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFastParking`.`tblVeiculo` (
  `idVeiculo` INT NOT NULL AUTO_INCREMENT,
  `placa` VARCHAR(10) NOT NULL,
  `marca` VARCHAR(45) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idVeiculo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFastParking`.`tblEntrada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFastParking`.`tblEntrada` (
  `idEntrada` INT NOT NULL AUTO_INCREMENT,
  `dataDeEntrada` DATE NOT NULL,
  `horaDeEntrada` TIME NOT NULL,
  PRIMARY KEY (`idEntrada`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFastParking`.`tblSaida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFastParking`.`tblSaida` (
  `idSaida` INT NOT NULL AUTO_INCREMENT,
  `dataDeSaida` DATE NULL,
  `horaDeSaida` TIME NULL,
  PRIMARY KEY (`idSaida`))
ENGINE = InnoDB
COMMENT = '		';


-- -----------------------------------------------------
-- Table `dbFastParking`.`tblEstadia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFastParking`.`tblEstadia` (
  `idEstadia` INT NOT NULL AUTO_INCREMENT,
  `idCliente` INT NOT NULL,
  `idVeiculo` INT NOT NULL,
  `idEntrada` INT NOT NULL,
  `idSaida` INT NOT NULL,
  `pago` TINYINT NOT NULL,
  `valor` DOUBLE NULL,
  PRIMARY KEY (`idEstadia`),
  INDEX `fk_tblEstadia_tblCliente_idx` (`idCliente` ASC) VISIBLE,
  INDEX `fk_tblEstadia_tblVeiculo1_idx` (`idVeiculo` ASC) VISIBLE,
  INDEX `fk_tblEstadia_tblEntrada1_idx` (`idEntrada` ASC) VISIBLE,
  INDEX `fk_tblEstadia_tblSiada1_idx` (`idSaida` ASC) VISIBLE,
  CONSTRAINT `fk_tblEstadia_tblCliente`
    FOREIGN KEY (`idCliente`)
    REFERENCES `dbFastParking`.`tblCliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tblEstadia_tblVeiculo1`
    FOREIGN KEY (`idVeiculo`)
    REFERENCES `dbFastParking`.`tblVeiculo` (`idVeiculo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tblEstadia_tblEntrada1`
    FOREIGN KEY (`idEntrada`)
    REFERENCES `dbFastParking`.`tblEntrada` (`idEntrada`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tblEstadia_tblSiada1`
    FOREIGN KEY (`idSaida`)
    REFERENCES `dbFastParking`.`tblSaida` (`idSaida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFastParking`.`tblPrecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFastParking`.`tblPrecos` (
  `idPreco` INT NOT NULL AUTO_INCREMENT,
  `precoEntrada` DOUBLE NULL,
  `precoAdicional` DOUBLE NULL,
  PRIMARY KEY (`idPreco`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFastParking`.`tblUsuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFastParking`.`tblUsuarios` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `statusUsuario` TINYINT NOT NULL,
  `nivelAcesso` INT NOT NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

use dbFastParking;

insert into tblCliente (nome) values("tuts da sildsva");

select* from tblCliente;

insert into tblVeiculo (placa, marca, modelo) values ("test2t44" , "fiat", "toro");

select * from tblVeiculo;

update tblVeiculo set
placa = replace(upper(placa),"-", "");

insert into tblEntrada (dataDeEntrada, horaDeEntrada) values (current_date(), current_time());

select * from tblEntrada;

insert into tblSaida (dataDeSaida, horaDeSaida) values (current_date() , "22:20:30");

select * from tblSaida;

insert into tblEstadia (idCliente, idVeiculo, idEntrada, idSaida, valor, pago) values (1,1,3,3,25.00, false);

select * from tblEstadia;

delete from tblEstadia where idEstadia = 5;

select tblCliente.*, tblVeiculo.*, tblEntrada.*, tblSaida.* from tblCliente, tblVeiculo, tblEntrada, tblSaida, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEntrada = tblEntrada.idEntrada and tblEstadia.idSaida = tblSaida.idSaida;

insert into tblPrecos (precoEntrada, precoAdicional) values (12.00 , 5.00);

select * from tblPrecos;

select tblEntrada.idEntrada, tblEntrada.dataDeEntrada, tblEntrada.horaDeEntrada from tblEntrada, tblEstadia, tblVeiculo where tblVeiculo.placa = "	" and tblVeiculo.idVeiculo = tblEstadia.idVeiculo and tblEntrada.idEntrada = tblEstadia.idEntrada;

select tblCliente.*, tblVeiculo.*, tblEntrada.*, tblSaida.*, tblEstadia.* from tblCliente, tblVeiculo, tblEntrada, tblSaida, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEntrada = tblEntrada.idEntrada and tblEstadia.idSaida = tblSaida.idSaida;

select tblCliente.*, tblVeiculo.*, tblEntrada.*, tblSaida.*, tblEstadia.* from tblCliente, tblVeiculo, tblEntrada, tblSaida, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEntrada = tblEntrada.idEntrada and tblEstadia.idSaida = tblSaida.idSaida and tblVeiculo.placa = "TEST2T18";

select tblCliente.*, tblVeiculo.*, tblEntrada.*, tblSaida.*, tblEstadia.* from tblCliente, tblVeiculo, tblEntrada, tblSaida, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEntrada = tblEntrada.idEntrada and tblEstadia.idSaida = tblSaida.idSaida;

select idEntrada from tblEntrada order by idEntrada desc limit 1;

select tblCliente.*, tblVeiculo.*, tblEntrada.*, tblSaida.*, tblEstadia.* from tblCliente, tblVeiculo, tblEntrada, tblSaida, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEntrada = tblEntrada.idEntrada and tblEstadia.idSaida = tblSaida.idSaida and tblEstadia.idEstadia = 2;
	
select tblCliente.*, tblVeiculo.*, tblEntrada.*, tblSaida.*, tblEstadia.* from tblCliente, tblVeiculo, tblEntrada, tblSaida, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEntrada = tblEntrada.idEntrada and tblEstadia.idSaida = tblSaida.idSaida and tblVeiculo.placa = 'TEST2T18';

select tblCliente.*, tblVeiculo.*, tblEntrada.*, tblSaida.*, tblEstadia.* from tblCliente, tblVeiculo, tblEntrada, tblSaida, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEntrada = tblEntrada.idEntrada and tblEstadia.idSaida = tblSaida.idSaida and tblVeiculo.placa = 'TEST2T18';

select * from tblVeiculo;

