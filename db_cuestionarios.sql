-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-08-2022 a las 18:56:00
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_cuestionarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionarios`
--

CREATE TABLE `cuestionarios` (
  `idCuestionario` int(11) NOT NULL,
  `codigo` varchar(25) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `fechaCreacion` date NOT NULL,
  `disponible` tinyint(4) NOT NULL,
  `autor` int(11) NOT NULL,
  `antecedentesPersonales` text DEFAULT NULL,
  `antecedentesFamiliares` text DEFAULT NULL,
  `motivoConsulta` text DEFAULT NULL,
  `revision` text DEFAULT NULL,
  `edad` tinyint(4) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `genero` tinyint(4) DEFAULT NULL,
  `trabajo` varchar(50) DEFAULT NULL,
  `hijos` tinyint(4) DEFAULT NULL,
  `imagenSeccion` varchar(150) DEFAULT NULL,
  `seccion` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuestionarios`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL,
  `pregunta` varchar(100) NOT NULL,
  `respuesta1` varchar(100) NOT NULL,
  `respuesta2` varchar(100) NOT NULL,
  `respuesta3` varchar(100) DEFAULT NULL,
  `respuesta4` varchar(100) DEFAULT NULL,
  `solucion` tinyint(4) NOT NULL,
  `detalles` text NOT NULL,
  `ayuda` text DEFAULT NULL,
  `definiciones` text DEFAULT NULL,
  `idCuestionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preguntas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntajes`
--

CREATE TABLE `puntajes` (
  `idPuntaje` int(11) NOT NULL,
  `codigo` varchar(125) NOT NULL,
  `nombre` varchar(125) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `puntajeCorrecto` int(11) NOT NULL,
  `puntajeIncorrecto` int(11) NOT NULL,
  `idCuestionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puntajes`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(55) NOT NULL,
  `contrasenia` varchar(45) NOT NULL,
  `autor` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `contrasenia`, `autor`) VALUES
(1, 'admin', 'admin2022', 'Administrador'),
(2, 'admin2', 'admin2022', 'Colaborador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuestionarios`
--
ALTER TABLE `cuestionarios`
  ADD PRIMARY KEY (`idCuestionario`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `usuario_cuestionario` (`autor`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `pregunta_cuestionario` (`idCuestionario`);

--
-- Indices de la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD PRIMARY KEY (`idPuntaje`),
  ADD KEY `puntaje_cuestionario` (`idCuestionario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuestionarios`
--
ALTER TABLE `cuestionarios`
  MODIFY `idCuestionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `puntajes`
--
ALTER TABLE `puntajes`
  MODIFY `idPuntaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuestionarios`
--
ALTER TABLE `cuestionarios`
  ADD CONSTRAINT `usuario_cuestionario` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `pregunta_cuestionario` FOREIGN KEY (`idCuestionario`) REFERENCES `cuestionarios` (`idCuestionario`);

--
-- Filtros para la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD CONSTRAINT `puntaje_cuestionario` FOREIGN KEY (`idCuestionario`) REFERENCES `cuestionarios` (`idCuestionario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
