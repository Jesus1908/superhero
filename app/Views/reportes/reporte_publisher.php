<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Superhéroes</title>
    <?= view('reportes/css/estilos_tarea') ?>
</head>
<body>
    <table class="table">
        <thead class="table-thead">
            <tr><th>ID</th><th>Superhéroe</th><th>Nombre Real</th><th>Alineación</th></tr>
        </thead>
        <tbody>
            <?php foreach($rows as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= !empty($row['superhero_name']) ? esc($row['superhero_name']) : 'No especificado' ?></td>
                <td><?= !empty($row['full_name']) ? esc($row['full_name']) : 'No especificado' ?></td>
                <td><?= !empty($row['alignment']) ? esc($row['alignment']) : 'No especificado' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
