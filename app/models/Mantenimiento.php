<?php
require_once __DIR__ . '/../config/db.php';

class Mantenimiento {
    private $conn;

    public $id_mantenimiento, $id_equipo, $tipo, $descripcion;
    public $fecha_programada, $fecha_ejecucion, $costo, $estado;
    public $id_tecnico_responsable;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function guardar() {
        $sql = "INSERT INTO mantenimientos
                (id_equipo, tipo, descripcion, fecha_programada,
                 fecha_ejecucion, costo, estado, id_tecnico_responsable)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $this->id_equipo, $this->tipo, $this->descripcion,
            $this->fecha_programada, $this->fecha_ejecucion ?: null,
            $this->costo ?: 0, $this->estado ?: 'Programado',
            $this->id_tecnico_responsable ?: null
        ]);
    }

    public function listarPorEquipo($id_equipo) {
        $sql = "SELECT m.*, u.nombre_completo AS tecnico
                FROM mantenimientos m
                LEFT JOIN usuarios u ON u.id = m.id_tecnico_responsable
                WHERE m.id_equipo = ?
                ORDER BY m.fecha_programada DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_equipo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}



