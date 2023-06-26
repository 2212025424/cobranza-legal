-- CREAMOS UN NUEVO USUARIO EN LA BASE DE DATOS ÚNICAMENTE PARA LA NUEVA BASE DE DATOS
CREATE USER 'usercobranzalegal'@'localhost' IDENTIFIED BY '$us3rC0branzal3gal';

-- ASIGNAMOS LOS PERMISOS AL NUEVO USUARIO
GRANT ALL PRIVILEGES ON cobranzalegaldb.* TO 'usercobranzalegal'@'localhost';

-- REFRESCAMOS LOS PERMISOS
FLUSH PRIVILEGES;

-- CREAMOS LA BASE DE DATOS
CREATE DATABASE cobranzalegaldb CHARACTER SET utf8;

-- CAMBIAMOS A LA BASE DE DATOS
USE cobranzalegaldb;

-- CREAMOS LA TABLA DE OFICINA
CREATE TABLE office (
    clv INT NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
    city_name VARCHAR(50) NOT NULL UNIQUE,
    address VARCHAR(250) NOT NULL UNIQUE,
    phone VARCHAR(50) NOT NULL UNIQUE,
    maps_url VARCHAR(250) NOT NULL UNIQUE,
    image_url VARCHAR(250) NOT NULL
) ENGINE = INNODB;

-- CREAMOS LA TABLA DE usuarios para el login
CREATE TABLE user (
    clv INT NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(250) NOT NULL UNIQUE
) ENGINE = INNODB;

-- CREAMOS LA TABLA DE CATEGORÍAS DE LOS ARTICULOS
CREATE TABLE category_article (
    clv INT NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
) ENGINE = INNODB;

-- CREAMOS LA TABLA DE ARTICULOS
CREATE TABLE article (
    clv INT NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
    clv_category INT NOT NULL,
    title VARCHAR(100) NOT NULL UNIQUE,
    summary VARCHAR (250) NOT NULL,
    body TEXT NOT NULL,
    date DATE NOT NULL,
    image_url VARCHAR(250) NOT NULL UNIQUE,
    FOREIGN KEY (clv_category) 
        REFERENCES category_article (clv) 
            ON DELETE RESTRICT
            ON UPDATE RESTRICT
) ENGINE = INNODB;

-- CREAMOS LA TABLA DE ROLES DE EMPLEADOS
CREATE TABLE rol_employee (
    clv INT NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
) ENGINE = INNODB;

-- CREAMOS LA TABLA DE EMPLEADOS
CREATE TABLE employee (
    clv INT NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
    clv_rol INT NOT NULL,
    name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(250) NOT NULL UNIQUE,
    image_url VARCHAR(250) NOT NULL UNIQUE,
    FOREIGN KEY (clv_rol) 
        REFERENCES rol_employee (clv) 
            ON DELETE RESTRICT
            ON UPDATE RESTRICT
) ENGINE = INNODB;

-- CREAMOS LA TABLA DE CATEGORÍA DE CONTACTOS
CREATE TABLE category_contact (
    clv INT NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
    -- name VARCHAR(100) NOT NULL UNIQUE,
    icon_url VARCHAR(250) NOT NULL UNIQUE
) ENGINE = INNODB;

-- CREAMOS LA TABLA DE CONTACTOS DE EMPLEADOS
CREATE TABLE contact_employee (
    clv INT NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
    clv_contact INT NOT NULL,
    clv_employee INT NOT NULL,
    url_contact VARCHAR(250) NOT NULL UNIQUE,
    FOREIGN KEY (clv_contact) 
        REFERENCES category_contact (clv) 
            ON DELETE RESTRICT
            ON UPDATE RESTRICT,
    FOREIGN KEY (clv_employee) 
        REFERENCES employee (clv) 
            ON DELETE RESTRICT
            ON UPDATE RESTRICT
) ENGINE = INNODB;

-- AGREGAMOS LA COLUMNA nombre A LA TABLA category_contact;
ALTER TABLE category_contact ADD name VARCHAR(100) NOT NULL UNIQUE;

-- INSERTAMOS POR DEFECTO EL USUARIO
INSERT INTO `user`(`clv`, `name`, `password`) VALUES ('1','admin',md5('adm1n_cobranza1ega1'));

-- INSERTAMOS POR DEFECTO LAS CATEGORÍAS DE LOS ARTICULOS
INSERT INTO `category_article`(`clv`, `name`) VALUES ('1','Asesoría'), ('2','Bufete Bautista TV'), ('3','General'), ('4','Sin categoría');

-- INSERTAMOS POR DEFECTO LOS ROLES DE LOS EMPLEADOS
INSERT INTO `rol_employee`(`clv`, `name`) VALUES ('1','Dirección'), ('2','Abogados'), ('3','Contadores');

-- INSERTAMOS POR DEFECTO LOS TIPOS DE CONTACTO
INSERT INTO `category_contact`(`clv`, `icon_url`, `name`) VALUES ('1','linkedIn','linkedIn'), ('2','Instagram','Instagram'), ('3','e-mail','e-mail');

-- OBTENER LOS ARTICULOS
SELECT a.clv AS clv, c.name AS category, a.title, a.summary, a.body, a.date, image_url FROM article a, category_article c WHERE a.clv_category = c.clv;

-- OBTENER LOS EMPLEADOS
SELECT e.clv AS clv, r.name AS rol, e.name AS name, e.description, e.image_url
FROM employee e INNER JOIN rol_employee r ON e.clv_rol = r.clv 
ORDER by e.clv;

-- OBTENER LAS REDES DE UN EMPLEADO
SELECT cc.icon_url as icon_url, ce.url_contact 
FROM category_contact cc INNER JOIN contact_employee ce ON cc.clv = ce.clv_contact
WHERE ce.clv_employee = 1
ORDER BY ce.clv;


SELECT cc.icon_url as icon_url, ce.url_contact FROM category_contact cc INNER JOIN contact_employee ce ON cc.clv = ce.clv_contact WHERE ce.clv_employee = :p_clv ORDER BY ce.clv;

-- 120 hosting Digital Ocean
-- 130 dominio CloudFlare
-- 3,000 Desarrollo de app
