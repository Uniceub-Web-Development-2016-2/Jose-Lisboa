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
-- Table `mydb`.`address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`address` (
  `id_address` INT NOT NULL AUTO_INCREMENT,
  `cep` VARCHAR(8) NOT NULL,
  `logradouro` VARCHAR(80) NULL,
  `bairro` VARCHAR(60) NULL,
  `localidade` VARCHAR(60) NULL,
  `uf` VARCHAR(2) NULL,
  `complemento` VARCHAR(45) NULL,
  `numero` INT(4) NULL,
  PRIMARY KEY (`id_address`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `cpf` VARCHAR(14) NOT NULL,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(65) NULL,
  `email` VARCHAR(80) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `cod_address` INT NULL,
  `gender` VARCHAR(1) NULL,
  `phonenumber` VARCHAR(11) NOT NULL,
  `phonenumber2` VARCHAR(11) NULL,
  `usertype` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`cpf`),
  INDEX `fk_tb_user_tb_address_idx` (`cod_address` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`event` (
  `id_event` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(80) NOT NULL,
  `theme` VARCHAR(80) NULL,
  `startdate` DATE NOT NULL,
  `enddate` DATE NOT NULL,
  `starttime` INT(2) NULL,
  `cod_eventlocation` INT NOT NULL,
  `registrationfee` INT(4) NULL,
  `subscriberslimit` INT(4) NOT NULL,
  `comments` TEXT(200) NULL,
  `eventcreator` VARCHAR(14) NOT NULL,
  PRIMARY KEY (`id_event`),
  INDEX `fk_tb_event_tb_address1_idx` (`cod_eventlocation` ASC),
  INDEX `fk_event_user1_idx` (`eventcreator` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`workshop`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`workshop` (
  `id_workshop` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `subscriberslitmit` INT(2) NOT NULL,
  `comments` TEXT(500) NULL,
  `cod_event` INT NOT NULL,
  PRIMARY KEY (`id_workshop`),
  INDEX `fk_workshop_event1_idx` (`cod_event` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`payment` (
  `id_payment` INT NOT NULL AUTO_INCREMENT,
  `value` INT(4) NOT NULL,
  `cod_user` VARCHAR(14) NOT NULL,
  `status` INT(1) NULL,
  `cod_event` INT NOT NULL,
  `paymentdate` DATE NOT NULL,
  PRIMARY KEY (`id_payment`),
  INDEX `fk_tb_payment_tb_event1_idx` (`cod_event` ASC),
  INDEX `fk_payment_user1_idx` (`cod_user` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`subscription`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`subscription` (
  `id_subscription` INT NOT NULL AUTO_INCREMENT,
  `status` INT(1) NOT NULL,
  `cod_payment` INT NULL,
  `cod_user` VARCHAR(14) NOT NULL,
  `cod_event` INT NOT NULL,
  `subscriptiondate` DATE NOT NULL,
  PRIMARY KEY (`id_subscription`),
  INDEX `fk_tb_participation_tb_payment1_idx` (`cod_payment` ASC),
  INDEX `fk_tb_participation_tb_event1_idx` (`cod_event` ASC),
  INDEX `fk_subscription_user1_idx` (`cod_user` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`address`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`address` (`id_address`, `cep`, `logradouro`, `bairro`, `localidade`, `uf`, `complemento`, `numero`) VALUES (1, '71692060', 'Quadra 101 conjunto 12', 'Residencial Oeste (São Sebastião)', 'Brasília', 'DF', 'Lote', 10);
INSERT INTO `mydb`.`address` (`id_address`, `cep`, `logradouro`, `bairro`, `localidade`, `uf`, `complemento`, `numero`) VALUES (2, '70200014', 'SES 801 conjunto B', 'Asa Sul', 'Brasília', 'DF', 'N/A', NULL);
INSERT INTO `mydb`.`address` (`id_address`, `cep`, `logradouro`, `bairro`, `localidade`, `uf`, `complemento`, `numero`) VALUES (3, '70070350', 'SDC', 'Zona Cívico-Administrativa', 'Brasília', 'DF', 'Loja', 20);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`user`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`user` (`cpf`, `firstname`, `lastname`, `email`, `password`, `cod_address`, `gender`, `phonenumber`, `phonenumber2`, `usertype`) VALUES ('052.099.411-67', 'José', 'Lisboa', 'josemrlisboa@gmail.com', '123', 1, 'M', '61981161217', '6121038378', 'A');
INSERT INTO `mydb`.`user` (`cpf`, `firstname`, `lastname`, `email`, `password`, `cod_address`, `gender`, `phonenumber`, `phonenumber2`, `usertype`) VALUES ('012.045.698-23', 'Fulano', 'de Tal', 'josemrl7@yahoo.com', '456', 1, 'M', '61995357363', NULL, 'H');
INSERT INTO `mydb`.`user` (`cpf`, `firstname`, `lastname`, `email`, `password`, `cod_address`, `gender`, `phonenumber`, `phonenumber2`, `usertype`) VALUES ('007.998.425-83', 'Genésia', 'da Silva', 'g.dasilva@uol.com.br', '789', 2, 'F', '61999654723', NULL, 'G');
INSERT INTO `mydb`.`user` (`cpf`, `firstname`, `lastname`, `email`, `password`, `cod_address`, `gender`, `phonenumber`, `phonenumber2`, `usertype`) VALUES ('099.264.169-18', 'Edvalda Ambrósio', 'de Souza', 'edv.ambrosio.alda@hotmail.com', '098', 2, 'F', '61998877678', NULL, 'G');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`event`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`event` (`id_event`, `name`, `theme`, `startdate`, `enddate`, `starttime`, `cod_eventlocation`, `registrationfee`, `subscriberslimit`, `comments`, `eventcreator`) VALUES (1, 'Semana Nacional de Ciencias Sociais', 'tfhg kjhkj', '2017-03-22', '2017-03-28', NULL, 3, 50, 100, 'erje rwer werwfs ere', '012.045.698-23');
INSERT INTO `mydb`.`event` (`id_event`, `name`, `theme`, `startdate`, `enddate`, `starttime`, `cod_eventlocation`, `registrationfee`, `subscriberslimit`, `comments`, `eventcreator`) VALUES (2, 'Coaching em Financas', 'hgjhj', '2017-06-02', '2017-06-02', 8, 3, 120, 150, 'sdkfs lkjfs flksadjf', '012.045.698-23');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`workshop`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`workshop` (`id_workshop`, `name`, `subscriberslitmit`, `comments`, `cod_event`) VALUES (1, 'Ciranda liberal', 25, 'sdkjf sdlj lsdkjf ', 1);
INSERT INTO `mydb`.`workshop` (`id_workshop`, `name`, `subscriberslitmit`, `comments`, `cod_event`) VALUES (2, 'Debate com chá sobre a conjuntura geopolítica atual', 45, 'sdf sd fdsa ', 1);
INSERT INTO `mydb`.`workshop` (`id_workshop`, `name`, `subscriberslitmit`, `comments`, `cod_event`) VALUES (3, 'Palestra com Guilerme Nogayra sober finanças', 120, 'sdk asfkasd lk ', 2);
INSERT INTO `mydb`.`workshop` (`id_workshop`, `name`, `subscriberslitmit`, `comments`, `cod_event`) VALUES (4, 'Palestra do prof. dr. Higão', 50, 'sdklf sdf aslk', 1);
INSERT INTO `mydb`.`workshop` (`id_workshop`, `name`, `subscriberslitmit`, `comments`, `cod_event`) VALUES (5, 'Palestra sobre money management com Caio Henrique', 120, 'sdlksnadljlk lksjdflks', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`payment`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`payment` (`id_payment`, `value`, `cod_user`, `status`, `cod_event`, `paymentdate`) VALUES (1, 50, '007.998.425-83', 1, 1, '2016-01-25');
INSERT INTO `mydb`.`payment` (`id_payment`, `value`, `cod_user`, `status`, `cod_event`, `paymentdate`) VALUES (2, 120, '099.264.169-18', 1, 2, '2017-04-15');
INSERT INTO `mydb`.`payment` (`id_payment`, `value`, `cod_user`, `status`, `cod_event`, `paymentdate`) VALUES (3, 120, '007.998.425-83', 1, 2, '2017-04-22');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`subscription`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`subscription` (`id_subscription`, `status`, `cod_payment`, `cod_user`, `cod_event`, `subscriptiondate`) VALUES (1, 1, 1, '007.998.425-83', 1, '2016-01-24');
INSERT INTO `mydb`.`subscription` (`id_subscription`, `status`, `cod_payment`, `cod_user`, `cod_event`, `subscriptiondate`) VALUES (2, 1, 2, '099.264.169-18', 2, '2017-04-13');
INSERT INTO `mydb`.`subscription` (`id_subscription`, `status`, `cod_payment`, `cod_user`, `cod_event`, `subscriptiondate`) VALUES (3, 0, NULL, '099.264.169-18', 1, '2016-01-12');
INSERT INTO `mydb`.`subscription` (`id_subscription`, `status`, `cod_payment`, `cod_user`, `cod_event`, `subscriptiondate`) VALUES (4, 1, 3, '007.998.425-83', 2, '2016-04-13');

COMMIT;

