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
  `id` INT NOT NULL AUTO_INCREMENT,
  `cep` VARCHAR(8) NOT NULL,
  `logradouro` VARCHAR(80) NULL,
  `bairro` VARCHAR(60) NULL,
  `localidade` VARCHAR(60) NULL,
  `uf` VARCHAR(2) NULL,
  `complemento` VARCHAR(45) NULL,
  `numero` INT(4) NULL,
  `status` INT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `id` VARCHAR(14) NOT NULL,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(65) NULL,
  `email` VARCHAR(80) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `codaddress` INT NULL,
  `gender` VARCHAR(1) NULL,
  `phonenumber` VARCHAR(11) NOT NULL,
  `phonenumber2` VARCHAR(11) NULL,
  `usertype` VARCHAR(1) NOT NULL,
  `status` INT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_user_tb_address_idx` (`codaddress` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`event` (
  `id` INT NOT NULL AUTO_INCREMENT,
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
  `status` INT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_event_tb_address1_idx` (`cod_eventlocation` ASC),
  INDEX `fk_event_user1_idx` (`eventcreator` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`workshop`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`workshop` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `subscriberslitmit` INT(2) NOT NULL,
  `comments` TEXT(500) NULL,
  `codevent` INT NOT NULL,
  `status` INT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_workshop_event1_idx` (`codevent` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`subscription`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`subscription` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `coduser` VARCHAR(14) NOT NULL,
  `codevent` INT NOT NULL,
  `subscriptiondate` DATE NOT NULL,
  `subscriptionstatus` INT(1) NOT NULL,
  `status` INT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_participation_tb_event1_idx` (`codevent` ASC),
  INDEX `fk_subscription_user1_idx` (`coduser` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`payment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `value` INT(4) NOT NULL,
  `paymentdate` DATE NOT NULL,
  `subscriptionid` INT NOT NULL,
  `paymentstatus` INT(1) NOT NULL,
  `status` INT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_payment_subscription1_idx` (`subscriptionid` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`address`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`address` (`id`, `cep`, `logradouro`, `bairro`, `localidade`, `uf`, `complemento`, `numero`, `status`) VALUES (1, '71692060', 'Quadra 101 conjunto 12', 'Residencial Oeste (São Sebastião)', 'Brasília', 'DF', 'Lote', 10, 1);
INSERT INTO `mydb`.`address` (`id`, `cep`, `logradouro`, `bairro`, `localidade`, `uf`, `complemento`, `numero`, `status`) VALUES (2, '70200014', 'SES 801 conjunto B', 'Asa Sul', 'Brasília', 'DF', 'N/A', NULL, 1);
INSERT INTO `mydb`.`address` (`id`, `cep`, `logradouro`, `bairro`, `localidade`, `uf`, `complemento`, `numero`, `status`) VALUES (3, '70070350', 'SDC', 'Zona Cívico-Administrativa', 'Brasília', 'DF', 'Loja', 20, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`user`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`user` (`id`, `firstname`, `lastname`, `email`, `password`, `codaddress`, `gender`, `phonenumber`, `phonenumber2`, `usertype`, `status`) VALUES ('052.099.411-67', 'José', 'Lisboa', 'josemrlisboa@gmail.com', '123', 1, 'M', '61981161217', '6121038378', 'A', 1);
INSERT INTO `mydb`.`user` (`id`, `firstname`, `lastname`, `email`, `password`, `codaddress`, `gender`, `phonenumber`, `phonenumber2`, `usertype`, `status`) VALUES ('012.045.698-23', 'Fulano', 'de Tal', 'josemrl7@yahoo.com', '456', 1, 'M', '61995357363', NULL, 'H', 1);
INSERT INTO `mydb`.`user` (`id`, `firstname`, `lastname`, `email`, `password`, `codaddress`, `gender`, `phonenumber`, `phonenumber2`, `usertype`, `status`) VALUES ('007.998.425-83', 'Genésia', 'da Silva', 'g.dasilva@uol.com.br', '789', 2, 'F', '61999654723', NULL, 'G', 1);
INSERT INTO `mydb`.`user` (`id`, `firstname`, `lastname`, `email`, `password`, `codaddress`, `gender`, `phonenumber`, `phonenumber2`, `usertype`, `status`) VALUES ('099.264.169-18', 'Edvalda Ambrósio', 'de Souza', 'edv.ambrosio.alda@hotmail.com', '098', 2, 'F', '61998877678', NULL, 'G', 1);
INSERT INTO `mydb`.`user` (`id`, `firstname`, `lastname`, `email`, `password`, `codaddress`, `gender`, `phonenumber`, `phonenumber2`, `usertype`, `status`) VALUES ('183.009.523-49', 'João', 'de Barro', 'joao.de.barro@gmail.com', '666', 3, 'M', '61999857162', '6132232255', 'G', 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`event`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`event` (`id`, `name`, `theme`, `startdate`, `enddate`, `starttime`, `cod_eventlocation`, `registrationfee`, `subscriberslimit`, `comments`, `eventcreator`, `status`) VALUES (1, 'Semana Nacional de Ciências Sociais', 'Sociedade e Meio Ambiente no séc. XXI', '2017-03-22', '2017-03-28', NULL, 3, 50, 100, 'erje rwer werwfs ere', '012.045.698-23', 1);
INSERT INTO `mydb`.`event` (`id`, `name`, `theme`, `startdate`, `enddate`, `starttime`, `cod_eventlocation`, `registrationfee`, `subscriberslimit`, `comments`, `eventcreator`, `status`) VALUES (2, 'Coaching em Finanças', '20 propostas de como melhorar sua vida financeira', '2017-06-02', '2017-06-02', 8, 3, 120, 150, 'sdkfs lkjfs flksadjf', '012.045.698-23', 1);
INSERT INTO `mydb`.`event` (`id`, `name`, `theme`, `startdate`, `enddate`, `starttime`, `cod_eventlocation`, `registrationfee`, `subscriberslimit`, `comments`, `eventcreator`, `status`) VALUES (3, 'Palestra com Neil Young', 'Music Business aplicado à Gastronomia', '2016-11-07', '2016-11-08', 9, 2, 200, 50, 'sdfj dfhsdjfhaskj jkfsd', '012.045.698-23', 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`workshop`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`workshop` (`id`, `name`, `subscriberslitmit`, `comments`, `codevent`, `status`) VALUES (1, 'Ciranda liberal', 25, 'sdkjf sdlj lsdkjf ', 1, 1);
INSERT INTO `mydb`.`workshop` (`id`, `name`, `subscriberslitmit`, `comments`, `codevent`, `status`) VALUES (2, 'Debate com chá sobre a conjuntura geopolítica atual', 45, 'sdf sd fdsa ', 1, 1);
INSERT INTO `mydb`.`workshop` (`id`, `name`, `subscriberslitmit`, `comments`, `codevent`, `status`) VALUES (3, 'Palestra com Guilerme Nogayra sobre finanças', 120, 'sdk asfkasd lk ', 2, 1);
INSERT INTO `mydb`.`workshop` (`id`, `name`, `subscriberslitmit`, `comments`, `codevent`, `status`) VALUES (4, 'Palestra do prof. dr. Higão', 50, 'sdklf sdf aslk', 1, 1);
INSERT INTO `mydb`.`workshop` (`id`, `name`, `subscriberslitmit`, `comments`, `codevent`, `status`) VALUES (5, 'Palestra sobre money management com Caio Henrique', 120, 'sdlksnadljlk lksjdflks', 2, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`subscription`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`subscription` (`id`, `coduser`, `codevent`, `subscriptiondate`, `subscriptionstatus`, `status`) VALUES (1, '007.998.425-83', 1, '2016-01-24', 1, 1);
INSERT INTO `mydb`.`subscription` (`id`, `coduser`, `codevent`, `subscriptiondate`, `subscriptionstatus`, `status`) VALUES (2, '099.264.169-18', 2, '2017-04-13', 1, 1);
INSERT INTO `mydb`.`subscription` (`id`, `coduser`, `codevent`, `subscriptiondate`, `subscriptionstatus`, `status`) VALUES (3, '099.264.169-18', 1, '2016-01-12', 1, 0);
INSERT INTO `mydb`.`subscription` (`id`, `coduser`, `codevent`, `subscriptiondate`, `subscriptionstatus`, `status`) VALUES (4, '007.998.425-83', 2, '2016-04-13', 1, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`payment`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`payment` (`id`, `value`, `paymentdate`, `subscriptionid`, `paymentstatus`, `status`) VALUES (1, 50, '2016-01-25', 1, 1, 1);
INSERT INTO `mydb`.`payment` (`id`, `value`, `paymentdate`, `subscriptionid`, `paymentstatus`, `status`) VALUES (2, 120, '2017-04-15', 2, 0, 1);
INSERT INTO `mydb`.`payment` (`id`, `value`, `paymentdate`, `subscriptionid`, `paymentstatus`, `status`) VALUES (3, 120, '2017-04-22', 4, 1, 1);

COMMIT;

