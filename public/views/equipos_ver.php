<?php include 'header.php'; ?>

<div class="container mt-4">

    <h3>Detalle del equipo</h3>

    <div class="card shadow p-4">

        <div class="row">

            <div class="col-md-6">
                <p><strong>Nombre del equipo:</strong> <?= $dato['nombre_equipo'] ?></p>
                <p><strong>Nomenclatura:</strong> <?= $dato['nomenclatura'] ?></p>
                <p><strong>Tipo de equipo:</strong> <?= $dato['tipo_equipo'] ?></p>
                <p><strong>Marca:</strong> <?= $dato['marca'] ?></p>
                <p><strong>Modelo:</strong> <?= $dato['modelo'] ?></p>
                <p><strong>Serial:</strong> <?= $dato['serial'] ?></p>
                <p><strong>Procesador:</strong> <?= $dato['procesador'] ?></p>
            </div>

            <div class="col-md-6">
                <p><strong>Memoria:</strong> <?= $dato['memoria'] ?> GB</p>
                <p><strong>Tipo disco:</strong> <?= $dato['tipo_disco'] ?></p>
                <p><strong>Capacidad disco:</strong> <?= $dato['capacidad_disco'] ?> GB</p>
                <p><strong>Sistema operativo:</strong> <?= $dato['os'] ?></p>
                <p><strong>Activo fijo:</strong> <?= $dato['activo_fijo'] ?></p>
                <p><strong>Número inventario:</strong> <?= $dato['numero_inventario'] ?></p>
                <p><strong>Estado:</strong> <?= $dato['estado'] ? "Operativo" : "Inactivo" ?></p>
            </div>

        </div>

        <hr>

        <p><strong>Empresa:</strong> <?= $dato['empresa'] ?></p>
        <p><strong>Sede:</strong> <?= $dato['sede'] ?></p>

        <hr>

        <p><strong>Observación:</strong></p>
        <p><?= nl2br($dato['observacion']) ?></p>

        <a href="equipos.php" class="btn btn-secondary mt-3">← Volver</a>
    </div>

</div>
