<?php
ini_set('memory_limit', '1024M'); // Aumenta el límite de memoria desde el código
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Equipo.php';
require_once __DIR__ . '/../models/Movimiento.php';

class ImportController {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function index() {
        include __DIR__ . '/../../public/views/equipos_importar.php';
    }

    public function descargarPlantilla() {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=plantilla_inventario.csv');
        header('Pragma: no-cache');

        $out = fopen('php://output', 'w');
        fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($out, [
            'N°','CEDULA','NOMBRE COMPLETO','CARGO','AREA','CECO','UBICACIÓN GEO','EMPRESA',
            'NOMBRE DEL EQUIPO','NOMENCLATURA EQUIPO','USUARIO DE DOMINIO','TIPO DE EQUIPO',
            'MARCA','MODELO','SERIAL','PROCESADOR','MEMORIA','TIPO DISCO','CAPACIDAD DISCO',
            'OS','ACTIVO FIJO','N° INVENTARIO','MONITOR','MARCA MONITOR','MODELO MONITOR',
            'SERIAL MONITOR','ACTIVO FIJO MONITOR','N° INVENTARIO MONITOR','LEASING','ANTIVIRUS',
            'ACTA DE ENTREGA','MTTO PREVENTIVO','FIRMA DE CORREO','NUEVO','TECLADO','MOUSE',
            'BASE REFRIGERANTE','OBSERVACION ESTADO EQUIPO','LICENCIA WINDOWS EQUIPO NUEVO',
            'WINDOWS LICENCIADO','CONEXIÓN SAP','BITLOCKER ID','PASSWORD'
        ], ';');
        fclose($out);
        exit;
    }

    public function procesar() {
        if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = "No se recibió el archivo.";
            header("Location: importar_equipos.php");
            exit;
        }

        $tmp = $_FILES['archivo']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION));

        try {
            if ($ext === 'csv') {
                $resultado = $this->procesarCSV($tmp);
            } elseif (in_array($ext, ['xlsx', 'xls'])) {
                if (!class_exists('PhpOffice\PhpSpreadsheet\IOFactory')) {
                    throw new Exception("Para importar .xlsx necesitas instalar PhpSpreadsheet. Ejecuta: composer require phpoffice/phpspreadsheet. O guarda tu Excel como CSV UTF-8.");
                }
                $resultado = $this->procesarExcel($tmp);
            } else {
                throw new Exception("Formato no soportado. Usa .xlsx, .xls o .csv");
            }

            $_SESSION['mensaje'] = "Se importaron {$resultado['importados']} equipos.";
            if (!empty($resultado['errores'])) {
                $_SESSION['errores_import'] = $resultado['errores'];
            }

            header("Location: equipos.php");
            exit;

        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
            header("Location: importar_equipos.php");
            exit;
        }
    }

    // Procesa CSV línea por línea (ahorra muchísima memoria)
    private function procesarCSV($path) {
        $handle = fopen($path, 'r');
        $fila_num = 1;
        $importados = 0;
        $errores = [];

        // Omitir cabecera
        fgetcsv($handle, 0, ';');

        while (($fila = fgetcsv($handle, 0, ';')) !== false) {
            $fila_num++;
            if (empty(array_filter($fila))) continue;

            try {
                $this->procesarFila($fila);
                $importados++;
            } catch (Exception $e) {
                $errores[] = "Fila " . $fila_num . ": " . $e->getMessage();
            }
            unset($fila); // Libera memoria en cada iteración
        }
        fclose($handle);

        return ['importados' => $importados, 'errores' => $errores];
    }

    // Procesa Excel fila por fila en modo lectura (ahorra muchísima memoria)
    private function procesarExcel($tmp) {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($tmp);
        $reader->setReadDataOnly(true); // Evita cargar formatos y colores que consumen RAM
        $spreadsheet = $reader->load($tmp);
        $sheet = $spreadsheet->getActiveSheet();
        
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        
        $importados = 0;
        $errores = [];

        for ($row = 2; $row <= $highestRow; $row++) {
            $fila = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE)[0];
            if (empty(array_filter($fila))) continue;

            try {
                $this->procesarFila($fila);
                $importados++;
            } catch (Exception $e) {
                $errores[] = "Fila " . $row . ": " . $e->getMessage();
            }
            unset($fila); // Libera memoria
        }
        
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);

        return ['importados' => $importados, 'errores' => $errores];
    }

    private function procesarFila(array $r) {
        $d = [
            'cedula'          => $this->normalizar($r[1]  ?? ''),
            'responsable'     => $this->normalizar($r[2]  ?? ''),
            'cargo'           => $this->normalizar($r[3]  ?? ''),
            'area'            => $this->normalizar($r[4]  ?? ''),
            'ceco'            => $this->normalizar($r[5]  ?? ''),
            'ubicacion'       => $this->normalizar($r[6]  ?? ''),
            'empresa'         => $this->normalizar($r[7]  ?? ''),
            'nombre_equipo'   => $this->normalizar($r[8]  ?? ''),
            'nomenclatura'    => $this->normalizar($r[9]  ?? ''),
            'usuario_dominio' => $this->normalizar($r[10] ?? ''),
            'tipo_equipo'     => $this->normalizar($r[11] ?? ''),
            'marca'           => $this->normalizar($r[12] ?? ''),
            'modelo'          => $this->normalizar($r[13] ?? ''),
            'serial'          => $this->normalizar($r[14] ?? ''),
            'procesador'      => $this->normalizar($r[15] ?? ''),
            'memoria'         => $this->normalizar($r[16] ?? ''),
            'tipo_disco'      => $this->normalizar($r[17] ?? ''),
            'capacidad_disco' => $this->normalizar($r[18] ?? ''),
            'os'              => $this->normalizar($r[19] ?? ''),
            'activo_fijo'     => $this->normalizar($r[20] ?? ''),
            'num_inventario'  => $this->normalizar($r[21] ?? ''),
            'monitor'         => $this->normalizar($r[22] ?? ''),
            'marca_monitor'   => $this->normalizar($r[23] ?? ''),
            'modelo_monitor'  => $this->normalizar($r[24] ?? ''),
            'serial_monitor'  => $this->normalizar($r[25] ?? ''),
            'af_monitor'      => $this->normalizar($r[26] ?? ''),
            'num_inv_monitor' => $this->normalizar($r[27] ?? ''),
            'leasing'         => $this->triEstado($r[28]  ?? ''),
            'antivirus'       => $this->triEstado($r[29]  ?? ''),
            'acta_entrega'    => $this->normalizar($r[30] ?? ''),
            'mtto_prev'       => $this->normalizar($r[31] ?? ''),
            'firma_correo'    => $this->normalizar($r[32] ?? ''),
            'nuevo'           => $this->triEstado($r[33]  ?? ''),
            'teclado'         => $this->normalizar($r[34] ?? ''),
            'mouse'           => $this->normalizar($r[35] ?? ''),
            'base_refrig'     => $this->normalizar($r[36] ?? ''),
            'observacion'     => $this->normalizar($r[37] ?? ''),
            'lic_windows'     => $this->normalizar($r[38] ?? ''),
            'win_licenciado'  => $this->normalizar($r[39] ?? ''),
            'conexion_sap'    => $this->normalizar($r[40] ?? ''),
            'bitlocker_id'    => $this->normalizar($r[41] ?? ''),
            'password'        => $this->normalizar($r[42] ?? ''),
        ];

        if ($d['serial'] === 'N/A' && $d['nombre_equipo'] === 'N/A') {
            throw new Exception("Sin serial ni nombre de equipo.");
        }

        $id_empresa = $this->getOrCreateEmpresa($d['empresa']);
        $id_sede    = $this->getOrCreateSede($d['ubicacion'], $id_empresa);

        $eq = new Equipo();
        $eq->nombre_equipo      = $d['nombre_equipo'];
        $eq->nomenclatura       = $d['nomenclatura'];
        $eq->tipo_equipo        = $d['tipo_equipo'];
        $eq->marca              = $d['marca'];
        $eq->modelo             = $d['modelo'];
        $eq->serial             = $d['serial'];
        $eq->procesador         = $d['procesador'];
        $eq->memoria            = $d['memoria'];
        $eq->tipo_disco         = $d['tipo_disco'];
        $eq->capacidad_disco    = $d['capacidad_disco'];
        $eq->os                 = $d['os'];
        $eq->activo_fijo        = $d['activo_fijo'];
        $eq->numero_inventario  = $d['num_inventario'];
        $eq->leasing            = $d['leasing'];
        $eq->antivirus          = $d['antivirus'];
        $eq->nuevo              = $d['nuevo'];
        $eq->estado             = 1;
        $eq->estado_ciclo       = 'En Uso';
        $eq->observacion        = $d['observacion'];
        $eq->usuario_dominio    = $d['usuario_dominio'];
        $eq->responsable        = $d['responsable'];
        $eq->cedula_responsable = $d['cedula'];
        $eq->cargo              = $d['cargo'];
        $eq->area               = $d['area'];
        $eq->ceco               = $d['ceco'];
        $eq->id_empresa         = $id_empresa;
        $eq->id_sede            = $id_sede;

        $eq->tiene_monitor             = $d['monitor'];
        $eq->marca_monitor             = $d['marca_monitor'];
        $eq->modelo_monitor            = $d['modelo_monitor'];
        $eq->serial_monitor            = $d['serial_monitor'];
        $eq->activo_fijo_monitor       = $d['af_monitor'];
        $eq->numero_inventario_monitor = $d['num_inv_monitor'];
        $eq->acta_entrega              = $d['acta_entrega'];
        $eq->mtto_preventivo           = $d['mtto_prev'];
        $eq->firma_correo              = $d['firma_correo'];
        $eq->teclado                   = $d['teclado'];
        $eq->mouse                     = $d['mouse'];
        $eq->base_refrigerante         = $d['base_refrig'];
        $eq->licencia_windows          = $d['lic_windows'];
        $eq->windows_licenciado        = $d['win_licenciado'];
        $eq->conexion_sap              = $d['conexion_sap'];
        $eq->bitlocker_id              = $d['bitlocker_id'];
        $eq->password_bitlocker        = $d['password'];

        $eq->valor_compra       = null;
        $eq->fecha_adquisicion  = null;
        $eq->fecha_fin_garantia = null;

        $eq->guardar();
        $idNuevo = $this->conn->lastInsertId();

        $mov = new Movimiento();
        $mov->registrar($idNuevo, 'Asignación', null, null, null, $id_sede,
            'Importación Excel — Responsable: ' . $d['responsable']);
    }

    private function getOrCreateEmpresa($nombre) {
        if ($nombre === '' || $nombre === 'N/A') {
            $row = $this->conn->query("SELECT id_empresa FROM empresas LIMIT 1")->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['id_empresa'] : null;
        }
        $stmt = $this->conn->prepare("SELECT id_empresa FROM empresas WHERE nombre = ?");
        $stmt->execute([$nombre]);
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) return $row['id_empresa'];

        $stmt = $this->conn->prepare("INSERT INTO empresas (nombre, estado) VALUES (?, 1)");
        $stmt->execute([$nombre]);
        return $this->conn->lastInsertId();
    }

    private function getOrCreateSede($ubicacion, $id_empresa) {
        if ($ubicacion === '' || $ubicacion === 'N/A' || !$id_empresa) return null;

        $stmt = $this->conn->prepare("SELECT id_sede FROM sedes WHERE nombre_sede = ? AND id_empresa = ?");
        $stmt->execute([$ubicacion, $id_empresa]);
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) return $row['id_sede'];

        $stmt = $this->conn->prepare("INSERT INTO sedes (id_empresa, nombre_sede, ciudad, direccion) VALUES (?, ?, 'N/A', 'N/A')");
        $stmt->execute([$id_empresa, $ubicacion]);
        return $this->conn->lastInsertId();
    }

    private function normalizar($valor) {
        $v = trim((string)$valor);
        if ($v === '') return 'N/A';

        $upper = strtoupper($v);
        $noAplica = ['N/A','NA','N.A.','N.A','NO APLICA','NO APLICA.','NO-APLICA','NO_APLICA',
                     '-','--','---','NULL','NONE','SIN DATO','SIN DATOS'];
        if (in_array($upper, $noAplica, true)) return 'N/A';

        return $v;
    }

    private function triEstado($valor) {
        $v = strtoupper(trim((string)$valor));
        if ($v === '') return 'N/A';

        $noAplica = ['N/A','NA','N.A.','N.A','NO APLICA','-','--','NULL','NONE'];
        if (in_array($v, $noAplica, true)) return 'N/A';

        $si = ['SI','SÍ','S','1','YES','X','TRUE','OK','APLICA'];
        if (in_array($si, $si, true) && in_array($v, $si, true)) return 'SI';

        $no = ['NO','N','0','FALSE','NEGATIVO'];
        if (in_array($v, $no, true)) return 'NO';

        return 'N/A';
    }
}
