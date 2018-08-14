-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-08-2018 a las 13:27:30
-- Versión del servidor: 5.6.39
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `codigosa_ventas_quicheladas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `operacion` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `efectivo` decimal(10,2) NOT NULL,
  `observacion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `fecha`, `monto`, `operacion`, `usuario_id`, `efectivo`, `observacion`) VALUES
(7, '2018-03-30 12:52:27', '1000.00', 1, 4, '0.00', ''),
(8, '2018-04-01 15:15:05', '955.00', 1, 4, '0.00', ''),
(9, '2018-05-01 14:42:33', '550.00', 1, 1, '0.00', ''),
(10, '2018-05-03 12:38:34', '400.00', 1, 1, '0.00', ''),
(11, '2018-05-03 19:06:39', '505.00', 2, 5, '500.00', 'Cuadre de Caja no conforme'),
(12, '2018-05-17 23:47:37', '300.00', 1, 5, '0.00', ''),
(13, '2018-05-17 23:50:04', '440.00', 2, 5, '440.00', 'Cuadre de Caja conforme'),
(14, '2018-05-23 15:04:13', '300.00', 1, 5, '0.00', ''),
(15, '2018-05-23 15:04:41', '1006.00', 2, 5, '800.00', 'Cuadre de Caja no conforme');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `estado`) VALUES
(4, 'Panes', 'Panes', 1),
(5, 'Boquitas', 'Acompañamientos', 1),
(6, 'Pizzas', 'Artesanales', 1),
(7, 'Caldos', 'Caldos', 1),
(8, 'Quesadillas', 'Quesadillas', 1),
(9, 'Tortillas', 'Tacos o Tortillas', 1),
(10, 'Gallo', 'Cervecería Nacional', 1),
(11, 'Pepsi', 'Distribuidora ', 1),
(12, 'Licor', 'Cervecería Nacional', 1),
(13, 'Tragos ', 'Licor Preparado', 1),
(14, 'Plato Fuerte', 'Platos Fuertes', 1),
(15, 'Ceviches', 'Ceviches', 1),
(16, 'Coca Cola', 'Gaseosa', 1),
(17, 'Ofertas', 'Cerveza', 1),
(18, 'Bebidas Calientes', 'Bebida', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `tipo_cliente_id` int(11) DEFAULT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `num_documento` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `telefono`, `direccion`, `tipo_cliente_id`, `tipo_documento_id`, `num_documento`, `estado`) VALUES
(8, 'cuñado', '', '', 1, 1, '00', 1),
(9, 'pika', '', '', 1, 1, '1321654353', 1),
(10, 'mesa 2', '', '', 1, 1, '1321354', 1),
(11, 'mesa 3', '', '', 1, 1, '21231354', 1),
(12, 'mesa 13', '', '', 1, 1, '213454', 1),
(13, 'mesa 1', '', '', 1, 1, '112', 1),
(14, 'mesa 4', '', '', 1, 1, '12', 1),
(15, 'mesa 5', '', '', 1, 1, '212', 1),
(16, 'mesa 6', '', '', 1, 1, '123154', 1),
(17, 'Mesa 7', '', '', 1, 1, '1254684', 1),
(18, 'mesa 8', '', '', 1, 1, '346545614', 1),
(19, 'mesa 9', '', '', 1, 1, '15458465', 1),
(20, 'mesa 10', '', '', 1, 1, '12514', 1),
(21, 'mesa 11', '', '', 1, 1, '5498741', 1),
(22, 'mesa 12', '', '', 1, 1, '1351541510', 1),
(23, 'mesa 13', '', '', 1, 1, '3516547894', 1),
(24, 'mesa 14', '', '', 1, 1, '326541', 1),
(25, 'mesa 15', '', '', 1, 1, '3216546512', 1),
(26, 'mesa 16', '', '', 1, 1, '65684984', 1),
(27, 'mesa 17', '', '', 1, 1, '154541', 1),
(28, 'mesa 18', '', '', 1, 1, '52458465', 1),
(29, 'mesa 19', '', '', 1, 1, '2654874', 1),
(30, 'mesa 20', '', '', 1, 1, '521548', 1),
(31, 'Gary Cano', '', '', 1, 1, '1824222831401', 1),
(32, 'Palomo', '', '', 1, 1, '000000', 1),
(33, 'xavi', '', '', 1, 1, '1565846', 1),
(34, 'xavi', '', '', 1, 1, '1565846', 1),
(35, 'Barra 1', '', '', 1, 1, '2154', 1),
(36, 'chicha', '', '', 1, 1, '2135434', 1),
(37, 'mesa 5 afuera', '', '', 1, 1, '313214354534', 1),
(38, 'mesa 2 afuera', '', '', 1, 1, '131641345', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `precio` varchar(45) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `importe` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `producto_id`, `venta_id`, `precio`, `cantidad`, `importe`) VALUES
(201, 122, 45, '15.00', '4', '60.00'),
(202, 39, 45, '30.00', '2', '60.00'),
(203, 86, 46, '10.00', '3', '30.00'),
(204, 47, 47, '25.00', '1', '25.00'),
(205, 122, 47, '15.00', '2', '30.00'),
(206, 120, 47, '8.00', '1', '8.00'),
(207, 11, 48, '20.00', '1', '20.00'),
(208, 76, 48, '14.00', '3', '42.00'),
(209, 79, 49, '22.00', '3', '66.00'),
(210, 9, 50, '35.00', '1', '35.00'),
(211, 123, 51, '15.00', '2', '30.00'),
(212, 47, 52, '25.00', '1', '25.00'),
(213, 9, 53, '35.00', '1', '35.00'),
(214, 9, 53, '35.00', '1', '35.00'),
(215, 55, 54, '80.00', '3', '240.00'),
(216, 76, 54, '14.00', '3', '42.00'),
(217, 75, 54, '14.00', '6', '84.00'),
(218, 88, 54, '35.00', '1', '35.00'),
(219, 14, 54, '15.00', '4', '60.00'),
(220, 11, 54, '20.00', '1', '20.00'),
(221, 128, 55, '35.00', '1', '35.00'),
(222, 85, 55, '30.00', '4', '120.00'),
(223, 90, 56, '35.00', '1', '35.00'),
(224, 76, 56, '14.00', '3', '42.00'),
(225, 76, 56, '14.00', '3', '42.00'),
(226, 87, 56, '18.00', '3', '54.00'),
(227, 87, 57, '18.00', '1', '18.00'),
(228, 47, 57, '25.00', '1', '25.00'),
(229, 51, 57, '15.00', '1', '15.00'),
(230, 12, 58, '30.00', '1', '30.00'),
(231, 89, 58, '18.00', '1', '18.00'),
(232, 52, 58, '60.00', '1', '60.00'),
(233, 9, 59, '35.00', '1', '35.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `parent` varchar(10) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `nombre`, `link`, `parent`, `orden`) VALUES
(1, 'Inicio', 'dashboard', '0', 1),
(2, 'Categorias', 'mantenimiento/categorias', '9', 0),
(3, 'Clientes', 'mantenimiento/clientes', '9', 0),
(4, 'Productos', 'mantenimiento/productos', '9', 0),
(5, 'Ventas', 'movimientos/ventas', '10', 0),
(6, 'Reporte Ventas', 'reportes/ventas', '11', 0),
(7, 'Usuarios', 'administrador/usuarios', '12', 0),
(8, 'Permisos', 'administrador/permisos', '12', 0),
(9, 'Mantenimiento', '#', '0', 3),
(10, 'Movimientos', '#', '0', 5),
(11, 'Reportes', '#', '0', 6),
(12, 'Administrador', '#', '0', 7),
(13, 'Configuraciones', '#', '0', 0),
(14, 'Apertura de Caja', 'caja/apertura', '15', 0),
(15, 'Caja', '#', '0', 4),
(16, 'Cierre de Caja', 'caja/cierre', '15', 0),
(17, 'Inventario', 'inventario', '0', 2),
(18, 'Ordenes', 'movimientos/ordenes', '10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `numero`, `estado`) VALUES
(1, '01', 1),
(2, '02', 0),
(3, '03', 0),
(4, '04', 0),
(5, '05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `producto_id`, `estado`) VALUES
(1, 77, 1),
(2, 77, 0),
(3, 77, 1),
(4, 77, 1),
(5, 77, 1),
(6, 77, 1),
(7, 77, 0),
(8, 77, 0),
(9, 77, 0),
(10, 77, 1),
(11, 77, 0),
(12, 77, 1),
(13, 77, 1),
(14, 77, 1),
(15, 77, 1),
(16, 77, 0),
(17, 77, 1),
(18, 77, 1),
(19, 77, 1),
(20, 77, 1),
(21, 123, 0),
(22, 123, 0),
(23, 85, 0),
(24, 85, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `usuario_id`, `estado`) VALUES
(12, '2018-05-17', 5, 0),
(13, '2018-05-18', 5, 0),
(14, '2018-05-18', 5, 0),
(15, '2018-05-18', 5, 1),
(16, '2018-05-18', 5, 0),
(17, '2018-05-23', 5, 0),
(18, '2018-05-23', 5, 1),
(19, '2018-05-24', 5, 0),
(20, '2018-05-30', 5, 0),
(21, '2018-05-30', 5, 1),
(22, '2018-06-05', 5, 1),
(23, '2018-06-05', 5, 1),
(24, '2018-06-05', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_mesa`
--

CREATE TABLE `pedidos_mesa` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `mesa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos_mesa`
--

INSERT INTO `pedidos_mesa` (`id`, `pedido_id`, `mesa_id`) VALUES
(23, 12, 4),
(24, 12, 0),
(25, 13, 4),
(26, 14, 4),
(27, 15, 2),
(28, 16, 1),
(29, 16, 0),
(30, 15, 1),
(31, 15, 0),
(32, 17, 3),
(33, 18, 4),
(34, 18, 0),
(35, 18, 5),
(36, 19, 3),
(37, 19, 0),
(38, 20, 3),
(39, 21, 3),
(40, 21, 0),
(41, 22, 2),
(42, 23, 3),
(43, 24, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `pedido_id`, `producto_id`, `cantidad`, `estado`) VALUES
(53, 12, 122, 4, 1),
(54, 12, 39, 2, 1),
(55, 12, 86, 3, 1),
(56, 13, 47, 1, 1),
(57, 13, 122, 2, 1),
(58, 13, 120, 1, 1),
(59, 14, 11, 1, 1),
(60, 14, 76, 3, 1),
(61, 14, 79, 3, 1),
(65, 16, 9, 1, 1),
(66, 16, 123, 2, 1),
(68, 15, 47, 1, 1),
(69, 15, 87, 1, 0),
(70, 15, 88, 1, 0),
(71, 15, 90, 1, 0),
(72, 17, 9, 1, 1),
(73, 17, 9, 1, 1),
(92, 18, 75, 5, 0),
(93, 18, 55, 2, 0),
(94, 18, 89, 4, 0),
(95, 18, 17, 3, 0),
(96, 18, 75, 6, 0),
(97, 18, 76, 3, 0),
(98, 18, 76, 3, 0),
(99, 18, 76, 3, 0),
(100, 18, 85, 4, 0),
(101, 18, 55, 3, 0),
(102, 18, 90, 1, 0),
(103, 18, 88, 1, 0),
(104, 18, 87, 3, 0),
(105, 18, 14, 4, 0),
(106, 18, 11, 1, 0),
(107, 18, 128, 1, 0),
(111, 19, 12, 1, 1),
(112, 19, 87, 1, 1),
(113, 19, 89, 1, 1),
(114, 19, 47, 1, 1),
(115, 19, 51, 1, 1),
(116, 19, 52, 1, 1),
(117, 20, 9, 1, 1),
(120, 21, 9, 1, 0),
(121, 21, 75, 8, 0),
(122, 22, 40, 2, 0),
(123, 22, 28, 2, 0),
(124, 23, 39, 1, 0),
(125, 24, 28, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `read` int(11) DEFAULT NULL,
  `insert` int(11) DEFAULT NULL,
  `update` int(11) DEFAULT NULL,
  `delete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `menu_id`, `rol_id`, `read`, `insert`, `update`, `delete`) VALUES
(1, 1, 2, 1, 1, 1, 1),
(2, 2, 2, 1, 1, 1, 0),
(3, 3, 2, 1, 1, 1, 0),
(4, 4, 2, 1, 1, 1, 0),
(5, 5, 2, 1, 1, 1, 1),
(10, 1, 1, 1, 1, 1, 1),
(11, 2, 1, 1, 1, 1, 1),
(12, 4, 1, 1, 1, 1, 1),
(13, 5, 1, 1, 1, 1, 1),
(14, 6, 1, 1, 1, 1, 1),
(15, 7, 1, 1, 1, 1, 1),
(16, 3, 1, 1, 1, 1, 1),
(17, 8, 1, 1, 1, 1, 1),
(18, 9, 1, 1, 1, 1, 1),
(19, 10, 1, 1, 1, 1, 1),
(20, 11, 1, 1, 1, 1, 1),
(21, 12, 1, 1, 1, 1, 1),
(23, 9, 2, 1, 1, 1, 1),
(24, 10, 2, 1, 1, 1, 1),
(25, 15, 1, 1, 1, 1, 1),
(26, 14, 1, 1, 1, 1, 1),
(27, 16, 1, 1, 1, 1, 1),
(28, 14, 2, 1, 1, 1, 1),
(29, 16, 2, 1, 1, 1, 1),
(30, 17, 1, 1, 1, 1, 1),
(31, 18, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `precio` varchar(45) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `stock_minimo` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL,
  `asociado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `precio`, `stock`, `stock_minimo`, `categoria_id`, `estado`, `condicion`, `asociado`) VALUES
(9, 'PanPo', 'Pan con Pollo', 'Delicioso pan Chapata con pollo, aguacate y queso, acompañado de unas deliciosas papas Crinkle.', '35.00', 1, 0, 4, 1, 0, 0),
(10, 'PanCa', 'Pan con Carne', 'Delicioso Pan Chapata con carne, aguacate y queso, acompañado de unas deliciosas papas Crinkle', '45.00', 1, 0, 4, 1, 0, 0),
(11, 'ArCe', 'Aros de Cebolla', 'Deliciosos Aros de Cebolla con Aderezo de la casa (15 Aprox.)', '20.00', 2, 0, 5, 1, 0, 0),
(12, 'Ali', 'Alitas', 'Deliciosas Alitas de Pollo bañadas en Barbacoa o simples, acompañadas de nuestro delicioso aderezo de la Casa, acompañados de Apio y Zanahoria (7 uni. Aprox.)', '30.00', 2, 0, 5, 1, 0, 0),
(13, 'AliPa', 'Alitas con Papas', 'Deliciosas Alitas de Pollo bañadas en Barbacoa o simples, acompañadas de nuestro delicioso aderezo de la Casa, acompañado de Papas fritas. (7 uni. Aprox.)', '40.00', 1, 0, 5, 1, 0, 0),
(14, 'Pap', 'Papas Fritas', 'Papas', '15.00', 2, 0, 5, 1, 0, 0),
(15, 'Pechu', 'Pechuguitas', 'Deliciosas Pechuguitas de Pollo acompañadas de Papas Fritas.', '30.00', 2, 0, 5, 1, 0, 0),
(16, 'PlaMx', 'Plato Mixto de Boquitas', 'Ideal para compartir con los Quichelamigos, disfrutando de Alitas, Pechuguitas, Papas fritas o Aros de Cebolla.', '45.00', 1, 0, 5, 1, 0, 0),
(17, 'Mo', 'Mollejas personal', 'Deliciosas Mollejas empanizadas, exquisitamente preparadas para ti.', '15.00', 1, 0, 5, 1, 0, 0),
(18, 'MoC', 'Mollejas Pa´Compartir', 'Deliciosas Mollejitas solamente empanizadas o si deseas preparadas para compartir con los Quichelamigos.', '40.00', 1, 0, 5, 1, 0, 0),
(19, 'EnsCam', 'Ensalada de Camaron', 'Ensalada con Camaron Precocido, preparado especialmente para ti.', '20.00', 1, 0, 5, 1, 0, 0),
(20, 'CamEmp1', 'Camaron Empanizado ', 'Camarones Pelados y desvenados totalmente empanizados acompañados de Arroz, Guacamole y Pan tostado con mantequilla o tortillas.', '45.00', 1, 0, 14, 1, 0, 0),
(21, 'CamEmpP', ' Camaron Empanizado Pequeño', 'Cmarones pelados y desvenados totalmente empanizados.', '25.00', 1, 0, 5, 1, 0, 0),
(22, 'CamEmpG', 'Camaron Empanizado Pa´Compartir', 'Camarones pelados y desvenados totalmente empanizados, pa´Compartir con tus Quichelamigos', '60.00', 1, 0, 5, 1, 0, 0),
(23, 'Quimon', 'Quichemon', 'Famoso Pan de la Casa, elaborado sobre Pan Chapata con Jamon, queso, tomate y cebolla, con el delicioso aderezo de la casa y lechuga, acompañado de Papas Crinkle.', '30.00', 1, 0, 4, 1, 0, 0),
(24, 'Papo', 'Papotas', 'Delicosas Papotas para compartir solo o acompañado.', '20.00', 1, 0, 5, 1, 0, 0),
(25, 'PapB', 'Papas con Barbacoa', 'Deliciosas Papas fritas con barbacoa.', '18.00', 1, 0, 5, 1, 0, 0),
(26, 'TaCam 1', 'Tacos de Camaron (2 uni.)', 'Deliciosos tacos de Camaron con ajo y chile guaque, acompañado de pico de gallo.', '25.00', 1, 0, 14, 1, 0, 0),
(27, 'TaCam2', 'Tacos de Camaron (3 uni.)', 'Deliciosos tacos de Camaron con ajo y chile guaque, acompañado de pico de gallo.', '35.00', 1, 0, 14, 1, 0, 0),
(28, 'CalTl', 'Caldo Tlalpeño', 'Delicioso Caldo Mexicano, acompañado de picado de tomate, cebolla, cilantro y aguacate. ', '35.00', 1, 0, 7, 1, 0, 0),
(29, 'CalTQ', 'Caldo Tlalpeño+Quichelada Gallo', 'Delicioso Caldo Mexicano, acompañado de picado de tomate, cebolla, cilantro y aguacate. ', '48', 1, 0, 7, 1, 0, 0),
(30, 'TC', 'Tortilla con Chorizo', '2 tortillas con Chorizo sobre Guacamole.', '12.00', 1, 0, 9, 1, 0, 0),
(31, 'TL', 'Tortilla con Longaniza', '2 tortillas con Longaniza sobre Guacamole.', '12.00', 1, 0, 9, 1, 0, 0),
(32, 'TS', 'Tortilla Suprema', '2 tortillas con Chorizo y Longaniza sobre Guacamole, queso derretido y lechuga.', '20.00', 1, 0, 9, 1, 0, 0),
(33, 'Tmx', 'Tortilla Mixta', '2 tortillas con Chorizo y Longaniza sobre Guacamole.', '16.00', 1, 0, 9, 0, 0, 0),
(36, 'Tortilla mixta.', 'Tortilla Mixta de Chorizo y longaniza', 'tortillas con chorizo y longaniza', '16.00', 1, 0, 9, 1, 0, 0),
(37, 'Concha25', 'Tablazo de Conchas', 'Tablazo', '25.00', 1, 0, 5, 1, 0, 0),
(38, 'tabla30', 'Tablazo de Conchas 3', 'tablazo de 3', '30.00', 1, 0, 5, 1, 0, 0),
(39, 'QueP', 'Quesadilla de Pollo', 'Quesadillas', '30.00', 1, 0, 8, 1, 0, 0),
(40, 'QueC', 'Quesadilla de Carne', 'Quesadillas', '30.00', 1, 0, 8, 1, 0, 0),
(41, 'PinC', 'Pincho de Carne', 'Pincho', '15.00', 1, 0, 5, 1, 0, 0),
(42, 'PinP', 'Pincho de Pollo', 'Pincho', '15.00', 1, 0, 5, 1, 0, 0),
(43, 'PinMx', 'Pincho de Pollo y Carne', 'Pincho', '15.00', 1, 0, 5, 1, 0, 0),
(44, 'ChoPa', 'Choripapas', 'Papas Fritas con Chorizo', '22.00', 1, 0, 5, 1, 0, 0),
(45, 'Band', 'Banderillas', 'Salchicha empanizada', '10.00', 1, 0, 5, 1, 0, 0),
(46, 'Nac', 'Nachos con Carne y Queso', 'Nachos con carne y queso', '20.00', 1, 0, 5, 1, 0, 0),
(47, 'PiP', 'Pizza personal de 1 ingrediente', 'Pizza', '25.00', 1, 0, 6, 1, 0, 0),
(48, 'PiPG', 'Pizza Personal de 1 ingrediente con Coca Cola 12onz.', 'Pizza', '30.00', 1, 0, 6, 1, 0, 0),
(49, 'PipQ', 'Pizza Personal de 1 ingrediente con Quichelada Gallo', 'Pizza', '38.00', 1, 0, 6, 1, 0, 0),
(50, 'InEx', 'Ingrediente Extra de Pizza', 'Pizza', '5.00', 1, 0, 6, 1, 0, 0),
(51, 'Quesox', 'Queso Extra para Pizza', 'Pizza', '15.00', 1, 0, 6, 1, 0, 0),
(52, 'PiM', 'Pizza Mediana de 1 Ingrediente', 'Pizza', '60.00', 1, 0, 6, 1, 0, 0),
(53, 'PiG', 'Pizza Grande de 1 Ingrediente', 'Pizza', '75.00', 1, 0, 6, 1, 0, 0),
(54, 'PiMCh', 'Pizza Mediana Chorilonga', 'Pizza', '65.00', 1, 0, 6, 1, 0, 0),
(55, 'PiGCh', 'Pizza Grande Chorilonga', 'Pizza', '80.00', 1, 0, 6, 1, 0, 0),
(56, 'PiMPi', 'Pizza Mediana Pizzerola', 'Pizza', '70.00', 1, 0, 6, 1, 0, 0),
(57, 'PiGPi', 'Pizza Grande Pizzerola', 'Pizza', '90.00', 1, 0, 6, 1, 0, 0),
(58, 'PiMJ', 'Pizza Mediana de Jalamon', 'Jalapeño y Jamon', '65.00', 1, 0, 6, 1, 0, 0),
(59, 'PiGJ', 'Pizza Grande Jalamon', 'Jalapeño y Jamon', '80.00', 1, 0, 6, 1, 0, 0),
(60, 'CevP', 'Ceviche Pequeño', 'Ceviches', '26.00', 1, 0, 15, 1, 0, 0),
(61, 'CevPM', 'Ceviche Pequeño Mixto ', 'Ceviches', '32.00', 1, 0, 15, 1, 0, 0),
(62, 'CevM', 'Ceviche Mediano', 'Ceviches', '36.00', 1, 0, 15, 1, 0, 0),
(63, 'CevMxM', 'Ceviche Mediano Mixto', 'Ceviches', '42.00', 1, 0, 15, 1, 0, 0),
(64, 'CevG', 'Ceviche Grande', 'Ceviches', '46.00', 1, 0, 15, 1, 0, 0),
(65, 'CevGMx', 'Ceviche Grande Mixto', 'Ceviches', '52.00', 1, 0, 15, 1, 0, 0),
(66, 'Coro', 'Corona 12 onz.', 'Cerveza', '16.00', 240, 120, 11, 1, 1, 0),
(67, 'ModVi', 'Modelo Vidrio 12 onz', 'Cerveza', '16.00', 60, 30, 11, 1, 1, 0),
(68, 'ModLa', 'Modelo Lata 12 onz.', 'Cerveza', '14.00', 270, 120, 11, 1, 1, 0),
(69, 'Pep', 'Pepsi 12 onz', 'Gaseosa', '10.00', 6, 12, 11, 1, 1, 0),
(70, '7', '7up 12 onz.', 'Gaseosa', '10.00', 43, 48, 11, 1, 1, 0),
(71, 'Grap', 'Grapette 12 onz.', 'Gaseosa', '10.00', 5, 12, 11, 1, 1, 0),
(72, 'Mir', 'Mirinda 12 onz.', 'Gaseosa', '10.00', 5, 12, 11, 1, 1, 0),
(74, 'Gat', 'Gatorade 12onz.', 'Bebida', '12.00', 19, 12, 11, 1, 1, 0),
(75, 'GB12', 'Gallo Botella 12onz.', 'Cerveza', '14.00', 493, 300, 10, 1, 1, 0),
(76, 'GL12', 'Gallo Lata 12onz.', 'Cerveza', '14.00', 457, 150, 10, 1, 1, 0),
(77, 'Cab12', 'Cabro Extra Botella 12onz.', 'Cerveza', '14.00', 92, 120, 10, 1, 1, 0),
(78, 'CabR12', 'Cabro Reserva 12onz.', 'Cerveza', '20.00', 65, 45, 10, 1, 1, 0),
(79, 'Hei12', 'Heineken 12onz.', 'Cerveza', '22.00', 48, 45, 10, 1, 1, 0),
(80, 'DD12', 'Dorada Draft 12onz.', 'Cerveza', '16.00', 46, 45, 10, 1, 1, 0),
(81, 'Min12', 'Mineral 12onz.', 'Gaseosa', '10.00', 82, 50, 10, 1, 1, 0),
(82, 'Bac12', 'Bacardi 12onz.', 'licor', '17.00', 48, 35, 10, 1, 1, 0),
(83, 'MC12', 'Monte Carlo 12onz.', 'Cerveza', '20.00', 47, 45, 10, 1, 1, 0),
(84, 'LC', 'Litro Cabro', 'Cerveza', '30.00', 37, 25, 10, 1, 1, 0),
(85, 'LG', 'Litro Gallo', 'Cerveza', '30.00', 23, 25, 10, 1, 1, 0),
(86, 'CC12', 'Coca Cola 12onz.', 'Gaseosa', '10.00', 129, 80, 16, 1, 1, 0),
(87, 'QG1', 'Quichelada Gallo 12onz.', 'Cerveza', '18.00', 2, 0, 17, 1, 0, 0),
(88, 'QG2', 'Quichelada de Gallo Oferta', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0),
(89, 'QM1', 'Quichelada Modelo lata 12onz.', 'Cerveza', '18.00', 1, 0, 17, 1, 0, 0),
(90, 'QM2', 'Quichelada Modelo Oferta', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0),
(91, 'QC1', 'Quichelada Cabro Extra 12onz.', 'Cerveza', '18.00', 1, 0, 17, 1, 0, 0),
(92, 'QC2', 'Quichelada Cabro Extra Oferta 12onz.', 'Cerveza', '35.00', 3, 0, 17, 1, 0, 0),
(93, 'QCo1', 'Quichelada Corona 12onz.', 'Cerveza', '20.00', 1, 0, 17, 1, 0, 0),
(94, 'QCo2', 'Quichelada Corono Oferta 12onz.', 'Cerveza', '38.00', 1, 0, 4, 1, 0, 0),
(95, 'QMC1', 'Quichelada Monte Carlo 12onz.', 'Cerveza', '25.00', 1, 0, 17, 1, 0, 0),
(98, 'QMC2', 'Quichelada Monte Carlo Oferta 12onz.', 'Cerveza', '45.00', 1, 0, 17, 1, 0, 0),
(99, 'QDD1', 'Quichelada Dorada Draft 12onz.', 'Cerveza', '20.00', 1, 0, 17, 1, 0, 0),
(100, 'QDD2', 'Quichelada Dorada Draft Oferta 12onz.', 'Cerveza', '38.00', 1, 0, 17, 1, 0, 0),
(101, 'QCR1', 'Quichelada Cabro Reserva 12onz.', 'Cerveza', '25.00', 1, 0, 17, 1, 0, 0),
(102, 'QCR2', 'Quichelada Cabro Reserva Oferta 12onz.', 'Cerveza', '45.00', 1, 0, 17, 1, 0, 0),
(103, 'Men', 'Mentirosa', 'Quichelada Mineral', '15.00', 1, 0, 17, 1, 0, 0),
(104, 'PiM1', 'Picosita Modelo lata 12onz.', 'Cerveza', '18.00', 1, 0, 17, 1, 0, 0),
(105, 'PiM2', 'Picosita Modelo Lata 12onz. Oferta', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0),
(106, 'PiG1', 'Picosita Gallo 12onz.', 'Cerveza', '18.00', 1, 0, 17, 1, 0, 0),
(107, 'PiG2', 'Picosita Gallo Lata 12onz. Oferta', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0),
(108, 'CaCE1', 'Cachuda Cabro Extra 12onz.', 'Cerveza', '18.00', 1, 0, 17, 1, 0, 0),
(109, 'CaCE2', 'Cachuda Cabro Extra Oferta 12onz.', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0),
(110, 'CaCo1', 'Cachuda Corona 12onz.', 'Cerveza', '20.00', 1, 0, 17, 1, 0, 0),
(111, 'CaCo2', 'Cachuda Corona 12onz. Oferta', 'Cerveza', '38.00', 1, 0, 17, 1, 0, 0),
(112, 'Tek1', 'Tequila simple', 'Trago', '15.00', 1, 0, 13, 1, 0, 0),
(113, 'Tek2', 'Tequila Doble', 'Trago', '25.00', 1, 0, 13, 1, 0, 0),
(114, 'Lev1', 'Levantamuertos simple', 'Trago', '6.00', 1, 0, 13, 1, 0, 0),
(115, 'Lev2', 'Levantamuertos + Tequila', 'Trago', '10.00', 1, 0, 13, 1, 0, 0),
(116, 'TW1', 'Whisky 1 onz. ', 'Trago', '25.00', 1, 0, 13, 1, 0, 0),
(117, 'TW2', 'Whisky 2 onz.', 'Trago', '45.00', 1, 0, 13, 1, 0, 0),
(118, 'TJ1', 'Jack Daniels 1 onz.', 'Trago', '35.00', 1, 0, 13, 1, 0, 0),
(119, 'TJ2', 'Jack Daniels 2 onz.', 'Trago', '65.00', 1, 0, 13, 1, 0, 0),
(120, 'Cafe', 'Cafe', 'cafe', '8.00', 1, 0, 18, 1, 0, 0),
(121, 'Té', 'Té', 'Te', '10.00', 1, 0, 18, 1, 0, 0),
(122, '1/8T', '1/8 Tamarindo', 'licor', '15.00', 37, 25, 12, 1, 1, 0),
(123, '1/8J', '1/8 Jamaica', 'licor', '15.00', 6, 12, 12, 1, 1, 0),
(124, '1/8Q', '1/8 Quetzalteca', 'licor', '15.00', 54, 24, 12, 1, 1, 0),
(125, '1/8mora', '1/8 de Mora', 'licor', '15.00', 144, 45, 12, 1, 1, 0),
(126, 'BotVe', 'Botella Venado Light', 'licor', '90', 12, 24, 12, 1, 1, 0),
(127, '1/2V', '1/2 Venado light+gaseosa', 'licor', '55.00', 34, 48, 12, 1, 1, 0),
(128, 'CAF', 'Quichelada Gallo y Cabro Oferta', 'Cerveza', '35.00', 1, 0, 10, 1, 0, 0),
(130, 'xlB', 'Botella XL Piña y Coco+3 Gaseosa', 'licor', '100.00', 1, 6, 12, 1, 1, 0),
(131, 'QuichGOferta', 'Quichelada Gallo Oferta 12 onz.', 'Cerveza', '35.00', 1, 0, 17, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_asociados`
--

CREATE TABLE `productos_asociados` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `producto_asociado` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_asociados`
--

INSERT INTO `productos_asociados` (`id`, `producto_id`, `producto_asociado`, `cantidad`) VALUES
(14, 15, 14, 1),
(15, 13, 14, 1),
(16, 16, 14, 1),
(17, 16, 12, 1),
(18, 16, 15, 1),
(19, 16, 11, 1),
(20, 18, 17, 2),
(21, 32, 30, 1),
(22, 32, 31, 1),
(23, 33, 30, 1),
(24, 33, 31, 1),
(25, 29, 75, 1),
(26, 49, 75, 1),
(27, 48, 86, 1),
(29, 88, 75, 2),
(32, 87, 75, 1),
(33, 89, 68, 1),
(34, 90, 68, 2),
(36, 92, 77, 2),
(37, 93, 66, 1),
(38, 94, 66, 2),
(41, 99, 80, 1),
(42, 91, 77, 1),
(43, 95, 83, 1),
(44, 98, 83, 2),
(45, 100, 80, 2),
(46, 101, 78, 1),
(47, 102, 78, 2),
(48, 103, 81, 1),
(49, 104, 68, 1),
(50, 105, 68, 2),
(51, 106, 76, 1),
(52, 107, 76, 2),
(54, 108, 77, 1),
(55, 109, 77, 2),
(56, 110, 66, 1),
(57, 111, 66, 2),
(60, 126, 86, 2),
(61, 126, 70, 1),
(63, 128, 75, 1),
(64, 128, 77, 1),
(65, 127, 86, 2),
(67, 130, 70, 3),
(68, 131, 75, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'admin', 'todas las funciones'),
(2, 'cajero', 'algunas funciones\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente`
--

CREATE TABLE `tipo_cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_cliente`
--

INSERT INTO `tipo_cliente` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Persona ', NULL),
(2, 'Empresa', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comprobante`
--

CREATE TABLE `tipo_comprobante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `igv` int(11) DEFAULT NULL,
  `serie` varchar(45) DEFAULT NULL,
  `predeterminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_comprobante`
--

INSERT INTO `tipo_comprobante` (`id`, `nombre`, `cantidad`, `igv`, `serie`, `predeterminado`) VALUES
(1, 'Factura', 0, 18, '001', 0),
(2, 'Ticket', 15, 0, '001', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `nombre`, `cantidad`) VALUES
(1, 'DPI', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `telefono`, `email`, `username`, `password`, `rol_id`, `estado`) VALUES
(1, 'Gary', 'Cano', '42956492', 'gcanom88@gmail.com', 'gcano', 'b2ffdbeb87e8e6331d350b482b328d309bc5a321', 1, 1),
(2, 'Javier', 'Bol', '41039872', 'jb@quicheladas.com', 'jb', '4458c79edc062c4d846a5bc0617561909ea8d106', 2, 1),
(3, 'Leonel', 'Bol', '55555555', 'leo@quicheladas.com', 'leo', '785b73decb616a0ee81705d9409da7d25bfc6f3e', 2, 1),
(4, 'Yaquelin', 'Flores', '41025675', 'yaquelin@quicheladas.com', 'wakiz', '7267dd68f963b1f330f0297e473c6b6a1ad69c6b', 1, 1),
(5, 'yony brondy', 'mamani fuentes', '45645342', 'yony@gmail.com', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `subtotal` varchar(45) DEFAULT NULL,
  `igv` varchar(45) DEFAULT NULL,
  `descuento` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `tipo_comprobante_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `num_documento` varchar(45) DEFAULT NULL,
  `serie` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `subtotal`, `igv`, `descuento`, `total`, `tipo_comprobante_id`, `cliente_id`, `usuario_id`, `num_documento`, `serie`, `estado`) VALUES
(45, '2018-05-17', '120.00', '0.00', '10', '110.00', 2, 8, 5, '000001', '001', 1),
(46, '2018-05-17', '30.00', '0.00', '0.00', '30.00', 2, 9, 5, '000002', '001', 1),
(47, '2018-05-18', '63.00', '0.00', '0.00', '63.00', 2, 8, 5, '000003', '001', 1),
(48, '2018-05-18', '62.00', '0.00', '0.00', '62.00', 2, 8, 5, '000004', '001', 1),
(49, '2018-05-18', '66.00', '0.00', '0.00', '66.00', 2, 8, 5, '000005', '001', 1),
(50, '2018-05-18', '35.00', '0.00', '0.00', '35.00', 2, 8, 5, '000006', '001', 1),
(51, '2018-05-18', '30.00', '0.00', '0.00', '30.00', 2, 9, 5, '000007', '001', 1),
(52, '2018-05-18', '25.00', '0.00', '0.00', '25.00', 2, 36, 5, '000008', '001', 1),
(53, '2018-05-23', '70.00', '0.00', '0.00', '70.00', 2, 8, 5, '000009', '001', 1),
(54, '2018-05-23', '481.00', '0.00', '0.00', '481.00', 2, 10, 5, '000010', '001', 1),
(55, '2018-05-23', '155.00', '0.00', '0.00', '155.00', 2, 10, 5, '000011', '001', 1),
(56, '2018-05-23', '173.00', '0.00', '0.00', '173.00', 2, 9, 5, '000012', '001', 1),
(57, '2018-05-24', '58.00', '0.00', '0.00', '58.00', 2, 8, 5, '000013', '001', 1),
(58, '2018-05-24', '108.00', '0.00', '7.50', '100.50', 2, 9, 5, '000014', '001', 1),
(59, '2018-05-30', '35.00', '0.00', '0.00', '35.00', 2, 11, 5, '000015', '001', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo_cliente_idx` (`tipo_cliente_id`),
  ADD KEY `fk_tipo_documento_idx` (`tipo_documento_id`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_venta_detalle_idx` (`venta_id`),
  ADD KEY `fk_producto_detalle_idx` (`producto_id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_notificaciones_idx` (`producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_mesa`
--
ALTER TABLE `pedidos_mesa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menus_idx` (`menu_id`),
  ADD KEY `fk_rol_idx` (`rol_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  ADD KEY `fk_categoria_producto_idx` (`categoria_id`);

--
-- Indices de la tabla `productos_asociados`
--
ALTER TABLE `productos_asociados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_rol_usuarios_idx` (`rol_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_venta_idx` (`usuario_id`),
  ADD KEY `fk_cliente_venta_idx` (`cliente_id`),
  ADD KEY `fk_tipo_comprobante_venta_idx` (`tipo_comprobante_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pedidos_mesa`
--
ALTER TABLE `pedidos_mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT de la tabla `productos_asociados`
--
ALTER TABLE `productos_asociados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_tipo_cliente` FOREIGN KEY (`tipo_cliente_id`) REFERENCES `tipo_cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_documento` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_producto_detalle` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_detalle` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_productos_notificaciones` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `fk_menus` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria_producto` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_rol_usuarios` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_cliente_venta` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_comprobante_venta` FOREIGN KEY (`tipo_comprobante_id`) REFERENCES `tipo_comprobante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_venta` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
