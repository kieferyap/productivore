CREATE TABLE `productivore_db`.`achievements` (
  `achievement_id` INT NOT NULL AUTO_INCREMENT,
  `achievement_name` VARCHAR(64) NULL DEFAULT NULL,
  `achievement_condition` VARCHAR(256) NULL,
  `achievement_rewards` INT NULL DEFAULT 550,
  `user_id` INT(11) NULL,
  `is_completed` INT(1) NULL DEFAULT false,
  `completed_on` DATETIME NULL DEFAULT NULL,
  `inserted_on` DATETIME NULL,
  PRIMARY KEY (`achievement_id`),
  INDEX `achievements_user_id_idx` (`user_id` ASC),
  CONSTRAINT `achievements_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `productivore_db`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

ALTER TABLE `productivore_db`.`setting_fields` 
ADD COLUMN `appling_id` INT(11) NULL AFTER `setting_field_name`,
ADD INDEX `setting_fields_appling_id_fk_idx` (`appling_id` ASC);
ALTER TABLE `productivore_db`.`setting_fields` 
ADD CONSTRAINT `setting_fields_appling_id_fk`
  FOREIGN KEY (`appling_id`)
  REFERENCES `productivore_db`.`applings` (`appling_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

/*
	Inserting a new settingmap? Insert into settings, too.
*/

BEGIN
	--New appling must be accessible to the users
	INSERT INTO user_appling_maps (user_id, appling_id)
	SELECT user_id, NEW.appling_id FROM users;
END

BEGIN
	--Insert a new setting_value_map?
	--New setting map must have values in settings
	INSERT INTO settings (user_appling_map_id, setting_field_setting_value_map_id, setting_field_id)
	SELECT user_appling_map_id, NEW.setting_field_setting_value_map_id, NEW.setting_field_id
	FROM user_applings
	WHERE appling_id = NEW.appling_id
	AND is_default = 1;
END