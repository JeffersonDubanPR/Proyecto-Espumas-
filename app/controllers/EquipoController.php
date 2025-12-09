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

        $e = new Equipo();

        // Datos del equipo
        $e->nombre_equipo = $post['nombre_equipo'];
        $e->nomenclatura = $post['nomenclatura'];
        $e->tipo_equipo = $post['tipo_equipo'];
        $e->marca = $post['marca'];
        $e->modelo = $post['modelo'];
        $e->serial = $post['serial'];
        $e->procesador = $post['procesador'];
        $e->memoria = $post['memoria'];
        $e->tipo_disco = $post['tipo_disco'];
        $e->capacidad_disco = $post['capacidad_disco'];
        $e->os = $post['os'];
        $e->activo_fijo = $post['activo_fijo'];
        $e->numero_inventario = $post['numero_inventario'];
        $e->leasing = $post['leasing'];
        $e->antivirus = $post['antivirus'];
        $e->estado = $post['estado'];
        $e->observacion = $post['observacion'];
        $e->usuario_dominio = $post['usuario_dominio'];
        $e->responsable = $post['responsable'];
        $e->cedula_responsable = $post['cedula_responsable'];
        $e->cargo = $post['cargo'];
        $e->area = $post['area'];
        $e->ceco = $post['ceco'];
        $e->id_empresa = $post['id_empresa'];
        $e->id_sede = $post['id_sede'];

        $e->guardar();

        header("Location: equipos.php");
        exit;
    }

    

}

