<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';

class ProductoController
{
    private Producto $productoModel;

    public function __construct()
    {
        $this->productoModel = new Producto(Database::connect());
    }

    public function index(): array
    {
        return $this->productoModel->all();
    }

    public function show(int $id): ?array
    {
        return $this->productoModel->find($id);
    }

    public function store(array $data): array
    {
        $validated = $this->validate($data);
        if (!$validated['ok']) {
            return $validated;
        }

        $this->productoModel->create(
            $validated['data']['nombre'],
            $validated['data']['descripcion'],
            $validated['data']['precio'],
            $validated['data']['stock']
        );

        return ['ok' => true, 'message' => 'Producto creado correctamente.'];
    }

    public function update(int $id, array $data): array
    {
        if ($id <= 0 || !$this->productoModel->find($id)) {
            return ['ok' => false, 'message' => 'Producto no encontrado.'];
        }

        $validated = $this->validate($data);
        if (!$validated['ok']) {
            return $validated;
        }

        $this->productoModel->update(
            $id,
            $validated['data']['nombre'],
            $validated['data']['descripcion'],
            $validated['data']['precio'],
            $validated['data']['stock']
        );

        return ['ok' => true, 'message' => 'Producto actualizado correctamente.'];
    }

    public function destroy(int $id): array
    {
        if ($id <= 0 || !$this->productoModel->find($id)) {
            return ['ok' => false, 'message' => 'Producto no encontrado.'];
        }

        try {
            $this->productoModel->delete($id);
            return ['ok' => true, 'message' => 'Producto eliminado correctamente.'];
        } catch (PDOException $e) {
            return ['ok' => false, 'message' => 'No se puede eliminar un producto con ventas registradas.'];
        }
    }

    private function validate(array $data): array
    {
        $nombre = trim($data['nombre'] ?? '');
        $descripcion = trim($data['descripcion'] ?? '');
        $precio = filter_var($data['precio'] ?? null, FILTER_VALIDATE_FLOAT);
        $stock = filter_var($data['stock'] ?? null, FILTER_VALIDATE_INT);

        if ($nombre === '') {
            return ['ok' => false, 'message' => 'El nombre no puede estar vacío.'];
        }

        if ($precio === false || $precio <= 0) {
            return ['ok' => false, 'message' => 'El precio debe ser mayor a 0.'];
        }

        if ($stock === false || $stock < 0) {
            return ['ok' => false, 'message' => 'El stock no puede ser negativo.'];
        }

        return [
            'ok' => true,
            'data' => [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio' => (float)$precio,
                'stock' => (int)$stock,
            ],
        ];
    }
}
