DELIMITER //

CREATE PROCEDURE insertarRestaurado
	(
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

END //

DELIMITER ;