CREATE TABLE Usuarios (
  id serial PRIMARY KEY,
  name varchar,
  gmail varchar,
  password varchar,
  status int
);

CREATE TABLE Listas (
  id serial PRIMARY KEY,
  usuario_id int,
  nombre varchar
);

CREATE TABLE Canciones (
  id serial PRIMARY KEY,
  nombre varchar,
  artista varchar,
  genro varchar
);

CREATE TABLE "ListaCancion" (
  id_Lista int,
  id_cancion int
);

CREATE TABLE ListaEnviada (
  id serial PRIMARY KEY,
  lista_id int,
  plataforma_id int
);

ALTER TABLE Listas ADD FOREIGN KEY (usuario_id) REFERENCES Usuarios (id);

ALTER TABLE ListaCancion ADD FOREIGN KEY (id_Lista) REFERENCES Listas (id);

ALTER TABLE ListaCancion ADD FOREIGN KEY (id_cancion) REFERENCES Canciones (id);

ALTER TABLE ListaEnviada ADD FOREIGN KEY (lista_id) REFERENCES Listas (id);
