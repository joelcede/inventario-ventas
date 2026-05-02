<?php
class Venta
{
    public function __construct(private PDO $db)
    {
    }

    public function all(): array
    {
        $stmt = $this->db->query(
            'SELECT v.id, v.producto_id, p.nombre AS producto, v.cantidad, v.total, v.fecha
             FROM ventas v
             INNER JOIN productos p ON p.id = v.producto_id
             ORDER BY v.id DESC'
        );

        return $stmt->fetchAll();
    }

    public function create(int $productoId, int $cantidad, float $total): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO ventas (producto_id, cantidad, total)
             VALUES (:producto_id, :cantidad, :total)'
        );

        return $stmt->execute([
            'producto_id' => $productoId,
            'cantidad' => $cantidad,
            'total' => $total,
        ]);
    }
}
