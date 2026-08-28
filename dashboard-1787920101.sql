CREATE TABLE IF NOT EXISTS `opleidingen` (
	`id` int AUTO_INCREMENT NOT NULL,
	`naam` varchar(255) NOT NULL,
	`code` varchar(16) NOT NULL,
	`created_at` timestamp DEFAULT 'null',
	`updated_at` timestamp DEFAULT 'null',
	PRIMARY KEY (`id`),
	CONSTRAINT `uq_opleidingen_code` UNIQUE (code)
);
CREATE TABLE IF NOT EXISTS `groepen` (
	`id` int AUTO_INCREMENT NOT NULL,
	`naam` varchar(255) NOT NULL,
	`klas_id` int NOT NULL,
	`created_at` timestamp DEFAULT 'null',
	`updated_at` timestamp DEFAULT 'null',
	PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `users` (
	`id` int AUTO_INCREMENT NOT NULL,
	`naam` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`email_verified_at` timestamp DEFAULT 'null',
	`password` varchar(255) NOT NULL,
	`rol` varchar(255) NOT NULL DEFAULT 'docent',
	`remember_token` varchar(100) DEFAULT 'null',
	`created_at` timestamp DEFAULT 'null',
	`updated_at` timestamp DEFAULT 'null',
	PRIMARY KEY (`id`),
	CONSTRAINT `uq_users_email` UNIQUE (email)
);
CREATE TABLE IF NOT EXISTS `activiteiten` (
	`id` int AUTO_INCREMENT NOT NULL,
	`titel` varchar(255) NOT NULL,
	`omschrijving` text DEFAULT 'null',
	`datum` date NOT NULL,
	`starttijd` time NOT NULL,
	`eindtijd` time NOT NULL,
	`locatie` varchar(255) NOT NULL,
	`type` text NOT NULL DEFAULT 'les',
	`aangemaakt_door` int NOT NULL,
	`created_at` timestamp DEFAULT 'null',
	`updated_at` timestamp DEFAULT 'null',
	PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `activiteit_groep` (
	`id` int AUTO_INCREMENT NOT NULL,
	`activiteit_id` int NOT NULL,
	`groep_id` int NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `uq_activiteit_groep_activiteit_id_groep_id` UNIQUE (activiteit_id, groep_id)
);
CREATE TABLE IF NOT EXISTS `opleiding_groep` (
	`id` int AUTO_INCREMENT NOT NULL,
	`opleiding_id` int NOT NULL,
	`groep_id` int NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `uq_activiteit_groep_activiteit_id_groep_id` UNIQUE (activiteit_id, groep_id)
);
ALTER TABLE `groepen` ADD CONSTRAINT `groepen_klas_id_foreign` FOREIGN KEY (klas_id) REFERENCES klassen (id);
ALTER TABLE `activiteiten` ADD CONSTRAINT `activiteiten_aangemaakt_door_foreign` FOREIGN KEY (aangemaakt_door) REFERENCES users (id);
ALTER TABLE `activiteit_groep` ADD CONSTRAINT `activiteit_groep_activiteit_id_foreign` FOREIGN KEY (activiteit_id) REFERENCES activiteiten (id);
ALTER TABLE `activiteit_groep` ADD CONSTRAINT `activiteit_groep_groep_id_foreign` FOREIGN KEY (groep_id) REFERENCES groepen (id);
ALTER TABLE `opleiding_groep` ADD CONSTRAINT `opleiding_groep_fk1` FOREIGN KEY (`opleiding_id`) REFERENCES `opleidingen`(`id`);
ALTER TABLE `opleiding_groep` ADD CONSTRAINT `activiteit_groep_activiteit_id_foreign` FOREIGN KEY (activiteit_id) REFERENCES activiteiten (id);
ALTER TABLE `opleiding_groep` ADD CONSTRAINT `activiteit_groep_groep_id_foreign` FOREIGN KEY (groep_id) REFERENCES groepen (id);
CREATE INDEX `groepen_klas_id_index` USING BTREE ON `groepen` (`klas_id`);
CREATE INDEX `activiteiten_datum_index` USING BTREE ON `activiteiten` (`datum`);
CREATE INDEX `activiteiten_datum_starttijd_index` USING BTREE ON `activiteiten` (`datum`, `starttijd`);
CREATE INDEX `activiteiten_aangemaakt_door_index` USING BTREE ON `activiteiten` (`aangemaakt_door`);
CREATE UNIQUE INDEX `uq_activiteit_groep_activiteit_id_groep_id` USING BTREE ON `activiteit_groep` (`activiteit_id`, `groep_id`);
CREATE INDEX `activiteit_groep_groep_id_index` USING BTREE ON `activiteit_groep` (`groep_id`);
CREATE UNIQUE INDEX `uq_activiteit_groep_activiteit_id_groep_id` USING BTREE ON `opleiding_groep` (`activiteit_id`, `groep_id`);
CREATE INDEX `activiteit_groep_groep_id_index` USING BTREE ON `opleiding_groep` (`groep_id`);