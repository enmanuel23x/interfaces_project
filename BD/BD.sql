SET NAMES utf8 ;
DROP DATABASE IF exists tienda;
CREATE DATABASE IF NOT EXISTS tienda;
USE tienda;
SET character_set_client = utf8mb4 ;
/*Tabla usuario*/
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `documento` varchar(40) NOT NULL,
  `rol` int(2) NOT NULL,
  `user` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
  );
/*Tabla categoria*/
CREATE TABLE IF NOT EXISTS `categoria` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(40) NOT NULL,
    `descripcion` varchar(500) NOT NULL,
    PRIMARY KEY (`id`)
  );
/*Tabla producto*/
CREATE TABLE IF NOT EXISTS `producto` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(40) NOT NULL,
    `precio` float(40) NOT NULL,
    `imagen` varchar(50) NOT NULL,
    `inventario` int(40) NOT NULL,
    `click` int(40) NOT NULL,
    `descripcion` varchar(500) NOT NULL,
    `id_categoria` int(11) NOT NULL,
    FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
    PRIMARY KEY (`id`)
  );
/* Otras imagenes*/
CREATE TABLE IF NOT EXISTS `other_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
  PRIMARY KEY (`id`)
);
/*Tabla factura*/
CREATE TABLE IF NOT EXISTS `factura` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_cliente` int(11) NOT NULL,
    `fecha` DATETIME NOT NULL,
    `total` float(50) NOT NULL,
    FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id`),
    PRIMARY KEY (`id`)
  );
/*Tabla detalle_factura*/
CREATE TABLE IF NOT EXISTS `detalle_factura` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_factura` int(11) NOT NULL,
    `id_producto` int(11) NOT NULL,
    `cantidad` int(11) NOT NULL,
    `precio` float(10) NOT NULL,
    FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id`),
    FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
    PRIMARY KEY (`id`)
  );
/*Tabla detalle_carrito*/
CREATE TABLE IF NOT EXISTS `detalle_carrito` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_producto` int(11) NOT NULL,
    `cantidad` int(11) NOT NULL,
    `id_cliente` int(11) NOT NULL,
    FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id`),
    FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
    PRIMARY KEY (`id`)
  );
/*Tabla lista_de_deseos*/
CREATE TABLE IF NOT EXISTS `lista_de_deseos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_cliente` int(11) NOT NULL,
    `nombre` varchar(50) NOT NULL,
    FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id`),
    PRIMARY KEY (`id`)
  );
/*Tabla detalle_lista_de_deseos*/
CREATE TABLE IF NOT EXISTS `detalle_lista_de_deseos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_lista_de_deseos` int(11) NOT NULL,
    `id_producto` int(11) NOT NULL,
    FOREIGN KEY (`id_lista_de_deseos`) REFERENCES `lista_de_deseos` (`id`),
    FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
    PRIMARY KEY (`id`)
  );