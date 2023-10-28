CREATE TABLE votos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    rut VARCHAR(12) NOT NULL UNIQUE, -- Para evitar votos duplicados
    nombre VARCHAR(255) NOT NULL,
    alias VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    region_id INT NOT NULL,
    comuna_id INT NOT NULL,
    candidato_id INT NOT NULL,
    como_se_entero VARCHAR(255), -- Podría ser un campo tipo TEXT si necesitas almacenar más información
    FOREIGN KEY (region_id) REFERENCES regiones(id) ON DELETE CASCADE,
    FOREIGN KEY (comuna_id) REFERENCES comunas(id) ON DELETE CASCADE,
    FOREIGN KEY (candidato_id) REFERENCES candidatos(id) ON DELETE CASCADE
);