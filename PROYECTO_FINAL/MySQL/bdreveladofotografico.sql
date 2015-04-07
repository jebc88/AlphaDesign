-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2015 at 12:18 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bdreveladofotografico`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `activarUsuario`(
	p_id int
	)
BEGIN
	DECLARE existe bit;

	SET existe:= IFNULL((SELECT	1
				  FROM	usuario
				  WHERE	idusuario = p_id),0);

	IF existe = 1 THEN
			UPDATE usuario
				SET		estado = 1
				WHERE	idusuario = p_id;
		END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `desactivarUsuario`(
	p_id int
	)
BEGIN
	DECLARE existe bit;

	SET existe:= IFNULL((SELECT	1
				  FROM	usuario
				  WHERE	idusuario = p_id),0);

	IF existe = 1 THEN
			UPDATE usuario
				SET		estado = 0
				WHERE	idusuario = p_id;
		END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `detalleUsuario`(p_id INT)
BEGIN

	SELECT *
	FROM usuario
	WHERE idUsuario=p_id;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarUsuario`(
	p_id int
	)
BEGIN
	DECLARE existe bit;

	SET existe:= IFNULL((SELECT	1
				  FROM	usuario
				  WHERE	idusuario = p_id),0);

	IF existe = 1 THEN
			DELETE FROM usuario
			WHERE	idusuario = p_id;
		END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarEliminado`(
	p_idusuario int,
	p_idmaquina int
	)
BEGIN
		INSERT INTO eliminado
			(
			idUsuario,
			idMaquinaVirtual,
			fechaCreacion,
			estado
			)

		VALUES
			(
			p_idusuario,
			p_idmaquina,
			NOW(),
			1
			); 
			
		SELECT 1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarMaquinaVirtual`(
	p_idusuario int,
	p_nombre varchar(50),
	p_descripcion varchar(50)
	)
BEGIN

	DECLARE mismoNombre bit;
	
    CREATE TEMPORARY TABLE errorMsg(
	Error varchar(100)
	);
	
	SET mismoNombre := IFNULL ((SELECT 1
					            FROM maquinavirtual
					            WHERE nombre = p_nombre),0);
   
	IF (mismoNombre = 0) THEN
		INSERT INTO maquinavirtual
			(
			idUsuario,
			nombre,
			descripcion,
			fechaCreacion,
			estado
			)

		VALUES
			(
			p_idusuario,
			p_nombre,
			p_descripcion,
			NOW(),
			1
			);
			
		SELECT 1;
            
    ELSE
		INSERT INTO errorMsg(Error)
		VALUES('Ya existe una maquina con el mismo nombre');
		
		SELECT *
		FROM errorMsg;
        
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarRespaldo`(
	p_idusuario int,
	p_idmaquina int
	)
BEGIN
		INSERT INTO respaldo
			(
			idUsuario,
			idMaquinaVirtual,
			fechaCreacion,
			estado
			)

		VALUES
			(
			p_idusuario,
			p_idmaquina,
			NOW(),
			1
			); 
			
		SELECT 1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarRestaurado`(
	p_idusuario int,
	p_idmaquina int
	)
BEGIN
		INSERT INTO restaurado
			(
			idUsuario,
			idMaquinaVirtual,
			fechaCreacion,
			estado
			)

		VALUES
			(
			p_idusuario,
			p_idmaquina,
			NOW(),
			1
			); 
			
		SELECT 1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarUsuarioNuevo`(
	p_id varchar(20),
	p_nombre varchar(50),
	p_apellido1 varchar(50),
	p_apellido2 varchar(50),
	p_fechaNacimiento date,
	p_genero char(1),
	p_telefono varchar(20),
	p_correo varchar(20),
	p_usuario varchar(20),
	p_pass varchar(50),
	p_tipo int
	)
BEGIN

	DECLARE existeId bit;
	DECLARE existeCorreo bit;
	DECLARE existeUsuario bit;
	DECLARE exito bit DEFAULT 0;
	
    CREATE TEMPORARY TABLE errorMsg(
	Error varchar(100)
	);
	
	SET existeId := IFNULL ((SELECT 1
					FROM usuario
					WHERE identificacion = p_id),0);
					
	SET existeCorreo := IFNULL ((SELECT 1
						FROM usuario
						WHERE correo = p_correo),0);
	
	SET existeUsuario := IFNULL ((SELECT 1
						FROM usuario
						WHERE usuario = p_usuario),0);
    
	IF (existeId = 0 AND existeCorreo = 0 AND existeUsuario = 0) THEN
		SET exito = 1;
	END IF;

	IF (exito = 1) THEN
		INSERT INTO usuario
			(
			identificacion,
			nombre,
			apellido1,
			apellido2,
			fechaNacimiento,
			genero,
			telefono,
			correo,
			usuario,
			pass,
			tipo,
            fechaCreacion,
			estado
			)

		VALUES
			(
			p_id,
			p_nombre,
			p_apellido1,
			p_apellido2,
			p_fechaNacimiento,
			p_genero,
			p_telefono,
			p_correo,
			p_usuario,
			password(p_pass),
			p_tipo,
			NOW(),
			0
			);
            
    ELSE
    	IF (existeId = 1) THEN
			INSERT INTO errorMsg(Error)
			VALUES('Identificacion ya existe');
		END IF;
		IF (existeCorreo = 1) THEN
			INSERT INTO errorMsg(Error)
			VALUES('Correo ya existe');
		END IF;
		IF (existeUsuario = 1) THEN
			INSERT INTO errorMsg(Error)
			VALUES('Nombre de usuario ya existe');
		END IF;
		
		SELECT *
		FROM errorMsg;
        
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `loguearUsuario`(
p_usuario varchar(20),
p_pass varchar(50)
)
BEGIN

	SELECT *
	FROM usuario
	WHERE usuario=p_usuario AND pass=password(p_pass);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerMaquinasVirtuales`()
BEGIN

	SELECT *
	FROM maquinavirtual;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerUsuarios`()
BEGIN

	SELECT *
	FROM usuario;
	
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `eliminado`
--

CREATE TABLE IF NOT EXISTS `eliminado` (
`idEliminado` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idMaquinaVirtual` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `maquinavirtual`
--

CREATE TABLE IF NOT EXISTS `maquinavirtual` (
`idMaquinaVirtual` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_bin NOT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `respaldo`
--

CREATE TABLE IF NOT EXISTS `respaldo` (
`idRespaldo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idMaquinaVirtual` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `restaurado`
--

CREATE TABLE IF NOT EXISTS `restaurado` (
`idRestaurado` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idMaquinaVirtual` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`idUsuario` int(11) NOT NULL,
  `identificacion` varchar(50) COLLATE utf8_bin NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `apellido1` varchar(50) COLLATE utf8_bin NOT NULL,
  `apellido2` varchar(50) COLLATE utf8_bin NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `genero` char(1) COLLATE utf8_bin NOT NULL,
  `telefono` varchar(20) COLLATE utf8_bin NOT NULL,
  `correo` varchar(30) COLLATE utf8_bin NOT NULL,
  `usuario` varchar(20) COLLATE utf8_bin NOT NULL,
  `pass` varchar(50) COLLATE utf8_bin NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT '0',
  `fechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `identificacion`, `nombre`, `apellido1`, `apellido2`, `fechaNacimiento`, `genero`, `telefono`, `correo`, `usuario`, `pass`, `tipo`, `fechaCreacion`, `estado`) VALUES
(1, '11115555', 'John', 'Smith', 'Collins', '1988-07-07', 'M', '55556666', 'jsmith@torrent.com', 'jsmith', '*00A51F3F48415C7D4E8908980D443C29C69B60C9', 1, '2015-04-07 14:05:02', b'1'),
(2, '99998888', 'Bob', 'Marley', 'Junior', '1972-04-04', 'M', '66664444', 'bob@marley.com', 'bmarley', '*00A51F3F48415C7D4E8908980D443C29C69B60C9', 2, '2015-04-07 14:19:33', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eliminado`
--
ALTER TABLE `eliminado`
 ADD PRIMARY KEY (`idEliminado`), ADD KEY `FK_Eliminado_Usuario_IdUsuario` (`idUsuario`), ADD KEY `FK_Eliminado_MaquinaVirtual_IdMaquinaVirtual` (`idMaquinaVirtual`);

--
-- Indexes for table `maquinavirtual`
--
ALTER TABLE `maquinavirtual`
 ADD PRIMARY KEY (`idMaquinaVirtual`), ADD KEY `FK_MaquinaVirtual_Usuario_IdUsuario` (`idUsuario`);

--
-- Indexes for table `respaldo`
--
ALTER TABLE `respaldo`
 ADD PRIMARY KEY (`idRespaldo`), ADD KEY `FK_Respaldo_Usuario_IdUsuario` (`idUsuario`), ADD KEY `FK_Respaldo_MaquinaVirtual_IdMaquinaVirtual` (`idMaquinaVirtual`);

--
-- Indexes for table `restaurado`
--
ALTER TABLE `restaurado`
 ADD PRIMARY KEY (`idRestaurado`), ADD KEY `FK_Restaurado_Usuario_IdUsuario` (`idUsuario`), ADD KEY `FK_Restaurado_MaquinaVirtual_IdMaquinaVirtual` (`idMaquinaVirtual`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`idUsuario`), ADD UNIQUE KEY `identificacion` (`identificacion`,`correo`,`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eliminado`
--
ALTER TABLE `eliminado`
MODIFY `idEliminado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maquinavirtual`
--
ALTER TABLE `maquinavirtual`
MODIFY `idMaquinaVirtual` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `respaldo`
--
ALTER TABLE `respaldo`
MODIFY `idRespaldo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `restaurado`
--
ALTER TABLE `restaurado`
MODIFY `idRestaurado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `eliminado`
--
ALTER TABLE `eliminado`
ADD CONSTRAINT `FK_Eliminado_MaquinaVirtual_IdMaquinaVirtual` FOREIGN KEY (`idMaquinaVirtual`) REFERENCES `maquinavirtual` (`idMaquinaVirtual`),
ADD CONSTRAINT `FK_Eliminado_Usuario_IdUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `maquinavirtual`
--
ALTER TABLE `maquinavirtual`
ADD CONSTRAINT `FK_MaquinaVirtual_Usuario_IdUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `respaldo`
--
ALTER TABLE `respaldo`
ADD CONSTRAINT `FK_Respaldo_MaquinaVirtual_IdMaquinaVirtual` FOREIGN KEY (`idMaquinaVirtual`) REFERENCES `maquinavirtual` (`idMaquinaVirtual`),
ADD CONSTRAINT `FK_Respaldo_Usuario_IdUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `restaurado`
--
ALTER TABLE `restaurado`
ADD CONSTRAINT `FK_Restaurado_MaquinaVirtual_IdMaquinaVirtual` FOREIGN KEY (`idMaquinaVirtual`) REFERENCES `maquinavirtual` (`idMaquinaVirtual`),
ADD CONSTRAINT `FK_Restaurado_Usuario_IdUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
