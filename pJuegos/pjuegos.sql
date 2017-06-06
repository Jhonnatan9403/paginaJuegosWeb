-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2017 at 05:25 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pjuegos`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrito`
--

CREATE TABLE `carrito` (
  `idCarrito` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombreProducto` varchar(50) NOT NULL,
  `cantProducto` int(11) NOT NULL,
  `precioTotal` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nombreCategoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombreCategoria`) VALUES
(1, 'Accion'),
(2, 'Aventura'),
(3, 'Arcade'),
(4, 'Lucha'),
(5, 'RPG'),
(6, 'MMO'),
(7, 'Horror'),
(8, 'Indie'),
(9, 'Deporte'),
(10, 'Plataformas'),
(11, 'FPS'),
(12, 'Estrategia'),
(13, 'Musica');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `nick` varchar(20) NOT NULL,
  `avatarU` varchar(500) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `comentario` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `nick`, `avatarU`, `idProducto`, `comentario`) VALUES
(3, 'a1', 'avatares/a1.png', 5, 'Sin reflejos'),
(4, 'C2', 'avatares/C2.png', 5, 'Buen juego'),
(5, 'a1', 'avatares/a1.png', 7, 'Muy buen juego'),
(6, 'a1', 'avatares/a1.png', 10, 'Muy buen juego'),
(7, 'C2', 'avatares/C2.png', 10, 'No me gusto el juego \r\n');

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombreProducto` varchar(50) NOT NULL,
  `cantProducto` int(11) NOT NULL,
  `precioTotal` int(100) NOT NULL,
  `fechaCompra` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`idFactura`, `idProducto`, `idUsuario`, `nombreProducto`, `cantProducto`, `precioTotal`, `fechaCompra`) VALUES
(10, 18, 3, 'Call of Duty Black ops 3', 3, 36000, 'June 5, 2017, 10:06 pm'),
(11, 5, 3, 'Wacth Dogs', 2, 100000, 'June 5, 2017, 10:27 pm'),
(12, 9, 3, 'The crew', 1, 15000, 'June 5, 2017, 11:09 pm'),
(13, 17, 3, 'Super smash bros brawl', 12, 60000, 'June 5, 2017, 11:09 pm'),
(14, 18, 3, 'Call of Duty Black ops 3', 1, 12000, 'June 5, 2017, 11:10 pm'),
(15, 7, 3, 'Super mario bros 3', 3, 30000, 'June 5, 2017, 11:11 pm'),
(16, 5, 4, 'Wacth Dogs', 1, 50000, 'June 6, 2017, 12:37 am'),
(17, 11, 3, 'Far Cry 4', 2, 30000, 'June 6, 2017, 12:44 am');

-- --------------------------------------------------------

--
-- Table structure for table `multimediaproducto`
--

CREATE TABLE `multimediaproducto` (
  `idMultimedia` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `ruta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plataforma`
--

CREATE TABLE `plataforma` (
  `idPlataforma` int(11) NOT NULL,
  `nombrePlataforma` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plataforma`
--

INSERT INTO `plataforma` (`idPlataforma`, `nombrePlataforma`) VALUES
(1, 'Pc'),
(2, 'Xbox'),
(3, 'Xbox 360'),
(4, 'Xbox One'),
(5, 'PlayStation 3'),
(6, 'PlayStation 4'),
(7, 'Nintendo Wii'),
(8, 'Nintendo Wii-U'),
(9, 'GameCube');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `nombreProveedor` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `plataforma` varchar(20) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `portada` varchar(100) NOT NULL,
  `sinopsis` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idProducto`, `idProveedor`, `nombreProveedor`, `nombre`, `precio`, `plataforma`, `categoria`, `portada`, `sinopsis`) VALUES
(5, 2, 'Ubisoft', 'Wacth Dogs', 50000, 'Pc', 'Accion', 'portadas/Wacth Dogs.jpg', 'Ambientado en un futuro cercano en la ciudad de Chicago, donde una red central de ordenadores conocida como el ctOS, conecta a todo y a todos, incluyendo todos los datos e informaciÃ³n privada de todos sus habitantes incluso anticipando posibles crÃ­menes, Watch_Dogs explora el impacto de la tecnologÃ­a en la sociedad moderna. Usando la ciudad como arma, el protagonista se embarcarÃ¡ en una misiÃ³n personal para administrar justicia por mano propia.'),
(7, 1, 'Nintendo', 'Super mario bros 3', 10000, 'Nintendo Wii', 'Plataformas', 'portadas/Super mario bros 3.png', 'El Mundo ChampiÃ±Ã³n es atacado por el Rey de los Koopas. Esta vez, Bowser ha enviado a sus siete hijos, conocidos como Koopalingspara hacer lo que se les antoje en cada reino, robando los cetros (varitas mÃ¡gicas) de los siete reyes que gobiernan en dicho mundo y convirtiÃ©ndolos en animales y plantas. Mario y Luigi son llamados nuevamente y en cada uno de estos mundos se infiltran en las naves de los Koopalings, '),
(9, 2, 'Ubisoft', 'The crew', 15000, 'Pc', 'Deporte', 'portadas/The crew.jpg', 'The Crew es un videojuego de conducciÃ³n multijugador situado en un entorno de mundo abierto basado en los Estados Unidos, desarrollado por Ivory Tower y distribuido por Ubisoft, que fue lanzado el 2 de diciembre de 2014 para PlayStation 4, Xbox One, Microsoft Windows y Xbox 360.'),
(10, 3, 'THQ', 'Darksiders 2', 11000, 'Pc', 'Aventura', 'portadas/Darksiders 2.jpg', 'Darksiders II se lleva a cabo en paralelo a el juego anterior. En el prÃ³logo, se revela que los cuatro jinetes (Guerra, Furia, Muerte y Disputa) son los Ãºltimos de los Nefilim, las fusiones de Ã¡ngeles y demonios que libraron una guerra sangrienta en el resto de la creaciÃ³n, con el fin de preservar el equilibrio del Universo, ordenados por el Consejo Abrasado, recibirÃ­an increÃ­bles poderes a cambio de sacrificar al resto de los Nefilim. Muerte atrapÃ³ las almas de sus hermanos caÃ­dos .'),
(11, 2, 'Ubisoft', 'Far Cry 4', 15000, 'Xbox 360', 'Aventura', 'portadas/Far Cry 4.jpg', 'Far Cry 4 se desarrolla en una regiÃ³n ficticia del Himalaya llamada Kyrat, un paÃ­s probablemente basado en ButÃ¡n. El personaje principal del juego es Ajay Ghale, un muchacho estadounidense que viaja a Kyrat para cumplir el Ãºltimo deseo de su madre, Ishwari Ghale, quien quiere que sus cenizas sean \"devueltas\" junto a Lakshmana, la hija asesinada de Ishwari y Pagan Min. Llegando a Kyrat, el joven Ajay es interceptado por miembros del ejÃ©rcito kyratÃ­ y Pagan Min en persona, el rey tirano de K'),
(14, 3, 'THQ', 'Darksiders', 12000, 'Pc', 'Aventura', 'portadas/Darksiders.jpg', 'Desde el inicio, ha habido una lucha entre las fuerzas del Cielo y las del Infierno. Como moderadores, surgiÃ³ el Consejo abrasado. Cuando las reglas no se cumplÃ­an, los cuatro Jinetes del Apocalipsis son invocados para castigar a quienes no las cumplen. En medio de esa guerra, aparecieron los primeros hombres, y asÃ­ se iniciÃ³ un nuevo reino, el de los humanos. El Cielo y el Infierno hicieron una tregua y se crearon 7 sellos, los cuales se romperÃ­an el dÃ­a en que la humanidad pudiera afront'),
(17, 1, 'Nintendo', 'Super smash bros brawl', 5000, 'Nintendo Wii', 'Lucha', 'portadas/Super smash bros brawl.jpg', 'El modo comienza con Mario y Kirby cara a cara situados en un estadio del mundo Smash Bros.. En este mundo, cuando un luchador es derrotado, se convierte en un trofeo, que puede ser revivido al tocar su base. De repente, aparece humo del cielo y la nave Hal Abarda interfiere en el combate. Aprovecha para lanzar unos enemigos morados llamados Â«PrÃ­midosÂ», de parte de los miembros del EjÃ©rcito del Subespacio.'),
(18, 2, 'Ubisoft', 'Call of Duty Black ops 3', 12000, 'Xbox One', 'FPS', 'portadas/Call of Duty Black ops 3.jpg', 'Juego de disparos en tercera persona ambientado en las guerras modernas.');

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombreProveedor` varchar(30) NOT NULL,
  `emailProveedor` varchar(50) NOT NULL,
  `documentoProveedor` int(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombreProveedor`, `emailProveedor`, `documentoProveedor`, `password`) VALUES
(1, 'Nintendo', 'nin10do@nintendo.com', 1, '1'),
(2, 'Ubisoft', 'ubi@ubisoft.com', 2, '2'),
(3, 'THQ', 'thq@thq.com', 3, '3');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nick` varchar(20) NOT NULL,
  `documento` int(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `avatar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nick`, `documento`, `nombre`, `apellido`, `correo`, `password`, `avatar`) VALUES
(3, 'a1', 123, 'jose', 'gomez', 'cp1@hotmail.com', '123', 'avatares/a1.png'),
(4, 'C2', 1245, 'pedro', 'gomez', 'pg@hotmail.com', '1234', 'avatares/C2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`idCarrito`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `multimediaproducto`
--
ALTER TABLE `multimediaproducto`
  ADD PRIMARY KEY (`idMultimedia`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indexes for table `plataforma`
--
ALTER TABLE `plataforma`
  ADD PRIMARY KEY (`idPlataforma`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrito`
--
ALTER TABLE `carrito`
  MODIFY `idCarrito` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `multimediaproducto`
--
ALTER TABLE `multimediaproducto`
  MODIFY `idMultimedia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plataforma`
--
ALTER TABLE `plataforma`
  MODIFY `idPlataforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `multimediaproducto`
--
ALTER TABLE `multimediaproducto`
  ADD CONSTRAINT `multimediaproducto_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
