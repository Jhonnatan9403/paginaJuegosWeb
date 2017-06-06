/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Jhonnatan Báez
 * Created: 30/04/2017
 */

CREATE TABLE `usuarios` ( 
  `idUsuario` INT(11) NOT NULL AUTO_INCREMENT, 
  `nick` VARCHAR(20) NOT NULL, 
  `documento` INT(20) NOT NULL,
  `nombre` VARCHAR(20) NOT NULL,
  `apellido` VARCHAR(20) NOT NULL,
  `correo` VARCHAR(50) NOT NULL,   
  `password` VARCHAR(30) NOT NULL,
	 
  PRIMARY KEY  (`idUsuario`) 
);

CREATE TABLE proveedor (

    idProveedor int (11) not null auto_increment,
    nombreProveedor varchar (30) not null,
    emailProveedor varchar (50) not null,
    documentoProveedor int (30) not null,
    password varchar (30) not null,

    PRIMARY KEY  (`idProveedor`)
);

CREATE TABLE producto (

    idProducto int (11) not null auto_increment,
    idProveedor int (11) not null,
    nombreProveedor varchar (30) not null,
    nombre varchar (50) not null,
    precio int (11) not null,
    plataforma varchar (20) not null,
    categoria varchar (20) not null,
    portada varchar (100) not null,
    
    Primary key (`idProducto`),
    Foreign key (`idProveedor`) references proveedor (`idProveedor`) on delete cascade on update cascade
    
);

CREATE TABLE multimediaproducto(

    idMultimedia int (11) not null auto_increment,
    idProducto int (11) not null,
    ruta varchar (100) not null,
    
    Primary key (`idMultimedia`),
    Foreign key (`idProducto`) references producto (`idProducto`) on delete cascade on update cascade
);

CREATE TABLE comentarios(

    idComentario int (11) not null auto_increment,
    `nick` VARCHAR(20) NOT NULL,
    idProducto int (11) not null,
    comentario varchar (500) not null,
    
    Primary key (`idComentario`),
    Foreign key (`idProducto`) references producto (`idProducto`) on delete cascade on update cascade
);

CREATE TABLE categoria(

    idCategoria int (11) not null auto_increment,
    nombreCategoria varchar (30) not null,
    
    Primary key (`idCategoria`)
);

CREATE TABLE plataforma(

    idPlataforma int (11) not null auto_increment,
    nombrePlataforma varchar (30) not null,
    
    Primary key (`idPlataforma`)
);

CREATE TABLE factura(

    idFactura int (11) not null auto_increment,
    idProducto int (11) not null,
    idUsuario int(11) not null,
    cantProducto int(11) not null,
    fechaCompra varchar(30) not null,
    
    Primary key (`idFactura`),
    Foreign key (`idProducto`) references producto (`idProducto`) on delete cascade on update cascade,
    Foreign key (`idUsuario`) references usuarios (`idUsuario`) on delete cascade on update cascade,

);

INSERT INTO `plataforma`(`nombrePlataforma`) VALUES ("Pc");
INSERT INTO `plataforma`(`nombrePlataforma`) VALUES ("Xbox");
INSERT INTO `plataforma`(`nombrePlataforma`) VALUES ("Xbox 360");
INSERT INTO `plataforma`(`nombrePlataforma`) VALUES ("Xbox One");
INSERT INTO `plataforma`(`nombrePlataforma`) VALUES ("PlayStation 3");
INSERT INTO `plataforma`(`nombrePlataforma`) VALUES ("PlayStation 4");
INSERT INTO `plataforma`(`nombrePlataforma`) VALUES ("Nintendo Wii");
INSERT INTO `plataforma`(`nombrePlataforma`) VALUES ("Nintendo Wii-U");
INSERT INTO `plataforma`(`nombrePlataforma`) VALUES ("GameCube");


INSERT INTO `categoria`(`nombreCategoria`) VALUES ("Accion");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("Aventura");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("Arcade");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("Lucha");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("RPG");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("MMO");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("Horror");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("Indie");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("Deporte");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("Plataformas");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("FPS");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("Estrategia");
INSERT INTO `categoria`(`nombreCategoria`) VALUES ("Musica");


