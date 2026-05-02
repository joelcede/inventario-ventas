<?php
require_once __DIR__ . '/../controllers/ProductoController.php';

$controller = new ProductoController();
$message = $_GET['message'] ?? '';
$error = ($_GET['error'] ?? '') === '1';
$editId = filter_var($_GET['edit'] ?? null, FILTER_VALIDATE_INT);
$editing = $editId ? $controller->show((int)$editId) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $result = $controller->store($_POST);
    } elseif ($action === 'update') {
        $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        $result = $controller->update((int)$id, $_POST);
    } elseif ($action === 'delete') {
        $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        $result = $controller->destroy((int)$id);
    } else {
        $result = ['ok' => false, 'message' => 'Acción no válida.'];
    }

    header('Location: productos.php?message=' . urlencode($result['message']) . '&error=' . ($result['ok'] ? '0' : '1'));
    exit;
}

$productos = $controller->index();

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
    <title>Productos</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <main class="container">
        <section class="header">
            <div class="brand">
                <h1>Productos</h1>
                <p>Crear, listar, editar y eliminar productos.</p>
            </div>
            <nav class="nav">
                <a href="index.php" class="btn-secondary">Inicio</a>
                <a href="ventas.php">Ventas</a>
            </nav>
        </section>

        <?php if ($message): ?>
            <div class="alert <?= $error ? 'error' : '' ?>"><?= h($message) ?></div>
        <?php endif; ?>

        <section class="grid">
            <article class="card">
                <h2><?= $editing ? 'Editar producto' : 'Nuevo producto' ?></h2>

                <form method="POST" action="productos.php">
                    <input type="hidden" name="action" value="<?= $editing ? 'update' : 'create' ?>">
                    <?php if ($editing): ?>
                        <input type="hidden" name="id" value="<?= h($editing['id']) ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" name="nombre" type="text" required value="<?= h($editing['nombre'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion"><?= h($editing['descripcion'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input id="precio" name="precio" type="number" step="0.01" min="0.01" required value="<?= h($editing['precio'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input id="stock" name="stock" type="number" min="0" required value="<?= h($editing['stock'] ?? '') ?>">
                    </div>

                    <div class="actions">
                        <button class="btn" type="submit"><?= $editing ? 'Guardar cambios' : 'Crear producto' ?></button>
                        <?php if ($editing): ?>
                            <a class="btn btn-secondary" href="productos.php">Cancelar</a>
                        <?php endif; ?>
                    </div>
                </form>
            </article>

            <article class="card">
                <h2>Listado</h2>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!$productos): ?>
                                <tr><td colspan="5">No hay productos registrados.</td></tr>
                            <?php endif; ?>

                            <?php foreach ($productos as $producto): ?>
                                <tr>
                                    <td><?= h($producto['id']) ?></td>
                                    <td>
                                        <strong><?= h($producto['nombre']) ?></strong><br>
                                        <small><?= h($producto['descripcion']) ?></small>
                                    </td>
                                    <td>$<?= number_format((float)$producto['precio'], 2) ?></td>
                                    <td><span class="badge"><?= h($producto['stock']) ?></span></td>
                                    <td>
                                        <div class="actions">
                                            <a class="btn btn-secondary" href="productos.php?edit=<?= h($producto['id']) ?>">Editar</a>
                                            <form method="POST" action="productos.php" onsubmit="return confirm('¿Eliminar este producto?');">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?= h($producto['id']) ?>">
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
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
