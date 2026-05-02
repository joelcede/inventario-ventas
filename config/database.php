<?php
class Database
{
    private const HOST = 'localhost';
    private const DB_NAME = 'inventario_ventas';
    private const USER = 'root';
    private const PASS = '';
    private const CHARSET = 'utf8mb4';

    public static function connect(): PDO
    {
        $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME . ';charset=' . self::CHARSET;

        try {
            return new PDO($dsn, self::USER, self::PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die('Error de conexión a la base de datos: ' . $e->getMessage());
        }
    }
}
