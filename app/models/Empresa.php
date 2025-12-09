<?php
require_once __DIR__ . '/../config/db.php';

class Empresa {

    private $conn;

    public $id_empresa;
    public $nombre;
    public $estado;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function listar() {
        $stmt = $this->conn->query("SELECT * FROM empresas ORDER BY id_empresa DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar() {
        $stmt = $this->conn->prepare("INSERT INTO empresas (nombre, estado) VALUES (?, ?)");
        return $stmt->execute([$this->nombre, $this->estado]);
    }

    public function buscar($id) {
        $stmt = $this->conn->prepare("SELECT * FROM empresas WHERE id_empresa = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar() {
        $stmt = $this->conn->prepare("UPDATE empresas SET nombre = ?, estado = ? WHERE id_empresa = ?");
        return $stmt->execute([$this->nombre, $this->estado, $this->id_empresa]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM empresas WHERE id_empresa = ?");
        return $stmt->execute([$id]);
    }
}

