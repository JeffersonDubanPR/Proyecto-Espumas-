<?php
require_once __DIR__ . '/../config/db.php';

class User {

    private $conn;

    public $id;
    public $nombre_completo;
    public $usuario;
    public $password_hash;
    public $estado;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // 🔹 Listar usuarios
    public function listar() {
        $sql = "SELECT id, nombre_completo, usuario, estado FROM usuarios ORDER BY id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Guardar nuevo usuario
    public function guardar() {
        $stmt = $this->conn->prepare("
            INSERT INTO usuarios (nombre_completo, usuario, password_hash, estado)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $this->nombre_completo,
            $this->usuario,
            $this->password_hash,
            $this->estado
        ]);
    }

    // 🔹 Buscar un usuario
    public function buscar($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Actualizar sin contraseña
    public function actualizar() {
        $stmt = $this->conn->prepare("
            UPDATE usuarios SET nombre_completo=?, usuario=?, estado=? WHERE id=?
        ");

        return $stmt->execute([
            $this->nombre_completo,
            $this->usuario,
            $this->estado,
            $this->id
        ]);
    }

    // 🔹 Actualizar contraseña
    public function actualizarPassword() {
        $stmt = $this->conn->prepare("UPDATE usuarios SET password_hash=? WHERE id=?");
        return $stmt->execute([$this->password_hash, $this->id]);
    }

    // 🔹 El login lo usa
    public function findByUsername($usuario) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

