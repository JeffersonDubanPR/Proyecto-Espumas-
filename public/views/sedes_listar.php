<?php include __DIR__ . '/header.php'; ?>

<h3>Sedes Registradas</h3>

<a href="sedes.php?action=nuevo" class="btn btn-primary mb-3">Nueva Sede</a>
<a href="dashboard.php" class="btn btn-secondary mb-3">← Volver</a>

<table class="table table-bordered">
<thead>
<tr>
    <th>ID</th>
    <th>Sede</th>
    <th>Empresa</th>
    <th>Ciudad</th>
    <th>Dirección</th>
    <th>Acciones</th>
</tr>
</thead>

<tbody>
<?php foreach ($datos as $s): ?>
<tr>
    <td><?= $s['id_sede'] ?></td>
    <td><?= $s['nombre_sede'] ?></td>
    <td><?= $s['empresa'] ?></td>
    <td><?= $s['ciudad'] ?></td>
    <td><?= $s['direccion'] ?></td>

    <td>
        <a href="sedes.php?action=editar&id=<?= $s['id_sede'] ?>" class="btn btn-warning btn-sm">Editar</a>

        <a href="sedes.php?action=eliminar&id=<?= $s['id_sede'] ?>" 
           onclick="return confirm('¿Eliminar esta sede?')"
           class="btn btn-danger btn-sm">
           Eliminar
        </a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php include __DIR__ . '/footer.php'; ?>
