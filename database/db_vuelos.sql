DROP DATABASE IF EXISTS db_vuelos;
CREATE DATABASE db_vuelos;
USE db_vuelos;

CREATE TABLE t_usuarios (
	usuario VARCHAR(10) NOT NULL,
	clave VARCHAR(10) NOT NULL,
	plantilla enum('plantilla1.css', 'plantilla2.css'),
	PRIMARY KEY (usuario)
);

CREATE TABLE t_rutas (
	origen VARCHAR(20) NOT NULL,
	destino VARCHAR(20) NOT NULL,
	PRIMARY KEY (origen, destino)
);

CREATE TABLE t_reservas (
	idReserva INT AUTO_INCREMENT NOT NULL,
	usuario VARCHAR(10) NOT NULL,
	origen VARCHAR(20) NOT NULL,
	destino VARCHAR(20) NOT NULL,
	fechaIda DATE NOT NULL,  /* 'aaaa-mm-dd' */
	fechaVuelta DATE NOT NULL, /* 'aaaa-mm-dd' */
	asiento INT NOT NULL,
	PRIMARY KEY (idReserva)
);

INSERT INTO t_usuarios (usuario, clave, plantilla) VALUES ('Usuario1', 'Usuario1', 'plantilla1.css');
INSERT INTO t_usuarios (usuario, clave, plantilla) VALUES ('Usuario2', 'Usuario2', 'plantilla2.css');

INSERT INTO t_rutas (origen, destino) VALUES ('Gran Canaria', 'Fuerteventura');
INSERT INTO t_rutas (origen, destino) VALUES ('Gran Canaria', 'Lanzarote');
INSERT INTO t_rutas (origen, destino) VALUES ('Lanzarote', 'Gran Canaria');
INSERT INTO t_rutas (origen, destino) VALUES ('Fuerteventura', 'Gran Canaria');

INSERT INTO t_reservas (usuario, origen, destino, fechaIda, fechaVuelta, asiento) VALUES ('Usuario1', 'Gran Canaria', 'Lanzarote', '2018-01-15', '2018-01-21', 2);
INSERT INTO t_reservas (usuario, origen, destino, fechaIda, fechaVuelta, asiento) VALUES ('Usuario1', 'Fuerteventura', 'Gran Canaria', '2018-03-16', '2018-03-17', 6);
INSERT INTO t_reservas (usuario, origen, destino, fechaIda, fechaVuelta, asiento) VALUES ('Usuario1', 'Gran Canaria', 'Lanzarote', '2017-12-28', '2017-12-28', 4);
INSERT INTO t_reservas (usuario, origen, destino, fechaIda, fechaVuelta, asiento) VALUES ('Usuario2', 'Fuerteventura', 'Gran Canaria', '2018-01-17', '2018-01-18', 8);

SELECT * FROM t_usuarios;
SELECT * FROM t_rutas;
SELECT * FROM t_reservas;

