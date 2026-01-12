<?php include 'header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Nueva Empresa</h3>
        <a href="../empresas.php" class="btn btn-secondary">← Volver</a>
    </div>

    <div class="card shadow-sm">    
        <div class="card-body">

            <form method="POST" action="empresas.php?action=guardar">



                <div class="mb-3">
                    <label class="form-label">Nombre de la empresa</label>
                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        placeholder="Ej: Espumas Santa Fe"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="1">Activa</option>
                        <option value="0">Inactiva</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Guardar empresa</button>
                    <a href="../empresas.php" class="btn btn-outline-secondary">Cancelar</a>
                </div>

            </form>

        </div>
    </div>

</div>
