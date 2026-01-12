<?php
require_once __DIR__ . '/../models/Equipo.php';
require_once __DIR__ . '/../models/Empresa.php';
require_once __DIR__ . '/../models/Sede.php';

class EquipoController {

    public function index() {
        $eq = new Equipo();
        $datos = $eq->listar();
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
            $e->$key = $value;
        }

        $e->guardar();

        header("Location: equipos.php");
        exit;
    }

    public function ver($id) {
        if (!$id) return;

        $eq = new Equipo();
        $dato = $eq->buscar($id);

        include __DIR__ . '/../../public/views/equipos_ver.php';
    }

    public function editar($id) {
        if (!$id) return;

        $eq = new Equipo();
        $dato = $eq->buscar($id);

        include __DIR__ . '/../../public/views/equipos_editar.php';
    }
}


