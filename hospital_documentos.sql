-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2026 a las 00:25:03
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital_documentos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administra_encuesta`
--

CREATE TABLE `administra_encuesta` (
  `IDencuesta` int(11) NOT NULL,
  `CI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carga`
--

CREATE TABLE `carga` (
  `Nombredocumento` varchar(255) NOT NULL,
  `CI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `Nombredocumento` varchar(30) NOT NULL,
  `Fecha` date NOT NULL,
  `TipoD` varchar(20) NOT NULL,
  `Categoria` varchar(20) NOT NULL,
  `Departamento` varchar(20) NOT NULL,
  `Rutapdf` varchar(255) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`Nombredocumento`, `Fecha`, `TipoD`, `Categoria`, `Departamento`, `Rutapdf`, `Email`) VALUES
('Estudio Radiológico', '2012-02-14', 'Pedido', 'Estudio', 'Radiología', 'uploads/43435216F11-21-16_Lic20Radiologa.pdf', 'radiologia@gmail.com'),
('Informe Radiológico', '2009-10-02', 'Informe ', 'Diagnóstico', 'Radiología', 'uploads/El_informe_radiologico_estructurado.pdf', 'radiologia@gmail.com'),
('Preparación Tomografía', '2010-05-05', 'Instructivo', 'Estudio', 'Imagenología', 'uploads/HTC 11.1-P1-IT14-ANEXO48 PREPARACIÓN PARA TAC (ESCÁNER) CON O SIN CONTRASTE.pdf', 'Imagenologia@gmail.com'),
('Protocolo Inyección', '2026-02-24', 'registro', 'Procedimiento', 'Imagenología', 'uploads/BD-50131 Principios de la Técnica de Inyección_MX_r.pdf', 'Imagenologia@gmail.com'),
('Uso de Contraste', '2026-10-12', 'Autorización', 'Procedimiento', 'Imagenología', 'uploads/382538504008.pdf', 'Imagenologia@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `IDencuesta` int(11) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE `funcionario` (
  `CI` int(11) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Cargo` varchar(20) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `funcionario`
--

INSERT INTO `funcionario` (`CI`, `Contraseña`, `Usuario`, `Cargo`, `Nombre`) VALUES
(38945612, '$2y$10$Pqah5fpDfu4vRMdewWKhV.xv0x7IbKlDZ/H4ntotLP3yhciRTo57O', 'TitaF', 'Medico', 'Tita Franco'),
(56789123, '$2y$10$Sven4jR9HCtpybc7mNyC/OPslC6r/RxgE.OnagcOjewgGa9FuZEFi', 'AvrilV', 'Administrador', 'Avril Vigo'),
(56977683, '$2y$10$CocZ9x3eWI2V9foE1MN5nu/boW5CN6jiWIUjuiKLe21av3sLsjxce', 'SarielP', 'Administrador', 'Sariel Pereyra'),
(389445612, '$2y$10$FC6.crjSLXmiJxOdbt6BD.53WgaO1Fo7maXO6UB1R9w3SPjTzGyze', 'YasA', 'Medico', 'Yasmin Acosta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incluye`
--

CREATE TABLE `incluye` (
  `IDrespuesta` int(11) NOT NULL,
  `IDencuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `IDpregunta` int(11) NOT NULL,
  `Temas` varchar(20) NOT NULL,
  `Orden` int(11) NOT NULL,
  `Textopregunta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`IDpregunta`, `Temas`, `Orden`, `Textopregunta`) VALUES
(15, 'Satisfacción', 1, '¿Qué tan satisfecho/a estás con la atención médica y profesional recibida en general?'),
(16, 'Satisfacción', 2, '¿Cómo evaluarías el trato humano, la empatía y el respeto brindado por el personal?'),
(17, 'Satisfacción', 3, '¿Qué tan clara y comprensible fue la información recibida sobre tu estado de salud y/o tratamiento?'),
(18, 'Tiempos', 1, '¿Cómo valorarías la agilidad y el tiempo de espera desde tu llegada hasta ser atendido/a?'),
(19, 'Tiempos', 2, '¿Qué tan organizado y eficiente consideras que fue el proceso de recepción y gestión de turnos/trámites?'),
(20, 'Instalaciones', 1, '¿Cómo calificarías la limpieza e higiene de las salas de espera, baños y consultorios/habitaciones?'),
(21, 'Instalaciones', 2, '¿Qué tan cómodas y adecuadas consideras las instalaciones físicas del hospital?'),
(22, 'Instalaciones', 3, '¿Cómo valorarías la señalización e indicaciones dentro del edificio para orientarte e ir de un sector a otro?'),
(23, 'Instalaciones', 4, '¿Qué tan seguro/a y protegido/a te sentiste en términos de privacidad y resguardo de tus datos e intimidad?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `IDrespuesta` int(11) NOT NULL,
  `IDpregunta` int(11) NOT NULL,
  `Valoracion` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiene`
--

CREATE TABLE `tiene` (
  `IDrespuesta` int(11) NOT NULL,
  `IDpregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administra_encuesta`
--
ALTER TABLE `administra_encuesta`
  ADD PRIMARY KEY (`IDencuesta`),
  ADD KEY `CI` (`CI`);

--
-- Indices de la tabla `carga`
--
ALTER TABLE `carga`
  ADD PRIMARY KEY (`Nombredocumento`),
  ADD KEY `CI` (`CI`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`Nombredocumento`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`IDencuesta`);

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`CI`);

--
-- Indices de la tabla `incluye`
--
ALTER TABLE `incluye`
  ADD PRIMARY KEY (`IDrespuesta`),
  ADD KEY `IDencuesta` (`IDencuesta`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`IDpregunta`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`IDrespuesta`),
  ADD KEY `IDpregunta` (`IDpregunta`);

--
-- Indices de la tabla `tiene`
--
ALTER TABLE `tiene`
  ADD PRIMARY KEY (`IDrespuesta`),
  ADD KEY `IDpregunta` (`IDpregunta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `IDencuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `IDpregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `IDrespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administra_encuesta`
--
ALTER TABLE `administra_encuesta`
  ADD CONSTRAINT `administra_encuesta_ibfk_1` FOREIGN KEY (`IDencuesta`) REFERENCES `encuestas` (`IDencuesta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `administra_encuesta_ibfk_2` FOREIGN KEY (`CI`) REFERENCES `funcionario` (`CI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carga`
--
ALTER TABLE `carga`
  ADD CONSTRAINT `carga_ibfk_1` FOREIGN KEY (`Nombredocumento`) REFERENCES `documentos` (`Nombredocumento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carga_ibfk_2` FOREIGN KEY (`CI`) REFERENCES `funcionario` (`CI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `incluye`
--
ALTER TABLE `incluye`
  ADD CONSTRAINT `incluye_ibfk_1` FOREIGN KEY (`IDrespuesta`) REFERENCES `respuesta` (`IDrespuesta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incluye_ibfk_2` FOREIGN KEY (`IDencuesta`) REFERENCES `encuestas` (`IDencuesta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`IDpregunta`) REFERENCES `preguntas` (`IDpregunta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tiene`
--
ALTER TABLE `tiene`
  ADD CONSTRAINT `tiene_ibfk_1` FOREIGN KEY (`IDrespuesta`) REFERENCES `respuesta` (`IDrespuesta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiene_ibfk_2` FOREIGN KEY (`IDpregunta`) REFERENCES `preguntas` (`IDpregunta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
