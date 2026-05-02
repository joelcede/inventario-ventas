<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../services/VentaService.php';

class VentaController
{
    private PDO $db;
    private Producto $productoModel;
    private Venta $ventaModel;
    private VentaService $ventaService;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->productoModel = new Producto($this->db);
        $this->ventaModel = new Venta($this->db);
        $this->ventaService = new VentaService($this->db);
    }

    public function productosDisponibles(): array
    {
        return $this->productoModel->all();
    }

    public function index(): array
    {
        return $this->ventaModel->all();
    }

    public function store(array $data): array
    {
        $productoId = filter_var($data['producto_id'] ?? null, FILTER_VALIDATE_INT);
        $cantidad = filter_var($data['cantidad'] ?? null, FILTER_VALIDATE_INT);

        return $this->ventaService->registrarVenta((int)$productoId, (int)$cantidad);
    }
}
