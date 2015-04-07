DELIMITER //
CREATE PROCEDURE activarUsuario
	(
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
END //
DELIMITER ;