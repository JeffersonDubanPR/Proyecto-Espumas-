<?php
require_once __DIR__ . '/../models/Sede.php';
require_once __DIR__ . '/../models/Empresa.php';

class SedeController {

    // 📌 Mostrar listado de sedes
    public function index() {
        $sede = new Sede();
        $datos = $sede->listar();

        include __DIR__ . '/../../public/views/sedes_listar.php';
    }

    // 📌 Formulario crear sede
    public function nuevo() {
        $empresa = new Empresa();
        $empresas = $empresa->listar();

        include __DIR__ . '/../../public/views/sedes_nuevo.php';
    }

    // 📌 Guardar sede en la BD
    public function guardar() {

        // Validar que llegan datos
        if (!isset($_POST['id_empresa']) || !isset($_POST['nombre_sede'])) {
            $_SESSION['error'] = "No llegaron los datos.";
            header("Location: sedes.php");
            exit;
        }

        $s = new Sede();
        $s->id_empresa   = $_POST['id_empresa'];
        $s->nombre_sede  = $_POST['nombre_sede'];
        $s->ciudad       = $_POST['ciudad'];
        $s->direccion    = $_POST['direccion'];

        $s->guardar();

        $_SESSION['mensaje'] = "Sede creada correctamente.";
        header("Location: sedes.php");
        exit;
    }

    // 📌 Formulario editar sede
    public function editar($id) {
        $sede = new Sede();
        $dato = $sede->buscar($id);

        $empresa = new Empresa();
        $empresas = $empresa->listar();

        include __DIR__ . '/../../public/views/sedes_editar.php';
    }

    // 📌 Actualizar sede
    public function actualizar() {

        if (!isset($_POST['id_sede'])) {
            $_SESSION['error'] = "No llegó el ID de la sede.";
            header("Location: sedes.php");
            exit;
        }

        $s = new Sede();
        $s->id_sede      = $_POST['id_sede'];
        $s->id_empresa   = $_POST['id_empresa'];
        $s->nombre_sede  = $_POST['nombre_sede'];
        $s->ciudad       = $_POST['ciudad'];
        $s->direccion    = $_POST['direccion'];

        $s->actualizar();

        $_SESSION['mensaje'] = "Sede actualizada.";
        header("Location: sedes.php");
        exit;
    }

    // 📌 Eliminar sede
    public function eliminar($id) {
        $sede = new Sede();
        $sede->eliminar($id);

        $_SESSION['mensaje'] = "Sede eliminada.";
        header("Location: sedes.php");
        exit;
    }
}
