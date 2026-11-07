-- ============================================================
-- Base de datos del proyecto ELECCIONES (Personero y Contralor)
-- I.E. San Juan Bosco
-- Para importar en phpMyAdmin (pestaña "SQL" o "Importar")
-- ============================================================

CREATE DATABASE IF NOT EXISTS `usuarios`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `usuarios`;

-- ------------------------------------------------------------
-- Tabla: usuarios (estudiantes que pueden votar)
-- Usada en: login.php, register.php, codigos.php
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Tabla: candidatos (candidatos a PERSONERO)
-- Usada en: pantalla_votacion.php, votos.php
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `candidatos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `imagen` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Tabla: candidatosb (candidatos a CONTRALOR)
-- Usada en: pantalla_votacion.php, votos.php
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `candidatosb` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `imagen` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Tabla: votos (un voto por usuario)
-- Usada en: votar.php, votos.php
-- La clave UNIQUE en `usuario` impide que alguien vote dos veces.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `votos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(50) NOT NULL,
  `voto_personero` INT(11) NOT NULL,
  `voto_contralor` INT(11) NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_usuario_voto` (`usuario`),
  KEY `idx_voto_personero` (`voto_personero`),
  KEY `idx_voto_contralor` (`voto_contralor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Datos de ejemplo: candidatos
-- (las imágenes están en la carpeta /imagenes del proyecto)
-- Cambia los nombres por los de tus candidatos reales.
-- ------------------------------------------------------------
INSERT INTO `candidatos` (`nombre`, `imagen`) VALUES
  ('Candidato Personero 1', 'imagenes/p1.jpg'),
  ('Candidato Personero 2', 'imagenes/p2.jpeg'),
  ('Candidato Personero 3', 'imagenes/p3.jpeg');

INSERT INTO `candidatosb` (`nombre`, `imagen`) VALUES
  ('Candidato Contralor 1', 'imagenes/c1.jpg'),
  ('Candidato Contralor 2', 'imagenes/c2.jpeg');

-- ------------------------------------------------------------
-- Usuario de prueba (usuario: prueba / contraseña: prueba)
-- Puedes borrarlo; los reales se generan con codigos.php
-- ------------------------------------------------------------
INSERT INTO `usuarios` (`username`, `password`) VALUES
  ('prueba', 'prueba');
