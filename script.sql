-- MySQL Script generated by MySQL Workbench
-- qui 16 dez 2021 14:48:33
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
  `login` VARCHAR(10) NOT NULL,
  `senha` VARCHAR(32) NULL,
  `status` ENUM('ativo', 'inativo', 'bloqueado', 'cancelado') NOT NULL,
  PRIMARY KEY (`login`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Desconto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Desconto` (
  `id_desconto` INT NOT NULL,
  PRIMARY KEY (`id_desconto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Loja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Loja` (
  `cnpj` BIGINT NOT NULL,
  `nome` VARCHAR(20) NOT NULL,
  `Desconto_id_desconto` INT NULL,
  `usuario_login` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`cnpj`),
  INDEX `fk_Loja_Desconto1_idx` (`Desconto_id_desconto` ASC) VISIBLE,
  UNIQUE INDEX `cnpj_UNIQUE` (`cnpj` ASC) VISIBLE,
  INDEX `fk_Loja_usuario1_idx` (`usuario_login` ASC) VISIBLE,
  CONSTRAINT `fk_Loja_Desconto1`
    FOREIGN KEY (`Desconto_id_desconto`)
    REFERENCES `mydb`.`Desconto` (`id_desconto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Loja_usuario1`
    FOREIGN KEY (`usuario_login`)
    REFERENCES `mydb`.`usuario` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Comprador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Comprador` (
  `cpf` BIGINT NOT NULL,
  `primeiro nome` VARCHAR(20) NOT NULL,
  `sobrenome` VARCHAR(20) NOT NULL,
  `telefone[]` BIGINT NULL,
  `usuario_login` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`cpf`),
  INDEX `fk_Comprador_usuario1_idx` (`usuario_login` ASC) VISIBLE,
  CONSTRAINT `fk_Comprador_usuario1`
    FOREIGN KEY (`usuario_login`)
    REFERENCES `mydb`.`usuario` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Endereço`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Endereço` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(20) NOT NULL,
  `cep` INT NOT NULL,
  `rua` VARCHAR(20) NOT NULL,
  `bairro` VARCHAR(20) NOT NULL,
  `estado` VARCHAR(20) NOT NULL,
  `numero` INT NOT NULL,
  `complemento` VARCHAR(45) NULL,
  `Comprador_cpf` BIGINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Endereço_Comprador1_idx` (`Comprador_cpf` ASC) VISIBLE,
  CONSTRAINT `fk_Endereço_Comprador1`
    FOREIGN KEY (`Comprador_cpf`)
    REFERENCES `mydb`.`Comprador` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Compra` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATETIME NOT NULL,
  `Loja_cnpj` BIGINT NOT NULL,
  `Comprador_cpf` BIGINT NULL,
  `Endereço_id` INT NULL,
  `protocolo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Compra_Loja1_idx` (`Loja_cnpj` ASC) VISIBLE,
  INDEX `fk_Compra_Comprador1_idx` (`Comprador_cpf` ASC) VISIBLE,
  INDEX `fk_Compra_Endereço1_idx` (`Endereço_id` ASC) VISIBLE,
  CONSTRAINT `fk_Compra_Loja1`
    FOREIGN KEY (`Loja_cnpj`)
    REFERENCES `mydb`.`Loja` (`cnpj`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Compra_Comprador1`
    FOREIGN KEY (`Comprador_cpf`)
    REFERENCES `mydb`.`Comprador` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Compra_Endereço1`
    FOREIGN KEY (`Endereço_id`)
    REFERENCES `mydb`.`Endereço` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Formas de pagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Formas de pagamento` (
  `id` INT NOT NULL,
  `resposta` VARCHAR(45) NOT NULL,
  `parcelas` INT NOT NULL,
  `valor` REAL NOT NULL,
  `status` ENUM('aprovado', 'negado', 'esperando confirmação') NOT NULL,
  `Compra_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Formas de pagamento_Compra1_idx` (`Compra_id` ASC) VISIBLE,
  CONSTRAINT `fk_Formas de pagamento_Compra1`
    FOREIGN KEY (`Compra_id`)
    REFERENCES `mydb`.`Compra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Cartao de credito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Cartao de credito` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(45) NOT NULL,
  `titular` VARCHAR(45) NOT NULL,
  `cpf` BIGINT NOT NULL,
  `data` VARCHAR(45) NOT NULL,
  `data expiracao` VARCHAR(45) NOT NULL,
  `Formas de pagamento_id` INT NOT NULL,
  `data_cadastro` DATE NOT NULL,
  `Comprador_cpf` BIGINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Cartao de credito_Formas de pagamento1_idx` (`Formas de pagamento_id` ASC) VISIBLE,
  INDEX `fk_Cartao de credito_Comprador1_idx` (`Comprador_cpf` ASC) VISIBLE,
  CONSTRAINT `fk_Cartao de credito_Formas de pagamento1`
    FOREIGN KEY (`Formas de pagamento_id`)
    REFERENCES `mydb`.`Formas de pagamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cartao de credito_Comprador1`
    FOREIGN KEY (`Comprador_cpf`)
    REFERENCES `mydb`.`Comprador` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Pix`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Pix` (
  `qr code` POLYGON NOT NULL,
  `copia cola` VARCHAR(40) NOT NULL,
  `Formas de pagamento_id` INT NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Formas de pagamento_id`),
  CONSTRAINT `fk_Pix_Formas de pagamento1`
    FOREIGN KEY (`Formas de pagamento_id`)
    REFERENCES `mydb`.`Formas de pagamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Boleto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Boleto` (
  `numero` VARCHAR(45) NOT NULL,
  `Formas de pagamento_id` INT NOT NULL,
  PRIMARY KEY (`Formas de pagamento_id`),
  CONSTRAINT `fk_Boleto_Formas de pagamento1`
    FOREIGN KEY (`Formas de pagamento_id`)
    REFERENCES `mydb`.`Formas de pagamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Status` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Status_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Status_item` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(20) NOT NULL,
  `especificacao` TEXT NULL,
  `status` ENUM('venda', 'cadastro', 'cancelado') NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Catalago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Catalago` (
  `preco` REAL NOT NULL,
  `quantidade` INT NOT NULL,
  `detalhes` VARCHAR(45) NULL,
  `Produto_id` INT NOT NULL,
  `Loja_cnpj` BIGINT NOT NULL,
  PRIMARY KEY (`Produto_id`, `Loja_cnpj`),
  INDEX `fk_Catalago_Loja1_idx` (`Loja_cnpj` ASC) VISIBLE,
  CONSTRAINT `fk_Catalago_Produto1`
    FOREIGN KEY (`Produto_id`)
    REFERENCES `mydb`.`Produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Catalago_Loja1`
    FOREIGN KEY (`Loja_cnpj`)
    REFERENCES `mydb`.`Loja` (`cnpj`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Item` (
  `numero` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `valor` REAL NOT NULL,
  `Compra_id` INT NOT NULL,
  `Desconto_id_desconto` INT NULL,
  `Catalago_Produto_id` INT NOT NULL,
  `Catalago_Loja_cnpj` BIGINT NOT NULL,
  PRIMARY KEY (`numero`, `Catalago_Produto_id`, `Catalago_Loja_cnpj`),
  INDEX `fk_Item_Compra1_idx` (`Compra_id` ASC) VISIBLE,
  INDEX `fk_Item_Desconto1_idx` (`Desconto_id_desconto` ASC) VISIBLE,
  INDEX `fk_Item_Catalago1_idx` (`Catalago_Produto_id` ASC, `Catalago_Loja_cnpj` ASC) VISIBLE,
  CONSTRAINT `fk_Item_Compra1`
    FOREIGN KEY (`Compra_id`)
    REFERENCES `mydb`.`Compra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Item_Desconto1`
    FOREIGN KEY (`Desconto_id_desconto`)
    REFERENCES `mydb`.`Desconto` (`id_desconto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Item_Catalago1`
    FOREIGN KEY (`Catalago_Produto_id` , `Catalago_Loja_cnpj`)
    REFERENCES `mydb`.`Catalago` (`Produto_id` , `Loja_cnpj`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Promocao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Promocao` (
  `numero` INT NOT NULL,
  `tipo` ENUM('compra', 'item') NOT NULL,
  `porcentagem` FLOAT NOT NULL,
  `data inicio` DATETIME NOT NULL,
  `data fim` DATETIME NOT NULL,
  `Loja_cnpj` BIGINT NOT NULL,
  PRIMARY KEY (`numero`, `Loja_cnpj`),
  INDEX `fk_Promocao_Loja1_idx` (`Loja_cnpj` ASC) VISIBLE,
  CONSTRAINT `fk_Promocao_Loja1`
    FOREIGN KEY (`Loja_cnpj`)
    REFERENCES `mydb`.`Loja` (`cnpj`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Usuario_sistema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Usuario_sistema` (
  `login` VARCHAR(10) NOT NULL,
  `senha` VARCHAR(32) NULL,
  `nome` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`login`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Administrador` (
  `Usuario_sistema_login` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`Usuario_sistema_login`),
  CONSTRAINT `fk_Administrador_Usuario_sistema1`
    FOREIGN KEY (`Usuario_sistema_login`)
    REFERENCES `mydb`.`Usuario_sistema` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Operador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Operador` (
  `Usuario_sistema_login` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`Usuario_sistema_login`),
  CONSTRAINT `fk_Operador_Usuario_sistema1`
    FOREIGN KEY (`Usuario_sistema_login`)
    REFERENCES `mydb`.`Usuario_sistema` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`mantém`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`mantém` (
  `Usuario_sistema_login` VARCHAR(10) NOT NULL,
  `Categoria_id` INT NOT NULL,
  `data` DATETIME NOT NULL,
  `operacao` ENUM('inserir', 'remover', 'atualizar') NOT NULL,
  PRIMARY KEY (`Usuario_sistema_login`, `Categoria_id`),
  INDEX `fk_Usuario_sistema_has_Categoria_Categoria1_idx` (`Categoria_id` ASC) VISIBLE,
  INDEX `fk_Usuario_sistema_has_Categoria_Usuario_sistema1_idx` (`Usuario_sistema_login` ASC) VISIBLE,
  CONSTRAINT `fk_Usuario_sistema_has_Categoria_Usuario_sistema1`
    FOREIGN KEY (`Usuario_sistema_login`)
    REFERENCES `mydb`.`Usuario_sistema` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_sistema_has_Categoria_Categoria1`
    FOREIGN KEY (`Categoria_id`)
    REFERENCES `mydb`.`Categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`mantém`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`mantém` (
  `Usuario_sistema_login` VARCHAR(10) NOT NULL,
  `Categoria_id` INT NOT NULL,
  `data` DATETIME NOT NULL,
  `operacao` ENUM('inserir', 'remover', 'atualizar') NOT NULL,
  PRIMARY KEY (`Usuario_sistema_login`, `Categoria_id`),
  INDEX `fk_Usuario_sistema_has_Categoria_Categoria1_idx` (`Categoria_id` ASC) VISIBLE,
  INDEX `fk_Usuario_sistema_has_Categoria_Usuario_sistema1_idx` (`Usuario_sistema_login` ASC) VISIBLE,
  CONSTRAINT `fk_Usuario_sistema_has_Categoria_Usuario_sistema1`
    FOREIGN KEY (`Usuario_sistema_login`)
    REFERENCES `mydb`.`Usuario_sistema` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_sistema_has_Categoria_Categoria1`
    FOREIGN KEY (`Categoria_id`)
    REFERENCES `mydb`.`Categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`mantém`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`mantém` (
  `Usuario_sistema_login` VARCHAR(10) NOT NULL,
  `Categoria_id` INT NOT NULL,
  `data` DATETIME NOT NULL,
  `operacao` ENUM('inserir', 'remover', 'atualizar') NOT NULL,
  PRIMARY KEY (`Usuario_sistema_login`, `Categoria_id`),
  INDEX `fk_Usuario_sistema_has_Categoria_Categoria1_idx` (`Categoria_id` ASC) VISIBLE,
  INDEX `fk_Usuario_sistema_has_Categoria_Usuario_sistema1_idx` (`Usuario_sistema_login` ASC) VISIBLE,
  CONSTRAINT `fk_Usuario_sistema_has_Categoria_Usuario_sistema1`
    FOREIGN KEY (`Usuario_sistema_login`)
    REFERENCES `mydb`.`Usuario_sistema` (`login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_sistema_has_Categoria_Categoria1`
    FOREIGN KEY (`Categoria_id`)
    REFERENCES `mydb`.`Categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`areas de negocio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`areas de negocio` (
  `Loja_cnpj` BIGINT NOT NULL,
  `Categoria_id` INT NOT NULL,
  PRIMARY KEY (`Loja_cnpj`, `Categoria_id`),
  INDEX `fk_Loja_has_Categoria_Categoria1_idx` (`Categoria_id` ASC) VISIBLE,
  INDEX `fk_Loja_has_Categoria_Loja1_idx` (`Loja_cnpj` ASC) VISIBLE,
  CONSTRAINT `fk_Loja_has_Categoria_Loja1`
    FOREIGN KEY (`Loja_cnpj`)
    REFERENCES `mydb`.`Loja` (`cnpj`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Loja_has_Categoria_Categoria1`
    FOREIGN KEY (`Categoria_id`)
    REFERENCES `mydb`.`Categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`possui`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`possui` (
  `Categoria_id` INT NOT NULL,
  `Produto_id` INT NOT NULL,
  PRIMARY KEY (`Categoria_id`, `Produto_id`),
  INDEX `fk_Categoria_has_Produto_Produto1_idx` (`Produto_id` ASC) VISIBLE,
  INDEX `fk_Categoria_has_Produto_Categoria1_idx` (`Categoria_id` ASC) VISIBLE,
  CONSTRAINT `fk_Categoria_has_Produto_Categoria1`
    FOREIGN KEY (`Categoria_id`)
    REFERENCES `mydb`.`Categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Categoria_has_Produto_Produto1`
    FOREIGN KEY (`Produto_id`)
    REFERENCES `mydb`.`Produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`solicita cadastro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`solicita cadastro` (
  `data` DATE NOT NULL,
  `observacao` TEXT NULL,
  `status` ENUM('cadastro', 'em análise', 'aprovado', 'negado') NOT NULL,
  `Produto_id` INT NOT NULL,
  `Loja_cnpj` BIGINT NOT NULL,
  `Operador_Usuario_sistema_login` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`Produto_id`, `Loja_cnpj`),
  INDEX `fk_solicita cadastro_Loja1_idx` (`Loja_cnpj` ASC) VISIBLE,
  INDEX `fk_solicita cadastro_Operador1_idx` (`Operador_Usuario_sistema_login` ASC) VISIBLE,
  CONSTRAINT `fk_solicita cadastro_Produto1`
    FOREIGN KEY (`Produto_id`)
    REFERENCES `mydb`.`Produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicita cadastro_Loja1`
    FOREIGN KEY (`Loja_cnpj`)
    REFERENCES `mydb`.`Loja` (`cnpj`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicita cadastro_Operador1`
    FOREIGN KEY (`Operador_Usuario_sistema_login`)
    REFERENCES `mydb`.`Operador` (`Usuario_sistema_login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`status` (
  `Status_id` INT NOT NULL,
  `Compra_id` INT NOT NULL,
  `data` DATETIME NOT NULL,
  PRIMARY KEY (`Status_id`, `Compra_id`),
  INDEX `fk_Status_has_Compra_Compra1_idx` (`Compra_id` ASC) VISIBLE,
  INDEX `fk_Status_has_Compra_Status1_idx` (`Status_id` ASC) VISIBLE,
  CONSTRAINT `fk_Status_has_Compra_Status1`
    FOREIGN KEY (`Status_id`)
    REFERENCES `mydb`.`Status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Status_has_Compra_Compra1`
    FOREIGN KEY (`Compra_id`)
    REFERENCES `mydb`.`Compra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`status_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`status_item` (
  `Status_item_id` INT NOT NULL,
  `Item_numero` INT NOT NULL,
  `data` DATETIME NOT NULL,
  PRIMARY KEY (`Status_item_id`, `Item_numero`),
  INDEX `fk_Status_item_has_Item_Item1_idx` (`Item_numero` ASC) VISIBLE,
  INDEX `fk_Status_item_has_Item_Status_item1_idx` (`Status_item_id` ASC) VISIBLE,
  CONSTRAINT `fk_Status_item_has_Item_Status_item1`
    FOREIGN KEY (`Status_item_id`)
    REFERENCES `mydb`.`Status_item` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Status_item_has_Item_Item1`
    FOREIGN KEY (`Item_numero`)
    REFERENCES `mydb`.`Item` (`numero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`aplicado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`aplicado` (
  `Desconto_id_desconto` INT NOT NULL,
  `Promocao_numero` INT NOT NULL,
  `Promocao_Loja_cnpj` BIGINT NOT NULL,
  PRIMARY KEY (`Desconto_id_desconto`, `Promocao_numero`, `Promocao_Loja_cnpj`),
  INDEX `fk_Desconto_has_Promocao_Promocao1_idx` (`Promocao_numero` ASC, `Promocao_Loja_cnpj` ASC) VISIBLE,
  INDEX `fk_Desconto_has_Promocao_Desconto1_idx` (`Desconto_id_desconto` ASC) VISIBLE,
  CONSTRAINT `fk_Desconto_has_Promocao_Desconto1`
    FOREIGN KEY (`Desconto_id_desconto`)
    REFERENCES `mydb`.`Desconto` (`id_desconto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Desconto_has_Promocao_Promocao1`
    FOREIGN KEY (`Promocao_numero` , `Promocao_Loja_cnpj`)
    REFERENCES `mydb`.`Promocao` (`numero` , `Loja_cnpj`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
