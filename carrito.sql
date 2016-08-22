-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2016 a las 17:36:07
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9
create database carrito;
use carrito;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



--
-- Base de datos: `carrito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE IF NOT EXISTS `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(8,2) NOT NULL,
  `cantidadArticulos` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `carrito`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemcarrito`
--

CREATE TABLE IF NOT EXISTS `itemcarrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrito_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `itemcarrito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `descripcion`, `codigo`, `precio`) VALUES
(1, 'Producto 1', 'a001', '55.00'),
(2, 'Producto 2', 'a002', '56.00'),
(3, 'Producto 3', 'a003', '57.00'),
(4, 'Producto 4', 'a004', '58.00'),
(5, 'Producto 5', 'a005', '59.00'),
(6, 'Producto 6', 'a006', '60.00'),
(7, 'Producto 7', 'a007', '61.00'),
(8, 'Producto 8', 'a008', '62.00'),
(9, 'Producto 9', 'a009', '63.00'),
(10, 'Producto 10', 'a0010', '64.00'),
(11, 'Producto 11', 'a0011', '65.00'),
(12, 'Producto 12', 'a0012', '66.00'),
(13, 'Producto 13', 'a0013', '67.00'),
(14, 'Producto 14', 'a0014', '68.00'),
(15, 'Producto 15', 'a0015', '69.00'),
(16, 'Producto 16', 'a0016', '70.00'),
(17, 'Producto 17', 'a0017', '71.00'),
(18, 'Producto 18', 'a0018', '72.00')

