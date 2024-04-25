SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `tasks_users_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (1, 'Go to cinema', 1, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (2, 'Buy shoes', 0, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (3, 'Go to shopping', 0, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (4, 'Pay the credit card ;-)', 1, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (5, 'Do math homework...', 0, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (6, 'Just Testing...', 1, 1);


-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL UNIQUE,
  `password` varchar(128),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Juan', 'juanmartin@mail.com', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('James', 'jbond@yahoo.net', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Lionel', 'mess10@gmail.gol', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Carlos', 'bianchini@hotmail.com.ar', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Diego', 'diego1010@gmail.com', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('One User', 'one@user.com', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Diegol', 'diego@gol.com.ar', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Test User', 'test@user.com', '$2y$10$S9.JvxDbDhESUZvZWmpyleWB4YTHEaCJ5nevlXMHNso8J4X4/Sgeq');

-- ----------------------------
-- Table structure for notes
-- ----------------------------
DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of notes
-- ----------------------------
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('1', 'My Note 1', 'My first online note');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('2', 'Chinese Proverb', 'Those who say it can not be done, should not interrupt those doing it.');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('3', 'Long Note 3', 'This is a very large note, or maybe not...');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('4', 'Napoleon Hill', 'Whatever the mind of man can conceive and believe, it can achieve.');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('5', 'Note 5', 'A Random Note');

INSERT INTO `notes`
    (`name`, `description`)
VALUES
    ('Brian Tracy', 'Develop an attitude of gratitude, and give thanks for everything that happens to you, knowing that every step forward is a step toward achieving something bigger and better than your current situation.'),
    ('Zig Ziglar', 'Your attitude, not your aptitude, will determine your altitude.'),
    ('William James', 'The greatest discovery of my generation is that a human being can alter his life by altering his attitudes.'),
    ('Og Mandino', 'Take the attitude of a student, never be too big to ask questions, never know too much to learn something new.'),
    ('Earl Nightingale', 'Our attitude towards others determines their attitude towards us.'),
    ('Norman Vincent Peale', 'Watch your manner of speech if you wish to develop a peaceful state of mind. Start each day by affirming peaceful, contented and happy attitudes and your days will tend to be pleasant and successful.'),
    ('W. Clement Stone', 'There is little difference in people, but that little difference makes a big difference. The little difference is attitude. The big difference is whether it is positive or negative.'),
    ('Dale Carnegie', 'Happiness does not depend on any external conditions, it is governed by our mental attitude.'),
    ('Walt Disney', 'If you can dream it, you can do it.'),
    ('William Shakespeare', 'Our doubts are traitors and make us lose the good we oft might win by fearing to attempt.'),
    ('Albert Einstein', 'A person who never made a mistake never tried anything new.');



-- ----------------------------
-- Table structure for empresas
-- ----------------------------
DROP TABLE IF EXISTS `empresas`;
CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- ----------------------------
-- Records of empresas
-- ----------------------------
INSERT INTO `empresas` (`id`, `name`,`rut`, `description`) VALUES ('1', 'Talents Sport', '11.222.333-4','Talentos deportivos Castro');
INSERT INTO `empresas` (`id`, `name`,`rut`, `description`) VALUES ('2', 'Academia de Pruebas', '11.222.333-4', 'Aqui puedes describir el estilo y disciplina de tu academia de talentos');


-- ----------------------------
-- Table structure for jugadores
-- ----------------------------
DROP TABLE IF EXISTS `jugadores`;
CREATE TABLE `jugadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `fecha_nac` varchar(50) NOT NULL,
  `peso_kg` int(11) NOT NULL,
  `altura_cm` int(11) NOT NULL,
  `velocidad_kmh` int(11) NOT NULL,
  `resistencia` int(11) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  CONSTRAINT `jugadores_empresas_fk` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jugadores_categorias_fk` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- ----------------------------
-- Records of jugadores
-- ----------------------------
INSERT INTO `jugadores` (`id`, `name`,`rut`,`fecha_nac`,`peso_kg`,`altura_cm`,`velocidad_kmh`,`resistencia`, `description`) VALUES ('1', 'Matias Vera', '21.222.333-4','01-01-09','58','160','33','100','El Controlador');


-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  CONSTRAINT `categorias_empresas_fk` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` (`id`,`id_empresa`, `name`, `description`) VALUES ('1', '1', 'Juniors', 'Chichichos de hasta 12 años');

-- ----------------------------
-- Table structure for campeonatos
-- ----------------------------
DROP TABLE IF EXISTS `campeonatos`;
CREATE TABLE `campeonatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fecha_inicio` varchar(12) NOT NULL,
  `fecha_fin` varchar(12) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  CONSTRAINT `campeonatos_categorias_fk` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- ----------------------------
-- Records of campeonatos
-- ----------------------------
INSERT INTO `campeonatos` (`id`,`id_categoria`, `name`,`fecha_inicio`,`fecha_fin`, `description`) VALUES ('1', '1', 'Super Copa', '01-01-24', '01-02-24','Copa organizada por Academia Talets Sports');



-- ----------------------------
-- Table structure for partidos
-- ----------------------------
DROP TABLE IF EXISTS `partidos`;
CREATE TABLE `partidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_campeonato` int(11) NOT NULL,
  `rival` varchar(50) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `hora` varchar(50) NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  CONSTRAINT `partidos_campeonatos_fk` FOREIGN KEY (`id_campeonato`) REFERENCES `campeonatos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- ----------------------------
-- Records of partidos
-- ----------------------------
INSERT INTO `partidos` (`id`,`id_campeonato`,`rival`,`fecha`,`hora`,`lugar`, `description`) VALUES ('1', '1','Arcoiris FC', '01-01-24','12:20','Estadio Municipal','Octavos de final');



-- ----------------------------
-- Table structure for nominas
-- ----------------------------
DROP TABLE IF EXISTS `nominas`;
CREATE TABLE `nominas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_partido` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL,
  `numero` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `nominas_partidos_fk` FOREIGN KEY (`id_partido`) REFERENCES `partidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nominas_jugadores_fk` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- ----------------------------
-- Records of nominas
-- ----------------------------
INSERT INTO `nominas` (`id`, `id_partido`, `id_jugador`, `numero`) VALUES ('1', '1','1','11');


-- ----------------------------
-- Table structure for profesores
-- ----------------------------
DROP TABLE IF EXISTS `profesores`;
CREATE TABLE `profesores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  CONSTRAINT `profesores_empresas_fk` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- ----------------------------
-- Records of profesores
-- ----------------------------
INSERT INTO `profesores` (`id`, `id_empresa`, `name`,`rut`, `description`) VALUES ('1', '1', 'Hector', '22.333.444-5','Profe Standar');
INSERT INTO `profesores` (`id`, `id_empresa`, `name`,`rut`, `description`) VALUES ('2', '1', 'Diego', '33.444.555-6','Profe Arqueros');









SET FOREIGN_KEY_CHECKS = 1;
