CREATE TABLE IF NOT EXISTS `stg_comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `parent_comment_id` INT NULL,
  `key` VARCHAR(45) NOT NULL,
  `name` VARCHAR(80) NOT NULL,
  `text` TEXT(1024) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_key` (`key` ASC),
  INDEX `fk_stg_comment_stg_comment1_idx` (`parent_comment_id` ASC),
  CONSTRAINT `fk_stg_comment_stg_comment1`
    FOREIGN KEY (`parent_comment_id`)
    REFERENCES `stg_comment` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB