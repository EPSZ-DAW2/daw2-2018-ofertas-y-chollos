-- MySQL dump 10.16  Distrib 10.1.36-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: daw2_ofertas
-- ------------------------------------------------------
-- Server version	10.1.36-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anuncios`
--

DROP TABLE IF EXISTS `anuncios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anuncios` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL COMMENT 'Titulo corto o slogan para el anuncio u oferta.',
  `descripcion` text COMMENT 'Descripción breve del anuncio/oferta o NULL si no es necesaria.',
  `tienda` text COMMENT 'Descripcion de la tienda o lugar del anuncio/oferta o NULL si no se conoce, aunque no debería estar vacío este dato.',
  `url` text COMMENT 'Dirección web externa (opcional) que enlaza con la página "oficial" o directamente del anuncio/oferta o NULL si no hay o no se conoce.',
  `fecha_desde` datetime DEFAULT NULL COMMENT 'Fecha y Hora de inicio del anuncio/oferta o NULL si no se conoce (mostrar próximamente).',
  `fecha_hasta` datetime DEFAULT NULL COMMENT 'Fecha y Hora de finalización del anuncio/oferta o NULL si no se conoce (no caduca automaáticamente).',
  `precio_oferta` float NOT NULL DEFAULT '0' COMMENT 'Precio de la oferta.',
  `precio_original` float NOT NULL DEFAULT '0' COMMENT 'Precio original antes de la oferta.',
  `zona_id` int(12) unsigned DEFAULT '0' COMMENT 'Area/Zona de ubicación de la tienda del anuncio/oferta o CERO si no existe o aún no está indicada (como si fuera NULL).',
  `categoria_id` int(12) unsigned DEFAULT '0' COMMENT 'Categoria de clasificación del anuncio/oferta o CERO si no existe o aún no está indicada (como si fuera NULL).',
  `imagen_id` varchar(25) DEFAULT NULL COMMENT 'Nombre identificativo (fichero interno) con la imagen principal o "de presentación" del anuncio/oferta, o NULL si no hay.',
  `votosOK` int(9) NOT NULL DEFAULT '0' COMMENT 'Contador de votos a favor para el anuncio/oferta.',
  `votosKO` int(9) NOT NULL DEFAULT '0' COMMENT 'Contador de votos encontra para el anuncio/oferta.',
  `proveedor_id` int(12) unsigned DEFAULT '0' COMMENT 'Prveedor  del anuncio/oferta o CERO si no está patrocinado por nadie o no existe, o aún no está indicado (como si fuera NULL).',
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
  `crea_usuario_id` int(12) unsigned DEFAULT '0' COMMENT 'Usuario que ha creado el anuncio/oferta o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación del anuncio/oferta o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) unsigned DEFAULT '0' COMMENT 'Usuario que ha modificado el anuncio/oferta por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del anuncio/oferta o NULL si no se conoce por algún motivo.',
  `notas_admin` text COMMENT 'Notas adicionales para los moderadores/administradores sobre el anuncio/oferta o NULL si no hay.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncios`
--

LOCK TABLES `anuncios` WRITE;
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anuncios_comentarios`
--

DROP TABLE IF EXISTS `anuncios_comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anuncios_comentarios` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `anuncio_id` int(12) unsigned NOT NULL COMMENT 'Anuncio/Oferta relacionada',
  `texto` text NOT NULL COMMENT 'El texto del comentario.',
  `comentario_id` int(12) unsigned DEFAULT '0' COMMENT 'Comentario relacionado, si se permiten encadenar respuestas. Nodo padre de la jerarquia de comentarios, CERO si es nodo raiz.',
  `cerrado` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de cierre de los comentarios: 0=No, 1=Si(No se puede responder al comentario)',
  `num_denuncias` int(9) NOT NULL DEFAULT '0' COMMENT 'Contador de denuncias del comentario o CERO si no ha tenido.',
  `fecha_denuncia1` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.',
  `bloqueado` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de comentario bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del comentario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` text COMMENT 'Notas visibles sobre el motivo del bloqueo del comentario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.',
  `crea_usuario_id` int(12) unsigned DEFAULT '0' COMMENT 'Usuario que ha creado el comentario o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `crea_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de creación del comentario o NULL si no se conoce por algún motivo.',
  `modi_usuario_id` int(12) unsigned DEFAULT '0' COMMENT 'Usuario que ha modificado el comentario por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
  `modi_fecha` datetime DEFAULT NULL COMMENT 'Fecha y Hora de la última modificación del comentario o NULL si no se conoce por algún motivo.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncios_comentarios`
--

LOCK TABLES `anuncios_comentarios` WRITE;
/*!40000 ALTER TABLE `anuncios_comentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncios_comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anuncios_etiquetas`
--

DROP TABLE IF EXISTS `anuncios_etiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anuncios_etiquetas` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `anuncio_id` int(12) unsigned NOT NULL COMMENT 'Anuncio/oferta relacionada',
  `etiqueta_id` int(12) unsigned NOT NULL COMMENT 'Etiqueta relacionada.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncios_etiquetas`
--

LOCK TABLES `anuncios_etiquetas` WRITE;
/*!40000 ALTER TABLE `anuncios_etiquetas` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncios_etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('usuario','18',1547486659);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('admin',1,NULL,NULL,NULL,1547145986,1547145986),('buscar',2,'Buscar ofertas',NULL,NULL,1547145985,1547145985),('consultar',2,'Consultar oferta',NULL,NULL,1547145985,1547145985),('crear',2,'crear ofertas',NULL,NULL,1547145985,1547145985),('eliminar',2,'Eliminar oferta',NULL,NULL,1547145985,1547145985),('invitado',1,NULL,NULL,NULL,1547145985,1547145985),('moderador',1,NULL,NULL,NULL,1547145986,1547145986),('modificar',2,'Modificar oferta',NULL,NULL,1547145985,1547145985),('patrocinador',1,NULL,NULL,NULL,1547145986,1547145986),('sysadmin',1,NULL,NULL,NULL,1547145986,1547145986),('usuario',1,NULL,NULL,NULL,1547145986,1547145986);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('admin','moderador'),('admin','modificar'),('invitado','buscar'),('invitado','consultar'),('moderador','eliminar'),('moderador','usuario'),('patrocinador','usuario'),('sysadmin','admin'),('usuario','crear'),('usuario','invitado');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` text COMMENT 'Texto adicional que describe la categoria o clasificación.',
  `icono` varchar(25) DEFAULT NULL COMMENT 'Nombre del icono relacionado de entre los disponibles en la aplicación (carpeta iconos posibles).',
  `categoria_id` int(12) unsigned DEFAULT '0' COMMENT 'Categoria relacionada, para poder realizar la jerarquía de clasificaciones. Nodo padre de la jerarquía de categoría, o CERO si es nodo raiz (como si fuera NULL).',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Electrónica','Anuncios de electrónica y tecnología.','',0),(2,'Viajes','Ofertas de viajes.','',0),(5,'Avión','Ofertas de billetes de avión.','',2),(6,'Barco','Ofertas de cruceros o similar.','',2),(7,'Jardín','Productos de jardinería.','',0),(8,'Hogar','Productos para la casa y el hogar.','',0),(9,'Ropa','Productos de ropa, moda y accesorios.','',0),(10,'Accesorios de moda','Accesorios.','',9),(11,'Salud y belleza','Productos relacionados con la salud y la belleza.','',0),(12,'Vehículos','Ofertas de vehículos.','',0),(13,'Coches','Ofertas de coches.','',12),(14,'Motos','Ofertas de motos.','',12),(15,'Accesorios coche.','Ofertas de accesorios y productos para el coche.','',13),(16,'Accesorios motos','Accesorios y productos para motos.','',14),(17,'Cultura','Ofertas y gangas de cultura.','',0),(18,'Familia','Ofertas para familias.','',0),(19,'Gratuito','Ofertas de productos totalmente gratuitos.','',0),(20,'Deportes y aire libre','Oferta de productos deportivos y de aire libre.','',0),(21,'Supermercado','Ofertas de productos que pueden encontrarse en supermercados.','',0),(22,'Móviles','Ofertas de móviles.','',1),(23,'Ordenadores','Ofertas de ordenadores.','',1);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuraciones`
--

DROP TABLE IF EXISTS `configuraciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuraciones` (
  `variable` varchar(50) NOT NULL,
  `valor` text,
  PRIMARY KEY (`variable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuraciones`
--

LOCK TABLES `configuraciones` WRITE;
/*!40000 ALTER TABLE `configuraciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `configuraciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etiquetas`
--

DROP TABLE IF EXISTS `etiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etiquetas` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) DEFAULT NULL,
  `descripcion` text COMMENT 'Texto adicional que describe la etiqueta o NULL si no es necesario.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etiquetas`
--

LOCK TABLES `etiquetas` WRITE;
/*!40000 ALTER TABLE `etiquetas` DISABLE KEYS */;
/*!40000 ALTER TABLE `etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensajes` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL COMMENT 'Fecha y Hora de creación del mensaje.',
  `texto` text COMMENT 'Texto con el mensaje.',
  `origen_usuario_id` int(12) unsigned DEFAULT '0' COMMENT 'Usuario relacionado, origen del mensaje.',
  `destino_usuario_id` int(12) unsigned DEFAULT '0' COMMENT 'Usuario relacionado, destinatario del mensaje.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(12) unsigned NOT NULL COMMENT 'Usuario relacionado con los datos principales.',
  `nif_cif` varchar(12) NOT NULL COMMENT 'Identificador del proveedor.',
  `razon_social` varchar(255) DEFAULT NULL COMMENT 'Razon social del comercil o NULL si con el "nombre y apellidos" del usuario es suficiente.',
  `telefono_comercio` varchar(25) NOT NULL,
  `telefono_contacto` varchar(25) NOT NULL,
  `url` text COMMENT 'Dirección web del comercio o NULL si no hay o no se conoce.',
  `fecha_alta` datetime DEFAULT NULL COMMENT 'Fecha y Hora de alta como proveedor, no como usuario o NULL si no se conoce por algún motivo (que no debería ser).',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nif_cif_UNIQUE` (`nif_cif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registros`
--

DROP TABLE IF EXISTS `registros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registros` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_registro` datetime NOT NULL COMMENT 'Fecha y Hora del registro de acceso.',
  `clase_log_id` char(1) NOT NULL COMMENT 'código de clase de log: E=Error, A=Aviso, S=Seguimiento, I=Información, D=Depuración, ...',
  `modulo` varchar(50) DEFAULT 'app' COMMENT 'Modulo o Sección de la aplicación que ha generado el mensaje de registro.',
  `texto` text COMMENT 'Texto con el mensaje de registro.',
  `ip` varchar(40) DEFAULT NULL COMMENT 'Dirección IP desde donde accede el usuario (vale para IPv4 e IPv6.',
  `browser` text COMMENT 'Texto con información del navegador utilizado en el acceso.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registros`
--

LOCK TABLES `registros` WRITE;
/*!40000 ALTER TABLE `registros` DISABLE KEYS */;
/*!40000 ALTER TABLE `registros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL COMMENT 'Correo Electronico y "login" del usuario.',
  `password` varchar(60) NOT NULL,
  `nick` varchar(25) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL COMMENT 'Fecha de nacimiento del usuario o NULL si no lo quiere informar.',
  `direccion` text COMMENT 'Direccion del usuario o NULL si no quiere informar.',
  `zona_id` int(12) unsigned DEFAULT '0' COMMENT 'Area/Zona de localización del usuario o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable.',
  `fecha_registro` datetime DEFAULT NULL COMMENT 'Fecha y Hora de registro del usuario o NULL si no se conoce por algún motivo (que no debería ser).',
  `confirmado` tinyint(1) NOT NULL COMMENT 'Indicador de usuario ha confirmado su registro o no.',
  `fecha_acceso` datetime DEFAULT NULL COMMENT 'Fecha y Hora del ultimo acceso del usuario. Debería estar a NULL si no ha accedido nunca.',
  `num_accesos` int(9) NOT NULL DEFAULT '0' COMMENT 'Contador de accesos fallidos del usuario o CERO si no ha tenido o se ha reiniciado por un acceso valido o por un administrador.',
  `bloqueado` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicador de usuario bloqueado: 0=No, 1=Si(bloqueada por accesos), 2=Si(bloqueada por administrador), ...',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Fecha y Hora del bloqueo del usuario. Debería estar a NULL si no está bloqueado o si se desbloquea.',
  `notas_bloqueo` text COMMENT 'Notas visibles sobre el motivo del bloqueo del usuario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `nick_UNIQUE` (`nick`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (18,'joseigles@usal.es','21232f297a57a5a743894a0e4a801fc3','joseigles','Jose','iglesias','1995-05-29','iehk',0,'2019-01-14 18:24:19',1,NULL,0,0,NULL,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_anuncios`
--

DROP TABLE IF EXISTS `usuarios_anuncios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_anuncios` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(12) unsigned NOT NULL COMMENT 'Usuario relacionado, seguidor del anuncio/oferta.',
  `anuncio_id` int(12) unsigned NOT NULL COMMENT 'Anuncio/Oferta relacionada.',
  `fecha_seguimiento` datetime NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento del anuncio/oferta por parte del usuario.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_anuncios`
--

LOCK TABLES `usuarios_anuncios` WRITE;
/*!40000 ALTER TABLE `usuarios_anuncios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_anuncios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_area_moderacion`
--

DROP TABLE IF EXISTS `usuarios_area_moderacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_area_moderacion` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(12) unsigned NOT NULL COMMENT 'Usuario relacionado con un Area para su moderación.',
  `zona_id` int(12) unsigned NOT NULL COMMENT 'Zona relacionada con el Usuario que puede moderarla.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_area_moderacion`
--

LOCK TABLES `usuarios_area_moderacion` WRITE;
/*!40000 ALTER TABLE `usuarios_area_moderacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_area_moderacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_avisos`
--

DROP TABLE IF EXISTS `usuarios_avisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_avisos` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_aviso` datetime NOT NULL COMMENT 'Fecha y Hora de creación del aviso.',
  `clase_aviso_id` char(1) NOT NULL DEFAULT 'M' COMMENT 'código de clase de aviso: A=Aviso, N=Notificación, D=Denuncia, C=Consulta, B=Bloqueo, M=Mensaje Genérico,...',
  `texto` text COMMENT 'Texto con el mensaje de aviso.',
  `destino_usuario_id` int(12) unsigned DEFAULT '0' COMMENT 'Usuario relacionado, destinatario del aviso, o NULL si no es para administración y aún no está gestionado.',
  `origen_usuario_id` int(12) unsigned DEFAULT '0' COMMENT 'Usuario relacionado, origen del aviso, o NULL si es del sistema.',
  `anuncio_id` int(12) unsigned DEFAULT '0' COMMENT 'Anuncio/Oferta relacionada o NULL si no tiene que ver directamente.',
  `comentario_id` int(12) unsigned DEFAULT '0' COMMENT 'Comentario relacionado o NULL si no tiene que ver directamente con un comentario.',
  `fecha_lectura` datetime DEFAULT NULL COMMENT 'Fecha y Hora de lectura del aviso o NULL si no se ha leido o se ha desmarcado como tal.',
  `fecha_aceptado` datetime DEFAULT NULL COMMENT 'Fecha y Hora de aceptación del aviso o NULL si no se ha aceptado para su gestión por un moderador o administrador. No se usa en otros usuarios.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_avisos`
--

LOCK TABLES `usuarios_avisos` WRITE;
/*!40000 ALTER TABLE `usuarios_avisos` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_avisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_categorias`
--

DROP TABLE IF EXISTS `usuarios_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_categorias` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(12) unsigned NOT NULL COMMENT 'Usuario relacionado.',
  `categoria_id` int(12) unsigned NOT NULL COMMENT 'Categoria relacionada.',
  `fecha_seguimiento` datetime NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento de la categoria por parte del usuario.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_categorias`
--

LOCK TABLES `usuarios_categorias` WRITE;
/*!40000 ALTER TABLE `usuarios_categorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_etiquetas`
--

DROP TABLE IF EXISTS `usuarios_etiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_etiquetas` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(12) unsigned NOT NULL COMMENT 'Usuario relacionado.',
  `etiqueta_id` int(12) unsigned NOT NULL COMMENT 'Etiqueta relacionada.',
  `fecha_seguimiento` datetime NOT NULL COMMENT 'Fecha y Hora de activación del seguimiento de la etiqueta por parte del usuario.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_etiquetas`
--

LOCK TABLES `usuarios_etiquetas` WRITE;
/*!40000 ALTER TABLE `usuarios_etiquetas` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zonas`
--

DROP TABLE IF EXISTS `zonas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zonas` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `clase_zona_id` char(1) NOT NULL COMMENT 'Código de clase de la zona: 1=Continente, 2=Pais, 3=Estado, 4=Region, 5=Provincia, 6=Municipio, 7=Localidad, 8=Barrio, 9=Area, ...',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la zona que la identifica.',
  `zona_id` int(12) unsigned DEFAULT '0' COMMENT 'Zona relacionada. Nodo padre de la jerarquia o CERO si es nodo raiz.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zonas`
--

LOCK TABLES `zonas` WRITE;
/*!40000 ALTER TABLE `zonas` DISABLE KEYS */;
/*!40000 ALTER TABLE `zonas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-14 20:22:13
