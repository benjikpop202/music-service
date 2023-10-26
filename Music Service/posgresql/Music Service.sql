
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    status VARCHAR(50) NOT NULL CHECK (status IN ('premium', 'regular'))
);

CREATE TABLE listas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    es_publica BOOLEAN NOT NULL,
    usuario_id INTEGER REFERENCES usuarios(id) ON DELETE CASCADE
);


CREATE TABLE canciones (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    artista VARCHAR(255) NOT NULL,
    genero VARCHAR(255) NOT NULL,
    lista_id INTEGER REFERENCES listas(id) ON DELETE CASCADE
);

