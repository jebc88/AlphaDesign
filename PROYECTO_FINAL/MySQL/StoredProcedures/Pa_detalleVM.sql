DELIMITER //
CREATE PROCEDURE detalleVM(p_id INT)
BEGIN

	SELECT  m.idmaquinavirtual as id,
    		u.usuario as usuario,
			m.nombre as nombre,
			m.descripcion as descripcion,
			m.ram as ram,
			m.ip as ip,
			m.fechaCreacion as fecha,
			m.estado as estado
	FROM maquinavirtual as m
	INNER JOIN usuario as u
	ON m.idUsuario=u.idUsuario
	AND m.idMaquinaVirtual=p_id;
	
END //
DELIMITER ;