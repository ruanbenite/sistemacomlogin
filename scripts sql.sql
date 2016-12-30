CREATE TABLE `sistemacomlogin`.`usuarios` ( `usu_id` INT NOT NULL AUTO_INCREMENT , 
                                            `usu_nome` VARCHAR(80) NOT NULL , `usu_email` VARCHAR(80) NOT NULL , 
                                            `usu_senha` INT(32) NOT NULL , 
                                            `usu_ativo` CHAR(1) NOT NULL , 
                                            PRIMARY KEY (`usu_id`)) ENGINE = InnoDB;