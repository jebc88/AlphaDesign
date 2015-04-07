DELIMITER //

CREATE PROCEDURE insertarMaquinaVirtual
	(
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

END //

DELIMITER ;