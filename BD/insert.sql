
/*Categoria*/
INSERT INTO `tienda`.`categoria` (`nombre`, `descripcion`) VALUES ('Electrodomesticos','Electrodomesticos');
INSERT INTO `tienda`.`categoria` (`nombre`, `descripcion`) VALUES ('Hogar','Hogar');
INSERT INTO `tienda`.`categoria` (`nombre`, `descripcion`) VALUES ('Informatica','Informatica');
/*Productos*/
INSERT INTO `tienda`.`producto` (`nombre`, `precio`,`imagen`,`inventario`, `click`,`descripcion`,`id_categoria`) 
VALUES ('Lavadora',400,'./src/assets/img/lav-1.jpg',20, 0,'Another boring lorem ipsum paragraph, where you can find meaningless latin words gathered together to form multiple sentences. Aint that typical?', 1);

INSERT INTO `tienda`.`producto` (`nombre`, `precio`,`imagen`,`inventario`, `click`,`descripcion`,`id_categoria`) 
VALUES ('Refrigerador',600,'./src/assets/img/refri-1.jpg',20, 0,'Another boring lorem ipsum paragraph, where you can find meaningless latin words gathered together to form multiple sentences. Aint that typical?', 1);

INSERT INTO `tienda`.`producto` (`nombre`, `precio`,`imagen`,`inventario`, `click`,`descripcion`,`id_categoria`) 
VALUES ('Microondas',100,'./src/assets/img/micro-1.jpg',20, 0,'Another boring lorem ipsum paragraph, where you can find meaningless latin words gathered together to form multiple sentences. Aint that typical?', 1);

INSERT INTO `tienda`.`producto` (`nombre`, `precio`,`imagen`,`inventario`, `click`,`descripcion`,`id_categoria`) 
VALUES ('Cafetera',120,'./src/assets/img/cafe-1.jpg',20, 0,'Another boring lorem ipsum paragraph, where you can find meaningless latin words gathered together to form multiple sentences. Aint that typical?', 1);

/* other_images*/
INSERT INTO `tienda`.`other_images` (`id_producto`,`imagen`)
VALUES (1,'./src/assets/img/lav-1.jpg');
INSERT INTO `tienda`.`other_images` (`id_producto`,`imagen`)
VALUES (1,'./src/assets/img/lav-1.jpg');
INSERT INTO `tienda`.`other_images` (`id_producto`,`imagen`)
VALUES (1,'./src/assets/img/lav-1.jpg');
