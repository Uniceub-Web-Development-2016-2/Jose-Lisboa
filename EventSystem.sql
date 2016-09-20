-- MySQL Script generated by MySQL Workbench
-- Ter 20 Set 2016 19:07:37 BRT
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`tb_address`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_address` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_address` (
  `idt_address` INT NOT NULL AUTO_INCREMENT,
  `cep` VARCHAR(8) NOT NULL,
  `logradouro` VARCHAR(80) NULL,
  `bairro` VARCHAR(60) NULL,
  `localidade` VARCHAR(60) NULL,
  `uf` VARCHAR(2) NULL,
  `complemento` VARCHAR(45) NULL,
  `numero` INT(4) NULL,
  PRIMARY KEY (`idt_address`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_user` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_user` (
  `idt_user` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(80) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `cod_address` INT NOT NULL,
  `gender` VARCHAR(1) NULL,
  `phonenumber` VARCHAR(11) NOT NULL,
  `phonenumber2` VARCHAR(11) NULL,
  `usertype` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`idt_user`),
  INDEX `fk_tb_user_tb_address_idx` (`cod_address` ASC),
  CONSTRAINT `fk_tb_user_tb_address`
    FOREIGN KEY (`cod_address`)
    REFERENCES `mydb`.`tb_address` (`idt_address`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_workshop`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_workshop` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_workshop` (
  `idt_workshop` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `subscriberslitmit` INT(2) NOT NULL,
  `comments` TEXT(500) NULL,
  PRIMARY KEY (`idt_workshop`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_event` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_event` (
  `idt_event` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(80) NOT NULL,
  `theme` VARCHAR(80) NULL,
  `startdate` DATE NOT NULL,
  `enddate` DATE NOT NULL,
  `cod_eventlocation` INT NOT NULL,
  `registrationfee` INT(4) NULL,
  `subscriberslimit` INT(4) NOT NULL,
  `cod_workshop` INT NOT NULL,
  `comments` TEXT(200) NULL,
  PRIMARY KEY (`idt_event`),
  INDEX `fk_tb_event_tb_address1_idx` (`cod_eventlocation` ASC),
  INDEX `fk_tb_event_tb_workshop1_idx` (`cod_workshop` ASC),
  CONSTRAINT `fk_tb_event_tb_address1`
    FOREIGN KEY (`cod_eventlocation`)
    REFERENCES `mydb`.`tb_address` (`idt_address`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_event_tb_workshop1`
    FOREIGN KEY (`cod_workshop`)
    REFERENCES `mydb`.`tb_workshop` (`idt_workshop`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_payment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_payment` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_payment` (
  `idt_payment` INT NOT NULL AUTO_INCREMENT,
  `value` INT(4) NOT NULL,
  `status` INT(1) NULL,
  `cod_user` INT NOT NULL,
  `cod_event` INT NOT NULL,
  PRIMARY KEY (`idt_payment`),
  INDEX `fk_tb_payment_tb_user1_idx` (`cod_user` ASC),
  INDEX `fk_tb_payment_tb_event1_idx` (`cod_event` ASC),
  CONSTRAINT `fk_tb_payment_tb_user1`
    FOREIGN KEY (`cod_user`)
    REFERENCES `mydb`.`tb_user` (`idt_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_payment_tb_event1`
    FOREIGN KEY (`cod_event`)
    REFERENCES `mydb`.`tb_event` (`idt_event`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_participation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`tb_participation` ;

CREATE TABLE IF NOT EXISTS `mydb`.`tb_participation` (
  `idt_participation` INT NOT NULL AUTO_INCREMENT,
  `status` INT(1) NULL,
  `cod_payment` INT NULL,
  `cod_user` INT NOT NULL,
  `cod_event` INT NOT NULL,
  PRIMARY KEY (`idt_participation`),
  INDEX `fk_tb_participation_tb_payment1_idx` (`cod_payment` ASC),
  INDEX `fk_tb_participation_tb_user1_idx` (`cod_user` ASC),
  INDEX `fk_tb_participation_tb_event1_idx` (`cod_event` ASC),
  CONSTRAINT `fk_tb_participation_tb_payment1`
    FOREIGN KEY (`cod_payment`)
    REFERENCES `mydb`.`tb_payment` (`idt_payment`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_participation_tb_user1`
    FOREIGN KEY (`cod_user`)
    REFERENCES `mydb`.`tb_user` (`idt_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_participation_tb_event1`
    FOREIGN KEY (`cod_event`)
    REFERENCES `mydb`.`tb_event` (`idt_event`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
