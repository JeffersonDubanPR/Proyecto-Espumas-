<?php
require_once __DIR__ . '/../config/db.php';

class Baja {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function registrar($id_equipo, $fecha, $motivo, $valor_residual, $id_usuario) {
        $sql = "INSERT INTO bajas (id_equipo, fecha_baja, motivo, valor_residual, id_usuario_autoriza)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id_equipo, $fecha, $motivo, $valor_residual ?: 0, $id_usuario]);
    }

    public function buscarPorEquipo($id_equipo) {
        $stmt = $this->conn->prepare("SELECT * FROM bajas WHERE id_equipo = ? ORDER BY fecha_baja DESC LIMIT 1");
        $stmt->execute([$id_equipo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}