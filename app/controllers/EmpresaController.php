<?php
require_once __DIR__ . '/../models/Empresa.php';

class EmpresaController {

    public function index() {
        $empresa = new Empresa();
        $datos = $empresa->listar();

        include __DIR__ . '/../../public/views/empresas_listar.php';
    }

    public function nuevo() {
        include __DIR__ . '/../../public/views/empresas_nuevo.php';
    }

    public function guardar($post) {
        $empresa = new Empresa();

        $empresa->nombre = $post['nombre'];
        $empresa->estado = 1;

        $empresa->guardar();

        header("Location: empresas.php");
        exit;
    }

    public function editar($id) {
        $empresa = new Empresa();
        $dato = $empresa->buscar($id);

        include __DIR__ . '/../../public/views/empresas_editar.php';
    }

    public function actualizar($post) {
        $empresa = new Empresa();

        $empresa->id_empresa = $post['id_empresa'];
        $empresa->nombre = $post['nombre'];
        $empresa->estado = $post['estado'];

        $empresa->actualizar();

        header("Location: empresas.php");
        exit;
    }

    public function eliminar($id) {
        $empresa = new Empresa();
        $empresa->eliminar($id);

        header("Location: empresas.php");
        exit;
    }
}
