DELIMITER //
CREATE PROCEDURE detalleUsuario(p_id INT)
BEGIN

	SELECT *
	FROM usuario
	WHERE idUsuario=p_id;
	
END //
DELIMITER ;