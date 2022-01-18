DROP TABLE IF EXISTS `#__price_items`;

CREATE TABLE IF NOT EXISTS `#__price_items` (
	`id` INT NOT NULL AUTO_INCREMENT,

	`city` VARCHAR(255) NOT NULL COMMENT 'Город',
	`activity` VARCHAR(255) NOT NULL COMMENT 'Направление деятельности',
	`store` VARCHAR(255) NOT NULL COMMENT 'Площадка',
	`name` VARCHAR(255) NOT NULL COMMENT 'Название пункта приема',
	`price` FLOAT NOT NULL COMMENT 'Цена',
	`p_date` VARCHAR(255) NOT NULL COMMENT 'Дата, вносимая пользователем',

	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания',
	`updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата обновления',
	PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_general_ci COMMENT = 'Таблица цен в пунктах приема';