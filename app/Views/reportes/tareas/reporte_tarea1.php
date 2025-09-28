<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Tarea 1</title>
    <?= view('reportes/css/estilos_tarea') ?>
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
        }
        
        .btn-generar {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .btn-generar:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }
        
        .btn-generar:active {
            transform: translateY(0);
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .description {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Generador de Reporte Personalizado</h1>
        <p class="description">Ingresa un título para tu reporte y genera un PDF personalizado</p>
        
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="/reportes/publishers" style="color: #007bff; text-decoration: none; margin-right: 20px;">← Volver a Reportes</a>
            <a href="/reportes/buscar" style="color: #007bff; text-decoration: none;">Buscar Superhéroes</a>
        </div>
        
        <form action="/reportes/generar-tarea1" method="post">
            <div class="form-group">
                <label for="titulo_reporte">Título Reporte:</label>
                <input type="text" 
                       id="titulo_reporte" 
                       name="titulo_reporte" 
                       placeholder="Ej: Reporte de Ventas 2024"
                       required>
            </div>
            
            <div style="text-align: center;">
                <button type="submit" class="btn-generar">
                    📄 Generar PDF
                </button>
            </div>
        </form>
    </div>
</body>
</html>
