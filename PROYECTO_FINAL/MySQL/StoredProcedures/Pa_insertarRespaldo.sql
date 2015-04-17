DELIMITER //

CREATE PROCEDURE insertarRespaldo
	(
	p_idusuario int,
	p_idmaquina int
	)
BEGIN

    CREATE TEMPORARY TABLE aux(
	msg varchar(100)
	);
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
			
	INSERT INTO aux(msg)
	VALUES ('Maquina respaldada con exito');
	
	SELECT *
	FROM aux;


END //

DELIMITER ;