<?php
class Producto
{
    public function __construct(private PDO $db)
    {
    }

    public function all(): array
    {
        $stmt = $this->db->query('SELECT * FROM productos ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM productos WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $producto = $stmt->fetch();

        return $producto ?: null;
    }

    public function create(string $nombre, string $descripcion, float $precio, int $stock): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO productos (nombre, descripcion, precio, stock)
             VALUES (:nombre, :descripcion, :precio, :stock)'
        );

        return $stmt->execute([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
        ]);
    }

    public function update(int $id, string $nombre, string $descripcion, float $precio, int $stock): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE productos
             SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock
             WHERE id = :id'
        );

        return $stmt->execute([
            'id' => $id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM productos WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function reduceStock(int $id, int $cantidad): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE productos
             SET stock = stock - :cantidad
             WHERE id = :id AND stock >= :cantidad'
        );

        $stmt->execute([
            'id' => $id,
            'cantidad' => $cantidad,
        ]);

        return $stmt->rowCount() === 1;
    }
}
