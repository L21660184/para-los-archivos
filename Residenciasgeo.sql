-- Creaci�n de la base de datos
CREATE DATABASE Residencias;

-- Usar la base de datos reci�n creada
USE Residencias;


CREATE TABLE Proyectos (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nombre_empresa VARCHAR(255) NOT NULL,
    contacto_empresa VARCHAR(255) NOT NULL,
    nombre_proyecto VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    archivo VARCHAR(255) NOT NULL -- Ruta del archivo subido (puedes usar almacenamiento de archivos o almacenamiento en base de datos)
);
 select * from Proyectos

