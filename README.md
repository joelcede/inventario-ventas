# Sistema Web: Inventario + Ventas Simple

Sistema web desarrollado en **PHP + MySQL** para gestionar productos y registrar ventas de forma sencilla.

## Funcionalidades

- Crear productos.
- Listar productos.
- Editar productos.
- Eliminar productos.
- Registrar ventas.
- Descontar stock automáticamente al vender.
- Validaciones básicas:
  - Nombre obligatorio.
  - Precio mayor a 0.
  - Stock mayor o igual a 0.
  - No permite vender si no hay stock suficiente.

## Estructura del proyecto

```text
inventario-ventas/
├── config/
│   └── database.php
├── controllers/
│   ├── ProductoController.php
│   └── VentaController.php
├── models/
│   ├── Producto.php
│   └── Venta.php
├── services/
│   └── VentaService.php
├── public/
│   ├── assets/
│   │   └── style.css
│   ├── index.php
│   ├── productos.php
│   └── ventas.php
├── database/
│   └── inventario.sql
└── README.md
```

## Requisitos

- PHP 8 o superior.
- MySQL o MariaDB.
- Servidor local como XAMPP, Laragon o Apache + PHP.
- Git.

## Instalación con XAMPP

1. Instalar XAMPP.
2. Iniciar **Apache** y **MySQL** desde el panel de XAMPP.
3. Copiar la carpeta `inventario-ventas` dentro de:

```text
C:\xampp\htdocs\
```

4. Abrir phpMyAdmin:

```text
http://localhost/phpmyadmin
```

5. Importar el archivo:

```text
database/inventario.sql
```

6. Abrir el sistema en el navegador:

```text
http://localhost/inventario-ventas/public/
```

## Configuración de base de datos

Archivo: `config/database.php`

```php
private const HOST = 'localhost';
private const DB_NAME = 'inventario_ventas';
private const USER = 'root';
private const PASS = '';
```

En XAMPP normalmente el usuario es `root` y la contraseña queda vacía.

## Seguridad básica aplicada

- Uso de PDO.
- Consultas preparadas para evitar SQL Injection.
- Escape de salida con `htmlspecialchars`.
- Validaciones en servidor.
- Eliminación mediante método POST.
- Transacciones al registrar ventas.

## Usuarios de prueba

Este sistema no incluye login, por lo que no requiere usuarios de prueba.

## Capturas

Agregar aquí capturas de:

- Pantalla principal.
- <img width="1585" height="843" alt="image" src="https://github.com/user-attachments/assets/9631f658-aaab-40f6-bb19-453175aba5c9" />

- Módulo de productos.
<img width="1584" height="848" alt="image" src="https://github.com/user-attachments/assets/9d265510-e819-4479-b761-730344bcfa1a" />
<img width="1522" height="776" alt="image" src="https://github.com/user-attachments/assets/dc9b2720-d34b-4542-bfc6-c53ad1c98304" />
<img width="497" height="618" alt="image" src="https://github.com/user-attachments/assets/ed474fea-530c-4a0f-920f-70d82e260fc6" />
<img width="469" height="574" alt="image" src="https://github.com/user-attachments/assets/bb296906-9109-45c2-81a7-1ebe89b319a5" />

- Módulo de ventas.
- <img width="1873" height="971" alt="image" src="https://github.com/user-attachments/assets/98dab89b-d942-435a-bd9b-6b1130b09830" />
<img width="461" height="441" alt="image" src="https://github.com/user-attachments/assets/0ef37720-1c3e-4da0-840b-2314c0b97e13" />


## Autor

Proyecto académico de inventario y ventas simple.
