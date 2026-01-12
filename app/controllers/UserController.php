<?php
require_once __DIR__ . '/../models/User.php';

class UserController {

    public function index() {
        $user = new User();
        $datos = $user->listar();
        include __DIR__ . '/../../public/views/usuarios_listar.php';
    }

    public function nuevo() {
        include __DIR__ . '/../../public/views/usuarios_nuevo.php';
    }

    public function guardar($post) {

        $u = new User();
        $u->nombre_completo = $post['nombre_completo'];
        $u->usuario = $post['usuario'];
        $u->password_hash = password_hash($post['password'], PASSWORD_DEFAULT);
        $u->estado = $post['estado'];

        $u->guardar();

        header("Location: usuarios.php");
        exit;
    }

    public function editar($id) {
        $u = new User();
        $dato = $u->buscar($id);

        include __DIR__ . '/../../public/views/usuarios_editar.php';
    }

    public function actualizar($post) {

        $u = new User();
        $u->id = $post['id'];
        $u->nombre_completo = $post['nombre_completo'];
        $u->usuario = $post['usuario'];
        $u->estado = $post['estado'];

        $u->actualizar();

        header("Location: usuarios.php");
        exit;
    }

    public function actualizarPassword($post) {

        $u = new User();
        $u->id = $post['id'];
        $u->password_hash = password_hash($post['password'], PASSWORD_DEFAULT);

        $u->actualizarPassword();

        header("Location: usuarios.php");
        exit;
    }

    
}
