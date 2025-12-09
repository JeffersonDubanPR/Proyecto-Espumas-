<form action="sedes.php?action=guardar" method="POST">

    <div class="mb-3">
        <label>Empresa</label>
        <select name="id_empresa" required class="form-control">
            <?php foreach ($empresas as $e): ?>
                <option value="<?= $e['id_empresa'] ?>"><?= $e['nombre'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Nombre de la sede</label>
        <input type="text" name="nombre_sede" required class="form-control">
    </div>

    <div class="mb-3">
        <label>Ciudad</label>
        <input type="text" name="ciudad" class="form-control">
    </div>

    <div class="mb-3">
        <label>Dirección</label>
        <input type="text" name="direccion" class="form-control">
    </div>

    <button class="btn btn-success">Guardar</button>
    
    <div class="container mt-4">
    <a href="sedes.php" class="btn btn-outline-secondary mb-3">← Volver a Sedes</a>


</form>

