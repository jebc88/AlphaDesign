DELIMITER //

CREATE PROCEDURE insertarRespaldo
	(
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

END //

DELIMITER ;