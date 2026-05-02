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
- <img width="1584" height="848" alt="image" src="https://github.com/user-attachments/assets/9d265510-e819-4479-b761-730344bcfa1a" />

- Módulo de ventas.
- <img width="1873" height="971" alt="image" src="https://github.com/user-attachments/assets/98dab89b-d942-435a-bd9b-6b1130b09830" />


## Sugerencia de commits para GitHub

La actividad pide mínimo 7 commits reales. Puedes usar esta secuencia:

```bash
git init
git add README.md
git commit -m "Agregar README inicial"

git add database/inventario.sql
git commit -m "Crear script de base de datos"

git add config/database.php
git commit -m "Configurar conexión PDO"

git add models/
git commit -m "Agregar modelos de productos y ventas"

git add controllers/
git commit -m "Agregar controladores principales"

git add services/
git commit -m "Agregar servicio para registrar ventas"

git add public/
git commit -m "Crear interfaz web del sistema"
```

## Autor

Proyecto académico de inventario y ventas simple.
