<?php
require_once __DIR__ . '/../config/db.php';

class Equipo {

    private $conn;

    // Campos base
    public $id_equipo, $nombre_equipo, $nomenclatura, $tipo_equipo;
    public $marca, $modelo, $serial, $procesador, $memoria;
    public $tipo_disco, $capacidad_disco, $os, $activo_fijo;
    public $numero_inventario, $leasing, $antivirus, $estado, $estado_ciclo;
    public $observacion, $usuario_dominio, $responsable, $cedula_responsable;
    public $cargo, $area, $ceco, $id_empresa, $id_sede;
    public $valor_compra, $fecha_adquisicion, $fecha_fin_garantia;

    // Datos del Excel
    public $tiene_monitor, $marca_monitor, $modelo_monitor, $serial_monitor;
    public $activo_fijo_monitor, $numero_inventario_monitor;
    public $acta_entrega, $mtto_preventivo, $firma_correo, $nuevo;
    public $teclado, $mouse, $base_refrigerante;
    public $licencia_windows, $windows_licenciado, $conexion_sap;
    public $bitlocker_id, $password_bitlocker;

    public function __construct() {
        $this->conn = Database::connect();
    }

       public function listar($busqueda = '') {
        $sql = "SELECT e.*, 
                       emp.nombre AS empresa,
                       s.nombre_sede AS sede
                FROM equipos e
                LEFT JOIN empresas emp ON emp.id_empresa = e.id_empresa
                LEFT JOIN sedes s ON s.id_sede = e.id_sede";
        
        $params = [];
        
        // Si hay un término de búsqueda, filtramos
        if (!empty($busqueda)) {
            $sql .= " WHERE e.responsable LIKE ? 
                      OR e.cedula_responsable LIKE ? 
                      OR e.serial LIKE ? 
                      OR e.nombre_equipo LIKE ? 
                      OR e.numero_inventario LIKE ? 
                      OR e.nomenclatura LIKE ? 
                      OR e.activo_fijo LIKE ?";
            
            $term = "%" . $busqueda . "%";
            $params = [$term, $term, $term, $term, $term, $term, $term];
        }

        $sql .= " ORDER BY e.id_equipo DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            activo_fijo, numero_inventario, leasing, antivirus, estado, estado_ciclo,
            observacion, usuario_dominio, responsable, cedula_responsable,
            cargo, area, ceco, id_empresa, id_sede,
            valor_compra, fecha_adquisicion, fecha_fin_garantia,
            tiene_monitor, marca_monitor, modelo_monitor, serial_monitor,
            activo_fijo_monitor, numero_inventario_monitor,
            acta_entrega, mtto_preventivo, firma_correo, nuevo,
            teclado, mouse, base_refrigerante,
            licencia_windows, windows_licenciado, conexion_sap,
            bitlocker_id, password_bitlocker
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $this->nombre_equipo,       $this->nomenclatura,      $this->tipo_equipo,
            $this->marca,               $this->modelo,            $this->serial,
            $this->procesador,          $this->memoria,           $this->tipo_disco,
            $this->capacidad_disco,     $this->os,
            $this->activo_fijo,         $this->numero_inventario,
            $this->leasing,             $this->antivirus,
            $this->estado,              $this->estado_ciclo ?? 'Registrado',
            $this->observacion,         $this->usuario_dominio,
            $this->responsable,         $this->cedula_responsable,
            $this->cargo,               $this->area,              $this->ceco,
            $this->id_empresa,          $this->id_sede,
            $this->valor_compra        ?? null,
            $this->fecha_adquisicion   ?? null,
            $this->fecha_fin_garantia  ?? null,
            $this->tiene_monitor       ?? null,
            $this->marca_monitor       ?? null,
            $this->modelo_monitor      ?? null,
            $this->serial_monitor      ?? null,
            $this->activo_fijo_monitor ?? null,
            $this->numero_inventario_monitor ?? null,
            $this->acta_entrega        ?? null,
            $this->mtto_preventivo     ?? null,
            $this->firma_correo        ?? null,
            $this->nuevo               ?? 'N/A',
            $this->teclado             ?? null,
            $this->mouse               ?? null,
            $this->base_refrigerante   ?? null,
            $this->licencia_windows    ?? null,
            $this->windows_licenciado  ?? null,
            $this->conexion_sap        ?? null,
            $this->bitlocker_id        ?? null,
            $this->password_bitlocker  ?? null
        ]);
    }

    public function actualizar() {
        $sql = "UPDATE equipos SET
            nombre_equipo=?, nomenclatura=?, tipo_equipo=?, marca=?, modelo=?, serial=?,
            procesador=?, memoria=?, tipo_disco=?, capacidad_disco=?, os=?,
            activo_fijo=?, numero_inventario=?, leasing=?, antivirus=?, estado=?, estado_ciclo=?,
            observacion=?, usuario_dominio=?, responsable=?, cedula_responsable=?,
            cargo=?, area=?, ceco=?, id_empresa=?, id_sede=?,
            valor_compra=?, fecha_adquisicion=?, fecha_fin_garantia=?,
            tiene_monitor=?, marca_monitor=?, modelo_monitor=?, serial_monitor=?,
            activo_fijo_monitor=?, numero_inventario_monitor=?,
            acta_entrega=?, mtto_preventivo=?, firma_correo=?, nuevo=?,
            teclado=?, mouse=?, base_refrigerante=?,
            licencia_windows=?, windows_licenciado=?, conexion_sap=?,
            bitlocker_id=?, password_bitlocker=?
            WHERE id_equipo=?";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $this->nombre_equipo,       $this->nomenclatura,      $this->tipo_equipo,
            $this->marca,               $this->modelo,            $this->serial,
            $this->procesador,          $this->memoria,           $this->tipo_disco,
            $this->capacidad_disco,     $this->os,
            $this->activo_fijo,         $this->numero_inventario,
            $this->leasing,             $this->antivirus,
            $this->estado,              $this->estado_ciclo,
            $this->observacion,         $this->usuario_dominio,
            $this->responsable,         $this->cedula_responsable,
            $this->cargo,               $this->area,              $this->ceco,
            $this->id_empresa,          $this->id_sede,
            $this->valor_compra        ?: null,
            $this->fecha_adquisicion   ?: null,
            $this->fecha_fin_garantia  ?: null,
            $this->tiene_monitor       ?: null,
            $this->marca_monitor       ?: null,
            $this->modelo_monitor      ?: null,
            $this->serial_monitor      ?: null,
            $this->activo_fijo_monitor ?: null,
            $this->numero_inventario_monitor ?: null,
            $this->acta_entrega        ?: null,
            $this->mtto_preventivo     ?: null,
            $this->firma_correo        ?: null,
            $this->nuevo               ?: 'N/A',
            $this->teclado             ?: null,
            $this->mouse               ?: null,
            $this->base_refrigerante   ?: null,
            $this->licencia_windows    ?: null,
            $this->windows_licenciado  ?: null,
            $this->conexion_sap        ?: null,
            $this->bitlocker_id        ?: null,
            $this->password_bitlocker  ?: null,
            $this->id_equipo
        ]);
    }

    public function actualizarEstadoCiclo($id, $nuevoEstado) {
        $stmt = $this->conn->prepare("UPDATE equipos SET estado_ciclo = ? WHERE id_equipo = ?");
        return $stmt->execute([$nuevoEstado, $id]);
    }
}
