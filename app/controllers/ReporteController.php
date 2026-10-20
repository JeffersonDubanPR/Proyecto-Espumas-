<?php
require_once __DIR__ . '/../config/db.php';

class ReporteController {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function index() {
        include __DIR__ . '/../../public/views/reportes_index.php';
    }

    public function inventarioValorizado() {
        $sql = "SELECT emp.nombre AS empresa, s.nombre_sede AS sede,
                       COUNT(eq.id_equipo) AS total_equipos,
                       SUM(CASE WHEN eq.valor_compra IS NOT NULL THEN eq.valor_compra ELSE 0 END) AS valor_total
                FROM equipos eq
                LEFT JOIN empresas emp ON emp.id_empresa = eq.id_empresa
                LEFT JOIN sedes s      ON s.id_sede     = eq.id_sede
                GROUP BY emp.nombre, s.nombre_sede
                ORDER BY empresa, sede";
        $datos = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . '/../../public/views/reportes_valorizado.php';
    }

    public function activosPorEstado() {
        $sql = "SELECT estado_ciclo, COUNT(*) AS cantidad FROM equipos GROUP BY estado_ciclo";
        $datos = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . '/../../public/views/reportes_estado.php';
    }

    public function garantiasPorVencer() {
        $sql = "SELECT id_equipo, nombre_equipo, serial, marca, modelo,
                       fecha_fin_garantia, DATEDIFF(fecha_fin_garantia, CURDATE()) AS dias_restantes
                FROM equipos
                WHERE fecha_fin_garantia IS NOT NULL
                  AND fecha_fin_garantia BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 90 DAY)
                ORDER BY fecha_fin_garantia ASC";
        $datos = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . '/../../public/views/reportes_garantias.php';
    }
}
