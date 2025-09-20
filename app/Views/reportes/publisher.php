<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa Editorial</title>
    <?= view('reportes/css/estilos_tarea') ?>
</head>
<body>
    <div class="container">
        <h1>Reporte por Casa Editorial</h1>
        <form action="/reportes/generar" method="get">
            <select name="publisher_id" required>
                <option value="">Seleccione una casa</option>
                <?php foreach ($publishers as $publisher): ?>
                    <option value="<?= $publisher['id'] ?>"><?= esc($publisher['publisher_name']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Generar</button>
        </form>
    </div>
</body>
</html>
