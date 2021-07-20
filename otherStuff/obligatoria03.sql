-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2021 a las 18:27:49
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `obligatoria03`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `cargo_id` bigint(20) UNSIGNED NOT NULL,
  `cargo_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`cargo_id`, `cargo_desc`) VALUES
(1, 'Admin'),
(2, 'Auxiliar'),
(3, 'Tecnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `actual` varchar(15) NOT NULL,
  `sistop_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_id` bigint(20) UNSIGNED NOT NULL,
  `creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`actual`, `sistop_id`, `tipo_id`, `creacion`) VALUES
('Activo', 1, 2, '1995-11-01'),
('Discontinuado', 2, 2, '1981-01-01'),
('Activo', 3, 2, '2000-04-15'),
('Activo', 4, 1, '1970-01-01'),
('Activo', 5, 1, '1991-03-01'),
('Discontinuado', 6, 3, '1988-10-01'),
('Activo', 39, 4, '2015-04-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `pers_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `dni` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`pers_id`, `nombre`, `apellido`, `dni`) VALUES
(5, 'Juana', 'Perez', 25333456),
(6, 'Ana', 'Gonzales', 34525789),
(7, 'Pablo', 'Perez', 15849674);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistop`
--

CREATE TABLE `sistop` (
  `sistop_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `version` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sistop`
--

INSERT INTO `sistop` (`sistop_id`, `nombre`, `version`) VALUES
(1, 'FreeBSD', '12.10'),
(2, 'Sun OS', '11.40'),
(3, 'Mac OS', '11.00'),
(4, 'GNU', '5.12'),
(5, 'Linux', '5.80'),
(6, 'IBM AIX', '7.20'),
(39, 'Windows', '10.02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `tipo_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`tipo_id`, `tipo_desc`) VALUES
(1, 'MINIX'),
(2, 'BSD'),
(3, 'AIX'),
(4, 'CP/M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabaja`
--

CREATE TABLE `trabaja` (
  `legajo` int(8) NOT NULL,
  `pers_id` bigint(20) UNSIGNED NOT NULL,
  `cargo_id` bigint(20) UNSIGNED NOT NULL,
  `fechaingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabaja`
--

INSERT INTO `trabaja` (`legajo`, `pers_id`, `cargo_id`, `fechaingreso`) VALUES
(10001, 6, 2, '2010-10-01'),
(10002, 7, 2, '2008-05-15'),
(70001, 5, 1, '2010-03-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_psw` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_perfil` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `legajo` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`user_id`, `user_psw`, `user_perfil`, `legajo`) VALUES
(5, 'e686859d8a43300614ee7767fc287d6d227cb16cd1204f11150f8207302edeb7e15883561621a13a9c54e63a913528a8ec759eb00fb8cfd445e8cbc66b32edf4', 'A', 70001),
(6, '3bd0ec7e54237c798afb6ede6ebc0feaadce5ab191d7d2f6310ad92072f332251aa7e66af79ee9e8f77e62ef2df0dde0e8872ca92e2d4a57adc334c6f8f830b9', 'E', 10001),
(7, 'ab4a301aa40357605ddce7b47ed7bcba32206defa7e8a6638528cecf7c4f2a8991fc51fa459e2d328c54af0051161557f280d9e8175606ee7b53da9a53de6866', 'E', 10002);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`cargo_id`),
  ADD UNIQUE KEY `cargo_id` (`cargo_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD KEY `idx_sistop` (`sistop_id`),
  ADD KEY `idx_tipo` (`tipo_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`pers_id`),
  ADD UNIQUE KEY `pers_id` (`pers_id`);

--
-- Indices de la tabla `sistop`
--
ALTER TABLE `sistop`
  ADD PRIMARY KEY (`sistop_id`),
  ADD UNIQUE KEY `pers_id` (`sistop_id`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`tipo_id`),
  ADD UNIQUE KEY `cargo_id` (`tipo_id`);

--
-- Indices de la tabla `trabaja`
--
ALTER TABLE `trabaja`
  ADD PRIMARY KEY (`legajo`),
  ADD KEY `pers_id` (`pers_id`),
  ADD KEY `cargo_id` (`cargo_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `legajo` (`legajo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sistop`
--
ALTER TABLE `sistop`
  MODIFY `sistop_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `tipo_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `fk_sistop` FOREIGN KEY (`sistop_id`) REFERENCES `sistop` (`sistop_id`),
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`tipo_id`);

--
-- Filtros para la tabla `trabaja`
--
ALTER TABLE `trabaja`
  ADD CONSTRAINT `trabaja_ibfk_1` FOREIGN KEY (`pers_id`) REFERENCES `personas` (`pers_id`),
  ADD CONSTRAINT `trabaja_ibfk_2` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`cargo_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`legajo`) REFERENCES `trabaja` (`legajo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
