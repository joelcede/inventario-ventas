<?php
require_once __DIR__ . '/../controllers/VentaController.php';

$controller = new VentaController();
$message = $_GET['message'] ?? '';
$error = ($_GET['error'] ?? '') === '1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->store($_POST);
    header('Location: ventas.php?message=' . urlencode($result['message']) . '&error=' . ($result['ok'] ? '0' : '1'));
    exit;
}

$productos = $controller->productosDisponibles();
$ventas = $controller->index();

function h(?string $value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <main class="container">
        <section class="header">
            <div class="brand">
                <h1>Ventas</h1>
                <p>Registrar ventas y descontar stock automáticamente.</p>
            </div>
            <nav class="nav">
                <a href="index.php" class="btn-secondary">Inicio</a>
                <a href="productos.php">Productos</a>
            </nav>
        </section>

        <?php if ($message): ?>
            <div class="alert <?= $error ? 'error' : '' ?>"><?= h($message) ?></div>
        <?php endif; ?>

        <section class="grid">
            <article class="card">
                <h2>Nueva venta</h2>
                <form method="POST" action="ventas.php">
                    <div class="form-group">
                        <label for="producto_id">Producto</label>
                        <select id="producto_id" name="producto_id" required>
                            <option value="">Seleccione...</option>
                            <?php foreach ($productos as $producto): ?>
                                <option value="<?= h($producto['id']) ?>">
                                    <?= h($producto['nombre']) ?> - Stock: <?= h($producto['stock']) ?> - $<?= number_format((float)$producto['precio'], 2) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" name="cantidad" type="number" min="1" required>
                    </div>

                    <button class="btn" type="submit">Registrar venta</button>
                </form>
            </article>

            <article class="card">
                <h2>Historial de ventas</h2>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!$ventas): ?>
                                <tr><td colspan="5">No hay ventas registradas.</td></tr>
                            <?php endif; ?>

                            <?php foreach ($ventas as $venta): ?>
                                <tr>
                                    <td><?= h($venta['id']) ?></td>
                                    <td><?= h($venta['producto']) ?></td>
                                    <td><?= h($venta['cantidad']) ?></td>
                                    <td>$<?= number_format((float)$venta['total'], 2) ?></td>
                                    <td><?= h($venta['fecha']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </article>
        </section>
    </main>
</body>
</html>
