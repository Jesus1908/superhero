<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Tarea 2</title>
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
        
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus, input[type="number"]:focus {
            outline: none;
            border-color: #007bff;
        }
        
        .btn-generar {
            background: linear-gradient(45deg, #28a745, #20c997);
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
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
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
        
        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 10px;
        }
        
        .checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            transition: background-color 0.3s;
            border: 2px solid transparent;
        }
        
        .checkbox-label:hover {
            background: #e9ecef;
        }
        
        .checkbox-label input[type="checkbox"] {
            margin-right: 12px;
            transform: scale(1.3);
            cursor: pointer;
        }
        
        .checkbox-label input[type="checkbox"]:checked + .checkmark {
            font-weight: bold;
            color: #28a745;
        }
        
        .checkbox-label:has(input:checked) {
            background: #d4edda;
            border-color: #28a745;
        }
        
        .checkmark {
            font-size: 16px;
            color: #333;
            transition: all 0.3s;
        }

        small {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Generador de Reporte Tarea 2</h1>
        <p class="description">Ingresa un título y configura los filtros para tu reporte personalizado</p>
        
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="/reportes/publishers" style="color: #007bff; text-decoration: none; margin-right: 20px;">← Volver a Reportes</a>
            <a href="/reportes/tarea1" style="color: #007bff; text-decoration: none;">Tarea 1</a>
        </div>
        
        <form action="/reportes/generar-tarea2" method="post">
            <div class="form-group">
                <label for="titulo_reporte">Título Reporte:</label>
                <input type="text" 
                       id="titulo_reporte" 
                       name="titulo_reporte" 
                       placeholder="Ej: Reporte de Superhéroes Tarea 2"
                       required>
            </div>
            
            <div class="form-group">
                <label>Filtrar por Género:</label>
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="generos[]" value="1">
                        <span class="checkmark">♂️ Masculino</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="generos[]" value="2">
                        <span class="checkmark">♀️ Femenino</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="generos[]" value="3">
                        <span class="checkmark">❓ N/A</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label>Rango de IDs de Superhéroes:</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <div style="flex: 1;">
                        <label for="id_minimo" style="font-size: 12px; color: #666; margin-bottom: 5px; display: block;">ID Mínimo:</label>
                        <input type="number" 
                               id="id_minimo" 
                               name="id_minimo" 
                               placeholder="Ej: 1"
                               min="1"
                               value="1"
                               required>
                    </div>
                    <div style="flex: 1;">
                        <label for="id_maximo" style="font-size: 12px; color: #666; margin-bottom: 5px; display: block;">ID Máximo:</label>
                        <input type="number" 
                               id="id_maximo" 
                               name="id_maximo" 
                               placeholder="Ej: 100"
                               min="1"
                               value="100"
                               required>
                    </div>
                </div>
                <small style="color: #666; font-size: 12px; margin-top: 5px; display: block;">
                    🔢 Ejemplo: Si pones del 10 al 50, traerá los superhéroes con ID 10, 11, 12... hasta el 50
                </small>
            </div>
            
            <div style="text-align: center;">
                <button type="submit" class="btn-generar">
                    📄 Generar PDF Tarea 2
                </button>
            </div>
        </form>
    </div>
</body>
</html>
