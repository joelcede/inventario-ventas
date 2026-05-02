<?php
function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario + Ventas</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <main class="container">
        <section class="header">
            <div class="brand">
                <h1>Sistema Inventario + Ventas</h1>
                <p>Gestión simple de productos y registro de ventas con PHP y MySQL.</p>
            </div>
            <nav class="nav">
                <a href="productos.php">Productos</a>
                <a href="ventas.php">Ventas</a>
            </nav>
        </section>

        <section class="home-cards">
            <a class="card" href="productos.php">
                <h2>CRUD Productos</h2>
                <p>Crear, listar, editar y eliminar productos con validaciones.</p>
            </a>
            <a class="card" href="ventas.php">
                <h2>Registro de Ventas</h2>
                <p>Registrar ventas y descontar automáticamente el stock.</p>
            </a>
        </section>
    </main>
</body>
</html>
