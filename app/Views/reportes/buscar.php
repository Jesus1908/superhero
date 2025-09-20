<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Superhéroe</title>
    <?= view('reportes/estilos_tarea') ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #resultado {
            margin-top: 20px;
        }
        .hero-info {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #000080;
        }
        .hero-info h3 {
            color: #000080;
            margin-top: 0;
        }
        .hero-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buscar Superhéroe</h1>
        <input type="text" id="busqueda" placeholder="Nombre del superhéroe..." style="width: 100%; padding: 10px;">
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
