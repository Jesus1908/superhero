<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico - Tarea 2</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .titulo-principal {
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-section {
            margin-bottom: 40px;
        }

        .checkbox-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
        }

        .checkbox-item input[type="checkbox"] {
            margin-right: 15px;
            transform: scale(1.5);
            cursor: pointer;
        }

        .checkbox-item label {
            cursor: pointer;
            font-size: 16px;
            color: #dc3545;
            font-weight: 500;
            flex: 1;
        }

        .btn-generar {
            background: #dc3545;
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .btn-generar:hover {
            background: #c82333;
        }

        .btn-generar:active {
            transform: translateY(1px);
        }

        .chart-section {
            margin-top: 40px;
            display: none;
        }

        .chart-container {
            position: relative;
            height: 400px;
            margin: 20px 0;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            display: none;
        }

        .loading {
            text-align: center;
            padding: 40px;
            display: none;
        }

        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007bff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="titulo-principal">GRÁFICO</h1>
        
        <div class="form-section">
            <form id="graficoForm">
                <ul class="checkbox-list">
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="1" id="na">
                        <label for="na">N/A</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="2" id="abc" checked>
                        <label for="abc">ABC Studios</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="3" id="darkhorse">
                        <label for="darkhorse">Dark Horse Comics</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="4" id="dc">
                        <label for="dc">DC Comics</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="5" id="george">
                        <label for="george">George Lucas</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="6" id="hanna">
                        <label for="hanna">Hanna-Barbera</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="7" id="harper">
                        <label for="harper">HarperCollins</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="8" id="icon">
                        <label for="icon">Icon Comics</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="9" id="idw">
                        <label for="idw">IDW Publishing</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="10" id="image">
                        <label for="image">Image Comics</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="11" id="rowling">
                        <label for="rowling">J. K. Rowling</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="12" id="tolkien">
                        <label for="tolkien">J. R. R. Tolkien</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="13" id="marvel">
                        <label for="marvel">Marvel Comics</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="14" id="microsoft">
                        <label for="microsoft">Microsoft</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="15" id="nbc">
                        <label for="nbc">NBC - Heroes</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="16" id="rebellion">
                        <label for="rebellion">Rebellion</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="17" id="shueisha">
                        <label for="shueisha">Shueisha</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="18" id="sony">
                        <label for="sony">Sony Pictures</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="19" id="southpark">
                        <label for="southpark">South Park</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="20" id="startrek">
                        <label for="startrek">Star Trek</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="21" id="syfy">
                        <label for="syfy">SyFy</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="22" id="teamepic">
                        <label for="teamepic">Team Epic TV</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="23" id="titan">
                        <label for="titan">Titan Books</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="24" id="universal">
                        <label for="universal">Universal Studios</label>
                    </li>
                    <li class="checkbox-item">
                        <input type="checkbox" name="publishers[]" value="25" id="wildstorm" checked>
                        <label for="wildstorm">Wildstorm</label>
                    </li>
                </ul>
                
                <button type="submit" class="btn-generar">Generar</button>
            </form>
        </div>

        <div class="loading">
            <div class="loading-spinner"></div>
            <p>Generando gráfico...</p>
        </div>

        <div class="error-message" id="errorMessage"></div>

        <div class="chart-section" id="chartSection">
            <div class="chart-container">
                <canvas id="heroesChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        let chart = null;

        document.getElementById('graficoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const publishers = formData.getAll('publishers[]');
            
            if (publishers.length === 0) {
                showError('Debe seleccionar al menos una casa editorial');
                return;
            }
            
            hideError();
            showLoading();
            hideChart();
            
            fetch('/reportes/generar-grafico', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ publishers: publishers })
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.success) {
                    showChart(data.publishers_data);
                } else {
                    showError(data.message || 'Error al generar el gráfico');
                }
            })
            .catch(error => {
                hideLoading();
                showError('Error de conexión');
                console.error('Error:', error);
            });
        });

        function showChart(publishersData) {
            const ctx = document.getElementById('heroesChart').getContext('2d');
            
            // Destruir gráfico anterior si existe
            if (chart) {
                chart.destroy();
            }
            
            const labels = publishersData.map(item => item.publisher_name);
            const data = publishersData.map(item => item.total_heroes);
            
            // Generar colores aleatorios para cada barra
            const colors = publishersData.map(() => {
                const hue = Math.floor(Math.random() * 360);
                return `hsl(${hue}, 70%, 50%)`;
            });

            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Número de Superhéroes',
                        data: data,
                        backgroundColor: colors,
                        borderColor: colors.map(color => color.replace('70%', '60%')),
                        borderWidth: 2,
                        borderRadius: 5,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Distribución de Superhéroes por Casa Editorial',
                            font: {
                                size: 18,
                                weight: 'bold'
                            }
                        },
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                title: function(context) {
                                    return context[0].label;
                                },
                                label: function(context) {
                                    return 'Superhéroes: ' + context.parsed.y;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },
                            title: {
                                display: true,
                                text: 'Cantidad de Superhéroes'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Casas Editoriales'
                            },
                            ticks: {
                                maxRotation: 45,
                                minRotation: 0
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
            
            document.getElementById('chartSection').style.display = 'block';
        }

        function showLoading() {
            document.querySelector('.loading').style.display = 'block';
        }

        function hideLoading() {
            document.querySelector('.loading').style.display = 'none';
        }

        function showError(message) {
            const errorDiv = document.getElementById('errorMessage');
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
        }

        function hideError() {
            document.getElementById('errorMessage').style.display = 'none';
        }

        function hideChart() {
            document.getElementById('chartSection').style.display = 'none';
        }
    </script>
</body>
</html>
