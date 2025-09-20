<?= view('reportes/estilos_tarea') ?>
<page backtop="0" backbottom="0" backleft="10mm" backright="0">
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
</page>
