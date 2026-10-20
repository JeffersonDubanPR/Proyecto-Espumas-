<?php
require_once __DIR__ . '/../config/db.php';

class ExportController {

    public function exportarExcel() {
        try {
            $conn = Database::connect();
            $sql = "SELECT e.*, emp.nombre AS empresa_nombre, s.nombre_sede AS sede_nombre
                    FROM equipos e
                    LEFT JOIN empresas emp ON emp.id_empresa = e.id_empresa
                    LEFT JOIN sedes s      ON s.id_sede     = e.id_sede
                    ORDER BY e.id_equipo DESC";
            $datos = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

            if (empty($datos)) throw new Exception("No hay datos para exportar.");

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=inventario_equipos_' . date('Y-m-d_His') . '.csv');
            header('Pragma: no-cache');

            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($out, [
                'CEDULA','NOMBRE','CARGO','AREA','CECO','SEDE','EMPRESA',
                'EQUIPO','NOMENCLATURA','USUARIO','TIPO','MARCA','MODELO','SERIAL',
                'PROCESADOR','MEMORIA','DISCO','CAPACIDAD','OS','ACTIVO FIJO',
                'INVENTARIO','MONITOR','SERIAL MONITOR','LEASING','ANTIVIRUS',
                'OBSERVACION','LICENCIA WINDOWS','WINDOWS LICENCIADO','SAP',
                'BITLOCKER','ESTADO CICLO','VALOR','F. ADQUISICION','F. GARANTIA'
            ], ';');

            $na = function ($v) { return ($v === null || $v === '') ? 'N/A' : $v; };

            foreach ($datos as $d) {
                fputcsv($out, [
                    $na($d['cedula_responsable']), $na($d['responsable']),
                    $na($d['cargo']), $na($d['area']), $na($d['ceco']),
                    $na($d['sede_nombre']), $na($d['empresa_nombre']),
                    $na($d['nombre_equipo']), $na($d['nomenclatura']),
                    $na($d['usuario_dominio']), $na($d['tipo_equipo']),
                    $na($d['marca']), $na($d['modelo']), $na($d['serial']),
                    $na($d['procesador']), $na($d['memoria']),
                    $na($d['tipo_disco']), $na($d['capacidad_disco']),
                    $na($d['os']), $na($d['activo_fijo']),
                    $na($d['numero_inventario']), $na($d['tiene_monitor']),
                    $na($d['serial_monitor']), $na($d['leasing']),
                    $na($d['antivirus']), $na($d['observacion']),
                    $na($d['licencia_windows']), $na($d['windows_licenciado']),
                    $na($d['conexion_sap']), $na($d['bitlocker_id']),
                    $na($d['estado_ciclo']), $na($d['valor_compra']),
                    $na($d['fecha_adquisicion']), $na($d['fecha_fin_garantia'])
                ], ';');
            }

            fclose($out);
            exit;

        } catch (Exception $e) {
            header('Content-Type: text/html; charset=utf-8');
            echo "Error al exportar: " . $e->getMessage();
            exit;
        }
    }
}


