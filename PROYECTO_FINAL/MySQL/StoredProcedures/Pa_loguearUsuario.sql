DELIMITER //
CREATE PROCEDURE loguearUsuario
(
p_usuario varchar(20),
p_pass varchar(50)
)
BEGIN

	SELECT *
	FROM usuario
	WHERE usuario=p_usuario AND pass=password(p_pass);
	
END //
DELIMITER ;