<?php
require_once __DIR__ . '/../models/Equipo.php';
require_once __DIR__ . '/../models/Empresa.php';
require_once __DIR__ . '/../models/Sede.php';
require_once __DIR__ . '/../models/Movimiento.php';
require_once __DIR__ . '/../models/Mantenimiento.php';
require_once __DIR__ . '/../models/Baja.php';
require_once __DIR__ . '/../models/User.php';

class EquipoController {

        public function index() {
        $eq = new Equipo();
        
        // Capturamos el término de búsqueda de la URL (si existe)
        $busqueda = $_GET['buscar'] ?? '';
        
        // Le pasamos el término al modelo
        $datos = $eq->listar($busqueda);

        $empresa = new Empresa();
        $empresas = $empresa->listar();

        $sede = new Sede();
        $sedes = $sede->listar();

        include __DIR__ . '/../../public/views/equipos_listar.php';
    }

    public function nuevo() {
        $empresa = new Empresa();
        $empresas = $empresa->listar();

        $sede = new Sede();
        $sedes = $sede->listar();

        include __DIR__ . '/../../public/views/equipos_nuevo.php';
    }

    public function guardar($post) {
        if (empty($post)) {
            header("Location: equipos.php");
            exit;
        }

        $e = new Equipo();
        foreach ($post as $key => $value) {
            if (property_exists($e, $key)) $e->$key = $value;
        }
        $e->estado_ciclo = $post['estado_ciclo'] ?? 'Registrado';
        $e->guardar();

        $idNuevo = Database::connect()->lastInsertId();

        $mov = new Movimiento();
        $mov->registrar($idNuevo, 'Asignación', null, null, null,
            $post['id_sede'] ?? null, 'Registro inicial del activo');

        header("Location: equipos.php");
        exit;
    }

    public function ver($id) {
        if (!$id) return;

        $eq = new Equipo();
        $dato = $eq->buscar($id);

        $mov = new Movimiento();
        $movimientos = $mov->listarPorEquipo($id);

        $mant = new Mantenimiento();
        $mantenimientos = $mant->listarPorEquipo($id);

        $baja = new Baja();
        $bajaInfo = $baja->buscarPorEquipo($id);

        include __DIR__ . '/../../public/views/equipos_ver.php';
    }

    public function editar($id) {
        if (!$id) return;

        $eq = new Equipo();
        $dato = $eq->buscar($id);

        $empresa = new Empresa();
        $empresas = $empresa->listar();

        $sede = new Sede();
        $sedes = $sede->listar();

        include __DIR__ . '/../../public/views/equipos_editar.php';
    }

    public function actualizar($post) {
        $e = new Equipo();
        foreach ($post as $key => $value) {
            if (property_exists($e, $key)) $e->$key = $value;
        }
        $e->actualizar();

        header("Location: equipos_ver.php?id=" . $post['id_equipo']);
        exit;
    }

    // Formularios de acción
    public function formAsignar($id) {
        $eq = new Equipo();
        $dato = $eq->buscar($id);

        $user = new User();
        $usuarios = $user->listar();

        $sede = new Sede();
        $sedes = $sede->listar();

        include __DIR__ . '/../../public/views/equipos_asignar.php';
    }

    public function asignar($post) {
        $id = $post['id_equipo'];
        $eq = new Equipo();
        $eq->actualizarEstadoCiclo($id, 'En Uso');

        $mov = new Movimiento();
        $mov->registrar($id, 'Asignación', null,
            $post['id_usuario_destino'] ?? null,
            null, $post['id_sede_destino'] ?? null,
            $post['observaciones'] ?? '');

        header("Location: equipos_ver.php?id=" . $id);
        exit;
    }

    public function formMantenimiento($id) {
        $eq = new Equipo();
        $dato = $eq->buscar($id);

        $user = new User();
        $usuarios = $user->listar();

        include __DIR__ . '/../../public/views/equipos_mantenimiento.php';
    }

    public function enviarMantenimiento($post) {
        $id = $post['id_equipo'];

        $eq = new Equipo();
        $eq->actualizarEstadoCiclo($id, 'En Mantenimiento');

        $m = new Mantenimiento();
        $m->id_equipo              = $id;
        $m->tipo                   = $post['tipo'];
        $m->descripcion            = $post['descripcion'];
        $m->fecha_programada       = $post['fecha_programada'];
        $m->fecha_ejecucion        = $post['fecha_ejecucion'] ?? null;
        $m->costo                  = $post['costo'] ?? 0;
        $m->estado                 = 'Programado';
        $m->id_tecnico_responsable = $post['id_tecnico'] ?? null;
        $m->guardar();

        header("Location: equipos_ver.php?id=" . $id);
        exit;
    }

    public function formBaja($id) {
        $eq = new Equipo();
        $dato = $eq->buscar($id);
        include __DIR__ . '/../../public/views/equipos_baja.php';
    }

    public function darBaja($post) {
        $id = $post['id_equipo'];

        $eq = new Equipo();
        $eq->actualizarEstadoCiclo($id, 'De Baja');

        $b = new Baja();
        $b->registrar($id, $post['fecha_baja'], $post['motivo'],
            $post['valor_residual'] ?? 0, $_SESSION['usuario_id']);

        $mov = new Movimiento();
        $mov->registrar($id, 'Baja', null, null, null, null,
            'Activo dado de baja: ' . $post['motivo']);

        header("Location: equipos_ver.php?id=" . $id);
        exit;
    }
}