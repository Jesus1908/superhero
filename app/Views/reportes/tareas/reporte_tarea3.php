<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promedio Pesos - Tarea 3</title>
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

        .description {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #2196f3;
        }

        .description h3 {
            margin: 0 0 10px 0;
            color: #1976d2;
            font-size: 18px;
        }

        .description p {
            margin: 0;
            color: #424242;
            line-height: 1.6;
        }

        .chart-controls {
            text-align: center;
            margin: 20px 0;
        }

        .btn-toggle-order {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-toggle-order:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn-toggle-order:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="titulo-principal">Promedio Pesos SH Publisher</h1>
        
        <div class="description">
            <h3>Análisis de Pesos Promedio - Casas de heroes</h3>
        </div>
        
        <div class="loading" id="initialLoading">
            <div class="loading-spinner"></div>
            <p>Cargando gráfico de todas las casas editoriales...</p>
        </div>

        <div class="error-message" id="errorMessage"></div>

        <div class="chart-controls" id="chartControls" style="display: none;">
            <button id="toggleOrderBtn" class="btn-toggle-order">
                <span id="orderText">Ordenar de Menor a Mayor</span>
            </button>
        </div>

        <div class="chart-section" id="chartSection">
            <div class="chart-container">
                <canvas id="pesosChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        let chart = null;
        let currentData = null;
        let originalData = null; 
        let isDescending = true; 

        document.addEventListener('DOMContentLoaded', function() {
            loadAllPublishersChart();
            setupOrderToggle();
        });

        function loadAllPublishersChart() {
            showLoading();
            hideChart();
            
            fetch('/reportes/generar-pesos-todas', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.success) {
                    originalData = data.pesos_data; 
                    currentData = [...data.pesos_data];
                    showChart(currentData);
                    document.getElementById('chartControls').style.display = 'block';
                } else {
                    showError(data.message || 'Error al generar el gráfico');
                }
            })
            .catch(error => {
                hideLoading();
                showError('Error de conexión');
                console.error('Error:', error);
            });
        }

        function showChart(pesosData) {
            const ctx = document.getElementById('pesosChart').getContext('2d');
            
            if (chart) {
                chart.destroy();
            }
            
            const labels = pesosData.map(item => item.publisher_name);
            const data = pesosData.map(item => {
                const peso = parseFloat(item.peso_promedio);
                return peso === 0 ? 0.1 : peso;
            });
            
            const datosOriginales = originalData.map(item => parseFloat(item.peso_promedio));
            const valoresPositivos = datosOriginales.filter(d => d > 0);
            let promedio = 0;
            let limiteExtremo = 0;
            let backgroundColors = 'rgba(0, 123, 255, 0.3)';
            let borderColors = '#007bff'; 
            let pointColors = '#007bff'; 
            
            if (valoresPositivos.length > 0) {
                promedio = valoresPositivos.reduce((a, b) => a + b, 0) / valoresPositivos.length;
                limiteExtremo = promedio * 10;
                
                backgroundColors = pesosData.map(() => 'rgba(0, 123, 255, 0.3)'); 
                borderColors = pesosData.map(() => '#007bff'); 
                pointColors = pesosData.map(() => '#007bff'); 
            }

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Peso Promedio (kg)',
                        data: data,
                        borderColor: Array.isArray(borderColors) ? borderColors : '#007bff',
                        backgroundColor: Array.isArray(backgroundColors) ? backgroundColors : 'rgba(0, 123, 255, 0.3)',
                        borderWidth: 2, 
                        fill: true,
                        tension: 0.1, 
                        pointBackgroundColor: Array.isArray(pointColors) ? pointColors : '#007bff',
                        pointBorderColor: Array.isArray(pointColors) ? pointColors : '#007bff',
                        pointBorderWidth: 0, 
                        pointRadius: 4, 
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: Array.isArray(pointColors) ? pointColors : '#007bff',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2,
                        pointStyle: 'circle'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Peso Promedio (kg)',
                            color: '#007bff',
                            font: {
                                size: 18,
                                weight: 'bold'
                            },
                            padding: {
                                top: 20,
                                bottom: 30
                            }
                        },
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#007bff',
                            borderWidth: 1,
                            callbacks: {
                                title: function(context) {
                                    return context[0].label;
                                },
                                label: function(context) {
                                    const publisherName = pesosData[context.dataIndex].publisher_name;
                                    const originalItem = originalData.find(item => item.publisher_name === publisherName);
                                    const originalValue = parseFloat(originalItem.peso_promedio);
                                    
                                    if (originalValue === 0) {
                                        return 'Peso promedio: 0 kg';
                                    } else {
                                        return 'Peso promedio: ' + Math.round(originalValue) + ' kg';
                                    }
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            type: 'logarithmic',
                            min: 0.1,
                            ticks: {
                                maxTicksLimit: 8, 
                                color: '#666',
                                font: {
                                    size: 12
                                },
                                callback: function(value) {
                                   
                                    if (value >= 1000000) {
                                        return (value / 1000000).toFixed(1) + 'M';
                                    } else if (value >= 1000) {
                                        return (value / 1000).toFixed(1) + 'k';
                                    } else if (value === 0.1) {
                                        return '0';
                                    }
                                    return Math.round(value);
                                }
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.1)',
                                drawBorder: false
                            },
                            title: {
                                display: false
                            },
                            afterBuildTicks: function(scale) {
                                const ticks = scale.ticks;
                                // Agregar tick para 0 si no existe
                                const hasZero = ticks.some(tick => tick.value === 0.1);
                                if (!hasZero) {
                                    ticks.unshift({
                                        value: 0.1,
                                        label: '0'
                                    });
                                }
                            }
                        },
                        x: {
                            ticks: {
                                color: '#666',
                                font: {
                                    size: 11
                                },
                                maxRotation: 45,
                                minRotation: 0
                            },
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            title: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart',
                        delay: function(context) {
                            return context.dataIndex * 100;
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    elements: {
                        point: {
                            hoverRadius: 8
                        }
                    }
                }
            });
            
            document.getElementById('chartSection').style.display = 'block';
        }

        function showLoading() {
            document.getElementById('initialLoading').style.display = 'block';
        }

        function hideLoading() {
            document.getElementById('initialLoading').style.display = 'none';
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

        function setupOrderToggle() {
            const toggleBtn = document.getElementById('toggleOrderBtn');
            toggleBtn.addEventListener('click', function() {
                if (currentData) {
                    isDescending = !isDescending;
                    updateChartOrder();
                    updateButtonText();
                }
            });
        }

        function updateChartOrder() {
            if (!originalData) return;
            const sortedData = [...originalData];
            sortedData.sort((a, b) => {
                if (isDescending) {
                    return b.peso_promedio - a.peso_promedio; // Mayor a menor
                } else {
                    return a.peso_promedio - b.peso_promedio; // Menor a mayor
                }
            });

            currentData = sortedData; 
            showChart(sortedData);
        }

        function updateButtonText() {
            const orderText = document.getElementById('orderText');
            if (isDescending) {
                orderText.textContent = 'Ordenar de Menor a Mayor';
            } else {
                orderText.textContent = 'Ordenar de Mayor a Menor';
            }
        }
    </script>
</body>
</html>
