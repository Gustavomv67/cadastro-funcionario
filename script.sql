create database funcionariobd;
use funcionariobd; 

CREATE TABLE `Funcionario` (
  `CodFuncionario` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(400) NOT NULL,
  `DataNascimento` DATETIME NOT NULL,
  `Salario` DECIMAL(18,2) NOT NULL,
  `Atividades` VARCHAR(15000) NOT NULL,
  PRIMARY KEY (`CodFuncionario`));
  
  CREATE TABLE `FuncionarioFilho` (
  `CodFuncionarioFilho` INT NOT NULL AUTO_INCREMENT,
  `CodFuncionario` INT NOT NULL,
  `Nome` VARCHAR(400) NOT NULL,
  `DataNascimento` DATETIME NOT NULL,
  PRIMARY KEY (`CodFuncionarioFilho`),
  INDEX `CodFuncionario_idx` (`CodFuncionario` ASC) VISIBLE,
  CONSTRAINT `CodFuncionario`
    FOREIGN KEY (`CodFuncionario`)
    REFERENCES `Funcionario` (`CodFuncionario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);