
--
-- Volcado de datos para la tabla `categorias`
--
USE `daw2_ofertas`

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `icono`, `categoria_id`) VALUES
(1, 'Electrónica', 'Anuncios de electrónica y tecnología.', '', 0),
(2, 'Viajes', 'Ofertas de viajes.', '', 0),
(5, 'Avión', 'Ofertas de billetes de avión.', '', 2),
(6, 'Barco', 'Ofertas de cruceros o similar.', '', 2),
(7, 'Jardín', 'Productos de jardinería.', '', 0),
(8, 'Hogar', 'Productos para la casa y el hogar.', '', 0),
(9, 'Ropa', 'Productos de ropa, moda y accesorios.', '', 0),
(10, 'Accesorios de moda', 'Accesorios.', '', 9),
(11, 'Salud y belleza', 'Productos relacionados con la salud y la belleza.', '', 0),
(12, 'Vehículos', 'Ofertas de vehículos.', '', 0),
(13, 'Coches', 'Ofertas de coches.', '', 12),
(14, 'Motos', 'Ofertas de motos.', '', 12),
(15, 'Accesorios coche.', 'Ofertas de accesorios y productos para el coche.', '', 13),
(16, 'Accesorios motos', 'Accesorios y productos para motos.', '', 14),
(17, 'Cultura', 'Ofertas y gangas de cultura.', '', 0),
(18, 'Familia', 'Ofertas para familias.', '', 0),
(19, 'Gratuito', 'Ofertas de productos totalmente gratuitos.', '', 0),
(20, 'Deportes y aire libre', 'Oferta de productos deportivos y de aire libre.', '', 0),
(21, 'Supermercado', 'Ofertas de productos que pueden encontrarse en supermercados.', '', 0),
(22, 'Móviles', 'Ofertas de móviles.', '', 1),
(23, 'Ordenadores', 'Ofertas de ordenadores.', '', 1);


