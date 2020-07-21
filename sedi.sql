-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200626114644',	'2020-07-01 10:18:43',	3363),
('DoctrineMigrations\\Version20200630141415',	'2020-07-01 10:18:46',	524),
('DoctrineMigrations\\Version20200701082120',	'2020-07-01 10:21:24',	814);

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `invite`;
CREATE TABLE `invite` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invite` (`id`) VALUES
(152),
(153),
(154),
(155),
(156),
(157),
(158),
(159);

DROP TABLE IF EXISTS `invite_user`;
CREATE TABLE `invite_user` (
  `invite_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`invite_id`,`user_id`),
  KEY `IDX_95A717C3EA417747` (`invite_id`),
  KEY `IDX_95A717C3A76ED395` (`user_id`),
  CONSTRAINT `FK_95A717C3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_95A717C3EA417747` FOREIGN KEY (`invite_id`) REFERENCES `invite` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invite_user` (`invite_id`, `user_id`) VALUES
(153,	2),
(153,	3),
(155,	2),
(155,	3),
(157,	2),
(157,	3),
(159,	2),
(159,	3);

DROP TABLE IF EXISTS `projet`;
CREATE TABLE `projet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `projet` (`id`, `name`) VALUES
(1,	'Gare de Berlin'),
(39,	'Gare de Marseille'),
(40,	'Gare de Boulogne'),
(41,	'Gare de Aix'),
(42,	'Quel materiel pour les rails'),
(43,	'Combien de personnes souhaitez vous pour l\'audit de sécurité?');

DROP TABLE IF EXISTS `repondant`;
CREATE TABLE `repondant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_who_rep_id` int NOT NULL,
  `date_crea` datetime NOT NULL,
  `sondage_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C2D8C7E58E92D0C7` (`user_who_rep_id`),
  KEY `sondage_id` (`sondage_id`),
  CONSTRAINT `FK_C2D8C7E58E92D0C7` FOREIGN KEY (`user_who_rep_id`) REFERENCES `user` (`id`),
  CONSTRAINT `repondant_ibfk_1` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `repondant` (`id`, `user_who_rep_id`, `date_crea`, `sondage_id`) VALUES
(12,	2,	'2020-07-19 00:00:00',	25),
(13,	3,	'2020-07-19 00:00:00',	25),
(14,	3,	'2020-07-19 00:00:00',	26),
(15,	2,	'2020-07-19 00:00:00',	26);

DROP TABLE IF EXISTS `repondant_reponse`;
CREATE TABLE `repondant_reponse` (
  `repondant_id` int NOT NULL,
  `reponse_id` int NOT NULL,
  PRIMARY KEY (`repondant_id`,`reponse_id`),
  KEY `IDX_84CC9043C5DBCCD6` (`repondant_id`),
  KEY `IDX_84CC9043CF18BB82` (`reponse_id`),
  CONSTRAINT `FK_84CC9043C5DBCCD6` FOREIGN KEY (`repondant_id`) REFERENCES `repondant` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_84CC9043CF18BB82` FOREIGN KEY (`reponse_id`) REFERENCES `reponse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `repondant_reponse` (`repondant_id`, `reponse_id`) VALUES
(12,	54),
(12,	55),
(12,	56),
(13,	55),
(13,	57),
(14,	59),
(15,	60);

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE `reponse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sondage_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5FB6DEC7BAF4AE56` (`sondage_id`),
  CONSTRAINT `FK_5FB6DEC7BAF4AE56` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reponse` (`id`, `sondage_id`, `name`) VALUES
(54,	25,	'Bois'),
(55,	25,	'Verre'),
(56,	25,	'Acier'),
(57,	25,	'Pierre'),
(58,	26,	'A'),
(59,	26,	'B'),
(60,	26,	'C'),
(61,	26,	'D'),
(62,	27,	'bois'),
(63,	27,	'Verre'),
(64,	27,	'Fer'),
(65,	27,	'Acier'),
(66,	28,	'2'),
(67,	28,	'3'),
(68,	28,	'4'),
(69,	28,	'5');

DROP TABLE IF EXISTS `sondage`;
CREATE TABLE `sondage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `auteur_id` int DEFAULT NULL,
  `projet_id` int DEFAULT NULL,
  `invite_id` int NOT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date_crea` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `choix_mult` int DEFAULT NULL,
  `isConf` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7579C89F60BB6FE6` (`auteur_id`),
  KEY `IDX_7579C89FC18272` (`projet_id`),
  KEY `IDX_7579C89FEA417747` (`invite_id`),
  CONSTRAINT `FK_7579C89F60BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_7579C89FC18272` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`id`),
  CONSTRAINT `FK_7579C89FEA417747` FOREIGN KEY (`invite_id`) REFERENCES `invite` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sondage` (`id`, `auteur_id`, `projet_id`, `invite_id`, `titre`, `description`, `date_crea`, `date_fin`, `choix_mult`, `isConf`) VALUES
(25,	2,	1,	153,	'Quel Matériaux pour les murs extéireurs',	'Quel Matériaux pour les murs extéireurs',	'2020-07-19 00:00:00',	NULL,	1,	1),
(26,	3,	1,	155,	'Quelle couleur pour les murs',	' Descritpion ',	'2020-07-19 00:00:00',	'2020-07-14 00:00:00',	NULL,	1),
(27,	3,	1,	157,	'Quel materiel pour les rails',	' Descritpion ',	'2020-07-20 00:00:00',	'2020-08-27 00:00:00',	1,	1),
(28,	3,	1,	159,	'Combien de personnes souhaitez vous pour l\'audit de sécurité?',	' Descritpion ',	'2020-07-20 00:00:00',	'2020-07-31 00:00:00',	NULL,	1);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `name`, `password`) VALUES
(1,	'joe',	'226c72af6fd3dc3ba3c50d56b43dc79cc93482c57a1359089cd6cbf5a3e5095d0bb435609df2290bf126295dab0d8e1fb45409a348bb223eab5f29622f012b95'),
(2,	'bob',	'0416a26ba554334286b1954918ecad7ba6c33575b49df915ff3367b5cef7ecd93b1f0b436636667b27b363011543971f1c81c3151d5ef72733501c1ff33c34af'),
(3,	'téo',	'1e7c07f722fbe2fa38ff9f4f23522ca142e8e38ea1e4e8693818213ed744cdb8ee689f7b593bc35b9368f051a2a24ca4dd4684fbd9b41efd5cfaf23ac0f3f24c');

DROP TABLE IF EXISTS `user_projet`;
CREATE TABLE `user_projet` (
  `user_id` int NOT NULL,
  `projet_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`projet_id`),
  KEY `IDX_35478794A76ED395` (`user_id`),
  KEY `IDX_35478794C18272` (`projet_id`),
  CONSTRAINT `FK_35478794A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_35478794C18272` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_projet` (`user_id`, `projet_id`) VALUES
(2,	1),
(2,	39),
(2,	40),
(2,	41),
(3,	1),
(3,	39),
(3,	40),
(3,	41);

-- 2020-07-21 07:17:10
