<?php
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Venta.php';

class VentaService
{
    private Producto $productoModel;
    private Venta $ventaModel;

    public function __construct(private PDO $db)
    {
        $this->productoModel = new Producto($db);
        $this->ventaModel = new Venta($db);
    }

    public function registrarVenta(int $productoId, int $cantidad): array
    {
        if ($productoId <= 0) {
            return ['ok' => false, 'message' => 'Debe seleccionar un producto válido.'];
        }

        if ($cantidad <= 0) {
            return ['ok' => false, 'message' => 'La cantidad debe ser mayor a 0.'];
        }

        try {
            $this->db->beginTransaction();

            $producto = $this->productoModel->find($productoId);
            if (!$producto) {
                $this->db->rollBack();
                return ['ok' => false, 'message' => 'El producto no existe.'];
            }

            if ((int)$producto['stock'] < $cantidad) {
                $this->db->rollBack();
                return ['ok' => false, 'message' => 'Stock insuficiente para realizar la venta.'];
            }

            $total = (float)$producto['precio'] * $cantidad;

            $stockActualizado = $this->productoModel->reduceStock($productoId, $cantidad);
            if (!$stockActualizado) {
                $this->db->rollBack();
                return ['ok' => false, 'message' => 'No se pudo actualizar el stock.'];
            }

            $this->ventaModel->create($productoId, $cantidad, $total);
            $this->db->commit();

            return ['ok' => true, 'message' => 'Venta registrada correctamente.'];
        } catch (Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            return ['ok' => false, 'message' => 'Error registrando venta: ' . $e->getMessage()];
        }
    }
}
