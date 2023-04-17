CREATE DATABASE senatimat;
USE senatimat;
CREATE TABLE escuelas
(
		idescuela			INT AUTO_INCREMENT PRIMARY KEY,
		escuela				VARCHAR(50) NOT NULL,
		CONSTRAINT uk_escuela_esc UNIQUE (escuela)
		
)ENGINE=INNODB;

INSERT INTO escuelas (escuela) VALUES
		('ETI'),
		('Administracion'),
		('Metal mecanica');
		
		SELECT * FROM escuelas ORDER BY 1;
		-- Segunda tabla
		
CREATE TABLE carreras
(
		idcarerra		 INT AUTO_INCREMENT PRIMARY KEY,
		idescuela		 INT NOT NULL,
		carrera			 VARCHAR(100)  NOT NULL,
		CONSTRAINT fk_idescuela_car FOREIGN KEY (idescuela) REFERENCES escuelas (idescuela),
		CONSTRAINT uk_carerra_car UNIQUE (carrera)
		
)ENGINE = INNODB;

INSERT INTO carreras (idescuela, carrera)VALUES
	(1,'Diseño Grafico Digital'),
	(1, 'Ingeneria de software con IA'),
	(1, 'Cyberseguridad'),
	(2,'Administracion de empresas'),
	(2,'Administracion Industrial'),
	(2,'Prevencionista de Riesgo'),
	(3,'Soldador Universal'),
	(3,'Mecanico de mantenimiento'),
	(3,'Soldador estructuras metalicas');
	
	SELECT * FROM carreras ORDER BY 1;
	
	-- Tercera tabla 
	CREATE TABLE sedes
	(
		idsede		INT AUTO_INCREMENT PRIMARY KEY,
		sede			VARCHAR(40) NOT NULL,
		CONSTRAINT uk_sede_sde UNIQUE (sede)
	)ENGINE = INNODB;
	
	INSERT INTO sedes (sede) VALUES
	('Chincha'),
	('Pisco'),
	('Ica'),
	('Ayacucho');
	SELECT * FROM sedes ORDER BY 1;
	
	-- Cuarta tabla
	CREATE TABLE estudiantes
	(
				idestudiante		INT AUTO_INCREMENT PRIMARY KEY,
				apellidos			VARCHAR(40)		NOT NULL,
				nombres				VARCHAR(40) 	NOT NULL,
				tipodocumento		CHAR(1)			NOT NULL DEFAULT 'D',
				nrodocumento		CHAR(8)			NOT NULL,
				fechanacimiento	DATE 				NOT NULL,
				idcarrera			INT 				NOT NULL,
				idsede				INT 				NOT NULL,
				fotografia			VARCHAR(100)	NULL,
				fecharegistro		DATETIME			NOT NULL DEFAULT NOW(),
				fechaupdate			DATETIME			NULL,
				estado				CHAR(1)			NOT NULL DEFAULT '1',
				CONSTRAINT uk_nrodocumento_est UNIQUE (tipodocumento, nrodocumento),
				CONSTRAINT fk_idcarrera_est	FOREIGN KEY (idcarrera) REFERENCES carreras (idcarerra),
				CONSTRAINT fk_sede_est FOREIGN KEY (idsede) REFERENCES sedes (idsede)
	)ENGINE = INNODB;
	
	INSERT INTO estudiantes (apellidos, nombres, nrodocumento, fechanacimiento, idcarrera, idsede) VALUES
		('Martinez', 'Carlos', '444445555', '2002-01-01', 1,1),
		('Ochoa', 'Fiorella', '77778888', '2000-10-10', 4,2),
		('Peres','Roxana','88881111','2001-03-03',7,3),
		('Quintana','Tania','33334444','2001-05-05',9,4);
		SELECT * FROM estudiantes;