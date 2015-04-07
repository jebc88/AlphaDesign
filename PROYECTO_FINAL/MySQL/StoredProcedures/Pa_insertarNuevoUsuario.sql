DELIMITER //

CREATE PROCEDURE insertarUsuarioNuevo
	(
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

END //

DELIMITER ;