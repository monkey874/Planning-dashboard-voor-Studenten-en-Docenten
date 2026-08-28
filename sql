SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `activiteit_groep`;
DROP TABLE IF EXISTS `activiteit_klas`;
DROP TABLE IF EXISTS `activiteiten`;
DROP TABLE IF EXISTS `groepen`;
DROP TABLE IF EXISTS `klassen`;
DROP TABLE IF EXISTS `opleidingen`;
DROP TABLE IF EXISTS `users`;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `opleidingen` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `naam`       VARCHAR(255) NOT NULL,
    `code`       VARCHAR(16)  NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `opleidingen_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `klassen` (
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `naam`         VARCHAR(255) NOT NULL,
    `opleiding_id` BIGINT UNSIGNED NOT NULL,
    `created_at`   TIMESTAMP NULL DEFAULT NULL,
    `updated_at`   TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `klassen_naam_unique` (`naam`),
    KEY `klassen_opleiding_id_index` (`opleiding_id`),
    CONSTRAINT `klassen_opleiding_id_foreign`
        FOREIGN KEY (`opleiding_id`) REFERENCES `opleidingen` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `groepen` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `naam`       VARCHAR(255) NOT NULL,
    `klas_id`    BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `groepen_klas_id_index` (`klas_id`),
    CONSTRAINT `groepen_klas_id_foreign`
        FOREIGN KEY (`klas_id`) REFERENCES `klassen` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
    `id`                BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `naam`              VARCHAR(255) NOT NULL,
    `email`             VARCHAR(255) NOT NULL,
    `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
    `password`          VARCHAR(255) NOT NULL,
    `rol`               ENUM('docent','superbeheerder') NOT NULL DEFAULT 'docent',
    `remember_token`    VARCHAR(100) NULL DEFAULT NULL,
    `created_at`        TIMESTAMP NULL DEFAULT NULL,
    `updated_at`        TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `activiteiten` (
    `id`              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `titel`           VARCHAR(255) NOT NULL,
    `omschrijving`    TEXT NULL DEFAULT NULL,
    `datum`           DATE NOT NULL,
    `starttijd`       TIME NOT NULL,
    `eindtijd`        TIME NOT NULL,
    `locatie`         VARCHAR(255) NOT NULL,
    `type`            ENUM('les','toets','activiteit','overig') NOT NULL DEFAULT 'les',
    `aangemaakt_door` BIGINT UNSIGNED NOT NULL,
    `created_at`      TIMESTAMP NULL DEFAULT NULL,
    `updated_at`      TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `activiteiten_datum_index` (`datum`),
    KEY `activiteiten_datum_starttijd_index` (`datum`, `starttijd`),
    KEY `activiteiten_aangemaakt_door_index` (`aangemaakt_door`),
    CONSTRAINT `activiteiten_aangemaakt_door_foreign`
        FOREIGN KEY (`aangemaakt_door`) REFERENCES `users` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `activiteit_klas` (
    `id`            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `activiteit_id` BIGINT UNSIGNED NOT NULL,
    `klas_id`       BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `activiteit_klas_unique` (`activiteit_id`, `klas_id`),
    KEY `activiteit_klas_klas_id_index` (`klas_id`),
    CONSTRAINT `activiteit_klas_activiteit_id_foreign`
        FOREIGN KEY (`activiteit_id`) REFERENCES `activiteiten` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `activiteit_klas_klas_id_foreign`
        FOREIGN KEY (`klas_id`) REFERENCES `klassen` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `activiteit_groep` (
    `id`            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `activiteit_id` BIGINT UNSIGNED NOT NULL,
    `groep_id`      BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `activiteit_groep_unique` (`activiteit_id`, `groep_id`),
    KEY `activiteit_groep_groep_id_index` (`groep_id`),
    CONSTRAINT `activiteit_groep_activiteit_id_foreign`
        FOREIGN KEY (`activiteit_id`) REFERENCES `activiteiten` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `activiteit_groep_groep_id_foreign`
        FOREIGN KEY (`groep_id`) REFERENCES `groepen` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `opleidingen` (`id`, `naam`, `code`, `created_at`, `updated_at`) VALUES
    (1, 'Software Developer',        'SD', NOW(), NOW()),
    (2, 'Media Developer',           'MD', NOW(), NOW());

INSERT INTO `klassen` (`id`, `naam`, `opleiding_id`, `created_at`, `updated_at`) VALUES
    (1, 'SD2A', 1, NOW(), NOW()),
    (2, 'SD2B', 1, NOW(), NOW()),
    (3, 'MD1A', 2, NOW(), NOW());

INSERT INTO `groepen` (`id`, `naam`, `klas_id`, `created_at`, `updated_at`) VALUES
    (1, 'Groep 1', 1, NOW(), NOW()),
    (2, 'Groep 2', 1, NOW(), NOW()),
    (3, 'Groep 1', 2, NOW(), NOW());

INSERT INTO `users` (`id`, `naam`, `email`, `password`, `rol`, `created_at`, `updated_at`) VALUES
    (1, 'Admin',       'admin@school.nl',  '$2y$12$e0MYzXyjpJS7Pd0RVvHwHeFq0jZQx8mI0wR5eXcH0lqB4l6h6h6h6', 'superbeheerder', NOW(), NOW()),
    (2, 'Docent Jansen','jansen@school.nl', '$2y$12$e0MYzXyjpJS7Pd0RVvHwHeFq0jZQx8mI0wR5eXcH0lqB4l6h6h6h6', 'docent',         NOW(), NOW());

INSERT INTO `activiteiten`
    (`id`, `titel`, `omschrijving`, `datum`, `starttijd`, `eindtijd`, `locatie`, `type`, `aangemaakt_door`, `created_at`, `updated_at`) VALUES
    (1, 'Programmeren',      'Backend les Laravel',        CURDATE(), '09:00:00', '10:30:00', 'A1.04', 'les',        2, NOW(), NOW()),
    (2, 'Toets Databases',   'SQL en normalisatie',        CURDATE(), '11:00:00', '12:00:00', 'B2.10', 'toets',      2, NOW(), NOW()),
    (3, 'Projectpresentatie','Sprint review',              CURDATE(), '13:30:00', '15:00:00', 'Aula',  'activiteit', 1, NOW(), NOW());

INSERT INTO `activiteit_klas` (`activiteit_id`, `klas_id`) VALUES
    (1, 1),
    (2, 1),
    (2, 2),
    (3, 1);

INSERT INTO `activiteit_groep` (`activiteit_id`, `groep_id`) VALUES
    (3, 1);
