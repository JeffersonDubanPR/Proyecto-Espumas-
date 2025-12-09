<?php
session_start();
require_once __DIR__ . '/../models/User.php';

class AuthController {

    public function login() {

        $usuario = trim($_POST['usuario'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $userModel = new User();
        $user = $userModel->findByUsername($usuario);

        // Si el usuario no existe
        if (!$user) {
            $_SESSION['error_login'] = "El usuario no existe.";
            header("Location: login.php");
            exit;
        }

        // 🔹 Validar si el usuario está inactivo
        if ($user['estado'] == 0) {
            $_SESSION['error_login'] = "El usuario está inactivo y no tiene acceso.";
            header("Location: login.php");
            exit;
        }

        // Si la contraseña no coincide
        if (!password_verify($password, $user['password_hash'])) {
            $_SESSION['error_login'] = "La contraseña no coincide.";
            header("Location: login.php");
            exit;
        }

        // Si todo está bien, iniciar sesión
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre_completo'];
        $_SESSION['usuario_rol'] = $user['rol'];

        header("Location: dashboard.php");
        exit;
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();

        header("Location: login.php");
        exit;
    }

}




