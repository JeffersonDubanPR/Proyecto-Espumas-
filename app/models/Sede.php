<?php
require_once __DIR__ . '/../config/db.php';

class Sede {

    private $conn;

    public $id_sede;
    public $id_empresa;
    public $nombre_sede;
    public $ciudad;
    public $direccion;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function listar() {
        $sql = "SELECT s.*, e.nombre AS empresa
                FROM sedes s
                INNER JOIN empresas e ON e.id_empresa = s.id_empresa
                ORDER BY s.id_sede DESC";

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar() {
        $stmt = $this->conn->prepare("INSERT INTO sedes (id_empresa, nombre_sede, ciudad, direccion) 
                                      VALUES (?, ?, ?, ?)");

        return $stmt->execute([
            $this->id_empresa,
            $this->nombre_sede,
            $this->ciudad,
            $this->direccion
        ]);
    }

    public function buscar($id) {
        $stmt = $this->conn->prepare("SELECT * FROM sedes WHERE id_sede = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar() {
        $stmt = $this->conn->prepare("UPDATE sedes 
                                      SET id_empresa=?, nombre_sede=?, ciudad=?, direccion=? 
                                      WHERE id_sede=?");

        return $stmt->execute([
            $this->id_empresa,
            $this->nombre_sede,
            $this->ciudad,
            $this->direccion,
            $this->id_sede
        ]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM sedes WHERE id_sede = ?");
        return $stmt->execute([$id]);
    }
}
