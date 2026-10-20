<?php
require_once __DIR__ . '/../config/db.php';

class Movimiento {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function registrar($id_equipo, $tipo, $id_usr_origen, $id_usr_destino, $id_sede_origen, $id_sede_destino, $observaciones) {
        $sql = "INSERT INTO historial_movimientos
                (id_equipo, tipo_movimiento, id_usuario_origen, id_usuario_destino,
                 id_sede_origen, id_sede_destino, observaciones)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id_equipo, $tipo, $id_usr_origen, $id_usr_destino, $id_sede_origen, $id_sede_destino, $observaciones]);
    }

    public function listarPorEquipo($id_equipo) {
        $sql = "SELECT m.*,
                       uo.nombre_completo AS usuario_origen,
                       ud.nombre_completo AS usuario_destino,
                       so.nombre_sede AS sede_origen,
                       sd.nombre_sede AS sede_destino
                FROM historial_movimientos m
                LEFT JOIN usuarios uo ON uo.id = m.id_usuario_origen
                LEFT JOIN usuarios ud ON ud.id = m.id_usuario_destino
                LEFT JOIN sedes so    ON so.id_sede = m.id_sede_origen
                LEFT JOIN sedes sd    ON sd.id_sede = m.id_sede_destino
                WHERE m.id_equipo = ?
                ORDER BY m.fecha_movimiento DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_equipo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

