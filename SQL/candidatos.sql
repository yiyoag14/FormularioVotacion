CREATE TABLE candidatos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    partido_politico VARCHAR(255) NOT NULL
);

INSERT INTO candidatos (id, nombre, partido_politico) VALUES 
(1, 'Miguel Torres', 'partido 1'),
(2, 'Isabella Vidal', 'partido 2'),
(3, 'Roberto Alarcón', 'partido 3'),
(4, 'Valeria Ponce', 'partido 4'),
(5, 'Leonardo Sanz', 'partido 5');
