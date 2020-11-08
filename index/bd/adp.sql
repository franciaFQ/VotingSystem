create database votacion_adp;

use votacion_adp;

create table puestos(
	codigo_puesto int not null primary key auto_increment,
    nombre_puesto varchar(50) not null
)engine=innoDB;

create table tipos(
	codigo_tipo int not null primary key auto_increment,
    nombre_tipo varchar(50) not null
)engine=innoDB;

create table usuarios(
	carnet varchar(8)  not null primary key,
    nombre varchar(100) not null,
    estado varchar(50) default 'Sin votar',
    turno char(2),
    contrasena varchar(50),
    codigo_tipo int not null,
    FOREIGN KEY (codigo_tipo) REFERENCES tipos(codigo_tipo)
)engine=innoDB;

create table candidatos(
	codigo_candidato varchar(8) not null primary key,
    imagen varchar(100) not null,
    codigo_puesto int not null,
    FOREIGN KEY (codigo_candidato) REFERENCES usuarios(carnet),
    FOREIGN KEY (codigo_puesto) REFERENCES puestos(codigo_puesto)
)engine=innoDB;

create table votos(
    codigo_candidato varchar(8) not null,
    FOREIGN KEY (codigo_candidato) REFERENCES candidatos(codigo_candidato)
)engine=innoDB;

ALTER SCHEMA `votacion_adp`  DEFAULT CHARACTER SET utf8 ;
ALTER SCHEMA `votacion_adp`  DEFAULT COLLATE utf8_spanish_ci ;
/*DATOS*/
INSERT INTO `votacion_adp`.`puestos` (`nombre_puesto`) VALUES ('Coordinador');
INSERT INTO `votacion_adp`.`puestos` (`nombre_puesto`) VALUES ('Sub-Coordinador');
INSERT INTO `votacion_adp`.`puestos` (`nombre_puesto`) VALUES ('Tesorero');
INSERT INTO `votacion_adp`.`puestos` (`nombre_puesto`) VALUES ('Secretaria');

INSERT INTO `votacion_adp`.`tipos` (`nombre_tipo`) VALUES ('Alumno');
INSERT INTO `votacion_adp`.`tipos` (`nombre_tipo`) VALUES ('Teacher');
INSERT INTO `votacion_adp`.`tipos` (`nombre_tipo`) VALUES ('Jefe');

INSERT INTO votacion_adp.usuarios (carnet, nombre, contrasena, codigo_tipo) VALUES ('MM1526', 'Marvin Mejia', '123456', 2);
INSERT INTO votacion_adp.usuarios (carnet, nombre, contrasena, codigo_tipo) VALUES ('PP0717', 'Marielos Bonilla', '654321', 3);

INSERT INTO `votacion_adp`.`usuarios` (`carnet`, `nombre`, `turno`, `contrasena`, `codigo_tipo`) VALUES ('GA1234', 'Rodrigo Francia', '3T', 'GA1234', '1');
INSERT INTO `votacion_adp`.`usuarios` (`carnet`, `nombre`, `turno`, `contrasena`, `codigo_tipo`) VALUES ('RF', 'Jesus Francia', '3M', 'RF', '1');

insert into candidatos (codigo_candidato, imagen, codigo_puesto) VALUES
	('09CB2111',	'images/SE2.jpg',	4),
	('09CT2154',	'images/S1.jpg',	2),
	('09DQ2144',	'images/S2.jpg',	2),
	('09FF2121',	'images/C1.jpg',	1),
	('09FH2129',	'images/S3.jpg',	2),
	('09FV2156',	'images/C3.jpg',	1),
	('09IS2150',	'images/T1.jpg',	3),
	('09MV2158',	'images/SE3.jpg',	4),
	('09SM2134',	'images/S1.jpg',	1),
	('09XO2138',	'images/S2.jpg',	1),
	('09YH2126',	'images/S3.jpg',	2),
	('FQ1415',	'images/T1.jpg',	3);