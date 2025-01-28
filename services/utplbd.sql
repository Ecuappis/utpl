-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando datos para la tabla utplbd.area: ~4 rows (aproximadamente)
INSERT INTO `area` (`id`, `nombre`, `nemonico`, `estado`) VALUES
	(1, 'Por afinidad', 'POR_AFINIDAD', 1),
	(2, 'Por demografia', 'POR_DEMOGRAFIA', 1),
	(3, 'Por expectativa', 'POR_EXPECTATIVA', 1),
	(4, 'Por habilidad', 'POR_HABILIDAD', 1);

-- Volcando datos para la tabla utplbd.boton: ~4 rows (aproximadamente)
INSERT INTO `boton` (`id`, `icono`, `nombre`, `page`, `seccion`, `estado`) VALUES
	(1, 'resources/encuesta.png', 'Encuesta', 'encuesta/', 1, 1),
	(2, 'resources/analisis.png', 'Análisis', 'analisis/', 1, 1),
	(3, 'resources/historico.png', 'Histórico', 'historico/', 1, 1),
	(4, 'resources/informacion.png', 'Información', 'informacion/', 1, 0);

-- Volcando datos para la tabla utplbd.boton_rol: ~4 rows (aproximadamente)
INSERT INTO `boton_rol` (`id`, `boton`, `rol`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 3, 1),
	(4, 4, 1);

-- Volcando datos para la tabla utplbd.encuesta: ~0 rows (aproximadamente)

-- Volcando datos para la tabla utplbd.estado: ~2 rows (aproximadamente)
INSERT INTO `estado` (`id`, `valor`) VALUES
	(0, 'false'),
	(1, 'true');

-- Volcando datos para la tabla utplbd.opciones: ~129 rows (aproximadamente)
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
	(16, 'Otra', 6, 1),
	(17, '1', 14, 1),
	(18, '2', 14, 1),
	(19, '3', 14, 1),
	(20, '4', 14, 1),
	(21, '5', 14, 1),
	(22, 'Primero de Bachillerato', 5, 1),
	(23, 'Segun de Bachillerato', 5, 1),
	(25, 'Tercero de bachillerato\r\n', 5, 1),
	(26, 'Primaria\r\n', 7, 1),
	(27, 'Secundaria', 7, 1),
	(30, 'Bachillerato', 7, 1),
	(31, 'Universidad', 7, 1),
	(32, 'Postgrado', 7, 1),
	(33, 'Menos de $ 500,00', 8, 1),
	(34, '$ 501 - $1000', 8, 1),
	(37, '$1001 - $2000', 8, 1),
	(38, '$2001- $3000\r\n', 8, 1),
	(39, 'Más de $3000', 8, 1),
	(40, 'Me interesa trabajar con herramientas, máquinas y equipos.', 9, 1),
	(41, 'Disfruto arreglando o construyendo cosas físicas (por ejemplo, reparaciones en casa, proyectos de bricolaje).', 9, 1),
	(44, 'Me siento atraído/a por temas relacionados con mecánica y automóviles.', 9, 1),
	(45, 'Disfruto explorando y aprendiendo sobre seres vivos como animales, peces y plantas.', 9, 1),
	(46, 'Encuentro fascinante la ingeniería y cómo se utiliza para diseñar y construir soluciones prácticas a problemas cotidianos y globales.', 9, 1),
	(47, 'Me interesa investigar fenómenos físicos, biológicos y/o culturales para entender sus causas y efectos.', 9, 1),
	(50, 'Me gusta jugar ajedrez.', 9, 1),
	(51, 'Disfruto explorando temas relacionados con ciencia ficción y avances científicos futuristas.', 9, 1),
	(52, 'Encuentro fascinante los misterios sin resolver y me gusta buscar soluciones lógicas y científicas para resolverlos.', 9, 1),
	(53, 'Me gusta leer novelas de detectives y explorar el razonamiento detrás de los casos y las soluciones propuestas.', 9, 1),
	(54, 'Me interesa trabajar con materiales físicos (como pinturas, arcilla, telas) para crear productos artísticos.', 9, 1),
	(55, 'Disfruto explorando temas relacionados con arte y belleza visual en diferentes formas de expresión (dibujo, pintura, escultura).', 9, 1),
	(56, 'Disfruto de actividades artísticas como la música, el teatro o la literatura que involucran la creación de obras y expresiones creativas.', 9, 1),
	(57, 'Analizar datos para encontrar patrones y conclusiones.', 10, 1),
	(60, 'Aprender sobre nuevos descubrimientos científicos.', 10, 1),
	(61, 'Explorar nuevas tecnologías y sus impactos en la sociedad.', 10, 1),
	(63, 'Resolver problemas usando herramientas y software tecnológico.', 10, 1),
	(66, 'Diseñar y construir estructuras o dispositivos prácticos.', 10, 1),
	(67, 'Resolver problemas complejos de manera creativa.', 10, 1),
	(68, 'Crear obras artísticas como pinturas, dibujos o esculturas.', 10, 1),
	(69, 'Compartir y recibir retroalimentación sobre tu arte.', 10, 1),
	(70, 'Analizar datos y realizar interpretaciones estadísticas.', 10, 1),
	(71, 'Resolver problemas matemáticos y encontrar soluciones eficientes.', 10, 1),
	(72, 'Matemáticas', 11, 1),
	(73, 'Biología', 11, 1),
	(74, 'Física', 11, 1),
	(75, 'Química', 11, 1),
	(76, 'Tecnología', 11, 1),
	(77, 'Arte', 11, 1),
	(78, 'Investigador/a científico/a', 12, 1),
	(81, 'Desarrollador/a de software', 12, 1),
	(82, 'Ingeniero/a civil', 12, 1),
	(83, 'Artista digital', 12, 1),
	(84, 'Matemático/a o estadístico/a', 12, 1),
	(85, 'Otro', 12, 1),
	(86, 'Familia', 13, 1),
	(87, 'Maestros', 13, 1),
	(88, 'Amigos', 13, 1),
	(89, 'Redes sociales', 13, 1),
	(92, 'Nadie en particular', 13, 1),
	(93, 'Muy positivo', 15, 1),
	(94, 'Positivo', 15, 1),
	(95, 'Neutro', 15, 1),
	(96, 'Negativo', 15, 1),
	(97, 'Muy negativo', 15, 1),
	(98, '1', 16, 1),
	(99, '2', 16, 1),
	(100, '3', 16, 1),
	(101, '4', 16, 1),
	(102, '5', 16, 1),
	(103, 'Falta de recursos educativos', 17, 1),
	(104, 'Falta de apoyo familiar', 17, 1),
	(105, 'Dificultad en las materias', 17, 1),
	(106, 'Falta de motivación', 17, 1),
	(107, 'Otra', 17, 1),
	(108, 'Salud', 18, 1),
	(109, 'Tecnología', 18, 1),
	(110, 'Medio ambiente', 18, 1),
	(111, 'Arte', 18, 1),
	(112, 'Educación (T/S/A)', 18, 1),
	(113, '1', 19, 1),
	(114, '2', 19, 1),
	(115, '3', 19, 1),
	(116, '4', 19, 1),
	(117, '5', 19, 1),
	(118, '1', 20, 1),
	(119, '2', 20, 1),
	(120, '3', 20, 1),
	(121, '4', 20, 1),
	(122, '5', 20, 1),
	(123, 'Mejorar la calidad de vida de las personas', 21, 1),
	(125, 'Innovar y crear nuevas tecnologías', 21, 1),
	(126, 'Contribuir a la sostenibilidad', 21, 1),
	(127, 'Desarrollar nuevas ideas artísticas', 21, 1),
	(130, 'No estoy seguro(a)', 21, 1),
	(131, '1', 22, 1),
	(132, '2', 22, 1),
	(133, '3', 22, 1),
	(134, '4', 22, 1),
	(135, '5', 22, 1),
	(136, 'Salud', 23, 1),
	(138, 'Energía', 23, 1),
	(139, 'Educación', 23, 1),
	(140, 'Transporte', 23, 1),
	(141, 'Medio Ambiente', 23, 1),
	(143, '1', 24, 1),
	(144, '2', 24, 1),
	(145, '3', 24, 1),
	(146, '4', 24, 1),
	(147, '5', 24, 1),
	(150, 'Muy informado/a', 25, 1),
	(151, 'Informado/a', 25, 1),
	(152, 'Neutro/a', 25, 1),
	(153, 'Poco informado/a', 25, 1),
	(154, 'Nada Informado/a', 25, 1);

-- Volcando datos para la tabla utplbd.persona: ~1 rows (aproximadamente)
INSERT INTO `persona` (`id`, `username`, `nombres`, `apellido_paterno`, `apellido_materno`, `genero`, `ciudad`, `rol`, `usuario`) VALUES
	(1, 'TANYA CEDEÑO', 'TANYA LORENA', 'CEDEÑO', 'MEDINA', 'F', 'MACHALA', 1, 1);

-- Volcando datos para la tabla utplbd.preguntas: ~25 rows (aproximadamente)
INSERT INTO `preguntas` (`id`, `pregunta`, `nombre`, `tipo`, `area`, `estado`, `filtro`) VALUES
	(1, 'Edad', 'Edad', 1, 2, 1, 1),
	(2, 'Género', 'Género', 1, 2, 1, 1),
	(3, 'Institución educativa', 'Institución', 1, 2, 1, 1),
	(4, 'Área de residencia', 'Residencia', 1, 2, 1, 1),
	(5, '¿En qué año escolar estás actualmente?', 'Nivel', 1, 2, 1, 1),
	(6, '¿Qué idiomas hablas?', 'Idiomas', 2, 4, 1, 1),
	(7, '¿Cuál es el nivel educativo más alto que han alcanzado tus padres o tutores:', 'Educación Familiar', 1, 3, 1, 0),
	(8, '¿Cuál es el ingreso familiar mensual aproximado?', 'Ingresos', 1, 1, 1, 1),
	(9, '¿Cuáles de las siguientes actividades te interesan?', 'Interes', 2, 1, 1, 1),
	(10, '¿Cuáles de las siguientes actividades te gusta realizar?', 'Afinidad', 2, 1, 1, 1),
	(11, '¿Qué asignatura disfrutas más en el colegio?', 'Asignatura', 1, 1, 1, 1),
	(12, '¿Cuál de las siguientes carreras te parece más atractiva?', 'Carreras', 1, 3, 1, 0),
	(13, '¿Quién influye más en tu decisión sobre qué estudiar en el futuro?', 'Influencia', 1, 3, 1, 1),
	(14, '¿Tus maestros te han animado a explorar temas relacionados con la ciencia o la tecnología?', 'Maestro', 3, 4, 1, 0),
	(15, '¿Qué opinan tus amigos sobre el estudio de disciplinas relacionadas con la tecnología o la ciencia?', 'Amigos', 1, 3, 1, 0),
	(16, '¿Qué tanto apoyo recibes de tu familia para estudiar temas relacionados con las matemáticas o la ciencia?', 'Familia', 3, 3, 1, 0),
	(17, '¿Qué obstáculos sientes que podrías enfrentar al seguir una de estas carreras (Ciencia, Tecnología, Ingeniería, Arte y Matemáticas)?', 'Obstaculo', 2, 3, 1, 0),
	(18, '¿Qué sectores te interesan más para trabajar en el futuro?', 'Sectores', 1, 3, 1, 0),
	(19, '¿Qué tan optimista te sientes sobre tu futuro en una carrera que involucre tecnología o ciencia?', 'Optimismo', 3, 3, 1, 0),
	(20, '¿Crees que tu carrera te brindará estabilidad económica?', 'Estabilidad', 3, 3, 1, 0),
	(21, '¿Qué esperas lograr con tu carrera en términos de impacto social o tecnológico?', 'Impacto', 1, 3, 1, 0),
	(22, '¿Crees que las innovaciones tecnológicas están mejorando la calidad de vida de las personas?', 'Innovacion', 3, 1, 1, 0),
	(23, '¿Qué área consideras más importante para que avance tecnológicamente?', 'Avance', 1, 1, 1, 1),
	(24, '¿Cuál es la probabilidad de que selecciones una carrera relacionada con Ciencia, Tecnología, Ingeniería, Arte o Matemáticas (STEAM)?', 'Seleccion', 3, 1, 1, 0),
	(25, '¿Qué tan informado/a te sientes sobre las diferentes opciones de carrera dentro de las áreas de Ciencia, Tecnología, Ingeniería, Arte y Matemáticas (STEAM)?', 'Informado', 1, 4, 1, 0);

-- Volcando datos para la tabla utplbd.respuestas: ~0 rows (aproximadamente)

-- Volcando datos para la tabla utplbd.rol: ~1 rows (aproximadamente)
INSERT INTO `rol` (`id`, `nombre`, `jerarquia`) VALUES
	(1, 'ESTUDIANTE', 1);

-- Volcando datos para la tabla utplbd.seccion: ~2 rows (aproximadamente)
INSERT INTO `seccion` (`id`, `nombre`) VALUES
	(1, 'PANEL'),
	(2, 'INTERNO');

-- Volcando datos para la tabla utplbd.tipo: ~3 rows (aproximadamente)
INSERT INTO `tipo` (`id`, `nombre`) VALUES
	(1, 'OPCION SIMPLE'),
	(2, 'OPCION MULTIPLE'),
	(3, 'ESCALA');

-- Volcando datos para la tabla utplbd.usuarios: ~1 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `username`, `pass`, `estado`) VALUES
	(1, 'tanya', '$2y$10$F9v.NCZ7jr5BaSWUUuxihuDBOjTDuIVIogMOkIazsGsE8qasswLUe', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
