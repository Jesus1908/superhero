<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Personalizado</title>
    <?= $estilos ?>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: white;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px;
        }

        .titulo-principal {
            font-size: 36px;
            font-weight: bold;
            margin: 0;
            color: #333;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .info-section {
            margin-bottom: 25px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #007bff;
            text-align: center;
        }

        .info-label {
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px;
        }

        .info-value {
            color: #6c757d;
            font-size: 14px;
        }

        .heroes-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
            border: 2px solid #343a40;
        }

        .heroes-table th {
            background: #343a40;
            color: white;
            padding: 6px 4px;
            text-align: left;
            font-weight: bold;
            font-size: 10px;
            border: 1px solid #495057;
        }

        .heroes-table td {
            padding: 4px 4px;
            border: 1px solid #dee2e6;
            font-size: 9px;
            max-width: 80px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .heroes-table td:nth-child(2) {
            max-width: 120px;
        }

        .heroes-table td:nth-child(3) {
            max-width: 100px;
        }

        .heroes-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .heroes-table tr:hover {
            background-color: #e9ecef;
        }


    </style>
</head>
<body>
    <div class="header">
        <h1 class="titulo-principal"><?= isset($titulo_reporte) ? esc($titulo_reporte) : 'Título no encontrado' ?></h1>
    </div>

    <?php if (!empty($heroes)): ?>
    <table class="heroes-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Superhéroe</th>
                <th>Nombre Real</th>
                <th>Género</th>
                <th>Editorial</th>
                <th>Alineación</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($heroes as $hero): ?>
            <tr>
                <td><?= $hero['id'] ?></td>
                <td><strong><?= esc($hero['superhero_name']) ?></strong></td>
                <td><?= esc($hero['full_name']) ?: 'No especificado' ?></td>
                <td><?= esc($hero['gender']) ?></td>
                <td><?= esc($hero['publisher_name']) ?></td>
                <td><?= esc($hero['alignment']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="info-section">
        <div class="info-label">⚠️ No se encontraron superhéroes</div>
        <div class="info-value">No hay superhéroes que coincidan con los criterios de búsqueda seleccionados.</div>
    </div>
    <?php endif; ?>
</body>
</html>
