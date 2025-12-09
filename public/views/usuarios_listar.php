<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Usuarios registrados</h3>

    <a href="usuarios_nuevo.php" class="btn btn-primary mb-3">
        Nuevo usuario
    </a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre completo</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($datos as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= $u['nombre_completo'] ?></td>
                    <td><?= $u['usuario'] ?></td>
                    <td><?= $u['estado'] ? 'Activo' : 'Inactivo' ?></td>
                    <td>
                        <a href="usuarios_editar.php?id=<?= $u['id'] ?>" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">← Volver</a>
</div>
