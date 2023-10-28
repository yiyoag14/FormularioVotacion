-- CREATE de la tabla regiones
CREATE TABLE regiones (
    id INT NOT NULL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

-- Insertando las regiones de Chile con ID manual, los id se agregan de forma manual 
-- teniendo en cuenta que no se agregarán más regiones por ahora
INSERT INTO regiones (id, nombre) VALUES 
(1, 'Región de Arica y Parinacota'),
(2, 'Región de Tarapacá'),
(3, 'Región de Antofagasta'),
(4, 'Región de Atacama'),
(5, 'Región de Coquimbo'),
(6, 'Región de Valparaíso'),
(7, 'Región del Libertador General Bernardo O’Higgins'),
(8, 'Región del Maule'),
(9, 'Región del Ñuble'),
(10, 'Región del Biobío'),
(11, 'Región de La Araucanía'),
(12, 'Región de Los Ríos'),
(13, 'Región de Los Lagos'),
(14, 'Región de Aysén del General Carlos Ibáñez del Campo'),
(15, 'Región de Magallanes y de la Antártica Chilena'),
(16, 'Región Metropolitana de Santiago');
