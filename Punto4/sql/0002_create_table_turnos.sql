USE paw;

CREATE TABLE turnos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre_del_paciente TEXT,
    email TEXT,
    telefono TEXT,
    edad INTEGER,
    talla_de_calzado INTEGER,
    altura DECIMAL,
    fecha_de_nacimiento TIMESTAMP,
    color_de_pelo TEXT,
    fecha_del_turno TIMESTAMP,
    horario_del_turno TEXT,
    imagen_diagnostico TEXT
);