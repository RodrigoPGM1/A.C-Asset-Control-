-- Seleccionar la base de datos
USE sistemaac;

-- Crear la tabla 'recibidos'
CREATE TABLE recibidos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, -- Usamos BIGINT para manejar muchos registros
    oficina VARCHAR(255) NOT NULL,                -- Nombre de la oficina
    documento VARCHAR(255) NOT NULL,              -- Número o referencia del documento
    expediente VARCHAR(255),                      -- Número de expediente, si aplica
    firma VARCHAR(255),                           -- Nombre de la persona que firma el documento
    cargo VARCHAR(255),                           -- Cargo de la persona que firma el documento
    oficio VARCHAR(255),                          -- Número o referencia del oficio, si aplica
    asunto TEXT,                                  -- Descripción del asunto
    fecha DATE,                                   -- Fecha de recepción del documento
    INDEX idx_fecha (fecha),                      -- Índice en la columna 'fecha' para mejorar el rendimiento de consultas
    INDEX idx_oficina (oficina),                  -- Índice en la columna 'oficina'
    INDEX idx_expediente (expediente)             -- Índice en la columna 'expediente'
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;               -- InnoDB para mejor rendimiento en tablas grandes y ROW_FORMAT para manejar campos TEXT eficientemente
 
-- Crearla tabla emitidos --

USE sistemaac;

CREATE TABLE emitidos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    oficina VARCHAR(255) NOT NULL,
    firma VARCHAR(255),
    asunto TEXT,
    adjunto VARCHAR(255),
    fecha DATE,
    INDEX idx_fecha (fecha),
    INDEX idx_oficina (oficina)
) ENGINE=InnoDB ROW_FORMAT=DYNAMIC;

-- Agregar identificador para numeros --
ALTER TABLE recibidos
ADD COLUMN numero VARCHAR(50) NOT NULL;

--pendientes--
CREATE TABLE pendientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(255) NOT NULL,
    prioridad TINYINT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


