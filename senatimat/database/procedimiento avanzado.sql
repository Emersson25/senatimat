USE senatimat;


DELIMITER $$
CREATE PROCEDURE spu_estudiantes_listar()
BEGIN
		SELECT * FROM estudiantes;
		
		SELECT  EST.idestudiante,
					EST.apellidos, EST.nombres,
					EST.tipodocumento, EST.nrodocumento,
					EST.fechanacimiento,
					ESC.escuela,
					CAR.carrera,
					SED.sede,
					EST.fotografia
			FROM estudiantes EST
			INNER JOIN carreras CAR ON CAR.idcarrera = EST.idcarrera
			INNER JOIN sedes SED ON SED.idsede = EST.idsede
			INNER JOIN escuelas ESC ON ESC.idescuela = CAR.idescuela
			WHERE EST.estado = '1';
			

END$$ 


DELIMITER $$
CREATE PROCEDURE spu_estudiantes_registrar
(
		IN _apellidos 			VARCHAR(40),
		IN _nombres 			VARCHAR(40),
		IN _tipodocumento		CHAR(1),
		IN _nrodocumento		CHAR(8),
		IN _fechanacimiento	DATE,
		IN _idcarrera			INT,
		IN _idsede				INT,
		IN _fotografia			VARCHAR(100)
)
BEGIN
			-- VALIDAR EL CONTENIDO DE _FOTOGRAFIA
			IF _fotografia = '' THEN
				SET _fotografia = NULL;
			END IF;
			
		INSERT INTO estudiantes (apellidos, nombres, tipodocumento, nrodocumento, fechanacimiento, idcarrera, idsede, fotografia) VALUES
			 (_apellidos, _nombres, _tipodocumento, _nrodocumento, _fechanacimiento, _idcarrera, _idsede, _fotografia);
END$$ 
CALL spu_estudiantes_registrar('Ortiz Jacobo', 'Emersson','D','73039705','2002-11-25',2,1,'');
CALL spu_estudiantes_registrar('Lopera Zabala', 'Giovanni','C','03256981','1989-02-25',3,2,'');
SELECT * FROM estudiantes;


DELIMITER $$
CREATE PROCEDURE spu_estudiantes_eliminar()
BEGIN

END$$ 

-- SEDES
DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN 
	SELECT * FROM sedes ORDER BY 2;
END $$
CALL spu_sedes_listar();
-- ESCUELAS
DELIMITER $$
CREATE PROCEDURE spu_escuelas_listar()
BEGIN
	SELECT * FROM escuelas ORDER BY 2;
	END $$
	CALL spu_escuelas_listar();
	-- Carreras
DELIMITER $$
CREATE PROCEDURE spu_carreras_listar(IN _idescuela INT)
BEGIN
	 SELECT idcarrera, carrera
	 FROM carreras
	 WHERE idescuela = _idescuela;
	END $$
	
	CALL spu_carreras_listar(2);
	SELECT * FROM carreras;
	
	
