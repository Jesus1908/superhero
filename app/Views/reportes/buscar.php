<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Superhéroe</title>
    <?= view('reportes/css/superpowerview') ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Buscar Superhéroe</h1>
        <input type="text" id="busqueda" placeholder="Nombre del superhéroe...">
        <div id="resultado"></div>
    </div>

    <script>
    $(document).ready(function() {
        $('#busqueda').keyup(function() {
            var query = $(this).val();
            if(query.length > 2) {
                $.ajax({
                    url: '/api/buscar',
                    type: 'GET',
                    data: {nombre: query},
                    success: function(data) {
                        $('#resultado').html(data);
                    }
                });
            } else {
                $('#resultado').html('');
            }
        });
    });
    </script>
</body>
</html>
