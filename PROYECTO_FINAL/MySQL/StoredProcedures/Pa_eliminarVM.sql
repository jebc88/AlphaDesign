DELIMITER //
CREATE PROCEDURE eliminarVM
	(
	p_id int
	)
BEGIN
	DECLARE existe bit;
    CREATE TEMPORARY TABLE aux(
	msg varchar(100)
	);
	SET existe:= IFNULL((SELECT	1
				  FROM	maquinavirtual
				  WHERE	idmaquinavirtual = p_id),0);

	IF existe = 1 THEN
			DELETE FROM maquinavirtual
			WHERE	idmaquinavirtual = p_id;
		END IF;
		
	INSERT INTO aux(msg)
	VALUES ('Maquina eliminada con exito');
	
	SELECT *
	FROM aux;
END //
DELIMITER ;