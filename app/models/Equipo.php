<?php
require_once __DIR__ . '/../config/db.php';

class Equipo {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function listar() {
        $sql = "SELECT e.*, 
                       emp.nombre AS empresa,
                       s.nombre_sede AS sede
                FROM equipos e
                LEFT JOIN empresas emp ON emp.id_empresa = e.id_empresa
                LEFT JOIN sedes s ON s.id_sede = e.id_sede
                ORDER BY e.id_equipo DESC";

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

   public function buscar($id) {
    $sql = "SELECT e.*, 
                   emp.nombre AS empresa,
                   s.nombre_sede AS sede
            FROM equipos e
            LEFT JOIN empresas emp ON emp.id_empresa = e.id_empresa
            LEFT JOIN sedes s ON s.id_sede = e.id_sede
            WHERE e.id_equipo = ?";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}



    public function guardar() {
        $sql = "INSERT INTO equipos (
            nombre_equipo, nomenclatura, tipo_equipo, marca, modelo, serial,
            procesador, memoria, tipo_disco, capacidad_disco, os,
            activo_fijo, numero_inventario, leasing, antivirus, estado,
            observacion, usuario_dominio, responsable, cedula_responsable,
            cargo, area, ceco, id_empresa, id_sede
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $this->nombre_equipo,
            $this->nomenclatura,
            $this->tipo_equipo,
            $this->marca,
            $this->modelo,
            $this->serial,
            $this->procesador,
            $this->memoria,
            $this->tipo_disco,
            $this->capacidad_disco,
            $this->os,
            $this->activo_fijo,
            $this->numero_inventario,
            $this->leasing,
            $this->antivirus,
            $this->estado,
            $this->observacion,
            $this->usuario_dominio,
            $this->responsable,
            $this->cedula_responsable,
            $this->cargo,
            $this->area,
            $this->ceco,
            $this->id_empresa,
            $this->id_sede
        ]);
    }
}
