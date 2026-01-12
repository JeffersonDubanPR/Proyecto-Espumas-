<?php
require_once __DIR__ . '/../models/ExportarEquipos.php';

class ExportController {

    public function exportarExcel() {
        try {
            // Obtener datos del modelo
            $modelo = new ExportarEquipos();
            $datos = $modelo->obtenerDatos();

            // Validar que hay datos
            if (empty($datos)) {
                throw new Exception("No hay datos para exportar");
            }

            // Configurar headers para descarga CSV
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=inventario_equipos_' . date('Y-m-d_His') . '.csv');
            header('Pragma: no-cache');
            header('Expires: 0');

            // Crear output
            $output = fopen('php://output', 'w');

            // BOM para UTF-8 (para que Excel lo abra correctamente con tildes)
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

            // Encabezados del archivo
            fputcsv($output, [
                'CEDULA',
                'NOMBRE COMPLETO',
                'CARGO',
                'AREA',
                'CECO',
                'UBICACION GEOGRAFICA',
                'EMPRESA',
                'NOMBRE DEL EQUIPO',
                'NOMENCLATURA EQUIPO',
                'USUARIO DE DOMINIO',
                'TIPO DE EQUIPO',
                'MARCA',
                'MODELO',
                'SERIAL',
                'PROCESADOR',
                'MEMORIA',
                'TIPO DISCO',
                'CAPACIDAD DISCO',
                'SISTEMA OPERATIVO',
                'ACTIVO FIJO',
                'NUMERO INVENTARIO',
                'LEASING',
                'ANTIVIRUS'
            ], ';'); // Usar punto y coma para mejor compatibilidad con Excel en español

            // Escribir datos
            foreach ($datos as $fila) {
                fputcsv($output, $fila, ';');
            }

            fclose($output);
            exit;

        } catch (Exception $e) {
            // En caso de error, mostrar mensaje
            header('Content-Type: text/html; charset=utf-8');
            echo "Error al exportar: " . $e->getMessage();
            exit;
        }
    }
}
?>
