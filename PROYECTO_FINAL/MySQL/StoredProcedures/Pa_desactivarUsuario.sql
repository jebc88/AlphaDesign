DELIMITER //
CREATE PROCEDURE desactivarUsuario
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
				SET		estado = 0
				WHERE	idusuario = p_id;
		END IF;
END //
DELIMITER ;