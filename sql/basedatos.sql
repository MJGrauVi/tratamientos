drop table if exists medicamentos;
drop table if exists pacientes;
drop table if exists tratamientos;
drop table if exists tratamiento_medicamentos;

-- Tabla para la clase Medicamento
CREATE TABLE medicamentos (
                              id INT PRIMARY KEY,
                              nombre_comercial VARCHAR(255) NOT NULL,
                              principio_activo VARCHAR(255) NOT NULL,
                              precio FLOAT DEFAULT 0
);

-- Tabla para la clase Paciente
CREATE TABLE pacientes (
                           id INT PRIMARY KEY,
                           nombre VARCHAR(255) NOT NULL,
                           numero_sip VARCHAR(50) NOT NULL UNIQUE,
                           fecha_nacimiento DATE NOT NULL,
                           alergias VARCHAR(255)
);

-- Tabla para la clase Tratamiento
CREATE TABLE tratamientos (
                              id INT PRIMARY KEY,
                              codigo_tratamiento VARCHAR(50) NOT NULL UNIQUE,
                              diagnostico VARCHAR(255) NOT NULL,
                              duracion_dias INT NOT NULL,
                              paciente_id INT NOT NULL,
                              CONSTRAINT fk_paciente_tratamiento FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE
);

-- Tabla intermedia para la relación Tratamiento "prescribe" Medicamento (N:M)
CREATE TABLE tratamiento_medicamentos (
                                          tratamiento_id INT NOT NULL,
                                          medicamento_id INT NOT NULL,
                                          PRIMARY KEY (tratamiento_id, medicamento_id),
                                          CONSTRAINT fk_tratamiento_med FOREIGN KEY (tratamiento_id) REFERENCES tratamientos(id) ON DELETE CASCADE,
                                          CONSTRAINT fk_medicamento_trat FOREIGN KEY (medicamento_id) REFERENCES medicamentos(id) ON DELETE CASCADE
);

-- Datos de ejemplo opcionales para pruebas
INSERT INTO medicamentos (id,nombre_comercial, principio_activo, precio) VALUES
                                                                          (1,'Paracetamol Cinfa', 'Paracetamol', 2.50),
                                                                          (2,'Ibuprofeno Kern Pharma', 'Ibuprofeno', 3.20),
                                                                          (3,'Amoxicilina Normon', 'Amoxicilina', 7.80);

INSERT INTO pacientes (id,nombre, numero_sip, fecha_nacimiento, alergias) VALUES
                                                                           (1,'Juan Pérez', 'SIP12345678', '1980-05-15', 'Alergia a la penicilina y los acaros'),
                                                                           (2,'María López', 'SIP87654321', '1992-11-20', 'Alergia al polen'),
                                                                           (3,'Alberto Sánchez', 'SIP46581822', '1999-04-18', 'Sin alergias conocidas'),
                                                                           (4,'Juana Carrillo', 'SIP65473899', '1975-08-01', 'Alergia a los frutos secos');


INSERT INTO tratamientos (id, codigo_tratamiento, diagnostico, duracion_dias, paciente_id) VALUES
                                                                                           (1,'TRT001', 'Fiebre y dolor de cabeza', 7, 1),
                                                                                           (2,'TRT002', 'Infección bacteriana', 10, 2);

INSERT INTO tratamiento_medicamentos (tratamiento_id, medicamento_id) VALUES
                                                                          (1, 1), -- TRT001 - Paracetamol
                                                                          (2, 3); -- TRT002 - Amoxicilina
