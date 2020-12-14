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
-- Table `dbFastParking`.`tblEstadia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFastParking`.`tblEstadia` (
  `idEstadia` INT NOT NULL AUTO_INCREMENT,
  `nomeDoCliente` VARCHAR(200) NOT NULL,
  `placaDoVeiculo` VARCHAR(20) NOT NULL,
  `dataDaEntrada` DATE NOT NULL,
  `horaDaEntrada` TIME NOT NULL,
  `dataDaSaida` DATE,
  `horaDaSaida` TIME,
  `pago` TINYINT NOT NULL,
  `valor` DOUBLE,
  PRIMARY KEY (`idEstadia`))
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

select * from tblEstadia;


/*insert into tblCliente (nome) values("tuts da sildsva");

select* from tblCliente;

insert into tblVeiculo (placa, marca, modelo) values ("test2t44" , "fiat", "toro");

select * from tblVeiculo;

update tblVeiculo set
placa = replace(upper(placa),"-", "");

insert into tblEstadia (idCliente, idVeiculo, dataDaEntrada , horaDaEntrada, dataDaSaida, horaDaSaida, valor, pago) values (1,1,current_date(),current_time(),null,null	,25.00, false);

select * from tblEstadia;


insert into tblPrecos (precoEntrada, precoAdicional) values (12.00 , 5.00);

select * from tblPrecos;



select idEntrada from tblEntrada order by idEntrada desc limit 1;

select tblCliente.*, tblVeiculo.*, tblEstadia.* from tblCliente, tblVeiculo, tblEstadia where tblEstadia.idCliente =
tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo;

select * from tblVeiculo;

select * from tblPrecos;

insert into tblCliente (nome) values('pedroca'); */

select * from tblPrecos;

insert into tblPrecos(precoEntrada, precoAdicional) values ('12' , '6');

