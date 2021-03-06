CREATE DATABASE webseries;

CREATE TABLE Usuario (
	id INT PRIMARY KEY,
	nombre VARCHAR(40),
	primer_apellido VARCHAR(255),
	segundo_apellido VARCHAR(255),
	num_telefono UNIQUE INT,
	password_hashed VARCHAR(255)	
);

CREATE TABLE Serie (
	id INT PRIMARY KEY,
	nombre VARCHAR(255),
	autor VARCHAR(255),
	fecha_creacion DATETIME,
	num_temporadas INT,
	num_episodios INT,
	url_caractula VARCHAR(500)
);

CREATE TABLE Comentario (
	id INT PRIMARY KEY,
	id_usuario INT,
	id_serie INT NOT NULL,
	CONSTRAINT fk_usuario FOREIGN KEY (id_usuario)
	REFERENCES Usuario (id),
	CONSTRAINT fk_serie FOREIGN KEY (id_serie)
	REFERENCES Serie (id),
	comentario VARCHAR(400)
);
