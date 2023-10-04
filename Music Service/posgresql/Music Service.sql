CREATE TABLE Usuarios (
  id int PRIMARY KEY,
  codigo int,
  nombre varchar,
  gmail varchar,
  password varchar,
  status int,
);

CREATE TABLE Listas (
  id int PRIMARY KEY,
  usuario_id int,
  nombre varchar
);

CREATE TABLE Canciones (
  id int PRIMARY KEY,
  nombre varchar,
  artista varchar,
  genro varchar
);

CREATE TABLE ListaCancion (
  id_Lista int,
  id_cancion int
);

CREATE TABLE ListaEnviada (
  id int PRIMARY KEY,
  lista_id int,
  plataforma_id int
);

CREATE TABLE Plataforma (
  id int PRIMARY KEY,
  nombre varchar
);

ALTER TABLE Listas ADD FOREIGN KEY (usuario_id) REFERENCES Usuarios (id);

ALTER TABLE Usuarios ADD FOREIGN KEY (codigo) REFERENCES Plataforma (id);

ALTER TABLE ListaCancion ADD FOREIGN KEY (id_Lista) REFERENCES Listas (id);

ALTER TABLE ListaCancion ADD FOREIGN KEY (id_cancion) REFERENCES Canciones (id);

ALTER TABLE ListaEnviada ADD FOREIGN KEY (lista_id) REFERENCES Listas (id);

ALTER TABLE ListaEnviada ADD FOREIGN KEY (plataforma_id) REFERENCES Plataforma (id);
