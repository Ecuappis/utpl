-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6938
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla utplbd.area
CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `nemonico` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK1_ESTADO_AREA` (`estado`),
  CONSTRAINT `FK1_ESTADO_AREA` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.area: ~4 rows (aproximadamente)
INSERT INTO `area` (`id`, `nombre`, `nemonico`, `estado`) VALUES
	(1, 'Por afinidad', 'POR_AFINIDAD', 1),
	(2, 'Por demografia', 'POR_DEMOGRAFIA', 1),
	(3, 'Por expectativa', 'POR_EXPECTATIVA', 1),
	(4, 'Por habilidad', 'POR_HABILIDAD', 1);

-- Volcando estructura para tabla utplbd.boton
CREATE TABLE IF NOT EXISTS `boton` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icono` varchar(50) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `page` varchar(50) NOT NULL,
  `seccion` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_SECCION` (`seccion`),
  KEY `FK2_ESTADO` (`estado`),
  CONSTRAINT `FK1_SECCION` FOREIGN KEY (`seccion`) REFERENCES `seccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_ESTADO` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.boton: ~4 rows (aproximadamente)
INSERT INTO `boton` (`id`, `icono`, `nombre`, `page`, `seccion`, `estado`) VALUES
	(1, 'resources/encuesta.png', 'Encuesta', 'encuesta/', 1, 1),
	(2, 'resources/analisis.png', 'Análisis', 'analisis/', 1, 1),
	(3, 'resources/historico.png', 'Histórico', 'historico/', 1, 1),
	(4, 'resources/informacion.png', 'Información', 'informacion/', 1, 0);

-- Volcando estructura para tabla utplbd.boton_rol
CREATE TABLE IF NOT EXISTS `boton_rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boton` int(11) NOT NULL,
  `rol` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_BOTON` (`boton`),
  KEY `FK2_ROL` (`rol`),
  CONSTRAINT `FK1_BOTON` FOREIGN KEY (`boton`) REFERENCES `boton` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_ROL` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.boton_rol: ~3 rows (aproximadamente)
INSERT INTO `boton_rol` (`id`, `boton`, `rol`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 3, 1),
	(4, 4, 1);

-- Volcando estructura para tabla utplbd.encuesta
CREATE TABLE IF NOT EXISTS `encuesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.encuesta: ~0 rows (aproximadamente)

-- Volcando estructura para tabla utplbd.estado
CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(11) NOT NULL,
  `valor` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.estado: ~2 rows (aproximadamente)
INSERT INTO `estado` (`id`, `valor`) VALUES
	(0, 'false'),
	(1, 'true');

-- Volcando estructura para tabla utplbd.opciones
CREATE TABLE IF NOT EXISTS `opciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) NOT NULL,
  `pregunta` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK2_ESTADO_OPCION` (`estado`),
  KEY `FK1_PREGUNTAR` (`pregunta`),
  CONSTRAINT `FK1_PREGUNTAR` FOREIGN KEY (`pregunta`) REFERENCES `preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_ESTADO_OPCION` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.opciones: ~21 rows (aproximadamente)
INSERT INTO `opciones` (`id`, `nombre`, `pregunta`, `estado`) VALUES
	(1, '15 años', 1, 1),
	(2, '16 años', 1, 1),
	(3, '17 años', 1, 1),
	(4, '18 años', 1, 1),
	(5, 'Otro:', 1, 1),
	(6, 'Masculino', 2, 1),
	(7, 'Femenino', 2, 1),
	(8, 'No definido', 2, 1),
	(9, 'Prefiero no decirlo', 2, 1),
	(10, 'Pública', 3, 1),
	(11, 'Privada', 3, 1),
	(12, 'Urbana', 4, 1),
	(13, 'Rural', 4, 1),
	(14, 'Español', 6, 1),
	(15, 'Ingles', 6, 1),
	(16, 'Otro', 6, 1),
	(17, '1', 14, 1),
	(18, '2', 14, 1),
	(19, '3', 14, 1),
	(20, '4', 14, 1),
	(21, '5', 14, 1);

-- Volcando estructura para tabla utplbd.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `genero` char(1) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `rol` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_ROL` (`rol`),
  KEY `FK2_USER` (`usuario`),
  CONSTRAINT `FK1_ROL` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_USER` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.persona: ~1 rows (aproximadamente)
INSERT INTO `persona` (`id`, `username`, `nombres`, `apellido_paterno`, `apellido_materno`, `genero`, `ciudad`, `rol`, `usuario`) VALUES
	(1, 'TANYA CEDEÑO', 'TANYA LORENA', 'CEDEÑO', 'MEDINA', 'F', 'MACHALA', 1, 1);

-- Volcando estructura para tabla utplbd.preguntas
CREATE TABLE IF NOT EXISTS `preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(300) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `tipo` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK1_TIPO` (`tipo`),
  KEY `FK2_ESTADO_PREGUNTA` (`estado`),
  KEY `FK3_SEGMENTO` (`area`) USING BTREE,
  CONSTRAINT `FK1_TIPO` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_ESTADO_PREGUNTA` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK3_SEGMENTO` FOREIGN KEY (`area`) REFERENCES `area` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.preguntas: ~25 rows (aproximadamente)
INSERT INTO `preguntas` (`id`, `pregunta`, `nombre`, `tipo`, `area`, `estado`) VALUES
	(1, 'Edad', 'Edad', 1, 2, 1),
	(2, 'Género', 'Género', 1, 2, 1),
	(3, 'Institución educativa', 'Institución', 1, 2, 1),
	(4, 'Área de residencia', 'Residencia', 1, 2, 1),
	(5, '¿En qué año escolar estás actualmente?', 'Nivel', 1, 1, 1),
	(6, '¿Qué idiomas hablas?', 'Idiomas', 2, 1, 1),
	(7, '¿Cuál es el nivel educativo más alto que han alcanzado tus padres o tutores:', 'Educación Familiar', 1, 1, 1),
	(8, '¿Cuál es el ingreso familiar mensual aproximado?', 'Ingresos', 1, 1, 1),
	(9, '¿Cuáles de las siguientes actividades te interesan?', 'Interes', 2, 1, 1),
	(10, '¿Cuáles de las siguientes actividades te gusta realizar?', 'Afinidad', 2, 1, 1),
	(11, '¿Qué asignatura disfrutas más en el colegio?', 'Asignatura', 1, 1, 1),
	(12, '¿Cuál de las siguientes carreras te parece más atractiva?', 'Carreras', 1, 1, 1),
	(13, '¿Quién influye más en tu decisión sobre qué estudiar en el futuro?', 'Influencia', 1, 1, 1),
	(14, '¿Tus maestros te han animado a explorar temas relacionados con la ciencia o la tecnología?', 'Maestro', 3, 1, 1),
	(15, '¿Qué opinan tus amigos sobre el estudio de disciplinas relacionadas con la tecnología o la ciencia?', 'Amigos', 1, 1, 1),
	(16, '¿Qué tanto apoyo recibes de tu familia para estudiar temas relacionados con las matemáticas o la ciencia?', 'Familia', 3, 1, 1),
	(17, '¿Qué obstáculos sientes que podrías enfrentar al seguir una de estas carreras (Ciencia, Tecnología, Ingeniería, Arte y Matemáticas)?', 'Obstaculo', 2, 1, 1),
	(18, '¿Qué sectores te interesan más para trabajar en el futuro?', 'Sectores', 1, 1, 1),
	(19, '¿Qué tan optimista te sientes sobre tu futuro en una carrera que involucre tecnología o ciencia?', 'Optimismo', 3, 1, 1),
	(20, '¿Crees que tu carrera te brindará estabilidad económica?', 'Estabilidad', 3, 3, 1),
	(21, '¿Qué esperas lograr con tu carrera en términos de impacto social o tecnológico?', 'Impacto', 1, 1, 1),
	(22, '¿Crees que las innovaciones tecnológicas están mejorando la calidad de vida de las personas?', 'Innovacion', 3, 1, 1),
	(23, '¿Qué área consideras más importante para que avance tecnológicamente?', 'Avance', 1, 1, 1),
	(24, '¿Cuál es la probabilidad de que selecciones una carrera relacionada con Ciencia, Tecnología, Ingeniería, Arte o Matemáticas (STEAM)?', 'Seleccion', 3, 1, 1),
	(25, '¿Qué tan informado/a te sientes sobre las diferentes opciones de carrera dentro de las áreas de Ciencia, Tecnología, Ingeniería, Arte y Matemáticas (STEAM)?', 'Informado', 1, 1, 1);

-- Volcando estructura para tabla utplbd.respuestas
CREATE TABLE IF NOT EXISTS `respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor` varchar(300) NOT NULL,
  `opcion` int(11) NOT NULL,
  `encuesta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK2_ENCUESTA` (`encuesta`),
  KEY `FK1_NOM_OPCION` (`opcion`) USING BTREE,
  CONSTRAINT `FK1_NOM_OPCION` FOREIGN KEY (`opcion`) REFERENCES `opciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK2_ENCUESTA` FOREIGN KEY (`encuesta`) REFERENCES `encuesta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.respuestas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla utplbd.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `jerarquia` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.rol: ~0 rows (aproximadamente)
INSERT INTO `rol` (`id`, `nombre`, `jerarquia`) VALUES
	(1, 'ESTUDIANTE', 1);

-- Volcando estructura para tabla utplbd.seccion
CREATE TABLE IF NOT EXISTS `seccion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.seccion: ~2 rows (aproximadamente)
INSERT INTO `seccion` (`id`, `nombre`) VALUES
	(1, 'PANEL'),
	(2, 'INTERNO');

-- Volcando estructura para tabla utplbd.tipo
CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.tipo: ~2 rows (aproximadamente)
INSERT INTO `tipo` (`id`, `nombre`) VALUES
	(1, 'OPCION SIMPLE'),
	(2, 'OPCION MULTIPLE'),
	(3, 'ESCALA');

-- Volcando estructura para tabla utplbd.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `FK1_ESTADO_USER` (`estado`),
  CONSTRAINT `FK1_ESTADO_USER` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla utplbd.usuarios: ~0 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `username`, `pass`, `estado`) VALUES
	(1, 'tanya', '$2y$10$F9v.NCZ7jr5BaSWUUuxihuDBOjTDuIVIogMOkIazsGsE8qasswLUe', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
