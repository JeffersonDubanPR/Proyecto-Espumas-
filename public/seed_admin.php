<?php
require_once __DIR__ . '/../app/config/db.php';

$conn = Database::connect();

$usuario  = 'admin';
$password = '123456';
$hash     = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->execute([$usuario]);

if ($stmt->fetch()) {
    echo "El usuario <strong>admin</strong> ya existe.";
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO usuarios (nombre_completo, usuario, password_hash, rol, estado)
    VALUES (?, ?, ?, 'ADMIN', 1)
");
$stmt->execute(['Administrador del sistema', $usuario, $hash]);

echo " Usuario admin creado correctamente.<br>";
echo "Usuario: <strong>admin</strong><br>";
echo "Contraseña: <strong>123456</strong><br>";
echo "Puedes iniciar sesión en <a href='login.php'>login.php</a>";


