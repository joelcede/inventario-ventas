CREATE DATABASE IF NOT EXISTS inventario_ventas
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE inventario_ventas;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    descripcion TEXT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_productos_precio CHECK (precio > 0),
    CONSTRAINT chk_productos_stock CHECK (stock >= 0)
);

CREATE TABLE IF NOT EXISTS ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_ventas_cantidad CHECK (cantidad > 0),
    CONSTRAINT chk_ventas_total CHECK (total > 0),
    CONSTRAINT fk_ventas_producto FOREIGN KEY (producto_id)
        REFERENCES productos(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

INSERT INTO productos (nombre, descripcion, precio, stock) VALUES
('Mouse Gamer', 'Mouse RGB con 6 botones.', 18.50, 12),
('Teclado Mecánico', 'Teclado compacto mecánico.', 45.00, 8),
('Audífonos', 'Audífonos con micrófono.', 25.99, 15);
