DROP DATABASE IF EXISTS inventario_ti;
CREATE DATABASE inventario_ti CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE inventario_ti;

CREATE TABLE empresas (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    estado TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE sedes (
    id_sede INT AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT NOT NULL,
    nombre_sede VARCHAR(150) NOT NULL,
    ciudad VARCHAR(100) DEFAULT NULL,
    direccion VARCHAR(200) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa) ON DELETE CASCADE
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(150) NOT NULL,
    usuario VARCHAR(80) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('ADMIN','TECNICO','CONSULTOR') DEFAULT 'CONSULTOR',
    estado TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE equipos (
    id_equipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_equipo VARCHAR(150),
    nomenclatura VARCHAR(100),
    tipo_equipo VARCHAR(100),
    marca VARCHAR(100),
    modelo VARCHAR(100),
    serial VARCHAR(150),
    procesador VARCHAR(150),
    memoria VARCHAR(50),
    tipo_disco VARCHAR(50),
    capacidad_disco VARCHAR(50),
    os VARCHAR(100),
    activo_fijo VARCHAR(100),
    numero_inventario VARCHAR(100),
    leasing VARCHAR(10) DEFAULT 'N/A',
    antivirus VARCHAR(10) DEFAULT 'N/A',
    estado TINYINT(1) DEFAULT 1,
    estado_ciclo ENUM('Registrado','En Uso','En Mantenimiento','De Baja') DEFAULT 'Registrado',
    observacion TEXT,
    usuario_dominio VARCHAR(100),
    responsable VARCHAR(150),
    cedula_responsable VARCHAR(50),
    cargo VARCHAR(100),
    area VARCHAR(100),
    ceco VARCHAR(50),
    id_empresa INT,
    id_sede INT,
    valor_compra DECIMAL(12,2) DEFAULT NULL,
    fecha_adquisicion DATE DEFAULT NULL,
    fecha_fin_garantia DATE DEFAULT NULL,
    tiene_monitor VARCHAR(50),
    marca_monitor VARCHAR(100),
    modelo_monitor VARCHAR(100),
    serial_monitor VARCHAR(100),
    activo_fijo_monitor VARCHAR(100),
    numero_inventario_monitor VARCHAR(100),
    acta_entrega VARCHAR(100),
    mtto_preventivo VARCHAR(100),
    firma_correo VARCHAR(100),
    nuevo VARCHAR(10) DEFAULT 'N/A',
    teclado VARCHAR(100),
    mouse VARCHAR(100),
    base_refrigerante VARCHAR(100),
    licencia_windows VARCHAR(150),
    windows_licenciado VARCHAR(50),
    conexion_sap VARCHAR(50),
    bitlocker_id VARCHAR(150),
    password_bitlocker VARCHAR(150),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa) ON DELETE SET NULL,
    FOREIGN KEY (id_sede) REFERENCES sedes(id_sede) ON DELETE SET NULL
);

CREATE TABLE historial_movimientos (
    id_movimiento INT AUTO_INCREMENT PRIMARY KEY,
    id_equipo INT NOT NULL,
    tipo_movimiento ENUM('Asignación','Devolución','Traslado','Baja') NOT NULL,
    id_usuario_origen INT DEFAULT NULL,
    id_usuario_destino INT DEFAULT NULL,
    id_sede_origen INT DEFAULT NULL,
    id_sede_destino INT DEFAULT NULL,
    fecha_movimiento DATETIME DEFAULT CURRENT_TIMESTAMP,
    observaciones TEXT,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE
);

CREATE TABLE mantenimientos (
    id_mantenimiento INT AUTO_INCREMENT PRIMARY KEY,
    id_equipo INT NOT NULL,
    tipo ENUM('Preventivo','Correctivo') NOT NULL,
    descripcion TEXT,
    fecha_programada DATE,
    fecha_ejecucion DATE,
    costo DECIMAL(10,2) DEFAULT 0,
    estado ENUM('Programado','En Proceso','Completado','Cancelado') DEFAULT 'Programado',
    id_tecnico_responsable INT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE
);

CREATE TABLE bajas (
    id_baja INT AUTO_INCREMENT PRIMARY KEY,
    id_equipo INT NOT NULL,
    fecha_baja DATE NOT NULL,
    motivo TEXT,
    valor_residual DECIMAL(10,2) DEFAULT 0,
    id_usuario_autoriza INT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE
);

INSERT INTO empresas (nombre, estado) VALUES ('Grupo Espumas Santa Fe', 1);
INSERT INTO sedes (id_empresa, nombre_sede, ciudad, direccion) VALUES (1, 'Sede Principal', 'Bogotá', 'Calle Principal 123');