-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2017 a las 17:08:52
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestor_archivos`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `documentos` (IN `_tipo` VARCHAR(20), IN `_dependencia` VARCHAR(20), IN `_opcion` VARCHAR(20), IN `_ruta` VARCHAR(200), IN `_asunto` VARCHAR(20), IN `_nombre` VARCHAR(200), IN `_detalles` VARCHAR(200), IN `_idusuario` VARCHAR(20), IN `_respuesta` VARCHAR(200), IN `_id` VARCHAR(20))  BEGIN

Case _opcion

When 'consulta_estandar' then

    SELECT d.id, r.id, asunto, d.nombre, fecha, 
    CASE When u.dependencia_usuario>1 THEN 'Financiera' Else 'Sistemas' END, 
    estado_documento, tipo_documento, archivo
    FROM documento d, estado_documento e, radicado r, tipo_documento t, usuario u 
    WHERE d.id = r.id_documento 
    AND e.id = r.id_estado_documento 
    AND id_tipo_documento = t.id 
    AND id_tipo_documento = _tipo
    AND u.id = d.id_usuario
    AND r.id_dependencia = _dependencia
    AND estado_documento != 'Archivado'
    GROUP BY d.id;
    
    
When 'consulta_admin' then

    SELECT d.id, r.id, asunto, d.nombre, fecha, 
    CASE When u.dependencia_usuario>1 THEN 'Financiera' Else 'Sistemas' END, 
    estado_documento, tipo_documento, archivo
    FROM documento d, estado_documento e, radicado r, tipo_documento t, usuario u 
    WHERE d.id = r.id_documento 
    AND e.id = r.id_estado_documento 
    AND id_tipo_documento = t.id
    AND u.id = d.id_usuario
    GROUP BY d.id;
    
    
WHEN 'consulta_archivado' THEN

    SELECT d.id, r.id, asunto, d.nombre, fecha, 
    CASE When u.dependencia_usuario>1 THEN 'Financiera' Else 'Sistemas' END, 
    estado_documento, tipo_documento, archivo 
    FROM documento d, estado_documento e, radicado r, tipo_documento t, usuario u 
    WHERE d.id = r.id_documento 
    AND e.id = r.id_estado_documento 
    AND id_tipo_documento = t.id 
    AND estado_documento = 'Archivado'
    AND u.id = d.id_usuario
    AND r.id_dependencia = _dependencia 
    GROUP BY d.id;
    
When 'crear' then
    
    INSERT INTO documento (id, archivo, asunto, nombre, detalles, id_usuario, id_tipo_documento, fecha) 
    VALUES (NULL, _ruta, _asunto, _nombre, _detalles, _idusuario, _tipo, CURDATE());
    
When 'respuesta' then

     UPDATE documento 
     SET `respuesta` = _respuesta 
     WHERE `id`= _id;
     
When 'id' then

     SELECT id 
     FROM documento 
     WHERE nombre=_nombre 
     ORDER BY id DESC 
     LIMIT 1;
     
When 'eliminar' then
     
     DELETE FROM documento WHERE id=_id;
     
When 'contestar' then

     SELECT asunto, d.nombre, archivo, fecha, tipo_documento, estado_documento,
    CASE When u.dependencia_usuario> 1 THEN 'Financiera' Else 'Sistemas' END, detalles, u.nombre, apellido, respuesta, r.id
    FROM documento d, estado_documento e, radicado r, tipo_documento t, usuario u 
    WHERE d.id = r.id_documento 
    AND e.id = r.id_estado_documento 
    AND t.id = d.id_tipo_documento
    AND u.id = d.id_usuario
    AND d.id = _id;
    
    End Case;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eventos` (IN `_id` VARCHAR(20), IN `_foto` VARCHAR(200), IN `_opcion` VARCHAR(20))  BEGIN

CASE _opcion

When 'actualizar' then

       UPDATE `eventos` 
       SET `foto` = _foto 
       WHERE `id` = _id;
       
When 'consultar' then

       SELECT foto 
       FROM eventos 
       WHERE `id` = _id;
    
    End Case;
   
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `radicado` (IN `_dependencia` VARCHAR(20), IN `_estado` VARCHAR(20), IN `_documento` VARCHAR(20), IN `_id` VARCHAR(20), IN `_opcion` VARCHAR(20), IN `_usuario` VARCHAR(50))  BEGIN

Case _opcion

When 'insertar' then

       INSERT 
       INTO `radicado` (`id_dependencia`, `id_estado_documento`, `id_documento`, `id`, `usuario`)     
       VALUES (_dependencia, _estado, _documento, NULL, _usuario);
    
When 'estado' then

        UPDATE radicado 
        SET `id_estado_documento` = _estado, 
        `usuario` = _usuario
        WHERE `id`=_id;
        
When 'contestar' then

        UPDATE radicado 
        SET `id_estado_documento` = _estado, 
        `id_dependencia` = _dependencia,
        `usuario` = _usuario
        WHERE `id`=_id;
    
WHEN 'reasignar' THEN

    UPDATE radicado 
    SET `id_dependencia` = _dependencia, 
    `usuario` = _usuario, `id_estado_documento` = _estado 
    WHERE `id_documento`= _documento;
    
When 'eliminar' then
    
    DELETE 
    FROM radicado 
    WHERE id_documento=_documento;
    
    End Case;
   
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `radicado_seguimientos` (IN `_iddependencia` VARCHAR(20), IN `_idestado` VARCHAR(20), IN `_iddocumento` VARCHAR(20), IN `_usuario` VARCHAR(20), IN `_opcion` VARCHAR(20))  BEGIN

CASE _opcion

WHEN 'insertar' THEN

    Insert 
    into radicado_seguimiento (id_dependencia,  id_estado_documento, id_documento, estado, usuario, fecha) 
    values (_iddependencia, _idestado, _iddocumento, 'Creo', _usuario, now());
    
when 'consultar' THEN

    SELECT r.id_documento, r.usuario, estado, e.estado_documento, r.fecha
    FROM estado_documento e, radicado_seguimiento r
    WHERE e.id = r.id_estado_documento 
    AND r.id_documento = _iddocumento
    AND r.estado != 'Elimino'
    ORDER BY 5;
    
when 'eliminados' THEN

    SELECT r.id_documento, r.usuario, estado, e.estado_documento, r.fecha
    FROM estado_documento e, radicado_seguimiento r
    WHERE e.id = r.id_estado_documento 
    AND r.estado = 'Elimino'
    ORDER BY 5;
    
END CASE;
   
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usuarios` (IN `_nombre` VARCHAR(20), IN `_apellido` VARCHAR(20), IN `_usuario` VARCHAR(20), IN `_pass` VARCHAR(20), IN `_telefono` VARCHAR(20), IN `_email` VARCHAR(20), IN `_tipo` VARCHAR(20), IN `_dependencia` VARCHAR(20), IN `_nacimiento` VARCHAR(20), IN `_opcion` VARCHAR(20), IN `_id` VARCHAR(20), IN `_foto` VARCHAR(20), IN `_fondo` VARCHAR(20), IN `_fuente` VARCHAR(20))  BEGIN

CASE _opcion
 
WHEN 'crear' THEN

    INSERT INTO `usuario` (`id`, `foto`, `nombre`, `apellido`, `usuario`, `pass`, `email`, `tipo_usuario`, `dependencia_usuario`, `fondo`, `fuente`) 
    VALUES (NULL, 'img/usuario.jpg', _nombre, _apellido, _usuario, _pass, _email, _tipo, _dependencia, 'images/narutoImagen.jpeg', 'Comic Sans');
    
WHEN 'eliminar' THEN
    
    DELETE FROM usuario WHERE id=_id;
    
WHEN 'actualizar_admin' THEN
    
    UPDATE usuario 
    SET `nombre` = _nombre, `apellido` = _apellido, `pass` = _pass, `email` = _email, `tipo_usuario` = _tipo, `dependencia_usuario` = _dependencia 
    WHERE `usuario`= _usuario;
    
WHEN 'foto' THEN
    
    UPDATE `usuario` 
    SET `foto` = _foto 
    WHERE `id` = _id;
    
WHEN 'validar' THEN

    SELECT * 
    FROM usuario 
    WHERE usuario= _usuario;
    
WHEN 'actualizar_estandar' THEN

    UPDATE `usuario` 
    SET `nacimiento` = _nacimiento, `email` = _email, `telefono` = _telefono 
    WHERE `id` = _id;
    
When 'personalizar' then
     
     UPDATE `usuario` 
     SET `fondo` = _fondo, `fuente` = _fuente
     WHERE `id` = _id;
     
When 'admin' then
     
    SELECT u.id, u.nombre, apellido,usuario, email, t.tipo_usuario, d.nombre, nacimiento
    FROM usuario u, tipo_usuario t, dependencia d 
    WHERE u.tipo_usuario= t.id 
    AND dependencia_usuario = d.id;
   
    END CASE;
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE `dependencia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`id`, `nombre`) VALUES
(0, NULL),
(1, 'Sistemas'),
(2, 'Financiera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id` int(11) NOT NULL,
  `archivo` varchar(200) DEFAULT NULL,
  `asunto` varchar(32) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `detalles` varchar(200) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `respuesta` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id`, `archivo`, `asunto`, `nombre`, `detalles`, `id_usuario`, `id_tipo_documento`, `fecha`, `respuesta`) VALUES
(97, 'docs/Mistransacciones.pdf', 'Prueba 3.0', 'Mis transacciones.pdf', 'Prueba', 12, 1, '2017-05-18', 'Aceptado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_documento`
--

CREATE TABLE `estado_documento` (
  `id` int(11) NOT NULL,
  `estado_documento` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado_documento`
--

INSERT INTO `estado_documento` (`id`, `estado_documento`) VALUES
(0, 'Eliminado'),
(1, 'Enviado'),
(2, 'Contestado'),
(3, 'Reasignado'),
(4, 'Archivado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `foto`) VALUES
(1, 'img/death-note-14093-1920x1200.jpg'),
(2, 'img/Best-Anime-Attack-On-Titan-Wallpaper-HD.png'),
(3, 'img/thumb-1920-607718.png'),
(4, 'img/thumb-1920-446274.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `radicado`
--

CREATE TABLE `radicado` (
  `id_dependencia` int(11) NOT NULL,
  `id_estado_documento` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `radicado`
--

INSERT INTO `radicado` (`id_dependencia`, `id_estado_documento`, `id_documento`, `id`, `usuario`) VALUES
(1, 3, 97, 2, 'Valen');

--
-- Disparadores `radicado`
--
DELIMITER $$
CREATE TRIGGER `radicado_historial` AFTER UPDATE ON `radicado` FOR EACH ROW Insert into radicado_seguimiento (id_dependencia,  id_estado_documento, id_documento, estado, usuario, fecha) values (new.id_dependencia, new.id_estado_documento, new.id_documento, 'Modifico', new.usuario, now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `radicado_historial2` AFTER DELETE ON `radicado` FOR EACH ROW Insert into radicado_seguimiento (id_dependencia,  id_estado_documento, id_documento, estado, usuario, fecha) values ('0', '0', old.id_documento, 'Elimino', old.usuario, now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `radicado_seguimiento`
--

CREATE TABLE `radicado_seguimiento` (
  `id_dependencia` int(11) NOT NULL,
  `id_estado_documento` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `radicado_seguimiento`
--

INSERT INTO `radicado_seguimiento` (`id_dependencia`, `id_estado_documento`, `id_documento`, `usuario`, `estado`, `fecha`) VALUES
(1, 1, 95, 'Valen', 'Creo', '2017-05-17 00:00:00'),
(2, 3, 95, 'Valen', 'Modificado', '2017-05-17 00:00:00'),
(2, 4, 95, 'Pablo1', 'Modificado', '2017-05-17 00:00:00'),
(1, 2, 95, 'Pablo1', 'Modificado', '2017-05-17 00:00:00'),
(0, 0, 95, 'Pablo1', 'Elimino', '2017-05-17 00:00:00'),
(1, 1, 96, 'Valen', 'Creo', '2017-05-18 00:00:00'),
(2, 3, 96, 'Valen', 'Modifico', '2017-05-18 00:00:00'),
(1, 2, 96, 'Pablo1', 'Modifico', '2017-05-18 00:00:00'),
(1, 4, 96, 'Valen', 'Modifico', '2017-05-18 00:00:00'),
(0, 0, 96, 'Valen', 'Elimino', '2017-05-18 00:00:00'),
(2, 1, 97, 'Valen', 'Creo', '2017-05-18 00:00:00'),
(1, 2, 97, 'Pablo', 'Modifico', '2017-05-18 00:00:00'),
(1, 4, 97, 'Valen', 'Modifico', '2017-05-18 09:52:00'),
(1, 3, 97, 'Valen', 'Modifico', '2017-05-18 09:52:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(32) NOT NULL,
  `tipo_documento` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `tipo_documento`) VALUES
(1, 'Cotizacion'),
(2, 'Solicitudes'),
(3, 'Permisos'),
(4, 'Facturas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `tipo_usuario` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo_usuario`) VALUES
(0, 'Administrador'),
(1, 'Estandar'),
(2, 'Dependencia'),
(3, 'Directivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(32) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `nombre` varchar(32) DEFAULT NULL,
  `apellido` varchar(32) DEFAULT NULL,
  `usuario` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(32) NOT NULL,
  `tipo_usuario` int(32) NOT NULL,
  `dependencia_usuario` int(32) NOT NULL,
  `nacimiento` date DEFAULT NULL,
  `fondo` varchar(200) NOT NULL,
  `fuente` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `foto`, `nombre`, `apellido`, `usuario`, `pass`, `telefono`, `email`, `tipo_usuario`, `dependencia_usuario`, `nacimiento`, `fondo`, `fuente`) VALUES
(9, 'img/maxresdefault.jpg', 'Juan', 'Aguirre', 'JuanPa', '1234', '3140000001', '@gmail', 0, 1, '1996-05-02', 'img/thumb-1920-19537.jpg', 'Comic sans'),
(11, 'img/Sabio.png', 'Mateo', 'Nieto', 'Payo', '123', '3140000001', '@gmail', 0, 1, '2000-01-01', 'images/narutoImagen.jpeg', 'Comic sans'),
(12, 'img/1.jpg', 'Diana', 'Garcia', 'Valen', '123', '3147950248', '@gmail.com', 1, 1, '0000-00-00', 'img/wc1701174.jpg', 'Comic Sans'),
(13, 'img/11031804.jpg', 'Valentina', 'Garcia', 'Diana', '123', '3140000000', '@gmail', 1, 1, '1998-01-29', 'images/narutoImagen.jpeg', 'Comic sans'),
(14, 'img/naruto_naruto_shippuden_bijuu_mode_uzumaki_103300_3840x2400.jpg', 'Alvaro', 'Aguirre', 'Pablo', '123', '3140000000', '@gmail', 1, 2, '1998-01-29', 'img/thumb-1920-19537.jpg', 'Comic sans'),
(15, 'img/AUGnM7.jpg', 'Pablo', 'Aguirre', 'Pablo1', '123', '314', 'gmail', 1, 2, '1996-05-02', 'img/maxresdefault.jp', 'Comic sans'),
(16, 'img/usuario.jpg', 'asd', 'asd', 'asd', 'asd', NULL, 'asd', 1, 2, NULL, 'images/narutoImagen.jpeg', 'Comic Sans');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_tipo_documento` (`id_tipo_documento`);

--
-- Indices de la tabla `estado_documento`
--
ALTER TABLE `estado_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `radicado`
--
ALTER TABLE `radicado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado_documento` (`id_estado_documento`),
  ADD KEY `id_documento` (`id_documento`),
  ADD KEY `id_dependencia` (`id_dependencia`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_usuario` (`tipo_usuario`),
  ADD KEY `dependencia_usuario` (`dependencia_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT de la tabla `estado_documento`
--
ALTER TABLE `estado_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `radicado`
--
ALTER TABLE `radicado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_6` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `documento_ibfk_8` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documento` (`id`);

--
-- Filtros para la tabla `radicado`
--
ALTER TABLE `radicado`
  ADD CONSTRAINT `radicado_ibfk_2` FOREIGN KEY (`id_estado_documento`) REFERENCES `estado_documento` (`id`),
  ADD CONSTRAINT `radicado_ibfk_3` FOREIGN KEY (`id_documento`) REFERENCES `documento` (`id`),
  ADD CONSTRAINT `radicado_ibfk_4` FOREIGN KEY (`id_dependencia`) REFERENCES `dependencia` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`dependencia_usuario`) REFERENCES `dependencia` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
