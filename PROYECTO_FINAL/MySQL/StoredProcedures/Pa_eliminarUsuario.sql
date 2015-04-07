DELIMITER //
CREATE PROCEDURE eliminarUsuario
	(
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
END //
DELIMITER ;