-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 13:11:56
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
-- Base de datos: `pibd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `IdAnuncio` int(11) NOT NULL,
  `TAnuncio` tinyint(4) DEFAULT NULL,
  `TVivienda` tinyint(4) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Alternativo` varchar(255) DEFAULT NULL,
  `Titulo` varchar(255) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Texto` text DEFAULT NULL,
  `Ciudad` varchar(100) DEFAULT NULL,
  `Pais` int(11) DEFAULT NULL,
  `Superficie` decimal(10,2) DEFAULT NULL,
  `Nhabitaciones` int(11) DEFAULT NULL,
  `Nbanyos` int(11) DEFAULT NULL,
  `Planta` int(11) DEFAULT NULL,
  `Anyo` year(4) DEFAULT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `Usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE `estilos` (
  `IdEstilo` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Fichero` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `IdFoto` int(11) NOT NULL,
  `Titulo` varchar(100) DEFAULT NULL,
  `Fichero` varchar(255) DEFAULT NULL,
  `Alternativo` varchar(255) DEFAULT NULL,
  `Anuncio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `IdMensaje` int(11) NOT NULL,
  `TMensaje` tinyint(4) DEFAULT NULL,
  `Texto` text DEFAULT NULL,
  `Anuncio` int(11) DEFAULT NULL,
  `UsuarioOrigen` int(11) DEFAULT NULL,
  `UsuarioDestino` int(11) DEFAULT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `IdPais` int(11) NOT NULL,
  `NomPais` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`IdPais`, `NomPais`) VALUES
(1, 'España'),
(2, 'Alemania'),
(3, 'Francia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `IdSolicitud` int(11) NOT NULL,
  `Anuncio` int(11) DEFAULT NULL,
  `Texto` text DEFAULT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Email` varchar(254) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Copias` int(11) DEFAULT NULL,
  `Resolucion` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `IColor` tinyint(1) DEFAULT NULL,
  `IPrecio` tinyint(1) DEFAULT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `Coste` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposanuncios`
--

CREATE TABLE `tiposanuncios` (
  `IdTAnuncio` tinyint(4) NOT NULL,
  `NomTAnuncio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiposanuncios`
--

INSERT INTO `tiposanuncios` (`IdTAnuncio`, `NomTAnuncio`) VALUES
(1, 'Venta'),
(2, 'Alquiler');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposmensajes`
--

CREATE TABLE `tiposmensajes` (
  `IdTMensaje` tinyint(4) NOT NULL,
  `NomTMensaje` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiposmensajes`
--

INSERT INTO `tiposmensajes` (`IdTMensaje`, `NomTMensaje`) VALUES
(1, 'Más información'),
(2, 'Solicitar una cita'),
(3, 'Comunicar una oferta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposviviendas`
--

CREATE TABLE `tiposviviendas` (
  `IdTVivienda` tinyint(4) NOT NULL,
  `NomTVivienda` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiposviviendas`
--

INSERT INTO `tiposviviendas` (`IdTVivienda`, `NomTVivienda`) VALUES
(1, 'Obra Nueva'),
(2, 'Vivienda'),
(3, 'Oficina'),
(4, 'Local'),
(5, 'Garaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `NomUsuario` varchar(15) NOT NULL,
  `Clave` varchar(15) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `Sexo` tinyint(4) DEFAULT NULL,
  `FNacimiento` date DEFAULT NULL,
  `Ciudad` varchar(100) DEFAULT NULL,
  `Pais` int(11) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `Estilo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`IdAnuncio`),
  ADD KEY `TAnuncio` (`TAnuncio`),
  ADD KEY `TVivienda` (`TVivienda`),
  ADD KEY `Pais` (`Pais`),
  ADD KEY `Usuario` (`Usuario`);

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`IdEstilo`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`IdFoto`),
  ADD KEY `Anuncio` (`Anuncio`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`IdMensaje`),
  ADD KEY `TMensaje` (`TMensaje`),
  ADD KEY `Anuncio` (`Anuncio`),
  ADD KEY `UsuarioOrigen` (`UsuarioOrigen`),
  ADD KEY `UsuarioDestino` (`UsuarioDestino`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`IdPais`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`IdSolicitud`),
  ADD KEY `Anuncio` (`Anuncio`);

--
-- Indices de la tabla `tiposanuncios`
--
ALTER TABLE `tiposanuncios`
  ADD PRIMARY KEY (`IdTAnuncio`);

--
-- Indices de la tabla `tiposmensajes`
--
ALTER TABLE `tiposmensajes`
  ADD PRIMARY KEY (`IdTMensaje`);

--
-- Indices de la tabla `tiposviviendas`
--
ALTER TABLE `tiposviviendas`
  ADD PRIMARY KEY (`IdTVivienda`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `NomUsuario` (`NomUsuario`),
  ADD KEY `Pais` (`Pais`),
  ADD KEY `Estilo` (`Estilo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `IdAnuncio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `IdEstilo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `IdFoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `IdMensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `IdPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `IdSolicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposanuncios`
--
ALTER TABLE `tiposanuncios`
  MODIFY `IdTAnuncio` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tiposmensajes`
--
ALTER TABLE `tiposmensajes`
  MODIFY `IdTMensaje` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tiposviviendas`
--
ALTER TABLE `tiposviviendas`
  MODIFY `IdTVivienda` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`TAnuncio`) REFERENCES `tiposanuncios` (`IdTAnuncio`),
  ADD CONSTRAINT `anuncios_ibfk_2` FOREIGN KEY (`TVivienda`) REFERENCES `tiposviviendas` (`IdTVivienda`),
  ADD CONSTRAINT `anuncios_ibfk_3` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`),
  ADD CONSTRAINT `anuncios_ibfk_4` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`IdUsuario`);

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`Anuncio`) REFERENCES `anuncios` (`IdAnuncio`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`TMensaje`) REFERENCES `tiposmensajes` (`IdTMensaje`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`Anuncio`) REFERENCES `anuncios` (`IdAnuncio`),
  ADD CONSTRAINT `mensajes_ibfk_3` FOREIGN KEY (`UsuarioOrigen`) REFERENCES `usuarios` (`IdUsuario`),
  ADD CONSTRAINT `mensajes_ibfk_4` FOREIGN KEY (`UsuarioDestino`) REFERENCES `usuarios` (`IdUsuario`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`Anuncio`) REFERENCES `anuncios` (`IdAnuncio`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`Estilo`) REFERENCES `estilos` (`IdEstilo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;