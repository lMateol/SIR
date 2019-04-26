-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2019 a las 13:35:04
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `s.i.r`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_persona` ()  NO SQL
SELECT * FROM tbl_persona$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_personaById` (IN `id` INT)  NO SQL
SELECT * FROM tbl_persona WHERE id_persona= id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tipoPersona` ()  NO SQL
SELECT * FROM tbl_tipo_persona$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nombre_comercial` varchar(255) NOT NULL,
  `propietario` varchar(255) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `iva` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre_comercial`, `propietario`, `telefono`, `direccion`, `email`, `iva`) VALUES
(1, 'Rodillos GBP', 'Liliana Ospina', '7058-7688', 'Bello Antioquia', 'rodillogGBP@gmail.com', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria_producto`
--

CREATE TABLE `tbl_categoria_producto` (
  `id_Categoria` int(11) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_categoria_producto`
--

INSERT INTO `tbl_categoria_producto` (`id_Categoria`, `categoria`, `estado`) VALUES
(1, 'Rodillo', 1),
(2, 'Canecas', 1),
(3, 'Rodillos Felpa', 1),
(4, 'asssss', 1),
(5, 'brochasss', 1),
(6, 'rodillo felpa', 1),
(7, 'asdsad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_comentario`
--

CREATE TABLE `tbl_comentario` (
  `id_comentario` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `telefono` int(50) NOT NULL,
  `comentario` varchar(250) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_comentario`
--

INSERT INTO `tbl_comentario` (`id_comentario`, `nombre`, `correo`, `telefono`, `comentario`, `fecha`) VALUES
(5, 'Jhoan', 'jhoanhenao820@gmail.', 5790660, 'sasasas', '2019-04-25 20:50:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_entrada`
--

CREATE TABLE `tbl_detalle_entrada` (
  `entrada_has_prducto` int(11) NOT NULL,
  `Entrada_id_entrada` int(11) NOT NULL,
  `Producto_id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_detalle_entrada`
--

INSERT INTO `tbl_detalle_entrada` (`entrada_has_prducto`, `Entrada_id_entrada`, `Producto_id_producto`, `cantidad`) VALUES
(1, 1, 1, 20),
(2, 2, 1, 200),
(3, 3, 1, 103),
(4, 5, 1, 12),
(5, 6, 1, 10),
(6, 7, 2, -20),
(7, 8, 1, 22),
(8, 9, 4, 40),
(9, 10, 1, 440),
(10, 11, 1, 20),
(11, 12, 1, 10),
(12, 13, 1, 120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_pedido`
--

CREATE TABLE `tbl_detalle_pedido` (
  `Pedido_has_Producto` int(11) NOT NULL,
  `Pedido_id_pedido` int(11) DEFAULT NULL,
  `Producto_id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `sub_total1` int(11) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `sub_total2` int(11) DEFAULT NULL,
  `iva_total` int(11) DEFAULT NULL,
  `total_pagar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_detalle_pedido`
--

INSERT INTO `tbl_detalle_pedido` (`Pedido_has_Producto`, `Pedido_id_pedido`, `Producto_id_producto`, `cantidad`, `precio`, `sub_total1`, `descuento`, `sub_total2`, `iva_total`, `total_pagar`) VALUES
(1, NULL, 1, 1, 100, 1000, 2, 500, 500, 500),
(2, NULL, 2, 2, 200, 1000, 2, 500, 500, 500),
(3, NULL, 3, 1, 20000, 1000, 2, 500, 500, 500),
(4, NULL, 4, 1, 55000, 1000, 2, 500, 500, 500),
(5, 1, 3, 1, 100, 1000, 2, 500, 500, 500),
(6, 1, 2, 1, 200, 1000, 2, 500, 500, 500),
(7, 1, 1, 1, 100, 1000, 2, 500, 500, 500),
(8, 2, 3, 1, 100, 1000, 2, 500, 500, 500),
(9, 2, 3, 1, 100, 1000, 2, 500, 500, 500),
(10, 2, 1, 1, 100, 1000, 2, 500, 500, 500),
(11, 3, 2, 11, 200, 1000, 2, 500, 500, 500),
(12, 3, 4, 1, 55000, 1000, 2, 500, 500, 500),
(13, 4, 2, 10, 200, 1000, 2, 500, 500, 500),
(14, 4, 1, 1, 100, 1000, 2, 500, 500, 500),
(15, 5, 1, 5, 100, 1000, 2, 500, 500, 500),
(16, 5, 2, 1, 200, 1000, 2, 500, 500, 500),
(17, 5, 3, 1, 100, 1000, 2, 500, 500, 500),
(18, 5, 4, 1, 55000, 1000, 2, 500, 500, 500),
(19, 6, 1, 1, 100, 1000, 2, 500, 500, 500),
(20, 6, 2, 1, 200, 1000, 2, 500, 500, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_salida`
--

CREATE TABLE `tbl_detalle_salida` (
  `producto_has_salida` int(11) NOT NULL,
  `Salida_id_salida` int(11) NOT NULL,
  `Producto_id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_detalle_salida`
--

INSERT INTO `tbl_detalle_salida` (`producto_has_salida`, `Salida_id_salida`, `Producto_id_producto`, `cantidad`) VALUES
(1, 1, 1, 10),
(2, 2, 2, 20),
(3, 3, 1, 44),
(4, 4, 1, 40),
(5, 5, 1, 40),
(6, 6, 1, 10),
(7, 7, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_entrada`
--

CREATE TABLE `tbl_entrada` (
  `id_entrada` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_entrada`
--

INSERT INTO `tbl_entrada` (`id_entrada`, `fecha_entrada`) VALUES
(1, '2019-03-11'),
(2, '2019-03-13'),
(3, '2019-03-18'),
(4, '2019-04-09'),
(5, '2019-04-09'),
(6, '2019-04-09'),
(7, '2019-04-09'),
(8, '2019-04-09'),
(9, '2019-04-09'),
(10, '2019-04-09'),
(11, '2019-04-10'),
(12, '2019-04-22'),
(13, '2019-04-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedido`
--

CREATE TABLE `tbl_pedido` (
  `id_pedido` int(11) NOT NULL,
  `Persona_id_persona` int(11) NOT NULL,
  `num_fact` int(11) NOT NULL,
  `vendedor` varchar(45) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `despachado_por` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `comentarios` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_pedido`
--

INSERT INTO `tbl_pedido` (`id_pedido`, `Persona_id_persona`, `num_fact`, `vendedor`, `fecha_pedido`, `fecha_vencimiento`, `despachado_por`, `estado`, `comentarios`) VALUES
(1, 1, 500, 'Liliana Ospina', '2019-04-09', '2019-04-09', 'Recogido', 0, 'joeuroasdsa'),
(2, 1, 500, 'Liliana Ospina', '2019-04-09', '2019-04-09', 'Recogido', 1, 'asdasd'),
(3, 1, 500, 'Liliana Ospina', '2019-04-09', '2019-04-09', 'Recogido', 1, 'kpasdasjdas'),
(4, 1, 500, 'Liliana Ospina', '2019-04-09', '2019-04-09', 'Recogido', 1, 'scsdss'),
(5, 1, 500, 'Liliana Ospina', '2019-04-09', '2019-04-09', 'Recogido', 1, 'asdjasdas'),
(6, 1, 520, 'Liliana Ospina', '2019-04-18', '2019-04-18', 'Recogido', 0, 'gracias'),
(7, 1, 500, 'Liliana Ospina', '2019-04-23', '2019-04-23', 'Recogido', 0, 'gracias liliana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona`
--

CREATE TABLE `tbl_persona` (
  `id_persona` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `tipo_documento_tipo_documento` int(11) NOT NULL,
  `documento` varchar(45) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `nro_Celular` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  `departamento` varchar(45) DEFAULT NULL,
  `tipo_persona_tipo_persona` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_persona`
--

INSERT INTO `tbl_persona` (`id_persona`, `nombres`, `apellidos`, `tipo_documento_tipo_documento`, `documento`, `telefono`, `nro_Celular`, `direccion`, `ciudad`, `departamento`, `tipo_persona_tipo_persona`, `estado`) VALUES
(1, 'jhoan sebastian', 'talaigua', 1, '1193441494', '523256', '123', 'calle 84 57A', 'medellin', 'antioquia', 2, 1),
(2, 'kildary', 'talaigua', 2, '11912312132', '21321321321', '321321321321', 'calle 52', 'bello', 'antioquia', 2, 1),
(3, 'nubia', 'hoyos', 1, '52325867', '123', '3128396759', 'calle52', 'manizales', 'bello', 1, 1),
(4, 'sebastian h', 'bustamante', 1, '1000307303', '5790660', '3207990284', 'cr 66', 'Bello', 'Antioquia', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE `tbl_producto` (
  `id_producto` int(11) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `nombre_producto` varchar(45) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `IVA_Producto` int(11) NOT NULL,
  `Categoria_Producto_id_Categoria` int(11) NOT NULL,
  `Persona_id_persona` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_producto`
--

INSERT INTO `tbl_producto` (`id_producto`, `referencia`, `nombre_producto`, `precio_unitario`, `IVA_Producto`, `Categoria_Producto_id_Categoria`, `Persona_id_persona`, `cantidad`, `estado`) VALUES
(1, 'RF2', 'rodillo pequeÃ±o', 100, 19, 1, 1, 290, 1),
(2, 'B011', 'brocha', 200, 2, 2, 1, 1000, 1),
(3, 'RF3', 'rodillo mediano', 100, 19, 1, 1, 25, 1),
(4, 'RF4', 'rodillo felpa', 55000, 19, 1, 3, 240, 1),
(5, 'FR53', 'rodillo felpa grande', 2000, 0, 3, 3, 200, 1),
(6, 'RF003', 'rodillo felpa grande', 10000, 19, 3, 3, 100, 1),
(7, 'RF003', 'rodillo nuevo', 1000, 19, 2, 3, 666, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salida`
--

CREATE TABLE `tbl_salida` (
  `id_salida` int(11) NOT NULL,
  `fecha_salida` date NOT NULL,
  `tipo_salida_tipo_salida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_salida`
--

INSERT INTO `tbl_salida` (`id_salida`, `fecha_salida`, `tipo_salida_tipo_salida`) VALUES
(1, '2019-03-11', 2),
(2, '2019-04-09', 2),
(3, '2019-04-09', 2),
(4, '2019-04-09', 2),
(5, '2019-04-10', 1),
(6, '2019-04-18', 2),
(7, '2019-04-22', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_documento`
--

CREATE TABLE `tbl_tipo_documento` (
  `tipo_documento` int(11) NOT NULL,
  `nombre_documento` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tipo_documento`
--

INSERT INTO `tbl_tipo_documento` (`tipo_documento`, `nombre_documento`, `estado`) VALUES
(1, 'Celuda Ciudadan?a', 0),
(2, 'Tarjeta Identidad', 0),
(3, 'NIT', 0),
(4, 'Cedula Extranjer?a', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_persona`
--

CREATE TABLE `tbl_tipo_persona` (
  `tipo_persona` int(11) NOT NULL,
  `nombre_tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tipo_persona`
--

INSERT INTO `tbl_tipo_persona` (`tipo_persona`, `nombre_tipo`) VALUES
(1, 'Proveedor'),
(2, 'Cliente'),
(3, 'mamasita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_salida`
--

CREATE TABLE `tbl_tipo_salida` (
  `tipo_salida` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tipo_salida`
--

INSERT INTO `tbl_tipo_salida` (`tipo_salida`, `nombre`, `estado`) VALUES
(1, 'Daño', 0),
(2, 'Accidente', 1),
(3, 'y', 1),
(4, '43', 1),
(5, '6', 1),
(6, '9', 1),
(7, 'mal estado', 1),
(8, 'mal estado', 1),
(9, 'mal estado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `nombre`, `correo`, `password`, `imagen`, `url`) VALUES
(1, 'Jhoan ', 'jhoanhenao820@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'fondo.jpg', 'public/img/fondo.jpg');

-- --------------------------------------------------------


--
-- Estructura de tabla para la tabla `tmp`
--

CREATE TABLE `tmp` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tmp`
--

INSERT INTO `tmp` (`id_tmp`, `id_producto`, `cantidad_tmp`, `precio_tmp`, `session_id`) VALUES
(96, 1, 1, 100.00, 'agaca3lehngaf31gnu4mnju8sf'),
(94, 1, 1, 100.00, 'agaca3lehngaf31gnu4mnju8sf'),
(103, 1, 1, 100.00, 'agaca3lehngaf31gnu4mnju8sf'),
(104, 4, 1, 55000.00, 'agaca3lehngaf31gnu4mnju8sf'),
(131, 3, 1, 100.00, '889v73ib3tro5btlnremllkah3'),
(127, 1, 1, 100.00, '889v73ib3tro5btlnremllkah3'),
(128, 2, 1, 200.00, '889v73ib3tro5btlnremllkah3'),
(129, 2, 1, 200.00, '889v73ib3tro5btlnremllkah3'),
(130, 3, 1, 100.00, '889v73ib3tro5btlnremllkah3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_categoria_producto`
--
ALTER TABLE `tbl_categoria_producto`
  ADD PRIMARY KEY (`id_Categoria`);

--
-- Indices de la tabla `tbl_comentario`
--
ALTER TABLE `tbl_comentario`
  ADD PRIMARY KEY (`id_comentario`);

--
-- Indices de la tabla `tbl_detalle_entrada`
--
ALTER TABLE `tbl_detalle_entrada`
  ADD PRIMARY KEY (`entrada_has_prducto`),
  ADD KEY `fk_Entrada_has_Producto_Entrada1_idx` (`Entrada_id_entrada`),
  ADD KEY `fk_Entrada_has_Producto_Producto1_idx` (`Producto_id_producto`);

--
-- Indices de la tabla `tbl_detalle_pedido`
--
ALTER TABLE `tbl_detalle_pedido`
  ADD PRIMARY KEY (`Pedido_has_Producto`),
  ADD KEY `fk_Pedido_has_Producto_Pedido1_idx` (`Pedido_id_pedido`),
  ADD KEY `fk_Pedido_has_Producto_Producto1_idx` (`Producto_id_producto`);

--
-- Indices de la tabla `tbl_detalle_salida`
--
ALTER TABLE `tbl_detalle_salida`
  ADD PRIMARY KEY (`producto_has_salida`),
  ADD KEY `fk_Producto_has_Salida_Producto1_idx` (`Producto_id_producto`),
  ADD KEY `fk_Producto_has_Salida_Salida1_idx` (`Salida_id_salida`);

--
-- Indices de la tabla `tbl_entrada`
--
ALTER TABLE `tbl_entrada`
  ADD PRIMARY KEY (`id_entrada`);

--
-- Indices de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_Pedido_Persona1_idx` (`Persona_id_persona`);

--
-- Indices de la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `fk_Persona_tipo_persona1_idx` (`tipo_persona_tipo_persona`),
  ADD KEY `fk_Persona_tipo_documento1_idx` (`tipo_documento_tipo_documento`);

--
-- Indices de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_Producto_Persona1_idx` (`Persona_id_persona`),
  ADD KEY `fk_Producto_Categoria_Producto1_idx` (`Categoria_Producto_id_Categoria`);

--
-- Indices de la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `fk_Salida_tipo_salida1_idx` (`tipo_salida_tipo_salida`);

--
-- Indices de la tabla `tbl_tipo_documento`
--
ALTER TABLE `tbl_tipo_documento`
  ADD PRIMARY KEY (`tipo_documento`);

--
-- Indices de la tabla `tbl_tipo_persona`
--
ALTER TABLE `tbl_tipo_persona`
  ADD PRIMARY KEY (`tipo_persona`);

--
-- Indices de la tabla `tbl_tipo_salida`
--
ALTER TABLE `tbl_tipo_salida`
  ADD PRIMARY KEY (`tipo_salida`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`id_tmp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_categoria_producto`
--
ALTER TABLE `tbl_categoria_producto`
  MODIFY `id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_comentario`
--
ALTER TABLE `tbl_comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_entrada`
--
ALTER TABLE `tbl_detalle_entrada`
  MODIFY `entrada_has_prducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_pedido`
--
ALTER TABLE `tbl_detalle_pedido`
  MODIFY `Pedido_has_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_salida`
--
ALTER TABLE `tbl_detalle_salida`
  MODIFY `producto_has_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_entrada`
--
ALTER TABLE `tbl_entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_documento`
--
ALTER TABLE `tbl_tipo_documento`
  MODIFY `tipo_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_persona`
--
ALTER TABLE `tbl_tipo_persona`
  MODIFY `tipo_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_salida`
--
ALTER TABLE `tbl_tipo_salida`
  MODIFY `tipo_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_detalle_entrada`
--
ALTER TABLE `tbl_detalle_entrada`
  ADD CONSTRAINT `fk_Entrada_has_Producto_Entrada1` FOREIGN KEY (`Entrada_id_entrada`) REFERENCES `tbl_entrada` (`id_entrada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Entrada_has_Producto_Producto1` FOREIGN KEY (`Producto_id_producto`) REFERENCES `tbl_producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_pedido`
--
ALTER TABLE `tbl_detalle_pedido`
  ADD CONSTRAINT `fk_Pedido_has_Producto_Pedido1` FOREIGN KEY (`Pedido_id_pedido`) REFERENCES `tbl_pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_has_Producto_Producto1` FOREIGN KEY (`Producto_id_producto`) REFERENCES `tbl_producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_salida`
--
ALTER TABLE `tbl_detalle_salida`
  ADD CONSTRAINT `fk_Producto_has_Salida_Producto1` FOREIGN KEY (`Producto_id_producto`) REFERENCES `tbl_producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_has_Salida_Salida1` FOREIGN KEY (`Salida_id_salida`) REFERENCES `tbl_salida` (`id_salida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD CONSTRAINT `fk_Pedido_Persona1` FOREIGN KEY (`Persona_id_persona`) REFERENCES `tbl_persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  ADD CONSTRAINT `fk_Persona_tipo_documento1` FOREIGN KEY (`tipo_documento_tipo_documento`) REFERENCES `tbl_tipo_documento` (`tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persona_tipo_persona1` FOREIGN KEY (`tipo_persona_tipo_persona`) REFERENCES `tbl_tipo_persona` (`tipo_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD CONSTRAINT `fk_Producto_Categoria_Producto1` FOREIGN KEY (`Categoria_Producto_id_Categoria`) REFERENCES `tbl_categoria_producto` (`id_Categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_Persona1` FOREIGN KEY (`Persona_id_persona`) REFERENCES `tbl_persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  ADD CONSTRAINT `fk_Salida_tipo_salida1` FOREIGN KEY (`tipo_salida_tipo_salida`) REFERENCES `tbl_tipo_salida` (`tipo_salida`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
