<?php
require_once __DIR__ . '/../config/db.php';

class Equipo {

    private $conn;

    // Atributos del equipo
    public $id_equipo;
    public $nombre_equipo;
    public $nomenclatura;
    public $tipo_equipo;
    public $marca;
    public $modelo;
    public $serial;
    public $procesador;
    public $memoria;
    public $tipo_disco;
    public $capacidad_disco;
    public $os;
    public $activo_fijo;
    public $numero_inventario;
    public $leasing;
    public $antivirus;
    public $estado;
    public $observacion;

    // Nuevos campos
    public $usuario_dominio;
    public $responsable;
    public $cedula_responsable;
    public $cargo;
    public $area;
    public $ceco;

    public $id_empresa;
    public $id_sede;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function listar() {
        $sql = "SELECT e.*, emp.nombre AS empresa, s.nombre_sede AS sede
                FROM equipos e
                LEFT JOIN empresas emp ON emp.id_empresa = e.id_empresa
                LEFT JOIN sedes s ON s.id_sede = e.id_sede
                ORDER BY e.id_equipo DESC";

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id) {
        $stmt = $this->conn->prepare("
            SELECT e.*, emp.nombre AS empresa, s.nombre_sede AS sede
            FROM equipos e
            LEFT JOIN empresas emp ON emp.id_empresa = e.id_empresa
            LEFT JOIN sedes s ON s.id_sede = e.id_sede
            WHERE e.id_equipo = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar() {
        $sql = "INSERT INTO equipos (
                nombre_equipo, nomenclatura, tipo_equipo, marca, modelo, serial,
                procesador, memoria, tipo_disco, capacidad_disco, os,
                activo_fijo, numero_inventario, leasing, antivirus, estado,
                observacion, id_empresa, id_sede,
                usuario_dominio, responsable, cedula_responsable, cargo, area, ceco
            )
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

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
            $this->id_empresa,
            $this->id_sede,
            $this->usuario_dominio,
            $this->responsable,
            $this->cedula_responsable,
            $this->cargo,
            $this->area,
            $this->ceco
        ]);
    }
}
