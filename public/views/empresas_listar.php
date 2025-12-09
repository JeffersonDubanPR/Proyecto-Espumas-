<?php include __DIR__ . '/header.php'; ?>

<div class="container mt-4">

<h3>Empresas Registradas</h3>

<a href="empresas.php?action=nuevo" class="btn btn-primary mb-3">Nueva Empresa</a>
<a href="dashboard.php" class="btn btn-secondary mb-3">← Volver</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($datos as $e): ?>
            <tr>
                <td><?= $e['id_empresa'] ?></td>
                <td><?= $e['nombre'] ?></td>
                <td><?= $e['estado'] ? 'Activo' : 'Inactivo' ?></td>

                <td>
                    <a href="empresas.php?action=editar&id=<?= $e['id_empresa'] ?>" class="btn btn-warning btn-sm">Editar</a>

                    <a href="empresas.php?action=eliminar&id=<?= $e['id_empresa'] ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Deseas eliminar esta empresa?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    

</table>

<?php include __DIR__ . '/footer.php'; ?>


