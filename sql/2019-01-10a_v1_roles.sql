-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-01-2019 a las 19:18:05
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `daw2_ofertas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(12) UNSIGNED NOT NULL,
  `titulo` text NOT NULL COMMENT 'Titulo corto o slogan para el anuncio u oferta.',
  `descripcion` text COMMENT 'Descripción breve del anuncio/oferta o NULL si no es necesaria.',
  `tienda` text COMMENT 'Descripcion de la tienda o lugar del anuncio/oferta o NULL si no se conoce, aunque no debería estar vacío este dato.',
  `url` text COMMENT 'Dirección web externa (opcional) que enlaza con la página "oficial" o directamente del anuncio/oferta o NULL si no hay o no se conoce.',
  `fecha_desde` datetime DEFAULT NULL COMMENT 'Fecha y Hora de inicio del anuncio/oferta o NULL si no se conoce (mostrar próximamente).',
  `fecha_hasta` datetime DEFAULT NULL COMMENT 'Fecha y Hora de finalización del anuncio/oferta o NULL si no se conoce (no caduca automaáticamente).',
  `precio_oferta` float NOT NULL DEFAULT '0' COMMENT 'Precio de la oferta.',
  `precio_original` float NOT NULL DEFAULT '0' COMMENT 'Precio original antes de la oferta.',
  `zona_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Area/Zona de ubicación de la tienda del anuncio/oferta o CERO si no existe o aún no está indicada (como si fuera NULL).',
  `categoria_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Categoria de clasificación del anuncio/oferta o CERO si no existe o aún no está indicada (como si fuera NULL).',
  `imagen_id` varchar(25) DEFAULT NULL COMMENT 'Nombre identificativo (fichero interno) con la imagen principal o "de presentación" del anuncio/oferta, o NULL si no hay.',
  `votosOK` int(9) NOT NULL DEFAULT '0' COMMENT 'Contador de votos a favor para el anuncio/oferta.',
  `votosKO` int(9) NOT NULL DEFAULT '0' COMMENT 'Contador de votos encontra para el anuncio/oferta.',
  `proveedor_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Prveedor  del anuncio/oferta o CERO si no está patrocinado por nadie o no existe, o aún no está indicado (como si fuera NULL).',
  `prioridad` int(4) NOT NULL DEFAULT '0' COMMENT 'Indicador de importancia para el anuncio/oferta en caso de tener proveedor.',
  `visible` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de anuncio/oferta visible a los usuarios o invisible (se está manteniendo): 0=Invisible, 1=Visible.',
  `terminada` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de anuncio/oferta terminada: 0=No, 1=Realizada, 2=Suspendida, 3=Cancelada por Inadecuada, ...',
  `fecha_terminacion` datetime DEFAULT NULL COMMENT 'Fecha y Hora de terminación del anuncio/oferta. Debería estar a NULL si no está terminada.',
  `num_denuncias` int(9) NOT NULL DEFAULT '0' COMMENT 'Contador de denuncias del anuncio/oferta o CERO si no ha tenido.',
  `fecha_denuncia1` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `bloqueada` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de anuncio/oferta bloqueada: 0=No, 1=Si(bloqueada por denuncias), 2=Si(bloqueada por administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del anuncio/oferta. Debería estar a NULL si no está bloqueada o si se desbloquea.',
  `notas_bloqueo` text COMMENT 'Notas visibles sobre el motivo del bloqueo del anuncio/oferta o NULL si no hay -se muestra por defecto según indique "bloqueada"-.',
  `cerrada_comentar` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de anuncio/oferta cerrada para comentarios: 0=No, 1=Si.',
  `crea_usuario_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Usuario que ha creado el anuncio/oferta o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación del anuncio/oferta o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Usuario que ha modificado el anuncio/oferta por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del anuncio/oferta o NULL si no se conoce por algún motivo.',
  `notas_admin` text COMMENT 'Notas adicionales para los moderadores/administradores sobre el anuncio/oferta o NULL si no hay.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios_comentarios`
--

CREATE TABLE `anuncios_comentarios` (
  `id` int(12) UNSIGNED NOT NULL,
  `anuncio_id` int(12) UNSIGNED NOT NULL COMMENT 'Anuncio/Oferta relacionada',
  `texto` text NOT NULL COMMENT 'El texto del comentario.',
  `comentario_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Comentario relacionado, si se permiten encadenar respuestas. Nodo padre de la jerarquia de comentarios, CERO si es nodo raiz.',
  `cerrado` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de cierre de los comentarios: 0=No, 1=Si(No se puede responder al comentario)',
  `num_denuncias` int(9) NOT NULL DEFAULT '0' COMMENT 'Contador de denuncias del comentario o CERO si no ha tenido.',
  `fecha_denuncia1` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `bloqueado` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de comentario bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del comentario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` text COMMENT 'Notas visibles sobre el motivo del bloqueo del comentario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.',
  `crea_usuario_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Usuario que ha creado el comentario o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación del comentario o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Usuario que ha modificado el comentario por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del comentario o NULL si no se conoce por algún motivo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios_etiquetas`
--

CREATE TABLE `anuncios_etiquetas` (
  `id` int(12) UNSIGNED NOT NULL,
  `anuncio_id` int(12) UNSIGNED NOT NULL COMMENT 'Anuncio/oferta relacionada',
  `etiqueta_id` int(12) UNSIGNED NOT NULL COMMENT 'Etiqueta relacionada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(12) UNSIGNED NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` text COMMENT 'Texto adicional que describe la categoria o clasificación.',
  `icono` varchar(25) DEFAULT NULL COMMENT 'Nombre del icono relacionado de entre los disponibles en la aplicación (carpeta iconos posibles).',
  `categoria_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Categoria relacionada, para poder realizar la jerarquía de clasificaciones. Nodo padre de la jerarquía de categoría, o CERO si es nodo raiz (como si fuera NULL).'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `variable` varchar(50) NOT NULL,
  `valor` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id` int(12) UNSIGNED NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` text COMMENT 'Texto adicional que describe la etiqueta o NULL si no es necesario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(12) UNSIGNED NOT NULL,
  `fecha_hora` datetime NOT NULL COMMENT 'Fecha y Hora de creación del mensaje.',
  `texto` text COMMENT 'Texto con el mensaje.',
  `origen_usuario_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Usuario relacionado, origen del mensaje.',
  `destino_usuario_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Usuario relacionado, destinatario del mensaje.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado con los datos principales.',
  `nif_cif` varchar(12) NOT NULL COMMENT 'Identificador del proveedor.',
  `razon_social` varchar(255) DEFAULT NULL COMMENT 'Razon social del comercil o NULL si con el "nombre y apellidos" del usuario es suficiente.',
  `telefono_comercio` varchar(25) NOT NULL,
  `telefono_contacto` varchar(25) NOT NULL,
  `url` text COMMENT 'Dirección web del comercio o NULL si no hay o no se conoce.',
  `fecha_alta` datetime DEFAULT NULL COMMENT 'Fecha y Hora de alta como proveedor, no como usuario o NULL si no se conoce por algún motivo (que no debería ser).'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id` int(12) UNSIGNED NOT NULL,
  `fecha_registro` datetime NOT NULL COMMENT 'Fecha y Hora del registro de acceso.',
  `clase_log_id` char(1) NOT NULL COMMENT 'código de clase de log: E=Error, A=Aviso, S=Seguimiento, I=Información, D=Depuración, ...',
  `modulo` varchar(50) DEFAULT 'app' COMMENT 'Modulo o Sección de la aplicación que ha generado el mensaje de registro.',
  `texto` text COMMENT 'Texto con el mensaje de registro.',
  `ip` varchar(40) DEFAULT NULL COMMENT 'Dirección IP desde donde accede el usuario (vale para IPv4 e IPv6.',
  `browser` text COMMENT 'Texto con información del navegador utilizado en el acceso.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(12) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'Correo Electronico y "login" del usuario.',
  `password` varchar(60) NOT NULL,
  `nick` varchar(25) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL COMMENT 'Fecha de nacimiento del usuario o NULL si no lo quiere informar.',
  `direccion` text COMMENT 'Direccion del usuario o NULL si no quiere informar.',
  `zona_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Area/Zona de localización del usuario o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable.',
  `fecha_registro` datetime DEFAULT NULL COMMENT 'Fecha y Hora de registro del usuario o NULL si no se conoce por algún motivo (que no debería ser).',
  `confirmado` tinyint(1) NOT NULL COMMENT 'Indicador de usuario ha confirmado su registro o no.',
  `fecha_acceso` datetime DEFAULT NULL COMMENT 'Fecha y Hora del ultimo acceso del usuario. Debería estar a NULL si no ha accedido nunca.',
  `num_accesos` int(9) NOT NULL DEFAULT '0' COMMENT 'Contador de accesos fallidos del usuario o CERO si no ha tenido o se ha reiniciado por un acceso valido o por un administrador.',
  `bloqueado` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de usuario bloqueado: 0=No, 1=Si(bloqueada por accesos), 2=Si(bloqueada por administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del usuario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` text COMMENT 'Notas visibles sobre el motivo del bloqueo del usuario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_anuncios`
--

CREATE TABLE `usuarios_anuncios` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado, seguidor del anuncio/oferta.',
  `anuncio_id` int(12) UNSIGNED NOT NULL COMMENT 'Anuncio/Oferta relacionada.',
  `fecha_seguimiento` datetime NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento del anuncio/oferta por parte del usuario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_area_moderacion`
--

CREATE TABLE `usuarios_area_moderacion` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado con un Area para su moderación.',
  `zona_id` int(12) UNSIGNED NOT NULL COMMENT 'Zona relacionada con el Usuario que puede moderarla.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_avisos`
--

CREATE TABLE `usuarios_avisos` (
  `id` int(12) UNSIGNED NOT NULL,
  `fecha_aviso` datetime NOT NULL COMMENT 'Fecha y Hora de creación del aviso.',
  `clase_aviso_id` char(1) NOT NULL DEFAULT 'M' COMMENT 'código de clase de aviso: A=Aviso, N=Notificación, D=Denuncia, C=Consulta, B=Bloqueo, M=Mensaje Genérico,...',
  `texto` text COMMENT 'Texto con el mensaje de aviso.',
  `destino_usuario_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Usuario relacionado, destinatario del aviso, o NULL si no es para administración y aún no está gestionado.',
  `origen_usuario_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Usuario relacionado, origen del aviso, o NULL si es del sistema.',
  `anuncio_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Anuncio/Oferta relacionada o NULL si no tiene que ver directamente.',
  `comentario_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Comentario relacionado o NULL si no tiene que ver directamente con un comentario.',
  `fecha_lectura` datetime DEFAULT NULL COMMENT 'Fecha y Hora de lectura del aviso o NULL si no se ha leido o se ha desmarcado como tal.',
  `fecha_aceptado` datetime DEFAULT NULL COMMENT 'Fecha y Hora de aceptación del aviso o NULL si no se ha aceptado para su gestión por un moderador o administrador. No se usa en otros usuarios.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_categorias`
--

CREATE TABLE `usuarios_categorias` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado.',
  `categoria_id` int(12) UNSIGNED NOT NULL COMMENT 'Categoria relacionada.',
  `fecha_seguimiento` datetime NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento de la categoria por parte del usuario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_etiquetas`
--

CREATE TABLE `usuarios_etiquetas` (
  `id` int(12) UNSIGNED NOT NULL,
  `usuario_id` int(12) UNSIGNED NOT NULL COMMENT 'Usuario relacionado.',
  `etiqueta_id` int(12) UNSIGNED NOT NULL COMMENT 'Etiqueta relacionada.',
  `fecha_seguimiento` datetime NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento de la etiqueta por parte del usuario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(12) UNSIGNED NOT NULL,
  `clase_zona_id` char(1) NOT NULL COMMENT 'Código de clase de la zona: 1=Continente, 2=Pais, 3=Estado, 4=Region, 5=Provincia, 6=Municipio, 7=Localidad, 8=Barrio, 9=Area, ...',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la zona que la identifica.',
  `zona_id` int(12) UNSIGNED DEFAULT '0' COMMENT 'Zona relacionada. Nodo padre de la jerarquia o CERO si es nodo raiz.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anuncios_comentarios`
--
ALTER TABLE `anuncios_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anuncios_etiquetas`
--
ALTER TABLE `anuncios_etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`variable`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nif_cif_UNIQUE` (`nif_cif`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `nick_UNIQUE` (`nick`);

--
-- Indices de la tabla `usuarios_anuncios`
--
ALTER TABLE `usuarios_anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_area_moderacion`
--
ALTER TABLE `usuarios_area_moderacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_avisos`
--
ALTER TABLE `usuarios_avisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_categorias`
--
ALTER TABLE `usuarios_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_etiquetas`
--
ALTER TABLE `usuarios_etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anuncios_comentarios`
--
ALTER TABLE `anuncios_comentarios`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anuncios_etiquetas`
--
ALTER TABLE `anuncios_etiquetas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios_anuncios`
--
ALTER TABLE `usuarios_anuncios`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_area_moderacion`
--
ALTER TABLE `usuarios_area_moderacion`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_avisos`
--
ALTER TABLE `usuarios_avisos`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_categorias`
--
ALTER TABLE `usuarios_categorias`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_etiquetas`
--
ALTER TABLE `usuarios_etiquetas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
